---
layout: layouts/post.njk
title: "Implementation Focus: OCLC/WorldCat"
author: "Fiz Mohamed"
date: 2009-11-19
slug: "yui-on-oclc-and-worldcat"
permalink: /2009/11/19/yui-on-oclc-and-worldcat/
categories:
  - "YUI Implementations"
---
![YUI TabView on Worldcat.](/yuiblog/blog-archive/assets/yui-tabs-on-worldcat-20091119-102329.png)

Here at OCLC — a worldwide non-profit library cooperative that provides web visibility for library catalogues around the world — we initially came across [YUI](http://developer.yahoo.com/yui/) while discussing [grid](http://developer.yahoo.com/yui/grids/) frameworks early in 2008. Later that year the subject of JavaScript toolkits arose, and we recalled YUI as part of the investigation for one of our products. We looked at a number of other popular toolkits, and we tried to approach the toolkits from the point of view of both a developer and designer. While it was a close call between some, I was very impressed with the YUI, especially with the [YUI 3](http://developer.yahoo.com/yui/3/) intro at that time which showed that Yahoo’s developers weren’t afraid to make big changes for the better, and had borrowed ideas from other mature toolkits and improved upon them. Even using [YUI 2](http://developer.yahoo.com/yui/2/) would save us time with its fully-featured set of interactive widgets. On top of that, YUI was supported both by Yahoo and an active developer community.

![YUI Carousel on WorldCat.org](/yuiblog/blog-archive/assets/yui-carousel-on-worldcat-20091119-103137.png)

YUI components have since found their way onto OCLC's [WorldCat.org](http://worldcat.org), a site that allows users to search for an item of interest and discover which libraries near them own that item. [WorldCat.org](http://worldcat.org) has become the Web destination for cross-library searching and uses YUI components in several locations:

-   **TabView**: One the homepage, tabs built on [YUI TabView](http://developer.yahoo.com/yui/tabview/) let a user click between a default search of all formats and one of several narrowed, format-specific searches, including books, DVDs and articles. TabView is also used on library profile pages (such as [http://www.worldcat.org/libraries/14229](http://www.worldcat.org/libraries/14229)), where users can tab through recently-catalogued items by genre.
-   **Carousel**: The WorldCat.org detailed record page provides a host of evaluative information about an item plus links to related items. Record pages on OCLC’s “WorldCat Local” service, a locally-branded and focused instance of WorldCat.org that serves as a library’s online catalog, uses the [YUI Carousel](http://developer.yahoo.com/yui/carousel/) to present a scrollable assortment of similar works by the same author or about the same subject. (See page bottom of [http://ucsd.worldcat.org/oclc/3952807&referer=brief\_results](http://ucsd.worldcat.org/oclc/3952807&referer=brief_results) for an example.)
-   **Reset/Fonts/Grids CSS**: We use the complete [YUI Reset](http://developer.yahoo.com/yui/reset/) package on the detailed record page, our most complex layout and most important page since it connects users to the local catalogs of our member libraries. The CSS package helps us maintain a consistent presentation across supported browsers, especially with user adjustment of font sizes — a key to making the page accessible for library users with limited sight.
-   **Menu**: WorldCat.org will soon use [YUI Menu](http://developer.yahoo.com/yui/menu/) to create its main navigation and user-account menubar. We liked the better support for keyboard and mouse navigation over our current third-party utility.