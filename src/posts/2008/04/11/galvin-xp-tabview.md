---
layout: layouts/post.njk
title: "Applying Matt Galvin's \"XP-style\" Skin to YUI TabView"
author: "Eric Miraglia"
date: 2008-04-11
slug: "galvin-xp-tabview"
permalink: /2008/04/11/galvin-xp-tabview/
categories:
  - "Development"
---
YUI community member Matt Galvin of [Simplified Complexity](http://simplifiedcomplexity.org/) has been working on some [new skins for YUI](http://yui.simplifiedcomplexity.org/). He's early in the process, but it's not too early to start taking advantage of his work — he's starting with an XP-style theme and he's applied it to the [YUI Button Control](http://developer.yahoo.com/yui/button/) and [YUI TabView Control](http://developer.yahoo.com/yui/tabview/).

Here's how to apply his XP skin to YUI TabView:

-   View the source of [Matt Sweeney's "Build from Markup" TabView example](http://developer.yahoo.com/yui/examples/tabview/frommarkup_clean.html); copy and paste that into a new file.
-   In the same directory, place [this new tabs.css file](http://ericmiraglia.com/yui/demos/tabs.css). It's comprised of TabView's "Core CSS" and Matt Galvin's XP presentation rules.
-   In the example source, delete the reference to `<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/tabview/assets/skins/sam/tabview.css">`; replace it with `<link rel="stylesheet" type="text/css" href="tabs.css">`, pointing at your new css file.
-   In the example source, change the CSS class name on the <body> element from `yui-skin-sam` to `yui-skin-xp`.
-   Grab the three custom images for the XP skin ([1](http://ericmiraglia.com/yui/demos/tab-background-gradient-highlight.png), [2](http://ericmiraglia.com/yui/demos/tab-background-gradient-selected.png), [3](http://ericmiraglia.com/yui/demos/tab-background-gradient.png)) and put them in the same directory.

Reload, and you're there. Here's the same treatment applied to the [standard dyanamic-tab-content example](http://developer.yahoo.com/yui/examples/tabview/datasrc.html) ([click through for the working example](http://ericmiraglia.com/yui/demos/tabs.php)):

[![YUI TabView styled with Matt Galvin's XP skin.](/yuiblog/blog-archive/assets/tab-xp.png)](http://ericmiraglia.com/yui/demos/tabs.php)