<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset-fonts-grids/reset-fonts-grids.css"> 
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
<!-- Dependencies for DataTable -->
<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.3.1/build/datatable/assets/datatable.css">
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/element/element-beta-min.js"></script> 
<!-- OPTIONAL: Drag Drop (enables resizeable columns) -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/connection/connection-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/datasource/datasource-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/datatable/datatable-beta-min.js"></script>

<!-- Dependencies for Context Menu -->
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/menu/assets/menu.css">
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/container/container_core-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/menu/menu-min.js"></script><!-- End dependencies for Context Menu -->
<!-- End Dependencies for Context Menu -->

<!-- Dependencies for Autocomplete -->
<script type="text/javascript" src="http://yui.yahooapis.com/2.3.1/build/autocomplete/autocomplete-min.js"></script>
<!-- End dependencies for Autocomplete -->

<!-- Row filter and DataView -->
<script type="text/javascript" src="DataView.js" ></script>
<script type="text/javascript" src="RowFilter.js" ></script>

<script>
		/////////////////Example 1////////////////
function init(tableId) {
	var myFormatDate = function(elCell, oRecord, oColumn, oData) {
	    var oDate = oData;
		elCell.innerHTML = oDate.getMonth() + "/" + oDate.getDate()  + "/" + oDate.getFullYear();
    };
	
	var myColumnDefs = [
		{key:"POID", label:"Purchase order ID", sortable:true, resizeable:true },
        {key:"Date", formatter:myFormatDate, sortable:true, resizeable:true, hideable:true},
        {key:"Quantity", formatter:"number", sortable:true, resizeable:true,hideable:true},
        {key:"Amount", formatter:"currency", sortable:true, resizeable:true,hideable:true},
        {key:"Title", label:"Book Title",  sortable:true, resizeable:true,hideable:true}
	];
	
        
    // Point to a local or proxy URL
    var myDataSource = new YAHOO.util.DataSource("books.txt");
    // Set the responseType as JSON
    myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSON;
        
    // Define the data schema
    myDataSource.responseSchema = {
    resultsList: "bookorders", // Dot notation to results array
    fields: ["POID","Date","Quantity","Amount","Title"] // Field names
    };
     
    myDataTable = new YAHOO.widget.DataView(tableId, myColumnDefs, myDataSource,{});
	myDataTable.subscribe("initEvent",initFilter,myDataTable);
	
	/////////////////Example 2////////////////
	myDataTable2 = new YAHOO.widget.DataView("table2", myColumnDefs, myDataSource,{});
	
}

YAHOO.util.Event.onAvailable("table1", function(){init("table1")});  

function initFilter(oResp,oDataTable,c){
    var data= oDataTable.getRecordSet().getRecords()
    fnFilter= new YAHOO.dpu.util.StringFilter(data,"Title")
    fnFilter.maxCacheEntries = 0;
    oAutoComp = new YAHOO.dpu.widget.RowFilter('acInput1','acResult1', oDataTable,fnFilter);
    var ua = navigator.userAgent.toLowerCase();
    if(ua.indexOf('msie') != -1 && ua.indexOf('opera') < 0) {
        oAutoComp.useIFrame = true;    
    }
	oDataTable.unsubscribe("initEvent",initFilter)
} 

function changeFilter() {
    var s = document.getElementById("fs");
    var column= s.options[s.selectedIndex].value;
    fnFilter.schemaItem=column
    
}
</script>

