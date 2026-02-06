---
layout: layouts/post.njk
title: "Automatic conversion from simple, accessible data tables to YUI Charts"
author: "Christian Heilmann"
date: 2008-01-17
slug: "tables-and-charts"
permalink: /2008/01/17/tables-and-charts/
categories:
  - "Development"
---
Charts are a great idea to make rows and rows of boring numbers easier to understand and to take in — for people that can see them. However, not all of your site's visitors can see and you'll also want to keep information you offer available for search engines. There are a lot of libraries on the web that allow you to create charts, but not many take this use case into consideration.

## In praise of data tables

This is where data tables come into play. (**Note:** For the purposes of this article, I'm referring to pure HTML tables — not to rich UI controls like Jenny Han Donnelly's [YUI DataTable Control](http://developer.yahoo.com/yui/datatable/).) They are the perfect data construct in HTML as they are available both for people that can see and those who can't. Assistive technologies like screen readers offer a way to navigate tables and to read their information row-by-row and cell-by-cell. All you need to do to please everyone is to use the correct markup (including a few attributes you might not have used yet):

```
<table summary="Results of a survey of which animals people would like to see more on YDN">
  <caption>What animals would you like to see more?</caption>
  <thead>
    <tr>
      <th scope="col">Animal</th>
      <th scope="col">Requests</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Kittens</td>
      <td>45331</td>
    </tr>
    <tr>
      <td>Puppies</td>
      <td>32323</td>
    </tr>
    <tr>
      <td>Elephants</td>
      <td>12345</td>
    </tr>
    <tr>
      <td>Badgers</td>
      <td>6546</td>
    </tr>
    <tr>
      <td>Sharks (without lasers)</td>
      <td>223</td>
    </tr>
    <tr>
      <td>Sharks (with lasers)</td>
      <td>2323</td>
    </tr>
  </tbody>
</table>
```

The `summary` attribute tells assistive technology what this table is about and the `caption` shows up for all users. The `th` elements define what cells are headers and the `scope` attribute applies them to all the data cells they are connected to. In this case it means that "animal" gets read out before each animal and "requests" before each number. This means that even a visitor who cannot see will still know in row five what the information is about. All in all the table renders as:

What animals would you like to see more?
| Animal | Requests |
| --- | --- |
| Kittens | 45331 |
| Puppies | 32323 |
| Elephants | 12345 |
| Badgers | 6546 |
| Sharks (without lasers) | 223 |
| Sharks (with lasers) | 2323 |

Easy to understand, but not too pretty. And it can get boring. How about we use this information and create a tasty pie chart like the following (click on the image below to see the working example in action)?

[![The accessible table enhanced with a pie chart (image; click through to see working example)](/yuiblog/blog-archive/assets/charttable/chart-table.png)](/yuiblog/blog-archive/assets/charttable/chartsexample.html)

## Using table data to automatically generate charts

In order to have the table be preceeded by a pie chart like this all you need is to add two scripts at the end of the document body and a class called `yui-table` to the table itself. For example:

```
<table class="yui-table" summary="Results of a survey of what browser people love">
  <caption>What browser do you love?</caption>
  <thead>
    <tr>
      <th scope="col">Browser</th>
      <th scope="col">Lovers</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>MSIE</td>
      <td>221</td>
    </tr>
    <tr>
      <td>Firefox</td>
      <td>516</td>
    </tr>
    <tr>
      <td>Opera</td>
      <td>312</td>
    </tr>
    <tr>
      <td>Safari</td>
      <td>100</td>
    </tr>
    <tr>
      <td>Omniweb</td>
      <td>30</td>
    </tr>
    <tr>
      <td>Lynx</td>
      <td>4</td>
    </tr>
  </tbody>
</table>
<script src="http://yui.yahooapis.com/2.4.1/build/yuiloader/yuiloader-beta-min.js"></script>
<script src="tablestoyuicharts.js"></script>
```

This will show in a browser with the latest Flash plugin like this:

[![The accessible table enhanced with a pie chart (image; click through to see working example)](/yuiblog/blog-archive/assets/charttable/chart-table2.png)](/yuiblog/blog-archive/assets/charttable/chartsexample.html)

You can define the size of the chart in CSS by defining a width and height for each div element with a class of `yuichartfromtable`:

```
div.yuichartfromtable{
  width:300px;
  height:300px;
  margin:0 auto;
}

```

As for the scripts: the first script is the [YUI Loader Utility](http://developer.yahoo.com/yui/loader) which allows you to pull in YUI components on-demand. This is great, as you don't need to add lots and lots of `script` elements but let the YUI Loader figure out what it needs. You can [download the second script here](/yuiblog/blog-archive/assets/charttable/tablestoyuicharts.js); if you care to know what is going on with it, check the following section. If you just want to use the script, then you're done :-).

## How does this work?

The script to turn all tables with the class `yui-table` into charts is quite short, as it uses the newer YUI components that take a lot of the heavy lifting off you, especially the table-to-dataset conversion which is done by the [YUI DataSource Utility](http://developer.yahoo.com/yui/datasource). The full script is this:

```

var tablestoYUIchartsplease = new YAHOO.util.YUILoader({
  require: ['charts'],
  onSuccess: function(){
    var tables = YAHOO.util.Dom.getElementsByClassName('yui-table','table');
    YAHOO.util.Dom.batch(tables,function(o){
      var chartcontainer = document.createElement('div');
      YAHOO.util.Dom.addClass(chartcontainer,'yuichartfromtable');
      YAHOO.util.Dom.insertBefore(chartcontainer,o);
      var data = new YAHOO.util.DataSource(o);
      data.responseType = YAHOO.util.DataSource.TYPE_HTMLTABLE;
      data.responseSchema = {fields:['response','count']};
      YAHOO.widget.Chart.SWFURL = 'http://developer.yahoo.com/yui/build/charts/assets/charts.swf?_yuiversion=2.4.1';
      var chart = new YAHOO.widget.PieChart(chartcontainer,data,{
        categoryField:'response',
        dataField:'count',
        expressInstall:'http://developer.yahoo.com/yui/build/charts/assets/expressinstall.swf'
      });
    });
  }
});
if(document.location.toString().indexOf('http')!==-1){
  tablestoYUIchartsplease.insert();
}
```

Let's chunk it up and see what each section does:

```
var tablestoYUIchartsplease = new YAHOO.util.YUILoader({
  require: ['charts'],
  onSuccess: function(){

```

First up, we let the [YUI Loader](http://developer.yahoo.com/yui/loader) do its magic: We instantiate a new loader, tell it we need the [YUI Charts Control](http://developer.yahoo.com/yui/charts) and wait for the different script nodes to be generated and the components to be loaded before we continue. The loader tells us all is OK by firing the `onSuccess` event, which we use to execute an anonymous function that does all the other work.

```
    var tables = YAHOO.util.Dom.getElementsByClassName('yui-table','table');
    YAHOO.util.Dom.batch(tables,function(o){

```

We use [the YUI Dom Collection](http://developer.yahoo.com/yui/dom) to get all tables with the correct class and apply a function to each of these tables using the `batch` method. The method sends the current table as the parameter `o` to this function.

```
      var chartcontainer = document.createElement('div');
      YAHOO.util.Dom.addClass(chartcontainer,'yuichartfromtable');
      YAHOO.util.Dom.insertBefore(chartcontainer,o);

```

We create a new `div` element, give it a class of `yuichartfromtable` (to allow for styling) and insert the new element into the document before the table.

```
      var data = new YAHOO.util.DataSource(o);
      data.responseType = YAHOO.util.DataSource.TYPE_HTMLTABLE;
      data.responseSchema = {fields:['response','count']};

```

Then we allow the rather new [YUI DataSource Utility](http://developer.yahoo.com/yui/datasource) to flex its binary muscles. While this is meant to wade through external data sources and JavaScript arrays for you, it also allows for a `responseType` of HTML table, which means it converts a table to a JavaScript object you can work with. As we're dealing here with a really simple table, all we need to do in terms of `responseSchema` is to define two fields: a `response` (what) and a `count` (how many). These three lines are all you need to convert the table to a dataset that both the [YUI Charts Control](http://developer.yahoo.com/yui/charts) and the [YUI DataTable Control](http://developer.yahoo.com/yui/datatable) can use.

```
      YAHOO.widget.Chart.SWFURL = 'http://developer.yahoo.com/yui/build/charts/assets/charts.swf?_yuiversion=2.4.1';
      var chart = new YAHOO.widget.PieChart(chartcontainer,data,{
        categoryField:'response',
        dataField:'count',
        expressInstall:'http://developer.yahoo.com/yui/build/charts/assets/expressinstall.swf'
      });

```

Time for pie: we define the URL of the Flash movie that draws the pie and instantiate a new pie chart. We send the `div` we created earlier as the container, the `data` we retrieved from the table as the data to display and define a configuration object. This object has the `response` field as the categories and the `count` field as the data. The `expressinstall` defines what Flash movie to show if the visitor doesn't have the right Flash version.

```
    });
  }
});
if(document.location.toString().indexOf('http')!==-1){
  tablestoYUIchartsplease.insert();
}
```

Almost done. All the script now needs to do is to call the `insert()` method of the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) — that gets the ball rolling. I've enclosed the method in an `if` statement that checks if the HTML is called up via HTTP or not as the Charts Control needs HTTP to work.

## Summary

That's all you need to do to progressively enhance an accessible data table to turn them into a pie chart using the YUI Charts Control. We can extend this example to allow for several types of charts and to turn the tables into sortable data tables quite easily. If there is interest, drop us a comment.