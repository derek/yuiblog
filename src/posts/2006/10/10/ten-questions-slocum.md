---
layout: layouts/post.njk
title: "Ten Questions with YAHOO.ext Author Jack Slocum"
author: "Jack Slocum"
date: 2006-10-10
slug: "ten-questions-slocum"
permalink: /2006/10/10/ten-questions-slocum/
categories:
  - "Development"
---
Q: What is your background in front-end engineering?

I have been doing web development since 1995. Most of my experience has been in building corporate web applications. I have also been involved in some high profile public sites such as compare.net (now shopping.msn.com), howardstern.com  and drlaura.com.

Q. What led you down the path of extending YUI?

For 4 or 5 years most of the front-end development I was doing was IE-only. As FireFox and other browsers starting gaining popularity, the need for a cross-browser solution arose. This is where YUI stepped in and made the transition easy for me.  As I did more development, I saw various ways I thought I could improve upon and/or extend the YUI base functionality. In August of this year, I started my YUI related blog and subsequently began working on the YUI Extensions library.   

Q. What are the core goals of the YAHOO.ext project?

To create a library of reusable objects and widgets that improve the overall usability of YUI and make it possible to use YUI without the need for other libraries.

Q. What components have you written so far?

-   A [Grid component](http://www.jackslocum.com/yui/2006/08/30/a-grid-component-for-yahoo-ui-extensions-v1/) that supports various data sources, paging, inline editing and various selection models.
-   A flexible [SplitBar component](http://www.jackslocum.com/yui/2006/08/19/a-splitbar-component-for-yahoo-ui/).
-   A basic [TabPanel component](http://www.jackslocum.com/yui/2006/08/26/a-javascript-tabpanel-for-yahoo-ui/).
-   A basic Toolbar component.
-   An [extended Animation library](http://www.jackslocum.com/yui/2006/08/24/javascript-animations-with-yahoo-ui-made-easy/) built on top of [YAHOO.util.Anim](http://developer.yahoo.com/yui/animation/) that supports automatic animation sequencing and synchronization.
-   A variety of utility classes that make every day development with YUI a little easier:
    -   [Element](http://www.jackslocum.com/yui/2006/08/16/better-yahoo-ui-code-with-the-element-object/):  Simplifies working with DOM elements. It also supports performing YUI animations automatically when setting an element’s properties.
    -   [DomHelper](http://www.jackslocum.com/yui/2006/10/06/domhelper-create-elements-using-dom-html-fragments-or-templates/): Highly optimized DOM creation and in-browser templates utility.
    -   EventManager: Takes [YAHOO.util.Event](http://developer.yahoo.com/yui/event/) one step further and provides normalized browser event objects.
    -   UpdateManager: Ajax helper to manage DOM element updates.

Q. The Grid component has generated a lot of attention in the blogosphere.  How many downloads have you logged of that component?  How many downloads have there been to-date of YAHOO.ext in total?

Unfortunately I didn’t start tracking downloads until recently, but in the past 2 weeks there have been over 5000 downloads.

Q. What is your current approach to documenting and supporting the Grid and the other Extensions?

Like the YUI team, I believe documentation is very important. [All of the components are well-documented](http://www.jackslocum.com/docs/) and there are generally multiple examples and at least one post on my blog describing how to use each component in plain English.

Q. The [Ajaxified phpBB interface](http://www.jackslocum.com/forum2/) is slick and has been the subject of a lot of discussion.  How hard is it for a site owner to implement your interface on an existing bulletin board?

The phpBB interface was intended to be a small project I was doing on the side for my site. Somehow it hit [the front page of Ajaxian](http://ajaxian.com/archives/yui-ajax-phpbb), and now everyone wants a copy. It’s only about 20% completed and I have no timeline for when it will be done.

Q. Last week you released [a DOM helper utility](http://www.jackslocum.com/yui/2006/10/06/domhelper-create-elements-using-dom-html-fragments-or-templates/) that allows developers to do DOM injection with much better performance than in comparable utilities in other libraries.  What are the core features of this new utility?

The DomHelper and Template classes provide a cross browser abstraction of creating DOM elements. Unlike the traditional approach of only providing a cleaner and more developer-friendly DOM API, the DomHelper classes also transparently provide more optimized insertion methods such as HTML fragments and template building.  The live benchmarks verse Scriptaculous Builder and Mochikit are [available here](http://www.jackslocum.com/yui/2006/10/06/domhelper-create-elements-using-dom-html-fragments-or-templates/)  and clearly show the performance benefits of using DomHelper.

Q. Bloggers reacted enthusiastically this week to your [Wordpress comments system](http://www.jackslocum.com/yui/2006/10/09/my-wordpress-comments-system-built-with-yahoo-ui-and-yahooext/) that allows readers to comment on individual paragraphs of a blog entry.  Any idea when this plugin will be released publicly?  What other Wordpress plugins might we expect down the road?

The real reason for creating the comments system was to allow people to ask questions or post comments about specific code blocks or topics in my tutorial and example blog posts. It also serves as a good example of using YUI in a real world application. I’m not sure if it could be made into a traditional  WordPress plug-in since I had to modify some of the core WordPress functionality (that is not available to plug-ins) to make it work.

Q. What's next on your development roadmap?

The next release will include a “Resizable” component which can be applied to any element to allow that element to be resizable by the user. I have also begun working on a Forms library that will make it possible to create rich forms with real-time data validation, data-binding and a desktop-like user experience. Some other ideas include a TaskPanel (like in Windows Explorer) and there are still quite a few features to implement in the Grid, like fixed columns and column reordering.

Q. What are you hoping to see next from the YUI project?

Definitely not a Grid component. :-)  I am looking forward to the History Utility. I think that’s something overlooked in many Ajax projects and having a YUI solution would be great.

Q. Are other developers getting involved in YAHOO.ext?

There have been a few people who have helped me a great deal with fixing various issues (especially on Safari), and I’ve been lucky to receive a lot of feedback and ideas from people using the library. Currently I am the only one working on core development, but I can definitely use some help.

Q. How can developers get involved if they want to participate?

The best way is by posting in the [Development Discussion forum](http://www.jackslocum.com/forum/) at [http://www.jackslocum.com/forum/](http://www.jackslocum.com/forum/). You can also e-mail me directly at jack dot slocum at yahoo dot com.