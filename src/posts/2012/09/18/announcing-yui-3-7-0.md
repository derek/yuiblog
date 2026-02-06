---
layout: layouts/post.njk
title: "Announcing YUI 3.7.0"
author: "Andrew Wooldridge"
date: 2012-09-18
slug: "announcing-yui-3-7-0"
permalink: /2012/09/18/announcing-yui-3-7-0/
categories:
  - "Releases"
---
**NOTE: Be sure to [update to the latest patch release](/yuiblog/blog/2012/09/24/yui-3-7-2-patch-release/): 3.7.2**

We are happy to announce the release of YUI 3.7.0, now available on [CDN](http://yui.yahooapis.com/3.7.0/build/yui/yui-min.js) or as a [download](http://yui.zenfs.com/releases/yui3/yui_3.7.0.zip). The documentation on the [website](http://yuilibrary.com/) has been updated as well! Releases will be coming more often now, as we transition to a [shorter release cycle](https://github.com/yui/yui3/wiki/Development-Schedule). Highlights for this release are:

-   Significant performance improvements (up to 3x!) in [Event](http://yuilibrary.com/yui/docs/event/) through both runtime and memory optimizations. More details in our [previous blog post](/yuiblog/blog/2012/08/31/yui-3-7-0pr1-event-performance/).
    
-   [ScrollView](http://yuilibrary.com/yui/docs/scrollview/) has undergone a major refactoring and includes new features such as Forced-Axis, Dual-Axis, and Right-To-Left support. For more details view the [release notes](https://gist.github.com/3745807).
    
-   The [App Framework](http://yuilibrary.com/yui/docs/app/) has some additional features, including Server Rendered Views support, and Route Specific Middleware for [Router](http://yuilibrary.com/yui/docs/router/#chaining-routes-and-middleware).
    
-   All of our builds now take advantage of [Shifter](http://yui.github.com/shifter/) and [UglifyJS](https://github.com/mishoo/UglifyJS) (all rigorously tested via [Yeti](http://yeti.cx/)).
    
-   [Graphics](http://yuilibrary.com/yui/docs/graphics/) and [Charts](http://yuilibrary.com/yui/docs/charts/) have undergone low level improvements, including the ability to scale the contents of a Graphic to its parent container, the addition of `toFront()` and `toBack()` to manage a shape's depth, the ability to animate `fill` and `stroke` attributes and the introduction of a data attribute which accepts SVG data
    
-   Gestures `[event-flick](http://yuilibrary.com/yui/docs/api/modules/event-flick.html)` and `[event-move](http://yuilibrary.com/yui/docs/api/modules/event-move.html)` now take advantage of MSPointer events.
    
-   We have graduated [Michael Matuzak](https://github.com/emkay)'s [`gallery-tap`](http://yuilibrary.com/gallery/show/tap) module to the YUI core module: [`event-tap`](http://yuilibrary.com/yui/docs/api/modules/event-tap.html). Thanks to Andres Garza for the original implementation.
    
-   [Ryan Grove](https://github.com/rgrove)'s [`node-scroll-info` plugin](http://yuilibrary.com/yui/docs/api/modules/node-scroll-info.html) is now available. This `Y.Node` plugin provides convenient events and methods related to scrolling.
    
-   In the [DataType](http://yuilibrary.com/yui/docs/datatype/) utility `DataType.Date.Locale`, which has been deprecated for a number of releases, has now been removed. `DataType.Date`, `DataType.Number` and `DataType.XML` have been renamed to `Y.Date`, `Y.Number` and `Y.XML`, but the `DataType.*` aliases have been retained for backwards compatibility.
    

Many [issues have been addressed](http://yuilibrary.com/projects/yui3/report/136) since 3.6.0. You can checkout the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.7.0-Change-History-Rollup) for all the components in the library. We invite you to join the [ongoing development discussions](https://github.com/yui/yui3/wiki/Ongoing-Development-Discussions) happening with the team over on GitHub. For support, visit our [forums](http://yuilibrary.com/forum/), or join other YUI developers live in the #yui channel on irc.freenode.net (a web client is [here](http://webchat.freenode.net/?channels=yui)).