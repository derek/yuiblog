---
layout: layouts/post.njk
title: "Implementation Focus: DocLanding"
author: "Unknown"
date: 2009-03-30
slug: "doclanding"
permalink: /blog/2009/03/30/doclanding/
categories:
  - "YUI Implementations"
---
![DocLanding: Online, on-demand document management](/yuiblog/blog-archive/assets/doclanding-20090330-111939.jpg)

**Tell us a little bit about DocLanding — what are the central problems you solve for your users?**

DocLanding is an on-demand document management solution that delivers enterprise class document management functionality for a fraction of the costs of most enterprise solutions. The software can be delivered through our Software as a Service (SaaS) offering or as an in-house system. Our clients are primarily in the financial services and healthcare arenas.

Common issues we solve for our customers include providing a web-based centralized repository for distributed workforces, on-demand web-based scanning for low paper volume offices, and desktop batch-based scanning in high paper volume offices. Other issues we address include secure document sharing and collaboration, document editing/annotations, version control, document commenting, and document watermarking. Our unique approach to separately controlled but linked document repositories allows users to access disparate repositories with one common login.

**What were the particular user interface challenges presented by your product's design?**

[![DocLanding: Document preview UI.](/yuiblog/blog-archive/assets/doclanding-preview-20090330-105501.jpg)](http://www.doclanding.com/)

We learned from some of our earlier work that you simply cannot underestimate the importance of user-friendly design. Creating a website is fairly easy, but creating a true web application that has to meet the needs of businesspeople is real work. Our product attempts to take document management from strictly the domain of the large enterprise and make it available to any small business. Electronic document management at its core is not a simple task. The goal is to organize and control access to massive numbers of files in addition to making them fully searchable. Because of this, the user interface is actually where the majority of our development time has traditionally been spent.

We've found that you will save time and money on support issues when you make your site straightforward and easy to use. Part of that is relaxing the specifications needed to run the site. We got ours pared down to just about any modern browser with JavaScript and Flash. The core site design we came up with presented its own challenges with its very specific use of the screen real estate. We found our users were better able to make full use of the application when we ourselves paid attention to colors, iconography and proximity of the controls to their function. We think we're on the right track because our feedback page has returned more requests for additional features than for help requests.

**You chose YUI to help power your site. What led you to that decision?**

[![DocLanding: On-demand document management](/yuiblog/blog-archive/assets/doclanding-main-20090330-105228.jpg)](http://www.doclanding.com/)

The simple answer is consistency and speed. We needed a framework that would enable us to meet the design specifications of our product. More specifically, we had ambitious design goals like maintaining a one screen view and minimizing or eliminating full page postbacks. In addition, we wanted our required elements to look and function identically in as many different browsers as we could manage. There are enough consistency issues between browsers and their rendering methodologies to contend with already, so any framework we chose needed to minimize the amount of browser-specific coding we'd have to do. After experimenting with a variety of different toolkits, YUI came out quite clearly on top. There was a bit of a learning curve to all the products, but YUI's had the best payoff.

The base framework does not require a plug-in, it plays well with .NET, and the scripts are light, tight and solid. Once we got the hang of the framework, we found it enlightening to compare our older traditional interface pages to the YUI versions. In every case, adjusting our UI methodology returned huge gains in performance and consistency with lighter downloads to our clients.

[![DocLanding: Mult-file uploads using YUI Uploader.](/yuiblog/blog-archive/assets/doclanding-uploaderUI-20090330-105714.jpg)](http://www.doclanding.com/)

**What YUI components are you using most heavily in your app?**

We're actually using quite a lot of the components. The most beneficial ones have been those that allow us to do as much with and on one screen as possible, so the [TreeView](http://developer.yahoo.com/yui/treeview/), [Menu](http://developer.yahoo.com/yui/menu/), [SimpleDialog](http://developer.yahoo.com/yui/container/simpledialog/) and [Layout Manager](http://developer.yahoo.com/yui/layout/) have been extremely useful. In truth we're using nearly all the controls, but we especially appreciate the [Uploader Control](http://developer.yahoo.com/yui/uploader/)'s ability to handle multiple file selection. We've been looking for a solution to that problem for some time and YUI's has been the most elegant we've encountered so far. We make good use of the [JSON Utility](http://developer.yahoo.com/yui/json/) and [Connection Manager](http://developer.yahoo.com/yui/connection/) to greatly minimize the size and number of requests to the server we make, which keeps our footprint down and more importantly keeps our users working, not waiting.

**What's next for DocLanding? What are the challenges you're working to address in your upcoming releases?**

We're constantly working to improve the feature set of our product. Our users have asked for features to better integrate the editing of their documents with the main application so we'll make time for that. We're also working on better accommodating large file uploads. Otherwise, we have several ideas on the table and we're weighing which ones would be most beneficial for our users. A version of the site optimized for mobile phones and netbooks is in the design stages already, as well as tools to import structured folders from the desktop directly into DocLanding. Experimentally, we're toying with the idea of only storing the metadata at the website and pulling content directly from networked client machines running our software. Ultimately, the needs of our users will dictate in what direction we move next.