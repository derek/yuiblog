---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: The Preload Module"
author: "Caridy Patino"
date: 2010-06-10
slug: "gallery-preload"
permalink: /2010/06/10/gallery-preload/
categories:
  - "Development"
---
A few weeks ago, Stoyan Stefanov ([@stoyanstefanov](http://twitter.com/stoyanstefanov/)) published the result of [his research about preloading components in advance without executing them](http://www.phpied.com/preload-cssjavascript-without-execution/). This technique can help improve the performance of successive pages that make use of the cached resources.

To leverage these results, we decided to port it to [YUI 3](http://developer.yahoo.com/yui/3/) with a new module called "[gallery-preload](http://yuilibrary.com/gallery/show/preload)", which is now available through the YUI Loader.

Let’s see a [preload example](http://caridy.github.com/examples/gallery-preload/simple.html):

```
YUI({
    //Last Gallery Build of this module
    gallery: 'gallery-2010.05.05-19-39'
}).use('gallery-preload', function(Y) {
  Y.preload ([
    'http://tools.w3clubs.com/pagr2/1.sleep.expires.png',
    'http://tools.w3clubs.com/pagr2/1.sleep.expires.js',
    'http://tools.w3clubs.com/pagr2/1.sleep.expires.css'
  ]); 
});
```

**How does this module improve the user experience?**

Nowadays, web applications have a large footprint in terms of JavaScript, CSS and images. Most of files in each of these categories are static and can be served through a CDN for cacheability. Once any of these files gets downloaded and cached, the browser doesn't need to download the same file in successive requests for the same page. But still, we have a big impact in the initial page request.

Recent studies suggest that 0.1 second \[100ms\] is about the limit for having the user feel that the system is reacting instantaneously; more than that will make the user impatient (Jakob Nielsen). The same is true for the loading process. We need or make our applications run fast in order to stay ahead of our user's expectations.

With web applications like _Facebook_ or _Gmail_, the user usually has to log-in first. This is a classic scenario in which "preloading" makes sense. We can estimate that every user will spend between 5 and 10 seconds interacting with a form. During this time, our application is doing nothing. If we can use this time to load cacheable files in background, those files will be available in cache when the user completes the login process — because we know where s/he is going next, we know exactly what s/he will need. In general, any web application with predictable user paths (including form workflows) can leverage this technique.

This technique is not a new one, but, as Stoyan pointed out, it's hard to do it without executing the scripts or injecting the CSS or displaying the images themselves; there is a cost associated with these post-load steps, and we should avoid paying that cost. Also, in some cases, these files will not play nicely with the initial page. In order to avoid conflicts and minimize the time to put a solution in place, we would need to guarantee that these files get included in the cache without using them in the current page.

This process needs to be completely harmless, and even if the user navigates or stops the loading process before the files get downloaded and cached, the fallback is always in place — the destination page will try to load the file directly.

**The following code shows how to implement this approach using the `gallery-preload` module:**

```
YUI({
    //Last Gallery Build of this module
    gallery: 'gallery-2010.05.05-19-39'
}).use('event-focus', 'gallery-preload', function(Y) {
  // waiting until the user focuses on an input element to start loading assets
  Y.on("focus", function() {
    Y.preload ([
      'http://tools.w3clubs.com/pagr2/2.sleep.expires.png', 
      'http://tools.w3clubs.com/pagr2/2.sleep.expires.js', 
      'http://tools.w3clubs.com/pagr2/2.sleep.expires.css'
    ]);
  }, ".myform input.query");
});
```

In this example, the script waits until the user focuses on one of the form input elements to start loading assets that will be used in the form's target page. This will improve the loading time of the page once the user submits the form.

**[Check the differences](http://caridy.github.com/examples/gallery-preload/profiler-entry.html) between accessing a page directly, and preloading a set of YUI 2/YUI 3 components ahead of time:**

![](/yuiblog/blog-archive/assets/preload/without-cache.jpg)

![](/yuiblog/blog-archive/assets/preload/with-cache.jpg)

Including few lines of codes to preload this set of components allows this page to load four times faster. No changes are required in the logic of your application, and no change is required in the target page...an inexpensive and effective performance tweak.

**One more feature:**

We also included a more advanced feature for those who want to be less aggressive. The module includes a built-in integration with [Nicholas Zakas’ Idle Timer module](http://yuilibrary.com/gallery/show/idletimer); Idle Timer allows us to preload files only if the user is inactive for a given period of time. Here is an example:

```
YUI({
    //Last Gallery Build of this module
    gallery: 'gallery-2010.05.05-19-39'
}).use('gallery-preload', function(Y) {
  // preload files only when the user is idle for at least 100ms
  Y.preloadOnIdle ([
    'http://tools.w3clubs.com/pagr2/3.sleep.expires.png', 
    'http://tools.w3clubs.com/pagr2/3.sleep.expires.js', 
    'http://tools.w3clubs.com/pagr2/3.sleep.expires.css'
  ], 100); 
});
```

### Conclusions:

It's important to be ahead of our users. Knowing the workflow of our web applications, and leveraging this preloading technique will help us improve overall user experience. It's also important to do it without increasing the complexity of our applications. [This new component](http://yuilibrary.com/gallery/show/preload) (`gallery-preload`) delivers on both of these goals.