---
layout: layouts/post.njk
title: "YUI 3.7.0pr1 - Event Performance"
author: "Eric Ferraiuolo"
date: 2012-08-31
slug: "yui-3-7-0pr1-event-performance"
permalink: /2012/08/31/yui-3-7-0pr1-event-performance/
categories:
  - "Performance"
  - "Releases"
---
We've previously mentioned our plans to move to a more rapid release cycle for YUI, and now the work we put into automating our unit and functional testing in 3.6.0 is making that possible. YUI 3.7.0pr1 is now available to the developer community for feedback and testing on the [Yahoo! CDN](http://yui.yahooapis.com/3.7.0pr1/build/yui/yui-min.js "YUI 3.7.0pr1 seed file") (and as a [download](http://yui.zenfs.com/releases/yui3/yui_3.7.0pr1.zip "YUI 3.7.0pr1 Zip distribution")), and our [Staging website](http://stage.yuilibrary.com/) has the updated documentation.

With our new release cycle, we plan to release a production-ready version of YUI at the end of each development sprint (which usually lasts one month.) The version number of a release will depend on its contents. 3.7.0pr1 is a preview release which was cut from our [3.x branch](https://github.com/yui/yui3/tree/3.x "YUI's 3.x branch on GitHub"), and we rely on your feedback and testing to help us determine if 3.7.0 will be the next production-ready release of YUI. Otherwise, we'll end up cutting 3.6.1 from our master branch and releasing it at the end of the current development sprint.

### Event Performance

The main focus for this preview release is to get our low level custom event performance work in your hands so it can be rigorously tested in real world applications. Based on our benchmarks, we are seeing up to a **3x improvement in custom event performance!**

To stay up to date with ongoing event performance work, **CC yourself on [Ticket #2532411](http://yuilibrary.com/projects/yui3/ticket/2532411 "YUI Ticket with details of ongoing event performance work")**.

#### Results

Some of the benchmark numbers on Chrome 21/MacOS, are shown below:

| Benchmark Description | YUI 3.6.0 | YUI 3.7.0pr1 |
| --- | --- | --- |
| Fire with Payload - no listeners | **34,412** ops/sec | **66,432** ops/sec |
| Fire with Payload - 2 listeners | **30,030** ops/sec | **62,484** ops/sec |
| Publish (with attribute event config) | **129,728** ops/sec | **371,997** ops/sec |

The benchmark tests can be found in [`src/event-custom/tests/benchmark/`](https://github.com/yui/yui3/tree/3.x/src/event-custom/tests/benchmark) on the 3.x branch.

In addition to the above benchmark tests, we've also created a [jsPerf benchmark](http://jsperf.com/yui-basecore-vs-base/2) to compare the initialization of BaseCore, Base, and Model in YUI 3.6.0 vs. 3.7.0pr1. The results show a noticeable improvement and that we have room to make the initialization of these classes even faster.

#### Runtime Optimizations

-   Event subscribers are now stored in arrays, as opposed to hashes. The `subscribers` and `afters` `Y.CustomEvent` instance properties have been deprecated, and replaced with private arrays.
    
    If you're referring to the `subscribers` or `afters` properties directly, you can set the `Y.CustomEvent.keepDeprecatedSubs` to `true`, to restore them, but you will incur a performance hit in doing so. The rest of the CustomEvent API is driven by the new private arrays.
    
    If you are using the above properties directly, please [file an enhancement request](http://yuilibrary.com/projects/yui3/newticket/) and we'll provide a public way to achieve the same results, without the performance hit, before we remove the properties permanently.
    
-   Avoid creating a new EventTarget during fire, if `stoppedFn` is not used.
    
-   Optimized mixing during the creation of a `CustomEvent` object.
    
-   Optimized mixing done on the facade, during a `fire()` with a payload.
    

The following commits have more details on the specific changes in their commit messages:

-   [e7415e71de](https://github.com/yui/yui3/commit/e7415e71de) - subscribers/afters fix.
-   [29f63996f8](https://github.com/yui/yui3/commit/29f63996f8) - optimized payload mix fix.

#### Memory Optimizations

Fixed `_facade` and `firedWith` which were holding onto a reference to the last fired event facade. Now `_facade` is reset to `null` after the fire sequence, and `firedWith` is only maintained for `fireOnce` CustomEvents.

This allows the facade from the last fired event to be garbage collected whereas prior to this change it wasn't.

#### Ongoing Work

This is just the beginning of our event performance work; you can expect more performance tweaks for events as we continue this development sprint. The next area we wanted to focus on is to reduce the amount of code we execute for the non-bubbling, non-broadcasting, no-subscribers use case. To stay up to date with the ongoing event performance changes and benchmark numbers, **CC yourself on [Ticket #2532411](http://yuilibrary.com/projects/yui3/ticket/2532411 "YUI Ticket with details of ongoing event performance work")**.

### ScrollView Improvements

ScrollView has undergone a major refactoring, and this release introduces a number of new features and bug fixes.

#### Forced-Axis and Dual-Axis Support

ScrollView now has an optional `axis` property that can be declared with values: `"x"`, `"y"`, or `"xy"`. If unspecified, ScrollView will attempt to auto-detect which axis is intended to be scrolled based on the overflow of its content (as it previously did.) By specifying `"xy"`, ScrollView is now able to scroll on both axes (though not at the same time.) This eliminates most needs for nested ScrollViews to accomplish dual-axis capability, thus improving performance and maintainability.

#### Right-To-Left (RTL) Support

Initial support has been added for RTL layouts, which is detected from the `direction` attribute of the page's `<html>` element. We are continuing to work on RTL support, so please [report any bugs](http://yuilibrary.com/projects/yui3/newticket) you encounter.

#### Bug Fixes

-   Improved reliability of the `scrollEnd` event. It now only fires once per scrolling sequence, instead of multiple times. This is useful to know when ScrollView's state is steady so you can perform any post-interaction tasks (e.g. DOM updates) without affecting the scrolling performance.
    
-   Fixed the multiple listeners were added for `drag` and `flick` events.
    
-   The `mousewheel` event now properly update the `scrollY` attribute.
    
-   ScrollView Paginator's `scrollTo()` method has been deprecated, use the new `scrollToIndex()` method which properly updates the paginator's `index` attribute.
    
-   Fixed ScrollView Paginator bug where the `scrollview.pages.scrollTo()` method may not actually scroll to the desired "page", or may cause the widget to lock-up.
    

Please refer to [ScrollView's full release notes](https://gist.github.com/3522590) for more specific details.

### App Framework Additions

For the first part of the current development sprint, a couple of new, related features added to [YUI's App Framework](http://yuilibrary.com/yui/docs/app/) suite of components:

#### Server Rendered Views Support

There are certain situations where an app needs to show a view which is not rendered in the browser, instead the content is rendered server side. The [Pjax component](http://yuilibrary.com/yui/docs/pjax/) in YUI was created for this specific use case, but the problem was these pjax content-fetching features were not available to people using `Y.App`. To make these feature available, they were extracted out to the `Y.PjaxContent` class extension, which is used by the new [`Y.App.Content`](http://stage.yuilibrary.com/yui/docs/api/classes/App.Content.html) extension which provide the follow features for working with pre-rendered views:

`showContent()`

Method which provides an easy way to view-ify HTML content which should be shown as an app's active/visible view.

`loadContent()`

Route middleware which loads content from a server. This makes an Ajax request for the requested URL, parses the returned content and puts it on the route's response object.

`Y.App.Content.route`

A stack of middleware which forms a pjax-style content route. This provides a standard convention which uses `loadContent()` and `showContent()` to load and show server rendered content as views for an app.

For more information, refer to the [Server Rendered Views](http://stage.yuilibrary.com/yui/docs/app/#server-rendered-views) section of App's user guide on our Staging website.

#### Route-specific Middleware

In order to support the API we wanted for server-rendered/progressively-enhanced views in `Y.App`, we added support for route-specific middleware to [Router](http://stage.yuilibrary.com/yui/docs/router/). The `route()` method now accepts an arbitrary number of callbacks enabling more reuse of routing code. For people familiar with [Express.js' route middleware](http://expressjs.com/api.html#app.VERB), this behaves the same.

For more information, refer to the [Chaining Routes and Middleware](http://stage.yuilibrary.com/yui/docs/router/#chaining-routes-and-middleware) section of Router's user guide on our Staging website.

#### Planned Changes to App Framework Components

Beyond these changes to the App Framework components, more are slated for the final 3.7.0 release. The items in the [list of high priority App Framework changes](http://yuilibrary.com/projects/yui3/report/132) have a similar theme: breaking features out into class extensions which have a single responsibility. The reasons being to help promote code reuse between components and on the server (in Node.js), which in turn allows more of YUI's App Framework components to be used by and within [Mojito](http://developer.yahoo.com/cocktails/mojito/).

### Happy Testing!

For a complete list of changes in 3.7.0pr1, please refer to the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.7.0-Change-History-Rollup) for this release.

We do these preview releases so you can test them in your applications and give us your feedback. If you find a bug, or want to suggest an enhancement, please don't hesitate to [file a ticket](http://yuilibrary.com/projects/yui3/newticket/). **Thanks, and happy testing!**