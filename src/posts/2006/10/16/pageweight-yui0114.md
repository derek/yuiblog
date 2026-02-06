---
layout: layouts/post.njk
title: "YUI: Weighing in on Pageweights"
author: "Eric Miraglia"
date: 2006-10-16
slug: "pageweight-yui0114"
permalink: /blog/2006/10/16/pageweight-yui0114/
categories:
  - "Development"
---
When we opened up the [YUI Library](http://developer.yahoo.com/yui/) in February, [we talked about](/yuiblog/blog/2006/02/17/developing-a-javascript-library-for-yahoo/) some of our motivations for creating an entirely new JavaScript toolkit. One of those motivations, we said, was that Yahoo!'s diverse engineering communities demanded a solution that was lightweight, one that could be applied _à la carte_ without unnecessary k-weight overhead.

With YUI now encompassing three CSS foundation libraries, six utilities and nearly a dozen UI controls, we thought it would be a good time for a progress report on library size, page weights, and YUI's _à la carte_ architecture. (**Note:** This article focuses almost exclusively on pageweight, which itself is only one element of overall performance. Filesizes described here are based on YUI's 0.11.4 release.)

### Three Ways to Evaluate Filesize

JavaScript and CSS files exist in three different states, each with unique size profiles:

1.  **Full code source, including comments and whitespace:** YUI, like most open-source JavaScript libraries, includes full-source files in its distribution. These files are formatted for developer readability and include extensive function-level comments to facilitate automated generation of API documentation. These files tend to be very large.
2.  **Minified source:** YUI components are also distributed in minified form — minification meaning that comments, whitespace, and line breaks have been removed from the file. (Douglas Crockford's [JSMin](http://www.crockford.com/javascript/jsmin.html) and the [Dojo Compressor](http://dojotoolkit.org/docs/compressor_system.html) are among the tools we use for this purpose.) **YUI Library JavaScript files are reduced in size by more than 60% through minification alone.**
3.  **Minified, gzipped source sent over the wire:** At Yahoo!, we evangelize the practice of serving all JavaScript and CSS files using gzip compression (a bandwidth-saving technique supported across the [A-Grade browsers](http://developer.yahoo.com/yui/articles/gbs/gbs_browser-chart.html)). Gzipping reduces overall data transmission dramatically, and it is the minified, gzipped payload that ultimately determines the file's weight on the wire. **YUI Library JavaScript files are reduced in size by more than 90% through the process of minification and gzipping combined.**

Here is a filesize profile of the YUI Library JavaScript utilities' core files in (1) full, (2) minified, and (3) minified/gzipped form.

#### Filesize Profile of YUI Utilities in Full, Minified and Minified/Gzipped Forms

![Chart: Filesize of YUI utilies JavaScript files in full, minified, and minified/gzipped profiles.](/yuiblog/blog-archive/assets/pageweight/filesize_by_type.gif)

**Note:** This chart does not include dependencies; the file sizes here are for each utility's core source file only.

The data-transmission savings gained from minification and gzipping are dramatic — a document loading the entire YUI utility suite would incur 232.5KB in additional pageweight if serving the fully-commented source; that weight drops to _less than 20KB_ when the files are minified and served with gzip compression, a savings of 91.9%. In assessing library weight, we focus primarily on filesizes after minification and gzipping, as that is the truest measure of how much data needs to be transmitted to the browser. It's worth reiterating, however, that this is only one part of the larger performance story.

### Weighing Individual YUI Components When Used _à la Carte_

One of the most important metrics for us in evaluating the success of YUI's _à la carte_ strategy is the aggregate filesize of each component, including its dependencies. All YUI JavaScript components require the [Yahoo Object](http://developer.yahoo.com/yui/yahoo/); most also require [Event](http://developer.yahoo.com/yui/event/) and [Dom](http://developer.yahoo.com/yui/dom/). The dependency tree beyond those foundations is more diverse. **Including all JavaScript dependencies** (even optional dependencies), what is the cost in transmitted filesize to include a single YUI component when serving the minified files and gzipping the payload sent to the browser?

#### _À la Carte_ Pageweight of Individual YUI JavaScript Components, Including All Dependencies

![Chart: Kweight of individual YUI components, including dependencies.](/yuiblog/blog-archive/assets/pageweight/infographic.gif)

**Note:** Optional dependencies can have a significant impact on overall pageweight. Container, for example, can make use of Connection Manager for wiring Dialog Controls to the server via XHR; it can also use Drag & Drop to enable draggable Panels and Dialogs and Animation effects when showing and hiding Panels. Those three optional components account for nearly 40% of Container's pageweight in the chart above. The Panel implementation used above to show the large-format version of the chart image omits all of these optional effects, and as a result requires only 20.8KB of transmitted YUI JavaScript. (Component filesizes represented in the chart do not include CSS resources.)

Because of YUI’s _à la carte_ architecture, even the heaviest component is roughly half the weight of the image containing the chart above. Looking at the single dimension of weight-on-the-wire, then, we feel comfortable that YUI is succeeding in one of its core goals: allowing implementers to choose specific richly interactive elements on a page-by-page basis without unduly inflating pageweight.

### The YUI CSS Foundation

This summer, we began including in YUI three core CSS resources — [Reset](http://developer.yahoo.com/yui/reset/), [Fonts](http://developer.yahoo.com/yui/fonts/), and [Grids](http://developer.yahoo.com/yui/grids/) — that provide a strong foundation on top of which developers can build semantic, progressively rendered, CSS-driven layouts. The YUI CSS Grids component is a toolkit from which can be assembled more than 130 different wireframes, meeting the needs of a significant subset of page layout projects. And, taken together, this CSS foundation has an aggregate k-weight of just 1.3KB on the wire (minified and gzipped).

For reference, here are the filesize profiles of the YUI CSS foundation files in (1) full, (2) minified, and (3) minified/gzipped forms.

#### Filesize Profile of YUI CSS Foundation Files in Full, Minified and Minified/Gzipped Forms

![Chart: Filesize of YUI CSS foundation files in full, minified, and minified/gzipped profiles.](/yuiblog/blog-archive/assets/pageweight/css_filesize_by_type.gif)

  

### Beyond Filesize

Obviously, there's a great deal to be said about library performance beyond raw k-weight on the wire; this single dimension is an important one, but achieving "performant richness" is a multifaceted problem. Over time, we'll explore some of these additional dimensions here on YUIBlog.