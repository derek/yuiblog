---
layout: layouts/post.njk
title: "Building Sideline: Lessons in YUI + Adobe AIR"
author: "Chad Auld"
date: 2009-03-31
slug: "sideline-beta-released"
permalink: /2009/03/31/sideline-beta-released/
categories:
  - "Development"
---
[![Screenshot of Sideline](/yuiblog/blog-archive/assets/sideline-beta-released/screenshot.png)](http://sideline.yahoo.com)

Ever wonder what people are saying right now about your company, brand, service, product, etc? [Sideline](http://sideline.yahoo.com), inspired by a recent internal hack project at Yahoo!, goes beyond the standard customer survey process to let you listen in real-time to people talking about your products and then use that feedback to enhance your service or help users with their problems.

Briefly stated, the goals of our project were to

-   Create a desktop application that allows for the creation, grouping, and auto-execution of advanced search queries against Twitter
-   Leverage existing skill-sets and tools
-   Target the Windows, Mac OS X, and Linux operating systems and minimize the amount of platform specific code that must be written
-   Open source the code so that others can learn from, contribute to, and/or extend the product as they see fit

Our team of front-end engineers are experts in JavaScript, CSS, HTML, and PHP but didn't have a great deal of experience developing desktop applications. So the question became, how to maximize our existing skill-sets for desktop development? The answer for us was to utilize the [Adobe AIR platform](http://www.adobe.com/products/air/), which "lets developers use proven web technologies to build rich Internet applications that run outside the browser on multiple operating systems". Since AIR supports HTML/JavaScript development (in addition to Flex and Flash), we could build our application on traditional web technologies, on top of [YUI](http://developer.yahoo.com/yui/), and have it run on the three main desktop operating systems.

### YUI Grids in AIR

Sideline contains an extensive implementation of the YUI Library. It should hopefully serve as a great example for other developers interested in experimenting with YUI and Adobe AIR. The application's layout is constructed using [YUI Grids](http://developer.yahoo.com/yui/grids/) and even makes use of the [recently added ARIA Landmark Roles](/yuiblog/blog/2009/03/05/aria-grids/). Grids worked very well in the AIR environment and made redesigns that occurred mid-development easy to implement with minimal code changes. Just like in the standard browser environment, YUI Grids can serve as a great foundation for an AIR application even if the developer decides against using the rest of the JavaScript library and opted for another framework instead.

### YUI Components in AIR

In addition to Grids, Sideline also utilizes the [Dom](http://developer.yahoo.com/yui/dom/), [Event](http://developer.yahoo.com/yui/event/), [Drag and Drop](http://developer.yahoo.com/yui/dragdrop/), [JSON](http://developer.yahoo.com/yui/json), [Selector](http://developer.yahoo.com/yui/selector/), [Container](http://developer.yahoo.com/yui/container/), [Button](http://developer.yahoo.com/yui/button/), [Menu](http://developer.yahoo.com/yui/menu/), [Slider](http://developer.yahoo.com/yui/slider/), and [TabView](http://developer.yahoo.com/yui/tabview/) components. I am happy to report that all the YUI components performed extremely well in the AIR environment and required no modifications. Sideline does implement a fairly customized design and thus some customized skinning of the YUI components was required, but no core modifications. Most AIR applications tend to have a rich desktop application feel to them. For this level of customization, the [YUI skinning article](http://developer.yahoo.com/yui/articles/skinning/) is a great reference to get started.

### Beyond the Browser

A major enhancement of the Adobe AIR platform over the traditional web environment is access to a local SQLite database and the user's file system. Local database access is becoming more available in traditional web environments through technology such as Gears and HTML 5 client side storage, but for now these solutions are not ubiquitous. For those interested in AIR development, Sideline has tackled many of the common tasks that a typical AIR application might require, e.g., fetching external data, handling application updates, interacting with the local database, working with the local filesystem, launching native browser windows, displaying desktop notifications, etc. It should prove to be a useful reference in that respect.

### Tips for AIR Development

1.  Know your environment. AIR uses the WebKit open source browser engine under the hood. Traditional web development is aimed at making an application or site work across as many browsers/operating systems as possible. Which browsers to support typically comes down to a cost versus usage factor. However, coding for a single rendering engine reduces the need to prepare for and test against the slue of potential combinations in the market. That being said, it still makes sense to develop in a cross-browser manner where possible since there may come a time when the application needs to find its way back into a more traditional browser environment. Using a framework like YUI will make that process relatively painless. It is simple to see the browsers and platforms currently supported by YUI via the [Graded Browser Support chart](http://developer.yahoo.com/yui/articles/gbs/). Developers should be fairly safe to take some basic shortcuts when building AIR application (using `-webkit-border-radius` makes rounded corners a breeze), but use them sparingly and document them so they are easy to spot later.
2.  During the development of a complex application in any environment a solid set of debugging tools is a must-have. Adobe provides some useful tools for debugging AIR out of the box. Developers should investigate the [AIR Debug Launcher (ADL)](http://help.adobe.com/en_US/AIR/1.5/devappshtml/WS5b3ccc516d4fbf351e63e3d118666ade46-7fd7.html), [the HTML Introspector](http://help.adobe.com/en_US/AIR/1.5/devappshtml/WS5b3ccc516d4fbf351e63e3d118666ade46-7ed2.html), and the [HTML Source Viewer](http://help.adobe.com/en_US/AIR/1.5/devappshtml/WS5b3ccc516d4fbf351e63e3d118666ade46-7ed3.html). In addition to the bundled tools, [Aptana Studio with its Adobe AIR Plugin](http://www.aptana.com/air) proved to be an indispensable asset. The Aptana plugin provides assistance with creation of an AIR project, importing of common JavaScript frameworks, debugging, packaging/exporting, and digitally signing the application.
3.  Don't forget the performance techniques we've learned from the standard browser environment (i.e., optimize your images, minify and combine the application's CSS and JavaScript files, and for heavy event-based applications like Sideline, take advantage of [event delegation techniques](http://developer.yahoo.com/yui/examples/event/event-delegation.html)). AIR applications run on the desktop and so there is a bit more leniency with performance than in the typical browser environment, but remember just like the browser itself, the AIR container also consumes a chunk of the system's memory even before the application's custom code kicks in.

### The Road Ahead

The beta version of Sideline can be installed at [http://sideline.yahoo.com](http://sideline.yahoo.com). The code is [open source under the terms of the BSD license and hosted on GitHub](http://github.com/cauld/sideline/tree/master). We welcome contributions, feedback, and/or suggestions. Also, in the spirit of keeping things as open as possible and supporting emerging technology we will likely port Sideline to [Titanium](http://titaniumapp.com/) in the near future. Some initial work has already been done on the port and will continue over the coming weeks. It is also quite possible that Sideline will end up implementing a JavaScript ORM such as [JazzRecord](http://www.jazzrecord.org/) to ease database interactions across platforms. If anyone has additional tips for supporting multiple platforms we'd love to hear them.

Now go forth and [fork it](http://github.com/cauld/sideline/fork)!