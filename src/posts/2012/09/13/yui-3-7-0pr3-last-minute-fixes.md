---
layout: layouts/post.njk
title: "YUI 3.7.0pr3 - Last Minute Fixes"
author: "Eric Ferraiuolo"
date: 2012-09-13
slug: "yui-3-7-0pr3-last-minute-fixes"
permalink: /blog/2012/09/13/yui-3-7-0pr3-last-minute-fixes/
categories:
  - "Releases"
---
Yesterday we released [YUI 3.7.0pr2](/yuiblog/blog/2012/09/12/yui-3-7-0pr2-final-round-of-testing/ "YUI 3.7.0pr2 – Final Round of Testing") and encouraged everyone to test it thoroughly, and you did! YUI 3.7.0pr3 is now available and contains some last minute fixes for issues you found in yesterday's release. It's on the [Yahoo! CDN](http://yui.yahooapis.com/3.7.0pr3/build/yui/yui-min.js "YUI 3.7.0pr3 seed file") (and as a [download](http://yui.zenfs.com/releases/yui3/yui_3.7.0pr3.zip "YUI 3.7.0pr3 Zip distribution")), and our [Staging website](http://stage.yuilibrary.com/) has the updated documentation.

### Issues Resolved in 3.7.0pr3

The following is the list of reported issues with 3.7.0pr2 that are **fixed in 3.7.0pr3:**

-   [Ticket #2532747](http://yuilibrary.com/projects/yui3/ticket/2532747): The switch to UglifyJS breaks some custom combo handlers and build scripts. There is a corresponding [Shifter issue](https://github.com/yui/shifter/issues/15), which is where the change were made.
    
-   [Ticket #2532746](http://yuilibrary.com/projects/yui3/ticket/2532746): Loader changes for pr2 create infinite loop on server-side builds. The corresponding code changes were in [Pull Request #257](https://github.com/yui/yui3/pull/257).
    
-   [Pull Request #256](https://github.com/yui/yui3/pull/256): This is a regression that fails to load some intl modules.
    
-   ScrollView had a few bugs fixed to address post-rendering dimension calculation ([#2532732](http://yuilibrary.com/projects/yui3/ticket/2532732)), a bug with mousewheel support ([#2532742](http://yuilibrary.com/projects/yui3/ticket/2532742)), and a bug with paginated flicking ([#2532739](http://yuilibrary.com/projects/yui3/ticket/2532739)).
    

### Keep Testing and Reporting Any Issues

Please update [Shifter](http://yui.github.com/shifter/) to the latest version (`npm -g i shifter`) and continue your testing with 3.7.0pr3. **Be sure to report any issues you find ASAP.** We are still planning to cut the next production-ready release of YUI on **Tuesday September 18, 2012**.

[Jay Shirley](https://github.com/jshirley) and [Ryan Grove](https://github.com/rgrove), thanks for testing yesterday's preview release and quickly report the issues you guys found! [Dav Glass](https://github.com/davglass), record time in deploying those fixes \\m/