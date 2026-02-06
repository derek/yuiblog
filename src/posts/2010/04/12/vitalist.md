---
layout: layouts/post.njk
title: "Implementation Focus: Vitalist, a Getting Things Done (GTD) Web App Built with YUI 2"
author: "YUI Team"
date: 2010-04-12
slug: "vitalist"
permalink: /blog/2010/04/12/vitalist/
categories:
  - "Development"
---
_**![](/yuiblog/blog-archive/assets/vitalist/headshot.jpg)About the author:**Matt Berg is a co-founder of [Vitalist](http://www.vitalist.com/ "GTD Software Online for Getting Things Done » Vitalist"), the premier web-based productivity manager for GTD. Matt is responsible for the UI and usability of the various Vitalist applications. He has a B.B.A. in MIS from the University of Texas at Austin and has been working on web applications since 2000. You can follow Matt on Twitter at [@mattberg](http://twitter.com/mattberg "Matt Berg on Twitter")_

### About Vitalist

[Vitalist](http://www.vitalist.com/ "GTD Software Online for Getting Things Done » Vitalist") is a powerful personal organization tool that closely follows the popular [Getting Things Done methodology by David Allen](http://www.davidco.com/ "David Allen, Getting Things Done® and GTD®"). With Vitalist, all of your to-dos are online, in GTD format, and ready to be accessed or updated from anywhere.

![](/yuiblog/blog-archive/assets/vitalist/main-small.png)

### Why YUI?

We have been using YUI at Vitalist pretty heavily since around version 2.2.0 — for about three years. Initially we ended up choosing YUI out of the available JavaScript frameworks for two major reasons: documentation and code footprint. To this day, I feel YUI continues to lead the pack in both of those areas.

With user interfaces getting more complex everyday, another major benefit of YUI is the number of available utilities and widgets. And at Vitalist we are taking full advantage, using the following components (version 2.8.0r4): [animation](http://developer.yahoo.com/yui/animation/), [autocomplete](http://developer.yahoo.com/yui/autocomplete/), [browser history](http://developer.yahoo.com/yui/history/), [calendar](http://developer.yahoo.com/yui/calendar/), [compressor](http://developer.yahoo.com/yui/compressor/), [connection](http://developer.yahoo.com/yui/connection/), [cookie](http://developer.yahoo.com/yui/cookie/), [CSS fonts](http://developer.yahoo.com/yui/fonts/), [CSS reset](http://developer.yahoo.com/yui/reset/), [datasource](http://developer.yahoo.com/yui/datasource/), [dom](http://developer.yahoo.com/yui/dom/), [drag and drop](http://developer.yahoo.com/yui/dragdrop/), [element](http://developer.yahoo.com/yui/element/), [event](http://developer.yahoo.com/yui/event/), [json](http://developer.yahoo.com/yui/json/), [logger](http://developer.yahoo.com/yui/logger/), [menu](http://developer.yahoo.com/yui/menu/), [selector](http://developer.yahoo.com/yui/selector/), [swf](http://developer.yahoo.com/yui/swf/), [tooltip](http://developer.yahoo.com/yui/container/tooltip/), [yahoo](http://developer.yahoo.com/yui/yahoo/).

### Obsession with Performance and Responsiveness

Early on at Vitalist we decided to go the rout of loading most of the necessary components and data on the initial visit to our main application. This was done for two reasons, UI responsiveness and ease of offline setup. Let's focus on responsiveness.

While in theory it's simple, having JavaScript handle basically all of our UI generation definitely added some complexities. For example, the speed of appending and traversing the DOM is of the utmost importance. Something as simple as adding a root element to the `getElementsByClassName` function boosts performance significantly. And sometimes we had to sacrifice programmatic convenience for speed. While the [YUI 2 Selector Utility](http://developer.yahoo.com/yui/selector/ "YUI 2: Selector Utility") can be very powerful, we originally found `getElementsByClassName` to be faster. (With the latest releases of YUI 2, the Selector Utility performance seems to have increased quite a bit, but we still default to `getElementsByClassName` when possible to boost performance — especially in browsers that have native support, which [YUI 2's Dom Utility](http://developer.yahoo.com/yui/dom/ "YUI 2: Dom Collection") leverages.)

![](/yuiblog/blog-archive/assets/vitalist/autocomplete-small.png)

[YUI 2 AutoComplete](http://developer.yahoo.com/yui/autocomplete/ "YUI 2: AutoComplete") powers one of the newer features of Vitalist, released in the last year or so, but it has also been one of the hardest implementations in terms of responsiveness and browser CPU usage. In our initial attempt, every time we needed a new autocomplete control for an input we would create a new instance, destroying it once it was no longer needed. This typically happens when moving from "page" to "page" (keep in mind, all of our "pages" are just client-generated screens). Internet Explorer struggled with this, often pegging the CPU at 100% and effectively bringing the computer to a halt. This forced us to turn off autocomplete support for IE. Two key changes helped us create a more efficient autocomplete. First, we create just a few generic instances of the autocomplete that can be shared from "page" to "page". Then the only update necessary is setting a new DataSource, which in our implementation requires less CPU effort. Number two, pay attention to the `maxResultsDisplayed` property. Because we allow the full autocomplete list to be displayed without any input (we also added the down arrow key to show the list), we initially set the `maxResultsDisplayed` to an arbitrarily large number like 10,000. Simply changing this number to the length of our actual datasource resulted in significant CPU performance gains.

![](/yuiblog/blog-archive/assets/vitalist/logger-small.png)

For monitoring performance on the front-end, we use the [YUI 2 Logger Control](http://developer.yahoo.com/yui/logger/ "YUI 2: Logger"). When in debug mode, we output many log updates detailing the various steps of JavaScript processing. One great thing about the logger is the fact that it keeps a timestamp of when it was last updated. This has been very helpful when trying to figure out the bottlenecks in our code. And for more of the server side performance monitoring, [YSlow](http://developer.yahoo.com/yslow/ "Yahoo! YSlow for Firebug") has also been very helpful in making sure we are generating http requests as fast as possible.

### Most Interesting Implementation Feature

![](/yuiblog/blog-archive/assets/vitalist/dragdrop-small.png)

Personally, I had the most fun implementing drag and drop in Vitalist (using [YUI 2 Drag and Drop](http://developer.yahoo.com/yui/dragdrop/ "YUI 2: Drag & Drop")). Drag and drop actually serves two purposes in Vitalist for the same drag element. First, we use it for manually re-sorting lists; secondly, we use it for moving tasks between lists. To accomplish this, two different drop target "zones" are used: one for the list elements in the content and one for the list elements in the left sidebar menu.

The interesting part here is the two different zones function quite differently. When dragging in the content area, we want the drag element to constantly move the hovered element and append the drag element in the new location. In the menu area, we don't want to anything to shift, but we do want to highlight the menu selection we are hovering over. Here is a code snippet from the onDragOver method:

```
if (destElNodeName === "li") {
	orig_p = srcEl.parentNode;
	p = destEl.parentNode;
	
	if (!_D.hasClass(p.parentNode, "nav")) {
		if (this.goingUp) {
			p.insertBefore(srcEl, destEl);
		} else {
			p.insertBefore(srcEl, destEl.nextSibling);
		}
	} else {
		_D.removeClass(_S.query("#sidebar .nav:not(.alt) li"), "drag");
		_D.addClass(destEl, "drag");
	}

	_DDM.refreshCache();
}

```

### Building Vitalist components with YUI Compressor

![](/yuiblog/blog-archive/assets/vitalist/admin-small.png)

Related to our obsession with performance, we created a web front-end that uses the [YUI Compressor](http://developer.yahoo.com/yui/compressor/ "YUI Compressor") in conjunction with some other scripts to build the various JavaScript and CSS components used throughout Vitalist. This ensures we are keeping the smallest code footprint possible for each of the major sections of our site. And as you may know, keeping the number of http requests as low as possible helps on page load times, so combining JavaScript and CSS files where possible can help a great deal.

Some background is necessary here. Vitalist has its own core set of JavaScript utilities and CSS that are shared across all of the major sections of the site. Each individual section (such as the main application, iPhone-optimized application, or marketing site) has its own specific JavaScript and CSS.

So the basics of the build process are as follows: First, the global JavaScript and CSS files are minified using YUI Compressor. Then, for each section, the various JavaScript and CSS files are minified, and then combined with the global file to create one single file. In addition, each section only requires certain components of YUI, so each of the required pieces are combined into a single YUI file, further reducing the number of files needed.

### What's Next?

The next major project with Vitalist using YUI will be upgrading to the [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") framework. With version 3.1.0's ability to use legacy YUI 2 components easily, it's time to make the move.

If you are interested in learning more about Vitalist, please check out our website: [www.vitalist.com](http://www.vitalist.com). Also, feel free to email us at [support@vitalist.com](mailto:support@vitalist.com) with any questions you may have.