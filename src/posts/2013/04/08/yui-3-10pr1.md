---
layout: layouts/post.njk
title: "YUI 3.10pr1"
author: "YUI Team"
date: 2013-04-08
slug: "yui-3-10pr1"
permalink: /blog/2013/04/08/yui-3-10pr1/
categories:
  - "Releases"
---
We are pleased to announce the arrival of **YUI 3.10pr1** today. It is available via [Yahoo! CDN](http://yui.yahooapis.com/3.10.0pr1/build/yui/yui-min.js), an archived [download](http://yui.zenfs.com/releases/yui3/yui_3.10.0pr1.zip), or on [npm](https://npmjs.org/package/yui). Our YUI Library [staging website](http://stage.yuilibrary.com/) has also been updated to reflect the changes in this release. **Please take note of the [testing advisory](#testing) below.**

## What's New in This Release?

We have been hard at work for a while now on some deep changes to YUI that dramatically improve performance. This preview release includes the results of this performance work. Also included in this release is the new `grunt`\-based build system that [Dav Glass](https://github.com/davglass) has been working on. Ryan Grove has included some improvements to `Y.Tree` as well.

### Attribute and Base Performance Improvements

On Chrome 25, compared to 3.8.1, we're seeing the following improvements (numbers in ops/sec):

| Benchmark | 3.8.1 | 3.10pr1 | x Change |
| --- | --- | --- | --- |
| new BaseCore() | 51,871 | 153,532 | 3 |
| new MyBaseCore() \[extends BaseCore\] | 51,980 | 140,016 | 3 |
| MyBaseCore with 10 simple value attributes | 20,535 | 45,541 | 2 |
| MyBaseCore with 20 varied attributes (using perf. best practices) | 11,699 | 19,153 | 2 |
| MyBaseCore with 10 simple value attributes - set() | 799,081 | 2,239,983 | 3 |
| MyBaseCore with 10 simple value attributes - get() | 2,527,214 | 10,424,878 | 4 |

When combined with the work in [CustomEvent and EventTarget](https://github.com/yui/yui3/pull/572) (see below) , we're seeing:

| Benchmark | 3.8.1 | 3.10pr1 | x Change |
| --- | --- | --- | --- |
| new Base() | 13,696 | 48,067 | 4 |
| base.set() | 74,202 | 332,063 | 4 |
| base.get() | 2,330,865 | 10,810,890 | 5 |

[`AttributeCore`](http://yuilibrary.com/yui/docs/api/classes/AttributeCore.html) and [`BaseCore`](http://yuilibrary.com/yui/docs/api/classes/BaseCore.html) have seen dramatic performance improvements. These in turn improve `Attribute` and `Base` which many components depend upon, including custom components. One of the key performance changes introduced this PR is the caching of the static `ATTRS` aggregation which occurs when you instantiate a `Base`\-based object. Before this change, YUI would re-aggregate `ATTRS` for every instance created, resulting in about 1/3 of the time required for `Base` instantiation. Now for the second instance onwards, YUI re-uses the cached aggregation improving performance substantially. **Note** however, as a result of this change, if you touch the `ATTRS` collection on a 'class' directly there's the potential for breakage (this is a rare case). The cache won't know about your modifications if they come in after the first instance of the class is created. If you have such code in your custom components, it will need to use the new `modifyAttrs()` static method. For more details see `Base`'s [HISTORY.md](https://github.com/yui/yui3/blob/dev-3.x/src/base/HISTORY.md).

### CustomEvent and EventTarget Performance Improvements

On Chrome 25, compared to 3.8.1, we're seeing the following improvements:

| Benchmark | 3.8.1 | 3.10pr1 | x Change |
| --- | --- | --- | --- |
| Low-level Publish (over regular publish) | \- | 1,404,890 | 5 |
| Publish | 261,855 | 531,777 | 2 |
| Fire With Payload - 10 listeners | 146,386 | 275,239 | 2 |
| Fire - 10 listeners | 176,905 | 347,636 | 2 |
| Fire With Payload - 2 listeners | 160,905 | 351,084 | 2 |
| Fire - 2 listeners | 209,820 | 671,328 | 3 |
| Fire With Payload - 0 listeners | 835,323 | 4,791,071 | 6 |
| Fire - 0 listeners | 839,048 | 5,139,582 | 6 |
| EventTarget Construction + Publish(foo) + Fire(foo) - no listeners | 104,124 | 306,288 | 3 |

Another set of optimizations focus on `CustomEvent` and `EventTarget`, primarily for the 'no listeners' code path but also for custom events in general. The goal for these changes was to improve `new Base()` times. `Base` publishes and fires 2 events (`init` and `initalizedChange`) during construction, which for the 80% case do not have listeners. The theme for this set of changes was to do the following:

-   Try to fast-path common usage.
-   Try to avoid the cost of the 20% features on the 80% path.

For more details, take a look at the [HISTORY.md](https://github.com/yui/yui3/blob/dev-3.x/src/event-custom/HISTORY.md) for `event-custom`.

Algorithmic development and testing was done on Chrome for both sets of performance improvements above, but micro-optimizations for each specific browser were tested with [jsperf](http://jsperf.com/) across all browsers. The "x Change" that is presented in the data above was also tested across browsers and shown to exist beyond Chrome. YUI Developer Derek Gathright ([@derek](https://twitter.com/derek)) posted some [performance numbers](https://gist.github.com/derek/5321971) using his new YUI Benchmark tool.

### Y.Tree Improvements

Ryan Grove ([@yaypie](https://twitter.com/yaypie)) has added an extension to [`Y.Tree`](http://yuilibrary.com/yui/docs/tree/) called [`Tree.Sortable`](http://stage.yuilibrary.com/yui/docs/api/classes/Tree.Sortable.html) which can be mixed into any Tree class to provide customizable sorting logic for nodes. He has also added `findNode()`,`find()`, `traverseNode()`, and `traverse()` methods to assist with building extensions for `Y.Tree`. For more details, check out the [HISTORY.md](https://github.com/yui/yui3/blob/v3.10.0pr1/src/tree/HISTORY.md) entry.

### Using grunt for Release Builds

Dav Glass ([@davglass](https://twitter.com/davglass)) has converted the build system over to using [`grunt`](http://gruntjs.com/). Both dev and release builds are now done using this task runner, which has been a frequently requested feature for some time now. `grunt` also integrates with [`yogi`](https://github.com/yui/yogi) to allow you to run both tests and builds. Dav [solicited feedback](https://groups.google.com/forum/?fromgroups=&hl=en#!topic/yui-contrib/5UW-lfBU5sE) from the community via our 'yui-contrib' mailing list and received responses that helped him make the best decision. This is a great example of a YUI developer making use of our [Contributor Mailing List](https://groups.google.com/forum/?fromgroups=#!forum/yui-contrib) and [Contributor Model](https://github.com/yui/yui3/wiki/Contributor-Model) in making changes for the better. If you want more details on how to use `grunt`, please take a look at the new [BUILD.md](https://github.com/yui/yui3/blob/v3.10.0pr1/BUILD.md) file included in this release. Also, if you want to develop for YUI we encourage you to join the mailing list to keep up with the latest. Check out the Contributor Model to learn how additions and improvements are integrated into the project.

### And More!

You can find the complete list of changes for this release on [GitHub](https://github.com/yui/yui3/compare/v3.9.1...v3.10.0pr1). We had a total of **214** commits by **11** authors since YUI 3.9.1. Also note that Luke Smith ([@ls\_n](https://twitter.com/ls_n)) recently updated the user guide for [Y.Promise](http://yuilibrary.com/yui/docs/promise/) so check that out as well.

### A Call for Deep Testing

Given that these performance improvements have a broad impact across many YUI components, we recommend that you take this preview release and try it out in a staging environment with your own applications. **It is vital that we hear about any issues you may run into so that we can fix them in a timely manner before the full 3.10 release.** Please take note of the [potential change](#attrs) you may need to make to your custom code if you modify your `ATTRS` class directly after the first instantiation. If you do run into an issue, please [file a ticket](http://yuilibrary.com/projects/yui3/newticket/).