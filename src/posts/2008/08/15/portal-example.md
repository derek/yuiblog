---
layout: layouts/post.njk
title: "A Closer Look at YUI 3.0 PR 1: Dav Glass's Draggable Portal Example"
author: "Eric Miraglia"
date: 2008-08-15
slug: "portal-example"
permalink: /2008/08/15/portal-example/
categories:
  - "Development"
---
[YUI 3.0 Preview Release 1](http://developer.yahoo.com/yui/3/) was made available on Wednesday, and with it we provided a look at how the next major iteration of YUI is taking shape. Among the elements we shipped with the preview is a new example from [Dav Glass](http://blog.davglass.com/), the [Draggable Portal](http://developer.yahoo.com/yui/3/examples/dd/portal-drag.html), which exercises a broad cross section of the preview's contents.

[![The Portal Example in the YUI 3.0 preview release.](/yuiblog/blog-archive/assets/portal.png)](http://developer.yahoo.com/yui/3/examples/dd/portal-drag_source.html)

The Draggable Portal is a common design pattern in which content modules on the page can be repositioned, minimized, removed, and re-added to the page. The state of the modules persists in the background, so a reload of the page or a return to the page calls up the modules in their most recently positioned state. You see variations of this design pattern on many personlizable portals like [My Yahoo](http://my.yahoo.com), [NetVibes](http://netvibes.com/), and [iGoogle](http://google.com/ig).

In this article, we'll take a look under the hood of this example to get a richer sense of YUI's 3.x codeline and the idioms and patterns it establishes. We're just pulling out some specific code snippets to examine here, but you can review the full code source for [this example](http://developer.yahoo.com/yui/3/examples/dd/portal-drag.html) — [and for 66 others](http://developer.yahoo.com/yui/3/examples/) — on [the YUI 3 website](http://developer.yahoo.com/yui/3/).

### Self-completion and Sandboxes

A core concept in YUI 3.x is that you generally work with _instances_ of YUI rather than global objects. The first line of the Draggable Portal illustrates a pattern that will grow familiar with use of YUI 3.x:

```
//Use loader to grab the modules needed
YUI().use('dd', 'anim', 'easing', 'io', 'cookie', 'json', function(Y) { ...

```

YUI here is being instantiated and a set of modules is requested (`dd`, `anim`, etc.). The resulting YUI instance is passed to the last argument of `use`, which is a callback function. The callback is called once YUI has verified that all of the necessary modules are present. There are some important concepts here:

1.  **"Self completing" installation:** If any of the modules needed is not yet on the page, the built-in Loader will retrieve it (before executing your dependent code).
2.  **Optimized loading:** By default, any modules that need loading will be fetched in a single HTTP request using combo-handling. This means that you can load a very small YUI "seed" on most pages and let YUI fetch additional resources as needed while still having very few HTTP requests and good performance.
3.  **Sandboxing:** The argument passed to the callback function, `Y` by convention, is the YUI instance. This instance can be separate from other YUI usage throughout the page. This allows you to compartmentalize your YUI usage with as many sandboxes as you require. Down the road, this will also make it possible to have multiple versions of YUI 3.x running safely on the same page. (YUI 3.x and 2.x can always live together safely.)

**More Reading:** You can explore all of these issues in more depth on [the User's Guide for the YUI module](http://developer.yahoo.com/yui/3/yui/) — the basic building block of YUI 3.x.

### The Power of Selectors

John Resig's [jQuery](http://jquery.com/) was among the first JavaScript libraries to demonstrate the power and intuitiveness of a selector-driven syntax, and since that time most major libraries have implemented CSS selector support for element targeting (YUI 2.x's [Selector Utility](http://developer.yahoo.com/yui/selector/) provides this functionality in the current codeline). YUI 3.x moves selector syntax onto center stage, making it the preferred idiom for referring to elements on the page.

You'll see this throughout the Draggable Portal code and throughout all YUI 3.x implementations, but here's one example of its use. On initialization, we need to get a reference to all of the `ul` elements that can contain content modules. The pattern is that we want every `ul` with the classname `list` that is a descendant of the element `#play` (where `Y` is a YUI instance):

```
var uls = Y.all('#play ul.list');
```

The return value of this method is a NodeList — a collection of Nodes — another core feature of YUI 3.x.

**More Reading:** There is a brief section on Node selector queries on the [Node User's Guide](http://developer.yahoo.com/yui/3/node/#node-query).

### Working with Nodes, Nodelists, and Event Facades

One of the first things you'll notice in your work with YUI 3.x is that the normalization of DOM and event interfaces is managed through Node and NodeList objects, which you interact with as though they were HTMLElements, and event facades, which you interact with as though they were DOM event objects.

In the Draggable Portal, the `_nodeClick` function uses Nodes and events to handle the logic that processes a click on the _minimize_ and _close_ icons at the top of each module:

```
//Handle the node:click event
var _nodeClick = function(e) {
    //Is the target an href?
    if (e.target.test('a')) {
        var a = e.target, anim = null, div = a.get('parentNode').get('parentNode');
        //Did they click on the min button
        if (a.hasClass('min')) {
            //Get some node references
            var ul = div.query('ul'),
                h2 = div.query('h2'),
            h = h2.get('offsetHeight'),
            hUL = ul.get('offsetHeight'),
            inner = div.query('div.inner');
            
            //Create an anim instance on this node.
            anim = new Y.Anim({
                node: inner
            });
            //Is it expanded?
            if (!div.hasClass('minned')) {
                //Set the vars for collapsing it
                /*snip*/
            } else {
                //Set the vars for expanding it
                /*snip*/
            }
            //Run the animation
            anim.run();

        }

         /*snip*/
        //Stop the click
        e.halt();
    }
};
```

`_nodeClick` is an event handler and it receives an event facade as its first argument (`e`). This event facade, which we treat like a standard DOM event object, has the standard assortment of properties and methods — and where those properties and methods are divergently implemented across A-Grade browsers, they've been normalized. This allows you to use standard DOM-scripting idioms — as you see in `_nodeClick`'s first line of code, `if(e.target...)`, which addresses the target element of the DOM click event.

But in that line, you also see evidence that `e.target` is not an HTMLElement but rather a Node instance. Node permits you to modify properties (`mynode.set("innerHTML", "New contents."`) and also to do powerful things like execute the `test` method, as we're doing here:

```
if (e.target.test('a')) {/*do something*/}
```

Here, we're using `test` which takes as its argument a CSS selector and returns `true` if this Node matches the selector string. If the Node instance corresponds to an anchor element, the test will pass.

Elsewhere in `_nodeClick` you'll see more usage of the Node instance. For example, Node is used to test whether the event target has a specific CSS classname applied...

```
if (a.hasClass('min')) {...}
```

...and to gather Node references for all the `h2` descendants of a given Node:

```
h2 = div.query('h2');
```

In the examples above, `a` and `div` are existing Node instances. In the second example, if there are multiple `h2` descendants of `div` a NodeList object will be returned instead of a single Node; a NodeList is a powerful object that lets you intrinsically batch operations on a group of Nodes.

### Custom Events: Now, with Bubbles

Another significant development in YUI 3.x is the implementation of bubbling in the Custom Event system. Custom Events and DOM events converge in 3.x, sharing a common syntax (in fact, DOM events are wrapped in Custom Events). Like DOM events, Custom Events can bubble and, as such, they can be subjected to the suppression of default behavior (`preventDefault`) and their propagation can be interrupted by script (`stopPropagation`).

In the Draggable Portal, we see Custom Events being used this way. A simple `stopper` function is created that stops the propagation of an event (generically, working for both DOM and Custom Events because of their shared interface):

```
var stopper = function(e) {
   e.stopPropagation();
};
```

Later, this method is applied to Custom Events provided by the Drag and Drop Utility:

```
dd.on('drag:end', stopper);
```

In the Portal, this technique is used to stop the propagation (bubbling) of drag events when an item is dragged into the canvas from the left column. In those cases, the item "transforms" into a module during the drag and then uses the drag events for the module. Once that happens, the drag events from its initial, left-column state are suppressed. By stopping the propagation of the event, an event handler that is listening for the `drag:end` event at a higher level in the application will not fire.

You'll find as you work with YUI 3.x that this subtle change to Custom Events is surprisingly useful and powerful as you wire together disparate modules that need to work together in your application.

**More Reading:** Read more about the Node object on the [Node User's Guide](http://developer.yahoo.com/yui/3/node/); read more about [the new Event Utility](http://developer.yahoo.com/yui/3/event/) on its User's Guide, and check out [the event-bubbling example showing the bubbling properties of custom events](http://developer.yahoo.com/yui/3/examples/event/event-ce.html).

### Fetching Cross-Domain JSON Data Without XSS

In this first preview release, we're primarily revamping the architecture of YUI's utility layer, and that focus trumps new functionality for the most part. But we're also beginning to add in some of the next-generation features that YUI implementers have been asking for. One of those features is a safe, ubiquitously supported mechanism for doing cross-domain requests (XDR) wherein JSON (or other) data can be safely fetched from another domain without the intervention of a server-side proxy.

In the Draggable Portal, all of the RSS feeds are being fetched via [Yahoo! Pipes](http://pipes.yahoo.com/) using YUI's new XDR support. In 3.x, [the IO Utility](http://developer.yahoo.com/yui/3/io/) replaces [Connection Manager](http://developer.yahoo.com/yui/connection/) as the broker of in-page HTTP requests. And IO makes use of Flash and External Interface to provide a safe, reliable XDR implementation. Here's what the code looks like.

First, IO is configued to use Flash for XDR, and we tell it where to find our `.swf` file:

```
//Setup the config for IO to use flash
Y.io.transport({
    id: 'flash',
    yid: Y.id,
    src: 'assets/io.swf'
});
```

When creating the request itself, the syntax feels very much like a traditional operation using Connection Manager:

```
//The Yahoo! Pipes URL
var url = 'http:/'+'/pipes.yahooapis.com/pipes/pipe.run...';
//Start the XDR request
var id = Y.io(url, {
    method: 'GET',
    xdr: { 
        use:'flash'
    },
    //XDR Listeners
    on: { 
        success: function(id, data) {
            //On success get the feed data
            var d = feeds[trans[id]],
            //Node reference
            inner = d.mod.query('div.inner'),
            //Parse the JSON data
            oRSS = Y.JSON.parse(data.responseText),
            html = '';
            
            //Did we get data?
            if (oRSS && oRSS.count) {
                //Walk the list and create the news list
                Y.each(oRSS.value.items, function(v, k) {
                    if (k < 5) {
                        html += '<li><a href="' + v.link + '" target="_blank">' + v.title + '</a>';
                    }
                });
            }
            //Set the innerHTML of the module
            inner.set('innerHTML', '' + html + '');
            if (Y.DD.DDM.activeDrag) {
                //If we are still dragging, update the proxy element too..
                var proxy_inner = Y.DD.DDM.activeDrag.get('dragNode').query('div.inner');
                proxy_inner.set('innerHTML', '' + html + '');
                
            }
        },
        failure: function(id, data) {
            //Something failed..
            alert('Feed failed to load..' + id + ' :: ' + data);
        }
    }
});
```

**More Reading:** You can [learn more about the IO Utility from it's User's Guide](http://developer.yahoo.com/yui/3/io/). To learn more about XDR using IO, check out the [Cross Domain JSON Transaction example](http://developer.yahoo.com/yui/3/examples/io/io-xdr.html).

### More to Explore

There's a lot more to Dav's [Draggable Portal](http://developer.yahoo.com/yui/3/examples/dd/portal-drag.html) example, and there are [dozens of examples](http://developer.yahoo.com/yui/3/examples/) on the [YUI 3.x website](http://developer.yahoo.com/yui/3/) — we invite you to explore those in more detail as time permits. We're looking forward to your feedback on the YUI 3.x discussion forum. In the meantime, we have our heads down on the next projects on the [roadmap](http://developer.yahoo.com/yui/articles/roadmap/), including the 2.6.0 release, improved platforms for community contributions, and subsequent preview releases of 3.x incorporating additional functionality and your feedback.