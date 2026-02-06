---
layout: layouts/post.njk
title: "YUI 3.9.0pr3"
author: "Andrew Wooldridge"
date: 2013-02-19
slug: "yui-3-9-0pr3"
permalink: /blog/2013/02/19/yui-3-9-0pr3/
categories:
  - "Development"
---
We have a new preview release today. This release is **YUI 3.9.0pr3** and is available on [Yahoo! CDN](http://yui.yahooapis.com/3.9.0pr3/build/yui/yui-min.js), [download](http://yui.zenfs.com/releases/yui3/yui_3.9.0pr3.zip), and via [npm](https://npmjs.org/package/yui). We have also updated the [staging website](http://stage.yuilibrary.com/) for this version.

## What's New Since PR2?

We have had a number of great new features merged in since [**YUI 3.9.0pr2**](/yuiblog/blog/2013/01/25/yui-3-9-0pr2/). This has been the direct result of the growing momentum from our developer community working through our new [contributor model](https://github.com/yui/yui3/wiki/Contributing.md) as well as our quicker release cycle. Featured below are some of the additions that have been made since pr2.

### Y.Tree

Ryan Grove ([@yaypie](http://twitter.com/yaypie)) has been working on a tree module as a part of his work at [SmugMug](https://github.com/smugmug/yui-gallery/tree/master/src/sm-tree) and has taken the next steps via a [pull request](https://github.com/yui/yui3/pull/429) to get it into YUI. The description on the request gives a good idea of the speed and utility of this new module. Note that his is not a TreeView, but is a lower level data structure that can support items like Menu, TreeView, or a DOM node. Here is a [speed test](http://jsbin.com/udayaz/54) with Y.Tree working on a TreeView.

### CSSReset, CSSBase, and Normalize.css

Tilo Mitra ([@tilomitra](https://twitter.com/tilomitra)) has merged in changes to deprecate CSSBase and replace it with Normalize.css. What this means for you as a developer is that you can take advantage of Normalize.css in [Forms](http://tilomitra.github.com/cssforms/), [Tables](http://tilomitra.github.com/csstables/), [Lists](http://tilomitra.github.com/csslist/) and [much more](http://jconniff.github.com/cssextras/). This is great for the future of CSS in YUI and helps web developers create beautiful and clean looking sites. You can take advantage of Normalize.css in a whole page context as well as more isolated way (for say an embedded widget) via a new class `.yui3-normalized`. For more details check out the [pull request](https://github.com/yui/yui3/pull/447). You can read more about the Normalize.css project [here](http://nicolasgallagher.com/about-normalize-css/).

### A+ Compatible Promises

Juan Dopazo ([@juandopazo](https://twitter.com/juandopazo)) and Luke Smith ([@ls\_n](https://twitter.com/ls_n)) have been working hard on a new module for promises called `[Y.Promise](http://stage.yuilibrary.com/yui/docs/api/classes/Promise.html)`. This has been named `promise` instead of `deferred` to avoid confusion and there is an additional object called `Y.Promise.Resolver` which behaves like the old `deferred`. You can find more detail about this module on the [pull request](https://github.com/yui/yui3/pull/445) description.

### Graphics Chaining

[Tripp Bridges](https://github.com/tripp) added [a feature](https://github.com/yui/yui3/pull/423) to [Graphics](http://stage.yuilibrary.com/yui/docs/graphics/) that allows you to chain drawing commands on a path. This may be a subtle change but it allows developers to write more human-readable code, and may allow the code to dynamically add paths. He's written an example using method chaining [here](https://gist.github.com/tripp/4988469).

### And Much More!

There were over **250** commits by **14** authors between **3.9.0pr2** and **3.9.0pr3**. Changed components include `Charts`, `Color`, `CSSNormalize`, `DataTable`, `Graphics`, `Handlebars`, `Number`, `Promise`, `ScrollView`, `Tree`, and `Uploader`. You can view the recently [closed pull requests](https://github.com/yui/yui3/pulls?direction=desc&page=1&sort=updated&state=closed) for additional insights as well as review [all the check-ins](https://github.com/yui/yui3/compare/v3.9.0pr2...v3.9.0pr3) for this release. A special thanks to [Satyam](https://github.com/Satyam) and [Arnaud Didry](https://github.com/ArnaudD) for their [DataTable](http://yuilibrary.com/yui/docs/datatable/) contributions.

## Keep Testing!

There has been a lot of changes in this most recent PR and we depend on developers like you to download the latest code and try these changes out with your own applications. If you find any bugs please **[file a ticket](http://yuilibrary.com/projects/yui3/newticket/)** so we can make this pr the best it can be.