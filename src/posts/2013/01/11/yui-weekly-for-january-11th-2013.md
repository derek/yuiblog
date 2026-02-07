---
layout: layouts/post.njk
title: "YUI Weekly for January 11th, 2013"
author: "Derek Gathright"
date: 2013-01-11
slug: "yui-weekly-for-january-11th-2013"
permalink: /2013/01/11/yui-weekly-for-january-11th-2013/
categories:
  - "YUI Weekly"
---
_Welcome to YUI Weekly, the weekly roundup of news and announcements from the YUI team and community. If you have any interesting demos or links you’d like to share, leave a comment below._

-   And we're back! Over the coming week we're wrapping up development on the next release of YUI, scheduled for release on **January 22nd**.
    
-   Milestone - YUI reached [500 forks on Github](https://github.com/yui/yui3/network)! Thanks to everyone for the contributions and involvement. <3 <3 <3
    
-   Are you an exceptional JavaScript engineer and passionate about library development? If so, [YUI Is hiring](/yuiblog/2013/01/08/yui-is-hiring-2/)!
    
-   This week's Gallery deployment includes two new CSS modules developed by YUI team member Tilo Mitra ([@tilomitra](http://twitter.com/tilomitra)). The first is [csstables](https://github.com/tilomitra/csstables/) ([demo](http://tilomitra.github.com/csstables/)), which will make it super simple to style tables of data without the overhead of JavaScript. The second module is [cssforms](https://github.com/tilomitra/cssforms/) ([demo](http://tilomitra.github.com/cssforms/)), which is designed to help you create simple, stylish forms. Check 'em out!
    
-   **Six** new [YUIConf 2012](http://lanyrd.com/2012/yuiconf/) videos
    
    -   Bishan Kochar's "[Secure Coding with YUI](/yuiblog/2012/12/24/yuiconf-2012-talk-bishan-kochar-on-secure-coding-with-yui/)"
    -   Gamaiel Zavala's "[Adopting YUI App Framework on Yahoo! Media Sites](/yuiblog/2012/12/26/yuiconf-2012-talk-gamaiel-zavala-on-adopting-yui-app-framework-on-yahoo-media-sites/)"
    -   Ryan Cannon's "[Using YUI to Tackle Video](http://youtu.be/HUG1zL-bXTc)" Daniel Stockman's "[A Poignant Guide to Y.App](http://youtu.be/CH0wqEmvDIg)"
    -   YUIConf [Lightning Talks](http://youtu.be/JGoNbSWUTuI), featuring Tic Tac Loader, Gear, Mjata Charts, and Behavior-Driven Development
    -   Montie Tsai and Zordius Chen's "[Bottle Mobile UI Library](/yuiblog/2013/01/07/yuiconf-2012talk-bottle-mobile-ui-library-with-montie-tsai-and-zordius-chen/)"
    -   Reid Burke's "[Write Code That Works](/yuiblog/2013/01/10/yuiconf-2012-talk-reid-burke-on-write-code-that-works/)"
-   Two new Open Roundtable videos
    
    -   Jan 3rd, 2013 - [YouTube](http://youtu.be/hRv8nwA62k0)
    -   Jan 10th, 2013 - [YouTube](http://youtu.be/pOJHhq-5QXE), [Minutes](https://gist.github.com/4515169)
-   [YUI Modules Explorer](https://github.com/ipeychev/yui-modules-explorer) is a utility that will scan your YUI application and tell you what modules you should include. Very cool!
    
-   As discussed in yesterday's Open Rountable, we'd like to encourage the use of YUIDoc's `@since {version}` tag more ([docs](http://yui.github.com/yuidoc/syntax/index.html#since)). However, a pain point is that when you include that tag you don't always know what version of YUI your code will be released with. So, we came up with a solution: include a `@SINCE@` token as a placeholder, then as part of our release deployment process, we'll replace any instances of `@since @SINCE@` with `@since 3.9.0` (for example).
    
-   Discussions on the [yui-contrib](https://groups.google.com/forum/?fromgroups=#!forum/yui-contrib) mailing list:
    
    -   [Removing the build directory](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/HVMp7xZgYS0)
    -   [Avoid merging in topic branches with fast-forward option \[on by default\]](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/GhH2vMrlEZQ)
    -   [\[vote\] Deprecate Y.substitute()](https://groups.google.com/forum/?fromgroups=#!topic/yui-contrib/U9_T8XQrlNc)
-   Version bumps this week for the following YUI devtools: [grover](https://github.com/davglass/grover), [yogi](https://github.com/yui/yogi), [shifter](https://github.com/yui/shifter), [yeti](https://github.com/yui/yeti), and [yuglify](https://github.com/yui/yuglify). Upgrade with `npm install -g grover yogi shifter yeti yuglify`
    
-   New and Updated modules in the [Gallery](http://yuilibrary.com/gallery/) this week: [cssform](https://github.com/tilomitra/cssforms), [csstable](https://github.com/tilomitra/csstables), [flickr-carousel](https://github.com/hatched/flickr-carousel), [sm-tree](https://github.com/smugmug/yui-gallery/tree/master/src/sm-tree), [sm-treeview](https://github.com/smugmug/yui-gallery/tree/master/src/sm-treeview), [zui-attribute](http://yuilibrary.com/gallery/show/zui-attribute), [zui-placeholder](http://yuilibrary.com/gallery/show/zui-placeholder), [zui-scrollhelper](http://yuilibrary.com/gallery/show/zui-scrollhelper), [zui-scrollsnapper](http://yuilibrary.com/gallery/show/zui-scrollsnapper), [datatable-celleditor-inline](http://yuilibrary.com/gallery/show/datatable-celleditor-inline), [datatable-celleditor-popup](http://yuilibrary.com/gallery/show/datatable-celleditor-popup), [datatable-formatters](http://yuilibrary.com/gallery/show/datatable-formatters), and [datatable-editable](http://yuilibrary.com/gallery/show/datatable-editable).
    
-   Reads of the Week (thanks to [JavaScript Weekly](http://javascriptweekly.com/))
    
    -   [The State of Javascript Package Management](http://wibblycode.wordpress.com/2013/01/01/the-state-of-javascript-package-management/)
    -   [The Power Of Getters](http://webreflection.blogspot.de/2013/01/the-power-of-getters.html)
    -   [Using Form Elements and CSS3 to Replace JavaScript](http://www.adobe.com/devnet/html5/articles/using-form-elements-and-css3-to-replace-javascript.html)
    -   [... and more](http://javascriptweekly.com/archive/112.html)

Have a great weekend!