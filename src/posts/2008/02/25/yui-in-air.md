---
layout: layouts/post.njk
title: "AIR 1.0 and YUI"
author: "YUI Team"
date: 2008-02-25
slug: "yui-in-air"
permalink: /blog/2008/02/25/yui-in-air/
categories:
  - "Development"
---
[Adobe released AIR 1.0 today](http://www.adobe.com/products/air/) — great news for web application authors everywhere who now have one more compelling platform on which to deliver their products, and a platform that extends their reach into desktop space.

As you'd expect from AIR, which embeds an [A-Grade](http://developer.yahoo.com/yui/articles/gbs/) version of the Webkit foundation that underpins Apple's Safari browser, most JavaScript libraries work well and do just what you'd expect in AIR. YUI is no exception. We've been tracking AIR's progress over the past several months, and we're happy to share with you [a showcase YUI app written in AIR 1.0 by YUI engineer Dav Glass](http://blog.davglass.com/files/yui/air1/). This application is based on Dav's ["Complex Example" for YUI](http://developer.yahoo.com/yui/examples/layout/adv_layout_source.html), which brings together a broad cross-section of YUI components, and it's a nice proof of concept for what YUI can do in the context of your AIR applications.

[![The YUI Complex Example running as an AIR application.](/yuiblog/blog-archive/assets/yui-in-air.png)](http://blog.davglass.com/files/yui/air1/)

The following YUI components are employed in Dav's application:

_YUI Core:_

-   [Yahoo Global Object](http://developer.yahoo.com/yui/yahoo)
-   [Dom Collection](http://developer.yahoo.com/yui/dom)
-   [Event Utility](http://developer.yahoo.com/yui/event)

_YUI Utilities:_

-   [Animation Utility](http://developer.yahoo.com/yui/animation)
-   [Selector Utility](http://developer.yahoo.com/yui/selector)
-   [Get Utility](http://developer.yahoo.com/yui/get) (**note:** the AIR sandbox prevents you from loading external script files, but Get otherwise works as expected)
-   [YUI Loader](http://developer.yahoo.com/yui/yuiloader) (**note:** due to limitations in the AIR sandbox, YUI Loader should be used to load YUI files that are packaged in your AIR application)

_YUI Controls:_

-   [AutoComplete Control](http://developer.yahoo.com/yui/autocomplete) (**note:** see below for an important note on AutoComplete in AIR)
-   [Button Control](http://developer.yahoo.com/yui/button)
-   [Calendar Control](http://developer.yahoo.com/yui/calendar)
-   [DataTable Control](http://developer.yahoo.com/yui/datatable)
-   [Rich Text Editor](http://developer.yahoo.com/yui/editor)
-   [Layout Manager](http://developer.yahoo.com/yui/layout)
-   [Logger Control](http://developer.yahoo.com/yui/logger)
-   [Menu Control](http://developer.yahoo.com/yui/menu)
-   [SimpleDialog Control](http://developer.yahoo.com/yui/container/simpledialog)
-   [Slider Control](http://developer.yahoo.com/yui/slider)
-   [TabView Control](http://developer.yahoo.com/yui/tabview)
-   [Tooltip Control](http://developer.yahoo.com/yui/container/tooltip)

We're continuing to work on some aspects of YUI that are not compatible with AIR. The most significant issues we're working to address are these:

-   **JSON support in DataTable:** Currently, [DataTable](http://developer.yahoo.com/yui/datatable/)'s JSON parsing routines are not compatible with AIR 1.0. We expect to address this in YUI 2.5.1 next month.
-   **Rich Text Editor:** Dav patched [Rich Text Editor](http://developer.yahoo.com/yui/editor/) for his demo AIR application above, making some adjustments with respect to how AIR handles the loading of content in frames. In YUI 2.5.1, we'll add unified support in RTE for AIR addressing this and several other issues.
-   **AutoComplete:** The [AutoComplete Control](http://developer.yahoo.com/yui/autocomplete/) today is not compatible with AIR when using JSON datasources. We will address this issue in a future release.

AIR is a unique environment that has its own set of nuances and quirks, some of which will doubtless affect your applications as you migrate them from pure browser-based deployments into the AIR context. The issues above are the ones we know of today that are YUI-specific. Based on Dav's experience converting the Complex Example to Air, we're excited about the role YUI can play in AIR apps and looking forward to addressing those few core issues that remain.