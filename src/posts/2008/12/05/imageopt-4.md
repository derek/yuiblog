---
layout: layouts/post.njk
title: "Image Optimization, Part 4: Progressive JPEG...Hot or Not?"
author: "Stoyan Stefanov"
date: 2008-12-05
slug: "imageopt-4"
permalink: /2008/12/05/imageopt-4/
categories:
  - "Performance"
  - "Development"
---
_This is part 4 in an ongoing series. You can read the other parts here:_

-   [Image Optimization Part 1: The Importance of Images](/yuiblog/2008/10/29/imageopt-1/)
-   [Image Optimization Part 2: Selecting the Right File Format](/yuiblog/2008/11/04/imageopt-2/)
-   [Image Optimization Part 3: Four Steps to File Size Reduction](/yuiblog/2008/11/14/imageopt-3/)

In the [previous article](/yuiblog/2008/11/14/imageopt-3/), the progressive JPEGs were briefly mentioned as a possible option when optimizing JPEGs. This post now diggs into this option a little deeper with the results of an optimization experiment involving over 10,000 images.

### Baseline vs. progressive JPEGs

Baseline are the "normal" JPEGs, the type of JPEG that all image programs write by default. The browsers load them top-to-bottom as more of the image information comes down the wire.[![Loading a baseline JPEG](/yuiblog/blog-archive/assets/5-base-example-small.jpg)](/yuiblog/blog-archive/assets/5-base-example.jpg)

Loading a baseline JPEG, click to enlarge

Progressive JPEGs are another type of JPEGs, they are rendered, as the name suggests, progressively. First you see a low quality version of the whole image. Then, as more of the image information arrives over the network, the quality gradually improves.[![Loading a baseline JPEG](/yuiblog/blog-archive/assets/4-prog-example-small.jpg)](/yuiblog/blog-archive/assets/4-prog-example.jpg)

Loading a progressive JPEG, click to enlarge

From usability perspective, progressive is usually good, because the user gets feedback that something is going on. Also if you're on a slow connection, progressive JPEG is preferable because you don't need to wait for the whole image to arrive in order to get an idea if it is what you wanted. If not, you can click away from the page or hit the back button, without waiting for the (potentially large) high quality image.

A reason against progressive JPEGs I've heard is that they look a bit old school and that users might be underimpressed, if not irritated, by the progressive rendering. I am not aware of a user study that focuses on this issue, please comment if you have heard or conducted such a experiment.

There is controversial information in blogs and books whether progressive JPEGs are bigger or smaller than the baseline JPEGs in terms of file size. So, as part of the never-ending quest for smaler file sizes and lossless optimization, here is an experiment that attempts to answer this question.

### The experiment

