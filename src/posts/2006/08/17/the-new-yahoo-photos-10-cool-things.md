---
layout: layouts/post.njk
title: "10 Cool Things About The New Yahoo! Photos"
author: "Unknown"
date: 2006-08-17
slug: "the-new-yahoo-photos-10-cool-things"
permalink: /blog/2006/08/17/the-new-yahoo-photos-10-cool-things/
categories:
  - "Development"
---
Editor's Note: We understand that Yahoo!'s user interface isn't all about the [YUI Library](http://developer.yahoo.com/yui/), and there are exciting projects happening here that do great work in the browser without much YUI usage. Though almost all development at Yahoo! is now using YUI, the new Yahoo! Photos site was well underway before YUI was released, and is therefore a notable exception as we [mentioned earlier](/yuiblog/blog/2006/07/18/ten_things/). (It does, however, use YUI's [Connection Manager](http://developer.yahoo.com/yui/connection).) This post is guest-written by one of Photos' lead frontend engineers. Enjoy!

The New Yahoo! Photos has a lot of cool features not commonly found on the web. Drag and drop and inline editing makes getting things done with your photos fast and easy, and it just feels more like a rich application.

To make the new stuff work, we had to make browsers jump through some hoops. This post is the first of a few that will explore some of the big ideas behind the scenes.

(Meanwhile, we hope you'll [take it for a spin](http://photos.yahoo.com/) to see for yourself.)

### 1\. Drag And Drop/Selection Model

With this new version of Yahoo! Photos, the old way of selecting photos using checkboxes is as out of style as using tables for layout! Let's say you were viewing album A, and wanted to copy some photos from there to album B. Like on a desktop, you must first make a selection.

<embed flashvars="id=715134&amp;emailUrl=http%3A%2F%2Fvideo.yahoo.com%2Futil%2Fmail%3Fei%3DUTF-8%26vid%3D62bc0ff14cb6d7abddca961a898e6d22.715134%26vback%3DStudio%26vdone%3Dhttp%253A%252F%252Fvideo.yahoo.com%252Fvideo%252Fstudio%253Fei%253DUTF-8&amp;imUrl=http%253A%252F%252Fvideo.yahoo.com%252Fvideo%252Fplay%253F%2526ei%253DUTF-8%2526vid%253D62bc0ff14cb6d7abddca961a898e6d22.715134&amp;imTitle=Yahoo%2521%2BPhotos%2BUI%2BDemo&amp;searchUrl=http://video.yahoo.com/video/search?p=&amp;profileUrl=http://video.yahoo.com/video/profile?yid=&amp;creatorValue=eXBob3Rvc21ldGE%3D" height="350" src="http://us.i1.yimg.com/cosmos.bcst.yahoo.com/player/media/swf/FLVVideoSolo.swf" type="application/x-shockwave-flash" width="425">

You can simply click and draw a selection rectangle around the photos you'd like to copy, or alternately select photos like you would on a desktop using the CTRL or Shift keys. Once selected, you can use CTRL-C to copy or simpler yet, just drag the photos to the album on the list at left; confirm the copy, and you're done!

![A ](http://us.i1.yimg.com/us.yimg.com/i/us/plus/misc/tutorials/ph/ph_addtowin_yp_1.gif)

A "Copy Photos" dialog

The selection model is a core part of content management for owners on the New Yahoo! Photos, as well as for guests and friends browsing and viewing photos. It is easy with the mouse, and when combined with keyboard shortcuts, a powerful way of selecting a choice number of photos from a large collection to perform operations on such as viewing a slideshow, emailing to friends or ordering prints.

![Viewing photos in an album](http://us.i1.yimg.com/us.yimg.com/i/us/plus/misc/tutorials/ph/ph_albumview2_400_yp_1.gif)

Photos may also be rearranged within albums, similar to the way they can be copied; users may simply select, then drag and drop the photos to their new position within the page, and the new order will be saved.

![Rearranging photos (red marks for illustration)](http://us.i1.yimg.com/us.yimg.com/i/us/plus/misc/tutorials/ph/ph_move2photos_yp_1.gif)

Rearranging a selection of photos, about to drop in new location (red marks for illustration)

### 2\. Keyboard Shortcuts

Desktop applications implement shortcuts to commonly-used menu items, such as CTRL-A or CTRL-C (Command key instead of CTRL for Mac,) which typically are "Select All" and "Copy", respectively.

This applies to the new Photos as well, which uses some keyboard shortcuts to make common tasks more accessible. While in a thumbnail view, you can select all of the photos by using CTRL-A, or copy a selection of photos to an album by using CTRL-C (we'll show you a "copy to.." dialog at that point.)

### 3\. Inline Editing

One common interaction that some may feel has been missing from the web, is inline editing. When viewing your own photos on the New Yahoo! Photos, you can easily edit some of your photo data inline without having to wait for the page to reload. If you don't like the name of a photo, simply click on its name, type a new one and click elsewhere or push Enter - just like you're used to on your desktop. You can also add comments and assign ratings inline when viewing a photo in detail, again without reloading the page.

![Inline editing in action.](http://us.i1.yimg.com/us.yimg.com/i/us/plus/misc/tutorials/ph/ph_inlineedit1_yp_1.gif)

Inline editing in action.

### 4\. New User Tips

Many of the new features such as the selection model and drag and drop in the new Yahoo! Photos may not be new to computer users, but our findings were that people did not expect to find these sort of features on the web. For this reason, we have the "New User Tips" guide which serves as an assistant of sorts, educating first-time users about what they can do with the new site.

The first time a new user logs into Yahoo! Photos, the "New User Tips" tutorial begins and explains some of the key new features with visual pointers overlaid on top of the "live" UI. This is similar to the "tour" feature as shown on the recently-redesigned [Yahoo! front page](http://www.yahoo.com).

![New user tips in action.](http://us.i1.yimg.com/us.yimg.com/i/us/ph/gr/nut/nut-all.png)

### 5\. Animation and Eye Candy

The New Yahoo! Photos was designed to both "look good and work well," including some stylistic flourishes and pleasing UI effects such as animation, fading transitions, modal dialogs and drop shadows.

In the case of dragging a selection of photos within the UI, an animation effect is used when the user starts dragging; the photos "zoom and shrink" towards the cursor as though it were a vacuum pulling the photos inward, so that they group together as miniature thumbnails underneath the cursor. (This is accomplished using Javascript, which repetitively modifies the position and size of each photo thumbnail until the animation is complete.)

The effect, while visually pleasing and even entertaining, has two practical uses:

1.  It prevents a large, full-size replica of content (cloned, "ghosted" thumbnails) from moving around the screen while the user is dragging, and creating "giant scrollbars" that disrupt the experience. On the desktop, moving a full-size replica around is not an issue because of the lack of scrollbars; on the web, we wanted a way to display a potentially-large selection of photos without causing the user's browser to adjust its scrollbars to accommodate the extra content.
2.  It's more expensive (i.e. slower) for the browser to redraw larger areas of content at once.

The earliest prototypes of the New Yahoo! Photos UI did not have the animation sequence when beginning a drag operation, but the lack of visual transition between "selected" and "dragging minimized under the cursor" looked awkward. After we added the animation effect, the UI felt more playful and fun, so it stayed.

### 6\. Progressive Loading

People are taking and sharing more and more photos, and our collections are growing into the thousands of photos. To make managing big photo collections as easy as possible, we had to figure out a way to display lots of thumbnails while keeping the site's browser-based UI snappy.

The New Yahoo! Photos strikes a balance between scrolling, pagination, browser rendering capabilities, and memory limitations and uses a technique of "progressive loading," effectively copying and inserting an empty "template" for a page of photos, then loading the photo information (metadata and thumbnail images) and adding them to the page on demand. It is truly on-demand in the sense that photos and related data area not loaded until their "containers" are scrolled into view, which keeps the UI feeling responsive. (More on the details of this technique in a forthcoming post.)

### 7\. Upload Tools

Uploading is the first step to take when you're using a photo site to share or print. Since most people want to share many photos at once, it's crucial for a site like Yahoo! Photos to make uploading large batches of photos easy.

To do that, the New Yahoo! Photos provides an Easy Upload Tool that comes in two flavors: a Firefox extension (that works on PC and Mac) and an ActiveX control for Internet Explorer on the PC. Both flavors of the tool share the same Javascript client-side code and UI. This approach allowed us to provide a consistent user experience regardless of browser, and reduces the maintenance cost and testing overhead. A standard form-based uploader is provided for other browsers.

Third-party developers have started writing upload tools that use the Yahoo! Photos API. Michael Galloway's [cool iPhoto plug-in](http://gallery.yahoo.com/apps/121) is one of the first to appear. Documentation for the public API should be posted on [http://developer.yahoo.com](http://developer.yahoo.com/) shortly if you're interested in writing something.

### 8\. Messenger Integration

The latest version of [Yahoo! Messenger](http://messenger.yahoo.com) pulls in our photo picker tool to allow users to quickly share each others' favorite shots from Yahoo! Photos right within your IM window.

![IM sharing in action](http://us.i1.yimg.com/us.yimg.com/i/us/ph/gr/msgr/im-share.jpg)

### 9\. Target Store Locator

When ordering [prints](http://new.photos.yahoo.com/shop/prints) of your photos in the US, you can choose to pick them up at your local Target store, as well as send them to a Target store close to a friend or family member across the country. Locating the closest Target store is now a lot easier with the draggable [Yahoo! Maps](http://maps.yahoo.com/beta/) mashup created by our partners at [EZ Prints](http://www.ezprints.com/home/).

![Screenshot of Target Store Locator](http://us.i1.yimg.com/us.yimg.com/i/us/ph/gr/nut/target-store-locator.png)

### 10\. ...And All That Ajax: YUI Connection Manager

"What's Ajax?", [Amy Hoy](http://www.slash7.com/) asks in her [humourous cheatsheet](http://www.slash7.com/cheats/whats_ajax_cheatsheet.pdf) (pdf link) - "Buzzword Bingo," she says: "Everyone's talking about Ajax, and practically nobody actually has a clue as to what it actually is". She summarizes nicely in saying, "No server requests? It Ain't Ajax".

If I were to try to answer Amy's question, I'd say the [YUI Connection Manager](http://developer.yahoo.com/yui/connection/), part of the [Yahoo! User Interface Library](http://developer.yahoo.com/yui/), _is_ Ajax. The YUI Connection Manager wraps Javascript's native xmlHttpRequest object and provides a normalised API which allows data to be retrieved asynchronously, including handler hooks for events such as success and failure. The New Yahoo! Photos uses the Connection Manager extensively for retrieving photo data on demand, performing inline editing on photos (e.g., renaming, copying, deleting or assigning a rating,) loading messaging data to be displayed in modal dialogs and other "inline" functionality which is carried out without reloading the page.

The adoption of the xmlHttpRequest (XHR) object across major modern web browsers has prompted developers to explore dynamic updates (both sending and receiving,) and as a result there has been a renewed interest in Javascript. Because pages now reload less-often due to XHR calls, Javascript is being used to manage the result of these calls - modifying the Document Object Model (DOM) within the browser, updating or creating new content, creating animation effects and transitions to enhance the UI and overall providing an enhanced experience. These techniques, collectively a part of "DHTML," have been around since the late 1990s, but did not see such wide-spread popularity until the XHR object became a de-facto standard.

While technically not Ajax, javascript animation, dynamic updates, effects and other forms of DHTML have become more mainstream due to the adoption of Ajax. While The New Yahoo! Photos was developed before the [YUI Library](http://developer.yahoo.com/yui/) was available, utilities are now available in this area including [animation](http://developer.yahoo.com/yui/animation/), [drag and drop](http://developer.yahoo.com/yui/dragdrop/), positioning and [event handling](http://developer.yahoo.com/yui/event/).

### Was It Good For You, Too?\*

The New Yahoo! Photos has some powerful new features and desktop-like interactions which are not typically expected on the web; we think you'll like it. If you don't have a Yahoo! ID, you can get one and start uploading photos at [http://photos.yahoo.com/](http://photos.yahoo.com/)

This article is one in a multi-part series on the New Yahoo! Photos; in the next article, we will delve into some technical details, including thoughts about performance, troubleshooting and other points of interest.

[Scott Schiller](http://www.schillmania.com/) is a self-described DHTML + Web Standards Evangelist, Resident DJ and record crate digger. He is one of the Front-end Engineers on Yahoo! Photos, and enjoys combining technical and creative skills in his work.

\* Heading inspiration: [alistapart.com](http://www.alistapart.com/)