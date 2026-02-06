---
layout: layouts/post.njk
title: "Thoughts on the new HTML5 elements and surrogate DIVs"
author: "YUI Team"
date: 2011-03-16
slug: "thoughts-on-the-new-html5-elements-and-surrogate-divs"
permalink: /2011/03/16/thoughts-on-the-new-html5-elements-and-surrogate-divs/
categories:
  - "Development"
---
Last November at YUIConf, [Tantek Çelik](http://tantek.com/) gave a presentation titled "HTML5: Right Here, Right Now" ([video](http://developer.yahoo.com/yui/theater/video.php?v=yuiconf2010-tantek "HTML5: Right Here, Right Now"), [slides](http://tantek.com/presentations/2010/11/html5-now/ "HTML5: Right Here, Right Now")). I didn't attend this talk, but recently two colleagues of mine mentioned Tantek's presentation pointing out what he calls "HTML5: bulletproofing" (mentioned in the video @26:00, slide #22 in the deck). The idea is to use new HTML elements without relying on JavaScript (i.e. [HTML5shim](http://code.google.com/p/html5shim/)).

The proposed markup looks like this:

```
<article><div class="article">
...
</div></article>

```

Authors would nest a div inside new HTML elements (i.e. `article`, `aside`, etc.), and it is **that** `div` that would be styled via class and/or id.

### Huh?

To be honest, that is what I thought the first time I heard about this idea. I wondered why one would want to implement something like that. Why not go the CC route then? At least, using Conditional Comments, we could avoid a wrapping that reminded me of the [Twice-Cooked Method](http://www.alistapart.com/articles/flashsatay).

But then I remembered "bulletproof". The way it was [originally defined](http://simplebits.com/publications/bulletproof/) by Dan Cederholm. It does not mean worrying about Internet Explorer; it means getting the bigger picture, writing code for the largest audience. This is why Tantek warns us about Javascript shims in the first place. Not only because we cannot assume the presence of javascript, but also because there are non-HTML5 browsers for which `document.createElement` does not do the trick. In short, there are other browsers than IE which we should consider.

### The cost of "bulletproofing"

Okay, I like the idea behind this, but I'm not sold on its value versus sticking with plain old "semantic" HTML ([POSH](http://microformats.org/wiki/posh)). What's wrong with "old" HTML + WAI-ARIA (which would convey the same semantics to screen-reader users)? In other words, for whom should we be doing this and how much does this bring to the table?

I don't have the answer to these questions and I hope people will join the discussion to enlighten me. But what I do know is the issues this technique raises. Because the lack of support for these new elements across browsers does not make this wrapping as insignificant as one might think.

### Caveats

#### JavaScript concerns

A different DOM structure across browsers means queries relying on properties like, `firstChild`, `lastChild`, `parentNode`, `childNodes`, `nextSibling`, `previousSibling`, etc. **will not be reliable**.

#### CSS concerns

With a different DOM structure, combinators (i.e. `>`, `+`, `~`) and pseudo-classes like `:nth-child()`, `:nth-last-child()`, `:nth-of-type()`, `:nth-last-of-type()`, `:first-child`, `:last-child`, `:first-of-type`, `:last-of-type` **will fail** each time the new elements are "in the way".

In addition to which, such wrapping will put in play the default styling of these new elements (`display:block`) which is is a deal breaker for some declarations on their "surrogate" `div`s (i.e. `display:inline-block`). See "[Nesting versus Wrapping](#NestingVsWrapping)".

Another problem is the fact that authors won't be able to style the new elements to prevent issues like these. This is because there is no hook and no other means to get to them.

## Nesting versus Wrapping

It is the last issue above that made me think of using a different approach. If we cannot access the new elements via CSS it is because there is no such thing as a [parent selector](http://snook.ca/archives/html_and_css/css-parent-selectors "Why we don't have a parent selector"), but! If we were nesting the elements rather than using them as wrappers, then we could use the child combinator to get to them.

And as it turns out, this nesting seems to solve quite a few problems. Not only does it allow authors to reach the new elements (if ever needed), but it also fixes the `display` issues I mentioned earlier and brings some CSS selectors back into the picture. See [Nesting versus Wrapping](#NestingVsWrapping) for basic examples.

Nesting new HTML elements makes this new solution _more consistent_ too as we would treat _all elements_ the same, which is not the case with the wrapping technique as some elements cannot contain a `div`. For example, `hgoup` can only contain headings. An issue Tantek Çelik addresses in his book, in which he recommends to make an exception for such element, nesting `hgroup` inside a `div` _instead of_ wrapping it with a `div`.

### Is that what we should do then?

I'm not sure.... Even if the _nesting_ technique seems to solve a few problems, we're still littering our documents with "junk" markup (yes, if it is used for presentation then it is junk). Some people justify this approach saying that once IE8 is dead, the clean up will be as simple as moving all attributes and their values from the `div` to its "HTML5" parent (leaving out the class name that matches the new element). The suggestion being to replace in the styles sheets the said class name with the element name. For example, going from:

```
.section {...}
```

to:

```
section {...}
```

Which is very dangerous as `class` and `type` are selectors of different specificity (`0,1,0` vs. `0,0,1`). In my opinion, a much safer approach would be to leave the class names alone. This would create some redundancy (i.e. `<section class="section">`), but will not mess with the cascade. Still, we would encounter problems if CSS rules contained any reference to new elements (as the nesting technique would permit).

### Is there any better way to do this?

What about writing clean markup and delivering elements depending on user agents? For example, we'd write markup like this: `<nav class="nav"></nav>`, `<section class="section"></section>` , `<aside class="aside"></aside>`, etc. but then we'd swap all these elements with `div`s depending on which UA makes the request. I know, browser sniffing is a bad idea (as this would not be based on the browser ability to deal with HTML5 elements), but what else can we do to move forward without polluting our documents with non semantic wrappers?

Lastly, I'm curious to know what people think of [HTML5 without JavaScript](http://www.debeterevormgever.nl/html5-ie-without-javascript/)? Is it something that works well across browsers? I created this [demo page](http://tjkdesign.com/Y!/YUIBlog/bulletproof_html5_technique/demo.html) and would appreciate feedback about this approach. I'd consider validation a minor issue if it solves bigger problems.