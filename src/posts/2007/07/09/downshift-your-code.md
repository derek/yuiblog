---
layout: layouts/post.njk
title: "Downshift Your Code"
author: "YUI Team"
date: 2007-07-09
slug: "downshift-your-code"
permalink: /blog/2007/07/09/downshift-your-code/
categories:
  - "Development"
---
Web browsers have advanced to the point where things happen fairly fast across the board. Events are fired fast, user interactions can be registered fast, code executes fast. All this speed is typically a good thing, as it keeps modern web applications zipping along at a steady clip. But sometimes fast is actually too fast. Sometimes, you simply can't let something happen multiple times in a second due to complex calculations or major UI shifts that occur.

As a concrete example, consider the resize event. In most browsers, the resize event fires after the user has finished resizing the window, meaning that the event is fired once for each window resize. Internet Explorer, on the other hand, fires the resize event continuously as the user is resizing the browser. If you have anything more than some simple calculations being applied during onresize, it's possible to end up confusing IE by having too much going on (especially if the event handler does any UI manipulations). The solution is to throttle your code so that a method is called a maximum number of times per second. This can be achieved using timeouts and a little bit of indirection. The basic pattern is as follows:

```

YAHOO.namespace("example");

YAHOO.example.MyObject = {

    _timeoutId : 0,
    _process : function () {
        //processing code goes here
    },

    process : function () {
        clearTimeout(this._timeoutId);
        var me = this;
        this._timeoutId = setTimeout(function(){
            me._process();
        }, 250);
    }
};

```

This object contains two "private" members, `_timeoutId` and `_process()`, which should not be accessed from outside of the object (if you want to make them truly private, you can use [Crockford's Module Pattern](/yuiblog/blog/2007/06/12/module-pattern/)). The `_timeoutId` property stores a timeout ID that is used to control how often `_process()`, the method doing all the processing, is called. The `process()` method is the one that should be called externally because it controls how often the processing can occur. The first step in this method is to clear the timeout represented by `_timeoutId`, then, it creates a new timeout to call `_process()`. This sequence makes it impossible for `_process()` to be called more frequently than every 250 milliseconds while assuring that `_process()` will be called no later than 250 milliseconds after the last call to `process()`. The maximum number of times `_process()` can be called is four times a second (using 250 milliseconds as the timeout period). You can, of course, adapt this time depending on your particular needs.

It isn't recommended that you use this in all of your methods because the technique uses closures and does have a performance penalty. However, if you are having trouble because a certain method is being called too frequently, throttling the processing can result in significant performance improvements.