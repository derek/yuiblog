---
layout: layouts/post.njk
title: "Implementation Focus: Nestoria"
author: "Unknown"
date: 2007-11-06
slug: "nestoria"
permalink: /blog/2007/11/06/nestoria/
categories:
  - "YUI Implementations"
---
**Tell us a little bit about Nestoria's product — what problems are you solving for your users?**

We're a search engine for property in Spain and the UK ([http://www.nestoria.es](http://www.nestoria.es), [http://www.nestoria.co.uk](http://www.nestoria.co.uk)).

We focus on one thing and one thing only — helping people find property to buy or rent as quickly and easily as possible.

That has a couple of pieces: data quality, freshness, speed, and of course the usability. That's where YUI comes in — helping us build the interface that allows users to intuitively understand our site and find the content they are interested in.

We work hard to make things very simple for the users. It may sound counterintuitive, but creating simplicity can be exceedingly complex technically — you can imagine ranking algorithms, geocoding, etc.

The Nestoria site itself is a mashup of properties with maps and overlays of all kinds of relevant content like schools, tube lines, pubs, photos. We also make data available via an API, geoRSS, KML, all kinds of widgets and a Facebook app, so we're pretty busy.

Here are some examples:

-   [Flats for rent in Edinburgh](http://www.nestoria.co.uk/edinburgh/flat/rent)
-   [Houses for sale in Sevilla](http://www.nestoria.es/sevilla/casa/comprar)

We're a small start up of internet veterans. The company has been around since 2006, and the site is made with LAMP where the P is perl.

**You transitioned the product recently to YUI. What factors led you to choose YUI for Nestoria?**

As a small company (9 people — that's total, not just developers), it's very difficult for us to test on all OS/browser combinations, so we love the fact that [YUI comes with A grade browser compatibility](http://developer.yahoo.com/yui/articles/gbs/). In the past we spent days debugging keystroke event handling.

Other major factors were the well organized documentation and examples, the continual innovation, and [the great community that supports YUI](http://tech.groups.yahoo.com/group/ydn-javascript/).

The icing on the cake was that [we don't need to serve the libraries ourselves](http://developer.yahoo.com/yui/articles/hosting/). This is good for two reasons: lower bandwidth costs for us, but also our pages are faster because users are more likely to have the libraries cached to begin with.

Finally, we appreciate the effort that goes into consistent namespacing — we're running other bits of javascript like [mapstraction](http://www.mapstraction.com) and Google maps on the page as well.

**What parts of the library are you using today?**

Right now we use four pieces:

_a. the [autocomplete](http://developer.yahoo.com/yui/autocomplete/) for our search boxes — which is truly amazing in how customizable it is:_

![AutoComplete in action on the Nestoria website.](/yuiblog/blog-archive/assets/nestoria/ac.gif)

b. the [sliders](http://developer.yahoo.com/yui/slider/) that allow users to set their search filters

![Nestoria's interface allows you to use sliders to select a price range and features like the numbers of bedrooms and bathrooms.](/yuiblog/blog-archive/assets/nestoria/sliders.gif)

_c. we're testing the use of [animations](http://developer.yahoo.com/yui/animation/) to hide more advanced features from users until they really need them_

_d. some of the [CSS libraries](/yuiblog/blog/2007/10/29/video-koechley/) for styling_

**How is YUI performing for you so far?**

Beyond all expectations. The libraries do what they claim (which I can't say for other libraries we looked at), so that part has been great. What's been amazing though has been the support of the community. Questions to the support list get answered quickly, by absolute experts.

**What's missing? What's been hard about using YUI so far?**

I'd like to see [the examples](http://developer.yahoo.com/yui/examples/) expanded — I think that would reduce the volume of basic questions on the support list.

One challenge I see for the YUI team going forward is the need to simultaneously serve both advanced power developers and also first time javascript users. Not easy. The sheer volume of questions and feature requests is rising.

I think the only sustainable solution is to give the community the tools to support itself. As an example, there are times we'd love to save time and just pay a YUI expert to spend an hour or two building a prototype showing us how to implement something. Perhaps Yahoo! could facilitate these sorts of things?

Another simple solution might be to divide into a newbies and advanced list.

In terms of technical specifics — I would love a dual slider — though we were able to find and extend [a user created version](http://tech.groups.yahoo.com/group/ydn-javascript/message/17714).

Also, a tool to tell us which libraries we need - we want to load only the absolute minimum and not reference 10 javascript urls. [Mootools](http://mootools.net/download) does a good job in this respect.

**In terms of rich-client work, what's next for your product? What are the hardest problems you're trying to solve on the UI side in upcoming versions?**

We recently launched access to 'meta' data — things like average house prices. We're looking for some interesting ways to visualize this information.

Nevertheless, the focus for us is always simplicity and speed, so it's unlikely we'll be adding much heavy rich-client type stuff to our site. We focus on presenting highly relevant data as quickly and in as user friendly a manner as possible.

That being said, [we do offer all of our data via our API](http://www.nestoria.co.uk/help/api-tech). We'd love to see folks get their design freak on and do some crazy data visualisation stuff (\*hint\*, \*hint\*).