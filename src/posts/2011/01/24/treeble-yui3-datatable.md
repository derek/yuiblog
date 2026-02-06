---
layout: layouts/post.njk
title: "Treeble with YUI 3 DataTable"
author: "John Lindal"
date: 2011-01-24
slug: "treeble-yui3-datatable"
permalink: /blog/2011/01/24/treeble-yui3-datatable/
categories:
  - "Development"
---
The beta release of [DataTable](http://developer.yahoo.com/yui/3/datatable/) in YUI 3.3.0 gives us a very powerful component to play with. To kick the tires in a useful way, I decided to update my [Treeble](http://yuilibrary.com/gallery/show/treeble) examples to use DataTable. (Treeble enables [displaying hierarchical data in a table](/yuiblog/blog/2010/04/14/treeble-using-nested-yui-2-datasources-for-row-expansion/).)

To my delight, it was a breeze! All the hard work is done in [`TreebleDataSource`](http://jafl.github.com/yui3-gallery/treeble/yuidoc/TreebleDataSource.html), which extends YUI 3 DataSource, so all I had to do was plug it into DataTable by using `Y.Plugin.DataTableDataSource` and then configure the columns:

> ```
> var ds = new Y.TreebleDataSource(...),
> 	pg = new Y.Paginator(...),
> 	table;
> 
> function sendRequest() {
> 	table.datasource.load({
> 		request: {
> 			startIndex:  pg.getStartIndex(),
> 			resultCount: pg.getRowsPerPage()
> 		}
> 	});
> }
> 
> var cols = [
>     { key: 'yui33-hack', label: '' },
>     {
>         key: 'treeblenub', label: '',
>         formatter: Y.Treeble.buildTwistdownFormatter(sendRequest)
>     },
>     {
>         key: 'title', label: 'Title',
>         formatter: Y.Treeble.treeValueFormatter
>     },
>     ...
> ];
> 
> table = new Y.DataTable.Base({columnset: cols});
> table.plug(Y.Plugin.DataTableDataSource, {datasource: ds});
> 
> ```

To see the complete source code, refer to the [live example](http://jafl.github.com/yui3-gallery/treeble/).

The only flies in the ointment are:

-   The yui33-hack column. Due to a [bug in YUI 3.3.0 DataTable](http://yuilibrary.com/projects/yui3/ticket/2529839), the `td` element passed to a column formatter is actually from the _previous_ column. Thus, the first column in the table displays the twistdown, and the second column is empty.
-   Undefined values in the data are displayed as `{value}` instead of blanks ([bug 2529858](http://yuilibrary.com/projects/yui3/ticket/2529858)).

In order to make Treeble easier to use, I have added a Sam skin which styles to the CSS classes written out by the `Y.Treeble` formatters.

Enjoy!

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._