---
layout: layouts/post.njk
title: "Adding File Upload to the YUI Rich Text Editor's Image Dialog"
author: "YUI Team"
date: 2007-10-17
slug: "rte-fileupload-231"
permalink: /blog/2007/10/17/rte-fileupload-231/
categories:
  - "Development"
---
[Dennis Muhlestein of AllMyBrain.com has posted a nifty integration](http://allmybrain.com/2007/10/16/an-image-upload-extension-for-yui-rich-text-editor/) of the [YUI Rich Text Editor](http://developer.yahoo.com/yui/editor/) with the file upload feature of the [YUI Connection Manager](http://developer.yahoo.com/yui/connection/).

> \[The YUI\] RTE has a great dialog for modifying images. You can't use it to upload images from your computer however. So far, every situation I've needed an RTE has called for the ability to add images from the users hard drive. I've created an extension that modifies the RTE image dialog to include a new input for browsing to an image. It uses the Yahoo Connection manager to upload the image in the background to your server, and then displays the image in the RTE after the file is successfully uploaded.

Dennis's uploader extension integrates with the existing image dialog, adding the requisite fields for file uploading:

![Dennis's uploader integrates with the existing image placement dialog in YUI's RTE.](/yuiblog/blog-archive/assets/uploader.png)

For more on Dennis's RTE adaptation, [check out his blog](http://allmybrain.com/2007/10/16/an-image-upload-extension-for-yui-rich-text-editor/) where he's provided sample code and an `uploader.js` file (compatible with YUI 2.3.1) that allows you to add this to your own RTE implementation.