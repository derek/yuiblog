---
layout: layouts/post.njk
title: "Implementation Focus: Wikia"
author: "Eric Miraglia"
date: 2007-06-18
slug: "wikia"
permalink: /2007/06/18/wikia/
categories:
  - "YUI Implementations"
---
**Tell us a little bit about Wikia. What point are you at in the evolution of your product and your company? What is its relationship to Wikipedia?**

We like to say that Wikia and Wikipedia have the same parents, but that otherwise we're not related. We share with Wikipedia a lot of the same fundamental ways we treat communities and we share with them an overarching respect for the kinds of content generation done by communities. We run on the same software as Wikipedia, MediaWiki, but there's no business relationship.

At Wikia, our core strengths are community building and helping passionate people find others like them with whom they can collaborate. We have 3,000 communities today. One of the more popular ones is [Wookieepedia](http://starwars.wikia.com/wiki/Main_Page), a community passionate about all things Star Wars. We have [a popular Star Trek community called Memory Alpha](http://memory-alpha.org/en/wiki/Main_Page) and [a wonderful community based around the Muppets](http://muppet.wikia.com/wiki/Main_Page). The [Marvel Database](http://marveldatabase.com) site is a great one, and the [Uncyclopedia](http://uncyclopedia.org), which is an unholy parody of Wikipedia, is enough to stop all productivity in the office for at least 30 minutes daily. We have communities based on Sci-Fi, technology, health, travel, and much more...it's a broad cross-section. Our communities build out huge amounts of content and we try to help them get great exposure for their content, too.

[![](/yuiblog/blog-archive/assets/wikia.gif)](http://wikia.com/)

**You have adopted YUI as your frontend framework for the interface you're building on top of MediaWiki. Tell us about that decision.**

Our decision set consisted of five key points:

1.  speed of development
2.  quality of the codebase
3.  documentation and examples
4.  robustness/future-proofing
5.  browser support

All of the toolkits we considered (YUI, Dojo, JQuery, Prototype) cover this decision set to some degree, and all of them allow you to generate impressive UIs with just a few lines of code. But our vision for the future required a platform that would enable us to build the robust features and widgets that we want to create ourselves. So we need a framework that we would feel comfortable building on. YUI is versatile, because there's so much you can do on top of it. But it's also more than that, because it has a catalogue of bundled widgets also...it gives you the best of both worlds. All of that, combined with the documentation and example code, was important for us given our distributed development team. Our assessment was that there were other libraries that could jump-start our development more quickly, but we felt they would leave us less free over time.

Here's one specific example of why we chose YUI: A lot of our designs so far have a three-column layout. We started with a test of different libraries dragging items across the three columns. All of the libraries we tested had at least some problem doing that with the exception of YUI. That kind of proved to us that there were things we wouldn't have to worry about with YUI that might be a concern if we made another choice.

We also talked to a lot of other companies around the valley about YUI, including [SmugMug](/yuiblog/blog/2007/01/12/smugmug/), and most of them had the same response: You're going to need to write some code to get exactly what you want done, but YUI is a great platform to write code with. For our needs, YUI felt like the right long-term choice.

**Every adoption of a new technology comes with some pain. What have the pain points been in adopting and using YUI so far?**

I'm not sure we're deep enough into it to feel the pain so far. What I've heard from the developers is that there's a lot to learn to make full use of the library. Whereas with Ruby on Rails you have this great integration with Prototype and Scriptaculous, and you can get some wonderful interactions built very quickly, YUI has involved a little more mastery on the front end of the process for us. I'm sure there will be more pain points as we go, but that's where we're at today.

**What does your UI look like a year from now? What challenges are you trying to overcome?**

Making things more simple and intuitive. If you've edited Wikipedia, you know what I'm talking about: "Thar be dragons..." We'd like to make it a more intuitive process for the user, and a more fun experience. People are in online communities because they're passionate about something. We want to make the expression of that passion fun rather than demanding. We also want to provide more visibility into the presence of other users, more core stuff around making the editing experience friendly, more information back to the users about what they're doing and what people are doing with the content they generate. Plus, I think there's a lot we can do in terms of letting our users mashup or combine different sources of information.

For us, it's all about tapping peoples' passions and not getting in their way.

**You're growing quickly in terms of traffic. Does that mean you're ramping up in terms of staff as well?**

Absolutely. We've grown from about 8 employees around the world a year ago to more than 30 today. Now that we've decided on YUI, we're seeking out great frontend engineers who are familiar with YUI and want to work with Jimmy and Angela as they change the world again with Wikia, just as they did with Wikipedia.

_**Do you have a YUI implementation that would be of interest to the YUI community?** If so, please [share your link](http://groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/) and post a message to the community forum at [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/), or leave us a message in the comments section below._