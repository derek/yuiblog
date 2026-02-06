---
layout: layouts/post.njk
title: "NodeConf 2013"
author: "Alexander Shusta"
date: 2013-08-06
slug: "nodeconf-2013"
permalink: /2013/08/06/nodeconf-2013/
categories:
  - "Development"
---
[![Evening Sing-along](http://farm8.staticflickr.com/7427/9326217062_2561c90c0b_z.jpg)](http://www.flickr.com/photos/ashusta/9326217062/ "Evening Sing-along by Î�±lexander, on Flickr")

This year's NodeConf was a mix of previous NodeConfs (that were run like most conferences) and the annual NodeConf Summer Camps (that were run like, well, a summer camp). The format differed from most conferences by providing outdoor activities like dodgeball, lake swimming, and campfires with sing-alongs. It emphasized small group sizes for talks and providing only one technical path. Despite some initial concern that summer camp themed activities would impinge upon time available for learning and hacking, by the end of the weekend I was very happy with the format.

Most conferences ask presenters to put together and present their content to a single audience that may consist of many hundreds of attendees. NodeConf flipped that around to asking presenters to repeatedly present to many smaller groups. This allowed attendees time to ask for clarification or even for some one-on-one help without worrying about the impact that they might have on (literally) hundreds of other people. I assume that getting presenters who were willing to spend 10 times as much time talking as they would at another conference was a challenge, but [Mikeal](https://twitter.com/mikeal) came through and organized a bang-up group of presenters who really know Node.js and who care about building the community around the product.

So, what was the process like? We arrived at [Walker Creek Ranch in North Marin](http://y.ahoo.it/wQulq1/a) on Thursday, and each person was assigned a schedule of sessions to attend. Because there was only one technical track every developer attended every session, but the order of attendance was randomized so that people would have more opportunity to meet other attendees than might have occurred if they attended the sessions with a static cohort. After schedule pickup we were left to socialize and explore the facilities until the welcome campfire / sing-along started. The actual sessions started on Friday morning and were 55 minutes in length with approximately 30 campers per session.

Of course there was [Foursquare](http://en.wikipedia.org/wiki/Four_square):

[![Foursquare at NodeConf](http://farm4.staticflickr.com/3717/9321244309_b81df976eb_z.jpg)](http://www.flickr.com/photos/ashusta/9321244309/ "Foursquare at NodeConf by Î�±lexander, on Flickr")

## Schedule

-   **Thursday** - arrive, setup camp, get schedule and meet other attendees
-   **Friday** - sessions 1 through 6, campfire and sing-along
-   **Saturday** - sessions 7 and 8, presenter 'office hours', hacks, campfire and sing-along
-   **Sunday** - finish up hacks and depart

## Presentation Summaries

### Hardware

Node.js is mostly used for serving web pages, but it is designed as a general computing platform. The Hardware presentation was based around using Node.js with the [Johnny Five package](https://github.com/rwldrn/johnny-five) to control an Arduino development board to demonstrate Node.js interacting with the physical world. Presenters Raquel Velez, Elijah Insua, and Rick Waldron stepped developers through setting up Arduino and writing a simple application for communication between the hardware and a Node.js instance with plenty of time for hands-on help and hacking.

The presentation slides are available at [https://speakerdeck.com/rockbot/nodeconf-nodebots-session](https://speakerdeck.com/rockbot/nodeconf-nodebots-session).

### Stream Modules

Streams are "a dependable way to compose large systems out of small components that do one thing well." They're essentially Unix pipes writ large allowing output from one program to be programmatically used as input to another program. Presenters Max Ogden, Substack, and Matt Podwysocki gave an overview of how streams are used in Node.js and then helped attendees work through the [Stream Adventure](https://github.com/substack/stream-adventure) game / programming challenge. Substack also wrote a Stream Handbook, available at [https://github.com/substack/stream-handbook](https://github.com/substack/stream-handbook).

### Web Services

This was an overview session of web-service stacks on Node.js. Presenters Eran Hammer and Mike Cantelon covered a lot of material relating to [Hapi](http://spumko.github.io/) and [Express](http://expressjs.com/). The general pattern for handling and responding to HTTP requests on Node.js has solidified around the following steps:

1.  **routing** - figure out what resources the request is trying to load
2.  **middleware** - apply application-specific rules based on the route
3.  **authentication** - does the user actually have permission for that resource
4.  **reply** - send the HTTP response out to the user

A maintainable web service will use this pattern to efficiently marshall and transmit resources to users. A full web site will make use of a framework (like Walmart Labs' Hapi or Yahoo!'s [Mojito](http://developer.yahoo.com/cocktails/mojito/)) that extends the pattern to support MVC-like functionality for your content.

### NodeCopter

Parrot AR drones, controlled by Node.js! Nexxy provided us with a cheat-sheet of the commands provided by the [`node-ar-drone`](https://github.com/felixge/node-ar-drone) package, instructions for connecting to the drone, 1 drone for every 2 developers, a few words of encouragement to get started and copious quantities of LiPo batteries while we worked.

Using a [REPL](http://en.wikipedia.org/wiki/REPL) you can interactively control the drone and verify how each command will be executed. Once you're confident in how the drone will react you can execute Node.js programs normally to send the drone on missions. It was a great example of how the Node.js REPL can be used to dynamically create programs. I was personally too nervous about losing the drone to allow for autonomous execution of my code but if the earlier Hardware session hadn't convinced me that Node.js is useful as a general computation platform this one did.

### Debugging & Performance Analysis with DTrace

Debugging Node.js performance issues can be tricky due to the asynchronous nature of the platform and the fact that things are evolving very quickly. [DTrace](http://en.wikipedia.org/wiki/DTrace) is a tool that allows you to capture events and state from your code as it is executed in production. Presenter, Max Bruning from Joyent walked us through a series of labs that showed how to instrument code, all the way down to the kernel, for debugging of live systems.

What's really impressive about DTrace (well, a lot, but let's say what was most impressive to me) is that you use instrumented code with nearly zero overhead so that it is possible to pull live data off of production hosts with all of the travails that they encounter. If your hosts are experiencing outages due to DDOS or configuration issues that cause a tight loop of execution, this is the best way to get access to information that might otherwise be lost as log files overflow.

### How to Node Core

[Node core](https://github.com/joyent/node) is the name given to a group of classes that constitute the heart of the Node.js application. Isaac Z. Schlueter, the primary maintainer of node core and [NPM](https://npmjs.org/) presented an overview of what it takes to contribute code to this foundational layer of the Node.js stack. Isaac was at pains to show that, with care, most developers can contribute code that will be accepted and merged. His definition of who should contribute to node core is "rockstars and users". Which is to say, everyone who has a stake in the performance and stability of Node.js is encouraged to help make it better.

Key take-aways from the session:

1.  tests are absolutely required
2.  test names should be descriptive
3.  test return values must fit the existing pattern of returning 'ok' for success
4.  tests must run in under 100MS
5.  contributing changes to node core is not difficult, but it does require attention to detail

Isaac's slides are available at [http://www.slideshare.net/IsaacSchlueter/how-tonodecore?ref=http://blog.izs.me/post/54766250297/nodeconf-2013](http://www.slideshare.net/IsaacSchlueter/how-tonodecore?ref=http://blog.izs.me/post/54766250297/nodeconf-2013)

### Node.js Domains

Try/catch is slow and doesn't work with asynchronous callbacks. By wrapping Node.js code in a domain you can deal with exceptions that occur during callbacks. These work very much like closures in JS where a developer can control the visibility of their code and handle any internal errors that occur by wrapping the code into a self-contained module / function. Presenters Forrest Norvell and Domenic Denicola explained how to use domains to successfully handle (or at least get meaningful logs from) errors in asynchronous code.

Slides are available at [http://othiym23.github.io/nodeconf2013-domains/#/](http://othiym23.github.io/nodeconf2013-domains/#/). Anyone who wants to maintain maximum service availability should really understand how domains are used.

### Distributed Apps

Running a distributed application on node is surprisingly easy. Because everything is already set up for asynchronous callbacks it doesn't really matter where code is executed, so long as its output can be routed to the correct place. Presenters Dominic Tarr and Jake Verbaten walked attendees through the creation of a chat client/server application where each user provided both a client and a server. This was a very hands-on session with developers working heads-down to get their systems hooked into the network and chatting away.

## Conclusions

Camping and code don't seem like they'd go together, but in this case they did. Having a steady supply of electricity and a (slowish) Internet connection meant that everyone was able work throughout the weekend without suffering the attention drain that unfettered access to the 'net can induce. Making Node.js accessible to senior and junior developers, with presenters who could talk about any level of the stack, is what really made the conference for me. The sing-alongs and s'mores were a nice add-on, but not really necessary with such a strong lineup of sessions and such a beautiful venue.

[![Morning View from the Tent](http://farm3.staticflickr.com/2840/9324036548_391f2cd41f_z.jpg)](http://www.flickr.com/photos/ashusta/9324036548/ "Morning View from the Tent by Alexander, on Flickr")