---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Ryan Grove's Storage Lite Cross-Browser Storage Library"
author: "Ryan Grove"
date: 2010-02-23
slug: "gallery-storage-lite"
permalink: /2010/02/23/gallery-storage-lite/
categories:
  - "Development"
---
With more and more browsers adding support for the [HTML5 Web Storage API](http://dev.w3.org/html5/webstorage/), the future is looking good for web applications that need persistent client-side data storage. Unfortunately, maintaining compatibility with older browsers that don't yet support Web Storage can be a challenge, and dropping support for older browsers is rarely an acceptable option.

The [Storage Lite YUI 3 Gallery module](http://yuilibrary.com/gallery/show/storage-lite), which was developed for use on [Yahoo! Search](http://search.yahoo.com/), aims to solve this problem by providing a simple, lightweight API wrapper for a variety of persistent client-side storage mechanisms with no external plugin dependencies of any kind (not even Flash). It weighs in at about 2.6KB after minification and before gzip, is similar to the HTML5 localStorage API, and works in IE6+, Firefox 2+, Safari 3.1+, Chrome 4+, and Opera 10.5+.

Apart from being based on YUI 3, Storage Lite differs from the existing [YUI 2 Storage Utility](http://developer.yahoo.com/yui/storage/) in several ways. YUI 2 Storage is a robust and extensible implementation that stays more faithful to the HTML5 localStorage and sessionStorage APIs (for example, it provides a change event and a `key()` method, which Storage Lite does not). YUI 2 Storage also falls back on Flash or Gears storage for older browsers, which can in some cases provide better persistence and more storage capacity. Storage Lite trades extensibility and plugin-based fallbacks for lighter weight and better performance, and specifically focuses on emulating only localStorage.

[![Click through to see the example in action.](/yuiblog/blog-archive/assets/storage-lite-20100222-153537.jpg)](http://rgrove.github.com/storage-lite/examples/simple-notepad.html)

Take a look at [this persistent notepad example](http://rgrove.github.com/storage-lite/examples/simple-notepad.html) to see Storage Lite in action, or read through the following non-interactive code sample for a quick tour of the API.

First, include the script:

```
<script src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js&gallery-2010.02.22-22/build/gallery-storage-lite/gallery-storage-lite-min.js"></script>

```

In your implementation code, listen for the `storage-lite:ready` event, which is fired when the storage mechanism is ready for use. After the storage mechanism is ready, you can use the API:

```
YUI().use('gallery-storage-lite', function (Y) {

    // For full compatibility with IE 6-7 and Safari 3.x, listen for the
    // storage-lite:ready event before making storage calls. If you're not
    // targeting those browsers, you can safely ignore this step.
    Y.StorageLite.on('storage-lite:ready', function () {

        // To store an item, pass a key and a value (both strings) to setItem().
        Y.StorageLite.setItem('kittens', 'fluffy and cute');

        // If you set the optional third parameter to true, you can use any
        // serializable object as the value and it will automatically be stored
        // as a JSON string.
        Y.StorageLite.setItem('pies', ['apple', 'pumpkin', 'pecan'], true);

        // To retrieve an item, pass the key to getItem().
        Y.StorageLite.getItem('kittens');    // => 'fluffy and cute'

        // To retrieve and automatically parse a JSON value, set the optional
        // second parameter to true.
        Y.StorageLite.getItem('pies', true); // => ['apple', 'pumpkin', 'pecan']

        // The length() method returns a count of how many items are currently
        // stored.
        Y.StorageLite.length(); // => 2

        // To remove a single item, pass its key to removeItem().
        Y.StorageLite.removeItem('kittens');

        // To remove all items in storage, call clear().
        Y.StorageLite.clear();

    });

});

```

Data stored using Storage Lite is persisted across pageviews and browser restarts\*, and is accessible only from the same domain in which it was stored. Behind the scenes, Storage Lite uses the following storage mechanisms, automatically choosing the best one that's supported:

-   **Firefox 3.5+, Chrome 4+, Safari 4+, IE8, Opera 10.5+:** [HTML5 localStorage](http://dev.w3.org/html5/webstorage/) — these modern browsers all support the core localStorage functionality defined in the HTML5 draft.
-   **Firefox 2.x and 3.0.x**: [Gecko globalStorage](https://developer.mozilla.org/en/DOM/Storage), an early API similar to HTML5’s localStorage.
-   **Safari 3.1 and 3.2**: [HTML5 Database Storage](http://developer.apple.com/safari/library/documentation/iPhone/Conceptual/SafariJSDatabaseGuide/Introduction/Introduction.html), because Safari 3.1 and 3.2 don’t support HTML5 localStorage.
-   **IE6, IE7**: [userData persistence](http://msdn.microsoft.com/en-us/library/ms531424%28VS.85%29.aspx), a rarely used IE feature for associating string data with an element on a web page and persisting it between pageviews.

For more details, see the [Storage Lite GitHub project](http://github.com/rgrove/storage-lite) and the [API reference](http://rgrove.github.com/storage-lite/docs/StorageLite.html).

\* Caveat: IE6 and IE7 persist data across pageviews, but not across browser restarts.