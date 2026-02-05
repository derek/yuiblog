<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Using Custom Icons in the TreeView Control</title>
   <!--console.log defuser-->
<script src="http://us.js2.yimg.com/us.js.yimg.com/lib/smb/js/shared/debug/firebugx.js"></script>

<!--Yahoo! User Interface Library: http://developer.yahoo.com/yui -->

<!--Begin YUI CSS infrastructure, including Standard Reset, Standard Fonts, and CSS Page Grids -->
<link rel="stylesheet" type="text/css" href="../../build/reset-fonts-grids/reset-fonts-grids.css" />
<!--end YUI CSS infrastructure-->

<!--begin YUIL Utilities -->
<script src="../../build/utilities/utilities.js"></script>

<!-- OPTIONAL for AutoComplete: JSON (not required if not using JSON data) -->
<script src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/json_2.0.0-b4.js"></script>
<!--end YUIL Utilities-->

<!--begin YUIL Widgets/Controls, including CSS where supported-->
<script src="../../build/logger/logger-min.js"></script>
<script src="../../build/slider/slider-min.js"></script>
<script src="../../build/treeview/treeview-min.js"></script>
<script src="../../build/calendar/calendar-min.js"></script>
<script src="../../build/autocomplete/autocomplete-min.js"></script>
<script src="../../build/container/container-min.js"></script>
<script src="../../build/menu/menu-min.js"></script>

<link rel="stylesheet" type="text/css" href="../../build/treeview/assets/tree.css" />
<link rel="stylesheet" type="text/css" href="../../build/calendar/assets/calendar.css" />
<link rel="stylesheet" type="text/css" href="../../build/container/assets/container.css" />
<link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css" />
<link rel="stylesheet" type="text/css" href="http://us.js2.yimg.com/us.js.yimg.com/lib/common/widgets/2/logger/css/logger_2.0.5.css"> 
<!--end Yahoo YUIL Widgets/Controls-->

<!--end Yahoo User Interface Library-->


<!--dpSyntaxHighlighter-->
<script src="/assets/dpSyntaxHighlighter.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/dpSyntaxHighlighter.css" />
<!--end dpSyntaxHighlighter-->


<!--begin blog stylesheet-->
<link rel="stylesheet" type="text/css" href="/blog/wp-content/themes/yuiblog_v1/style.css" />
<!--end blog styleshet-->


<!--begin demo stylesheet-->
<link rel="stylesheet" type="text/css" href="/assets/demo.css" />
<!--end demo styleshet-->
   <style type="text/css">
   #doc { width: 85%; min-width: 950px; }
   </style>
   
<link rel="stylesheet" href="http://developer.yahoo.com/yui/examples/treeview/css/folders/tree.css">
  
<style type="text/css">
	#treediv {background-color:#FFFCE9; padding:1em; margin-right:1em;}
    .icon-ppt { padding-left: 20px; background: transparent url(img/icons.png) 0 0px no-repeat; }
    .icon-dmg { padding-left: 20px; background: transparent url(img/icons.png) 0 -36px no-repeat; }
    .icon-prv { padding-left: 20px; background: transparent url(img/icons.png) 0 -72px no-repeat; }
    .icon-gen { padding-left: 20px; background: transparent url(img/icons.png) 0 -108px no-repeat; }
    .icon-doc { padding-left: 20px; background: transparent url(img/icons.png) 0 -144px no-repeat; }
    .icon-jar { padding-left: 20px; background: transparent url(img/icons.png) 0 -180px no-repeat; }
    .icon-zip { padding-left: 20px; background: transparent url(img/icons.png) 0 -216px no-repeat; }
</style>

<script>

//Wrap our initialization code in an anonymous function
//to keep out of the global namespace:
(function(){
	var init = function() {
		
		//create the TreeView instance:
		var tree = new YAHOO.widget.TreeView("treediv");
		
		//get a reusable reference to the root node:
		var root = tree.getRoot();
		
		//for Ahmed's documents, we'll use TextNodes.
		//First, create a parent node for his documents:
		var ahmedDocs = new YAHOO.widget.TextNode("Ahmed's Documents", root, true);
			//Create a child node for his Word document:
			var ahmedMsWord = new YAHOO.widget.TextNode("Prospectus", ahmedDocs, false);
			//Now, apply the "icon-doc" style to this node's
			//label:
			ahmedMsWord.labelStyle = "icon-doc";
			var ahmedPpt = new YAHOO.widget.TextNode("Presentation", ahmedDocs, false);
			ahmedPpt.labelStyle = "icon-ppt";
			var ahmedPdf = new YAHOO.widget.TextNode("Prospectus-PDF version", ahmedDocs, false);
			ahmedPdf.labelStyle = "icon-prv";
	
		//for Susheela's documents, we'll use HTMLNodes.
		//First, create a parent node for his documents:
		var sushDocs = new YAHOO.widget.TextNode("Susheela's Documents", root, true);
			//Create a child node for her zipped files:
			var sushZip = new YAHOO.widget.HTMLNode("Zipped Files", sushDocs, false);
			//Now, apply the "icon-zip" style to this HTML node's
			//content:
			sushZip.contentStyle = "icon-zip";
			var sushDmg = new YAHOO.widget.HTMLNode("Files -- .dmg version", sushDocs, false);
			sushDmg.contentStyle = "icon-dmg";
			var sushGen = new YAHOO.widget.HTMLNode("Script -- text version", sushDocs, false);
			sushGen.contentStyle = "icon-gen";
			var sushJar = new YAHOO.widget.HTMLNode("JAR file", sushDocs, false);
			sushJar.contentStyle = "icon-jar";
	
		tree.draw();
	}
	YAHOO.util.Event.on(window, "load", init);
})();
</script>


