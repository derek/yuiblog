---
layout: layouts/post.njk
title: "Mobile Browser Cache Limits, Revisited"
author: "Ryan Grove"
date: 2010-07-12
slug: "mobile-browser-cache-limits-revisited"
permalink: /2010/07/12/mobile-browser-cache-limits-revisited/
categories:
  - "Development"
---
In [Mobile Browser Cache Limits: Android, iOS, and webOS](/yuiblog/blog/2010/06/28/mobile-browser-cache-limits/), I shared the results of my attempts to determine browser cache limits on Android, iOS, and webOS devices. At the end of the article, I wrote:

> Use these results as a starting point, but verify them yourself before you make major decisions based on assumptions about mobile cache limitations. The mobile browser world changes at a lightning pace, so this research will have a very short shelf life.

As it turns out, that was good advice: the day after the article was posted, [Steve Souders](http://stevesouders.com/) commented that he had run tests using a different methodology that was more representative of a real-world web workflow and had gotten different results.

## New Methodology

My original methodology involved navigating directly to a randomly generated page of a certain size, served with a `text/html` content type. The results using this methodology were reliably reproducible (except on webOS), but as Steve pointed out, users don't navigate directly to CSS and JavaScript files. My assumption that the limits for direct navigation to an HTML resource were the same as the limits for external CSS and JavaScript was incorrect, so even though the results of my tests were valid, they weren't widely applicable.

Over the course of many IM sessions, several emails, and a couple of phone calls, Steve and I worked out a new testing methodology. I implemented a version of it on top of my [cache testing framework](http://github.com/rgrove/cachetest), then Steve [implemented a version](http://stevesouders.com/tests/cachesize/) capable of publishing results to [Browserscope](http://www.browserscope.org/).

In the new tests, we load an HTML page that refers to a randomly-generated CSS or JavaScript component of a certain size. Then we navigate to a second HTML page that loads the same component and checks whether or not it was loaded from the cache. To determine whether a component was loaded from the cache, we store a timestamp in a cookie on each request; if the timestamp is updated the second time we load the component, we know the request hit the server, which means the component was not loaded from the cache.

## New Results

We found that **all the mobile browsers we tested had significantly higher cache limits for external resources loaded by a page than they did for an HTML page itself**. This is excellent news for mobile web developers.

The table below illustrates our findings: .cachestats { font-size: 12px; } .cachestats td, .cachestats th { margin: 2px; padding: 2px; text-align: center; font-size:12px !important; } .cachestats th { background: #efefef; font-weight: bold; padding: 4px; } .cachestats .browser { text-align: left; } .cachestats .doubtful { background-color: #fff0db; } .cachestats .no { background-color: #ff5f5f; } .cachestats .yes { background-color: #b3ffaf; } /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

Table: Mobile browser external resource cache characteristics
| Browser/OS/Device | Single Component Limit | Survives Power Cycle |
| --- | --- | --- |
| Android 2.2 (Nexus One) | 2MB | Yes |
| Mobile Safari, iOS 3.1.3 (1st-gen iPhone) | 4MB+ | No |
| Mobile Safari, iOS 3.2 (iPad) | 4MB+ | No |
| Mobile Safari, iOS 4.0 (iPhone 3GS) | 4MB+ | No |
| Mobile Safari, iOS 4.0 (iPhone 4) | 4MB+ | No |
| webOS 1.4.1 (Palm Pre Plus) | ~0.99MB (1,023KB) | Yes |

Note that 4MB was the largest size we tested, and all the iOS devices cached 4MB components. The actual cache limit for those devices may be larger than 4MB. Also, webOS on the Palm Pre Plus gave consistent results in this test, whereas it had some problems in the previous test.

It's possible that the much lower limits my previous test showed for HTML components on iOS may indicate the use of a RAM cache for those components, while the much higher limits for CSS/JS components in this test may indicate the use of a disk cache, but this is just conjecture. Android, at least, does appear to use a disk cache in both cases, since its cache survives power cycles.

## New Recommendations

Based on these new results, coupled with the results from my previous tests, I offer the following updated set of recommendations:

-   **Use far-future cache expiration headers.** This will prevent the browser from having to send a conditional GET request.
-   **Try to limit HTML pages to 25.6KB or less** if you want them to be cached, since the previous tests showed that this limit—imposed by iOS 3.2 on the iPad—was the lowest HTML resource limit of the devices tested.
-   **Keep CSS and JS components under 1MB.** Of course, 1MB is enormous and your components should be much smaller than this, but don't bother splitting a component into separate requests for the sake of cacheability unless its size approaches 1MB.
-   **Consider using the HTML5 application cache** if it's important that your components persist in the cache for a long time, or across power cycles.
-   **Do your own testing.** I stressed the importance of this in my previous article and I'll stress it again here. Use these results as a starting point, but verify them yourself before you make important decisions based on them.