---
layout: layouts/post.njk
title: "YUI PHP Loader Beta 2 Released"
author: "YUI Team"
date: 2009-12-02
slug: "yui-php-loader-beta-2-released"
permalink: /2009/12/02/yui-php-loader-beta-2-released/
categories:
  - "Development"
---
We've spent the past few months working on beta 2 of the [YUI PHP Loader](http://developer.yahoo.com/yui/phploader/). The latest release brings some general code cleanup, bug fixes, and performance enhancements. It also includes expanded API documentation and a new example which demonstrates mixed loading methods. [Full details on beta 2 are available here](http://github.com/yui/phploader/blob/master/CHANGES).

In related news, we've had [our first community port from PHP to Java](http://yuilibrary.com/forum/viewtopic.php?f=96&t=1859) ([http://github.com/levancho/YUIJavaLoader](http://github.com/levancho/YUIJavaLoader)). The first port came sooner than we initially expected and we hope other community members will help port PHP Loader to other popular languages as well.

Also, a number of users have asked about support for using the existing combo service to combine YUI resources with custom ones. The existing combo service on yui.yahooapis.com does not support this. However, you can utilize PHP Loader to pull off such a task with some local combo handling. Here is a sample project that demonstrates one approach to this problem — [http://github.com/cauld/lissa](http://github.com/cauld/lissa).

-   [Learn more about YUI PHP Loader](http://developer.yahoo.com/yui/phploader/)
-   [Download YUI PHP Loader](http://yuilibrary.com/downloads/#phploader)
-   [YUI PHP Loader Developer Forums](http://yuilibrary.com/forum/viewforum.php?f=96)
-   [Fork PHP Loader on GitHub](http://github.com/yui/phploader/)
-   [Release notes for beta 2](http://github.com/yui/phploader/blob/master/CHANGES)

If you're a PHP Loader user and you weren't here for [YUICONF 2009](http://yuilibrary.com/yuiconf2009/) in October, you might want to catch [the video from our PHP Loader session](http://developer.yahoo.com/yui/theater/video.php?v=auld-yuiconf2009-phploader) on [YUI Theater](http://developer.yahoo.com/yui/theater/):

   

<object height="270" width="520"><param name="movie" value="http://d.yimg.com/m/up/ypp/default/player.swf"> <param name="flashVars" value="vid=16467661&amp;"> <param name="allowfullscreen" value="true"> <param name="wmode" value="transparent"><embed allowfullscreen="true" flashvars="vid=16467661&amp;" height="270" src="http://d.yimg.com/m/up/ypp/default/player.swf" type="application/x-shockwave-flash" width="520"></object>