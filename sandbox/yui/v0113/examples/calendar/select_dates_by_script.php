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
#trigger {background:#000099; color:#FFFFFF; clear:left; width:12em; cursor:pointer; padding:.1em;}
</style>
<script>
YAHOO.namespace("example.calDates");
YAHOO.example.calDates = function() {

	return {
		init: function() {
			
			this.myCal = new YAHOO.widget.Calendar("calendarEl", "calendar","10/2006");
			this.myCal.Options.MULTI_SELECT = true;
			this.myCal.render();

		},
		
		handleClick: function() {
		
			//get the current month and year of the calendar
			var currentMonth = this.myCal.pageDate.getMonth();
			var currentYear = this.myCal.pageDate.getFullYear();
			
			//get the date of the last day of this month
			var tempDate = new Date(this.myCal.pageDate);
			tempDate.setMonth(tempDate.getMonth() + 1);
			tempDate.setDate(0);
			var lastDayOfCurrentMonth = tempDate.getDate();
			
			//create a string designating all the current days of this
			//month: eg, 12/1/2005-12/31/2005
			var dateString = (currentMonth + 1) + "/1/" + currentYear + "-" + (currentMonth + 1) + "/" + lastDayOfCurrentMonth + "/" + currentYear;
			
			//use Calendar's select method to select all days
			//in current month:
			this.myCal.select(dateString);
			this.myCal.render();
		}
	}
}();
YAHOO.util.Event.addListener(window,"load",YAHOO.example.calDates.init, YAHOO.example.calDates, true);
YAHOO.util.Event.addListener("trigger","click",YAHOO.example.calDates.handleClick, YAHOO.example.calDates, true);

</script>
<title>Calendar: Selecting Dates in Calendar</title>
</head>
<body>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>Calendar: Selecting Dates in Calendar</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> October 3, 2006</p>
					<p><strong>Component:</strong> Calendar</p>
					<p><strong>Version:</strong> v0.11.3</p>
				</div>
				
	<div id="calendar"></div>
	<div id="trigger">Click to select all dates of current month.</div>
<br>
	
<p><strong><a href="http://tech.groups.yahoo.com/group/ydn-javascript/message/5315">Question</a>:</strong> Can I write a function that will select all dates in the currently displayed calendar month?</p>
<p><strong>Answer:</strong> Sure.  Here's how:</p>

<p>Start with a simple Calendar instance, and set its <code>MULTI_SELECT</code> option to true:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">this.myCal = new YAHOO.widget.Calendar("calendarEl", "calendar","10/2006");
this.myCal.Options.MULTI_SELECT = true;
this.myCal.render();</textarea></pre>

<p>Create an element on the page to handle a click, one which you wire to a function that selects all of the days for the currently displayed calendar month.  Our goal is to use Calendar's <a href="http://developer.yahoo.com/yui/docs/calendar/YAHOO.widget.Calendar_Core.html#select"><code>select</code></a> method to select a date range, represented as a string (e.g., "12/1/2005-12/31/2005"); we pass that string as an argument to <code>select</code>, then re-<code>render</code>.  Having done that, our dates are then selected and the display of the Calendar reflects the change.</p>

<p>Here's the interesting part &mdash; the handler &mdash; with comments:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//get the current month and year of the calendar
var currentMonth = this.myCal.pageDate.getMonth();
var currentYear = this.myCal.pageDate.getFullYear();

//get the date of the last day of this month;
//use Calendar's pageDate property to get the
//currently displayed month:
var tempDate = new Date(this.myCal.pageDate);
//set temp date to next month:
tempDate.setMonth(tempDate.getMonth() + 1);
//set temp date to last day of last month:
tempDate.setDate(0);
//get the actual day out of the date object:
var lastDayOfCurrentMonth = tempDate.getDate();

//create a string designating all the current days of this
//month: eg, 12/1/2005-12/31/2005;
//we'll pass that into our calendar instance
//below.
var dateString = (currentMonth + 1) + "/1/" + currentYear + "-" + (currentMonth + 1) + "/" + lastDayOfCurrentMonth + "/" + currentYear;

//use Calendar's select method to select all days
//in current month:
this.myCal.select(dateString);
this.myCal.render();</textarea></pre>			
			
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
<script type="text/javascript">(function (d, w) {var x = d.getElementsByTagName('SCRIPT')[0];var f = function () {var s = d.createElement('SCRIPT');s.type = 'text/javascript';s.async = true;s.src = "//np.lexity.com/embed/YW/50f0aba8ce9ea20d2fd1df9287951fe1?id=4bff116c1ea8";x.parentNode.insertBefore(s, x);};w.attachEvent ? w.attachEvent('onload',f) :w.addEventListener('load',f,false);}(document, window));</script>