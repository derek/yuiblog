---
layout: layouts/post.njk
title: "Search Highlight Using sm-treeview"
author: "Gary Danko"
date: 2013-03-13
slug: "search-highlight-using-sm-treeview"
permalink: /2013/03/13/search-highlight-using-sm-treeview/
categories:
  - "Development"
---
**The following blog post was written by a member of the YUI community. Want to write your own article for the YUI Blog? Find out more on our [Contribute](/yuiblog/contribute/) page!**

I am a long time Delicious user but there are no good Delicious add-ons for my browser of choice, Chrome. So I decided to write my own. I saw a demo of `[sm-treeview](https://github.com/smugmug/yui-gallery/tree/master/src/sm-treeview)` at YUIConf 2012 and decided to use it as a basis for my extension. The layout for my extension's tree is simple. Each tag is a folder and can contain children. Each bookmark is a child. I wanted to be able to search bookmarks. My vision would be for you type what you're searching for in a text box. Matching results would have their parent folders expanded and the actual results highlighted. Unfortunately, `sm-treeview` does not have a search feature at this time. Using a little trickery I was able to add this functionality to `sm-treeview`. **1) Create CSS for highlighting the search results.****2) Create an object to hold the mapping for each "child".****3) Add a closeAll prototype to your code.****4) Render your tree with lazyRender disabled so you have access to the entire tree's markup.****5) Immediately after rendering your tree, populate the child node map.****6) Create a keyup event to track changes to the search box.**

I am processing my results in the keydown event. You could create an array of search results, etc. Performance with **80** parents and **400** children is excellent. I am sure there is a more efficient way of doing this but it does work and I have not hit any performance snags.

For an interactive demo of a searchable muppet list using this technique look at [this jsbin](http://jsbin.com/uvuhot/20/edit).

![](/yuiblog/wp-content/uploads/2013/03/gdanko_square.jpg)_**About the author:** Gary Danko (@gdanko) Gary Danko is a husband and father, Android developer, and Yahoo! engineer who lives in California._