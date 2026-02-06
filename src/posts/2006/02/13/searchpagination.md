---
layout: layouts/post.njk
title: "Search Pagination Design Pattern"
author: "Bill Scott"
date: 2006-02-13
slug: "searchpagination"
permalink: /2006/02/13/searchpagination/
categories:
  - "Design"
---
**Problem Summary**

The user needs to view a set of search results ranked by relevance that is too large to easily display within a single page.

[![Pagination control for Yahoo! Search](http://developer.yahoo.net/ypatterns/images/sub_paginsrp.gif)](http://developer.yahoo.net/ypatterns/pattern_searchpagination.php)

Search pagination focuses on controlling paging through search results that are usually sorted by relevance. With [Item Pagination](http://developer.yahoo.net/ypatterns/objectpagination.php), the user may want to go through any number of pages to find information, Search Pagination results are generally most useful on the first page or so.

Pagination is the standard way of handling larger data sets. An alternate approach is using [an endless or on-demand scrolling technique](http://looksgoodworkswell.blogspot.com/2005/06/death-to-paging-rico-livegrid-released.html). In a future release of the pattern library we will document the Endless Scrolling pattern (which is currently used in the new Yahoo! Mail Beta.)

The pattern can be found at: [Search Pagination Pattern](http://developer.yahoo.net/ypatterns/pattern_searchpagination.php).