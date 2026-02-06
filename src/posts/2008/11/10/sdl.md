---
layout: layouts/post.njk
title: "Implementation Focus: SDL"
author: "YUI Team"
date: 2008-11-10
slug: "sdl"
permalink: /2008/11/10/sdl/
categories:
  - "YUI Implementations"
---
**Tell us a little bit about SDL. What are your core lines of business?**

SDL is the world leader in Global Information Management. We provide desktop and enterprise software and localization services to help corporations create and maintain all multilingual content.

**What kinds of web applications do you develop at SDL? What JavaScript frameworks do you use across the spectrum of your projects?**

The web applications we develop are for corporate customers who are looking to manage multilingual assets such as terminology, previously translated content, and dictionaries. Most of our enterprise applications have a web front end. For example, [Global AMS](http://www.sdl.com/en/products/global-ams/Global_ams.asp) enables a system administrator to manage users and the profiles and rules available to those users. Global AMS is the first SDL application to use CEAF and YUI.

Historically, our other web applications have used our own bespoke JS frameworks written for each application. We haven't really used any of the other frameworks.

**YUI is used in your framework (CEAF), which is part of your recently-released [Global AMS](http://www.sdl.com/en/products/global-ams/Global_ams.asp) product. How are you using YUI in these applications?**

We are trying to give all our products a similar look and feel so that the user experience is consistent across the whole range of products. YUI helps us by providing a common set of widgets for developers to use.

CEAF allows the developers to specify in the configuration of an application what elements should be available on each page. For example, that a page will have a toolbar with buttons that add new objects to the system and a table with a list of languages which must have a context menu so that users can interact with the data being shown. YUI allows us to easily turn that configuration in to UI that users can interact with. Even the forms that don't fit this model are easier because the YUI widgets and the widgets we build on top of them mean the developer can concentrate on what the form is doing rather than how it looks.

![Dialog, Tabs and other YUI controls in use on SDL's Global AMS.](/yuiblog/blog-archive/assets/sdl-dialog.png)

We use the [Dialog widget](http://developer.yahoo.com/yui/container/dialog) the most. Each object within the system is represented at some point on a YUI-based [Dialog](http://developer.yahoo.com/yui/container/dialog/), either when it's being created or edited. It might sound insignificant in that one sentence but most objects can be represented using the default dialog class and very few require anything more than that.

We send the bare minimum HTML to the client until more is requested. Dialog boxes are all loaded on the fly using the [Connection Manager](http://developer.yahoo.com/yui/connection) before being cached if the data would be useful later on.

We use the [Layut Manager](http://developer.yahoo.com/yui/layout/) to build the basic page layout and to give the application a known starting point for all its styles. The page is split into three and we use [Connection Manager](http://developer.yahoo.com/yui/connection/) to load the main page element with data from the server.

![The YUI Context Menu in use on SDL's Global AMS.](/yuiblog/blog-archive/assets/sdl-menu.png)

**Why YUI? There are lots of good options out there — what was it about YUI that made it a good fit for these applications?**

We also looked quite seriously at Dojo, but in the end YUI ticked more boxes. YUI had better documentation, the weight of Yahoo! behind it and a massive community.

We like the mix of [API documentation](http://developer.yahoo.com/yui/docs/), [getting-started tutorials](http://developer.yahoo.com/yui/examples/calendar/quickstart.html) and more [advanced examples](http://developer.yahoo.com/yui/examples/get/get-script-basic.html). So much so that we've adopted the same model for our developer documentation we do for CEAF.

**What's next for you and your web team at SDL?**

The release of Global AMS was just the first of our products to use CEAF and we're continuing to build other applications on CEAF.

We've just finished integrating 2.5.2 of the YUI framework, upgrading from version 2.3.1. We can't just upgrade to the latest and greatest version of YUI as soon as it's available, so this means we're a couple of versions out of step. This is why we keep pestering about adding version numbers to the API docs, so we know the method is available in a specific version. This work will also let us switch versions of YUI more easily in the future; we had to customise some of the early widgets (the table in particular) but that's no longer the case in 2.5.2.

We're adding new widgets of our own to the CEAF framework such as a file upload widget, an implementation of the drag and drop control for personalising data tables and multi-select boxes.