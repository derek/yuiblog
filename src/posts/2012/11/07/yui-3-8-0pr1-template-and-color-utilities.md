---
layout: layouts/post.njk
title: "YUI 3.8.0pr1 - Template and Color Utilities"
author: "Eric Ferraiuolo"
date: 2012-11-07
slug: "yui-3-8-0pr1-template-and-color-utilities"
permalink: /blog/2012/11/07/yui-3-8-0pr1-template-and-color-utilities/
categories:
  - "Releases"
---
**YUI 3.8.0pr1** is now available to the developer community for feedback and testing on the [Yahoo! CDN](http://yui.yahooapis.com/3.8.0pr1/build/yui/yui-min.js "YUI 3.8.0pr1 seed file") (and as a [download](http://yui.zenfs.com/releases/yui3/yui_3.8.0pr1.zip "YUI 3.8.0pr1 zip distribution")), on [npm](https://npmjs.org/package/yui "Node.js Packaged Module"), and our [Staging website](http://stage.yuilibrary.com/) has the updated documentation.

The current development sprint ends this Friday, at which time we’ll be feature complete on the next YUI release. We are on track for this next stable release to be 3.8.0, and the release is [scheduled](https://github.com/yui/yui3/wiki/Development-Schedule) for **December 4, 2012.**

### Introducing Template and Template.Micro Utilities

[Ryan Grove](https://github.com/rgrove) has [contributed](https://github.com/yui/yui3/pull/230) new [templating utilities](http://stage.yuilibrary.com/yui/docs/template/) to YUI. [`Y.Template`](http://stage.yuilibrary.com/yui/docs/api/classes/Template.html) is a class which provides a generic template engine API, and [`Y.Template.Micro`](http://stage.yuilibrary.com/yui/docs/api/classes/Template.Micro.html), a static class which provides a simple micro-templating engine. `Y.Template` can be used to compile, precompile, render, and revive precompiled templates using Handlebars or `Y.Template.Micro`.

Ryan describes why there was a need for these templating utilities:

> “While working on a new widget recently, I found myself wanting a string-based templating solution that was more advanced than `Y.Lang.sub()` or `Y.substitute()`, but without the overhead of `Y.Handlebars`. I needed support for interpolation, if/else branching, and looping, but only for a few very small templates. Underscore-style templates (more familiar as ERB-style templates to Rubyists) seemed like exactly the right fit.”

`Y.Template.Micro` is a string-based micro-templating language similar to [ERB](http://ruby-doc.org/stdlib-1.9.3/libdoc/erb/rdoc/ERB.html) and [Underscore](http://underscorejs.org/#template) templates. Template.Micro is great for small, powerful templates, and its compilation engine is _extremely_ fast with a small footprint.

Compared with the features of Handlebars, Template.Micro is much simpler. Using the generic engine API provided by `Y.Template`, Micro and Handlebars templates can be used interchangeably. This gives you a powerful way to customize a component’s Handlebars templates by overriding them with Micro templates, and not incur the cost of loading the `handlebars-compiler` module (which is 9KB minified and gzipped).

### Introducing Color Utilities

Color utilities have been available in YUI for quite some time, but they were hidden in a DOM helper submodule which was never publicly documented. We are changing this today by exposing the new [`Y.Color` utility](http://stage.yuilibrary.com/yui/docs/color/)!

`Y.Color` provides methods which enable conversion between hexadecimal, RGB, HSL, and HSV color models. HSL and HSV conversion methods are provided by [submodules](http://stage.yuilibrary.com/yui/docs/api/modules/color.html), this way you only have to load the modules you need.

We created the Color utilities to be extensible. New color models can be defined by providing a RegEx for matching, a string template, and any conversion methods.

An exciting feature of the Color utilities is the support for color theory, which is provided by the [`color-harmony`](http://stage.yuilibrary.com/yui/docs/api/classes/Color.Harmony.html) module. These features enable you to match one color to another color’s perceived brightness, get similar colors to one that’s supplied within a certain range, find complementary colors, etc. We have some [great examples](http://stage.yuilibrary.com/yui/docs/color/hsl-harmony.html) showing off these new color utilities, be sure to check them out!

Having a robust color utilities will allow us (the YUI community included) to create new modules and features such as a color picker widget. Taking it a step further, we’ll be able to use these color utilities to _greatly_ improve YUI skinning. Stay tuned for more on that soon :)

### Attribute and Base Observability Refactoring

Back in YUI 3.5.0, the features of `Y.Attribute` were extracted-out into smaller sub-components, each with a single reasonability: `Y.AttributeCore`, `Y.AttributeEvents`, `Y.AttributeExtras`. `Y.Attribute` was then redefined using these parts. At that time we also did a similar refactoring of `Y.Base` and extracted `Y.BaseCore`, a base class sans events.

Today we are codifying the concept of “observability” at the [Attribute](http://stage.yuilibrary.com/yui/docs/api/modules/attribute.html) and [Base](http://stage.yuilibrary.com/yui/docs/api/modules/base.html) levels. Instead of using the description “_has_ events”, we’re now referring to a components qualities, i.e., “_is_ observable”. This distinction is a better match for how [`Y.AttributeObservable`](http://stage.yuilibrary.com/yui/docs/api/classes/AttributeObservable.html) (formerly `Y.AttributeEvents`), and the new [`Y.BaseObservable`](http://stage.yuilibrary.com/yui/docs/api/classes/BaseObservable.html) class extension are used and applied.

Certain components in your app will benefit from the ability to have their lifecycles and attribute changes observed to other parts of the system, but other components will incur an unnecessary overhead and don’t require these abilities.

This refactoring combined with updates to `Y.Base.create/mix()` which allow it to be used with `Y.BaseCore` (and BaseCore subclasses), means that observability can be added to class at any time by mixing in the new `Y.BaseObservable` extension.

Stay tuned for [continued work](http://yuilibrary.com/projects/yui3/report/143) on Attribute and Base performance in the next major YUI release after 3.8.0.

### ScrollView Enhancements

ScrollView has received minor enhancements for this preview release, including fixes for a couple [pagination](http://yuilibrary.com/projects/yui3/ticket/2532815) [bugs](http://yuilibrary.com/projects/yui3/ticket/2532745). This returns the pagination features back to the pre–3.7.0 behavior, which requires a distance threshold of at least 50% to trigger moving to the next “page”.

A special thanks to [Juan Dopazo](https://github.com/juandopazo) for [contributing](https://github.com/yui/yui3/pull/274) a fix for ScrollViewPaginator’s `scrollToIndex()` method, which now properly respects animation duration and easing options.

### Happy Testing!

For a complete list of changes in 3.8.0pr1, please refer to the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.8.0-Change-History-Rollup) for this release.

We rely on your feedback from testing these preview releases in your real world apps to give us the final vote of confidence in the stability of the code, beyond what our automated and manual testing provides. If you find a bug, or want to suggest an enhancement, please don’t hesitate to [file a ticket](http://yuilibrary.com/projects/yui3/newticket/). **Thanks, and happy testing!**