---
layout: layouts/post.njk
title: "YUI Weekly - Aug 24th, 2012"
author: "Derek Gathright"
date: 2012-08-24
slug: "this-week-in-yui-aug-24th-2012"
permalink: /2012/08/24/this-week-in-yui-aug-24th-2012/
categories:
  - "YUI Weekly"
---
-   Early in the week Dav sent an email to the team, "_I couldn't sleep last Thursday night so..._" \[at this point, you know something awesome happened\] "_... so I stayed up and wrote a builder replacement for the YUI 3 project._" Introducing [Shifter](https://github.com/davglass/shifter)! We're in the process of removing all Ant remnants (build.xml files, .properties files, etc.) and officially using Shifter as YUI's build tool. So if you are a developer who builds YUI from source, `npm -g install shifter`. Depending on your system, you should see build times improved anywhere from 30% to 1000%! More to come.
    
-   As part of a new builder, we published a package called [yui-lint](https://github.com/yui/yui-lint/blob/master/yui-lint.js). These are our recommended JSLint configurations for doing YUI development, and will be used on all of our development tools.
    
-   If you missed it, we published our [YUI Target Environments](/yuiblog/blog/2012/08/21/yui-target-environments/) matrix, which is YUI's list of testing environments. Based on traffic both inside the Y! network and across the rest of the Web, these are the browsers (and JS engines) that have a sizable enough user base that warrants testing of the library.
    
-   It's coming up to that time of year again, YUIConf! We're still in the early-planning stages, so nothing to announce just yet aside from sharing that we're targeting early-November. So time to start thinking about ideas for talk proposals. Stay tuned!
    
-   YUI's testing tool [Yeti](https://github.com/yui/yeti) now displays code coverage results. See commit [fe4a563a20](https://github.com/yui/yeti/commit/fe4a563a20b33fd2c9bd7da05deca8711d3c641b) for more details.
    
    ```
    yeti src/widget-stdmod/tests/unit/widget-stdmod.html
    Connected to http://localhost:9000
     Agent connected: Safari (6.0) / Mac OS
    ✔ Testing started on Safari (6.0) / Mac OS
    Testing... \ 100% complete (1/1) 190.78 tests/sec 
    93% line coverage ✔ Agent completed: Safari (6.0) / Mac OS
    8 tests passed! (883ms)
    ```
    
-   If you are in an OSX/Linux/BSD environment, here's a quick alias you can run daily to stay up to date with the latest changes in our developer tools, `echo "alias yuiupdate='sudo npm -g install yuidocjs selleck shifter grover yuitest yeti'" >> ~/.bashrc`
    
-   Thanks to [clickholddrag](https://github.com/clickholddrag), [ArnaudD](https://github.com/ArnaudD), [rgrove](https://github.com/rgrove), and [clarle](https://github.com/clarle) for the [pull requests](https://github.com/yui/yui3/pulls) this week. Special hat-tip to rgrove for his [speed improvements](https://github.com/yui/yui3/pull/226) to Y.merge, something that should help out across most of the library.
    
-   Jeff Pihach (aka: [Hatch](http://yuilibrary.com/gallery/user/hatch)) recently wrote some blogs posts on his experience using YUI in Cordova, so if you are into mobile development with YUI, give them a read: [Guide to using YUI with PhoneGap (Cordova)](http://fromanegg.com/post/24952800088/guide-to-using-yui-with-phonegap-cordova) and [Loading YUI from Yahoo!’s CDN for PhoneGap (Cordova)](http://fromanegg.com/post/26291754575/loading-yui-from-yahoo-s-cdn-for-phonegap-cordova%20work).
    
-   Steven Olmsted (aka: [solmsted](http://yuilibrary.com/gallery/user/solmsted)) wrote a [Diablo 3 Skill Calculator](http://d3skillcalculator.com/calc/0) using the [YUI App Framework](http://yuilibrary.com/yui/docs/app/) and [gallery-lazy-load](http://yuilibrary.com/gallery/show/lazy-load). So if you are curious to see either of those (or both) in action, crack open Chrome/Safari dev tools and inspect around through the JS.
    
-   New/Updated modules in the [Gallery](http://yuilibrary.com/gallery/) this week: [gallery-bootstrap-alert](http://yuilibrary.com/gallery/show/bootstrap-alert), [gallery-bootstrap-dropdown](http://yuilibrary.com/gallery/show/bootstrap-dropdown), [gallery-bootstrap-tabview](http://yuilibrary.com/gallery/show/bootstrap-tabview), [gallery-bootstrap-popover](http://yuilibrary.com/gallery/show/bootstrap-popover), [gallery-bootstrap-tooltip](http://yuilibrary.com/gallery/show/bootstrap-tooltip), [gallery-bootstrap-collapse](http://yuilibrary.com/gallery/show/bootstrap-collapse), [gallery-nmpjaxplus](http://yuilibrary.com/gallery/show/nmpjaxplus), [gallery-datatable-footerview](http://yuilibrary.com/gallery/show/datatable-footerview), [gallery-paginator-view](http://yuilibrary.com/gallery/show/paginator-view), [gallery-zui-scrollsnapper](http://yuilibrary.com/gallery/show/zui-scrollsnapper), [gallery-zui-rascroll](http://yuilibrary.com/gallery/show/zui-rascroll), [gallery-zui-attribute](http://yuilibrary.com/gallery/show/zui-attribute), [gallery-md-model](http://yuilibrary.com/gallery/show/md-model). Thanks everyone!
    

If you have anything interesting to share, please leave a comment below. Thanks!