---
layout: layouts/post.njk
title: "Graded Browser Support: Update, Roadmap, and FAQ"
author: "Unknown"
date: 2006-08-18
slug: "browser-support-update-2006q3"
permalink: /blog/2006/08/18/browser-support-update-2006q3/
categories:
  - "Development"
---
We published a paper titled Graded Browser Support (GBS) alongside the YUI Library release in February. Called "[logical and simple, but also profoundly practical](http://www.webstandards.org/2006/02/14/yahoo-developers-setting-a-standard-for-the-new-professionalism/)" by the Web Standards Project's (WaSP) Group Lead, GBS rejects the customary "you must be this tall to ride" approach and instead defines three _grades of support_. This makes it possible to support every desktop browser - at some grade - while bringing sanity and predictability to the development and quality assurance (QA) testing processes.

While the GBS concept is durable, the granting of A-grade support to a particular user agent (browser) is provisional. On the Yahoo! Developer Network, you can read [the definitive GBS article](http://developer.yahoo.com/yui/articles/gbs/gbs.html) and [reference our A-grade chart](http://developer.yahoo.com/yui/articles/gbs/gbs_browser-chart.html) which is updated quarterly. (A-grade support is the highest grade of support. The YUI Library proudly features complete A-grade support.)

In the next sections we will report on changes in [this quarter's update](#changes-2006Q3), forecast changes we're considering for [next quarter](#potential-changes-2006Q4), and answer several [frequently asked questions](#faq).

### Changes This Quarter (2006-Q3)

**Initiation of A-grade support for Opera 9.0x; discontinuation of A-grade support for Opera's 8.x and earlier branches:** Now that Opera 9.0x has been released and adopted, we have discontinued A-grade support for older versions.

**Discontinuation of A-grade support for Safari < 2.x:** We have discontinued A-grade support for all versions of Safari prior to the 2.x branch.

These changes are reflected on the [A-grade support chart](http://developer.yahoo.com/yui/articles/gbs/gbs_browser-chart.html) on the Yahoo! Developer Network site.

### Potential Changes for Next Quarter (2006-Q4)

**Discontinuation of A-grade support for IE 5.5:** We see a small but significant percentage of traffic still using IE5.5, especially in Asia. However, this number is steadily dropping, and combined with the upcoming rollout of IE7 we expect to discontinue A-grade support for IE5.5 across all Windows flavors in the 4th quarter.

**Discontinuation of A-grade support for Firefox 1.0.x:** As a majority of users migrate to Firefox's 1.5x and 2.0x branches, we plan to discontinue A-grade support for Firefox 1.0x across all operating systems.

**Discontinuation of A-grade support for Mozilla Suite and Netscape:** Mozilla and Netscape continue to maintain their Mozilla Application Suite and Netscape Navigator product lines. We have discontinued A-grade support for these two browsers because they share the Gecko rendering engine with Mozilla's Firefox. We have not noticed functional differences between Gecko's implementation in Firefox - which receives A-grade support - and these two brands.

### Frequently Asked Questions

**Question: Who determines which browsers receive A-grade support, and how is that decision made?**

I drive this decision making process in consultation with my team and other stakeholders. I weigh a wide variety of data, as well as more general considerations and objectives.

**Internal Stats:** From our server logs, we study which browsers are used by our visitors. Most importantly we look at the global average, however we also slice this data in several ways: by % of page views, by % of users, by property (e.g., Y!News), by country, and by demographic.

**Public Stats:** We monitor publicly available stats such as those from [Hitwise](http://www.hitwise.com/) and [Web Side Story](http://www.websidestory.com/). However, I believe our internal stats are an accurate sample of overall Internet traffic because of our breadth of services and content types and our overall scale and penetration.

**Economic and Strategic Factors:** Beyond raw statistics, we consider economic and strategic factors such as the impact on development time and the type of product development that the capabilities (or lack thereof) of the platform afford. Also, since every A-grade browser must be part of the QA process, we are mindful of the cost of each incremental addition to the A-grade list.

**Rendering Engines:** For example, by assessing Gecko (inside Firefox) and Trident (within IE), we can gain inexpensive coverage (X-grade support) of derivative browsers such as [Flock](http://www.flock.com/) and [Maxthon](http://www.maxthon.com/), respectively.

**Healthy Ecosystem:** Broad and inclusive browser support fosters a healthy and vibrant browser ecosystem, which we believe is a Good Thing. On one hand, this may cultivate competition and innovation by supporting a wide range of browsers. On the other hand, it may encourage consistent, compatible, and collaborative innovation by browser vendors because we tend to develop against only the capabilities that shared across all A-grade browsers.

**Question: Should different countries and projects define a different suite of A-grade browsers?**

A globally consistent approach advances our goal of maximum availability and accessibility. Even if data indicate a particular distribution of browser usage in a particular country, welcoming users from anywhere on the globe is optimal. This is a best practice and recommendation, but not a mandate. Further, the reduction of visual and functional "cliffs" between sites and products can encourage user exploration. The same concept applies to project-specific determinations.

**Question: "Why is the chart updated quarterly?"**

A key benefit of GBS is the sanity it can bring to QA and development processes. If the A-grade membership shifts too quickly, these benefits disappear. Quarterly updates balance responsiveness to market conditions with a reduction in development environment volatility.

**Question: "What about mobile devices?"**

While mobile and living room devices can benefit from a GBS approach, this article and chart address desktop browsers only.

**Question: "What grade of support do micro-versions that are released in the time between GBS updates receive? How should the ".x" notation be read?"**

The dot-x notation (e.g., Opera 9.0x) provides flexibility between quarterly GBS updates. Because GBS is not auto-updating (i.e., to receive A-grade support a browser must be specifically identified on the chart), we have found it useful to not be overly precise in our browser version identification in some cases.

**Question: This sounds great, but why does Yahoo! site X not work on my browser?**

Graded Browser Support is our centrally recommended policy, however not all sites have adopted it yet. Some properties have legacy code that makes this difficult, while others use a technology piece that presents challenges. That said, adoption of GBS continues, and many of our sites that do not currently support all A-grade browsers are moving towards it.

### Conclusion

I believe the benefits of GBS are clear and significant. By updating the A-grade chart quarterly it remains relevant.