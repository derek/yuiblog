---
layout: layouts/post.njk
title: "Dissecting 3.5.0 DataTable, Part 1"
author: "Unknown"
date: 2012-05-01
slug: "dissecting-3-5-0-datatable-part-1"
permalink: /2012/05/01/dissecting-3-5-0-datatable-part-1/
categories:
  - "Development"
---
DataTable has been one of YUI's most heavily used and relied upon widgets for years. In 3.5.0, DataTable got a major overhaul, resulting in some small changes to the API and some big changes to the infrastructure.

In this two part article, we'll talk about these changes, what led up to the decision to revisit the infrastructure rather than focus on features, break down some of the new and experimental concepts being explored, and finish up with a look at the plan for the future of DataTable as we see it today.

So without further ado, let's address the obvious question:

## Why Refactor?

The short answer is "to make DataTable easier to use and customize". The 3.4.1 infrastructure was based on a "core" Widget model, with all additional features left to plugins or subclasses. The data was held in a `Y.Recordset` instance and the column configuration in a `Y.Columnset` instance. The Widget was responsible for creating the entire table markup. That seemed like a reasonable architecture, but there were a few issues with this:

1.  DataTables are defined by their features, which means there could be a lot of `plug()`ing to get the DataTable that fits your application. This made working with DataTable too complicated and verbose.
2.  The contract of the Plugin API hindered DataTable's multiple features from interacting properly. In fact, certain DataTable features in 3.4.1 had already started breaking this contract.
3.  DataTable was hard coded to use `Y.Record`, `Y.Recordset`, `Y.Column`, and `Y.Columnset`. This coupling limited the ability to customize DataTable or integrate it with other components in your application.
4.  The rendering algorithm was flexible, but its hooks for customization were fixed. There was an opportunity to make rendering more customizable (and a whole lot faster) without requiring implementers to do major surgery on their instances.

