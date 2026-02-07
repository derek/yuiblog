---
layout: layouts/post.njk
title: "YUI 3.7.0pr4 - Minor patch"
author: "Dav Glass"
date: 2012-09-14
slug: "yui-3-7-0pr4-minor-patch"
permalink: /2012/09/14/yui-3-7-0pr4-minor-patch/
categories:
  - "Releases"
---
Tuesday we released [YUI 3.7.0pr2](/yuiblog/2012/09/12/yui-3-7-0pr2-final-round-of-testing/ "YUI 3.7.0pr2 – Final Round of Testing") and encouraged everyone to test it thoroughly, and you did! YUI 3.7.0pr4 is now available and contains a last minute fix for an issue that was found in yesterday's release. It's on the [Yahoo! CDN](http://yui.yahooapis.com/3.7.0pr4/build/yui/yui-min.js "YUI 3.7.0pr4 seed file") (and as a [download](http://yui.zenfs.com/releases/yui3/yui_3.7.0pr4.zip "YUI 3.7.0pr4 Zip distribution")), and our [Staging website](http://stage.yuilibrary.com/) has the updated documentation.

### Issue Resolved in 3.7.0pr4

I recently fixed an issue in Shifter to properly support license comments (`/*!`) and that was part of the 3.7.0pr3 release yesterday. However, one file didn't get minified correctly (ticket [#2532753](http://yuilibrary.com/projects/yui3/ticket/2532753)). So I fixed that up as soon as I got word of it ([fixed commit](https://github.com/yui/shifter/commit/5c82862ddf91813b91d3eeba9e43a452722f3c8b)) and quickly deployed 3.7.0p4 with only the [one file changing](https://github.com/yui/yui3/commit/a7628fa434d3fbe40dd4f70ce13eda975838ca74).

### Keep Testing and Reporting Any Issues

Please update [Shifter](http://yui.github.com/shifter/) to the latest version (`npm -g i shifter`) and continue your testing with 3.7.0pr4. **Be sure to report any issues you find ASAP.** We are still planning to cut the next production-ready release of YUI on **Tuesday September 18, 2012**.