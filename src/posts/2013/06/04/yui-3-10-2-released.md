---
layout: layouts/post.njk
title: "YUI 3.10.2 Released"
author: "Andrew Wooldridge"
date: 2013-06-04
slug: "yui-3-10-2-released"
permalink: /blog/2013/06/04/yui-3-10-2-released/
categories:
  - "Releases"
---
We are happy to announce the release of **YUI 3.10.2**! You can find it now on the [Yahoo! CDN](http://yui.yahooapis.com/3.10.2/build/yui/yui-min.js), [download it](http://yui.zenfs.com/releases/yui3/yui_3.10.2.zip) directly, or pull it in via [npm](https://npmjs.org/package/yui). We've also updated the [YUI Library website](http://yuilibrary.com/) with the latest documentation.

Since we've had a number of larger releases lately, this release represents an effort to do some "spring cleaning" on the codebase. Behind the scenes we've also been working hard on our CI system. We've been digging deep into flaky browser tests to ensure that we have the highest confidence in future releases across our supported [YUI Target Environments](http://yuilibrary.com/yui/environments/).

Given the "cleanup" nature of this release, there are updates and fixes across the board.

### Anim Fix

YUI contributor [Zeno Rocha](https://github.com/zenorocha) (from Liferay) removed an unnecessary `code` tag in the [Anim](http://yuilibrary.com/yui/docs/anim/) Utility.

### App Framework Fix

In the [App Framework](http://yuilibrary.com/yui/docs/app/), [Router](http://yuilibrary.com/yui/docs/router/index.html) now properly dispatches when using hash-based URLS and calling `replace()` without arguments. Before this would throw an error.

### Attribute Fix

In YUI 3.8.1 there was a fix to ensure options were sent to the setter correctly in [Attribute](http://yuilibrary.com/yui/docs/attribute/), but this didn't work using `AttributeObservable` and is now fixed in this version.

### Charts Fixes

Two issues were fixed in [Charts](http://yuilibrary.com/yui/docs/charts/). In the first, styles didn't map correctly to a legend when series were styled using a global object. In the second, the legend would not honor the specified series marker style for shape.

### Color Changes

This is a relatively larger change that you may want to take note of. [Y.Color](http://yuilibrary.com/yui/docs/color/) was moved out of [DOM](http://yuilibrary.com/yui/docs/api/classes/DOM.html). You may observe some minor differences in the output of Y.Color methods. So if you were depending on a specific type of response, for instance `toHex()`, you may want to check your own implementations. See [pull request 822](https://github.com/yui/yui3/pull/822) for more details.

### Dial Fixes

There was a minor bug fix in [Dial](http://yuilibrary.com/yui/docs/dial/) where it may stick at min if you dragged it below min, then back above min - but only if the min/max position was North of the dial.

### Event and Custom Event Fixes

One area that received a lot of attention this time around were the [Event](http://yuilibrary.com/yui/docs/event/) and [Custom Event](http://yuilibrary.com/yui/docs/api/classes/CustomEvent.html) modules. The `nodelist.on()` method had a rare issue with custom module loading. There was a fix for DOM event facade when the Y instance was set to `emitFacade:true` (see [release notes](https://github.com/yui/yui3/wiki/YUI-3.10.2-Change-History-Rollup) for details). In Custom Event there was an issue fixed regarding the facade carrying stale data for the "no subscriber" case. A Custom Event regression was fixed where `once()` and `onceAfter()` subscriptions using the `*` prefix threw a `TypeError`. Finally, there was an exception fixed with `fire(type,null)` with `emitFacade:true`.

### JSON Fix

YUI Reviewer [Luke Smith](https://github.com/lsmith) fixed an [issue](https://github.com/yui/yui3/issues/690) in the [JSON](http://yuilibrary.com/yui/docs/json/) utility that would effect YUICompressor and code minification. There are efforts (see issues [4](https://github.com/yui/grunt-yui-contrib/issues/4) and [5](https://github.com/yui/grunt-yui-contrib/issues/5)) underway to guarantee CDN files are tested.

### Graphics Fix

There was a rounding issue fixed in the SVG implementation that had surfaced in certain edge cases of the [PieChart](http://yuilibrary.com/yui/docs/api/classes/PieChart.html) in the Charts module.

### Handlebars Update

[Handlebars](http://yuilibrary.com/yui/docs/handlebars/) within YUI was updated to v1.0.11. For more details, see the [Handlebar's release notes](https://github.com/wycats/handlebars.js/blob/master/release-notes.md#v1011).

### Node Accessibility Improvements

YUI contributor **Gerard Cohen** contributed a change where `show()` and `hide()` now set and remove a [node's](http://yuilibrary.com/yui/docs/node/) `hidden` attribute, providing a semantic indication of hidden content and improving accessibility.

### Scrollview Update

The [Paginator](http://yuilibrary.com/yui/docs/api/modules/scrollview-paginator.html) API methods now respect the widget's `disabled` ATTR.

### Deprecations and Removals

SimpleYUI has been deprecated in this release. This module will be removed from the library in a future version. Profiler has been on the deprecation track as well and has now been removed from the library in this release.

### Widget Fixes

In [Widget](http://yuilibrary.com/yui/docs/widget/), contentBox would remain in the `Y.Node_instances` cache when the widget hadn't been rendered and `widget.destroy(true)` was used.

### Throttle Change

[Throttle](http://yuilibrary.com/yui/docs/api/modules/yui-throttle.html) no longer changes the value of `this` inside the throttled function.

### And More!

There were a total of **226** [commits](https://github.com/yui/yui3/compare/v3.10.1...v3.10.2) by **21** authors between **YUI 3.10.1** and this release. We have spent quite a bit of time making our unit and functional tests more robust. We encourage you to consider not only contributing code fixes and feature improvements, but additional unit tests as well. We run approximately 20,000 tests for every build! And through the course of a single day that that adds up to almost 100K tests across our [Target Environments](http://yuilibrary.com/yui/environments/). We believe that strong CI with robust tests is essential to maintaining the high standard of quality we hold for our codebase. If you would like to learn more about this release, please check out the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.10.2-Change-History-Rollup).