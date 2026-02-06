---
layout: layouts/post.njk
title: "Using YUI TreeView and DataTable Together"
author: "YUI Team"
date: 2009-10-12
slug: "using-yui-treeview-and-datatable-together"
permalink: /blog/2009/10/12/using-yui-treeview-and-datatable-together/
categories:
  - "Development"
---
When you want to present both a complex hierarchy and lists of properties, the [TreeView](http://developer.yahooo.com/yui/treeview/) and [DataTable](http://developer.yahooo.com/yui/datatable/) Controls in [YUI 2](http://developer.yahooo.com/yui/) work well together.

For this tip we will make a browser for web server logs. The TreeView will display file and folder paths, and the DataTable will display individual log lines. Clicking on a file or folder in the Tree will cause the DataTable to filter out all but that path. ([Click here for the working demo](/yuiblog/blog-archive/assets/datatable-with-treeview.html).)

[![Screenshot of TreeView and DataTable example](/yuiblog/blog/wp-content/uploads/2009/10/datatable-treeview2.png)](/yuiblog/blog-archive/assets/datatable-with-treeview.html)

For brevity's sake I will use static data. In practice you would use the dynamic data techniques detailed [here](http://developer.yahoo.com/yui/examples/treeview/dynamic_tree.html) and [here](http://developer.yahoo.com/yui/examples/datatable/dt_dynamicdata.html) and do the filtering on the server. After the static example, we'll [talk about dynamic data in more detail](#tvdtdynamic).

The bit to pay attention to is the linkage between the TreeView's `labelClicked` event and the DataSource's `sendRequest()` method. (You can find all the dependencies for this example on the [YUI 2 Configurator](http://developer.yahoo.com/yui/articles/hosting/?base&datatable&fonts&treeview&MIN).)

```
<!-- Combo-handled YUI CSS files: --> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.8.0r4/build/fonts/fonts-min.css&2.8.0r4/build/base/base-min.css&2.8.0r4/build/datatable/assets/skins/sam/datatable.css&2.8.0r4/build/treeview/assets/skins/sam/treeview.css"> 
<!-- Combo-handled YUI JS files: --> 
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yahoo-dom-event/yahoo-dom-event.js&2.8.0r4/build/element/element-min.js&2.8.0r4/build/datasource/datasource-min.js&2.8.0r4/build/datatable/datatable-min.js&2.8.0r4/build/treeview/treeview-min.js"></script> 

<!-- create container DIVs for the TreeView and DataTable -->
<body class="yui-skin-sam">
  <table>
  <tr>
    <td valign="top">
    <div id="myTree" style="width:160px"></div>
    </td>
    <td valign="top">
    <div id="myContainer"></div>
    </td>
  </tr>
</table>
</body>


<script>
YAHOO.util.Event.addListener(window, "load",
function() {

  /**** DataTable ****/

  // Define the columns of the DataTable
  var myColumnDefs = [
    {key:"ip",   label:"IP Address"},
    {key:"path",   label:"Path"},
    {key:"status", label:"Status"},
    {key:"msec",   label:"Time"},
    {key:"bytes",  label:"Size"},
    {key:"ts",   label:"Timestamp"}
  ];

  // Dummy data for the table.
  var myData = [
    {ts:'Oct 10 2009 14:33:26', ip:'1.2.3.4', path:'/favicon.ico', status:200, msec:123, bytes:616},
    {ts:'Oct 10 2009 14:33:26', ip:'1.2.3.4', path:'/images/logo.gif', status:200, msec:213, bytes:7891},
    {ts:'Oct 10 2009 14:33:26', ip:'1.2.3.4', path:'/images/welcome.gif', status:200, msec:872, bytes:19357},
    {ts:'Oct 10 2009 14:33:26', ip:'1.2.3.4', path:'/index.html', status:200, msec:901, bytes:13453},
    {ts:'Oct 10 2009 14:33:27', ip:'4.5.6.7', path:'/favicon.ico', status:304, msec:110, bytes:616},
    {ts:'Oct 10 2009 14:33:27', ip:'4.5.6.7', path:'/images/logo.gif', status:304, msec:432, bytes:7891},
    {ts:'Oct 10 2009 14:33:27', ip:'4.5.6.7', path:'/images/welcome.gif', status:304, msec:528, bytes:19357},
    {ts:'Oct 10 2009 14:33:27', ip:'4.5.6.7', path:'/index.html', status:304, msec:562, bytes:13453},
    {ts:'Oct 10 2009 14:33:28', ip:'3.4.5.6', path:'/favicon.ico', status:200, msec:313, bytes:616},
    {ts:'Oct 10 2009 14:33:28', ip:'3.4.5.6', path:'/images/logo.gif', status:200, msec:215, bytes:7891},
    {ts:'Oct 10 2009 14:33:28', ip:'3.4.5.6', path:'/images/welcome.gif', status:200, msec:324, bytes:19357},
    {ts:'Oct 10 2009 14:33:28', ip:'3.4.5.6', path:'/index.html', status:200, msec:818, bytes:13453},
    {ts:'Oct 10 2009 14:33:29', ip:'7.8.9.5', path:'/favicon.ico', status:200, msec:786, bytes:616},
    {ts:'Oct 10 2009 14:33:29', ip:'7.8.9.5', path:'/images/logo.gif', status:200, msec:604, bytes:7891},
    {ts:'Oct 10 2009 14:33:29', ip:'7.8.9.5', path:'/images/welcome.gif', status:200, msec:803, bytes:19357},
    {ts:'Oct 10 2009 14:33:29', ip:'7.8.9.5', path:'/index.html', status:200, msec:934, bytes:13453}
  ];

  // Create a static "JSARRAY" DataSource with the appropriate fields.
  var myDataSource = new YAHOO.util.DataSource(myData);
  myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
  myDataSource.responseSchema = {
    fields: ['ip', 'path', 'status', 'msec', 'bytes', 'ts']
  };

  // Create a filter function that will be called any time sendRequest() is called.
  // Returns only the results whose path matches the given prefix.
  myDataSource.doBeforeCallback = function (path, raw, res) {
    var data = res.results || [];
    var filtered = [];
    if (path) {
      for (var i=0; i<data.length; i++) {
        if (data[i].path.indexOf(path) === 0) {
          filtered.push(data[i]);
        }
      }
      res.results = filtered;
    }
    return res;
  };

  // Create the DataTable instance given the HTML element, column defs and datasource.
  var myDataTable = new YAHOO.widget.DataTable("myContainer", myColumnDefs, myDataSource);


  /**** TreeView ****/

  // Dummy tree data, describing a folder and some files.
  var myTreeData = [
    {name:'images', children:[
       {name:'logo.gif'},
       {name:'welcome.gif'}
     ]},
    {name:'index.html'},
    {name:'favicon.ico'}
  ];

  var myTree = new YAHOO.widget.TreeView("myTree");

  // Recurse over the tree data to build nodes.
  // Expand the second level of files & folders, but keep the rest hidden.
  function buildNodes(parentNode, treeData, parentPath, expanded) {
    for (var i=0; i<treeData.length; i++) {
      var nodeData = treeData[i];
      var node = new YAHOO.widget.TextNode(nodeData.name, parentNode, expanded);

      // Build up the full path of the node for future reference.
      node.path = parentPath + '/' + node.label;

      // Recurse downward if this node has children.
      if (nodeData.children) {
        buildNodes(node, nodeData.children, node.path, false);
      }
    }
  }
  buildNodes(myTree.getRoot(), myTreeData, '', true);


  // When a tree node is clicked, filter the DataTable's records
  // by poking at the DataSource's sendRequest() method.
  myTree.subscribe("labelClick", function(node) {
    myDataSource.sendRequest(node.path,{
      success : myDataTable.onDataReturnInitializeTable,
      failure : myDataTable.onDataReturnInitializeTable,
      scope   : myDataTable,
      argument: myDataTable.getState()
    });

  });

  myTree.draw();

});

</script>

```

## Using TreeView and DataTable with Dynamic Data

To use dynamic data, server-side pagination and sorting with a DataTable, [check out this example](http://developer.yahoo.com/yui/examples/datatable/dt_dynamicdata.html). To use dynamic data in a TreeView, [refer to this example](http://developer.yahoo.com/yui/examples/treeview/dynamic_tree.html). In the `loadNodeData` function you can add the call to `myDataSource.sendRequest()` like so:

```
  // construct a server-side call that will return logs matching the given path
  var nodePath = encodeURIComponent(node.path);
  var requestString = 'path=' + nodePath + '&sort=ts&dir=asc&startIndex=0&results=25';

  // poke at the DataSource using sendRequest()
  var oCallback = {
    success : myDataTable.onDataReturnSetRows,
    failure : myDataTable.onDataReturnSetRows,
    scope   : myDataTable,
    argument: myDataTable.getState()
  };
  myDataSource.sendRequest(requestString, oCallback);

```