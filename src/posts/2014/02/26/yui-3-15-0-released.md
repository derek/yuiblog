---
layout: layouts/post.njk
title: "YUI 3.15.0 Released"
author: "Andrew Wooldridge"
date: 2014-02-26
slug: "yui-3-15-0-released"
permalink: /2014/02/26/yui-3-15-0-released/
categories:
  - "Releases"
  - "Development"
---
We are happy to announce the release of YUI **3.15.0**! You can find this release on the [Yahoo CDN](http://yui.yahooapis.com/3.15.0/build/yui/yui-min.js), through [npm](https://npmjs.org/package/yui), and downloadable via a [`.zip` archive](http://yui.zenfs.com/releases/yui3/yui_3.15.0.zip). The [YUI Library website](http://yuilibrary.com/) has also been updated to reflect the changes in this release.

## What's New In This Release

If there was one person who has had the biggest impact on this release, it would be [Juan Dopazo](https://twitter.com/juandopazo). He has been doing quite a bit of work around adding support for ES6 modules in YUI. He updated the underlying implementation of `Y.soon` in the Timers module, and also contributed a huge amount of work to the Promise module. In addition he did a good amount clean-up work behind the scenes on the inline docs across the library. Beyond this, there were changes and updates across a wide variety of modules, and a huge effort went into bringing down the number of test failures from our website examples.

### App Framework Updates

In the [App Framework](http://yuilibrary.com/yui/docs/app/) `ModelSync.local` was [refactored](https://github.com/yui/yui3/pull/1613) to use a different and more readable storage system. Note that this system is backwards-incompatible with the old storage system but the API remains the same so you don't need to change application code unless you want to maintain the data that is already present in `localstorage` today. In addition, there was a fix to `history-hash-ie` to prevent it loading for non-IE browsers ([#1613](https://github.com/yui/yui3/pull/1613)).

### Attribute Fixes

In [Attribute](http://yuilibrary.com/yui/docs/attribute/), a issue was [fixed](https://github.com/yui/yui3/pull/1542) where `reset()` would fail when resetting an attribute called `'length'`.

### Calendar Changes

Two issues were fixed in the [Calendar](http://yuilibrary.com/yui/docs/calendar/) module. The first [changes the behavior of Calendar](https://github.com/yui/yui3/issues/1627) to use `visibility:inherit` instead of `visibility:visible` for compatibility with overlays (thanks [@jafl](https://github.com/jafl)). The second fixes an issue where the Calendar cell of the next month appears to be selectable (see [#1559](https://github.com/yui/yui3/issues/1559) for details, and thanks to [@shunner](https://github.com/shunner) for the fix).

### Charts Updates

The Charts module received two updates as well. In a single series histogram the `_maxSize` property was not updated ([#1480](https://github.com/yui/yui3/pull/1480/)). The `labelFormat` attribute [was added](https://github.com/yui/yui3/pull/1632/) to `CategoryAxisBase` and `CategoryAxis`.

### Date Updates

There were some changes to [Date](http://yuilibrary.com/yui/docs/api/classes/Date.html) that landed in the tree between releases that caused a number of test failures. Those changes were reverted until the tests can be updated to fix the failures (see details [here](https://github.com/yui/yui3/commit/7e4b363fcba52bfa5443da2b23ad2989b8186b9a), [here](https://github.com/yui/yui3/commit/1c292444451feeacf0613f2e03bafdb355b92cd4) and [here](https://github.com/yui/yui3/commit/36592d9d8ded7f4cfd837fa905c19c83f45e0cc8)).

### Drag and Drop Fixes

In [Drag and Drop](http://yuilibrary.com/yui/docs/dd/), a bug where `drop:hit` didn't fire was [fixed](https://github.com/yui/yui3/issues/1573) (thanks [@hacklschorsch](https://github.com/hacklschorsch) ). When starting a `gesturemove` event, the default page action is prevented and fixes an [issue](https://github.com/yui/yui3/issues/1557) where browsers were selecting the text when dragging (thanks [@andrewnicols](https://github.com/andrewnicols)).

### DOM Fixes

In DOM we have two fixes thanks to [@okuryu](https://twitter.com/okuryu). The first fixes an [issue](https://github.com/yui/yui3/issues/1603) where if you set an input value to `null` resulted in a node.value ==="null" in IE9. The second fixes an [issue](https://github.com/yui/yui3/issues/1469) in `setStyle()` where you could not set an opacity to 1.

### Event Infrastructure and Event Simulate Changes

If there was one bug you might have seen and really wished was fixed, it was probably [one](https://github.com/yui/yui3/issues/1460) in [Event](http://yuilibrary.com/yui/docs/event/) where you would see an `event.returnValue is deprecated` warning in Chrome. A big thanks to [@zhiyelee](https://github.com/zhiyelee) for fixing this! Also, [@andrewnicols](https://github.com/andrewnicols) reduced categories of certain noisy log events in the `event` module and added categories for those that were missing some ([#1605](https://github.com/yui/yui3/issues/1605)). Lastly, support was added for W3C Pointer events in the `tap` event. This fixed an issue were the `type` of pointer event objects was changed from `MSPointerDown` to `pointerdown` to comply with their proposed W3C standard.

In [Event Simulate](http://yuilibrary.com/yui/docs/api/modules/event-simulate.html), whitelisted W3C Pointer events were added.

### Graphics Updates

Graphics received two updates. The [first](https://github.com/yui/yui3/pull/1543/) parses an rgba value into a color string and opacity value for vml fill and stroke. The second addressed an [issue](https://github.com/yui/yui3/pull/1566/) with path chaining in the canvas implementation of graphics.

### IO Fix

There was an issue in `io-upload-iframe` fixed by [@andrewnicols](https://github.com/andrewnicols) where the code would attempt to reset attributes of a `form` element that no longer existed on the page ([#1465](https://github.com/yui/yui3/pull/1465/) ).

### Loader Performance Improvements

Since [Loader](http://yuilibrary.com/yui/docs/api/classes/Loader.html) is fundamental to YUI, any updates here often have a broad impact on the library. [Ezequiel](https://github.com/ezequiel) optimized the `calculate` method to now use a topological sort (a variation of a depth first search) to generate a valid dependency order. If you find any issues with this new behavior, please [file an issue](https://github.com/yui/yui3/issues/new) (you must be logged in).

### Promise Updates and Deprecations

The next version of YUI introduces several changes to align them better to the emerging EcmaScript 6 standard.

There are new static methods for creating promises: `Promise.resolve` and `Promise.reject`. These are factory counterparts for the functions available to the promise initialization function. A typical use case is rejecting early when a function that returns a promise gets a wrong input:

There are new static methods for combining promises: `Promise.all` and `Promise.race`. `Promise.all` is similar to `Y.batch` but it takes an array, which makes it easier to keep a list of promises and pass it to `Promise.all(arrayOfPromises)`.

The `resolve` function now handles promises as values. If a promise for the value ‘foo’ is passed to `resolve`, the new promise will be fulfilled with `foo` as soon as the first one is fulfilled.

This is also true for the static `Promise.resolve`.

The method `promise.getStatus()` is deprecated to align with the new EcmaScript standard for promises. Internally, the use of a Resolver object will also be removed in the future to match the API in Chrome and Firefox.

### YUI Test Addition

In YUI Test a new method was added `test.next(fn)` which returns a callback that automatically resumes asynchronous tests.

### Timers Changes

Another relatively big change in this release is the importing of `asap.js` as the underlying implementation of `Y.soon`. Tasks scheduled during the flushing of the queue are pushed to the end of the queue instead of being scheduled for a new tick.

### Widget Modality Fix

A [bug](https://github.com/yui/yui3/pull/1636) was fixed in Widget Modality where the widget would focus before it was actually rendered and caused a jump in the window position (thanks [@andrewnicols](https://github.com/andrewnicols)).

### YUI Core Changes

In YUI Core, a method called `Y.require()` was added for importing ES6 modules. It's similar to `Y.use()` but it follows the following signature.

Also in YUI Core [@andrewnicols](https://github.com/andrewnicols) set the default `logLevel` to `info` if missing or not a real category ([#1610](https://github.com/yui/yui3/compare/v3.14.1...v3.15.0)). Contributor [@adinardi](https://github.com/yui/yui3/wiki/YUI-3.15.0-Change-History-Rollup) fixed UA detection in recent versions of the Amazon Silk browser ([#1576](http://yuilibrary.com/yui/environments/)). And finally, the value of `this` was fixed inside ES6 definitions.

## Additional Information

There were a total of [**449** commits by **19** contributors](https://github.com/yui/yui3/compare/v3.14.1...v3.15.0) for this release. You can find details about the changes in this release by checking out the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.15.0-Change-History-Rollup). For every commit made to our source, there are over 9,000 tests run against our [target environments](http://yuilibrary.com/yui/environments/). If you discover an issue, please [file it in GitHub](https://github.com/yui/yui3/issues/new) (you'll need to sign in first). If you would like to contribute tests, documentation, code fixes, or new features, please check out our [Contributing to YUI](https://github.com/yui/yui3/wiki/Contributing-to-YUI) Wiki entry.