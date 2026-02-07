---
layout: layouts/post.njk
title: "Updated TextMate Bundle for YUI 2.8.0"
author: "YUI Team"
date: 2009-11-30
slug: "2-8-0-textmate-bundle"
permalink: /2009/11/30/2-8-0-textmate-bundle/
categories:
  - "Releases"
  - "Development"
---
I've recently brought my YUI bundle for [TextMate](http://macromates.com/) up to date with version 2.8.0 of the library. It provides syntax coloring and documentation look-up for all of the utilities and widgets, as well as tab completion for the most frequently used parts of the library.

There are two ways to get the bundle:

1.  Use Subversion to check out a the most recent copy
    ```
    cd ~/Library/Application\ Support/TextMate/Bundles
    svn co http://svn.textmate.org/trunk/Bundles/JavaScript\ YUI.tmbundle/
    
    ```
    
2.  Download [the bundle](http://techfoolery.com/tools/yui_bundle.zip), unzip it, and put it in the ~/Library/Application\\ Support/TextMate/Bundles directory

You can use the Bundle Editor within TextMate to view various code snippets and commands and become more familiar with the bundle. As with all TextMate bundles, everything can be customized; tab completion triggers, aliases (if you use `Y.D` instead of `YAHOO.util.Dom` for instance), snippets, and even the syntax coloring itself. If you want more information, there is [a screencast](/yuiblog/blog/2006/11/30/rossharmes-yui-bundle/) from a few years ago that is still remarkably current.