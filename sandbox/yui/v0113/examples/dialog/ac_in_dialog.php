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
ol {margin-left:3em; list-style:decimal;}
#shower {width:15em; background-color:#0066FF; color:#FFFFFF; font-weight:bold; margin-bottom:1em; padding:1em;}
#myDialog .bd {position:relative;}
#myAC {position:relative; width:30em; overflow:visible;}
#myAC #myInput {position:relative;width:100%;display:block;}
#myAC #myContainer {position:relative;width:100%;}
#myAC #myContainer .yui-ac-content {position:absolute; width:100%; border:1px solid black;background-color:#ccc;z-index:9050; max-height:8em; overflow:auto;}
#myAC #myContainer .yui-ac-shadow {position:absolute; width:100%; background-color:grey; margin:.2em; z-index:9049;}
#myAC #myContainer ul {width:100%; list-style:none;}
#myAC #myContainer li.yui-ac-highlight {background:#ff0;}
#myAC #myContainer li.yui-ac-prehighlight {background:#ccc;}
#myAC ul {margin:0;}
</style>
<script>
YAHOO.namespace("example.ACinDialog");
YAHOO.example.ACinDialog = function() {
	var myACData = [
		"Alabama",
		"Alaska",
		"Arizona",
		"Arkansas",
		"California",
		"Colorado",
		"Connecticut",
		"Delaware",
		"Florida",
		"Georgia",
		"Hawaii",
		"Idaho",
		"Illinois",
		"Indiana",
		"Iowa",
		"Kansas",
		"Kentucky",
		"Louisiana",
		"Maine",
		"Maryland",
		"Massachusetts",
		"Michigan",
		"Minnesota",
		"Mississippi",
		"Missouri",
		"Montana",
		"Nebraska",
		"Nevada",
		"New Hampshire",
		"New Jersey",
		"New Mexico",
		"New York",
		"North Dakota",
		"North Carolina",
		"Ohio",
		"Oklahoma",
		"Oregon",
		"Pennsylvania",
		"Rhode Island",
		"South Carolina",
		"South Dakota",
		"Tennessee",
		"Texas",
		"Utah",
		"Vermont",
		"Virginia",
		"Washington",
		"West Virginia",
		"Wisconsin",
		"Wyoming"
	];
	return {
		init: function() {
			
			//create a new dialog, using existing markup on the page:
			var myDialog = new YAHOO.widget.Dialog("myDialog", {
				width:"40em",
				fixedcenter:true,
				visible:false
			});
			this.myDialog = myDialog;
			
			//instantiate AC before rendering Dialog
			myDs = new YAHOO.widget.DS_JSArray(myACData);
			myAc = new YAHOO.widget.AutoComplete("myInput","myContainer",myDs);

			//render dialog
			myDialog.render();

			YAHOO.util.Event.addListener("shower","click",myDialog.show,myDialog,true);

		}
	}
}();
YAHOO.util.Event.addListener(window,"load",YAHOO.example.ACinDialog.init, YAHOO.example.ACinDialog, true);
</script>
<title>Dialog: Using AutoComplete in a Dialog</title>
</head>
<body>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>Dialog: Using AutoComplete in a Dialog</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> September 19, 2006</p>
					<p><strong>Component:</strong> Dialog, AutoComplete</p>
					<p><strong>Version:</strong> v0.11.3</p>
				</div>
				
<div id="shower">Click here to show the Dialog.</div> 
	
