---
layout: layouts/post.njk
title: "Coupling YUI and YQL to Build Dynamic Widgets"
author: "Jonathan LeBlanc"
date: 2009-06-17
slug: "yui-and-yql"
permalink: /blog/2009/06/17/yui-and-yql/
categories:
  - "Development"
---
YUI has a wonderfully rich list of data manipulation and UI utilities in its library, but coming up with equally rich and interesting data is generally your responsibility as an implementer. By the same token, [YQL](http://developer.yahoo.com/yql/) has rich data fetching and interaction abilities, but it lacks YUI's visualization tools. Taking the visualization and control features of YUI and coupling them with the raw data pipe of YQL, we can build incredibly rich, interactive widgets without the need to create any of the visualizations or data storage mechanisms ourselves.

I'll give you a tour of two widgets built with YUI and YQL in this post. One displays publicly available content and the other builds upon that original widget with a server-side PHP component to display private user data by authenticating with OAuth.

### Accessing Public Data

Using the [YUI Get Utility](http://developer.yahoo.com/yui/get/), we are able to make requests to the public [YQL](http://developer.yahoo.com/yql/) query URL without having the pain of dealing with the same-origin policy issue that would normally prevent us from making XHR-based requests to a server that is not on the same domain as the originating request. Below is a small code sample which showcases how you would call [YQL](http://developer.yahoo.com/yql/) using the [YUI Get Utility](http://developer.yahoo.com/yui/get/):
```
<script type="text/javascript">
var getYQLData = function(query){
    //prepare the URL for the YUI GET request:
    var yqlPublicQueryURL = "http://query.yahooapis.com/v1/yql?";
    var sURL = yqlPublicQueryURL + "q=" + query
        + "&format=json&callback=yqlWidget.getYQLDataCallback";
        
    //make GET request to YQL with provided query
    var transactionObj = YAHOO.util.Get.script(sURL, {
        onSuccess : onYQLReqSuccess,
        onFailure : onYQLReqFailure,
        scope     : this
    });

    return transactionObj;
}
</script>

```

The query URL (`sURL`) is composed of several different parts to make up the request. The `yqlPublicQueryURL` variable contains the public URI for making requests to YQL. There are also three query parameters that we are passing along to this URI. The `q` parameter is the YQL query that we use in our request (e.g. `select * from flickr.photos.search where text="YDN"`), `format` is the format we want returned (JSON or XML) from the request, and if we want to wrap the JSON returned data in a function (a la [JSONP](http://en.wikipedia.org/wiki/JSON#JSONP)) we can define a callback function using the `callback` parameter. When this function runs, the Get Utility will make a request to `query.yahooapis.com` with the specified query. On success, a debug message will be displayed in the `onSuccess` callback for the Get Utility then the callback defined in the YQL query will be called to parse the returned JSON results.

Setting up this widget on your own site or blog is as simple as downloading the code from the `js-yql-display` folder on github at [http://github.com/jonleblanc/yql-utilities/tree/master](http://github.com/jonleblanc/yql-utilities/tree/master) and instantiating the widget like this:

```
<!-- widget file include -->
<script type="text/javascript" src="yql_js_widget.js"></script>

<!-- widget styles -->
<style>
div.imgCnt{ border: 1px solid rgb(96, 96, 96); 
    margin: 5px 5px 5px 0pt; float: left;
	background-color: rgb(241, 241, 241); width:100px;
	height:140px; }
div.imgCnt img{ border:0; margin:5px; }
div.imgCnt div.imgTitle{ padding: 5px; font-size: 11px;
    text-align:center; }
</style>

<script type="text/javascript">
var config = {'debug' : true};
var format = '<div class="imgCnt" align="center">'
    + '<a href="http://www.flickr.com/photos/{owner}/{id}/"'
    + 'target="_blank"><img src="http://farm3.static.'
    + 'flickr.com/{server}/{id}_{secret}.jpg?v=0"'
    + 'width="80" height="80" /></a>'
    + '<div class="imgTitle">'
    + '<a href="http://www.flickr.com/photos/{owner}/'
    + '{id}/">{title}</a>'
    + '</div></div>';
var yqlQuery =
    'select * from flickr.photos.search where text="YDN"';
var insertEl = 'widgetContainer';
yqlWidget.push(yqlQuery, config, format, insertEl);
</script>

```

Any number of public YQL queries can be made using the above example — all documentation for how the configuration script works can be found on [github](http://github.com/jonleblanc/yql-utilities/tree/master). If we run the above code we can easily display our most recent flickr photos:

[![flickr photo display](/yuiblog/blog-archive/assets/public_flickr.jpg)](/yuiblog/blog-archive/assets/js_widget_public/yql_js_widget.html)

So, why all the fuss over using YQL and YUI together like this? Well, for me these utilities bring me quite close to a traditional MVC (Model View Controller) type of design pattern. YQL is a wonderful data aggregation and manipulation tool, but at the end of the day it's just data. We insert the controller functionality using YUI utilities such as [the Get Utility](http://developer.yahoo.com/yui/get/) or [Connection Manager](http://developer.yahoo.com/yui/connection/), then we can build our presentation layer on top of that using widgets like [DataTable](http://developer.yahoo.com/yui/datatable/) and [Charts](http://developer.yahoo.com/yui/charts/).

[![private update stream](/yuiblog/blog-archive/assets/private_updates.jpg)](http://www.nakedtechnologist.com/php_widget_oauth/yql_php_widget.html)

### Accessing Private User Data

Let's explore the pairing of YUI and YQL a little further by taking the foundation built in the public JavaScript query widget and attaching a server-side component to authenticate and store an oAuth session. Using the Y!OS [PHP SDK](http://developer.yahoo.com/social/sdk/#php), we are able to extend the JavaScript widget to display the update stream and personal badge details of the user who originally authenticated the widget. Since we're using the PHP SDK on the same domain as our widget to make our authenticated calls to YQL, we no longer need to worry about the same-origin policy issues. This means that we can exchange the use of the [YUI Get Utility](http://developer.yahoo.com/yui/get/) with the [YUI Connection Manager](http://developer.yahoo.com/yui/connection/). The benefit to using the [Connection Manager](http://developer.yahoo.com/yui/connection/) here is that we can use a standard ajax request and the event handlers of the utility instead of a callback within the YQL query. Our new request function would look something like this:

```
<script type="text/javascript">
var getYQLData = function(query){
    //prepare URL & post data for YUI Connection Manager POST:
    var sURL = "private_data_fetch.php";
    var postData = "q=" + query;

    //define Connection Manager event callbacks
    var callback = {
        success:parseYQLResults,
        failure:onYQLReqFailure
    };
		
    //make POST request to YQL with provided query
    var transactionObj = YAHOO.util.Connect.asyncRequest('POST',
	    sURL, callback, postData);
		
    return transactionObj;
}
</script>

```

The Connection Manager is used to make AJAX requests to the PHP SDK (whose references are housed in `private_data_fetch.php` within the above code) with the query as a POST parameter. The SDK in turn makes an authenticated request for the user's personal data and dumps out a JSON string as the return of the request. Then all you need to do is parse the JSON string using the [YUI JSON Utility](http://developer.yahoo.com/yui/json/); after you've called `YAHOO.util.JSON.parse()` on the transaction results, your data can be treated in the same manner as the data in the first example.

Since YQL generates results when the request is called, there is no need to house this data for yourself. YQL can pull data from any available source so you can build widgets such as these to display dynamic results with each refresh.

Both of the widgets showcased in this post are freely available for download and contribution on github at [http://github.com/jonleblanc/yql-utilities/tree/master](http://github.com/jonleblanc/yql-utilities/tree/master). These widgets are:

-   `js-yql-display`: JavaScript widget to display public YQL data
-   `php-yql-display`: JavaScript / PHP widget to display private YQL data