---
layout: layouts/post.njk
title: "Implementation Focus: Confirmit"
author: "Eric Miraglia"
date: 2009-04-02
slug: "confirmit"
permalink: /2009/04/02/confirmit/
categories:
  - "YUI Implementations"
---
[![Confirmit](/yuiblog/blog-archive/assets/confirmit-20090331-121127.jpg)](http://confirmit.com/)

**What is Confirmit? Tell us a little bit about the company.**

Confirmit has been around since 1996, and we are now over 250 employees globally, with offices in Guildford, London, Oslo, New York, San Francisco, Moscow and Yaroslavl.

Confirmit targets Global 5000 companies and Market Research agencies worldwide with a wide range of software products for feedback / data collection, panel management, data processing, analysis, and reporting. Customers include British Airways, Countrywide Financial, Dow Chemical, Experian, GlaxoSmithKline, Halifax Bank of Scotland, Hewlett Packard, Intrawest, Ipsos, Nielsen, The NPD Group, Safeco Insurance, StatoilHydro, Symantec and Virgin Media.

The goal of Confirmit as a company is to revolutionize the survey, panel and reporting process through automation and integration. The goal of the R&D department is to support this by creating a high quality product that is capable of tackling current and future challenges in the market.

![Confirmit Express survey designer, using Yahoo, Dom, Event, Animation, Connection, Json, and  Selector.](/yuiblog/blog-archive/assets/confirmit-ui-20090401-130747.jpg)

**From a frontend engineering perspective, what are the core challenges you face in your work on Confirmit?**

The core challenges we face from a front-end engineering perspective would have to be the fact that most of our developers are in fact not front-end engineers. YUI helps us a lot in this area, and does so in a manner that in most instances are transparent to the developers. The less they need to know about how for instance attaching events differs from browser to browser, the better. We can't all be browser geeks in the R&D department, but we should not have to be in order to be productive.

Now that browsers are evolving so quickly (as opposed to the first half of the decade), having a code-base that is ready for the current and future browsers is definitely the biggest challenge in creating a rich web interface.

**Why did you choose YUI as part of your JavaScript foundation?**

I felt \[YUI\] would be an excellent choice as our JavaScript framework of choice, considering Yahoo's own requirements when it comes to performance, stability, browser support, etc. For the first week of March we averaged about two million page-hits daily on our surveying servers, and about two hundred thousand page-hits daily on the survey authoring servers. Our primary strengths are security, scalability and performance, so we needed a JavaScript framework that supports these product qualities. I also felt that the YUI project would not be a short-lived one, and that I could count on it being updated and maintained for a long time considering the solid reputation of the company responsible for it.

**How are you using YUI in your site today?**

![Survey using YUI Calendar for date questions. ](/yuiblog/blog-archive/assets/confirmit-calendar-20090401-131348.jpg)We are using YUI in almost every area of the product. The core library is deeply integrated into the survey authoring and reporting platforms ([Yahoo](http://developer.yahoo.com/yui/yahoo/), [Dom](http://developer.yahoo.com/yui/dom/), [Event](http://developer.yahoo.com/yui/event/), [JSON](http://developer.yahoo.com/yui/json/), [Selector](http://developer.yahoo.com/yui/selector/)), and we are also using the [Connection Manager](http://developer.yahoo.com/yui/connection/) a lot for XHR/Ajax.

Confirmit Express (the entry-level product for survey authoring) is also using the [Animation Utility](http://developer.yahoo.com/yui/animation/) heavily.

We are also using quite a few components in the survey front-end ([Slider](http://developer.yahoo.com/yui/slider/), [Calendar](http://developer.yahoo.com/yui/calendar/), [Get](http://developer.yahoo.com/yui/get/), [Cookie](http://developer.yahoo.com/yui/cookie/), [YUI Loader](http://developer.yahoo.com/yui/yuiloader/), [DragDrop](http://developer.yahoo.com/yui/dragdrop/), [Resize](http://developer.yahoo.com/yui/resize/)) in order to create a more interesting experience for the respondent.

![Screenshot of a survey using a numeric slider. ](/yuiblog/blog-archive/assets/confirmit-slider-20090401-130956.jpg)

Elsewhere in the product we are using [YUI AutoComplete](http://developer.yahoo.com/yui/autocomplete/) and [Rich Text Editor](http://developer.yahoo.com/yui/editor/).

We are combining the components in use with our own core libraries during build time in order to reduce the number of requests to the server, meaning we have one combined JavaScript file for survey authoring, one for reporting, one for surveys, and one for Confirmit Express. We have of course considered using the Yahoo or Google combo handler for this, but the lack of an SLA and SSL support has prevented this so far. \[_Note: Google's CDN does provide SSL. -Ed._\]

![YUI Resize in use in the Confirmit interface.](/yuiblog/blog-archive/assets/confirmit-resize-20090401-131751.jpg)

**In using YUI for these projects, what aspects of the library have been particularly pleasing to work with and powerful in solving problems?**

My personal favorite components would have to be [Event](http://developer.yahoo.com/yui/event/) and [Connection](http://developer.yahoo.com/yui/connection/). Dustin Diaz has a great article on [how and why you should use the Event Utility](http://www.dustindiaz.com/yahoo-event-utility/); it should be very educational for anyone who hasn't had the time to get to know the Event Utility in detail.

When it comes to the Connection Manager, I love the fact that it does exactly what you need, and nothing more. Make a request, specify the http method, specify the form to send if needed, and provide a handler for the response. It’s not doing anything too fancy, but it’s all very nice and clean, resulting in very readable and maintainable code.

**What's the most innovative thing you've done with YUI in the current release of Confirmit?**

In the Inline Surveys project we use [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) to set up the JavaScript environment and the [Get Utility](http://developer.yahoo.com/yui/get/) for the cross-domain requests. If the page hosting the Inline Survey is on our own domain we switch from the Get Utility to [Connection Manager](http://developer.yahoo.com/yui/connection/) for XHR, and the similarities in the interfaces of these two components makes this extremely easy to accomplish.

**What would you like to see YUI developers improve on in upcoming releases of YUI?**

It would be great to have some chaining functionality in YUI. We are using [DEDChain](http://dedchain.dustindiaz.com/) internally as a chaining wrapper for YUI, and it does the job. But I would really like to see what the YUI team could come up with if they put their brilliant minds to it (since this will be included in [YUI 3](http://developer.yahoo.com/yui/3/) I guess I will get my wish).

Some more skins would also be great. The SAM skin is excellent, but it would be good to have more than one to choose from, especially a darker blue one and perhaps a white on black skin.

I am also really looking forward to seeing the lazy load syntax in YUI 3, it seems like a very nice way of working with the different YUI components that you don’t want to have preloaded in the initial page delivered to the browser.