---
layout: layouts/post.njk
title: "Working with the YUI DataTable Control, Part 1: Getting Started"
author: "Satyam"
date: 2007-09-12
slug: "satyam-datatable"
permalink: /2007/09/12/satyam-datatable/
categories:
  - "Development"
---
**Don't miss [Part Two of this series](/yuiblog/2007/09/26/satyam-datatable-2/), in which Satyam explores methods for changing data within the [YUI DataTable Control](http://developer.yahoo.com/yui/datatable/).**

[YUI's DataTable Control](http://developer.yahoo.com/yui) has many options, more than any single application will use. Unless you want to improvise something different for each and every page, chances are you will be using a subset of those options. As most often is the case, whatever worked your first time, that's what you will use in the rest of the pages, usually copying it over and then modifying it for each page. Then, in the second or third page, you notice that clicking on a column heading does reorder the data but not in the way you expected; so, you research a little more and find out that the code you so happily copied all over needs some retouching. Given the complexity of the component and the problems you will address with it, planning a little bit in advance is a good idea.

This article aims to share with you some lessons from my own implementations of DataTable and from the questions I've seen posted [on YDN-JavaScript](http://tech.groups.yahoo.com/group/ydn-javascript/) related to this component. DataTable will continue to evolve, and some of the issues addressed here may change in nature over time, but I hope to help shorten your path to a smooth deployment of DataTable based on the 2.3.x release.

## Data Types

The data shown to the user by DataTable is a reflection of the data it holds in the internal `RecordSet` array. `DataTable` assumes this data to be one of the native JavaScript data types; after all, that is the only choice it has. Thus, numbers are expected to be actual integers or floats, dates to be JS `Date` objects and booleans to be actual `true` or `false` values, not just 'truish' or 'unlikely' like 1 and 0 or `!= 0` and `null` (i.e., they have to compare to `true` and `false` with a triple equal). Your `DataTable` might look cool in a first trial but then things start to break down when trying to use advanced features if the data types aren't properly implemented, so keep this in mind.

## The DataSource Component

Data is read into the `RecordSet` via the `DataSource` component. The `DataSource` can actually be used as a separate component, though it is not currently well documented independently of the `DataTable`. It can be used to retrieve structured data, letting it manage the connection and parse the data into a JavaScript array of values, so it might be handy if you read any table-oriented data, such as a menu or a tree. You set it up as you would for the `DataTable` and then instead of passing it to the `DataTable`, you call its `sendRequest` method to get the data. That's what the `DataTable` does and just like you won't have much to do with the `DataSource` once you've got your data, neither has the `DataTable`; once it's got its data, the `DataSource` just drops out of the picture. But first you have to actually get that data, and it is an important step.

First, you have to define the format of that data. For example, I use PHP and MySQL and I don't care to load my server doing much data conversion on the server side when the client machine might have as much CPU power as my server; so I pass data just the way it comes and let the client deal with it. Thus, dates will be `YYYY-MM-SS hh:mm:ss` and booleans will be 0 or 1 which, of course, is not the way `DataTable` wants them. The `DataSource` component is the place to fix that.

When you set the `DataSource` you specify the names of the columns it will receive, like this:

```
myDataSource.responseSchema = {
    fields: ["name","breed","age"]
};
```

The code above assumes all fields will be treated as strings. The `fields` property can have an array of strings representing the column names or it can have object literals, like this:

```
myDataSource.responseSchema = {
      fields: ["name","breed",
            {key:"age", parser:YAHOO.util.DataSource.parseNumber}
      ] 
};
```

The value of the `parser` property is the function to be called to parse that data. `DataSource` itself has a brief set of such functions, but if they are not good for your data, it is easy to define your own. The function should expect a single argument, the original value, and return the internal JavaScript representation of it. The `parseDate` function uses the JavaScript `Date` object constructor to parse the data, which takes several textual date formats. However, it does not automatically process my SQL output, so I defined my own custom function as follows:

```
YAHOO.util.DataSource.parseDate = function (oData) {
        var parts = oData.split(' ');
        var datePart = parts[0].split('-');
        if (parts.length > 1) {
                var timePart = parts[1].split(':');
                return new Date(datePart[0],datePart[1]-1,datePart[2],timePart[0],timePart[1],timePart[2]);
        } else {
                return new Date(datePart[0],datePart[1]-1,datePart[2]);
        }
};
```

Notice that I used the very same name for the function as the original `parseDate` function. There is no need to actually do it that way, but since I am not going to use the original function I might as well override it and have mine as the default. We'll see other circumstances when doing this can be quite useful.

So this is how you deal with converting each of the data values from the external representation to the internal one. But values don't come one at a time on their own, they come in whole packages and there is another choice you have to make: the message format. I find XML a little verbose, unnecessarily so, while plain-text (comma- or tab-separated values) a little too terse. JSON suits me fine, but you'll need to make your own choice with respect to the message format. It is easier if you settle into one format, whichever it is, and even provide expansion space. DataTable author Jenny Han Donnelly's [JSON over XHR example](http://developer.yahoo.com/yui/datatable/#xhr) shows a sample of data with extras:

```
{SalesDatabase:
    {totalItems:40, itemsFound:2, items: [
        {Company:"A1 Services",
        Title:"CEO",
        Name:"Jane Jones",
        Phone:"800-555-2121",
        Email:"janejones@a1services.com"},

        {Company:"Acme",
        Title:"President",
        Name:"John Smith",
        Phone:"800-555-1212",
        Email:"johnsmith@acme.com"}
    ]}
}
```

Notice the `totalItems` and `itemsFound` fields. You might ask yourself why this doesn't start with the square bracket after `items` in the second line. That's why JSON is better than plain text, if it wasn't for that allowance to carry some extra structured information in the same package, JSON would be no better than plain text with the column names repeated too many times.

For this example, you would set your `DataSource` like this (from the component docs):

```
var myDataSource = new YAHOO.util.DataSource("http://url/datafeed.php?");
myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
myDataSource.responseSchema = {
    resultsList: "SalesDatabase.items", 
    fields: ["Company","Title","Name","Phone","Email"] 
};
```

Notice the dot notation you must use to specify the branch you have to travel to reach the data. XML fans might expect XPATH; don't. Also, the field description consists of strictly the column names, since they are all strings and there are no dates or numbers to parse. `DataSource` ignores the extra info, but you can get to it, if needed.

My choice of extra information, though, is somewhat different that what is illustrated in the YUI examples that ship with DataTable. My standard JSON reply uses this format:

```
{
        replyCode:200, replyText:”Ok”,
        data:[{ ... } , ... ]
}
```

I use this format even for replies that carry no data, such as database actions like record deletes or updates. In those cases, there won't be any data, just a success or failure indication. This standard format could be thought of as an envelope which can carry any information between server and client. For example, if the action request is an insert on a table with an auto increment field, I also use this format:

```
{
        replyCode:201, replyText:”Data follows”,
        data:{AddressId:23}
}
```

`DataSource` won't take this last message since the data is not an array, which is what it usually deals with, but I still use it even for requests I pass to the server via [Connection Manager](http://developer.yahoo.com/yui/connection/). In my view, the function at the server side that produces the JSON reply does not and should not care where the request came from and its replies have always the same format.

`DataSource` will also completely ignore the `replyCode` and `replyText` properties: It will go straight for the data. Nevertheless, if it doesn't find the data element, it will trigger a `responseParseEvent` event, where you should be able to get to the full response and find out why did it fail. Unfortunately, the arguments passed in the `responseParseEvent` don't give you access to that field. The best alternative I've found is to redefine the method `doBeforeCallback` (which is meant to be overridden for cases like this when you need access to the raw and/or parsed data before the callback gets it). This function always gets called, error or not, so you have to test for errors and then you can reach the raw response in `oRawResponse` as plain text and do whatever you like with it. Here's an example of what that function might look like:

```
myDataSource.doBeforeCallback = function(oRequest, oRawResponse, oParsedResponse) {
        if (oParsedResponse.error) {
                var r = eval('(' + oRawResponse + ')');
                if (r.replyCode !== undefined) {
                        alert(r.replyText);
                } else {
                        alert(oRawResponse);
                }
        };
        return oParsedResponse;
};
```

### Column definitions

Now that we have the data into the `DataTable`'s `RecordSet` array, we need to specify how to show it to the user. We do this with the column definitions, which is the second argument to the `DataTable` constructor. Column definitions are created as an array of object literals, one item per column to be shown. Notice that the number of columns in the `DataTable` might not match the number of columns in the incoming data. You might either ignore some of the columns coming from the server or add columns calculated from data in other columns or made up somehow. That might help to explain why you have to mention the column names twice, once for the `DataSource`, once again for the `DataTable`: Depending on your implementation, they might not be a one-for-one match.

The `key` property for each column should match the field name given in the fields list in the `DataSource`. The `label` property is the text to be shown in the column heading, which defaults to the value of the `key` property if no `label` value is given.

### Sorting

The `sortable` property is `true` or `false` and specifies whether you want the user to be able to click on that column's header and sort it. If the data was properly converted when read, the internal sorter (it actually uses JavaScript's native `Array` `sort` method) should work since it knows how to sort all the native data types. If your values cannot be sorted by the standard comparison operators that `sort` uses, you can specify a custom function which will be passed to the `sort` function to deal with any other data type. If your data is already sorted, it is good to show that to the user: The `sortedBy` configuration property of the `DataTable` does that by highlighting the column and putting an arrow by the column header. You set it when instantiating the `DataTable`, in the fourth argument as part of the configuration object literal:

