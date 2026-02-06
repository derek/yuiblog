---
layout: layouts/post.njk
title: "YUI 3.8.1 Released"
author: "Andrew Wooldridge"
date: 2013-01-23
slug: "yui-3-8-1-released"
permalink: /blog/2013/01/23/yui-3-8-1-released/
categories:
  - "Development"
---
Last night we released **YUI 3.8.1**. It is now available on the [Yahoo! CDN](http://yui.yahooapis.com/3.8.1/build/yui/yui-min.js "YUI 3.8.1 Seed file") (also as a [download](http://yui.zenfs.com/releases/yui3/yui_3.8.1.zip "YUI 3.8.1 Zip file")) and on [npm](https://npmjs.org/package/yui). The [YUI Library website](http://yuilibrary.com/) has been updated with the latest documentation, including the addition of **iOS 6** to our [Target Environments](http://yuilibrary.com/yui/environments/).

### iOS 6 Target Environment

We've added support for **iOS 6** on the [Target Environments](http://yuilibrary.com/yui/environments/) page. This means that you as a developer can have confidence that your YUI-based sites and applications will run well in this environment, and that you may file issues for this environment as you would any of the other target environments. A big thanks to everyone who worked to make this happen including [Eric Ferraiuolo](http://twitter.com/ericf), [Matt Sweeney](http://twitter.com/msweeney), and [Tilo Mitra](http://twitter.com/tilomitra). Issues were fixed in modules including [Node](http://yuilibrary.com/yui/docs/node/), [IO](http://yuilibrary.com/yui/docs/io/), and [Attribute](http://yuilibrary.com/yui/docs/attribute/). Many unit tests were updated for **iOS 6** as well. Eric Ferraiuolo posted a [great explanation](/yuiblog/blog/2012/08/21/yui-target-environments/) of our Target Environment page and how it works.

**Note:** **iOS 4** will be removed as a target environment very soon.

### DataTable, Attribute, and Template

While this was a minor point release, **YUI 3.8.1** saw many updates and improvements across a number of modules. Most notably fixes for [DataTable](http://yuilibrary.com/yui/docs/datatable/) (via [Mark Woon](https://github.com/markwoon) and [clanceyp](https://github.com/clanceyp)) , [Attribute](http://yuilibrary.com/yui/docs/attribute/) (via [redbat](https://github.com/redbat) and [Satyam](https://github.com/Satyam)), and [Template](http://yuilibrary.com/yui/docs/template/) issues (via [ericf](https://github.com/ericf)). [Anthony Pipkin](https://github.com/apipkin) is working hard on future improvements for DataTable so stay tuned for updates!

### Many Bugfixes and Community Contributions

If you check out the [YUI 3.8.1 Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.8.1-Change-History-Rollup) page on GitHub you'll get a good idea of the modules updated for **3.8.1**. You may also notice that more and more pull requests from community members are being included in each release. If you would like to help make improvements to this project check out the [yui-contrib](https://groups.google.com/forum/?fromgroups#!forum/yui-contrib) mailing list. Please feel free to [file a ticket](http://yuilibrary.com/projects/yui3/newticket/) or make use of our newly added [Issues](https://github.com/yui/yui3/issues/new) feature on GitHub as well!

### Next Release

We are also working hard on **YUI 3.9.0** and have [already released a PR1](/yuiblog/blog/2013/01/16/yui-3-9-0pr1-charts-jsonp-and-responsive-grids/) for you to try out and help us find any remaining issues. Once we have completed testing, **YUI 3.9.0** will be arriving soon!