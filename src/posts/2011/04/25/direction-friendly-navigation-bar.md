---
layout: layouts/post.njk
title: "Direction-friendly Navigation Bar"
author: "Thierry Koblentz"
date: 2011-04-25
slug: "direction-friendly-navigation-bar"
permalink: /2011/04/25/direction-friendly-navigation-bar/
categories:
  - "Development"
---
I recently came across a horizontal navigational menu with right-aligned links. As you might expect, it was a list element with `float:right` and the list items with `float:left`. Even though there is nothing wrong with this approach, it inspired me to take this opportunity to discuss [directionality](http://dev.w3.org/csswg/css3-writing-modes/#direction) for layout.

### The cost of floating elements

Floats have no concept of **directionality**; they do not work like inline elements or table columns (for which the `dir` attribute is a magic bullet). With floats, authors must implement a mechanism to "swap" values whenever the interface changes (`ltr` vs. `rtl`).

So instead of using `float`, authors may favor `inline-block`. Here is a simple example:

```
ul {  
    text-align: end; 
    text-align: right\9;  
    *text-align: right; 
}
li {
    display: inline; 
}
a {
    display: inline-block;
    padding: 5px 15px;
    margin: 0 5px;
}
```

Note that using "`\ 0`" (with no space) instead of "`\9`" would take care of Opera, but may not be as future proof as "`\9`" (IE only).

As this [demo page](/yuiblog/blog-archive/assets/direction-friendly-navigation-bar/demo.html) shows, in Chrome, Safari and Firefox, the `inline-block` technique makes the layout writing-mode dependent (the direction of the flow matches the value of the `dir` attribute, or the initial value if no direction is specified). For other UAs, and because of IE's lack of support for the attribute selector (i.e. `html[dir="rtl"]`), authors need to add a hook in the markup to cater to the change of direction. For example, for full A-grade compatibility:

For the float technique:

```
.rtl ul { float: left; }
.rtl ul li { float: right; }

```

For the inline-block technique:

```
.rtl ul { 
    text-align: left\9;  /* IE8/9 */
    *text-align: left;   /* IE5/6/7 */
}
```

### `text-align: start | end`

Unlike `left` and `right`, `start` and `end` are writing-mode dependent keywords. In English, `start` maps to `left` and `end` maps to `right`. Relying on `start` and `end` rather than `left` and `right` allows some browsers to do the swapping (`ltr`/`rtl`) **automatically**.

### Differences between browsers and techniques

In browsers that do not support "`start`/`end`" (IE, Opera)

float technique: swapping direction does not change anything

inline-block technique: swapping direction does not change the alignment of the menu, but links are displayed in the proper sequence

In browsers that do support "`start`/`end`" (Chrome, Safari, Firefox)

float technique: swapping direction does not change anything

inline-block technique: swapping direction is enough to swap the direction of both the menu and the links

That's it! Next time you have to style elements horizontally, remember to give `display:inline-block` or `display:table` a try.

_**About the author:** Thierry Koblentz is a front-end engineer at Yahoo! He owns [TJK Design](http://www.tjkdesign.com/ "TJK Design"), [ez-css.org](http://www.ez-css.org/ "Lightweight CSS framework") and [css-101.org](http://www.css-101.org/ "Interactive CSS Tutorial"). You can follow Thierry on Twitter at [@thierrykoblentz](http://twitter.com/thierrykoblentz "Thierry Koblentz on Twitter")_ .