---
layout: layouts/post.njk
title: "YUI Weekly for February 22, 2014"
author: "Clarence Leung"
date: 2014-02-22
slug: "yui-weekly-for-february-22-2014"
permalink: /2014/02/22/yui-weekly-for-february-22-2014/
categories:
  - "Development"
---
Welcome to another week for YUI Weekly - the weekly roundup of news and announcements from the YUI team and the community! We've got some exciting news about the upcoming release, a great guest on this week's Roundtable, and a new batch of YUIConf videos!

# Release News

We released the release candidate for **YUI 3.15.0** on February 19th, notably containing a new loading API through `Y.require`, additions to Promises, and a change to `ModelSync.Local`'s internal storage mechanism. We also got a lot of great contributions from the community during this release, so a big thank you to everyone who helped to make YUI better.

It's available for you to use [directly off our CDN](http://yui.yahooapis.com/3.15.0-rc-1/build/yui/yui-min.js), as a [zip](http://yui.zenfs.com/releases/yui3/yui_3.15.0-rc-1.zip), or installable through [npm](https://npmjs.org/package/yui).

You can see the full list of all of the changes in [our release rollup right here](https://github.com/yui/yui3/wiki/YUI-3.15.0-Change-History-Rollup). Please definitely let us know if you come across any bugs by [filing an issue on GitHub](https://github.com/yui/yui3/issues).

# Open Roundtable

This week's [Open Roundtable](http://www.youtube.com/watch?v=aUsAtkbDuBM) continued our **YUI in the Wild** series, where we chat with different folks from a variety of companies, who tell us about some cool things they've been doing with YUI, based on our past [In the Wild](/yuiblog/blog/category/in-the-wild/) blog posts.

For this week's guest, we had [Daniel Stockman](https://twitter.com/evocateur) from [Zillow](http://zillow.com) come in to talk about how they began to integrate the [d3 visualization library](http://d3js.org/) into their application. We talked about how to customize your own `d3` build, some ways of organizing an application using both `d3` and the YUI App Framework, and how Zillow is creating new build tools to improve developer productivity.

Zillow has a few of their tools that they use [open-sourced on GitHub](https://github.com/zillow), so definitely check them out over there!

If your company or team is interested in being featured on the next **YUI in the Wild**, feel free to contact [Andrew Wooldridge](https://twitter.com/triptych), our Community Engineer, and we can help you set up a time or discuss content!

# YUIConf Videos

The following YUIConf videos were released this week:

-   [Accessibility + YUI](https://www.youtube.com/watch?v=SuZHmz7yo04) by [Ted Drake](https://twitter.com/ted_drake) and Sarbbottam
-   [Grunt your World](http://www.youtube.com/watch?v=yZCK0MlfsL0) by [Akshay Patel](https://twitter.com/akshayp) and [Seth Bertalotto](http://twitter.com/redonkulus)

# More in the World of YUI

-   [John Lindal](/yuiblog/blog/2014/02/21/migrating-a-datetime-widget-from-yui-2-to-yui-3-a-case-study/) wrote a blog post on how he worked to migrate his application from YUI 2 to YUI 3. Check out the gallery modules that he created to help with that process, [gallery-datetime](http://jafl.github.io/yui-modules/datetime/) and [gallery-datetime-range](http://jafl.github.io/yui-modules/datetime-range/)

That's all for now - hope everyone has a great week, and get ready for the release of YUI 3.15.0!