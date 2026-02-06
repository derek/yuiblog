---
layout: layouts/post.njk
title: "Using Nested YUI 2 DataTables for Row Expansion"
author: "YUI Team"
date: 2010-03-17
slug: "using-nested-datatables-for-row-expansion"
permalink: /2010/03/17/using-nested-datatables-for-row-expansion/
categories:
  - "Development"
---
As usual, it is developers on the [YUI forums](http://yuilibrary.com/forum/index.php) who come up with the most interesting questions (tip: this makes the forums a good place to hang around). Recently, someone asked the following: [Using YUI 2 DataTable](http://developer.yahoo.com/yui/datatable/ "YUI 2: DataTable"), could you nest a child table to provide details about a row when it is "expanded" in a master table? It has been asked a few times before, but I haven't had a good solution to share in the past. Now I do have a solution, and you can find it, along with my other examples, [here](http://www.satyam.com.ar/yui/2.8.0/nested.html).

This is what it looks like:

[![](/yuiblog/blog-archive/assets/nested.png)](http://www.satyam.com.ar/yui/2.8.0/nested.html)

The top input box is actually a [YUI 2 AutoComplete](http://developer.yahoo.com/yui/autocomplete/ "YUI 2: AutoComplete") box where you can first look for a particular music artist. When you find in the dropdown list the artist you are looking for, selecting it will bring up a DataTable listing all the albums for that artist, ordered with the most recent albums at the top. The \[+\] sign to the left of each row allows for that row to expand; when the row expands, a nested DataTable is displayed listing the tracks in the selected album.

The nested child table is indented to the right, leaving the column with the expand/collapse icon encompassing it. Several child tables can be open at the same time. The master table can be sorted and the child tables will move along with their master records.

The technique we're using here involves changing the height of the row in the master table so that it leaves enough space for the child table to overlap it. The code in the sample is heavily commented, so here I'll just describe the logic. First, the child table is created and appended to the `document.body` and removed from the pageflow (`position:absolute`). The width is set to the width of the master table minus the width of the expand/collapse column. Only then is the height of the child table measured, since narrowing the child table can cause the text on a cell to wrap (like in the second track), increasing the height. The height of the master row is increased by the height of the child table. In fact, it is the height of the cell containing the toggle icon the one that gets adjusted, the row will simply match the tallest cell. The position of the child is then set to the position of the master row, offset to the right to clear the expand/collapse column and down to clear the master row.

It is important to keep track of all the information to do this. DataTable records are a good place to do so. A record object can take extra information beyond what was originally read by the DataSource. If you use method `setData()` on a new field, that field will be created if it didn't exist before. We store all related information in the field associated with the expand/collapse column, which is called `__NESTED__` and holds an object that has the following properties:

-   `td`: a reference to the expand/collapse cell in the master table
-   `tdOrigHeight`: the original height of that cell, used as an offset for the child table
-   `tdNewHeight`: the height with the child table, used when expanding a second time
-   `dt`: a reference to the child DataTable instance
-   `div`: a reference to the container for the child DataTable
-   `expanded`: whether the row is expanded or not

The existence of a value (not undefined) for this field tells us that the child table exists, whether visible (`expanded:true`) or not.

Positioning is done in two steps. When the table is created, the horizontal position (left attribute) is set just once. The vertical position (top) is set in a second step along with those of other records. While the left position is stable, expanding and collapsing rows or sorting the master table makes the rows move up or down (but not horizontally); when this happens, the vertical position of all child tables needs to be moved accordingly. (**Note:** From a positioning perspective, it might have been easier to make the child table part of the parent table and use `position:relative` to let the browser move it for us. Though it makes the positioning easier, this approach creates other potential issues. Since the child table would become part of the same branch of the DOM tree as the master, styles would propagate down from the master table to the child, events from the child table would bubble up to the master, and so on.)

In this example, you can keep querying for different artists, which means a new master table and new child tables. It's important not to forget about those child tables and leave them behind. When a new artist is requested, we make sure to destroy all the child tables and their containers by first going through the RecordSet and, for those Record instances that have a `__NESTED__` field we call the `destroy()` on the child tables and then remove the whole child from the DOM tree.

### YQLDataSource: Getting Data from YQL

All the data both from the AutoComplete and for the several DataTables is read via `[YQLDataSource](http://developer.yahoo.com/yui/examples/datasource/datasource_yql.html "YUI Library Examples: DataSource Utility: YQLDataSource")`, a subclass of `ScriptNodeDataSource` that uses the [YUI 2 Get Utility](http://developer.yahoo.com/yui/get/ "YUI 2: Get") to fetch data directly from the [YQL](http://developer.yahoo.com/yql/ "Yahoo! Query Language - YDN") Service. You usually don't need to provide any arguments when creating an instance of a `YQLDataSource`. It already points to the URL for the YQL Service so you don't want to change that. `YQLDataSource` will read all the fields that it receives from the servers. On the one hand, this means you don't need to provide a `responseSchema.fields` list of fields, but on the other it means that you shouldn't use `Select *` in your YQL query; rather, list the specific fields you want to retrieve in the YQL statement. You may still use the `responseSchema.fields` array to attach parsers for some of the fields if they are numbers (as many fields in this example are), dates, Booleans or come in special formats.

Since YQLDataSource is a subclass of ScriptNodeDataSource, it can be used with any YUI component that uses a DataSource. I used a YQLDataSource for the AutoComplete box, another for the main table and one shared YQLDataSource for all child tables. Since the format of the reply for all child tables is the same, there is no problem reusing that single instance of YQLDataSource amongst them. If there had been anything worth plotting, I might have also used Charts with YQLDataSource.

YQLDataSource takes the YQL statement as the first argument in its `sendRequest()` method. That means that in a DataTable, it is the value you set in the `initialRequest` configuration attribute or you pass to my `requery()` method, which is also included in the page. For AutoComplete, you assemble the YQL statement in the `generateRequest()` method that you must override. All YQL statements used in this example are stored in three `YQL_QUERY__xxxx_` constants near the top of the code. `[YAHOO.lang.substitute](http://developer.yahoo.com/yui/docs/YAHOO.lang.html#method_substitute "API: yahoo  YAHOO.lang   (YUI Library)")` is used to assemble the query with its arguments.

The expand/collapse column is initially empty; it has no data coming from the server. The column is added on the spot and then the associated data field is used to store the settings for the nested table. The formatter associated with it adds an invisible <a> element so it can serve as a tab stop and can hold a suitable ARIA role and status. It has a `className` that sets the \[+\] sign as a non-repeating background, like this:

```
.yui-skin-sam .yui-dt td.__NESTED__ div.expand {
    background:transparent url(http://yui.yahooapis.com/2.8.0r4/build/assets/skins/sam/sprite.png) no-repeat 0 -350px;
}
```

There is a similar style declaration for the collapse icon. This makes it really easy for the visual designer to completely change the look of the page if needed. If I had set the contents through the formatter for that column setting its contents as text, an image or a button, there would be no way to change it without changing the code. In this way, the cell content remains invisible and the styling is fully in the hands of the designer.

To toggle the nested tables we respond to any click on that cel. To handle clicks, we can simply rely on DataTable's `cellClickEvent`:

```
albumDt.on('cellClickEvent', function (oArgs) {
    var target = oArgs.target, event = oArgs.event,
        record = this.getRecord(target),
        column = this.getColumn(target);
   
    // We care about clicks on columns 'expand' and 'title'                   
    switch (column.key) {
    case 'expand':
        Event.stopEvent(event);
        // . . . . 
```

First I find out, from the event target (which is the `<td>` element), the record and column corresponding to that cell. From the key of the column I then decide what to do and from the record I get all the information I may need.

### Final Thoughts

This is an example, and it has some rough edges. If you resize the browser window, the child tables may end up floating in weird places. Further event listeners would be needed to detect such changes and redo the layout. Another enhancement would be to leverage ARIA live regions to make the child tables more discoverable to screen-reader users; in its current form, this example would fare poorly in a screen reader because of the dissociation between child tables and their corresponding rows in the master table.

YQL is a query system for external tables or data APIs and it cannot do any better than the tables or APIs it represents. The search for artists only works on full names, it won't find an artist by partial names, which makes the AutoComplete search box behave a little funny. Still, for the purpose of the example, it is the best table I could find because it has a three level hierarchy: artist - album - tracks.

A [more complete version](http://satyam.com.ar/yui/2.8.0/nested1.html) of this example is also available with a general-purpose `YAHOO.widget.NestedDataTable` object defined as a subclass of DataTable in a separate .js file, where several of the shortcomings of the original are fixed.