---
layout: layouts/post.njk
title: "YUI 3.11.0 Released"
author: "Andrew Wooldridge"
date: 2013-07-16
slug: "yui-3-11-0-released"
permalink: /2013/07/16/yui-3-11-0-released/
categories:
  - "Development"
---
We are happy to announce the release of **YUI 3.11.0**! You can find it now on the [Yahoo! CDN](http://yui.yahooapis.com/3.11.0/build/yui/yui-min.js), via [npm](https://npmjs.org/package/yui), or [download it directly](http://yui.zenfs.com/releases/yui3/yui_3.11.0.zip). The [YUI Library website](http://yuilibrary.com) has also been updated to reflect the changes in this release.

There have been lots of changes across the board in this release , many of which are listed below.

## Performance Improvements Through Attribute and Base Changes

Continuing the theme of performance improvements begun in **[YUI 3.10.0](/yuiblog/blog/2013/04/24/yui-3-10-0-released/)**, there have been more changes to Attribute and Base. The [previous blog post](/yuiblog/blog/2013/06/19/3-11pr1-released/) discussing this change can provide more details, but there have been more updates and fixes since **3.11.0pr1**, most significantly this pull request ([#917](https://github.com/yui/yui3/pull/917)) which deals with an order of operations issue introduced with ([#629](https://github.com/yui/yui3/issues/629)).

Essentially this has to do with creating new objects with Base() and BaseCore() and how ATTRS are handled. In this release Base now adds up all ATTRS up the class hierarchy at once instead of a class at a time which helps in instantiation times, and Base `init` and Attribute changes bypass the Event sub-system if there are no potential listeners (a speed and performance boost).

There is a new constructor flow ( as detailed in [#917](https://github.com/yui/yui3/pull/917)), Flow "3":

Manual chained, B Constructor -> A Constructor, kicks off:

1.  ExtA Constructor
2.  ExtB Constructor
3.  Ad-Hoc attrs
4.  A + B ATTRS (valueFn, setters, getters, validators called)
5.  A initializer
6.  ExtA initializer
7.  B initializer
8.  ExtB initializer

What this means to you is that you may run into backwards compatibility issues if you depended on:

1.  Existing B ATTRS relying on A initializer and ExtA initializer having run.
2.  Existing ExtB Constructor relying on A ATTRS, A initializer, and Ext A initializer having run.

There were some older extensions ( WidgetPositionAlign, WidgetButtons, etc.) that depended on the old behavior but after updating them to use `initializer` that cleared up the issues. So, if you have an older extension or otherwise depend on the old behavior of the constructor chain, you will need to update your code before migrating to this version.

## New Paginator and DataTable Paginator

### Paginator

We are pleased to announce a new component, [Paginator](http://yuilibrary.com/yui/docs/paginator/). It is released with a few examples and full test coverage. It's built to be lightweight and flexible and can be used on the server or client side. Since there are so many unique styles and use cases to paginators, the Paginator **view** has been stripped out and can be implemented in any fashion you like. Take a look at the [examples](http://yuilibrary.com/yui/docs/examples/#component-paginator) to get a head start.

### DataTable Paginator

Hot on the heels of Paginator is the much anticipated [DataTable Paginator](http://yuilibrary.com/yui/docs/api/classes/DataTable.Paginator.html). DataTable Paginator mixes directly into DataTable and is ready to go with a few settings defined as it has its own Model, View, and Templates. Everything is decoupled enough however to take in a new Model, View and/or Template and render something completely different.

## Other Updates

This release also features a large number of fixes and updates across the board once again. The [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.11.0-Change-History-Rollup) contains a comprehensive list of all the noteworthy changes in this release.

### ArraySort Changes

[Ryan Grove](https://github.com/rgrove) [added](https://github.com/yui/yui3/commit/6db021a52411e60f92c45abdeecc532c5f44e782) a new method in [ArraySort](http://yuilibrary.com/yui/docs/api/classes/ArraySort.html) for performing natural-order comparisons of two strings, two numbers, or a number and a string.

### Calendar Changes

Several folks have contributed fixes to Calendar this time around. Jeroen Versteeg ([@drjayvee](https://github.com/drjayvee)) has been working to clean up lang with removing unused components, `short_weekdays` strings, and replacing `weekday` strings with datatype/date-format. Arnaud Didry ([@ArnaudD](https://github.com/ArnaudD)) added a fix that disables nodes correctly after setting `minimumDate` and `maximumDate`. And Gábor Kovács ([@gkovacs76](https://github.com/gkovacs76)) added Hungarian language support to Calendar (as well as other components, see below) . Go YUI community!

### Color Changes

Y.Color's `toArray()` method now always returns alpha values ([ticket](http://yuilibrary.com/projects/yui3/ticket/2533111) | [pull request](https://github.com/yui/yui3/pull/548)).

### DataTable Fixes

There are a few DataTable bugs ([#695](https://github.com/yui/yui3/pull/695), [#703](https://github.com/yui/yui3/pull/703)) that were addressed in this release. Let Tony ([@apipkin](https://github.com/apipkin)) know what you think of the changes in DataTable as well as any plans you have to use Paginator.

### DOM Fixes

Ezequiel Rodriguez ([@ziggyism](https://github.com/ziggyism)) fixed an issue in `Y.Selector` where it could return an incorrect number of elements in browsers that don't support `getElementsByTagName()` or `querySelectorAll()`. Jeroen fixed an Opera related issue where `Y.Selector` failed to include selected `<option>` elements when the `:checked` pseduo-selector was used.

### ScrollInfo Changes

Ryan also added an `isNodeOnscreen()` method in [ScrollInfo](http://yuilibrary.com/yui/docs/api/classes/Plugin.ScrollInfo.html) that returns `true` if the given node is within the visible bounds of the viewport, `false` otherwise. He improved the performance of `getOffscreenNodes()` and `getOnscreenNodes()`. He also fixed a bug that caused `getOffscreenNodes()` and `getOnscreenNodes()` to return incorrect information when used on a scrollable node rather than the body.

### Tree Changes

Ryan was on a roll with changes for this release:

-   In [Y.Tree](http://yuilibrary.com/yui/docs/tree/) the `Tree#createNode()`, `Tree#insertNode()`, and `Tree#traverseNode()` methods now throw or log informative error messages when given a destroyed node instead of failing cryptically (or succeeding when they shouldn't).
-   He added `Tree.Node#depth()`, which returns the depth of the node, starting at 0 for the root node.
-   Also added was `Tree.Sortable#sort()`, which sorts the children of every node in a sortable tree.
-   The `Tree.Node#isRoot()` method now returns `false` on destroyed nodes instead of causing an exception.
-   The `Tree.Sortable#sortNode()` and `Tree.Sortable.Node#sort()` methods now accept a `deep` option. If set to `true`, the entire hierarchy will be sorted (children, children's children, etc.).
-   In Tree.Sortable the Sort comparator functions are now executed in their original context. When the sort comparator lives on the tree, its `this` object will be the tree instance. When it lives on a node, its `this` object will be the node. When specified as an anonymous function in an options object, its `this` object will be the global object.

### Changes In YUI Core

YUI Core had quite a number of updates, all around making it faster and more compliant with modern browsers. Ezequiel Rodriguez improved the performance of `Y.Array.dedupe()` in ES5-compliant browsers as well as brought `Y.Lang.trim()`, `Y.Lang.trimLeft()`, `Y.Lang.trimRight()` into compliance with ES5 (plus tests to ensure native implementations are used only if they work properly). Ryan updated `Y.UA` to correctly identify IE 11 as well as Opera 15+.

### And More!

There were fixes in [AsyncQueue](http://yuilibrary.com/yui/docs/async-queue/), [Calendar](http://yuilibrary.com/yui/docs/calendar/) (thanks [Arnaud Didry](https://github.com/ArnaudD)), [Color](http://yuilibrary.com/yui/docs/color/), [DataTable](http://yuilibrary.com/yui/docs/datatable/), updates to [Handlebars](http://yuilibrary.com/yui/docs/handlebars/), [IO](http://yuilibrary.com/yui/docs/io/), [JSONP](http://yuilibrary.com/yui/docs/jsonp/), [Node](http://yuilibrary.com/yui/docs/node/), Plugin, and [Promise](http://yuilibrary.com/yui/docs/promise/). Hungarian language support was added to [AutoComplete](http://yuilibrary.com/yui/docs/autocomplete/), [Console](http://yuilibrary.com/yui/docs/console/), and [Date](http://yuilibrary.com/yui/docs/api/classes/Date.html) (thank you [Gábor Kovács](https://github.com/gkovacs76)). Ryan also fixed a minor issue in the [Rich Text Editor](http://yuilibrary.com/yui/docs/editor/) component. You can find a complete list of changes for this release on [GitHub](https://github.com/yui/yui3/compare/v3.10.3...v3.11.0) as well as the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.11.0-Change-History-Rollup). We had a total of 570 commits by 18 authors since **YUI 3.10.3**.

### Known Issues

Our testing efforts have been constantly expanding. As a result we are discovering issues that may have existed in previous versions but we are now better able to discover them.

-   One such [issue](https://github.com/yui/yui3/issues/1000) is with `Widget.StdMod` in IE6. Jeroen also fixed an issue where `fillHeight` didn't work correctly when a section's content was set after rendering. Fixing this exposed an issue in IE6 with `contentBox` where the height gets incorrectly set after the `bodyContentChange` event is fired. If you have code that depends on `Widget.StdMod` in IE6, take note of this issue.
-   Another [issue](https://github.com/yui/yui3/issues/890) is around DataTable Paginator in IE8 - a unit test is failing and Tony is investigating this issue.

We run over 10K tests for every environment, which now includes around 1700 functional tests! And over the course of a single day this adds up to a minimum of over 120K tests run across our [Target Environments](http://yuilibrary.com/yui/environments/). We believe having a strong CI is critical for maintaining the high standard of quality for our codebase. If you run into any issues with this release, please file an [issue](https://github.com/yui/yui3/issues/new).