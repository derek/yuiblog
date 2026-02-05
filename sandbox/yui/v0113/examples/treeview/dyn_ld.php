<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />


<!--Yahoo! User Interface Library: http://developer.yahoo.com/yui -->

<!--Begin YUI CSS infrastructure, including Standard Reset, Standard Fonts, and CSS Page Grids -->
<link rel="stylesheet" type="text/css" href="../../build/reset/reset.css" />
<link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css" />
<link rel="stylesheet" type="text/css" href="../../build/grids/grids.css" />
<!--end YUI CSS infrastructure-->

<!--begin YUIL Utilities -->
<script src="../../build/yahoo/yahoo-min.js"></script>
<script src="../../build/event/event-min.js"></script>
<script src="../../build/dragdrop/dragdrop-min.js"></script>
<script src="../../build/connection/connection-min.js"></script>
<script src="../../build/animation/animation-min.js"></script>
<script src="../../build/dom/dom-min.js"></script>

<!-- OPTIONAL for AutoComplete: JSON (not required if not using JSON data) -->
<script src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/json_2.0.0-b4.js"></script>
<!--end YUIL Utilities-->

<!--begin YUIL Widgets/Controls, including CSS where supported-->
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

<style>
#report {margin:7px 0; padding:5px; border:1px solid black; background-color:#E1E1E1;}
</style>

<script>
YAHOO.example.treeExample = function() {
	function buildTree() {
		//create a new tree:
		tree = new YAHOO.widget.TreeView("treeContainer");
		
		//get root node for tree:
		var root = tree.getRoot();
		
		//create dummy data for root
		var mycars = new Array();
		mycars[0] = "Saab";
		mycars[1] = "Volvo";
		mycars[2] = "BMW";
		mycars[3] = "Ferrari";
		mycars[4] = "Yugo";
		mycars[5] = "Bentley";
				
		for (i=0;i<mycars.length;i++)
		{
			var tmpNode = new YAHOO.widget.TextNode({label: mycars[i], customData: mycars[i] + "-metadata"}, root, false);			
			//set dynamic loading just for these top-level nodes
			tmpNode.setDynamicLoad(loadNodeData);
		}
		tree.draw();
	}

	//handler to process label clicks, to be
	//assigned in our dynamic load function
	var onLabelClick = function(oNode) {
		document.getElementById("report").innerHTML = "The node you clicked on had the label '" + oNode.data.label  + "'";
	}

	function loadNodeData(node, fnLoadComplete) {
		//dummy data for bmw parent
		var oCarData = {
			BMW: ["3 series","m series","5 series","7 series","6 series"],
			Saab: ["9-2", "9-3", "9-5", "Aero", "Viggen"],
			Volvo: ["V50", "V70", "V90", "XC", "XC-90"],
			Ferrari: ["Enzo", "Spyder"],
			Yugo: ["Really?  Yugo?"],
			Bentley: ["Continental", "Arnage"]
			};
		
		//get the models for the car make designated
		//by the clicked label
		var children = oCarData[node.data.label];
		
		//loop through children array	
		for (var i=0; i<children.length; i++) {
			thisModel = children[i];
			var newNode = new YAHOO.widget.TextNode({label:thisModel}, node, false);
			newNode.onLabelClick = onLabelClick;
		}
		fnLoadComplete();
	}
	return {
		init: function() {
			buildTree();
		}
	}
}()
YAHOO.util.Event.addListener(window, "load", YAHOO.example.treeExample.init, YAHOO.example.treeExample, true);
</script>
<title>TreeView Example: Dynamic Load, Using node.onLabelClick and node.data</title>
</head>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>TreeView Example: Dynamic Load, Using node.onLabelClick and node.data</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> September 25, 2006</p>
					<p><strong>Component:</strong> TreeView, Event</p>
					<p><strong>Version:</strong> v0.11.3</p>
				</div>
			   
			   <div id="treeContainer"></div>
			   <div id="report">Click on a node label above to report the node's label and custom data here.</div>
				<p id="clear">This simple example of a TreeView using dyanmic loading responds to <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/5163">jmpow99's question on the YDN-JavaScript group</a> (<a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/5184">and followup question here</a>).</p>
				
				<p>The followup question asks about how to determine what node is involved when a label is clicked on and how to track information about that node.  Let's start with the issue of associating data with a Node object.  The constructor for a TextNode takes as its first argument the Node label (as a string) or, alternatively, a custom object containing data associated with the Node; when a custom object is passed, the Node instance will use the object's <code>label</code> member as the label and, if present, the <code>href</code> member as the "destination" for a label click.  But we can put in additional members, too &mdash; anything that we want to associate with the Node.  So, in the above implementation, we'll specify our label and we'll note that in this object literal we could put any other custom attributes we'd care to:</p>
				
