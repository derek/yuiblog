---
layout: layouts/post.njk
title: "Peeling Back the Interface of the Yahoo! Home Page Beta"
author: "Nate Koechley"
date: 2006-05-15
slug: "peeling-back-the-homepage-beta"
permalink: /2006/05/15/peeling-back-the-homepage-beta/
categories:
  - "Development"
---
To celebrate the launch of the public [beta of the new Yahoo! home page](http://www.yahoo.com/preview), I want to peel back the interface and point out a few things of interest to developers.

First of all, I'm very proud that the new Yahoo! home page uses the open-source [Yahoo! User Interface Library](http://developer.yahoo.com/yui/) extensively. To be clear, the exact lines of code available to the world for free are used by Yahoo!'s new flagship page. The Library's _a la carte_ design lets them use just the components they need: [Connection](http://developer.yahoo.com/yui/connection/), [DOM](http://developer.yahoo.com/yui/dom/), [Animation](http://developer.yahoo.com/yui/animation/), and [Event](http://developer.yahoo.com/yui/event/), as well as [CSS Fonts](http://developer.yahoo.com/yui/fonts/) and [CSS Reset](http://developer.yahoo.com/yui/reset/). This illustrates several things, including the industrial-grade functionality of the YUI Library, the validity of an _a la carte_ approach, and our commitment to continued development and support of this library.

Now, notice how the page is optimized with "download-on-demand." If a JavaScript, CSS, HTML or JSON file isn't absolutely and immediately necessary, it is not loaded until after the onLoad event fires. Many of the features that Bill Scott discusses in his [design patterns coverage of this launch](/yuiblog/blog/2006/05/15/patterns-behind-homepage/), such as In Context Configuration and Dynamic Local Content, aren't used by each user on each visit. By downloading the code for these pieces of functionality either automatically post-load or strictly on-demand, unnecessary overhead is reduced and the page is much faster.

Download-on-demand takes at least two forms. Script nodes are used to get JavaScript Libraries after page load. The JS for the Traffic and Local sections are an example of this technique. In other cases, for example the Personal Assistant module's inbox preview, HTML is retrieved directly via YUI's Connection utility (which wraps the XMLHttpRequest object).

[JSON](http://en.wikipedia.org/wiki/JSON), (the light-weight data interchange format well suited to Ajax applications and championed by our own Douglas Crockford), is used extensively on the new home page. JSON has many advantages, as Douglas most-recently spoke about at [The Ajax Experience](http://www.theajaxexperience.com/show_view.jsp?showId=58) conference last week. Of the [many advantages of JSON](http://www.json.org/xml.html), three were quoted repeatedly in my talks with the home page team. First, it's a native JS data structure so no extensive parsing is required (like there is when using XML). Second, there is less data to transport compared to XML. And finally, since it is so readable, development and debugging are more pleasant and efficient.

On the CSS side, notice the extensive use of [CSS Sprites](http://www.alistapart.com/articles/sprites/). Though not new, this technique is one of the best ways to optimize a site. By using sprites instead of individual images, 15 separate home page image calls are combined into a [single HTTP request](http://us.i1.yimg.com/us.yimg.com/i/ww/t5/grd-1px.gif). Every HTTP request has a significant negative effect on performance -- therefore reducing requests should always be a priority.

As you can imagine, the home page team has been hard at work. The hard work continues as they continue improving the beta, rolling out enhancements, and expanding to more countries. If you have technical questions, please feel free to leave a comment and I'll do my best to get answers from the team for a followup in-depth article here.

Thanks,  
Nate