</head>
<body>
<div id="doc" class="yui-t3">
   <div id="hd"><h1>Using Custom Icons in the TreeView Control</h1></div>
   <div id="bd">
	<div id="yui-main">
	<div class="yui-b"><div class="yui-g">
				<div id="demoDetails">
					<p><strong>Date:</strong> December 27, 2006</p>
					<p><strong>Component:</strong>TreeView</p>
					<p><strong>Version:</strong> v0.12.1</p>
				</div>

				<div id="treediv">				

				</div>
				

 
				<p id="clear">Many implementations of tree-style controls call for using custom icons on a per-node basis.  In this example, we'll look at one strategy for apply custom icons to specific nodes using the <a href="http://developer.yahoo.com/yui/treeview/">YUI TreeView Control</a>.</p>
				
				<p>We'll start by using a single image containing our icon set and we'll use the technique known as "<a href="http://www.alistapart.com/articles/sprites">CSS Sprites</a>" to specify which icon we want to use for each specific style.  This allows us to combine seven images in a single HTTP request (<a href="http://yuiblog.com/blog/2006/11/28/performance-research-part-1/">click here to read more about why reducing HTTP requests is a good idea</a>).  Here's the raw image:</p>
				
				<p><img src="img/icons.png" width="18" height="252" alt="Our icon images are combined into a single png file to reduce HTTP requests."></p>
				
				<p>With that image in place, we can now set up our style rules to identify icons for each file type.  We do that by positioning our <code>icons.png</code> image uniquely for each icon we want to display:</p>
				
<pre><textarea name="code" class="HTML" cols="60" rows="1"><style type="text/css">
.icon-ppt { padding-left: 20px; background: transparent url(img/icons.png) 0 0px no-repeat; }
.icon-dmg { padding-left: 20px; background: transparent url(img/icons.png) 0 -36px no-repeat; }
.icon-prv { padding-left: 20px; background: transparent url(img/icons.png) 0 -72px no-repeat; }
.icon-gen { padding-left: 20px; background: transparent url(img/icons.png) 0 -108px no-repeat; }
.icon-doc { padding-left: 20px; background: transparent url(img/icons.png) 0 -144px no-repeat; }
.icon-jar { padding-left: 20px; background: transparent url(img/icons.png) 0 -180px no-repeat; }
.icon-zip { padding-left: 20px; background: transparent url(img/icons.png) 0 -216px no-repeat; }
</style></textarea></pre>

<p>The effect of these style rules is to create a 20-pixel space to the left of the styled object and to place the icon directly in that space.  The sheet of icons is positioned so that, for example, the zip-file icon will appear when the class <code>icon-zip</code> is applied.</p>

<p>To apply these styles on a per-node basis in TreeView, we use the <a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.TextNode.html#labelStyle">labelStyle</a> property of <a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.TextNode.html">TextNodes</a> and <a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.MenuNode.html">MenuNodes</a> and the <a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.HTMLNode.html#contentStyle">contentStyle</a> property of <a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.HTMLNode.html">HTMLNodes</a>.</p>

<p>Here is the code used to create the TreeView instance above and to create the first node, "Ahmed's Documents," while applying the specific icon styles to each node:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//create the TreeView instance:
var tree = new YAHOO.widget.TreeView("treediv");

//get a reusable reference to the root node:
var root = tree.getRoot();

//for Ahmed's documents, we'll use TextNodes.
//First, create a parent node for his documents:
var ahmedDocs = new YAHOO.widget.TextNode("Ahmed's Documents", root, true);
	//Create a child node for his Word document:
	var ahmedMsWord = new YAHOO.widget.TextNode("Prospectus", ahmedDocs, false);
	//Now, apply the "icon-doc" style to this node's
	//label:
	ahmedMsWord.labelStyle = "icon-doc";
	var ahmedPpt = new YAHOO.widget.TextNode("Presentation", ahmedDocs, false);
	ahmedPpt.labelStyle = "icon-ppt";
	var ahmedPdf = new YAHOO.widget.TextNode("Prospectus-PDF version", ahmedDocs, false);
	ahmedPdf.labelStyle = "icon-prv";</textarea></pre>
	
