---
layout: layouts/post.njk
title: "Implementation Focus: Lamplight"
author: "Jenny Donnelly"
date: 2010-09-15
slug: "implementation-focus-lamplight"
permalink: /2010/09/15/implementation-focus-lamplight/
categories:
  - "YUI Implementations"
---
**What is Lamplight?**

Lamplight is a database for charities and voluntary groups (that's non-profits) in the UK. It helps our customers keep their data efficiently, demonstrate the impact they have on the people they work with, and streamline administrative and reporting tasks. We've been going since 2004 and re-wrote the entire system in 2009, using YUI2 very heavily.

Lamplight has a pretty demanding bunch of users: they are generally not very keen to be sat in front of a computer — they want to be out working with the people they serve. So Lamplight's got to be intuitive to use, responsive, and make their jobs easier.

We're also committed to making it affordable for the smallest organisations — a hosted system starts at £15/month (for the whole organisation). So we work really hard to make a single system that is flexible enough for a whole range of different organisations to use without becoming impossible to manage and administer.

**Which YUI components do you use?**

It's easier to list the ones we don't: Carousel, Charts, Cookie, ImageCropper, ImageLoader, Layout, ProgressBar, Slider, Storage, SWF and TreeView. Everything else is in there to a greater or lesser extent. [DataTable](http://developer.yahoo.com/yui/datatable/), [Editor](http://developer.yahoo.com/yui/editor/) and [Menu](http://developer.yahoo.com/yui/menu/) get the biggest workouts.

**Why did you choose YUI?**

First impressions go a long way. While I was trying out some of the libraries, YUI widgets seemed to be the most responsive, and/or the most reliable in different browsers. And then it doesn't take long to realise the documentation, examples, and forums are really impressive too.

In some ways it's made things harder — we use Zend Framework on the server, which (now) comes with Dojo 'built in' — but I'm pretty sure it was the right decision.

**What have you had most fun with?**

We're just about to push the new YUI 2 based Diary to all our customers. Diary's my own creation, and it seems to be working pretty well. It does what you expect a diary to do — drag and drop appointments, click and drag to add, and so on. It's built on a whole stack of existing YUI 2 components (the [Resize](http://developer.yahoo.com/yui/resize/) utility, [Drag & Drop](http://developer.yahoo.com/yui/dragdrop/), and [DateMath](http://developer.yahoo.com/yui/docs/module_datemath.html) in particular). Diary is on GitHub, along with the API docs and a few examples ([http://mattparker.github.com/diary/](http://mattparker.github.com/diary/))![Screenshot of Lamplight's Diary](/yuiblog/blog-archive/assets/lamplight/lamplight-diary.jpg)

I've also enjoyed working with [DataTable](http://developer.yahoo.com/yui/datatable/). I've added a column chooser context menu, used and added a bit to [Satyam's work with key navigation around an editable table](http://satyam.com.ar/yui/#keynav), and implemented remote sorting/paging with the server returning HTML.

And [Editor's](http://developer.yahoo.com/yui/editor/) received some attention too: we have mail-merge menu buttons, some extra HTML filter buttons to handle content pasted from MS Word, a document templating system, and a built-in image insertion/uploader (images come from our server).![Screenshot of Lamplight's Editor](/yuiblog/blog-archive/assets/lamplight/lamplight-editorform.jpg)

Finally, we've got a very simple ACL system, so that (for example) I only need one set of context menus that enable or disable items depending on who's logged in — I think it's good to know what you can't do, rather than searching for a removed 'delete' option!

**What's been hardest?**

Managing all the widgets that come and go. There shouldn't ever be a page load until you log out, and in that time there are a lot of DataTables, TabViews, Buttons, ContextMenus... coming and going. Sometimes these'll be in a Dialog, so I can't just destroy() them on every ajax request, for example. I've ended up with a singleton WidgetManager, which stores sets of widgets (for example a form with some Buttons and a DataTable) and destroys (or hides them out the way, in the case of Editor) them at the right moment. All these widgets register themselves with the WidgetManager when they're constructed. And we re-wrote fair chunks so that there's only a single Editor, Dialog, and Panel that get re-used whenever they're needed. Fortunately this wasn't too painful as they're all wrapped on the server by PHP classes, so I only needed to alter my Yui\_Datatable or Yui\_Form (for example) classes.