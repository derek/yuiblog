---
layout: layouts/post.njk
title: "Optimizing Yahoo! Search for the iPhone"
author: "Ryan Grove"
date: 2008-08-28
slug: "ysearch-for-iphone"
permalink: /2008/08/28/ysearch-for-iphone/
categories:
  - "Performance"
  - "Development"
---
When we [set out to build](http://wonko.com/post/yahoo-search-brings-search-assist-searchmonkey-and-more-to-the-i) an [iPhone-optimized version of Yahoo! Search](http://search.yahoo.com/i), we wanted to bring [SearchMonkey](http://developer.yahoo.com/searchmonkey/), [![Yahoo! Search with Search Assist, tailored for the iPhone.](/yuiblog/blog-archive/assets/ysearch-iphone.png)](http://search.yahoo.com/i/) Search Assist, and other JavaScript-heavy Yahoo! Search features to the iPhone, but we also wanted the site to be blazing fast even over EDGE, all while reusing as much existing code as possible in order to minimize engineering effort and make maintenance easier. This is how we did it.

### Reduce

Our first task was to remove code that wasn't strictly necessary for the iPhone experience. We were able to eliminate a significant portion of the Search Assist code, and we shaved off even more bytes by rewriting the remainder in an iPhone-specific way rather than the generic, framework-like style of the original code.

Some examples of the kinds of things an iPhone-specific site doesn't need:

-   **Keyboard navigation and shortcuts:** The iPhone doesn't have arrow keys and the keyboard only appears when a text input element has focus, so code that handles keyboard shortcuts and navigation events is unnecessary.
-   **Hover states and mouse movement handlers:** Since the iPhone is a touchscreen device, there's no mouse cursor and thus no way for the user to hover over an element. Mobile Safari fires the `mousemove` and `mouseover` events just before the `mousedown`, `mouseup`, and `click` events, and it fires the `mouseout` event when an element loses focus.
-   **Context menus:** There's no way to right-click or control-click on the iPhone, so the `contextmenu` event cannot be triggered.
-   **Text selection and clipboard handlers:** Sadly, the iPhone does not provide clipboard functionality or a way to select text in an input element, so these handlers are useless.

Rewriting this code instead of reusing the existing code was a tradeoff since it meant we would need to spend more time maintaining it in the future, but the performance gains were worth it: we brought the minified JavaScript weight of the iPhone Search Assist implementation down from 32KB to 2KB (before gzip). Execution speed was also greatly improved by eliminating animations and simplifying the code that requests search suggestions on each keystroke.

After cutting out the unnecessary code, the next step was to make our remaining code as small as possible. The [YUI Compressor](http://developer.yahoo.com/yui/compressor/) made this easy, and we were able to save additional bytes by refactoring our code to follow the advice given in Nicholas Zakas's article _[Helping the YUI Compressor](/yuiblog/blog/2008/02/11/helping-the-yui-compressor/)_, which describes several things you can do to help the YUI Compressor generate even more compact code.

Consider the following example (for the sake of brevity, I've replaced code that doesn't pertain to this example with placeholder comments):

```
YAHOO.namespace('Search');

YAHOO.Search.iPhone = function () {
  // ... private methods ...

  return {
    // ... public methods ...

    toggle: function (el) {
      if (YAHOO.util.Dom.hasClass(el, 'hidden')) {
        YAHOO.util.Dom.removeClass(el, 'hidden');
      } else {
        YAHOO.util.Dom.addClass(el, 'hidden');
      }
    }
  };
}();
```

The YUI Compressor will compress the original 359 bytes to 209 bytes:

```
YAHOO.namespace("Search");YAHOO.Search.iPhone=function(){return{
toggle:function(A){if(YAHOO.util.Dom.hasClass(A,"hidden")){
YAHOO.util.Dom.removeClass(A,"hidden")}else{YAHOO.util.Dom.addClass(A,
"hidden")}}}}();
```

We can compress this code even further by replacing the repeated reference to `YAHOO.util.Dom` with a local variable and by using the more compact ternary operator rather than an `if` statement:

```
YAHOO.namespace('Search');

YAHOO.Search.iPhone = function () {
  var YUD = YAHOO.util.Dom;

  // ... private methods ...

  return {
    // ... public methods ...

    toggle: function (el) {
      var className = 'hidden';

      YUD[YUD.hasClass(el, className) ? 'removeClass' : 'addClass'](el,
        className);
    }
  };
}();
```

This will compress to a mere 173 bytes:

```
YAHOO.namespace("Search");YAHOO.Search.iPhone=function(){
var A=YAHOO.util.Dom;return{toggle:function(C){var B="hidden";
A[A.hasClass(C,B)?"removeClass":"addClass"](C,B)}}}();
```

Optimizations like this are particularly important due to Mobile Safari's cache limitations, which we'll discuss a little later.

### Reuse

Search Assist was the only JavaScript component that we rewrote for iPhone Search; everything else was reused wholesale with no modifications. Two things made this possible:

-   Mobile Safari is a highly capable browser that can do virtually everything its big brother can do.
-   Our existing codebase uses YUI heavily. Since YUI takes care of most cross-browser issues for us, the code works well on all A-grade browsers including Safari and, by extension, Mobile Safari.

One of the most important factors to consider when reusing existing code is that the iPhone's processor is much slower than desktop processors; as a result, JavaScript execution can be tens or even hundreds of times slower. It's a good idea to avoid complex animation, heavy DOM manipulation, and other CPU-intensive operations.

If necessary, refactor your existing code to allow animations to be turned off, use [event delegation](http://developer.yahoo.com/performance/rules.html#events) whenever possible to minimize your DOM event overhead, and always be sure to provide a tag name and root element to YUI Dom Utility methods like [getElementsByClassName](http://developer.yahoo.com/yui/docs/YAHOO.util.Dom.html#method_getElementsByClassName). You'll see performance improvements in desktop browsers as well as Mobile Safari.

### Recycle

In the months after the iPhone was launched, the Yahoo! Exceptional Performance Team (and others outside of Yahoo!) discovered that [Mobile Safari doesn't cache components larger than 25KB](/yuiblog/blog/2008/02/06/iphone-cacheability/) pre-gzip. This presents a bit of a problem for iPhone web apps using YUI since the core YUI components ([YAHOO Global Object](http://developer.yahoo.com/yui/yahoo/), [Dom Collection](http://developer.yahoo.com/yui/dom/), and [Event Utility](http://developer.yahoo.com/yui/event)) weigh in at a combined size of just over 30KB. We wanted to [minimize the number of HTTP requests we made](http://developer.yahoo.com/performance/rules.html#num_http), especially via EDGE, but we also wanted to ensure that our components were cached so the browser wouldn't need to download them on every pageview.

The solution was a tradeoff: We split our components into cache-friendly chunks of less than 25KB. This results in a few additional HTTP requests the first time the user visits the site, but it ensures that the components are cached and don't need to be re-downloaded for future pageviews.

The easiest way to do this is to use the [YUI Dependency Configurator](http://developer.yahoo.com/yui/articles/hosting/), which will automatically create [ComboHandler](/yuiblog/blog/2008/07/16/combohandler/) URLs for the components you select. For example, if your iPhone web app requires YAHOO, Dom, Event, and the [JSON Utility](http://developer.yahoo.com/yui/json/), you can break these dependencies up into two requests, each smaller than 25KB:

```
<script type="text/javascript"
  src="http://yui.yahooapis.com/combo?2.5.2/build/yahoo/yahoo-min.js&2.5.2/build/dom/dom-min.js"></script>
<script type="text/javascript"
  src="http://yui.yahooapis.com/combo?2.5.2/build/event/event-min.js&2.5.2/build/json/json-min.js"></script>

```

One catch: the YUI Configurator will try to include `yahoo-min.js` in each generated URL since all YUI libraries depend on it. There's no need to load this file twice, so be sure to manually remove it from all but the first URL you generate.

### Rejoice

Thanks to Mobile Safari's awesomeness, YUI's abstraction of browser compatibility issues, YUI Compressor's excellent minification routines, and ComboHandler's ability to aggregate multiple components into cache-friendly chunks, it only took us two weeks to build [Yahoo! Search for iPhone](http://search.yahoo.com/i). The end result is snappy even on slow EDGE network connections.