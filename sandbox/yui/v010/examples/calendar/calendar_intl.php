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

<script>

/* Using Crockford's "Module Pattern" to stay out of the global namespace: */
YAHOO.example.calExample = function() {

	return {
		
		cal1: "",
	
		init: function() {
		
			this.cal1 = new YAHOO.widget.Calendar("YAHOO.example.calExample.cal1","cal1Container"); 
		
			this.cal1.customConfig = function(){
				this.Config.Locale.MONTHS_SHORT = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun","Jul", "Ago", "Set", "Out", "Nov", "Dez"]; 
				this.Config.Locale.MONTHS_LONG = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio","Junho", "Julho", "Agosto", "Setembro",    "Outobro", "Novembro", "Dezembro"]; 
				this.Config.Locale.WEEKDAYS_1CHAR = ["D", "S", "T", "Q", "Q", "S", "S"];
				this.Config.Locale.WEEKDAYS_SHORT = ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa"]; 
				this.Config.Locale.WEEKDAYS_MEDIUM = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"];
				this.Config.Locale.WEEKDAYS_LONG = ["Domingo", "Segunda", "Terça", "Quarta","Quinta", "Sexta", "Sabado"];
				this.Config.Options.START_MONDAY = true;     
			};
			
			this.cal1.setupConfig();
			
			this.cal1.render (); 
		}

	}
} ();

YAHOO.util.Event.onAvailable("cal1Container", YAHOO.example.calExample.init, YAHOO.example.calExample, true);
</script>
<title>International Calendar Example</title>
</head>
<body>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>International Calendar Example</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> May 10, 2006</p>
					<p><strong>Component:</strong> Calendar</p>
					<p><strong>Version:</strong> v0.10.0</p>
				</div>
			    <div id="cal1Container"></div>
				<p id="clear">This example illustrates an implementation of a simple 1-up calendar with display names for month and day internationalized.  The <a href="http://groups.yahoo.com/group/ydn-javascript/message/1151">original request for this example</a> included a code sample that got very close to the solution.  In that code sample, the author posted code that created the calendar instance (<code>cal1</code>) and configured its <code>Locale</code> object as follows:</p>
				
<pre><textarea name="code" class="JScript" cols="60" rows="1">this.cal1.customConfig = function(){
	this.Config.Locale.MONTHS_SHORT = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun","Jul", "Ago", "Set", "Out", "Nov", "Dez"]; 
	this.Config.Locale.MONTHS_LONG = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio","Junho", "Julho", "Agosto", "Setembro",    "Outobro", "Novembro", "Dezembro"]; 
	this.Config.Locale.WEEKDAYS_1CHAR = ["D", "S", "T", "Q", "Q", "S", "S"];
	this.Config.Locale.WEEKDAYS_SHORT = ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa"]; 
	this.Config.Locale.WEEKDAYS_MEDIUM = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"];
	this.Config.Locale.WEEKDAYS_LONG = ["Domingo", "Segunda", "Terça", "Quarta","Quinta", "Sexta", "Sabado"];
	this.Config.Options.START_MONDAY = true;     
};</textarea></pre>

<p><strong>Note:</strong> Currently, one of our examples illustrates modifing the <code>customConfig</code> member on the <em>instance's prototype</em> (as in <code>this.cal1.prototype.customConfig = ...</code> in line 1 above; this is incorrect, and you should modify the customConfig member directly on the instance).</p>

<p>In the current version of Calendar, one more step is required after defining <code>customConfig</code>, and that step involves applying the configuration to your instance.  It's an additional step that we'll remove in a future version, but for now the solution is quite simple &mdash; just apply the include the folloiwng line of code prior to rendering:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">this.cal1.setupConfig();
this.cal1.render (); </textarea></pre>

<p>The call to setupConfig will apply your changes and you'll see those reflected in the calendar when it renders.</p>

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
