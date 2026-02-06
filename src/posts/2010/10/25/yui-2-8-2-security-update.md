---
layout: layouts/post.njk
title: "Announcing YUI 2.8.2 — Important Security Update for All Users of YUI 2.4.0-2.8.1"
author: "Eric Miraglia"
date: 2010-10-25
slug: "yui-2-8-2-security-update"
permalink: /2010/10/25/yui-2-8-2-security-update/
categories:
  - "Development"
---
The YUI team released YUI 2.8.2 today. This release corrects a [security-related defect](http://yuilibrary.com/support/2.8.2/) that was introduced in the YUI 2 Flash component infrastructure beginning with the YUI 2.4.0 release. This defect allows JavaScript injection exploits to be created against domains that host affected YUI `.swf` files. [Visit the security bulletin for YUI 2.8.2 for full details about how to identify and replace affected files](http://yuilibrary.com/support/2.8.2/).

If your site hosts a YUI 2 distribution between version 2.4.0 and 2.8.1 that includes these files, it is affected by this vulnerability.

If your site loads YUI 2 from Yahoo's CDN (`yui.yahooapis.com`) or from Google's CDN (`ajax.googleapis.com`), and the files are not hosted on your own domain, you are not affected. YUI 3 is not affected by this issue.

You can download YUI 2.8.2 (and patched versions of YUI 2.4.0-2.8.1) from [the YUILibrary.com downloads page](http://yuilibrary.com/downloads/ "YUI Library :: Downloads").

See the [security bulletin](http://yuilibrary.com/support/2.8.2/) for information about how to determine whether your site is affected, how to remedy the problem, and how to verify the fix.