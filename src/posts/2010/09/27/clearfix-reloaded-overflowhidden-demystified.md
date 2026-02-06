---
layout: layouts/post.njk
title: "clearfix Reloaded + overflow:hidden Demystified"
author: "Thierry Koblentz"
date: 2010-09-27
slug: "clearfix-reloaded-overflowhidden-demystified"
permalink: /2010/09/27/clearfix-reloaded-overflowhidden-demystified/
categories:
  - "CSS 101"
---
_**About the author:** Thierry Koblentz is a front-end engineer at Yahoo!  
He owns [TJK Design](http://www.tjkdesign.com/ "TJK Design") and [ez-css.org](http://www.ez-css.org/ "Lightweight CSS framework"). You can follow Thierry on Twitter at [@thierrykoblentz](http://twitter.com/thierrykoblentz "Thierry Koblentz on Twitter")_ .

[clearfix](http://www.positioniseverything.net/easyclearing.html) and `overflow`:`hidden` may be the two most popular techniques to clear floats without structural markup.

This short article is about enhancing the first method and shedding some light on the real meaning of the second.

## clearfix

In [everything you know about clearfix is wrong](http://www.tjkdesign.com/articles/clearfix_block-formatting-context_and_hasLayout.asp) I explain the issues this method creates across browsers and I suggest to _only_ use clearfix on elements that are not next to floats (e.g. a modal window), although as authors we still have to deal with collapsing margins. This [demo page](http://www.tjkdesign.com/lab/clearfix/new-clearfix.html) demonstrates the issue.

Margin-collapse behavior in the [first two boxes](http://www.tjkdesign.com/lab/clearfix/new-clearfix.html) shows that it is the generated (_non-empty_) content that keeps the bottom margin _inside_ the box (which makes perfect sense [according to spec](http://www.w3.org/TR/CSS2/box.html#collapsing-margins "no no-empty content, padding or border areas or clearance separate the margins...")).

So, to create the same box layout across browsers we can enhance the original method by generating content using **both pseudo-elements** `:before` _and_ `:after`:

```
.clearfix:before,
.clearfix:after {
  content: ".";    
  display: block;    
  height: 0;    
  overflow: hidden;	
}
.clearfix:after {clear: both;}
.clearfix {zoom: 1;} /* IE < 8 */
```

Don't simply replace your clearfix rules with these new ones in _existing projects_, though, as you may have already patched issues related to collapsing margins via other methods.

## `overflow`

In most discussions about clearing floats the `overflow:hidden` method comes up, and it is always shot down by a "[If you're placing absolutely positioned elements inside the div, you’ll be cutting off these elements](http://thinkvitamin.com/design/everything-you-know-about-clearfix-is-wrong/#comment-20123)". But this is not necessary true. `overflow:hidden` will always clip relatively positioned elements, but it will not always hide absolutely positioned ones. This is because it all depends on the _containing block_:

**10.1 Definition of "containing block"**:

> 4\. If the element has 'position: absolute', the containing block is established by the nearest ancestor with a ['position'](http://www.w3.org/TR/CSS2/visuren.html#propdef-position) of 'absolute', 'relative' or 'fixed', ...

This means absolutely positioned elements will show outside of a box styled with `overflow:hidden` **unless** their containing block is the box itself or an element inside the said box.

You can check [this demo page](http://www.tjkdesign.com/lab/clearfix/overflow-and-ap.html "overflow:hidden and containing blocks") to see how things work.

## Better alternatives

If you _can_ apply a width to the element containing floats, then your best option is to use:

```
display: inline-block;
width: <any explicit value>;
```

## Further reading

-   [Contained Floats, enclosing floats with pure CSS known as the clearfix technique](http://csscreator.com/attributes/containedfloat.php)
-   [How To Clear Floats Without Structural Markup](http://www.positioniseverything.net/easyclearing.html)
-   [The New Clearfix Method](http://perishablepress.com/press/2009/12/06/new-clearfix-hack/)
-   [10.1 Definition of "containing block"](http://www.w3.org/TR/CSS2/visudet.html#containing-block-details)