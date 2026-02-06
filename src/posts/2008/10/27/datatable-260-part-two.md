---
layout: layouts/post.njk
title: "Working with the YUI DataTable (Updated for v2.6.0), Part 2: Changing the Contents of the DataTable"
author: "Satyam"
date: 2008-10-27
slug: "datatable-260-part-two"
permalink: /2008/10/27/datatable-260-part-two/
categories:
  - "Development"
---
**Don't miss [Part One of this series](/yuiblog/blog/2008/10/15/datatable-260-part-one/), in which Satyam explores practical steps on getting started with the [YUI DataTable Control](http://developer.yahoo.com/yui/datatable/).**

In a [previous article](/yuiblog/blog/2008/10/15/datatable-260-part-one/) I wrote about how to get started with your own implementation of the `DataTable` component. In this article I will cover how to change the contents of the `DataTable`, especially how to communicate with your database server to make changes and, if successful, show those changes to the user, since in many applications, the contents of the `DataTable` should be a reflection of the information in a database.

## Deleting records

We will start with the easiest transaction: deleting a single record. First let's make a column containing a delete icon which, when clicked, will delete the row. To do that, we declare that extra column in the column definitions for the `DataTable` in this way:

```
var myColumnDefs = [
    ....,
    ....,
    {key:'delete', label:' ', className:'delete-button'}, 
    ....
];

```

* * *

```
    
// where delete-button can be declared as:
.delete-button {
    cursor: pointer;
    background: transparent url(images/delete.png) no-repeat center center;
    width: 16px;  height: 16px;
}

```

