---
layout: layouts/post.njk
title: "Alternative Skins for YUI 3.1.0 Slider"
author: "Jeff Conniff"
date: 2010-04-06
slug: "alternative-slider-skins"
permalink: /2010/04/06/alternative-slider-skins/
categories:
  - "Releases"
  - "Development"
---
We decided to take the [YUI 3 Slider](http://developer.yahoo.com/yui/3/slider/) widget skins up a visual notch for YUI 3.1.0. These were our goals:

1.  Improve the overall visual tastiness and 3-D appearance
2.  Offer a wider range of thumb and rail skins
3.  Provide two sets skins to serve dark as well as light page backgrounds
4.  Provide a complete set of thumbs and rails for vertical as well as horizontal use
5.  Make it easier to mix and match thumbs with different rail styles
6.  Provide Photoshop assets to aid developers in modifying slider images to match any background color

Compare the YUI 2 slider skins with the YUI 3 ones below. The new set has more variety and should serve a broad spectrum of pages and styles.

YUI 2 Slider Skins:

![YUI 2 Slider Skins](/yuiblog/blog-archive/assets/yui2_slider_skins.gif)

YUI 3 Slider Skins:

![YUI 3 Slider Skins](/yuiblog/blog-archive/assets/yui3_slider_skins.jpg)

We didn't restrict the thumbs to rectangles and 45 degree angles. This posed some challenges with anti-aliasing. The YUI 2 thumbs have shadows incorporated into the thumb image, so they are a solid color gray. We've improved this by making a shadow object that's separate from the thumb image. The shadow has `opacity: 0.15`. This means it looks natural as the shadow falls on the rail and the tick marks.

![](/yuiblog/blog-archive/assets/shadow_compare2.jpg)

We will be providing original photoshop files containing each of the rail and thumb images. This will provide developers the source from which to easily customize the images so that they look their best when placed on whatever color background your site has.

![](/yuiblog/blog-archive/assets/slider_blue_3.jpg)

YUI 3's widget foundation reached GA status last week [with the release of YUI 3.1.0](/yuiblog/blog/2010/03/31/announcing-yui-3-1-0/). We don't yet have a full slate of native YUI 3 widgets, and we haven't yet defined a set of global skins. However, the work we did on visual assets for the beta Slider Component should make it more useful in the short term, and we'll carry all of these visual options on as alternative themes or examples once YUI 3's baseline themes are in place.

Have a look at these [working code examples](http://developer.yahoo.com/yui/3/examples/slider/slider_skin.html) of the new sliders. Checkout the behind the scenes [detailed workings](http://developer.yahoo.com/yui/3/slider/#skinning) of the skin images and CSS.

We hope these new sliders will be a nice visual addition to your bag of tricks.