The new architecture aims to address these and other issues uncovered during its production life prior to 3.5.0, and take advantage of the [App Framework](http://yuilibrary.com/yui/docs/app/) components that weren't around when DataTable was initially created in 3.3.0.

DataTable is incredibly important to a lot of people, and it's important to us that it not only be built right, but also that it be _as easy to use as possible_. These changes aim to move DataTable in the right direction.

## Big Changes

The major changes from 3.4.1 to 3.5.0 are mostly under the hood, and with any luck, [migrating to 3.5.0 DataTable](http://yuilibrary.com/yui/docs/datatable/migration.html) should be painless.

Most of the outward changes to the API make it much easier to add and use DataTable features. Compare a 3.4.1 sortable DataTable to its 3.5.0 equivalent:

### What's in a Name?

The first thing you'll notice is that as of 3.5.0, you create instances of `Y.DataTable` rather than `Y.DataTable.Base`. The base class is still around, but now its primary role is as a superclass for extension (which we'll talk more about in the next article).

`Y.DataTable` is now the main class _and_ the namespace for classes that support DataTable, such as `Y.DataTable.Base`, `Y.DataTable.Sortable`, and `Y.DataTable.BodyView`. The notable exception is `Y.Plugin.DataTableDataSource`, which hasn't yet been migrated over to the new world order (expect that in 3.6.0).

You'll see more about this in the next article when we talk about some of DataTable's new concepts.

### Features as Class Extensions

The 3.5.0 architecture marks a shift _away_ from the plugin model for DataTable. Instead, we're putting features in class extensions, and using the powerful [`Y.Base.mix()`](http://yuilibrary.com/yui/docs/api/classes/Base.html#method_mix) method to augment these features into the DataTable class, creating a sort of ad-hoc multiple inheritance model.

The two primary benefits this approach has are:

1.  The API for your DataTable and all its features is in one place, your `Y.DataTable` instance.
2.  Rather than having to explicitly build up your DataTable from the Base, simply including the feature modules in your `use()` line adds support for those features to the `Y.DataTable` class.

But what if you have a couple of DataTables on the page, and you don't want all of them sortable or scrollable, etc.?

To keep features from leaking between DataTable instances, each feature includes a behavioral trigger, which is responsible for activating the feature for that particular instance. A feature might look for assigned table attributes, such as "scrollable", or column configurations such as "width". It might even have multiple triggers, such as `datatable-sort` looking for either the "sortable" table attribute or "sortable" column configuration property.

### No More Coupling

As of 3.5.0, `Y.Columnset` and `Y.Column` are gone, and you're not limited to data storage in `Y.Record` and `Y.Recordset`.

Column definitions are now stored as a simple array of objects, just like what you pass into the DataTable's `columns` attribute.

The reason for this change is that many features are column-specific, making the column definitions a natural place to configure them. But the Column class shouldn't include feature related attributes unless that feature is requested. However, features implemented as plugins should not directly modify classes. So how can a column definition include `sortable: true` if the Column class doesn't have a `sortable` attribute and the plugin can't add it? There wasn't a good answer, so we (regrettably) added the feature attributes to the base Column class, allowing them to do nothing unless the plugin was added. With so many pending DataTable features wanting to be configured in the column definitions, we decided to remove the Column class wrappers in 3.5.0 to allow columns to be defined with whatever properties were needed. The jury is still out on this change, so we're interested in your feedback.

On the data side of things, Recordset and Record were technically working fine, but with the advent of `Y.Model` and `Y.ModelList` in 3.4.0, there was now a huge opportunity to share classes that were likely to be used elsewhere in the application. This meant, however, that DataTable would need to be decoupled from its data storage classes because the common use case for the App Framework components is to create subclasses of them with attributes and APIs that specifically encapsulate your business logic.

So in 3.5.0, rather than being bound to `Y.Record`, data records are stored in Model subclass instances. By default, DataTable will create a Model subclass for you, customized to your data, but you now have the option to specify the class to use by setting the DataTable's `recordType` attribute. Similarly, you can provide your table's `data` in a ModelList or ModelList-like object.

Now if you share your ModelList or Models across various parts of your application, modifications to any of them will automatically update the table.

### Customizable Rendering

In 3.5.0, the rendering algorithm was completely rewritten, and is now significantly faster and more configurable than its 3.4.1 counterpart. The [migration guide](http://yuilibrary.com/yui/docs/datatable/migration.html) and [user guide](http://yuilibrary.com/yui/docs/datatable/index.html) go into detail about the various cell formatting options, but one important change worth talking about here is that the entire algorithm can be replaced with a simple configuration change.

In keeping with the move to configurable data storage classes, DataTable now delegates its rendering algorithms to [`Y.View`](http://yuilibrary.com/yui/docs/view/) classes. In 3.5.0, the basic, featureless DataTable has attributes `headerView`, `bodyView`, and `footerView`. By default, `footerView` is unset, but `headerView` is set to `Y.DataTable.HeaderView`, and `bodyView` is set to `Y.DataTable.BodyView`.

When a DataTable instance is `render()`ed, the only DOM content the Widget itself is responsible for is the `<table>` and its immediate children. The rendering of the header content, footer content, and data rows is left to whatever View class is supplied to the respective attribute.

The default Views provided in 3.5.0 include enough [column configuration options](http://yuilibrary.com/yui/docs/datatable/#column-config) to handle most use cases, but if you have special requirements for your table rendering or you want to hyper-optimize your specific implementation, you can supply your own View classes to the attributes noted above, and DataTable will use them instead.

### More to Come

The next article will go into more detail about DataTable's architectural techniques, experimental patterns, and what's coming in the next release.

In the mean time, be sure to let us know in the [yuilibrary.com forum](http://yuilibrary.com/forum), on [Twitter](http://twitter.com/yuilibrary), and in the #yui IRC channel on freenode, how things are going in your DataTable apps and what features you're most looking forward to.