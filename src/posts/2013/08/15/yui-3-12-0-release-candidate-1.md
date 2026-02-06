---
layout: layouts/post.njk
title: "YUI 3.12.0 Release Candidate 1"
author: "Andrew Wooldridge"
date: 2013-08-15
slug: "yui-3-12-0-release-candidate-1"
permalink: /blog/2013/08/15/yui-3-12-0-release-candidate-1/
categories:
  - "Development"
---
We are pleased to announce a new release candidate for you to try out. **3.12.0-beta-1** is available via CDN [here](http://yui.yahooapis.com/3.12.0-beta-1/build/yui/yui-min.js), a downloadable [archive](http://yui.zenfs.com/releases/yui3/yui_3.12.0-beta-1.zip), or on [npm](https://npmjs.org/package/yui). We've also updated the [staging website](http://stage.yuilibrary.com/) with the latest documentation.

We are currently testing this release candidate and fixing any show stopper bugs. You can learn more about the release schedule [here](https://github.com/yui/yui3/wiki/Development-Schedule). Please take this opportunity to try out this release candidate in your own test environments and let us know if you run across any issues. (Note: future release candidate branches will use "rc" instead of "beta".)

## What's New in This Release

This release has enhancements and updates across the board in a number of modules, including the ones listed below.

### App Framework Fixes

Support was added to [ModelList](http://stage.yuilibrary.com/yui/docs/model-list/) for descending sort order via `sort({descending: true})` and to support this change the `options` passed to `sort()` are now passed along with a protected `_sort()` method ([#1004](https://github.com/yui/yui3/issues/1004)). Thanks to [@rishabhm](https://github.com/rishabhm) for the fix! In [Router](http://stage.yuilibrary.com/yui/docs/router/), support was added for registering route param handler functions or regular expressions ([#1063](https://github.com/yui/yui3/issues/1063)). Also fixed in Router was an issue with trying to URL-decode matching path segments that are `undefined` ([#964](https://github.com/yui/yui3/issues/964), [#1076](https://github.com/yui/yui3/issues/1076)).

### Button Fix

In [Button](http://stage.yuilibrary.com/yui/docs/button/), `ButtonGroup.disable()` will disable each child button. For more details see [ButtonGroup.getButtons()](http://stage.yuilibrary.com/yui/docs/api/classes/ButtonGroup.html#method_getButtons).

### Calendar Language Support

Support was added in [Calendar](http://stage.yuilibrary.com/yui/docs/calendar/) for various Chinese regions ([#1007](https://github.com/yui/yui3/issues/1007)). Thanks [@shunner](https://github.com/shunner)!

### Charts Feature

In [Charts](http://stage.yuilibrary.com/yui/docs/charts/), a feature was added to include logarithmic scaling ([#716](https://github.com/yui/yui3/issues/716)).

### Event Changes

A number of new features were added to [`event-tap`](http://stage.yuilibrary.com/yui/docs/api/modules/event-tap.html) and [`event-gestures`](http://stage.yuilibrary.com/yui/docs/api/modules/event-gestures.html), including:

-   the ability to prevent the browser default behavior via `e.preventDefault()`([#682](https://github.com/yui/yui3/issues/682))
-   a new `sensitivity` property that allows you to customize when `tap` fires based on the `px` difference between the start and end event ([#631](https://github.com/yui/yui3/pull/631))
-   dual-listener support ([#683](https://github.com/yui/yui3/issues/683))
-   improvements targeting Android 4.0.x reliability

In [Event](https://stage.yuilibrary.com/yui/docs/event/), [Ryan Grove](https://github.com/rgrove) fixed an issue where YUI would break the back/forward cache by attaching an unnecessary `unload` event handler.

In [Custom Event](http://stage.yuilibrary.com/yui/docs/api/classes/CustomEvent.html), we fixed a regression introduced in 3.10.0 (where `EventTarget.detach('cat|*')` would throw an exception when EventTarget was configured with a prefix).

### Node Changes

In [Node](http://stage.yuilibrary.com/yui/docs/node/), [Jeroen Versteeg](https://github.com/drjayvee) fixed two issues. One issue involved `Node` instances that were cached before `node-pluginhost`was loaded and could not become plugin hosts. The other was a fix to `Node.toggleView()` where it would not show a node if that node's `hidden` attribute wasn't set, a regression from 3.10.2.

Also, [@zhiyelee](https://github.com/zhiyelee) fixed an issue with `Node.addMethod()` where it could not bind to contexts other than itself ([#1070](https://github.com/yui/yui3/issues/1070)).

### TabView Fix

YUI contributor Bryan Zaugg ([@blzaugg](https://github.com/blzaugg)) fixed a missing ARIA role in the `tablist` of [TabView](http://stage.yuilibrary.com/yui/docs/tabview/).

### Template Feature

One of the larger changes for this release is in [Template](http://stage.yuilibrary.com/yui/docs/template/). A central template registry was added which decouples making templates available from invoking a template to render it. The registry abstracts templates to names which enables templates to be easily overridden ([#1021](https://github.com/yui/yui3/issues/1021)).

### Tree Fix

In [Tree](https://stage.yuilibrary.com/yui/docs/tree/), `Tree.Sortable` failed to reindex a node's children after sorting them, which could result in `Tree.indexOf()` and `Tree.Node.index()` returning incorrect indices.

## Process Improvements

We are constantly seeking ways to improve not only the codebase but the way in which we manage code changes and the process of releases. This release marks the first time we are trying out a [short-lived branch](https://groups.google.com/d/msg/yui-contrib/BFMaCqS6oiE/rdvOZq-2ZVcJ) method of cutting a release candidate branch and immediately reopening the tree for checkins.

## Continuous Integration

We run over 8,700 tests for [every target environment](http://yuilibrary.com/yui/environments/) with our internal CI system, so having a comprehensive set of tests for every feature is critical to maintaining our high standards for the quality in our codebase. If you are interested in contributing to YUI, consider taking on an [`up-for-grabs`](https://github.com/yui/yui3/issues?direction=desc&labels=up+for+grabs&page=1&sort=created&state=open) bug, write a test, or even simply file an [issue](https://github.com/yui/yui3/issues/new).

## Additional Details

There were a total of 239 commits for this upcoming release by 23 contributors. You can read more about the details of this release candidate in the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.12.0-Change-History-Rollup) and the [GitHub Comparison](https://github.com/yui/yui3/compare/v3.11.0...v3.12.0-beta-1) to 3.11.0.