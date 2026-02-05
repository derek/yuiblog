<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>TreeView and Horizontal Scrolling</title>
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
   

<script>

</script>


</head>
<body>
<div id="doc" class="yui-t3">
   <div id="hd"><h1>TreeView and Horizontal Scrolling</h1></div>
   <div id="bd">
	<div id="yui-main">
	<div class="yui-b"><div class="yui-g">
				<div id="demoDetails">
					<p><strong>Date:</strong> January 5, 2007</p>
					<p><strong>Component:</strong>TreeView</p>
					<p><strong>Version:</strong> v0.12.1</p>
				</div>

<div id="parentTreeDiv" style="width:300px;height:150px;overflow-x:auto;">
	<div id="treeDiv1"><!-- TREE RENDERED HERE --></div>
</div>

<script type="text/javascript">


function treeInit() {
	var tree = new YAHOO.widget.TreeView("treeDiv1");
	var tmpNode;
		for (var i = 0; i < 3; i++) {
	tmpNode = new YAHOO.widget.TextNode(i + "_long_node_label_yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy" + i, tree.getRoot(), false);
	}
	tmpNode = new YAHOO.widget.TextNode("child node", tmpNode, false);
	tmpNode = new YAHOO.widget.TextNode("grandchild node", tmpNode, true);
	tmpNode = new YAHOO.widget.TextNode("great grandchild node", tmpNode, false);
	tree.draw();
}

YAHOO.util.Event.addListener(window, "load", treeInit);


</script>

				

 
				<p id="clear">This simple example is designed to illustrate the simplest approach to allowing a <a href="http://developer.yahoo.com/yui/treeview/">TreeView Control</a> implementation to spread out horizontally beyond the dimensions allocated for it on the page.  If a TreeView is constrained spatially, its visual treatment will degrade.  To prevent this: </p>
				<ul>
				  <li>Wrap the element into which your TreeView will be rendered within a container element. Do not specify a width for the element into which you're rendering your TreeView; allow it to expand horizontally as needed. </li>
				  <li>Using CSS, specify a width for the container element.</li>
				  <li>Using CSS, specify  the overflow-x property to be auto.</li>
		  </ul>
				<p>If you were to write the CSS inline, the markup for this solution would look as follows:</p>
				
<pre><textarea name="code" class="HTML" cols="60" rows="1"><div id="parentTreeDiv" style="width:300px;overflow-x:auto;">
	<div id="treeDiv1"><!-- TREE RENDERED HERE --></div>
</div></textarea></pre>
<br><br>
<p>Please note that text in your tree will wrap if it can &mdash; this technique will only force scrolling if the TreeView instance can not naturally be constrained within the given space.  To force scrolling even when the tree is not constrained, you would need to wrap <code>parentTreeDiv</code> around an inner element with a width set to the desired width allocated for your tree.</p>

<div id="outerwrapper" style="width:300px;height:150px;overflow-x:auto;"> 
	<div id="parentTreeDiv2" style="width:600px;height:130px;overflow-x:auto;">
		<div id="treeDiv2"><!-- TREE RENDERED HERE --></div>
	</div>
</div>

<script type="text/javascript">


function treeInit2() {
	var tree = new YAHOO.widget.TreeView("treeDiv2");
	var tmpNode;
		for (var i = 0; i < 3; i++) {
	tmpNode = new YAHOO.widget.TextNode(i + "_long_node_label_yyyy yyyyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyyy" + i, tree.getRoot(), false);
	}
	tmpNode = new YAHOO.widget.TextNode("child node", tmpNode, false);
	tmpNode = new YAHOO.widget.TextNode("grandchild node", tmpNode, true);
	tmpNode = new YAHOO.widget.TextNode("great grandchild node", tmpNode, false);
	tree.draw();
}

YAHOO.util.Event.addListener(window, "load", treeInit2);


</script>

<textarea name="code" class="JScript" cols="60" rows="1"><div id="outerwrapper" style="width:300px;height:150px;overflow-x:auto;"> 
	<div id="parentTreeDiv2" style="width:600px;height:130px;overflow-x:auto;">
		<div id="treeDiv2"><!-- TREE RENDERED HERE --></div>
	</div>
</div>

<script type="text/javascript">


function treeInit2() {
	var tree = new YAHOO.widget.TreeView("treeDiv2");
	var tmpNode;
		for (var i = 0; i < 3; i++) {
	tmpNode = new YAHOO.widget.TextNode(i + "_long_node_label_yyyy yyyyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyy yyyyyyy" + i, tree.getRoot(), false);
	}
	tmpNode = new YAHOO.widget.TextNode("child node", tmpNode, false);
	tmpNode = new YAHOO.widget.TextNode("grandchild node", tmpNode, true);
	tmpNode = new YAHOO.widget.TextNode("great grandchild node", tmpNode, false);
	tree.draw();
}

YAHOO.util.Event.addListener(window, "load", treeInit2);
</textarea>

</script>

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