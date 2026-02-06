---
layout: layouts/post.njk
title: "Unobtrusive Rollovers Using YUI"
author: "Eric Miraglia"
date: 2008-04-28
slug: "unobtrusive-rollovers-using-yui"
permalink: /blog/2008/04/28/unobtrusive-rollovers-using-yui/
categories:
  - "Development"
---
[![Introduction to Unobtrusive JavaScript, DOM Scripting, and the Yahoo! User Interface (YUI) Library on 2tsp.com.](/yuiblog/blog-archive/assets/2tbsp-1.png)](http://2tbsp.com/node/91)

Chad at 2tbsp.com [wrote up a nice tutorial last week](http://2tbsp.com/node/91) outlining some practical fundamentals with respect to writing "unobtrusive JavaScript." His example implements a standard rollover, beginning with bad-old-days obtrusive scripting, migrating to unobtrusive scripting, and concluding with an unobtrusive script that leverages YUI's [Event Utility](http://developer.yahoo.com/yui/event/) for event attachment and the [Dom Collection](http://developer.yahoo.com/yui/dom/)'s [`getElementsByClassName`](http://developer.yahoo.com/yui/docs/YAHOO.util.Dom.html#method_getElementsByClassName), [`addClass`](http://developer.yahoo.com/yui/docs/YAHOO.util.Dom.html#method_addClass) and [`removeClass`](http://developer.yahoo.com/yui/docs/YAHOO.util.Dom.html#method_removeClass) for class management.

[Click through](http://2tbsp.com/system/files/yui-rollover.html) for his functioning example.

[![Click through for the functioning example.](/yuiblog/blog-archive/assets/2tbsp-2.png)](http://2tbsp.com/system/files/yui-rollover.html)

Of course, Chad just means this as an example of some of the practical points involved in unobtrusive scripting. Others have looked at the problem more encyclopedically — for a more ambitious (and not YUI-related) analysis of the paradigm, check out Christian Heilmann's "[The seven rules of Unobtrusive JavaScript](http://icant.co.uk/articles/seven-rules-of-unobtrusive-javascript/)".