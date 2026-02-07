---
layout: layouts/post.njk
title: "Draggable DataTable Rows"
author: "Unknown"
date: 2009-05-08
slug: "draggable-datatable-rows"
permalink: /2009/05/08/draggable-datatable-rows/
categories:
  - "Development"
---
### Introduction

A recent project of mine required an implementation of DataTable where rows could be moved around with Drag and Drop functionality. After looking through the [YUI gallery of examples](http://developer.yahoo.com/yui/examples/), I realized that the feature I was trying to implement was a little bit different from the ones I saw. So I decided to implement my own solution. In this article I'll explain how I combined YUI's [DataTable](http://developer.yahoo.com/yui/datatable/) and [Drag and Drop](http://developer.yahoo.com/yui/dragdrop/) components, some workarounds for the challenges I encountered, and how I was able to improve upon my initial solution by using [the new YUI3 codeline](http://developer.yahoo.com/yui/3/) (which is currently available in preview mode).![Screenshot of draggable DataTable rows.](/yuiblog/blog-archive/assets/draggable-datatable-rows/screenshot.png)

### Initial considerations and some possible solutions

The first question that came to my mind was how to make each table row draggable and a drop target at the same time in the most efficient way. I also knew that instantiating a Drag and DDTarget object at the same time on an element wasn't going to work. After reading through the [Drag and Drop API documentation](http://developer.yahoo.com/yui/docs/module_dragdrop.html) I found out that the property [`isTarget`](http://developer.yahoo.com/yui/docs/YAHOO.util.DragDrop.html#property_isTarget) gets set by default to `true` for every Drag object we create, making that object a drop target as well. So with that, I defined a custom `DDRows` class to set up the interesting moment handlers and also add some CSS style for the drag proxy object to visually differentiate it from the regular rows. A proxy drag object is just a container that gets displayed once the dragging starts and it serves as a marker/guide for what is being dragged.

```
YAHOO.example.DDRows = function(id, sGroup, config) {
    YAHOO.example.DDRows.superclass.constructor.call(this, id, sGroup, config);
    Dom.addClass(this.getDragEl(),"type-proxydrag");
};

YAHOO.extend(YAHOO.example.DDRows, YAHOO.util.DDProxy, {
	// Handlers defined here
});

```

After defining the DDRows class, I listen for the DataTable's `initEvent` to set up each row as a DDRows Drag object:

```
myDataTable.subscribe("initEvent", function() {
    var i, id,
    allRows = this.getTbodyEl().rows;

    for(i=0; i<allRows.length; i++) {
        id = allRows[i].id;

        // Clean up any existing Drag instances
        if (myDTDrags[id]) {
            myDTDrags[id].unreg();
            delete myDTDrags[id];
        }

        // Create a Drag instance for each row
        myDTDrags[id] = new YAHOO.example.DDRows(id);
    }
});

```

Then instead of using the DDTarget class, I look for the `isTarget` property of the Drag object to validate the target element. This way we make sure we only move table rows onto other table rows:

```
onDragDrop: function(e, id) {
    var destDD = YAHOO.util.DragDropMgr.getDDById(id);
    // Only if dropping on a valid target
    if(destDD && destDD.isTarget && this.srcEl) {
            ...
    }
}

```

An important consideration is that the DOM is repainted each time we move a row, so not only does the Drag object on the original row need to be cleaned up when it is deleted, a new Drag object needs to be created for the row that is created in the new position. Here is the entire `onDragDrop` function that cleans up and moves a row:

```
onDragDrop: function(e, id) {
    var destDD = YAHOO.util.DragDropMgr.getDDById(id);
    // Only if dropping on a valid target
    if(destDD && destDD.isTarget && this.srcEl) {
        var	srcEl = this.srcEl,
            srcIndex = srcEl.sectionRowIndex,
        	destEl = Dom.get(id),
        	destIndex = destEl.sectionRowIndex,
            srcData = myDataTable.getRecord(srcEl).getData();

        this.srcEl = null;

        // Cleanup existing Drag instance
        myDTDrags[srcEl.id].unreg();
        delete myDTDrags[srcEl.id];

        // Move the row to its new position
    	myDataTable.deleteRow(srcIndex);
        myDataTable.addRow(srcData, destIndex);
    	YAHOO.util.DragDropMgr.refreshCache();
    }
    }
}

```

Here is the [full working example using YUI 2.7.0](/yuiblog/blog-archive/assets/draggable-datatable-rows/example-yui2.html).

### Enhancing our example by using YUI 3.0 PR2

On the Yahoo! homepage, we have been using YUI 3 to develop [our next-generation experience](/yuiblog/2008/11/11/frontpage-and-yui3/), and the more I use it, the more I realize how powerful and extensible it is. So I decided to go ahead and check out the [Drag and Drop](http://developer.yahoo.com/yui/3/dd/) component from the latest [YUI 3.0 preview release](http://developer.yahoo.com/yui/3/) for this exercise.

It was no surprise when I discovered that with this new version I could take advantage of some of the new properties and methods to make my solution more clean and efficient. For instance, Drag and Drop in YUI 3 provides an efficient way to create the Drag/Target objects we need:

```
myDTDrags[id] =  new Y.DD.Drag({
    node: "#"+id,
    constrain2node: "#datatable",
    moveOnEnd: false,
    proxy: true,
    target: true
});

```

We no longer have to define our own subclass or worry about validating the element before swapping rows, as the `drophit` event will only be triggered when applied to elements we've defined as drop targets.

The other great new feature version 3 brings us is custom-event bubbling (which brings the power of DOM-event bubbling to the custom events that drive the library's API). Thanks to this, we can now to listen for all the Drag and Drop events at the document level using the Drag and Drop Manager, rather than having to attach several events to each individual table row. Our custom-event delegation code looks like this:

```
Y.DD.DDM.on('drag:start',startDrag);
Y.DD.DDM.on('drag:end',endDrag);
Y.DD.DDM.on('drag:drophit',dragDrop);

```

Here is the [full working example using YUI 3.0 PR2](/yuiblog/blog-archive/assets/draggable-datatable-rows/example-yui3.html).

### Conclusion

I hope you find these examples a useful resource on how to add Drag and Drop functionality to DataTables and on how you easily you can integrate YUI 2.7.0 and YUI 3 components in the same page. It also serves as a quick preview on all the new and exciting features that are coming with the next generation of YUI.