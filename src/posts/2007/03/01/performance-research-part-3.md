---
layout: layouts/post.njk
title: "Performance Research, Part 3: When the Cookie Crumbles"
author: "Tenni Theurer"
date: 2007-03-01
slug: "performance-research-part-3"
permalink: /2007/03/01/performance-research-part-3/
categories:
  - "Development"
---
HTTP cookies are used for a variety of reasons such as authentication and personalization. Information about cookies is exchanged in the HTTP headers between web servers and browsers. This article discusses the impact of cookies on the overall user response time.

### HTTP Quick Review

Cookies originate from web servers when browsers request a page. Here is a sample HTTP header sent by the web server after a request for `www.yahoo.com`:

```
  HTTP/1.1 200 OK
  Content-Type: text/html; charset=utf-8
  Set-Cookie: C=abcde; path=/; domain=.yahoo.com

```

The header includes information about the response such as the protocol version, status code, and content-type. The `Set-Cookie` is also included in the response and in this example the name of the cookie is "C" and the value of the cookie is "abcde". Note: The maximum size of a cookie is 5051 bytes in IE 6.0 and 4096 bytes in Firefox 1.5.

The browser saves the "C" cookie on the user's computer and sends it back in future requests. The "`domain=.yahoo.com`" specifies that the browser should include the cookie in future requests within the `.yahoo.com` domain and all its sub-domains. For example, if the user then visits `finance.yahoo.com`, the browser includes the "C" cookie in the request. Since an Expires attribute is not included in this example, the cookie expires at the end of the session.

Here is a sample HTTP header for `finance.yahoo.com` sent by the browser:

```
  GET / HTTP/1.1
  Host: finance.yahoo.com
  User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; ...
  Cookie: C=abcde;

```

Notice that the "C" cookie, originating from `www.yahoo.com`, is also included in the request for `finance.yahoo.com`.

### Impact of cookies on response time

The performance team at Yahoo! ran an experiment to measure the impact of retrieving a document with various cookie sizes. The experiment measured a static HTML document with no elements in the page. The primary variable in the experiment was the cookie size. We ran the experiment using a test harness that fetches a set of URLs repeatedly while measuring how long it takes to load the page on DSL. The results are shown in Table 1.

<table class="chart" id="response-times-for-various-cookie-sizes-table"><caption>Table 1. Response times for various cookie sizes</caption><tbody><tr><th>Cookie Size</th><th>Median Response Time (Delta)</th></tr><tr><td>0 bytes</td><td>78 ms (<b>0 ms</b>)</td></tr><tr><td>500 bytes</td><td>79 ms (<b>+1 ms</b>)</td></tr><tr><td>1000 bytes</td><td>94 ms (<b>+16 ms</b>)</td></tr><tr><td>1500 bytes</td><td>109 ms (<b>+31 ms</b>)</td></tr><tr><td>2000 bytes</td><td>125 ms (<b>+47 ms</b>)</td></tr><tr><td>2500 bytes</td><td>141 ms (<b>+63 ms</b>)</td></tr><tr><td>3000 bytes</td><td>156 ms (<b>+78 ms</b>)</td></tr></tbody></table>

**Note:** Times are for page loads on DSL (~800 kbps).

These results highlight the importance of keeping the size of cookies as low as possible to minimize the impact on the user's response time. A 3000 byte cookie, or multiple cookies that total 3000 bytes, could add as much as an 80 ms delay for users on DSL bandwidth speeds. The delay is even worse for users on dial-up.

### How big are users' cookies set at the .yahoo.com domain?

Cookies set at the `.yahoo.com` domain affect the overall response time for users visiting web pages across the Yahoo! network. Figure 1 shows the percentages of Yahoo!'s total page views with various cookie sizes set at the `.yahoo.com` domain.

#### **Figure 1.** Percentage of Page Views with Various Cookie Sizes

![Figure 1. Percentage of Page Views with Various Cookie Sizes](/yuiblog/blog-archive/assets/performance/cookies.gif)

About 80% of page views have fewer than 1000 bytes of cookies, which correlates to about a 5 to 15 ms delay for users on DSL bandwidth speeds. While the data shows that the majority of page views aren't impacted by a significant delay, it also shows that about 2% of page views have over 1500 bytes of cookies set at the `.yahoo.com` domain. Although 2% sounds insignificant, at Yahoo! this translates to millions of page views per day, a compelling motivation for us to investigate this 2% and eliminate unnecessary cookies, reduce cookie sizes, and set cookies at more granualar domain levels.

In an earlier post about browser cache usage, one user made a [comment](/yuiblog/blog/2007/01/04/performance-research-part-2/#comment-29021) about the side-effects of different browsers. Since Internet Explorer and Firefox have different implementations for the maximum size and number of cookies supported, we also analyzed the data by browser type and found no significant difference between the cookie sizes. It would be interesting to further investigate whether there is a difference in performance across browsers.

### Analysis of Cookie Sizes across the Web

To show how Yahoo!'s cookie usage relates to those of other companies, we analyzed the cookies set by other popular web sites. For this experiment, we cleared all our cookies and visited only the home pages of these web sites. Table 2 shows between 60 and 500 bytes of cookie information included in the HTTP headers.

<table class="chart" id="total-cookie-sizes-chart"><caption>Table 2. Total Cookie Sizes</caption><tbody><tr><td>&nbsp;</td><th>Total Cookie Size</th></tr><tr><th><a href="http://www.amazon.com/">Amazon</a></th><td>60 bytes</td></tr><tr><th><a href="http://www.google.com/">Google</a></th><td>72 bytes</td></tr><tr><th><a href="http://www.yahoo.com/">Yahoo</a></th><td>122 bytes</td></tr><tr><th><a href="http://www.cnn.com/">CNN</a></th><td>184 bytes</td></tr><tr><th><a href="http://www.youtube.com/">YouTube</a></th><td>218 bytes</td></tr><tr><th><a href="http://www.msn.com/">MSN</a></th><td>268 bytes</td></tr><tr><th><a href="http://www.ebay.com/">eBay</a></th><td>331 bytes</td></tr><tr><th><a href="http://www.myspace.com/">MySpace</a></th><td>500 bytes</td></tr></tbody></table>

**Note:** We only requested the home page.

The data in Table 2 reflects only cookies set at the top domain levels to eliminate any cookies that may have been set by ads. The total cookie size for Yahoo! (122 bytes) in Table 2 differs from the cookie sizes indicated in Figure 4 because in this experiment we visited only the home pages of each web site. The data in Figure 4 reflect real users, many of whom visit multiple Yahoo! web pages. To illustrate, if `tv.yahoo.com` and `movies.yahoo.com` wanted to share information within a cookie, the cookie must be set at the `.yahoo.com` domain. The total cookie size set at the `.yahoo.com` domain for a user who visits multiple Yahoo! sub-domains is typically higher than the total cookie size set for a user who only visits `www.yahoo.com`.

Setting cookies at the appropriate path and domain is just as important as the size of the cookie, if not more. A cookie set at the `.yahoo.com` domain impacts the response time for every Yahoo! page in the `.yahoo.com` domain that a user visits.

### Takeaways

-   Eliminate unnecessary cookies.
-   Keep cookie sizes as low as possible to minimize the impact on the user response time.
-   Be mindful of setting cookies at the appropriate domain level so other sub-domains are not affected.
-   Set an Expires date appropriately. An earlier Expires date or none removes the cookie sooner, improving the user response time.