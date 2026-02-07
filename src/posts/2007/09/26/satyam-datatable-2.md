---
layout: layouts/post.njk
title: "Working with the YUI DataTable Control, Part 2: Changing the Contents of the DataTable"
author: "YUI Team"
date: 2007-09-26
slug: "satyam-datatable-2"
permalink: /2007/09/26/satyam-datatable-2/
categories:
  - "Development"
---
**Don't miss [Part One of this series](/yuiblog/2007/09/12/satyam-datatable/), in which Satyam explores practical steps on getting started with the [YUI DataTable Control](http://developer.yahoo.com/yui/datatable/).**

In a [previous article](/yuiblog/2007/09/12/satyam-datatable/) I wrote about how to get started with your own implementation of the `DataTable` component. In this article I will cover how to change the contents of the `DataTable`, especially how to communicate with your database server to make changes and, if successful, show those changes to the user, since in many applications, the contents of the `DataTable` should be a reflection of the information in a database.

## Deleting records

We will start with the easiest transaction: deleting a single record. First let's make a column containing a delete icon which, when clicked, will delete the row. To do that, we declare that extra column in the column definitions for the `DataTable` in this way:

```
var myColumnDefs = [
    ....,
    ....,
    {key:'delete',label:' ',formatter:function(elCell) {
        elCell.innerHTML = '<img src="images/delete.png" title="delete row" />';
        elCell.style.cursor = 'pointer';
    }}, 
    ....
```

