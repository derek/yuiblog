---
layout: layouts/post.njk
title: "Implementation Focus: YUI 3 Powering Autofusion's ResearchPro"
author: "Unknown"
date: 2010-06-18
slug: "autofusion"
permalink: /2010/06/18/autofusion/
categories:
  - "Development"
---
_**About the author:**![Josh Lizarraga](/yuiblog/blog-archive/assets/autofusion/josh-lizarraga.jpg)[Josh Lizarraga](http://freshcutsd.com/) is a YUI Contributor and frontend developer located in San Diego, California. He uses YUI to build rich frontend interfaces and Ajax applications for [Autofusion, Inc.](http://www.autofusion.com/), a San Diego firm that offers web solutions to the automotive industry in the United States and Canada. When he's not on the clock, Josh enjoys contributing to the YUI project with test cases and [Gallery](http://yuilibrary.com/gallery/) modules._

![ResearchPro Home Screen](/yuiblog/blog-archive/assets/autofusion/researchpro-1.jpg)

### About the Project

In addition to serving industry professionals, Autofusion provides end-user information resources via our [CarPrices.com](http://www.carprices.com/) sister-site. "ResearchPro" is the name we've bestowed on our brand new car research application, which allows the user to quickly and easily find everything there is to know about a potential new car purchase.

Researching a new car before you buy is typically a daunting yet necessary experience, and the current options available to consumers are not very user-friendly. ResearchPro attempts to remedy these issues with a simple, guided approach to car research. We also take the experience one step further, allowing customers to receive a free quote on their dream car from local dealers.

### Why YUI?

We started using [YUI 2](http://developer.yahoo.com/yui/2/) for all of our frontend development about two years ago, and haven't looked back. YUI's focus on application development makes it a no-brainer for Autofusion, as we provide many embeddable web apps and widgets to our customers.

Over the years we have used just about every YUI 2 component there is in both our client web properties and our internal tools. YUI's proven track record and incredible documentation really set it apart from the other libraries we've worked with. The refinements to the library offered by [YUI 3](http://developer.yahoo.com/yui/3/) made it an easy choice for this project.

### How YUI is Utilized in the Project

ResearchPro makes use of several YUI 3 components, namely [IO](http://developer.yahoo.com/yui/3/io/), [JSON](http://developer.yahoo.com/yui/3/json/), [Node](http://developer.yahoo.com/yui/3/node/), [Event](http://developer.yahoo.com/yui/3/event/), [Animation](http://developer.yahoo.com/yui/3/anim/), and even the beta [Slider](http://developer.yahoo.com/yui/3/slider/) widget. We're also using the **selector-css3** and **event-mouseenter** modules, as well as a custom module that handles the JSON communication with the backend.

![ResearchPro YUI 3 Slider Usage](/yuiblog/blog-archive/assets/autofusion/researchpro-2.jpg)

### Challenges and Benefits of Using YUI 3

Migrating from YUI 2 to YUI 3 was both the largest challenge and the largest benefit during ResearchPro's development. Working with Node instances instead of DOM nodes directly can take some adjusting to at first, but we quickly found that this excellent abstraction greatly reduces the amount and complexity of the code for a given task. Likewise, the chainability of YUI 3 methods offers some great syntactic sugar that is hard to live without.

The primary challenge of the YUI 3 migration was and continues to be beta bugs. The first YUI 3 beta was released a few months before we started development, and we took that opportunity to start this project with the new codeline. We wanted to be familiar with YUI 3 once it replaces YUI 2 in our workflow down the road. During development, we discovered and reported several bugs, some of which are still being worked out today.

### What's Next for Autofusion?

We are always developing new products with YUI and revising our existing offerings to incorporate YUI on the frontend. Our online inventory solution is powered by YUI 2, and we're currently planning a refined version of the product that will use YUI 3 in its place.

Our inventory interface makes heavy use of the Container module family, so hopefully by the time we start development YUI 3 will have implementations of Panel and Dialog. We've been very pleased with the rapid growth of features, and expect YUI to be our frontend toolkit of choice for years to come.