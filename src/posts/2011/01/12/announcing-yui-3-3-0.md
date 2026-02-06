---
layout: layouts/post.njk
title: "Announcing YUI 3.3.0"
author: "Satyen Desai"
date: 2011-01-12
slug: "announcing-yui-3-3-0"
permalink: /blog/2011/01/12/announcing-yui-3-3-0/
categories:
  - "Development"
---
The YUI Team is pleased to announce the general availability of YUI 3.3.0, the latest release in our JavaScript and CSS library. If you use Yahoo's CDN, you can upgrade by switching your seed file to [YUI 3.3.0](http://yui.yahooapis.com/3.3.0/build/yui/yui-min.js); you can also [download the 3.3.0 distribution from YUILibrary.com](http://yuilibrary.com/downloads/ "YUI Library :: Downloads").

Some things to look for in this release:

-   **Firefox 4, IE9, and Android 2.2 support** — With YUI 3.3.0, we've tested extensively against the latest betas of the forthcoming Firefox 4 and IE9 releases to ensure the smoothest possible transition when those browsers hit GA. This is also the first release during which we've treated WebKit on Android as an A-Grade browser; you should see much improved support for Android throughout the library.
-   **Node sugar**: Matt Sweeney landed some additional sugar methods in 3.3.0, including `show` and `hide` methods to toggle the display of a Node or NodeList, `wrap` and `unwrap` to add and remove a parentNode, and `empty` to remove all childNodes. The new `node-load` submodule adds a `load` method to Node, providing a convenient IO wrapper.
-   ![](/yuiblog/blog-archive/assets/autocomplete-20110110-153010.jpg)**[AutoComplete widget (beta)](http://developer.yahoo.com/yui/3/autocomplete/ "YUI 3 AutoComplete")** — Ryan Grove's YUI 3 AutoComplete widget, new in 3.3.0, provides a flexible, configurable, and accessible AutoComplete implementation. It includes options for custom filtering, highlighting, and formatting of results; delimited queries; result retrieval from a variety of local and remote sources such as YQL, JSONP, and XHR; and is built to be modular and easy to extend. As a companion to AutoComplete, Ryan's [node-tokeninput Gallery module](http://yuilibrary.com/gallery/show/node-tokeninput "YUI Library :: Gallery :: node-tokeninput") makes it easy to turn any input element into a tokenized input field similar to the `NSTokenField` Cocoa widget in Mac OS X.
-   **[Charts](http://developer.yahoo.com/yui/3/charts/ "YUI 3 Charts")** — Tripp Bridges has rewritten Charts from the ground up over the past six months. YUI 3 Charts provides a JavaScript API for creating charts from a set of data. Charts uses a combination of SVG, HTML Canvas and VML to facilitate the creation of different variations and combinations of line, marker, area, spline, column, bar and pie charts. As of this release, YUI 3 Charts includes the following features:
    
    -   Stacked axes and series
    -   Multiple value axes
    -   Customizable graphics and text
    -   Customizable default tooltip
    
      
    [![](/yuiblog/blog-archive/assets/charts-20110110-152137.jpg)](http://developer.yahoo.com/yui/3/examples/charts/charts-stackedarea.html)
-   **[DataTable widget (beta)](http://developer.yahoo.com/yui/3/datatable/ "YUI 3 DataTable")** — Jenny Donnelly and Tilo Mitra landed the beginnings of the new YUI 3 DataTable widget in 3.3.0. This new widget begins to implement the extensive functional footprint of the YUI 2 version while using YUI 3's much more modular structure. Hence, you'll find features like scrolling and sorting broken out as plugins or extensions, allowing you to load only the code you need for your implementation. If you're interested in this component, [don't miss Tilo's introduction to YUI 3 DataTable from YUIConf 2010](http://developer.yahoo.com/yui/theater/video.php?v=yuiconf2010-mitra "Video: Tilo Mitra — Handling Data in YUI 3 (YUI Theater)").  
    ![](/yuiblog/blog-archive/assets/datatable-20110110-154937.jpg)
-   **[Dial widget (beta)](http://developer.yahoo.com/yui/3/dial/ "YUI 3 Dial")** — Jeff Conniff's new Dial widget is a circular value input control. It's similar to a real-world, analog volume control dial, but it allows larger value ranges and finer granularity. Use Dial instead of Slider where you need to control a larger range, and where you need finer control. For example, you might need to tune in a radio station in the frequency range of 500-1500 kHz, but need the granularity to accurately select 560.2 kHz — an operation that requires about 10,000 discrete values. Dial is a compact UI that provides that level of granularity. There are other cases when the Dial's radial form factor better suits your design, such as when rotating objects, selecting angles, or representing real world controls that people are accustomed to seeing in dial format. It is especially effective when used to help the user see the effect of the value in real-time. The Dial also has the benefit of fine motor control leverage. The farther out from the center of the Dial the user pulls the handle, the more precise the control.  
    [![](/yuiblog/blog-archive/assets/330-dial-20101222-121808.jpg)](http://developer.yahoo.com/yui/3/examples/dial/dial-interactive.html "YUI Library Examples: Dial: Dial With Interactive UI")
-   ![](/yuiblog/blog-archive/assets/resize-20110110-163729.jpg)**[Resize utility (beta)](http://developer.yahoo.com/yui/3/resize/ "YUI 3 Resize")** — Provided by Eduardo Lundgren of Liferay, this is the first component to move from the excellent AlloyUI suite into the core YUI 3 distribution. Eduardo has focused on making the component more modular, separating most functional groups into separate plugins. The new component is organized as follows:
    
    -   **`Y.Resize`**: Base Class. The Resize Utility allows you to make an HTML element resizable, supporting eight handle positions and wrapped elements (`Y.Resize` will wrap the element, calculate adjustments for borders/padding and offset the handles for you).
    -   **`Y.ResizeConstrained`**: Sometimes a user may want to preserve the object's aspect ratio, limit the resize operation to to a region, or set max and min dimensions. The `Y.ResizeConstrained` plugin provides those options for you.
    -   **`Y.Plugin.ResizeProxy`**: When using this plugin, the Resize utility will create a "proxy" element to resize instead of resizing the actual element. This should be used when you are resizing a complex element.
    
    (You can meet Eduardo and fellow AlloyUI author Nate Cavanaugh in this [AlloyUI whirlwind tour shot at YUIConf 2010](http://developer.yahoo.com/yui/theater/video.php?v=yuiconf2010-alloy "Video: Nate Cavanaugh and Eduardo Lundgren — A Whirlwind Tour of AlloyUI Components in the YUI 3 Gallery (YUI Theater)").)

Up next will be 3.4.0, which we expect to release in Q2. Current plans for that release include further enhancements for mobile (see [my talk from YUIConf for more on our philosophy regarding mobile support](http://yui.zenfs.com/theater/yuiconf2010-smith-hd.mov)), Anthony Pipkin's work on Button and Toolbar controls (which we hope to bundle with YUI 3's Editor for a complete rich text editor component), and [Gonzalo Cordero's TreeView component](http://developer.yahoo.com/yui/theater/video.php?v=yuiconf2010-cordero "Video: Gonzalo Cordero — A Preview of YUI 3 TreeView (YUI Theater)"). We'll be looking for your feedback on these priorities; stay tuned to YUIBlog for a special upcoming Open Hours developer session to talk about the YUI 3 roadmap for 3.4.0 and beyond.

Enjoy 3.3.0 — we look forward to hearing your feedback on Freenode's #yui channel or in the [YUI Forums](http://yuilibrary.com/forum/ "YUI Library :: Forums :: Index page").