One of the [many free APIs](http://developer.yahoo.com/everything.html) that Yahoo! provides is the [image search API](http://developer.yahoo.com/search/image/V1/imageSearch.html). I used it to find images that match a number of queries, such as "kittens", "puppies", "monkeys", "baby", "flower", "sunset".. 12 queries in total. Once having the image URLs, I downloaded all the images and cleaned up 4xx and 5xx error responses and non-jpegs (turned out sometimes sites host PNGs or even BMPs renamed as .jpg). After the cleanup there were 10360 images to work with, images of all different dimensions and quality, and best of all, real life images from live web sites.

Having the source images, I ran them through jpegtran twice with the following commands:

`> jpegtran -copy none -optimize source.jpg result.jpg`

and

`> jpegtran -copy none -progressive source.jpg result.jpg`

The first one optimizes the Huffman tables in the baseline JPEGs (details discussed in the previous article). The second command converts the source JPEGs into progressive ones.

Let's see what the result file sizes turn out to be.

### Results

> The Census report, like most such surveys, had cost an awful lot of money and didn't tell anybody anything they didn't already know — except that every single person in the Galaxy had 2.4 legs and owned a hyena. Since this was clearly not true the whole thing had eventually to be scrapped.

Douglas Adams — "So Long, and Thanks for All the Fish"

The median JPEG returned in this experiment was 52.07 Kb, which is probably not the most useful statistic. The important thing is that the median saving when using jpegtran to optimize the image losslessly as a **baseline JPEG is 9.04%** of the original (the median image becomes 47.36 Kb) and when using a **progressive JPEG, it's 11.45%** (46.11 Kb median).

So it looks like progressive JPEGs are smaller on average. But that's only the average, it's not a hard rule. In fact in more than 15% of the cases (1611 out of the 10360 images) the progressive JPEG versions were bigger. Since it's difficult to predict when an image will be smaller as progressive by just looking at it (or for automated processing without even looking at it), an idea of how the image will perform based on its dimensions or file size would be really helpful.

Looking for a relationship, I plotted all the results on a graph where:

-   Y is the difference in the savings "baseline minus progressive", so negative numbers will mean cases when baseline is smaller
-   X is the file size of the original image

The graph shows how the results are all over the place, but there seems to be a trend — the bigger the image, the better it is to save it as a progressive JPEG.![Progressive vs baseline JPEG](/yuiblog/blog-archive/assets/1-progressive-jpeg-overview.png)

"Zooming" into the area of smaller file sizes to see where progressive JPEGs get less effective, let's only consider the images that are 30K and under. Then using the trendline feature of Excel, we can see where the line is drawn (for a clearer trendline mouse over or focus or click the image).[![Progressive vs baseline JPEG for smaller images](/yuiblog/blog-archive/assets/2-progressive-jpeg.png)](/yuiblog/blog-archive/assets/3-progressive-jpeg.png)

### Summary

The take-home messages after looking at the graphs above:

-   when your JPEG image is under 10K, it's better to be saved as baseline JPEG (estimated 75% chance it will be smaller)
-   for files over 10K the progressive JPEG will give you a better compression (in 94% of the cases)

So if your aim is to squeeze every byte (and consitency is not an issue), the best thing to do is to try both baseline and progressive and pick the smaller one.

The other option is have all images smaller than 10K as baseline and the rest as progressive. Or simply use baseline for thumbs, progressive for everything else.

### IE and progressive JPEGs

"Oh, not IE again!" is probably what you're thinking, but it's not so bad actually. It's just that IE doesn't render progresive JPEGs progressively. It displays the image just fine, but only when it arrives completely. So in IE, the baseline JPEGs display more progressively (top-to-bottom is still progress) than the progressive JPEGs.

### A word on ImageMagick

ImageMagick is a an impressive set of command-line image tools, which you can also use to optimize files. Unlike most other image software, by default ImageMagick writes **optimized** baseline JPEGs (as if using the -optimize switch in jpegtran).

ImageMagick can also strip meta data and write progressive JPEGs, so I repeated the experiment outlined above but using ImageMagick instead of jpegtran. The commands used were:

```
>convert -strip source.jpg result.jpg // baseline JPG
>convert -strip -interlace Plane source.jpg result.jpg // progressive JPEG

```

Observations from the ImageMagick experiment:

-   The baseline vs. progressive trendline is the same: images 10K or bigger are better optimized when using progressive encoding
-   The overall compression is better: the median is **10.85% optimization for baseline JPEGs** (jpegtran saved 9.04%) and **13.25% for progressive JPEGs** (11.45% with jpegtran)
-   There is some quality loss. ImageMagick doesn't perform fully lossless operations. Inspecting random images visually I couldn't tell any difference but using [an image diff](http://www.phpied.com/image-diff/) utility shows that pixel information in the images has been modified.

And the last set of stats gleaned from the experiment has to do with the speed of writing JPEGs. Here's how jpegtran and ImageMagick performed while optimizing the 10k+ images on my laptop (Windows XP, 2GHz dual CPU, 500Mb RAM). From fastest to slowest:

1.  jpegtran baseline (11 images per second),
2.  jpegtran progressive (9 images/s),
3.  ImageMagick baseline (7 images/s),
4.  ImageMagick progressive (5.5 images/s)