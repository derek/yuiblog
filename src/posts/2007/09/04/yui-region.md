---
layout: layouts/post.njk
title: "Shift Happens — Fixing Tricky Layouts with the YUI Dom Collection"
author: "Unknown"
date: 2007-09-04
slug: "yui-region"
permalink: /blog/2007/09/04/yui-region/
categories:
  - "Development"
---
Every so often we have to do things as web developers that don't quite work along with our ideals. One of them is when we're asked to implement layout requirements that expect content or font sizes to be set in stone and not change. While this requirement is inherently flawed — this is the web, not a fixed canvas — it still crops up over and over again.

One of these problems we came across recently was that an advertising campaign had a small banner in one column of the layout and a large banner in another column. This wouldn't be a problem, but the ads required that the banners line up _on the bottom_ for the "wow" effect to happen. The problem is clear to anyone who ever worked in a web environment with third-party-maintained content. The following illustration shows what the main issue is:

![An unknown amount of content above the small banner shifts it below the other one](/yuiblog/blog-archive/assets/shifthappens/problem.png)

**Illustration one:** There is an unknown amount of content above the banner in the middle column which makes it impossible to align the banners. [See the problem on the demo page](/yuiblog/blog-archive/assets/shifthappens/fixingalignment-problem.html).

The right-hand column has a control above the large banner that has a fixed height and consists of images, which is why there is no problem with this one. The problem is _the content above the banner in the centre of the layout_. Editorial constraints allow us to keep the variability of this content in check to some degree to protect our bottom-aligned boxes; however, there remains that tricky little problem that if visitors have a larger font size, the text content in that centre box grow longer, and shift happens:

![Larger fonts lead to misalignment of the banners](/yuiblog/blog-archive/assets/shifthappens/largerfont.png)

**Illustration two**: Increasing the font size stops the banners from being aligned on the bottom.

## Using CSS to battle the issues

The first thing we tried was to use CSS to align the banners by positioning the parent node containing both ads relatively and the large banner absolutely to the bottom of it. In order to avoid overlap, we added a padding as high as the banner to the module on the right. We also needed to set a specific width to the absolutely positioned banner. This solved the issue in the case of more content being added above the smaller banner or the font size being increased.

![using CSS to fix the problem - almost](/yuiblog/blog-archive/assets/shifthappens/csssolution.png)

**Illustration three**: Using CSS, we can keep the font resizing in check. [See the CSS solution](/yuiblog/blog-archive/assets/shifthappens/fixingalignment-css.html).

We were almost there, cake got rolled in, champagne bottles were at the ready but then we realized that we have another problem. What if the font size is _smaller_? Or even worse, what if the small banner is not displayed at all? After all, both banners are included by a third-party script we have no control over.

The first problem of smaller fonts and the large banner ending up below the smaller one could be solved by positioning the small banner absolutely to the bottom and adding padding to the container element. However, this still would mean that this padding gets applied when there is no small banner and there'd be a gap between module and banner in the right column.

We put the cake and bubbly back into the fridge and looked around what else can be used. CSS was out as a real solution as you cannot have conditionals in this language (if this is true then...). The solution was using JavaScript and the [YUI Dom Collection](http://developer.yahoo.com/yui/)'s [Region methods](http://developer.yahoo.com/yui/docs/YAHOO.util.Region.html).

## Region to the rescue

This little gem in the YUI allows you to read out the position and size of an element on the screen at any moment in time regardless of its positioning. Region works the same for absolutely, relatively or statically positioned elements, all it expects is the element to be available and not hidden with `display:none`.

With this in mind, we were able to sort out our game plan:

-   Check if both ads exist (as there is no need to do anything if the small banner is not there)
-   Read out the Region of both ads.
-   Calculate the difference in height.
-   Create an empty DIV and set its height to the difference (we could have used margin or padding on the ads, but who is to say they don't already have a margin?)
-   Test which one of the ads is lower than the other.
-   Add the DIV before the other one.

This works around all the issues and is a pretty short script:

```
YAHOO.example.fixAdPosition = function(){
  var ad_one = YAHOO.util.Dom.get('adblock1');
  var ad_two = YAHOO.util.Dom.get('adblock2');
  if(ad_one && ad_two){
    var region_one = YAHOO.util.Dom.getRegion(ad_one);			
    var region_two = YAHOO.util.Dom.getRegion(ad_two);
    var pad = document.createElement('div');
    pad.innerHTML = '&nbsp;';
    var height = Math.abs(region_one.bottom - region_two.bottom);
    YAHOO.util.Dom.setStyle(pad,'height',height+'px');
    var toPad = (region_one.bottom < region_two.bottom) ? ad_one : ad_two;
    toPad.parentNode.insertBefore(pad,toPad);
  }
}();
```

![using JavaScript to fix the problem, all banners line up regardless of font size](/yuiblog/blog-archive/assets/shifthappens/jssolution.png)

**Illustration four**: Using JS and YUI region, we can cover all problem cases. [See the JavaScript solution](/yuiblog/blog-archive/assets/shifthappens/fixingalignment-js.html).

This fixes the problem when the page is loading. We could have gone further and added a font-resizing sniffing mechanism to re-align the banners when the font gets resized (if you want to know about font resizing and how to monitor it, check out [this A List Apart article](http://www.alistapart.com/articles/fontresizing) and its comments).

## More Reading

-   Read [more about YUI Region in this blog post](http://www.wait-till-i.com/index.php?p=478).
-   Check out the [YUI Dom API documentation](http://developer.yahoo.com/yui/docs/module_dom.html).
-   [Download the examples for this post](/yuiblog/blog-archive/assets/shifthappens/shifthappens.zip).