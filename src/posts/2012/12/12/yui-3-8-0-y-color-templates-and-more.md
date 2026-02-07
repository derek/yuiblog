---
layout: layouts/post.njk
title: "YUI 3.8.0 - Y.Color, Templates, and more!"
author: "Andrew Wooldridge"
date: 2012-12-12
slug: "yui-3-8-0-y-color-templates-and-more"
permalink: /2012/12/12/yui-3-8-0-y-color-templates-and-more/
categories:
  - "Releases"
  - "Development"
---
We are pleased to announce the availability of **YUI 3.8.0**. It is available via [Yahoo! CDN](http://yui.yahooapis.com/3.8.0/build/yui/yui-min.js) (or [download](http://yui.zenfs.com/releases/yui3/yui_3.8.0.zip)) and on [npm](https://npmjs.org/package/yui). We have also updated our [website](http://yuilibrary.com/) to reflect the changes and new features of 3.8.0. The highlights of this release are listed below, inspired by the [original 3.8.0pr1 announcement](/yuiblog/blog/2012/11/07/yui-3-8-0pr1-template-and-color-utilities/) from [Eric Ferraiuolo](https://twitter.com/ericf).

### Y.Color

With this release we have a [new utility](http://yuilibrary.com/yui/docs/color/) called `Y.Color` which has been elevated from a DOM helper sub-module and expanded in features. This project is led by [Anthony Pipkin](https://twitter.com/apipkin) who explains the reasoning behind this [change](https://github.com/yui/yui3/pull/236):

> "Working on Color brought its share of challenges, but was very exciting to work on. The main objective with Color was to address color conversion between hexadecimal, RGB, and HSL color spaces. There was an undocumented hexadecimal and RGB conversion utility in YUI3 under DOM, but we needed to surface this utility and add documentation along with a few useful examples. Another focus for Color in this release was a set of color harmony methods to be used in the [new widget skinning tool (Skinner)](http://jconniff.github.com/skinner/)."

`Y.Color` has methods to allow conversion between hexadecimal, RGB, HSV, and HSL color values. HSL and HSV conversion methods are provided by [sub-modules](http://yuilibrary.com/yui/docs/api/modules/color.html), this way you only have to load the modules you need.

We created the Color utility to be extensible. New color models can be defined by providing a regex for matching, a string template, and any conversion methods.

An exciting feature of the Color utility is the support for color theory, which is provided by the `[color-harmony](http://yuilibrary.com/yui/docs/api/classes/Color.Harmony.html)` module. These [features](http://yuilibrary.com/yui/docs/color/#harmony) enable you to match one color to another color’s perceived brightness, get similar colors to one that’s supplied within a certain range, find complementary colors, etc.

Check out the websites demos: '[RGB Slider](http://yuilibrary.com/yui/docs/color/rgb-slider.html)', '[HSL Color Picker](http://yuilibrary.com/yui/docs/color/hsl-picker.html)', '[HSL Harmony](http://yuilibrary.com/yui/docs/color/hsl-harmony.html)', and Jeff Conniff's '[Skinner Demo](http://jconniff.github.com/skinner/)'.

### Template and Template.Micro

[Ryan Grove](https://github.com/rgrove) has [contributed](https://github.com/yui/yui3/pull/230) new [templating utilities](http://yuilibrary.com/yui/docs/template/) to YUI. [`Y.Template`](http://yuilibrary.com/yui/docs/api/classes/Template.html) is a class which provides a generic template engine API, and [`Y.Template.Micro`](http://yuilibrary.com/yui/docs/api/classes/Template.Micro.html) is a static class which provides a simple micro-templating engine. `Y.Template` can be used to compile, precompile, render, and revive precompiled templates using Handlebars or `Y.Template.Micro`.

Ryan explains the origin of these templating utilities:

> "While working on a new widget recently, I found myself wanting a string-based templating solution that was more advanced than `Y.Lang.sub()` or `Y.substitute()`, but without the overhead of `Y.Handlebars`. I needed support for interpolation, if/else branching, and looping, but only for a few very small templates. Underscore-style templates (more familiar as ERB-style templates to Rubyists) seemed like exactly the right fit."

`Y.Template.Micro` is a string-based micro-templating language similar to [ERB](http://ruby-doc.org/stdlib-1.9.3/libdoc/erb/rdoc/ERB.html) and [Underscore](http://underscorejs.org/#template) templates. Template.Micro is great for small, powerful templates, and its compilation engine is _extremely_ fast with a small footprint.

Compared with the features of Handlebars, Template.Micro is much simpler. Using the generic engine API provided by `Y.Template`, Micro and Handlebars templates can be used interchangeably. This gives you a powerful way to customize a component's Handlebars templates by overriding them with Micro templates, and not incur the cost of loading the `handlebars-compiler` module (which is 9KB minified and gzipped).

### Attribute and Base Observability Refactoring

Back in [YUI 3.5.0](/yuiblog/blog/2012/04/10/announcing-yui-3-5-0/), the features of `Y.Attribute` were extracted out into smaller sub-components, each with a single reasonability: `Y.AttributeCore`, `Y.AttributeEvents`, `Y.AttributeExtras`. `Y.Attribute` was then redefined using these parts. At that time we also did a similar refactoring of `Y.Base` and extracted `Y.BaseCore`, a base class sans events.

Today we are codifying the concept of "**observability**" at the [Attribute](http://yuilibrary.com/yui/docs/api/modules/attribute.html) and [Base](http://yuilibrary.com/yui/docs/api/modules/base.html) levels. Instead of using the description "_has_ events", we're now referring to a component's qualities, i.e., "_is_ observable". This distinction is a better match for how [`Y.AttributeObservable`](http://yuilibrary.com/yui/docs/api/classes/AttributeObservable.html) (formerly `Y.AttributeEvents`) and the new [`Y.BaseObservable`](http://yuilibrary.com/yui/docs/api/classes/BaseObservable.html) class extension are used and applied.

Certain components in your app will benefit from the ability to have their lifecycles and attribute changes observed by other parts of the system, but other components will incur an unnecessary overhead and don't require these abilities.

This refactoring, combined with updates to `Y.Base.create/mix()` which allow it to be used with `Y.BaseCore` (and BaseCore subclasses), means that **observability** can be added to class at any time by mixing in the new `Y.BaseObservable` extension.

Work is [continuing](http://yuilibrary.com/projects/yui3/report/143) on Attribute and Base performance. Look for more improvements in upcoming [releases](https://github.com/yui/yui3/wiki/Development-Schedule).

### ScrollView Enhancements

[ScrollView](http://yuilibrary.com/yui/docs/scrollview/) has received minor enhancements for this release, including fixes for a couple [pagination](http://yuilibrary.com/projects/yui3/ticket/2532815) [bugs](http://yuilibrary.com/projects/yui3/ticket/2532745). This release returns the pagination features back to the pre-3.7.0 behavior, which requires a distance threshold of at least 50% to trigger moving to the next "page".

A special thanks to [Juan Dopazo](https://github.com/juandopazo) for [contributing](https://github.com/yui/yui3/pull/274) a fix for ScrollViewPaginator's `scrollToIndex()` method, which now properly respects animation duration and easing options.

### Other Changes

While describing every change in this release would take quite some time, there are a few other updates worth noting:

-   In [App Framework](http://yuilibrary.com/yui/docs/app/), a minor [fix](http://yuilibrary.com/projects/yui3/ticket/2532941) to decode URL-encoded path matches for Router's `req.params`.
-   In Cookie, a [fix](https://github.com/yui/yui3/pull/248) to make the order of cookie loading with the same name configurable.
-   In [Pjax](http://yuilibrary.com/yui/docs/pjax/), [fixed](https://github.com/yui/yui3/pull/336) an issue where Pjax would throw an error because of calling methods on `null` nodes when and IO request was aborted (which happens to pending requests when a new request comes in).
-   In [Charts](http://yuilibrary.com/yui/docs/charts/), [stonebk](https://github.com/stonebk) contributed a [fix](https://github.com/yui/yui3/pull/344) for an issue when click events were not firing on elements outside of chart in ios.

Check out the [Change History](https://github.com/yui/yui3/wiki/YUI-3.8.0-Change-History-Rollup) for more details on this release.

### New and Improving Tools

Finally, there are a number of new tools in development around this time that you should check out:

-   [Skinner](https://github.com/jconniff/skinner) uses `Y.Color` to [build customizable](http://jconniff.github.com/skinner/) skins for YUI. Recent updates include improvements in text readability, visually richer gradients, vendor specific CSS for gradients, and the ability to render Sam and Night skins!
-   `[yogi](https://github.com/yui/yogi)` not only allows you to [build and test](http://yui.github.com/yogi/) files for YUI, but also allows you to build, create, and test [Gallery](http://yui.github.com/yogi/gallery/index.html) components, even in your own repo!
-   [Grid Builder](http://github.com/yui/gridbuilder) allows you to [rapidly create](http://yui.github.com/gridbuilder/) responsive YUI3 Grids. It's now a YUI project on GitHub so feel free to submit pull requests, request features, or post any issues that you may be having. Recent changes include the ability to directly edit the values of the media queries for custom sizes, [improved documentation](http://yui.github.com/gridbuilder/docs.html), and a [new example](http://yui.github.com/gridbuilder/examples/magazine/).