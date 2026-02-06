---
layout: layouts/post.njk
title: "Quick Edit mode for YUI 2 DataTable"
author: "John Lindal"
date: 2010-08-19
slug: "quickedit-datatable"
permalink: /blog/2010/08/19/quickedit-datatable/
categories:
  - "Development"
---
[YUI 2 DataTable](http://developer.yahoo.com/yui/datatable/) provides slick inline editing. When `disableBtns` is turned on in the column configuration, editing simple values like strings or numbers feels just like Excel. However, the experience cannot be as responsive as a desktop application because each change typically requires an XHR call to the server to store (or reject!) the new value. If the user needs to change many of the displayed values, it can be a slow and frustrating experience. To solve this, I developed QuickEditDataTable. This extends DataTable to add Quick Edit mode, which allows all editable values to be changed in one bulk operation:

[![](http://jafl.github.com/yui2/quickedit/example.png)](http://jafl.github.com/yui2/quickedit/)

([Click the screenshot to play with this example](http://jafl.github.com/yui2/quickedit/ "YUI 2 Quick Edit Example").)

### Overview

To enter Quick Edit mode, call `startQuickEdit()`. To exit Quick Edit mode, call `cancelQuickEdit()`.

It is your responsibility to save the changes before calling `cancelQuickEdit()`. To simplify this task, QuickEditDataTable provides `getQuickEditChanges()`. This returns an array of objects, one for each row. Each object contains only the values that were changed in that row, keyed off the column id's. For example, if the table has 4 columns (title, author, year, quantity), and the user only changed the quantity in one row to 20, then the object for that row would be `{quantity:20}`. The other values would be omitted.

QuickEditDataTable can easily extend `YAHOO.widget.ScrollingDataTable` if you need that functionality. If you need this, simply make a copy of the source file and change the base class.

### Configuration

Quick Edit is a modal state in which the cell formatters for editable columns are swapped out and replaced with special formatters that generate `input`, `textarea`, or `select` elements. Only columns that have `quickEdit` configuration will be editable. The configuration options are:

`copyDown`

If true, the top cell in the column will have a button to copy the value down to the rest of the rows.

`formatter`

The cell formatter which will render an appropriate form field: <input type="text">, <textarea>, or <select>. By default, the cell formatter `YAHOO.widget.QuickEditDataTable.textQuickEditFormatter` is used for all cells to produce input elements. To get a `textarea` element, configure a column to use `YAHOO.widget.QuickEditDataTable.textareaQuickEditFormatter` instead. You can also write a custom quick edit formatter -- see below.

`validation`

Validation configuration for every field in the column.

`css`

CSS classes encoding basic validation rules:

`yiv-required`

Value must not be empty.

`yiv-length:[x,y]`

String must be at least `x` characters and at most `y` characters. At least one of x and y must be specified.

`yiv-integer:[x,y]`

The integer value must be at least `x` and at most `y`. `x` and `y` are both optional.

`yiv-decimal:[x,y]`

The decimal value must be at least `x` and at most `y`. Exponents are not allowed. `x` and `y` are both optional.

`fn`

A function that will be called with the DataTable as its scope and the cell's form element as the argument. Return true if the value is valid. Otherwise, call `this.displayQuickEditMessage(...)` to display an error and then return false.

`msg`

A map of types to messages that will be displayed when a basic or regex validation rule fails. The valid types are: `required`, `min_length`, `max_length`, `integer`, `decimal`, and `regex`. There is no default for type `regex`, so you must specify a message if you configure a regex validation. The default error messages for the other types are stored in `YAHOO.widget.QuickEditDataTable.Strings` and can be overridden and/or localized.

`regex`

Regular expression that the value must satisfy in order to be considered valid.

Sometimes, a non-editable column must be rendered differently during Quick Edit mode. The best example is a column containing a link, since navigating away from the page while in Quick Edit mode can be disastrous. To remove the link during Quick Edit, configure `qeFormatter` for the column to be `YAHOO.widget.QuickEditDataTable.readonlyLinkQuickEditFormatter`. For email addresses, use `YAHOO.widget.QuickEditDataTable.readonlyEmailQuickEditFormatter`. You can also write you own custom, read-only formatter. Simply follow the normal rules for constructing a DataTable cell formatter.

### Custom Quick Edit Formatters

To write a custom cell formatter for QuickEdit mode, you must structure the function as follows:

```
function myQuickEditFormatter(el, oRecord, oColumn, oData) {
  var markup =
    '<input type="text" class="{yiv} yui-quick-edit yui-quick-edit-key:{key}"/>' +
    YAHOO.widget.QuickEditDataTable.MARKUP_QE_ERROR_DISPLAY;
    el.innerHTML = lang.substitute(markup, {
      key: oColumn.key,
      yiv: oColumn.quickEdit.validation ? (oColumn.quickEdit.validation.css || '') : ''
    });
    el.firstChild.value = extractMyEditableValue(oData);
    YAHOO.widget.QuickEditDataTable.copyDownFormatter.apply(this, arguments);
};

```

You can use `textarea` or `select` instead of `input`, but you can only create a single field.

`extractMyEditableValue()` does not have to be a separate function nor must it be limited to using only `oData`. The work should normally be done inline in the formatter function, but the name of the sample function makes the point clear.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._