```
var myDataTable = new YAHOO.widget.DataTable (<elContainer> , <aColumnDefs> , <oDataSource> , {
        sortedBy:{
                key:'Company',
                dir:'asc'
        }
});
```

Setting the `sortedBy` property just does the highlighting, it doesn't sort the data; it is just a means of telling the `DataTable` that the data is already sorted. When the user clicks a column header, provided it has `sortable:true` set, then it will be sorted and the highlight will change, but otherwise the `DataTable` does not assume the data to be sorted in any way.

An issue somewhat associated with sorting is the relationship in between row numbers and record IDs; namely, that _there is no relationship_. Initially, on a freshly loaded table, the row numbers and record IDs will match, but after sorting, inserting or deleting rows, they won't match any longer. The record ID (`YAHOO.widget.Record.getId()`) is permanently associated with the row but the row number is not, so be careful with your use of row numbers. If you use the `DataTable.addRow` method and insert the record at position 0, the first row, that will be its row number, but the record ID will be one higher than the highest record ID it ever had. Deleted rows renumber the remaining rows but the record IDs remain with the gaps. Sorts simply scramble the record IDs with respect to order.

### Formatting

The `DataTable` comes with plenty of formatters which you specify via the `formatter` property in the column definitions. For the standard formatters you can give the name of the formatter as a string literal, such as `'date'`, which the `DataTable` will translate to `YAHOO.widget.DataTable.formatDate`. For custom formatters (or even for the standard ones, if you feel so inclined) you can provide a function. For example, in Europe we use dates in `DD/MM/YYYY` format instead of the `MM/DD/YYYY` used by default in `DataTable`. I can do one of two things: I either define my own formatter and explicitly set it in every column definition or I replace the provided function, like this:

