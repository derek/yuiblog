---
layout: layouts/post.njk
title: "YUI 3.13.0 Release Candidate 1"
author: "Andrew Wooldridge"
date: 2013-10-02
slug: "yui-3-13-0-release-candidate-1"
permalink: /blog/2013/10/02/yui-3-13-0-release-candidate-1/
categories:
  - "Development"
---
We are happy to announce a new release candidate for everyone to try out: **3.13.0-rc-1**. It is available through our CDN [here](http://yui.yahooapis.com/3.13.0-rc-1/build/yui/yui-min.js), downloadable via an [archive](http://yui.zenfs.com/releases/yui3/yui_3.13.0-rc-1.zip), and installable via [npm](https://npmjs.org/package/yui).

This release candidate is currently being tested across our [target environments](http://yuilibrary.com/yui/environments/) and we're fixing any showstopper bugs. Check out the [release schedule](https://github.com/yui/yui3/wiki/Development-Schedule) for more details. Please take this opportunity to try out this release candidate in your own test environments and [file issues](https://github.com/yui/yui3/issues/new) if you run across anything that doesn't work the way you expect (please indicate which version you were testing when you file the issue).

## What's New In This Release

We have a full plate of changes and improvements! The main focus of this release centered around improvements to the Rich Text Editor, but there are changes across the board reflecting the amazing activity of our YUI community. You can find them listed below.

### Rich Text Editor Improvements

A major new feature for [Editor](http://stage.yuilibrary.com/yui/docs/editor/) is the ability to work in one of two modes. The traditional mode was via an iframe element on a page, and this is not changed. A second new mode allows Editor to work as an inline editor on a page using ContentEditable. Due to this, some internal changes have been made. `Y.Frame` is now a plugin and it extends `Y.Plugin.Base`. There is a new Plugin called ContentEditable which allows the editor to work without having to use an iframe element. If a container is not specified, `EditorBase` creates and plugs an instance of Y.Frame, otherwise it uses the provided container ([#1041](https://github.com/yui/yui3/issues/1041)). This is thanks to the work of [Iliyan Peychev](https://github.com/ipeychev) and [Tony Pipkin](https://github.com/apipkin). Check out the [updated examples](http://stage.yuilibrary.com/yui/docs/examples/#component-editor) on the staging site for implementation details. Note if you are already using Editor, there should be no changes needed for you to make, as it is backwards compatible.

### App Framework Improvements

#### Router

Take note that several changes in [Router](http://stage.yuilibrary.com/yui/docs/router/index.html) are not backwards compatible. These include a Router's `root` path is now enforced as its mount point. Routers with a specified `root` will only consider paths as matching its route handles if that path is semantically within the Router's `root` path ([#1083](https://github.com/yui/yui3/issues/1083)). The `getPath()` method now returns the _full_ current path, whereas before it returned the current path relative to the Router's `root`. This also affects `req.path` which is now the full path as well. Router's dispatching process has been changed to take `req` and `res` objects instead of creating them inside the `_dispatch()` method. This refactor also removed the deprecated support for calling `res()` as an alias for `next()`. Please take note of these changes as you may have to change the way you implement Router if you call these methods.

There were several other changes as well. Router now accepts route objects through its `route()` method. These route objects are the same as those specified in a Router's `routes` attribute and what Router uses for its internal storage of its routes. If these route objects contain a regular expression as their `path` or they contain a `regex` or `regexp` property, then they are considered fully-processed. Route objects can also contain any arbitrary metadata which will be preserved ([#1067](https://github.com/yui/yui3/issues/1067)). Additional `req` attributes were added: `req.router` which is a reference to the Router instance, and `req.route` which is a reference to the current route object whose callbacks are being dispatched. Lastly, calling the `dispatch()` method will now set a `req.src` to `dispatch`.

#### Model

In [Y.Model](http://stage.yuilibrary.com/yui/docs/model/), `ModelSync.Local` was added which is an extension that provides a `sync()` implementation for `localStorage` that can be mixed into Models and ModelLists ([#1218](https://github.com/yui/yui3/issues/1218)). You can find an example in the [YUI TodoMVC example app](https://github.com/tastejs/todomvc/tree/gh-pages/architecture-examples/yui).

### Button and Widget Changes

The changes made in both [Button](http://stage.yuilibrary.com/yui/docs/button/) and [Widget](http://stage.yuilibrary.com/yui/docs/widget/) were in order to improve Y.Button. One long-standing issue was the problem of always having to wrap Button with a container element such as a div. In Widget, support was improved for having single-box widgets (where the 'bounding box' was equivalent to the 'container box') by defaulting `boundingBox` to `srcNode` if `CONTENT_TEMPLATE` is null ([#1125](https://github.com/yui/yui3/issues/1125)).

In support of this, in Y.Button a `labelHTML` attribute was added to `Y.ButtonCore` for nested HTML label support, and now Y.Button correctly retains all node attributes upon render. In the past, the node was recreated, and any custom attributes on the node would get destroyed.

### Calendar Updates

Some fixes in [Calendar](http://stage.yuilibrary.com/yui/docs/calendar/) include resolving an issue where one couldn't select a date when passing `minimumDate` ([#1030](https://github.com/yui/yui3/issues/1030)), and removal of some superfluous strings from the Hungarian calendar translations ([#1054](https://github.com/yui/yui3/issues/1054) - thanks [Jeroen Versteeg](https://github.com/drjayvee) ).

### DataTable Changes

[DataTable](http://stage.yuilibrary.com/yui/docs/datatable/) has had a number of updates. A highlight module was added ([#1196](https://github.com/yui/yui3/issues/1196)), improvements were made to the documentation and variable naming for better code understanding ([#946](https://github.com/yui/yui3/issues/946) - thanks Satyam), `Show All` was added to language packs ([#1173](https://github.com/yui/yui3/issues/1173)), a `contentUpdate`event was added to trigger after a DataTable has been updated from a `dataChange` event ([#1072](https://github.com/yui/yui3/issues/1072)), and an issue was fixed with objects that were recursively nested being cloned infinitely ([#1008](https://github.com/yui/yui3/issues/1008)).

In addition, an issue where [Paginator's](http://stage.yuilibrary.com/yui/docs/api/modules/datatable-paginator.html) count would become out of sync with DataTable when DataTable data was added or removed ([#1011](https://github.com/yui/yui3/issues/1011)), and a French language pack was added as well ([#1166](https://github.com/yui/yui3/issues/1166)).

### Event, CustomEvent, and Event ValueChange Updates

In [Event](http://stage.yuilibrary.com/yui/docs/event/), delegated focus and blur events now behave the same way other events do when a delegate sub from a container closer to the target calls `e.stopPropagation()`. Delegate subs from containers higher in the parent axis are not notified ([#1145](https://github.com/yui/yui3/issues/1145)).

In [CustomEvent](http://stage.yuilibrary.com/yui/docs/api/classes/CustomEvent.html), `addTarget` and `removeTarget` are now chainable.

[Event ValueChange](http://stage.yuilibrary.com/yui/docs/api/classes/ValueChange.html) was updated to support `<select>` and `[contenteditable="true"]` elements as well ([#1184](https://github.com/yui/yui3/issues/1184)).

### Updates in File

YUI Community member [Jerry Reptak](https://github.com/jetfault) added a check in [File](http://stage.yuilibrary.com/yui/docs/api/classes/File.html) to make sure that the XHR exists before aborting ([#1053](https://github.com/yui/yui3/issues/1053)).

### Graphics Change

In [Graphics](http://stage.yuilibrary.com/yui/docs/graphics/), a fix was made for an issue involving elements being orphaned after `destroy()` being called (#1138).

### History Fixes

The [History](http://stage.yuilibrary.com/yui/docs/history/) module received some fixes including fixing a possible exception with `HistoryHTML5.init()` in IE10 (fixed by [Ariel Schiavoni](https://github.com/arielschiavoni)), [Rob Lund](https://github.com/roblund) added a workaround for a `replaceState` bug in Chrome/Webkit ([#1159](https://github.com/yui/yui3/issues/1159)), and [Byran Zaugg](https://github.com/blzaugg) fixed an issue with `parseHash` not parsing blank values in a hash string ([#1116](https://github.com/yui/yui3/issues/1116)).

### Node and ScrollInfo Node Plugin Fixes

In [Node](http://stage.yuilibrary.com/yui/docs/node/), pull request [#1169](https://github.com/yui/yui3/issues/1169) fixed an issue with `inDoc` failing if Node was not bound to a DOM node. In the [Node plugin for ScrollInfo](http://stage.yuilibrary.com/yui/docs/api/modules/node-scroll-info.html), the methods `getOffsceenNodes()` and `getOnscreenNodes()` were fixed to avoid returning incorrect information in certain cases.

### Paginator Naming Fix

In [Paginator](http://stage.yuilibrary.com/yui/docs/paginator/), a minor fix was done for a misspelling of Paginator in a NAME parameter.

### Transition Update

In [Transition](http://stage.yuilibrary.com/yui/docs/transition/), an optional flag was added to NodeList.transition which, if true, fires the callback only once at the end of the NodeList transitions ([#880](https://github.com/yui/yui3/issues/880) - thanks [Perturbatio](https://github.com/Perturbatio)).

### Uploader Fix

Jerry Reptak fixed another issue in [Uploader](http://stage.yuilibrary.com/yui/docs/uploader/) involving an `uploadcancel` typo.

### YUI Core Update

A new method under [Y.Lang](http://stage.yuilibrary.com/yui/docs/api/classes/Lang.html), called `Y.Lang.isRegExp()` was created.

## Removals and Deprecations

Another theme of sorts for this release was deprecation and removal. We [deprecated SimpleYUI](/yuiblog/blog/2013/06/04/yui-3-10-2-released/#deprecations) a while back, and as of this release it is removed from the codebase. We also have [deprecated and removed](https://groups.google.com/forum/#!topic/yui-contrib/_SaE7C8Asks) all of the Flash files from our repository. If you are looking to compile and host your own SWFs to include in YUI, you will need to visit the [yui3-swfs](https://github.com/yui/yui3-swfs) repo to obtain the source files. Also removed was [widget-locale](https://github.com/yui/yui3/pull/1117), as it had been already deprecated almost 3 years ago.

New deprecations include the official [deprecation](https://github.com/yui/yui3/wiki/Deprecation-Policy) of [PHP Loader](https://github.com/yui/phploader) and [YUI 2in3](https://github.com/yui/2in3). These projects will no longer be supported and their features may removed from YUI in the future (as in the case for YUI 2in3).

## Additional Details

We run over 8,700 tests for [every target environment](http://yuilibrary.com/yui/environments/) with our internal CI system, so having a comprehensive set of tests for every feature is critical to maintaining our high standards for the quality in our codebase. If you are interested in contributing to YUI, consider taking on an [`up-for-grabs`](https://github.com/yui/yui3/issues?direction=desc&labels=up+for+grabs&page=1&sort=created&state=open) bug, write a test, or even simply file an [issue](https://github.com/yui/yui3/issues/new).

There were a total of 486 commits for this upcoming release by 17 contributors. You can read more about the details of this release candidate in the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.13.0-Change-History-Rollup) and the [GitHub Comparison](https://github.com/yui/yui3/compare/v3.12.0...v3.13.0-rc-1) to 3.12.0.