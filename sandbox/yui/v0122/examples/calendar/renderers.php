<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Updateable Renderers</title>

   <link rel="stylesheet" type="text/css" href="../../build/reset-fonts-grids/reset-fonts-grids.css">

   <script type="text/javascript" src="../../build/yahoo/yahoo.js"></script>  
   <script type="text/javascript" src="../../build/dom/dom.js"></script>  
   <script type="text/javascript" src="../../build/event/event.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../../build/calendar/assets/calendar.css">
	<script type="text/javascript" src="../../build/calendar/calendar.js"></script>
	
	<style>
		BODY {text-align:left}
	</style>
</head>
   <body>
		<button id="btn">Download New Dates</button>
		<div id="cal1Container"></div>
		
      <script type="text/javascript">
      	//
      	// - This is the central set of dates which need special treatment. Namespace as appropriate 
			// - If you have more individual dates than ranges, you can change the object structure to something more suitable
			// 
	      var HIGHLIGHT_DATE_HASH = {
	               2007 : {  1:{from:1, to:5},   	// Dates to highlight in JAN - 1st to 5th
	                         2:{from:10, to:15}, 	// Dates to highlight in FEB
	                         3:{from:15, to:20}		// Dates to highlight in APR
								 }, 	
	               2008 : {  1:{from:1, to:5},
	                         2:{from:4, to:9}
								 }
	      };
				 
           
         function initCal() {
             var cal1 = new YAHOO.widget.Calendar("cal1","cal1Container", {pagedate:"2/2007"});

				 function updateDateStructure() {
				 		// 
						// This would come from your XHR call.
						// 
				 		HIGHLIGHT_DATE_HASH = {
                     2007 : {  1:{from:12, to:16},   	// New Dates to highlight in JAN - 12th to 16th
                               2:{from:17, to:20}, 	// New Dates to highlight in FEB
                               4:{from:2, to:14}  		// New Dates to highlight in APR
									  } 	
						};
						cal1.render();
				 }
            
				 // The Custom Renderer only needs to be attached once (per month).
				 // It looks at the HIGHLIGHT_DATE_HASH to figure out which dates need highlighting
             var customHighlightRenderer = function(workingDate, cell)
             {
                 var isHighlighted = false;
                
                 var yr = HIGHLIGHT_DATE_HASH[workingDate.getFullYear()];
                 if (yr) {
                     var month = yr[workingDate.getMonth()+1];
                     if (month){
                         var fromDate = month.from;
                         var toDate = month.to;
                         var date = workingDate.getDate();
                          
                         if (date >= fromDate && date <= toDate) {
                             isHighlighted = true;
                         }
                     }
                 }
                
                 if (isHighlighted) {
                     YAHOO.util.Dom.addClass(cell, this.Style.CSS_CELL_HIGHLIGHT4);
                 }
             };
            
             for (var i = 1; i <= 12; i++) {
				 	// Attach to the MONTH, instead of individual dates, to improve performance.
                cal1.addMonthRenderer(i, customHighlightRenderer);
             }
             cal1.render();
				 
				 YAHOO.util.Event.addListener("btn", "click", updateDateStructure);
         }
			YAHOO.util.Event.addListener(window, "load", initCal);
		</script>		
   </body>
</html>