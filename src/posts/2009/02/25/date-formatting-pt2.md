---
layout: layouts/post.njk
title: "Date Formatting with YUI - Part II"
author: "Philip Tellis"
date: 2009-02-25
slug: "date-formatting-pt2"
permalink: /2009/02/25/date-formatting-pt2/
categories:
  - "Development"
---
In [Part I](/yuiblog/2009/02/11/date-formatting-pt1-2/), we saw how to format a date using YUI's date formatter. In Part II, we'll look at formatting dates for a specific use case — inside the [DataTable](http://developer.yahoo.com/yui/datatable/) control.

DataTables are a great tool for presenting all types of data to the users of your website, including dates. As we've seen in Part I, the date formatter makes it easy to transform a Date object into a formatted string. For this example, we'll take DataTable's [Basic Example](http://developer.yahoo.com/yui/examples/datatable/dt_basic.html) and add a custom date formatter to it. We'll start with the includes we need:

```
<!-- Individual YUI CSS files --> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/datatable/assets/skins/sam/datatable.css"> 

<!-- Individual YUI JS files --> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/datasource/datasource-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/element/element-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/datatable/datatable-min.js"></script> 

```

Next, we'll add markup to input a user-defined format and to trigger a DataTable redraw:

```
<label>Format: <input type="text" id="date-format" value="%b %d %Y" size="30"></label> <input type="button" id="render-table" value="Redraw">

<div id="basic"></div>

```

The key here is to define a custom date formatter:

```
YAHOO.namespace("YAHOO.example.DateFormatter");
YAHOO.example.DateFormatter.formatDate = function(elCell, oRecord, oColumn, oData) {
	var el = document.getElementById("date-format");
	var sFormat = el.value;

	var str = YAHOO.util.Date.format(oData, {format: sFormat});
	elCell.innerHTML = str;
}

```

And finally, here is the JavaScript to create the DataTable. Note that we point the formatter for the "date" column to our own:

```
YAHOO.example.Data = {
    bookorders: [
        {id:"po-0167", date:new Date(1980, 2, 24), quantity:1, amount:4},
        {id:"po-0783", date:new Date("January 3, 1983"), quantity:null, amount:12.12345},
        {id:"po-0297", date:new Date(1978, 11, 12), quantity:12, amount:1.25},
        {id:"po-1482", date:new Date("March 11, 1985"), quantity:6, amount:3.5}
    ]
};

var myColumnDefs = [
	{key:"id", sortable:true},
	{key:"date", formatter:YAHOO.example.DateFormatter.formatDate,
			sortable:true, sortOptions:{defaultDir:YAHOO.widget.DataTable.CLASS_DESC}},
	{key:"quantity", formatter:YAHOO.widget.DataTable.formatNumber, sortable:true},
	{key:"amount", formatter:YAHOO.widget.DataTable.formatCurrency, sortable:true}
];

var myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.bookorders);
myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
myDataSource.responseSchema = {
	fields: ["id","date","quantity","amount"]
};

var myDataTable = new YAHOO.widget.DataTable( "basic", myColumnDefs, myDataSource );

```

For our example, we'll also include an event handler to redraw the table when the "Redraw" button is clicked:

```
YAHOO.util.Event.addListener("render-table", "click", myDataTable.render, myDataTable, true);

```

Putting it all together, we get a [DataTable with customizeable date formating](/yuiblog/blog-archive/assets/dateformatting/datatable.html).

In this example, our DataSource holds actual Date objects. This isn't strictly necessary. For an application to support internationalization, date/time information should be stored and transmitted in UTC. For instance, if your data resides on your server as a `DATETIME` field in a MySQL database, then the best way to convert it to a Unix timestamp is to use the `UNIX_TIMESTAMP()` function:

```
SELECT id, UNIX_TIMESTAMP(pubdate) AS date, quantity, amount FROM bookorders;

```

Other database engines have their own method of extracting a Unix timestamp.

The result set can then be JSON encoded using a server-side JSON library in your language of choice, before it is passed back to the browser. In PHP, we'd do something like this:

```
$bookorders = array();
while($row = mysql_fetch_assoc($results))
{
	$bookorders[] = $row;
}
header("Content-type: application/json");
echo json_encode($bookorders);

```

On the client side, we'd receive this data using an [XHRDataSource](http://developer.yahoo.com/yui/datasource/#xhr):

```
var myDataSource = new YAHOO.util.XHRDataSource("http://hostname/your/script.php");
myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
// See DataSource documentation for full details

```

Since your data comes in as JSON from the server, you're probably better off passing dates in as Unix timestamps and using the Date constructor inside your formatter:

```
YAHOO.example.Data = {
    "bookorders': [
        {id:"po-0167", date:320227200, quantity:1, amount:4},
        {id:"po-0783", date:410428800, quantity:null, amount:12.12345},
        {id:"po-0297", date:279705600, quantity:12, amount:1.25},
        {id:"po-1482", date:479376000, quantity:6, amount:3.5}
    ]
};

YAHOO.example.DateFormatter.formatDate = function(elCell, oRecord, oColumn, oData) {
	var el = document.getElementById("date-format");
	var sFormat = el.value;

	var oDate = new Date(oData*1000);

	var str = YAHOO.util.Date.format(oDate, {format: sFormat});
	elCell.innerHTML = str;
}

```

Note that we multiply the Unix timestamp by 1000 because the Unix timestamps we received were in seconds, while the Date constructor requires milliseconds.

That's all for now. In Part III, we'll look at formatting dates in the [Charts control](http://developer.yahoo.com/yui/charts/).