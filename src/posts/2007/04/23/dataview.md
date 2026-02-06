---
layout: layouts/post.njk
title: "YUI Tutorial: Subclassing DataTable to Create DataView"
author: "Victor Morales"
date: 2007-04-23
slug: "dataview"
permalink: /blog/2007/04/23/dataview/
categories:
  - "Development"
---
In this tutorial we will build a subclass for DataTable called DataView. This subclass will allow the DataTable to hide a particular column by right clicking in the table header rows and selecting a column from a `[ContextMenu](http://developer.yahoo.com/yui/menu/#contextmenu)` — one of the major types of menus supported by the YUI Menu Control.

The first step to subclassing DataTable is writing the constructor for the new subclass (DataView, in this case) and specifying its inheritance from the DataTable class using `[YAHOO.extend](http://developer.yahoo.com/yui/yahoo/#extend)`:

```
 //create namespace:
 YAHOO.namespace("yuiblog.widget");

  YAHOO.yuiblog.widget.DataView = function(elContainer , oColumnSet , oDataSource , oConfigs) {
         if (arguments.length > 0) {
                YAHOO.yuiblog.widget.DataView.superclass.constructor.call(this, elContainer , oColumnSet , oDataSource , oConfigs);
           }
           //Call ContextMenu initialization method
           this._initHideMenu();
 };
 // Inherit from YAHOO.widget.DataTable
 YAHOO.lang.extend(YAHOO.yuiblog.widget.DataView, YAHOO.widget.DataTable);
 
```

The DataView constructor adds a hookup to the `_initHideMenu` method, which initializes the `ContextMenu`. This method has the following responsibilites:

1.  Initialize and create a `ContextMenu` instance.
2.  Determine if a column can be hidden, and if so add it as an item in the `ContextMenu`.
3.  Subscribe each `MenuItem` to the `onhideMenuClick` event handler.

```
 YAHOO.yuiblog.widget.DataView.prototype._initHideMenu=function(oColumnSet) {

         var oColumnSet= this._oColumnSet
         this.aColState=[];
         var _hideCol=[]
         var keys= oColumnSet.keys;
         for (var i=0; i<keys.length;i++) {
             if(keys[i].hideable) {
                     itemText = keys[i].text || keys[i].key;
                 _hideCol.push({text:itemText,checked:true, colNum:i})
              }
             this.aColState[i]=0; 
         }
         if (_hideCol.length>0)    {
           var oContextMenu = new YAHOO.widget.ContextMenu("hideMenu", { trigger: this.getHead()     } );

           // Define the items for the menu
           var aMenuItemData =_hideCol 
           var nMenuItems = aMenuItemData.length;
           var oMenuItem;
           for(var i=0; i<nMenuItems; i++) {
              var item= aMenuItemData[i]
              oMenuItem = oContextMenu.addItem(item);
              oMenuItem.clickEvent.subscribe(this.onhideMenuClick, [oMenuItem,item.colNum],this);
           }
           oContextMenu.render(document.body);
         }

 }; 
```

Notice how `_initHideMenu` iterates over the `ColumnSet` keys array, which maps one-to-one to a table column. If a column has the hideable property set to `true`, an anonymous object is created with the column text and position and then "pushed" into an array that is used to populate the `ContextMenu`.

The next step is to define the `onHideMenuClick` method, which hides the appropriate column from the DataTable depending on the `MenuItem` that was clicked. To hide a column we simply call the `hideSwap` method which alters the `display` attribute of the column.

```
 YAHOO.yuiblog.widget.DataView.prototype.onhideMenuClick=function(p_sType, p_aArgs, p_oMenuItem) {
         var oMenuItem= p_oMenuItem[0];
         var col_no=p_oMenuItem[1];
         var swap= oMenuItem.cfg.getProperty("checked")
         oMenuItem.cfg.setProperty("checked", swap);
         var colstyle;
         if (!swap) {
             this.hideSwap(col_no,'none',0)
             this.aColState[col_no]=1      
         }
         else {
             this.hideSwap(col_no,'',0)
             this.aColState[col_no]=0
         }
 };
 YAHOO.widget.DataView.prototype.hideSwap=function(col_no,colstyle,startRow) {
       //Hide or unhide column header
        var headRow= this.getHead().getElementsByTagName('th')
        headRow[col_no].style.display=colstyle;

        var rows= this.getBody().getElementsByTagName('tr')

        // Hide or unhide column rows 
        for (var row=startRow; row<rows.length;row++) {
          var cels = rows[row].getElementsByTagName('td')
          cels[col_no].style.display=colstyle;
        }
};
 
```

