---
layout: layouts/post.njk
title: "Introducing the YUI 3 Gallery"
author: "Eric Miraglia and Dav Glass"
date: 2009-11-04
slug: "introducing-the-yui-3-gallery"
permalink: /blog/2009/11/04/introducing-the-yui-3-gallery/
categories:
  - "Development"
---
Last week at [YUICONF 2009](http://yuilibrary.com/yuiconf2009/), we introduced the [YUI 3 Gallery](http://yuilibrary.com/gallery/), a new way to contribute to [YUI 3](http://developer.yahoo.com/yui/3/). Within a few hours, [Greg Hinch had posted the first community contribution to the Gallery](http://yuilibrary.com/gallery/show/form). Today, less than a week later, there are 18 modules in the gallery — all of them available for you to use from your `YUI().use()` statement.

### How YUI 3 Gallery Works

[![Enough already...where's the developer's guide?](/yuiblog/blog-archive/assets/contributint-to-the-gallery-20091103-104835.jpg)](http://yuilibrary.com/gallery/developer)When you have a module you'd like to contribute to the YUI 3 community, you can show it off on the gallery at YUILibrary.com. Whether your contribution is open-source or commercial, as long as it's based on YUI 3, the gallery is open to you. All gallery items have a dedicated discussion forum on YUILibrary.com, all are searchable and discoverable, and all can be voted up or down by the community.

If you'd like to go a step further and have the code for your module hosted on the Yahoo! CDN and fully integrated into the YUI 3 framework, be sure to return a signed [Contributor’s License Agreement (CLA)](http://developer.yahoo.com/yui/community/yui-cla.gzip) in order to contribute your work to YUI 3 on a formal basis under [YUI’s BSD license](http://developer.yahoo.com/yui/license.html). Then you can [fork the YUI 3 Gallery project on GitHub](http://github.com/yui/yui3-gallery/) and issue a pull request directly from your gallery module on YUILibrary.com. That will initiate a review process. Once approved, your module will be rolled up in the next push of the Gallery to the Yahoo! CDN. (On average, this will take place once every two weeks.) After that, your work will be available to any implementer's `YUI().use()` statement without the need to explicitly load the code on each page and without you having to host the files.

[![YUI 3 Gallery workflow](/yuiblog/blog-archive/assets/gallery-graphic-20091103-135709.jpg)](http://yuilibrary.com/gallery/developer)

When you're ready to make a contribution, check out Dav's [detailed developer documentation for YUI 3 Gallery](http://yuilibrary.com/gallery/developer). You may also want to check out Dav's YUICONF 2009 talk, "Contributing to YUI":

  

<object allowfullscreen="true" height="287" width="510"><param name="movie" value="http://cosmos.bcst.yahoo.com/up/ypp/default/player.swf"> <param name="flashVars" value="vid=16429144&amp;autoPlay=0"> <param name="wmode" value="transparent"><embed allowfullscreen="true" flashvars="vid=16429144&amp;autoPlay=0" height="287" src="http://cosmos.bcst.yahoo.com/up/ypp/default/player.swf" type="application/x-shockwave-flash" width="510"></object>

[Download video (m4v)](/yuiblog/yuitheater/glass-yuiconf2009-contributing.m4v) | [slides](http://www.slideshare.net/davglass/contributing-to-yui)

### YUI 3 vs. YUI 3 Gallery

How does the gallery differ from non-gallery YUI 3 code?

-   The gallery is more open — YUI's core team reviews submissions, but the goal is to accept as much as possible.
-   Gallery code formally contributed to YUI is pushed on a rolling basis — it's not tied to the release cycle of the YUI 3 core.
-   Gallery modules are the responsibility of the developers who create and contribute them. The YUI core team neither tests nor supports Gallery modules.

### Gallery Modules

The following modules have been contributed — some by YUI developers, and many from outside the team:

-   [**Accordion**](http://yuilibrary.com/gallery/show/accordion) by [Iliyan Peychev](http://yuilib.com/g/peychevi): Accordion widget for YUI3.
-   [**beforeunload**](http://yuilibrary.com/gallery/show/beforeunload) by [Adam Moore](http://yuilib.com/g/adam): Adds `beforeunload` event support to YUI for A-Grade browsers other than Opera.
-   [**chromahash**](http://yuilibrary.com/gallery/show/chromahash) by [Jeff Craig](http://yuilib.com/g/foxxtrot): Chromahash is a non-reversable password visualization module
-   [**Form**](http://yuilibrary.com/gallery/show/form) by [Greg Hinch](http://yuilib.com/g/greghinch): A module for managing form interaction in a page, including client-side validation, server side error processing, and asynchronous form submission.
-   [**History Lite**](http://yuilibrary.com/gallery/show/history-lite) by [Ryan Grove](http://yuilib.com/g/rgrove): History Lite is similar in purpose to the [YUI Browser History module](http://developer.yahoo.com/yui/3/history/), but with a more flexible API, no initialization or markup requirements, limited IE6/7 support, and a much smaller footprint.
-   [**Idle Timer**](http://yuilibrary.com/gallery/show/idletimer) by [Nicholas C. Zakas](http://yuilib.com/g/nzakas): The idle timer aims to determine when the user is idle (not interacting with the page) so that you can respond appropriately.
-   [**IO Poller**](http://yuilibrary.com/gallery/show/io-poller) by [Eric Ferraiuolo](http://yuilib.com/g/ericf): An extension to the `Y.io` utility to add support for polling a server resource
-   [**JSONP**](http://yuilibrary.com/gallery/show/jsonp) by [Luke Smith](http://yuilib.com/g/lsmith): Adds a `Y.JSONPRequest` class and a `Y.jsonp(url, callback)` method.
-   [**Konami event**](http://yuilibrary.com/gallery/show/event-konami) by [Luke Smith](http://yuilib.com/g/lsmith): Adds a DOM event "konami" that is triggered when the targeted element receives keydown strokes in the Konami code sequence.
-   [**Node Accordion**](http://yuilibrary.com/gallery/show/node-accordion) by [Caridy Patino](http://yuilib.com/g/caridy): Node Accordion Plugin is a light-weight solution (~3k) for expandable and collapsible elements.
-   [**Node drag events**](http://yuilibrary.com/gallery/show/event-drag) by [Luke Smith](http://yuilib.com/g/lsmith): node.on('drag:end', fn, config, ctx, arg1, ...argN)Adds new DOM events for "drag", "drag:start", "drag:end" and all other DD.Drag events. Full list in the docs. config obj takes Drag attributes for configuration plus supports 'proxy', 'constrained', or any other `Y.Plugin.DDxxx`.
-   [**Number**](http://yuilibrary.com/gallery/show/number) by [Matt Snider](http://yuilib.com/g/matt.snider): Supplies number manipulation utilities and exposes some of the powerful Math functions directly on the `Y.Number` namespace. This adds additional functionality to what is provided in Base, and the methods are applied directly to the YUI instance.
-   [**Port Base**](http://yuilibrary.com/gallery/show/port) by [Dav Glass](http://yuilib.com/g/davglass): This module will aid a developer in porting from a newer YUI2 module to a YUI3 module. It mimics the `YAHOO.util.Element` class from 2.x.
-   [**Simple Editor Port**](http://yuilibrary.com/gallery/show/simple-editor) by [Dav Glass](http://yuilib.com/g/davglass): This is a non-supported port of SimpleEditor from YUI2.x.
-   [**Textarea Tab Control**](http://yuilibrary.com/gallery/show/tabby) by [Dav Glass](http://yuilib.com/g/davglass): This little module adds the ability to use the tab key inside of a textarea. Currently it doesn't support Opera and it doesn't support text-selection tabbing.
-   [**Timepicker**](http://yuilibrary.com/gallery/show/timepicker) by [Stephen Woods](http://yuilib.com/g/saw): This is based on the very slick time picker by Maxime Haineault.
-   [**toRelativeTime**](http://yuilibrary.com/gallery/show/torelativetime) by [Luke Smith](http://yuilib.com/g/lsmith): Adds `Y.toRelativeTime(date)` to turn a past Date instance into a relative time string, e.g. "about an hour ago".
-   [**Twitter Status display**](http://yuilibrary.com/gallery/show/twitter-status) by [Luke Smith](http://yuilib.com/g/lsmith): Adds Y.Twitter.Status widget for Twitter status updates. Configure how many to display, from what twitter user (public only), and how frequent to poll for updates.
-   [**YQL Module**](http://yuilibrary.com/gallery/show/yql) by [Dav Glass](http://yuilib.com/g/davglass): This module adds a little sugar to YUI3 to make simple easy YQL queries.

### Your Code Here

This is something we've wanted to do for awhile. The tightly controlled quality of the YUI core library has been a strength — we expect that strength to continue going forward. But whereas it was difficult to contribute first-class modules to YUI in the past, today it's simple. Code you write today can be a part of YUI 3, accessed via any implementer's `use` statement, within a week or two.