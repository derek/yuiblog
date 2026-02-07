---
layout: layouts/post.njk
title: "The CSS Position Property"
author: "Thierry Koblentz"
date: 2010-12-14
slug: "the-css-position-property"
permalink: /2010/12/14/the-css-position-property/
categories:
  - "CSS 101"
  - "Development"
---
_**About the author:** Thierry Koblentz is a front-end engineer at Yahoo!  
He owns [TJK Design](http://www.tjkdesign.com/ "TJK Design"), [ez-css.org](http://www.ez-css.org/ "Lightweight CSS framework") and [css-101.org](http://www.css-101.org/ "Interactive CSS tutorial"). You can follow Thierry on Twitter at [@thierrykoblentz](http://twitter.com/thierrykoblentz "Thierry Koblentz on Twitter")_ .

This property applies to all elements. It has five possible values:

-   `static`
-   `relative`
-   `absolute`
-   `fixed`
-   `inherit`

### position:static

From section 9 [Visual formatting model](http://www.w3.org/TR/CSS21/visuren.html#normal-flow "Normal Flow"):

> The box is a normal box, laid out according to the [normal flow](http://www.w3.org/TR/CSS21/visuren.html#normal-flow). The [`top`](http://www.w3.org/TR/CSS21/visuren.html#propdef-top), [`right`](http://www.w3.org/TR/CSS21/visuren.html#propdef-right), [`bottom`](http://www.w3.org/TR/CSS21/visuren.html#propdef-bottom), and [`left`](http://www.w3.org/TR/CSS21/visuren.html#propdef-left) properties do not apply.

#### Things to notice in [this demo](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/static.html "Static scheme, demo")

-   The second box shows exactly where it would be _without_ the position declaration.
-   The value given to `top` does **not** apply because in a 'static' context, the _computed_ value of [box offsets](http://www.w3.org/TR/CSS21/visuren.html#position-props) is always `auto`.

#### Things to remember

-   If the `position` property of an element has the value of `static`, that element is **not** said to be _positioned_.
-   Because `static` is the initial value (the default value), there is no need to include such styling in a declaration block unless it is to _overwrite_ a different value.

### position:relative

From section 9 [Visual formatting model](http://www.w3.org/TR/CSS21/visuren.html#relative-positioning "Relative Positioning"):

> The box's position is calculated according to the normal flow (this is called the position in [normal flow](http://www.w3.org/TR/CSS21/visuren.html#normal-flow)). Then the box is offset relative to its normal position. When a box B is relatively positioned, the position of the following box is calculated as though B were not offset.

#### Things to notice in [this demo](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/relative.html "Relative scheme, demo")

-   Box 'two' has moved down by 300 pixels, but box 'three' as well as the following paragraphs stayed in place. It appears like if the box was lifted from the page, leaving its footprint behind. This is because offsetting a relatively positioned box **does not disturb the flow**.
-   The relatively positioned box _overlaps_ the following elements. It shows _in front_ of other boxes.

#### Things to remember

-   Computed values are always left = -right and top = -bottom. If the `direction` of the containing block is `ltr`, the value of 'left' wins and 'right' becomes -'left'. If `direction` of the containing block is `rtl`, 'right' wins and 'left' is ignored. Authors could take advantage of how things work by setting equal value to opposite properties.
-   Unlike with the 'absolute' model, `top`, `right`, `bottom`, and `left` properties cannot stretch nor shrink the box (they cannot change its size).

### position:absolute

From section 9 [Visual formatting model](http://www.w3.org/TR/CSS21/visuren.html#absolutely-positioned "Absolute Positioning"):

> The box's position (and possibly size) is specified with the `top`, `right`, `bottom`, and `left` properties. These properties specify offsets with respect to the box's [containing block](http://www.w3.org/TR/CSS21/visuren.html#containing-block). A absolutely positioned box is removed from the normal flow entirely (it has no impact on later siblings) and assigned a position with respect to a containing block. Also, though [absolutely positioned](http://www.w3.org/TR/CSS21/visuren.html#absolutely-positioned) boxes have margins, they do not [collapse](http://www.w3.org/TR/CSS21/box.html#collapsing-margins) with any other margins.

#### Things to notice in [this demo](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/absolute.html "Absolute scheme, demo")

-   Because no box offset is specified, box 'two' did not move from its original position, but if we had used `top:0;left:0;` for example, that box would be at the [top left corner of the viewport](demos/absolute-top-left.html).
-   Layout wise, it is like box 'two' had been styled with `display:none`. The box has been _removed from the flow._
-   With box 'two' out of the flow, box 'three' has moved up against box 'one' (the paragraphs have followed).
-   Like all elements removed from the flow, box 'two' has horizontally shrink-wrapped.

#### Things to remember

-   For **any** 'absolute' or 'fixed' positioned element the computed value for `display` is `block`.
-   For **any** 'absolute' or 'fixed' positioned element the computed value for `float` is `none`.
-   A 'containing block' is a box that establishes a positioning context. It is established by the nearest ancestor with a [‘position’](http://www.w3.org/TR/CSS2/visuren.html#propdef-position) of ‘absolute’, ‘relative’ or ‘fixed’. This means the parent box may not be the _containing block_.
-   The default position of a absolutely positioned box is _not_ always the same as if it was styled with top:0;left:0; (in a LTR context). And this is for two reasons:
    1.  The containing block for a positioned box is established by the _nearest positioned ancestor_; if there is none, the reference container is the root element. The containing block in which the [root element](http://www.w3.org/TR/CSS21/conform.html#root) lives is a rectangle called the initial containing block. For continuous media, it has the dimensions of the [viewport](http://www.w3.org/TR/CSS21/visuren.html#viewport) (a window or other viewing area on the screen) and is anchored at the canvas origin. [This example](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/the-viewport-is-the-containing-block.html) shows the box positioned in relation to the viewport (the default containing block).
    2.  The element is positioned in reference to the padding box, _not the content box nor the border box_ of the containing block. This [new example](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/body-is-the-containing-block.html) demonstrates where box 'two' would be if the edges of the padding box did not touch the edges of the content box (the containing block being `body`).
-   The _size_ of the box may be the result of the `top`, `right`, `bottom`, and `left` property values. For examples, zeroing out all properties will make the box stretch to match the dimensions of the padding box of its containing block. See [zeroing out all box offsets](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/zeroing-out-box-offsets.html) (note: ie6 _does not_ stretch the box).
-   To create a mask overlay that does _not_ scroll with the document (as in the [previous example](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/zeroing-out-box-offsets.html)), either use `fixed` _instead_ of `absolute` or style `body` with `position:relative` as the **initial positioning block** _is_ the viewport (styling `html` would not work in IE). As this [overlay demo](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/overlay.html) shows.
-   `position:absolute` triggers [haslayout](http://www.satzansatz.de/cssd/onhavinglayout.html).

#### Most important thing to remember

Because this positioning scheme removes boxes from the flow, it is considered bad pratice to use it for layout.

### position:fixed

From section 9 [Visual formatting model](http://www.w3.org/TR/CSS21/visuren.html#fixed-positioning "Fixed Positioning"):

> Fixed positioning is a subcategory of absolute positioning. The only difference is that for a fixed positioned box, the containing block is established by the [viewport](http://www.w3.org/TR/CSS21/visuren.html#viewport). For [continuous media](http://www.w3.org/TR/CSS21/media.html#continuous-media-group), fixed boxes do not move when the document is scrolled. In this respect, they are similar to [fixed background images](http://www.w3.org/TR/CSS21/colors.html#background-properties). For [paged media](http://www.w3.org/TR/CSS21/page.html) (where the content of the document is split into one or more discrete pages), boxes with fixed positions are repeated on every page. This is useful for placing, for instance, a signature at the bottom of each page. Boxes with fixed position that are larger than the page area are clipped. Parts of the fixed position box that are not visible in the initial containing block will not print.

Things to notice in [this demo](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/fixed.html "Fixed scheme, demo"):

-   Since fixed positioning is a subcategory of absolute positioning, everything that was true for 'absolute' is also true for 'fixed' (the element shrink-wraps, it is removed from the flow, etc.).
-   The box is positioned in _relation to the viewport_, it does not _scroll_ with the page.
-   In IE 6, the box appears [as a **static** box](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/static.html), but there is a "funny" [workaround](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/fixed-for-ie6.html "IE 6 hack to mimic position:fixed") for that.
-   When _printing_ the document, box 'two' appears on every single page.

Things to remember:

-   The box's position is calculated according to the 'absolute' model, but in addition, the box is [fixed](http://www.w3.org/TR/CSS21/visuren.html#fixed-positioning) with respect to some reference. In the case of handheld, projection, screen, tty, and tv media types, the box is fixed with respect to the [viewport](http://www.w3.org/TR/CSS21/visuren.html#viewport) and does not move when scrolled.
-   Content may be inaccessile to sighted users if part of the box is outside of the viewport area.
-   In the case of the print media type, authors may want to prevent an element from appearing on each printed page. Maybe using a @media rule, as in:
    ```
    @media print { 
      #logo {position: static;}
    }
    ```
    
-   Like `position:absolute`, `position:fixed` will trigger [haslayout](http://www.satzansatz.de/cssd/onhavinglayout.html) in IE.

### position:inherit

If `position:inherit` is specified for a given box, then it will take the same computed value as the property for the box's parent.

Note that IE 6 and 7 do not support this keyword except when used with `direction` and `visibility` (see the [CSS Property Value inherit](http://reference.sitepoint.com/css/inheritvalue)).

### Things to consider

#### Box offsets

Be aware that for absolutely and fixed positioned boxes, values set in percentage for `top`, `right`, `bottom`, and `left` are computed according to the dimensions of the **containing block** (which may not be the parent box).

#### 'position' and 'overflow'

A box styled with `overflow:hidden` will clip _relatively_ positioned elements (nested boxes), but it will not always hide _absolutely_ positioned ones. This is because the parent box is not always the containing block (the nearest ancestor with a [‘position’](http://www.w3.org/TR/CSS2/visuren.html#propdef-position) of ‘absolute’, ‘relative’ or ‘fixed’).

In short, this means absolutely positioned elements will show outside of a box styled with overflow:hidden unless their containing block is the box itself or an element inside the said box. This [demo page](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/overflow-and-ap.html) shows how things work.

#### Margins

Authors can use margins on elements regardless of their positioning scheme.

#### The case of IE

In IE, 'positioning' a box may be a blessing or a curse:

-   In IE6, `position:relative (with haslayout)` can be used to prevent a box styled with negative margins from [being _clipped_](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/ie6-and-negative-margin-01.html "IE6 clips part of the box") by a parent container (see how [positioning the box](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/ie6-and-negative-margin-02.html) fixes this issue).
-   Positioning an element may "**disturb**" the way boxes stack in IE 6 and 7 as this may establish a new stacking context (see a [test case](http://tjkdesign.com/Y!/YUIBlog/the-position-property/demos/ie-6-7-and-stacking-issue.html)).

#### Stacking order and stacking level

-   According to the sequence in the source code, _positioned_ boxes come _in front_ of floats and boxes in the normal flow.
-   Authors can specify stack levels via the 'z-index' property **only** on positioned boxes.
-   In IE6 and 7, the simple fact of positioning a box can establish a stacking context (see above, "[the case of IE](#the-case-of-IE)").

#### Mobile devices

Read PPK's article, [the \[sixth\] position value](http://www.quirksmode.org/blog/archives/2010/12/the_fifth_posit.html), to find out why mobile browser vendors cannot really support `position:fixed`.

### Further readings

-   [Visual formatting model](http://www.w3.org/TR/CSS2/visuren.html)
-   [Position (CSS property)](http://reference.sitepoint.com/css/position)
-   [The position declaration](http://www.quirksmode.org/css/position.html)

A "ghost" analogy by **DrLangbhani**:

> An element with position relative is always offset relative to it's _normal position in the flow_. In other words, it is shifted relative to where it would be under normal circumstances, and shifting it _doesn't_ affect the layout of elements around it. It's like a ghost that has left its body behind. A body that has width and height and affects its surroundings but is invisible. The ghostly box is able to move but is still connected to the old body in that its position is still measured from it. Now an element with position absolute is even easier. It no longer affects its surroundings at all (it's pulled out of the layout flow). It's now a true ghost with no body left behind. As far as its sibling elements are concerned it's as if it no longer exists. To get its position, look through each of its parent elements until you find one with either position: relative, \[position: fixed,\] or position: absolute. That element will serve as the reference point. Only if you don't find a "positioned" element will it be offset from the document.