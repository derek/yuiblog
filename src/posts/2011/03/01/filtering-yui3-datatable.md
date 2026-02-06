---
layout: layouts/post.njk
title: "Filtering the Data Displayed by YUI 3 DataTable"
author: "John Lindal"
date: 2011-03-01
slug: "filtering-yui3-datatable"
permalink: /2011/03/01/filtering-yui3-datatable/
categories:
  - "Development"
---
In addition to sorting, which is supported by [YUI 3 DataTable](http://developer.yahoo.com/yui/3/datatable/), it is often useful to be able to filter the data and display a subset of the available rows. The [Query Builder](http://yuilibrary.com/gallery/show/querybuilder) widget in the [YUI 3 Gallery](http://yuilibrary.com/gallery/) provides a UI for constructing a simple filter expression.

[![](http://jafl.github.com/yui3-gallery/querybuilder/example.gif)](http://jafl.github.com/yui3-gallery/querybuilder/)

([Click the screenshot to play with this example](http://jafl.github.com/yui3-gallery/querybuilder/ "YUI 3 Query Builder Example").)

### History

The first version was written by a colleague working with me on the Yahoo! Publisher Network (YPN). (He left soon afterwards to attempt honest employment. Following the precedent set by Jamie Zawinski, he opened a pub to sell beer -- home brewed, no less! But I digress....) After hacking together the first version of Query Builder, he made the mistake of showing it to me. A few days later, he complained, "You rewrote the whole thing!" In fact, I have rewritten it several times over the years. YPN is gone, but the latest YUI 2 version of Query Builder powers all data tables in [APT](http://apt.yahoo.com/), Yahoo's display advertising management platform. The port to YUI 3 is actually the least amount of work I have had to do to generate a new version!

### How the example works

The core of the example is (1) the Query Builder configuration which specifies how the user can filter the data and (2) the extension to Y.DataSource.Local which implements the filter. (For server side pagination, you would send the filter data to the server and bake it into your SQL query.)

To configure Query Builder, the example first defines a list of the variables that can be filtered:

```
var var_list =
[
	{
		name: 'title',
		type: 'string',
		text: 'Title'
	},
	{
		name: 'year',
		type: 'number',
		text: 'Year',
		validation: 'yiv-integer:[0,2100]'
	},
	{
		name: 'quantity',
		type: 'number',
		text: 'Quantity',
		validation: 'yiv-integer:[0,]'
	}
];

```

Each variable is assigned a name (matching the key in the DataTable column configuration) and a type. The default types are 'string', 'number', and 'select', but you can extend this by building custom plugins ([see below](#plugins)). For each type that you use, you must also define a set of operators:

```
var ops =
{
	string:
	[
		{ value: 'contains',    text: 'Contains' },
		{ value: 'starts-with', text: 'Starts with' },
		{ value: 'ends-with',   text: 'Ends with' }
	],

	number:
	[
		{ value: 'equal',   text: '=' },
		{ value: 'less',    text: '<=' },
		{ value: 'greater', text: '>=' }
	]
};

```

This specifies the operators that the user can apply to each variable type. (If you need different sets of operators for variables of the same fundamental type, you can clone the type. See the [Plugins](#plugins) section below.)

[Y.FormManager](http://yuilibrary.com/gallery/show/formmgr) is used to validate the values entered by the user before the filter is applied. The validation key for each variable in the above Query Builder configuration provides CSS data which is interpreted by Y.FormManager.

If all validations pass, a request is sent to the data source. The extension to `Y.DataSource.Local` is quite simple. It merely filters the data before returning the results:

```
Y.extend(CustomDataSource, Y.DataSource.Local,
{
	_defDataFn: function(e)
	{
		var data = filterData(e.data, e.request.filter);
		var response =
		{
			results: data.slice(e.request.recordOffset,
						e.request.recordOffset + e.request.rowsPerPage),
			meta:
			{
				totalRecords: data.length
			}
		};

		this.fire("response", Y.mix({response: response}, e));
	}
});

```

The `filter` element of the request is obtained from [`QueryBuilder.toDatabaseQuery()`](http://jafl.github.com/yui3-gallery/querybuilder/yuidoc/QueryBuilder.html#method_toDatabaseQuery), which returns a list of `[variable, operator, value]` tuples. Also note that the response must include information on the total number of records, since this changes based on the filter being applied.

`filterData()` simply loops over the tuples from `toDatabaseQuery()`, applying the filter operators defined in a two level lookup table:

```
var filters =
{
	string:
	{
		contains: function(value, filter)
		{
			return (value.indexOf(filter) >= 0);
		},
		'starts-with': function(value, filter)
		{
			return (value.substr(0, filter.length) == filter);
		},
		'ends-with': function(value, filter)
		{
			return (value.substr(-filter.length) == filter);
		}
	},

	number:
	{
		equal: function(value, filter)
		{
			return (parseInt(value, 10) == parseInt(filter, 10));
		},
		less: function(value, filter)
		{
			return (parseInt(value, 10) <= parseInt(filter, 10));
		},
		greater: function(value, filter)
		{
			return (parseInt(value, 10) >= parseInt(filter, 10));
		}
	}
};

```

After all this, DataTable simply displays what it receives from the data source.

### Plugins

[`Y.QueryBuilder.plugin_mapping`](http://jafl.github.com/yui3-gallery/querybuilder/yuidoc/Types.js.html) defines the mapping of type names to actual classes. You can augment this mapping in two ways:

1.  Clone an existing type by defining a new name for the same class. This allows different sets of operators for different variables of the same fundamental type.
2.  Create a new type by implementing the [plugin API](http://jafl.github.com/yui3-gallery/querybuilder/yuidoc/QueryBuilder.html). Studying the source code for the existing plugins is the best way to get a feel for how this API works.

### Generalizing Query Builder

Query Builder does not support parentheses, so you can either AND all the conditions or OR all the conditions. While it is possible to introducing parentheses into a graphical representation of a Boolean expression, all the designs that I have seen are too cumbersome to use. A textual representation is much simpler and easier to manipulate. [Expression Builder](http://yuilibrary.com/gallery/show/exprbuilder) incorporates Query Builder into a widget that allows constructing a textual representation without having to remember the syntax or type everything in by hand.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._