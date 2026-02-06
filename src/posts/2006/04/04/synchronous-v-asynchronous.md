---
layout: layouts/post.njk
title: "Synchronous v. Asynchronous"
author: "Douglas Crockford"
date: 2006-04-04
slug: "synchronous-v-asynchronous"
permalink: /blog/2006/04/04/synchronous-v-asynchronous/
categories:
  - "Development"
---
XMLHttpRequest can operate synchronously or asynchronously. Many people prefer to use it synchronously. When used this way, the JavaScript engine is blocked until the interaction with the server is complete. Because it blocks, the flow of control looks a lot like an ordinary function invocation. Temporal complexity is abstracted away, leaving a very familiar and comfortable programming pattern. It works particularly well when the server is on the same machine, or nearby on the LAN. Unfortunately, it can perform very badly if the server is under heavy load, or if the browser is connected to the server over a slow link. Because the JavaScript engine is blocked until the request completes, the browser will be frozen. The user cannot cancel the request, cannot click away, cannot go to another tab. This is extremely bad behavior.

Fortunately, XMLHttpRequest provides an option for asynchronous operation. When you set the `asyncFlag` flag to `true`, the JavaScript engine does not block. Instead the request returns immediately, with a potential action that will be triggered later when the result on the request is known. The [Yahoo! Connection Manager](http://developer.yahoo.com/yui/connection/index.html) provides a very nice interface for this.

```
var cObj = YAHOO.util.Connect.asyncRequest('GET', 'http://myservice.com?req=update', {
    success: function (response) {
        alert(response.responseText);
    },
    failure: function (response) {
        alert(response.statusText);
    }
});
```

You supply two functions. Your `success` function contains everything that should happen as a result of the request succeeding. So if the request was to obtain some [JSON](http://developer.yahoo.com/common/json.html) text which should be delivered to the `app.update` method, then your `success` function could be

```
    success: function (response) {
        app.update(eval('(' + response.statusText + ')'));
    }
```

Asynchronous programming is slightly more complicated because the consequence of making a request is encapsulated in a function instead of following the request statement. But the realtime behavior that the user experiences can be significantly better because they will not see a sluggish server or sluggish network cause the browser to act as though it had crashed. Synchronous programming is disrespectful and should not be employed in applications which are used by people.