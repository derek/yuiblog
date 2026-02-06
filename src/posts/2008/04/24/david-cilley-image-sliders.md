---
layout: layouts/post.njk
title: "David Cilley's Tutorial Series on Ajax Image Sliders"
author: "YUI Team"
date: 2008-04-24
slug: "david-cilley-image-sliders"
permalink: /2008/04/24/david-cilley-image-sliders/
categories:
  - "Development"
---
[![David Cilley on Ajax image sliders using YUI.](/yuiblog/blog-archive/assets/imageslider1.jpg)](http://www.atalasoft.com/cs/blogs/davidcilley/archive/2008/04/21/ajax-image-sliders-part-2-intervals-with-on-demand.aspx)

[![David Cilley on Ajax image sliders using YUI.](/yuiblog/blog-archive/assets/imageslider2.jpg)](http://www.atalasoft.com/cs/blogs/davidcilley/archive/2008/04/21/ajax-image-sliders-part-2-intervals-with-on-demand.aspx)David Cilley this week published the second in his series of articles on using the [YUI Slider Control](http://developer.yahoo.com/yui/slider/) to provide real-time previewing of image changes.

-   [Part 1: The OnDemand method](http://www.atalasoft.com/cs/blogs/davidcilley/archive/2008/04/16/ajax-image-sliders-part-1.aspx).
-   [Part 2: The Interval method](http://www.atalasoft.com/cs/blogs/davidcilley/archive/2008/04/21/ajax-image-sliders-part-2-intervals-with-on-demand.aspx).

In this second installment, David takes on the challenge of making the preview _feel_ instantaneous without computing or delivering every possible image represented by the slider's continuum:

> On the previous slider example, I used a YUI slider that had a range from -100 to 100. This is a total of 201 different combinations for one image dialog, and that's about 10-20 times more requests than a web server should have to handle in a reasonable amount of time. We want to make this look as if the slider is actually changing the image while we scroll it, but we don't want to request 201 images up front, and we don't want to load them all on demand either.

A part 3 in the series, David notes, will continue to refine the control. \[**Update:** [David has posted Part 3.](http://www.atalasoft.com/cs/blogs/davidcilley/archive/2008/04/28/sliders-part-3-intervals-with-opacity.aspx)\]

For more Slider Control examples, check out the [YUI Slider example roster](http://developer.yahoo.com/yui/examples/slider/); and don't miss Todd Kloots's [Slider/Button example](http://developer.yahoo.com/yui/examples/button/btn_example14.html), which would be another way of presenting the control David is describing in his article series.