We are declaring an extra column with `key` equal to `'delete'`, with a blank column header (if `label` is not declared the header will default to the `key` value so we have to explicitly say we don't want one) and with a `className` with the CSS attributes that you can see declared right below. We don't need to add any actual contents to the cell nor assign it any `onClick` or `id` attributes We couldn't care less for the contents of that cell, meaning it can be an `<img>`, `<button>`, a simple text or nothing. The best option, though, is leave the graphics design completely open as we have done.

We are going to be able to detect a click on the cell by subscribing to the `cellClickEvent`. If we also want to have in-line cell editing, as is often the case, we would have the following somewhere in our code:

```
myDataTable.subscribe('cellClickEvent',myDataTable.onEventShowCellEditor);

```

This is telling the `DataTable` that when it receives a cell click event it should activate the cell editor, but that is not the only option, our 'delete' button can also be clicked and we want to respond to each event accordingly. We would then have:

```
myDataTable.subscribe('cellClickEvent',function(oArgs) {
    var target = oArgs.target;
    var column = myDataTable.getColumn(target);
    if (column.key == 'delete') {
        if (confirm('Are you sure?')) {
            myDataTable.deleteRow(target);
        }
    } else {
        myDataTable.onEventShowCellEditor(oArgs);
    }
});

```

Instead of simply showing the cell editor, first we check whether the click came from a cell in the new column, the one named 'delete'. We use the target cell received in the argument to get the column via `getColumn()` and then check for its `key` value. If the `key` of the clicked column is `'delete'` and if the user confirms the action we call `deleteRow()` and pass in the target cell as an argument, otherwise, we leave the cell editor pop up.

The event listener is executed in the scope of the table, so `this` and `myDataTable` within the function are the same, we used the latter for clarity.

Code similar to the above can be used at any time when we might want to edit some cells and not others. Here, we have selected by column but we can also read the record where the click happened and decide whether to edit or not based on the value on an associated column for that same record.

We have one problem with this code: the server knows nothing of this change and we want to keep the server always in sync, so we will have to insert some code in between the user confirmation and the actual row deletion:

```
myDataTable.subscribe('cellClickEvent',function(oArgs) {
    var target = oArgs.target;
    var column = this.getColumn(target);
    if (column.key == 'delete') {
        if (confirm('Are you sure?')) {
            var record = this.getRecord(target);
            YAHOO.util.Connect.asyncRequest(
                'GET',
                'myServer.php?deleteRow=' + record.getData('id'),
                {
                    success: function (o) {
                        if (o.responseText == 'Ok') {
                            this.deleteRow(target);
                        } else {
                            alert(o.responseText);
                        }
                    },
                    failure: function (o) {
                        alert(o.statusText);
                    },
                    scope:this
                }
            );
        }
    } else {
        this.onEventShowCellEditor(oArgs);
    }
});

```

After confirming the user intention, we call `asyncRequest()` of the [Connection Manager](http://developer.yahoo.com/yui/connection/). We make a `GET` request to the server, passing it the value of the database primary key, here called `id`, for the current record which we get through a call to `getData()`. Upon a successful reply from the server, if it sends an `'Ok'` message, we delete the row as before. If there is any other reply from the server, we assume it to be an error message and we show it to the user, just as we do if we are unable to connect the server in the `failure` callback option.

In this example I changed the references from `myDataTable` to `this`, since the event listener is called within the scope of the `DataTable`, but beware, the callback to the `asyncRequest()` method has a different scope unless you explicitly force it and so we need to add `scope:this` for the `this.deleteRow()` inside the callback to work. Thanks to closure, the variable `target` within the `success` callback function refers to the one in the enclosing function. We are not really concerned with aesthetics here, but in your own code you might prefer to use `YAHOO.widget.SimpleDialog` instead of `confirm()` and `alert()`.

If you analyze this function you may notice that all the information it needs comes from the event `target` except for two hard coded values: the column key and the database's primary key for the record. This forces us to rewrite this very same function for each and every table. We can, though, provide this information from elsewhere so that we could put this function into our own handy personal library. In the [previous article](/yuiblog/blog/2008/10/15/datatable-260-part-one/) I mentioned that the column definitions were extensible, and you can add your own properties to them as long as their names don't collide with those the YUI library uses. We can add a couple of such properties. One we will call `action` and in this case we will set `action:'delete'`. The other property we will call `isPrimaryKey` and it will either be `true` or simply not be there, hence `false`. We will set it to `true` only in the column or columns which are the primary keys in the database. Our generic `onCellClick` function might then look like this:

```
var onCellClick = function(oArgs) {
    var target = oArgs.target,
        column = this.getColumn(target),
        record = this.getRecord(target);
    switch (column.action) {
        case 'delete':
            if (confirm('Are you sure?')) {
                
                YAHOO.util.Connect.asyncRequest(
                    'GET',
                    'myServer.php?action=delete' + myBuildUrl(this,record),
                    {
                        success: function (o) {
                            if (o.responseText == 'Ok') {
                                this.deleteRow(target);
                            } else {
                                alert(o.responseText);
                            }
                        },
                        failure: function (o) {
                            alert(o.statusText);
                        },
                        scope:this
                    }
                );
            }
            break;
        default:
            this.onEventShowCellEditor(oArgs);
            break;
    }
};

// which we would use like this:
myDataTable.subscribe('cellClickEvent',onCellClick);


```

We intentionally left the door open to accept other actions within the same function, the default always being editing cells. This does not mean that all cells will be editable, `onEventShowCellEditor` first checks whether the column has the `editor` attribute set. The `myBuildUrl()` function is:

```
var myBuildUrl = function(datatable,record) {
    var url = '';
    var cols = datatable.getColumnSet().keys;
    for (var i = 0; i < cols.length; i++) {
        if (cols[i].isPrimaryKey) {
            url += '&' + cols[i].key + '=' + escape(record.getData(cols[i].key));
        }
    }
    return url;
};

```

This function goes through all the column definitions looking for the `isPrimaryKey` property and, if set, it will concatenate into the variable `url` the column's `key` name, which we assume to be URL-safe, and the current value for that column taken from `record` all in proper and escaped URL-encoded format. The value returned will even have the leading `'&'` since, most of the time, we will be appending it to a partially built URL. Most of the transactions we do with the server will require us to identify the record by its primary keys so we will use this function quite often.

## Inserting rows

It is quite easy to insert a blank row into the `DataTable`. Let's assume that we have added another column that has buttons to insert a row. The following code will insert a blank row above the row where the button was clicked. Since we have left the switch on `column.action` open for expansion we now add:

```
case 'insert':
    this.addRow( {} , this.getRecordIndex(target));
    break;
    ....

```

The `addRow()` method takes an object literal whose property names are those of the `column.key` properties and the values for each property are the ones to be inserted. Those fields not explicitly set (none in this example) will be set to `undefined`. In normal circumstances the object literal should be filled with suitable defaults. The second argument to `addRow()` is the position where the record is to be inserted, in this case taken from the position of the click via `getRecordIndex()`.

The user will still need to input data for the new row and the new data will need to be sent to the server as we will see later on. Since there is no built-in row-editing functionality in the DataTable, the best option is to pop up a `Dialog` from the Container component. The [documentation for the Dialog component](http://developer.yahoo.com/yui/container/dialog/) shows how to assemble a form and submit the information collected to the server, so I won't cover that here.

Another idea for row insertion is to trigger it via a context menu, where you would have to insert the new row in relation to the row that triggered the context menu. Or an 'Add New Record' button or link directly outside the table could cause a row to be inserted at position 0, which would be the top of the table. This is a case where we can fully appreciate the difference in between row numbers and record id numbers that we mentioned in the [previous article](/yuiblog/blog/2008/10/15/datatable-260-part-one/). The record we have just created will get a new record id number, one higher than the highest record ever assigned. Nevertheless, it would get row number 0, because that's where we placed it with the `addRow()` method. They are different concepts and they are also different from the primary key(s) of the database record on the server.

Once we decide how we want to allow the user to insert a row, we need to send the request to the server and handle its reply. We should not fully count on the information the user entered into the `Dialog` form -- the database might assign default values for empty fields, it might have timestamp values inserted into date fields or it might have an auto-incremented integer as its primary key so we need to know what that primary key value turned out to be. In the [Submitting Form Data](http://developer.yahoo.com/yui/container/dialog/#submit) section in the `Dialog` documentation we have the `onSuccess` callback function which simply pops up a message alert to the user. We will use that callback to insert the record with the values returned from the server.

In the [previous article](/yuiblog/blog/2008/10/15/datatable-260-part-one/) I mentioned the benefits of using a standard message response. We didn't use that standard message format in the previous section in order to focus on the new information presented there. Let's take a moment and review it since we now have a more complex reply from the server and we can't just get by with a plain 'Ok'. I use JSON as the basis for my server replies; I don't recommend plain text because it lacks any structure (i.e. you could not make an envelope); and though XML is a good choice, I find it too verbose and harder to parse. Three possible messages in my message format are:

```
// Plain Ok response
{   "replyCode":200, "replyText":"Ok" }

// Ok with extra data
{
    "replyCode":201, "replyText":"Data Follows", 
    "data":[{ ... } , ... ] 
}

// Something went wrong
{ "replyCode":500, "replyText":"Something really bad happened" }

```

All messages will be enclosed in an envelope carrying status information which reports in numeric and textual form the result of the transaction requested. Reply codes in the 2xx range mean no error. A 200 is an Ok reply when there is no extra information to be provided, a 201 is a variation meaning that there is extra data in the reply. Codes in the 5xx range and above mean some sort of error. The numerical values for the `replyCode` are modeled after the standard HTTP reply codes but they should not be confused with them and no attempt should be made to send those reply codes in the HTTP headers. Browsers, proxy servers and other intermediaries may act on standard HTTP reply codes and they might get confused if we send our application-level codes at the communication level, where they do not belong.

In the row delete case there would either be a successful `200 'Ok'` reply or it would get some 5xx `replyCode` and an error message in `replyText`. For a data fetch (i.e.:when filling a DataTable) the reply would have a 201 code and the `data` property would contain the data requested. In our row insert case, we would receive the reply status envelope plus the full record with all its default values, auto-incremented fields, timestamps and whatnot or, in the case of server error, a 500 `replyCode` and an error description. Thus, our Dialog submit `onSuccess` callback function would look like this:

```
var onSuccess = function(o) {
    var r = YAHOO.lang.JSON.parse(o.responseText, function (k,v) {
        if (/-date$/.test(k) {
            return YAHOO.util.DataSource.parseDate(v);
        }
        return v;
    });
    if (r.replyCode == 201) {
        myDataTable.addRow(r.data, 0);
        var tr = myDataTable.getTrEl(0);
        tr.scrollIntoView();
        YAHOO.util.Dom.addClass(tr, 'my-highlight-row');
        setTimeout(function() {
            YAHOO.util.Dom.removeClass(tr, 'my-highlight-row');
        }, 2000);
    } else {
        alert(r.replyText);
    }
}:


```

We first decode the JSON reply with the YUI [JSON utility](http://developer.yahoo.com/yui/json/). Since we presumably have agreed that all date fields will end with the `-date` suffix we use the _reviver_, a function passed as the second argument to the parser, to detect them, via a suitable regular expression and convert then to JavaScript dates. The converter we use is the very same parser the DataSource uses so we should get the same results as the DataTable gets. If `replyCode` is `201`, indicating success plus data, we add the row just as it comes from the server in the first table position, row number 0. Though YUI's JSON parser offers the alternative to parse values on the fly, other parsers for other message formats might not include such a facility and it might be cumbersome to specify a _reviver_ for all possible data types, so it is more likely we wouldn't use it and instead the call to `addRow()` in a real case would look like this:

```
myDataTable.addRow({
    someNumericField: YAHOO.util.DataSource.parseNumber(r.data.someNumericField),
    someDateField: YAHOO.util.DataSource.parseDate(r.data.someDateField),
    someTextField: r.date.someTextField,
    someBooleanField: !!r.date.someBooleanField  // yes, those are two 'not' operators put together
},0);

```

The lines after the call to `addRow()` simply use the Dom Utility's `addClass()` and `removeClass()` to highlight the row for 2 seconds in order to call attention to the newly inserted row, which is brought into view by the HTML DOM function `scrollIntoView`.

All along we've been assuming the column `key` names are the same as the database table column names, a practice I recommend. SQL names are valid JavaScript variable names and are URL-safe so there is no reason not to use the same names all through, but of course, if you inherit a system with funny column names (some databases allow names in national language character sets which might cause encoding problems or JavaScript errors) you might have to change those names, preferably on the server side, if that is where the culprit lies.

## In-line cell editing

One of the most attractive features of the `DataTable` is that you can edit cells as if in a spreadsheet. The [documentation](http://developer.yahoo.com/yui/datatable/#edit) covers the basics and a working example can be found [here](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html). Besides setting the `editor` property in the column definitions to a suitable editor for that column, you have to remember to pass the `cellClickEvent` to the `onEventShowCellEditor()` method just as is shown in the documentation or how we did when we captured the `cellClickEvent` for our own use.

There have been several important changes for 2.6.0. In previous versions, the `editor` property of a column definition would take a short-name such as `'textbox'` or the full reference to the plug-in for that type of field such as `YAHOO.widget.DataTable.editCheckbox`. Though these two ways are still supported for backward compatibility, each type of editor is now a separate class, all inheriting from `BaseCellEditor` so this is how it looked like and how you would do it now (taken from the [cell editing example](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html)):

```
// Sample of old style
{key: "amount", editor: "textbox", editorOptions: {validator: YAHOO.widget.DataTable.validateNumber}},
{key: "active", editor: "radio", editorOptions: {radioOptions: ["yes", "no", "maybe"], disableBtns: true}},
{key: "colors", editor: "checkbox", editorOptions: {checkboxOptions: ["red", "yellow", "blue"]}},
                        
// Sample of new style:
{key: "amount", editor: new YAHOO.widget.TextboxCellEditor({validator: YAHOO.widget.DataTable.validateNumber})},
{key: "active", editor: new YAHOO.widget.RadioCellEditor({radioOptions: ["yes", "no", "maybe"], disableBtns: true})},
{key: "colors", editor: new YAHOO.widget.CheckboxCellEditor({checkboxOptions: ["red", "yellow", "blue"]})},

```

In the current version you create an instance of each kind of editor for each column that is to be edited and provide the editor options as arguments to the constructor. The options are mostly the same ones as before. Back then you placed them in a separate `editorOptions` property, now they are part of the object instantiation. There is one difference in the options. For radio buttons, checkboxes and dropdowns you could specify the options via an array with simple textual options, as in the example above or an array of sets of texts to be shown to the user and values to be stored internally. In previous versions there was no agreement in the property names for those options, now it has been standardized across all those controls in `value` and `label` (it used to be `value` and `text` for dropdowns),

A second major change is the possibility to confirm asynchronously the changes against the server. Once the user accepted the change in the cell editor, there were several ways to get notified that a change was taking place, even to validate it and rejected, but all these happened synchronously, with no break to be able to get an Ok from the server before showing it to the user. We might be able to revert it afterwards, but the user would have seen the change in the screen and would be entitled to assume the change is valid. By the time a rejection from the server arrived, the user might well be looking elsewhere or even navigated away from the page. This issue occupied a big part of the previous version of this same article, with many lines of code devoted to it.

This has changed thanks to the `asyncSubmitter` setting of the cell editors. The `asyncSubmitter` is a function that receives two arguments, the first one a callback function it should call when it gets the confirmation back from the server, the second, the new value for that cell. The `asyncSubmitter` is called in the scope of the editor so it can retrieve any other information it might require from there, such as the Record instance, the value belongs to or the original value of the cell. The DataTable will be blocked prior to calling the `asyncSubmitter` and will be unblocked by the callback so there is not chance for the user to go away. The cell editor is not dismissed until the callback is called. The callback should receive one or two arguments. The first one a boolean value to indicate success, the second, the value that will actually end up stored in the `Record`, thus allowing the server to change it. Here is a sample of a possible submitter:

```
{key:'name', editor: new YAHOO.widget.TextboxCellEditor({
    asyncSubmitter: function (callback, newValue) {
        var record = this.getRecord(),
            column = this.getColumn(),
            oldValue = this.value,
            datatable = this.getDataTable();
        YAHOO.util.Connect.asyncRequest(
            'POST',
            'People.php', 
            {
                success:function(o) {
                    var r = YAHOO.lang.JSON.parse(o.responseText);
                    if (r.replyCode == 201) {
                        callback(true, r.data);
                    } else {
                        alert(r.replyText);
                        callback();
                    }
                },
                failure:function(o) {
                    alert(o.statusText);
                    callback();
                },
                scope:this
            },
            'action=cellEdit&column=' + column.key + '&newValue=' + 
                escape(newValue) + '&oldValue=' + escape(oldValue) + 
                myBuildUrl(datatable,record)
        );                                              
    }
})},

```

Here we have a column definition for an editable field via a plain `TextboxCellEditor` which has a single argument for its constructor, an `asyncSubmitter`. The submitter function receives two arguments, the `callback` function and the `newValue` just entered and possibly modified by the `validator` (none in this case). To start with, the submitter reads several important pieces to be able to do its job. The `record` and `column` the cell being edited belongs to, the original value for the field and a reference to the datatable. Notice that the scope of the submitter is not the DataTable but the cell editor so `this` is not the DataTable instance, as we are used to from the event listeners we've used so far.

We then use `asyncRequest` to connect to the server via POST using a very long url-encoded post document containing all of the data, the action requested from the server, the column the cell belongs to, the new and old values and through `myBuildUrl` the primary key of the record in the server database table. When the server replies, if the code is a 201 it means the server gave an Ok and it is sending the possibly fixed value back, we then call the callback function signaling the acceptance and what the value actually stored should be. For any other reply, we show an alert and call the callback with no arguments (the first one will equate to false when missing and the second argument is irrelevant in this case). Placing a breakpoint with a debugger in this code anywhere before it calls back the cell editor will show the DataTable greyed out and completely blocked.

A detail often overlooked is that the `validator` function is also the place to do data conversion for the data just entered before it is sent to the server. The value finally saved into the table is not the one initially read into the variable `newData` but that returned by the `validator` function. This is not optional for some data types. Digits entered into an HTML textbox do not make a number but a string of digits. If we allow that string to get into the `RecordSet`, we will find, later on, that sorting columns doesn't work as expected. Other cell editors don't give trouble: the calendar editor will already return a native JavaScript `Date` object. A dropdown will return the option value, not the description but, once again, as a string not a number. `DataTable` has the static function `YAHOO.widget.DataTable.validateNumber` which can be assigned to the `validator` function for any numeric column to do such conversion, as seen in the [example](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html) (see the column definition for column `'amount'`).

### Checkbox and radio button editors

We have already seen how to use the formatters for these two types of input elements. The corresponding editors allow multiple checkboxes or radio buttons in the same cell. Their functionality is no different than having a dropdown with multiple or single selection respectively, they are not meant to edit a single boolean value per cell, though they could, but it is cumbersome for the user to have to click once to bring the editor up, a second time for the choice and then a third click on the Ok (unless you used the `disableBtns` option). The use of similar names is somewhat misleading in that you might associate `formatCheckbox` with `editCheckbox` and `formatRadio` with `editRadio` but they are not at all related, the data they represent is completely different, the formatters represent booleans, the editors single or multiple choices within enumerations.

In the [previous article](/yuiblog/blog/2008/10/15/datatable-260-part-one/) we have seen how to respond to click events in checkboxes and radio buttons but we have not used them to update the Recordset. Besides, we have always gone by the principle that the server should be notified of the intended change and upon approval we would update what the user sees. The following code shows how we can do it:

```
myDataTable.subscribe('checkboxClickEvent', function(oArgs){
    // hold the change for now
    YAHOO.util.Event.preventDefault(oArgs.event);
    // block the user from doing anything
    this.disable();

    // Read all we need
    var elCheckbox = oArgs.target,
        newValue = elCheckbox.checked,
        record = this.getRecord(elCheckbox),
        column = this.getColumn(elCheckbox),
        oldValue = record.getData(column.key),
        recordIndex = this.getRecordIndex(record),
        recordKey = record.getData('recordKey');

    // check against server
    YAHOO.util.Connect.asyncRequest(
        'POST',
        'People.php', 
        {
            success:function(o) {
                var r = YAHOO.lang.JSON.parse(o.responseText);
                if (r.replyCode == 200) {
                    // If Ok, do the change
                    var data = record.getData();
                    data[column.key] = newValue;
                    this.updateRow(recordIndex,data);
                } else {
                    alert(r.replyText);
                }
                // unblock the interface
                this.undisable();
            },
            failure:function(o) {
                alert(o.statusText);
                this.undisable();
            },
            scope:this
        },
        // data to be sent to the server
        'action=cellEdit&column=' + column.key + '&newValue=' + 
            escape(newValue) + '&oldValue=' + escape(oldValue) + 
            myBuildUrl(this,record)
    );                                              
});

```

In this case we first prevent the checkbox from changing state because we don't want that to happen until we get an Ok from the server, thus we call `preventDefault`. The DataTable now has the ability to disable itself so the user won't be able to continue while the request to the server is processed. This is done automatically by the cell editors, but we have to handle it ourselves in this case so we call method `disable` before submitting the information to the server and call `undisable` after the reply has arrived.

We then read a bunch of values and objects that we need to report to the server or to confirm the update. As with the previous example, we assemble a big URL with all this information and send it to the server. Upon receiving the server reply, if it is a 200 code we use `updateRow` to have both the UI and the recordset updated at once.

## Adding editors

If you try the [example](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html) you might notice that if you try to edit the cells in the amount column you are allowed to enter anything at all. It is when you click the 'Ok' button that the `validateNumber` function rejects the entry and leaves the cell contents unmodified but, until you do so, you can quite happily fill the textbox with all sorts of nonsense. I prefer my editor to let me know when I am doing something wrong instead of waiting until I thoroughly made a fool of myself. Fortunately, we are not limited to the available editors.

Let's take the standard `TextboxCellEditor` method and make an `RegExpCellEditor` one where you can specify a regular expression to validate the entry. Actually, we will handle two separate regular expressions, one to be used while the value is being entered and might not be yet complete. This will accept or reject keystrokes as they are being pressed. The other regular expression is that for the final value and it will highlight the entry by adding a className to the entry box so the graphics designer can choose how to signal the user that the value is not yet complete. For example to validate a US Social Security Number, this is how we would specify the editor in the column definition:

```
editor:new YAHOO.widget.RegExpCellEditor({
    regExp:'^\\d{0,3}-?\\d{0,2}-?\\d{0,4}$',
    finalRegExp:'^\\d{3}-\\d{2}-\\d{4}$',
    failedRegExpClassName:'warning'
})

```

While the `regExp` property is full of conditionals so that it won't mind while the values are being entered, the `finalRegExp` has no conditionals whatsoever, you have to put 3 digits, a dash, 2 digits, another dash and the final 4 digits and the whole entry from beginning (^) to end ($) is validated. While the entry doesn't match `finalRegExp` it will be shown with whatever CSS styles the style called `.warning` says, on the other hand, if what you enter doesn't match the `regExp` pattern, the character will simply be rejected so, in this case, nothing but digits and dashes can go, and those in the right places. The editor does not replace the normal `validator` which is an all-or-nothing validation once you have pressed Ok button, the editor does not prevent an invalid value from being accepted. A `validator` function might have to verify check-digits, check consistency with other values in the same record or a number of other things and the `asyncSubmitter` has the final say from the server itself. The `RegExpCellEditor` only gives feedback on the proper format of the entry, nothing more.

```
YAHOO.widget.RegExpCellEditor = function (oConfigs) {
    this._sId = "yui-regexptextboxceditor" + YAHOO.widget.BaseCellEditor._nCount++;
    oConfigs = oConfigs || {};
    oConfigs.type = 'regexptextbox';
    YAHOO.widget.RegExpCellEditor.superclass.constructor.call(this, oConfigs); 
    
};

```

First, the constructor for the cell editor. We first assemble an Id which the cell editor will use, based on the type of editor (so it makes it easy to find in the debugger) and a unique global index. We make sure the `oConfigs` is an object and add a `type` property to it. Then we call the constructor of the object we will inherit from, a regular textbox editor, all the previous being a preparation for that superclass constructor.

Next, as can be seen below, we extend the closest type of editor, the `TextboxCellEditor` which we will use as the model for our own editor. In fact, we will only add validation for the keys being typed into the textbox. The `YAHOO.lang.extend` function accepts a third argument which is an object containing the properties and methods we mean to add or override. We add the three properties for our editor and override the `render` method. This method normally draws the actual HTML elements that will take the user input. We won't actually draw anything different so the first thing we do is to call the same method of the superclass. What we are interested in is in setting up the listeners for the keystrokes.

```
YAHOO.lang.extend(YAHOO.widget.RegExpCellEditor, YAHOO.widget.TextboxCellEditor, {
    regExp: null,
    finalRegExp: null,
    failedRegExpClassName : '',
    
    render: function () {
        YAHOO.widget.RegExpCellEditor.superclass.render.call(this);

        if (this.regExp && YAHOO.lang.isString(this.regExp)) { 
            this.regExp = new RegExp(this.regExp); 
        }
        if (this.finalRegExp && YAHOO.lang.isString(this.finalRegExp)) {
            this.finalRegExp = new RegExp(this.finalRegExp); 
        }

        YAHOO.util.Event.on(this.textbox,'keypress', function(ev) {
            if (YAHOO.lang.isNull(this.regExp)) { return; }
            var textbox = this.textbox;
            if (YAHOO.env.ua.gecko > 0 && ev.keyCode) { 
                return;
            }
            var ch = ev.keyCode || ev.charCode, 
                val = textbox.value, 
                start, 
                end; 
            if (document.selection && document.selection.createRange) {
                //undocumented IE trick to get the selection box.
                start = Math.abs(document.selection.createRange().moveStart("character", -1000000));
                end = Math.abs(document.selection.createRange().moveEnd("character", -1000000)); 
            } else {
                start = textbox.selectionStart;
                end = textbox.selectionEnd;
            }
            val = val.substr(0,start) + String.fromCharCode(ch) + val.substr(end);
            if (!this.regExp.test(val)) {
                YAHOO.util.Event.stopEvent(ev);
            }
        },this,true);
        YAHOO.util.Event.on(this.textbox,'keyup',function(ev) {
            if (YAHOO.lang.isNull(this.finalRegExp)) { return; }
            if (this.finalRegExp.test(this.textbox.value)) {
                YAHOO.util.Dom.removeClass(this.textbox,this.failedRegExpClassName);
            } else {
                YAHOO.util.Dom.addClass(this.textbox,this.failedRegExpClassName);
            }
        },this,true);
    }

});
// Just to copy static members, not really needed.
YAHOO.lang.augmentObject(YAHOO.widget.RegExpCellEditor, YAHOO.widget.TextboxCellEditor);

```

The listeners for the keystrokes are somewhat complicated and in the end say little about the DataTable itself. The problem is that, while the `keyup` listener allows the data to be read directly from the input element, the character just entered can't be rejected. The only way to reject a character is to listen to the `keypress` event, which can be cancelled. The problem there is that since the character has not yet been inserted into the textbox, this process needs to be emulated. Thus, we need to find out where the insertion point is to get the character would go and that varies in between browsers. Once the would-be entry is assembled, it is compared against the regular expression and the character accepted (the default) or rejected via `stopEvent`. We do use the `keyup` event to compare against the `finalRegExp` and set or remove the given className accordingly.

## Extending the standard objects

The new version of the DataTable has brought many new classes. The DataSource has been broken into several specific classes, the ScrollableDataTable is now a separate thing from the simple DataTable, the Paginator is not distributed along the DataTable and the editors are now true objects. Extending them has become a little more complicated.

Why would you trouble yourself with extending them? If you have adopted some sort of standard envelope for data transmission as has been suggested, you might want to avoid specifying the `resultsList` every time since it is always the same and, if you override either `doBeforeParseData` or `doBeforeCallback` you might want that to be taken care of as well. And it you later change from, say, JSON to XML, you change your own DataSource object and the applications hardly needs to learn about it.

To start with, the `DataSource` object cannot be extended because it is not really a true object. What seems to be the constructor is actually a _factory_ which, depending on the `responseType` declared returns instances of the specific sub-classes derived from `DataSourceBase` so, extending `DataSource` will, in the end, fail. When you need to extend a `DataSource`, you have to extend the specific class you will be using `XHRDataSource`, `LocalDataSource` or any such sub-class.

If you extend the `DataTable` it will fail if you set the `scrollable` configuration attribute. The regular DataTable can be extended but when the `scrollable` is set it acts as a factory for a `ScrollableDataTable` and will fail just as extending `DataSource` or any such factory fails. Both the plain `DataSource` object and the `DataTable` when producing a scrollable data table are only entry points to provide backward compatibility.

As for the `Paginator` object, the only difference now is that it has to be explicitly loaded so it is more of a dependency issue.

The architecture of the cell editors has changed in important ways but migrating the prior versions to 2.6 is not much of a headache as we have already seen and the old style still works. Extending them is quite something else. Actually, in prior versions what you did is changing the plug-ins at the end of the core editor code, now you do really extend the editors since they are real objects. Examples of such migrations from the old plug-ins to the new objects can be found in the [DataGrid](http://www.satyam.com.ar/yui/#DataGrid) and [Invoice](http://www.satyam.com.ar/yui/#invoice) examples in my YUI examples, both available for 2.5 and 2.6 (in fact, the `RegExpCellEditor` above was taken from the later example).

## Conclusion

In this and the [previous article](/yuiblog/blog/2008/10/15/datatable-260-part-one/), we have seen how to create a `DataTable`, how to make changes to the `DataTable`, how to report those changes to the server and how, once accepted by the server, show those changes to the user. We have always maintained the database server as the primary source of our data, ensuring the `DataTable` does not show any changes until they have been confirmed by the server. We have also seen how to validate data input both at the row entry level and on a field-by-field basis.

Many of these techniques have been put together in the following [example](http://satyam.com.ar/yui/2.6.0/myDataTable/myClient.html), which is available for [download](http://satyam.com.ar/yui/2.6.0/myDataTable/satyamdatatable.zip).