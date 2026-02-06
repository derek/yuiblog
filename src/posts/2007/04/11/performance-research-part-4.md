---
layout: layouts/post.njk
title: "Performance Research, Part 4: Maximizing Parallel Downloads in the Carpool Lane"
author: "Steve Souders"
date: 2007-04-11
slug: "performance-research-part-4"
permalink: /blog/2007/04/11/performance-research-part-4/
categories:
  - "Development"
---
### Parallel Downloads

The biggest impact on end-user response times is the number of components in the page. Each component requires an extra HTTP request, perhaps not when the cache is full, but definitely when the cache is empty. Knowing that the browser performs HTTP requests in parallel, you may ask why the number of HTTP requests affects response time. Can't the browser download them all at once?

The explanation goes back to the HTTP/1.1 spec, which suggests that browsers download two components in parallel per hostname. Many web pages download all their components from a single hostname. Viewing these HTTP requests reveals a stair-step pattern, as shown in Figure 1.

#### **Figure 1.** Downloading 2 components in parallel

![Figure 1. Downloading 2 components in parallel](/yuiblog/blog-archive/assets/performance/two_parallel.gif)

If a web page evenly distributed its components across two hostnames, the overall response time would be about twice as fast. The HTTP requests would look as shown in Figure 2, with four components downloaded in parallel (two per hostname). The horizontal width of the box is the same, to give a visual cue as to how much faster this page loads.

#### **Figure 2.** Downloading 4 components in parallel

![Figure 2. Downloading 4 components in parallel](/yuiblog/blog-archive/assets/performance/four_parallel.gif)

Limiting parallel downloads to two per hostname is a guideline. By default, both Internet Explorer and Firefox follow the guideline, but users can override this default behavior. Internet Explorer stores the value in the Registry Editor. (See [Microsoft Help and Support](http://support.microsoft.com/?kbid=282402).) Firefox's setting is controlled by the network.http.max-persistent-connections-per-server setting, accessible in the about:config page.

It's interesting to note that for HTTP/1.0, Firefox's default is to download eight components in parallel per hostname. Figure 3 shows what it would look like to download these ten images if Firefox's HTTP/1.0 settings are used. It's even faster than Figure 2, and we didn't have to split the images across two hostnames.

#### **Figure 3.** Downloading 8 components in parallel

![Figure 3. Downloading 8 components in parallel](/yuiblog/blog-archive/assets/performance/eight_parallel.gif)

Most web sites today use HTTP/1.1, but the idea of increasing parallel downloads beyond two per hostname is intriguing. Instead of relying on users to modify their browser settings, front-end engineers could simply use CNAMEs (DNS aliases) to split their components across multiple hostnames. Maximizing parallel downloads doesn't come without a cost. Depending on your bandwidth and CPU speed, too many parallel downloads can degrade performance.

If browsers limit the number of parallel downloads to two (per hostname over HTTP/1.1), this raises the question:

### What if we use additional aliases to increase parallel downloads in our pages?

We've seen a couple great blogs and articles written recently on the subject, most notably [Ryan Breen of Gomez](http://www.ajaxperformance.com/?p=33) and [Aaron Hopkins over at Google](http://www.die.net/musings/page_load_time/). Here's another spin. The performance team at Yahoo! ran an experiment to measure the impact of using various numbers of hostname aliases. The experiment measured an empty HTML document with 20 images on the page. The images were fetched from the same servers as those used by real Yahoo! pages. We ran the experiment in a controlled environment using a test harness that fetches a set of URLs repeatedly while measuring how long it takes to load the page on DSL. The results are shown in Figure 4.

#### **Figure 4.** Loading an Empty HTML Document with 20 images using Various Number of Aliases

![Figure 4. Loading an Empty HTML Document with 20 images using Various Number of Aliases](/yuiblog/blog-archive/assets/performance/expt.gif)

**Note:** Times are for cached aliases, empty file cache page loads on DSL (~800 kbps).

In our experiment, we vary the number of aliases: 1, 2, 4, 5, and 10. This increases the number of parallel downloads to 2, 4, 8, 10, and 20 respectively. We fetch 20 smaller-sized images (36 x 36 px) and 20 medium-sized images (116 x 61 px). To our surprise, increasing the number of aliases for loading the medium-size images (116 x 61px) worsens the response times using four or more aliases. Increasing the number of aliases by more than two for smaller-sized images (36 x 36px) doesn't make much of an impact on the overall response time. On average, using two aliases is best.

One possible contributor for slower response times is the amount of CPU thrashing on the client caused by increasing the number of parallel downloads. The more images that are downloaded in parallel, the greater the amount of CPU thrashing on the client. On my laptop at work, the CPU jumped from 25% usage for 2 parallel downloads to 40% usage for 20 parallel downloads. These values can vary significantly across users' computers but is just another factor to consider before increasing the number of aliases to maximize parallel downloads.

These results are for the case where the domains are already cached in the browser. In the case where the domains are not cached, the response times get significantly worse as the number of hostname aliases increases. For web pages desiring to optimize the experience for first time users, we recommend not to increase the number of domains. To optimize for the second page view, where the domains are most likely cached, increasing parallel downloads does improve response times. The choice depends on which scenario was most typical.

Another issue to consider is that DNS lookup times vary significantly across ISPs and geographic locations. Typically, DNS lookup times for users from non-US cities are significantly higher than those for users within the US. If a good percentage of your users are coming from outside the US, the benefits of increasing parallel downloads is offset by the time to make many DNS lookups.

Our rule of thumb is to increase the number of parallel downloads by using at least two, but no more than four hostnames. Once again, this underscores the number one rule for improving response times: reduce the number of components in the page.