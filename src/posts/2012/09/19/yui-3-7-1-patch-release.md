---
layout: layouts/post.njk
title: "YUI 3.7.1 Patch Release"
author: "Andrew Wooldridge"
date: 2012-09-19
slug: "yui-3-7-1-patch-release"
permalink: /2012/09/19/yui-3-7-1-patch-release/
categories:
  - "Releases"
---
**NOTE: Be sure to update to the [latest patch release](/yuiblog/blog/2012/09/24/yui-3-7-2-patch-release/): 3.7.2.**

It's exciting to be part of a live and vibrant project that is so responsive to its community. That is most evident by things like releasing a new patch as soon as we find issues. We encourage you to update your code to **3.7.1** to take advantage of the latest fixes. Here's the [CDN link](http://yui.yahooapis.com/3.7.1/build/yui/yui-min.js), and it's also [available to download](http://yui.zenfs.com/releases/yui3/yui_3.7.1.zip). About this release:

-   This release fixes encoding issues with our build for people who are self-hosting YUI and serving it with a non-UTF-8 encoding.
    
-   The recommendation is for people to update to 3.7.1, there are no code changes, simply a rebuilding of some of our minified files which had non-ascii chars.