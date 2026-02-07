---
layout: layouts/post.njk
title: "Performance Research, Part 6: Less is More — Serving Files Faster by Combining Them"
author: "Tenni Theurer"
date: 2008-07-21
slug: "performance-research-part-6"
permalink: /2008/07/21/performance-research-part-6/
categories:
  - "Performance"
---
In [Performance Research Part 1](/yuiblog/2006/11/28/performance-research-part-1/), we discussed how reducing the number of HTTP requests has the biggest impact on improving the response time and is often the easiest performance improvement to make. One technique without having to simplify the page design is to combine multiple scripts into a single script, and similarly combine multiple stylesheets into a single stylesheet.

> Combining multiple files reduces the extra bytes from HTTP headers as well as potential transfer latency caused by TCP slow starts, packet losses, etc.

Figure 1 shows a graphical view of how time is spent loading a page with six separate scripts. Notice that for every file, the browser makes a separate HTTP request to retrieve the file. The gaps between the scripts indicate the time the browser takes to parse and render each script. Figure 2 shows the how time is spent loading a page with the same six scripts combined into a single script.

#### **Figure 1.** Loading a page with six separate scripts

![Figure 1. Loading a page with six separate scripts](/yuiblog/blog-archive/assets/six-separate-scripts.gif)

#### **Figure 2.** Loading a page with one combined script

![Figure 1. Loading a page with one combined script](/yuiblog/blog-archive/assets/one-single-script.gif)

Combining JavaScript and CSS files as part of the development process can be burdensome. It usually makes sense during development to organize the code into logical modules as separate files. Typically, combining those separate files before product release is either a manual process or part of a build process. Every time one of the individual files is changed, the larger file needs to be re-combined and re-pushed. The cost of this across an organization as large as Yahoo! is significant.

### Serve Files Faster using Combo Handler

Combo Handler, built in collaboration by [Yahoo!'s Exceptional Performance team](http://developer.yahoo.com/performance/) and the groups that support our CDN, is one solution to combine multiple files into a single, larger file.

Combo Handler provides a way to allow developers to maintain the logical organization of their code in separate files, while achieving the advantages of combining those into a single file as part of the final user experience. It alleviates the need for the time-consuming re-build and re-push processes. In addition, Combo Handler integrates seamlessly into a content delivery network, taking full advantage of the [benefits of a CDN](http://developer.yahoo.com/performance/rules.html#cdn) while reducing the drawbacks of dynamically combining separate files.

We've been using this service across many Yahoo! properties for some time now to help improve end users' response times. Thanks to the YUI team, it is [now available](/yuiblog/2008/07/16/combohandler/) to all of you that are using the Yahoo!-hosted YUI JavaScript files. (Note: Combo-handling of CSS files is not supported at this time.) [Head over to the YUI Configurator](http://developer.yahoo.com/yui/articles/hosting/#configure) to generate combo-ready filepaths customized for your specific YUI implementation.

### Combo Handler Best Practices

When using Combo Handler to combine files, pay special attention to the order in which the files are specified. Not only could there be file dependencies, browsers will only use the cached version of a file if the filename extracted from the URL is identical. For example, suppose the following smaller files (`dom.js` and `event.js`) are combined into a single larger file using Combo Handler:

```
   http://yui.yahooapis.com/combo?event.js&dom.js
   http://yui.yahooapis.com/combo?dom.js&event.js

```

In the example above, the browser will download and cache both files separately because the filenames are actually different.

Also, you may not always want to combine all files into one single file. Suppose you have one or more scripts that are shared across multiple pages in your site in addition to scripts that are only used on specific pages. By combining everything into one large file and using this file across your entire site, some pages will spend time downloading more than it really needs. Instead, take a look at different types of combinations. You might combine the scripts that are used in every page across your site into one script. Then for each page or group of pages, combine common scripts into another separate script.

### Yahoo! HotJobs Combines and Reduces Response Time by 8%!

The [Exceptional Performance](http://developer.yahoo.com/performance/) team ran an experiment with [Yahoo! HotJobs](http://hotjobs.yahoo.com) to determine the response time savings our users would benefit from by combining multiple files into a single file. Two real user test buckets were created for this experiment. In one bucket, users visited a page with six JavaScript files left uncombined. In the second bucket, users visited the same page with the six JavaScript files combined into one single file.

> Combining six JavaScript files into one single JavaScript file improved performance by almost 8% on average for Yahoo! HotJobs' users on broadband bandwidth speeds and 5% for users on lan. No design or feature changes required!

Keep in mind that the page we tested was already highly optimized for performance and had a [YSlow](http://developer.yahoo.com/yslow) "A" grade. The response time savings depend on a number of factors including number of files combined, browser caching patterns, etc. This experiment supported our previous research, which indicated that reducing HTTP requests is an effective way to improve response times for our end users.

### Takeaways

Improve response times by combining multiple JavaScript and CSS files. Yahoo!'s [Combo Handler](/yuiblog/2008/07/16/combohandler/) Service is one solution that provides a way to make fewer HTTP requests for Yahoo!-hosted JavaScript files, and also leverages the benefits of a Content Delivery Network.

-   Combine scripts and stylesheets to reduce HTTP requests.
-   Look at different types of file combinations.
-   Avoid users from having to download more than they really need.
-   Pay special attention to the order in which files are combined.