---
layout: layouts/post.njk
title: "CSS Quick Tip: Inline Boxes with Bottom Alignment"
author: "Thierry Koblentz"
date: 2010-11-15
slug: "inline-boxes-with-bottom-alignment"
permalink: /blog/2010/11/15/inline-boxes-with-bottom-alignment/
categories:
  - "Development"
---
## The challenge

Keeping a submit button at the bottom of a line box, aligned with form controls positioned below their label (Figure 1).

![Figure 1: The submit button is aligned with other from controls](/yuiblog/blog-archive/assets/inlineboxes/figure-1.png)

## The tricky part

If the containing block is not wide enough for the submit button to flow next to the other controls, that button must show at the beginning of the next line box (according to RTL/LTR context) with minimal space above it (Figure 2).

![Figure 2: The submit button wraps to the next line, below the other controls](/yuiblog/blog-archive/assets/inlineboxes/figure-2.png)

## The solution

`display:inline-block` allow us to keep everything in the flow and at the bottom of the line box. This is because `inline-block` generates a block box (see [9.2.4 The 'display' property](http://www.w3.org/TR/CSS2/visuren.html#propdef-display)), which itself is flowed as a single inline box, similar to a replaced element (i.e. an image).

## The Markup

We group label and control pairs inside `div`s.

```
<form>
   <div>
   <label></label>
   <select></select>
  </div>

   <div>
   <label></label>
   <select></select>
  </div>

   <div>
   <label></label>
   <select></select>
  </div>

  <div>
   <input /> 
  </div>
</form>

```

## The CSS

```
label {display:block;}
div {
  display:inline-block;
  margin:0 10px 10px 0;
  *display:inline;
  zoom:1;
} 
```

To position the controls below their associated label, we style the labels with `display:block` (without this, these elements would show side-by-side).

Note that styling the labels as block does _not_ make them expand across the form, but only across their parent boxes - which share the same line box. This is because the inside of an inline-block is formatted as a block box, and the box itself is formatted as an inline box.

The two last rules are for IE 6 and 7 which do not support `inline-block`. For these browsers, we need to style the `div`s as inline and use `zoom`. Note that this hack is not as robust as the real thing because a nested (non replaced) element [with a layout](http://www.satzansatz.de/cssd/onhavinglayout.html "The concept of hasLayout in IE/Win") will break everything, sitting on its own line inside the form. So, unless you plan to give such nested elements a width, do _not_ give them a layout.

## The Demos

Year2010

MonthJanuary

Day1

Year2010

MonthJanuary

Day1