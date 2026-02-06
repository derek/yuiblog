---
layout: layouts/post.njk
title: "Announcing YUI 3.9.0"
author: "Andrew Wooldridge"
date: 2013-03-13
slug: "announcing-yui-3-9-0"
permalink: /blog/2013/03/13/announcing-yui-3-9-0/
categories:
  - "Development"
---
We have released YUI 3.9.0 today. It is now available via [Yahoo! CDN](http://yui.yahooapis.com/3.9.0/build/yui/yui-min.js), [download](http://yui.zenfs.com/releases/yui3/yui_3.9.0.zip), and [npm](https://npmjs.org/package/yui). The [YUI Library website](http://yuilibrary.com/) has been updated with the latest documentation.

This release has seen quite a progression of features and fixes since [YUI 3.8.1](/yuiblog/blog/2013/01/23/yui-3-8-1-released/) and the subsequent Preview Releases. Some of these are highlighted below.

### Responsive Grids and Chrome 25 Fix

[Tilo Mitra](https://github.com/tilomitra) ([@tilomitra](https://twitter.com/tilomitra)) has continued the work started in his ongoing [gridbuilder](http://yui.github.com/gridbuilder/) development and folded this into [CSSGrids](http://yuilibrary.com/yui/docs/cssgrids/). He's introducing a new file structure that creates `cssgrids-responsive.css` which includes `cssgrids-units.css`, `cssgrids-base.css`, and `cssgrids-responsive-base.css`. This also changes the classname `yui3-g-responsive` to `yui3-g-r`. Also he's merged in changes to deprecate [CSSBase](http://yuilibrary.com/yui/docs/cssbase/) and replace it with [Normalize.css](http://nicolasgallagher.com/about-normalize-css/). What this means for you as a developer is that you can take advantage of Normalize.css in [Forms](http://tilomitra.github.com/cssforms/), [Tables](http://tilomitra.github.com/csstables/), [Lists](http://tilomitra.github.com/csslist/) and [much more](http://jconniff.github.com/cssextras/). You can use [Normalize.css](http://yuilibrary.com/yui/docs/cssnormalize/) in a whole page context as well as in a more isolated way (for say an embedded widget) via a new class `.yui3-normalized`. For more details check out the [pull request](https://github.com/yui/yui3/pull/447).

**Note:** also included in this release is a fix for anyone using [YUI Grids](http://yuilibrary.com/yui/docs/cssgrids/). Chrome 25 has added `word-spacing` for inline-block elements which breaks YUI Grids because they become over-collapsed. This [patch](https://github.com/yui/yui3/pull/468) fixes that. **You can get the updated YUI Grids styles without having to update any of your YUI javascript.** You can simply update the CSS file you are linking to on the CDN - separate from your javascript.

You can check out the [Grid Builder](http://yui.github.com/gridbuilder/) on GitHub as well as [Skin Builder](http://yui.github.com/skinbuilder/) from Jeff Conniff ([@jeffconniff](https://twitter.com/jeffconniff)). Both of these applications are continually updated, so please feel free to file issues or pull requests!

### Y.Tree

Ryan Grove ([@yaypie](http://twitter.com/yaypie)) has been working on a [tree module](http://yuilibrary.com/yui/docs/tree/) as a part of his work at [SmugMug](https://github.com/smugmug/yui-gallery/tree/master/src/sm-tree) and has taken the next steps via a [pull request](https://github.com/yui/yui3/pull/429) to get it into YUI. The description on the request gives a good idea of the speed and utility of this new module. Note that his is not a TreeView, but is a [lower level data structure](http://yuilibrary.com/yui/docs/api/classes/Tree.html) that can support items like Menu, TreeView, or a DOM node.

### A+ Compatible Promises

Juan Dopazo ([@juandopazo](https://twitter.com/juandopazo)) and Luke Smith ([@ls\_n](https://twitter.com/ls_n)) have been working hard on a new module for promises called `<a href="http://yuilibrary.com/yui/docs/api/classes/Promise.html">Y.Promise</a>`. This has been named `promise` instead of `deferred` to avoid confusion and there is an additional object called `Y.Promise.Resolver` which behaves like the old `deferred`. You can find more detail about this module on the [pull request](https://github.com/yui/yui3/pull/445) description.

### Graphics and Charts

[Tripp Bridges](https://github.com/tripp) made many behind-the-scenes changes to refactor Charts (see this [pull request](https://github.com/yui/yui3/pull/373) for details) as well as Graphics (via [this pull request](https://github.com/yui/yui3/pull/423)).

### Deprecated and Removed Modules

`datatable-deprecated` and `uploader-deprecated` have been [removed](https://github.com/yui/yui3/pull/390). `substitute` has been moved to [deprecated status](https://github.com/yui/yui3/pull/389). You should use `Y.Lang.sub` or `Y.Template` instead. If you rely on `substitute` in your codebase, this is a good time to start migrating to these alternative methods. Also note, `Y.Template` has added the concept of [default options](https://github.com/yui/yui3/pull/368). CSSBase is also being deprecated in this release (see below). Also [deprecated](https://github.com/yui/yui3/pull/485) are `node-menunav` and `node-focusmanager` which have no replacements yet but this is meant to notify developers so they can focus on other modules.

### And More!

The number of community [pull requests](https://github.com/yui/yui3/pulls) and [issues](https://github.com/yui/yui3/issues?direction=asc&sort=updated&state=open) has been steadily increasing since we have introduced our [Contributor Model](https://github.com/yui/yui3/wiki/Contributor-Model) and associated [Contributor Mailing List](https://groups.google.com/forum/?fromgroups#!forum/yui-contrib). There were a total of **374** [commits](https://github.com/yui/yui3/compare/v3.9.0pr1...v3.9.0pr3) by **17** authors between pr1 and pr3 and over **627** [total commits](https://github.com/yui/yui3/compare/v3.8.1...v3.9.0) by **18** authors between **3.8.1** and **3.9.0**. You can find further details about this release by reviewing the previous blog entries for [PR1](/yuiblog/blog/2013/01/16/yui-3-9-0pr1-charts-jsonp-and-responsive-grids/), [PR2](/yuiblog/blog/2013/01/25/yui-3-9-0pr2/), and [PR3](/yuiblog/blog/2013/02/19/yui-3-9-0pr3/). Also check out the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.9.0-Change-History-Rollup) for this release.