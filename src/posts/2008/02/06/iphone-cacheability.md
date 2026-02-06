---
layout: layouts/post.njk
title: "Performance Research, Part 5: iPhone Cacheability - Making it Stick"
author: "Tenni Theurer"
date: 2008-02-06
slug: "iphone-cacheability"
permalink: /blog/2008/02/06/iphone-cacheability/
categories:
  - "Development"
---
At [MacWorld 2008](http://www.macworldexpo.com/), Steve Jobs announced that Apple sold 4 million iPhones to date, that's 20,000 iPhones sold every day. [Net Applications](http://marketshare.hitslink.com/report.aspx?sample=4&qprid=10&qpmr=14&qpdt=1&qpct=0&qptimeframe=M&qpsp=107) reports that total web browsing on iPhone is up at 0.12% for December 2007, topping the web browsing on all Windows Mobile devices combined. Apple's iPhone has changed the game for many users browsing the web on a mobile device. Web developers can now create functionally rich and visually appealing applications that run within the iPhone's version of the Safari Mobile web browser. While the iPhone presents new and exciting opportunities for mobile web application developers, it also provides a unique set of performance challenges.

Limited information is available on this device and understanding the cache properties of the browser is essential to creating a high performance web site. In earlier posts, we described how [80% or more](/yuiblog/blog/2006/11/28/performance-research-part-1/) of the end-user response time is spent on the front-end, and [why the cache matters](/yuiblog/blog/2007/01/04/performance-research-part-2/). In this research, Yahoo!'s Exceptional Performance team investigated the iPhone cache properties and looked at how the performance rules are affected. We were particularly interested in the following cache properties on the iPhone:

-   The maximum cache limit for an individual component.
-   The maximum cache limit for multiple components.
-   The effect of gzipped components on the maximum cache limits.
-   Whether cached components are persistent between power cycles.

We conducted our cache experiments with both Apple's iPhone and iPod Touch, and came to the same conclusions.

### Cache Hit or Miss?

In [Part 2](/yuiblog/blog/2007/01/04/performance-research-part-2/), we discussed the importance to differentiate between end user experiences for an empty versus a primed cache page view.

When an external component (scripts, stylesheets, and images) is referenced in an HTML page, the browser makes an HTTP request and stores the component in memory while the HTML page is rendered. Though components are stored in the browser's memory during rendering, they may or may not be stored in the browser's cache. A "cache miss" refers to when the browser bypasses the cache and requests the component over the network. A "cache hit" refers to when the component is found in the cache and the corresponding HTTP requests are avoided.

Components are cacheable when they include either the expires or cache-control header.

```
      Expires: [Expiration time in GMT Format]
      Cache-Control: max-age=[Expiration time in seconds]

```

Components that do not have one of the above headers will not be cached by the browser. To discover the cache capabilities on the iPhone browser and get a cache hit, we configured the server to include the following response header:

```
      Expires: Thu, 15 Apr 2010 20:00:00 GMT

```

### Maximum Cache Limits

In our experiments, we varied the size of different types of components (images, stylesheets, and scripts) to determine the maximum cache size for an individual component. We found that if the size of component is greater than 25 KB, the iPhone's browser does not cache the component. Thus, web pages designed specifically for the iPhone should reduce the size of each component to 25 Kbytes or less for optimal caching behavior.

The good news is if the browser downloads a component larger than 25 KB, components already in the browser cache are not affected. Components already in the cache are only replaced by newer cacheable components under 25 KB using the LRU (least recently used) algorithm.

Apple's [website](http://developer.apple.com/iphone/devcenter/designingcontent.html) indicates a 10 MB limit for individual components. The limit applies to the browser ability to store component in memory (not disk). However, the actual size that the iPhone can handle is much smaller, and depends on memory fragmentation and other applications that may be running concurrently. The uncached components are reclaimed by the browser when the page unloads.

To determine the maximum limit of the iPhone cache for multiple components, we incremented the number of 25 KB sized components embedded in our page. We tested the various component types and found that the iPhone browser was able to cache a maximum of 19 external 25KB components. The maximum cache limit for multiple components is found to be 475K - 500 KB.

### Compressed Components

We also analyzed the impact of the cache characteristics on components transmitted with and without compression. We were surprised to find that the 25 KB maximum cache limit for a component is independent to whether the component was sent gzipped. The Safari browser on the iPhone decodes the component _before_ saving it to the cache. Therefore, only the uncompressed size matters, which further emphasizes the importance of keeping the size of components small.

### The Effect of Power Cycle

Every once in awhile, iPhone and iPod Touch users will need to force a hard reset, or in other words, cut the power and reboot the device. This is achieved by a hold of the sleep button for five seconds, and a simple slide to power off. Suppose a user was browsing your site at the moment before the reset. Will the images and stylesheets still be in the browser's cache when the user returns to ensure a speedy response time when the user returns? We discovered that the iPhone browser cache is not persisted across power cycle. This means that the Safari browser cache on iPhone allocates memory from the system memory to create cached components but does not save the cached components in persistent storage.

### Case Study: Yahoo! Front Page

Yahoo! launched a beta version of the mobile home page at the Consumer Electronics Show (CES) in January 2008. From a performance standpoint, this makes perfect sense. The iPhone has an amazing UI, but it is limited by the small cache size and slow network speed. Downloading large components over the air through the EDGE network is slower compared to DSL. According to published reports, the typical data download speed varies from 82 kbps to 150 kbps. Though the WiFi network speed is usually more acceptable, it's better to give users the choice in which experience they'd prefer. Let's take a closer look at the caching characteristics of the [mobile](http://beta.m.yahoo.com) and [desktop](http://www.yahoo.com) versions of Yahoo!'s Home Page on the iPhone. Figure 1 below shows a comparison between the two.

#### **Figure 1.** Yahoo! Front Page Mobile and Desktop versions on the iPhone

![Yahoo! Front Page Mobile and Desktop versions on the iPhone](/yuiblog/blog-archive/assets/performance/iphone-side-by-side.png)

The desktop version of Yahoo!'s home page is roughly 11 times heavier in total size than the mobile version. As a result, the response time to load the desktop version on the iPhone is over 10 times as long. Table 1 shows a summary of the total size and number of HTTP requests to load the Yahoo!'s Front Page mobile version. Loading the page on the iPhone over the EDGE network, it took on average 2.2 seconds to load with an empty cache and on average only 1.5 seconds to load with a primed cache. Table 2 shows the desktop version took on average 25.4 seconds to load with an empty cache and on average 19.9 seconds with a primed cache. That's 32% faster with a primed cache than empty cache to load the mobile version, rather than only 22% faster to load the desktop version. While the mobile site is designed for optimal caching behavior, the desktop version contains many more components that are uncacheable by the iPhone.

<table class="chart"><caption>Table 1. iPhone Mobile Experience</caption><tbody><tr><th></th><th>Empty Cache</th><th>Primed Cache</th></tr><tr><td>HTML/Text</td><td>5K (23K*)</td><td>5K (23K*)</td></tr><tr><td>Images</td><td>14K</td><td>5K</td></tr><tr><td>Total Size</td><td>19K (37K*)</td><td>10K (28K*)</td></tr><tr><td>HTTP Requests</td><td>23</td><td>4</td></tr><tr><td>Response Time</td><td>2.2 sec</td><td>1.5 sec</td></tr></tbody></table>

<table class="chart"><caption>Table 2. iPhone Desktop Experience</caption><tbody><tr><th></th><th>Empty Cache</th><th>Primed Cache</th></tr><tr><td>HTML/Text</td><td>32K (121K*)</td><td>32K (121K*)</td></tr><tr><td>Images</td><td>117K</td><td>32K</td></tr><tr><td>JS/CSS</td><td>74K (278K*)</td><td>73K (272K*)</td></tr><tr><td>Total Size</td><td>223K (517K*)</td><td>137K (425K*)</td></tr><tr><td>HTTP Requests</td><td>30</td><td>4</td></tr><tr><td>Response Time</td><td>25.4 sec</td><td>19.9 sec</td></tr></tbody></table>

**\*** Uncompressed sizes measured in kilobytes.

### Takeaways

Design sites specific for iPhone users. In addition to improved usability, you will also reduce the overall page weight and enhance end-user's performance. Yahoo!'s Exceptional Performance team identified [13 rules for making web pages fast](http://developer.yahoo.com/performance/rules.html). The iPhone cache experiment suggests an additional performance rule specific for developing web sites for the iPhone:

#### Reduce the size of each component to 25 Kbytes or less for optimal caching behavior.

Given that the wireless network speed on iPhone is limited and the browser cache is cleared across power cycle, it is even more important to make fewer HTTP requests to achieve good performance than in the desktop world. To reduce the number of HTTP requests, Safari on iPhone supports image map, CSS sprites, inline images and inline CSS images. Take advantage of the browser cache whenever possible. If an external component can be shared across multiple pages in the site, remember that each individual component has to be smaller than 25 KB to be cacheable. Also, the maximum cache limit of all components is 475 - 500 KB. Minify all the JavaScript, CSS and HTML. For components that aren't shared across multiple pages, consider making them inline.