---
layout: layouts/post.njk
title: "YUI Weekly for February 1st, 2013"
author: "Derek Gathright"
date: 2013-02-01
slug: "yui-weekly-for-february-1st-2013"
permalink: /2013/02/01/yui-weekly-for-february-1st-2013/
categories:
  - "YUI Weekly"
---
_Welcome to YUI Weekly, the weekly roundup of news and announcements from the YUI team and community. If you have any interesting demos or links you’d like to share, please leave a comment below._

-   No new releases this week. The current stable is [YUI 3.8.1](/yuiblog/blog/2013/01/23/yui-3-8-1-released/), and latest preview is [YUI 3.9.0pr2](/yuiblog/blog/2013/01/25/yui-3-9-0pr2/). If you are curious about what is coming up next, checkout this week's "[Development Schedule Updates](/yuiblog/blog/2013/01/29/development-schedule-updates/)" blog post.
    
-   Yesterday's Roundtable ([video](http://www.youtube.com/watch?v=P5uO_SpKByE)) featured a preview of Ryan Grove's ([@yaypie](http://twitter.com/yaypie)) Y.Menu, some discussion around [Y.Tree](https://github.com/yui/yui3/pull/429), deprecation of node-menunav and node-focusmanager ([proposal](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/I28zUGYPBoA)), [YUI.Features](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/9Fxieen0790), and [unassigned tickets](http://bit.ly/XtVfeQ).
    
-   Two new [YUIConf 2012](http://lanyrd.com/2012/yuiconf/) videos were published:
    
    -   Diego Ferreiro's "[NodeJS+Cocktails — Scaling Yahoo!](/yuiblog/blog/2013/01/28/yuiconf-2012-diego-ferreiro-on-nodejscocktails-scaling-yahoo/)"
    -   Kevin Lamping's "[Scaling YUI in the Enterprise](/yuiblog/blog/2013/01/31/yuiconf-2012-scaling-yui-in-the-enterprise-with-kevin-lamping/)"
-   The [Skin Builder](http://jconniff.github.com/skinner/) preview has some new features:
    
    -   Custom color scheme feature for a more full range of custom skin looks.
    -   The padding control is now separated into two controls, horizontal and vertical.
    -   A slider has been added to increase/decrease the contrast of text to it's background.
-   [gallery-scrollanim](https://github.com/emyang/yui-gallery-scrollanim) is a widget that animates HTML elements based on vertical page scroll, and is new to the YUI Gallery this week. _"With ScrollAnim widget, you can quickly create sites that have various HTML elements move or fade according to how far the user has scrolled down the site. The animation for each HTML element is also gracefully controlled by easing functions of your choosing. Also the widget is great for achieving the popular "parallax effects", when certain elements (especially the backgrounds) move at a different speed than the user-controlled scrolling speed."_ Thanks [@emyang](https://github.com/emyang)!
    
-   Do you use YUI and [Grunt](http://gruntjs.com/)? Check out [grunt-yui-config](https://github.com/hojberg/grunt-yui-config), a utility by [@shojberg](http://twitter.com/shojberg) for generating a YUI config with Grunt. Install with `npm install grunt-yui-config --save-dev`.
    
-   New and updated modules in the [Gallery](http://yuilibrary.com/gallery/) this week: [accordion-horiz-vert](http://yuilibrary.com/gallery/show/accordion-horiz-vert), [itsadtcolumnresize](http://yuilibrary.com/gallery/show/itsadtcolumnresize), [scrollanim](https://github.com/emyang/yui-gallery-scrollanim), and [zui-rascroll](http://yuilibrary.com/gallery/show/zui-rascroll).
    
-   Version bumps this week for the following YUI devtools: [grover](https://github.com/davglass/grover) and [yogi](https://github.com/yui/yogi). Grover now supports `--debug` and `--console` to print debug and console messages. Upgrade with `npm install -g grover yogi`.