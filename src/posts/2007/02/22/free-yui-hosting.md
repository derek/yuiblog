---
layout: layouts/post.njk
title: "Free Hosting of YUI Files from Yahoo!"
author: "YUI Team"
date: 2007-02-22
slug: "free-yui-hosting"
permalink: /blog/2007/02/22/free-yui-hosting/
categories:
  - "Development"
---
Coinciding with this week's release of YUI version 2.2.0, the one year anniversary of the [YUI open-source release](/yuiblog/blog/2006/02/13/the-yahoo-user-interface-library/), and as announced at the [YUI Party](/yuiblog/blog/2007/02/05/first-year-party/) just moments ago, we're [opening up free YUI hosting from the Yahoo! network to all YUI implementers](http://developer.yahoo.com/yui/articles/hosting/). If you're using YUI for your own project, we'll serve the files for you — gzipped, with good cache-control, using our state-of-the-art network, for free. You can count on these files being continuously available because they're the same files, served by the same source, that we use for most YUI implementations at Yahoo!.

Files served from Yahoo!'s network include version numbers in filepaths, allowing you to reference a specific version in your code. Previous versions are retained even as new versions are released. While we are providing no explicit SLA with respect to the availability of legacy code, our current policy is to support permanent availability of legacy YUI files.

### Why Provide YUI Hosting on Yahoo!'s Network?

We're opening up the service of YUI from Yahoo! servers for [the same reasons we open-sourced YUI in February](/yuiblog/blog/2006/02/13/the-yahoo-user-interface-library/): Yahoo! is quintessentially a web company. The progress being made by developers in richness and usability today is healthy for the web and, by extension, good for Yahoo! We want to do everything we can do to enhance that evolution — whether it's opening up YUI, hosting YUI files, or creating [best-of-breed APIs](http://developer.yahoo.com/) like the recently-announced [Browser-Based Authentication](http://developer.yahoo.com/auth/) system.

At the end of the day, this step has a small incremental cost to Yahoo! while providing a valuable ease-of-implementation advantage to many developers. Serving YUI from Yahoo! servers won't be the right decision for all implementers; if you're aggregating or customizing YUI source code and serving it from a highly performant host, there will be little reason to switch. However, for some implementers the provision of free, robust, edge-network hosting will have significant upside.

### What Are the Benefits of Having Yahoo! Host YUI Files?

Yahoo!'s network is located throughout the world. HTTP requests for YUI files are evaluated to determine their geographic source and then served from in-region server farms wherever possible. This [edge-computing](http://en.wikipedia.org/wiki/Edge_computing) system provides shorter round-trip times for packets as compared to the use of centralized network hosts. Because YUI files (consisting of JavaScript files, CSS files, and image resources) are static, there need be no relationship between the server providing these files and the server holding session information and business logic for a given application. Moving these files off a central server and closer to your users, therefore, should make your application more responsive overall.

Moreover, Yahoo!'s hosting network is configured to serve JavaScript and CSS using gzip compression. We minify YUI JavaScript before pushing it to our servers; in combination with gzipping, this results in a 90% reduction in transmitted filesize as compared to the footprint of YUI's raw (and commented) source. CSS files weigh 60% less on the wire using gzip compression. If your current host does not support mod-gzip or mod-deflate, the advantages of using Yahoo! hosting could be dramatic. ([See "YUI: Weighing in on Pageweights" for a full discussion of YUI filesizes](/yuiblog/blog/2006/10/16/pageweight-yui0114/).)

Finally, far-future [Expires headers](http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.21) are issued on all static content. This HTTP response header directs the browser to retain content in cache (and to access it from the cache) as long as possible. Improving your cache hit rate will reduce the amount of time your users spend waiting for files to download.

### What About Privacy?

Usage of this service will be recorded in Yahoo!'s Web traffic logs. We can assure you that our intent is simply to provide a convenience to the YUI developer community. If the record left in Yahoo!'s logs would compromise the privacy of your users, do not use this service.

\* \* \* \* \*

For complete information about how to include YUI files hosted by Yahoo! in your project, please see "[Serving YUI from Yahoo!](http://developer.yahoo.com/yui/articles/hosting/)" on the YUI website. We hope this resource proves useful to those of you developing rich internet applications with YUI.