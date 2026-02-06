---
layout: layouts/post.njk
title: "Item Pagination Design Pattern"
author: "Bill Scott"
date: 2006-02-13
slug: "objectpagination"
permalink: /blog/2006/02/13/objectpagination/
categories:
  - "Design"
---
**Problem Summary**

The user needs to view data items from a potentially large set of sorted data that will not be easy to display within a single page.

[![Pagination control for Yahoo! 360](http://developer.yahoo.net/ypatterns/images/sub_paginitem.gif)](http://developer.yahoo.net/ypatterns/pattern_objectpagination.php)

There are other patterns in this area that we will be documenting in the future. One of those is the Chronological Pagination pattern (no reference yet). While the Item Pagination is about moving through data that can be arbitrarily sorted, the Chronological Pagination will capture moving through data that has the sense of oldest to newest.

The other pattern we have documented in this set is [Search Pagination](http://developer.yahoo.net/ypatterns/pattern_searchpagination.php). Search pagination focuses on controlling paging through search results that are usually sorted by relevance. With Item Pagination, the user may want to go through any number of pages to find information, Search Pagination results are generally most useful on the first page or so.

Pagination is the standard way of handling larger data sets. An alternate approach is using [an endless or on-demand scrolling technique](http://looksgoodworkswell.blogspot.com/2005/06/death-to-paging-rico-livegrid-released.html). In a future release of the pattern library we will document the Endless Scrolling pattern (which is currently used in the new Yahoo! Mail Beta.)

The pattern can be found at: [Item Pagination](http://developer.yahoo.net/ypatterns/pattern_objectpagination.php).