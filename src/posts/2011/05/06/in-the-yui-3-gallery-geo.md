---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Geo"
author: "Nicholas C. Zakas"
date: 2011-05-06
slug: "in-the-yui-3-gallery-geo"
permalink: /blog/2011/05/06/in-the-yui-3-gallery-geo/
categories:
  - "Development"
---
Geolocation is one of the more exciting HTML5-related technologies to appear in browsers, and the [Geo](http://yuilibrary.com/gallery/show/geo) Gallery module gives you access to location information. The [W3C Geolocation API](http://dev.w3.org/geo/api/spec-source.html) provides a simple interface to access the user's location from JavaScript. The following code accesses the user's current location in a supporting browser:
```
navigator.geolocation.getCurrentPosition(function(result) {
    //success handler
}, function (result){
    //failure handler
})
```
When this code is executed, the browser pops up a message asking for the user's permission to reveal their current location. The dialog displayed in Firefox looks like this: ![Geolocation dialog in Firefox](/yuiblog/blog/wp-content/uploads/2011/05/geo.png) If the user denies permission, or an error occurs while trying to get the current position, the failure handler is called. Otherwise, the success handler is called with information about the current location. That information comes in the form of latitude and longitude coordinates (other information may be available as well, depending on the implementation). The W3C Geolocation API is supported in Internet Explorer 9+, Firefox 3.5+, Safari 5+, Chrome, and Opera 10.6 as well as on Mobile Safari and Webkit on Android, making it fairly ubiquitous. The Geo module uses the Geolocation API when it's available, and falls back to an IP-based lookup via the YQL [pidgets.geoip](http://geoip.pidgets.com/) open table when not available or if there is an error. This table is exceptionally useful because you can lookup location information for a specific IP address, or you can omit the IP address and it will return the location information for the IP address making the request. The latter part ensures that you need to make only one request to get location information instead of two (other solutions use one to get the IP address and then one to get the location information for that IP address). In typical YUI fashion, the Geo module provides a streamlined interface for accessing geolocation information. Instead of providing two callback functions, one for success and one for failure, just pass in one. The result object has a `success` property indicating if the call succeeded:
```
YUI({
    gallery: 'gallery-2011.04.27-17-14'
}).use('gallery-geo', function(Y) {
 
    Y.Geo.getCurrentLocation(function(response){
 
        //check to see if it was successful
        if (response.success){
            console.log(response.coords.latitude);
            console.log(response.coords.longitude);
        }
 
    });
 
});
```
When a geolocation call completes successfully, the `success` property is true and `response.coords` is filled with at least two properties: `latitude` and `longitude` (if the native API is used, then all available properties are copied to this object). There is also a `source` property on the response object that is either "native", if the information was retrieved from the native API, or "pidgets.geoip", if it was retrieved by YQL. If an error occurs, or if the user declines to provide location information, then `success` is false. If the Geolocation API has an error, the Geo module will try IP-based lookup instead. If, however, the user declines to provide information, the IP-based lookup is not performed. Keep in mind that the native API is much more accurate than IP location, so you won't get the same quality results in browsers without native geolocation support. However, the Geo module is a good first step to providing location-based experiences to your users.