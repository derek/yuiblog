---
layout: layouts/post.njk
title: "Pure"
author: "Tilo"
date: 2013-05-30
slug: "pure"
permalink: /2013/05/30/pure/
categories:
  - "Releases"
---
[![pure-banner](/yuiblog/blog/wp-content/uploads/2013/05/pure-banner.png)](http://purecss.io/)

Yesterday at CSSConf, we launched [Pure](http://purecss.io) - a new CSS library. Phew! Here are the slides from the presentation:

Although it looks pretty minimalist, we’ve been working on Pure for several months. After many iterations, we have released Pure as a set of small, responsive, CSS modules that you can use in every web project.

You can learn more about Pure on [its homepage](http://purecss.io), or through the [GitHub repo](http://github.com/yui/pure/).

**Pure is 100% CSS**, but as front-end engineers, we don’t only deal with CSS. Much of our time is spent writing JavaScript as well. One of the advantages of Pure is that it doesn’t force you to use a particular JavaScript library. However, we have thought quite a bit about how Pure and YUI can work together now and in the future. Let’s dig into that.

## How It Started

To really understand why we made Pure, let’s talk a bit about how the project was conceived. Looking at YUI, we felt that there was a lot of really useful CSS in our library, but it was tightly coupled with our JavaScript. YUI has historically had [CSS modules](http://yuilibrary.com/yui/docs/guides/) such as [Grids](http://yuilibrary.com/yui/docs/cssgrids/), [Fonts](http://yuilibrary.com/yui/docs/cssfonts/), and [Reset](http://yuilibrary.com/yui/docs/cssreset/), but they aren’t exposed well enough to non-YUI users, making them hard to find unless you explore all of [YUI's components](http://yuilibrary.com/yui/docs/guides/). In addition, we had some really useful CSS for styling widgets such as table CSS for [DataTable](http://yuilibrary.com/yui/docs/datatable/), and menu CSS for [`node-menunav`](http://yuilibrary.com/yui/docs/node-menunav/) (and now SmugMug’s [`Y.Menu`](https://github.com/smugmug/yui-gallery/tree/master/src/sm-menu)). It didn’t make sense to keep this tight coupling between CSS and JavaScript, so we decided to break the CSS components out into their own YUI modules. In fact, we had already set a precedent for this with [CSSButton](http://yuilibrary.com/yui/docs/button/cssbutton.html).

Once we started upon this path, we realized that instead of just creating new CSS modules, it would be better to split out the CSS entirely into a new project, independent of YUI. There’s no reason why someone couldn’t use that CSS with jQuery, vanilla JavaScript, Bootstrap, or some other library. That’s how Pure came about.

## Fitting In With YUI

Not only is Pure compatible with jQuery or Bootstrap, but you can also use it with YUI. In the near future, **YUI will be depending on Pure**. To make this easy to understand, let’s take an example such as [DataTable](http://yuilibrary.com/yui/docs/datatable/):

Currently, DataTable has its CSS stored in its `assets/` directory. This includes base DataTable styles, along with styles for DataTable plugins. In the future, the core DataTable styles will be pulled in from Pure ([Pure Tables](http://purecss.io/tables/), to be specific). We envision doing this in the following way:

1.  Creating a CSSTable module that pulls in Pure Table CSS via [Bower](http://bower.io/).
2.  Renaming of prefixes (`.pure-table` changes to `.yui3-table`)
3.  Letting DataTable depend on CSSTable

You could imagine this working for all current YUI widgets that have a CSS dependency in Pure.

## Benefits

There are a few benefits in having YUI depend on Pure in this way. First, it allows Pure to stay independent of YUI. We believe it’s important for Pure to have its own identity, and we are accomplishing this by letting Pure have its own release schedule and not be bound by a dependency on YUI.

In contrast, it gives YUI the flexibility to pull in specific parts of Pure that are useful for the library and then tweak them as necessary. By creating YUI CSS modules we’re able to loosen the coupling between a JavaScript widget, and the CSS required to render it. This also makes a great progressive enhancement story: You could imagine having a regular `<table>` element styled through Pure, until JavaScript is loaded. From a style perspective, the way the table looks will not change since the same CSS rules are being leveraged by YUI.

## Thoughts

We’re really excited to see what happens with Pure over the coming weeks and months. As it matures, we’re looking forward to building it out through a thriving open-source community. Although Pure is independent of YUI, our improvements to it will be fed back into YUI through the steps mentioned above. We think this is the best way forward when it comes to YUI and CSS.

We want to continue this discussion with you on the [**YUI Contrib** mailing list](https://groups.google.com/forum/#!forum/yui-contrib) to figure out the best way to integrate Pure into YUI. Let us know what you think!