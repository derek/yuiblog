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
#container {width:400px; padding:10px; border:1px dotted black;background-color:#CCCCCC;}
</style>
<script>

(function() {

//create log reader instance on pageload
function loggerInit() {
	var myLogReader = new YAHOO.widget.LogReader();
}
//on is an alias for addListener
YAHOO.util.Event.on(window, "load", loggerInit);

function clickHandler(e) {
	//get the resolved (non-text node) target:
	var elTarget = YAHOO.util.Event.getTarget(e);	
	//walk up the DOM tree looking for an <li>
	//in the target's ancestry; desist when you
	//reach the container div
	while (elTarget.id != "container") {
		//are you an li?
		if(elTarget.nodeName == "LI") {
			//yes, an li: so write out a message to the log
			YAHOO.log("The clicked li had an id of " + elTarget.id, "info", "clickExample");
			//and then stop looking:
			break;
		} else {
			//wasn't the container, but wasn't an li; so
			//let's step up the DOM and keep looking:
			elTarget = elTarget.parentNode;
		}
	}
}
//attach clickHandler as a listener for any click on
//the container div:
YAHOO.util.Event.on("container", "click", clickHandler);

function mouseHandler(e) {
	var elTarget = YAHOO.util.Event.getTarget(e);
	while (elTarget.id != "container") {
		if(elTarget.nodeName == "LI") {
			YAHOO.log("The li that was mousedover had an id of " + elTarget.id, "info", "mouseExample");
			break;
		} else {
			elTarget = elTarget.parentNode;
		}
	}
}
YAHOO.util.Event.on("container", "mouseover", mouseHandler);
	
})();

</script>
<title>Event Delegation Example</title>
</head>
<body>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>Event Delegation Example</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> October 22, 2006</p>
					<p><strong>Component:</strong> Event, Dom</p>
					<p><strong>Version:</strong> v0.11.4</p>
				</div>
				
				<div id="container">
					<ul id="list">
						<li id="li-1">List Item 1</li>
						<li id="li-2">List Item 2</li>
						<li id="li-3">List Item 3</li>
						<li id="li-4">List Item 4</li>
						<li id="li-5">List Item 5</li>
						<li id="li-6">List Item 6</li>
					</ul>
				</div>
				

 
				<p id="clear"><a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/5925">In this YDN-JavaScript post</a>, prizeloop asks whether &quot;event delegation&quot; &mdash; the use of a single event listener on a parent object to listen for events happening on its children (or deeper descendants) &mdash; works for mousemove events as well as, say, click events. This example illustrates the use of event delegation on both click and mouseover events.</p>
				
				<p>We'll start with some structural markup &mdash; a div containing a ul with <em>n</em> li children. </p>
				
				<pre><textarea name="code" class="HTML" cols="60" rows="1"><div id="container">
	<ul id="list">
		<li id="li-1">List Item 1</li>
		<li id="li-2">List Item 2</li>
		<li id="li-3">List Item 3</li>
		<li id="li-4">List Item 4</li>
		<li id="li-5">List Item 5</li>
		<li id="li-6">List Item 6</li>
	</ul>
</div></textarea></pre>

<p>We'll use the <a href="http://developer.yahoo.com/yui/logger/">YUI Logger Control</a> as the reporting mechanism for our event handlers, so this example begins its script by creating a LogReader instance and rendering it into the document body on pageload:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//create log reader instance on pageload
function loggerInit() {
	var myLogReader = new YAHOO.widget.LogReader();
}
//on is an alias for addListener
YAHOO.util.Event.on(window, "load", loggerInit);</textarea></pre>

<p>Now we'll add an event handler to the container div, listening for any clicks in that div's bounds.  We're only really interested in clicks on li's, though; when we get one of those, we'll write out a message to the Logger.</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">function clickHandler(e) {
	//get the resolved (non-text node) target:
	var elTarget = YAHOO.util.Event.getTarget(e);	
	//walk up the DOM tree looking for an <li>
	//in the target's ancestry; desist when you
	//reach the container div
	while (elTarget.id != "container") {
		//are you an li?
		if(elTarget.nodeName == "LI") {
			//yes, an li: so write out a message to the log
			YAHOO.log("The clicked li had an id of " + elTarget.id, "info", "clickExample");
			//and then stop looking:
			break;
		} else {
			//wasn't the container, but wasn't an li; so
			//let's step up the DOM and keep looking:
			elTarget = elTarget.parentNode;
		}
	}
}
//attach clickHandler as a listener for any click on
//the container div:
YAHOO.util.Event.on("container", "click", clickHandler);</textarea></pre>

<p>The same technique works for the <code>mousemove</code> event as well.  We'll substitute <code>mousemove</code> for <code>click</code>, but make no other substantive changes:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">function mouseHandler(e) {	
	var elTarget = YAHOO.util.Event.getTarget(e);	
	while (elTarget.id != "container") {
		if(elTarget.nodeName == "LI") {
			YAHOO.log("The li that was mousedover had an id of " + elTarget.id, "info", "mouseExample");
			break;
		} else {
			elTarget = elTarget.parentNode;
		}
	}
}
YAHOO.util.Event.on("container", "mouseover", mouseHandler);</textarea></pre>

<p>In this example, we've used two event listeners with their associated memory and performance load to serve as delegates for the same two events on six list items.  Instead of 12 event listeners, we now have two.  And the code works regardless of the number of li's used.  In a more complicated page context, it's easy to see how this technique can dramatically reduce the number of event listeners required and thereby improve the performance of your application.</p>

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
