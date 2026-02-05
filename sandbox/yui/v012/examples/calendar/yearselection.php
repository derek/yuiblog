<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Selecting Years in the Calendar Control</title>
   

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
   #doc { width: 85%; min-width: 950px; }
   </style>
<style type="text/css">
#calendarcontrol {text-align:center;}
#yearcontrols {position:relative; width:100%; clear:left; zoom:1; padding:3px;}
#yearcontrols:after {content:'.';visibility:hidden;clear:left;height:0;display:block;}
#yearcontrols a:hover {background-color:#f7f9fb; color:#000;}
#yearselect, #yearform {display:inline;}
#yearnav {position:relative; display:inline;}
</style>
<script>

//Wrap our initialization code in an anonymous function
//to keep out of the global namespace:
(function(){
	var init = function() {
		var myCal = new YAHOO.widget.CalendarGroup("newcalelement",
			"calendarcontrol",
			{
			  mindate: "1/1/1963",
			  maxdate: "12/31/2019" }
			);
		
		var syncyear = function(type) {
			//update the select menu to verify that we're displaying
			//the correct year
			YAHOO.util.Dom.get("yearselect").value = parseInt(
				myCal.pages[0].getDateByCellId("newcalelement_0_cell17").getFullYear()
			);
		}
		myCal.renderEvent.subscribe(syncyear);
		myCal.render();

		YAHOO.util.Dom.get("calendarcontrol").appendChild(YAHOO.util.Dom.get("wrapper"));
		
		var changeYear = function() {
			myCal.setYear(parseInt(YAHOO.util.Dom.get("yearselect").value));
			myCal.render();
		}
		YAHOO.util.Event.addListener("yearselect", "change", changeYear);
		
		var prevyear = function(e) {
			//console.log("previous year firing");
			if (myCal.pages[0].getDateByCellId("newcalelement_0_cell17").getFullYear() > 1963) {
				myCal.previousYear();
			}
		}
		YAHOO.util.Event.addListener("prevyear", "click", prevyear);

		
		var nextyear = function(e) {
			//console.log("next year firing");
			if (myCal.pages[0].getDateByCellId("newcalelement_0_cell17").getFullYear() <2019) {
				myCal.nextYear();
			}
		}
		YAHOO.util.Event.addListener("nextyear", "click", nextyear);
		
	}
	YAHOO.util.Event.onContentReady("yearcontrols", init);
})();
</script>


</head>
<body>
<div id="doc" class="yui-t3">
   <div id="hd"><h1>Selecting Years in the Calendar Control</h1></div>
   <div id="bd">
	<div id="yui-main">
	<div class="yui-b"><div class="yui-g">
				<div id="demoDetails">
					<p><strong>Date:</strong> December 5, 2006</p>
					<p><strong>Component:</strong>Calendar</p>
					<p><strong>Version:</strong> v0.12.0</p>
				</div>
				
				<div id="calendarcontrol">
					<!--Calendar Control will be rendered here-->
				</div>	
				<div id="wrapper">				
					<div id="yearcontrols">
						<div id="yearnav">
							
							<form id="yearform" action="#">
								<a id="prevyear"><img src="http://us.i1.yimg.com/us.yimg.com/i/us/tr/callt.gif"></a> <select name="yearselect" id="yearselect">
<option value='1963'>1963</option>
<option value='1964'>1964</option>
<option value='1965'>1965</option>
<option value='1966'>1966</option>
<option value='1967'>1967</option>
<option value='1968'>1968</option>
<option value='1969'>1969</option>
<option value='1970'>1970</option>
<option value='1971'>1971</option>
<option value='1972'>1972</option>
<option value='1973'>1973</option>
<option value='1974'>1974</option>
<option value='1975'>1975</option>
<option value='1976'>1976</option>
<option value='1977'>1977</option>
<option value='1978'>1978</option>
<option value='1979'>1979</option>
<option value='1980'>1980</option>
<option value='1981'>1981</option>
<option value='1982'>1982</option>
<option value='1983'>1983</option>
<option value='1984'>1984</option>
<option value='1985'>1985</option>
<option value='1986'>1986</option>
<option value='1987'>1987</option>
<option value='1988'>1988</option>
<option value='1989'>1989</option>
<option value='1990'>1990</option>
<option value='1991'>1991</option>
<option value='1992'>1992</option>
<option value='1993'>1993</option>
<option value='1994'>1994</option>
<option value='1995'>1995</option>
<option value='1996'>1996</option>
<option value='1997'>1997</option>
<option value='1998'>1998</option>
<option value='1999'>1999</option>
<option value='2000'>2000</option>
<option value='2001'>2001</option>
<option value='2002'>2002</option>
<option value='2003'>2003</option>
<option value='2004'>2004</option>
<option value='2005'>2005</option>
<option value='2006'>2006</option>
<option value='2007'>2007</option>
<option value='2008'>2008</option>
<option value='2009'>2009</option>
<option value='2010'>2010</option>
<option value='2011'>2011</option>
<option value='2012'>2012</option>
<option value='2013'>2013</option>
<option value='2014'>2014</option>
<option value='2015'>2015</option>
<option value='2016'>2016</option>
<option value='2017'>2017</option>
<option value='2018'>2018</option>
<option value='2019'>2019</option>								</select> <a id="nextyear"><img src="http://us.i1.yimg.com/us.yimg.com/i/us/tr/calrt.gif"></a>
							</form>
							
						</div>
					</div>
				</div>
				

 
				<p id="clear">The YUI <a href="http://developer.yahoo.com/yui/calendar/">Calendar Control</a>'s default user interface is tailored for a specific interaction pattern: date selection of one or more dates that are localized within the span of a few months.  As such, it provides month-by-month navigation but not year-by-year navigation.  This UI is suitable for its intended use case but not for use cases wherein users will be selecting dates that are widely spaced across many months or years.</p>
				
				<p>The Calendar Control can easily be configured to provide alternative interfaces that allow for quick year-selection; this example explores the construction of one such interface.</p>
				
				<p>In this example, we'll use a simple <code>&lt;select&gt;</code> menu to allow for the selection of a specific year across a wide range (1963-2019). We'll include navigation arrows to the left and right of the <code>&lt;select&gt;</code> to provide year-by-year clickthrough in that same  range. Here is our markup for the navigation control: </p>
				
				
