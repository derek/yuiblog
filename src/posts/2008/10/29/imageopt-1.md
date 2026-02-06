---
layout: layouts/post.njk
title: "Image Optimization Part 1: The Importance of Images"
author: "Stoyan Stefanov"
date: 2008-10-29
slug: "imageopt-1"
permalink: /2008/10/29/imageopt-1/
categories:
  - "Development"
---
_This is part 1 in an ongoing series. You can read the other parts here:_

-   [Image Optimization Part 2: Selecting the Right File Format](/yuiblog/blog/2008/11/04/imageopt-2/)
-   [Image Optimization Part 3: Four Steps to File Size Reduction](/yuiblog/blog/2008/11/14/imageopt-3/)
-   [Image Optimization Part 4: Progressive JPEG…Hot or Not?](/yuiblog/blog/2008/12/05/imageopt-4/)

This is the first in a series of posts about image optimization. In this series, I'll explore how images affect web site performance and what can you do to your images in order to improve page loading times. (I won't say how many posts in this series, so that I can claim later that I underpromised and overdelivered...).

When you think about improving page response time, one of the first obvious things to think about is the page weight. It's obvious that, all things being equal, the heavier a page is the slower it will be. If we take this to the extreme, we can say that the fastest page you can possibly have is the blank page. Once you start adding stuff to the blank page, you're only making it slower.

On a more serious note, it really is up to you how much content you want to put on a page, so let's focus on what comes next. After you've settled on the content, it's your job to make sure the content and components are as small as possible. Following our [Yahoo! performance best practices](http://developer.yahoo.com/performance/rules.html), you should make sure that all plain text components (HTML, XML, CSS, JavaScript...) are sent compressed over the wire and that you minify CSS and JavaScript.

But what about the images, how can you speed them up without sacrificing quality and looks? But first, does it really matter?

### How important are the images?

Before we start, let's see if we should even bother with images. Lately we've been witnessing the rise of rich internet applications with lots of JavaScript — by "lots" meaning sometimes 300K or more worth of JavaScript code. In other cases, especially in advertising, Flash seems to be the weapon of choice. So, on average, how much of the page weight is images. It's easy to answer this question by just looking at [Alexa's top 10 websites](http://www.alexa.com/site/ds/top_sites) in the world (as of October 2008) and use [YSlow](http://developer.yahoo.com/yslow/) to check what percent of the total page weight is images. The results are given below.

<table border="1" id="imagekweight" width="350"><caption>Percentage of page weight that goes to images, average 46.6%</caption><tbody><tr><td>1</td><td>Yahoo!</td><td>39%</td></tr><tr><td>2</td><td>Google</td><td>75%</td></tr><tr><td>3</td><td>YouTube</td><td>37%</td></tr><tr><td>4</td><td>Live.com</td><td>94%</td></tr><tr><td>5</td><td>Facebook</td><td>39%</td></tr><tr><td>6</td><td>MSN</td><td>59%</td></tr><tr><td>7</td><td>MySpace</td><td>36%</td></tr><tr><td>8</td><td>Wikipedia</td><td>34%</td></tr><tr><td>9</td><td>Blogger</td><td>28%</td></tr><tr><td>10</td><td>Yahoo! JP</td><td>25%</td></tr></tbody></table>

#chart { width: 530px; height: 350px; } .chart\_title { display: block; font-size: 1.2em; font-weight: bold; margin-bottom: 0.4em; } /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

On average, **46.6%** of the page weight for these popular sites consists of images, included either inline with `<img>` tags or via CSS stylesheets. Other studies show that this percent can be even higher, depending on the cross section of sites you examine. The exact number is not important, because every site is unique and different from the average; for example [Amazon's](http://amazon.com/) home page was made of 75% images at the time of the experiment.

This is a massive percentage and it tells us one thing: There's huge potential to improve the performance of websites if we can improve the way we handle the image payload. By focusing on images you can make a difference and delight your site visitors with a faster and more pleasant experience.

### To be continued...

Over the course of the following weeks, we'll be publishing more about image optimization. The topics for discussion include:

-   different image formats and how to pick the right one
-   ways to put your images on a diet without compromising quality
-   optimizing generated images
-   the effect of using `AlphaImageLoader`
-   favicons
-   CSS sprites
-   serving images faster

The series of posts will not require Photoshop or other designers' domain-specific knowledge, so it should be pretty easy for anyone to learn and apply these techniques. More to come soon...