---
layout: layouts/post.njk
title: "More Accessible YUI Grids Layouts with ARIA Landmark Roles"
author: "Todd Kloots"
date: 2009-03-05
slug: "aria-grids"
permalink: /2009/03/05/aria-grids/
categories:
  - "Accessibility"
  - "Development"
---
[YUI Grids CSS](http://developer.yahoo.com/yui/grids/) has long been an important tool for developers wishing to create more accessible layouts. Through its support of source-order independent layouts, Grids enables control of the reading order of a page, allowing developers to place the most important content higher in the markup so that it can be quickly discovered by users of screen readers. However, while the role of each section of a Grid (e.g., navigation, main content, footer, etc.) is easily perceived through visual style and layout, it is not immediately perceived by users of screen readers because `<div>`s are inherently structural elements with no default semantic meaning.

### The Benefit of Landmark Roles

[ARIA Landmark Roles](http://www.w3.org/TR/wai-aria/#roleattribute_inherits) improve the content parsability of Grids for users of screen readers. By allowing developers to declare the intended purpose of each section of a layout, Landmark Roles provide semantic meaning to each section of a Grid, giving users of screen readers a high-level summary of how a page is organized. In addition, Landmark Roles significantly improves a Grid's navigability. For example, the [JAWS screen reader](http://www.freedomscientific.com/products/fs/jaws-product-page.asp) will announce all of the Landmarks when a page is loaded and allows users to quickly jump between them by pressing the semicolon key:

   

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34"> <param name="allowFullScreen" value="true"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=12214507&amp;vid=4561284&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/7558/80857405.jpeg&amp;embed=1"><embed allowfullscreen="true" bgcolor="#000000" flashvars="id=12214507&amp;vid=4561284&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/7558/80857405.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34" type="application/x-shockwave-flash" width="512"></object>

  
[Example Page Using YUI Grids And ARIA Landmark Roles](http://video.yahoo.com/watch/4561284/12214507) @ [Yahoo! Video](http://video.yahoo.com)

### Using Landmark Roles

Of all the roles defined in the [ARIA Specification](http://www.w3.org/TR/wai-aria/), the Landmark Roles are among the easiest to implement since they _don't require JavaScript for keyboard support or state management_. Landmark Roles are applied to an element using the `role` attribute and can be used to improve the semantics of any section of a Grid. For example, to declare a section of a Grid as navigation, simply set the role attribute to a value of "navigation":

```
<div class="yui-b" role="navigation">
```

Presently the ARIA Specification defines seven different Landmark Roles:

-   [`application`](http://www.w3.org/TR/wai-aria/#application)
-   [`banner`](http://www.w3.org/TR/wai-aria/#banner)
-   [`complementary`](http://www.w3.org/TR/wai-aria/#complementary)
-   [`contentinfo`](http://www.w3.org/TR/wai-aria/#contentinfo)
-   [`main`](http://www.w3.org/TR/wai-aria/#main)
-   [`navigation`](http://www.w3.org/TR/wai-aria/#navigation)
-   [`search`](http://www.w3.org/TR/wai-aria/#search)

### Getting Started Is Easy

Since ARIA Landmark Roles are such a perfect complement to Grids, we've added built-in support to [YUI Grids Builder](http://developer.yahoo.com/yui/grids/builder/), added a [new section on using Landmarks](http://developer.yahoo.com/yui/grids/#using-landmark-roles) to the Grids user guide, and created a [new example to highlight usage of Landmarks Roles](http://developer.yahoo.com/yui/examples/grids/grids-landmarks.html) within YUI Grids CSS. Developers who are currently using Grids should definitely consider adding ARIA Landmark Roles to their markup to easily improve the accessibility of existing layouts.