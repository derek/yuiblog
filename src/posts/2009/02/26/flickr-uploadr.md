---
layout: layouts/post.njk
title: "Flickr Uploadr: Improving Browser-based File Uploads with YUI Uploader"
author: "Scott Schiller"
date: 2009-02-26
slug: "flickr-uploadr"
permalink: /blog/2009/02/26/flickr-uploadr/
categories:
  - "Development"
---
Traditionally, file uploading in the browser has been awkward, slow and error-prone. File selection is done one at a time and monitoring progress of the upload is difficult. There are no simple callbacks for total bytes, progress, error handling and so on, restricting the developer's ability to provide meaningful messaging on the UI end.

Conveniently, existing browser plug-ins such as Flash can be used to provide or enhance certain functionality which browsers themselves do not support. The combination of Flash and JavaScript allows for batch file selection, progress and error reporting, and speedier uploading.

In a typical Flash-driven uploader, Flash provides the core service and provides callbacks to JavaScript-land with status updates, messaging and so on. JavaScript then updates an HTML and CSS-driven UI. Flash-JavaScript communication is made possible by Flash's `ExternalInterface` API, introduced with Flash 8. Several projects have implemented uploaders based on this approach, including the [YUI Uploader](http://developer.yahoo.com/yui/uploader/) control and [SWFUpload](http://swfupload.org) among others. While developing against `ExternalInterface` can get a bit quirky, an effective library can abstract away most of the quirks and provide a convenient API allowing you to take advantage of Flash's improved file-handling abilities through JavaScript.

### Building an effective upload UI

![](/yuiblog/blog-archive/assets/uploadr/ready.png "Screen capture of Flickr Uploadr's initialized state")

On Flickr, we implemented a simple large "Choose photos and videos" link which when clicked, opens a multi-select-capable file-selection dialog driven by the YUI Uploader (which requires Flash 9). YUI Uploader provides file metadata via [`fileSelect`](http://developer.yahoo.com/yui/docs/YAHOO.widget.Uploader.html#event_fileSelect) event callbacks after files are selected, at which point the file list and UI can be updated. The user can add and remove files as they like according to business logic, configure upload options and so on.

### Beginning the Upload

![](/yuiblog/blog-archive/assets/uploadr/files-added.png "Screen capture of Flickr Uploadr's files-added state")

Once the user has prepared their selection of files and clicked "Upload Photos and Videos", the file queue is processed. YUI Uploader can upload files simultaneously or in sequence to a given URL (a signed API call in Flickr's case) with callbacks for file progress, errors, file completion and upload completion. The idea is that the control's Flash component simply sends files and reports errors and progress, leaving all of the event handling to JavaScript. Because of this separation, upload behaviours can easily be changed or updated without having to change the Flash component.

### Upload Progress

During file upload, the [`uploadProgress`](http://developer.yahoo.com/yui/docs/YAHOO.widget.Uploader.html#event_uploadProgress) event fires regularly, providing the file ID, bytes uploaded and total bytes for each file. This data can be reflected as a progress bar, a percentage value or raw bytes depending on your UI.

   

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" data="http://www.flickr.com/apps/video/stewart.swf?v=67090" height="347" type="application/x-shockwave-flash" width="500"><param name="flashvars" value="intl_lang=en-us&amp;photo_secret=a963966738&amp;photo_id=3259239187"> <param name="movie" value="http://www.flickr.com/apps/video/stewart.swf?v=67090"> <param name="bgcolor" value="#000000"> <param name="allowFullScreen" value="true"><embed allowfullscreen="true" bgcolor="#000000" flashvars="intl_lang=en-us&amp;photo_secret=a963966738&amp;photo_id=3259239187" height="347" src="http://www.flickr.com/apps/video/stewart.swf?v=67090" type="application/x-shockwave-flash" width="500"></object>

  
Flickr Uploadr screencast from [designingwebinterfaces](http://flickr.com/photos/designingwebinterfaces/3259239187/) on Flickr.

### Connection Error Handling

If a file upload fails due to a connection or IO error from Flash, the [`uploadError`](http://developer.yahoo.com/yui/docs/YAHOO.widget.Uploader.html#event_uploadError) event will fire so you can attempt to gracefully recover by retrying the upload of that file. Another safeguard is to implement a basic timeout such that if a file upload "hangs" for too long without a reported error (e.g., 2 minutes passes without an `uploadProgress` event), the file upload can be aborted.

### File Upload Response Handling

When a file has been posted to the target URL, the server response is passed to a JavaScript callback via the [`uploadCompleteData`](http://developer.yahoo.com/yui/docs/YAHOO.widget.Uploader.html#event_uploadCompleteData) event. Photos are processed asynchronously post-upload in Flickr's case, so a processing ticket ID is provided in the upload response. The ticket ID is then polled via API calls until a success/fail result is ultimately returned after server-side processing.

### Uploader Start-Up Handling

![](/yuiblog/blog-archive/assets/uploadr/loading.png "Screen capture of Flickr Uploadr's pre-initialized loading UI")

YUI Uploader handles the creation and writing out of the Flash object and its initialization process. Once the control has loaded, the [`contentReady`](http://developer.yahoo.com/yui/docs/YAHOO.widget.FlashAdapter.html#event_contentReady) event fires and the file selection process can begin. It is worth considering displaying some sort of "loading" element in your UI, in case the user wants to "choose files" before the control has initialized. In Flickr's case, we show a small animation next to the "Choose photos and videos" link to indicate a loading state, as well as greying out the text itself.

It is also helpful to have a fall-through error handler that redirects the user to an alternate upload method, such as a non-JavaScript form-based file upload. The Flickr Uploadr detects for Flash 9+ upfront with JavaScript (e.g., the SWFObject), and also uses a `try...catch` block in the `init` method and around the file-selection bits. So if something goes wrong during initialization or when the user clicks the "Choose" link, exceptions trigger a fall-through to our basic uploader. This also is an appropriate fallback for users who don't have Flash or JavaScript to begin with.

### Special Casing: Handling Flash 10 Security Restrictions

Due to a change in the security model beginning with Flash 10, file selection must now begin via the user clicking directly on the Flash movie. With previous versions, you could call \[Flash movie\].selectFiles() from JavaScript and the selection dialog would be shown without requiring user action.

To keep the user experience consistent on Flickr where an HTML link could trigger the selection dialog, we made the Flash movie transparent and [overlaid it on top of the HTML link](http://developer.yahoo.com/yui/examples/uploader/uploader-advanced-postvars.html). Thus, the Flash movie captures the click and the selection dialog works as expected. One might call this a legitimate, local form of clickjacking.

If repositioning the Flash movie is undesirable in your use case, another option is to render the link, text or button UI [within the Flash movie itself](http://developer.yahoo.com/yui/examples/uploader/uploader-simple-button.html) and show the movie as a normal inline element.

### Should I Use This?

While there are some notable technical considerations associated with developing a Flash-based uploader UI — such as initialization and error handling — as with most nifty/shiny web things, the technical complexity of the implementation rests solely with the developer. Once the application logic has been implemented by the developer and integrated with YUI Uploader, the end result is an upload experience that is consistently faster, more convenient, efficient and more robust to the end user.