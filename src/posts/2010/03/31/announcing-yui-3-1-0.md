---
layout: layouts/post.njk
title: "Announcing YUI 3.1.0"
author: "YUI Team"
date: 2010-03-31
slug: "announcing-yui-3-1-0"
permalink: /2010/03/31/announcing-yui-3-1-0/
categories:
  - "Releases"
  - "Development"
---
The YUI team is pleased to announce the release of [YUI 3.1.0](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library").

Highlights of this release include the following:

-   **Component infrastructure** — The Widget infrastructure for YUI 3 is now largely in place. Satyen Desai has been focused on this work over the past several months, and [the approach he discussed at YUICONF 2009](http://developer.yahoo.com/yui/theater/video.php?v=desai-yuiconf2009-widgets "Video: Satyen Desai — A Widget Walkthrough (YUI Theater)") is now fully realized as the [Base](http://developer.yahoo.com/yui/3/base/), [Attribute](http://developer.yahoo.com/yui/3/attribute/ "YUI Library"), [Plugin](http://developer.yahoo.com/yui/3/plugin/ "YUI Library") and [Widget](http://developer.yahoo.com/yui/3/widget/ "YUI Library") modules in the component infrastructure group reach GA status. Satyen has provided a [detailed developer guide](http://developer.yahoo.com/yui/3/widget/) for those interested in learning more about the component infrastructure.
    
       
    
    <object height="287" width="510"><param name="movie" value="http://d.yimg.com/m/up/ypp/default/player.swf"> <param name="flashVars" value="vid=16467713&amp;"> <param name="allowfullscreen" value="true"> <param name="wmode" value="transparent"><embed allowfullscreen="true" flashvars="vid=16467713&amp;" height="287" src="http://d.yimg.com/m/up/ypp/default/player.swf" type="application/x-shockwave-flash" width="510"></object>
    
-   **Internationalization utility** — Satyen worked with Yahoo internationalization engineer Norbert Lindenberg on the new [Internationalization utility](http://developer.yahoo.com/yui/3/intl/) for 3.1.0. This component introduces YUI 3's approach to internationalization, allowing for the externalization of module language resource bundles that can be delivered separately from code, with support added to Adam Moore's loader for specifying language preferences. We'll continue to develop and build upon this approach as we introduce YUI 3 widgets with more complex UIs.
-   **TabView as a reference widget** — Matt Sweeney's [TabView](http://developer.yahoo.com/yui/3/tabview/) is updated and serves as a good reference implementation for YUI 3-based widgets, including the approach we're taking on progressive enhancement.
    
    [![](/yuiblog/blog-archive/assets/tabview-20100329-161513.jpg)](http://developer.yahoo.com/yui/3/examples/tabview/tabview-io.html)
    
-   **Loader improvements** — Adam Moore has improved YUI 3's loader to better support the [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery"). As of 3.1.0, you can now load any Gallery module that shipped prior to 3.1.0 without additional configuration simply by referencing the module in your `use()` statement.
-   **YUI 2 in 3** — Adam extended the power of `use()` even further with the [YUI 2 in 3 project](/yuiblog/2010/03/11/yui-2-in-3-coming-soon/ "YUI 2 in 3: Coming in YUI 3.1.0, a Simpler Way To Use YUI 2 Modules » Yahoo! User Interface Blog (YUIBlog)"). With the release of 3.1.0, you can now include YUI 2 modules directly from your `use()` statement, bringing a fully sandboxed version of YUI 2 into your YUI 3 instance. This work supports developers who are making the transition to YUI 3 but are still dependent on some components that are unique to YUI 2, including the popular [YUI 2 DataTable](http://developer.yahoo.com/yui/datatable/ "YUI 2: DataTable").
-   **New Sortable utility** — [Sortable](http://developer.yahoo.com/yui/3/sortable) is a new utility from Dav Glass that leverages [Drag and Drop](http://developer.yahoo.com/yui/3/dd/) to implement sortable lists. Support is provided for single lists or multiple lists in which items can be dragged from one list to the other.
    
    [![](/yuiblog/blog-archive/assets/sortable-20100329-160801.jpg)](http://developer.yahoo.com/yui/3/examples/sortable/sortable-multi-out.html)
    
-   **Visual treatments for Slider** — Visual designer Jeff Conniff worked with YUI engineer Luke Smith on the [Slider](http://developer.yahoo.com/yui/3/slider/) component for 3.1.0, the result of which was a series of alternative visual treatments for Slider. Luke has also updated Slider to take advantage of improvements in the general Widget infrastructure.
    
    [![](/yuiblog/blog-archive/assets/sliderskins-20100329-161107.jpg)](http://developer.yahoo.com/yui/3/examples/slider/slider_skin.html)
    
-   [![](/yuiblog/blog-archive/assets/hover-event.png)](http://developer.yahoo.com/yui/3/event/#define)**New API for creating synthetic DOM events** — Luke added the [`Y.Event.define()`](http://developer.yahoo.com/yui/3/event/#define) method to make it easy for developers to define new DOM events in the YUI 3 ecosystem. Use this to fill in gaps in the native DOM event list or otherwise label common user interaction moments, then subscribe and unsubscribe as you would with any other event.

As always, YUI program manager Georgiann Puckett has provided [a comprehensive changelog for the YUI 3.1.0](http://yuilibrary.com/projects/yui3/wiki/ReadMe/RollUp_3.1.0) release — refer to that document for detailed information about what has changed throughout the YUI 3 family.

### What's Next?

Between the release of YUI 3.0.0 and 3.1.0, more than 50 free, open-source modules have been added to the [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery"). Today, [all of that content is accessible to you from any YUI 3.1.0 instance](http://developer.yahoo.com/yui/3/examples/yui/yui-gallery.html). As we get started on our work for YUI 3.2.0, the library itself will be anything but static — currently, YUI 3 is growing more rapidly from community contributions than from the core team's work, and those contributions are accessible at an unprecedented scale.

In the coming weeks, we'll update the [YUI 3 roadmap](http://yuilibrary.com/projects/yui3/roadmap "Roadmap :: YUI 3 :: YUI Library") and [calendar](http://yuilibrary.com/projects/yui3/calendar#calendar "Calendar :: YUI 3 :: YUI Library") with early objectives and timelines from our 3.2.0 planning. 3.2.0 will be a widget-focused release as the majority of the core team turns its attention to the high-value UI building blocks that are familiar from the YUI 2 world.

In the meantime, we look forward to your feedback on YUI 3.1.0. Join us in the [YUILibrary.com forums](http://yuilibrary.com/forum/ "YUI Library :: Forums :: Index page") and let us know via the [bug tracker](http://yuilibrary.com/projects/yui3/report "Available Reports :: YUI 3 :: YUI Library") if you discover issues in the release.