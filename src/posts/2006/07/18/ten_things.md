---
layout: layouts/post.njk
title: "Ten Things Yahoo! Is Already Doing with the YUI Library"
author: "YUI Team"
date: 2006-07-18
slug: "ten_things"
permalink: /2006/07/18/ten_things/
categories:
  - "Development"
---
Since [the YUI Library](http://developer.yahoo.com/yui/) was released under an open-source BSD licence in February, we've gotten a lot of questions about YUI. One of the questions we've fielded more than any other, though, is also one of the best and most relevant: Who at Yahoo! is putting this stuff out into production? The answer is that almost everyone at Yahoo! is using YUI to some degree, including some of our most highly trafficked and high-profile sites. There are some notable exceptions — the Yahoo! Mail Beta and the new Yahoo! Photos, for example, are projects that started before YUI was available and work their DHTML magic using solutions crafted by their own engineering teams. But, increasingly, what we're seeing is that most new projects at Yahoo! are relying on YUI to serve as a foundation.

Inspired by our own [Dustin Diaz](http://www.dustindiaz.com/)'s recent post ("[15 Things You Can Do with Yahoo UI](http://www.thinkvitamin.com/features/javascript/15-things-you-can-do-with-yahoo-ui)") on the new frontend-developer journal [Vitamin](http://www.thinkvitamin.com/), we wanted to share with you ten things Yahoo! is _already_ doing with YUI. This list isn't exhaustive, nor does it suggest that these are the ten most important implementations; rather, these are ten that represent some of the breadth and depth with which YUI is being used within the Yahoo! family.

### 1\. Front Page's Personal Assistant

[![The new Yahoo! Front Page](/yuiblog/blog-archive/assets/ten_things/frontpage.gif)](http://www.yahoo.com/)Yahoo's Front Page redesign, recently out of preview and available at [http://www.yahoo.com](http://www.yahoo.com), uses YUI extensively in its Personal Assistant module toward the top right corner of the page. [Event Utility](http://developer.yahoo.com/yui/event/) is used to listen for mouse events when interacting with the module; [Connection Manager](http://developer.yahoo.com/yui/connection/) retrieves data on demand from the Personal Assistant's six services; and the [Animation Utility](http://developer.yahoo.com/yui/animation/) powers the smooth transitions as you move from module to module.

### 2\. My Yahoo! Drag & Drop Portal

[![My Yahoo!](/yuiblog/blog-archive/assets/ten_things/my.gif)](http://my.yahoo.com/)

[My Yahoo!](http://my.yahoo.com/) was one of the first major consumer sites to embrace RSS and allow users to fully experience the ["Come To Me" web](http://www.personalinfocloud.com/2006/01/the_come_to_me_.html) — the web in which information you care about, whether from Yahoo! or from any site with an RSS feed, is aggregated and arranged to your liking. In January, arranging that information got a whole lot easier when My Yahoo!'s developers gave the site a major infusion of YUI — [Event Utility](http://developer.yahoo.com/yui/event/), [Connection Manager](http://developer.yahoo.com/yui/connection/), [Drag and Drop Utility](http://developer.yahoo.com/yui/dragdrop/), [Animation Utility](http://developer.yahoo.com/yui/animation/), and the [Dom Collection](http://developer.yahoo.com/yui/dom/). The result: A personalized portal in which you can drag your content modules around on the page to reorder them. Note the use of the Animation Utility to soften the transition when you drop a module in a new location.

### 3\. AllTheWeb.com LiveSearch

No picture is provided for this example, because the only way to fully appreciate the responsiveness of this Search interface is to experience it yourself. [AllTheWeb's LiveSearch](http://livesearch.alltheweb.com/) provides an alternative interface to the Yahoo! Search platform and drives intense XHR-mediated traffic via [Connection Manager](http://developer.yahoo.com/yui/connection/), exploring the deep integration of client- and server-side application logic. (**Note:** This implementation imposes some browser restrictions at present; these restrictions are not intrinsic to YUI Library code, which is designed to work in all [A-Grade browsers](http://developer.yahoo.com/yui/articles/gbs/gbs.html).)

### 4\. Yahoo! Tech — Animated Page-Width Resizing (and More)

[![The new Yahoo! Tech](/yuiblog/blog-archive/assets/ten_things/tech.gif)](http://tech.yahoo.com/)[Yahoo! Tech](http://tech.yahoo.com/) is the first major Yahoo! product launched in the YUI era, and it takes full advantage of the library. One of the more unique uses of YUI on Tech is its implementation of a configurable content width control. This feature allows you to show and hide the secondary content column on the fly, and it employs the [Animation Utility](http://developer.yahoo.com/yui/animation/) to gradualize the transition for good measure — an innovative approach to handling the variety of screen sizes and browser viewport sizes with which users view Tech's content-rich pages.

### 5\. Yahoo! Finance CSS Reset, Fonts, & Grids

[![Yahoo! Finance employs the YUI CSS platform.](/yuiblog/blog-archive/assets/ten_things/finance.gif)](http://finance.yahoo.com/)

[Yahoo! Finance](http://finance.yahoo.com/) takes advantage of one of the newer components of the YUI Library, the [CSS Reset](http://developer.yahoo.com/yui/reset/), [Fonts](http://developer.yahoo.com/yui/fonts/) and [Grids](http://developer.yahoo.com/yui/grids/) packages. Try visiting Finance and zooming your text size — notice that the page's wireframe zooms right along with the text, keeping the integrity of the design intact at the larger size. This is just one benefit of these infrastructure CSS components that provide a stable, flexible, and future-friendly foundation for your web site.

### 6\. Yahoo! Search Y!Q Drag and Drop Contextual Search Module

[![Y!Q Contextual Search](/yuiblog/blog-archive/assets/ten_things/yq.gif)](http://news.yahoo.com/)Drag and Drop implementations can be complicated, but some of the best implementations are quite simple. When you click on a [Y!Q contextual search](http://yq.search.yahoo.com/) link on any site that implements it (like [Yahoo! News](http://news.yahoo.com/), or even many non-Yahoo sites [via the Y!Q API](http://yq.search.yahoo.com/publisher/embed.html)), a small window pops up with search results for the linked term. That window can be moved around using a simple implementation of the [YUI Drag and Drop Utility](http://developer.yahoo.com/yui/dragdrop/), allowing you to position it on the page as desired, out of the way of anything it may be obscuring.

### 7\. Yahoo! Sports Torino Olympics AutoComplete Content Navigator

[![AutoComplete powering site-wide search on the Yahoo! Winter Olympics site.](/yuiblog/blog-archive/assets/ten_things/sports.gif)](http://sports.yahoo.com/olympics/torino2006/)[Yahoo! Sports](http://sports.yahoo.com) designers wanted to do something special for the [2006 Winter Olympics in Turin](http://sports.yahoo.com/olympics/torino2006/), something that would make it easier to navigate to check on the action for individual athletes, sports and countries. So they took the [YUI AutoComplete Control](http://developer.yahoo.com/yui/autocomplete/) and put it to work, developing a slick navigator that augments directory-style navigation with something much faster and more powerful. Typing a few characters in the search box and arrowing to your selection allows you to get to your destination in world-record time.

### 8\. Yahoo! News Animated SuperTicker

[![Yahoo! News employs the YUI Animation Utility to promote top stories and features in its SuperTicker.](/yuiblog/blog-archive/assets/ten_things/news.gif)](http://news.yahoo.com/)

[Yahoo! News](http://news.yahoo.com/) takes the ticker idea to a new plateau with its smooth-scrolling SuperTicker. This module, which promotes major features toward the top of the main News page, overloads a `<div>` horizontally and uses the [YUI Animation Utility](http://developer.yahoo.com/yui/animation/)'s Scroll subclass to slide the content back and forth — automatically via a timer or as a navigation control when the user clicks on the arrows at the module's lower corners.

### 9\. Yahoo! Health Refresh Content Scroller

[![Yahoo! Health implements the YUI Slider Control to create a customized scrollbar.](/yuiblog/blog-archive/assets/ten_things/health.gif)](http://health.yahoo.com/)

[Yahoo! Health](http://health.yahoo.com) has its own take on the horizontally-scrolling ticker, employing YUI components including the [Slider Control](http://developer.yahoo.com/yui/slider/) and the [Animation Utility](http://developer.yahoo.com/yui/animation/) to provide a Health Expert Advice module loaded with content in a compact space. Note the highly customized implementation of the Slider Control along the bottom of the module.

### 10\. Yahoo! Groups Advanced Message Search

The [YUI Calendar Control](http://developer.yahoo.com/yui/calendar/) makes date-selection a snap. The [Yahoo! Groups](http://groups.yahoo.com/) implementation of this is a nice one. Go to the Advanced Search page in the Messages section of one of your groups, and use the select menu for Dates to search for messages between two dates. The standard interaction model presents itself — three select menus for each date (month, day, and year), requiring six mouse clicks (or three long click-and-holds) to choose each date. But a single click on the calendar icon next to the select menus summons up the Calendar Control, and another click selects your date, giving you the same result with one-third as many clicks. Sometimes it's the little things that matter most.

[![Yahoo! Groups uses the YUI Calendar Control to reduce the mousing load on date selection by as much as 66%.](/yuiblog/blog-archive/assets/ten_things/groups.gif)](http://groups.yahoo.com/)

### What Are You Doing with YUI?

These are just ten examples of how Yahoo! is deploying the YUI Library today. These projects, and the dozens of others we're tracking, leverage the _a la carte_ nature of YUI, a characteristic that is allowing properties to enrich their interfaces gradually and incrementally. There are exciting things afoot in frontend engineering at Yahoo! beyond just YUI — see Yahoo! Finance's new [Flash-based charting](http://finance.yahoo.com/charts#chart5:symbol=T;range=5y;compare=BLS+AT;charttype=line;crosshair=on;logscale=on;source=) for one example — but YUI is playing an important role in the evolution of theYahoo! product family.

**Now it's your turn:** What are _you_ doing with the YUI Library? If you're using YUI in your own work, we'd love to hear from you and to make your project available to the larger YUI community on the [YDN-JavaScript Yahoo! Group](http://groups.yahoo.com/group/ydn-javascript/). Please share the url and a project description [in the YUI application gallery](http://groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/) and/or in the comments below.