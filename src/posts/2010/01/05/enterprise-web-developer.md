---
layout: layouts/post.njk
title: "Implementation Focus: Enterprise Web Developer, a Python/YUI Framework"
author: "YUI Team"
date: 2010-01-05
slug: "enterprise-web-developer"
permalink: /blog/2010/01/05/enterprise-web-developer/
categories:
  - "Development"
---
### [Enterprise Web Developer](http://www.mgateway.com/ewd.html) (EWD), a Python/YUI framework

Since the early days in 1996, I wanted people to be able to use web technologies as a user interface to applications that they’d previously have considered using Client/Server or some other GUI technology to create. It seemed to be to be a technology that had the potential to be heavily automated so that developers could focus on expressing _what_ they wanted to do rather than _how_ to achieve it.

The thing that has always dismayed and surprised me is how the industry has not embraced this philosophy. Whilst there is no shortage of web/Ajax frameworks out there - there seems to be a new one every week - they all have a common theme: the notion that a web/Ajax application is primarily a programming issue. By contrast I’ve been firmly of the view that by building a framework that was first and foremost design-focused, the programming aspects could be potentially automated to such a degree that the actual programming required in even a complex healthcare application should be able to be reduced to almost trivial levels. That’s been the design goal of our EWD and it proves that such an approach is practical, feasible and highly beneficial.

### Why Python and YUI?

We’ve ported EWD to the free Open Source NoSQL database [GT.M](http://en.wikipedia.org/wiki/GT.M) and Chris Munt, M/Gateway co-founder, has developed a number of language bindings that EWD can use. Our recent slidecast series (described below) was based around his Python binding because it’s such a popular language these days - [recent reports](http://python.dzone.com/articles/python-use-45-google-app) suggest that it has grown in use by 45% since April 2008. However, you could use EWD just as easily with Ruby or Java.

Our [screencast series](http://www.mgateway.com/ewdDemo.html) focuses on EWD/YUI integration for several reasons:

-   YUI provides a very powerful and highly functional and usable set of UI widgets
-   unlike many of the Javascript frameworks, YUI is not an “all or nothing” environment, so you can mix and match YUI components with your own
-   YUI is a free Open Source library so in combination with EWD and GT.M running on a Linux platform, the demo is based on a completely free Open Source stack
-   it has the Yahoo! and Douglas Crockford pedigree: what more need you say!

### EWD uses XML syntax to incorporate YUI. What advantages does this offer?

Making EWD work with YUI was pretty straightforward, but it soon became clear to me that the average developer faced quite a few obstacles when adopting such a Javascript framework for their UI development. Frameworks are complex environments, requiring a lot of detailed knowledge of pretty advanced Javacript, there's a big learning curve and there’s a lot of “devil in the detail”. Furthermore, that complex and verbose Javascript requires downstream maintenance, often by someone other than the original developer. Additionally, for me, they presented yet another example of how the industry’s solution to web/Ajax application development was moving further towards programming and away from the skillsets of designers.

From the earliest days of EWD I’d ensured that it was user-extensible, allowing you to encapsulate functionality and behaviour as XML-based “custom tags”, and they proved to be a perfect solution to incorporating YUI. The YUI custom tags I’ve demonstrated are therefore a custom extension of EWD. The YUI custom tags not only generate all the Javascript needed by the corresponding widget, they also manage the destruction of the widget at the correct time, and include optimised “just in time” loading of the correct .js and .css files, leaving the developer to not have to worry about all that up-front configuration stuff. Another key feature of XML tags is that they are inherently nestable, and usually that’s exactly what you need to do with YUI widgets: menus and datatables nested inside tab-panels for example. So the real advantages are that the developer can express _what_ he/she wants to do in just a few intuitively named and laid out custom tags. Not only does it make development quick and simple, but downstream maintenance also becomes simple too (and remember that one of the major costs and overheads of a big, mission-critical application is maintenance).

A good example is the use of TabView widgets. In EWD these can be described by a simple, intuitive (and therefore highly maintainable) set of nested XML Custom tags, eg:

```
<yui:TabView>
    <yui:Tab label="By Artist" active="true" dataSrc="selectCDXArtist.ewd" />
    <yui:Tab label="By Title" active="false" dataSrc="selectCDXTitle.ewd" />
</yui:TabView>

```

The _yui:TabView_ Custom Tag's _tag processor_ is invoked by EWD's compiler when it encounters an instance of this tag, and it generates the run-time code that will send the appropriate YUI TabView Javascript and associated HTML markup to the browser.

### EWD instructional series

We've done a series of [screencasts](http://www.mgateway.com/ewdDemo.html) to introduce EWD. Here is Part One:

  

<object height="344" width="425"><param name="movie" value="http://www.youtube.com/v/j_DEP7q1WsM&amp;hl=en_US&amp;fs=1&amp;"> <param name="allowFullScreen" value="true"> <param name="allowscriptaccess" value="always"><embed allowfullscreen="true" allowscriptaccess="always" height="344" src="http://www.youtube.com/v/j_DEP7q1WsM&amp;hl=en_US&amp;fs=1&amp;" type="application/x-shockwave-flash" width="425"></object>

The goal of the [screencasts](http://www.mgateway.com/ewdDemo.html) was to demonstrate the extreme level of automation of EWD when used to its full potential. I also wanted to demonstrate how, in EWD, you’re very much describing what you’re wanting to achieve, leaving EWD to do all the _how_ work and to handle all the day-to-day things that are essential to a web application but that can and should be automated, eg session management, security management etc. I hope when people watch the videos they see how little programming has been left for a programmer to do: it’s basically fetching data from the database, validating form fields against a database, and saving data back to a database.

They always say a picture is worth a thousand words, and I think a video is even more potent. Seeing is believing, and there’s nothing like being shown how a tool can be used by the guy who designed and wrote it!

I chose to explore a set of typical UI interactions for an average application that could be demonstrated in the space of about an hour. I also wanted to demonstrate how nesting of the UI components was possible using both the inherent nesting of YUI custom tags and EWD’s “fragment”-based Ajax architecture. The demo covers logging into an application, a main menu, tab panels for choosing the action required and a query against the database whose results are presented in a DataTable. Hopefully the fact that I’ve been able to demonstrate how all that functionality can be created in just over an hour shows the power and benefit of EWD as a development framework. And in terms of maintainability, the entire application I demonstrate is described in just 134 lines of simple HTML/XML markup and only 78 lines of straightforward Python code!

### Where can people get EWD to try it out for themselves?

The quickest and simplest way to get a fully-working EWD system up and running is to use our free [M/DB Installer](http://gradvs1.mgateway.com/main/index.html?path=mdb/mdbDownload). We've done a [screencast](http://www.youtube.com/watch?v=BxC7Yvsmlfs) for this too.

At present the EWD/YUI Custom Tag library isn't generally available, but we're hoping to be able to release it soon.

We also have a [forum for EWD users](http://groups.google.co.uk/group/enterprise-web-developer-community) that people are very welcome to join.