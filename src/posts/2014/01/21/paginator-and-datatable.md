---
layout: layouts/post.njk
title: "Paginator and DataTable"
author: "Anthony Pipkin"
date: 2014-01-21
slug: "paginator-and-datatable"
permalink: /blog/2014/01/21/paginator-and-datatable/
categories:
  - "Development"
---
When I first started on DataTable Paginator, the idea for a standalone paginator component came up. This component needed to be small, light weight and versatile. With this in mind, I put my head down and came up with a few different concepts.

### Paginator Widget

The first build of [Paginator](http://yuilibrary.com/yui/docs/paginator/) was a [Widget](http://yuilibrary.com/yui/docs/widget/) with paging capabilities. This widget was self contained and rendered a predefined UI with "First", "Previous", "Next" and "Last" buttons with a series of numbers in the middle. It was a "standard" paginator control, but then some other feedback started coming in asking about how to disable buttons and about handling really large sets of data. It became obvious very quickly having a single module to house such a tool was not hitting the versatile marker I set to achieve. It was apparent I needed a new approach.

### Paginator Model View

The next logical step was to abstract the logic from the view. To achieve the separation, I used [Model](http://yuilibrary.com/yui/docs/model/) and [View](http://yuilibrary.com/yui/docs/view/). I also took it a step further to move the URL logic to it's own file. This meant that you could have pagination in your application without having to fight or work around URLs in your controls, but you could easily get them if you wanted them. This decision was easy, the challenge of the layout still remained. I invoked the help of [Template](http://yuilibrary.com/yui/docs/template/) to create a few templates out of the box.

The templates became more and more bloated with each customization option you added to them. And since [Paginator](http://yuilibrary.com/yui/docs/paginator/) required a lot of customization, this started breaking the small and lightweight goal I had established. I thought about scrapping some of the template customization and let the implementers add that on if they wanted it, but I felt that could be very limiting in the end. Again, I needed another solution.

### Paginator Mixable

The obvious solution to the size issue was to drop the view logic altogether. I needed to make a change to the files we were keeping. I didn't need the core and URL modules to extend [Model](http://yuilibrary.com/yui/docs/model/) any longer, so that was out. This left me with two files that could be mixed into anything, but nothing that could be instantiated when you wanted it out of the box. This meant we needed to create one more file for Paginator, one that mixed into [Base](http://yuilibrary.com/yui/docs/base/) so it could be instantiated and get change events. Removing the view logic wasn't without some resistance but it quickly proved it's worth when creating the user guides.

## DataTable Paginator

I was finally at a satisfactory place with [Paginator](http://yuilibrary.com/yui/docs/paginator/), and it was finally time to get started on the DataTable specific Paginator. This Paginator implementation needed a specific UI and needed to mix into the [DataTable](http://yuilibrary.com/yui/docs/datatable/) nicely. This meant it needed to provide a customizable View, Model, Template and a Controller to mix into DataTable without sacrificing any of the customizations.

### Model

To start, I created a Paginator Model. This was the easiest part. You just need to mix `paginator-core` into a Model. `Y.Base.create('dt-pg-model', Y.Model, [Y.Paginator.Core]);`

### Templates

The Paginator needed a few templates to make the customization of the the UI a bit easier on the developer if they wanted to change it. There are a few different templates that come pre assembled.

-   _rowWrapper_ - Creates a TR around the Paginator for use in a table node
-   _button_ - Creates a button with the given type and label
-   _buttons_ - Creates a group of buttons and each button is created from the array of buttons passed in
-   _gotoPage_ - The form containing the input UI for the end user to type in the page they wish to view
-   _perPage_ - A select node containing different options to view a different set of items per page

Each of these are able to be changed by the developer in `Y.DataTable.Templates.Paginator`.

### View

The View uses various options to put the UI together. One very important piece is the `contentTemplate`. This dictates the content and the order of the UI components. Originally it's defined as `'{buttons}{goto}{perPage}'` and will be replaced with the UI components in that order. You can change the order, add and remove options — although in doing such, you may need to adjust other parts and the CSS, but it is an option!

### Controller

The controller is where the Model and View are tied together and the part of the puzzle that get's mixed into the [DataTable](http://yuilibrary.com/yui/docs/datatable/). There are lots of thing to talk about in this one, but I'll just touch on a few of them.

The first is providing your own Paginator Model and View to the DataTable. When you instantiate the DataTable, you can pass through a new `paginatorModel` and/or `paginatorView` to the configuration. These are defined as the files shipped with DataTable Paginator by default. Feel free to mix and match as you wish.

You can also specify locations for the paginator to reside in the application. By default it's set to render the paginator in the footer. You can render it into the header, just before the header cells. You can also render it into any node on the page and still get the same benefit with interaction.

There are also a few public methods to note: [`firstPage`](http://yuilibrary.com/yui/docs/api/classes/DataTable.Paginator.html#method_firstPage), [`prevPage`](http://yuilibrary.com/yui/docs/api/classes/DataTable.Paginator.html#method_previousPage), [`nextPage`](http://yuilibrary.com/yui/docs/api/classes/DataTable.Paginator.html#method_nextPage), [`lastPage`](http://yuilibrary.com/yui/docs/api/classes/DataTable.Paginator.html#method_lastPage). These will pass through to the paginator model and set the page number as expected. For other interaction with the paginator model, you need only call it from the DataTable set such as `myDt.get('paginatorModel').set('page', 4);`

## Moving Forward

There are lots of other neat things coming to [DataTable](http://yuilibrary.com/yui/docs/datatable/) in the near future and I am very excited to be a part of this project. If you have any feedback on the component as it stands now, feel free to let me know by posting comments to our [Trello Board](https://trello.com/b/fTpWY4oN/datatable-roadmap) or a message to the [Google Groups](https://groups.google.com/forum/#!categories/yui-support/datatable) set aside for DataTable. If you have a feature request or want to contribute a pull request to get something fixed or added, be sure to head over to the project page on [GitHub](https://github.com/yui/yui3/) and make the request.