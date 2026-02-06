---
layout: layouts/post.njk
title: "Working with the YUI DataTable (Updated for v2.6.0), Part 1: Getting Started"
author: "Satyam"
date: 2008-10-15
slug: "datatable-260-part-one"
permalink: /2008/10/15/datatable-260-part-one/
categories:
  - "Development"
---
[YUI's DataTable Control](http://developer.yahoo.com/yui) has many options, more than any single application will use. Unless you want to improvise something different for each and every page, chances are you will be using a subset of those options. As most often is the case, whatever worked your first time, that's what you will use in the rest of the pages, usually copying it over and then modifying it for each page. Then, in the second or third page, you notice that clicking on a column heading does reorder the data but not in the way you expected; so, you research a little more and find out that the code you so happily copied all over needs some retouching. Given the complexity of the component and the problems you will address with it, planning a little bit in advance is a good idea.

This article is an update of a [similar article](/yuiblog/blog/2007/09/12/satyam-datatable) written when version 2.3 of YUI was current. With version 2.6, the DataTable has been taken out of beta, which means its public interfaces will no longer change — so this should be the definitive article about it on this 2.x line of code.

## Data Types

The data shown to the user by DataTable is a reflection of the data it holds in the internal `RecordSet` array. `DataTable` assumes this data to be one of the native JavaScript data types; after all, that is the only choice it has. Thus, numbers are expected to be actual integers or floats, dates to be JavaScript `Date` objects and booleans to be actual `true` or `false` values, not just 'truish' or 'unlikely' like 1 and 0 or `!= 0` and `null` (i.e., they have to compare to `true` and `false` with a triple equal). Your `DataTable` might look cool in a first trial but then things start to break down when trying to use advanced features if the data types aren't properly implemented, so keep this in mind, values should be converted to their proper native types.

## The DataSource Component

Data is read into the `RecordSet` via the `DataSource` component, the same one used by the [Charts](http://developer.yahoo.com/yui/charts/) and [AutoComplete](http://developer.yahoo.com/yui/autocomplete/) components. It can be used to retrieve structured data, letting it manage the connection, parse the data, fetch the values, convert them and place them into a JavaScript array of values, so it might be handy if you read any table-oriented data, basically, the result of any database query.

One thing it does not do, and is often the cause of much confusion, is to take data back. The DataSource goes one-way, it is a source of data, it does not keep a permanent connection to the server so it cannot take any updated values and modify them in whatever storage media they came from. It wouldn't be able to do so, after all, what's the opposite of an SQL Select statement, an Insert or an Update? You have to put the logic for updates on the server side and then it is up to you how you communicate with it and we will see that in the second part of this series.

So, the first thing you have to do is to decide where your data will be coming from. Most often it comes from a remote source so you would use the `XHRDataSource` class. But you might want to support users who don't have JavaScript enabled and you want them to see the raw information without JavaScript enhancements, then you will draw the HTML table for non-JavaScript users and make the `LocalDataSource` class read it so it gets enhanced by the DataTable for the rest. The `LocalDataSource` will also read an XML Data Island if you use them. If the source of your data is on a separate domain and the regular XHR connection would fail, then you would use the `ScriptNodeDataSource` which uses YUI's [Get utility](http://developer.yahoo.com/yui/get/) to do cross-domain data retrieval. Finally, data might come from some other library you have to interact with to request the data. You can then use the `FunctionDataSource` that takes a function to read the data from and by whatever means you require.

Then, you have to define the format of that values themselves. For example, I use PHP and MySQL and I don't care to load my server doing much data conversion on the server side when the client machine might have as much CPU power as my server; so I pass data just the way it comes and let the client deal with it. Thus, dates will be `YYYY-MM-SS hh:mm:ss` and booleans will be 0 or 1 which, of course, is not the way `DataTable` wants them. The `DataSource` component is the place to fix that.

When you set the `DataSource` you specify the names of the columns it will receive, like this:

```
myDataSource.responseSchema = {
    fields: ["name","breed","age"]
};

```

The code above assumes all fields will be treated as strings. This could produce strange results such as having a dog aged "11" sorted as if it were younger than a dog aged "2". The `fields` property allows you to specify a parser, like this:

```
myDataSource.responseSchema = {
    fields: ["name","breed",
        {key:"age", parser:YAHOO.util.DataSource.parseNumber}
    ] 
};

```

Version 2.6 has made it easier: instead of providing the full reference to the built-in function you can use shortnames:

```
myDataSource.responseSchema = {
    fields: ["name","breed",
        {key:"age", parser:'number'}
    ] 
};

```

The `DataSource` itself has a brief set of such functions, (`'date'`, `'number'` and `'string'`) but if they are not good for your data, it is easy to define your own. The function should expect a single argument, the original value, and return the internal JavaScript representation of it. For example, the `parseDate` function uses the JavaScript `Date` object constructor to parse the data, which takes several textual date formats; however, it does not automatically process my SQL output, so I defined my own custom function as follows:

```
YAHOO.util.DataSource.Parser['sqlDate'] = function (oData) {
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

By adding the function to the `YAHOO.util.DataSource.Parser` array, I can now use the shortname `'sqlDate'` in the `parser` setting.

So this is how you deal with converting each of the data values from the external representation to the internal one. But values don't come one at a time on their own, they come in whole packages and there is another choice you have to make: the message format. I find XML a little verbose, unnecessarily so, while plain-text (comma- or tab-separated values) somewhat limited. JSON suits me fine, but you'll need to make your own choice regarding the message format. It is easier if you settle into one format, whichever it is, and even provide expansion space. DataTable author Jenny Han Donnelly's [JSON over XHR example](http://developer.yahoo.com/yui/datatable/#xhr) shows a sample of data with extras:

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

For this example, you would set your `DataSource` like this:

```
var myDataSource = new YAHOO.util.XHRDataSource("http://url/datafeed.php?", {
    responseType: YAHOO.util.DataSource.TYPE_JSON,
    responseSchema: {
        resultsList: "SalesDatabase.items", 
        fields: ["Company","Title","Name","Phone","Email"] 
    }
});

```

Notice the dot notation you must use to specify the branch you have to travel to reach the data. XML fans might expect XPATH; don't. The field description simply consists of the column names, since they are all strings and there are no dates or numbers to parse. `DataSource` ignores the extra info, but you can get to it, if needed.

My choice of extra information, though, is somewhat different than what is illustrated in the YUI examples that ship with DataTable. My standard JSON reply uses this format:

```
{
    replyCode:200, replyText:Ok,
    data:[{ ... } , ... ]
}

```

I use this format even for replies that carry no data, such as database actions like record deletes or updates. In those cases, there won't be any data, just a success or failure indication. This standard format could be thought of as an envelope which can carry any information between server and client. For example, if the action request is an insert on a table with an auto increment field, I also use this format:

```
{
    replyCode:201, replyText:Data follows,
    data:{AddressId:23}
}

```

The `DataSource` won't take this last message since the data is not an array, which is what it usually deals with, but I still use it even for requests I pass to the server via [Connection Manager](http://developer.yahoo.com/yui/connection/). In my view, the function at the server side that produces the JSON reply does not and should not care where the request came from and where the reply goes, it will always have the same format.

The `DataSource` will completely ignore the `replyCode` and `replyText` properties, it will go straight for the data. We need some way to access that information before it is lost. More important, however, is that if the `replyCode` signals an error, the rest of the data might well be useless so we must trap it as soon as possible. The method `doBeforeParseData` is meant to be overridden for cases like this when you need access to the raw unparsed data before it goes any further. Here's an example of what that function might look like:

```
myDataSource.doBeforeParseData = function (oRequest, oFullResponse, oCallback) {
    if (oFullResponse.replyCode) {
        if (oFullResponse.replyCode > 299) {
            alert(oFullResponse.replyText);
            return {};
        }
    } else {
        alert(oFullResponse);
    }
    return oFullResponse;
};

```

Returning an empty object in case of error will ensure that the DataSource fails without taking too long to parse something that is irrelevant and makes the DataTable show the `"Data Error"` message.

For XML data, a similar scheme may be used, for example:

```
<?xml version="1.0"?>
<reply code="200" text="ok">
    <data id="1" name="Alice" />
    <data id="2" name="Bob" />
    <data id="3" name="Carol" />
</reply>

```

While with JSON data the `oFullResponse` argument for `doBeforeParseData` is already JSON-unencoded, the same argument for XML data is still an XML document, which is harder to access. Fortunately, the XML parser is a little more forgiving: if it doesn't find any member called `data` it will not produce an error simply assuming there are no records for that query. This allows us to wait until after it is parsed so the meta data is easily accessible. We can then use the meta-data facility of the DataSource. We would declare the DataSource for the above like this:

```
var myDataSource = new YAHOO.util.XHRDataSource('People.php?',{
    responseType: YAHOO.util.DataSource.TYPE_XML,
    responseSchema: {
        resultNode: 'data',
        fields:['id','name'],
        metaNode: 'reply',
        metaFields: {replyCode:'code',replyText:'text'}
    }
});

```

And then, we can extract and check the meta-information like this:

```
myDataSource.doBeforeCallback = function (oRequest, oFullResponse, oParsedResponse, oCallback) {
    if (parseInt(oParsedResponse.meta.replyCode,10) > 299) {
        alert(oParsedResponse.meta.replyText);
        oParsedResponse.error = true;
    }
    return oParsedResponse;
};

```

The above shows how you can extract and process meta-data from an XML DataSource (the same facility, with different property names, exists for JSON data). It also shows how, in `doBeforeCallBack` we can signal an error to the DataTable by setting the `error` property of `oParsedResponse` to true before we return it. Incidentally, I purposefully put all the data and meta-data into element attributes. The XML parser can locate data in both places, as text contents of an element or as an attribute and a mixture of both..

### Column definitions

Now that we have the data into the `DataTable`'s `RecordSet` array, we need to specify how to show it to the user. We do this with the column definitions, which is the second argument to the `DataTable` constructor. Column definitions are created as an array of object literals, one item per column to be shown. Notice that the number of columns in the `DataTable` might not match the number of fields in the incoming data. You might either not show some of the fields coming from the server or add columns calculated from data in other columns or made up somehow. All fields read by the DataSource will be available in the `RecordSet` array, even if they are not shown. That might help to explain why you have to mention the column names twice, once for the `DataSource`, once again for the `DataTable`: depending on your implementation, there might not be a one-for-one match. Besides, for plain data formats like text or array, where fields are not named, the DataSource will read the fields in the order they are listed, which might not be the order in which you want them shown.

The `key` property for each column should match the field name given in the `fields` array in the `DataSource`. The `label` property is the text to be shown in the column heading, which defaults to the value of the `key` property if no `label` value is given.

### Sorting

The `sortable` property can be set to `true` or `false` and specifies whether you want the user to be able to click on that column's header and sort it. If the data was properly converted when read, the internal sorter (it actually uses JavaScript's native `Array` `sort` method) should work since it knows how to sort all the native data types. If your values cannot be sorted by the standard comparison operators that `sort` uses, you can specify a custom function which will be passed to the `sort` function to deal with any other data type.

Database servers are good at sorting so if your data is already sorted, it is good to show that to the user, the `sortedBy` configuration attribute of the `DataTable` does that by highlighting the column and putting an arrow by the column header. You set it when instantiating the `DataTable`, in the fourth argument as part of the configuration object literal:

```
var myDataTable = new YAHOO.widget.DataTable (<elContainer> , <aColumnDefs> , <oDataSource> , {
    sortedBy:{
        key:'Company',
        dir: YAHOO.widget.DataTable.CLASS_ASC
    }
});

```

Setting the `sortedBy` property just does the highlighting, it doesn't sort the data; it is just a means of telling the `DataTable` that the data is already sorted. When the user clicks a column header, provided it has `sortable:true` set, then it will be sorted and the highlight will change, but otherwise the `DataTable` does not assume the data to be sorted in any way. The `sortedBy.dir` property can still take the `'asc'` and `'desc'` shortnames for backward compatibility, though I think it is really handy to use the shortnames and hope they will remain; however, if you read the property back, it will show the new values.

An issue somewhat associated with sorting is the relationship in between row numbers and record IDs; namely, that _there is no relationship_. Initially, on a freshly loaded table, the row numbers and record IDs will match, but after sorting, inserting or deleting rows, they won't match any longer. The record ID (`YAHOO.widget.Record.getId()`) is permanently associated with the row but the row number is not, so be careful with your use of row numbers. If you use the `DataTable.addRow` method and insert the record at position 0, the first row, that will be its row number, but the record ID will be one higher than the highest record ID it ever had. Deleted rows renumber the remaining rows but the record IDs remain with the gaps. Sorts simply scramble the record IDs with respect to order.

### Formatting

The `DataTable` comes with plenty of formatters which you specify via the `formatter` property in the column definitions. For the standard formatters you can use their shortnames, a string literal, such as `'date'`, which the `DataTable` will translate to `YAHOO.widget.DataTable.formatDate`. For custom formatters (or even for the standard ones, if you feel so inclined) you can provide a function.

In the original example I used dates as an example, in Europe we use dates in `DD/MM/YYYY` format instead of the `MM/DD/YYYY` used by default in `DataTable` and I will still show how to do it but I will also show how version 2.6 has made it easier immediately after. Just as with the parsers, I can either define it in-line or add it to the array of custom formatters so I can use it via a shortname, like this:

```
YAHOO.widget.DataTable.Formatter['dmyDateHiliteOld'] = function(el, oRecord, oColumn, oData) {
    if(oData instanceof Date) {
        el.innerHTML = oData.getDate() + '/' + (oData.getMonth()+1)  + '/' + oData.getFullYear();

        var DM = YAHOO.widget.DateMath; // this requires the Calendar widget
        // Make all dates older than a month show on a red background
        if (DM.before(oData,DM.add(new Date(),DM.MONTH,-1))) {
            YAHOO.util.Dom.addClass(el,'oldDate');
        } else {
            YAHOO.util.Dom.removeClass(el,'oldDate');
        }
    } else {
        el.innerHTML = YAHOO.lang.isValue(oData) ? oData : '';
    }
};

```

The point of highlighting dates older than a month is to show that a formatter not only has access to the contents of the cell but to the whole of the cell itself so it can change anything it wants. It can even go higher up and modify the row the cell belongs to. There was a bug in version 2.5 that made this impossible (the formatter was called before the cell was appended to the row) and still now (2.6.0) the formatter is called after the cell is added to the row, but before the row is appended to the table so you can't use method `this.getTrEl(el)` which will fail, but `getAncestorByTagName` works fine (by the time you read this, it might have been fixed). Here, we highlight the whole row when dates are old.

```
YAHOO.widget.DataTable.Formatter['dmyDateHiliteOld'] = function(el, oRecord, oColumn, oData) {
    if(oData instanceof Date) {
        el.innerHTML = oData.getDate() + '/' + (oData.getMonth()+1)  + '/' + oData.getFullYear();

        var DM = YAHOO.widget.DateMath; 
        // var tr = this.getTrEl(el);   // This doesn't work
        var tr = YAHOO.util.Dom.getAncestorByTagName(el,'tr');
        if (DM.before(oData,DM.add(new Date(),DM.MONTH,-1))) {
            YAHOO.util.Dom.addClass(tr,'oldDate');
        } else {
            YAHOO.util.Dom.removeClass(tr,'oldDate');
        }
    } else {
        el.innerHTML = YAHOO.lang.isValue(oData) ? oData : '';
    }
};

```

Having added the formatter to the `Formatter` list I would just have to specify `formatter:'dmyDateHiliteOld'` in the column definition.

The good news now is that none of this is actually needed in 2.6. The built-in formatter for dates is highly configurable and it uses the [`YAHOO.util.Date.format`](http://developer.yahoo.com/yui/docs/YAHOO.util.Date.html) static function which uses handy format specs or locale settings. The easiest in the long run is to have your locale setting defined as explained in the API docs for [`YAHOO.util.DateLocale`](http://developer.yahoo.com/yui/docs/YAHOO.util.DateLocale.html). I will simply set an ad-hoc formatter:

```
var myDataTable = new YAHOO.widget.DataTable (<elContainer> , <aColumnDefs> , <oDataSource> , {
    dateOptions:{format:'%d/%m/%Y'} ,
    currencyOptions:{prefix: '€', decimalPlaces:2, decimalSeparator:',', thousandsSeparator:'.'} 
});

```

I also added a specification for currency which will allow us to display monetary amounts by simply setting `formatter:'currency'` in the column definition.

You might wish `DataTable` would guess what formatter to use from your data, but many times it cannot. For example, a link or an email address are both strings, but you would actually want them displayed as hyperlinks; currency values are plain numbers, so letting `DataTable` guess is of no use.

#### Combining data from several fields

The standard `'link'` and `'email'` formatters use the same value both for the display text and the underlying `href` attribute for the link. This is not always what we want. We may receive from the server two separate fields, `name` and `email` and we want the e-mail to display as a _mailto:_ link under the name thus combining two separate fields from the `DataSource.responseSchema.fields` array into a single column. We can set the following formatter:

```
YAHOO.widget.DataTable.Formatter.formatUserWithEmail = function(el, oRecord, oColumn, oData) {
    if (YAHOO.lang.isString(oData)) {
        var eMail = oRecord.getData('email');
        if (YAHOO.lang.isString(eMail) && eMail.length) {
            el.innerHTML = '<a href=mailto:' + eMail + '>' + oData + '</a>';
        } else {
            el.innerHTML = oData; 
        }
    } else { 
        el.innerHTML = YAHOO.lang.isValue(oData) ? oData : ""; 
    } 
};

```

I would assign this formatter function to the column containing the name while the column containing the eMail would not be included in the column definitions. But it _would_ be included in the fields definition for the `DataSource` so that the data will actually be there for you, in the `oRecord` argument.

As for the remaining argument to the formatter function, the `oColumn` argument gives you a copy of the definitions you provided in the column definitions plus some more, such as the default values for the settings you didn't set explicitly. There is nothing preventing you from adding further properties to the column definition besides the ones `DataTable` uses; just make sure their names don't collide with the ones `DataTable` uses. If you add extra properties, those will show up in the `oColumn` argument of the formatter. This would allow you to have a parameterized formatter, with the formatting options coming in the `oColumn` argument.

### Other formatters

Several formatters produce HTML elements the user can interact with. Beyond the link and email formatters, which the user can actually click, the `'textbox'`, `'textarea'`, `'button'`, `'checkbox'`, `'radio'` and `'dropdown'` formatters can also be user to provide elements the user can interact with. These are not to be confused with the cell editors, which we will see in the second part of the series. The cell editors will update the value in the underlying `Record` object for that row. The formatters, on the other hand, though they do provide the expected HTML `<input>` and other elements, they have no default action. A `'checkbox'` formatter assigned to a column containing a boolean value will correctly show checked or unchecked to reflect the underlying value. The user will be able to click on the checkbox and see the checkbox changing its state, but that won't be reflected anywhere else.

These controls are mostly meant to trigger actions that might not directly affect the underlying data. For example, a `'checkbox'` formatter could be assigned to a made-up column, one which has no corresponding field from the DataSource. The checkboxes will show unchecked since an `undefined` is almost like a `false`. Such a column might be used in response to a 'delete selected' button so, the act of clicking in itself produces no lasting change. Buttons might be used to perform operations involving more than one field in a record or records amongst them, dropdowns might be used to select which action to perform, when and if it is performed. In all this cases, the user action does not involve an immediate change upon the underlying data. What you would normally do is to listen to events triggered by the user interaction. The DataTable provides them, in plenty: `dropdownChangeEvent` and the several click events, `linkClickEvent`, `buttonClickEvent`, `checkboxClickEvent` and `radioClickEvent` which bubble to `cellClickEvent` then to `rowClickEvent` and finally to `tableClickEvent` and their equivalents for thead cells and double clicks, where applicable.

Let us assume there is a whole bunch of checkboxes, buttons and links in several columns in the DataTable. How can you handle them? You can use the element specific events but you can also use the general one, like this:

```
myDataTable.on('cellClickEvent',function (oArgs) {
    // 'this' is already referring to the DataTable
    var target = oArgs.target;
    var record = this.getRecord(target);
    var column = this.getColumn(target);
    switch (column.key) {
        case 'column1':
            // ....
            break;
        case 'whateverColumn':
            // ....
            break;
        default:
            // ignore clicks on other columns, do nothing
            break;
    }
});

```

The code above shows the most standard way to deal with clicks in a DataTable. If what you are listening to is `rowClickEvent` then you can't fetch the column since the event will signal the whole row as the target. From the argument of the listener we pick the targeted cell, the one that has received the click, from that we find what the column and record for that cell is. With the `column.key` value we can identify what column and consequently, what element was clicked, was it the column with the checkboxes or that with the buttons? Then we can branch according to that, or simply ignore the click. Finally, from the record we can read the value of any field in the row.

For example, let us say we want to implement a column of checkboxes to do a certain operation on a batch of records. Adding the column of checkboxes to the DataTable is as easy as adding the following entry into the column definitions:

```
    {key:'select',label:'Select',formatter:'checkbox'}

```

There will be no corresponding value coming from the DataSource so nothing needs to be added to the `responseSchema.fields` array. Then, we listen to the click event:

```
myDataTable.on('checkboxClickEvent',function (oArgs) {
    var target = oArgs.target;
    var record = this.getRecord(target);
    var column = this.getColumn(target);
    if (column.key == 'select') { // to ensure we respond to the right column
        var primaryKey = record.getData('id');
        if (target.checked) {
            YAHOO.example.recordSelection[primaryKey] = true;
        } else {
            delete YAHOO.example.recordSelection[primaryKey];
        }
    }
});

```

After reading the usual properties we make sure the click was on the expected column (just in case we add more checkboxes in the future) and then read the value of the database primary key value from the field called `'id'` via method `Record.getData()`, then based on whether the checkbox is checked or not we add that primary key value to a globally accessible hash indexed by the `primaryKey` value or remove it from that same list if it is unchecked. Whatever group operation we might later do, we just have to go through this hash.

Why did I listen to `checkboxClickEvent` instead of the cell-level event? The first part of the code looks pretty much the same, the difference is what `target` is. For a `cellClickEvent`, `target` will be the `<td>` element, which doesn't have any `checked` property, for `checkboxClickEvent`, `target` is the `<input type="checkbox" />` element which does.

What if you want to actually show the user something like a checkbox that the user can't interact with? If you use the `'checkbox'` formatter, the box will be active. The best is to provide a custom formatter like this:

```
YAHOO.widget.DataTable.Formatter.showBoolean = function(el, oRecord, oColumn, oData) {
    if (oData) {
        YAHOO.util.dom.addClass(el,'true');
    } else {
        YAHOO.util.dom.removeClass(el,'true');
    }
};

```

The graphics designer can then assign to the style `.true` whatever suits his/her design, whichever background image or color is more suitable. This provides more flexibility and independence of design than actually drawing something in it. Notice we are not filling the cell with anything at all.

### In-line Editing

One of the most exciting features of the `DataTable` is the possibility of editing cells right on the spot. If you assign an editor to a column in the column definitions, that column will be editable. Just as you add a `formatter` property to allow for different formatters, you use the `editor` property to use any of the several editors provided with the `DataTable`, which you can either call by short name or by assigning it a function or a reference to a function of your own. You have a good sampling of the editors available in the [code samples](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html).

Though the in-line editor will take care of updating the underlying `RecordSet` and make those changes visible to the user, you would want those changes to be sent to the server, where the data resides permanently. Other changes to the `DataTable`, such as inserting or deleting rows are closely tied to cell editing. That's a subject for another article, as synchronizing your data between client and server is a lengthier topic than we have space for here. In any case, with the variety of editors available, you would be hard pressed to miss the one you truly needed.

## Conclusion  

YUI's `DataTable` is very flexible and allows you to do many things. Making your choices in advance allows you to define your own version of the `DataTable` and either cast some of those choices or make them more easily accessible according to your taste and preferences. The whole application will look and behave more consistently and, should you want to change anything, many of the changes will be concentrated in just one single place.