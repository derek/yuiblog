---
layout: layouts/post.njk
title: "AccordionView Widget for YUI from Marco van Hylckama Vlieg"
author: "Eric Miraglia"
date: 2008-07-25
slug: "accordionview"
permalink: /2008/07/25/accordionview/
categories:
  - "Development"
---
[![The AccordionView Widget based on YUI, by Marco van Hylckama Vlieg](/yuiblog/blog-archive/assets/accordionview.png)](http://www.i-marco.nl/weblog/yui-accordion/)[Marco van Hylckama Vlieg](http://www.i-marco.nl/weblog/), author of the YUI-based Dark Matter theme for Pixelpost ([free version](http://www.pixelpost.org/extend/templates/dark-matter/) | [pro version](http://darkmatter-template.com/)), is back with another outstanding contribution to the YUI ecosystem: The new [AccordionView Widget](http://www.i-marco.nl/weblog/yui-accordion/).

We've written about a number of YUI-based accordions over the years, but this may be the most complete and the most consistent with YUI's own widget style. Visually and syntactically, Marco's accordion feels part and parcel with other YUI widgets you may be using.

Markup for the widget begins with an unordered list:

```
<ul id="mymenu" class="yui-accordionview">
    <li class="yui-accordion-panel">
        <a class="yui-accordion-toggle" href="#">Item 1</a>
            <div  class="yui-accordion-content">
                <!--content goes here-->
            </div>
     </li>

    <li class="yui-accordion-panel">
        <a class="yui-accordion-toggle" href="#">Item 2</a>
            <div  class="yui-accordion-content">
                <!--content goes here-->
            </div>
     </li>
</ul>
```

Once markup is in place, you can instantiate the widget:

```
var accordion = new YAHOO.widget.AccordionView('mymenu', options);
```

According to Marco's documentation page, AccordionView supports the following options:

-   **width**: css value for width including unit (example: '400px', '15em', etc.)
-   **expandItem**: index of item to expand at initialization, default is none. 0 is the first, 1 the second, etc.
-   **animationSpeed**: speed in seconds for animation. The default is 0.7
-   **animate**: true or false, default is true
-   **effect**: YUI Animation effect to use on animation. See [the documentation on YAHOO.util.Easing](http://developer.yahoo.com/yui/docs/YAHOO.util.Easing.html). Default is YAHOO.util.Easing.easeBoth
-   **collapsible**: true or false, whether the whole thing can be collapsed or not, default is true
-   **expandable**: true or false, whether the whole thing can expand (true) or act as an accordion where only one item can be open (false). default is false
-   **hoverActivated**: true or false, when set to true, the items are activated on hover. Note that this activates on click ALSO in order to keep keyboard navigation working.

Marco calls AccordionView a "work in progress"; you can give him feedback on how it's working for you and what features you'd like to see added or refined [on his blog](http://www.i-marco.nl/weblog/archive/2008/07/20/yui_powered_javascript_accordi).