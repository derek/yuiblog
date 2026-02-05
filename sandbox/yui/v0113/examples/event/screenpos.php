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
<style type="text/css">
.flying-label {
	position:absolute;
	border:1px solid blue;
	background-color:#99CCFF;
}
</style>
<script>

(function() {

	function init(){
		YAHOO.util.Event.addListener(document, 'click', fnClick);
	}
	function fnClick(e){
		var root = YAHOO.util.Dom.get("labels");
		var newDiv = document.createElement("div");
		var newText = document.createTextNode("appears adjacent to mouse position");
		newDiv.appendChild(newText);
		root.appendChild(newDiv);
		YAHOO.util.Dom.addClass(newDiv, "flying-label");
		YAHOO.util.Dom.setXY(newDiv, YAHOO.util.Event.getXY(e));
	}
	
	YAHOO.util.Event.addListener(window, 'load', init);

})();

</script>
<title>Event Example: Use Page Position on Click</title>
</head>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>Event Example: Use Page Position on Click</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> September 12, 2006</p>
					<p><strong>Component:</strong> Event, Dom</p>
					<p><strong>Version:</strong> v0.11.3</p>
				</div>
			   
				<p id="clear">The combination of the Event Utility and the Dom Collection makes it really easy to do what Michael asks for <a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/4776">in this YDN-JavaScript post</a>: Namely, to get the mouse coordinates during a click and make an arbitrary piece of content appear next to where the mouse is located.  Click anywhere on this page to see the effect in action.</p>

<p>Start with some simple CSS code for the appearing elements, which will be positioned absolutely, outside of the page flow:</p>				
<pre><textarea name="code" class="JScript" cols="60" rows="1"><style type="text/css">
.flying-label {
	position:absolute;
	border:1px solid blue;
	background-color:#99CCFF;
}
</style></textarea></pre>

	<p>Next, listen for a click anywhere on the page.  When that event happens, create (if necessary) the content you want to position and then, in line 11 below, use the combination of <a href="http://developer.yahoo.com/yui/dom">Dom</a> and <a href="http://developer.yahoo.com/yui/event">Event</a> to <code>getXY</code> using Event on the event object and feed those coordinates into a <code>setXY</code> on the new element using Dom.</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">	function init(){
		YAHOO.util.Event.addListener(document, 'click', fnClick);
	}
	function fnClick(e){
		var root = YAHOO.util.Dom.get("labels");
		var newDiv = document.createElement("div");
		var newText = document.createTextNode("appears adjacent to mouse position");
		newDiv.appendChild(newText);
		root.appendChild(newDiv);
		YAHOO.util.Dom.addClass(newDiv, "flying-label");
		YAHOO.util.Dom.setXY(newDiv, YAHOO.util.Event.getXY(e));
	}
	
	YAHOO.util.Event.addListener(window, 'load', init);
</textarea></pre>

<p>&mdash; <strong>Eric Miraglia</strong>, Yahoo Presentation Platform Engineering</p>
				
			<div id="labels"></div>
	
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