With these changes in place, in our HTML page we only need to make sure to specify which columns will be "hideable".

```
        var myColumnHeaders = [
             {key:"POID", abbr:"Purchase order ID", sortable:true, resizeable:true },
             {key:"Date", type:"date", sortable:true, resizeable:true, hideable:true},
             {key:"Quantity", type:"number", sortable:true, resizeable:true,hideable:true},
             {key:"Amount", type:"currency", sortable:true, resizeable:true,hideable:true},
             {key:"Title", text:"Book Title", type:"string", sortable:true, resizeable:true,hideable:true}
         ]; 
```

[Click here for a functional example of the the project at this stage.](/yuiblog/sandbox/yui/v222/examples/datatable/hidingColumns.php)

## Adding Filtering to the DataView

Sometimes it is useful to view only a particular type of information and hide the rest. Filtering data from a table is a simple yet powerful pattern that allows users to find the information that they want in less time. Here we will leverage the [AutoComplete Control](http://developer.yahoo.com/yui/autocomplete/) and combine it with [DataTable](http://developer.yahoo.com/yui/datatable/).

We'll continue building upon the DataView class described above. Let's take a quick look at the methods and properties needed to implement row filtering in our DataView class:

| Name | Responsibility | Type |
| --- | --- | --- |
| `defaultView` | Store the original (unfiltered) table records | Array property |
| `isFiltered` | Keeps track of the state of the table | boolean property |
| `doBeforeLoadData` | Populates the `defaultView` array | method (overriden) |
| `filterRows` | Updates the content of the table | method |

  

The corresponding code is shown below:

```
 YAHOO.yuiblog.widget.DataView.prototype.isFiltered=false;

  YAHOO.yuiblog.widget.DataView.prototype.doBeforeLoadData= function( sRequest ,oResponse ) {
     if(oResponse) {
         this.defaultView=oResponse;
     }    
     return true;
 }

  YAHOO.yuiblog.widget.DataView.prototype.filterRows=function(filteredRows) {
     if(filteredRows == undefined) {
         this._oRecordSet.replace(this.defaultView);
         this.populateTable();
         this.isFiltered=false;
     }
     else {
         var dataView=[];
         for (var i=0; i<filteredRows.length;i++) {
              var r=filteredRows[i];
              var row= this._oRecordSet._records[r];
              dataView.push(row);
           }
           this.replaceRows(dataView);
           this._oRecordSet._records=dataView;
           this.isFiltered=true;
     }
 }; 
```

To initialize the `defaultView` property we take advantage of the `doBeforeLoadData` [method](http://developer.yahoo.com/yui/docs/DataTable.html#doBeforeLoadData) which is automatically called by the DataView constructor once data is available.

Slightly more interesting is the `filterRows` method. This method receives as a parameter an array containing the row numbers that will be displayed. If we don't specify an array then the DataView is reset to its default state and the `isFiltered` property is set to false.

That is really all we have to do for the DataView class. The next step is to create a subclass of AutoComplete, `RowFilter`, which will be responsible for "feeding" the `filterRows` method we just created:

```
 YAHOO.yuiblog.widget.RowFilter = function( elInput,elContainer,oDataTable,fnFilter,oConfigs) {
         if (arguments.length > 0) {
                YAHOO.yuiblog.widget.RowFilter.superclass.constructor.call(this, elInput,elContainer,fnFilter,oConfigs);
           }

         this.Filter=fnFilter;
         this._oDataTable=oDataTable;
          this.itemSelectEvent.subscribe(this.myOnSelect);
         this.dataReturnEvent.subscribe(this.myOnDataReturn);
         this._oDataTable.subscribe("columnSortEvent",this.updateFilter,this._oDataTable,this)
 }

                 // Inherit from YAHOO.widget.RowFilter
 YAHOO.lang.extend(YAHOO.yuiblog.widget.RowFilter, YAHOO.widget.AutoComplete); 
     
```

The core of the `RowFilter` class are the methods `myOnSelect`, `myOnDataReturn` and `updateFilter.` Again, a table summarizing their roles would be helpful:

| Name | Responsibility |
| --- | --- |
| `myOnSelect` | Calls the filterRows method of its DataView instance when the user selects a result |
| `myOnDataReturn` | Check if its DataView instance is filtered. If true, then it resets its DataSource and DataView instances to their original state |
| `UpdateFilter` | Updates its DataSource to match the sorted DataTable |

Here's the code for each of these pieces:

`myOnSelect`:

```
 YAHOO.yuiblog.widget.RowFilter.prototype.myOnSelect= function(sType, aArgs) {
      var objResult = aArgs[2][1];
     this._oDataTable.filterRows(objResult.matchedRows)
 }
 
```

`myOnDataReturn`:

```
 YAHOO.yuiblog.widget.RowFilter.prototype.myOnDataReturn= function(sType, aArgs) {
      var oAutoComp = aArgs[0];
      var sQuery = aArgs[1];
      var aResults = aArgs[2];

     if(aResults.length == 0) {
           oAutoComp.setBody("<div id=\"container_default\">No matching results</div>");
      }

     this.reset();
 } 
```

`UpdateFilter`:

```
 YAHOO.yuiblog.widget.RowFilter.prototype.updateFilter=function(oColumn,oDataTable) {
      var records=oDataTable.getRecordSet().getRecords();
      this.Filter._aData=records;
      if (oDataTable.isFiltered) {
          this.hideColumns();
      }
 }; 
```

When I said that the `RowFilter` class is responsible for feeding the `filterRows` method I lied. In reality, the heavy lifting is delegated to the `fnFilter` method of the `StringFilter` class.

`StringFilter` Constructor:

```
 YAHOO.yuiblog.util.StringFilter=function(aRecords, sFieldName, oConfigs) {
       if(typeof oConfigs == "object") {
         for(var sConfig in oConfigs) {
             this[sConfig] = oConfigs[sConfig];
         }
     }
      this._aData=aRecords;
      this.schemaItem=sFieldName;
      this._init();
 };

  YAHOO.yuiblog.util.StringFilter.prototype = new YAHOO.widget.DataSource(); 
```

`fnFilter` method:

```
 YAHOO.yuiblog.util.StringFilter.prototype.fnFilter=function(sQuery) {
      sQuery=unescape(sQuery);
      var aResults = [];
      var aData= this._aData;
      var fName= this.schemaItem;
      if(sQuery && sQuery.length > 0) {
           var q= sQuery.toLowerCase();
           var updateResult=false;
           var elHashTable={}

           for (var i=0; i<aData.length; i++) {
                var field=aData[i][fName];
                var updateResult=false;

                 if(elHashTable[field]) {
                     //Update Hashtable entry with the additional row matched 
                      elHashTable[field].rows.push(i)
                      updateResult=true;
                }
                else {
                      elHashTable[field]= {rows:[i], resultIndex:-1};
                }

                //Save the index of the match
                var mIndex=field.toLowerCase().indexOf(q);
                var objResult={value:field, matchIndex:mIndex, matchedRows:[i]
           }

                                 if (mIndex<0) { continue;}

                                  if(updateResult){
                     var ri = elHashTable[field].resultIndex;
                     objResult.matchedRows=elHashTable[field].rows;
                     aResults[ri]=[objResult.value,objResult];
                }
                else {
                       aResults.push([objResult.value,objResult]);  
                       //Update the hashtable resultIndex   
                       elHashTable[field].resultIndex = aResults.length-1;
                       var ri= elHashTable[field].resultIndex;
                }
           }
      }
      return aResults;
 } 
```

The `StringFilter` class implements the DataSource interface and has two important properties: `_aData` which is a reference to the unfiltered records, and `schemaItem` which maps to a field name in the DataTable. When the `fnFilter` method receives a query from the `RowFilter` class it looks for the query term in the `schemaItem` column of its `_aData` array. This method returns an array containing the content of the column rows that match the query, as well as their corresponding row numbers.

[Click here to try out the full DataView example including the ContextMenu and AutoComplete integration running on YUI version 2.3.1.](/yuiblog/sandbox/yui/v231/examples/datatable/filterRows.php) ([An older version running on version 2.2.2 is available here.](/yuiblog/sandbox/yui/v222/examples/datatable/filterRows.php))

**Note:**For the sake of simplicity, this particular `hideColumns` implementation does not work with nested headers.

**\[Update\]** Fixed display bug when user hides a column after applying a filter.