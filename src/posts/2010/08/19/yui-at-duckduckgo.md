---
layout: layouts/post.njk
title: "Using YUI 2 on the DuckDuckGo Search Engine"
author: "Gabriel Weinberg"
date: 2010-08-19
slug: "yui-at-duckduckgo"
permalink: /blog/2010/08/19/yui-at-duckduckgo/
categories:
  - "YUI Implementations"
---
[![](/yuiblog/blog-archive/assets/duckduckgo-20100817-115307.jpg)](http://duckduckgo.com/?q=yui+library)

[DuckDuckGo](http://duckduckgo.com/) is a search engine that uses YUI extensively. Here's what it uses in particular:

-   _ImageLoader_. Matt Mlinac's [YUI 2 ImageLoader](http://developer.yahoo.com/yui/imageloader/ "YUI 2: ImageLoader") was the first thing I implemented and what originally hooked me on YUI for this project. DuckDuckGo has favicons next to results and often has "Zero-click Info" above results that usually includes [an image](http://duckduckgo.com/Yahoo!_UI_Library). I didn't want these images to compete with the results when loading, as getting results as fast as possible is the ultimate goal.
    
    The ImageLoader Utility handles this well by loading the images after the page load. DDG also auto-loads the next page of results when you scroll down. Sometimes the favicons icons are therefore hidden, and with ImageLoader their load is delayed (sometimes indefinitely) until necessary. To accomplish this, there is a different image group per (internal) page, each with its own custom trigger.
    
    ```
    div.event=new YAHOO.util.CustomEvent('it');
        var ig1=new YAHOO.util.ImageLoader.group(div,'click');
        ig1.addCustomTrigger(div.event);
        div.ig = ig1;
    
    ```
    
-   _Cookie_. DuckDuckGo has a lot of [settings](http://duckduckgo.com/settings.html), which are stored via cookies and alternately via [URL params](http://duckduckgo.com/params.html). When cookies are used, I use Nicholas Zakas's [YUI 2 Cookie Utility](http://developer.yahoo.com/yui/cookie/ "YUI 2: Cookie Utility") to easily get and set the values.
    
    ```
      YAHOO.util.Cookie.set(cookie, value, { expires: new Date("January 12, 2025") });
      x=ki||YAHOO.util.Cookie.get("i");
    ```
    
-   _StyleSheet_. Some DDG settings change the look and feel of the site. These changes are actually accomplished after page load via Luke Smith's [YUI 2 StyleSheet Utility](http://developer.yahoo.com/yui/stylesheet/ "YUI 2: StyleSheet Utility"). Some of these changes are straightforward and I can just use the [`setStyle` Dom function](http://developer.yahoo.com/yui/docs/YAHOO.util.Dom.html#method_setStyle "API: dom  YAHOO.util.Dom   (YUI Library)").
    
    ```
    YAHOO.util.Dom.setStyle('b2','display','block');
    ```
    
    Others require actual class changes, which I use the utility to do.
    
    ```
    YAHOO.util.StyleSheet('DDG').set('.ci', {display: "block"}).
                set('.cid', {display: "block"}).
                set('.ci2', {display: "block"}).
                enable();
    ```
    
-   _Dom_. I also use some functions in Matt Sweeney's base [YUI 2 Dom component](http://developer.yahoo.com/yui/dom/ "YUI 2: Dom Collection"). I referenced `setStyle` above, and I also use the related `getStyle`, `addClass` and `removeClass` functions. In addition, I find the `getViewportHeight`, `getViewportWidth`, `getX` and `getY` functions to be incredibly useful to make things work cross-browser, and now on mobile screens as well.
    
-   _KeyListener_. DDG has a bunch of [keyboard shortcuts](http://duckduckgo.com/goodies.html) that let you navigate results without the mouse. I use the [YUI 2 KeyListener](http://developer.yahoo.com/yui/docs/YAHOO.util.KeyListener.html "API: event  YAHOO.util.KeyListener   (YUI Library)") component to enable these shortcuts.
    
    ```
    kl14 = new YAHOO.util.KeyListener(document, { keys:[70] }, { fn:not } );kl14.enable();
    ```
    
-   _AutoComplete_. I'm currently working on adding search suggestions to the search engine, and will be using Jenny Donnelly's [YUI 2 AutoComplete](http://developer.yahoo.com/yui/autocomplete/ "YUI 2: AutoComplete") component for the front-end. I understand that AutoComplete is getting introduced in YUI 3 soon. Everything else I use has already been introduced in YUI 3, though I still use YUI 2. However, I will be exploring the migration to YUI 3 soon.
    

_![](/yuiblog/blog-archive/assets/gabrielweinberg.jpg)**About the author:** Gabriel Weinberg is the founder of the DuckDuckGo search engine, based out of Valley Forge, PA. Gabriel has been a startup founder for over ten years, and his last company was sold in 2006. Gabriel holds degrees from MIT in Physics and the Technology and Policy Program._