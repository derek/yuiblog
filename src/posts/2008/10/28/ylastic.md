---
layout: layouts/post.njk
title: "Implementation Focus: Ylastic"
author: "YUI Team"
date: 2008-10-28
slug: "ylastic"
permalink: /blog/2008/10/28/ylastic/
categories:
  - "YUI Implementations"
---
**1\. What is Ylastic, and what interested you in creating a unified interface into Amazon's cloud computing services?**

Ylastic is a single unified user interface to the the AWS cloud computing environment — S3, EC2, SQS and SimpleDB. We were initially working on a video creation startup and trying to use AWS as our platform and used a bunch of free tools and home brewed scripts to manage the environment. It quickly became a mess as we were spending way too much time trying to see where we were each day. We needed to track our instances, manage videos being uploaded to buckets, view the messages in queues for debugging and use SDB for metadata. We also needed a way to monitor the AWS status dashboard so we could be proactive if one of the services was having any issues, and also to track what each one of was doing so we didn't step on each other's toes. The existing tools were able to give us some of this info, but there was no simple way to do this without tying ourselves into knots and wasting valuable time with these issues which could be put to better use working on our own app. That's when a light bulb went off in our heads that maybe we were building the wrong product. We decided to scratch our own itch and build something that would be useful for managing an user's interactions with AWS.

**2\. You've made extensive use of YUI throughout the Ylastic user interface. Tell us a little bit about your design goals for the UI and how you took advantage of YUI to achieve those goals.**

Our main design goals for the UI were:

-   _Easy to build:_ This was very important as we wanted to build it fast and get to market. YUI is a large and comprehensive framework, but once you "get it" and understand the patterns of usage, it is very easy to use.
-   _Readily available components:_ Access to a readily available, well tested and reliable component library. We early on decided that the main component that we would need for showing the various pieces of AWS information would be a table control. YUI provides a bunch of reliable and tested components out of the box and the [DataTable](http://developer.yahoo.com/yui/datatable/) is one of them. This is a very versatile component and has handled everything we have thrown at it with ease. We use DataTables on pretty much every page of the app. We use AJAX everywhere via the [DataSource](http://developer.yahoo.com/yui/datasource/)/[Connection Manager](http://developer.yahoo.com/yui/connection/), [Logger](http://developer.yahoo.com/yui/logger/) for debugging, [Container](http://developer.yahoo.com/yui/container/) with [Panels](http://developer.yahoo.com/yui/container/panel/) and [Dialogs](http://developer.yahoo.com/yui/container/dialog/) for messages and forms, [Reset](http://developer.yahoo.com/yui/reset/)/[Fonts](http://developer.yahoo.com/yui/fonts/)/[Base](http://developer.yahoo.com/yui/base/)/[Grids CSS](http://developer.yahoo.com/yui/grids/) for page layout, [TabView](http://developer.yahoo.com/yui/tabview/) for preferences, [AutoComplete](http://developer.yahoo.com/yui/autocomplete/) for search filtering, [Animation](http://developer.yahoo.com/yui/animation/) for effects and [Dom](http://developer.yahoo.com/yui/dom/) and [Selector](http://developer.yahoo.com/yui/selector/) for DOM manipulation.
-   _Work in Firefox and Safari:_ We wanted to support these two browsers out of the box as a lot of the people that use AWS seem to be using one of them. Support for Internet Explorer was not a requirement initially, but we intend to fully support it for future versions. YUI has worked pretty well for us in both the browsers with no issues.
-   _Look good:_ The UI needed to have a nice clean look which was unified across all the components. We did not want a mix and match look and feel. The default Sam Skin for YUI is used for our application.
-   _Support:_ We also needed some support for the framework. It did not have to be commercial but we wanted a framework that had an enthusiastic community and active development. The [YUI forum](http://tech.groups.yahoo.com/group/ydn-javascript/) has been a fantastic resource for us and very helpful.

You can see the Ylastic in action using YUI on our [screencasts](http://ylastic.com/screencasts.html).

**3\. What implementation piece with YUI are you most proud of from a code/engineering perspective?**

Ylastic provides a dashboard which is the first page that our users see when they login. This page displays the current state of your entire AWS environment along with the service health status. There are four custom panels, one each for EC2, S3, SQS and SimpleDB displaying the relevant info for each service, and a datatable that displays the current service health, as you can see in the screenshot below. There is a lot of stuff going on in the background of this page including multiple datasources for retrieving the information asynchronously, a loading modal dialog, a monitor that knows when all the info has been retrieved, animation to fade in the panels as data arrives, and dom manipulation. Last but not the least, the page layout had to work correctly in both Safari and FF. YUI provided all the right tools and we were able to tie everything together and get it all to work.

[![The YUI DataTable and other components on the Ylastic Dashboard.](/yuiblog/blog-archive/assets/ylastic_dashboard.png)](http://ylastic.com/)

**4\. What lessons did you learn about working with YUI on a challenging project that might be of interest/use to other YUI developers?**

Spend some time up front prototyping and playing with the various components before doing any serious development work. This will really help you get familiar with the framework. Don't be afraid to dig in to the source code for YUI, which is well commented. The code is of a very high quality and you can learn a lot about using JavaScript efficiently by looking at the patterns used by the YUI team.

**5\. As YUI veterans at this point, what advice or wish list do you have for the YUI development team?**

The YUI team has done a great job of listening to the users and constantly improving the various components.

We would like to see more complex samples/examples for the various components. It would also be nice to have a cookbook for YUI, which shows off code snippets for common functionality.

In case of the datatable, this would provide a single place where you can quickly determine how to update a cell, delete a row, and so on. This will really help both new users and experienced users by providing all the important information in one place, may be even a wiki? The forums are a good resource but the volume of questions and usage is beginning to make it a little difficult to sort and search for things.

**6\. What's next for the Ylastic frontend's evolution?**

We are already working on supporting the iPhone for Ylastic and just posted a [sneak preview](http://blog.ylastic.com/?p=63) on our blog. We intend to work on supporting other moble platforms next, and we are planning on experimenting with the YUI for this. We are currently running on YUI 2.5.2, and intend to move over to the 3.x when it is released.