---
layout: layouts/post.njk
title: "Implementation Focus: PowerReviews"
author: "Jack Slocum"
date: 2006-10-13
slug: "powerreviews"
permalink: /2006/10/13/powerreviews/
categories:
  - "Development"
---
![Members of PowerReviews engineering team: (clockwise from top left) Martin Davidsson, Gautam Prabhu, Jim Morris, Joshua Greenough, Aamir Virani, and Vlod Kalicun](/yuiblog/blog-archive/assets/powerreviews.jpg)

**Members of the PowerReviews engineering team:** _(clockwise from top left) Martin Davidsson, Gautam Prabhu, Jim Morris, Joshua Greenough, Aamir Virani, and Vlod Kalicun. At their Millbrae offices._

What is PowerReviews and how long have you been around?

We've been around about a year and four months. The goal of the site is to become the "review engine of the web," providing a better place to research products via review data. There are enough price comparison tools on the web already. If the customer buying process is first research, then price-compare, then buy, we want PowerReviews to the place for doing the research...we call it "research on your terms."

Where does YUI fit into your needs and process? Why did you choose YUI?

We built our first generation using [the Prototype library](http://prototype.conio.net/) and home-brew code for some basic interactions and effects, but we've moved to YUI for our second-generation. We're trying to rip out as much home-brew as we can and use YUI as much as possible. A big part of choosing YUI for us was the documentation. We also liked the ability to choose individual components, the fact that it ships with minified source, and the fact that it's used on Yahoo...we know at least that it's being tested at a high volume and in a lot of browsers. Fundamentally, we tend to agree with the engineering philosophies that the YUI team is espousing.

What has been the most rewarding aspect of moving to a more dynamic interface?

We like being able to make the process of creating a review more interactive and contextual. Desktop applications make this kind of thing really easy, but it's been hard on the web. Using Ajax has for us allowed the site to take on some of those more interactive characteristics.

We've also used interactivity on the administrative side to improve productivity. We're using things like inline editing for auditing and approving reviews as they come in. It can be simple things, but it's saving pageloads and keystrokes and, ultimately, time. It's also incremental — if one of our clients does a series of steps and the browser crashes, everything they've done along the way gets saved.

What, if anything, has surprised you about switching to YUI as your client-side platform?

YUI incorporates the CSS foundation we needed and provides for us a tie-in between CSS and JavaScript — it's like we're getting that all for free, using the YUI team as an outsource group to help us build foundations. We think there also will be leverage down the road, being able to hire engineers who are familiar with YUI and therefore can pick up our stuff and contribute faster.

What have been the pain points in adopting YUI?

The main detriment we've found is that YUI doesn't have the same kinds of distilled, one-line effects that you find in [Scriptaculous](http://script.aculo.us/). We've looked at [Jack Slocum](/yuiblog/blog/2006/10/10/ten-questions-slocum/)'s stuff, and we see some of that emerging with YUI. But there are some more complicated interactions built-in for you with Scriptaculous.

Filesize is a concern for us, too. We can control gzipping on our own site, but we distribute our solution to our customers; if they don't enable gzipping, the library's filesize goes up.

Have you looked at the [Yahoo! Patterns library](http://developer.yahoo.com/ypatterns/) in planning your implementation of a richer client-side feature set?

Yes. That's been a big part of our thinking, too. There are standards there, and they sound really simple at times but incorporate a lot of things that have been learned at Yahoo and elsewhere. And these are the emerging patterns on the web, so we can rely on our users tending to be familiar with these patterns.

_Do you have a YUI implementation that would be of interest to the YUI community? If so, please [share your link](http://groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/) and post a message to the community forum at [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/), or leave us a message in the comments section below._