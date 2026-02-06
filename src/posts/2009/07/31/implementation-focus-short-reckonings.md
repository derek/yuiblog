---
layout: layouts/post.njk
title: "Implementation Focus: Short Reckonings"
author: "Jenny Donnelly"
date: 2009-07-31
slug: "implementation-focus-short-reckonings"
permalink: /blog/2009/07/31/implementation-focus-short-reckonings/
categories:
  - "YUI Implementations"
---
**Please tell us a little about your project.**

[http://shortreckonings.com](http://shortreckonings.com) is a free YUI-based Web tool that helps tracking and evening out group expenses. Its light user interface is ideal for coworkers, roommates, travel buddies or family members. ![Screenshot of Squarespace home page.](/yuiblog/blog-archive/assets/short-reckonings/homepage.png)

**Which components of the YUI Library are used on your site?**

Short Reckonings uses the following YUI components: [Lang](http://developer.yahoo.com/yui/yahoo/#lang), [Dom](http://developer.yahoo.com/yui/dom/), [Connection](http://developer.yahoo.com/yui/connection/), [Event & CustomEvent](http://developer.yahoo.com/yui/event/), [Overlay & Dialog](http://developer.yahoo.com/yui/container/), [TabView](http://developer.yahoo.com/yui/tabview/), [DataTable](http://developer.yahoo.com/yui/datatable/), [Calendar](http://developer.yahoo.com/yui/calendar/), [AutoComplete](http://developer.yahoo.com/yui/autocomplete/), [JSON](http://developer.yahoo.com/yui/json/). The AutoComplete control allows for faster input of expense descriptions for example. Custom events are used intensively to make the different elements of the application communicate together.

**What have been your recent successes?**

1.5 years after its beta launch -- which was covered on the [YDN Blog](http://developer.yahoo.net/blog/archives/2008/01/short_reckonings_developer_spotlight.html) -- Short Reckonings has reached a momentum with its adoption by users from many countries. Today, I am pleased to announce that Short Reckonings is no longer in beta. Since its beta launch, a lot of new features and user interface improvements have been made. Among the most significant ones:

-   Support for non-even splits and formulas;
-   Rich widgets such as calendar and autocomplete;
-   Content can be in any language (utf8);
-   Print & export to Excel;
-   Sign in with your Facebook account.

![Screenshot of Squarespace workflow page.](/yuiblog/blog-archive/assets/short-reckonings/payments.png)

**Congrats! What about any challenges you've faced recently?**

A recent challenge has been the integration with Facebook Connect JS API. Because FB Connect is a young library and is not very stable, using YUI Custom Events to build a YUI layer above it has been the key to make it usable in production environment.

**What do you see for the road ahead?**

With my current stay in Cambodia, I have become very concerned about making software usable in slow connection environments and offline. The next version of Short Reckonings will support offline usage (with Google Gears or HTML5 offline storage). Once back in Canada, I also would like to release an iPhone version. And of course migrating to [YUI 3](http://developer.yahoo.com/yui/3/) will be an exciting experience!