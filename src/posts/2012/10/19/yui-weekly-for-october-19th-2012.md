---
layout: layouts/post.njk
title: "YUI Weekly for October 19th, 2012"
author: "Derek Gathright"
date: 2012-10-19
slug: "yui-weekly-for-october-19th-2012"
permalink: /2012/10/19/yui-weekly-for-october-19th-2012/
categories:
  - "YUI Weekly"
---
-   Just a reminder that [YUIConf 2012](http://lanyrd.com/2012/yuiconf/) is coming up in a few weeks! You can purchase tickets [here](https://www.regonline.com/yuiconf2012), and we'll be posting a speaker lineup soon.
    
-   You can now use YUI to build native apps on Windows 8! This week saw the release of YUI 3.7.3, a patch release to bring improved support to each of the four [Windows 8 JavaScript runtimes](https://github.com/yui/yui3/wiki/Windows-8-JavaScript-Runtimes). While the target of this release was native Windows 8 apps and IE10, we still encourage everyone using YUI 3.7 to upgrade since some updates will also help out non-IE10 browsers (e.g. Y.Transition fix for Firefox 16). You can learn more about this release from the [announcement](/yuiblog/2012/10/17/yui-3-7-3-windows-8-apps-and-ie-10/) as well as reviewing the [history rollup](https://github.com/yui/yui3/wiki/YUI-3.7.3-Change-History-Rollup). Kudos to everyone for the assistance with testing and pull requests!
    
-   Earlier this week, Dav Glass ([@davglass](https://twitter.com/davglass)) [announced](/yuiblog/2012/10/16/state-of-yui-compressor/) that YUI Compressor has been deprecated and replaced with [yuglify](https://github.com/yui/yuglify), a combination of [UglifyJS](https://github.com/mishoo/UglifyJS) and [node-cssmin](https://github.com/jbleuzen/node-cssmin) (a Node.js port of cssmin, the CSS minification tool in Compressor).
    
-   Yesterday, YUI engineers Satyen Desai ([@dezziness](https://twitter.com/dezziness)) and Eric Ferraiuolo ([@ericf](https://twitter.com/ericf)) talked with SmugMuggers Lee Shepherd ([@bigwebguy](https://twitter.com/bigwebguy)) and Luke Smith ([@ls\_n](https://twitter.com/ls_n)) about the gritty details of using `Y.Base.create()` in advanced ways with the `_buildCfg` property, and came up with some possible enhancements. Video of that conversation has been posted [here](http://www.youtube.com/watch?v=itYPu6UEuOg).
    
-   Thanks to Alberto Santini ([@albertosantini](https://github.com/albertosantini)) and Jeroen Versteeg ([@asystance](https://github.com/asystance)) for the calendar translation pull requests ([es](https://github.com/yui/yui3/pull/316), [es-AR](https://github.com/yui/yui3/pull/317), [it](https://github.com/yui/yui3/pull/315), & [nl](https://github.com/yui/yui3/pull/314)). If you have knowledge of languages currently unsupported in Y.Calendar, we'd love to have some additional contributions. You can view a list of the current languages files [here](https://github.com/yui/yui3/tree/master/src/calendar/lang).
    
-   QuirksMode [posted the results](http://www.quirksmode.org/blog/archives/2012/10/javascript_libr_1.html) of a survey conducted to measure JavaScript library usage. Among DOM-centric libraries, YUI ranked 2nd (behind jQuery), and 6th overall. You can participate in the survey [here](https://urtak.com/u/47197/).
    
-   Simon Højberg ([@shojberg](https://twitter.com/shojberg)) gave a live-coding [presentation](https://speakerdeck.com/u/hojberg/p/dat-yui-hack) of YUI at [Prov.JS](http://www.meetup.com/Prov-JS) last night. You can browse through or clone the [code](https://github.com/hojberg/cweepy) for an example of creating a simple application using Y.App on the client with a Node.js server. Thanks for the talk Simon!
    
-   [Stockpile](https://github.com/jafl/YUI-3-Stockpile) is a "YUI 3 combo handler built on NodeJS that supports versioning, either for individual modules or for bundles of modules."
    
-   Version bumps this week for the following YUI devtools: [shifter](https://github.com/yui/shifter), [grover](https://github.com/davglass/grover), [yuidoc](https://github.com/yui/yuidoc), [yogi](https://github.com/yui/yogi), and [yuglify](https://github.com/yui/yuglify). Upgrade with `npm install -g shifter grover yuidoc yogi uglify`.
    
-   Updated modules in the [Gallery](http://yuilibrary.com/gallery/) this week: [datatable-col-resize](http://yuilibrary.com/gallery/show/datatable-col-resize), [deferred](http://yuilibrary.com/gallery/show/deferred), and [get-selection](http://yuilibrary.com/gallery/show/get-selection).
    

<iframe allowfullscreen="allowfullscreen" frameborder="0" height="315" src="http://www.youtube.com/embed/itYPu6UEuOg?list=UUTHcgWOTU6gPje1g_U29tfQ&amp;hl=en_US" width="560"></iframe>