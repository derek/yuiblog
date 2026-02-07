---
layout: layouts/post.njk
title: "YUI 3.14.0 Released"
author: "Andrew Wooldridge"
date: 2013-11-25
slug: "yui-3-14-0-released"
permalink: /2013/11/25/yui-3-14-0-released/
categories:
  - "Releases"
  - "Development"
---
We are pleased to announce the release of **YUI 3.14.0**! This release can be found on the [Yahoo CDN](http://yui.yahooapis.com/3.14.0/build/yui/yui-min.js) as well as through [npm](https://npmjs.org/package/yui) and a [`.zip` archive](http://yui.zenfs.com/releases/yui3/yui_3.14.0.zip). We also have updated the [YUI Library website](http://yuilibrary.com/) to reflect the changes in this release. ( It's fitting that this release is so near to Thanksgiving, since it's our "pi" release.)

## What's New In This Release

Two of the larger changes in this release include updates to [Charts](http://yuilibrary.com/yui/docs/charts/) (and the underlying [Graphics](http://yuilibrary.com/yui/docs/graphics/) component) and a new feature to enable transpiled [ES6 modules](http://wiki.ecmascript.org/doku.php?id=harmony:modules) to YUI modules. (More info on what ES6 Modules are is [here](http://www.2ality.com/2013/07/es6-modules.html).) There were also many fixes across modules and a continuing theme of community members contributing these fixes and improvements.

### Charts and Graphics

In Charts an issue ([#1393](https://github.com/yui/yui3/issues/1393)) was fixed in which CandleStick series did not render nicely when there were large amounts of data, several histogram issues were fixed ([#1390](https://github.com/yui/yui3/issues/1390), [#1391](https://github.com/yui/yui3/issues/1391), [#1392](https://github.com/yui/yui3/issues/1392)), an issue ([#1382](https://github.com/yui/yui3/issues/1382)) was fixed where first/last values were removed from axis in certain cases, and a feature ([#1381](https://github.com/yui/yui3/issues/1381)) was added to offset labels in Axis. In Graphics there was a fix ([#1398](https://github.com/yui/yui3/issues/1398)) for an issue in which the canvas element did not properly position itself within a container and a fix ([#1375](https://github.com/yui/yui3/issues/1375)) for when the path did not stroke correctly in the SVG implementation.

**NOTE**: There was a regression introduced in this release in Charts. Please see the [YUI 3.14.1 release blog post](/yuiblog/blog/2013/12/18/yui-3-14-1-released/) for more details.

### EcmaScript 6 Compatible YUI Modules

By setting a feature flag (`{es: true, requires: []}`) in your YUI config, you can get access to a new exciting feature which allows access to [ES6 modules](http://wiki.ecmascript.org/doku.php?id=harmony:modules) to be transpiled into YUI modules. For more details about this feature, please check out the [pull request](https://github.com/yui/yui3/pull/1407). There's [work in progress](https://github.com/square/es6-module-transpiler/pull/78) to get the [`es6-module-transpiler`](https://github.com/square/es6-module-transpiler) to output YUI modules as well.

### Button Change

In [Button](http://yuilibrary.com/yui/docs/button/) there was a fix ([#1374](https://github.com/yui/yui3/pull/1374)) by [@drjayvee](https://github.com/drjayvee) for the `disabledChange` listener to correctly enable or disable buttons.

### Calendar Fix

There was a minor fix ([#1307](https://github.com/yui/yui3/issues/1307)) in [Calendar](http://yuilibrary.com/yui/docs/calendar/) by [@okuryu](https://github.com/okuryu) regarding an undeclared variable.

### CSS Grids and Normalize Update

Another relatively important change this time around is that [CSS Grids](http://yuilibrary.com/yui/docs/cssgrids/) and [CSS Normalize](http://yuilibrary.com/yui/docs/cssnormalize/) are now imported into YUI from [Pure](http://purecss.io/) via Grunt ([#1240](https://github.com/yui/yui3/issues/1240)). This is a big step not only toward more fully integrating Pure into YUI, but represents a new way for YUI to include other 3rd party libraries and code into the codebase itself.

### DataTable Update

The [DataTable](http://yuilibrary.com/yui/docs/datatable/) module was updated with an a `datatable-keynav` module which provides keyboard navigation within DataTable ([#596](https://github.com/yui/yui3/issues/596)).

### Rich Text Editor Fix

In [Rich Text Editor](http://yuilibrary.com/yui/docs/editor/) a Y.Frame issue ([#1367](https://github.com/yui/yui3/issues/1367)) was fixed where the linked CSS in the frame was trying to call `/undefined`. Thanks to [@ipeychev](https://github.com/ipeychev) for the fix!

### Get Utility Issue

There is now a fix for an issue ([#1360](https://github.com/yui/yui3/pull/1360)) in the [Get Utility](http://yuilibrary.com/yui/docs/get/) where the behavior for `this` was different between Node.js and in the browser. This fix maintains feature parity for polyfills and other vendor scripts.

### Node Feature Additions

In [Node](http://yuilibrary.com/yui/docs/node/), there has been the addition of `paste`, `copy`, and `cut` to Node's event whitelist ([#1350](https://github.com/yui/yui3/issues/1350)). Thanks [@JetFault](https://github.com/JetFault)!

### Number Feature Added

In [Number](http://yuilibrary.com/yui/docs/api/classes/Number.html), `parse`can parse all the formats that `format` can produce ([#587](https://github.com/yui/yui3/issues/587)).

### YUI Test Change

A new method was added to [YUI Test](http://yuilibrary.com/yui/docs/test/) called `Y.ArrayAssert.isUnique()`.

### Transition Fix

In [Transition](http://yuilibrary.com/yui/docs/transition/), an issue was fixed ([#1258](https://github.com/yui/yui3/issues/1258)) where `toggleView`did not correctly work when passed only an effect name.

### Uploader Utility Feature

In [Uploader](http://yuilibrary.com/yui/docs/uploader/), there was an addition ([#1356](https://github.com/yui/yui3/issues/1356)) of XHR's `responseText`to `uploaderror's`event payload. Thanks to [@semafor](https://github.com/semafor) for the addition!

## Deprecations for This Release

In [Promise](http://yuilibrary.com/yui/docs/promise/), `getStatus` has been marked deprecated. This means this method may be removed some time in the future, so you should not depend on its presence in your own code.

## Target Environments Update

We've updated our [Target Environments Matrix](http://yuilibrary.com/yui/environments/) page to reflect our added support for **iOS 7**. We have also broken out desktop Safari into **OS X 10.8** (Mt. Lion) and **OS X 10.9** (Mavericks) to reflect the growing marketshare of **OS X 10.9**. Also, we have updated the supported version of **WinJS** for **Windows 8 Apps** as that version significantly improves support for 3rd party JavaScript libraries like YUI. We continually update and re-evaluate this matrix to reflect the current state of browser and platform marketshare, so be sure to check it for updates periodically.

## Additional Information

There were a total of [**341** commits by **24** contributors](https://github.com/yui/yui3/compare/v3.13.0...v3.14.0) for this release. You can find details about the changes in this release by checking out the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.14.0-Change-History-Rollup). For every commit made to our source, there are over 9,000 tests run against our [target environments](http://yuilibrary.com/yui/environments/). If you discover an issue, please [file it in GitHub](https://github.com/yui/yui3/issues/new) (you'll need to sign in first). If you would like to contribute tests, documentation, code fixes, or new features, please check out our [Contributing to YUI](https://github.com/yui/yui3/wiki/Contributing-to-YUI) Wiki entry.