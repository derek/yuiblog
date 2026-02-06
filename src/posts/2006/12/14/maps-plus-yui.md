---
layout: layouts/post.njk
title: "Using YUI with the Yahoo! Maps AJAX API"
author: "Eric Miraglia"
date: 2006-12-14
slug: "maps-plus-yui"
permalink: /blog/2006/12/14/maps-plus-yui/
categories:
  - "Development"
---
A [YUI Forum](http://tech.groups.yahoo.com/group/ydn-javascript/) contributor noted this week that he had encountered a slight hitch when including YUI components on the same page with the versatile (and [well-documented](http://developer.yahoo.com/maps/ajax/V3.4/reference.html)) [Yahoo! Maps AJAX API](http://developer.yahoo.com/maps/ajax/index.html) written by Yahoo! engineer Mirek Grymuza. The root of the issue is that the highest-level Maps AJAX API file seeks to include some YUI components on its own; this can cause problems if you're already including those components for your own application.

A future release of the Maps AJAX API will resolve this issue seamlessly; in the meantime, it's easy to use the Maps AJAX API with your own YUI implementation.

### The Workaround

1.  Don't use the Maps AJAX API's base include file (e.g., http://api.maps.yahoo.com/ajaxymap?v=3.4&appid=YourAppId). We'll replicate all of its steps here.
2.  Include all the YUI files that serve as dependencies for the Maps AJAX API. These are:
    
    -   [Yahoo Global Object](http://developer.yahoo.com/yui/yahoo/)
    -   [Dom Collection](http://developer.yahoo.com/yui/dom/)
    -   [Event Utility](http://developer.yahoo.com/yui/event/)
    -   [Drag & Drop Utility](http://developer.yahoo.com/yui/dragdrop/)
    -   [Animation Utility](http://developer.yahoo.com/yui/animation/)
    
    The recommended approach here is to include the combined `utilities.js` file that ships with the [YUI distribution](http://developer.yahoo.com/yui/download/) (in the `build/utilities` directory). This file will provide all of the above components in a single aggregate file (along with [Connection Manager](http://developer.yahoo.com/yui/connection/)) which weighs just 18.1KB gzipped on the wire. ([More on YUI and pageweight](/yuiblog/blog/2006/10/16/pageweight-yui0114/); [more on why reducing http requests is a Very Good Thing](/yuiblog/blog/2006/11/28/performance-research-part-1/).)
3.  The Maps AJAX API's base include file, which we're omitting, does three things:
    1.  Includes the necessary YUI components — you've done that already.
    2.  Sets a global variable, YMAPPID, to the value of your [application ID for the Yahoo! Maps API](http://api.search.yahoo.com/webservices/register_application).
    3.  Includes an additional script file, the current version of which is:  
        http://us.js2.yimg.com/us.js.yimg.com/lib/map/js/api/ymapapi\_3\_4\_1\_5.jsOnce you have the necessary YUI pieces on the page, you need to take these next two steps yourself.

### The Code:

<!--load YUI from your own install folder if possible; otherwise:-->  
<script type="text/javascript" src="http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/utilities\_2.1.0.js"> </script>  
  
<!--set your application ID variable:-->  
<script type="text/javascript">  
var YMAPPID = "YourAppId";  
</script>  
  
<!--Include core Maps AJAX API script:-->  
<script type="text/javascript"  
src="http://us.js2.yimg.com/us.js.yimg.com/lib/map/js/api/ymapapi\_3\_4\_1\_7.js"></script>

### The Result

Now you're set to use the Maps AJAX API per its [getting started guide](http://developer.yahoo.com/maps/ajax/index.html) and [advanced documentation](http://developer.yahoo.com/maps/ajax/V3.4/reference.html). That allows you to go above and beyond slickrock in Moab, Utah...#mapContainer { height: 300px; width: 100%; margin:0; padding:0;} /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

...with just a few lines of CSS, HTML, and JavaScript:

<style type="text/css">  
#mapContainer { height: 300px; width: 100%; }  
</style>

<div id="mapContainer"></div>

<script type="text/javascript">  
(function() {  
// Create a lat/lon object  
var myPoint = new YGeoPoint(38.589162,-109.534018);  
// Create a map object  
var map = new YMap(document.getElementById('mapContainer'));  
// Add a pan control  
map.addPanControl();  
// Add a slider zoom control  
map.addZoomLong();  
// Add map type control  
map.addTypeControl();  
// set type to SAT  
map.setMapType(YAHOO\_MAP\_HYB);  
// Display the map centered on a latitude and longitude  
map.drawZoomAndCenter(myPoint, 5);  
})();  
</script>

Piece of cake, right? Grab your bike, and I'll meet you [there](http://www.flickr.com/photos/tags/slickrock/clusters/utah-moab-bike/).

### Notes:

1.  This method spells out an explicit version number for the Maps AJAX API script (3\_4\_1\_7 as of today), whereas using the API directly allows the API authors to increment that version automatically.
2.  This approach suggests using different (newer) versions of YUI components than are currently tested and QA'd by the Yahoo! Maps team for use with the Maps AJAX API. Therefore, this approach pairs scripts that are presumed compatible but that have not been QA'd together.
3.  We expect to obsolete this approach with a subsequent release of the Maps AJAX API.