---
layout: layouts/post.njk
title: "\"AutoGrid\" for YUI Grids — Using JavaScript to Create Adaptive Grids"
author: "Unknown"
date: 2008-06-25
slug: "autogrids"
permalink: /blog/2008/06/25/autogrids/
categories:
  - "Development"
---
I love [YUI Grids](http://developer.yahoo.com/yui/grids/). I know my CSS and I know how to work around different problems of browsers, but I am also very much bored about having to fix and test and create these workarounds over and over again. While YUI Grids might not be perfect for all cases of web development out there, I am happy to take a pragmatic approach and just create sites that can be done with them (now you also know why I am not a designer).

One problem I keep having when I put some YUI Grids-based sites live is that people complain about me expecting a certain screen resolution or viewport size. YUI grids can either be 100% wide, which can be pretty silly on high resolutions, or optimized for resolutions of either 800x600 or 1024x768. When you optimize for 800 pixels people on higher resolutions will complain about the length of the page and when you go for 1024 people will say they have to scroll to see your side-bar on 800x600. You can't win.

Or can you? CSS is not dynamic — it has a fixed state and you can only hope that the browser does the right thing with what you give it (well, there are conditional comments for IE, but technically they are HTML, and of course there are media queries in CSS3 and other goodies, but for the sake of the argument let's say supporting IE6 is a base). JavaScript, on the other hand, is very dynamic and you can read out and check what is happening to the browser currently in use and react to it.

Putting this feature of JavaScript to good use you can create a YUI-Grids-based layout that remains flexible and changes according to needs. All you need to do is use some [YUI Dom](http://developer.yahoo.com/yui/dom/) magic and change IDs and classes accordingly.

YUI Grids come in several flavours of overall width, defined by the ID on the container DIV:

-   #doc - 750px centered (good for 800x600)
-   #doc2 - 950px centered (good for 1024x768)
-   #doc3 - 100% fluid (good for everybody)
-   #doc4 - 974px fluid (good for 1024x768)
-   #doc-custom - custom width

One thing to remember here is that even `doc3` has a minimum width of 750 pixels, which is why for a fully flexible grid you need to override that:
```
#doc3{
  min-width:0;
}
```

Inside the container DIV you can have two blocks, and their width and the position of the side bar is defined by the class on the container DIV:

-   .yui-t1 - Two columns, narrow on left, 160px
-   .yui-t2 - Two columns, narrow on left, 180px
-   .yui-t3 - Two columns, narrow on left, 300px
-   .yui-t4 - Two columns, narrow on right, 180px
-   .yui-t5 - Two columns, narrow on right, 240px
-   .yui-t6 - Two columns, narrow on right, 300px

Putting these together you can create a plan for your flexible grid:

-   When the available screen space is larger than 950 pixels, use doc2 and the widest sidebar — either left or right
-   If you have less than 950 pixels, use doc and the medium size sidebars
-   If you have less than 760 pixels, use doc3 and the smallest sidebars
-   If you have even less — say 600 pixels — at your disposal, show the side bar below the main content

The script to allow for this is not really rocket science. All it needs to do is read out the grids settings, the width of the available browser window and then change the IDs and classes accordingly.

```
YAHOO.example.autoGrid = function(){
  var container = YAHOO.util.Dom.get('doc') || 
                  YAHOO.util.Dom.get('doc2') || 
                  YAHOO.util.Dom.get('doc4') || 
                  YAHOO.util.Dom.get('doc3') ||
                  YAHOO.util.Dom.get('doc-custom');
  if(container){
    var sidebar = null;
    var classes = container.className;
    if(classes.match(/yui-t[1-3]|yui-left/)){
       var sidebar = 'left';
    }
    if(classes.match(/yui-t[4-6]|yui-right/)){
       var sidebar = 'right';
    }
    function switchGrid(){
      var currentWidth = YAHOO.util.Dom.getViewportWidth();
      if(currentWidth > 950){
        container.id = 'doc2';
        if(sidebar){
          container.className = sidebar === 'left' ? 'yui-t3' : 'yui-t6';
        }
      }
      if(currentWidth < 950){
        container.id = 'doc';
        if(sidebar){
          container.className = sidebar === 'left' ? 'yui-t2' : 'yui-t5';
        }
      }
      if(currentWidth < 760){
        container.id = 'doc3';
        if(sidebar){
          container.className = sidebar === 'left' ? 'yui-t1' : 'yui-t4';
        }
      }
      if(currentWidth < 600){
        container.id = 'doc3';
        container.className = '';
      }
    };
    switchGrid();
    /* 
      Throttle by Nicholas Zakas to work around MSIE's resize nasties.
      http://www.nczonline.net/blog/2007/11/30/the_throttle_function
    */
    function throttle(method, scope) {
      clearTimeout(method._tId);
        method._tId= setTimeout(function(){
        method.call(scope);
      }, 100);
    };
    YAHOO.util.Event.on(window,'resize',function(){
      throttle(YAHOO.example.autoGrid.switch,window);
    });
    
  };
  return {
    switch:switchGrid
  };
}();
```

Let's go through it step by step:

```
YAHOO.example.autoGrid = function(){
  var container = YAHOO.util.Dom.get('doc') || 
                  YAHOO.util.Dom.get('doc2') || 
                  YAHOO.util.Dom.get('doc4') || 
                  YAHOO.util.Dom.get('doc3') ||
                  YAHOO.util.Dom.get('doc-custom');
  if(container){

```

First we check if there is actually a YUI Grid in the current document, by testing for the presence of the correct IDs. If there is, we execute the rest of the code.

```
    var sidebar = null;
    var classes = container.className;
    if(classes.match(/yui-t[1-3]|yui-left/)){
       var sidebar = 'left';
    }
    if(classes.match(/yui-t[4-6]|yui-right/)){
       var sidebar = 'right';
    }
```

We define `sidebar` as null, retrieve the class name of the container element and check if there was a column structure defined. In addition to the preset YUI Grids classes we also defined `yui-left` and `yui-right` here. These styles allow you to not have a sidebar without the script functionality but to get one once the script determines that there is enough space for one.

```
    function switchGrid(){
      var currentWidth = YAHOO.util.Dom.getViewportWidth();
      if(currentWidth > 950){
        container.id = 'doc2';
        if(sidebar){
          container.className = sidebar === 'left' ? 'yui-t3' : 'yui-t6';
        }
      }
      if(currentWidth < 950){
        container.id = 'doc';
        if(sidebar){
          container.className = sidebar === 'left' ? 'yui-t2' : 'yui-t5';
        }
      }
      if(currentWidth < 760){
        container.id = 'doc3';
        if(sidebar){
          container.className = sidebar === 'left' ? 'yui-t1' : 'yui-t4';
        }
      }
      if(currentWidth < 600){
        container.id = 'doc3';
        container.className = '';
      }
    };
    switchGrid();
```

The method `switchGrid()` does all the work we defined. We set up the different cases for applying IDs and classes and call the method immediately after it's been defined.

```
    /* 
      Throttle by Nicholas Zakas to work around MSIE's resize nasties.
      http://www.nczonline.net/blog/2007/11/30/the_throttle_function
    */
    function throttle(method, scope) {
      clearTimeout(method._tId);
        method._tId= setTimeout(function(){
        method.call(scope);
      }, 100);
    };
    YAHOO.util.Event.on(window,'resize',function(){
      throttle(YAHOO.example.autoGrid.switch,window);
    });
```

For full flexibility, we also apply an event listener that re-checks the grid specifications when the user resizes the browser. As Internet Explorer has a nasty habit of firing the resize event while the user resizes the window, we need to throttle the execution of `switchGrid()`. [This is explained in detail on Nicholas Zakas' blog](http://www.nczonline.net/blog/2007/11/30/the_throttle_function).

```
  };
  return {
    switch:switchGrid
  };
}();
```

As the throttle method needs a public method to call from `setTimeout()` we return a pointer to `switchGrid`.

That's all. You can try out the effect [on the demonstration page](/yuiblog/blog-archive/assets/autogrid.html). If you define your sidebar independent of size, you can create some wonderfully dynamic and flexible sites with this little script.