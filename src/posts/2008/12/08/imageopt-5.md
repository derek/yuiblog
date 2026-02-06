---
layout: layouts/post.njk
title: "Image Optimization, Part 5: AlphaImageLoader"
author: "Stoyan Stefanov"
date: 2008-12-08
slug: "imageopt-5"
permalink: /2008/12/08/imageopt-5/
categories:
  - "Performance"
  - "Development"
---
_This is part 5 in an ongoing series. You can read the other parts here:_

-   [Image Optimization Part 1: The Importance of Images](/yuiblog/blog/2008/10/29/imageopt-1/)
-   [Image Optimization Part 2: Selecting the Right File Format](/yuiblog/blog/2008/11/04/imageopt-2/)
-   [Image Optimization Part 3: Four Steps to File Size Reduction](/yuiblog/blog/2008/11/14/imageopt-3/)
-   [Image Optimization Part 4: Progressive JPEG...Hot or Not?](/yuiblog/blog/2008/12/05/imageopt-4/)

This installment of the image optimization series is about the IE-proprietary AlphaImageLoader CSS filter, which developers often use as a workaround to solve transparency issues with truecolor PNGs in IE. The problem with AlphaImageLoader is that it hurts page performance and, therefore, hurts user experience. I argue that AlphaImageLoader should be avoided when at all possible.

### Quick Refresher

