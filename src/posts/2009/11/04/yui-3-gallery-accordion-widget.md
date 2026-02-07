---
layout: layouts/post.njk
title: "YUI 3 Gallery: Accordion Widget"
author: "YUI Team"
date: 2009-11-04
slug: "yui-3-gallery-accordion-widget"
permalink: /2009/11/04/yui-3-gallery-accordion-widget/
categories:
  - "YUI 3 Gallery"
  - "Development"
---
 [![YUI3 Accordion Widget](/yuiblog/blog-archive/assets/iliyan-accordion-20091103-165257.jpg)](http://yuilibrary.com/gallery/show/accordion)[Accordion](http://yuilibrary.com/gallery/show/accordion) is a visual widget that allows the expansion/collapse of grouped items containing arbitrary data. Accordion items can be added or removed dynamically, reordered via drag-and-drop, closed and set as always visible. Originally, I built the widget top of [YUI 2](http://developer.yahoo.com/yui/2/), but I've since ported it to [YUI 3](http://developer.yahoo.com/yui/3/).

Accordion is part of the new [YUI 3 Gallery](http://yuilibrary.com/gallery/), offered under the [YUI BSD License](http://developer.yahoo.com/yui/license.html), and available on the Yahoo! CDN.

The module consists of two classes — `Accordion` itself and `AccordionItem`, both extending [YUI 3's Widget](http://developer.yahoo.com/yui/3/widget/).

### Building an Accordion

The developer can build an Accordion from markup or from scratch using JavaScript. Check out the [examples on GitHub](http://ipeychev.github.com/yui3-gallery/gallery-accordion/) for more information.

If you are building from JavaScript, the first step is to instantiate and render Accordion:

```
var accordion = new Y.Accordion( {
    contentBox: "#accordion1",
    useAnimation: true,
    collapseOthersOnExpand: true
});

accordion.render();
```

The next step is to add one or more items:

```
var item1 = new Y.AccordionItem( {
    label: "Item1, added from script",
    expanded: true,
    contentBox: "dynamicContentBox1",
    contentHeight: {
        method: "fixed",
        height: 80
    },
    closable: true
} );

item1.set( "bodyContent", "Dynamically added item with fixed content height, 80px." );

accordion.addItem( item1 );
```

### Features

During instantiation (or later) the developer can set configuration options. Some of them are applicable for Accordion itself; others options apply to AccordionItems.

Among the Accordion config options:

-   **reorderItems** — If `true`, the user will be able to reorder the registered items by using drag and drop.
-   **collapseOthersOnExpand** — If `true`, Accordion will close all other items when a new item expands. This is the default behaviour.
-   **useAnimation** — This setting determines whether Accordion animates the process of items expanding/collapsing. If `true`, animation details may be set through another config property: `animation`.
-   **resizeEvent** — The developer may specify an object that provides a resize event (instead of the default browser event). For example, in the YUI 2 world if an Accordion were placed in LayoutManager the developer could use the resize event that LayoutManager provides.

Some of the AccordionItem config options:

-   **contentHeight** — The developer may choose among three different content height policies. These are:
    -   **auto** — The browser will calculate content height.
    -   **fixed** — Content height will be always X pixels, where X is a value specified by the developer.
    -   **stretch** — The third option is to set content height to be `stretch`ed. In this case, it will be calculated later, depending on the other items and on the total size of Accordion's container.
-   **alwaysVisible** — if `true`, the item will always stay open, even when another item is being expanded, and _even if the value of Accordion's property **collapseOthersOnExpand** is `true`_.
-   **closable** — If true, the user will be able to remove the item from Accordion.
-   **expanded** — Setting this property to `true` or `false` will expand/collapse item respectively.
-   **animation** — Each item may have its own animation settings.

### Future enhancements

I plan to do more work in the area of accessibility; I would like to see it improved in the future versions of Accordion.

### About the author

![YUI3 Accordion Widget](http://farm3.static.flickr.com/2655/4068966161_db6faeb274_t.jpg) Iliyan Peychev,  
Senior Software Engineer  
[Map Soft Ltd.](http://www.map.bg)