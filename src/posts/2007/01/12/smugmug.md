---
layout: layouts/post.njk
title: "Implementation Focus: SmugMug"
author: "YUI Team"
date: 2007-01-12
slug: "smugmug"
permalink: /2007/01/12/smugmug/
categories:
  - "YUI Implementations"
---
![For SmugMug, the passion shows in the attention to detail. Slideshows use YUI Animation to fade between images, and if you resize the slideshow window the images scale up (using high-resolution source) to fill your screen.](/yuiblog/blog-archive/assets/smugmug.gif)SmugMug is a four-year-old service that provides online photosharing to high-end, high-touch customers — professional and avocational photographers who care deeply about the presentation of their photographic assets. Headquartered in Mountain View, SmugMug has gotten [a lot](http://www.businessweek.com/magazine/content/06_46/b4009001.htm) [of press](http://gigaom.com/2006/07/13/startups-embracing-amazon-s3/) for [its incorporation of Amazon's S3 storage service](http://blogs.smugmug.com/onethumb/2006/11/10/amazon-s3-show-me-the-money/), but its model is creative on a number of levels. As a small company, its 17 employees are distributed around the US and around the world. Many of SmugMug's employees have been hired from the talent pool discovered within its own loyal customer base. And they've built a site that now supports more than 100 million photographs, all with a very small engineering team. In part, they've done this by leveraging inexpensive pieces of infrastructure (like S3) and open-source software — like [YUI](http://developer.yahoo.com/yui/).

SmugMug started using YUI shortly after it was released, after it was discovered independently by MacAskill and Thompson. Says MacAskill: "When I first became aware of YUI in March or February, I said look, this is the JS Library to use. I looked at all kinds of different things. It seemed to be lean and designed in a way that made sense." The _à la carte_ approach [with its small file footprint](/yuiblog/2006/10/16/pageweight-yui0114/) was a big factor for MacAskill. "I'm the optimization guy. I did not want a heavy footprint for a client-side library."

Looking beyond the architecture and the code quality, SmugMug's engineers saw some other elements that were appealing. "The documentation was really good," says Jimmy. "We didn't want to dig through sparse documentation trying to figure things out. I looked at the YUI examples and I could picture immediately how this fit in the work I was doing."

One of the singular qualities of SmugMug's YUI implementation is that YUI is exposed directly to SmugMug customers. "We let customers control every pixel on the screen," MacAskill told us. "We give them all the tools they need to get exactly the result they want, including using YUI as part of their customization. That's another reason why documentation was such a high priority for us."

In the past 9 months, the team has incorporated into numerous facets of SmugMug's product:

-   Accordion menus based on [Animation](http://developer.yahoo.com/yui/animation);
-   [Panel](http://developer.yahoo.com/yui/container/panel/)\-based flyouts for displaying EXIF information and phototools;
-   [Drag & Drop](http://developer.yahoo.com/yui/dragdrop/) rearrangements of galleries;
-   Lightbox functionality based on the [Panel Control](http://developer.yahoo.com/yui/container/panel/)
-   Rendering and adding new comments based on [Connection Manager](http://developer.yahoo.com/yui/connection/)
-   In-context notifications using [Panels](http://developer.yahoo.com/yui/container/panel/) and [Animation](http://developer.yahoo.com/yui/animation/);
-   [Animation Utility](http://developer.yahoo.com/yui/animation/) and [Dom Collection](http://developer.yahoo.com/yui/dom/) are used to manage opacity and other transitions, giving the interface a more fluid, polished feel;
-   [Dom Collection](http://developer.yahoo.com/yui/dom/) used throughout to manage dynamic DOM updates;
-   Rich interactions underpinned by the [Event Utility](http://developer.yahoo.com/yui/event/), including performance techniques like the use of [purgeElement](http://developer.yahoo.com/yui/docs/YAHOO.util.Event.html#purgeElement) to stay skinny on memory;
-   Use of a modified version of the [Slider Control](http://developer.yahoo.com/yui/slider/)'s [Color Picker example](http://developer.yahoo.com/yui/examples/slider/rgb2.html?mode=dist) in customization screens.

Pain points for SmugMuggers using YUI? "We'd like to see more DOM insertion and creation functionality, the kinds of things we saw in looking quickly at [TabView](http://developer.yahoo.com/yui/tabview/) in the past few days with its [Element object](http://developer.yahoo.com/yui/docs/YAHOO.util.Element.html)," Thompson told us.

We're big fans of SmugMug — they [joined us at Yahoo! for Hack Day](http://blogs.smugmug.com/onethumb/2006/10/05/quickies-hack-day-sun-t1000-amazon-s3/) late last year and their [passion](http://www.smugmug.com/aboutus/aboutus.mg) for geeking out, building cool stuff, and taking care of their customers is evident in everything they do. If you want to get a sense of the love they bestow on their product, go to any gallery ([here's a pretty one with waterfalls](http://www.smugmug.com/gallery/571233)) and click on the slideshow link. When the slideshow begins to play, zoom your browser window — note that the pictures scale up to fill your screen from high-resolution source. They never forget, even in the details, that this is a site for photographers and image lovers and that it's all about maximizing the experience of beautiful images.

_Do you have a YUI implementation that would be of interest to the YUI community? If so, please [share your link](http://groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/) and post a message to the community forum at [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/), or leave us a message in the comments section below._