---
layout: layouts/post.njk
title: "YUI 2 in 3: Coming in YUI 3.1.0, a Simpler Way To Use YUI 2 Modules"
author: "Eric Miraglia and Adam Moore"
date: 2010-03-11
slug: "yui-2-in-3-coming-soon"
permalink: /blog/2010/03/11/yui-2-in-3-coming-soon/
categories:
  - "Development"
---
Using [YUI 2](http://developer.yahoo.com/yui/2/ "YUI 2 — Yahoo! User Interface Library") components in the context of [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") implementations is important for some implementers making the transition between YUI 2 and YUI 3. In some cases, we simply want to transition our code in stages, but we want to do so within the context of a YUI 3 implementation pattern. In other cases, we may be relying on high-level components like [YUI DataTable](http://developer.yahoo.com/yui/datatable/) that aren't yet present in YUI 3.

As part of the upcoming 3.1.0 release, Adam has improved the experience of using [YUI 2](http://developer.yahoo.com/yui/2/ "YUI 2 — Yahoo! User Interface Library") components from within [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library"). To this end, he's added some intelligence to YUI 3's loader that allows you to load YUI 2 modules directly from your `YUI().use()` statement:

```
YUI().use("yui2-button", function(Y) {
	
	//YAHOO is not a global object; it is sandboxed along
	//with the rest of your YUI 3 functionality.  This line
	//is necessary if you want to use existing implementation
        //code:
	var YAHOO = Y.YUI2;
	
	//YUI 2 implementation code
	var button = new YAHOO.widget.Button("mybutton");
	
});

```

You'll find this functionality in the YUI 3 codeline as of build 1933, and we've deployed an experimental YUI 3 build (nominally "yui3.1.0pr2") and an early build of YUI 2.8.0 functionality wrapped for use in YUI 3.

When you [download YUI 3's latest source from GitHub](http://github.com/yui/yui3/downloads "Downloads for yui's yui3 - GitHub") you'll find some working examples in `sandbox/loader` (look for files with the `2in3` prefix). These examples demonstrate the use of a number of YUI 2 modules. We've posted [a simple live example that shows how to use YUI 2 DataTable within YUI 3](http://ericmiraglia.com/yui/demos/2in3dt.php "YUI 2 in 3: Using YUI 2 DataTable from YUI 3"), which is one of the most frequently requested transitional features.

[![](/yuiblog/blog-archive/assets/2in3datatable-20100310-140033.jpg)](http://ericmiraglia.com/yui/demos/2in3dt.php "YUI 2 in 3: Using YUI 2 DataTable from YUI 3")

Key points about the YUI 2 in 3 effort:

-   **This work is available in the [latest builds](http://github.com/yui/yui3/downloads) of the upcoming 3.1.0 release (build 1933 and later).** It is not available in 3.0.0 or in the 3.1.0pr1 preview.
-   **The project is in an experimental state.** Neither the yui3.1.0pr2 build nor the wrapped YUI 2 builds from which it pulls have been extensively tested, although we've staged them on the CDN to make it convenient to explore the implementation.
-   **Download the latest build for examples.** You'll find a few of Adam's proof-of-concept files in `sandbox/loader` — other than the simple example above, those are the best code references available until the official 3.1.0 release (which is still about a month out).
-   **Your feedback [in the forums](http://yuilibrary.com/forum/viewforum.php?f=18 "YUI Library :: Forums :: View forum - General") is welcome** — and, if you find problems, we're interested in hearing about them.
-   **When used this way, YUI 2 does not create a global `YAHOO` object.** YUI 2 components are wrapped in YUI 3 module definitions and they stay contained in the YUI 3 sandbox to which they're attached. The line from the codesample above, `var YAHOO = Y.YUI2;`, is needed in order to cut and paste YUI 2-style implementation code — or you can change `YAHOO` references to `Y.YUI2`.
-   **YUI 2 releases are supported back to 2.2.2** — the latest bug-fix release for every minor version is supported (2.2.2, 2.3.1, 2.4.1, 2.5.2, 2.6.0, 2.7.0, 2.8.0). You can specify the YUI 2 version to `use` as follows: `YUI({yui2: '2.7.0'}).use('yui2-button', ...)`. The goal here is to allow you to avoid migrating to 2.8.0 (or later) prior to a YUI 3 migration.

### Gallery Is Easier To Use, Too

[![](/yuiblog/blog-archive/assets/galleryintegration-20100311-072806.jpg)](http://ericmiraglia.com/yui/demos/galleryintegration.php)

Adam's enhancements to YUI 3's intrinsic loader have improved the experience of working with the rapidly growing [YUI 3 Gallery](http://yuilibrary.com/gallery), too. As of 3.1.0, you'll be able to bring gallery modules into the page from the `use()` statement without additional configuration — the loader will be able to determine and resolve dependencies for you and will do the right thing with respect to combo'ing the gallery source code with other YUI files. [Here's an example Dav Glass put together for 3.1.0](http://ericmiraglia.com/yui/demos/galleryintegration.php) that demonstrates the use of his [YQL Query gallery module](http://yuilibrary.com/gallery/show/yql) in combination with a pre-release build of 3.1.0.