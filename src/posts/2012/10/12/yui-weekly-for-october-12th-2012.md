---
layout: layouts/post.njk
title: "YUI Weekly for October 12th, 2012"
author: "Derek Gathright"
date: 2012-10-12
slug: "yui-weekly-for-october-12th-2012"
permalink: /2012/10/12/yui-weekly-for-october-12th-2012/
categories:
  - "YUI Weekly"
---
-   [YUIConf 2012](http://yuilibrary.com/yuiconf/2012) is quickly approaching! Tickets are [now available](https://www.regonline.com/yuiconf2012), and we just posted some [new hotel information](/yuiblog/2012/10/12/additional-hotel-information-for-yuiconf-2012/) for anyone traveling into the Bay Area. Thanks to everyone who submitted a speaker proposal. We're currently digging through those and you'll hear back from us soon!
    
-   Development on YUI 3.7.3 is just about complete and should be out the door next week. This minor version bump will bring improved Windows 8 and Internet Explorer 10 support to YUI, which has been the bulk of core development over the previous few weeks. As always, check out our [Github wiki](https://github.com/yui/yui3/wiki) for more details about upcoming releases.
    
-   The [Y.Soon pull request](https://github.com/yui/yui3/pull/304) is getting some lively discussion, so chime on Github if you have any thoughts on it being included in YUI's core. For some background, Y.Soon is [currently in the Gallery](http://yuilibrary.com/gallery/show/soon) and is based on [setImmediate.js](https://github.com/NobleJS/setImmediate), a cross-browser implementation of the [setImmediate API](https://dvcs.w3.org/hg/webperf/raw-file/tip/specs/setImmediate/Overview.html). Nicholas Zakas has a [nice blog post](http://www.nczonline.net/blog/2011/09/19/script-yielding-with-setimmediate/) on the advantages of script yielding with setImmediate.
    
-   Yeti 0.2.12 is released with support for JUnit XML output for Jenkins and bugfixes. For more info, see the [0.2.12 release post](http://yeti.cx/blog/2012/10/yeti-0-2-12-released/) on the Yeti blog.
    
-   [Project Sikuli](http://sikuli.org/) is a really nifty way automate and test user interfaces using images, and one that we're investigating for use within YUI's suite of testing tools. Thanks to Yeti and 6,300+ unit tests, the vast majority of YUI's testing is now entirely automated. However, there are still some components such as [charts](http://yuilibrary.com/yui/docs/charts/) and [cssbutton](http://yuilibrary.com/yui/docs/button/cssbutton.html) that require manual visual testing, which is something we'd also love to automate as well. So if testing via screenshots is also an area of interest for your project, check it out and let us know what you think.
    
-   Speaking of testing, YUITest was featured in [this Smashing Magazine article](http://www.netmagazine.com/features/essential-javascript-top-five-testing-libraries) about top JavaScript testing libraries. Thanks guys!
    
-   Pat Cavit ([@Tivac](https://github.com/tivac)) threw together an [extension-view-parent](https://gist.github.com/2629600) module, which is a Y.View extension to help you out when working with Views requiring a parent/child relationship. See the README for more details and an example.
    
-   Something that was discovered during the ongoing Windows 8 testing is older versions of [Prettify](http://code.google.com/p/google-code-prettify/) do not render properly in IE10. Prettify's authors [fixed the issue](http://code.google.com/p/google-code-prettify/source/diff?spec=svn220&r=220&format=side&path=/trunk/js-modules/recombineTagsAndDecorations.js) earlier this year and we've now upgraded Prettify across all YUI's dev tools. However, there are still quite a few Gallery modules that include versions of Prettify that will not work in IE10, so if you own a module on [this list](https://gist.github.com/3880719), please upgrade to the latest version of Prettify. [yui-prettify-tools](https://github.com/derek/yui-prettify-tools) can assist you with that process.
    
-   Version bumps for the following YUI dev tools: [Grover](https://github.com/davglass/grover/), [Yogi](https://github.com/davglass/grover/), and [Yeti](https://github.com/yui/yeti). Upgrade with `npm install -g grover yogi yeti`. Also, if you have a fork of Selleck, please update your upstream URL to point to the new [Selleck repository](https://github.com/yui/selleck) within the YUI org on Github.
    
-   New/updated modules in the [Gallery](http://yuilibrary.com/gallery/) this week: [node-fitvids](http://yuilibrary.com/gallery/show/node-fitvids), [model-sync-multi](http://yuilibrary.com/gallery/show/model-sync-multi), and [bulkedit](http://yuilibrary.com/gallery/show/bulkedit). `model-sync-multi` is new to the Gallery this week, and is "a class extension for Y.Module allowing multiple model sync implementations to be used by a single model."