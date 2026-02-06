---
layout: layouts/post.njk
title: "YUI Weekly for February 8th, 2013"
author: "Derek Gathright"
date: 2013-02-08
slug: "yui-weekly-for-february-8th-2013"
permalink: /2013/02/08/yui-weekly-for-february-8th-2013/
categories:
  - "YUI Weekly"
---
-   No new releases this week, but here's a reminder about upcoming deadlines for the [current development cycle](https://github.com/yui/yui3/wiki/Development-Schedule#wiki-next-release) (_Sprint 5_).
    
    -   February 12: Feature Complete Pull Request Deadline.
    -   February 15: Feature Complete Code Freeze.
    -   February 19: Stable Release Pull Request Deadline.
    -   February 22: Stable Release Code Freeze.
    -   February 26: Stable Release.
-   [AlloyYUI v2](http://alloyui.com/) (built on top of YUI) is out! Check out the [examples](http://alloyui.com/examples/), [API documentation](http://alloyui.com/api/), and the [AUI Rosetta Stone](http://alloyui.com/rosetta-stone/) to compare APIs between YUI, jQuery, and AUI. Congrats to the team at [Liferay](http://www.liferay.com/) and all of the contributors to the project.
    
-   [yui-contrib](https://groups.google.com/forum/?fromgroups=#!forum/yui-contrib) mailing list activity for the week:
    
    -   A [vote was held](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/I28zUGYPBoA) to deprecate [node-menunav](https://yuilibrary.com/yui/docs/node-menunav/) and [node-focusmanager](http://yuilibrary.com/yui/docs/node-focusmanager/).
    -   After gathering some feedback, Dav is going to [begin prototyping](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/5UW-lfBU5sE) with [Grunt](http://gruntjs.com/) for use within YUI's ecosystem.
    -   Dav also started [a discussion](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/9Fxieen0790) about YUI.Feature, which was discussed in a [Hangout](http://www.youtube.com/watch?v=f_uLt1sdngU) this week.
-   A couple new additions to the [YUI Theater](http://www.youtube.com/user/yuilibrary):
    
    -   "_Hangout with Dav Glass on Seed Changes and Feature Testing_" ([youtube](http://www.youtube.com/watch?v=f_uLt1sdngU))
    -   "_YUI Open RoundTable 2/7/2013_" ([youtube](http://www.youtube.com/watch?v=uRRE5JIUPVs&feature=plcp)) where Tilo & Jeff showed off a preview of [CSS List](http://tilomitra.github.com/csslist/) and [CSS Extras](http://jconniff.github.com/cssextras/).
-   [SmugMug Tree](https://github.com/smugmug/yui-gallery/tree/master/src/sm-tree) and [SmugMug Menu](https://github.com/smugmug/yui-gallery/tree/master/src/sm-menu) are now on the Gallery CDN as a preview to what is expected to be brought into YUI's core in an upcoming release. `Tree` already has a [pull request](https://github.com/yui/yui3/pull/429) submitted, and after some additional development `Menu` is expected to replace the now deprecated `node-menunav`. Here are the [API docs](http://smugmug.github.com/yui-gallery/api/) for each, and a [demo of Y.Menu](http://jsbin.com/iforun/2). Hat tip to Ryan Grove ([@yaypie](https://twitter.com/yaypie)) and the SmugMug team!
    
-   [Primrose](https://github.com/hojberg/primrose) is a BDD ([Behavior-driven development](http://en.wikipedia.org/wiki/Behavior-driven_development)) spec framework for YUI.
-   New and updated [Gallery](http://yuilibrary.com/gallery/) modules this week: [bottle](http://yuilibrary.com/gallery/show/bottle), [sm-tree](https://github.com/smugmug/yui-gallery/tree/master/src/sm-tree), [sm-menu](https://github.com/smugmug/yui-gallery/tree/master/src/sm-menu), [nmpjaxplus](http://yuilibrary.com/gallery/show/nmpjaxplus), [zui-attribute](http://yuilibrary.com/gallery/show/zui-attribute), [zui-placeholder](http://yuilibrary.com/gallery/show/zui-placeholder), [zui-rascroll](http://yuilibrary.com/gallery/show/zui-rascroll), [zui-scrollhelper](http://yuilibrary.com/gallery/show/zui-scrollhelper), and [zui-scrollsnapper](http://yuilibrary.com/gallery/show/zui-scrollsnapper).
    
-   Version bumps this week for the following YUI devtools: [grover](https://github.com/davglass/grover) and [shifter](https://github.com/yui/shifter/). Upgrade with `npm install -g grover shifter`.
    
-   Reads of the Week (thanks to [JavaScript Weekly](http://javascriptweekly.com/))
    
    -   [Deferreds and Promises in JavaScript](http://flaviocopes.com/deferred-and-promises-in-javascript/?utm_source=javascriptweekly&utm_medium=email)
    -   [Meet the New Stack, Same as the Old Stack](http://dailyjs.com/2013/02/04/stack/?utm_source=javascriptweekly&utm_medium=email)
    -   [Writing modular frontend components in 2013](http://www.netmagazine.com/features/writing-modular-frontend-components-2013?utm_source=javascriptweekly&utm_medium=email)
    -   [… and more](http://javascriptweekly.com/archive/116.html)
-   Finally... we discovered the reason for [one of JavaScript's great mysteries](http://s89997654.onlinehome.us/screencaps/Screenshot_2_8_13_3_42_PM.png).