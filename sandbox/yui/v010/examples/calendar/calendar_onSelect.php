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
#formOutput {clear:left; padding-top:15px;}
</style>


<script>

/* Using Crockford's "Module Pattern" to stay out of the global namespace: */
YAHOO.example.calExample = function() {

	return {
		
		cal1: "",
		
		reportSelection: function() {
			document.forms.formOutput.textOutput.value = this.getSelectedDates().toString();	
		},
		
		updateTextField: function() {
			document.forms.formOutput.textOutput.value = YAHOO.example.calExample.cal1.getSelectedDates().toString();
		},
		
	
		init: function() {
		
			this.cal1 = new YAHOO.widget.Calendar("YAHOO.example.calExample.cal1","cal1Container"); 
			this.cal1.onSelect = this.reportSelection;			
			this.cal1.render (); 
		}

	}
} ();

YAHOO.util.Event.onAvailable("cal1Container", YAHOO.example.calExample.init, YAHOO.example.calExample, true);
</script>
<title>Calendar Example: Simple onSelect</title>
</head>
<body>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>Calendar Example: Simple onSelect</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> May 12, 2006</p>
					<p><strong>Component:</strong> Calendar</p>
					<p><strong>Version:</strong> v0.10.0</p>
				</div>
			    <div id="cal1Container"></div>
				<form id="formOutput">
					Text Field: <input type="text" size="45" id="textOutput">
				</form>
				<p id="clear">This example illustrates use of the <code>onSelect</code> method in a simple 1-up instance of the Calendar control.</p>
				
<p>Our first step is to instantiate a 1-up Calendar as per the usual means; our Calendar instance will live in a <code>div</code> whose id is <code>cal1Container</code>:</p>
				
<pre><textarea name="code" class="JScript" cols="60" rows="1">
this.cal1 = new YAHOO.widget.Calendar("YAHOO.example.calExample.cal1","cal1Container"); 			
this.cal1.render ();
</textarea></pre>

<p>Next, we'll write a method that will handle the logic for the <code>onSelect</code> event.  Here, we'll just assume that we want to grab the string value of the date from the date object; in practice, we'd often want to get month, day and year separately and reformat the date to suit our application (which we can do using the <a href="http://search.yahoo.com/search?&p=javascript date object">Date object</a>'s built-in functionality):</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">reportSelection = function() {
	document.forms.formOutput.textOutput.value = this.getSelectedDates().toString();	
}</textarea></pre>

<p>Once we've done that, we can hook up our <code>reportSelection</code> handler to serve as the <code>onSelect<code></code></code> handler for <code>cal1</code>:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">this.cal1.onSelect = this.reportSelection;			
this.cal1.render (); </textarea></pre>

<p>Using this approach, it takes just a single line of code to apply your own function to serve as the handler for this important moment in a Calendar control interaction.</p>

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
