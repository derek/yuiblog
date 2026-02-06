---
layout: layouts/post.njk
title: "YUI 3.10.0 Released"
author: "Andrew Wooldridge"
date: 2013-04-24
slug: "yui-3-10-0-released"
permalink: /blog/2013/04/24/yui-3-10-0-released/
categories:
  - "Releases"
---
We are pleased to announce the release of **YUI 3.10.0**! You can find it on the [Yahoo CDN](http://yui.yahooapis.com/3.10.0/build/yui/yui-min.js), via [direct download](http://yui.zenfs.com/releases/yui3/yui_3.10.0.zip), or [npm](https://npmjs.org/package/yui). The [YUI Library website](http://yuilibrary.com/) has also been updated with the latest documentation.

This release has a number of new features and fixes since YUI 3.9.1. Some of these are listed below.

### 4x Attribute and Base Performance Improvements

As detailed in our [PR1 blog post](/yuiblog/blog/2013/04/08/yui-3-10pr1/), we made significant performance improvements to [Attribute](http://yuilibrary.com/yui/docs/attribute/) and [Base](http://yuilibrary.com/yui/docs/base/), starting at the `AttributeCore` and `BaseCore` layers, resulting in up to **4x** improvement over **YUI 3.8.1** for some common use cases, from the non-event based `Core` changes alone. We're seeing even more significant gains when combined with the Custom Event optimizations discussed below for observable `Attribute` and `Base` implementations.

#### Backwards Compatibility Note

A significant chunk of the improvement mentioned above comes from optimizing the way we aggregate the "static" `ATTRS` collection for `Base` or `BaseCore` based objects. We now cache the results of the aggregation while creating the first instance of a given "class", and reuse the cached aggregation for subsequent instances.

As a result, if you're modifying the `ATTRS` collection of a "class" after an instance has potentially been created, you'll need to **change your code** to use the new static `modifyAttrs()` method. This way the code knows the static properties have changed and won't continue to use an out-of-date cache.

We didn't come across any code in the library or during the PR which was doing this modification, so we believe this is a fairly rare case.

For more details about this change check out `Bases`'s [HISTORY.md](https://github.com/yui/yui3/blob/v3.10.0/src/base/HISTORY.md).

### CustomEvent Performance Improvements

Along with `Attribute` and `Base`, we also improved `CustomEvent` performance for some common use cases. The improvements started out mainly targeting the "no listeners" use case, however while working on this area, we also tried to make sure the "20%" features didn't weigh down the more common "80%" code paths. These changes result in improvements from 2x up to 6x depending on the use case, even outside the targeted "no listeners" use cases.

For more details about the CustomEvent changes, see CustomEvent's [HISTORY.md](https://github.com/yui/yui3/blob/v3.10.0/src/event-custom/HISTORY.md).

#### Future Performance Work

There are a couple of further performance optimization areas in `BaseCore` and `CustomEvent` we couldn't get to in time for 3.10.0. We plan to put out a PR for these additional optimizations early in the 3.11.0 sprint cycle. Like the `ATTRS` change above, they could have some minor backwards compatibility impact but hopefully the gains make them worth it (see [comment](https://github.com/yui/yui3/pull/572#issuecomment-15808262) ).

### AutoComplete, Console, and DataTable Language Updates

YUI Contributor [Alberto Santini](https://github.com/albertosantini) added Italian language files for [Console](http://yuilibrary.com/yui/docs/console/), [AutoComplete](http://yuilibrary.com/yui/docs/autocomplete/), and [DataTable](http://yuilibrary.com/yui/docs/datatable/). Thanks Alberto! Contributing language files is an excellent way to make contributions to the YUI codebase.

### Y.Tree Improvements

Ryan Grove ([@yaypie](https://twitter.com/yaypie)) has added an extension to [`Y.Tree`](http://yuilibrary.com/yui/docs/tree/) called [`Tree.Sortable`](http://yuilibrary.com/yui/docs/api/classes/Tree.Sortable.html) which can be mixed into any Tree class to provide customizable sorting logic for nodes. He has also added `findNode()`,`find()`, `traverseNode()`, and `traverse()` methods to assist with building extensions for `Y.Tree`. For more details, check out the [HISTORY.md](https://github.com/yui/yui3/blob/v3.10.0/src/tree/HISTORY.md) entry.

### Deprecations and Removals

In this release we have officially deprecated [Profiler](http://yuilibrary.com/yui/docs/profiler/). If you are looking for good profiling tools, check out the developer tools built in to most modern browsers, which typically include profiling JavaScript. We also removed the `dom-deprecated` and `node-deprecated` modules. They have been deprecated for some time and they were due for removal from the repo.

### Using `grunt` for Release Builds

Dav Glass ([@davglass](https://twitter.com/davglass)) has converted the build system over to using [`grunt`](http://gruntjs.com/). Both dev and release builds are now done using this task runner, which has been a frequently requested feature for some time now. `grunt` also integrates with [`yogi`](https://github.com/yui/yogi) to allow you to run both tests and builds. If you want more details on how to use grunt, please take a look at the new [BUILD.md](https://github.com/yui/yui3/blob/v3.10.0/BUILD.md) file included in this release.

### And More!

This release continues the trend of having lots of community pull requests and issues fixed. There were a total of **365** [commits](https://github.com/yui/yui3/compare/v3.9.1...v3.10.0) by **22** authors between 3.9.1 and this release. There have been significant updates and changes to several unit tests as well as we continue to improve the CI process and weed out unstable tests. You can find out more about this release by checking out the [previous blog post](/yuiblog/blog/2013/04/08/yui-3-10pr1/) for PR1. There is also a [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.10.0-Change-History-Rollup) for this release.

### PR Adoption

We would like to have more "real world" adoption of PRs in the future, especially for changes as broad as the infrastructure changes mentioned above, due to the level of customization on top of them. In addition to the unit and functional tests, this helps us validate the changes we make each cycle in real-world applications, and helps us avoid having to have a rapid point release once a new version is out. In other words, you can make a real difference in the quality of a release by testing our PRs in your staging environments.

A big shout out goes to [Eduardo Lundgren](http://www.liferay.com/web/eduardo.lundgren/blog) at Liferay for trying the 3.10.0 PR out for us and letting us know how it went. (Check them out at [JAX.de](/yuiblog/blog/2013/04/23/yui3-and-alloyui-at-jax-de/) this week as well!)

[Let us know](http://yuilibrary.com/forum/viewtopic.php?f=18&t=12283) if you have ideas to help with PR adoption across the community.