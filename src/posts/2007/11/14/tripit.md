---
layout: layouts/post.njk
title: "Implementation Focus: TripIt"
author: "Unknown"
date: 2007-11-14
slug: "tripit"
permalink: /blog/2007/11/14/tripit/
categories:
  - "YUI Implementations"
---
**Q: Please tell us a bit about your company, TripIt**

A: Over the past year or so I have been working on building TripIt, after a six-year hiatus from web application development. TripIt is a personal travel assistant that helps you organize your travel plans and stay in touch with your friends and colleagues.  We want to replace the manila travel folder as the preferred way to manage your travel plans.

![Just email TripIt your travel plans--no matter where you booked.](/yuiblog/blog-archive/assets/tripit2.jpg)![TripIt builds you a master itinerary with all your plans and more.](/yuiblog/blog-archive/assets/tripit4.jpg)![With TripIt, it's easy to share, print, and access your itinerary from anywhere.](/yuiblog/blog-archive/assets/tripit6.jpg)

The core of the application is a set of technologies that we call The Itinerator.  The Itinerator has three primary responsibilities.

-   Consume all of your travel information and understand it so that it can enhance it with all kinds of meta-information such as maps, directions, and weather.
-   Provide tools for both organizing and sharing your travel information
-   Provide as many channels for re-distributing your travel information through a variety of open standards and protocols such as iCalendar, email, etc...

After months of development, TripIt launched our open beta on September 17th, 2007 at the TechCrunch 40 conference and the response so far has been incredible.  There is no greater joy for engineers than when people use what they have built.  That said, TripIt is at the very beginning of its life, and we are constantly learning and improving the application to better serve our customers.

[![A sample Tripit itinerary.](/yuiblog/blog-archive/assets/tripit.gif)](http://www.tripit.com/uhp/sampleItinerary)

**Q: Can you tell us why you chose YUI, and how you’re using it?**

A: When we started TripIt, one of the first choices we made was to pick our web development framework.  We chose Symfony, which, like a lot of the web development frameworks out there, comes with an embedded copy of Script.aculo.us.  At the time, I hadn't done any UI coding for the web in over six years and we had to get this thing started (FAST!), so we just used what we were given.  Script.aculo.us is a great library and is very fast and lightweight.  The problem was that it didn't have all the widgets we needed and we were moving so quickly that we couldn't afford a lot of time finding the best calendar widget, the best menu widget, etc...  So, I began looking around to see what else was available, and came across YUI.

YUI was perfect for us.  It had the best combination of widgets, lean design, comfortable programming model, and, most importantly, good documentation and examples.  It also had a small but growing -- and seemingly excited -- community of people who were using it (all important things to look for when evaluating any piece of open-source software!).  We got everything moved over to YUI and have never looked back.

**Q: What are you using in YUI?**

A: At this point, TripIt is using most of the library’s controls ([AutoComplete](http://developer.yahoo.com/yui/autocomplete/), [Calendar](http://developer.yahoo.com/yui/calendar/), [Container](http://developer.yahoo.com/yui/container/), and [Menu](http://developer.yahoo.com/yui/menu/)).  Of course, we're using the core [Yahoo Global Object](http://developer.yahoo.com/yui/yahoo/), [Dom](http://developer.yahoo.com/yui/dom/), and [Event](http://developer.yahoo.com/yui/event/) components, as well as [Animation](http://developer.yahoo.com/yui/animation/), and [Connection Manager](http://developer.yahoo.com/yui/connection/),

**Q: Every adoption of a new technology comes with some pain. What have the pain points been in adopting and using YUI so far?**

A: The biggest pain we had in first getting started with YUI was the visual styling of the widgets.  We started using YUI before it was skinnable (i.e. pre-2.3) and ended up reverse engineering a lot of the YUI styles that control the look and feel of the calendar and menus.  This led to some instability in the UI.  One of the main reasons we upgraded to YUI 2.3 (which was a bit painful as well) is that we can, over time, sort those issues out.  We were very happy that the YUI development team recognized this problem in the community and added Skins.

**Q: What role did YUI play in the building of TripIt?**

A: When we started building TripIt I was the UI engineer (among other things!) but I hadn't programmed a real web application in about six years.  Back then AJAX existed as a technique but most web developers (myself included) probably would have said it was a bathroom cleaner.  Nowadays, of course, it's expected that web sites have both dynamic elements and communicate asynchronously with the web server.  The one thing I noticed that hadn't changed over the years was the lack of consistent and current support of web standards across all of the major browsers.  YUI was critical in enabling someone like myself (i.e. a software engineer who hadn't done much UI development) to get up to speed quickly and build a modern website that worked well across all of the major browsers.  YUI doesn't solve all of your problems, but it does make a lot of the more basic issues go away.  Fortunately for TripIt, I don't do most of the UI development these days so you will see the UI dramatically improve over the next couple of months under our UI engineering lead’s expert guidance.

**Q: What's next for TripIt?**

A: We're going to continue to make TripIt smarter and smarter so that it can do more complex tasks for our travelers.  You can expect us to work hard to support more vendors and input formats, as well as add more ways to access and use your travel information.  The goal is for TripIt to be able to integrate your travel plans wherever you choose to book and to give that information back to you in the format or application you find most useful.  Examples of the types of things you will see us work on are:  features such as "TripIt To Me," which we just introduced as a Launchpad company at the recent Web 2.0 Summit.  With this feature, you can get instant access to all of your travel information on your e-mail enabled smartphone or PDA using a very simple and intuitive command language.

It's important to keep in mind that TripIt is just getting started. We have an engineering and product development team that is passionate about listening to user feedback.  We're also fortunate to have a traveler community that is excited about what we're doing and giving us a wonderful stream of feedback. A lot of what comes next will be heavily influenced by the TripIt community itself, so let us know what you think!

**Q: Final thoughts?**

A: I just wanted to thank you for the opportunity to talk directly with the [YUI community](http://tech.groups.yahoo.com/group/ydn-javascript/).  We appreciate the work the YUI development team is doing with YUI and are very happy that Yahoo is releasing this great work for use by the development community.