---
layout: layouts/post.njk
title: "In the YUI 3 Gallery:  Bulk Editor Widget"
author: "John Lindal"
date: 2011-12-05
slug: "bulk-edi"
permalink: /2011/12/05/bulk-edi/
categories:
  - "YUI 3 Gallery"
  - "Development"
---
The [QuickEdit plugin](/yuiblog/blog/2011/04/19/quickedit-datatable-yui3/) for [YUI 3 DataTable](http://developer.yahoo.com/yui/3/datatable/) makes it easy to edit an entire page of records as an atomic operation. However, sometimes you need to do even more. For example, you might have to simultaneously edit more records than you can comfortably fit on a single page. Or you might need to support adding, duplicating, and removing records as part of the atomic operation. Or you might wish to visually group fields by placing them in a single table cell. The [Bulk Editor](http://yuilibrary.com/gallery/show/bulkedit) widget supports all these possibilities.

[![](http://jafl.github.com/yui3-gallery/bulkedit/example.gif)](http://jafl.github.com/yui3-gallery/bulkedit/ "YUI 3 Bulk Editor Screenshot")

([Click the screenshot to play with this example](http://jafl.github.com/yui3-gallery/bulkedit/ "YUI 3 Bulk Editor Example").)

### Overview

The Bulk Editor widget consists of three components:

`Data source`

This wraps a YUI DataSource and manages the changes: insertions, removals, and changed values.

`Base widget`

This provides the basic structure for editing by managing records and fields within each record. Derived classes are responsible for rendering each record into a separate row, which could be a div, a tbody, or some other container.

`HTML table implementation`

This extends the base widget to render each record into a tbody in an HTML table. The column configuration determines which field is displayed in each column of the table. A custom cell formatter can be used to render multiple fields in a single table cell.

### Configuration

In the example that generated the above screenshot, the configuration has been kept as simple as possible:

`fields` defines the editable values in each record. The default type is input. The other valid types are select and textarea. (select requires a list of values.) Basic validation is provided by [Form Manager](http://yuilibrary.com/gallery/show/formmgr-css-validation) gallery module. This covers [required fields, length restrictions, and numeric ranges](http://jafl.github.com/yui3-gallery/yuidoc/module_gallery-formmgr-css-validation.html). More complex validation can be performed by specifying `regex` or your own function (`fn`). Here is an excerpt from the live example:

```
var fields =
{
	title:
	{
		type: 'textarea'
	},
	year:
	{
		validation:
		{
			css: 'yiv-integer:[1500,2100]'
		}
	},
	color:
	{
		type: 'select',
		values:
		[
			{ value: 'red',   text: 'Red'   },
			{ value: 'green', text: 'Green' },
			{ value: 'blue',  text: 'Blue'  }
		]
	}
};

```

`Y.BulkEditDataSource` requires an instance of `Y.DataSource` and the following parameters:

`uniqueIdKey`

The name of a key which uniquely identifies each record.

`generateRequest`

A function to generate request parameters for `Y.DataSource`. (This is empty in the example, because `Y.DataSource.Local` always returns all the data.)

`extractTotalRecords`

A function to extract the total number of records from the `Y.DataSource` response.

Since the example uses `Y.DataSource.Local`, `totalRecordsReturnExpr` is also required. This OGNL expression specifies where in the response to store the total number of records. (Notice that `extractTotalRecords` reads this value.)

```
var ds = new Y.BulkEditDataSource(
{
	ds:                     raw_ds,
	uniqueIdKey:            'id',
	generateRequest:        function() { },
	totalRecordsReturnExpr: '.meta.totalRecords',
	extractTotalRecords:    function(response)
	{
		return response.meta.totalRecords;
	}
});

```

`Y.HTMLTableBulkEditor` requires the data source, the field configuration, and the column configuration. In the column configuration, the key is the field name, unless you specify a custom formatter. The label is used as the column title. Here is an excerpt from the live example:

```
var columns =
[
	{
		key:       'checkbox',
		label:     '<input type="checkbox" id="select-all" />',
		formatter: function(o)
		{
			var markup = '<input type="checkbox" class="record-select" id="{id}" />';
			o.cell.set('innerHTML', Y.Lang.sub(markup,
			{
				id: this.getRecordId(o.record)
			}));
		}
	},
	{ key: 'title', label: 'Title' },
	{ key: 'year', label: 'Year' },
	{ key: 'color', label: 'Color' }
];

```

(Note that the live example defines a minor extension to `Y.HTMLTableBulkEditor` to handle the checkbox column.)

You can also pass an instance of [`Y.Paginator`](http://yuilibrary.com/gallery/show/paginator) to `Y.BulkEditDataSource`. This is demonstrated in a separate, more complicated [live example](http://jafl.github.com/yui3-gallery/bulkedit/complex.html).

### Local vs. Remote Data Sources

When deciding whether to use a local or a remote datasource, you must carefully consider the trade-offs. The obvious trade-off is that a local datasource is faster when paginating, but the initial page load will take longer, and it requires more memory on the client.

The Bulk Editor widget imposes additional trade-offs, however.

First, the YUI DataSource must return immutable data. This is automatic for local data sources, but can be tricky to implement for remote data sources. You will need to lock the rows in your database table for the duration of the bulk edit operation if more than one user is allowed to modify them.

Second, the choice between local and remote data source affects how you are allowed to save the data. When you use a local data source, you can do best effort saving, i.e., save all the valid records to the server, remove them from the local datasource, and allow the user to focus on the records that have invalid values. When you use a remote data source, the immutability requirement only allows you to do all or nothing saving, i.e., the data can only be saved after all the data is valid.

### Real-world Use Case

The original motivation for the Bulk Editor widget was to allow post-processing of an uploaded spreadsheet. Introducing a post-processing step removes the need for the spreadsheet values to be perfect. Errors can be flagged and fixed in the Bulk Editor widget instead of rejecting the entire upload. In addition, processing on the server can do best-guess assignment of additional values required for each record, and the user can check and fix these extra values before saving. This simplifies the initial creation of the spreadsheet.

In this scenario, a remote data source is the best choice. The uploaded data is stored in a scratch space, and is therefore guaranteed immutable, since no other user can see it. "All or nothing" saving is appropriate: Once all the errors have been fixed, the save operation is atomic, just like a standard upload operation.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._