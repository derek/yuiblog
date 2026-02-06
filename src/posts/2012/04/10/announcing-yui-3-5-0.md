---
layout: layouts/post.njk
title: "Announcing YUI 3.5.0"
author: "Jenny Donnelly"
date: 2012-04-10
slug: "announcing-yui-3-5-0"
permalink: /2012/04/10/announcing-yui-3-5-0/
categories:
  - "Releases"
---
We are pleased to announce YUI 3.5.0, now available on CDN at [http://yui.yahooapis.com/3.5.0/build/yui/yui-min.js](http://yui.yahooapis.com/3.5.0/build/yui/yui-min.js) or as a [download](http://yui.zenfs.com/releases/yui3/yui_3.5.0.zip). Highlights for this release include:

-   Availability of YUI in Node.js as an NPM module
-   Formal introduction of ["night"](http://yuilibrary.com/yui/docs/tutorials/skins/#alternate-skins), our second skin offering
-   Introduction of [App](http://yuilibrary.com/yui/docs/app/#app-component), [Button](http://yuilibrary.com/yui/docs/button/), [CSSButton](http://yuilibrary.com/yui/docs/button/#usecssbutton), [Handlebars](http://yuilibrary.com/yui/docs/handlebars), [Pjax](http://yuilibrary.com/yui/docs/pjax/), [TestConsole](http://yuilibrary.com/yui/docs/test-console/) components
-   Refactoring of [CSS Grids](http://yuilibrary.com/yui/docs/cssgrids/) to be even more lightweight and versatile
-   Refactoring of the [Get](http://yuilibrary.com/yui/docs/get/) utility for additional feature support and performance enhancements
-   Refactoring of [Loader](http://yuilibrary.com/yui/docs/yui/loader.html) to implement Get’s asynchronous functionality
-   The [Uploader](http://yuilibrary.com/yui/docs/uploader/) component received an HTML5 implementation which includes drag-and-drop functionality, plus a much improved progressive enhancement scenario, granular queue management and accessibility.
-   Keyboard navigation add to the [Calendar](http://yuilibrary.com/yui/docs/calendar/) component
-   Enhancements to [App](http://yuilibrary.com/yui/docs/app/), [Charts](http://yuilibrary.com/yui/docs/charts/), and [DataTable](http://yuilibrary.com/yui/docs/datatable/) components
-   [Numerous bug fixes](http://yuilibrary.com/projects/yui3/report/122)

We received a great number of pull requests and other contributions from the community during this release cycle! We would like to give a special shout to the following contributions from the community:

-   Calendar lang packs contributed by Marzelpan (German), leonardomartins (Portuguese), raytjwen (Chinese), and osmestad (Norwegian)
-   Todd Smith (stlsmiths on the forum, t\_smith in #yui, no relation to Luke Smith) created a [list of examples](http://blunderalong.com/yui) using the preview releases and was a great help forecasting and promoting the DataTable changes.

Notable changes and deprecations to the API this release include:

-   The App Framework family of modules, including Model, Controller/Router, and View have received significant enhancements. An overview of the changes was covered in [an earlier blog post](/yuiblog/blog/2011/12/12/app-framework-350/), and a detailed list of changes can be found in the [history](https://github.com/yui/yui3/blob/master/src/app/HISTORY.md) file.
-   We introduced asynchronous loading in Loader by default. This means that any script `Loader` injects into the page will be loaded asynchronously. This will decrease load time and improve performance by allowing the browser to fetch as many scripts at once as it can. If your custom modules are properly wrapped in a `YUI.add` callback, you will see no difference at all. However, if you are loading custom modules that require ordered script loading (depends on another dynamic, unwrapped module), you will need to change your module config to tell `Loader` to not load these modules with the `async` flag. You can do this by adding an `async: false` config to its module definition and `Y.Get.script` will not load it asynchronously.
-   Uploader was refactored in order to support HTML5 functionality when available. The 3.4.1 version was deprecated and made available as uploader-deprecated. A migration guide is available at [http://yuilibrary.com/yui/docs/uploader/migration.html](http://yuilibrary.com/yui/docs/uploader/migration.html).
-   An update to Charts custom formatting may cause backward compatibility issues when upgrading under certain circumstances. Please see the [Known Issues](http://yuilibrary.com/yui/docs/charts/#issues) section for more detail.
-   DataTable was refactored in order to leverage Model, ModelList, and View. The 3.4.1 version was deprecated and made available as datatable-deprecated, datatable-base-deprecated, datatable-sort-deprecated, etc. A migration guide is available at [http://yuilibrary.com/yui/docs/datatable/migration.html](http://yuilibrary.com/yui/docs/datatable/migration.html).
-   A small number of methods, properties, and config options were deprecated in Get, but are still supported for backcompat. They'll be removed in a future release. Full details are available in Get's [history](https://github.com/yui/yui3/blob/master/src/get/HISTORY.md) file.

The [rollup of 3.5.0 changes](https://github.com/yui/yui3/wiki/YUI-3.5.0-Change-History-Rollup) is available on our GitHub Wiki. You can also review [the list of tickets that were resolved in this release](http://yuilibrary.com/projects/yui3/report/122).

If you find any bugs, please visit our [bug tracking system](http://yuilibrary.com/projects/yui3/newticket/). If you’d like to provide input on this and future releases, the ongoing discussions are happening on our [GitHub wiki.](https://github.com/yui/yui3/wiki/Ongoing-development-discussions)

We will be announcing our 3.6.0 roadmap and timeline very soon, so stay tuned!