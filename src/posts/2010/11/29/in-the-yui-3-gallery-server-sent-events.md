---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Server-Sent Events"
author: "Nicholas C. Zakas"
date: 2010-11-29
slug: "in-the-yui-3-gallery-server-sent-events"
permalink: /blog/2010/11/29/in-the-yui-3-gallery-server-sent-events/
categories:
  - "Development"
---
Push notifications on the web are increasing in popularity, as evidenced by the excitement over [Web Sockets](http://www.w3.org/TR/websockets/), and with good reason. The web is moving towards more accurate and up-to-date information as audiences turn to the Internet for real-time updates of stocks, news, sports, and more. While Web Sockets represents a giant leap forward in the realm of push notifications, there is a lesser-known spec that can be considered a small jump forward: [Server-Sent Events](http://dev.w3.org/html5/eventsource/).

Server-Sent Events (SSE) are also targeted at making push notifications easier by building on top of the techniques that developers are already using. As opposed to Web Sockets, SSE uses regular HTTP to communicate with the server and allows you to decide whether to use [HTTP streaming](http://en.wikipedia.org/wiki/Comet_%28programming%29#Streaming), [long polling](http://en.wikipedia.org/wiki/Comet_%28programming%29#Ajax_with_long_polling), or even regular polling to retrieve new data (though this isn't recommended).

At the heart of SSE is the `EventSource` object. The [YUI 3 Gallery EventSource](http://yuilibrary.com/gallery/show/eventsource) module creates a cross-browser implementation of `EventSource`, bringing support for Server-Sent Events to all browsers that support the `XMLHttpRequest`, including Internet Explorer 6, while falling back to the native implementation in browsers that have it (currently Safari 5, Chrome 7, and Opera 10.7).

The `EventSource` interprets a response as an event stream (signified by a content type of "text/event-stream") and fires appropriate events. There are three predefined events:

-   `open` - fires when the connection with the server has been established.
-   `message` - fires when a new message is received from the server. The `event.data` property contains the new data.
-   `error` - fires when an error occurs in processing the event stream. Once this event fires, no further events will be processed and the server connection is permanently closed.

The event stream itself is plain text data made up of the keyword "data:" followed by some data on a single line. If you wish to have multiple lines, you must include more rows with "data:" prefixes. A empty line is considered the boundary between events. Here's a simple example:

```
data: hello

data: hello
data: world

```

Two `message` events are fired with this event stream. The first has `event.data` set to "hello" while the second has `event.data` set to "hello\\nworld" (note the new line).

Here's an example of creating a new `EventSource` instance:

```
YUI({
    gallery: 'gallery-2010.11.17-21-32'
}).use('gallery-eventsource', function(Y) {
 
    var src = new Y.EventSource("stream.php");
 
    src.on("open", function(event){
        console.log("Connection opened!");
    });
 
    src.on("message", function(event){
        console.log("Data received: " + event.data);
    });
 
    src.on("error", function(event){
        console.log("Error!");
    });
 
});

```

The constructor accepts a single argument, which is the URL of the event stream. The interesting and useful part of `EventSource` is that it will automatically reconnect to the server if the connection is lost for any reason. Doing so frees developers from needing to worry about disconnecting and reconnecting, a frequent complaint when using `XMLHttpRequest` for push notifications.

Even though the YUI 3 Gallery EventSource module matches the specification with support for HTTP streaming, long polling, and regular polling, not all browsers support all three. Internet Explorer (up to and including version 9) does not support HTTP streaming, while it can easily handle long or regular polling. The recommended usage of this module is to build your experience with a long polling implementation for best performance and compatibility.

If you'd like to optimize for browsers that support HTTP streaming, the module sets a special `X-YUIEventSource-PollOnly` header when it detects a browser that can't use HTTP streaming. You can check for this header on the server to determine the correct way to serve data. Here's an example implementation using JSP:

```
<%@page contentType="text/event-stream" buffer="none"%>
<%

    //check for poll-only header
    String header = request.getHeader("X-YUIEventSource-PollOnly");

    //check every so often to see if there's new data
    while(true) {        

        //sleep for a second - simulate waiting for data
        Thread.sleep(1000);        

        //output the current time, ensure there are two trailing newlines
        out.print("data: " + (new java.util.Date()).toString() + "x\n\n");
        out.flush();

        //if it's a poll-only request, break the loop, 
        //which ends the request - the client will reconnect
        if (header != null){
            break;
        }
    }
%>
```

It's fairly easy to migrate existing long polling solutions to use SSE, provided the data format is simple. Since the format of event streams is line-based, that could mean reformatting some data to sit on a single line instead of multiple lines.

While SSE will never have the same performance characteristics as Web Sockets due to using HTTP, it does represent a logical evolution of push notifications in browsers. SSE can replace older `XMLHttpRequest`\-based solutions with less code and better error handling, all while keeping the same authentication paradigm.

The YUI 3 Gallery EventSource module implements almost all of the SSE spec (you can see in the source code which parts are not yet implemented by searching for "TODO" comments). This is because some of the features are vaguely described. The module supports the following features:

-   Simple events (fire `message` event).
-   Custom events (fire an event matching the name specified in "event:")
-   Event IDs (captured in `event.lastEventId` and sent to the server)

The parts that have yet to be implemented are support for reconnection times and the `event.origin` property. Otherwise, everything else should behave the same as the native implementation.

### Further Reading

-   [Introduction to Server-Sent Events](http://www.nczonline.net/blog/2010/10/19/introduction-to-server-sent-events/)
-   [The Long Journey of Server-Sent Events](http://my.opera.com/core/blog/eventsource)