---
layout: layouts/post.njk
title: "Loader Usage at Quorus"
author: "Peter Abrahamsen"
date: 2011-03-24
slug: "loader-usage-at-quorus"
permalink: /blog/2011/03/24/loader-usage-at-quorus/
categories:
  - "Development"
---
Today, I'd like to talk about [YUI Loader](http://developer.yahoo.com/yui/3/yui/#loader) and how we at [Quorus, Inc.](http://www.quorus.com/), use it to provide third-party websites with new features on demand.[![Quorus screenshot](/yuiblog/blog-archive/assets/loader-at-quorus/quorus-screenshot.png)](http://quorus.com)

The code we write powers features on other peoples' pages, meaning we're in the unenviable position of having not only no control over the browser environment, but heavy restrictions in how we use the document itself. Our customers put a Quorus bootstrap script on their pages; everything else needed for our functionality is loaded dynamically and on demand. We go to heroic lengths to make sure that our elements, styles, and scripts do not alter the behavior of anything we're not responsible for.

We started our present code base two years ago, when YUI 3 was just taking shape. It was a risky decision at the time to commit to a codebase that wouldn't hit beta for several months. In retrospect I can't imagine how we would have accomplished what we have without it. I haven't seen any other framework that has components approaching the power of Loader, [Attribute](http://developer.yahoo.com/yui/3/attribute/), and [CustomEvent](http://developer.yahoo.com/yui/3/event/#customevent).

The Quorus **bootstrap script** we provide to our customers does almost nothing. Its job is just to load the core of our platform without blocking the rest of page load, and to queue any API calls until we've done so. This core script file, called **stage2**, inlines `yui`, `loader`, and `oop`, as well as enough smarts to load additional libraries to respond to API calls, user clicks, and other conditions in the operating environment. Most other resources are served by a custom combo server that serves custom Quorus and stock YUI modules.

`Bootstrap` queues up API calls made in the host site's code between when it loads and when we're ready to go in an array on our global object, QUORUS:

```
QUORUS._callbacks = [];
QUORUS.use = function () {
  // turn the arguments object into a regular array,
  // so that it can be stored safely
  var args = Array.prototype.slice.call(arguments, 0);
  QUORUS._callbacks.push(args);
};

```

Once we're ready to process API calls, `stage2` runs them one by one in timeouts. This ensures we yield control regularly back to the browser, which makes the user experience more responsive. The behavior is a lot like Y.AsyncQueue, but simpler and doesn't require YUI to be loaded:

```
// Put the real 'use' function in place for any subsequent calls:
QUORUS.use = function (feature, callback) {
  YUI.use('module-that-provides-the-feature', function (Y) {
    // find the API for the requested feature, and pass it to the callback
    callback(Y.APIs[feature]);
    // process another pending API call, if any:
    setTimeout(processAPICall, 0);
  });
};

// Play catch-up, running each callback in sequence:
function processAPICall () {
  var callback = QUORUS._callbacks.shift();
  if (callback) {
    QUORUS.use.apply(QUORUS, callback);
  }
}

// Start processing the queue:
processAPICall();

```

The `bootstrap` file is, by this point, mostly immutable: it's something we hand off to a customer, who might require a month or more to deploy any new version we gave them—an impossibly long time for an agile startup company. The `stage2` file, meanwhile, is small, loads from our own servers, and has a short cache lifetime. This ensures that no end user will have an old version for more than a few minutes. Nearly all the other resources we need are in permanently cacheable JavaScript libraries and CSS files.

When we release a new version of our code, `stage2` automatically directs browsers to start downloading from a new location, ensuring that they use only the newest code. This setup allows us to deploy changes quickly without serving up assets more often than necessary. Not only does this keep our bandwidth costs low, but it provides a better user experience: the cached resources load very quickly while the page is loading.![Quorus JS loading flow diagram](/yuiblog/blog-archive/assets/loader-at-quorus/quorus-load-flow.png)

If we were starting our codebase today, with the benefit of the [YUI Gallery](http://yuilibrary.com/gallery/show), there are a number of components we might use to make our lives easier. One of them is Eric Ferraiuolo's [Base Component Manager](http://yuilibrary.com/gallery/show/base-componentmgr), which assists with wiring up components (typically Widgets) on demand. Another might be [Storage Lite](http://yuilibrary.com/gallery/show/storage-lite), to help us retain application state across page loads.

Many thanks to the YUI team for their great work, and to the community for their contributions. If you would like to read about our approaches to sandboxing or to coordinating asynchronously loaded components, please let me know in the comments!

![Peter Abrahamsen](/yuiblog/blog-archive/assets/loader-at-quorus/peter-abrahamsen.png)_**About the author:** Peter Abrahamsen writes Ruby and JavaScript, manages server infrastructure, and studies user-centered design in Seattle, Washington, USA. He can be found on [IRC](http://yuilibrary.com/irc/) as Rainhead._