---
layout: layouts/post.njk
title: "Implementing YUI on the Assembla.com Agile Planner"
author: "Joachim Larsen"
date: 2010-08-18
slug: "yui3-at-assembla"
permalink: /2010/08/18/yui3-at-assembla/
categories:
  - "YUI Implementations"
---
[![](/yuiblog/blog-archive/assets/assembla-20100818-072550.jpg)](http://blog.assembla.com/assemblablog/tabid/12618/bid/12940/Upgraded-Agile-Planner-for-Fast-Fun-Roadmapping.aspx "Upgraded Agile Planner for Fast, Fun Roadmapping")

Fast and fun – that was the user requirement for [the new Assembla.com Agile Planner](http://blog.assembla.com/assemblablog/tabid/12618/bid/12940/Upgraded-Agile-Planner-for-Fast-Fun-Roadmapping.aspx "Upgraded Agile Planner for Fast, Fun Roadmapping") – an AJAX interface for adding development tasks, building story/feature outlines, and scheduling them into releases. We were lucky to have [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") to make it fast and fun to implement as well.

I had used [YUI 2](http://developer.yahoo.com/yui/2/ "YUI 2 — Yahoo! User Interface Library") for a number of prior projects and I had been impressed by the engineering of the UI components and the underlying library infrastructure. I wanted to learn more about YUI 3, with its compact syntax and deeper focus on DOM manipulation and CSS3-style selectors. This project, with a low dependence on 'prebuilt widgets,' was a perfect opportunity to get my feet wet with YUI 3. The facilities for 'large app' implementation via custom modules and integration with YUI loader made it a natural choice.

The Agile Planner supports a number of drag and drop user interactions with multiple interaction groups and context based behaviors. At the same time, it handles a complex set of interactions with the server, including merging in new data from the server, and propagating changes to the server.

We improved on the existing Planner which was based on Rails handlers and Prototype.js. YUI's sandbox philosophy and strong OOP facilities made coexisting with Prototype.js a breeze.

We used a large number of YUI components, including:

-   Async-Queue to offer a responsive experience on a page that can involve 1000+ simultaneous tickets
-   Drag and Drop with interaction groups.
-   IO as a connection manager to queue and massage server interaction.
-   Event-delegate to allow simply hydrating html templates and forgetting about them.
-   Event-key for keyboard interaction and navigation.
-   Collection for giving us a consistent implementation experience across browsers.
-   Cookie for easy short-term UI persistence.
-   Profiler to find the biggest speed gains
-   YUI Doc to leave information for the rest of the team

Working with YUI 3 on an app like this has been fun, and I am looking forward to hearing what our users will urge us to do next!

_**About the author:** Joachim Larsen is a frontend engineer with Assembla.com._