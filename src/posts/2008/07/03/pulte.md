---
layout: layouts/post.njk
title: "Implementation Focus: AA | RF's Redesign of the Pulte Homes Website"
author: "Frederic Welterlin"
date: 2008-07-03
slug: "pulte"
permalink: /2008/07/03/pulte/
categories:
  - "YUI Implementations"
---
[![The new Pulte Homes website designed by Avenue A | Razorfish using a variety of YUI components.](/yuiblog/blog-archive/assets/pulte-community.png)](http://pultehomes.com)

**Tell us a little bit about your site redesign for [Pulte Homes](http://pultehomes.com).**

The new Pulte Homes, Inc. web redesign was launched in May 2008 to help consumers find homes using a rich and interactive map-based search tool, learn about available homes using interactive multimedia, organize and save properties of interest using personalized notebooks, and finally connect with Pulte sales agents directly through a dynamic, context-specific contact form.

The project was scoped as an end-to-end design and implementation effort lasting approximately 18 months. We used the following and YUI components as part of the redesign:

-   [Dom Collection](http://developer.yahoo.com/yui/dom/)
-   [Event Utility](http://developer.yahoo.com/yui/event/)
-   [Element Utility](http://developer.yahoo.com/yui/element/)
-   [Animation Utility](http://developer.yahoo.com/yui/animation/)
-   [Carousel Control (by Bill Scott)](http://billwscott.com/carousel/)
-   [Container Family](http://developer.yahoo.com/yui/container/)
-   [TabView Control](http://developer.yahoo.com/yui/tabview/)
-   [Slider Control](http://developer.yahoo.com/yui/slider/)
-   [AutoComplete Control](http://developer.yahoo.com/yui/autocomplete/)
-   [Button Control](http://developer.yahoo.com/yui/button/)
-   [Grids CSS](http://developer.yahoo.com/yui/grids/)
-   [YUI Compressor](http://developer.yahoo.com/yui/compressor/)
-   [Yahoo! Design Patterns Library](http://developer.yahoo.com/ypatterns/)

**You chose YUI for the implementation of the Pulte Homes website. What factors went into that decision? You know and use other libraries on a daily basis (and choose them over YUI for some projects) — why was YUI the right choice in this instance?**

The presentation layer JavaScript library decision was made based on the following factors:

1.  _Time to Market:_ a need to have solid, pre-built functional components that can be quickly customized to match the desired interaction model and "look and feel." The web standards based approach that YUI employs makes it easy to customize components while also addressing common development issues such as browser compatibility, performance and accessibility.
2.  _Robust set of widgets:_ a desire to use a front end framework that fits with the client approved interaction specification (for example, our UX team's use of the [Auto Complete design pattern](http://developer.yahoo.com/ypatterns/pattern.php?pattern=autocomplete) was accommodated using the [YUI AutoComplete](http://developer.yahoo.com/yui/autocomplete/) component). In the deadline-driven agency environment, integrated development practices help to reduce development time and improve continuity.
3.  _Reliability:_ a sense of comfort/security in using products that are already proven on Yahoo! web properties. The [YUI website](http://developer.yahoo.com/yui/), [API](http://developer.yahoo.com/yui/docs/), and supporting community are all excellent resources in providing help, feedback, and examples.

**One aspect of AA|RF implementations of YUI that's striking is the degree to which you customize the look and feel. When you use a component like Container, Slider or TabView, you do a full custom skin. How much effort is it for you to do so? What tips do you have for other designers or developers who are skinning YUI?**

Pulte is a great example of the typical clients that hire AA|RF — they do so not only because of our end-to-end service capabilities, but also because of our reputation for design and UX excellence. Since branding and user experience are so important to many of our clients, we place considerable effort into building high quality interfaces.

For example, we designed a modular front-end architecture that would accommodate not only Pulte.com, but also two sub brands: DelWebb and DiVosta. All three web sites use the same back-end, content management system, and front-end HTML templates and YUI components. We then dynamically change the CSS reference, and therefore the skin, based on domain. This was accomplished using web standards based separation of the presentation layers (HTML, CSS, and JavaScript). Since YUI also follows web standards best practices, it was easy to integrate functional components with three different skins.

[![YUI components in use on the Pulte Homes site as designed by AA | RF.](/yuiblog/blog-archive/assets/pulte-components.png)](http://pultehomes.com)

In the image above, the Auto Complete, Slider, and Button Control modules use the same HTML and JavaScript, but different style sheets.

We recommend designers and developers consider using an integrated approach to web development, especially for large scale implementations involving interdisciplinary teams. For Pulte we used Yahoo! based interaction design patterns, functional components, styling guides and performance tools together to achieve the branding and user experience needs that our clients expect in world class products.

**Pulte Homes is an ASP.Net site. What does a .Net developer need to know about YUI before getting started — any special tips and tricks?**

YUI, like most client side JavaScript frameworks that we use, works well on any platform. The high level technical choices made at the beginning of a project are the factors that most affect developers on a day to day basis, especially in terms of integration pains. As more and more processing occurs on the browser due to demand for such technologies as AJAX and rich internet applications, architects must consider the implications of using end to end frameworks (for their standardized development patterns) versus using customized solutions. We could have used ASP.NET Ajax for most of the components, but we decided that YUI was a better fit for the level of customization and interaction that we wanted. So for this particular project, the most important "trick" was to have an architecture and development process that cleanly incorporates the customized features into the .NET environment.

**In your Pulte implementation, we see a custom `yui.js` rollup that contains your selection of YUI components. You implement this instead of [drawing the individual files off Yahoo! servers](http://developer.yahoo.com/yui/articles/hosting/). Is it ever appropriate to use a third-party hosting service (as Yahoo would be in this case) on your customer's sites?**

Yes, absolutely. From a performance point of view, the advantages of geo-based file serving, caching, HTTP requests, etc, are compelling reasons to serve YUI from a content delivery network. We have actually referenced the [Yahoo! Exceptional Performance](http://developer.yahoo.com/performance) site for best practices on how to improve performance. The new Pulte site, being a "Web 2.0" feature rich experience, requires above average bandwidth requirements. We are planning on implementing a number of new performance enhancing tasks over the next several weeks based on information gathered using such tools as [YSlow](http://developer.yahoo.com/yslow/).

As for the use of third-party hosting services, we have found that some clients (and I am not talking about Pulte specifically here) are simply uncomfortable with having key components like JavaScript libraries served from a third party due to lack of SLAs (service level agreements).

**What are you most proud of in the Pulte Homes project?**

The new home search page is probably the coolest feature- it provides consumers with map-based searching for available homes, coupled with a rich set of filters around the most important criteria that people use to look for homes. This feature is a great mash-up of Microsoft technologies (ASP/.NET), Google technologies (Maps), and Yahoo! technologies (YUI). While the three companies are battling each other for market share, we have found a way to combine some of their best services to help people find homes. I like the symmetry of that…

**What's on the horizon for AA|RF as far as the front-end is concerned? Are there emerging technologies coming into the mainstream that you're looking at for some clients? I'm thinking, of course, about things like AIR, Gears, HTML5, Silverlight, etc.**

Since joining the Microsoft family last year, we have built a number of Silverlight applications to help bring this emerging technology into the limelight. In addition, we feel that mobile web application development is on the cusp of hitting the mainstream in the United States, especially with the advent of Apple's iPhone and its associated SDK. We are working hard to find ways to bring value to our clients via the mobile channel.

We have always put business and user needs ahead of technology — and will continue to do so. All the new technologies that are emerging offer a lot of potential in terms of solving problems more effectively and elegantly under certain contexts. However, the reality is that many of our clients are yet to fully harness the power of the Web 2.0 technologies that have emerged in the last few years. They are looking for us to do that in the near-term before they can look ahead.