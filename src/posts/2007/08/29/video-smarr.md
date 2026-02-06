---
layout: layouts/post.njk
title: "YUI Theater — Joseph Smarr: \"High-Performance JavaScript: Why Everything You've Been Taught is Wrong\""
author: "Unknown"
date: 2007-08-29
slug: "video-smarr"
permalink: /blog/2007/08/29/video-smarr/
categories:
  - "YUI Theater"
---
[![](/yuiblog/blog-archive/assets/smarr.jpg)](http://video.yahoo.com/video/play?vid=1041101)

[Joseph Smarr](http://josephsmarr.com) is the Chief Platform Architect at Plaxo, Inc., where he's led the engineering of Plaxo's address-book integration application. In the course of building Plaxo 3.0, which involved an ambitious foray into rich internet application design, Joseph and learned a host of lessons about the importance of performance and the means by which it can be achieved. Many of those lessons ("premature optimization is the root of all evil") will be familiar. But some run contrary to what are commonly thought of as best practice in frontend engineering — for example, the Plaxo team found that in some cases they could achieve substantial gains by attaching event handlers inline using DOM level 0 syntax (e.g. `<div onclick="someGlobalFunction();">`) rather than attaching them via DOM level 2's favored `addListener`.

In sum, Joseph argues for a four-point approach to achieving maximum performance in your web-app:

-   _Be lazy:_ Don't load or do things before you need to; maybe you won't need to load or do them at all.
-   _Be responsive:_ Make things happen quickly. If you can shave 100ms off of an interaction by responding to a `mousedown` event instead of a `click` event, do it.
-   _Be pragmatic:_ Frontend engineering is hard enough. Don't make it harder than it needs to be.
-   _Be vigilant:_ Blank web pages are fast. Web pages become slow because you put stuff in them; slowness is your resonsibility. Vigilance is required to prevent slowness.

Joseph visited Yahoo! this week to reprise his recent talk from OSCON in which he enumerates these lessons and fleshes them out with practical detail and the wisdom of experience. Our thanks to Joseph for the visit and for allowing us to share his presentation publicly on [YUI Theater](http://developer.yahoo.com/yui/theater/).

This video is [available in Flash format on Yahoo! Video](http://video.yahoo.com/video/play?vid=1041101) and as [an MPEG-4, iPod-compatible (and iPhone-compatible!) download](/yuiblog/yuitheater/smarr-performance.m4v) (change the extension from `.m4v` to `.mp4` if your video software doesn't recognize the extension).

<embed flashvars="id=3881103&amp;emailUrl=http%3A%2F%2Fvideo.yahoo.com%2Futil%2Fmail%3Fei%3DUTF-8%26vid%3D1041101&amp;imUrl=http%253A%252F%252Fvideo.yahoo.com%252Fvideo%252Fplay%253Fei%253DUTF-8%2526vid%253D1041101&amp;imTitle=Joseph%2BSmarr%253A%2B%2526quot%253BHigh-performance%2BJavaScript%253A%2BWhy%2BEverything%2BYou%2526%252339%253Bve%2BBeen%2BTaught%2BIs%2BWrong%2526quot%253B&amp;searchUrl=http://video.yahoo.com/search/video?p=&amp;profileUrl=http://video.yahoo.com/video/profile?yid=&amp;creatorValue=ZXJpY21pcmFnbGlh&amp;vid=1041101" height="350" src="http://us.i1.yimg.com/cosmos.bcst.yahoo.com/player/media/swf/FLVVideoSolo.swf" type="application/x-shockwave-flash" width="425">

[Joseph also features in a video this week from the ScobleShow on PodTech](http://www.podtech.net/scobleshow/technology/1611/plaxo-to-ship-online-identity-aggregator-based-on-microformats) ([iPod compatible download](http://media1.podtech.net/download.php?file=media/2007/08/PID_012378/Podtech_Plaxo0807_ipod.mp4)), where he discusses some upcoming Plaxo features including an online identity aggregator based on microformats.

### In Case You Missed...

Some other recent videos from the [YUI Theater series](http://developer.yahoo.com/yui/theater/):

-   **Matt Mlinac:** "The YUI ImageLoader Utility" ([Yahoo! Video](http://video.yahoo.com/video/play?vid=979796) | [.m4v download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/mlinac-imageloader.m4v))
-   **Shawn Lawton Henry:** "Web Content Accessibility Guidelines Update" ([Yahoo! Video](http://video.yahoo.com/video/play?vid=955300) | [.mp4 download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/henry-wcag.mp4))
-   **Joe Hewitt:** "An Introduction to iUI" ([Yahoo! Video](http://video.yahoo.com/video/play?vid=853528) | [.m4v download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/hewitt-iui.m4v))
-   **Karo Caran:** "An Introduction to Screen Maginfication Software" ([Yahoo! Video](http://video.yahoo.com/video/play?vid=633844) | [.m4v download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/caran-screenmag.m4v))