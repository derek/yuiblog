---
layout: layouts/post.njk
title: "YUI 3.7.0pr2 - Final Round of Testing"
author: "Eric Ferraiuolo"
date: 2012-09-12
slug: "yui-3-7-0pr2-final-round-of-testing"
permalink: /2012/09/12/yui-3-7-0pr2-final-round-of-testing/
categories:
  - "Releases"
---
Two weeks ago we released [YUI 3.7.0pr1](/yuiblog/blog/2012/08/31/yui-3-7-0pr1-event-performance/ "YUI 3.7.0pr1 Blog post"), today we're releasing the second and final preview release for the current development sprint. YUI 3.7.0pr2 is now available to the developer community for feedback and testing on the [Yahoo! CDN](http://yui.yahooapis.com/3.7.0pr2/build/yui/yui-min.js "YUI 3.7.0pr2 seed file") (and as a [download](http://yui.zenfs.com/releases/yui3/yui_3.7.0pr2.zip "YUI 3.7.0pr2 Zip distribution")), and our [Staging website](http://stage.yuilibrary.com/) has the updated documentation. To reiterate the importance of testing our preview releases: we rely on your feedback from testing these preview releases in your real world applications, this gives us the final vote of confidence in the stability of the code, beyond what our automated and manual testing provides.

### The Next Production-Ready Release

Next week, on **September 18, 2012**, we will be cutting the next production-ready release of YUI. We are planning for this release to be 3.7.0 GA and be based on what's currently in our [3.x branch](https://github.com/yui/yui3/tree/3.x). If there are any critical issues or breaking changes discovered in 3.7.0pr2 that cannot be resolved before Tuesday, our backup plan is to release 3.6.1 from our [master branch](https://github.com/yui/yui3).

### Recent Changes and New Additions

#### Building with Shifter

**For this release, all modules have been minified using UglifyJS!** We have removed all of the old Ant build files from our 3.x branch, and rebuilt _all_ of our modules using the latest version of [Shifter](http://yui.github.com/shifter/), [our new build tool](/yuiblog/blog/2012/08/27/shifter-fast-yui-module-building/ "Shifter introduction blog post"), which uses [UglifyJS](https://github.com/mishoo/UglifyJS) by default. We've _rigorously_ tested the rebuilt modules on 20+ devices using [Yeti](http://yeti.cx) and have **not** seen any differences with the minified files using UglifyJS compared to YUI Compressor, besides being ~5% smaller in file size. If you notice something not working right with the new minified files, please don't hesitate to **[file a ticket](http://yuilibrary.com/projects/yui3/newticket/)**.

#### Graphics and Charts

A bunch of lower-level work has went into Graphics and Charts recently, and we are encouraging anyone who's using the Graphics library, and/or Charts to test 3.7.0pr2 in their applications.

##### Recent Enhancements to Graphics

-   The ability to scale the contents of a graphic to its parent container using `autoSize` and `preserveAspectRatio` attributes.
-   The addition of `toFront()` and `toBack()` methods for managing a shape's depth.
-   The ability to animate `fill` and `stroke` attributes using the newly created `shape-anim` submodule. The submodule also allows for animating transforms (formally `anim-shape-transform`).
-   The introduction of a data attribute which accepts SVG path data. Graphics does not currently perform all possible SVG drawing methods. These will be added in a subsequent release and are documented in tickets: [#2532735](http://yuilibrary.com/projects/yui3/ticket/2532735) and [#2532470](http://yuilibrary.com/projects/yui3/ticket/2532470).

#### Gesture Events Supported in IE 10

Gestures (`event-flick` and `event-move`) are now supported on IE 10 (Windows 8 tablets and desktops), and they feel pretty snappy too!

#### Tap Event

We have graduated [Michael Matuzak's](https://github.com/emkay) [`gallery-tap`](http://yuilibrary.com/gallery/show/tap) module to the YUI core module: [`event-tap`](http://stage.yuilibrary.com/yui/docs/api/modules/event-tap.html). The `"tap"` event normalizes user interactions across touch and mouse or pointer based input devices. This can be used by developers to build input device agnostic components which behave the same in response to either touch or mouse based interaction. On a touchscreen, `"tap"` is like `"click"`, only it requires much less finger-down time since it listens to touch events, but reverts to mouse events if touch is not supported. Thanks to Andres Garza and Christopher Bartz for the original implementation, and Michael for the gallery module!

#### ScrollInfo Node Plugin

[Ryan Grove's](https://github.com/rgrove) [`node-scroll-info` plugin](http://stage.yuilibrary.com/yui/docs/api/modules/node-scroll-info.html) is now available. This `Y.Node` plugin provides convenient events and methods related to scrolling. This could be used, for example, to implement infinite scrolling, or to lazy-load content based on the current scroll position. Ryan extracted this module from his work on improving the infinite scrolling on SmugMug's search results page and contributed back to YUI. You can read more about how this module is used in his post: [Speeding Up SmugMug's Search](http://sorcery.smugmug.com/2012/08/09/speeding-up-smugmug-search/).

### What to Continue Testing

#### ScrollView Refactoring

Our preview release process has been very helpful to ScrollView's refactoring, as you've helped [identify](http://yuilibrary.com/projects/yui3/ticket/2532732) [some](http://yuilibrary.com/projects/yui3/ticket/2532742) [bugs](http://yuilibrary.com/projects/yui3/ticket/2532739) introduced in 3.7.0pr1. After reviewing the [ScrollView changes in 3.7.0pr1](/yuiblog/blog/2012/08/31/yui-3-7-0pr1-event-performance/ "YUI 3.7.0pr1 Blog post"), the following the larger changes introduced in this preview release:

-   Smoother flick animations
-   When using multiple ScrollView instances on a page, you now have the ability to adjust per-animation and drag physics per instance.
-   ScrollView and its Paginator plugin now support an `axis` attribute. When possible, it’s best to define each of these `axis` attributes.

#### Event Performance

The work that has gone into improving event performance is just the beginning; you can expect more performance tweaks for events as we move into the next development sprint. The next area we wanted to focus on is to reduce the amount of code we execute for the non-bubbling, non-broadcasting, no-subscribers use case. To stay up to date with the ongoing event performance changes and benchmark numbers, **CC yourself on [Ticket #2532411](http://yuilibrary.com/projects/yui3/ticket/2532411)**.

#### App Framework Additions

The two major additions to the App Framework for 3.7.0, server rendered views support and route-specific middleware, appear to be very solid and useful to people. These will be the only major changes to the App Framework for 3.7.0, as the [other planned changes](/yuiblog/blog/2012/08/31/yui-3-7-0pr1-event-performance/ "YUI 3.7.0pr1 Blog post") will happen in the next development sprint.

#### Happy Testing!

For a complete list of changes since 3.6.0, please refer to the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.7.0-Change-History-Rollup) for this release. If you find a bug, or want to suggest an enhancement, please don't hesitate to [file a ticket](http://yuilibrary.com/projects/yui3/newticket/). **Thanks, and happy testing!**