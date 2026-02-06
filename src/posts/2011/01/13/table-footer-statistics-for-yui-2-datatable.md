---
layout: layouts/post.njk
title: "Table footer statistics for YUI 2 DataTable"
author: "YUI Team"
date: 2011-01-13
slug: "table-footer-statistics-for-yui-2-datatable"
permalink: /2011/01/13/table-footer-statistics-for-yui-2-datatable/
categories:
  - "Development"
---
The YUI 2 DataTable does a lot. But one of the things it doesn't do is anything with a table footer, where you might expect to find totals, averages or other summary data. So I've extended DataTable to add summary data for numeric data.[![](/yuiblog/blog-archive/assets/datatable-footer/screenshot.png)](http://mattparker.github.com/datatable/colstats.html "DataTable footer extension")

### Getting it going

First, to use it: you'll need some code from [github](https://github.com/mattparker/Yui-DataTable-extension-summary-statistics) - there are three js files, and you'll need all of them on your page after the YUI DataTable js file. And you might want to change the namespace - we use `YAHOO.LPLT.DataTable` as the extension of `YAHOO.widget.DataTable`. I'll explain a bit more about these files below.

You set up your datatable as normal, but there are three things you need to do to get the summary working:

1.  Make sure your datasource specifies "number" parsers for any fields you want to summarise, particularly if you're doing inline cell editing:
    ```
    myDataSource.responseSchema = {fields: [
       {key: "quantity", parser: "number"}
       /* etc... */
    ]};
    
    ```
    
2.  Add a config key-value of columnStats: true in your column definition array:
    ```
    var myColumnDefs = [
        {key: "quantity", label: "Quantity", columnStats: true} 
        /* etc... */
    ];
    
    ```
    for the columns that you'd like summarised. (The total of your 'id' column is probably not very helpful!).
3.  Tell the datatable which statistics to calculate:
    ```
    var myDataTable = new YAHOO.LPLT.DataTable("exampleEl",
        myColumnDefs, 
        myDataSource, 
        {columnStats: {on: true, stats: ['sum']}}
    );
    
    ```
    This is the simplest possible way to configure the column statistics, but you can add extra statistics, customise the labels, and more.

There's an example [on github](http://mattparker.github.com/datatable/colstats.html) to play with.

### A few points:

-   The footer will change with your table. So if you show/hide columns, move them around, add new ones, add/remove rows, sort, or use inline cell editors, the footer will update the UI and statistics accordingly.
-   You can add as many rows to the footer as you like, one row for each statistic. As it stands, you can have mean, median, sum, min, max, range, stdev, variance, or varianceUnbiased. The 'stats' item in the configuration is an array: just add the statistics you'd like to this array (e.g. `stats: ["min", "median", "stdev"]`).
-   The table footer will use any formatters specified for that column.
-   If you have a paginator, you can choose whether the statistics shown are for the entire table or just the currently visible page. Add `pagedTotals: true` to the columnStats object to have page statistics.
-   The 'stats' array in the config object can also include object literals, with keys 'label' and 'fn'. fn is the function that will calculate statistics - either a string like 'min' or a function that returns a number. The example on github shows how you could do a 'weighted total' using data from two columns.

### More on the actual extension code

The main file, YAHOO\_DataTable\_colStats.js, adds a couple of protected properties to the datatable, a few protected methods, and two public methods, `colStatsRefresh` which will re-calculate and redraw the table footer, and `colStatsGetRecordSet`, which returns an array either of all records, or just those visible, depending on the value of `pagedTotals`. The first may be useful if you're making changes to the table that don't fire useful events (for example directly changing data in the underlying RecordSet); the second if you're using custom summary functions.

YAHOO\_DataSource\_patch.js adds a `parseField(key, value)` method to DataSource. This is needed when you have textbox inline cell editors for numeric data; the editor returns a string, which is not parsed automatically, and so can't be added. The parseField provides access to the parsers specified in the DataSource, to convert edited data.

YAHOO\_util\_Stats.js provides a standalone `YAHOO.util.Stats` class which wraps a (sorted) array of numeric data and provides the summary statistics. It's only dependency is YAHOO.lang. A YAHOO.util.Stats instance is maintained by the DataTable for each column that is to be summarised, and caches some of the harder maths to improve performance. The strings passed in to the stats array ('min', 'median' etc) are methods of the YAHOO.util.Stats class, so you could easily add additional ones by adding to the prototype. Note though that they only have access to 'their' column's data.

### And finally

I'm pretty sure this isn't going to work with scrolling datatables, so I've not even tried it! But if you find any problems or have ideas, do please put them on the github issue tracker.