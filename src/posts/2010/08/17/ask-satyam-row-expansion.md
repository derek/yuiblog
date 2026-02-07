---
layout: layouts/post.njk
title: "Ask Satyam: Row Expansion and Nested DataTables"
author: "YUI Team"
date: 2010-08-17
slug: "ask-satyam-row-expansion"
permalink: /2010/08/17/ask-satyam-row-expansion/
categories:
  - "Development"
---
> [![](/yuiblog/blog-archive/assets/satyam-book-small-20100809-120823.jpg)](https://www.packtpub.com/yahoo-user-interface-yui-2-8-learning-library/book)Satyam (a.k.a Daniel Barreiro) is a long-time YUI contributor and one of the most prolific, generous experts in the [YUI forums](http://yuilibrary.com/forum/ "YUI Library :: Forums :: Index page"). He is also [the author of a new book on YUI 2.8.0, _YUI 2.8.0: Learning the Library_](https://www.packtpub.com/yahoo-user-interface-yui-2-8-learning-library/book). This article in the "Ask Satyam" series [was suggested by Alberto Santini](/yuiblog/2010/07/29/ask-satyam/#comment-593036 "Ask Satyam — and Be Eligible for a Free Copy of the New YUI 2.8 Book from Packt » Yahoo! User Interface Blog (YUIBlog)") and [Bryan Kane](/yuiblog/2010/07/29/ask-satyam/#comment-593069). Satyam will be answering several additional questions in the coming weeks here on YUIBlog as part of the series.

It's a common problem in information architecture: You have tabular data, and you have the need to display additional information about the entity represented by each table row. Usually, this is accomplished by "expanding" the row on click or selection and showing the data directly below the chosen row. Sometimes this additional data comes in the way of a further DataTable which might also have its rows expandable into more nested levels. We call the basic use case of drilling down into a single row _row expansion_; when the use case involves further tabular data associated with each row, the feature is described as a _nested DataTable._

So far there have been several serious attempts to support these features with the [YUI 2 DataTable](http://developer.yahoo.com/yui/datatable/ "YUI 2: DataTable"). DataTable's own list of examples includes a [Row Expansion](http://developer.yahoo.com/yui/examples/datatable/dt_rowexp_basic.html) example by Eric Gelinas. John Lindal presented his [Treeble](http://jafl.github.com/yui2/treeble/) in a [YUI Blog article](/yuiblog/2010/04/14/treeble-using-nested-yui-2-datasources-for-row-expansion/) some time ago with a [version for YUI 3](http://yuilibrary.com/gallery/show/treeble) in the Gallery. I also tried with my [NestedDataTable](http://www.satyam.com.ar/yui/#NestedDataTables) project.

None of these solutions is completely satisfactory and the question tends to recur; in fact, two people asked for it as part of the [Ask Satyam](/yuiblog/2010/07/29/ask-satyam/) series. In this article, I'll dive in again and explore strategies and options for dealing with row expansion and nested DataTables.

### A few issues to consider

DataTable makes a couple of very basic assumptions. One is that the ordinal position of a Record corresponds to the same ordinal position of a row within the `<tbody>` of the markup. I count 17 occurrences of property `sectionRowIndex` which returns the ordinal number of a `<tr>` element within its section (that is, within the `<tbody>`, `<thead>` or `<tfoot>` where it is contained). There are also many occurrences where the ordinal position of the Record is used as an index into the array of rows. For example, in the [Row Expansion](http://developer.yahoo.com/yui/examples/datatable/dt_rowexp_basic_clean.html) example, let it run to the end, expand any row about half-way to the table and then execute the following two statements in the debugging console:

```
YAHOO.example.Basic.oDT.getTrEl(YAHOO.example.Basic.oDT.getRecord(17)).id 
YAHOO.example.Basic.oDT.getNextTrEl(YAHOO.example.Basic.oDT.getRecord(17)).id 
```

Both will show `yui-rec17` as the answer, which is not correct since the second statement should return the id of the next row. If you do the same with no rows expanded or using a low number, before the expanded row, the second statement will correctly return `yui-rec18`.

Obviously, all examples listed work in their basic form; the "bug" demonstrated above amounts to a trick. If your application stays within safe boundaries, you are fine. However, a feature added to your application at a later time, one that makes deeper assumptions about how the DataTable's internals are operating, may lead to some problems. (For what it's worth, DataTable is very robust. Its built-in functionality is pretty safe, it sorts columns, edits cells, selects and highlights fine, as far as I tested it. I wasn't able to break its most popular built-in features.)

Nesting structures within the DataTable also invites some other complications: Clicking somewhere in an expanded custom row might be troublesome, since the click on the nested element would bubble up to the containing DataTable where it can mess things up. You must remember this point when listening to events such as `cellClickEvent` on the parent table since the target cell reported might not belong to the parent table but to a nested one — so fetching the Record or Column for that cell may fail.

Finally, there are some conceptual issues. What does `getNextTrEl` mean? Does it include only DataTable's own rows (let's call them _data rows_), or should it include custom rows added later, as it does now? I would say it should only include data rows since the custom rows, being nested, are not siblings to the data rows but children and, though the HTML markup forces us to use plain `<TR>` elements, conceptually, they are not siblings. Then, if you somehow reach a `<TR>` element and ask for its corresponding Record in the containing DataTable using method `getRecord()`, if that `<TR>` is a custom row, what would be its corresponding Record: `null` (since it doesn't belong to the containing DataTable but to the nested one) or the Record of the data row it is a child of?

How do you want the stripes on the rows? Currently, the striping logic takes even and odd rows indiscriminately, whether data rows or custom rows but perhaps you would like the custom rows to carry on the same background color as the data row to which they belong.

These are some of the aspects of row-expansion functionality that require definition; any decision on them, as long as it is consistent and predictable, would likely accommodate most use cases.

### Nesting without DataTable

[![](/yuiblog/blog-archive/assets/treebleexample-20100817-095427.jpg)](http://jafl.github.com/yui3-gallery/treeble/)Of course, we might live with these restrictions, but then what is the point of bothering with the DataTable at all? If all you want is to display some nested information in a tabular form, you could simply use a regular `<table>` element or something like it. In fact, [the YUI 3 version of Treeble](http://yuilibrary.com/gallery/show/treeble "YUI Library :: Gallery :: Treeble") ([example](http://jafl.github.com/yui3-gallery/treeble/ "YUI 3 Treeble Example")) does exactly that; since there is not yet a YUI 3 version of DataTable to be used, it uses none at all. You might as well do the very same thing with YUI 2, like in [this example](http://satyam.com.ar/yui/2.8.0/RowExpansionPlainHTML.html), where no DataTable nor HTML `<table>` was used at all. Admittedly, the example is very simple and visually ugly (I've never claimed to be artistic); but, if that is all you care for, at least you know it won't fail you. Just an idea you might want to evaluate when you decide on what to do.

### Row Expansion with DataTable

[![](/yuiblog/blog-archive/assets/rowexpansion-20100817-100641.jpg)](http://developer.yahoo.com/yui/examples/datatable/dt_rowexp_basic.html)Finally, you might really want to use a DataTable. If so, how do we go about that? Both Treeble and my own [NestedDataTable](http://satyam.com.ar/yui/2.8.0/nested1.html) nest two DataTables. Eric Gelinas, in contrast, has used another approach, which I find more flexible. He does not make any assumptions on what is going to be in the expansion. It uses a `rowExpansionTemplate` configuration attribute that can take either a string template or a reference to a function. The string template is processed via `[YAHOO.lang.substitute](http://developer.yahoo.com/yui/docs/YAHOO.lang.html#method_substitute "API: yahoo  YAHOO.lang   (YUI Library)")` along with the data from the Record object for the row about to be expanded. We already know that we don't need to define in the column definitions array all the fields we have read with the DataSource; we can keep extra DataSource fields in reserve for later use. The template mechanism lets us display in the expansion row those other fields for which we didn't have space in the regular row. The [example](http://developer.yahoo.com/yui/examples/datatable/dt_rowexp_basic.html) lists picture names from Flickr, images which might be too big to show in the main DataTable. The fields to assemble the URL pointing to those pictures are loaded from the start. Upon row expansion, those bits are put together to built an `<img>` tag and the thumbnail for the picture is shown in the expansion row.

Now, if we set `rowExpansionTemplate` to a function reference, then we get all the flexibility we might possibly want. I used that idea in [this example](http://satyam.com.ar/yui/2.8.0/nestedRowExpansion.html), but with a somewhat different [rowexpansion.js](http://www.satyam.com.ar/yui/2.8.0/rowexpansion.js) file. The original was more focused on using the string template and it assumed that the expansion row could be destroyed and rebuilt at any time at no cost. That is not the case when the expansion is something more complex, such as a DataTable with further DataTables nested within. Every time a column is sorted, DataTable will delete all rows and start anew, which would be tremendously expensive with complex content if it was to be deleted and reconstructed as well. Instead, what I do is to keep a reference to the expansion row in the expansion state object (see description in method `[getExpansionState](http://www.satyam.com.ar/yui/2.8.0/rowExpansionDocs/YAHOO.widget.RowExpansionDataTable.html#method_getExpansionState)`), which is stored in the Record of the parent table. This data is not deleted, and as a result it's much more efficient to restore that same row whenever the parent row is re-rendered.

[![](/yuiblog/blog-archive/assets/nesteddatatables-20100817-101227.jpg)](http://satyam.com.ar/yui/2.8.0/nestedRowExpansion.html "Nested DataTables using RowExpansionDataTable")

Sometimes, however, the parent rows will be deleted on purpose or the parent DataTable reloaded from the server with, possibly, different data which requires the children to be refreshed. I need to explicitly delete the child rows in such cases because otherwise they would remain in memory as zombies. Thus, I override several methods (`deleteRow`, `deleteRows`, `initializeTable`, `destroy`) and delete the nested content before its parent Record is deleted. Deleting, however, is not enough, since the content might need some more elaborate means of disposal. As with many complex components, DataTable has a `destroy` method which needs to be called to fully clear the instance and its associated events. I added the `rowExpansionDestroyEvent` event to signal that the nested row is about to be destroyed, thus allowing the developer to handle the content as required. For example:

```
albumDT.on('rowExpansionDestroyEvent', function (state) {
    state[NESTED_DT].destroy();
});
```

All events receive the `state` object as their single argument. Here, I use the reference to the nested DataTable which I stored under a property name of my own (`NESTED_DT`) and call its `destroy` method.

RowExpansionDataTable adds the column that triggers row expansion automatically and also listens to clicks on that column. You don't need to do anything for that column to show up and be active. It always adds it on the left hand side by using this simple code in the constructor:

```
var REDT = function(elContainer,aColumnDefs,oDataSource,oConfigs) {

     aColumnDefs.unshift({
          key:ROW_EXPANSION,
          label:'',
          className:CLASS_TRIGGER
     });
     REDT.superclass.constructor.call(this, elContainer,aColumnDefs,oDataSource,oConfigs); 
};

YAHOO.widget.RowExpansionDataTable = REDT;
```

RowExpansionDataTable also sets a listener for `cellClickEvent` and checks if the column clicked is the one with its key set to the value stored in constant `ROW_EXPANSION`; there is no need for us to respond to that event, although we may want to set up further listeners for our own purposes on other columns.

Though the basis of my [rowexpansion.js](http://www.satyam.com.ar/yui/2.8.0/rowexpansion.js) file is Eric Gelinas's work, there are also many differences. I changed many of the variable, method and property names to conform to the standard naming conventions and fixed plenty of errors flagged by [JSLint](http://www.jslint.com/). In its basics, however, the code is still Eric's.

The [example](http://satyam.com.ar/yui/2.8.0/nestedRowExpansion.html) is well commented and described after the sample table; the [rowexpansion.js](http://www.satyam.com.ar/yui/2.8.0/rowexpansion.js) file is easy to follow and its [API Docs](http://satyam.com.ar/yui/2.8.0/rowExpansionDocs/YAHOO.widget.RowExpansionDataTable.html) are also available.

### Overlaying children

Another alternative to adding rows is to make the expansion float above the parent row. I have used this in my own [NestedDataTable example](http://satyam.com.ar/yui/2.8.0/nested1.html). This example also uses YQL tables via YQLDataSource and, as I mentioned in the [previous article](/yuiblog/2010/08/09/ask-satyam-yql-and-yui/), the YQL Artists search table is somewhat clumsy to use along with [YUI 2 AutoComplete](http://developer.yahoo.com/yui/autocomplete/ "YUI 2: AutoComplete") as it won't bring back partial matches with artist names.

[![](/yuiblog/blog-archive/assets/nesteddatatables-20100817-104246.jpg)](http://satyam.com.ar/yui/2.8.0/nested1.html "Nested DataTables")

Here, when you expand a row, a container `<div>` is created and appended to the document body. The container uses absolute positioning and is moved to overlap the row right below the one being expanded. The container thus covers the rows next to the one being expanded so, the height of this row is increased to make space for the overlapping container.

This mechanism spares us from the two issues I mentioned before: no row is added to the DataTable, the ordinal positions of Records and Rows match at all times and events can't bubble from the containers to the DataTable since they are not descendants of the DataTable. However, maintaining the position of the containers requires paying attention to several events and recalculating their position. Sorting the main table with several children open will move all the containers to their new positions with ease, and so will resizing the browser window.

This [example](http://satyam.com.ar/yui/2.8.0/nested1.html) uses just two levels of nesting while the RowExpansionDataTable example could be expanded to any limit. I have tried to combine the two and I see no theoretical reason why it would not succeed; however, in trying to do so I found the example got so complex that it was hard to describe in a blog article of any reasonable size. The example, as it is, has complete control over the parent and child tables, knows when they expand or contract, move, get redrawn or change in any other way, and can easily access any of them and adjust their layout. In trying to extend this to any number of levels, I found that communicating all those changes up and down the hierarchy of nested components, not all of them necessarily DataTables, was hard, with changes deep in one branch possibly affecting nested components on other branches.

The complexity lies not so much in communicating those changes up and down and acting on them as in trying to provide standard interfaces for generic child elements to participate. If you have full control over the several containers and their content, it should be manageable; however, it would only make sense to do so if the RowExpansionDataTable fails in some particular application, as I admit it may, and cannot be fixed easily.

### Conclusion

You don't always need real DataTables to have tables nested inside each other, but if you do, my RowExpansionDataTable is a good choice, besides being a good example on how to extend DataTable. It has some issues, which I described so that if you bump into them, you know where to look as you work around them. DataTable itself is amazingly robust and handles itself quite nicely. Overlapping content in the DataTable is also a possible solution, if signaling the changes in size and position of the children can be solved efficiently, though it is hard to do in a generic component — and I didn't try to do so here. Neither did I try a version inheriting from ScrollingDataTable; it is not that I forgot, but rather that I know it is not a trivial undertaking.