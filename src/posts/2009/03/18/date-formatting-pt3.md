---
layout: layouts/post.njk
title: "Date Formatting with YUI - Part III"
author: "Philip Tellis"
date: 2009-03-18
slug: "date-formatting-pt3"
permalink: /2009/03/18/date-formatting-pt3/
categories:
  - "Development"
---
In [Part I](/yuiblog/blog/2009/02/11/date-formatting-pt1-2/), we saw how to easily format a date using YUI's date formatter and in [Part II](/yuiblog/blog/2009/02/25/date-formatting-pt2/) we looked at formatting dates for the DataTable control. We will now take a look at how to format dates for the [YUI Charts](http://developer.yahoo.com/yui/charts/) control.

Interestingly, it was the Charts control that first led to the development of the date formatter. We were building a time-series chart and needed to format dates differently at various locations. Dates displayed along our X-axis needed to be appropriate to the range represented by the chart. For example, for data spanning months, we wanted the labels to be at a month-day level, and for data data years, we wanted the labels to show month and year. We also wanted the chart's caption to show the entire date range in a human friendly format like "January - March 2008". Finally, the chart needed a tooltip to show the exact date for the mouse hover point.

We could either render all of this date data into pre-formatted strings using PHP on the back end, or we could send the raw date data to the front end and have JavaScript render it appropriately. We went with the second option to reduce the payload size, reduce data redundancy, and to stay more in line with the MVC pattern. The only problem, of course, was that date formatting in JavaScript isn't as easy as PHP's `strftime` or `date` functions. That's when we decided to port `strftime` to JavaScript.

Let's now proceed with an example and attempt to create a chart like the one I've described above. We'll start with the YUI Charts [Quickstart Example](http://developer.yahoo.com/yui/examples/charts/charts-quickstart.html), but instead of working with just month strings, we'll use data based on Unix timestamps and work with data for 15 months.

The DataSource should look like this:

```
YAHOO.example.expenses =
[
    // Note: Unix timestamps output seconds since the Epoch,
    // so multiply by 1000 to get a JS timestamp
	{ date: 1199174400000, rent: 880.00, utilities: 894.68 },
	{ date: 1201852800000, rent: 880.00, utilities: 901.35 },
	{ date: 1204358400000, rent: 880.00, utilities: 889.32 },
	{ date: 1207033200000, rent: 880.00, utilities: 884.71 },
	{ date: 1209625200000, rent: 910.00, utilities: 879.811 },
	{ date: 1212303600000, rent: 910.00, utilities: 897.95 },
	{ date: 1214895600000, rent: 910.00, utilities: 894.68 },
	{ date: 1217574000000, rent: 910.00, utilities: 901.35 },
	{ date: 1220252400000, rent: 910.00, utilities: 889.32 },
	{ date: 1222844400000, rent: 910.00, utilities: 884.71 },
	{ date: 1225522800000, rent: 910.00, utilities: 889.81 },
	{ date: 1228118400000, rent: 910.00, utilities: 897.95 },
	{ date: 1230796800000, rent: 910.00, utilities: 894.68 },
	{ date: 1233475200000, rent: 910.00, utilities: 921.35 },
	{ date: 1235894400000, rent: 910.00, utilities: 889.32 }
];

var st=0; en=YAHOO.example.expenses.length-1;

YAHOO.example.getData = function() {
	var data = [];
	for(var i=st; i<=en; i++) {
		data.push(YAHOO.example.expenses[i]);
	}
	return data;
}

var myDataSource = new YAHOO.util.DataSource( YAHOO.example.getData );
myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
myDataSource.responseSchema =
{
	fields: [ "date", "rent", "utilities" ]
};

```

We use a function to return the data so that we can return subsets of it based on various triggers.

We'll set up most of our chart like the example:

