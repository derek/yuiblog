---
layout: layouts/post.njk
title: "Using YUI 2 and YUI 3 Together: Even Easier with Caridy's Wrapper Utility"
author: "YUI Team"
date: 2009-11-19
slug: "2-and-3-with-wrapper"
permalink: /blog/2009/11/19/2-and-3-with-wrapper/
categories:
  - "Development"
---
[![Using YUI 2 and YUI 3 together with Caridy's Wrapper Utility](/yuiblog/blog-archive/assets/wrapperutility-20091119-123959.png)](http://ericmiraglia.com/yui/demos/wrapper.php)

[The YUI 3 Gallery](http://yuilibrary.com/gallery) got an interesting new addition today: [Caridy Patino Mayea's YUI 2 Wrapper Utility](http://yuilibrary.com/gallery/show/yui2). Wrapper allows you to pull in [YUI 2](http://developer.yahoo.com/yui/2/) modules from [YUI 3](http://developer.yahoo.com/yui/3/) `use()` statements. Check out [Caridy's documentation for the Wrapper here](http://caridy.github.com/gallery-yui2/).

How easy? [Here's a full example](http://ericmiraglia.com/yui/demos/wrapper.php). All that we start with is the 6.2KB (gzip) YUI 3 seed file; Caridy's Wrapper and the built-in YUI 3 Loader take care of the rest:

```
<script type="text/javascript" src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js"></script>

<div id="demo" class="yui-navset">
    <ul class="yui-nav">
        <li><a href="#tab1"><em>Tab One Label</em></a></li>
        <li class="selected"><a href="#tab2"><em>Tab Two Label</em></a></li>
        <li><a href="#tab3"><em>Tab Three Label</em></a></li>
    </ul>            
    <div class="yui-content">
        <div id="tab1"><p>Tab One Content</p></div>
        <div id="tab2"><p>Tab Two Content</p></div>
        <div id="tab3"><p>Tab Three Content</p></div>
    </div>
</div>

<script language="javascript">

YUI({
    modules: {
        'gallery-yui2': {
            fullpath: 'http://yui.yahooapis.com/gallery-2009.11.19-20/build/gallery-yui2/gallery-yui2-min.js',
            requires: ['node-base','get','async-queue'],
            optional: [],
            supersedes: []
      }
 
    }
}).use('gallery-yui2', function(Y) {
 
    Y.yui2().use("tabview", function () {
 
        var myTabs = new YAHOO.widget.TabView("demo");
 
    });
 
});

</script>
```

Check out the [YUI 2 Wrapper](http://yuilibrary.com/gallery/show/yui2) and [many others](http://yuilibrary.com/gallery/show/?show=all) on the [YUI 3 Gallery](http://yuilibrary.com/gallery/).