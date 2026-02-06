---
layout: layouts/post.njk
title: "YUI 3.0.0 beta 1 Available for Download"
author: "Eric Miraglia"
date: 2009-06-24
slug: "yui3b1"
permalink: /blog/2009/06/24/yui3b1/
categories:
  - "Development"
---
[YUI 3.0.0 beta 1](http://developer.yahoo.com/yui/3/) is now [available for download from YUILibrary.com](http://yuilibrary.com/downloads/#yui3).

This release takes YUI 3 out of its preview phase and brings its APIs to a near-final state. For those intending to implement YUI 3, the 3.0.0 beta 1 release is a good place to begin the transition. If you've been working with the latest preview release, George Puckett has provided [a comprehensive 3.0.0 beta 1 changelog](http://yuilibrary.com/projects/yui3/wiki/ReadMe/RollUp_3.0.0beta1) to guide you. We look forward to [hearing your feedback](http://yuilibrary.com/forum/viewforum.php?f=15) as you begin working with 3.0.0 beta 1, and we'll work hard to address that feedback as we prepare for a GA release in the coming months.

We've spent a lot of time in this release cycle refining the core elements of YUI 3 — [YUI](http://developer.yahoo.com/yui/3/yui/), [Node](http://developer.yahoo.com/yui/3/node/), and [Event](http://developer.yahoo.com/yui/3/event/) — to ensure that we have the right API going forward. Performance is improved, and we've refined our module/submodule structure. In some cases we've added significant new features, including intrinsic support for event delegation in the Event package; however, the focus is on moving the base library to production quality.

Several YUI 2.x components make their YUI 3 debut in this release:

1.  **[DataSource](http://developer.yahoo.com/yui/3/datasource/):** YUI's data abstraction layer provides a standard interface into data sets, regardless of the data's origin (local, XHR, XSS, etc.) and format (JSON, XML, CSV, etc.);
2.  **[ImageLoader](http://developer.yahoo.com/yui/3/imageloader/):** ImageLoader allows you to defer the loading of images that aren't in the viewport when the page paints, throttling bandwidth usage and improving performance;
3.  **[History](http://developer.yahoo.com/yui/3/history/):** The History component gives you control of the brower's back button within the context of a single-page web application;
4.  **[StyleSheet](http://developer.yahoo.com/yui/3/stylesheet/):** StyleSheet makes it easy to create and modify CSS rules on the fly, allowing you to dynamically style page elements with fewer repaints.

As part of the more granular packaging in the new codeline, we've created separate YUI 3 modules to house functionality that in YUI 2 was bundled with other components. [Cache](http://developer.yahoo.com/yui/3/cache/), [DataType](http://developer.yahoo.com/yui/3/datatype/) and [DataSchema](http://developer.yahoo.com/yui/3/dataschema/) debut in this release; each of these used to be a part of DataSource.

### Getting to Know YUI 3

The best way to get started with YUI 3 is to dive into the [documentation](http://developer.yahoo.com/yui/3/) and [examples](http://developer.yahoo.com/yui/3/examples/) — particularly the examples for the core [YUI](http://developer.yahoo.com/yui/3/examples/yui/), [Node](http://developer.yahoo.com/yui/3/examples/node/) and [Event](http://developer.yahoo.com/yui/3/event/) components.

We also recommend spending some time with Satyen Desai, whose tech talk on YUI 3's design goals and architecture provides an excellent overview of the new codeline. The video is embedded below; [an HD version, along with a transcript, is available from the YUI Theater site](http://developer.yahoo.com/yui/theater/desai-yui3.html).

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=13406817&amp;vid=5044557&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//l.yimg.com/a/p/i/bcst/videosearch/8818/85299985.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=13406817&amp;vid=5044557&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//l.yimg.com/a/p/i/bcst/videosearch/8818/85299985.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40" type="application/x-shockwave-flash" width="512"></object>

  
[Satyen Desai: "YUI 3: Design Goals and Architecture"](http://video.yahoo.com/watch/5044557/13406817) @ [Yahoo! Video](http://video.yahoo.com)

### CSS Grids and YUI 3

Those of you who use the YUI CSS components may notice that we've removed references to YUI CSS Grids in the 3.0.0 beta 1 documentation, although Grids remains present in the download (and, of course, you can continue using [the YUI 2.7.0 version of Grids](http://developer.yahoo.com/yui/grids/)).

We've deprecated the Grids implementation that was included in the preview releases, and we expect to significantly re-engineer this component before reintroducing it as part of YUI 3.

### Roadmap

The 3.0.0 beta 1 release is an important milestone for YUI. At this point, we are encouraging all YUI implementers to use YUI 3 for new projects, especially projects that don't make heavy use of widgets.

Our attention now turns to bringing YUI 3 to GA status. We expect this to happen in Q3, at which time the following components will be promoted to GA:

-   **Core:** YUI, Node, Event
-   **Component foundation:** Attribute, Base, Plugin
-   **Utilities:** Animation, Cookie, Drag and Drop, Get, History, ImageLoader, IO, JSON, Queue, StyleSheet
-   **CSS:** Reset, Base, Fonts

After 3.0.0 GA, the next major release will be 3.1.0, currently scheduled for Q4. The 3.1.0 release will bring the widget foundation to GA, including the following components:

-   **Widget foundation:** Widget and Widget extensions
-   **Utilities:** DataSource, DataSchema, DataType, Cache

During the 3.1.0 release cycle, we'll also begin introducing specific widgets built upon the YUI 3 codeline. Note that Widget, its extensions, and the sample widgets shipping with 3.0.0 beta 1 are expected to evolve significantly in the coming months as we begin focusing more attention on that part of the library.

For full details on the roadmap, refer to the [YUI 3.x Roadmap on YUILibrary.com](http://yuilibrary.com/projects/yui3/roadmap). That page is kept current with the latest information about our plans and progress. The [YUI 3.x Dashboard](http://yuilibrary.com/projects/yui3/dashboard) is also a useful resource for those wanting to track our progress toward major YUI 3 releases.