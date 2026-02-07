---
layout: layouts/post.njk
title: "YUI 2.7.0 on TaskSpeed"
author: "YUI Team"
date: 2009-04-13
slug: "yui-270-on-taskspeed"
permalink: /2009/04/13/yui-270-on-taskspeed/
categories:
  - "Releases"
  - "Performance"
  - "Development"
---
[![Screenshot of TaskSpeed](/yuiblog/blog-archive/assets/taskspeed/screenshot.png)](http://dante.dojotoolkit.org/taskspeed/)

A few months ago Peter Higgins, a contributor to the [Dojo Toolkit](http://dojotoolkit.org/), adapted the [SlickSpeed](http://mootools.net/slickspeed/) test framework to do higher level comparisons of how various JavaScript libraries perform when doing some "common" DHTML tasks. The new test framework is called [TaskSpeed](http://dante.dojotoolkit.org/taskspeed/). And thanks to the excellent work done by one of our favorite community members, [Eric Ferraiuolo](http://925html.com/), [YUI 2.7.0](http://developer.yahoo.com/yui/) now has representation in the matrix as well.

### About TaskSpeed

Whereas SlickSpeed compares the performance of the respective JavaScript CSS selector engines in common libraries, TaskSpeed attempts to qualify a larger set of library functionality with less granularity. The goal seems to be to predict what a library consumer might expect for aggregate speeds when developing on top of library A vs. library B.

In addition to each of the participating libraries, a "PureDom" column represents the performance of the given task with plain old JavaScript and direct DOM interaction, serving as a healthy reminder that the benefits you get from using a JavaScript library don't come for free. Unfortunately, "PureDom" might also be incorrectly construed as an argument in favor of not using a library at all, but that is a [separate and lengthy discussion](http://www.b-list.org/weblog/2007/jan/22/choosing-javascript-library/).

### The results

Though YUI 2.7.0 was only added to the matrix on April 10th, the results submitted so far suggest that YUI performs the given tasks with comparable efficiency in the newer browsers, and better than most in Internet Explorer 6, 7, and 8.

#### IE 8 results from Apr 10 – Apr 13

![Chart of IE8 performance comparisons](/yuiblog/blog-archive/assets/taskspeed/chart.png)

### Take-aways

Though YUI performs ably, it's my opinion that the numbers seen in TaskSpeed should be taken with a hefty grain of salt. The tests are designed to exercise library abstraction logic against DOM-intensive operations. The issue here is twofold:

1.  Not all libraries (YUI included) have abstraction logic for all of the specific tasks, which breaks the apples-to-apples comparison.
2.  And in order to get meaningful numbers, the test operations are iterated up to 500 times or performed against excessive numbers of nodes. In real-world cases, these conditions are not the norm, meaning the differences are exaggerated, perhaps even grossly.

By and large, TaskSpeed may be more of a distraction than a source of information useful to the consumer. My greatest concern is that people will make a decision to choose one library over another based on which one can add a ridiculous number of event subscribers in 25 milliseconds vs. 30, ignoring more important issues like cross-browser stability, code maintainability, documentation quality, and community support.

This is not to say that TaskSpeed is without value. Here are the interesting take-aways I've found:

1.  Accounting for the lengthy iterations TaskSpeed needs to make the numbers substantial, all libraries perform common tasks pretty quickly.
2.  Libraries are getting faster, as seen by comparing version to version of the same library where available.
3.  There is a performance price to pay for the stability and consistency any library offers.
4.  For the library authors and contributors, an _apples-to-apples_ comparison of task execution can highlight potential areas where we may each be able to evolve to use best-of-breed techniques for everyone's benefit!

I'd like to personally extend a big "thank you" to Eric Ferraiuolo for having done the fantastic legwork on this. Another great example of the importance of community contributions to the YUI library!