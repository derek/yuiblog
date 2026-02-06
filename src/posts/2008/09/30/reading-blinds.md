---
layout: layouts/post.njk
title: "Reading Blinds — a YUI-powered Reading Tool"
author: "Christian Heilmann"
date: 2008-09-30
slug: "reading-blinds"
permalink: /blog/2008/09/30/reading-blinds/
categories:
  - "Development"
---
Ever since I got upgraded to a shiny Macbook Pro and a 24 inch monitor at work I had a web experience that differed a lot from what I had before. Web sites that were easy and nice to read out of a sudden showed a massive amount of white space that actually hurt my eyes. Talking to several people with visual impairments and dyslexia at [Scripting Enabled](http://scriptingenabled.org) confirmed me that this can be a real issue.

This is why I thought of writing a small script that can be used as a bookmarklet to cover the screen with a dark overlay and only shows a few lines at a time. That way you can concentrate on the bit you are reading at the moment and the rest of the screen does not bother you too much.

Following are two screenshots of the same site with and without reading blinds:

![Browser with Reading Blinds](/yuiblog/blog-archive/assets/blinds.jpg)

![Browser without Reading Blinds](/yuiblog/blog-archive/assets/withoutblinds.jpg)

So how to build that?

The task of building a tool like that is actually pretty easy:

-   create two DIVs with black background and 85% opacity
-   position them fixed to the top and the bottom of the screen
-   set their height to 10% and 70% to leave a gap

Then I thought that I should be able to move the highlight on the page. For this I needed a bit more sophistication:

-   Detect the mouse cursor position
-   Make the top div span from the current top of the document to a few pixels above the cursor position
-   Make the bottom div span from a few pixels below the current cursor position to the bottom of the viewport

I could have had a go at it myself, but I don't want to end in browser inconsistency hell, hence I use YUI.

Here's the code:

```
var readingblinds = function(){
  var visible = true;
  var y,top,bottom;
  var info = true;
  var size = 70;
  function generate(){
    top = document.createElement('div');
    bottom = document.createElement('div');
    document.body.appendChild(top);
    document.body.appendChild(bottom);
    styleTopBottom();
    var message = document.createElement('div');
    var note = document.createTextNode(
      'Reading Blinds - ' + 
      'move mouse to highlight section to read. ' 
    );
    message.appendChild(note);
    top.appendChild(message);
    styleMessage(message);
    YAHOO.util.Event.on(document, "mousemove", move);
  };
  function move(e){
    y = YAHOO.util.Event.getXY(e);
    if(y[1] > size){
      render(y);
    }
  };
  function render(y){
    var real = y[1]-YAHOO.util.Dom.getDocumentScrollTop();
    YAHOO.util.Dom.setStyle(top,'height',real-size+'px');
    var h = YAHOO.util.Dom.getViewportHeight()-real+size;    
    YAHOO.util.Dom.setStyle(bottom,'top',real+size+'px');
    YAHOO.util.Dom.setStyle(bottom,'height',h + 'px');
  };
  function styleMessage(message){
    YAHOO.util.Dom.setStyle(message,'font-size','80%');
    YAHOO.util.Dom.setStyle(message,'text-align','right');
    YAHOO.util.Dom.setStyle(message,'padding','5px');
    YAHOO.util.Dom.setStyle(message,'font-family','verdana,sans-serif');
    YAHOO.util.Dom.setStyle(message,'color','white');
  }
  function styleTopBottom(){
    YAHOO.util.Dom.batch([top,bottom],function(o){
      YAHOO.util.Dom.setStyle(o,'background','#000');
      YAHOO.util.Dom.setStyle(o,'width','100%');
      YAHOO.util.Dom.setStyle(o,'position','fixed');
      YAHOO.util.Dom.setStyle(o,'left','0');
      YAHOO.util.Dom.setStyle(o,'height','10%');
      YAHOO.util.Dom.setStyle(o,'opacity','.85');
      YAHOO.util.Dom.setStyle(o,'overflow','hidden');
    });
    YAHOO.util.Dom.setStyle(top,'top','0');
    YAHOO.util.Dom.setStyle(bottom,'bottom',0);
    YAHOO.util.Dom.setStyle(bottom,'height','70%');
  };
  return{
    init:generate
  }
}();
readingblinds.init();
```

The interesting methods are `move()` and `render()`; the rest is more or less run-of-the-mill DOM scripting.

The `move()` method is an event handler that gets called by any mousemove event on the document. YUI's Dom Collection then makes it easy for me to get the current mouse cursor position with `getXY()` and I just need to make sure that the mouse is low enough in the browser window to not cause a negative height on the top div.

The `render()` method then sets the appropriate heights. I determine the upper border of the browser with `getDocumentScrollTop()` and substract that one from the cursor position. To determine where to end the bottom div I use `getViewPortHeight()`.

### Addding dazzle with keyboard controls

This was cool enough, but I wanted to be able to turn the blinds on and off and change the size of the visible part with the keyboard, too. For this, I needed to use the keylistener utility some tool methods to resize the gap or show and hide both of the cover divs. The resizing methods needed to get some boundaries to avoid div overlap or the whole viewport to be uncovered.

```
var readingblinds = function(){
  var visible = true;
  var y,top,bottom;
  var info = true;
  var size = 70;
  function generate(){
    top = document.createElement('div');
    bottom = document.createElement('div');
    document.body.appendChild(top);
    document.body.appendChild(bottom);
    styleTopBottom();
    var message = document.createElement('div');
    var note = document.createTextNode(
      'Reading Blinds - ' + 
      'move mouse to highlight section to read. ' +
      'Press "b" to show and hide, "s" to decrease size,' + 
      ' "l" to increase size'
    );
    message.appendChild(note);
    top.appendChild(message);
    styleMessage(message);
    var keyspy = new YAHOO.util.KeyListener(
      document, 
      { keys:66 }, 
      { fn:peekaboo }
    );
    keyspy.enable();
    var keyspy2 = new YAHOO.util.KeyListener(
      document, 
      { keys:83 }, 
      { fn:smaller }
    );
    keyspy2.enable();
    var keyspy3 = new YAHOO.util.KeyListener(
      document, 
      { keys:76 }, 
      { fn:larger }
    );
    keyspy3.enable();
    YAHOO.util.Event.on(document, "mousemove", move);
  };
  function move(e){
    y = YAHOO.util.Event.getXY(e);
    if(y[1] > size){
      render(y);
    }
  };
  function render(y){
    var real = y[1]-YAHOO.util.Dom.getDocumentScrollTop();
    YAHOO.util.Dom.setStyle(top,'height',real-size+'px');
    YAHOO.util.Dom.setStyle(bottom,'top',real+size+'px');
    var h = YAHOO.util.Dom.getViewportHeight()-real+size;    
    YAHOO.util.Dom.setStyle(bottom,'height',h + 'px');
  };
  function styleMessage(message){
    YAHOO.util.Dom.setStyle(message,'font-size','80%');
    YAHOO.util.Dom.setStyle(message,'text-align','right');
    YAHOO.util.Dom.setStyle(message,'padding','5px');
    YAHOO.util.Dom.setStyle(message,'font-family','verdana,sans-serif');
    YAHOO.util.Dom.setStyle(message,'color','white');
  }
  function styleTopBottom(){
    YAHOO.util.Dom.batch([top,bottom],function(o){
      YAHOO.util.Dom.setStyle(o,'background','#000');
      YAHOO.util.Dom.setStyle(o,'width','100%');
      YAHOO.util.Dom.setStyle(o,'position','fixed');
      YAHOO.util.Dom.setStyle(o,'left','0');
      YAHOO.util.Dom.setStyle(o,'height','10%');
      YAHOO.util.Dom.setStyle(o,'opacity','.85');
      YAHOO.util.Dom.setStyle(o,'overflow','hidden');
    });
    YAHOO.util.Dom.setStyle(top,'top','0');
    YAHOO.util.Dom.setStyle(bottom,'bottom',0);
    YAHOO.util.Dom.setStyle(bottom,'height','70%');
  };
  function peekaboo(){
    if(visible === true){
      YAHOO.util.Dom.setStyle(top,'display','none');
      YAHOO.util.Dom.setStyle(bottom,'display','none');
      visible = false;
    } else {
      YAHOO.util.Dom.setStyle(top,'display','block');
      YAHOO.util.Dom.setStyle(bottom,'display','block');
      visible = true;
    }
  };
  function smaller(){
    if(size > 10){
      size -= 5;
      render(y);
    }
  };
  function larger(){
    if(size <  YAHOO.util.Dom.getViewportHeight()/2){
      size += 5;
      render(y);
    }
  };
  return{
    init:generate
  }
}();
readingblinds.init();
```

That was pretty cool already, but as I wanted to make reading blinds a single script include or bookmarklet I had the problem of relying on the YUI. Well, there is a trick to conjure YUI from thin air by using the [`YAHOO_config` object with the listener method](http://developer.yahoo.com/yui/docs/YAHOO_config.html) creating a script node to get the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/).

So instead of calling `readingblinds.init()` directly, I used the following magic YUI trick:

```
if(typeof YAHOO=="undefined"||!YAHOO){
  YAHOO_config = function(){
    var s = document.createElement('script');
    s.setAttribute('type','text/javascript');
    s.setAttribute('src','http://yui.yahooapis.com/2.5.2/'+
                   'build/yuiloader/yuiloader-beta-min.js');
    document.getElementsByTagName('head')[0].appendChild(s);
    return{
      listener:function(o){
        if(o.name === 'get'){
          window.setTimeout(YAHOO_config.ready,1);
        }
      },
      ready:function(){
        var loader = new YAHOO.util.YUILoader();
        var dependencies = ['yahoo','dom','event'];
        loader.require(dependencies);
        loader.loadOptional = true;
        loader.insert({
          onSuccess:function(){
            readingblinds.init();
          }
        });
      }
    };
  }();
} else {
  readingblinds.init();
}
```

That's the lot. You can download [readingblinds.js](/yuiblog/blog-archive/assets/readingblinds.js) and include it in your site, or you can drag the following link to your links toolbar: [Reading Blinds](javascript:var%20x=%20function\(\){var%20h=document.createElement\('script'\);h.src='/blog-archive/assets/readingblinds.js';h.type='text/javascript';document.getElementsByTagName\('head'\)[0].appendChild\(h\)}\(\);).