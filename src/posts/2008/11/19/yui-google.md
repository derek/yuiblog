---
layout: layouts/post.njk
title: "Google Hosting YUI Files on ajax.googleapis.com"
author: "Unknown"
date: 2008-11-19
slug: "yui-google"
permalink: /2008/11/19/yui-google/
categories:
  - "Development"
---
**Update:** It should be added that Google's CDN provides SSL support whereas Yahoo's does not. If you were previously hosting your own set of YUI files to use in a secure environment, the Google CDN may be a way to offload that bandwidth and improve performance.

[![](/yuiblog/blog-archive/assets/configurator-goog.png)](http://developer.yahoo.com/yui/articles/hosting/?yuiloader-dom-event&MIN&nocombine&basepath&http://ajax.googleapis.com/ajax/libs/yui/2.6.0/build/&google)

Google has been [hosting some of the popular AJAX libraries](http://code.google.com/apis/ajaxlibs/documentation/) for awhile, and we're pleased to announce that YUI has now been added to that roster. Now, you can choose between `yui.yahooapis.com` and `ajax.googleapis.com` when you evaluate your hosting options for YUI files. We've added Google as an option in the CDN section of the [Dependency Configurator](http://developer.yahoo.com/yui/articles/hosting/?yuiloader-dom-event&MIN&nocombine&basepath&http://ajax.googleapis.com/ajax/libs/yui/2.6.0/build/&google); it's easy to configure your implementation and switch the generated URLs from one source to the other.

There are two things to keep in mind in working with the Google CDN, particularly if you're currently using Yahoo's CDN:

1.  **Combo-handling:** Combo-handling (the on-the-fly aggregation of files to reduce HTTP requests) is supported on Yahoo's CDN but not on Google's;
2.  **Versions:** Google's CDN contains the current version of YUI (2.6.0) and will get future versions as they become available; legacy versions of YUI are not available from the Google CDN.

If you're using [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) to bring in your YUI files, it's a simple thing to switch to Google's servers using YUI Loader's `base` configuration option. Here's what you would do to pull the [YUI DataTable](http://developer.yahoo.com/yui/datatable/) and its dependencies from the Google CDN using YUI Loader:

```
<!--Include YUI Loader: --> 
<script type="text/javascript" 
src="http://ajax.googleapis.com/ajax/libs/yui/2.6.0/build/yuiloader/yuiloader-min.js">
</script> 

<!--Use YUI Loader to bring in your other dependencies: --> 
<script type="text/javascript"> 
// Instantiate and configure YUI Loader: 
(function() { 
var loader = new YAHOO.util.YUILoader({ 
        base: "http://ajax.googleapis.com/ajax/libs/yui/2.6.0/build/", 
        require: ["datatable"], 
        onSuccess: function() { 
            //instantiate your DataTable here...
    } 
}); 

// Load the files using the insert() method. 
loader.insert(); 
})(); 
</script>
```

The Dependency Configurator will generate this script for you; simply [load this configuration](http://developer.yahoo.com/yui/articles/hosting/?datatable&MIN&nocombine&basepath&http://ajax.googleapis.com/ajax/libs/yui/2.6.0/build/&google) and switch to the "Dynamic Loading with YUI Loader" tab.

Thanks to [Vadim Spivak](http://vadim.spivak.net/blog/) at Google and [Dion Almaer](http://almaer.com/blog/) (now at Mozilla) for helping to make this additional option available to the YUI developer community. We love that Google is supporting web developers in this way — grabbing YUI files from Google's global infrastructure is a fantastic option to have.