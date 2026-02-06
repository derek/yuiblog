---
layout: layouts/post.njk
title: "Implementation Focus: Squarespace"
author: "Unknown"
date: 2009-06-09
slug: "implementation-focus-squarespace"
permalink: /blog/2009/06/09/implementation-focus-squarespace/
categories:
  - "YUI Implementations"
---
![Members of Squarespace team: (From left to right) Paolo DeDios, Erica Reitman, Dane Atkinson, Jonathan Snook, Anthony Casalena, Tyler Thompson, Davin Chew, Rolando Berrios.](/yuiblog/blog-archive/assets/squarespace/team.jpg)

**Members of the Squarespace team:** _(From left to right) Paolo DeDios, Erica Reitman, Dane Atkinson, Jonathan Snook, Anthony Casalena, Tyler Thompson, Davin Chew, Rolando Berrios._

**Can you provide a background of projects where you've used YUI? What problems are you trying to solve for users?**

Squarespace has two different audiences that have to be served in different ways. We have Squarespace customers who use the tools that we provide and we have the people who visit the sites that our customers create. YUI is used to drive a lot of the functionality that we provide to our customers and do that in a way that works reliably cross-browser. If we don't provide a reliable in-browser experience, we'll hear about it with support requests.

We also have YUI available for our customers to use on the sites that they build (although it's never been a requirement). Our customers get to rely on a stable and reliable library for any of their own site-building needs.![Screenshot of Squarespace overview page.](/yuiblog/blog-archive/assets/squarespace/screenshot1.png)

**You chose YUI's JavaScript library to help drive the UI. What led you to make that choice?**

At the time the decision was made, YUI was the best choice. YUI is a well-designed library that considered the requirements of multiple scenarios, not limiting itself to one or two use cases. It was also one of the few libraries that had an integrated and supported set of widgets.

Also, the fact that YUI is actively maintained and tested so extensively with the [Yahoo! homepage](http://www.yahoo.com/) is a massive win. No other library we looked at was receiving that sort of extensive testing and coverage. When we have run into speed issues, it's turned out to be cross-browser issues unrelated to our use of YUI.

**What YUI components are in use on which projects?**

Of course the standard [DOM](http://developer.yahoo.com/yui/dom/) and [Event](http://developer.yahoo.com/yui/event/) stuff along with [Drag and Drop](http://developer.yahoo.com/yui/dragdrop/), [Animation](http://developer.yahoo.com/yui/animation/), and [Connection Manager](http://developer.yahoo.com/yui/connection/). On the widget side of things, we take advantage of [Calendar](http://developer.yahoo.com/yui/calendar/), [ColorPicker](http://developer.yahoo.com/yui/colorpicker/), and [Slider](http://developer.yahoo.com/yui/slider/).

**Design and interface quality are huge differentiators for startups. What are the features you have prioritized in your interfaces and what have you build on top of YUI?**

For Squarespace, design and interface quality is a big part of our success. We really work to create a polished in-browser experience so that customers can design and manage their sites all from one place. We're trying to replace desktop tools. The browser and YUI have allowed us to do that.

We pull in dynamic overlays allowing our customers to move content around, edit content on the spot, or add new content without requiring a page refresh. Squarespace also allows them to edit the look and feel of their sites dynamically. Change colours, images, or other CSS properties from the interface or have direct access to specify whatever CSS you want. It's really quite flexible, and we're very proud of how well it has been received.![Screenshot of Squarespace design view page.](/yuiblog/blog-archive/assets/squarespace/screenshot2.png)

**What are the next interface challenges you are tackling for upcoming releases?**

We have some great features that we're working on right now that will increase the flexibility that our customers will have to modify their content and design right from the browser but the challenge with doing more stuff within the browser is ensuring that you're creating a snappy and responsive interface. We definitely don't want them to be sitting there while we load up large assets. We want them to be able to jump in and play with their sites as quickly and easily as possible.

We plan to stick with YUI and will be watching [the progress of YUI 3](/yuiblog/blog/2009/05/12/video-desai-yui3/) very closely to see how it'll fit into our future plans.