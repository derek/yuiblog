---
layout: layouts/post.njk
title: "Performance Research, Part 1:  What the 80/20 Rule Tells Us about Reducing HTTP Requests"
author: "Tenni Theurer"
date: 2006-11-28
slug: "performance-research-part-1"
permalink: /2006/11/28/performance-research-part-1/
categories:
  - "Performance"
  - "Development"
---
It's no secret that users prefer faster web sites. I work in a dedicated team focused on quantifying and improving the performance of Yahoo! products worldwide. As part of our work, we conduct experiments related to web page performance. We are sharing our findings so that other front-end engineers join us in accelerating the user experience on the web.

### The 80/20 Performance Rule

Vilfredo Pareto, an economist in the early 1900s, made a famous observation where 80% of the nation's wealth belonged to 20% of the population. This was later generalized into what's commonly referred to as the Pareto principle (also known as the 80-20 rule), which states for any phenomenon, 80% of the consequences come from 20% of the causes. We see this phenomenon in software engineering where 80% of the time is spent in only 20% of the code. When we optimize our applications, we know to focus on that 20% of the code. This same technique should also be applied when optimizing web pages. Most performance optimization today are made on the parts that generate the HTML document (apache, C++, databases, etc.), but those parts only contribute to about 20% of the user's response time. It's better to focus on optimizing the parts that contribute to the other 80%.

Using a packet sniffer, we discover what takes place in that other 80%. Figure 1 is a graphical view of where the time is spent loading http://www.yahoo.com with an empty cache. Each bar represents a specific component and is shown in the order started by the browser. The first bar is the time spent for the browser to retrieve just the HTML document. Notice only 10% of the time is spent here for the browser to request the HTML page, and for apache to stitch together the HTML and return the response back to the browser. The other 90% of the time is spent fetching other components in the page including images, scripts and stylesheets.

#### Figure 1. Loading http://www.yahoo.com

![Figure 1. Loading http://www.yahoo.com](/yuiblog/blog-archive/assets/performance/pageload.gif)

Table 1 shows popular web sites spending between 5% and 38% of the time downloading the HTML document. The other 62% to 95% of the time is spent making HTTP requests to fetch all the components in that HTML document (i.e. images, scripts, and stylesheets). The impact of having many components in the page is exacerbated by the fact that browsers download only two or four components in parallel per hostname, depending on the HTTP version of the response and the user's browser. Our experience shows that reducing the number of HTTP requests has the biggest impact on reducing response time and is often the easiest performance improvement to make.

<table class="chart" id="time-spent-loading-popular-web-sites"><caption>Table 1. Time spent loading popular web sites</caption><tbody><tr><td class="empty">&nbsp;</td><th>Time Retrieving HTML</th><th>Time Elsewhere</th></tr><tr><th>Yahoo!</th><td>10%</td><td>90%</td></tr><tr><th>Google</th><td>25%</td><td>75%</td></tr><tr><th>MySpace</th><td>9%</td><td>91%</td></tr><tr><th>MSN</th><td>5%</td><td>95%</td></tr><tr><th>ebay</th><td>5%</td><td>95%</td></tr><tr><th>Amazon</th><td>38%</td><td>62%</td></tr><tr><th>YouTube</th><td>9%</td><td>91%</td></tr><tr><th>CNN</th><td>15%</td><td>85%</td></tr></tbody></table>

**Note:** Times are for page loads with an empty cache over Comcast cable modem (~2.5 mbps).

### Shouldn't everything be saved in the browser's cache anyway?

The conclusion is the same: Reducing the number of HTTP requests has the biggest impact on reducing response time and is often the easiest performance improvement to make. In the next article we'll look at the impact of caching, and some surprising real-world findings.

Disclaimer: Design imperatives dictating visual richness need to be weighed against this request-reduction goal. When you need visual richness, additional steps can be taken -- aggregating JS files, using CSS sprites, etc. -- but visual richness does tend to run counter to a slender HTTP request pipeline.