---
layout: layouts/post.njk
title: "Mobile Browser Cache Limits: Android, iOS, and webOS"
author: "YUI Team"
date: 2010-06-28
slug: "mobile-browser-cache-limits"
permalink: /2010/06/28/mobile-browser-cache-limits/
categories:
  - "Development"
---
**Update (July 12, 2010):** While the results described in this article are accurate for HTML pages, new tests have revealed very different cache limits for CSS and JS resources. The updated results are described in [Mobile Browser Cache Limits, Revisited](/yuiblog/2010/07/12/mobile-browser-cache-limits-revisited/).

In early 2008, Wayne Shea and Tenni Theurer wrote a YUI Blog post on [iPhone Cacheability](/yuiblog/2008/02/06/iphone-cacheability/) in which they shared the results of research into various characteristics and limitations of Mobile Safari's cache in iPhone OS 1.x. Among other things, they found that individual components larger than 25KB were not cached, and that there was a maximum total cache size of between 475KB and 500KB.

Much has changed since then. We've seen two new major releases and many minor releases of the iPhone OS (now iOS), and several other mobile devices with highly capable browsers have appeared to challenge the iPhone. Stoyan Stefanov found, in late 2009, that [the iPhone's cache limits had changed](http://www.phpied.com/iphone-caching/) (sadly, for the worse). But where do things stand now? And what about those non-iOS browsers?

## Background

Browsers have two types of caches that we're concerned with for the purposes of these tests:

-   The **component cache**, or object cache, stores individual files. HTML, CSS, JavaScript, and images all go into the component cache. Whenever it needs one of these components, the browser first checks the cache before making a network request.
-   The **page cache**, also known as the back/forward cache, stores an entire page and all of its components, as well as their current state. When you use the back or forward button, the browser will load the page from the page cache if possible.

The [HTML5 application cache](http://www.whatwg.org/specs/web-apps/current-work/multipage/offline.html) is another type of cache that's widely supported by mobile browsers. Browser makers already do a good job of documenting the limits of the application cache, so I didn't include it in my testing. More on the application cache later.

## Devices Tested

I tested the following mobile browser/platform combinations:

-   Android 2.1 (Nexus One)
-   Mobile Safari on iOS 3.1.3 (1st-gen iPhone)
-   Mobile Safari on iOS 3.2 (iPad)
-   Mobile Safari on iOS 4.0 (iPhone 3GS)
-   Mobile Safari on iOS 4.0 (iPhone 4)
-   webOS 1.4.1 (Palm Pre Plus)

**Note:** With the exception of Mobile Safari on iOS 4.0, I tested only one device in each category. If there are variations between individual devices or differences based on installed software beyond the OS, my tests would not detect those variations. These particular devices were tested because they're the ones I had access to, not because I consider them to be more important than other devices.

## Methodology

Cache testing is tedious, but relatively simple.

I wrote a tiny Sinatra app ([fork it on GitHub!](http://github.com/rgrove/cachetest)) that generates a response consisting of a requested number of pseudorandom alphanumeric and whitespace bytes. The responses can be served either gzipped or uncompressed. The following far-future expiration response headers are sent to ensure that all responses are considered cacheable:

```
Cache-Control: max-age=315360000
Expires: Fri, 01 May 2020 03:47:24 GMT

```

Over my local network, I then manually performed the following steps on each device to test the component cache:

1.  Load the cache test index page.
2.  Tap on a link to a component of a particular size, ranging from 5KB to 20MB, and wait for it to finish loading.
3.  Tap the back button.
4.  Tap the same link again. Observe whether the random characters are the same, and whether the server console prints a log entry for a request, to determine whether the component was cached in step 2.
5.  Repeat and adjust component sizes as necessary to determine the maximum component size that will be cached.

To test the page cache, I performed essentially the same steps except that instead of tapping the link again in step 4, I tapped the browser's forward button, causing it to use the page cache rather than the component cache.

Support for `ETag` and `Last-Modified` was determined by tweaking the server to send the appropriate `ETag` or `Last-Modified` response headers (in separate tests) and to omit the far-future expiration headers. I then inspected the request headers received by the server to verify that the browser sent the expected `If-None-Match` or `If-Modified-Since` headers on step 4.

## Results

I tested with gzip both enabled and disabled, but I found that **gzip had no effect on cacheability on any device**. The uncompressed component size is what matters in all cases, regardless of whether or not that component is served gzipped. As such, all component sizes mentioned here are uncompressed sizes.

The table below illustrates my overall findings.

Table: Mobile browser cache characteristics
| Browser/OS/Device | Single Component Limit | Total Component Limit | Page Cache Size Limit | Supports Last-Modified | Supports ETag | Survives Power Cycle |
| --- | --- | --- | --- | --- | --- | --- |
| Android 2.1 (Nexus One) | ~2MB (~2,048,000b) | ~2MB (~2,048,000b) | ∞ 2 | Yes | Yes | Yes |
| Mobile Safari, iOS 3.1.3 (1st-gen iPhone) | 0b 1 | 0b 1 | ∞ 2 | No | No | No |
| Mobile Safari, iOS 3.2 (iPad) | 25.6KB (26,214b) | ~281.6KB (~288,354b) | 25.6KB (26,214b) | Yes | Yes | No |
| Mobile Safari, iOS 4.0 (iPhone 3GS) | 51.199KB (52,428b) | ~1.05MB (~1,100,988b) | ∞ 2 | Yes | Yes | No |
| Mobile Safari, iOS 4.0 (iPhone 4) | 102.399KB (104,857b) | ~1.9MB (~1,992,283b) | ∞ 2 | Yes | Yes | No |
| webOS 1.4.1 (Palm Pre Plus) 3 | ~1MB (~1,048,576) | ? | ~1MB (~1,048,576) | No | No | Yes |

**Notes:**

1 Mobile Safari on iOS 3.1.3 doesn't appear to cache _any_ components, regardless of size, except for the page cache. It's unclear whether this is intentional or a bug.

2 The page caches in Android 2.1, iOS 3.1.3, and iOS 4.0 (but not iOS 3.2) appear to be limited only by available RAM when it comes to individual page size. I didn't attempt to determine exactly how many separate pages could coexist in the page cache at once.

3 webOS test results were inconsistent and at various points the cache seemed to stop working altogether until the phone was power-cycled. I don't consider these results conclusive, or even trustworthy, but they're listed here for the sake of comparison.

### Android

The Android browser exhibited the best cache behavior of all devices tested. While it appears to impose no limit on the size of individual components, the total cache size seems to be limited to approximately 2MB, which means that individual components are effectively limited to 2MB as well.

The page cache appeared to impose no limit on the size of individual pages, happily caching every byte I threw at it until the available RAM was exhausted and the browser crashed.

I was pleasantly surprised to find that Android's component cache survived both browser restarts and power cycles, a feat none of the iOS devices was able to match.

**Possible caveat:** A review of [Android's WebKit source tree](http://android.git.kernel.org/?p=platform/external/webkit.git;a=summary) leads me to believe that its cache limits may adapt based on the amount of RAM and/or flash memory available on the particular device on which it's running. If true, these numbers may only be applicable to the Nexus One. In fact, if the cache size adapts based on unused memory rather than total memory, these numbers may only be applicable to _my_ Nexus One.

I could be mistaken, but the differences in the iOS 4.0 test results on the iPhone 3GS and iPhone 4 support this theory. (Android and Mobile Safari are both WebKit-based browsers, so they may have this behavior in common.) If you're familiar with the WebKit source and can shed more light on this, please get in touch with me.

### iOS

Results varied wildly across the three most recent versions of iOS. Astonishingly, **Mobile Safari on iOS 3.1.3 did not cache components of any size**, despite having an apparently unlimited page cache size. This is troubling since it means iOS 3.1.3 users are likely getting a suboptimal browsing experience, especially if they aren't using wifi. The unlimited page cache size does little good here, since it only comes into play for back/forward navigations. This behavior is a significant change from what others observed in previous iOS releases and I can't imagine any good reason for it, so I suspect this may be a bug.

Mobile Safari on iOS 3.2 (which is only available on the iPad) does not exhibit this bug. Its 25.6KB component limit and ~281.6KB total cache limit are better than nothing, but they still seem paltry compared to the other devices tested. Uniquely among iOS devices, the iPad appears to limit the size of pages in the page cache to 25.6KB, the same as its component size limit.

Mobile Safari on iOS 4.0 exhibited different limits on the iPhone 3GS and on the iPhone 4, which implies that the limits adapt based on available RAM (the iPhone 3GS has 256MB while the iPhone 4 has 512MB; both devices tested had 32GB of flash memory). On the iPhone 3GS, iOS 4.0 has a 51.199KB component size limit and a ~1.05MB total component cache size.

On the iPhone 4, the component size limit was almost exactly two times the limit on the iPhone 3GS, at 102.399KB. The total component cache size was approximately 1.9MB. Perhaps because iOS 3.2 and iOS 4.0 were developed separately but branched from a common ancestor, the iOS 4.0 page cache size appears to be limited only by available RAM on both devices tested, just like iOS 3.1.3.

None of the iOS devices preserved the contents of the cache across forced browser restarts or device power cycles, although they did preserve the cache when merely switching applications without actually killing the browser.

### webOS

My test results on webOS were so inconsistent that I have little confidence in them. I've included what little data I managed to gather purely for the sake of completeness. Please take it with a hefty grain of salt.

As near as I was able to determine, webOS _might_ have an individual component size limit of about 1MB, with a matching page size limit in the page cache. I was unable to coax `If-None-Match` or `If-Modified-Since` request headers from webOS, which implies that it does not support `ETag` and `Last-Modified`.

On some tests, it appeared that webOS's maximum component size was greater than 1MB, but this was inconsistent. As far as I can tell, webOS appears to have a nasty bug where, after a certain point—possibly when the maximum total cache size is reached—the cache just completely stops working altogether until the phone is power-cycled. In some cases even power cycling didn't fix the cache breakage, so I eventually gave up trying to establish the exact cause of the problem and the exact limits of the webOS cache.

## Recommendations

Based on these results, I offer the following recommendations to anyone developing web applications for the tested devices:

-   **Use far-future cache expiration headers.** This will prevent the browser from having to send a conditional GET request and will improve cacheability in webOS, which doesn't support `ETag` or `Last-Modified`.
-   At least until iOS 4.0 arrives on the iPad, try to **limit individual component sizes to 25.6KB or less**, uncompressed. And urge your iPhone users to upgrade to iOS 4.0 as soon as possible.
-   If your website must support iOS 3.1.3 users (which is likely), if it requires components larger than 25.6KB, or if the total size of all your components is larger than 281.6KB, **consider using the HTML5 application cache**, [localStorage](http://www.w3.org/TR/webstorage/), or [database storage](http://www.w3.org/TR/offline-webapps/#sql) to store your components. Alex Kessinger's recent YUI Blog post, [An Introduction to Using YUI 3 in Offline Applications](/yuiblog/2010/05/27/yui3-intro-to-offline/), might be of interest for YUI 3 developers considering this approach.
-   **Do your own testing.** Don't assume that these results apply to any future version of any of the tested browsers or devices. Use these results as a starting point, but verify them yourself before you make major decisions based on assumptions about mobile cache limitations. The mobile browser world changes at a lightning pace, so this research will have a very short shelf life.

I've [made my test code available on GitHub](http://github.com/rgrove/cachetest) and I encourage you to use it, fork it, and share what you learn.

## Call for Documentation

Browser makers, please consider documenting and publishing your browser's cache limits. In the desktop world where these limits are typically so high as to be a non-issue, documentation wasn't needed. In the mobile world, browser cache limits are vital information that web developers must have in order to create performant websites with compelling features.

The limits of new features like localStorage and the application cache are typically well-documented. Please extend this level of documentation to the component cache as well.