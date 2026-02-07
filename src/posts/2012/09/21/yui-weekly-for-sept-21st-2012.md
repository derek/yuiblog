---
layout: layouts/post.njk
title: "YUI Weekly - Sept 21st, 2012"
author: "Derek Gathright"
date: 2012-09-21
slug: "yui-weekly-for-sept-21st-2012"
permalink: /2012/09/21/yui-weekly-for-sept-21st-2012/
categories:
  - "YUI Weekly"
---
-   3.7 is out! This was the first release on our quick-release cycle, but there was still a lot packed into the 6 weeks since 3.6. You'll find some [nice improvements](/yuiblog/2012/08/31/yui-3-7-0pr1-event-performance/) with custom events, a [big update](https://gist.github.com/3745807) to ScrollView, new modules like [event-tap](http://yuilibrary.com/yui/docs/api/modules/event-tap.html) & [node-scroll-info](http://yuilibrary.com/yui/docs/api/modules/node-scroll-info.html), and [lots more](/yuiblog/2012/09/18/announcing-yui-3-7-0/)! A quick follow up release to 3.7.0 is out the door with [3.7.1](/yuiblog/2012/09/19/yui-3-7-1-patch-release/), and 3.7.2 is in the works.
    
-   A big warm welcome to Andrew Wooldridge ([@triptych](http://twitter.com/triptych)) who [joins the YUI Team](/yuiblog/2012/09/18/yuis-new-community-engineer-and-yuiconf-dates-set/) as our first community engineer. Andrew is a current Yahoo and long-time member of the YUI community, so we're happy to see him come aboard to work with us (and you!) full-time. Head over to his blog to read some [YUI tutorials](http://andrewwooldridge.com/blog/yui3/), and check out slides from his [YUI: Hidden Gems](http://www.slideshare.net/triptych/yui-hidden-gems) talk at last year's YUIConf. Speaking of...
    
-   It's that time of year again, YUIConf! This will be YUI's 4th year hosting the 2-day event, and this time we're taking it off-campus to the Santa Clara Marriott. While we're working to [nail down the date](/yuiblog/2012/09/20/yuiconf-update-notice-potential-date-change/), we encourage you to continue cooking up your [talk proposals](/yuiblog/2012/09/19/submit-a-talk-for-yuiconf-2012/). More details to be announced soon!
    
-   For those of you who follow YUI's [bug tracker](http://yuilibrary.com/projects/yui3/report/) activity, new "Target Version" buckets have been created to help out with our new [branch strategy](https://github.com/yui/yui3#branches) and quick-release cycle.
    
    -   3.CURRENT.NEXT: Bug fixes to the current release (e.g. 3.7.2).
    -   3.NEXT: Code to be included in the next major version (e.g. 3.8.0)
    -   BACKLOG: Tickets that haven't been scheduled yet
    -   FUTURE: Tickets that haven’t been scheduled yet, but will be soon
-   A recent addition to the Gallery is [gallery-bottle](http://zordius.github.com/yui3-gallery/gallery-bottle/), an HTML5 framework for mobile UI components. Hat tip to all the [contributors](http://zordius.github.com/yui3-gallery/gallery-bottle/contributers.html) involved in the project for extensive documentation and demos. Nice work!
    
-   As we move towards faster releases, it can be handy to quickly bounce around between version tags, so '`git fetch origin --tags`' will update your tag list, and '`git checkout v3.7.1`' to grab a specific version. Worth mentioning, a while back we threw together a [shell script](https://gist.github.com/1130822) to clean up the non-version tags in older forks of the YUI repository, so if you run '`git tag -l`' and still see build tags like `yui3-####`, run that cleanup script. You will now only see version tags in your list (e.g. `v3.7.1`).
    
-   James Arthur Johnson ([@jamesarthurjohn](http://twitter.com/jamesarthurjohn)) put together a [Jeopardy game using YUI Grids](http://educ.jmu.edu/~chaoaj/csuc12/jeopardy.shtml). Fun!
-   Version bumps this week for the following YUI devtools: [Yogi](https://github.com/yui/yogi/), [Shifter](https://github.com/yui/shifter/), [YUIDoc](https://github.com/yui/yuidoc/), and [Grover](https://github.com/davglass/grover/). Upgrade with '`npm -g install yogi shifter yuidocjs grover`'.
    
-   New/updated modules in the [Gallery](http://yuilibrary.com/gallery/) this week: [itsaselectlist](http://yuilibrary.com/gallery/show/itsaselectlist), [simple-accordion](http://yuilibrary.com/gallery/show/simple-accordion), [bottle](http://yuilibrary.com/gallery/show/bottle), and [calendar-jumpnav](http://yuilibrary.com/gallery/show/calendar-jumpnav).
    

If you have anything else you'd like to share, leave a comment below.