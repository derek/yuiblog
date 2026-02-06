---
layout: layouts/post.njk
title: "3.11pr1 Released"
author: "Andrew Wooldridge"
date: 2013-06-19
slug: "3-11pr1-released"
permalink: /2013/06/19/3-11pr1-released/
categories:
  - "Releases"
---
We are pleased to announce a new preview release for you to try out. **YUI 3.11pr1** is available via [Yahoo! CDN](http://yui.yahooapis.com/3.11.0pr1/build/yui/yui-min.js), a downloadable [archive](http://yui.zenfs.com/releases/yui3/yui_3.11.0pr1.zip), or on [npm](https://npmjs.org/package/yui). Our YUI Library [staging website](http://stage.yuilibrary.com/) has also been updated to reflect the changes in this release. **Given that this is a preview release, please take note of the [testing advisory](#testing) below.**

## Purpose of This Preview Release

For this sprint we have some fundamental changes to Attribute and Base, which could benefit from some validation against real-world implementations. Getting an early PR out and widely adopted gives us a couple of weeks to react to anything which comes out of the PR process due to these low level changes.

## Attribute and Base Changes

There are two relatively low level changes to Attribute and Base/BaseCore that help improve performance and stability.

-   Base now adds all ATTRS up the class hierarchy at once, instead of a class at a time ([Issue](https://github.com/yui/yui3/issues/629) / [Pull Request](https://github.com/yui/yui3/pull/781)).
-   Base `init` and Attribute `change` events now bypass the Event sub-system if there are no potential listeners ([Issue](https://github.com/yui/yui3/issues/702) / [Pull Request](https://github.com/yui/yui3/pull/863)).

Here are some performance numbers, to highlight the potential benefits of these changes:

<table><tbody><tr><td>Version</td><td>Ops/Sec</td></tr><tr><td>3.9.0</td><td><div>new Base() with no init listener x <strong>12,914</strong> ops/sec</div><div>myBase.set() with no listeners x <strong>82,616</strong> ops/sec</div></td></tr><tr><td>3.10.3</td><td><div>new Base() with no init listener x <strong>40,308</strong> ops/sec</div><div>myBase.set() with no listeners x <strong>256,048</strong> ops/sec</div></td></tr><tr><td>3.11.0pr1</td><td><div>new Base() with no init listener x <strong>75,828</strong> ops/sec</div><div>myBase.set() with no listeners x <strong>1,217,522</strong> ops/sec</div></td></tr></tbody></table>

Both of these changes carry with them some element of risk, but they have the potential to provide performance improvements with only a small degree of backwards compatibility issues. **One of the primary reasons for this PR is to test these changes, so we encourage you to download this release and test them out.**

## New Paginator and DataTable Paginator

### Paginator

We are pleased to announce a new component, [Paginator](http://stage.yuilibrary.com/yui/docs/paginator/). It is released with a few examples and full test coverage. It's built to be lightweight and flexible and can be used on the server or client side. Since there are so many unique styles and use cases to paginators, the paginator **view** has been stripped out and can be implemented in any fashion you like. Take a look at the [examples](http://stage.yuilibrary.com/yui/docs/examples/#component-paginator) to get a head start.

### DataTable Paginator

Hot on the heels of Paginator is the much anticipated DataTable Paginator. DataTable Paginator mixes directly into DataTable and is ready to go with a few settings defined as it has its own Model, View, and Templates. Everything is decoupled enough however to take in a new Model, View and/or Template and render something completely different.

## Other Updates

There are also a number of bug fixes and updates across the board in this release, including a new Paginator module.

### DataTable Fixes

There are also a few DataTable bugs that were addressed in this preview release. Look here for the [full list of changes](https://github.com/yui/yui3/compare/v3.10.3...v3.11.0pr1). Let Tony ([@apipkin](https://github.com/apipkin)) know what you think of the changes in DataTable as well as any plans you have to use Paginator.

### ArraySort Changes

[Ryan Grove](https://github.com/rgrove) [added](https://github.com/yui/yui3/commit/6db021a52411e60f92c45abdeecc532c5f44e782) a new method in [ArraySort](http://stage.yuilibrary.com/yui/docs/api/classes/ArraySort.html) for performing natural-order comparisons of two strings, two numbers, or a number and a string.

### ScrollInfo Changes

Ryan also added an `isNodeOnscreen()` method in [ScrollInfo](http://stage.yuilibrary.com/yui/docs/api/classes/Plugin.ScrollInfo.html) that returns `true` if the given node is within the visible bounds of the viewport, `false` otherwise. He improved the performance of `getOffscreenNodes()` and `getOnscreenNodes()`. He also fixed a bug that caused `getOffscreenNodes()` and `getOnscreenNodes()` to return incorrect information when used on a scrollable node rather than the body.

### Tree Changes

Ryan was on a roll with changes for this release:

-   In [Y.Tree](http://stage.yuilibrary.com/yui/docs/tree/) the `Tree#createNode()`, `Tree#insertNode()`, and `Tree#traverseNode()` methods now throw or log informative error messages when given a destroyed node instead of failing cryptically (or succeeding when they shouldn't).
-   He added `Tree.Node#depth()`, which returns the depth of the node, starting at 0 for the root node.
-   Also added was `Tree.Sortable#sort()`, which sorts the children of every node in a sortable tree.
-   The `Tree.Node#isRoot()` method now returns `false` on destroyed nodes instead of causing an exception.
-   The `Tree.Sortable#sortNode()` and `Tree.Sortable.Node#sort()` methods now accept a `deep` option. If set to `true`, the entire hierarchy will be sorted (children, children's children, etc.).
-   In Tree.Sortable the Sort comparator functions are now executed in their original context. When the sort comparator lives on the tree, its `this` object will be the tree instance. When it lives on a node, its `this` object will be the node. When specified as an anonymous function in an options object, its `this` object will be the global object.

### And More!

There were fixes in [AsyncQueue](http://stage.yuilibrary.com/yui/docs/async-queue/), [Calendar](http://stage.yuilibrary.com/yui/docs/calendar/) (thanks [Arnaud Didry](https://github.com/ArnaudD)), [Color](http://stage.yuilibrary.com/yui/docs/color/), [DataTable](http://stage.yuilibrary.com/yui/docs/datatable/), updates to [Handlebars](http://stage.yuilibrary.com/yui/docs/handlebars/), [IO](http://stage.yuilibrary.com/yui/docs/io/), [JSONP](http://stage.yuilibrary.com/yui/docs/jsonp/), and [Promise](http://stage.yuilibrary.com/yui/docs/promise/). Hungarian language support was added to [AutoComplete](http://stage.yuilibrary.com/yui/docs/autocomplete/), [Console](http://stage.yuilibrary.com/yui/docs/console/), and [Date](http://stage.yuilibrary.com/yui/docs/api/classes/Date.html) (thank you [Gábor Kovács](https://github.com/gkovacs76)). You can find a complete list of changes for this release on [GitHub](https://github.com/yui/yui3/compare/v3.10.3...v3.11.0pr1) as well as the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.11.0-Change-History-Rollup). We had a total of 381 commits by 14 authors since **YUI 3.10.3**.

### A Call for Testing

Since many of these changes are either new or may have unforeseen issues, we recommend that you take this preview release and try it out in a staging environment with your own applications. It is very important that we hear about any issues you run into so that we can fix them in a timely manner before the **3.11 GA** release. If you do encounter an issue, please [file a ticket](https://github.com/yui/yui3/issues/new).

### Known Issues

We've already been testing this preview release across our [target environments](http://yuilibrary.com/yui/environments/) and we've encountered a few issues that you should be aware of in your own testing.

-   Test failure: ArraySort on Safari (4.0) / Linux \[ 2.3 \] in naturalCompare() should sort mixed strings and numbers: Values in position 5 are not the same. Expected: 100 (number) Actual: 100 (string)
    
-   Test failure: DataTable: Paginator on Internet Explorer (8.0) / Windows XP in Paginator test rowsPerPage === null shows all rows: There are not 100 rows in the table Expected: 100 (number) Actual: 0 (number)
    
-   Test failure: test clicking on the controls: Values should be the same. Expected: C:30 (string) Actual: A:0 (string)
    

The ArraySort test failure is being tracked in this pull request ([#886](https://github.com/yui/yui3/issues/886)) and Tony is investigating the DataTable issues in this pull request ([#890](https://github.com/yui/yui3/issues/890)).

As you try out this preview release, pay particular attention to the Attribute and Base changes, the new Paginator module, and the new methods in Y.Tree. With your help, we can make the upcoming **3.11 GA** release the best one yet!