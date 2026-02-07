---
layout: layouts/post.njk
title: "Quick Edit mode for YUI 3 DataTable"
author: "John Lindal"
date: 2011-04-19
slug: "quickedit-datatable-yui3"
permalink: /2011/04/19/quickedit-datatable-yui3/
categories:
  - "Development"
---
Even though [YUI 3 DataTable](http://developer.yahoo.com/yui/3/datatable/) does not yet have inline editing of individual cells, it is relatively simple to implement Quick Edit mode. The [QuickEdit](http://yuilibrary.com/gallery/show/quickedit) plugin for DataTable in the [YUI 3 Gallery](http://yuilibrary.com/gallery/) allows all the visible values in a DataTable to be edited simultaneously.

[![](http://jafl.github.com/yui3-gallery/quickedit/example.png)](http://jafl.github.com/yui3-gallery/quickedit/ "YUI 3 Quick Edit Screenshot")

([Click the screenshot to play with this example](http://jafl.github.com/yui3-gallery/quickedit/ "YUI 3 Quick Edit Example").)

### Overview

As with the [YUI 2 version](/yuiblog/2010/08/19/quickedit-datatable/), the core idea of Quick Edit mode is to swap out all the cell formatters with new ones which populate the cells with form elements, e.g., input fields or dropdowns. This is done when `start()` is called, based on the configuration described below. After the user is finished, you can call `getChanges()` to get the changed values and then persist them. To exit Quick Edit mode, call `cancel()`. (It is named cancel instead of stop to remind you that it _discards_ all changes.)

Since the Quick Edit gallery module is a plugin for DataTable, you need to plug it in to your datatable before you can use it:

```
my_table.plug(Y.Plugin.DataTableQuickEdit);

```

This stores the plugin in the `qe` member of the datatable, so you must call the plugin's functions like this:

```
my_table.qe.start();

```

### Configuration

Quick Edit adds two new configuration attributes to all columns: `quickEdit` and `qeFormatter`.

If a column's `quickEdit` property is defined, the column will be editable in Quick Edit mode. To accept all the defaults, you can simply set `quickEdit:true`. For more control, you can pass an object with the following properties:

`formatter`

The cell formatter which will render an appropriate form field: <input type="text">, <textarea>, or <select>. By default, the cell formatter `Y.Plugin.DataTableQuickEdit.textFormatter` is used for all cells to produce input elements. To get a `textarea` element, configure a column to use `Y.Plugin.DataTableQuickEdit.textareaFormatter` instead.

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

A function that will be called with the DataTable as its scope and the cell's form element as the argument. Return true if the value is valid. Otherwise, call `this.displayMessage(...)` to display an error and then return false.

`msg`

A map of types to messages that will be displayed when a basic or regex validation rule fails. The valid types are: `required`, `min_length`, `max_length`, `integer`, `decimal`, and `regex`. There is no default for type `regex`, so you must specify a message if you configure a regex validation. The default error messages for the other types are stored in `Y.FormManager.Strings` (provided by [gallery-formmgr-css-validation](http://yuilibrary.com/gallery/show/formmgr-css-validation)) and can be overridden and/or localized.

`regex`

Regular expression that the value must satisfy in order to be considered valid.

Sometimes, a non-editable column must be rendered differently during Quick Edit mode. The best example is a column containing a link, since navigating away from the page while in Quick Edit mode can be disastrous. To remove the link during Quick Edit, configure `qeFormatter` for the column to be `Y.Plugin.DataTableQuickEdit.readonlyLinkFormatter`. For email addresses, use `Y.Plugin.DataTableQuickEdit.readonlyEmailFormatter`. You can also write you own custom, read-only formatter. Simply follow the normal rules for constructing a DataTable cell formatter.

### Missing Features

Due to a [bug in YUI 3.3.0 DataTable](http://yuilibrary.com/projects/yui3/ticket/2529839), the `td` element passed to a column formatter is actually from the _previous_ column. This made it too troublesome to support copy down, where a button in the first row lets you copy the value down to all other rows.

The bug also required a complete reworking of the basic Quick Edit cell formatters to return text instead of manipulating the DOM. This is why custom cell formatters are not officially supported in this initial release. If you are adventurous, you can still build them, but keep in mind that you will need to rewrite them, including adding in support for copy down, once the bug in DataTable is fixed.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._