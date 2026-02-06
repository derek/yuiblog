---
layout: layouts/post.njk
title: "Module Tabs Design Pattern"
author: "YUI Team"
date: 2006-02-13
slug: "moduletabs"
permalink: /blog/2006/02/13/moduletabs/
categories:
  - "Design"
---
**Problem Summary**

The user needs to navigate through one or more stacked panes of content without refreshing the page.

[![Module Tabs from Yahoo! News](http://developer.yahoo.net/ypatterns/images/sub_moduletabs.gif)](http://developer.yahoo.net/ypatterns/pattern_moduletabs.php)

The challenge here is to distinguish tabs that control content within a page from general site navigation tabs. The approach we take a Yahoo! is to treat them visually lighter. Using links for the non-selected tab and the pointer style tab for the selected tabs creates a visual contrast with the [Navigation Tabs](http://developer.yahoo.net/ypatterns/pattern_navigationtabs.php) that might appear on a given site.

Tidwell describes the general pattern behind tabs as a [Card Stack](http://time-tripper.com/uipatterns/Card_Stack).

The pattern can be found at: [Module Tabs](http://developer.yahoo.net/ypatterns/pattern_moduletabs.php).

**Note 1/3/2007:** For code samples to support this design pattern, please see the [YUI TabView Control](http://developer.yahoo.com/yui/tabview/). -Eric Miraglia