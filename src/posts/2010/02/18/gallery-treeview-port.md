---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Adam Moore's YUI TreeView Port"
author: "Eric Miraglia"
date: 2010-02-18
slug: "gallery-treeview-port"
permalink: /2010/02/18/gallery-treeview-port/
categories:
  - "Development"
---
[![click through to run this example in the browser](/yuiblog/blog-archive/assets/tvgallery-20100218-175738.jpg)](http://ericmiraglia.com/yui/demos/tvgallery.php)As the YUI Team wraps up work on [the core widget foundation for YUI 3](http://developer.yahoo.com/yui/theater/video.php?v=desai-yuiconf2009-widgets), one of the things we're seeing in the [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery") is transitional solutions that help flesh out [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") implementations. Some of these, like [Julien Lecomte's SimpleMenu](/yuiblog/blog/2010/02/12/gallery-simple-menu/), are pure YUI 3, and others, like [Adam Moore's TreeView module](http://yuilibrary.com/gallery/show/treeview "YUI Library :: Gallery :: treeview"), help bridge the gap between [YUI 2](http://developer.yahoo.com/yui/2/ "YUI 2 — Yahoo! User Interface Library") and 3 and will likely be replaced by other gallery modules or shipping YUI 3 widgets down the road.

Adam's TreeView port is a conversion of the popular [TreeView Control from YUI 2](http://developer.yahoo.com/yui/treeview/ "YUI 2: TreeView"). The YUI 3 Gallery version runs on the YUI 3 foundation and makes use of [Dav Glass's `gallery-port` module](http://yuilibrary.com/gallery/show/port "YUI Library :: Gallery :: Port Base") to bridge some of the API changes. Not all of the features in the YUI 2 version are supported (date editing and animation, for example, aren't included), but it's trivial to get a standard TreeView running with this gallery module. All of the code comes off the CDN and can be combo-handled.

And here's some sample code. Script and CSS file inclusion:

```
<link type="text/css" rel="stylesheet" 
href="http://yui.yahooapis.com/gallery-2010.02.17-20/build/gallery-treeview/assets/skins/sam
     /gallery-treeview.css" />
<script type="text/javascript" 
     src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js&
     gallery-2009.11.02-20/build/gallery-port/gallery-port-min.js&
     gallery-2009.11.19-20/build/gallery-treeview/gallery-treeview-min.js"></script>
```

Markup:

```
<div id="treeView"></div>
```

Implementation script:

```
<script language="javascript">

//Create a YUI instance that uses the treeview gallery module
YUI().use('gallery-treeview', function(Y) {

//Associate the YAHOO variable with and instance of Dav Glass's
//Port utility:
var YAHOO = Y.Port();

//Instantiate the Tree using standard YUI 2 syntax:
var tree = new YAHOO.widget.TreeView("treeView", [
	{type:'Text', label:'Cars',expanded:true, children:[
			'Aston Martin',
			'Bugatti',
			{type: 'Text', label:'GM', href:"http://gm.com", expanded:false, children:[
				'Buick',
				'Cadillac',
				'Chevrolet',
				'GMC'
			]},
			'Renault',
			'Toyota',
			'Volkswagon'
		]
	},
	{type:'Text', label:'Computers', editable:true, children: [
			'Acer',
			'Apple',
			'HP',
			'Dell'
		]
	}
]);
 
// Render the tree:
tree.render();
 
 
});
</script>
```

[Click through for a working version of this example](http://ericmiraglia.com/yui/demos/tvgallery.php).