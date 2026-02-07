---
layout: layouts/post.njk
title: "Displaying Controls in a DataTable: An Overview"
author: "Unknown"
date: 2012-05-07
slug: "displaying-controls-in-a-datatable-an-overview"
permalink: /2012/05/07/displaying-controls-in-a-datatable-an-overview/
categories:
  - "Development"
---
Recently, there was a question in the forums about using input fields in a DataTable. With the ongoing push to build ever more complex applications in the browser, I decided that an overview of the available options for editing tabular data might be useful.

The most straightforward way to edit data would be to use inline editing, but this is not yet available in YUI 3 DataTable. In the mean time, one option is to roll your own input fields directly in the table cells, similar to [this example](http://www.satyam.com.ar/yui/2.6.0/assortedControls.html).

If you do not want to save each change when it happens, you could use the [QuickEdit](/yuiblog/2011/04/19/quickedit-datatable-yui3/) gallery module instead. This lets you edit all the visible cells and then save the changes in a single operation.

The above solutions are modal. If you prefer a non-modal way to edit all the cells, you could use the [Bulk Editor](/yuiblog/2011/12/05/bulk-edi/) widget. This works with pagination, so you can save all the changes across all the pages of your table in a single operation. It even lets you easily add and remove rows -- and even when you are using a remote DataSource!

Bulk Editor is not built on top of YUI DataTable, however. If you need other features from YUI DataTable, you could use the [state preservation plugin](http://yuilibrary.com/gallery/show/datatable-state) for YUI 3 DataTable. This also works with pagination, so you can save all the values on all the pages in a single operation, but it is not designed to let you easily add or remove rows.

The [state preservation plugin](http://yuilibrary.com/gallery/show/datatable-state) is also useful if you want to do something simpler like displaying checkboxes for selecting rows in a table.

The reason for all these different solutions is that the engineering trade-offs are quite complex, so it is not advisable to build a single kitchen sink solution to support all the above features. Hopefully, this overview will help you choose the appropriate module for tackling your next big table-based application.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._