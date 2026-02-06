---
layout: layouts/post.njk
title: "Running YUI 3 Server-Side with Node.js"
author: "Dav Glass"
date: 2010-04-05
slug: "running-yui-3-server-side-with-node-js"
permalink: /2010/04/05/running-yui-3-server-side-with-node-js/
categories:
  - "Development"
---
For those that do not know about [Node.js](http://nodejs.org/), here is how I describe it:

> Node.js is a server-side, non-blocking, event-driven runtime for JavaScript built on top of the [v8 JavaScript engine](http://code.google.com/p/v8/). Think of Node.js as a viable replacement for your server-side scripting language, sitting behind an http server like [Apache](http://httpd.apache.org/) or [nginx](http://nginx.org/).

Recently I've been playing around with Node.js to see what all the excitement was about. So naturally I set out to see what it would take to get [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") to run under Node. Knowing [the architecture behind YUI 3](http://developer.yahoo.com/yui/theater/video.php?v=desai-yui3 "Video: Satyen Desai — YUI3: Design Goals and Architecture (YUI Theater)"), I figured that it wouldn't be too hard to get it running.

Since Node.js does not provide a native DOM, you might wonder, "Why use a JavaScript framework?" Well, YUI 3 is not all about DOM manipulation — it also contains a robust set of class/object management tools, not to mention our powerful custom events. All of these tools are immediately useful in server-side programming.

### Getting Started

First, it should be noted that YUI will be loaded into the global scope in Node.js, because all YUI 3 modules invoke `YUI.add` at the start of the file. The YUI object will assign itself to the `exports` object per the [CommonJS](http://commonjs.org/ "CommonJS: JavaScript Standard Library") specification, but, once a module is used, it needs a global YUI to attach to. (This may be something we work around in the future, but that's the starting point for this exploration.)

The first thing I needed to do was get loader to work. Doing this was pretty simple, I just used the built-in YUI 3 tools. The YUI 3 module system is robust and easy to configure, so using the `YUI.add` method I was able to create a new `get` module. This new module accepted the default parameters for the client-side Get Utility, but instead of creating a script node and including YUI that way it fetches YUI from disk or from the CDN and loads the data into the current process. Here is a simple code snippet that shows how this is done:

```
YUI.add('get', function(Y) {
    Y.Get = function() {};
    Y.Get.script = function(s, cb) {
        var urls = Y.Array(s), url, i, l = urls.length;
        for (i=0; i < l; i++) {
            url = urls[i];
            if (!urls[i].match(/^https?:\/\//)) {
                url = url.replace(/\.js$/, '');
            }
            Y.log('URL: ' + url, 'info', 'get');
            // doesn't need to be blocking, so don't block.
            require.async(url, function (mod) {
                pass(cb);
            });
        }
    };
    //Just putting this is so we don't get errors
    Y.Get.css = function(s, cb) {
        Y.log('Loading CSS: ' + s, 'debug', 'get');
        pass(cb);
    };
});

```

Now that I had Get loading scripts, I wanted to be able to track what it was doing. YUI 3 includes a configuration attribute called `logFn` that allows for logging support in environments where native console logging might not exist. I used this configuration attribute to add an option to the global YUI object that tells YUI that it should use a special function when emitting log messages. Here's a look at that function:

```
logFn: function(str, t, m) {
    t = t || 'info';
    m = (m) ? '(' +  m+ ') ' : '';
    var o = false;
    if (str instanceof Object || str instanceof Array) {
        //Should we use this?
        if (str.toString) {
            str = str.toString();
        } else {
            str = sys.inspect(str);
        }
    }
    // output log messages to stderr
    sys.error('[' + t.toUpperCase() + ']: ' + m + str);
}

```

Now that I had YUI 3 loading and logging messages, the next step was to test the system. I decided to load up my [YQL Gallery module](http://yuilibrary.com/gallery/show/yql "YUI Library :: Gallery :: YQL Query") and try making a [YQL](http://developer.yahoo.com/yql/ "Yahoo! Query Language - YDN") request. This turned out to be easier than I expected. Since the YQL module uses Get, it worked out of the box. Here's a sample console printout of it running a YQL query against my GitHub table.

```
[INFO]: (yui) Module requirements: [ Array ]: 3
[INFO]: (yui) Modules missing: [ Array ]: 3, 3
[INFO]: (yui) Fetching loader: http://yui......oader/loader-min.js
[INFO]: (get) URL: http://yui.yahooapis.co.../loader/loader-min.js
[INFO]: (yui) Module requirements: [ Array ]: 11
[INFO]: (yui) Modules missing: [ Array ]: 8, 8
[INFO]: (yui) Using Loader
[INFO]: (get) URL: http://yui.yahooapis.com/combo?3.1.0/build/du......
...........ild/gallery-yql/gallery-yql-debug.js
[LIFE]: (base) constructor called
[INFO]: (attribute) Attribute constructor called
[LIFE]: (base) init called
[INFO]: (event) yui_3_1_0_1_12703536585676: Firing one:init
[INFO]: (attribute) initValue for initialized:false
[INFO]: (attribute) Adding attribute: initialized
[INFO]: (attribute) initValue for destroyed:false
[INFO]: (attribute) Adding attribute: destroyed
[INFO]: (attribute) Adding attribute: initialized
[INFO]: (event) : Firing one:foo
[INFO]: (event) : one:foo->sub: yui_3_1_0_1_127035365856711
[DEBUG]: (myapp) Foo Fired
[INFO]: (get) URL: http://query.yahooapis.com/v1/public/yql?q=select%20*%20fro.......bles.env&
[INFO]: (event) yui_3_1_0_1_127035365856715: query->sub: yui_3_1_0_1_127035365856716
{ count: '1'
, created: '2010-04-04T04:01:00Z'
, lang: 'en-US'
, updated: '2010-04-04T04:01:00Z'
, uri: 'http://query.yahooapis.com/v1/yql
, results: 
   { user: 
      { 'gravatar-id': 'd5c18055c50c5b34b0163e0bf0dbf59f'
      , name: 'Dav Glass'
      , company: [Object]
      .....
      , blog: 'http://blog.davglass.com/'
      }
   }
}

```

So with all that working as easy as it did, I figured it was time to see about adding support for [YUI 3 IO](http://developer.yahoo.com/yui/3/io/ "YUI 3: IO"). YUI 3's IO module already had support for cross domain requests via a Flash transport. I decided that I would add a new transport just for Node.js. Thomas Sha, the author of IO, was able to make IO accept third-party transports in the same fashion that the Flash transport works. At this point it was easy to integrate with the http connection handling already provided by Node.js. This allows code that designed to run on the XDR transport in the browser to be run on the server — all you need to do is change the transport type, and everything else should work exactly the same.

```
YUI().use('json', 'base', 'io-nodejs', function(Y) {
    var url = 'http:/'+'/yuilibrary.com/gallery/api/user/davglass';
    Y.io(url, {
        xdr: {
            use: 'nodejs'
        },
        on: {
            start: function() {
                Y.log('Start IO', 'info', 'TEST');
            },
            success: function(id, o) {
                Y.log(Y.JSON.parse(o.responseText).userinfo);
            }
        }
    });

```

After getting the IO module to work, I set out to use the library to build something fun. What did I build? I used YUI 3 and Node.js to build a local combo server. In other words, I could use YUI 3 to build a tool that serves YUI 3 combo'd files. This project was surprisingly easy to do as well. The source for the Combo Loader is available from [my GitHub account](http://github.com/davglass/nodejs-yui3loader) and I have a [demo server up here](http://yuiloader.davglass.com:8080/demo/).

All in all, the process of making the core YUI 3 utilities work under Node.js was simple thanks to YUI 3's architecture. The code for my [Node.js YUI 3 module is available in my GitHub repository](http://github.com/davglass/nodejs-yui3) with instructions on how to get it running.

Stay tuned for my next post, when I will talk about some additional experiments I've been pursuing since getting YUI 3 running on Node.js.