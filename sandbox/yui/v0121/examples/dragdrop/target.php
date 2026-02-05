<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Targets and Groups in YUI Drag &amp; Drop</title>
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
<style type="text/css">
.draggable {text-align:center; background-color:#0000CC; color:#FFFFFF; font-weight:bold; width:7em; height:6em; padding:.1em; margin:.3em; cursor:move; border:1px solid #dedede;}
#alertPanel .bd {text-align:left;}
</style>
<script>

//Wrap our initialization code in an anonymous function
//to keep out of the global namespace:
(function(){
	var init = function() {
		
		var myPanel = new YAHOO.widget.Panel("alertPanel", {
			close:true,
			visible:false,
			draggable:false,
			modal:false,
			fixedcenter:true,
			width:"20em",
			height:"10em",
			effect:{effect:YAHOO.widget.ContainerEffect.FADE, duration:.4}
		});
		myPanel.render(document.body);
		
		var DD = new YAHOO.util.DD("drag1", "group1");
		DD.addToGroup("group2");		
		DD.addToGroup("sharedgroup");		
		var DD2 = new YAHOO.util.DD("drag2", "group2");
		DD2.addToGroup("group3");
		DD2.addToGroup("sharedgroup");		
		var DD3 = new YAHOO.util.DD("drag3", "group3");
		DD3.addToGroup("group4");
		DD3.addToGroup("sharedgroup");		
		var DD4 = new YAHOO.util.DD("drag4", "group4");
		DD4.addToGroup("group1");
		DD4.addToGroup("sharedgroup");	
		
		DD.onDragDrop = DD2.onDragDrop = DD3.onDragDrop = DD4.onDragDrop = function(e, id) {
			var sReport = "<strong>Group memberships for " + id + ":</strong><br>";
			var DDTarget = YAHOO.util.DragDropMgr.getDDById(id);
			myPanel.setHeader("The drop target was " + id);
			for (agroup in DDTarget.groups) {
				sReport += agroup + ": " + DDTarget.groups[agroup].toString() + "<br>";
			}
			myPanel.setBody(sReport);
			myPanel.render();
			myPanel.show();
		}
		
	    DD.startDrag = DD2.startDrag = DD3.startDrag = DD4.startDrag = function(x,y) {
			YAHOO.util.Dom.setStyle(this.getEl(), "zIndex", 10);
		}
		
		DD.endDrag = DD2.endDrag = DD3.endDrag = DD4.endDrag = function(x,y) {
			YAHOO.util.Dom.setStyle(this.getEl(), "zIndex", 1);
		}

	}
	YAHOO.util.Event.on(window, "load", init);
})();
</script>


</head>
<body>
<div id="doc" class="yui-t3">
   <div id="hd"><h1>Targets and Groups in YUI Drag &amp; Drop</h1></div>
   <div id="bd">
	<div id="yui-main">
	<div class="yui-b"><div class="yui-g">
				<div id="demoDetails">
					<p><strong>Date:</strong> December 22, 2006</p>
					<p><strong>Component:</strong>Drag &amp; Drop</p>
					<p><strong>Version:</strong> v0.12.1</p>
				</div>

				<div id="wrapper">				
					<div id="drag1" class="draggable">drag1<br>
group1, group2, sharedgroup</div>
					<div id="drag2" class="draggable">drag2<br>
group2, group3, sharedgroup</div>
					<div id="drag3" class="draggable">drag3<br>
group3, group4, sharedgroup</div>
					<div id="drag4" class="draggable">drag4<br>
group4, group1, sharedgroup</div>
				</div>
				

 
				<p id="clear">The <a href="http://developer.yahoo.com/yui/dragdrop/">YUI Drag and Drop Utility</a> routes its events through the object associated with the element being dragged.  Many times you'll find yourself, while reacting to Drag and Drop events, needing to examine both the HTML element and the Drag and Drop instance associated with the drop target.  The Drag and Drop API makes this a simple task.  In this example, we'll look at a specific use case in which we want to learn about the group memberships of the drop target during the <code>onDragDrop</code> event.</p>

<p>In this example, we have four draggable <code>divs</code> on the page.  Each draggable item is a member of three groups which vary by item, but all items are members of <code>sharedgroup</code> &mdash; that means they'll all react to be being dragged over or dropped on one another.</p>

<p>We set up our draggable items and group memberships as follows:</p>
				
<pre><textarea name="code" class="JScript" cols="60" rows="1">var DD = new YAHOO.util.DD("drag1", "group1");
DD.addToGroup("group2");		
DD.addToGroup("sharedgroup");		
var DD2 = new YAHOO.util.DD("drag2", "group2");
DD2.addToGroup("group3");
DD2.addToGroup("sharedgroup");		
var DD3 = new YAHOO.util.DD("drag3", "group3");
DD3.addToGroup("group4");
DD3.addToGroup("sharedgroup");		
var DD4 = new YAHOO.util.DD("drag4", "group4");
DD4.addToGroup("group1");
DD4.addToGroup("sharedgroup");</textarea></pre>

<p>Next, we override the <code>onDragDrop</code> event for each of our four instances.  In this method, we must do the following:</p>

<ul>
  <li>get a reference to the target element's Drag and Drop instance;</li>
  <li>look at the target instance's <code>groups</code> property;</li>
  <li>report on all of its group memberships.</li>
</ul>
<p>Here's the method we'll use to do that.  Note that we're going to report the information we find to an existing <a href="http://developer.yahoo.com/yui/container/panel/">Panel</a> on the page, setting its header and body, rerendering it, and making it visible to report on <code>groups</code> information for our drop target:</p>
<pre><textarea name="code" class="JScript" cols="60" rows="1">
//the id argument is the id of the drop target
DD.onDragDrop = DD2.onDragDrop = DD3.onDragDrop = DD4.onDragDrop = function(e, id) {
	//prepare our string for the header:
	myPanel.setHeader("The drop target was " + id);
	
	//begin our body string:
	var sReport = "<strong>Group memberships for " + id + ":</strong><br>";
	
	//get reference to the DDObject for the drop
	//target:
	var DDTarget = YAHOO.util.DragDropMgr.getDDById(id);
	
	//loop through the target's group memberships:
	for (agroup in DDTarget.groups) {
		sReport += agroup + ": " + DDTarget.groups[agroup].toString() + "<br>";
	}
	
	//send report to our Panel's body area; re-render
	//and show Panel
	myPanel.setBody(sReport);
	myPanel.render();
	myPanel.show();
}</textarea></pre>

<p>The key issue here is that we can get at (and then do anything we want with) the Drag and Drop instance associated with the target of Drag and Drop events.  Here, we're doing it in the <code>onDragDrop</code> event; however, the same technique holds for all of the Drag and Drop events that are associated with a target:</p>

<ul>
  <li><code>onDragEnter</code></li>
  <li><code>onDragOver</code></li>
  <li><code>onDragOut</code></li>
  <li><code>onDragDrop</code></li>
</ul>

<p>Moving easily between the logic in your Drag and Drop events and the objects associated with targets of those events is an important element of your scripting toolkit for these interactions.</p>


<p>&mdash; <strong>Eric Miraglia</strong>, Yahoo Presentation Platform Engineering</p>
				
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