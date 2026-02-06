---
layout: layouts/post.njk
title: "Combo Handler Service Available for Yahoo-hosted JS"
author: "Eric Miraglia"
date: 2008-07-16
slug: "combohandler"
permalink: /blog/2008/07/16/combohandler/
categories:
  - "Development"
---
We've been talking for a long time at Yahoo about [the importance of minimizing HTTP requests to improve performance](/yuiblog/blog/2006/11/28/performance-research-part-1). One important technique for YUI users has long been to use the pre-built "rollup" files (like `[yahoo-dom-event.js](http://yui.yahooapis.com/2.5.2/build/yahoo-dom-event/yahoo-dom-event.js)`, which combines the YUI Core in a single minified HTTP request) and to create custom rollups that aggregate all of your YUI JS content in a single file. You'll notice that we do a lot of this on our core Yahoo properties. For example, if you go to [check on the Tour de France on Yahoo! Sports](http://sports.yahoo.com/sc), you'll find that numerous YUI components are aggregated with custom Sports-specific JS resources in a single HTTP request ([here's the aggregate file](http://l.yimg.com/img.sports.yahoo.com/static/versioned_asset/v3/minify/js/editorial/js/yui/yuiloader-beta-min_2.5.1.r1.4.js;editorial/js/yui/dom-min_2.5.1.r1.4.js;editorial/js/yui/event-min_2.5.1.r1.4.js;editorial/js/yui/connection-min_2.5.1.r1.4.js;editorial/js/yui/animation-min_2.5.1.r1.4.js;editorial/js/yui/json-min.r1.3.js;editorial/js/constants.r1.15.js;editorial/js/globalsearch.r1.3.js;editorial/js/sports.r1.16.js;editorial/js/tabs.r1.20.js;editorial/js/cookie.r1.3.js;editorial/js/home_modules.r1.4.js;editorial/js/ticker.r1.3.js;editorial/js/window.r1.16.js;editorial/js/scorethin.r1.15.js;editorial/js/manager.r1.3.js;editorial/js/carousel.r1.11.js;editorial/js/player_search.r1.3.js;editorial/js/countdown.r1.5.js;editorial/js/oly.r1.13.js;editorial/js/mlbtv.r1.5.js;editorial/js/flyout_test.r1.20.js;editorial/js/ult.r1.3.js)).

Thanks to the hard work of the [Yahoo Exceptional Performance team](http://developer.yahoo.com/performance/) and the groups that support our CDN, we're now able to offer ad-hoc file aggregation — "combo handling" — to file served from `yui.yahooapis.com`. So, a request for the full [YUI Rich Text Editor](http://developer.yahoo.com/yui/examples/editor/cal_editor.html), which previously looked like this...

```
<script type="text/javascript" 
   src="http://yui.yahooapis.com/2.5.2/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" 
   src="http://yui.yahooapis.com/2.5.2/build/container/container_core-min.js"></script> 
<script type="text/javascript" 
   src="http://yui.yahooapis.com/2.5.2/build/menu/menu-min.js"></script> 
<script type="text/javascript" 
   src="http://yui.yahooapis.com/2.5.2/build/element/element-beta-min.js"></script> 
<script type="text/javascript" 
   src="http://yui.yahooapis.com/2.5.2/build/button/button-min.js"></script>
<script type="text/javascript" 
   src="http://yui.yahooapis.com/2.5.2/build/editor/editor-beta-min.js"></script> 
```

...can now be written this way:

```
<script type="text/javascript" 
src="http://yui.yahooapis.com/combo?2.5.2/build/yahoo-dom-event/yahoo-dom-event.js&
2.5.2/build/container/container_core-min.js&2.5.2/build/menu/menu-min.js&
2.5.2/build/element/element-beta-min.js&2.5.2/build/button/button-min.js&
2.5.2/build/editor/editor-beta-min.js"></script>
```

In one step, this eliminates five separate HTTP requests.

[![Combo handling is built into the YUI Configurator interface.](/yuiblog/blog-archive/assets/combo.png)](http://developer.yahoo.com/yui/articles/hosting/#configure) **A few notes regarding combo handling on `yui.yahooapis.com`**:

-   If you're using the [YUI Configurator](http://developer.yahoo.com/yui/articles/hosting/#configure), this option ("Combine All JS Files") is enabled by default as long as you're using the default base path.
-   Combo-handling of YUI CSS files is not supported at this time.
-   In an upcoming release, we'll provide built-in combo-handling support in [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) and restructure filepaths in YUI's CSS resources to make them combinable as well.
-   YUI Configurator will always output the current version of the library, but all YUI JS files from 2.2.0 onward are present on `yui.yahooapis.com` and can be combined using the same combo-handling syntax.

We hope combo handling provides a easy performance win for those of you letting Yahoo serve your YUI files. Discussion of combo handling and all YUI issues takes place [in our community forum](http://tech.groups.yahoo.com/group/ydn-javascript/) — please join us there and let us know how this works for you.