---
layout: layouts/post.njk
title: "Treeble:  Using Nested YUI 2 DataSources for Row Expansion"
author: "John Lindal"
date: 2010-04-14
slug: "treeble-using-nested-yui-2-datasources-for-row-expansion"
permalink: /blog/2010/04/14/treeble-using-nested-yui-2-datasources-for-row-expansion/
categories:
  - "Development"
---
Daniel Barreiro's recent post about nested tables reminded me that it was about time I finished my "treeble" widget. "Treeble" comes from merging "tree" and "table." The original motivation was to enable drilling into the details behind each row in a table, e.g., start with a table which displays sales figures for each continent and then drill into each country, region, and city. Of course, once I started building it, the natural design was to support any hierarchy of data. As an example, it can display a tree like this:

[![](http://jafl.github.com/yui2/treeble/example_all.png)](http://jafl.github.com/yui2/treeble/)

(Click the screenshot to play with this example.)

### Overview

The treeble widget consists of two parts. The first is a small extension to YUI DataTable for opening/closing nodes in the tree. (This is done by augmenting DataTable in order to allow it to work transparently with existing extensions to DataTable, most notably ScrollingDataTable.) The second part of treeble is a significant extension to YUI DataSource, called TreebleDataSource, which merges the results from simple, flat data sources. The tree is built dynamically, so you don't have to load all your data at once.

The tricky part is paginating the tree: knowing the subset of nodes which have been opened, request only the visible items. TreebleDataSource provides two options:

1.  Paginate top-level nodes only, so all their children can be visible on the same page (the default)
2.  Paginate so a fixed number of nodes are visible

#1 is ideal when the tree is shallow and there are only a few children per node. #2 is necessary when there may be a very large number of children per node. The configuration option that controls this behavior is `paginateChildren`. **In order for pagination to work, the total number of items available from each simple data source must not change.**

Since all the items from all the simple data sources are displayed in a single table with a single set of columns, **the schema given to DataTable must be the union of all the flat data source schemas**. For example, in the above screenshot, DataTable must have a column for Quantity even though it is only defined for the leaf nodes.

Obviously, rows in the table no longer map directly to records in the simple data sources. Instead, each record in the DataTable has three special members:

`_yui_node_ds`

The DataSource from which the record was retrieved. If you allow inline editing, this tells you which DataSource to use when saving the new value. (You can edit the Quantity column in the [live example](http://jafl.github.com/yui2/treeble/).)

`_yui_node_depth`

The depth of the node in the tree. Top-level nodes have depth zero. This is useful when indenting child nodes, as in the above screenshot.

`_yui_node_path`

Array of node indices leading to the record. For example, `[2,5,1]` translates to second child of the sixth child of the third top-level node. `DataTable.rowIsOpen()` and `DataTable.toggleRow()` require this array to identify the node.

The YUIDoc for TreebleDataSource and the extensions to DataTable is [here](http://jafl.github.com/yui2/treeble/yuidoc/).

### Configuring DataTable

To work with TreebleDataSource, your YUI DataTable must be configured correctly:

```
var myDataSource = new YAHOO.util.TreebleDataSource(...);
var myDataTable = new YAHOO.widget.DataTable(container, columns, myDataSource,
{
  dynamicData:true,
  generateRequest: YAHOO.widget.DataTable.generateTreebleDataSourceRequest,
  displayAllRecords: the opposite of your TreebleDataSource's paginateChildren value,
  other configuration, e.g., paginator
});

```

The special version of `generateRequest` is required because TreebleDataSource needs to receive a known data format so it can correctly generate the requests to the individual simple data sources.

### Constructing TreebleDataSource

When you construct TreebleDataSource, you must pass it an instance of YUI DataSource as `oLiveData`. One column in the data schema for this data source must have its parser set to either `"datasource"` or a custom parsing function which does the same job: construct a new YUI DataSource from the value in the column. The default data source parser ignores falsey values and constructs a data source from any truthy value, e.g., an array of objects, an XHR URL, or an object which defines `dataType` and `liveData`. The configuration (including `responseSchema` and `treebleConfig`) for the new data source is copied from the parent data source. Writing a custom datasource parser is discussed later in this post.

TreebleDataSource itself has only one configuration parameter, `paginateChildren`, which controls the pagination behavior, as discussed earlier. The majority of the treeble-related configuration is set on the simple data sources via the `treebleConfig` object. This allows the configuration to be different for each simple data source, as discussed below in the section on mixed data sources.

#### Using local DataSources

The [live example](http://jafl.github.com/yui2/treeble/) demonstrates how to work with local DataSources. The only required values in `treebleConfig` are `generateRequest` and `totalRecordsReturnExpr`:

```
new LocalDataSource(array,
{
  ...,
  treebleConfig:
  {
    totalRecordsReturnExpr: '.meta.totalRecords',
    generateRequest: function(state, path)
    {
      return state;
    }
  }
});

```

Since LocalDataSource ignores all request parameters, `generateRequest` could actually return null, but it echoes the state object instead to support extensions which can sort the data.

Setting `totalRecordsReturnExpr` signals TreebleDataSource that the simple data source will return all its records, not just the requested slice. The actual value of `totalRecordsReturnExpr` must be an [OGNL](http://en.wikipedia.org/wiki/OGNL) expression specifying where in the `oParsedResponse` object returned by TreebleDataSource to store the total number of visible nodes, based on which nodes are currently open. In the example, this is `oParsedResponse.meta.totalRecords`. Since DataTable has (and must have!) `dynamicData` set to `true`, the live example also overrides `DataTable.handleDataReturnPayload` to set `oPayload.totalRecords=oParsedResponse.meta.totalRecords`. This gives the paginator the information it needs to compute the total number of pages.

#### Using XHR DataSources

An example configuration when using XHR DataSources would be to construct the top-level data source as:

```
new XHRDataSource(url,
{
  ...,
  treebleConfig:
  {
    startIndexExpr: '.meta.startIndex',
    totalRecordsExpr: '.meta.totalRecords',
    generateRequest: function(state, path)
    {
      return 'path='+path.join(',')+
                 '&startIndex='+state.startIndex+
                 '&results='+state.results+
                 '&sort='+state.sort+
                 '&dir='+state.dir;
    }
  }
});

```

In this example, `generateRequest` returns query args which the server will interpret in order to return the appropriately sorted slice of the children of the node specified by `path`.

The value of `startIndexExpr` is an [OGNL](http://en.wikipedia.org/wiki/OGNL) expression specifying where in the `oParsedResponse` object returned by the simple data source the index of the first returned node is stored. In the example, this is `oParsedResponse.meta.startIndex`.

The value of `totalRecordsExpr` is an [OGNL](http://en.wikipedia.org/wiki/OGNL) expression specifying where in `oParsedResponse` the total number of nodes is stored. In the example, this is `oParsedResponse.meta.totalRecords`. `totalRecordsExpr` also specifies where in the `oParsedResponse` object returned by TreebleDataSource to store the total number of visible nodes, based on which nodes are currently open.

Since DataTable has (and must have!) `dynamicData` set to `true`, you would also have to override `DataTable.handleDataReturnPayload` to set `oPayload.totalRecords=oParsedResponse.meta.totalRecords`. This gives the paginator the information it needs to compute the total number of pages.

#### Using Mixed DataSources

TreebleDataSource does not require that all the simple data sources be the same type. For example, if you have a large number of top-level nodes, but only a small tree of children for each node, then it makes sense to return the entire tree when a top-level node is opened. The default data source parser actually handles this automagically if you specify `startIndexExpr`, `totalRecordsExpr`, and `totalRecordsReturnExpr` for the top-level data source!

If you have only a few top-level nodes, but each tree of children is huge, then your top-level data source could use local data, and you could build a custom data source parser which instantiates XHR data sources for the children, setting `startIndexExpr`, `totalRecordsExpr`, and `generateRequest` appropriately.

You are only limited by your ability to comprehend the complexity of the system!

Note that, when using a custom data source parser, you must define `childNodesKey` in `treebleConfig` for each simple data source so TreebleDataSource knows the name of the data source column. (When you use the default parser, this is detected automatically.)