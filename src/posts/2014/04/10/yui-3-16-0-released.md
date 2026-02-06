---
layout: layouts/post.njk
title: "YUI 3.16.0 Released"
author: "Andrew Wooldridge"
date: 2014-04-10
slug: "yui-3-16-0-released"
permalink: /blog/2014/04/10/yui-3-16-0-released/
categories:
  - "Development"
---
We are pleased to announce the release of **YUI 3.16.0**! This release can be found on the [Yahoo CDN](http://yui.yahooapis.com/3.16.0/build/yui/yui-min.js), through [npm](https://npmjs.org/package/yui), and via a downloadable [`.zip` archive](http://yui.zenfs.com/releases/yui3/yui_3.16.0.zip). The YUI Library website has also been updated to reflect the changes in this release.

## What's New In This Release

If there were a theme for this release, it's probably one of community involvement. Many of the fixes and update in this release were originated from the YUI community and simply brought in with minimal changes via the committers. Another theme would be around Loader. There were fixes in Loader to improve its speed as well as deal with various edge case issues. As usual, there were also a number of fixes and updates across the board as outlined below.

### App Framework Updates

In the [App Framework](http://yuilibrary.com/yui/docs/app/) an issue was fixed where Router's `hasRoute(url)` method did not follow the same semantics as the route dispatching process. Now all registered param handlers will process any named params, giving them a chance to validate and reject a param value. This will make the `hasRoute()` method an effective way to check whether a router will dispatch to a route handler for a given URL ([#1722](https://github.com/yui/yui3/issues/1722)).

### Calendar Updates {calendarupdates3160}

In [Calendar](http://yuilibrary.com/yui/docs/calendar/), Andrew Nicols fixed an issue where you could not change the month in RTL mode ([#1719](https://github.com/yui/yui3/pull/1719)) and the arrow itself was wrongly displayed ([#1724](https://github.com/yui/yui3/pull/1724)). Community member Marc Lundgren changed the arrow to display using CSS instead of an image ([#1361](https://github.com/yui/yui3/pull/1361)).

### CSS Grids Changes

Pure CSS was updated to 0.4.2 and YUI imported the new version in this release. As a result in [Grids](http://yuilibrary.com/yui/docs/cssgrids/) you can now use non-reduced fraction class names when laying out a grid. This means that we have rules for classes such as `.pure-u-12-24` as well as `.pure-u-1-2`.

### CSS Normalize Changes

Also as a result of the Pure CSS update of [Base](http://yuilibrary.com/yui/docs/cssbase/), you can now set a `[hidden]` attribute to your HTML elements if you want them to be `display: none;`.

### DataTable Updates

In [DataTable](http://yuilibrary.com/yui/docs/datatable/) an issue was fixed by @[annumanuel](https://github.com/annumanuel) were the table did not render correctly in the print preview for IE 11 ([#1708](https://github.com/yui/yui3/pull/1708)).

### DOM Changes

In [DOM](http://yuilibrary.com/yui/docs/api/classes/DOM.html) Ryuichi Okumura optimized `dom-style.js`, removed an unnecessary anonymous function and unused variables, and changed the code to use "Number()" instead of "new Number()".

### Drag and Drop Improvements

In [Drag and Drop](http://yuilibrary.com/yui/docs/dd/), Andrew Nicols moved `preventDefault` to `gesturemovestart` ([#1721](https://github.com/yui/yui3/pull/1721)) and to invoke that `preventDefault` after movement has started ([#1761](https://github.com/yui/yui3/pull/1761)). Chema Balsas fixed an issue where `dd-proxy` would reset radio buttons when cloneNode==true ([#1663](https://github.com/yui/yui3/issues/1663)).

### Rich Text Editor Updates

In [Rich Text Editor](http://yuilibrary.com/yui/docs/editor/), [@alaaibrahim](https://github.com/alaaibrahim) fixed an issue where the `yui-cursor` selector was used as an `id` instead of a `class` ([#1648](https://github.com/yui/yui3/pull/1648)).

### Event Updates

In [Event](http://yuilibrary.com/yui/docs/event/), Andrew Nicols added the spacebar key mapping to ensure correct ARIA and WCAG compliance. ([#1642](https://github.com/yui/yui3/pull/1642))

### IO Utility Changes

In [IO](http://yuilibrary.com/yui/docs/io/) there was a fix by [@goodforenergy](https://github.com/goodforenergy) to remove the unnecessary `src` attribute of an `iframe` which had caused an extra request to be made to the current page URL when the `iframe` was included on the page. ([#1646](https://github.com/yui/yui3/pull/1646) ) [@customcommander](https://github.com/customcommander) documented the usage of username/password in the Y.io configuration ([#1572](https://github.com/yui/yui3/pull/1572) ).

### Loader Changes

There were quite a few changes in [Loader](http://yuilibrary.com/yui/docs/api/classes/Loader.html) this time around including an optimization of Loader's constructor ([#1581](https://github.com/yui/yui3/pull/1581)) by [@caridy](https://github.com/caridy). Ezequiel was busy with fixes as well including removing `onCSS` documentation since it was never implemented , fixing an issue where a module's `lang` packs were not being included before the module itself, an issue where conditionally loading a module using `before` did not work, and an issue where a `CSS` module could not require a `js` module (all in [#1743](https://github.com/yui/yui3/pull/1743)).

### Node Fixes

In [Node](http://yuilibrary.com/yui/docs/node/), there was a fix for the issue where `getCell()` would throw an error if `shift` was not a recognized value. When you call `instanceof Y.Node` it now checks for `_node` to allow for instances from other sandboxes. Also, [@solmsted](https://github.com/solmsted) clarified the Node vs NodeList method docs.

### Promise Changes

In [Promise](http://yuilibrary.com/yui/docs/promise/), when there is an error inside the promise initialization, the promise is now rejected.

### Sortable Utility Fixes

In [Sortable](http://yuilibrary.com/yui/docs/sortable/), [Paul B.](https://github.com/popox) fixed an issue where the `zIndex` of a dragged item would persist at **999** after the drag was complete ([#1486](https://github.com/yui/yui3/pull/1486)).

### YUI Test Changes

In [YUI Test](http://yuilibrary.com/yui/docs/test/), `test.next` now takes an optional argument to change the value of `this` inside the callback.

### Widget Modality Fixes

Two issues were fixed in [Widget Modality](http://yuilibrary.com/yui/docs/api/modules/widget-modality.html). The first ([#1684](https://github.com/yui/yui3/pull/1684)) fixed the positioning of the modal mask for stacked models, thanks [@moiraine](https://github.com/moiraine)! The second fixed an issue where cloning a modal widget and its mask would result in Widget Modality not functioning correctly ([#1175](https://github.com/yui/yui3/pull/1175)), thanks to [@jinty](https://github.com/jinty).

### YQL Fix

An issue was fixed in [YQL](http://yuilibrary.com/yui/docs/yql/) where `yql-jsonp`, `yql-nodejs`, and `yql-winjs` were missing `yql` from their `requires` list.

## Additional Information

There were a total of [**247** commits by **29**](https://github.com/yui/yui3/compare/v3.15.0...v3.16.0) contributors for this release. You can find details about the changes in this release by checking out the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.16.0-Change-History-Rollup). For every commit made to our source, there are over 9,000 tests run against our [target environments](http://yuilibrary.com/yui/environments/). If you discover an issue, please [file it in GitHub](https://github.com/yui/yui3/issues/new) (you'll need to sign in first). If you would like to contribute tests, documentation, code fixes, or new features, please check out our [Contributing to YUI Wiki](https://github.com/yui/yui3/wiki/Contributing-to-YUI) entry. Also note that we have archived the legacy Forums and old YUI trac tickets on the website. Be sure to check out the [yui-support](https://groups.google.com/forum/#!forum/yui-support) forum for support questions, and use [GitHub Issues](https://github.com/yui/yui3/issues/new) to file tickets (you must be signed in to file tickets).

## Committer Update

Congratulations to [Andrew Nicols](https://github.com/andrewnicols) of [Moodle](https://moodle.org/) for being added as a [committer](https://github.com/yui/yui3/blob/master/CONTRIBUTORS.md)! As you can see from this release and the previous one, Andrew is actively filing issues as well as his own pull requests, and we are glad to have him join the list of committers to the YUI project!