<pre><textarea name="code" class="JScript" cols="60" rows="1">var newNode = new YAHOO.widget.TextNode({
	  label:thisModel,
	  customData:"Additional data can reside in this object..."
	}, node, false);</textarea></pre>

<p>Now, how to get to that data when a label is clicked? That custom object we created will be stored as the Node instance's <code>data</code> member.  And <a href="http://developer.yahoo.com/yui/docs/treeview/YAHOO.widget.TextNode.html">YAHOO.widget.TextNode</a> has a method called <a href="http://developer.yahoo.com/yui/docs/treeview/YAHOO.widget.TextNode.html#onLabelClick">onLabelClick</a> which fires each time a label is clicked and which receives the label's parent Node as an argument.  We can write our own function to handle this and assign it to our Node instances' <code>onLabelClick</code> member:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">var onLabelClick = function(oNode) {
	document.getElementById("report").innerHTML = "The node you clicked on had the label '" + oNode.data.label + "'.";
}

//later in the code, within our dynamic load function,
//we assign onLabelClick to our child node instances:
for (var i=0; i<children.length; i++) {
	thisModel = children[i];
	var newNode = new YAHOO.widget.TextNode({label:thisModel}, node, false);
	newNode.onLabelClick = onLabelClick;
}</textarea></pre>

<p>Note that in our <code>onLabelClick</code> function we're extracting just the <code>label</code> member from our Node's <code>data</code> object, but any additional data that we stored there would be accessible to us at that point &mdash; including, for example, the unique identifier that might tie that node to its corresponding database record.</p>

<p>In total, our code now looks like this:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1"><script>
YAHOO.example.treeExample = function() {
	function buildTree() {
		//create a new tree:
		tree = new YAHOO.widget.TreeView("treeContainer");
		
		//get root node for tree:
		var root = tree.getRoot();
		
		//create dummy data for root
		var mycars = new Array();
		mycars[0] = "Saab";
		mycars[1] = "Volvo";
		mycars[2] = "BMW";
		mycars[3] = "Ferrari";
		mycars[4] = "Yugo";
		mycars[5] = "Bentley";
				
		for (i=0;i<mycars.length;i++)
		{
			var tmpNode = new YAHOO.widget.TextNode({label: mycars[i], customData: mycars[i] + "-metadata"}, root, false);			
			//set dynamic loading just for these top-level nodes
			tmpNode.setDynamicLoad(loadNodeData);
		}
		tree.draw();
	}

	//handler to process label clicks, to be
	//assigned in our dynamic load function
	var onLabelClick = function(oNode) {
		document.getElementById("report").innerHTML = "The node you clicked on had the label '" + oNode.data.label  + "'";
	}

	function loadNodeData(node, fnLoadComplete) {
		//dummy data for bmw parent
		var oCarData = {
			BMW: ["3 series","m series","5 series","7 series","6 series"],
			Saab: ["9-2", "9-3", "9-5", "Aero", "Viggen"],
			Volvo: ["V50", "V70", "V90", "XC", "XC-90"],
			Ferrari: ["Enzo", "Spyder"],
			Yugo: ["Really?  Yugo?"],
			Bently: ["Continental", "Arnage"]
			};
		
		//get the models for the car make designated
		//by the clicked label
		var children = oCarData[node.data.label];
		
		//loop through children array	
		for (var i=0; i<children.length; i++) {
			thisModel = children[i];
			var newNode = new YAHOO.widget.TextNode({label:thisModel}, node, false);
			newNode.onLabelClick = onLabelClick;
		}
		fnLoadComplete();
	}
	return {
		init: function() {
			buildTree();
		}
	}
}()
YAHOO.util.Event.addListener(window, "load", YAHOO.example.treeExample.init, YAHOO.example.treeExample, true);
</script>

<div id="treeContainer">Tree container</div></textarea></pre>

<p>&mdash; <strong>Eric Miraglia</strong>, Yahoo Presentation Platform Engineering</p>
				
	  </div>
		</div>
		<!-- end: primary column from outer template -->
		
		<!-- start: secondary column from outer template -->
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
</ul>		</div>
		<!-- end: secondary column from outer template -->
		
	</div>
	<div id="ft">
<p>(c)2010 Yahoo Inc.</p>

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
</noscript>	</div>
</div>

</body>
</html>
