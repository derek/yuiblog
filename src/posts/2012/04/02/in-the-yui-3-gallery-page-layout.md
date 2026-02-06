---
layout: layouts/post.njk
title: "In the YUI 3 Gallery:  Page Layout"
author: "YUI Team"
date: 2012-04-02
slug: "in-the-yui-3-gallery-page-layout"
permalink: /2012/04/02/in-the-yui-3-gallery-page-layout/
categories:
  - "Development"
---
When working with tabular data, it is nice to be able to see as many columns as possible. If the table is the only widget on the page, then you can let the table expand and the viewport will scroll. However, this will not work if you need to display multiple tables along with other modules in a more complicated arrangement. Since traditional, fixed width layout is not acceptable, this led to the creation of [Page Layout](http://yuilibrary.com/gallery/show/layout) which supports fluid layout of multiple modules on a page.

[![](http://jafl.github.com/yui3-gallery/layout/example.png)](http://jafl.github.com/yui3-gallery/layout/cols.html "YUI 3 Page Layout Screenshot")

([Click the screenshot to play with this example](http://jafl.github.com/yui3-gallery/layout/cols.html "YUI 3 Page Layout Example").)

### Overview

Page Layout provides fluid layout for modules arranged either in rows or columns. Each row or column contains one or more modules. Each module contains an optional header, a body, and an optional footer. (A previous incarnation of Page Layout supported arbitrary layouts via nesting, but this turned out to be way too slow.)

You can set the size of each row or column and the size of each module within a horizontal list or vertical stack. Since the layout is fluid, all sizes are specified as percentages of the available width or height. You can also set the minimum supported width and height of your layout (in em’s), to ensure that none of the modules on your page shrink too small.

Modules can be collapsible. A single module in a row (or a module in a vertical stack) collapses vertically, folding up so only the module header is visible. A single module in a column (or a module in a horizontal line) collapses horizontally into a thin bar which can be clicked to re-expand the module.

Individual modules can be a fixed size, managed by CSS. However, this is an edge case, and will not be discussed in this article. Please refer to the [examples](http://jafl.github.com/yui3-gallery/layout/rows-fixed.html) for details.

Page Layout also supports a page header and page footer which span the width of the page. These are assumed to be fixed height containers.

Page Layout has three modes:

Fit to viewport

This is the default. The layout is adjusted to fit the viewport. Each module has a vertical scrollbar if the content is taller than the allocated space. The viewport scrollbars only appear if the viewport is smaller than the configured minimum size.

Fit to content

The layout’s width is adjusted to fit the viewport, but each module’s height expands to show all the content. The viewport’s vertical scrollbar appears if the layout is taller than the viewport.

Single module

This mode automatically takes effect if there is only one module on the page. Fit to content is used if the content is not as tall as the viewport. Otherwise, fit to viewport is used. This is especially useful for a module with controls in the footer, because the controls will stay close to the content instead of being stuck at the bottom of the viewport.

### Configuration

The layout is specified in the markup by attaching classes to the appropriate divs, so you can continue to build the contents of each module the way you normally do.

For a row-based layout, the structure is:

```
<div class="layout-hd">...</div>

<div class="layout-bd" style="visibility:hidden;">
	<div class="layout-module-row">
		<div class="layout-module">
			<div class="layout-m-hd">...</div>
			<div class="layout-m-bd">...</div>
			<div class="layout-m-ft">...</div>
		</div>
	</div>
</div>

<div class="layout-ft" style="visibility:hidden;">...</div>

```

The page header and footer are optional.

The visibility styles are removed once the layout is ready to be displayed. This avoids displaying the raw contents while the page loads.

To transpose to a column-based layout, simply change `layout-module-row` to `layout-module-col`. Note that you cannot mix rows and columns.

You can stack as many rows or columns as you want, and you can stack as many modules as want inside each row or column. Of course, if you put too much on one page, the modules will be so small that nothing will be visible! (For efficiency, the layout algorithms do not degrade gracefully. Caveat emptor.)

To set the height of a row or a module inside a column add `height:N%` to the class, where N is a positive number. To set the width of a column or a module inside a row add `width:N%` to the class.

To change the mode to fit to content, add `FIT_TO_CONTENT` to the class of the main body div (`layout-bd`). If you want to avoid the single module behavior, add `FORCE_FIT` to the main body div’s class.

#### Collapsible Modules

Modules that collapse vertically simply hide the body and footer. The elements for collapsing and expanding both go inside the module header. Here is an example using buttons:

```
<div class="layout-m-hd">
	...
	<button class="layout-vert-collapse-nub">↑</button>
	<button class="layout-vert-expand-nub">↓</button>
	...
</div>

```

Modules that collapse horizontally are replaced by a thin strip that serves as the expand button. Here is an example of collapsing left:

```
<div class="layout-module">
	<div class="layout-left-expand-nub">
		<div>→</div>
	</div>
	<div class="layout-m-hd">
		...
		<button class="layout-left-collapse-nub">←</button>
		...
	</div>
	...
</div>

```

To collapse to the right, replace left with right in the above CSS classes. (Page Layout does not actually make any distinction between collapsing left or right, but the classes are useful for styling.)

Modules can be collapsed or expanded programmatically by using the API: `collapseModule`, `expandModule`, `toggleModule`, and `moduleIsCollapsed`. All four functions require that you pass the div containing the module, i.e., the one that has the class `layout-module`.

### Usage

Once you instantiate Page Layout, it immediately begins managing the modules on the page, so you don’t have to do much. Page Layout automatically reflows the layout when the window is resized or the text size is zoomed. However, you must notify Page Layout when an element on the page changes size. Simply call `elementResized` and pass the element that changed. You must also notify Page Layout if you add or remove modules, by calling `rescanBody`.

When displaying a widget that manages its own scrollbars, e.g., `Y.DataTable`, you need to notify the widget when the module is resized. Page Layout fires two events: `beforeResizeModule` and `afterResizeModule`. The [plugin for DataTable](https://github.com/jafl/yui3-gallery/blob/master/src/gallery-layout-datatable/js/layout-datatable.js) shows how to handle these events. Before the module is resized, reset the height to auto. Afterwards, set the height to fit the module.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._