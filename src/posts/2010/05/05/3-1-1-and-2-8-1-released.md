---
layout: layouts/post.njk
title: "YUI 3.1.1 and YUI 2.8.1 Released"
author: "Unknown"
date: 2010-05-05
slug: "3-1-1-and-2-8-1-released"
permalink: /2010/05/05/3-1-1-and-2-8-1-released/
categories:
  - "Releases"
  - "Development"
---
The YUI team released [YUI 2.8.1](http://developer.yahoo.com/yui/2/) and [YUI 3.1.1](http://developer.yahoo.com/yui/3/) today. Each of these minor releases contains a set of targeted bug fixes. Notably, the History component in both libraries was updated to correct an issue that could result in an XSS vulnerability in some implementations.

### History Issue

Ryan Grove corrected [an issue](http://yuilibrary.com/projects/yui3/ticket/2528792) relating to [YUI 2 Browser History Manager](http://developer.yahoo.com/yui/history/ "YUI 2: Browser History Manager") and [YUI 3 History](http://developer.yahoo.com/yui/3/history/ "YUI 3: History"). Writes Ryan:

> In previous YUI versions, HTML markup in history values was not escaped before being written to a hidden iframe in IE6 and IE7, which could result in script execution in certain circumstances. An attacker with the ability to create an unfiltered link on a page that uses YUI 2 Browser History Manager or YUI 3 History (for example, by posting a comment on a blog, where the blog software did not properly filter the comment) could in theory inject arbitrary HTML or script that would be executed when a user then clicked on that link. YUI 2.8.1 and YUI 3.1.1 address this issue. To mitigate this in versions of YUI prior to 2.8.1 and 3.1.1, ensure that HTML characters in user input are always escaped (whether on the server or on the client) before being used to construct links or history values.

These updates are strongly recommended for all users of YUI's browser history functionality.

### YUI 3.1.1

In addition to the History fix, YUI 3.1.1 contains about 20 minor updates throughout the library. Refer to the [YUI 3.1.1 ticket list](http://yuilibrary.com/projects/yui3/ticket/2528792 "#2528792 history manager allows xss injection in ie7 and ie6 :: YUI 3 :: YUI Library") for full details.

### YUI 2.8.1

[Issues addressed in YUI 2.8.1](http://yuilibrary.com/projects/yui2/report/31 "{31 Tickets Assigned to YUI 2.8.1 :: YUI 2 :: YUI Library}") include the History vulnerability and minor updates to AutoComplete, DataTable, TreeView and Uploader.

We also updated a number of YUI 2 examples that employ the Flickr API. These examples were previously using a Flickr API key that was beginning to become overused — probably through inadvertent copy-and-paste into third-party applications. If you find that this issue is affecting your application — i.e., your Flickr images are no longer appearing or you're seeing errors in Flickr-related implementations whose source was derived from a YUI example — you should [head over to Flickr and pick up your own API key](http://www.flickr.com/services/apps/create/apply).