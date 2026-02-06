---
layout: layouts/post.njk
title: "Bookmarklet for the YUI Logger Control"
author: "YUI Team"
date: 2008-07-01
slug: "logger-bookmarklet"
permalink: /2008/07/01/logger-bookmarklet/
categories:
  - "Development"
---
[![Rajat Pandit's YUI Logger bookmarklet.](/yuiblog/blog-archive/assets/loggerbookmarklet.png)](http://blog.rajatpandit.com/sandbox/yuilogger/index.html)

Rajat Pandit has put together a bookmarklet for [YUI Logger](http://developer.yahoo.com/yui/logger/) that allows you to pop open a logger console on-demand — a big convenience when you're debugging. Check out [Rajat's blog](http://blog.rajatpandit.com/2008/06/26/bookmarklet-for-yui-logger/) and [bookmarklet page](http://blog.rajatpandit.com/sandbox/yuilogger/index.html) for more on this project.

Keep in mind that the YUI Logger Control outputs messages logged via `YAHOO.log`; to see full YUI debugging messages, you'll need to use the `-debug` version of YUI files. For example, to use the `-debug` version of the [YUI Event Utility](http://developer.yahoo.com/yui/event/), use `http://yui.yahooapis.com/2.5.2/build/event/event-debug.js`.