As mentioned in a [previous article](/yuiblog/blog/2008/11/04/imageopt-2/), [PNGs](http://en.wikipedia.org/wiki/Portable_Network_Graphics) come in several different types but can roughly be divided into:

-   Indexed (palette), also referred to as PNG8 which have up to 256 colors.
-   Truecolor PNG, also referred to as PNG32 or PNG24.

Both formats support alpha (variable) transparency and, while PNG8 images degrade to a GIF-like non-variable transparency in IE6 ([example](/yuiblog/blog-archive/assets/png8-transparency.png), [source](http://www.sitepoint.com/blogs/2007/09/18/png8-the-clear-winner/)), truecolor PNGs show an uglyish background in place of the transparent pixels (source W3C).![truecolor PNG transparency problem in IE6](/yuiblog/blog-archive/assets/png-transparency.png)

### The AlphaImageLoader fix

IE6 (and older versions of IE) provides a solution to the problem through its proprietary `filter` CSS property. The following code will display the proper image cross-browser:

```
#some-element {
    background: url(image.png);
    _background: none;
    _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='image.png', sizingMethod='crop');
}

```

As you can see, the underscore CSS hack is used to target IE < 7 and

1.  "undo" the background; and
2.  load the same image, using Microsoft's AlphaImageLoader filter.

The reason to target IE prior to version 7 is that IE7 supports the alpha transparency natively without the need for filters. (IE8 does too and it actually [changes the filter syntax](http://blogs.msdn.com/ie/archive/2008/09/08/microsoft-css-vendor-extensions.aspx) completely.)

It's interesting to note that the filter doesn't change the image; rather, it changes the HTML element this style is applied to. The other interesting thing is that each element is processed synchronously in a single UI thread. The process applying the filter takes some resources for each element and the more "filtered" elements you have, the worse it gets, even if you use the same image for all the elements.

The question is: How does this affect the overall performance of the page?

### Freeze! Side Effect #1

Here's a simple experiment: Create a page that has a CSS filter and then simulate (and exaggerate) network latency by delaying the image used in the filter by ten seconds. The result? Not only is nothing rendered (blank page) for ten seconds, but the browser freezes, meaning you cannot interact with it, click its icons or menus, type in the URL...you can't even close it.

[Here's a test example.](/yuiblog/blog-archive/assets/image-opt-tests/alphatest.html)

In the example, I didn't use the underscore hack so you can see the (d)effect in IE7 too, even in IE8 in "compatibility mode".

While the effect is exaggerated for demo purposes, network latencies are a fact of life and this is probably the worst user experience you can deliver: Someone comes to your page and their browser freezes.

Note that parallel downloads are not blocked. The browser still downloads the other page components in the background, but there's no progressive rendering. You can think of it this way — since IE will not render anything until the very last bit of CSS comes down the wire ([more info](http://www.phpied.com/rendering-styles/)), and your because CSS has a dependency on a filtered image, the rendering is blocked until the dependency is satisfied.

What if you have several AlphaImageLoader filters on the page? They are processed synchronously one after the other so the problem is multiplied. If you have 5 images, each delayed 2 seconds on the server, then the browser freezes for a total of 10 seconds.

### Time and Memory — Side Effects #2 and #3

Another negative effect of using the AlphaImageLoader is the increase of the amount of memory required to process and apply the filters. These days we might be tempted to think our visitors' computers have a virtually indefinite supply of memory, but for older computers (those more likely to run IE6 and under) this may not be the case.

And at the end of it, it's the performance we're most interested in, performance as measured by the time it takes for the page to load in the browser. Let's do a test to measure how much time and memory is required by the filters.

First, let's have a baseline page — one that has a hundred <div>s with the same non-filtered background image. Then let's have a second page with a filter applied to the divs (all 100 divs use the same). A hundred elements with filtered backgrounds is unlikely to be found in a normal page, but a little exaggeration will help with the measurements.

The time is measured from the start of the page to the onload event of the page, after the images have been cached, thus eliminating the time required to download the page and the images. The memory consumption is measured with the help of the [ProcessExplorer](http://technet.microsoft.com/en-us/sysinternals/bb896653.aspx) tool and given as the before/after delta of the private bytes measurement, showing the "price" of rendering the page.

Here are the median results from 10 runs in IE6 on a PC with a dual 2GHz CPU and 500M RAM. On a less powerful computer, the load times are likely to be even worse.td.number{text-align:right} /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

<table border="1"><caption>AlphaImageLoader test results</caption><tbody><tr><th>test page</th><th>time, seconds</th><th>memory, MB</th></tr><tr><td><a href="alpha-no-filter-100.html">Test #1 - no filters</a></td><td class="number">0.031</td><td class="number">0.6</td></tr><tr><td><a href="alpha-filter-100.html">Test #2 - with filters</a></td><td class="number">0.844</td><td class="number">46.8</td></tr></tbody></table>

As you can see, the AlphaImageLoader effect is pretty bad — our test page loads 27 times slower and eats up 78 times more memory. These results are, of course, highly speculative — it's just one image tested on just one PC (relatively powerful and underworked). With different images, applied to a different number of elements and on different machines, results may vary considerably, especially when there's less RAM or CPU, or if you throw network latency (side effect #1) into the mix. But this example illustrates the important concepts:

-   AlphaImageLoader is slow and requires more memory
-   It's applied per element, not per image

If you have a sprite image and you use it for different elements (sprites with alpha filters are trickier, [but doable](http://www.julienlecomte.net/blog/2007/07/4/)), you'll pay the penalty for each element the sprite is used on.

### Yahoo! Search Case Study

Using lab tests like the one above can give us some idea of the AlphaImageLoader "price," and you might be tempted to test and calculate approximately how much you pay for each filtered element, but there's nothing better than a real life test with millions of requests coming form different parts of the world with different browsers, computers and bandwidth.

[Yahoo!'s search results page](http://search.yahoo.com/search?p=yahoo+search) used to have a truecolor PNG sprite and employed AlphaImageLoader to achieve the transparency (an [older version of the sprite](http://us.js2.yimg.com/us.yimg.com/i/us/sch/el/ngsprt_srp_20071130.png) is still around if you're curious). Replacing the truecolor PNG with a gracefully degrading PNG8 ([discussed previously](/yuiblog/blog/2008/11/04/imageopt-2/)) decreased the pageload time by 50-100ms for the users of IE 5 and 6. 100ms may not seem like much, but for a page that loads under a second, it's at least 10%. Also, according to [an Amazon study](http://home.blarg.net/%7Eglinden/StanfordDataMining.2006-11-29.ppt), 100ms slower means 1% fewer sales (even for their content-heavy pages). Earning 1% more by just replacing an image doesn't look like a bad deal at all.

### So Now What?

The best thing would be to avoid AlphaImageLoader completely and, like Y!Search, take the time to create PNG8 images that degrade nicely in IE6 and look good in all other browsers. How do you create a gracefully degrading PNG8? Well, create a GIF-like image first, one that has only fully transparent or fully opaque pixels. After making sure it looks acceptable (it will look like this in IE6), proceed to enhancing the image with semi-transparent pixels which will smooth any rounded corners or other parts that would benefit from transparency. Unfortunately, as far as I know, Fireworks is currently the only image processing software capable of handling alpha transparency in PNG8. You can also try command line tools such as [pngnq](pngnq.sourceforge.net) and [pngquant](http://www.libpng.org/pub/png/apps/pngquant.html), although automated truecolor-to-palette PNG conversion might not always yield satisfactory results and you might need to pick the fully opaque pixels manually.

There might be cases when you won't be able to get by with a PNG8 and absolutely need to use AlphaImageLoader — for example when most or all pixels are semi-transparent (imagine a "play" button over a video thumbnail). Dave Artz of AOL has some [other cases](http://www.artzstudio.com/2008/07/png-alpha-transparency-no-clear-winner/) where PNG8 will not be good enough. In such cases (but only after you try your best to persuade the designer to reconsider the use of transparency), make sure you use the underscore hack (`_filter`) so that you don't penalize IE7 users.

Sometimes instead of PNG8 people use GIF for IE6 and truecolor PNG for the others, but that's not necessary; with one PNG8 you achieve both binary and alpha transparency.

Additional benefits from using a PNG8 are:

1.  PNG8 is usually smaller than truecolor PNG,
2.  only one image to maintain for all browsers
3.  cleaner CSS with no hacks, branches or proprietary tags
4.  ability to repeat background

### Transparency with VML

Using VML is yet another option in IE to make a truecolor PNG transparent, and it solves several problems: alpha transparency, performance, and background repeat. Unfortunatelly, it comes with the price of extra non-standard markup (or dependency on JavaScript to generate it if you want your initial markup clean) and more propritary CSS. Here's an example on how to implement it.

If, for example, you have an empty div, you need to wrap it in one VML `:rect` (or `:shape`) and one `:fill` element, like this:

```
<v:rect>
  <v:fill type="tile" src="alphatest.png">
    <div>&nbsp;</div>
  </v:fill>
</v:rect>

```

Somewhere in the markup before that you also need to declare a VML namespace:

```
<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />

```

And in your stylesheet you need:

```
v\:rect  {
    behavior:url(#default#VML);
    width: 100px;
    height: 100px;
    display: block;
}

v\:fill  {
    behavior:url(#default#VML);
}

```

[A test page](/yuiblog/blog-archive/assets/image-opt-tests/vml.html) with 100 VML `rect` elements loads in 0.094 seconds (almost 10 times faster than using filters) and the memory usage is under 4Mb (10 times less than the filtered page).

As you can see this solution adds more markup and proprietary CSS, but it's still a solution and doesn't have the penalties of the AlphaImageLoader. (Thanks go to [this post](http://dillerdesign.com/experiment/DD_roundies/) by Drew Diller and also [HTML Remix](http://www.htmlremix.com/curved-corner-border-radius-cross-browser/), who accidentally found this side effect while working on another problem — rounded corners with VML, via [snook.ca](http://snook.ca/archives/html_and_css/ie-rounded/))

### P.S. ...and What about Other Filters

AlphaImageLoader is not the only filter that exists. Another popular one is the opacity filter.

For example, for 50% element opacity developers use the properties:

-   `opacity: 0.5` (standard),
-   `-moz-opacity: 0.5` (early Mozilla versions, before Firefox 0.9), and
-   for IE, `filter: alpha(opacity=50)`.

A quick test in IE6 shows that the opacity filter is not nearly as slow as the AlphaImageLoader, but it's still making the page slower and takes the same amount of memory. This test uses color background, not an image, but even with an image the results are pretty much the same.

<table border="1"><caption>opacity filter test results</caption><tbody><tr><th>test page</th><th>time, seconds</th><th>memory, MB</th></tr><tr><td><a href="alpha-no-opacity-100.html">Test #3 - 100 divs, no opacity</a></td><td class="number">0.016</td><td class="number">0.2</td></tr><tr><td><a href="alpha-opacity-100.html">Test #4 - 100 divs with opacity</a></td><td class="number">0.093</td><td class="number">46.7</td></tr></tbody></table>