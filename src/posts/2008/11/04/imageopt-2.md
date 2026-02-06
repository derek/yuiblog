---
layout: layouts/post.njk
title: "Image Optimization Part 2: Selecting the Right File Format"
author: "Stoyan Stefanov"
date: 2008-11-04
slug: "imageopt-2"
permalink: /blog/2008/11/04/imageopt-2/
categories:
  - "Development"
---
_This is part 2 in an ongoing series. You can read the other parts here:_

-   [Image Optimization Part 1: The Importance of Images](/yuiblog/blog/2008/10/29/imageopt-1/)
-   [Image Optimization Part 3: Four Steps to File Size Reduction](/yuiblog/blog/2008/11/14/imageopt-3/)
-   [Image Optimization Part 4: Progressive JPEG…Hot or Not?](/yuiblog/blog/2008/12/05/imageopt-4/)

This second installment of the image optimization series talks about file formats and how to chose the right one for the job. We'll briefly discuss the popular GIF and JPEG formats and then move on to highlighting the rock star, PNG, hopefully helping correct some misconceptions about it.

### GIF

GIF is a palette (also called "indexed") type of image. It contains a palette of indexed colors, up to 256, and for every pixel of the image there is a corresponding color index. The format is no longer subject to patent issues, so you can create GIFs without the risk of going to jail. (For more on the history of the GIF format, [click here](http://www.cloanto.com/users/mcb/19950127giflzw.html).)

GIF is a _non-lossy_ format, which means that when you modify the image and save it, you don't lose quality.

GIF also support animations, which, in the dark Web 1.0 ages, resulted in a plethora of blinking "new" images, rotating @ signs, birds dropping ... an email, and other annoyances. In the much more civilized Web 2.0 era, we still have "loading..." animations while we wait for the results of the next Ajax request to update the page, but there are also things like the good old shiny sparkles that people like to put in their social network profiles. Nevertheless, animation support is here if you need it.

GIF also supports transparency, which is a sort of boolean type of transparency. A pixel in a GIF image is either fully transparent or it's fully opaque.

### JPEG

JPEG doesn't have the 256 colors restriction associated with GIFs; it can contain millions of colors and it has great compression. This makes it suitable for photos and, in fact, most cameras store photos in JPEG format. It's a _lossy_ format, meaning you lose quality with every edit, so it's best to store the intermediate results in a different format if you plan to have many edits. There are, however, some operations that can be performed losslessly, such as cropping a part of the image, rotating it or modifying meta information, such as comments stored in the image file.

JPEG doesn't support transparency.

### PNG

PNGs is a _non-lossy_ format that comes in several kinds, but for practical purposes, we can think of PNGs as being of two kinds:

1.  PNG8, and
2.  truecolor PNGs.

PNG8 is a palette image format, just like GIF, and 8 stands for 8 bits, or 28, or 256, the number of palette entries. The terms "PNG8", "palette PNG" and "indexed PNG" are used interchangeably.

How does PNG8 compare to GIF?

-   Pros:
    -   it usually yields a smaller file size
    -   it supports alpha (variable) transparency
-   Cons:
    -   no animation support

The second type of PNGs, truecolor PNGs, can have millions of colors, like JPEG. You can also sometimes come across the names PNG24 or PNG32.

And how does truecolor PNG compare to JPEG? On the pros side, it's non-lossy and supports alpha transparency, but on the cons side, the file size is bigger. This makes truecolor PNG an ideal format as an intermediate between several edits of a JPEG and also in cases where every pixel matters and the file size doesn't matter much, such as taking screeenshots for a help manual or some printed material.

### Internet Explorer and PNG transparency

We said that both PNG types support alpha transparency, but there are some browser eccentricities that affect both types and about which you should be aware.

With PNG8, whenever you have semi-transparent pixels they appear as fully transparent in IE (version 6 and lower). This is not ideal but it's still useful and is the same behavior that you get from a GIF. So by using a PNG8, in the worst case (IE < 7) you get the same user experience as with a GIF, while for other browsers (Firefox, Safari, Opera) you get a better experience. Below is an example that illustrates this, note how in IE6 the semi-transparent light around the bulb is missing (source: [SitePoint](http://www.sitepoint.com/blogs/2007/09/18/png8-the-clear-winner/)):![PNG8 alpha transparency](/yuiblog/blog-archive/assets/png8-transparency.png)

For truecolor PNGs, the situation is a much less attractive compromise. All the semi transparent pixels appear grey in IE prior to version 7 (source: [W3C](http://www.w3.org/Graphics/PNG/inline-alpha.html)).![transparency in truecolor PNG](/yuiblog/blog-archive/assets/png-transparency.png)

IE7 introduces proper native support for alpha transparency in both PNG8 and truecolor PNGs. For earlier IE versions you need to fix the truecolor PNG transparency issue using CSS and an AlphaImageLoader filter, which we'll discuss in more details in a follow-up article. (Spoiler alert: _avoid AlphaImageLoader_.)

### "All we are saying is: Give PiNG a chance!"

Although PNG8 should be the preferred of the PNGs, because it's smaller in filesize and degrades well in early IEs without special CSS filters, there are still some use cases for truecolor PNGs:

-   **When the 256 colors of the PNG8 are not enough, you may need a truecolor PNG.** This is a case you should try to avoid. On one hand, if you have thousands and thousands of colors, this starts to look like a case where JPEG will be better suited and will give better compression. On the other hand, if the colors are around a thousand or so, you may try to convert this image to a PNG8 and see if it looks acceptable. Very often, the human eye is not sensitive enough to tell the difference between 200 and 1000 colors. That depends on the image, of course; often you can safely remove 1000 colors, but sometimes removing even 2 colors results in an unacceptable image. In any event, try your potential truecolor PNG candidate as PNG8 and as JPEG and see if you like the result in terms of quality and file size.
-   **When most of the image is semi-transparent.** If only a small part of the image is semi-transparent, like around rounded corners, the GIF-like degradation of PNG8 is often OK. But if most of the image is translucent (think a PLAY button over a video thumbnail), you might not have a choice but to use the AlphaImageLoader hack.

At the end, let's summarize what was discussed in this article highlighting that:

-   JPEG is the format for photos.
-   GIF is the format for animations.
-   PNG8 is the format for everything else — icons, buttons, backgrounds, graphs...you name it.