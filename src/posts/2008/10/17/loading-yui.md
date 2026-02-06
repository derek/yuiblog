---
layout: layouts/post.njk
title: "Loading YUI: Seeds, Core, and Combo-handling"
author: "Eric Miraglia"
date: 2008-10-17
slug: "loading-yui"
permalink: /blog/2008/10/17/loading-yui/
categories:
  - "Development"
---
![Kweight of common YUI baseline assets.](/yuiblog/blog-archive/assets/loading/core.png)

With [the 2.6.0 release of YUI](/yuiblog/blog/2008/10/01/yui-260/), the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) now supports combo-handling for both JavaScript and CSS files coming off of Yahoo's CDN. YUI Loader is the utility that understands the YUI module structure and dependency list and can load any YUI component on the page on-demand. The addition of combo-handling makes YUI Loader an even more viable option for many implementations, because you're never more than two HTTP requests (one for JS, one for CSS) away from downloading the requirements for any YUI component(s) to your page (not including image assets).

In this short article, I'll take you through three common approaches to loading YUI on the page and review the filesize breakdown and benefits of each approach. All filesizes discussed here are minified and gzipped KB.

## 1\. Using YUI Loader as a Seed File

YUI Loader is a 9.4KB file. It packages the [Yahoo Global Object](http://developer.yahoo.com/yui/yahoo/), the [Get Utility](http://developer.yahoo.com/yui/get/), and the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) engine, including all the dependency metadata required to load additional YUI components on demand. With just YUI Loader on the page, you can load, say, the [TabView Control](http://developer.yahoo.com/yui/tabview/) as follows:

```
// Instantiate and configure Loader:
var loader = new YAHOO.util.YUILoader({

    // Identify the components you want to load.  
    // Loader will automatically identify
    // any additional dependencies required for 
    // the specified components.  We could specify
    // as many components here as we wish:
    require: ["tabview"],

    // The function to call when all script/css resources
    // have been loaded
    onSuccess: function() {
        //This is your callback function; you can use
        //this space to call all of your instantiation
        //logic for the components you just loaded.
        //In this example, we'd instantiate a TabView 
        //Control here:
        var myTabs = new YAHOO.widget.TabView();
    },

    // Combine YUI files into a single request (per file type)
    // by using the Yahoo! CDN's combo-handler.
    combine: true
});

// Load the files using the insert() method.
loader.insert();
```

([Live demo](http://ericmiraglia.com/yui/demos/tabyuiloader.php).)

Loader is the smallest available YUI seed file; from this 9.4KB base, you can bootstrap anything else in the library with a single HTTP request for JavaScript. Let's look at the K-weight profile for this request in which we use YUI Loader as a seed file to bootstrap your JavaScript dependencies for the TabView Control.

![Loading TabView with YUI Loader](/yuiblog/blog-archive/assets/loading/loader-tabview.png)

So, our initial baseline K-weight was 9.4KB; YUI Loader then downloaded the rest of YUI Core ([Dom](http://developer.yahoo.com/yui/dom/) and [Event](http://developer.yahoo.com/yui/event/)) along with [Element](http://developer.yahoo.com/yui/element/) and [TabView](http://developer.yahoo.com/yui/tabview/), all a single 13.3KB download.

## 2\. Using YUI Loader Plus Core as a Seed File

A second common approach to loading YUI is to use the YUI Core (Yahoo, Dom and Event) plus YUI Loader to serve as your seed file. Here's what that might look like on the page:

```
<!-- Combo-handled YUI CSS files: --> 
<link rel="stylesheet" 
type="text/css" 
href="http://yui.yahooapis.com/combo?2.6.0/build/tabview/assets/skins/sam/tabview.css">
<!-- Combo-handled YUI JS files: --> 
<script type="text/javascript" 
src="http://yui.yahooapis.com/combo?2.6.0/build/yuiloader-dom-event/yuiloader-dom-event.js"></script> 
<script>

(function() {
	//create Loader instance:
    var loader = new YAHOO.util.YUILoader({
        require: ["tabview"],
        onSuccess: function() {
        	//when TabView is loaded, instantiate Tabs:
        	var tabView = new YAHOO.widget.TabView('demo');
        },
        combine: true
    });
    
    //When our target element is ready, bring
    //in the non-blocking, combo-handled script
    //download.  We can use Event here because
    //we've loaded YUI Core at the top of the page:
    YAHOO.util.Event.onContentReady("demo", function() {
    	loader.insert();
    });

})();
</script>
```

([Live demo](http://ericmiraglia.com/yui/demos/tabcoreloader.php).)

This seed file is bigger than YUI Loader alone — 17.4KB versus 9.4KB. But it confers some big advantages:

-   You have access to Event Utility's event listener methods and its crucial page-timing methods ([like `onDOMReady` and `onContentReady`](http://developer.yahoo.com/yui/examples/event/event-timing.html)) right away;
-   You have access to the Dom Collection's swiss-army knife of DOM convenience methods right away.

Because most pages in a YUI-driven application are going to use both Event and Dom, this is often a good universal foundation from which to bootstrap YUI-dependent modules.

In the scenario where we're loading TabView, here's how the JavaScript flow breaks down with YUI Loader + YUI Core as our foundation:

![Loading TabView with YUI Loader + YUI Core as a foundation.](/yuiblog/blog-archive/assets/loading/loadercore-tabview.png)

The overall K-weight is about the same as with the simple YUI Loader seed; we have a heavier initial load, but immediate access to the goodness of YUI's Core. And our subsequent HTTP request to complete TabView's JS requirements drops to a small 5.4KB.

## 3\. Combining All Requests in a Single File

Where loading scripts on-demand doesn't make sense for your application (for example, if some of the core interactions on the page have script-driven enhancements that you want to render as quickly as possible), you can still take advantage of combo-handling on the Yahoo CDN by configuring your request on the [Dependency Configurator](http://developer.yahoo.com/yui/articles/hosting/). ([Here's a configuration for TabView using combo-handling](http://developer.yahoo.com/yui/articles/hosting/?tabview&MIN&norollup).)

Here's what that might look like on the page:

```
<!-- Combo-handled YUI JS files: -->
<script type="text/javascript" 
src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/element/element-beta-min.js&2.6.0/build/tabview/tabview-min.js"></script>
<script>
YAHOO.util.Event.onContentReady("demo", function() {
	var myTabs = new YAHOO.widget.TabView("demo");
});
</script>
```

([Live demo](http://ericmiraglia.com/yui/demos/tabsimple.php).)

Best practice according to [Yahoo's Exceptional Performance guidelines](http://developer.yahoo.com/performance/) would be to put this single file as close to the bottom of the page as possible, allowing the content and design to be processed before the browser hits your JS files. (**Note:** this is one reason why you might find approaches 1 and 2 useful — putting the 17.4KB YUI Loader + YUI Core file at the top of your file has minimal performance impact, and it allows you to load other JavaScript-dependent modules `onDOMReady` where appropriate.)

## Summary

The takeaway here is that there are several ways to leverage combo-handling, and YUI Loader's support for combo-handling, to bring the power of YUI into your application with minimal HTTP requests.

Here are some common implementations of YUI components using the combo-handler; this visualization is, again, of minified and gzipped K-weight for the JS dependencies:

![K-weight for common YUI components.](/yuiblog/blog-archive/assets/loading/kweight.png)

Any of these single HTTP requests weighs less on the wire than the image above. [As I've discussed elsewhere](/yuiblog/blog/2006/10/16/pageweight-yui0114/), the _a la carte_ design of YUI means that you can add components to any of these payloads at a big discount because you'll be adding only incremental dependencies. For example, the DataTable payload in the image above could have TabView added to it with just a 3.5KB additional cost. Using YUI Loader and its new combo-handling functionality makes this process even more performant and responsive in your applications.