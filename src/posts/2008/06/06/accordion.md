---
layout: layouts/post.njk
title: "Notoptimal Dev's New YUI-Based Accordion Menu"
author: "YUI Team"
date: 2008-06-06
slug: "accordion"
permalink: /2008/06/06/accordion/
categories:
  - "Development"
---
[![Visit Notoptimal Dev's blog post about the new Accordion Menu.](/yuiblog/blog-archive/assets/notoptimal.png)](http://dev.notoptimal.net/2008/06/simple-yui-powered-accordion-widget.html)

[![Visit Notoptimal Dev's blog post about the new Accordion Menu.](/yuiblog/blog-archive/assets/notoptimal-menu.png)](http://dev.notoptimal.net/2008/06/simple-yui-powered-accordion-widget.html)Juan I. Leon at Notoptimal Dev [went looking for the perfect Accordion Menu recently](http://dev.notoptimal.net/2008/06/simple-yui-powered-accordion-widget.html), but the search was not a success. The criteria:

-   be lightweight
-   use unobtrusive Javascript techniques (ie not have scattered Javascript all over the markup)
-   use simple CSS to make it look nice
-   needed to support both single and multiple sections opened at a time.

Writes Juan: "My search came up short. Most were overly complicated, or they required libraries other than what I already have running on my sites. Too much bloat. I guess I'd have to write my own. Since I already use the \*radical\* YUI libraries on my sites, making it YUI-powered was the way to go for me. I set my goal to <100 lines of good OO unobtrusive Javascript. The current version [sits at 80 LOC with lots of comments](http://notoptimal.net/sample_code/JILS_accordion/JILS_accordion.js)."

You can [check out the blog article](http://dev.notoptimal.net/2008/06/simple-yui-powered-accordion-widget.html) or [jump directly to the example](http://notoptimal.net/sample_code/JILS_accordion/accordion_example.html).