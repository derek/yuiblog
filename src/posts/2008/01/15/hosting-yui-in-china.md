---
layout: layouts/post.njk
title: "Hosting YUI Files for Implementations in Mainland China"
author: "Unknown"
date: 2008-01-15
slug: "hosting-yui-in-china"
permalink: /2008/01/15/hosting-yui-in-china/
categories:
  - "Development"
---
[![Announcing support for hosting YUI in China on YUIBlog.cn](/yuiblog/blog-archive/assets/yuiblog.cn.png)](http://www.yuiblog.cn/2008/01/14/yui%e6%9c%ac%e5%9c%b0%e7%89%88%e5%8f%91%e5%b8%83/)Back in February 2007, we opened up hosting of YUI files on Yahoo's content delivery network to all users, and we maintain a page describing [how you can implement YUI while drawing all of its resources from our network](http://developer.yahoo.com/yui/articles/hosting/). What we've heard from the YUI community is that having this choice is a big deal — and more than a billion YUI files were served from our `yui.yahooapis.com` last week, a number that has grown steadily since we opened up that service.

The `yui.yahooapis.com` domain is an edge-hosted CDN, and it automatically draws files from data centers as close as possible to the source of the request, optimizing performance. While that works well in most locations, one area where we were seeing poor response times was in China, where a growing community of YUI users is located. To help improve performance for implementers serving the China market, we're announcing today the availability of `cn.yui.yahooapis.com`, a CDN specifically for that region.

As of today, the following two paths will both work for retrieving the minified [Yahoo Global Object](http://developer.yahoo.com/yui/yahoo/):

-   [http://cn.yui.yahooapis.com/2.4.1/build/yahoo/yahoo-min.js](http://cn.yui.yahooapis.com/2.4.1/build/yahoo/yahoo-min.js) (China region)
-   [http://yui.yahooapis.com/2.4.1/build/yahoo/yahoo-min.js](http://yui.yahooapis.com/2.4.1/build/yahoo/yahoo-min.js) (standard, global usage)

For most implementations, you'll want to continue using the standard `yui.yahooapis.com`, but if your project serves China primarily the new domain will improve your response times and deliver a better experience. For users in mainland China, we've seen as much as a 5x improvement in response times based on initial tests.

A bit more about this (in Chinese) on [YUIBlog.cn](http://www.yuiblog.cn/2008/01/14/yui%e6%9c%ac%e5%9c%b0%e7%89%88%e5%8f%91%e5%b8%83/), a blog created recently by the user experience team at Yahoo! China (a company in the Alibaba group). A big thanks to Hongwei Zeng, an engineer at Yahoo! China, for helping to make this arrangement possible.