---
layout: layouts/post.njk
title: "An Update on YUI 3 Charts"
author: "Tripp Bridges"
date: 2010-02-18
slug: "an-update-on-yui-3-charts"
permalink: /2010/02/18/an-update-on-yui-3-charts/
categories:
  - "Development"
---
![YUI 3 Charts in action.](/yuiblog/blog-archive/assets/yui3charts.jpg)

Today, we checked in our work-to-date on the next generation of YUI Charts. You can find this pre-alpha code, along with some examples, [in the sandbox directory of the YUI 3 head on GitHub](http://github.com/yui/yui3/tree/master/sandbox/chart/ "sandbox/chart at master from yui's yui3 - GitHub"). This initial release is a preview of where we're going with YUI Charts; no aspect of this implementation is complete, and it's not suitable for production use at this point, but it does give a sense of where we're heading — and it's a chance for us to check in with interested developers and share our progress. (If you need a production-ready charts solution today, check out [YUI 2 Charts](http://developer.yahoo.com/yui/charts/).)

For this release, we have created a solid foundation to build up the functionality of the Charts, and we've included one simple chart type to demonstrate the flexibility of our architecture. In particular:

-   YUI 3 Charts are now fully modular. Individual subcomponents of a Chart, like an Axis, or a LineGraph, are now their own classes that you can manage and update individually.
-   The modularity of the Charts component within the Flash Player (our current rendering engine of choice) is fully paralleled in its JavaScript wrapper. From the JS developer's point of view, you are working with a set of JS components, with all method calls, display list changes and property assignments seamlessly transmitted to Flash and back. (This abstraction will be even more crucial when we move beyond a single rendering engine.)
-   The Charts now support styling every single element — from label rotation and font faces (no need for embedded fonts!), to the color and number of tick marks.
-   Because of the new modularity, features like multiple axes and multiple independent graphs are now included.
-   In addition to the very advanced Chart, we've drafted a sugar wrapper called SimpleChart, which allows you to quickly build Charts with two lines of code.

Now that the foundation is in place, our next step is to continue building up the Charts functionality. If you are interested in what that will be, [take a look at our talk from YUIConf 2009, where we described our grand plans for the architecture and features of the Charts package](http://developer.yahoo.com/yui/theater/video.php?v=rabinovich-yuiconf2009-charts "Video: Allen Rabinovich — YUI 3 Infographics (YUI Theater)").

   

<object height="300" width="510"><param name="movie" value="http://d.yimg.com/m/up/ypp/default/player.swf"> <param name="flashVars" value="vid=16714396&amp;"> <param name="allowfullscreen" value="true"> <param name="wmode" value="transparent"><embed allowfullscreen="true" flashvars="vid=16714396&amp;" height="300" src="http://d.yimg.com/m/up/ypp/default/player.swf" type="application/x-shockwave-flash" width="510"></object>

You can start playing with Charts immediately: the component, along with a few very informative examples, is located in the YUI 3 sandbox. To get started, [download the latest YUI 3 build from GitHub](http://github.com/yui/yui3/downloads), drop it in your web root, and navigate to the `sandbox/chart/tests` directory. Keep in mind that this is not a packaged release. For that reason, the API we use is just a sketch of what the final API will be and is therefore sure to change, [but we'd love to hear your thoughts and feedback on where the project is headed](http://yuilibrary.com/forum/viewforum.php?f=18 "YUI Library :: Forums :: View forum - General").

We've posted the current example set on YUIBlog as well (running build 1828) — feel free to click through if you're interested in seeing the current work in action:

-   [Simple Chart](/yuiblog/sandbox/yui/yui3-1828/sandbox/chart/tests/simplechart.html)
-   [Customized Simple Chart](/yuiblog/sandbox/yui/yui3-1828/sandbox/chart/tests/customizedsimplechart.html)
-   [String Formatting](/yuiblog/sandbox/yui/yui3-1828/sandbox/chart/tests/formattedlabels.html)
-   [Advanced Usage](/yuiblog/sandbox/yui/yui3-1828/sandbox/chart/tests/advancedusage.html)

_—Tripp Bridges and Allen Rabinovich, YUI Team engineers_