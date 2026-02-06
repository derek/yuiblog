---
layout: layouts/post.njk
title: "Using the TabView Control with My Dispatcher Plugin"
author: "YUI Team"
date: 2008-11-03
slug: "tabview-dispatcher"
permalink: /2008/11/03/tabview-dispatcher/
categories:
  - "Development"
---
This article is about my [Dispatcher Plugin](http://bubbling-library.com/eng/api/docs/plugins/dispatcher) (part of my [Bubbling Library](http://www.bubbling-library.com)) and how to use it along with the [YUI TabView](http://developer.yahoo.com/yui/tabview/) to load on-demand content using the [YUI Connection Manager](http://developer.yahoo.com/yui/connection/). The Bubbling Library doesn't ship with YUI, but it's a free download and licensed under the same BSD terms as is YUI.

### YUI TabView Overview

One of the most compelling components in the [YUI Library](http://developer.yahoo.com/yui/) is the TabView Control. It allows us to maximize the space in our web pages, ordering and segmenting the information and sharing the container (visualization area) at the same time. It’s easy to use as a developer and as an end user because the navigable tabbed views of content represent a well known design pattern in most OSs. Most users feel comfortable using TabView right away.

### A Few Examples

One of my favorite characteristics of the YUI widgets is that they can be used to enhance the DOM in an unobtrusive way with little effort.  The TabView widget is no exception:

```
<div id="demo" class="yui-navset">     
  <ul class="yui-nav">         
    <li class="selected"><a href="#tab1"><em>Tab One Label</em></a></li>         
    <li><a href="#tab2"><em>Tab Two Label</em></a></li>     
  </ul>                 
  <div class="yui-content">         
    <div><p>Tab One Content</p></div>         
    <div><p>Tab Two Content</p></div>

  </div> 
</div>
<script type="text/javascript"> 
var myTabs = new YAHOO.widget.TabView("demo");
</script>
```

([Live demo](http://developer.yahoo.com/yui/examples/tabview/frommarkup.html).)

[![](/yuiblog/blog-archive/assets/tabviewexample.png)](http://developer.yahoo.com/yui/examples/tabview/frommarkup.html)

If Progressive Enhancement isn't relevant in your implementation, you can create a TabView object purely from JavaScript, creating the tabs and rendering them into a specified DOM element. In this case, the content of the tabs will not be available for search engines, which is a drawback, but the content for each tab can be loaded on demand using AJAX or by injecting the HTML code directly during the definition of the tab. Let's see an example:

```
var myTabs = new YAHOO.widget.TabView("demo");
myTabs.addTab( new YAHOO.widget.Tab({   label: 'Tab One Label',   content: '<p>Tab One Content</p>',
  active: true  })); myTabs.addTab( new YAHOO.widget.Tab({   label: 'Tab Three Label',
  content: '<p>Loading, please wait...</p>',   dataSrc: 'tab2.html' }));
myTabs.appendTo(document.body);

```

([Live demo](http://developer.yahoo.com/yui/examples/tabview/fromscript.html).)

This technique is mostly used in dynamic web applications. We can also combine the progressively enhanced and dynamic approaches, creating a tabview with the default content from the markup and then inserting the rest of the tabs on the fly. In this case, each tab will load the content using AJAX. Check out this example:

```
<div id="demo" class="yui-navset">     
  <ul class="yui-nav">         
    <li class="selected"><a href="#tab1"><em>Tab One Label</em></a></li>    
  </ul>                 
  <div class="yui-content">         
    <div><p>Tab One Content</p></div>

  </div> 
</div>
<script type="text/javascript"> 
var myTabs = new YAHOO.widget.TabView("demo");
var tab2 = new YAHOO.widget.Tab({   label: 'Tab Two Label',   content: '<p>Loading, please wait...</p>',
  dataSrc: 'tab2.html'  })
myTabs.addTab( tab2 );myTabs.addTab( new YAHOO.widget.Tab({   label: 'Tab Three Label',   content: '<p>Tab Three Content</p>' }));

</script>
```

TabView uses the [YUI Connection Manager](http://developer.yahoo.com/yui/connection/) to load the content on demand, and it handles all the AJAX logic under the hood. _Keep in mind that the Connection Manager is subjected to the Cross Domain Policy, which means that you can only use URLs within the current domain_. (In [YUI 3.0](http://developer.yahoo.com/yui/3/), the successor to Connection Manager, [the IO Utility](http://developer.yahoo.com/yui/3/io/), provides Flash-based support for cross-domain AJAX \[[demo](http://developer.yahoo.com/yui/3/examples/io/io-xdr.html)\].)

Sometimes we want to create enhanced functionality within the tab content (when a certain tab becomes active), and for this you can use “`contentChange`” or “`beforeContentChange`” events to execute certain actions. We could add this kind of logic to the previous example as follows:

```
<script type="text/javascript">function handleContentChange(e) {    alert('tab2 was loaded...');
  /* you can render a datatable within the tab now :-) */}tab2.addListener('contentChange', handleContentChange);</script>
```

### The Problem

But this approach can introduce certain dependencies and complexity within our code, because the actions for a certain tab’s content will be defined at the page level, which means that if you want change the content of tab, you probably need to change something at the application level as well -- the functionality of the tab's content is not encapsulated with that content.

Creating monolithic contents (on demand content that will encapsulate its own requirements, initialization process and behaviors) seems be a solution, but there is a problem: If you want load a certain content within a tab, and that content has some JavaScript functionality, that functionality will not be executed because. The tab widget will use innerHTML to replace the tab’s content. The browser will then strip out the “script” tags because it's injecting the code within the tab, and that script content will not be executed at all. Generally this is a good thing, as it protects you from one potential vector for XSS attacks. But in the event you need to bring in scripts this way, it's a problem you need to work around. (Keep in mind, though, that working around this puts the responsibility for security squarely on your shoulders. Using the event-driven approach described above is a better, more secure approach for applications where it's possible to use it.)

If you go down the path of bringing scripts into the page with the content of a tab, the good news is that you can use a plugin to delegate the work, and it will handle the AJAX routine to execute and process the CSS and the JavaScript code within the on demand contents. This plugin, from my [Bubbling Library](http://www.bubbling-library.com/), is called “Dispatcher” (`YAHOO.plugin.Dispatcher`), and it has been one of the most popular components from my Bubbling Library Extension.

### YUI Dispatcher Plugin

The complexity of the code will be almost the same as what we've seen above; even the syntax is quite similar. Let’s start with an example:

```
<div id="demo" class="yui-navset">     
  <ul class="yui-nav">         
    <li class="selected"><a href="#tab1"><em>Tab One Label</em></a></li>    
  </ul>                 
  <div class="yui-content">         
    <div><p>Tab One Content</p></div>

  </div> 
</div>
<script type="text/javascript">
var myTabs = new YAHOO.widget.TabView("demo");YAHOO.plugin.Dispatcher.delegate (new YAHOO.widget.Tab({  label: 'Tab Two Label',
  content: '<p>Loading, please wait...</p>',  dataSrc: 'tab2.html'}), myTabs);

myTabs.addTab( new YAHOO.widget.Tab({   label: 'Tab Three Label',   content: '<p>Tab Three Content</p>' }));
</script>
```

The method “`delegate`” will do the job for you in an efficient way. The process is quite simple:

-   The Tab object loads the content using the YUI Connection Manager
-   Before injecting the code using innerHTML, it passes the code to the dispatcher.
-   The dispatcher strips out the JavaScript and CSS code from the content.
-   The dispatcher injects the parsed content (without JavaScript/CSS tags) within the tab area.
-   The dispatcher executes each JavaScript chunk and injects each CSS tag in the order in which they appear. Remote JavaScript and remote CSS will be loaded using the [YUI Get Utility](http://developer.yahoo.com/yui/get/) by default, which means that they are not subjected to the Cross Domain Policy.

[(Live demo.)](http://bubbling-library.com/sandbox/dispatcher/plugin-dispatcher-dynamic-tabs.html)

### Complex Example

Let's look at a more complex example. In this case, the second tab loads some content, and the content defines its own functionality, creating/rendering a [YUI DataTable](http://developer.yahoo.com/yui/datatable/) within it. Exactly the same code from the previous example:

```
<script type="text/javascript">YAHOO.plugin.Dispatcher.delegate (new YAHOO.widget.Tab({  label: 'Tab Two Label',  dataSrc: 'tab2.html'}), myTabs, {
  /* Object literal with the area configuration */
});


</script>

```

And the content of the file "`tab2.html`" should look like this:

```
<link rel="stylesheet" type="text/css" 
href="http://yui.yahooapis.com/2.5.2/build/datatable/assets/skins/sam/datatable.css"><script type="text/javascript" 
src="http://yui.yahooapis.com/2.5.2/build/datasource/datasource-beta-min.js"></script><script type="text/javascript" 
src="http://yui.yahooapis.com/2.5.2/build/datatable/datatable-beta-min.js"></script<script type="text/javascript" 
src="http://bubbling-library.com/sandbox/dispatcher/data.js"></script>
<div id="basic" class="example"></div><script type="text/javascript">var myColumnHeaders = [  {key:"id", sortable:true, resizeable:true},  {key:"quantity", type:"number", sortable:true, resizeable:true},  {key:"amount", type:"currency", sortable:true, resizeable:true},  {key:"title", type:"html", sortable:true, resizeable:true}];var myColumnSet = new YAHOO.widget.ColumnSet(myColumnHeaders);var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.bookorders);myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;myDataSource.responseSchema = {  fields: ["id","quantity","amount","title"]};var myDataTable = new YAHOO.widget.DataTable("basic", myColumnSet, myDataSource);</script>
```

As you can see, the content of "`tab2.html`" is like another page, and the tab object works like an `iframe`. The differences are:

-   There is a single document (less memory and bandwidth used by the browser).
-   The tab is sharing the execution scope with the current document (easy JavaScript integration).
-   There is more flexibility for cosmetics because the container is just another DIV within the current document instead of being an iframe.

[(Live demo.)](http://bubbling-library.com/sandbox/dispatcher/plugin-dispatcher-dynamic-tabs-with-datatable-inside.html)

### Memory Leaks

Now that we can create widgets and add listeners to certain elements within the tab content, we need to keep in eye on the memory management, especially in the tabs where we aren't caching the dynamic content. In those tabs, the content will be loaded multiple times, replacing the old content and executing the scripts again. By default, the dispatcher releases all the listeners in the area before it displays new content using `YAHOO.util.Event.purgeElement.` But sometimes this is not enough.

The destroyer is a hook method and is only available during the execution of the scripts from dynamic content, which means that you can use this within the tab content:

```
YAHOO.plugin.Dispatcher.destroyer.subscribe (function(el, config){   
  // el: HTML Element that grap the tab’s content   
  // config: Object literal with the area configuration */ 
}); 
```

And because the destroyer is a [YUI Custom Event](http://developer.yahoo.com/yui/event/#customevent), you can add multiple listeners to it. The dispatcher plugin fires the Custom Event when you try to load a new content within the same tab.

You can load fresh content within the tab by setting the cache property to false during the creation of the tab, and every time you click on the tab the YUI Connection Manager loads the content again.

At this point, the dispatcher fires the destroyer Custom Event before switching the content of the DIV (tab’s wrapper). Then it will setup a new destroyer object for the new content, and you will be able to add new listeners for the new content.

This technique will allow you to create widgets and destroy them in a more memory-friendly way when the content changes.

[(Live demo.)](http://bubbling-library.com/sandbox/dispatcher/ondestroy-utility.html)

### More Features

The dispatcher plugin is very flexible and has the following features:

-   Load content within a general container (DIV)
-   Browser history integration
-   Loading Mask integration
-   Customize the execution proccess
-   CSS path correction process

### Upcoming Features

-   Layout Manager 2.6.0 integration
-   Form handling (automatic submit process thru Connection Manager)

### Requirements

Include the dispatcher plugin after the connection manager, and don't forget to include the tabview widget as well, but not _necesary before the dispatcher_:

```
<script type="text/javascript" 
src="http://yui.yahooapis.com/2.5.2/build/yahoo-dom-event/yahoo-dom-event.js"></script<script type="text/javascript" 
src="http://yui.yahooapis.com/2.5.2/build/connection/connection-min.js"></script><script type=”text/javascript” 
src=’http://js.bubbling-library.com/1.5.0/build/dispatcher/dispatcher-min.js’></script<script type="text/javascript" 
src="http://yui.yahooapis.com/2.5.2/build/tabview/tabview-min.js"></script>


```

### Troubleshooting

#### Handling Errors (Debugging)

There are two configuration options to handle errors:

```
YAHOO.plugin.Dispatcher.delegate (new YAHOO.widget.Tab({    label: 'Tab Two Label',    dataSrc: 'tabs2.html'}), myTabs, {
    onError: function (el) {      // el: DOM Reference for the area      // when the YUI connection manager call the failure method      // 403, 404, etc    },    error: function (el, jsCode) {      // el: DOM Reference for the area, jsCode: javascript code      // this method get fired when a JS error occur during the execution      // this is for debugging only...    }});

```

[(Live demo.)](http://bubbling-library.com/sandbox/dispatcher/error-handle.html)

#### Anonymous Functions

The dispatcher plugin uses an anonymous function to execute inline scripts, introducing a problem with the global variables. Let’s see an example:

**Original Content:**

```
function myFunc () {   
  // your stuff here 
}
var myVar = 1; 
```

**The dispatcher transforms it into this:**

```
(function() { 
  function myFunc () { 
    // your stuff here 
  } 
  var myVar = 1; 
})();
```

So, “`myFunc`” and “`myVar`” are not global variables and are only accessible within the same script tag.

To tackle this issue, you should use _namespaces_:

```
YAHOO.example.myFunc = function () { 
  // your stuff here 
};
YAHOO.example.myVar = 1;
```

Or the nasty trick to force it to be global:

```
window.myFunc = function () { 
  // your stuff here 
};
window.myVar = 1; 
```

#### **Customizing the execution routine**

There is a configuration argument to customize the evaluation routine. The code should look like this:

```
YAHOO.plugin.Dispatcher.delegate (new YAHOO.widget.Tab({    label: 'Tab Two Label',    dataSrc: 'tabs2.html'}), myTabs, {
    evalRoutine: myCustomEval});
```

In this case, `myCustomEval` should execute the script.

[(Live demo.)](http://bubbling-library.com/sandbox/dispatcher/customizing-inline-execution.html)

### Working Examples

-   [TabView and Dispatcher](http://bubbling-library.com/sandbox/dispatcher/plugin-dispatcher-dynamic-tabs.html)  
    In this example the dispatcher manages the content inside the tabs, executing the scripts (remote and inline "script" tags) during the dataSrc request.
-   [Nested TabViews](http://bubbling-library.com/sandbox/dispatcher/plugin-dispatcher-dynamic-tabview-inside-tabview.html)  
    In this example, we use two different approach: one using the tab's events to modify the loaded content and a second sing the dispatcher to leave the task to the content which is a more flexible approach.
-   [Tabview, DataTable and Dispatcher (**_check the last tab_**)](http://bubbling-library.com/sandbox/dispatcher/plugin-dispatcher-dynamic-tabs-with-datatable-inside.html)  
    In this example the dispatcher manages the content inside a tab to render a YUI Datatable during the dataSrc request.
-   [How to avoid memory leaks](http://bubbling-library.com/sandbox/dispatcher/ondestroy-utility.html)  
    In this example, you can see how the first tab "Datatable Control" define the rules to destroy the YUI Datatable.
-   [More examples here](http://bubbling-library.com/sandbox/dispatcher/index.html).