<p>The script for creating Susheela's part of the tree is very similar.  Here, we'll use HTMLNodes, and we'll use the <code>contentStyle</code> property to apply the icon style:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//for Susheela's documents, we'll use HTMLNodes.
//First, create a parent node for his documents:
var sushDocs = new YAHOO.widget.TextNode("Susheela's Documents", root, true);
	//Create a child node for her zipped files:
	var sushZip = new YAHOO.widget.HTMLNode("Zipped Files", sushDocs, false);
	//Now, apply the "icon-zip" style to this HTML node's
	//content:
	sushZip.contentStyle = "icon-zip";
	var sushDmg = new YAHOO.widget.HTMLNode("Files -- .dmg version", sushDocs, false);
	sushDmg.contentStyle = "icon-dmg";
	var sushGen = new YAHOO.widget.HTMLNode("Script -- text version", sushDocs, false);
	sushGen.contentStyle = "icon-gen";
	var sushJar = new YAHOO.widget.HTMLNode("JAR file", sushDocs, false);
	sushJar.contentStyle = "icon-jar";</textarea></pre>
	
<p>Note that in this example we're also applying <a href="http://developer.yahoo.com/yui/examples/treeview/css/folders/tree.css">the "folder style" CSS file</a> that is included with the TreeView Control's examples; you can find that file in <a href="http://developer.yahoo.com/yui/download/">the YUI distribution</a> under <code>/examples/treeview/css/folders/tree.css</code>.</p>
</div>
</div>
	</div>
	<div class="yui-b">
	<h3>YUI Library Resources:</h3>

<ul>
	<li><a href="http://developer.yahoo.com/yui/">The YUI Library</a></li>
	<li><a href="http://sourceforge.net/projects/yui/">Download</a></li>
	<li><a href="http://yuiblog.com/">YUI Blog</a></li>
	<li><a href="http://groups.yahoo.com/group/ydn-javascript">YUI Community Forum</a></li>
	<li><a href="http://developer.yahoo.com/ypatterns/">Yahoo Design Patterns Library</a></li>
</ul>

<h3>Recent Examples:</h3>

<ul>
	<li><a href="../../../v231/examples/datatable/filterRows.php">Row Filtering with DataTable and AutoComplete (v2.3.1)</a></li>
	<li><a href="../../../v222/examples/datatable/filterRows.php">Row Filtering with DataTable and AutoComplete (v2.2.2)</a></li>
	<li><a href="../../../v222/examples/datatable/hidingColumns.php">Hiding Columns with DataTable and ContextMenu</a></li>
	<li><a href="../../../v0113/examples/calendar/select_dates_by_script.php">Calendar: Selecting Dates in Calendar</a></li>
	<li><a href="../../../v0113/examples/treeview/dyn_ld.php">TreeView Example: Dynamic Load, Using node.onLabelClick and node.data</a></li>
	<li><a href="../../../v0113/examples/dialog/ac_in_dialog.php">Dialog: Using AutoComplete in a Dialog</a></li>
	<li><a href="../../../v0113/examples/event/customevent.php">Custom Event Example: Simple Publisher and Subscriber</a></li>
	<li><a href="../../../v0113/examples/event/screenpos.php">Event Example: Use Page Position on Click</a></li>
	<li><a href="../../../v010/examples/calendar/calendar_onSelect.php">Calendar Example: Simple onSelect</a></li>
	<li><a href="../../../v010/examples/calendar/calendar_getcellindom.php">Calendar Example: Get DOM Element on Click</a></li>
	<li><a href="../../../v010/examples/calendar/calendar_intl.php">International Calendar Example</a></li>
</ul>	</div>
	
	</div>
   <div id="ft"><p>(c)2010 Yahoo Inc.</p>

<!--MyBlogLog tracking-->
<script type='text/javascript' src='http://track2.mybloglog.com/js/jsserv.php?mblID=2007010912241462'></script>
<!-- Yahoo! Web Analytics - All rights reserved -->
<script type="text/javascript" src="http://d.yimg.com/mi/ywa.js"></script>
<script type="text/javascript">
/*globals YWA*/
var YWATracker = YWA.getTracker("10001638119858");
/*
YWATracker.setDocumentName("");
YWATracker.setDocumentGroup("");
*/
YWATracker.submit();
</script>
<noscript>
<div><img src="http://a.analytics.yahoo.com/p.pl?a=10001638119858&amp;js=no"
width="1" height="1" alt="" /></div>
</noscript></div>
</div>
</body>
</html>