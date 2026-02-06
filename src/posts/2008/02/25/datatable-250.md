---
layout: layouts/post.njk
title: "A Peek Under the Hood of YUI's DataTable Control in 2.5.0"
author: "YUI Team"
date: 2008-02-25
slug: "datatable-250"
permalink: /blog/2008/02/25/datatable-250/
categories:
  - "Development"
---
We think the 2.5.0 release of the [YUI DataTable Control](http://developer.yahoo.com/yui/datatable/) is our best one yet, so we wanted to take a moment to look back at some of the challenges we've faced over the past few months and to peek under the hood at some of the techniques we've used to tackle these problems.

### A Yielding Render Queue

The browser environment presents non-trivial challenges for application developers, including security sandboxes and limits to CPU and memory. The DataTable is a large and robust application even before you load it up with data, and one of the core challenges for us has been to improve performance as more and more data is brought into the table. In previous releases, the browser's UI thread would tend to lock up after a certain data-size threshold was crossed as DataTable churned through the management of its internal objects and the DOM.

We've made huge improvements in DataSource to help speed things up on the data processing side, but there remained the issue of rendering all this data to the UI. Modifying the DOM can get expensive quickly, especially when you're talking about drawing or updating hundreds of rows with several cells per row.

Browsers are impatient; they like to get to work updating the display as soon as something is changed in the DOM. While we appreciate the enthusiasm, this model can be counterproductive when a lot of changes need to be made — such as rendering a DataTable with hundreds of rows. After each DOM change, the browser prepares to update the UI, but it won't actually redraw the UI until the JavaScript has finished executing. In effect, all the preparatory work done between subsequent DOM updates needlessly pulls resources away from the remaining work that needs to be done. All the while, the UI sits there unchanged.

To address this issue, we've introduced progressive rendering to the new version of DataTable.

By default, progressive rendering isn't turned on, as the benefit is mostly evident for tables in excess of 50 rows. To enable progressive rendering, set the DataTable's `renderLoopSize` configuration to the number of rows you want rendered per iteration. For example, to configure your DataTable to draw 20 rows at a time:

```
var myDataSource = new YAHOO.util.DataSource(myHugeDataSet);
myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
myDataSource.responseSchema = { fields : [ "id","name","age" ] };

var myColumnDefs = [ {key:"id"}, {key:"name"}, {key:"age"} ];

var myTableConfig = { renderLoopSize : 20 };

var myDataTable = new YAHOO.widget.DataTable('tbl', myColumnDefs, myDataSource, myTableConfig);
```

Supposing `myHugeDataSet` contains 412 records, the DataTable will immediately render itself in an empty state, then milliseconds later 20 rows will appear, then 20 more rows, and so on until all of the 412 rows are displayed.

### Scrolling This Way _and_ That Way

The scrollability feature, which was too fragile in previous releases, warranted a markup overhaul to give DataTable a more solid foundation to support fixed-header scrolling plus horizontal scrolling. Our challenge was to achieve a stable xy-scrolling mechanism while remaining accessible to screenreaders. (Screenreader software, which assists blind or partially sighted users, is good at handling `<table>` elements and their contents; it doesn't do well with tabular data that's marked up in other ways \[such as in `<div>`s\]. [For a general introduction to screenreaders, check out this YUI Theater video](/yuiblog/blog/2007/03/28/video-geoffray/).)

To start, the simplest way to achieve scrolling was to split DataTable markup into two `<table>` elements each housed in their own containers with their own `overflow` styles. Next, because of our built-in support for nested headers, we wanted to keep `<td>` "header" attributes as the best technique to allow screenreaders to make sense of our content. Trouble was, without `<th>` elements, these "header" attributes were meaningless. We were forced to duplicate all the markup of the `<thead>` of the first `<table>` in another `<thead>` in the second `<table>`. A quick absolute-positioning of the second `<thead>` to the far-left places these meant-for-screenreaders-only elements offscreen.

[![XY scrolling in the new YUI DataTable Control.](/yuiblog/blog-archive/assets/xy_scroll_mech.png)](http://developer.yahoo.com/yui/examples/datatable/dt_fixedscroll.html)

### A Fresh Look at Pagination

Pagination is such a fast way to reduce the footprint of a large dataset that we found ourselves recommending this feature to a lot of our implementers. Problem was, everybody seemed to have different expectations when it comes to pagination. The challenge here was to create a solution simple enough for the plug-and-play needs of some, but flexible enough for implementers with highly customized requirements. The result of our efforts is the new `YAHOO.widget.Paginator` class (currently packaged with the DataTable build).

Before we tell the _interesting_ story, here’s the less interesting one. To paginate your DataTable, all your Paginator needs to know is how many `rowsPerPage` you want to display. The rest it can figure out on its own.

```
var myTableConfig = {
  paginator: new YAHOO.widget.Paginator({rowsPerPage:50})
  };
var myDataTable = new YAHOO.widget.DataTable(
  myContainer, myColumnDefs, myDataSource, myTableConfig);
```

Of course, dividing a total number of records by a set number of rows per page is simple math. That part is easy to code. It’s in the UI implementation that things get dicey.

To tackle this problem, Paginator is build on a template and UI component system. The template config contains the markup describing how the pagination controls should be rendered. The default template looks like this:

```
"{FirstPageLink} {PreviousPageLink} {PageLinks} {NextPageLink} {LastPageLink}"
```

Each bracketed item is a placeholder identifying where to render one of Paginator’s UI components. The following UI components are available with the 2.5.0 release:

-   FirstPageLink
-   PreviousPageLink
-   NextPageLink
-   LastPageLink
-   PageLinks
-   RowsPerPageDropdown
-   CurrentPageReport

Each component adds its own configuration options to the Paginator, allowing you to customize its look and feel. For example, this configuration...

```
var myPaginator = new YAHOO.widget.Paginator({
  rowsPerPage : 25,
  template : "{PreviousPageLink} <span>{CurrentPageReport}</span> {NextPageLink}",
  previousPageLinkLabel : ‘&lt;’,
  nextPageLinkLabel : ‘&gt;’,
  pageReportTemplate : ‘Showing records <strong>{startRecord} – {endRecord}</strong> of {totalRecords}’
  });
```

...would result in pagination controls rendered like this:

[![A simple Paginator interface; you can customize this UI fully using the techniques described above.](/yuiblog/blog-archive/assets/paginator.png)](http://developer.yahoo.com/yui/examples/datatable/dt_clientpagination.html)

Take a look at the classes under the `YAHOO.widget.Paginator.ui` namespace in DataTable’s API docs for a list of each component’s options.

Of course, if none of the pre-packaged UI components suits your needs, you can create your own components. Just drop them in the `YAHOO.widget.Paginator.ui` namespace and you can immediately reference them by name in your Paginator template and config. And if you create a cool Paginator component, let us know in the comments or [on the YUI community forum](http://tech.groups.yahoo.com/group/ydn-javascript/) — we'd love to see what you build with this, as would other DataTable users.

### Columns Get Their Day

Version 2.5.0 introduces a new set of APIs for managing Columns in the DataTable: setting widths, hiding and showing, inserting, removing, and drag-and-drop reordering of Columns are now supported out of the box. Hiding and showing of Columns is implemented by setting a column's width to "`1px"` on hide and and reverting to the original width on show. Inserting a Column requires passing in an object literal Column definition. This will create a new Column instance, add it to the internal ColumnSet, and update the DOM as necessary. Removing a Column will remove the Column instance from the ColumnSet as well as removing all related elements from the DOM. Drag-and-drop reordering of Columns can be enabled for the entire DataTable via the constructor config, as long as the [Drag and Drop Utility](http://developer.yahoo.com/yui/dragdrop/) is available on the page. When a Column is reordered, it is first removed from the DataTable and then inserted into the new position.

Since Columns can be assigned a `width` at instantiation or dynamically at runtime, users can easily resize their Column widths and then save their settings as a preference for their next visit using the [Cookie Utility](http://developer.yahoo.com/yui/cookie/) that Nicholas C. Zakas contributed to YUI for the 2.5.0 release. Here's one way you might achieve that:

```
var Cookie = YAHOO.util.Cookie;
var Dom = YAHOO.util.Dom;

var myData = [
  {SKU:"23-23874", Quantity:43, Item:"Helmet", Description:"Red baseball helmet. Size: Large."},
  {SKU:"48-38835", Quantity:84, Item:"Football", Description:"Leather football."},
  {SKU:"84-84848", Quantity:31, Item:"Goggles", Description:"Light blue swim goggles"},
  {SKU:"84-84843", Quantity:56, Item:"Badminton Set", Description:"Set of 2 badminton rackets, net, and 3 birdies."},
  {SKU:"84-39321", Quantity:128, Item:"Tennis Balls", Description:"Canister of 3 tennis balls."},
  {SKU:"39-48949", Quantity:55, Item:"Snowboard", Description:""},
  {SKU:"99-28128", Quantity:77, Item:"Cleats", Description:"Soccer cleats. Size: 10."},
  {SKU:"83-48281", Quantity:65, Item:"Volleyball", Description:""},
  {SKU:"89-32811", Quantity:12, Item:"Sweatband", Description:"Blue sweatband. Size: Medium."},
  {SKU:"28-22847", Quantity:43, Item:"Golf Set", Description:"Set of 9 golf clubs and bag."},
  {SKU:"38-38281", Quantity:1, Item:"Basketball Shorts", Description:"Green basketball shorts. Size: Small."},
  {SKU:"82-38333", Quantity:288, Item:"Lip balm", Description:"Lip balm. Flavor: Cherry."},
  {SKU:"21-38485", Quantity:177, Item:"Ping Pong Ball", Description:""},
  {SKU:"83-38285", Quantity:87, Item:"Hockey Puck", Description:"Glow-in-the-dark hockey puck."}
  ];
  
  // Grab cookies when possible
  var myColumns = [
  {key:"SKU", resizeable:true, width:parseInt(Cookie.get("SKU"),10)||null},
  {key:"Quantity", resizeable:true,width:parseInt(Cookie.get("Quantity"),10)||null},
  {key:"Item", resizeable:true,width:parseInt(Cookie.get("Item"),10)||null},
  {key:"Description", resizeable:true,width:parseInt(Cookie.get("Description"),10)||null}
  ]
  
  var myDataSource = new YAHOO.util.DataSource(myData,{
  responseType: YAHOO.util.DataSource.TYPE_JSARRAY,
  responseSchema: { fields: ["SKU", "Quantity", "Item", "Description"] }
  });
  
  var myDataTable = new YAHOO.widget.DataTable("myContainer", myColumns, myDataSource);
  
  myDataTable.subscribe("columnResizeEvent", function(oArg) {
  // Coming soon: width value from the event.
  // Until then, manually calculate.
  var el = oArg.target.firstChild;
  var newWidth = el.offsetWidth -
  (parseInt(Dom.getStyle(el,"paddingLeft"),10)|0) -
  (parseInt(Dom.getStyle(el,"paddingRight"),10)|0);
  
  // Set the cookie
  Cookie.set(oArg.column.getKey(), newWidth, {
  path: "/",
  domain: "yahoo.com",
  expires: new Date("January 12, 2025")
  });
  });
```

### There is No "Rest" in Iteration

2.5.0 is a big release for DataTable, but our work is not done, and we're already tackling our next set of top issues, including better support of server-side sort and pagination, more performance enhancements with dynamically added and removed data, and more robust screenreader accessibility for dynamic states.

We want to take this chance to thank all the members of the community who have taken the time to implement our products, file bugs, suggest features, and contribute to the forum (this means you, Satyam!). Your participation is wholly appreciated and makes an incredible difference in what we do and how we do it.