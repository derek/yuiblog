---
layout: layouts/post.njk
title: "Tutorial: Implementing Instant Search with YUI AutoComplete and the Yahoo Search API"
author: "Eric Miraglia"
date: 2008-05-15
slug: "search-suggest"
permalink: /2008/05/15/search-suggest/
categories:
  - "Development"
---
[![Visit 'Writing Your First YUI Application' on InsideRIA](/yuiblog/blog-archive/assets/insideria.png)](http://www.insideria.com/2008/05/writing-your-first-yui-applica.html)

[![The instant-search interface on the YUI website.](/yuiblog/blog-archive/assets/searchsuggest.png)](http://www.insideria.com/2008/05/writing-your-first-yui-applica.html)O'Reilly's InsideRIA blog [has a feature up that steps through the creation from scratch of a sample YUI implementation](http://www.insideria.com/2008/05/writing-your-first-yui-applica.html). The sample application implements an Instant Search feature using [YUI AutoComplete](http://developer.yahoo.com/yui/autocomplete/) backed by the [Yahoo! Web Search API](http://developer.yahoo.com/search/web/V1/webSearch.html). This is the same treatment we use on the YUI web site to power the search box at the top right corner of the header. It searches `developer.yahoo.com` and `yuiblog.com` for relevant content and populates the AutoComplete suggestion container with likely destinations based on what's been typed in the search field. The tutorial shows you how to apply this treatment to your own site while searching the domain or domains of interest to your users.

The InsideRIA piece is cast as an introduction to YUI for those who have not explored the library, so check out the first few sections in particular if you're looking for a compact YUI overview. If you're an experienced YUI implementer interested in the the Instant Search functionality, skip to the "Building Your First Application" section about a third of the way in.