---
layout: layouts/post.njk
title: "Coming in YUI 3.2.0: SimpleYUI"
author: "Eric Miraglia and Adam Moore"
date: 2010-09-03
slug: "coming-inyui-3-2-0-simpleyui"
permalink: /2010/09/03/coming-inyui-3-2-0-simpleyui/
categories:
  - "Development"
---
_The feature described in this article is available as of YUI 3.2.0pr2, and it will be a part of the upcoming 3.2.0 release. You can start playing with it today by following the code in this article._

SimpleYUI is a new way of loading and instantiating [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library"). The SimpleYUI file contains a rollup of basic Ajax library functionality: DOM tasks, event abstraction, UI effects, and Ajax. Unlike other ways of loading YUI, SimpleYUI creates a YUI instance immediately upon loading and binds all included components to a global `Y` variable. Using SimpleYUI is easy:

```
<script type="text/javascript"
 src="http://yui.yahooapis.com/3.2.0pr2/build/simpleyui/simpleyui-min.js"></script>

<script>
 //Y is ready to use; no instantiation necessary:
 Y.one("#foo").addClass("highlight");
</script>

```

This isn't a "lite" or de-contented version of YUI — you still have access to all of the power and features of the entire library when you start with the SimpleYUI file. However, SimpleYUI does provide a nice convenience by rolling up some common functionality and creating a global instance (`Y`) that's ready to use immediately.

## Work with the DOM

SimpleYUI gives you all of the standard DOM interactions in the YUI 3 API:

```
//get an element reference, add a click handler
Y.one('#demo').on('click', function(e) {/*handle click*/});

//add content to an element
Y.one('#demo').append('Additional content added to #demo.');

//listen for any click on any <li> that descends from #demo:
Y.one('#demo').delegate('click', function(e) {/*handle click*/}, 'li');

//move #demo to the location of any click on the document
Y.one('document').on('click', function(e) {
    	Y.one('#demo').setXY([e.pageX, e.pageY]);
	}
);

```

## Create UI Effects

All of the UI effects that are part of the (new-for-3.2.0) YUI Transition module are available in SimpleYUI:

```
//fade #demo, then remove it from the DOM:
Y.one('#demo').transition({
    easing: 'ease-out',
    duration: 2, // seconds
    opacity: 0
}, function() {
    this.remove();
});

```

## Ajax

SimpleYUI provides the IO module's basic Ajax functionality:

```
// Make an HTTP request to 'get.php':
Y.io('get.php', {
    on: {
        complete: function (id, response) {
            var data = response.responseText; // Response data.
            // ... handle the response ...
        }
    }
});

```

## The rest of YUI is just a use() away

You aren't limited to what comes bundled with SimpleYUI. You can bring in any other YUI 3 component, [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery") module, or [YUI 2](http://developer.yahoo.com/yui/2/ "YUI 2 — Yahoo! User Interface Library") component with a simple `use()` statement at any time.

```
//Use drag and drop, which is not included in the SimpleYUI rollup:
Y.use('dd-drag', function(Y) {
    var dd = new Y.DD.Drag({
        node: '#foo'
    });
});

```

YUI 3 is good about loading anything you need whenever you need it; just master the `use()` statement and you're always just one line of code away from anything in the library that you need.

## Use SimpleYUI when...

-   ...you want to get started fast and learn the ropes of YUI;
-   ...you want to have basic Ajax library functionality available at any time in the life of the page without creating a new YUI instance.

## Don't use SimpleYUI when...

-   ...performance matters more than convenience;
-   ...you want to sandbox portions of your implementation into separate instances;
-   ...you want to be deliberate about when different components load and what the precise module/submodule makeup is on the page.