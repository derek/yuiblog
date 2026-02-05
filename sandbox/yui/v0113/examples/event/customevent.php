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
#container {width:400px; height:75px; padding:10px; border:1px dotted black;background-color:#CCCCCC;}
#resizer {width:200px; height:75px; background-color:#00CCFF;}
</style>
<script>

(function() {
	
	//create a new custom event, to be fired
	//when the resizer div's size is changed
	var onSizeChange = new YAHOO.util.CustomEvent("onSizeChange", this);
	
	//get local references to dom elements,
	//for convenience
	var container = YAHOO.util.Dom.get("container");
	var resizer = YAHOO.util.Dom.get("resizer");
	
	//when the container is clicked on, change the 
	//width of the resizer -- as long as it appears
	//to be a valid new size (>0).
	function fnClick(e){
		var containerX = YAHOO.util.Dom.getX("container");
		var clickX = YAHOO.util.Event.getPageX(e);
		var containerPadding = parseInt(YAHOO.util.Dom.getStyle("container","padding-left"), 10);
		var newWidth = clickX - containerX - containerPadding;
		
		if (newWidth > 0) {
			YAHOO.util.Dom.setStyle("resizer", "width", newWidth + "px");
			 //fire the custom event, passing
			 //the newWidth var in as an argument
			onSizeChange.fire(newWidth);
		}
	}
	
	//listen for clicks on the container
	YAHOO.util.Event.addListener("container", 'click', fnClick);

	//a handler to respond to the custom event that
	//we're firing when the resizer changes size; we'll
	//just report the new size to the subscriber div.
	fnSubscriber = function(type, args) {
		var subscriber = YAHOO.util.Dom.get("subscriber");
		var newMessage = "<strong>Custom Event fired:</strong>" +
			" the new size of the resizer div is " +
			args[0] + "px.<br>";
		subscriber.innerHTML = newMessage + subscriber.innerHTML;
	}
	
	//all that remains is to subscribe our subscriber
	//handler to the onResize custom event:
	onSizeChange.subscribe(fnSubscriber);
	
})();

</script>
<title>Custom Event Example: Simple Publisher and Subscriber</title>
</head>
<body>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>Custom Event Example: Simple Publisher and Subscriber</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> September 16, 2006</p>
					<p><strong>Component:</strong> Event, Dom</p>
					<p><strong>Version:</strong> v0.11.3</p>
				</div>
				
				<div id="container">
					<div id="resizer">
						Click anywhere within the grey box to resize me.
					</div>
				</div>
				<div id="subscriber"><strong>Subscriber Div:</strong> Size changes will be reported here.</div>
			   
				<p id="clear"><a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/4910">In this YDN-JavaScript post</a>, mattesid requests a simple example of using Custom Event, part of the <a href="http://developer.yahoo.com/yui/event/">YUI Event Utility</a>, to respond to changes in the size of a page element.</p>
				
				<p>In this example, we'll have a grey container div within which is a blue resizer div.  If you click in container, resizer will automatically resize to "x" position of your click.  When this happens, the click hander will fire a Custom Event, <code>onSizeChange</code>, which will let other components on the page know about the change.  We'll create one such component, a subscriber, that will write out to the subscriber div the new width of the resizer element.</p>

<p>Start with some simple CSS code for the appearing elements:</p>				
<pre><textarea name="code" class="JScript" cols="60" rows="1"><style type="text/css">
#container {width:400px; height:75px; padding:10px; border:1px dotted black;background-color:#CCCCCC;}
#resizer {width:200px; height:75px; background-color:#00CCFF;}
</style></textarea></pre>

	<p>Next, dive into the script, of which the important bits are explored below (view source for full script).  The script will also be quite simple, beginning with creating our Custom Event, which we'll fire when our click handler executes and changes the resizer's width.</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//create a new custom event, to be fired
//when the resizer div's size is changed
var onSizeChange = new YAHOO.util.CustomEvent("onSizeChange", this);</textarea></pre>
	
<p>Our click handler, to be fired when the grey container div is clicked on, looks like this; remember, it only fires the Custom Event if it seems like the click will result in a positive value for the resizer's new width &mdash; line 15 below is where we ultimately fire the Custom Event.</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//when the container is clicked on, change the 
//width of the resizer -- as long as it appears
//to be a valid new size (>0).
function fnClick(e){
	var containerX = YAHOO.util.Dom.getX("container");
	var clickX = YAHOO.util.Event.getPageX(e);
	//adjust for padding in container
	var containerPadding = parseInt(YAHOO.util.Dom.getStyle("container","padding-left"), 10);
	var newWidth = clickX - containerX - containerPadding;
	
	if (newWidth > 0) {
		YAHOO.util.Dom.setStyle("resizer", "width", newWidth + "px");
		 //fire the custom event, passing
		 //the newWidth var in as an argument
		onSizeChange.fire(newWidth);
	}
}</textarea></pre>

<p>We now have a Custom Event and are firing it at the right time, passing in the relevant data payload: the new width of the resizer div.  The last step is to create a function to respond to this change and then subscribe that function to our Custom Event, <code>onSizeChange</code>:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//a handler to respond to the custom event that
//we're firing when the resizer changes size; we'll
//just report the new size to the subscriber div.
fnSubscriber = function(type, args) {
	var subscriber = YAHOO.util.Dom.get("subscriber");
	var newMessage = "<strong>Custom Event fired:</strong>" +
		" the new size of the resizer div is " +
		args[0] + "px.<br>";
	subscriber.innerHTML = newMessage + subscriber.innerHTML;
}

//all that remains is to subscribe our subscriber
//handler to the onResize custom event:
onSizeChange.subscribe(fnSubscriber);</textarea></pre>

<p>This is a simple example of how to use Custom Events.  One of the powerful things about this concept is how far it can extend &mdash; obviously, we only have one subscriber here, but we could have from zero to <em>n</em> subscribers.  Moreover, Custom Events give you granular control over scope and firing order.  As a result of their flexibility and power, we find ourselves using Custom Events more and more as vehicles for exposing API functionality in YUI components.</p>

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
