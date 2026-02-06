---
layout: layouts/post.njk
title: "Using Your App's YUI Components on the Server"
author: "Eric Ferraiuolo"
date: 2012-04-23
slug: "using-your-apps-yui-components-on-the-server"
permalink: /blog/2012/04/23/using-your-apps-yui-components-on-the-server/
categories:
  - "Development"
---
For my first sprint of 3.6.0 development I'm writing up (and showing by example) how to develop an app using YUI on the client _and_ server, which works on both the desktop and mobile devices. Code sharing and reuse FTW! To start this process, I wanted to first build something using the development approaches that we want to promote. I've done that and I want to report in on my first experience running YUI on Node.js (spoiler: it was awesome!)

[Photos Near Me](http://photosnear.me/), an app that shows you interesting photos near your current location, is a project I started almost a year ago to dogfood the [YUI App Framework](http://yuilibrary.com/yui/docs/app/) while [Ryan Grove](http://twitter.com/yaypie) and I were writing it. I've been keeping the app up to date with the latest changes and additions to the App Framework, including the use of [`Y.App`](http://yuilibrary.com/yui/docs/app/#app-component), the newest component in the App Framework. Photos Near Me has always been a client-side only app up until now!

My plan was to power the Photos Near Me server using Node.js, Express.js, and YUI, and I set two goals: share the app's model objects and share its [Handlebars](http://yuilibrary.com/yui/docs/handlebars/) templates between the client and server. Thanks to [Dav Glass](http://twitter.com/davglass) who has put in a ton of effort to make [YUI run on Node.js](http://yuilibrary.com/yui/docs/yui/nodejs.html) in an intuitive, seamless way, I was able to easily accomplish these goals after several hours of refactoring the app. I was pleasantly surprised that my first try instantiating one of the model objects server-side and calling its `load()` method, which fetches data from YQL, _just frickin' worked!_

Photos Near Me now renders the initial state for a request on the server then hands off control to the client-side `Y.App` instance. From there, in modern browsers which can use HTML5 History, all routing, data fetching, and page rendering will be done client-side; while older browsers will perform full page loads handled by the server. The time from request to seeing photos has been drastically reduced, it was especially noticeable on my iPhone when refreshing the page.

Being able to use the _exact same code_ for the models and templates between the client and server makes following the [best practices](http://yuilibrary.com/yui/docs/app/#best-practices) of progressive enhancement much easier to implement.

Check out Photos Near Me:  
[http://photosnear.me/](http://photosnear.me/)

And its source:  
[https://github.com/ericf/photosnear.me](https://github.com/ericf/photosnear.me)

Watch for my comprehensive tutorial on building apps with YUI which will use Photos Near Me as an example to describe and show in detail how to use YUI on the server and client to build apps which run in desktop and mobile browsers while following the best practices of progressive enhancement.