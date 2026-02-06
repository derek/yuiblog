---
layout: layouts/post.njk
title: "Introducing the Grid Builder"
author: "YUI Team"
date: 2012-12-21
slug: "introducing-the-grid-builder"
permalink: /2012/12/21/introducing-the-grid-builder/
categories:
  - "Development"
---
![](/yuiblog/blog/wp-content/uploads/2012/12/Screen-Shot-2012-12-20-at-1.42.24-PM.png "gridbuilder")

Today, we're happy to announce that we've shipped YUI's [Responsive Grid Builder](http://yui.github.com/gridbuilder/). We demoed it during YUIConf, and have gotten great feedback from the community over the last few weeks. Let's dig in and see how this little app can make it easier for you to work with YUI Grids.

## Overview

We set out to solve a very specific problem: to make it easier for developers to customize a grid for their own use-case. Grids form the foundation of a web page's layout. They should be easy to work with but shouldn't tie you in to a specific implementation. Yet, a lot of grids do just that - defining widths, media queries, and number of columns that your app should use. We thought that the best way to solve these issues is to create sensible defaults, but allow developers to tweak the parameters as they see fit. We hope this results in a grid system that is less bloated and easier to work with.

## Features

The [Grid Builder](http://yui.github.com/gridbuilder/) allows you to customize various aspects of a grid:

-   Fluid or fixed-width grid
-   Number of columns
-   Alter prefix names ("yui3", "g", and "u")
-   Include responsive behavior
-   Edit Media Queries
-   Offsets

As you toggle these attributes, minified CSS is generated at the bottom of the app, ready for you to copy/paste.

## Responsive Behavior

The Grid Builder adds responsive behavior to the existing YUI Grids rules. This makes it [super-easy](http://yui.github.com/gridbuilder/examples/magazine/) for you to build responsive web pages or web apps.

### Mixing responsive and non-responsive behavior

YUI Responsive Grids builds on top of the existing YUI Grids implementation. It adds a single new class name called `.yui3-g-responsive`. You can use this instead of using `.yui3-g` as you normally do. All elements with a class name of `.yui3-u-*-*` will automatically become responsive if they are direct descendents of a `.yui3-g-responsive`. Images will shrink to fit the viewport, and units will collapse to 100% width when the viewport is 767px or below.

For example, consider the two HTML snippets below. The first gist shows how regular YUI grids are written. These grids are unresponsive. They'll always be one-thirds irrespective of the width of the screen. The second gist replaces the `yui3-g` with `yui3-g-responsive`, thereby making the one-third columns collapse to full width on lower screen widths.

If you want some HTML elements to remain in a grid even on smaller screens, wrap them in the standard `.yui3-g`. Refer to the [Grid Builder docs](http://yui.github.com/gridbuilder/docs.html) for more information and examples.

### Media Queries

By default, the Grid Builder listens to four media queries, but these are all configurable through the user interface.

| Type of Display | Media Query Widths |
| --- | --- |
| Default Displays | 980px and up |
| Large Tablets | 768px to 979px |
| Smaller Tablets and Large Phones | 767px and below |
| Phones | 480px and below |

## It's open source!

We're big believers in shipping and iterating when it comes to tools like the Grid Builder. Check out the [source on Github](http://github.com/yui/gridbuilder), along with the [examples](http://yui.github.com/gridbuilder/examples/magazine/) and [documentation](http://yui.github.com/gridbuilder/docs.html). If you feel like we missed something or notice any bugs, [file an issue](http://github.com/yui/gridbuilder/issues) or (even better), file a pull request!