---
layout: layouts/post.njk
title: "Velocity 2013 - Building a Faster and Stronger Web"
author: "Derek Gathright"
date: 2013-07-16
slug: "velocity-2013-building-a-faster-and-stronger-web"
permalink: /2013/07/16/velocity-2013-building-a-faster-and-stronger-web/
categories:
  - "Miscellany"
---
.entry .imgwrap-right { width:350px; float:right; text-align:center; margin:1em 0 0 1em; } .entry .imgwrap-left { width:350px; float:left; text-align:center; margin:1em 1em 0 0; } .entry .slide { text-align:center; } /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

![Velocity 2013](http://farm8.staticflickr.com/7411/9083212144_c916b6f5e1.jpg)  
([photo credit](http://www.flickr.com/photos/oreillyconf/9083212144/sizes/m/))

If there's one thing we've learned in 20+ years of building Web sites, it's that performance matters. Browsers need to fetch, parse, and render pages quicker. JavaScript needs to execute faster, HTTP servers need to generate and serve content more efficiently, and caching layers need to be more pervasive. All in effort to make the browsing experience more enjoyable for the user so they browse, click, engage, and buy more. The effect performance has on the bottom-line has been [very](http://www.stevesouders.com/blog/2010/05/07/wpo-web-performance-optimization/) [well](http://www.codinghorror.com/blog/2011/06/performance-is-a-feature.html) [documented](http://www.fastcompany.com/1825005/how-one-second-could-cost-amazon-16-billion-sales) over the years, and the interest in "fast" is doing anything but slowing down.

So every year, the industry's experts on speed gather at the Santa Clara Convention Center for [Velocity](http://velocityconf.com/), a conference all about Web performance and operations. Myself, along with other members of the [YUI](http://yuilibrary.com/) and [Mojito](http://developer.yahoo.com/cocktails/mojito/) teams were fortunate to be on hand again this year to discuss our experiences and learn from others. It was an insightful and inspirational 3 days, and in this post I'll recap and share some of what we learned with you.

* * *

## Day 0

![Steve Souders](http://i.imgur.com/mgNjVBZl.jpg)  
(Steve Souders | ["The Illusion of Speed"](http://www.youtube.com/watch?v=bGYgFYG2Ccw))

The first day of Velocity-related events consisted of workshops and short [Ignite](http://igniteshow.com/) talks, some of which you can find on O'Reilly's [Ignite Velocity YouTube playlist](http://www.youtube.com/playlist?list=PL055Epbe6d5b1ymaQ6cgUW5q6cmoX-eMM).

One particular talk to highlight is [Steve Souders](https://twitter.com/souders)' **"The Illusion of Speed"**, which was especially eye-opening on the importance of speed, or rather the importance of **perceived** speed. _"As much as I love data and metrics, that's the tail wagging the dog. The real thing we're after is to create an experience that people love and they feel is fast. We might be front-end engineers, we might be devs, we might be ops, but what we really are, is perception brokers."_ In other words, the winner is the experience that makes users the happiest, not necessarily the fastest. Often those are correlated, but not always. Checkout out the [video of his talk](http://www.youtube.com/watch?v=bGYgFYG2Ccw) to learn why.

* * *

## Day 1

### Johan Bergström - Lund University

![Johan Bergström](http://farm6.staticflickr.com/5492/9089461244_e203a8826d.jpg)  
(Johan Bergström | [photo credit](http://www.flickr.com/photos/oreillyconf/9089461244/sizes/m/in/photostream/))

Velocity Conference 2013 kicked off with [Johan Bergström](https://twitter.com/bergstrom_johan)'s [presentation](http://prezi.com/m4y8-5e5lvio/what-where-and-when-is-risk-in-system-design/) about risk management. Bergström is an Associate Professor at Lund University, and while he isn't an expert on anything Web-related, he is an expert in the field of [safety science](http://www.journals.elsevier.com/safety-science/). He was brought to Velocity to enhance and enlighten our understanding of risk factors in linear and relational systems and provide us with tips to minimize incidents that can lead to errors and downtime in our Web applications.

The main takeaway I got from his 25-minute keynote (which is [available on YouTube](http://www.youtube.com/watch?v=Pb_zYs8G6Co)) was that **safety is just an illusion and no systems are actually safe, they are just made less unreliable**. Since risk is never truly gone, you should never ignore its presence and continually discuss it amongst your team.

I believe that final point is an important one. Often times we don't acknowledge risk until something actually fails, and much more can be done to minimize the damages if more proactive steps are taken to account for inevitable failures. Proactive vs reactive.

### Kyle Rush - Obama for America

![Kyle Rush](http://farm4.staticflickr.com/3688/9087245477_1bf0a2f890.jpg)  
(Kyle Rush | [photo credit](http://www.flickr.com/photos/oreillyconf/9087245477/sizes/m/))

The opening day keynotes continued with other presentations by industry experts, including [Kyle Rush](https://twitter.com/kylerush)'s excellent talk **"Meet the Obama Campaign's $250 Million Fundraising Platform"**. Rush's keynote was based off a [blog post](http://kylerush.net/blog/meet-the-obama-campaigns-250-million-fundraising-platform/) he wrote last year. It recapped the donation platform his team built during 2011 and 2012 when he served as Director of Front-end Development at Obama for America.

When Rush joined the campaign he inherited a slow, error-prone Web application. He rebuilt it using a variety of techniques and tools focused on front-end performance, such as serving static sites (built with [Jekyll](http://jekyllrb.com/)), [optimize.ly](https://www.optimizely.com/), [WebPageTest](http://www.webpagetest.org/), and utilizing JavaScript to off-load as much as possible to the browser. The result was a 60% faster TTP metric (time to paint), a 49% increase in donation conversion rate, and a platform that was processing up to $3 million dollars an hour.

You can find a video of Rush's talk [here](http://www.youtube.com/watch?v=FaygFGhex_4). It's a worthwhile viewing that can give you some insight into what a high-scale, high-performance front-end web application can look like. Also, the [Hacker News discussion](https://news.ycombinator.com/item?id=4842510) response to his blog post offers some insightful follow-up conversation.

### Arvind Jain - Google

Day 1 keynotes concluded with Google's [Arvind Jain](http://www.linkedin.com/pub/arvind-jain/1/516/593), whose talk ([video](http://www.youtube.com/watch?v=TGuMha46Nh0)) was an analysis to answer the question of **"Is the Web Getting Faster?"**. Using data gathered from Akamai, industry studies, browser benchmarks, and the [HTTP Archive](http://httparchive.org), Jain concluded that no, the Web is not getting faster. While the core infrastructure (networks, browsers, protocols, etc.) are getting faster, the Web is primarily getting richer to take advantage of the extra performance capabilities, which results in a nearly equal slowdown.

![takeaways](http://i.imgur.com/5nDJSBj.png)

### Andrew Betts - Financial Times Labs

After a few lightning demos consisting of new products from Akamai, AT&T, and Appurify, the first day's sessions kicked off. The first one I attended was a talk by [Andrew Betts](https://twitter.com/triblondon), a software engineer at [Financial Times Labs](http://labs.ft.com/) who spoke on the topic of making Web applications as performant as native apps. In his talk **"Escaping the Uncanny Valley"**, Betts focused on the challenges his team faced when building the [Financial Times HTML5 Web app](http://labs.ft.com/2011/06/ft-launches-first-major-html5-mobile-news-app/) and how to properly avoid the "[uncanny valley](http://en.wikipedia.org/wiki/Uncanny_valley)" (the point where a Web app tries to be too similar to a native app, but falls short and appears as a clunky, cheap imitation).

![Andrew Betts](http://farm4.staticflickr.com/3794/9087251919_9559c9aba8.jpg)  
(Andrew Betts | [photo credit](http://www.flickr.com/photos/oreillyconf/9087251919/sizes/m/))

Some of Betts' key points:

-   Ensure smooth scrolling with sub-16ms frame rates
-   Ensure any UI pauses are sub-100ms
-   Intelligently use CSS selectors
-   Don't use flexbox!
-   Disable hover effects
-   Intelligent use of local storage technologies
-   Cache, cache, cache
-   Text re-encoding (see: [FT Labs blog post](http://labs.ft.com/2012/06/text-re-encoding-for-optimising-storage-capacity-in-the-browser/))
-   XHR batching
-   [Fast Click](http://labs.ft.com/articles/ft-fastclick/)
-   Always provide UI response feedback

I recommend a review of [the slides](https://speakerdeck.com/triblondon/escaping-the-uncanny-valley-velocity-2013) for anyone working on mobile Web applications. In them, you'll find quite a few priceless nuggets of information in there to help save time investigating performance issues, in addition to tips on preventing any bottlenecks.

![data storage technologies](http://i.imgur.com/SHupm8e.png)  
(An overview of storage options)

### Stephen Woods - Yahoo

![Stephen Woods](http://farm4.staticflickr.com/3673/9080889933_3f2b183505.jpg)  
(Stephen Woods | [photo credit](http://www.flickr.com/photos/bluesmoon/9080889933/sizes/m/))

Following Betts' talk was another mobile-centric presentation from Yahoo's [Stephen Woods](https://twitter.com/ysaw). In Woods' talk ([slides](https://speakerdeck.com/ysaw/optimizing-javascript-runtime-performance-for-touch-velocity-2013)), he echoed some of the same lessons learned while building new Flickr products that Betts did with the Financial Times app, including ensuring that you achieve the magical <16ms frame rate (which equates to 60FPS), and tips for intelligent caching (e.g., _"cache values, not DOM nodes"_).

Main takeaways included:

-   Cache data where possible
-   Update the UI on user actions, use transforms where possible
-   Multitask when you can, with threads and yielding

### Colt McAnlis - Google

![Stephen Woods](http://i.imgur.com/v9ZW9OI.jpg)  
(Colt McAnlis | [photo credit](http://seorushnow.com/report-from-velocity-day-2/))

A little later in the day was an insightful talk from Google's [Colt McAnlis](https://twitter.com/duhroach) in which he described the inner-workings of Chrome's rendering engine, harnessing the power of 3D acceleration, and the tools available in Chrome that can help you create more efficient applications.

The takeaway from this talk was to understand how the rendering process occurs and to design pages with the GPU in mind. As Betts also alluded to in his talk, if you misuse advanced techniques, you can end up in worse shape than where you started. Understand, analyze, then enhance.

Here's a [pdf of his slides](http://cdn.oreillystatic.com/en/assets/1/event/94/The%20CSS%20and%20GPU%20Cheatsheet%20Presentation.pdf).

## Day 2

* * *

### Dylan Richard - Obama for America

![Dylan Richards](http://i.imgur.com/RL1SJh4.png)  
(Dylan Richards | [photo credit](http://www.youtube.com/watch?v=LCZT_Q3z520))

Day 2 of Velocity kicked off with an insightful keynote from [Dylan Richard](https://twitter.com/dylanr), who recently spent 18 months as Director of Engineering at Obama for America. In his devops-centric talk, Richard shared some of his experiences and insights during the time when he was tasked with rebuilding the organization's technology infrastructure, as well as sharing tips for building resilient systems and teams.

Richard reminded us that uptime for critical systems is the primary objective, because _"No feature is cool enough to not have a working app."_ He is also a strong believer that _"You can't learn unless you are simulating real things"_, which of course lead into some discussion of [destructive testing](http://en.wikipedia.org/wiki/Destructive_testing).

While this talk certainly was more on the operations side of the Velocity spectrum, there are still valuable insights for software engineers of any kind and is worth a viewing. You can find a video of his talk [here](http://www.youtube.com/watch?v=LCZT_Q3z520).

### Ilya Grigorik - Google

![Ilya Grigorik](http://farm4.staticflickr.com/3674/9087250187_3ea3ec18ac.jpg)  
(Ilya Grigorik | [photo credit](http://www.flickr.com/photos/oreillyconf/9087250187/sizes/m/))

During the Lightning Demos portion of Day 2, Google's [Ilya Grigorik](https://twitter.com/igrigorik) introduced some new tools to help you find answers to Web performance-related questions. Grigorik began his talk ([video](http://www.youtube.com/watch?v=bhUMHKJf3r4)) with Indira Gandhi's famous quote _"The power to question is the basis of all human progress"_ to emphasize the role curiosity plays in our success as engineers. Grigorik then proceeded to list off various questions many Web developers have such as _"Are websites getting faster?"_, _"What CSS frameworks are the most popular?"_, _"Is Flash adoption on the decline?"_, and more.

It turns out, these previously difficult questions to answer are now relatively easy thanks to the availability of the [HTTP Archive](httparchive.org/) data in Google's [Big Query](http://bigquery.cloud.google.com/). If you are familiar with SQL, you can now throw together some simple queries and analyze gigabytes of HTTP data scooped up from a crawl of a million websites. Grigorik goes into more details in his [blog post](http://www.igvita.com/2013/06/20/http-archive-bigquery-web-performance-answers/).

So naturally, I became curious on the version breakdown of YUI usage and realized the HTTP Archive can help answer that question for me. After some data crunching I was able to generate this chart:

![](http://i.imgur.com/RH214ck.png)

### Ariya Hidayat - Sencha

![Ariya Hidayat](http://farm3.staticflickr.com/2828/9089643751_8193588ae3.jpg)  
(Ariya Hidayat | [photo credit](http://www.flickr.com/photos/bluesmoon/9089643751/sizes/m/))  

* * *

![The unix philosophy](http://i.imgur.com/UB9hz71l.png)  
("The Unix Philosophy")

One of the more educational talks of Velocity 2013 was [Ariya Hidayat](https://twitter.com/ariyahidayat)'s **"Emerging JavaScript Tools to Track JavaScript Quality and Performance"**. In this talk ([slides](https://speakerdeck.com/ariya/emerging-language-tools-to-track-javascript-quality-and-performance)), Hidayat began with describing composable tools, _"Write something once that does its job very well"_, and then presents his favorite JavaScript tools while referencing some topics and tips covered from many of his [blog posts](http://ariya.ofilabs.com/highlights).

Some of the JavaScript-related tools mentioned:

-   [Phantom.js](http://phantomjs.org/) - A headless WebKit scriptable with a JavaScript API
-   [Esprima](http://esprima.org/) - A high performance, standard-compliant ECMAScript parser
-   [MetaJS](http://int3.github.io/metajs) - A CPS Javascript metacircular interpreter that visualizes script execution
-   [JSComplexity](http://jscomplexity.org/) - A [complexity analysis](http://jscomplexity.org/complexity) for JavaScript projects
-   [Plato](http://ariya.ofilabs.com/2013/01/javascript-code-complexity-visualization.html) - A code complexity visualization tool
-   [Defs.js](https://github.com/olov/defs/) - An ES6 `const` and `let` transpiler to ES3.
-   [Istanbul](http://gotwarlost.github.io/istanbul/) - A code coverage tool for JavaScript

Hidayat closed with the following bits of advice:

-   _"Build **composable** tools"_
-   _"**Automate** any tedious parts of code review"_
-   _"Incorporate **code quality metrics** into dashboards"_

### Nicholas Zakas - Box

![Nicholas Zakas](http://farm8.staticflickr.com/7342/9097359847_800788f5b8.jpg)  
(Nicholas Zakas | [photo credit](http://www.flickr.com/photos/bluesmoon/9097359847/))

Velocity's Web Performance track concluded with a talk ([slides](http://www.slideshare.net/nzakas/enough-withthejavascriptalready)) from [Nicholas Zakas](https://twitter.com/slicknet) on the over-reliance of JavaScript. In **"Enough with the JavaScript already"**, his point was that as JavaScript developers, we have the tendency to try to do too many things in JavaScript. As an example of this, Zakas cited the plethora of client-MVW frameworks (Model-View-_Whatever_) and client-side rendering as JavaScript-gone-too-far. This is something [Twitter](https://blog.twitter.com/2012/improving-performance-twittercom) and [airbnb](http://nerds.airbnb.com/weve-launched-our-first-nodejs-app-to-product/) have realized, which should serve as a reminder to take a step back and rethink things before you try to outsmart a web browser.

As an example of proper and intelligent use of JavaScript, Zakas pointed to Alex Sexton's wonderful [Deploying JavaScript Applications](http://alexsexton.com/blog/2013/03/deploying-javascript-applications/) blog post which mentions the idea of listening for mouse movements to trigger loading JS. Consider the fact that you have two types of scripts you typically run on a page, 1) Render/Functionality-critical scripts, and 2) Supplementary functionality scripts. If a script isn't required for primary functionality of your page, you should defer loading it.

Speaking of when and where to execute your JavaScript, here's his categorization of the four suggested locations to place your Javascript:

![The 4 JavaScript Load Times](http://i.imgur.com/1DjxL6Rl.jpg)

Zakas' talk concluded with some observations about building and using libraries, arguing that it's an [economy of scale](http://en.wikipedia.org/wiki/Economies_of_scale) rule, meaning the cost per component decreases the more components you use. So for example, if you are using YUI for only [node](https://yuilibrary.com/yui/docs/node/), that's really expensive, and maybe not the best investment. But, if you begin using other YUI components as well, the more you use, the cheaper your investment becomes.

The takeaway here is that bytes are costly in bandwidth, performance, and maintenance, so scrutinize your decisions when selecting libraries to use. Don't just blindly invent or throw a new library at the problem.

You can find some insightful discussion on these slides over on [Hacker News](https://news.ycombinator.com/item?id=6044356).

* * *

## Overall Takeaways

Here are some common themes observed at Velocity 2013:

-   Tracking browser metrics in [CI](https://en.wikipedia.org/wiki/Continuous_integration) is becoming popular, both due to availability of [Navigation Timing APIs](https://developer.mozilla.org/en-US/docs/Navigation_timing) and greater awareness of [paint timings](http://addyosmani.com/blog/devtools-visually-re-engineering-css-for-faster-paint-times/). As Paul Hammond said in [his Ignite Velocity talk](http://www.youtube.com/watch?v=_hE_MtasB2Q), _"If it moves, track it."_
-   Your software will make mistakes, but it's difficult to predict what and where. So, focus on making resilient systems that help you detect problems faster to mitigate the damage.
-   The point of improving performance is to improve the experience of the end user. They actually don't care that things are metrically faster, they just like the feeling they get from their perception that things are faster.
-   Alex Sexton's excellent "[Deploying JavaScript Applications](http://alexsexton.com/blog/2013/03/deploying-javascript-applications/)" blog post, and his follow-up "[Front-End Ops](http://www.smashingmagazine.com/2013/06/11/front-end-ops/)" seemed to be commonly cited among Velocity talks.
-   And finally, when you think you are done with performance, you probably aren't.

As a two-time attendee of Velocity, I'm comfortable saying that it continues to be one of the most educational and inspiring events out there today. Tim O'Reilly stated in [his 2011 keynote](http://www.youtube.com/watch?v=9Kn-RrAg9FI), _"You might think you are just helping to run some random site, but you are engaged in an exploration that is central to the future of humanity"_, and after learning about all the interesting problems being tackled by Velocitians, I completely agree. So, cheers to the Velocity organizers, presenters, and community, for building a better, faster, stronger Web!

P.S. You can find all my session notes [here](https://gist.github.com/derek/5835728). Also, if you are an O'Reilly Safari subscriber, keep an eye out for videos of the 2013 talks. In the meantime, you can view previous years [2011](http://techbus.safaribooksonline.com/video/-/9781449311773) and [2012](http://techbus.safaribooksonline.com/video/-/9781449343927), as well as finding select videos from 2013 [on YouTube](http://www.youtube.com/playlist?list=PL055Epbe6d5bdB4KPqssegVpYUDJXSzOp).

* * *