<p>This example explores issues surrounding the placement of an <a href="http://developer.yahoo.com/yui/autocomplete/">AutoComplete</a> control within the context of a <a href="http://developer.yahoo.com/yui/container/dialog/">Dialog</a> control.</p>
<p>The primary issue you'll run into with this combination (or in any situation where AutoComplete resides within an <a href="http://developer.yahoo.com/yui/container/overlay/">Overlay</a> or <a href="http://developer.yahoo.com/yui/container/panel">Panel</a>) is the behavior when the AC suggestion container descends below the visible area in the Dialog body.  The AC suggestion container is absolutely positioned in most implementations, so it is not part of the Dialog body's dimensions (and won't, therefore, cause the dialog body to resize to fit it; as a result, overflow:hidden on the Dialog's containing div or on the Dialog's body will cause the AC suggestion container to be clipped  when it descends below the boundaries of the Dialog body.</p>
<p>This leaves two principal options for AC-in-Dialog implementations:</p>
<ol>
  <li><strong>Put the AC suggestion container in an Overlay</strong>: An AC suggestion container that is itself an Overlay, rendered into the body of the document, allows the container to float above the context of the Dialog and not be clipped by the Dialog's dimensions. <em>Disadvantage:</em> Because it's not part of the page flow within the Dialog, the Overlay solution will not automatically move with the Dialog during screen resize, font zoom, or <a href="http://developer.yahoo.com/yui/dragdrop/">Drag and Drop</a>. There are ways to account for these contingencies, but they add complexity.</li>
  <li><strong>Implement a standard AC suggestion container, leaving room in the Dialog for it to descend without overflowing the Dialog body:</strong> This is the solution I recommend. It allows for a contextual flow for the AC suggestion container and for the usual anchoring of the suggestion container to the input or text field with which it is associated. This anchoring holds automatically during drag, window resize, or font zoom. <em>Disadvantage</em>: This solution does not generally allow the AC suggestion container to descend beyond the boundaries of the Dialog. Care must be exercised in design to provide enough space for the suggestion container to descend to its maximum height without hitting the bottom edge of the dialog body. </li>
</ol>
<p>An implementation of the second option above appears on this page. Its CSS adopts the standard conventions for AC that appear in the <a href="http://developer.yahoo.com/yui/examples/autocomplete/">AC examples provided on YDN</a>. Overflow, by default set to hidden for the Dialog body class, is left at the default. </p>				
<pre><textarea name="code" class="JScript" cols="60" rows="1">#myDialog .bd {position:relative;}
#myAC {position:relative; width:30em; overflow:visible;}
#myAC #myInput {position:relative;width:100%;display:block;}
#myAC #myContainer {position:relative;width:100%;}
#myAC #myContainer .yui-ac-content {position:absolute; width:100%; border:1px solid black;background-color:#ccc;z-index:9050; max-height:8em; overflow:auto;}
#myAC #myContainer .yui-ac-shadow {position:absolute; width:100%; background-color:grey; margin:.2em; z-index:9049;}
#myAC #myContainer ul {width:100%; list-style:none;}
#myAC #myContainer li.yui-ac-highlight {background:#ff0;}
#myAC #myContainer li.yui-ac-prehighlight {background:#ccc;}
#myAC ul {margin:0;}
</textarea></pre>

<p>Markup for the Dialog encompasses the usual markup for an AutoComplete implementation.  Of course, a real-world implementation will include the form apparatus, labels, buttons, etc.</p>

<textarea name="code" class="HTML" cols="60" rows="1"><div id="myDialog">
	<div class="hd">My Dialog, Using AutoComplete on the Form Field</div>
	<div class="bd">
		<div id="myAC">
			<form action="ac_in_dialog.php" method="post" id="myForm">
				<input id="myInput" type="text">
				<div id="myContainer"></div>
			</form>
		</div>
		Lorem ipsum dolor sit amat...  
	</div>
</div></textarea>

<p>In our script, we instantiate the Dialog, then build the AC datasource and AC instance:</p>
			
<pre><textarea name="code" class="JScript" cols="60" rows="1">//create a new dialog, using existing markup on the page:
var myDialog = new YAHOO.widget.Dialog("myDialog", {
	width:"40em",
	fixedcenter:true,
	visible:false
});
this.myDialog = myDialog;

//instantiate AC before rendering Dialog
myDs = new YAHOO.widget.DS_JSArray(myACData);
myAc = new YAHOO.widget.AutoComplete("myInput","myContainer",myDs);

//render dialog
myDialog.render();

var myACData = [
	"Alabama",
	"Alaska",
	...
];

myDs = new YAHOO.widget.DS_JSArray(myACData);
myAc = new YAHOO.widget.AutoComplete("myInput","myContainer",myDs);
</textarea></pre>

<p>With this code in place, our in-Dialog AutoComplete is fully functional.</p>


<div id="myDialog">
	<div class="hd">My Dialog, Using AutoComplete on the Form Field</div>
	<div class="bd">
		<div id="myAC">
			<p>State:</p>
			<form action="ac_in_dialog.php" method="post" id="myForm">
				<input id="myInput" type="text">
				<div id="myContainer"></div>
			</form>
		</div>
		
		Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  Lorem ipsum dolor sit amat.  

	</div>
</div>


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