```
// Define multiple series
var seriesDef = 
[
	{ displayName: "Rent", yField: "rent" },
	{ displayName: "Utilities", yField: "utilities" }
];

// Define a custom function to format numbers as currency along the Y-axis
YAHOO.example.formatCurrencyAxisLabel = function( value )
{
	return YAHOO.util.Number.format( value,
	{
		prefix: "$",
		thousandsSeparator: ",",
		decimalPlaces: 2
	});
}

var currencyAxis = new YAHOO.widget.NumericAxis();
currencyAxis.minimum = 800;
currencyAxis.labelFunction = YAHOO.example.formatCurrencyAxisLabel;

// Create a tool tip that shows up when you mouseover a data point
YAHOO.example.getDataTipText = function( item, index, series )
{
	var toolTipText = series.displayName + " for " + item.date;
	toolTipText += "\n" + YAHOO.example.formatCurrencyAxisLabel( item[series.yField] );
	return toolTipText;
}

// Create the chart
var mychart = new YAHOO.widget.LineChart( "chart", myDataSource, {
		series: seriesDef,
		xField: "date",
		yAxis: currencyAxis,
		dataTipFunction: YAHOO.example.getDataTipText
	}
);


```

This chart isn't quite what we wanted though. It displays raw timestamps in the tool tip and on the X-axis. To remedy this, we need to customise both of these using the date formatter. Start with the `getDataTipText` function. Note the changed lines marked in bold:

```
YAHOO.example.getDataTipText = function( item, index, series )
{
	var d = new Date(item.date);
	var sDate = YAHOO.util.Date.format(d, {format: "%B %Y"});
	var toolTipText = series.displayName + " for " + sDate;
	toolTipText += "\n" + YAHOO.example.formatCurrencyAxisLabel( item[series.yField] );
	return toolTipText;
}

```

We also need to define a flexible label formatter for the X-axis:

```
YAHOO.example.xFormat="%b %d";
YAHOO.example.formatDate = function( value )
{
	var d = new Date(value);
	return YAHOO.util.Date.format( d, { YAHOO.example.xFormat });
}

var timeAxis = new YAHOO.widget.TimeAxis();
timeAxis.majorTimeUnit="month";
timeAxis.labelFunction = YAHOO.example.formatDate;

```

And pass this in to the chart constructor. Note the changes to the earlier constructor marked in bold.

```
var mychart = new YAHOO.widget.LineChart( "chart", myDataSource, {
		series: seriesDef,
		xField: "date",
		yAxis: currencyAxis,
		xAxis: timeAxis,
		dataTipFunction: YAHOO.example.getDataTipText
	}
);


```

Finally, we write a little function to draw the caption and change the x-axis label format.

```
function refreshChart() {
	if(this && this.nodeName && this.nodeName.toUpperCase() == 'BUTTON') {
		var range = this.id.split("_");
		st = parseInt(range[1], 10);
		en = parseInt(range[2], 10);
	}
	var caption = '';
	var d1=new Date(YAHOO.example.expenses[st].date);
	var d2=new Date(YAHOO.example.expenses[en].date);

	if(d1.getFullYear() != d2.getFullYear()) {
		caption = YAHOO.util.Date.format(d1, {format: "%b %Y - "})
					+ YAHOO.util.Date.format(d2, {format: "%b %Y"});
		YAHOO.example.xFormat="%b '%y";
	} else if(d1.getMonth() != d2.getMonth()) {
		caption = YAHOO.util.Date.format(d1, {format: "%b - "})
					+ YAHOO.util.Date.format(d2, {format: "%b %Y"});
		YAHOO.example.xFormat="%b";
	} else {
		caption = YAHOO.util.Date.format(d1, {format: "%d %b - "})
					+ YAHOO.util.Date.format(d2, {format: "%d %b, %Y"});
	    YAHOO.example.xFormat="%m-%d";
	}

	YAHOO.util.Dom.get("caption").innerHTML = caption;

	// redraw the chart with the new range of data
	mychart.refreshData();
}

refreshChart();

YAHOO.util.Event.on(document.getElementsByTagName('button'), 'click', refreshChart);

```

This function is called whenever we change the range of data displayed. To do this, we attach it to the `onclick` event of our range selection buttons. We also have to call it right at the start so that the caption is drawn correctly. The markup for the range selection buttons should look like this:

```
<button id="b_0_2">Q1 '08</button>
<button id="b_3_5">Q2 '08</button>
<button id="b_6_8">Q3 '08</button>
<button id="b_9_11">Q4 '08</button>

<button id="b_12_14">Q1 '09</button>
<button id="b_0_14">Entire range</button>

```

Putting it all together, we get a [custom date-formatted chart](/yuiblog/blog-archive/assets/dateformatting/chart.html). Notice how the labels on the X-Axis show abbreviated months and years while the tool tip shows the full month and year.

In the final part of this series, we'll look at date localisation for internationalised web apps.