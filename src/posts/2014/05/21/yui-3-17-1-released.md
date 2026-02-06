---
layout: layouts/post.njk
title: "YUI 3.17.1 Released"
author: "YUI Team"
date: 2014-05-21
slug: "yui-3-17-1-released"
permalink: /blog/2014/05/21/yui-3-17-1-released/
categories:
  - "Development"
---
We are happy to announce the release of **YUI 3.17.1**! This release can be found on the [free Yahoo CDN](http://yui.yahooapis.com/3.17.1/build/yui/yui-min.js), through [npm](https://npmjs.org/package/yui), and through a [downloadable `.zip` archive](http://yui.zenfs.com/releases/yui3/yui_3.17.1.zip). We have also updated the [YUI Library website](http://yuilibrary.com/) to reflect the changes in this release. **YUI 3.17.0** was found to have an [issue](https://github.com/yui/yui3/pull/1832) with [Loader](http://yuilibrary.com/yui/docs/api/classes/Loader.html) right before it was about to be fully released, so we decided to update the version number to reflect this fix (since **3.17.0** had already been deployed to CDN, npm, etc.)

**Do not use YUI 3.17.0 due of this Loader issue.**

The changes listed below are almost exclusively from **YUI 3.17.0** with the exception of the Loader fix.

## What's New In This Release

This release is a bit lighter on features due to a few longer-term projects in the works for next release. These include integrating a standalone version of [Promises](http://yuilibrary.com/yui/docs/promise/) called [`ypromise`](https://github.com/yahoo/ypromise) and efforts going in to replacing YUI's standard touch events with [Hammer.js](http://eightmedia.github.io/hammer.js/) under the hood. There are some significant updates this release in YUI Loader as well as a fix for an [issue](https://github.com/yui/yui3/issues/1784) with Drag and Drop + Forms. The fixes and updates for this release are outlined below.

### App Framework Changes

There was a fix in [ModelSync.Local](https://yuilibrary.com/yui/docs/api/classes/ModelSync.Local.html) to stringify the hash before saving.

### Calendar Updates

A [fix](https://github.com/yui/yui3/pull/1752) was made by [@mairatma](https://github.com/mairatma) where `Y.Calendar.selectDates` had failed when passed the `maximumDate` with minutes/seconds. There was a [fix](https://github.com/yui/yui3/pull/1749) for an issue with left/right margins in dual-panel calendars. Another [fix](https://github.com/yui/yui3/pull/1724) in Calendar resolved an issue with `calendarnavigation` month :hover and disabled styles.

### Drag and Drop Fixes

[Andrew Nicols](https://github.com/andrewnicols) fixed an [issue](https://github.com/yui/yui3/pull/1778) in [Drag and Drop](http://yuilibrary.com/yui/docs/dd/) that was a regression in 3.16.0 around filtering mousedown events. This resulted in form elements in (draggable) floating panels unable to receive focus. If you ran into this issue in YUI **3.16.0** try out **3.17.1** to see if it resolves your issue. If not, please [file a bug](https://github.com/yui/yui3/issues/new) so we can resolve any outstanding problems.

### DOM Changes

In [DOM](http://yuilibrary.com/yui/docs/api/modules/dom.html), [@okuryu](https://github.com/okuryu) [moved out](https://github.com/yui/yui3/pull/1709) the `color-base` module from being a dependency in `dom-style` to improve performance of core modules that depend on `dom-style`. Note however that `dom-style-ie` will still depend on `color-base` for legacy IE (8.0).

### Rich Text Editor Fixes

In [Rich Text Editor](http://yuilibrary.com/yui/docs/editor/) there were two minor fixes. The first one increased the specificity of when to set the cursor (assuming to be for a more accurate state of the cursor). The second fix checks for the existence of a `node` before removing it.

### YUI Loader Changes

In [Loader](http://yuilibrary.com/yui/docs/api/classes/Loader.html), support was added for optional dependencies. These dependencies are conditionally loaded but each dependency is responsible for determining the result of the test, the opposite of `condition`. Example:

```
YUI({
    modules: {
      foo: {
        test: function (Y) {
          return true;
        }
      },
      bar: {
        optionalRequires: ['foo']
      }
    }
  }).use('bar', ...);
```

In addition, there was an [issue](https://github.com/yui/yui3/pull/1832) with Loader that prevented us from fully releasing **3.17.0** and resulted in this **3.17.1** release.

### MenuNav Fixes

In [MenuNav](http://yuilibrary.com/yui/docs/api/classes/plugin.NodeMenuNav.html) a [fix](https://github.com/yui/yui3/pull/1772) was made in the check for the IE UserAgent when testing to making sure the browser is IE.

### Node Changes

In [Node](http://yuilibrary.com/yui/docs/api/classes/Node.html), `invalid` was added to the event whitelist.

### Tree Fixes

In [Tree](http://yuilibrary.com/yui/docs/api/classes/Tree.html), @rgrove fixed an [issue](https://github.com/yui/yui3/issues/1689) where moving a node to another tree failed when that node has children.

## Additional Information

There were a total of [**163** commits by **16**](https://github.com/yui/yui3/compare/v3.16.0...v3.17.1) contributors for this release. You can find details about the changes in this release by checking out the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.17.0-Change-History-Rollup) for **3.17.0**, and the [Rollup](https://github.com/yui/yui3/wiki/YUI-3.17.1-Change-History-Rollup) for **3.17.1**. For every commit made to our source, there are over 9,000 tests run against our [target environments](http://yuilibrary.com/yui/environments/). If you discover an issue, please [file it in GitHub](https://github.com/yui/yui3/issues/new) (you'll need to sign in first). If you would like to contribute tests, documentation, code fixes, or new features, please check out our [Contributing to YUI Wiki](https://github.com/yui/yui3/wiki/Contributing-to-YUI) entry.