```
YAHOO.widget.DataTable.formatDate = function(el, oRecord, oColumn, oData) {
        var oDate = oData;
        if(oDate instanceof Date) {
                el.innerHTML = oDate.getDate() + '/' + (oDate.getMonth()+1)  + '/' + oDate.getFullYear();

                // Make all dates older than a month show on a red background
                var DM = YAHOO.widget.DateMath;
                if (DM.before(oDate,DM.add(new Date(),DM.MONTH,-1))) {
                        el.style.backgroundColor = 'red';
                }
        } else {
                el.innerHTML = YAHOO.lang.isValue(oData) ? oData : '';
        }
};
```

I would still have to specify `formatter:'date'` in the column definition, but `DataTable` will use the redefined version instead of the original. If you have an international site and might need dates or currencies in different formats it might be easier to declare the columns with `formatter:'date'` or `formatter:'currency'` and have sets of JavaScript source files with different formatting functions for each country locale or make a customizable version of all the standard functions using the same names and load locale configurations for them.

You might wish `DataTable` would guess what formatter to use from your data, but many times it cannot. For example, a link or an email address are both strings, but you would actually want them displayed as hyperlinks; currency values are plain numbers, so letting `DataTable` guess is of no use.

The standard link and email formatters use the same value both for the display text and the underlying `href` attribute for the link, like this, where `oData` contains the actual value from the `Record` (all formatters default to display the data as-is if it is not the data type expected -- that's why the `if` is there):

```
YAHOO.widget.DataTable.formatLink = function(el, oRecord, oColumn, oData) {
    if(YAHOO.lang.isString(oData)) {
        el.innerHTML = "<a href=\"" + oData + "\">" + oData + "</a>";
    } else {
        el.innerHTML = YAHOO.lang.isValue(oData) ? OData : "";
    }
};
```

Now, say you want to display the `mailto:` link using just the name of the person while setting the href attribute to the email address, then you would use your own formatter. This might be a case when the number of columns in the `DataSource` don't match the columns displayed in the table. Let's say the `DataSource` has one column each for the eMail address and the name, and the `DataTable` only one. For example:

```
YAHOO.example.formatUserWithEmail = function(el, oRecord, oColumn, oData) {
        if (YAHOO.lang.isString(oData)) {
                var eMail = oRecord.getData('email');
                if (YAHOO.lang.isString(eMail) && eMail.length) {
                        el.innerHTML = '<a href=”mailto:' + eMail + '”>' + oData + '</a>';
                } else {
                        elInnerHTML = oData;
                }
        } else {
                el.innerHTML = YAHOO.lang.isValue(oData) ? oData : "";
        }
};
```

I would assign this formatter function to the column containing the name while the column containing the eMail would not be included in the column definitions. But it _would_ be included in the fields definition for the `DataSource` so that the data will actually be there for you, in the `oRecord` argument.

As for the rest of the arguments to the formatter function, the first one is the cell, which allows you further flexibility since you are not limited to just format the contents; you can also format the container itself. In my `formatDate` function above, I put code in it to make all dates older than a month show on a red background. (While we're on the subject of dates, do check `[YAHOO.widget.DateMath](http://developer.yahoo.com/yui/docs/YAHOO.widget.DateMath.html)`, part of the `Calendar` component, which has some potentially relevant functionality).

The `oColumn` argument gives you a copy of the definitions you provided in the column definitions plus some more, such as the default values of the ones you left out. There is nothing preventing you from adding further properties to the column definition besides the ones `DataTable` uses; just make sure their names don't collide with the ones `DataTable` uses. If you add extra properties, those will show up in the `oColumn` argument of the formatter. This would allow you to have a parameterized formatter, with the formatting options coming in the `oColumn` argument. And, as shown here, I use single quotes for JavaScript literals and double quotes for the HTML stuff, which spares me from having to escape double quotes within double quotes and makes it much easier to detect unbalanced quotes (but for the sake of this article I have respected the format of code that I copied from YUI documentation).

### In-line Editing

One of the most exciting features of the `DataTable` is the possibility of editing cells right on the spot. If you assign an editor to a column in the column definitions, that column will be editable. Just as you add a `formatter` property to allow for different formatters, you use the `editor` property to use any of the several editors provided with the `DataTable`, which you can either call by short name or by assigning it a function or a reference to a function of your own. You have a good sampling of the editors available in the [code samples](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html).

Though the inline editor will take care of updating the underlying `RecordSet` and make those changes visible to the user, you would want those changes to be sent to the server, where the data resides permanently. Other changes to the `DataTable`, such as inserting or deleting rows are closely tied to cell editing. That's a subject for another article, as synchronizing your data between client and server is a lengthier topic than we have space for here. In any case, with the variety of editors available, you would be hard pressed to miss the one you truly needed.

## Conclusion  

![](/yuiblog/blog-archive/assets/satyam_datatable.gif)

The image above summarizes the format of the data at each stage in the system, how it comes out from the server, how it is stored internally in the `DataTable`'s `RecordSet`, how it is presented to the user, and where to put the conversions as the data goes from one to the other and back again.

YUI's `DataTable` is very flexible and allows you to do many things. Making your choices in advance allows you to define your own version of the `DataTable` and either cast some of those choices or make them more easily accessible according to your taste and preferences. The whole application will look and behave more consistently and, should you want to change anything, many of the changes will be concentrated in just one single place.