---
layout: layouts/post.njk
title: "YUI 3.9.1 Released"
author: "Andrew Wooldridge"
date: 2013-03-27
slug: "yui-3-9-1-released"
permalink: /2013/03/27/yui-3-9-1-released/
categories:
  - "Releases"
---
Today we have released **YUI 3.9.1**. You can find this release on the [Yahoo! CDN](http://yui.yahooapis.com/3.9.1/build/yui/yui-min.js), as a [download](http://yui.zenfs.com/releases/yui3/yui_3.9.1.zip), and on [npm](https://npmjs.org/package/yui). The [YUI Library website](http://yuilibrary.com/) has been updated as well. This is a small release mainly intended to fix an issue with Handlebars but includes some other great fixes as well.

## Updated Handlebars

There was an issue in the previous release with the version of [Handlebars](http://yuilibrary.com/yui/docs/handlebars/) included in the source. This version would prevent you from doing anything more than the most basic Handlebars templates due to a regression with nested blocks. This regression was found by the automated testing from the [Mojito](https://github.com/yahoo/mojito) team and highlighted a discrepancy between the npm version and source version of Handlebars. This release includes an updated version of Handlebars in both the source and npm builds which fixes this regression. We've subsequently added additional tests to check for this issue in the future. **If you are using Handlebars in your applications you should definitely update to this latest version.**

## LazyModelList Fixes

Ryan Grove \[[@yaypie](https://twitter.com/yaypie)\] included a few fixes to [`LazyModelList`](http://yuilibrary.com/yui/docs/api/classes/LazyModelList.html) including an [issue](https://github.com/yui/yui3/issues/528) where a revived model would not update the original object when an attribute changed, as well as an [issue](https://github.com/yui/yui3/issues/530) where revived models did not have the same `clientId` as the original object. Thanks to [ItsAsbreuk](https://github.com/ItsAsbreuk) for filing the issues!

## `Y.Tree` changes

Ryan also added a [feature](https://github.com/yui/yui3/commit/8323511d74940270f8b5d385efd98422502e6bd8) to [`Y.Tree`](http://yuilibrary.com/yui/docs/tree/) adding a `src` option to all methods that trigger events. This is passed along to the event facade of the resulting event and can be used to distinguish between changes caused by different sources (such as user-initiated changes vs programmatic changes).

You can check out the details of all the changes in this release in the [YUI 3.9.1 History Rollup](https://github.com/yui/yui3/wiki/YUI-3.9.1-Change-History-Rollup) as well.