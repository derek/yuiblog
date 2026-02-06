---
layout: layouts/post.njk
title: "Implementation Focus: Mint.com"
author: "Matt Snider"
date: 2007-12-05
slug: "mint"
permalink: /blog/2007/12/05/mint/
categories:
  - "YUI Implementations"
---
**Matt, tell us a little bit about Mint's history and the problem space you're addressing with your product.**

Mint was founded in 2006 by Aaron Patzer, after he realized that software could do far more than had been previously achieved to help people understand and manage their money. He quit his day job and began coding — forming the earliest parts of the application that powers Mint.com today.

**Mint was [a big hit](http://www.techcrunch.com/2007/09/18/mint-wins-techcrunch40-50000-award/) at the TechCrunch 40 event this year, taking home the top award and a $50,000 prize. From an engineering perspective, what did you learn from that event about the current generation of startups and what it takes to be exceptional in this second generation of web-based companies?**

It became apparent that a lot of companies had flashy UIs with lots of AJAX goodness, but few sites had a clean and clear UI with enough substance to stick. It drove home the point that just because I can use AJAX, it is not always prudent to do so. (It also doesn't hurt to solve an actual need and have a real revenue model.)

![The Mint homepage.](/yuiblog/blog-archive/assets/mint.gif)

**Obviously, inspiring trust in your product is crucial to you, so a frontend experience that feels simple and secure was a high priority. What were the aspects of Mint as a web application were a particular focus for you? What were the big challenges you were facing in the browser?**

We spent several months developing and iterating on the account page. It had to be simple enough that the user could add an account in under a minute, but complex enough to manage all the accounts of a user. It takes approx. 30 seconds to add a bank account to Mint — not a long time considering you only do that once — but we still wanted to make it as easy and fast as possible. We needed a UI that conveyed clearly that you could start adding all your accounts in parallel, without waiting for the first one(s) to finish \[_see screenshot below_\] . We choose a wallet-like design, where you have specific slots for each "card" — each of which uses AJAX and has its own independent status indication and progress bars. All interaction, with an account or collection of accounts, then needed to be driven through this paradigm.

Since we are using the core YUI package, we had few cross-browser issues. Consequently, the biggest challenge ended up being with the regex engine in Safari 2. The JSON object used to update each card can become quite large. I use [Douglas Crockford's JSON parser](http://json.org/) to validate that the response is a valid JSON object. However, in Safari, if the JSON object was larger than 5000-7000 characters, it would crash the browser without warning.

\[_Note: Luke Smith on the YUI team has adapted Douglas's work for inclusion directly in YUI as of [the 2.4.0 release](/yuiblog/blog/2007/12/04/yuii-240/); see the [YUI JSON Utility User's Guide](http://developer.yahoo.com/yui/json/) for more. -Eric_\]

![The Mint user interface.](/yuiblog/blog-archive/assets/mint_ui.gif)

**You adopted YUI early in the process, and it continues to be an important part of the mix for your frontend architecture. We know you guys take your JavaScript approach seriously, as [your blog](http://www.mattsnider.com/) attests. What informed your decision to go with YUI as opposed to a pure home-brew solution or one of the other free alternatives?**

We choose YUI for many reasons — here are a few of them: well documented and cross-browser safe code, large development team, high adoption, very active community, and the clout of Yahoo! behind it. There was no reason to reinvent the wheel, when such a solid (free) product already existed. And, our UI development team won't rival the size of YUI's team for several more years (although [Mint is hiring](http://mint.com/jobs.html)!), so we wouldn't be able to keep up with improvements.

**What's worked well for you so far? In what ways has YUI seemed like a great fit for your specific challenges?**

[The Event Utility](http://developer.yahoo.com/yui/event/) is by far my favorite package. The ability to easily attach events, manipulate scope, and pass objects through to the event callback function was exactly what we needed. YUI was also one of the first frameworks to offer a [CustomEvent object](http://developer.yahoo.com/yui/event/#customevent), which is one of my favorite parts of YUI. [The `onDomReady()` function](http://developer.yahoo.com/yui/event/#ondomready) was also very valuable for improved performance, at least until I moved the JavaScript out of the header.

**We always ask, and genuinely want to know: Where has YUI not worked well for you? If you were going to pick a few things that would make YUI a more effective toolkit for Mint, what would those things be?**

It would be nice if there were DOJO/MooTools-like tool, where I could choose which browser matrix I wanted to support (like all [A-Grade browsers](http://developer.yahoo.com/yui/articles/gbs/)) and/or which methods I want \[to reduce overall file size\].