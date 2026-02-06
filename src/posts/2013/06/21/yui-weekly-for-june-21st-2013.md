---
layout: layouts/post.njk
title: "YUI Weekly for June 21st, 2013"
author: "Derek Gathright"
date: 2013-06-21
slug: "yui-weekly-for-june-21st-2013"
permalink: /2013/06/21/yui-weekly-for-june-21st-2013/
categories:
  - "YUI Weekly"
---
_Welcome to YUI Weekly, the weekly roundup of news and announcements from the YUI team and community. If you have any interesting demos or links you’d like to share, feel free to leave a comment below._

-   This week saw the release **YUI 3.11 PR1**. Our team's never-ending quest to make YUI faster and faster continues, and in this preview release you'll find some pretty fundamental changes to [Attribute](https://yuilibrary.com/yui/docs/attribute) and [Base](https://yuilibrary.com/yui/docs/base/) to help out performance. As noted in the [3.11PR1 release announcement](/yuiblog/blog/2013/06/19/3-11pr1-released/), some `Base` perf tests demonstrate a **6x** speed increase over 3.10.3, and a **15x** increase over 3.9.0! Additionally, this release includes the introduction of the [Paginator](http://stage.yuilibrary.com/yui/docs/paginator/) utility, as well as various bug fixes and other enhancements. A reminder, June 30th is the pull request deadline for the this release, so you have approximately one more week to submit anything you would like included in 3.11 (expected to ship July 16th). Happy testing!
    
-   As [mentioned](https://groups.google.com/forum/?fromgroups#!topic/yui-contrib/r_v_oxcMBsk) on the contributor mailing list, YUI has created two new support forums; [yui-support](https://groups.google.com/forum/#!forum/yui-support) and [yui-deprecated](https://groups.google.com/forum/#!forum/yui-deprecated), so please subscribe and let us know what you think!
    
-   Some contributors are currently working on a [YUI Cheat Sheet](https://github.com/yui/yui3/wiki/Cheat-Sheet-%28Newbie%29), so if you have anything to add, feel free to edit the wiki or chime in on the [yui-contrib discussion](https://groups.google.com/forum/?fromgroups#!topic/yui-contrib/AAlx_y1jrHo).
    
-   A few days ago, [a ticket](https://github.com/yui/yui3/issues/894) was filed to propose introducing [Moment.js](http://momentjs.com/) to the library, and in the discussion Ryan Grove ([@yaypie](http://twitter.com/yaypie)) mentioned [a simple trick](https://speakerdeck.com/yaypie/when-not-to-use-yui?slide=80) covered in his "[When Not to Use YUI](http://www.youtube.com/watch?v=8cTz73zdDuc)" talk at [YUIConf 2012](http://lanyrd.com/2012/yuiconf/). It's always worth revisiting the fact that [YUI Loader](http://yuilibrary.com/yui/docs/yui/loader.html) is a full featured JavaScript and CSS loader, and isn't restricted to only loading in YUI modules. Here's [a demonstration](http://jsbin.com/akevej/3/edit) of Ryan's trick in action, using Loader to include Moment.js and the popular 3D drawing library [Three.js](http://threejs.org/).
    
-   [yui-purecss.docpad](https://github.com/MassDistributionMedia/yui-purecss.docpad) is a [PureCSS](http://purecss.io/) skeleton for [DocPad](http://docpad.org/).
    
-   At this week’s [Open Roundtable](https://github.com/yui/yui3/wiki/Open-Roundtable) ([video](http://www.youtube.com/watch?v=0e7s9LPy9Zg)), YUI summer interns Rashad ([@rashadrussell](https://github.com/rashadrussell)) and Patrick ([@patjameson](http://twitter.com/patjameson)) gave demonstrations of two projects they are working on: a layout builder and some experiments with video chat using [Web RTC](http://www.webrtc.org/).
    
-   New and updated modules in this week’s [Gallery build](http://yuilibrary.com/gallery/buildtag/gallery-2013.06.20-02-07) include: [beacon-listener](http://github.com/Perturbatio/beacon-listener), [itsadialogbox](http://yuilibrary.com/gallery/show/itsadialogbox), [itsamodellistsyncpromise](https://github.com/ItsAsbreuk/yui3-gallery/tree/master/src/gallery-itsamodellistsyncpromise), [itsamodelsyncpromise](https://github.com/ItsAsbreuk/yui3-gallery/tree/master/src/gallery-itsamodelsyncpromise), [sm-treeview](https://github.com/smugmug/yui-gallery/tree/master/src/sm-treeview), and [template-factory](http://github.com/asotog88/yui-gallery-template-factory).
    
-   In the [last week](https://github.com/yui/yui3/pulse), YUI has seen 13 authors pushing 67 commits, 7 pull requests merged, 9 pull requests proposed, and 12 issues closed.
    
-   Links of the Week (thanks to [JavaScript Weekly](http://javascriptweekly.com))
    
    -   [Effectively Managing Memory at Gmail scale](http://www.html5rocks.com/en/tutorials/memory/effectivemanagement/)
    -   [What asm.js is and what asm.js isn't](http://mozakai.blogspot.co.uk/2013/06/what-asmjs-is-and-what-asmjs-isnt.html)
    -   [Using JavaScript's 'toString' Method](http://designpepper.com/blog/drips/using-javascripts-tostring-method)
    -   [Information Hiding in JavaScript](http://weblog.bocoup.com/info-hiding-in-js/)
    -   [Referencing DOM from JS: there must be a DRYer, safer way](http://blog.pamelafox.org/2013/06/referencing-dom-from-js-there-must-be.html)
    -   [Use forensics and detective work to solve JavaScript performance mysteries](http://www.html5rocks.com/en/tutorials/performance/mystery/)
    -   [... and more](http://javascriptweekly.com/archive/135.html)