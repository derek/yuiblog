---
layout: layouts/post.njk
title: "YUI 2.7.0 on InsideLine.com"
author: "YUI Team"
date: 2009-12-14
slug: "yui-2-7-0-on-insideline-com"
permalink: /2009/12/14/yui-2-7-0-on-insideline-com/
categories:
  - "Releases"
  - "YUI Implementations"
---
Here at [Edmunds](http://www.edmunds.com/) ([Edmunds.com](http://www.edmunds.com/)) we just launched a redesign of [Inside Line (InsideLine.com)](http://www.insideline.com/ "Inside Line: News, Road Tests, Auto Shows, Car Photos and Videos"), our automotive enthusiast web site, and we are using the [YUI JavaScript library](http://developer.yahoo.com/yui/ "YUI Library") extensively.

Some of the YUI utilities & widgets used on Inside Line:

-   Yahoo/Dom/Event
-   Animation Utility
-   Connection Manager
-   ImageLoader
-   JSON
-   Selector
-   Carousel
-   TabView

We (the Frontend team) started out with YUI 2.7.0 JavaScript core and built our own JavaScript user interface library on top of it to encapsulate site-specific components and functionality. Our library takes advantage of YUI’s core utilities, including [Dom]( http://developer.yahoo.com/yui/dom/), [Event](http://developer.yahoo.com/yui/event "YUI Library"), [Connection Manager](http://developer.yahoo.com/yui/connection/ "YUI 2: Connection Manager"), and [Animation](http://developer.yahoo.com/yui/animation "YUI Library").

We are using Dom and Event extensively to handle DOM interaction, event listeners and custom event handling. The YUI Connection Manager is handling all of our Ajax implementations, including our custom search widgets. We are also using many of the YUI widgets on Inside Line, including [TabView](http://developer.yahoo.com/yui/tabview/ "YUI 2: TabView") and [Carousel](http://developer.yahoo.com/yui/carousel/ "YUI 2: Carousel Control"), with custom skins. The [YUI ImageLoader](http://developer.yahoo.com/yui/imageloader/ "YUI 2: ImageLoader") helped us improve page performance and meet our strict performance requirements.

We chose YUI because of its great documentation, thorough testing, and the scope and depth of its offerings. The library is easy to learn, understand, and implement. The modularity of the system fits in well with our design principles, and the API and custom events make it extremely extensible and easy to integrate.

### Some Highlights

Multimedia Spotlight (tabview, carousel) from [InsideLine.com](http://www.insideline.com/ "Inside Line: News, Road Tests, Auto Shows, Car Photos and Videos"):

[![InsideLine.com multimedia spotlight.](/yuiblog/blog-archive/assets/il-mm-spotlight-20091211-113200.png)](http://www.insideline.com/ "Inside Line: News, Road Tests, Auto Shows, Car Photos and Videos")

[Image and Video Galleries](http://www.insideline.com/audi/s4/2010/2010-audi-s4-full-test-and-video.html "2010 Audi S4 Full Test and Video") (core, JSON and Carousel):

[![InsideLine.com gallery interface.](/yuiblog/blog-archive/assets/il-gallery-20091211-113030.png)](http://www.insideline.com/audi/s4/2010/2010-audi-s4-full-test-and-video.html "2010 Audi S4 Full Test and Video")

[Ajax Search Widgets](http://www.insideline.com/search/?q=bmw) (Dom, Event, Connection Manager):

[![InsideLine.com search interface.](/yuiblog/blog-archive/assets/il-search-20091211-112649.png)](http://www.insideline.com/search/?q=bmw "Search")

_**Do you have a YUI Imlementation you'd like to share on YUIBlog?** [Check out our contribution guidelines](/yuiblog/blog/contribute/) — we'd love to hear from you._