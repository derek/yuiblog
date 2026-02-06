---
layout: layouts/post.njk
title: "Implementation Focus: Pattern Insight"
author: "Erik Hinterbichler"
date: 2009-12-04
slug: "pattern-insight"
permalink: /blog/2009/12/04/pattern-insight/
categories:
  - "YUI Implementations"
---
![](/yuiblog/blog-archive/assets/patterninsight-patchminer-20091204-115202.png)

### About Pattern Insight

Pattern Insight provides powerful solutions to index, search, and analyze semi-structured data. By "semi-structured" we mean any type of system data — code, logs, scripts, and more.

Currently we have two major software suites: "Code Insight" and "Log Insight."

![](/yuiblog/blog-archive/assets/patterninsight-patchminer-20091204-115410.png)

Code Insight provides several unique capabilities for analyzing source code. At its core is a lightning-fast fuzzy snippet search which scales to billions of lines of code. With snippet search, you can paste in a snippet of code and find all similar snippets across your entire code base, even tolerating variable name changes or line insertions/deletions. Built on top of this fuzzy search capability is Patch Miner, an application for locating buggy code that needs to be fixed. You can input a bug fix and Patch Miner will find all other locations where that bug fix should be applied. Finally, we have Pattern Miner, a copy-paste and duplication detector. Pattern Miner can help you refactor your code base by automatically finding duplicated code, even when variable names have changed. It can also detect IP leaks across different codebases; e.g., if you use both open source and proprietary code and want to prevent code from flowing between them.

![](/yuiblog/blog-archive/assets/pattern-insight-patchminer-20091204-114849.png)

Log Insight is our next-generation log search and analysis product. Log Insight can index TBs of system data and provide sub-second performance for complicated search queries. Furthermore, it enables the creation of persistent signatures that can be used to scan new or archived data for instant matches. Log Insight can also automatically extract common patterns (e.g. for failures) that can then be codified as signatures back to the Pattern Insight engine.

### The Importance of UI

We recognize that possessing great underlying technology is not enough to create a successful product. A good UI is absolutely essential if we want users to be able to see the value of our technology and take full advantage of it. Thus the requirements for our user interfaces drive much of the development of our backend technology.

As one example, a product like Patch Miner is heavily dependent on the UI to shape it. At its highest level, Patch Miner is a fairly abstract concept: "find all the places where a bug fix needs to be applied in my code base." Turning this into a concrete UI provides quite a few unique design challenges. For instance, what exactly is a "bug fix" and what is the best way for a user to input it? And once Patch Miner has found a bug somewhere else, what's the best way to present the result to the user? Solving these user experience problems has provided the road map for the development of the core Patch Miner application.

### Using YUI at Pattern Insight

The UIs for Code Insight and Log Insight are fully web-based, and we are using [YUI](http://developer.yahoo.com/yui/ "YUI Library") heavily to improve user experience. When we were initially trying to decide which JS framework to use, there were two things that sold us on YUI: the extensive documentation and the wide variety of ready-made components and widgets. We ended up making use of almost all of them: [animation](http://developer.yahoo.com/yui/animation/), [autocomplete](http://developer.yahoo.com/yui/autocomplete/ "YUI Library"), [button](http://developer.yahoo.com/yui/button/ "YUI Library"), [calendar](http://developer.yahoo.com/yui/calendar/ "YUI Library"), [connection manager](http://developer.yahoo.com/yui/connection/ "YUI Library"), [container](http://developer.yahoo.com/yui/container/ "YUI Library"), [cookie](http://developer.yahoo.com/yui/cookie "YUI Library"), [datasource](http://developer.yahoo.com/yui/datasource/ "YUI Library"), [history](http://developer.yahoo.com/yui/history/ "YUI Library"), [JSON](http://developer.yahoo.com/yui/json/ "YUI Library"), [slider](http://developer.yahoo.com/yui/slider/ "YUI Library"), [tabview](http://developer.yahoo.com/yui/tabview/ "YUI Library"), [treeview](http://developer.yahoo.com/yui/treeview/ "YUI Library"), [loader](http://developer.yahoo.com/yui/yuiloader/ "YUI Library"), [logger](http://developer.yahoo.com/yui/logger/ "YUI Library"), [test](http://developer.yahoo.com/yui/yuitest/ "YUI Library"), and [CSS base](http://developer.yahoo.com/yui/base/ "YUI Library")/[reset](http://developer.yahoo.com/yui/reset/ "YUI Library")/[fonts](http://developer.yahoo.com/yui/fonts/ "YUI Library")/[grids](http://developer.yahoo.com/yui/grids/ "YUI Library").

### Maintaining High Performance in a Rich Application

Our main strategy in keeping our rich applications performant has been to develop our own web services API which we use to load data on-demand as much as possible. The built-in support for on-demand loading in YUI widgets like treeview has made this much easier for us. We also made the decision to stop supporting IE 6. This has enabled us to use much more sophisticated Javascript that modern browsers can handle but IE 6 can't.

### Most Interesting YUI Implementation Features

We've developed quite a few of our own custom widgets, including a multi-select list with filtering capability and an auto-resizing textbox that grows and shrinks based on user input. Things like auto-resizing might seem minor, but I think most users would agree that small things like this are often the difference between pain and joy when using an interface.

Additionally, purely from a development perspective, our use of the YUI loader makes it very easy to quickly write new pages. We can effortlessly drop in anything we want on a given page, either standard YUI widgets or our own. Essentially, at the top of each page we just need to call our own "loadModules" function and give it the list of components we want to use, plus a callback function:

```
YAHOO.PI.loadModules(['treeview', 'PI.SelectableList'], function() { …
```

We are still using [YUI 2](http://developer.yahoo.com/yui/), but this works similarly to the new `YUI().use` function in [YUI 3](http://developer.yahoo.com/yui/3/).

### What's Next?

We are currently hard at work on Code Insight 1.6, our next major release, which will come with some impressive improvements to Patch Miner. We are also actively developing the next version of Log Insight, which will include a brand new, highly sophisticated UI. Among the new features are a web-based signature editor with live syntax highlighting, autocompletion, and error checking.

If you're interested in learning more about us, you can read about our products and check out some videos at our website: [http://www.patterninsight.com](http://www.patterninsight.com). Also, feel free to email us at info@patterninsight.com.