---
layout: layouts/post.njk
title: "Implementation Focus: timr"
author: "YUI Team"
date: 2009-10-12
slug: "timr"
permalink: /blog/2009/10/12/timr/
categories:
  - "YUI Implementations"
---
**Tell us about your product.**

[timr](http://timr.com/) is a very easy to use time-tracking application which offers a web application as well as native clients for mobile phones. This combination allows our users to easily track their times in the office and on the go.![Screenshot of timr](/yuiblog/blog-archive/assets/timr/screen1.png)

**What problem are you trying to solve for users?**

For most people, time tracking is an evil, consuming a lot of time, money and energy. The reason that time tracking often fails is the lack of an appropriate tool.

Most systems are cumbersome, complicated or simply not available when users have the need to track their time. Times are mainly tracked subsequent to the work performed and not parallel to the work, which increases the effort that is needed. This is even more dramatic since times are mostly tracked not directly after work but at the end of the week or, even worse, at the end of the month.

timr allows its users to track their times instantaneously during the work day, easily and ubiquitously. That means the time is always tracked parallel to the work, no matter if you are in the office or on the go. At the end of the day, all your time is already tracked, without having to invest one more minute to track any work before going home.

**What makes your product stand out?**

Over the past few years we have had a lot of experiences with different time-tracking applications and concepts. Most are too complicated or simply too cumbersome. So we designed a system that we ourselves would enjoy using. We decided that time tracking has to be Easy, Instantaneous and Ubiquitous:

-   If a time-tracking application isn't easy to use, you won't use it and it will be even harder to convince your employees to use it.
-   If time tracking isn't easy enough it is usually procrastinated, but subsequent time tracking needs even more time then instantaneous time tracking -- a dangerous loop.
-   For ongoing instantaneous time tracking you need the possibility to track times anytime, anywhere.

**What are the things your team is most proud of?**

By leveraging YUI in our web applications as well as building out native clients for mobile phones, we made time tracking with timr always easy, in the office and on the go. Although it would have been much easier for us to develop a web application that also works on mobile phone browsers and sell this as a "solution" for mobile time tracking, you would realize very fast that having to start a browser, open the mobile web page and enter your login credentials to instantaneously track your time isn't easy. We've taken no shortcuts in our efforts to give users the power and convenience to track their times anytime, anywhere.

**Please describe how you came to choose YUI as a resource.**

We looked for a library of reusable components that could provide us the best usability. It was also important for us to be able to customize and tweak the components for our needs. Many rich component libraries provide a lot of features but do not allow developers to hook into them easily to extend them.

With our server architecture consisting of the Spring Framework and the free application container Tomcat, we found in YUI a perfect companion to sit on top as the "JavaScript-Layer".![Screenshot of timr](/yuiblog/blog-archive/assets/timr/screen2.png)

**Which YUI components in particular do you use in your product?**

We use about 70% of the components included in YUI 2.7. The application consists of a minimal set of JSPs through which most user inputs are submitted using dynamic dialogs. These dialogs are based on the YUI [Container family of components](http://developer.yahoo.com/yui/container/) and use the [Connection Manager](http://developer.yahoo.com/yui/connection/) to send the inputs by AJAX to the server. This improves the flow of the application a lot.

Another important component is the [TreeView](http://developer.yahoo.com/yui/treeview/), which we use to display our highly customizable task structure and through which users can define their exact hierarchy of customers, projects and tasks.

All the reporting is done in the [DataTable](http://developer.yahoo.com/yui/datatable/) with server side filtering, sorting and pagination enabled. Custom formatters and special configurations allow us to adapt the grid exactly to our needs.

Besides these components, we make heavy use of [Context Menu](http://developer.yahoo.com/yui/menu/#usingcontextmenu) and [Drag & Drop](http://developer.yahoo.com/yui/dragdrop/) all over the application, to give power users an efficient workflow.

**What have been the successes of using YUI in your project?**

YUI helped us create a web application that is so easy to use that there are no more excuses for "old-fashioned" time tracking systems. Many of YUI's components enable our web application to feel much more like a desktop application but without having to install and update it on each client computer. The interesting thing is, that after using timr ourselves we experienced that time tracking actually became fun, and the coolest thing is how many of our users tell us the same: time tracking is fun! YUI has played a significant role in helping us achieve this "fun" side effect.

**What have been the challenges of using YUI in your project?**

One word: JavaScript. Frankly, the power of JavaScript has been underestimated for a long time and many developers have used JavaScript with old bad patterns. Luckily [Douglas Crockford's book](http://oreilly.com/catalog/9780596517748/) helped us a lot to find the good parts of JavaScript and how to use them. We believe that being able to write good JavaScript code is an essential requirement for today's web developers and we are sure that we will see a lot more great JavaScript applications in the future.

**What are some upcoming features you are tackling with YUI?**

One of the upcoming features we are planning is a special reporting page that will make heavy use of [YUI Charts](http://developer.yahoo.com/yui/charts/). We will give the user a huge set of predefined reports using the DataTable and provide dynamic charts for visualization and allow them to create their own.