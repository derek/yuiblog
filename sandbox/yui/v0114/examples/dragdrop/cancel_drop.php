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
#container {width:400px; padding:10px; border:1px dotted black;background-color:#CCCCCC; position:relative;}
.draggable {width:100px; padding:10px; border:1px solid black;background-color:#0099CC; color:#FFFFFF; margin-bottom:10px; position:relative; z-index:0;}
.beingDragged {z-index:100; border:1px solid red;}
</style>
<script>

//Create "DDSpecial" subclass with built-in animation
YAHOO.example.DDSpecial = function(id, sGroup, config) {
	YAHOO.log("constructor firing for " + id,"info","DDSpecial");
    if (id) {
        this.init(id, sGroup, config);
		
		//initialize placeholders for tracking
		//element position at drag start:
		this.startX = 0;
		this.startY = 0;
		
		//initialize "drop flag", which will tell us
		//in endDrag whether the dragged item was dropped
		//on a legitimate target:
		this.dropFlag = false;
		
		//create animation object; we'll add attributes
		//in endDrag:
		this.returnToStart = new YAHOO.util.Anim(id, {}, 0.5, YAHOO.util.Easing.easeBoth);
    }
};
//DDSpecial will inherit from YAHOO.util.DD:
YAHOO.example.DDSpecial.prototype = new YAHOO.util.DD();

//Capture position of dragged element at mousedown:
YAHOO.example.DDSpecial.prototype.onMouseDown = function(e) {
	YAHOO.log("onMouseDown firing for " + this.getEl().id,"info","DDSpecial");
	
	//get the true top and left properties of the
	//dragged element:
	this.startY = (this.getEl().style.top) || 0;
	this.startX = (this.getEl().style.left) || 0;
};

YAHOO.example.DDSpecial.prototype.startDrag = function(x,y) {
	YAHOO.log("startDrag firing for " + this.getEl().id,"info","DDSpecial");
	
	//At the beginning of the drag, we reset the drop
	//flag to false; we'll set it to true only
	//if onDragDrop fires (which indicates that
	//the drop happened on a legitimate target:
	this.dropFlag=false;
	YAHOO.util.Dom.addClass(this.getEl(), "beingDragged");
};


YAHOO.example.DDSpecial.prototype.onDragDrop = function(e,id) {
	YAHOO.log("onDragDrop firing for " + this.getEl().id,"info","DDSpecial");
	
	//The dragged element was dropped on a legitimate
	//target; we set the drop flag to true so that
	//the animation back to point of origin can be
	//skipped in endDrag:
	this.dropFlag=true;
};

YAHOO.example.DDSpecial.prototype.endDrag = function(e) {
	YAHOO.log("endDrag firing for " + this.getEl().id,"info","DDSpecial");
	
	//Was there a legitimate drop target?
	if(this.dropFlag==false) {
		//No legitimate drop, so animate
		//back to point of origin:
		YAHOO.log("animation in endDrag firing for " + this.getEl().id 
			+ "; startX: " + this.startX + "; startY: " + this.startY,
			"info","DDSpecial");
		//Set animation attributes, moving the dragged element
		//back to points of origin that we captured during the
		//onMouseDown method:
		this.returnToStart.attributes.top = {to: parseInt(this.startY)};
		this.returnToStart.attributes.left = {to: parseInt(this.startX)};
		//Fire the animation:
		this.returnToStart.animate();
	}
	YAHOO.util.Dom.removeClass(this.getEl(), "beingDragged");
};

//Wrap our initialization code in an anonymous function
//to keep out of the global namespace:
(function(){
	var init = function() {
		var exampleLogReader = new YAHOO.widget.LogReader();
		var tmpDD1 = new YAHOO.example.DDSpecial("drag1");
		var tmpDD2 = new YAHOO.example.DDSpecial("drag2");
		var tmpDD3 = new YAHOO.example.DDSpecial("drag3");
		var tmpDD1 = new YAHOO.util.DDTarget("container");
	}
	YAHOO.util.Event.addListener(window, "load", init);
})();
</script>
<title>Using Drag &amp; Drop with Animation</title>
</head>
<body> 

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>Using Drag &amp; Drop with Animation</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
				<div id="demoDetails">
					<p><strong>Date:</strong> October 26, 2006</p>
					<p><strong>Component:</strong>Drag &amp; Drop, Animation, Event, Dom</p>
					<p><strong>Version:</strong> v0.11.4</p>
				</div>
				
				<div id="container">
					<div id="drag1" class="draggable">Drag 1</div>
					<div id="drag2" class="draggable">Drag 2</div>
					<div id="drag3" class="draggable">Drag 3</div>
					<p>The blue boxes are draggable.  When dropped within the grey box, or upon one another, they will stay where they are dropped.  When they are dragged outside the grey box and not on top of one another they will animate back to their original position.</p>
				</div>
				

 
				<p id="clear">A common implementation pattern in Drag &amp; Drop (<a href="http://developer.yahoo.com/yui/dragdrop/">YUI</a>; <a href="http://developer.yahoo.com/ypatterns/parent.php?pattern=dragdrop">YPatterns</a>) requires the dragged element to return to its original position if it is not dropped on a legitimate drop target.  In many cases, <a href="http://developer.yahoo.com/yui/dragdrop/">Animation</a> should be applied to the dragged element to reinforce for the user that the drop was unsuccessful.  In this example, we'll create a simple subclass of <a href="http://developer.yahoo.com/yui/docs/dragdrop/YAHOO.util.DD.html"><code>YAHOO.util.DD</code></a> that bundles in this behavior.</p>
				
				<p>We'll begin by creating our subclass, <code>DDSpecial</code>.  This subclass will inherit from <code>YAHOO.util.DD</code> and so must replicate everything contained in that object's constructor (which we can find in the <a href="http://developer.yahoo.com/yui/docs/dragdrop/overview-summary-DD.js.html">source code for <code>YAHOO.util.DD</code></a>.  In the constructor, we'll add a few additional fields for <code>DDSpecial</code>:</p>
				
				<ol>
				  <li><strong>startX and startY:</strong> These fields will contain the origin points of the dragged element; we'll capture those during the <code>mouseDown</code> event that leads to a drag interaction.</li>
				  <li><strong>dropFlag:</strong> This boolean flag will tell us in <code>endDrag</code> whether a legitimate drop target was under the mouse when the dragged element was dropped; we'll initialize this to <code>false</code>.</li>
				  <li><strong>returnToStart:</strong> This will be our <a href="http://developer.yahoo.com/yui/docs/animation/YAHOO.util.Anim.html"><code>YAHOO.util.Anim</code></a> instance; we'll initialize it with a blank <code>attributes</code> object and set attributes in endDrag when we know the origin points to which we want to return.</li>
			  </ol>
			  
<pre><textarea name="code" class="JScript" cols="60" rows="1">//Create "DDSpecial" subclass with built-in animation
YAHOO.example.DDSpecial = function(id, sGroup, config) {
	YAHOO.log("constructor firing for " + id,"info","DDSpecial");
    if (id) {
        this.init(id, sGroup, config);
		
		//initialize placeholders for tracking
		//element position at drag start:
		this.startX = 0;
		this.startY = 0;
		
		//initialize "drop flag", which will tell us
		//in endDrag whether the dragged item was dropped
		//on a legitimate target:
		this.dropFlag = false;
		
		//create animation object; we'll add attributes
		//in endDrag:
		this.returnToStart = new YAHOO.util.Anim(id, {}, 0.5, YAHOO.util.Easing.easeBoth);
    }
};
//DDSpecial will inherit from YAHOO.util.DD:
YAHOO.example.DDSpecial.prototype = new YAHOO.util.DD();</textarea></pre>

				<p>Now that we have our subclass, we can extend its prototype by definining the interesting moments of Drag &amp; Drop as needed to achieve our desired behavior.  In this case, we can start by capturing the origin points of the dragged element during <code>onMouseDown</code>.  We do this <code>onMouseDown</code> rather than in <code>startDrag</code> because the element may have moved slightly by the time <code>startDrag</code> fires &mdash; by definition, <code>startDrag</code> commences as a result of a mousedown event in combination with the Drag &amp; Drop Manager's <code>clickTimeThresh</code> (default: 1 second) or <code>clickPixelThresh</code> (default: 3 pixels) having been exceeded.</p>
				
<pre><textarea name="code" class="JScript" cols="60" rows="1">//Capture position of dragged element at mousedown:
YAHOO.example.DDSpecial.prototype.onMouseDown = function(e) {
	YAHOO.log("onMouseDown firing for " + this.getEl().id,"info","DDSpecial");
	
	//get the true top and left properties of the
	//dragged element:
	this.startY = (this.getEl().style.top) || 0;
	this.startX = (this.getEl().style.left) || 0;
};</textarea></pre>

<p>The next step is to make sure that our <code>dropFlag</code> is set to false in <code>startDrag</code> and then set to true in the event that the dragged element is dropped on a target.  We know there was a successful drop, in this simple case, simply by tracking whether <code>onDragDrop</code> fires; if it does, we'll set the <code>dropFlag</code> to true, which will allow us to know in endDrag that we can leave the dragged element right where it was dropped.</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">YAHOO.example.DDSpecial.prototype.startDrag = function(x,y) {
	YAHOO.log("startDrag firing for " + this.getEl().id,"info","DDSpecial");
	
	//At the beginning of the drag, we reset the drop
	//flag to false; we'll set it to true only
	//if onDragDrop fires (which indicates that
	//the drop happened on a legitimate target:
	this.dropFlag=false;	
};


YAHOO.example.DDSpecial.prototype.onDragDrop = function(e,id) {
	YAHOO.log("onDragDrop firing for " + this.getEl().id,"info","DDSpecial");
	
	//The dragged element was dropped on a legitimate
	//target; we set the drop flag to true so that
	//the animation back to point of origin can be
	//skipped in endDrag:
	this.dropFlag=true;
};</textarea></pre>

<p>In endDrag, we'll simply check to see if the dropFlag is true; if it is, we do nothing.  If it's still false, then no drop target was involved and we'll animate the dragged element back to its points of origin.</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">YAHOO.example.DDSpecial.prototype.endDrag = function(e) {
	YAHOO.log("endDrag firing for " + this.getEl().id,"info","DDSpecial");
	
	//Was there a legitimate drop target?
	if(this.dropFlag==false) {
		//No legitimate drop, so animate
		//back to point of origin:
		YAHOO.log("animation in endDrag firing for " + this.getEl().id 
			+ "; startX: " + this.startX + "; startY: " + this.startY,
			"info","DDSpecial");
		//Set animation attributes, moving the dragged element
		//back to points of origin that we captured during the
		//onMouseDown method:
		this.returnToStart.attributes.top = {to: parseInt(this.startY)};
		this.returnToStart.attributes.left = {to: parseInt(this.startX)};
		//Fire the animation:
		this.returnToStart.animate();
	}
};</textarea></pre>

<p>All that remains is to initialize our draggable elements.  We'll do this in an anonymous function to keep everything out of the global namespace; because we've tied the <a href="http://developer.yahoo.com/yui/logger/">Logger Control</a> into this example, we'll put all of this into an onload handler and intialize after the page has loaded:</p>

<pre><textarea name="code" class="JScript" cols="60" rows="1">//Wrap our initialization code in an anonymous function
//to keep out of the global namespace:
(function(){
	var init = function() {
		var exampleLogReader = new YAHOO.widget.LogReader();
		var tmpDD1 = new YAHOO.example.DDSpecial("drag1");
		var tmpDD2 = new YAHOO.example.DDSpecial("drag2");
		var tmpDD3 = new YAHOO.example.DDSpecial("drag3");
		var tmpDD1 = new YAHOO.util.DDTarget("container");
	}
	YAHOO.util.Event.addListener(window, "load", init);
})();</textarea></pre>

<p>You'll find that most of your Drag &amp; Drop implementations require you to think through your interesting moments carefully and to provide custom logic for them.  However, this pattern of using a subclass to bundle in self-healing animations is one that we find ourselves using a great deal.</p>
				
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
