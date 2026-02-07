---
layout: layouts/post.njk
title: "YUI Weekly for March 29th, 2013"
author: "Derek Gathright"
date: 2013-03-29
slug: "yui-weekly-for-march-29th-2013"
permalink: /2013/03/29/yui-weekly-for-march-29th-2013/
categories:
  - "YUI Weekly"
---
_Welcome to YUI Weekly, the weekly roundup of news and announcements from the YUI team and community. If you have any interesting demos or links you’d like to share, feel free to leave a comment below._

-   This week saw the release of **[YUI 3.9.1](/yuiblog/2013/03/27/yui-3-9-1-released/)**. It was a patch release that includes bug fixes and enhancements for [Handlebars](https://yuilibrary.com/yui/docs/handlebars/), [LazyModelList](https://yuilibrary.com/yui/docs/model-list/#lazymodellist) fixes, and updates to [Y.Tree](https://yuilibrary.com/yui/docs/tree/). Details of all changes can be found in the [YUI 3.9.1 History Rollup](https://github.com/yui/yui3/wiki/YUI-3.9.1-Change-History-Rollup).
    
-   With the **3.9.1** release out the door, planning for the next release of YUI is underway! One big thing you can expect to see in the upcoming preview release is [Satyen Desai](http://yuilibrary.com/gallery/user/sdesai)'s work on `Base` performance improvements. By including [these updates](https://github.com/sdesai/yui3/compare/yui:dev-3.x...sdesai:attrs-event-perf), we're seeing a 2-5x improvement in the [base-benchmark](https://github.com/yui/yui3/blob/master/src/base/tests/benchmark/base-benchmark.js) perf tests in Chrome/OSX. Improvements in `Base` will affect anything extending it, which includes many other parts of the library. Stay tuned!
    
-   For those anxious to get started with the new `Y.Promise` component documentation is on the way! Here's the [pull request](https://github.com/yui/yui3/pull/563) and a Markdown formatted [Gist](https://gist.github.com/derek/5272048).
    
-   You can make nice-looking tooltips and popovers using YUI with the new Y.Tipsy and Y.Popover widget. Check out the [documentation and examples](http://tilomitra.github.com/tipsy/) to learn more.
    
-   This week's [Roundtable](https://github.com/yui/yui3/wiki/Roundtable-Topics) ([video](http://www.youtube.com/watch?v=ylR5AyMkNHo)) featured a demo of `Y.Tipsy`, a discussion about an upcoming [eventx hangout](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/pp3rrHiAUG8), a mid-April YUI meetup, Ryan's Man Cave, and recent pull requests.
    
-   Steven Olmsted (aka: [solmsted](http://yuilibrary.com/gallery/user/solmsted)) has been building a telephony platform on top of Node.js and YUI, and now the first telephony application built on top of that is live, the Alaska 511 Traveler Information System. If you're in Alaska you can call 5-1-1, or out of state callers can dial (866) 282-7577. When you call, an event gets fired, then a Base object gets instantiated, stuff is `.plug`ed into it, and you're on the phone with YUI! Looks like it is time to add telephony systems to our [target environments](http://yuilibrary.com/yui/environments/). _wink_
    
-   This week on [yui-contrib](https://groups.google.com/forum/?fromgroups=#!forum/yui-contrib), a discussion about [memory management in YUI](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/hP-Qg2jLQXo) popped up where we discuss issues, tips, and enhancement ideas. Chime in if you have any thoughts.
    
-   Version bumps this week for the following YUI devtools: [Yogi](https://github.com/yui/yogi) and [Shifter](https://github.com/yui/shifter/). Shifter now supports a `--yui-module` option. Upgrade with `npm install -g yogi shifter`.
    
-   New and updated [Gallery](http://yuilibrary.com/gallery/) modules include: [tipsy](https://github.com/tilomitra/tipsy), [widget-pointer](http://github.com/tilomitra/WidgetPointer), [sm-treeview](https://github.com/smugmug/yui-gallery/tree/master/src/sm-treeview), [sm-menu](https://github.com/smugmug/yui-gallery/tree/master/src/sm-menu), [popover](https://github.com/tilomitra/popover), [nmpjaxplus](http://yuilibrary.com/gallery/show/nmpjaxplus), [itsaviewmodel](https://github.com/ItsAsbreuk/yui3-gallery/tree/master/src/gallery-itsaviewmodel), [itsascrollviewkeynav](https://github.com/ItsAsbreuk/yui3-gallery/tree/master/src/gallery-itsascrollviewkeynav), [itsacalendarmodellist](https://github.com/ItsAsbreuk/yui3-gallery/tree/master/src/gallery-itsacalendarmodellist), [cssform](https://github.com/tilomitra/cssforms/), [csslist](https://github.com/tilomitra/csslist/), [csstable](https://github.com/tilomitra/csstables), [namespace-with-array](https://github.com/wenbing/yui3-modules/tree/master/src/gallery-namespace-with-array), and [facebook-dao](https://github.com/asotog88/yui3-gallery/tree/master/src/gallery-facebook-dao).
    
-   Have a hoppy Easter weekend everyone!