---
layout: layouts/post.njk
title: "Reid Burke's Scrolling TabView"
author: "YUI Team"
date: 2008-05-20
slug: "scrolling-tabview"
permalink: /2008/05/20/scrolling-tabview/
categories:
  - "Development"
---
[![](/yuiblog/blog-archive/assets/idearefuge.png)](http://reidburke.com/yui/)

Reid Burke of IdeaRefuge [writes in with a new YUI implementation](http://reidburke.com/yui/) that tweaks the standard "stacked" spatial orientation of a tab control and replaces with a scrolling orientation (either horizontal or vertical). In his own words:

> I've created a YUI addon, ScrollTabView, that allows you to transition between [TabView](http://developer.yahoo.com/yui/tabview/) content with a Scroll animation.
> 
> This allows you to use YUI's tabs to create an effect similar to:
> 
> -   [Panic's Coda](http://panic.com/coda/)
> -   [Mozilla's Firefox 3 pre-release start page](http://en-us.www.mozilla.com/en-US/firefox/3.0rc1/firstrun/)
> 
> You can specify your own direction (horizontal or vertical), animation duration, and easing as attributes. Complicated styles are all applied automatically — just use it like a normal TabView.
> 
> View [examples of ScrollTabView in action and grab the code here](http://reidburke.com/yui/).
> 
> Direct links to examples and code:
> 
> -   [http://internal.reidburke.com/yui-addons/yodeler/widget/ScrollTabView.js](http://internal.reidburke.com/yui-addons/yodeler/widget/ScrollTabView.js)
> -   [http://internal.reidburke.com/yui-addons/yodeler/examples/ScrollTabView/horizontal.html](http://internal.reidburke.com/yui-addons/yodeler/examples/ScrollTabView/horizontal.html)
> -   [http://internal.reidburke.com/yui-addons/yodeler/examples/ScrollTabView/vertical.html](http://internal.reidburke.com/yui-addons/yodeler/examples/ScrollTabView/vertical.html)
> -   [http://internal.reidburke.com/yui-addons/yodeler/examples/ScrollTabView/easing.html](http://internal.reidburke.com/yui-addons/yodeler/examples/ScrollTabView/easing.html)
> -   [http://internal.reidburke.com/yui-addons/yodeler/examples/ScrollTabView/quick.html](http://internal.reidburke.com/yui-addons/yodeler/examples/ScrollTabView/quick.html)
> 
> It's all available under a BSD License — so feel free to use it for your own projects!

Reid's work builds on top of Matt Sweeney's YUI [TabView Control](http://developer.yahoo.com/yui/tabview/) and [Animation Utility](http://developer.yahoo.com/yui/animation/).