<pre><textarea name="code" class="JScript" cols="60" rows="1"><a id="prevyear"><img src="http://us.i1.yimg.com/us.yimg.com/i/us/tr/callt.gif"></a>
<select name="yearselect" id="yearselect">
<option value='1963'>1963</option>
...
<option value='2019'>2019</option>
</select>
<a id="nextyear"><img src="http://us.i1.yimg.com/us.yimg.com/i/us/tr/calrt.gif"></a></textarea></pre>

<p>Next, we instantiate a <a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.CalendarGroup.html">CalendarGroup</a> whose <code><a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.Calendar.html#mindate">mindate</a></code> and <code><a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.Calendar.html#maxdate">maxdate</a></code> configurations match our intended range:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">var myCal = new YAHOO.widget.CalendarGroup("newcalelement",
	"calendarcontrol",
	{
	  mindate: "1/1/1963",
	  maxdate: "12/31/2019" }
	);
</textarea></pre>

<p>We need a function that will keep our <code>&lt;select&gt;</code> menu in sync with the year displayed on the first page of our two-page CalendarGroup. We can do that by monitoring the <code><a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.Calendar.html#renderEvent">renderEvent</a></code>, which fires when the calendar is initially displayed and when a user pages to a new calendar month; we'll check an arbitrary date in the middle of the first page (cell 17, in this case) and set our <code>&lt;select&gt;</code> menu to the appropriate year whenever the page changes: </p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//our syncing function:
var syncyear = function(type) {
	//update the select menu to verify that we're displaying
	//the correct year
	YAHOO.util.Dom.get("yearselect").value = parseInt(
		myCal.pages[0].getDateByCellId("newcalelement_0_cell17").getFullYear()
	);
}
//we sync whenever the calendar renders:
myCal.renderEvent.subscribe(syncyear);
myCal.render();</textarea></pre>

<p>When the user selects a new year using the <code>&lt;select&gt;</code> menu, we need to navigate to that year; we do that using the Calendar Control's <code><a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.Calendar.html#setYear">setYear()</a></code> method (which works both for Calendar and for CalendarGroup). We create a function to listen for a change in the <code>&lt;select&gt;</code>; when that event fires we simply set the year to the <code>&lt;select&gt;</code> field's new value. </p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">var changeYear = function() {
	//get the value of the <select> menu as an integer, send to setYear:
	myCal.setYear(parseInt(YAHOO.util.Dom.get("yearselect").value));
	//have to rerender to make this visible:
	myCal.render();
}
//wire up the change event using Event Utility:
YAHOO.util.Event.addListener("yearselect", "change", changeYear);</textarea></pre>

<p>We can wire up our "next year" button using Calendar's <code><a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.Calendar.html#nextYear">nextYear()</a></code> method.  We'll write a quick check and only do the navigation if we're not at the end of our prescribed range.  Here's the code for navigating forward; going backward, of course, is very similar (uses <code><a href="http://developer.yahoo.com/yui/docs/YAHOO.widget.Calendar.html#previousYear">previousYear()</a></code> instead).</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">var nextyear = function(e) {
	//check the current year of the first month page; if we're
	//already at the end of our range, then do nothing. Otherwise,
	//navigate forward:
	if (myCal.pages[0].getDateByCellId("newcalelement_0_cell17").getFullYear() <2019) {
		myCal.nextYear();
	}
}
YAHOO.util.Event.addListener("nextyear", "click", nextyear);</textarea></pre>

<p>In this example, we have some additional markup containing the navigation controls and an extra step where we append those controls to the Calendar's DOM structure once it has been rendered.  In a more advanced implementation, we could subclass Calendar to build in these behaviors.  But the pieces above illustrate some of the strategies you can use to wire year-navigation into your existing Calendar implementation.</p>
				
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