---
layout: layouts/post.njk
title: "YUI Theater — Matt Mlinac: \"The YUI ImageLoader Utility\""
author: "YUI Team"
date: 2007-08-21
slug: "video-mlinac"
permalink: /blog/2007/08/21/video-mlinac/
categories:
  - "YUI Theater"
---
<embed flashvars="id=3765292&amp;emailUrl=http%3A%2F%2Fvideo.yahoo.com%2Futil%2Fmail%3Fei%3DUTF-8%26vid%3D979796&amp;imUrl=http%253A%252F%252Fvideo.yahoo.com%252Fvideo%252Fplay%253Fei%253DUTF-8%2526vid%253D979796&amp;imTitle=Matt%2BMlinac%253A%2B%2526quot%253BThe%2BYUI%2BImageLoader%2BUtility%2526quot%253B&amp;searchUrl=http://video.yahoo.com/search/video?p=&amp;profileUrl=http://video.yahoo.com/video/profile?yid=&amp;creatorValue=ZXJpY21pcmFnbGlh&amp;vid=979796" height="350" src="http://us.i1.yimg.com/cosmos.bcst.yahoo.com/player/media/swf/FLVVideoSolo.swf" type="application/x-shockwave-flash" width="425">

One of the new components in YUI version 2.3.0 is the **ImageLoader Utility** ([User's Guide](http://developer.yahoo.com/yui/imageloader/); [examples](http://developer.yahoo.com/yui/examples/imageloader/); [Cheat Sheet](/yuiblog/blog-archive/assets/pdf/cheatsheets/imageloader.pdf)), an experimental component written by Yahoo! Travel engineer Matt Mlinac that allows you to defer the loading of some images during the initial page load.

ImageLoader operates on the premise that image data for some images is unnecessary at the initial paint of the page, usually for one of two reasons:

1.  The image is "below the fold" — that is, outside of the viewport;
2.  The image is in the DOM but will not be made visible until some user interaction takes place, as is the case in [some TabView implementations](http://developer.yahoo.com/yui/examples/imageloader/imgloadtabs.html).

[![Yahoo! engineer Matt Mlinac introduces the YUI ImageLoader Utility.](/yuiblog/blog-archive/assets/mlinac-imageloader.jpg)](http://video.yahoo.com/video/play?vid=979796)ImageLoader allows you to withhold the `src` attribute of images (which prevents them from loading, obviously) while still supplying other accessibility-related attributes like `alt` and `longdesc`. ImageLoader provides a "foldConditional" property that automatically senses whether images are in the viewport, enabling easy implementation of the simplest image deferral scenario. In all scenarios, ImageLoader allows you to define specific triggers that cause image data to load. Common triggers include the window's scroll event (which can bring "below-the-fold" images into view), the user mousing over a control that might reveal deferred images in a widget, and so on.

[In this 9-minute video](http://video.yahoo.com/video/play?vid=979796), Matt talks through some of those scenarios, walks through three examples, and introduces you to basic code patterns to get you started evaluating this interesting component.

While there are non-trivial drawbacks to withholding the `src` attribute from images, the savings in overall K-weight at initial pageload can be dramatic for some implementations. The least-obtrusive way to implement ImageLoader is to provide all visitors with image `src` attributes on the first visit to your site and then, if you determine that a given user has JavaScript enabled, begin applying ImageLoader (and withholding `src` attributes) on subsequent page views. That said, there are obviously some implementations where ImageLoader is a better fit than others, and for some the objection to withholding the `src` attribute under any circumstances is too much to overcome. For sites that rely on the SEO characteristics that obtain when search spiders can match image tag attribute data to image source URLs, the ImageLoader approach would be detrimental. We've released ImageLoader as an [experimental component](http://developer.yahoo.com/yui/articles/faq/#experimental) and we're interested to hear your feedback on the utility and its intrinsic assumptions [in the YUI community forums](http://tech.groups.yahoo.com/group/ydn-javascript/).

This video is [available in Flash format on Yahoo! Video]( http://video.yahoo.com/video/play?vid=979796) and as [an MPEG-4, iPod-compatible (and iPhone-compatible!) download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/mlinac-imageloader.m4v) (change the extension from `.m4v` to `.mp4` if your video software doesn't recognize the extension).

[![Full documentation and examples for the YUI ImageLoader can be found on the YUI website.](/yuiblog/blog-archive/assets/imageloader-cheatsheet.gif)](http://developer.yahoo.com/yui/imageloader/)

### In Case You Missed...

Some other recent videos from the [YUI Theater series](http://developer.yahoo.com/yui/theater/):

1.  **Shawn Lawton Henry:** "Web Content Accessibility Guidelines Update" ([Yahoo! Video](http://video.yahoo.com/video/play?vid=955300) | [.mp4 download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/henry-wcag.mp4))
2.  **Joe Hewitt:** "An Introduction to iUI" ([Yahoo! Video](http://video.yahoo.com/video/play?vid=853528) | [.m4v download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/hewitt-iui.m4v))
3.  **Karo Caran:** "An Introduction to Screen Maginfication Software" ([Yahoo! Video](http://video.yahoo.com/video/play?vid=633844) | [.m4v download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/caran-screenmag.m4v))
4.  **Douglas Crockford:** "JavaScript: The Good Parts" ([Yahoo! Video](http://video.yahoo.com/video/play?vid=630959) | [.m4v download](http://us.dl1.yimg.com/download.yahoo.com/dl/ydn/yui/theater/crockford-goodstuff.m4v))