We are declaring an extra column with `key` equal to `'delete'`, with a blank column header (if `label` is not declared the header will default to the `key` value so we have to explicitly say we don't want one) and with a `formatter` function that we define on the spot. We will use only the `elCell` argument so we don't even bother to declare the other three arguments passed to the formatter function. We simply put an image into that cell; no `onClick` or `id` attributes are needed for that image, as we will see, and we couldn't care less for the contents of that cell, meaning it can be a `<button>`, a simple text or nothing.

We are going to be able to detect a click on the cell by subscribing to the `cellClickEvent`. If we also want to have inline cell editing, we would have the following somewhere in our code:

```
myDataTable.subscribe('cellClickEvent',myDataTable.onEventShowCellEditor);
```

This is telling the `DataTable` that when it receives a cell click event it should activate the cell editor, but that is not the only option. We could have instead:

```
myDataTable.subscribe('cellClickEvent',function(ev) {
    var target = YAHOO.util.Event.getTarget(ev);
    var column = myDataTable.getColumn(target);
    if (column.key == 'delete') {
        if (confirm('Are you sure?')) {
            myDataTable.deleteRow(target);
        }
    } else {
        myDataTable.onEventShowCellEditor(ev);
    }
});
```

Instead of simply showing the cell editor, first we check whether the click came from a cell in the new column, the one with the delete icon. Use the Event component's `getTarget()` method to get the target cell of the click. We can then use the target cell to get the column via `getColumn()` and then check for its `key` value. If the `key` of the clicked column is the same for the delete icon column and, if the user confirms the action, we call `deleteRow()` and pass in the target cell as an argument. The event listener is executed in the scope of the table, so `this` and `myDataTable` within the function are the same.

We have one problem with this code: the server knows nothing of this change, so we will have to insert some code in between the user confirmation and the actual row deletion:

```
myDataTable.subscribe('cellClickEvent',function(ev) {
    var target = YAHOO.util.Event.getTarget(ev);
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
        this.onEventShowCellEditor(ev);
    }
});
```

After confirming the user intention, we call `asyncRequest()` of the Connection Manager. We make a `GET` request to the server, passing it the value of the database primary key, here called `id`, for the current record which we get through a call to `getData()`. Upon a successful reply from the server, if it sends an `'Ok'` message, we delete the row as before. If there is any other reply from the server, we assume it to be an error message and we show it to the user, just as we do if we are unable to connect the server in the `failure` callback option.

In this example I changed the references from `myDataTable` to `this`, since the event listener is called within the scope of the `DataTable`, but beware, the callback to the `asyncRequest()` method has a different scope unless you explicitly force it and so we need to add `scope:this` for the `this.deleteRow()` inside the callback to work. Thanks to closure, the variable `target` within the `success` callback function refers to the one in the enclosing function. I am simplifying a bit here, but in your own code you might prefer to use `YAHOO.widget.SimpleDialog` instead of `confirm()` and `alert()`.

If you analyze this function you may notice that all the information it needs comes from the event `target` except for two hard coded values: the column key and the database's primary key for the record. This forces us to rewrite this very same function for each and every table. We can, though, provide this information from elsewhere so that we could put this function into our own handy personal library. In the [previous article](/yuiblog/2007/09/12/satyam-datatable/) I mentioned that the column definitions were extensible, and you can add your own properties to them as long as their names don't collide with those the YUI uses. We can add a couple of such properties. One we will call `action` and in this case we will set `action:'delete'`. The other property we will call `isPrimaryKey` and it will either be `true` or simply not be there. We will set it to `true` only in the column or columns which are the primary keys in the database. Our generic delete function might then look like this:

```
myDataTable.subscribe('cellClickEvent',function(ev) {
    var target = YAHOO.util.Event.getTarget(ev);
    var column = this.getColumn(target);
    if (column.action  == 'delete') {
        if (confirm('Are you sure?')) {
            var record = this.getRecord(target);
            YAHOO.util.Connect.asyncRequest(
                'GET',
                'myServer.php?action=delete' + myBuildUrl(record),
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
        this.onEventShowCellEditor(ev);
    }
});
```

Where the `myBuildUrl()` function is:

```
var myBuildUrl = function(record) {
    var url = '';
    var cols = this.getColumnSet().keys;
    for (var i = 0; i < cols.length; i++) {
        if (cols[i].isPrimaryKey) {
            url += '&' + cols[i].key + '=' + escape(record.getData(cols[i].key));
        }
    }
    return url;
};
```

This function goes through all the column definitions looking for the `isPrimaryKey` property and, if set, it will concatenate into the variable `url` the column's `key` name, which we assume to be URL-safe, and the current value for that column taken from `record` all in proper and escaped URL encoded format. The value returned will even have the leading `'&'` since, most of the time, we will be appending it to a partially built URL. Most of the transactions we do with the server will require us to identify the record by its primary keys so we will use this function quite often.

## Inserting rows

It is quite easy to insert a blank row into the `DataTable`. Let's assume that we have added another column that has buttons to insert a row. The following code will insert a blank row above the row where the button was clicked. Since we now have more options for the `action` column property, we change the previous `if(column.action == 'delete')` to a switch:

```
myDataTable.subscribe('cellClickEvent',function(ev) {
    var target = YAHOO.util.Event.getTarget(ev);
    var column = this.getColumn(target);
    switch(column.action) {
        case 'insert':
            this.addRow( {} , this.getRecordIndex(target));
            break;
    ....
```

The `addRow()` method takes an object literal whose property names are those of the `column.key` properties and the values for each property are the ones to be inserted. Those fields not explicitly set (none in this example) will be set to `undefined`. In normal circumstances the object literal should be filled with suitable defaults. The second argument to `addRow()` is the position where the record is to be inserted, in this case taken from the position of the click via `getRecordIndex()`.

The user will still need to input data for the new row and the new data will need to be sent to the server as we will see later on. Since there is no built-in row editing functionality in the current release, the best option is to pop up a `Dialog` from the Container component. The [documentation for the Dialog component](http://developer.yahoo.com/yui/container/dialog/) shows how to assemble a form and submit the information collected to the server, so I won't cover that here.

Another idea for row insertion is to trigger it via a context menu, where you would have to insert the new row in relation to the row that triggered the context menu. Or an 'Add New Record' button or link directly outside the table could cause a row to be inserted at position 0, which would be the top of the table. This is a case where we can fully appreciate the difference in between row numbers and record id numbers that we mentioned in the [previous article](/yuiblog/2007/09/12/satyam-datatable/). The record we have just created will get a new record id number, one higher than the highest record ever assigned. Nevertheless, it would get row number 0, because that's where we placed it with the `addRow()` method. They are different concepts and they are also different from the primary key(s) of the database record on the server.

Once we decide how we want to allow the user to insert a row, we need to send the request to, and handle the reply from, the server. We should not fully count on the information the user entered into the `Dialog` form -- the database might assign default values for empty fields, it might have timestamp values inserted into date fields or, it might have an auto-incremented integer as its primary key so we need to know what that key value turned out to be. In the [Submitting Form Data](http://developer.yahoo.com/yui/container/dialog/#submit) section in the `Dialog` documentation we have the `onSuccess` callback function which simply pops up a message alert to the user. We will use that callback to insert the record with the values returned from the server.

In the [previous article](/yuiblog/2007/09/12/satyam-datatable/) I mentioned the benefits of using a standard message response. We didn't use that standard message format in the previous section in order to focus on the new information presented. Let's take a moment and review since we now have a more complex reply from the server and we can't just get by with a plain 'Ok'. I use JSON as the basis for my server replies; I don't recommend plain text because it lacks any structure (for instance, you could not make an envelope); and though XML is a good choice, I find it too verbose and harder to parse. My message format is this:

```
{
    replyCode:200, replyText:"Ok", 
    data:[{ ... } , ... ] 
}
```

All messages will be enclosed in an envelope carrying status information which reports in numeric and textual form the result of the transaction requested. Then in the optional `data` property, whatever extra information the client requested is also passed along. In the row delete case, the `data` property would be empty and there would either be a successful `200 'Ok'` reply or it would get some 500 `replyCode` and an error message in `replyText`. The numbers for the `replyCode` are modeled after the standard HTTP reply codes. In our row insert case, we would receive the reply status envelope plus the full record with all its default values, auto-incremented fields, timestamps and whatnot or, in the case of server error, a 500 `replyCode` and an error description. Thus, our Connection Manager `success` callback function would look like this:

```
var onSuccess = function(o) {
    var r = parseJSON(o.responseText);
    if (r.replyCode == 200) {
        myDataTable.addRow(r.data,0);
        var tr = myDataTable.getTrEl(0);
        YAHOO.util.Dom.addClass(tr,'my-highlight-row');
        setTimeout(function() {
            YAHOO.util.Dom.removeClass(tr,'my-highlight-row');
        },2000);
    } else {
        alert(r.replyText);
    }
};
```

We first decode the JSON reply with our favorite JSON parser. If the `replyCode` is `200`, indicating success, let's add the row just as it comes from the server in the first table position, row number 0. Remember that when the `DataSource` reads the data, it makes the data type conversion through the function we set in the `parser` property. We have to do the same here. Some JSON converters on the server side send numbers as actual numbers instead of enclosing them in quotes. This is not often the case and it shouldn't be counted upon since a later version might change that behavior, so the call to `addRow()` in a real case would more likely look like this:

```
myDataTable.addRow({
    someNumericField: YAHOO.util.DataSource.parseNumber(r.data.someNumericField),
    someDateField: YAHOO.util.DataSource.parseDate(r.data.someDateField),
    someTextField: r.date.someTextField,
    someBooleanField: !!r.date.someBooleanField  // yes, those are two 'not' operators put together
},0);
```

The lines after the call to `addRow()` simply use the Dom Utility's `addClass()` and `removeClass()` to highlight the row for 2 seconds in order to call attention to the newly inserted row.

All along we've been assuming the column `key` names are the same as the database table column names, a practice I recommend. SQL names are valid JavaScript variable names and are URL-safe so there is no reason not to use the same names all through, but of course, if you inherit a system with funny column names (some databases allow names in national language character sets which might cause encoding problems or JavaScript errors) you might have to change those names, preferably on the server side, if that is where the culprit lies.

## Inline cell editing

One of the most attractive features of the `DataTable` is that you can edit cells as if in a spreadsheet. The [documentation](http://developer.yahoo.com/yui/datatable/#edit) covers the basics and a working example can be found [here](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html). Besides setting the `editor` property in the column definitions to a suitable editor for that column, you have to remember to pass the `cellClickEvent` to the `onEventShowCellEditor()` method just as is shown in the documentation or how we did when we captured the `cellClickEvent` for our own use.

Notice that in all the above examples we have always had the `DataTable` as a reflection of the data on the database server. In all cases we have sent the intended change to the server, and only on a successful reply from the server we have updated the information presented to the user. We will do the same thing now with inline cell editing. The `DataTable` provides the `editorSaveEvent` which fires after the new value has been updated on the screen, which is unfortunately too late under this premise. If on communicating with the server we receive a failure `replyCode`, it is too late to revert the user input since the editor popup would have already been closed and the screen already updated, leading the user to believe the change has succeeded. He might have even navigated away from the page!

The big problem is that the communication with the server is performed in an asynchronous way so the designers of the `DataTable` didn't have much choice as to what they could offer, since such communication can be handled in so many ways. The many possible alternatives would make a parameterized `saveCellEditor()`, such is the name of the method, unwieldy.

The only choice, then, would be to provide a custom method to handle the communication with the server. Ideally, the method `onEventSaveCellEditor()`, which in the supplied version simply calls `saveCellEditor()`, is meant to be a hook for such customizations since you could redefine `onEventSaveCellEditor()` to handle things your way. Unfortunately as of 2.3.0, there is a bug which renders this hook non-functional, so check the release notes for later versions on the status of this.

Failing that, instead of overriding the hook `onEventSaveCellEditor()`, we can override `saveCellEditor()` itself. We will use the original as the model, so here it is, with its original comments removed and mine added:

```
YAHOO.widget.DataTable.prototype.saveCellEditor = function() {
    if(this._oCellEditor.isActive) {
        var newData = this._oCellEditor.value;
        var oldData = this._oCellEditor.record.getData(this._oCellEditor.column.key);

        if(this._oCellEditor.validator) {
            this._oCellEditor.value = this._oCellEditor.validator.call(this, newData, oldData);
            if(this._oCellEditor.value === null ) {

// --------      on failure section
                this.resetCellEditor();
                this.fireEvent("editorRevertEvent",
                    {editor:this._oCellEditor, oldData:oldData, newData:newData}
                );
// -------- end of on failure section 

                return;
            }
        }

// --------      on success section
        this._oRecordSet.updateKey(this._oCellEditor.record, this._oCellEditor.column.key, this._oCellEditor.value);
        this.formatCell(this._oCellEditor.cell);
        this.resetCellEditor();
        this.fireEvent("editorSaveEvent",
            {editor:this._oCellEditor, oldData:oldData, newData:newData}
        );
// --------      end of on success section

    }
    else {
    }
};
```

I have marked a couple of sections out of the main body of the method which correspond to the actions taken on success and on failure. In this case, the only source of failure is the `validator` function, if provided, returning `null`. The variable `this._oCellEditor.value` is where all editors store the entered value. Actually, `this._oCellEditor` also holds lots of useful information which you can find described in the [API documentation](http://developer.yahoo.com/yui/docs/YAHOO.widget.DataTable.html#getCellEditor).

A detail often overlooked is that the `validator` function is also the place to do data conversion for the data just entered. The value finally saved into the table is not the one initially read into the variable `newData` but that returned by the `validator` function. This is not optional for some data types. Digits entered into an HTML textbox do not make a number but a string of digits. If we allow that string to get into the `RecordSet`, we will find, later on, that sorting columns doesn't work as expected. Other cell editors don't give trouble: the calendar editor will already return a native JavaScript `Date` object. A dropdown will return the option value, not the description but, once again, as a string not a number. `DataTable` has the static function `YAHOO.widget.DataTable.validateNumber` which can be assigned to the `validator` function for any numeric column to do such conversion, as seen in the [example](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html) (see the column definition for column `'amount'`). Incidentally, `validateNumber()` failed to enter the API documentation so you won't find it there.

Our modified `saveCellEditor()` will look like this:

```
YAHOO.widget.DataTable.prototype.saveCellEditor = function() {

// ++++ this is the inner function to handle the several possible failure conditions
    var onFailure = function (msg) {
        alert(msg);

// --------      on failure section        
        this.resetCellEditor();
        this.fireEvent("editorRevertEvent",
            {editor:this._oCellEditor, oldData:oldData, newData:newData}
        );
// --------      end of on failure section

    };

// +++ this comes from the original except for the part I cut to place in the function above.

    if(this._oCellEditor.isActive) {
        var newData = this._oCellEditor.value;
        var oldData = this._oCellEditor.record.getData(this._oCellEditor.column.key);

        if(this._oCellEditor.validator) {
            newData = this._oCellEditor.validator.call(this, newData, oldData);
            this._oCellEditor.value = newData;
            if(newData === null ) {

// this is where the contents of the inner function onFailure used to be.
                onFailure('validation');
                return;
            }
        }

// ++++++ from here on I added new, except for the 'success' case pasted in.

        YAHOO.util.Connect.asyncRequest(
            'POST',
            'myServer.php?action=update&newData=' + escape(newData) + 
            '&oldData=' + escape(oldData) + myBuildUrl(this._oCellEditor.record),
            {
                success: function (o) {
                    var r = parseJSON(o.responseText);
                    if (r.replyCode == 200) {

// --------     on success section
                        this._oRecordSet.updateKey(this._oCellEditor.record, this._oCellEditor.column.key, newData);
                        this.formatCell(this._oCellEditor.cell);
                        this.resetCellEditor();
                        this.fireEvent("editorSaveEvent",
                            {editor:this._oCellEditor, oldData:oldData, newData:newData}
                        );
// --------     end of on success section

                    } else {
                        onFailure(r.replyText);
                    }
                },
                failure: function(o) {
                    onFailure(o.statusText);
                },
                scope: this
            }
        );
    } else {
    }
};
```

I still left the original comments enclosing the success and failure actions, which have been moved around but remain mostly as they were. Since there are many causes of failure, the failure section has been enclosed in an inner function called `onFailure()` and moved to the top so it can be called from several places within the method. After that comes the original source except for the place where the failure section was, which now has a call to the `onFailure()` inner function.

After validating, we have the call to `asyncRequest()` to pass the new value to the server. Notice how we build the URL indicating the action we want to have performed, the new and old values and the reference to the primary key built by the `myBuildUrl()` function which we introduced earlier. In the `success` callback we parse the JSON message of the server reply. We check for a `replyCode` of `200` which signals success and then go into the success section we took from the original. If the `replyCode` was anything but 200 we call the `onFailure()` function with the message received in `replyText`. If the communication failed, the `failure` callback will call the `onFailure()` function with the text from `statusText`. Finally we make sure to set the scope for the callback functions to that of the `DataTable`.

We left most of the code as it was, including calls to events which we might not even use. We can change the behavior a little bit, though. If there is an error, you might choose to leave the editing popup open. The user would then either fix the value entered or click on the 'Cancel' button to explicitly drop the intended change, an option I prefer so it is absolutely clear to the user that the change did not occur.

### Checkboxes and radio buttons

These two form elements can be utilized differently depending on the situation. Built-in formatters will display one checkbox or one radio button per row directly in a cell and expose checkboxClickEvent and radioClickEvent custom events, while the built-in editors are designed to display several checkboxes or several radio buttons in a dialog atop a cell so they let you set multiple (in the case of checkboxes) or mutually exclusive (in the case of radio buttons) values for each cell as an inline editor. The use of similar names is somewhat misleading in that you might associate `formatCheckbox` with `editCheckbox` and `formatRadio` with `editRadio` but they are not at all related.

Another consideration is that users might expect to interact with checkboxes and radios differently than textboxes or calendars. Most probably they would expect the checkbox to be clickable and its state to change immediately without having to click an `Ok` or `Cancel` button. If the data is critical you might want to have the user confirm the change before committing it to the database. In the next section, [Adding Editors](#adding_editors), you will see how to make your own custom editor.

If we want even fewer clicks to change the checkboxes or radio buttons, we wouldn't use an editor at all, but instead the formatters to display these form elements directly in each cell. The `DataTable` makes it easy to execute click handlers by providing the `checkboxClickEvent` and `radioClickEvent` custom events. Note that although the formatter for dropdowns draws an active HTML select box, there is no corresponding `dropdownClickEvent` to signal changes to it, nor does the `DataTable` refuse to accept changes, which might lead the user to believe the change has been accepted. This is marked TODO in the source, so keep an eye on that.

The source of the [Custom Cell Formatting](http://developer.yahoo.com/yui/examples/datatable/dt_formatting.html) example provides us with most of the code we need:

```
this.myDataTable.subscribe("checkboxClickEvent", function(oArgs){   
    var elCheckbox = oArgs.target;   
    var elRecord = this.getRecord(elCheckbox);   
    var name = elRecord.getData("field5");   
    alert("Checkbox was " + (elCheckbox.checked ? "" : "un") + "checked for " + name);   
});  
```

This function listens for the `checkboxClickEvent` and, when fired, displays a message showing the new state and the value of an associated field in the same row; but this falls short of what we need. First of all, if you check the [example](developer.yahoo.com/yui/examples/datatable/dt_formatting.html) mentioned, you will see that if you check some boxes and then do a sort, the checked boxes are lost. This is because the screen image of the `DataTable` is derived from the underlying `RecordSet`, and we have not changed that. When `DataTable` needs to refresh the table, it will resort to the `RecordSet` and will clear all the checkboxes and radio buttons.

The first thing to do, then, is to update the `RecordSet`. The following two lines can take care of that:

```
var elColumn = this.getColumn(elCheckbox);
this.getRecordSet().updateKey(elRecord, elColumn.key, elCheckbox.checked);
```

But we meant to have the database server be our master copy for the data and if we execute the lines above in the same listener function, we would have the user see a change that has not been accepted by the server yet. I won't repeat the full code for this as you can see most of it in the [code box above](#saveCellEditor). Remember we took from the original `saveCellEditor()` method a _success section_ and a _failure section_ and we rearranged the original code from `saveCellEditor()` so that the _success section_ would be executed on receiving a `200 'Ok'` reply from the server and the _failure section_ would be executed on any other condition. We will do the same thing here. Consider these last two lines of code as the _success section_.

We don't have a _failure section_ so far but we will need one. While with textboxes the change done in the pop up editor has to be copied to the actual cell under it, with checkboxes and radio buttons, the control itself will have changed. So, our _failure section_ needs to revert the change. We can do it in one of two ways. We can either explicitly change the value of the checked attribute of the checkbox or reject the event. Here they are, you just need to choose one:

```
elCheckbox.checked = ! elCheckbox.checked;
YAHOO.util.Event.stopEvent(oArgs.event);
```

So, we just add the call to `asyncRequest()` and put these two pieces of code in the corresponding slots, as we did before.

Radio buttons, though, require some extra work. HTML radio buttons are exclusive of one another but the fields in the `RecordSet` are not. We will be notified via `radioClickEvent` that a new radio button was clicked, but we won't know which one has become unchecked. Moreover, while calling `stopEvent()` to cancel the click works in Firefox and it does revert the set of radio buttons to have the prior one checked, in IE you can stop the new radio button from getting checked, but it does not restore the previously checked radio button. My recommendation is to have a globally scoped variable (in `YAHOO.example` or your own namespace) containing a reference to the last radio button checked. In the _success section_, we have to first read the record of the previous checked radio button and set it to `false`, and then set the field in the new record and store the reference to the variable in the global tracker:

```
// on success:
var elRecord = this.getRecord(YAHOO.example.myLastRadioButton);
this.getRecordSet().updateKey(elRecord, elColumn.key, false);
var elRecord = this.getRecord(elRadio);
this.getRecordSet().updateKey(elRecord, elColumn.key, true);
YAHOO.example.myLastRadioButton = elRadio;

// on failure:
elRadio.checked = false;
YAHOO.example.myLastRadioButton.checked = true;
```

While in the _success section_ we updated the `RecordSet` to reflect the changes and we don't care about the user interface since it has already changed for us, in the _failure section_ we leave the `RecordSet` alone, since we didn't change anything in it, but revert the user interface which did change.

## Adding editors

If you try the [example](http://developer.yahoo.com/yui/examples/datatable/dt_cellediting.html) you might notice that if you try to edit the cells in the amount column you are allowed to enter anything at all. It is when you click the 'Ok' button that the `validateNumber()` function rejects the entry and leaves the cell contents unmodified but, until you do so, you can quite happily fill the textbox with all sorts of nonsense. You don't like it? What prevents you from making your own editor! Let's take the standard `editTextbox()` method and make an `editNumber()` method of our own:

```
YAHOO.widget.DataTable.editNumber = function(oEditor, oSelf) {
    var elCell = oEditor.cell;
    var oRecord = oEditor.record;
    var oColumn = oEditor.column;
    var elContainer = oEditor.container;
    var value = YAHOO.lang.isValue(oRecord.getData(oColumn.key)) ? oRecord.getData(oColumn.key) : "";

    var elTextbox = elContainer.appendChild(document.createElement("input"));
    elTextbox.type = "text";
    elTextbox.style.width = elCell.offsetWidth + "px"; 
    elTextbox.value = value;

    YAHOO.util.Event.addListener(elTextbox, 'keypress', function(ev){
        if (ev.keyCode != 0) return;
        if (ev.charCode >= 48 && ev.charCode <= 57) return;
        YAHOO.util.Event.stopEvent(ev);
    });

    YAHOO.util.Event.addListener(elTextbox, "keyup", function(ev){
        oEditor.value = parseInt(elTextbox.value,10);
        oSelf.fireEvent("editorUpdateEvent",{editor:oEditor});
    });

    elTextbox.focus();
    elTextbox.select();
};
```

Our `editNumber()` method is simply the `editTextbox()` method with a listener for the `keypress` event added, where we check for valid characters. We accept all non-printable characters such as arrow keys, backspace and so on by letting by all non-zero `keyCode` values. If the key pressed corresponds to a valid printable character then we check that is in the range of 48 to 57 that spans the digits. If the key pressed does not correspond to those, we call `stopEvent()` so the key pressed will not be accepted. By simply adding more `charCode` numbers to the conditional we could accept the minus sign, a decimal separator or whatever we want. We are also converting the string entered into the textbox to an actual integer (see the call to `parseInt()`) so there will be no need to use `validateNumber()` later on.

To use this editor instead of the standard textbox editor in the column definition for this particular column, instead of indicating `editor:'textbox'` we would put:

```
..., editor:YAHOO.widget.DataTable.editNumber, ...
```

All edit methods receive the [`oEditor`](http://developer.yahoo.com/yui/docs/YAHOO.widget.DataTable.html#getCellEditor) object, which we met before under the name of `this._oCellEditor` and contains a lot of information: the cell being edited, the record and column for that cell and the container (which is the popup dialog where the `<input>` element, or whichever control you want, will be placed). The method also reads the current value of the cell from the record; usually it is safer to read the raw data value from the record than read it from `elCell.innerHTML` which might be formatted with extra decoration that we would have to strip away. We then create an `<input>` element inside the container, set the type to `text` (due to an anomaly in IE, we would not be able to set it to anything else anyway), stretch it to the same size as the cell in the `DataTable` and load it with the current value. Then we set our event listeners. Finally we put the focus on the textbox and select all its contents.

Notice the `<input>` box is completely anonymous. We hold a reference to it in `elTextbox` but otherwise it has no `id` nor `name`; we don't need one. If we need to reach it, it will always be the `firstChild` of the container. After the edit function executes, the `DataTable` will place the 'Ok' and 'Cancel' buttons (assuming they have not been disabled) and position the top left corner of the container to match the top left corner of the cell being edited.

A very important thing to do is to respond to each and every change in the editor by storing its current value into `oEditor.value`. Different types of editors might hold their values in different ways. A textbox holds data in its `value` property, a textarea in `innerHTML`, and more complex editors such as the `Calendar` might require calling a method or a conversion. Since at any time the user might click the 'Ok' button and our editor would lose the control of the value, it is important that at all moments it stores the current value in `oEditor.value` where `saveCellEditor()` can reach it.

For a more complex example of an editor you might look at the `editDate()` method which uses the `Calendar` component. With the few tips mentioned above, you will find that it is not so difficult after all.

## Conclusion

In this and the [previous article](/yuiblog/2007/09/12/satyam-datatable/), we have seen how to create a `DataTable`, how to make changes to the `DataTable`, how to report those changes to the server and how, once accepted by the server, show those changes to the user. We have always maintained the database server as the primary source of our data, ensuring the `DataTable` does not show any changes until they have been confirmed by the server. We have also seen how to validate data input both at the row entry level and on a field-by-field basis.