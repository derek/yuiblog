---
layout: layouts/post.njk
title: "YUI 3.0 Preview Release 1"
author: "Eric Miraglia and Matt Sweeney"
date: 2008-08-13
slug: "yui3pr1"
permalink: /2008/08/13/yui3pr1/
categories:
  - "Development"
---
[![YUI 3.0 Preview 1 website.](/yuiblog/blog-archive/assets/yui3.png)](http://developer.yahoo.com/yui/3/)The YUI team is pleased to announce the public availability of [YUI 3.0 Preview Release 1](http://developer.yahoo.com/yui/3/), an early look at what we're working on for the next generation of the YUI Library. [Documentation for YUI 3.0](http://developer.yahoo.com/yui/3/) is on the YUI website; the download is available on the [YUI project area on SourceForge](http://sourceforge.net/projects/yui/); you can find us with questions or comments on [the YUI 3.x discussion forum](http://tech.groups.yahoo.com/group/yui3/). Keep in mind that this is an early preview, not a production-quality (or even a beta) release. This release is not suitable for production use, but it will give you an idea of what we're working on, and it should provide a good framework for conversation about the future of the library.

### Five Goals for YUI 3:

We've talked to thousands of YUI users over the past 30 months, and based on that feedback we've set five design goals for the next generation of the library. What you've told us is that YUI 3.0 should be:

-   lighter (less K-weight on the wire and on the page for most uses)
-   faster (fewer http requests, less code to write and compile, more efficient code)
-   more consistent (common naming, event signatures, and widget APIs throughout the library)
-   more powerful (do more with less implementation code)
-   more securable (safer and easier to expose to multiple developers working in the same environment; easier to run under systems like [Caja](http://code.google.com/p/google-caja/) or [ADsafe](http://adsafe.org/))

With this early release, we've made progress toward most of these objectives — and we believe we have the right architecture in place to meet all five as we move to GA over the next few quarters.

### What's New in YUI 3.0?

When you start to write code using YUI 3.0, you'll notice some changes in structure and style. Here's a taste:

<table border="1" width="100%"><tbody><tr><td>Snippet:</td><td>What it does:</td></tr><tr><td><pre>YUI().use('node', function(Y) {
    Y.get('#demo').addClass('enabled');
});
</pre></td><td>Creates a YUI instance with the <code>node</code> module (and any dependencies) and adds the class "enabled" to the element with the <code>id</code> of "demo".</td></tr><tr><td><pre>YUI().use('dd-drag', function(Y) {
        var dd = new Y.DD.Drag({
        node: '#demo'
    });
});</pre></td><td>Creates an instance of YUI with basic drag functionality (a subset of the <code>dd</code> module), and makes the element with the <code>id</code> of "demo" draggable.</td></tr><tr><td><pre>Y.all('.demo').addClass('enabled');</pre></td><td>Adds the class "enabled" to the all elements with the <code>className</code> "demo".</td></tr><tr><td><pre>Y.all('.demo').set('title', 'Ready!').removeClass('disabled');</pre></td><td>Sets the title attribute of all elements with the <code>className</code> "demo" and removes the class "disabled" from each.</td></tr><tr><td><pre>Y.get('#demo').plug(Y.Plugin.Drag, {
    handles: 'h2'
});</pre></td><td>Adds the <code>Drag</code> plugin to the element with the <code>id</code> "demo", and enables all of its <code>h2</code> children drag as handles.</td></tr><tr><td><pre>Y.on('click', function(e) {
    e.preventDefault();
    e.target.query('em').set('innerHTML', 'clicked');
}, '#demo a');</pre></td><td>Attaches a DOM event listener to all anchor elements that are children of the element with the <code>id</code> "demo". The event handler prevents the anchor from navigating and then sets a value for the <code>innerHTML</code> of the first <code>em</code> element of the clicked anchor.</td></tr></tbody></table>

What's different here?

-   _Sandboxing:_ Each YUI instance on the page can be self-contained, protected and limited (`YUI().use()`). This segregates it from other YUI instances, tailors the functionality to your specific needs, and lets different versions of YUI play nicely together.
-   _Modularity:_ YUI 3 is architected to use smaller modular pieces, giving you fine-grained control over what functionality you put on the page. If you simply want to make something draggable, you can include the `dd-drag` submodule, which is a small subset of the [Drag & Drop Utility](http://developer.yahoo.com/yui/3/dd/).
-   _Self-completing:_ As long as the basic YUI seed file is in place, you can make use of any functionality in the library. Tell YUI what modules you want to use, tie that to your implementation code, and YUI will bring in all necessary dependencies in a single HTTP request before executing your code.
-   _Selectors:_ Elements are targeted using intuitive CSS selector idioms, making it easy to grab an element or a group of elements whenever you're performing an operation.
-   _Custom Events++:_ [Custom Events](http://developer.yahoo.com/yui/3/event/#customevent) are even more powerful in YUI 3.0, with support for bubbling, stopping propagation, assigning/preventing default behaviors, and more. In fact, the Custom Event engine provides a common interface for DOM and API events in YUI 3.0, creating a consistent idiom for all kinds of event-driven work.
-   _Nodes and NodeLists:_ Element references in YUI 3.0 are mediated by [Node](http://developer.yahoo.com/yui/3/node/) and NodeList facades. Not only does this make implementation code more expressive (`Y.Node.get("#main ul li").addClass("foo");`), it makes it easier to normalize differences in browser behavior (`Y.Node.get("#promo").setStyle("opacity", .5);`).
-   _Chaining_: We've paid attention throughout the new architecture to the return values of methods and constructors, allowing for a more compressed chaining syntax in implementation code.

And that's just the beginning. [Dive into the examples](http://developer.yahoo.com/yui/3/examples/) to learn more and to see the preview release in action, including some hidden gems like full A-Grade cross-domain requests. Our resident metahacker Dav Glass created a nice multi-component example, [the draggable portal](http://developer.yahoo.com/yui/3/examples/dd/portal-drag.html), that will give you some sense of what's included in today's preview.

### Is YUI 3.0 Backward Compatible with YUI 2.x?

No. YUI 3.0 builds off of the YUI 2.x codeline, but we've evolved most of the core APIs in working toward the five key goals described above. As a result, migrating from YUI 2.x to 3.x will require effort at the implementation level.

We know that ease-of-migration will be a critical factor for all YUI users. We're taking two important steps to facilitate the transition as it arrives:

-   **Limited compatibility layer:** YUI 3.0 will ship with a limited compatibility layer for the current YUI Core (Yahoo Global Object, Dom Collection, and Event Utility). This will allow you to run many of your YUI 2.x-based implementations on top of YUI 3.0. We're not shipping the compatibility layer with today's preview, but you'll see it appear in a future preview or beta release prior to GA.
-   **Full parallel compatibility:** YUI 3.0 can be run in parallel to YUI 2.x with no side effects for either version. If you choose to make the transition in stages, you can run the full 2.x stack and 3.x stack together as needed.

Even with these provisions in place, we know that an API change (along with new concepts and idioms) has a real cost for everyone involved. We're convinced that this change is both necessary and worth the effort, and obviously we're going to work hard to make the value proposition compelling.

### What's Next?

YUI 3.0 is a work in progress. The common widget framework for 3.0 is not included in this preview and we're continuing to work on refinements to the core — including optimizations to the package structure to minimize base K-weight. We anticipate the next two releases coming up as follows:

-   **October 2008 — PR2:** Widget Framework, sample widgets, additional utilities.
-   **December 2008 — Beta 1:** Final mix of module structures, API completion, full complement of utilities.

We have some great stuff to share as we move further along in this process. We've never been more excited about YUI and its future — and we think YUI 3.0 will have a big role to play in that future.