<style type="text/css">
/* CSS FOR DataTable */
div.yui_datatable {margin:1em;}
div.yui_datatable table {border-collapse:collapse;}
div.yui_datatable th, div.yui_datatable td {border:1px solid #F1EFE2;padding:.25em; text-align:center; }
div.yui_datatable th {border-bottom:2px solid #D6D2C2; cursor:default;  font-family:arial;   font-size:8pt;  font-size-adjust:none; line-height:normal; background-color:#EBEADB;}
div.yui_datatable th img {border-style:none}
div.yui_datatable th a   {text-decoration:none; color:black; font-weight:normal}
div.yui_datatable th a:hover {text-decoration:underline; }  
div.yui_datatable em {font-style:italic;}
div.yui_datatable strong {font-weight:bold;}
div.yui_datatable .big {font-size:136%;}
div.yui_datatable .small {font-size:77%}
div.yui_datatable .yui-dt-sortedbyasc .yui-dt-headtext {background-image: url('../assets/sort_asc.gif'); background-repeat:no-repeat; background-position:right;}/*arrow up*/ 
div.yui_datatable .yui-dt-sortedbydesc .yui-dt-headtext {background-image: url('../assets/sort_desc.gif'); background-repeat:no-repeat; background-position:right;}/*arrow down*/
div.yui_datatable th .yui-dt-headtext {margin-right:5px;padding-right:15px;} /*room for arrow*/

/*CSS For Auto Complete*/
.ac {position:relative;padding:1em;}
.acF {position:relative;margin:1em;width:15em;}/* set width of widget here*/
.acInput {position:absolute;width:100%;height:1.4em;}
.acResult {position:absolute;top:1.7em;width:100%;}
.acResult .yui-ac-content {position:absolute;width:100%;height:11em;border:1px solid #404040;background:#fff;overflow:auto;overflow-x:hidden;z-index:9050;}
.acResult .yui-ac-shadow {position:absolute;margin:.3em;width:100%;background:#a0a0a0;z-index:9049;}
.acResult ul {padding:5px 0;width:100%;}
.acResult li {padding:0 5px;cursor:default;white-space:nowrap;}
.acResult li.yui-ac-highlight {background:#ff0;}

#doc {width:95%;}
</style>

<title>Row Filtering with DataTable and AutoComplete</title>
</head>

<body id="yahoo"><!-- id: optional property or feature signature -->
<div id="doc" class="yui-t1"><!-- possible values: t1, t2, t3, t4, t5, t6, t7 -->
	<div id="hd">
		<h1>Row Filtering with DataTable and AutoComplete</h1>
	</div>
	<div id="bd">

		<!-- start: primary column from outer template -->
		<div id="yui-main">
			<div class="yui-b">
			<div id="demoDetails">
					<p><strong>Date:</strong> September 18, 2007</p>
					<p><strong>Component:</strong>DataTable, AutoComplete</p>
					<p><strong>Version:</strong> v2.3.1</p>
			</div>

			<br/>
			<p style="color:orange;font-size:142%;font-weight:bold">Example using AutoComplete</p>	
			<div class="ac">
	        	<form >
		            <div class="yui_datatable" id="table1"></div>
		             <p style="font-weight:bold">Find an order by:
		             <select id="fs" onchange="changeFilter()">
		                <option value="POID">POID</option>
		                <option value="Title" selected="true">Title</option>
		            </select>
		             </p>
		            <div class="acF">
		                <input class="acInput" id="acInput1" />
		                <div class="acResult" id="acResult1"></div>
		            </div>
		            <br/><br/>
	           </form>
		    </div>				
			
			<p style="color:orange;font-size:142%;font-weight:bold">Example using a Filter button</p>	
			<br/>
			<p>The DataView class now has a method called Filter which receives as a parameters the string to search, and the column to look at:
			<br/><p style="padding-left:20px"> myDataTable.Filter('foo','Title'). </p><br/>
			Also the Filter function can be chained. For example try querying for "book", and then for "aloud" </p>
			<div class="yui_datatable" id="table2"></div>
<form>
    <div class="yui_datatable" id="table2"></div>
    <input id="queryInput" type="text" />
    <input type="button" value="Filter Title"
 onclick="myDataTable2.Filter(document.getElementById('queryInput').value,'Title')" /> 
     <input type="button" value="Clear Filters"                onclick="myDataTable2.ClearFilters()"  />
</form>
 			
				<p id="clear">This example is an update to <a href="http://yuiblog.com">Victor Morales's tutorial on subclassing DataTable</a>.</p>
				
				<p>&mdash; <strong>Eric Miraglia</strong>, YUI Library</p>	
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
