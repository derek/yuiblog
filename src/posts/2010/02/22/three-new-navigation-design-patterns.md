---
layout: layouts/post.njk
title: "Three new navigation design patterns"
author: "Christian Crumlish"
date: 2010-02-22
slug: "three-new-navigation-design-patterns"
permalink: /2010/02/22/three-new-navigation-design-patterns/
categories:
  - "Design"
---
[![topnav bar](/yuiblog/wp-content/uploads/2010/02/topnav-300x75.png "topnav")](/yuiblog/wp-content/uploads/2010/02/topnav.png)Over the past few months I conducted an audit of the patterns in Yahoo!'s _internal_ design pattern library, with an eye toward publishing as many of them as possible in [the open library at YDN](http://design.yahoo.com/). Why? Well, for one thing, to get more eyeballs on them, to gather more feedback and keep improving the patterns. Also, since very few patterns in the library contain Yahoo!-specific information, and an alternative process is now in place for vetting requirements specific to the Yahoo! network and brand _components_, the design pattern collection can now more easily focus on (relatively) universal design principles for web implementations.

I completed the audit before the end of last year and expect to release new patterns in batches over the next few months. Some patterns will be mature and provide a solid foundation for site design. A few will be published as beta patterns which may undergo significant changes in subsequent updates based on feedback received. Regardless of their status, we hope you’ll get involved and review and provide feedback on the patterns provided.

The first batch of patterns to come out from the audit relates to [navigation bars](http://developer.yahoo.com/ypatterns/navigation/bar/). There are three patterns so far in this grouping: [Top Navigation](http://developer.yahoo.com/ypatterns/navigation/bar/topnav.html), [Left Navigation](http://developer.yahoo.com/ypatterns/navigation/bar/leftnav.html), and [Progress Bar](http://developer.yahoo.com/ypatterns/navigation/bar/progress.html). One legitimate question is whether top and left nav bars are still the best or most current way to navigate a site and find content? We still find many examples of them across the web and in use at Yahoo! so for now I'll say yes, but it's worth thinking about.

Wherever possible I try to link patterns back to [the YUI Library](http://developer.yahoo.com/yui/) and, where appropriate, to other code and implementation solutions. YUI has great support for navbars and menu examples. Probably the best place to start is the [menu widget](http://developer.yahoo.com/yui/menu/).

One interesting nomenclature issue we studied was the distinction between a stepwise progress indicator (which is what the pattern is about) and a continuous progress bar (for which there's [a great YUI example](http://developer.yahoo.com/yui/progressbar/)). These two things are often referred to with similar names, but perform different functions. Suggestions for more appropriate terminology are welcome.

Please check out these [new patterns](http://developer.yahoo.com/ypatterns/navigation/bar/) and let us know what you think!