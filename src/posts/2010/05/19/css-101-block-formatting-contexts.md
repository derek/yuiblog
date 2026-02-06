---
layout: layouts/post.njk
title: "CSS 101: Block Formatting Contexts"
author: "Thierry Koblentz"
date: 2010-05-19
slug: "css-101-block-formatting-contexts"
permalink: /2010/05/19/css-101-block-formatting-contexts/
categories:
  - "Development"
---
_**About the author:** Thierry Koblentz is a front-end engineer at Yahoo!  
He owns [TJK Design](http://www.tjkdesign.com/ "TJK Design"), [ez-css.org](http://www.ez-css.org/ "Lightweight CSS framework") and [css-101.org](http://www.css-101.org/ "Interactive CSS tutorial"). You can follow Thierry on Twitter at [@thierrykoblentz](http://twitter.com/thierrykoblentz "Thierry Koblentz on Twitter")._

A block formatting context is a box that satisfies at least one of the following:

-   the value of "float" is not "none",
-   the used value of "overflow" is not "visible",
-   the value of "display" is "table-cell", "table-caption", or "inline-block",
-   the value of "position" is neither "static" nor "relative".

When it comes to the [visual formatting model](http://www.w3.org/TR/CSS21/visuren.html) (this is how user agents process the [document tree](http://www.w3.org/TR/CSS21/conform.html#doctree) for visual [media](http://www.w3.org/TR/CSS21/media.html)), block formatting contexts are big players. So it is crucial for CSS authors to have a solid understanding of their relationship with the flow, floats, clear, and margins.

### What does the spec say about...

#### How block formatting contexts flow

The [positioning scheme](http://www.w3.org/TR/CSS21/visuren.html#positioning-scheme) to which block formatting contexts belong is [normal flow](http://www.w3.org/TR/CSS21/visuren.html#normal-flow). Therefore, the "block" of a block formatting context is positioned in the flow of the page as you'd expect with [block](http://www.w3.org/TR/CSS21/visuren.html#block-box) boxes, [inline formatting](http://www.w3.org/TR/CSS21/visuren.html#inline-formatting) of [inline](http://www.w3.org/TR/CSS21/visuren.html#inline-box) boxes, [relative positioning](http://www.w3.org/TR/CSS21/visuren.html#relative-positioning) of block or inline boxes, and positioning of [run-in](http://www.w3.org/TR/CSS21/visuren.html#run-in) boxes. Simply put, they are part of the page flow.

#### What triggers block formatting contexts

Section 9.4.1 says that the following will establish new block formatting contexts:

> -   floats,
> -   absolutely positioned elements,
> -   inline-blocks,
> -   table-cells,
> -   table-captions,
> -   elements styled with "overflow" (any value other than "visible")
> -   elements styled with "display:flex" or "inline-flex" (flex boxes)

But according to the [CSS level 3 specification](http://www.w3.org/TR/css3-box/#block-level0), a block formatting context (a "flow root" in CSS3 speak) is created when the following condition is met:

> -   The value of " [position](http://www.w3.org/TR/css3-box/#position)" is neither "static" nor "relative" (see [\[CSS3POS\]](http://www.w3.org/TR/css3-box/#CSS3POS)).

This definition means that `position:fixed` establishes a new block formatting context, too. This is not a miss in section 9.4.1, though; fixed positioning is a subcategory of absolute positioning (9.6.1) and references in the specification to an absolutely positioned element (or its box) imply that the element's " [position](http://www.w3.org/TR/CSS21/visuren.html#propdef-position)" property has the value "absolute" or "fixed" .

Note that `display:table` does not establish block formatting contexts per se. But because it can generate [anonymous boxes](http://www.w3.org/TR/CSS21/tables.html#anonymous-boxes), one of them (with `display:table-cell`) establishes a new block formatting context. In other words, the trigger is the anonymous box, not `display:table`. This is something authors should keep in mind, because even if both styles establish new block formatting contexts (implicitly or explicitly), `clear` does not work the same with `display:table` as it does with `display:table-cell`.

A final trigger is the `fieldset` element. Oddly enough, there was no information on www.w3.org about this behavior until the [HTML5](http://www.w3.org/TR/html5/the-xhtml-syntax.html#the-fieldset-element-0 "The fieldset element is expected to establish a new block formatting context") specification. There were browser bugs ( [Webkit](https://bugs.webkit.org/show_bug.cgi?id=3898#c9), [Mozilla](https://bugzilla.mozilla.org/show_bug.cgi?id=342531)) that mentioned this, but nothing "official". Actually, even if fieldsets establish new block formatting contexts in most browsers, as per section 3.2 (UA conformance), authors were not supposed to take this for granted:

> CSS 2.1 does not define which properties apply to form controls and frames, or how CSS can be used to style them. User agents may apply CSS properties to these elements. Authors are recommended to treat such support as experimental. A future level of CSS may specify this further.

#### What block formatting contexts do

Block formatting contexts contain floats because of the way they flow, and per section 9.4.1, they prevent collapsing margins and do not overlap floats:

> In a block formatting context, boxes are laid out one after the other, vertically, beginning at the top of a containing block. The vertical distance between two sibling boxes is determined by the ["margin"](http://www.w3.org/TR/CSS21/box.html#propdef-margin) properties. Vertical margins between adjacent block boxes in a block formatting context [collapse](http://www.w3.org/TR/CSS21/box.html#collapsing-margins).
> 
> In a block formatting context, each box's left outer edge touches the left edge of the containing block (for right-to-left formatting, right edges touch). This is true even in the presence of floats (although a box's line boxes may shrink due to the floats), unless the box establishes a new block formatting context (in which case the box itself [may become narrower](http://www.w3.org/TR/CSS21/visuren.html#bfc-next-to-float) due to the floats).

### Enough with the specs, what does this mean in the real world?

Block formatting contexts behave more or less like any block box, apart from these important exceptions:

-   #### Block formatting contexts prevent margin collapsing
    
    Vertical margins between adjacent block boxes [collapse](http://www.w3.org/TR/CSS21/box.html#collapsing-margins), but only if they are in the same block formatting context. In other words, if the adjacent boxes do not belong to the same block formatting context, their margin will _not_ collapse.
    
    Example:
    
    This is a paragraph inside a DIV with a blue background, styled with `margin:20px`.
    
    This is a paragraph inside a DIV with a blue background, styled with `margin:20px`.
    
    This is a paragraph inside a DIV with a blue background, it is styled with `margin:20px`, The parent DIV is styled with `overflow:hidden;zoom:1`.
    
    Between the two first blue boxes above, the bottom and top margin of the paragraphs collapse (the gap equals 20 pixels, not 40 pixels), but because the last DIV creates a new block formatting context, the margins of the third paragraph do not collapse, hence they do not "stick out" of the paragraph's container but instead are part of that block box.
    
    **Note**: in IE6, without _explicit_ margins the DIV would fail to enclose the margins.
    
    When it comes to collapsing margins, creating a new block formatting context acts the same as applying `border` or `padding` to the element.
    
-   #### Block formatting contexts contain floats
    
    I am sure you have heard of the sentence " a float always contains floats ", or maybe heard of the FNE ( [float nearly everything](http://orderedlist.com/our-writing/blog/articles/clearing-floats-the-fne-method/)) method. But the basis of this is that floats **are** block formatting contexts, so a better way to formulate this is to say that " **a block formatting context always contains floats** ".
    
    Example:
    
    This paragraph is a float inside a DIV with a blue background, it is styled with `margin:20px`
    
    This paragraph is a float inside a DIV with a blue background, it is styled with `margin:20px`. The parent DIV is styled with `overflow:hidden;zoom:1`.
    
    The first paragraph is a float so it is removed from the flow and its container **collapses**, hence the background of this container does not show.
    
    The second paragraph is also a float, but it is _contained_ inside a DIV that creates a new block formatting context, hence that container encloses the child's "margin box". You should also note that, unlike with the first paragraph, there is no need to clear the previous box. This is often referred to as "self-clearing", which makes lot of sense considering that block formatting contexts are a normal part of the flow.
    
    **Note**: `clear` only clears floats within _the same block formatting context_.
    
-   #### Block formatting contexts do not overlap floats
    
    This one is [my favorite](http://www.ez-css.org/ "A CSS framework based on new block formatting contexts"). According to the spec, the border-box of a block formatting context must not overlap the margin-box of floats in the same block formatting context as the element itself. What this means is that browsers create _implicit_ margins on block formatting contexts to prevent them from overlapping the margin-box of floats. For this very reason, negative margins should have no effect when applied to a block formatting context next to floats (WebKit and IE6 have a problem with this though - see [test case](http://www.tjkdesign.com/lab/bfc/test.html)).
    
    Example:
    
    ```
    .sideBar { 
    background: skyBlue; 
    float: left; 
    width: 180px; 
    }
    ```
    
    ```
    .sideBar { 
    background: yellow; 
    float: right; 
    width: 180px; 
    }
    ```
    
    ```
    #main { 
    background: pink; 
    overflow: hidden; 
    zoom: 1; 
    border: 5px solid teal; 
    } 
    ```
    
    Because this behavior is attached to the "border box" (not the "margin box"), to create space (e.g., a 20px gap) between the pink box and its siblings, authors would need to either:
    
    -   Set a 20px margin on the floats
    -   Set margin values on the pink box greater than the width of the floats (i.e., `margin:0 220px`)
    
    Yes, you'd use `220px`, _not_ `20px`. Because it is the _border-box_ that tries to fit between the floats, not the margin-box. And if I say it _tries_ it is because that container would drop if there was not enough room for it between the two floats.
    
    In other words, if the pink box was given a 400 pixels width, that box should **drop** when the parent container is narrower than 770 pixels (180px + 180px + 400px + 10px). As a side note, in a few instances, this behavior appears to be broken in Firefox (at least in v.3.5.9) (i.e., when the above construct is the first child of `body` - see [test case](http://www.tjkdesign.com/lab/bfc/test.html)).
    
    **Note**: the space that shows in IE6 between the pink box and the two floats is due to the [three pixel jog bug](http://www.positioniseverything.net/explorer/threepxtest.html).
    

### hasLayout versus block formatting context

As you may have noticed, all previous examples are styled using `overflow:hidden;zoom:1`. The former declaration establishes a new block formatting context in modern browsers while the latter triggers hasLayout in Internet Explorer (IE 5.5/6/7). This is because these renderings are very close ( [similarities with the CSS specs](http://www.satzansatz.de/cssd/onhavinglayout.html#engineer)). Like block formatting contexts, elements that are given a layout appear to prevent collapsing margins, to contain floats, and to not overlap floats.

#### Properties/declarations that give elements a layout

The lists below show that the properties that establish a new block formatting context also trigger hasLayout, at least the ones supported by the browser, with the exception of `overflow` in IE < 7.

In Internet Explorer 5 and 6

`position:absolute`

`position:fixed`

`float` (any value other than " `none`")

`display:inline-block`

`width` (any value other than " `auto`")

`height` (any value other than " `auto`")

`zoom` (any value other than " `normal`")

`writing-mode:tb-rl`

`-ms-writing-mode:tb-rl`

In Internet Explorer 7

`min-width` (any value)

`min-height` (any value)

`max-width` (any value other than `none`)

`max-height` (any value other than `none`)

elements styled with `overflow` (any value other than `visible`)

`overflow-x` and `overflow-y` (any value other than `visible`)

##### Things to consider

-   `zoom` and `writing-mode` are proprietary properties and do not validate.
-   IE 5.0 does not support `zoom`
-   `width` and `height` trigger hasLayout on inline elements only when these properties apply to these elements (i.e., IE6 in quirks mode).
-   `overflow-x` and `overflow-y` are part of the CSS3 box model module
-   hasLayout is also triggered when the layout-flow is different from the parent layout flow (i.e., `rtl` to `ltr`)

In Quirks Mode and IE7 Mode (All Versions)

-   When overflow is set to something other than visible, table-cell elements \*do not \* establish new block formatting contexts.
-   When overflow is set to visible, table-cell elements \*establish \* a new block formatting context.

#### HTML elements that always have a layout:

In Internet Explorer, these elements have - \*by default \* - a layout. \* `<body>` (as well as `<html>` in Strict mode) \* `<table>`, `<tr>`, `<th>`, `<td>` \* `<img>` \* `<hr>` \* `<input>`, `<button>`, `<select>`, `<textarea>`, `<fieldset>`, `<legend>` \* `<iframe>`, `<embed>`, `<object>`, `<applet>` \* `<marquee>`

### Wrap up

To reduce the risk of issues between modern browsers and Internet Explorer ( < 8), authors may choose to give a layout to boxes that establish new block formatting contexts. This way the flow is identical, elements escape floats the same way, `clear` clears the same floats, and margins collapse where expected. Also, authors must pay attention when styling boxes using [hasLayout triggers](#hasKayoutTriggers) (i.e., `width`) as such styling may require making that element a new block formatting context as well.

### Further readings

#### Implications

-   Page breaks and block-formatting contexts: [Allowed page breaks (13.3.3)](http://www.w3.org/TR/CSS21/page.html#allowed-page-breaks).
-   Clearfix and block formatting contexts: [Everything you Know about Clearfix is Wrong](http://carsonified.com/blog/design/everything-you-know-about-clearfix-is-wrong/)

#### Demos and testcases

-   [Block formating contexts, "hasLayout" – IE Window vs CSS2.1 browsers: simulations.](http://dev.l-c-n.com/IEW/simulations.php)
-   [New block formatting contexts next to floats](http://www.brunildo.org/test/FloatMarginOverflow.html)

#### hasLayout articles

-   [On having layout](http://www.satzansatz.de/cssd/onhavinglayout.html)
-   ["HasLayout" Overview](http://msdn.microsoft.com/en-us/library/bb250481%28VS.85%29.aspx)
-   [hasLayout Property](http://msdn.microsoft.com/en-us/library/ms533776%28VS.85%29.aspx)

Special thanks to [Philippe Wittenbergh](http://l-c-n.com/) and [Bruno Fassino](http://www.brunildo.org/test) for finding spec references when one needs them and to Ingo Chao for giving us the best resource on [having layout](http://www.satzansatz.de/cssd/onhavinglayout.html).