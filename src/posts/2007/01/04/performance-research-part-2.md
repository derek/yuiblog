---
layout: layouts/post.njk
title: "Performance Research, Part 2: Browser Cache Usage - Exposed!"
author: "YUI Team"
date: 2007-01-04
slug: "performance-research-part-2"
permalink: /2007/01/04/performance-research-part-2/
categories:
  - "Performance"
  - "Development"
---
This is the second in a series of articles describing experiments conducted to learn more about optimizing web page performance. You may be wondering why you're reading a performance article on the YUI Blog. It turns out that most of web page performance is affected by front-end engineering, that is, the user interface design and development.

In an earlier post, I described [What the 80/20 Rule Tells Us about Reducing HTTP Requests](/yuiblog/blog/2006/11/28/performance-research-part-1/). Since browsers spend 80% of the time fetching external components including scripts, stylesheets and images, reducing the number of HTTP requests has the biggest impact on reducing response time. But shouldn't everything be saved in the browser's cache anyway?

### Why does cache matter?

It's important to differentiate between end user experiences for an empty versus a full cache page view. An "empty cache" means the browser bypasses the disk cache and has to request all the components to load the page. A "full cache" means all (or at least most) of the components are found in the disk cache and the corresponding HTTP requests are avoided.

The main reason for an empty cache page view is because the user is visiting the page for the first time and the browser has to download all the components to load the page. Other reasons include:

-   The user visited the page previously but cleared the browser cache.
-   The browser cache was automatically cleared, based on the browser's settings.
-   The user reloaded the page in a way that caused the cache to be bypassed. For example, the browser will bypass the cache if you hold down the control-shift key while clicking the Refresh button in Internet Explorer.

Strategies such as combining scripts, stylesheets, or images reduce the number of HTTP requests for _both_ an empty and a full cache page view. Configuring components to have an Expires header with a date in the future reduces the number of HTTP requests for only the full cache page view.

Previously, we observed where the time is spent when a user requests [http://www.yahoo.com](http://www.yahoo.com) with an empty cache. When a user loads the page, the browser downloads approximately 30 components (see Figure 1). Figure 2 is a graphical view of where the time is spent loading [http://www.yahoo.com](http://www.yahoo.com) with a full cache. Each bar represents a specific component requested by the browser. Since components are already in the cache on a full cache page view, and the Expires header has a date in the future, the browser only has to download three components including the HTML document

![Figure 1. Loading http://www.yahoo.com with an empty cache](/yuiblog/blog-archive/assets/performance/pageload-empty.gif)

#### Figure 1. Loading http://www.yahoo.com with an empty cache

![Figure 2. Loading http://www.yahoo.com with a full cache](/yuiblog/blog-archive/assets/performance/pageload-full.gif)

#### Figure 2. Loading http://www.yahoo.com with a full cache

Table 1 shows a summary of the total size and number of requests for each type of component to load [http://www.yahoo.com](http://www.yahoo.com). How much does a full cache benefit the user? Loading the page over my cable modem at home, it took 2.4 seconds with an empty cache and only 0.9 seconds with a full cache. The full cache page view had 90% fewer HTTP requests and 83% fewer bytes to download than the empty cache page view.

#### Table 1. Empty and Full Cache Summary to load http://www.yahoo.com

![Table 1. Empty and Full Cache Summary to load http://www.yahoo.com](/yuiblog/blog-archive/assets/performance/empty-full.gif)

\* Times were measured over cable modem (~2.5 mbps).

### How many users view Yahoo! pages with a full cache?

The performance team at Yahoo! ran an experiment to determine the percentage of users and page views with an empty cache on some of Yahoo!'s most popular pages. We defined the experiment to measure users' cache behavior related to a new component (an image). For this new image we measured the following statistics each day:

1.  What percentage of users requested the new image?
2.  What percentage of page views requested the new image?

The new image was configured with the following HTTP headers:

```
Expires: Thu, 15 Apr 2004 20:00:00 GMT
Last-Modified: Wed, 28 Sep 2006 23:49:57 GMT

```

When the browser saves a component in its cache, it also saves the Expires and Last Modified values. Specifying an Expires date in the past forces the browser to request the image every time the page is viewed (with a few exceptions, such as when users click the browser's "back" button to return to a page). If the image is already in the browser's cache and is being re-requested, the browser will pass the Last-Modified date in the request header. This is called a _conditional GET request_ and if the image has not been modified, the server will return a `304 Not Modified` response. The requests from browsers, therefore, result in one of the following response status codes:

-   200 — The browser does not have the image in its cache.
-   304 — The browser has the image in its cache, but needs to verify the last modified date.

Since the status codes are recorded in the apache access logs, we are able to determine the empty and full cache measurements by analyzing the logs.

The percentage of users with an empty cache is:

```
       # of unique users with at least one 200 response 
                                                        
                    total # of unique users             

```

The percentage of page views with an empty cache is:

```
                      # of 200 responses           
                                                   
           # of 200 responses + # of 304 responses 

```

Figure 3 shows the percentage of users and page views with an empty cache plotted over each day of the experiment. On the first day of the experiment, no one had these images cached so the empty cache percentage was 100%. As the days passed more users had the images cached, so the percentages dropped until at some point it reached a constant steady state.

![Figure 3. Percentage of Users and Page Views with an Empty Cache](/yuiblog/blog-archive/assets/performance/cache-expt.gif)

#### Figure 3. Percentage of Users and Page Views with an Empty Cache

### Suprising Results

40-60% of Yahoo!'s users have an empty cache experience and ~20% of all page views are done with an empty cache. To my knowledge, there's no other research that shows this kind of information. And I don't know about you, but these results came to us as a _big_ surprise. It says that even if your assets are optimized for maximum caching, there are a significant number of users that will _always_ have an empty cache. This goes back to the earlier point that reducing the number of HTTP requests has the _biggest_ impact on reducing response time. The percentage of users with an empty cache for different web pages may vary, especially for pages with a high number of active (daily) users. However, we found in our study that regardless of usage patterns, the percentage of page views with an empty cache is always ~20%.

Conclusion: Keep in mind the empty cache user experience. It might be more prevalent than you think!