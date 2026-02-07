---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Matt Parker's Resize Plugin"
author: "Unknown"
date: 2010-03-25
slug: "gallery-resize"
permalink: /2010/03/25/gallery-resize/
categories:
  - "YUI 3 Gallery"
  - "Development"
---
We use an awful lot of the different [YUI 2](http://developer.yahoo.com/yui/2/ "YUI 2 — Yahoo! User Interface Library") widgets and components in our main application, and love them! But I'd thought it was about time to start getting to grips with [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library"), and decided I'd have a go at bringing [YUI 2's Resize Utility](http://developer.yahoo.com/yui/resize/ "YUI 2: Resize Utility") over to YUI 3. I also have longer term plans to write a diary widget, and if it was going to be in YUI 3 it would need some resizableness.

The result: [My YUI 3 Gallery Resize plugin](http://yuilibrary.com/gallery/show/resize). [The source is available on GitHub](http://github.com/mattparker/yui3-gallery/), and [here is a functional example](http://mattparker.github.com/).

[![](/yuiblog/blog-archive/assets/resize-node-plugin-20100324-113511.jpg)](http://mattparker.github.com/)

I decided to do it as a plugin, rather than a widget. As far as I can tell, plugins are like a pretty handbag or a pair of ostrich-skin shoes; they pretty up an existing element, but they're not the be-all-and-end-all. Making an element resizeable felt like a plugin to me.

To use Resize, include the code in your page:

```
<script src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js&gallery-2010.03.23-17-54/build/gallery-resize/gallery-resize-min.js"></script>

```

Once you've got the module on the page, making an element resizeable is as easy as plugging it in:

```
YUI().use( "gallery-resize", function(Y){
  Y.one( "#elementId" ).plug( Y.Plugin.Resize );
} );

```

It seemed quite important to me that the config and API of YUI 3 versions of components that exist in YUI 2 should be similar, at least, or as much as they can be within the YUI 3 approach. So you can use the same config objects with this plugin as with the YUI 2 version, and I've provided the same API methods. I wrote the plugin code from scratch, but the CSS is copied directly from YUI 2, only changing the prefix from `yui-` to `yui3-`. This should help minimize the learning curve for people making the YUI 2 to YUI 3 transition.

Here's an example with some more options, passed as an object as the second argument to `plug()`:

```
YUI().use( "gallery-resize", function(Y){

  Y.one( "#elementId" )
   .plug( Y.Plugin.Resize,
         { draggable: true,
            ratio: false,
            height: 150,
            proxy: true,
            ghost: true,
            animate: true,
            autoRatio: true,
            handles: [ "t", "b" , "l", "r", "tl" , "tr" , "bl" , "br" ],
            hiddenHandles: false,
            hover: true,
            knobHandles : true,
            useShim: true,
            status: true,
            // this is new: a selector to find child elements within #elementId
            // that should be resized in proportion to the wrapper.
            wrappedEls: "img",
            // so is this: should the wrapper 'hug' the wrapped element?
            // this'll only work with one wrapped element.
            hugWrappedEl: true
             } );
 } );

```

There is one exception to the consistency with YUI 2: wrapping elements. My Resize Gallery module adds some `div` elements inside the element that's being resized to give you drag handles. This is fine as long as the element accepts child nodes; but images, textareas and the like don't. In YUI 2, the [Resize Utility](http://developer.yahoo.com/yui/resize/ "YUI 2: Resize Utility") automatically (or if you tell it to) adds a wrapper element to your image (or whatever) to make it resizeable.

This is fine, but it isn't so good with a plugin approach. Plugins plug in to a particular node, and are accessible as a property of that node. But if my plugin starts creating new parent nodes and attaches itself and its behaviour to that parent, the interface is a bit broken, and it gets confusing to use. So the bottom line is that you have to wrap your pictures yourself for now. This could be cast as an advantage; the wrapper element can contain a pile of images, say, and they could all be resized with the wrapper, but captions for them could be left alone.

I'd love feedback from users ([in the brand new Gallery Resize forum](http://yuilibrary.com/forum/viewforum.php?f=177 "YUI Library :: Forums :: View forum - Resize")) as to whether the plugin approach works for you — that is, do you like the convenience or would you prefer the additional convenience of a utility that automatically handled the wrapping of images and textareas? I have some other to-dos still, as well; for example, I've not yet got wired the Events, there's some re-arranging odds and ends (pulling out the CSS class names), and some performance and size optimisations yet to do. I haven't completed cross-browser testing, either; if you're using Resize with a Mac, particularly, I'd love [feedback](http://yuilibrary.com/forum/viewforum.php?f=177 "YUI Library :: Forums :: View forum - Resize") on how it's working for you.