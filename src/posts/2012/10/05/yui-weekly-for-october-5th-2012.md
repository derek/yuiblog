---
layout: layouts/post.njk
title: "YUI Weekly for October 5th, 2012"
author: "Derek Gathright"
date: 2012-10-05
slug: "yui-weekly-for-october-5th-2012"
permalink: /blog/2012/10/05/yui-weekly-for-october-5th-2012/
categories:
  - "YUI Weekly"
---
-   YUIConf Updates! [Early-bird registration](/yuiblog/blog/2012/10/05/yuiconf-2012-early-bird-registration-open/) is open, and you now have until October 10th to [submit your speaker proposals](/yuiblog/blog/2012/10/04/deadline-to-submit-yuiconf-2012-talk-proposals-extended/).
    
-   This week saw continued work towards the next release of YUI and the conclusion of our current 3.7.x sprint, which seeks to bring improved support to YUI 3.7+ for Windows 8 and IE10. For the most part, everything has worked great, but there are some differences in things like XML and tighter security policies that have needed either small tweaks or new sub-modules. If you are curious to see what kind of changes were needed, you can follow along the [commit history](https://github.com/yui/yui3/commits/ie10) on the IE10 branch. Once we complete our Windows 8 development, we hope to wrap it all up in a blog post detailing everything we've learned so far about Windows 8's [four JS runtimes](https://github.com/yui/yui3/wiki/Windows-8-JavaScript-Runtimes) and YUI.
    
-   One of the things being used for new WinJS sub-modules is a feature in YUI's Loader, which we call capability-based loading. This was a feature added in [YUI 3.2](/yuiblog/blog/2010/07/26/3-2-0pr1/) which allows the library to segregate non-standard code into new sub-modules, and only load in those modules when necesary, thus improving performance and reducing k-weight for standards-based browers. If you are unfamiliar with this feature and interested in using it in your own apps, capability-based loading has its own recipe in the YUI 3 Cookbook ([O'Reilly](http://shop.oreilly.com/product/0636920013303.do), [Amazon](http://www.amazon.com/YUI-3-Cookbook-Cookbooks-OReilly/dp/1449304192/)), and you can read a preview of that chapter on [Google Books](http://books.google.com/books?id=babK068x7JIC&pg=PA34&lpg=PA34&dq=yui+3+cookbook+1.15&source=bl&ots=gtszcA5k5a&sig=nrf_gVAs7u_h91qm8d21C685Kgo&hl=en&sa=X&ei=jU9vULmsEOGWiAKbkoCQCg&ved=0CDAQ6AEwAA#v=onepage&q=yui%203%20cookbook%201.15&f=false).
    
-   Much of the Windows 8 testing has been doing using [YUIMetroTester](https://github.com/tilomitra/YUIMetroTester), an app that was built to run YUI's automated tests inside a native WinJS app. If you are curious about YUI+WinJS development, or would like to run your own test suite inside it, feel free to use it as a reference guide or starting point.
    
-   If you are interested in deploying your YUI apps on [Heroku](http://heroku.com/), you might find [this repository](https://github.com/triptych/yui3-heroku-example-simple) interesting. It's a simple starter app paired with step-by-step instructions on how to use Heroku as a hosting service.
    
-   The YUI [development schedule](https://github.com/yui/yui3/wiki/Development-Schedule) has been updated to include the latest information about our current sprints and upcoming releases, including 3.7.3 and 3.8.
    
-   Version bumps this week for one our the YUI devtools, [Yogi](https://github.com/yui/yogi/). Upgrade with `npm -g install yogi`.
    
-   New/updated modules in the [Gallery](http://yuilibrary.com/gallery/) this week: [node-fitvids](http://yuilibrary.com/gallery/show/node-fitvids), [datatable-col-resize](http://yuilibrary.com/gallery/show/datatable-col-resize), [layout](http://yuilibrary.com/gallery/show/layout), [fwt-treeview](http://yuilibrary.com/gallery/show/fwt-treeview), [flyweight-tree](http://yuilibrary.com/gallery/show/flyweight-tree), [anim-native](http://yuilibrary.com/gallery/show/anim-native), [event-selection](http://yuilibrary.com/gallery/show/event-selection), [itsatoolbar](http://yuilibrary.com/gallery/show/itsatoolbar), [zui-rascroll](http://yuilibrary.com/gallery/show/zui-rascroll), [bottle](http://yuilibrary.com/gallery/show/bottle), [nmresizer](http://yuilibrary.com/gallery/show/nmresizer), and [nmpjaxplus](http://yuilibrary.com/gallery/show/nmpjaxplus).