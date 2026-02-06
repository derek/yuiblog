---
layout: layouts/post.njk
title: "Adrien Cahen's YUI Fonts Dashboard Widget"
author: "Eric Miraglia"
date: 2007-05-11
slug: "yuifonts-widget"
permalink: /2007/05/11/yuifonts-widget/
categories:
  - "Development"
---
One core advantage of the [YUI Fonts](http://developer.yahoo.com/yui/fonts/) foundation ([Reset](http://developer.yahoo.com/yui/reset/), [Fonts](http://developer.yahoo.com/yui/fonts/), [Grids](http://developer.yahoo.com/yui/grids/)) created by YUI engineer [Nate Koechley](http://nate.koechley.com/blog/) is that it allows you to define fonts in relative terms. That means (even in IE) that fonts zoom or shrink in size as the user increases/decreases the zoom level of the page. This is really good news for people who come to your site — whether they're zooming because their monitor's screen resolution is ultra-high or because they've misplaced their bifocals, the ability to zoom the size of text is a key feature of accessibility for all sighted users. (And what we love about [YUI Grids](http://developer.yahoo.com/yui/grids/) is that it allows you to do that zooming on the page's basic wireframe as well...but that's another story.)

To get this nice zoomability, the Fonts CSS package requires you to specify fonts in relative percentages rather than pixel sizes; [we provide a handy lookup table in the documentation](http://developer.yahoo.com/yui/fonts/#fontsize) to show you which percentage value to use for which "base" pixel size you're targeting (eg, the pixel size you want to use when the zoom level is set to normal).

Yahoo Messenger engineer [Adrien Cahen](http://gaarf.info/) wanted that information to be even _more_ handy, so he [whipped up a Dashboard widget](http://gaarf.info/2007/05/10/yui-fonts-a-dashboard-widget/) that lays out the YUI Fonts sizing table for you.

[![Adrien Cahen's YUI Fonts Dashboard Widget](/yuiblog/blog-archive/assets/cahen_yuifonts_widget.gif)](http://gaarf.info/2007/05/10/yui-fonts-a-dashboard-widget/)

If you're a Mac user, now you can have your YUI Fonts sizing chart at the touch of your F12 key. Sweet. Thanks, Adrien.