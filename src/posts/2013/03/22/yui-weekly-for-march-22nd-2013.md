---
layout: layouts/post.njk
title: "YUI Weekly for March 22nd, 2013"
author: "Derek Gathright"
date: 2013-03-22
slug: "yui-weekly-for-march-22nd-2013"
permalink: /blog/2013/03/22/yui-weekly-for-march-22nd-2013/
categories:
  - "YUI Weekly"
---
_Welcome to YUI Weekly, the weekly roundup of news and announcements from the YUI team and community. If you have any interesting demos or links you’d like to share, feel free to leave a comment below._

-   In this week's release news, a bug was discovered in 3.9.0's [Handlebars](http://yuilibrary.com/yui/docs/handlebars/) utility so we're working to include a fix for that into a patch release as soon as possible. For details on this issue check out [pull request #539](https://github.com/yui/yui3/pull/536). If this becomes a full 3.9.1 release and includes other fixes unrelated to Handlebars, you can have a peek the [yui:v3.9.0...yui:master](https://github.com/yui/yui3/compare/yui:v3.9.0...yui:master) compare to stay on top of all other inclusions since last week's [3.9.0 release](/yuiblog/blog/2013/03/13/announcing-yui-3-9-0/).
    
-   [Yeti 0.2.20 was released](/yuiblog/blog/2013/03/20/yeti-0-2-20-released/) to introduce efficiency improvements in addition to other bug fixes. Check out Yeti's [HISTORY.md](https://github.com/yui/yeti/blob/master/HISTORY.md#0220--2013-03-20) for more details.
    
-   A new version of [YUI GridBuilder](http://yui.github.com/gridbuilder/) was published to introduce a Chrome 25 fix, aesthetic improvements, and the ability to view unminified CSS.
    
-   Team member Andrew Wooldridge ([@triptych](https://twitter.com/triptych)) sat down with Anthony Pipkin ([@apipkin](https://twitter.com/apipkin)) for a chat about [Datatable](http://yuilibrary.com/yui/docs/datatable/) in this week's [Developer Spotlight](/yuiblog/blog/2013/03/20/developer-spotlight-anthony-pipkin-and-datatable/). If you have a few minutes to spare, take a look at the survey included in that blog post and give us your feedback on what can be done to improve Datatable. Thanks!
    
-   As discussed on [yui-contrib](https://groups.google.com/forum/#!forum/yui-contrib), YUI build results are now being sent to the [yui-build](https://groups.google.com/forum/#!forum/yui-build) group instead of yui-contrib. So if those updates interest you, be sure to subscribe to that group as well.
    
-   This week's [Roundtable](https://github.com/yui/yui3/wiki/Roundtable-Topics) ([video](http://www.youtube.com/watch?v=4eQdJ-Ss_tE)) featured a demo of [Y.Tipsy](https://github.com/tilomitra/tipsy) (a tooltip widget), as well as a discussion about the next patch release and [SemVer](http://semver.org/).
    
-   New and updated [Gallery](http://yuilibrary.com/gallery) modules include [WidgetPointer](http://github.com/tilomitra/WidgetPointer), [csslist](http://github.com/tilomitra/csslist), [sm-treeview](https://github.com/smugmug/yui-gallery/tree/master/src/sm-treeview), [i18n-formats](http://github.com/ashiksmd/i18n-formats), [patch-390-transition-htcbutterfly](https://github.com/zordius/zui/tree/master/src/patch-390-transition-htcbutterfly), [tipsy](https://github.com/tilomitra/tipsy), and [test-dom](https://github.com/klamping/yui3-gallery-contributions/tree/master/src/gallery-test-dom).
    
-   Version bumps this week for the following YUI devtools: [Yeti](https://github.com/yui/yeti), [Yogi](https://github.com/yui/yogi), [Shifter](https://github.com/yui/Shifter), and [YUI Doc](https://github.com/yui/yuidoc/). Upgrade with `npm install -g yeti yogi shifter yuidocjs`.
    
-   Links of the Week (thanks to [JavaScript Weekly](http://javascriptweekly.com)).
    
    -   [js-git](http://www.kickstarter.com/projects/creationix/js-git)
    -   [asm.js in Firefox Nightly](https://blog.mozilla.org/luke/2013/03/21/asm-js-in-firefox-nightly/)
    -   [How I Write Modules](http://substack.net/how_I_write_modules)
    -   [A JavaScript refresh](http://typedarray.org/javascript-refresh/)
    -   [... and more](http://javascriptweekly.com/archive/122.html)
-   And finally, if you are disappointed with Google's [decision to kill Reader](http://blogs.wsj.com/digits/2013/03/13/google-kills-reader-hits-a-nerve/) and are looking for a replacement, YUI's Drag & Drop example contains an [RSS reader](http://yuilibrary.com/yui/docs/dd/portal-example.html) that could serve as a basis for your own custom-built solution.