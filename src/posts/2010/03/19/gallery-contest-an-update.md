---
layout: layouts/post.njk
title: "Gallery Contest: An Update"
author: "YUI Team"
date: 2010-03-19
slug: "gallery-contest-an-update"
permalink: /blog/2010/03/19/gallery-contest-an-update/
categories:
  - "Development"
---
The [YUI 3 Gallery Contest 2010](/yuiblog/yui3gallerycontest2010/ "YUI 3 Gallery Contest 2010") is well underway, and with a full weekend left for submissions I wanted to share with you what's come in so far. These are all the brand new modules submitted by what I believe are eligible contest participants since the contest's start date (if you think you're eligible and I've omitted your contribution, please let me know in the comments). These are ordered from most to least recent.

Two HTML 5 video abstractions are included here, as well as a Lightbox port, a Quicksand port, a new Slideshow and some lower-level utilities. Participants include Josh Lizarraga, who authored one of the first YUI 3 community contributions, and Greg Hinch, who was the first public contributor to YUI 3 Gallery. There are some people new to the YUI community, too, whose contributions look outstanding.

It's not too late to enter the contest; visit the [contest page](/yuiblog/yui3gallerycontest2010/ "YUI 3 Gallery Contest 2010"), check that you are eligible, and make sure you fax in your CLA and submit your module prior to the deadline on Monday night.

### [HTML5 Player (gallery-player)](http://yuilibrary.com/gallery/show/player)

[Josh Brickner](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=7708 "View Profile")'s [HTML5 Player](http://yuilibrary.com/gallery/show/player) is a YUI 3 widget that creates a video player using the HTML5 video tag.

[![](/yuiblog/blog-archive/assets/html5player-20100319-090209.jpg)](http://macinjosh.net/yui/example.html "HTML5 Player example")

Josh has put [an example up here](http://macinjosh.net/yui/example.html "YUI HTML5 Player"), along with a [README](http://macinjosh.net/yui/README.md "README for HTML5 Player").

### [YUISand (gallery-yuisand)](http://yuilibrary.com/gallery/show/yuisand)

[Lauren Smith](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=7567 "View Profile")'s [YUISand](http://yuilibrary.com/gallery/show/yuisand) "fancifies the sorting and itemizing of a collection of similar items." Lauren's work implements the functionality of the [Quicksand](http://razorjack.net/quicksand/docs-and-demos.html#demo-link "Quicksand") module built by Jacek Galanciak for jQuery. [Lauren has docs up](http://kickballcreative.com/yui/modules/yuisand/ "YUISand | Modules | Kickball Creative"), and he's got a full example roster.

[![YUISand example](/yuiblog/blog-archive/assets/yuisand-20100319-091453.jpg)](http://kickballcreative.com/yui/modules/yuisand/examples/example6.php "Example 6 | YUISand | Kickball Creative")

### [YUI Slideshow (gallery-yui-slideshow)](http://yuilibrary.com/gallery/show/yui-slideshow)

[Josh Lizarraga](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=186 "View Profile")'s YUI Slideshow is a Gallery version of a project Josh first shared with the community last year on his FreshCutSD site. Writes Josh: "YUI Slideshow lets you create customizable, animated slideshows from images or any other HTML. The module has many different built-in transitions you can use to create a variety of effects. You can also create your own by passing in an Anim configuration object. You can also designate any HTML element as a pause, play, next, or previous button."

[![](/yuiblog/blog-archive/assets/slideshow-20100319-092202.jpg)](http://freshcutsd.com/yui-slideshow/#demo "YUI Slideshow –  Fresh Cut - San Diego Graphic Design")

### [Effects (gallery-effects)](http://yuilibrary.com/gallery/show/effects)

[Andrew Bialecki](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=5270 "View Profile")'s Effects package wraps YUI's Animation Utility with an API similar to Scriptaculous to make animating nodes even easier.

### [Lightbox (gallery-lightbox)](http://yuilibrary.com/gallery/show/lightbox)

[Andrew Bialecki](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=5270 "View Profile")'s [Lightbox](http://yuilibrary.com/gallery/show/lightbox) is a port of the Lightbox module to YUI. At present, the module is targeting the featureset of [Lightbox 2](http://www.huddletogether.com/projects/lightbox2/ "Lightbox 2").

I didn't see any posted documentation from Andrew on this module yet, but [the example that he ships with gallery gives you an idea of what this module does](http://ericmiraglia.com/yui/demos/lightbox.php "Lightbox Demo").

[![](/yuiblog/blog-archive/assets/lightbox-20100319-093641.jpg)](http://ericmiraglia.com/yui/demos/lightbox.php "Lightbox Demo")

### [Data Storage (gallery-data-storage)](http://yuilibrary.com/gallery/show/data-storage)

[Andrew Bialecki](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=5270 "View Profile")'s [Data Storage](http://yuilibrary.com/gallery/show/data-storage) adds the functionality of the jQuery data storage API (http://api.jquery.com/category/miscellaneous/data-storage/). Andrew describes the module this way: "Sometimes it's useful to store arbitrary data with a particular node or object. If your class uses the [Attribute](http://developer.yahoo.com/yui/3/attribute) utility, you're in luck and your job is done. However, the Node class doesn't (yet) use the Attribute utility, so this port of the jQuery data storage API allows you to associate data with a particular Node instance. In fact, you're not limited to `Y.Node` instances -- any object will do."

### [Component Manager (gallery-base-componentmgr)](http://yuilibrary.com/gallery/show/base-componentmgr)

[Eric Ferraiuolo](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=116 "View Profile")'s [Component Manager](http://yuilibrary.com/gallery/show/base-componentmgr) is a `Y.Base` extension. Writes Eric: "Don't need all your page's components to be ready and loaded on page load? Want to lazily load their dependencies and lazily instantiate them on-demand based on some user action? Then use this `Y.Base` Extension."

### [Video (gallery-video)](http://yuilibrary.com/gallery/show/video)

[Greg Hinch](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=4156 "View Profile")'s [Video](http://yuilibrary.com/gallery/show/video) module attempts to insert a video element into the page, using HTML 5, and falls back to Quicktime if HTML 5 support isn't available. Here's Greg's description: "Dealing with video can be difficult, trying to find the right player to use for your user's environment and the type of video you want to play. This module is an attempt to centralize all that logic into a single interface, including the events and methods published by the various players available."

### [Form Events (gallery-form-event)](http://yuilibrary.com/gallery/show/form-event)

[Eric Ferraiuolo](http://yuilibrary.com/forum/memberlist.php?mode=viewprofile&u=116 "View Profile")'s [Form Events](http://yuilibrary.com/gallery/show/form-event) module adds event bubbling to form events: `submit`, `reset`, and `change`. IE is the major browser that doesn't natively support bubbling of these events.