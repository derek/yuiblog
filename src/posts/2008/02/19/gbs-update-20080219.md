---
layout: layouts/post.njk
title: "Graded Browser Support: Updated A-Grade Chart"
author: "Nate Koechley"
date: 2008-02-19
slug: "gbs-update-20080219"
permalink: /2008/02/19/gbs-update-20080219/
categories:
  - "Graded Browser Support"
  - "Development"
---
This post marks the first Graded Browser Support (GBS) update of 2008. It modifies the A-Grade support chart and offers a forecast of likely future changes. The current [A-Grade support chart](http://developer.yahoo.com/yui/articles/gbs "Graded Browser Support page on the Yahoo! Developer Network") is always on the YUI web site; updates are always announced here.

There are three main changes in this update:

-   Safari 3 begins receiving A-Grade support on Mac 10.4 and 10.5
-   Safari 2 stops receiving A-Grade support.
-   Firefox 1.5 stops receiving A-Grade support.

### [Current A-Grade Support Chart](http://developer.yahoo.com/yui/articles/gbs/#gbschart)

<table summary="This chart lists browsers that receive A-Grade support as defined by Graded Browser Support."><tbody><tr class="first"><td></td><th abbr="Win 98" class="pc" id="Windows_98" scope="col"><abbr title="Microsoft Windows 98">Win 98</abbr></th><th abbr="Win 2000" class="pc" id="Windows_2000" scope="col"><abbr title="Microsoft Windows 2000">Win 2000</abbr></th><th abbr="Win XP" class="pc" id="Windows_XP" scope="col"><abbr title="Microsoft Windows XP">Win XP</abbr></th><th abbr="Win Vista" class="pc" id="Windows_Vista" scope="col"><abbr title="Microsoft Windows Vista">Win Vista</abbr></th><th abbr="Mac 10.4" class="mac" id="Macintosh_10.4" scope="col"><abbr title="Macintosh 10.4">Mac 10.4</abbr></th><th abbr="Mac 10.5" class="mac" id="Macintosh_10.5" scope="col"><abbr title="Macintosh 10.5">Mac 10.5</abbr></th></tr><tr><th abbr="IE 7" id="Internet_Explorer_7.0" scope="row"><abbr title="Internet Explorer 7.0">IE 7.0</abbr></th><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 6" id="Internet_Explorer_6.0" scope="row"><abbr title="Internet Explorer 6.0">IE 6.0</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Firefox 2.0." id="Mozilla_Firefox_2.0." scope="row"><abbr title="Mozilla Firefox 2.0.">Firefox 2.0.</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td></tr><tr><th id="Opera_9." scope="row"><abbr abbr="Opera 9." title="Opera 9.">Opera 9.</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td></tr><tr><th abbr="Safari 3.0" id="Apple Safari_3.0" scope="row"><abbr title="Apple Safari 3.0">Safari 3.0</abbr></th><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td></tr></tbody></table>

The dagger symbol (as in "Firefox 2.0.") indicates that "the latest single non-beta version at that branch level" receives support. Read it as "the most recent" instead of "all" but note that 2.1.0 would not be included because it's not at "that branch level."

### GBS Forecast

In addition to the effective-immediately changes, we're also keeping our eyes on some pending developments.

-   #### Firefox 3 and Internet Explorer 8
    
    GBS does not extend A-Grade support to beta versions of browsers. (They receive X-Grade support by definition.) However, it's important to be aware of forthcoming releases, especially from established brands that enjoy rapid adoption once generally available (GA). **We are currently watching the development progress of Firefox 3 and Internet Explorer 8.**
    
    We made an exception to our "no betas" stance during IE7's beta phase in recognition of IE's market share and ability to promote rapid adoption. These exceptions -- committing development and QA resources to provide A-Grade support prior to a GA release -- give us an opportunity to learn the new browser's quirks and provide feedback while it is still being developed. And it means our sites are prepared when it does reach GA. **We will likely extend the same accommodation to IE8. Stay tuned.**
    
-   #### Windows 98
    
    **We anticipate that in the next GBS update we will discontinue A-Grade support for browsers running on Windows 98.**
    

## Other Notes

-   [YUI 2.5.0, released earlier this week](/yuiblog/2008/02/20/yui-250-released/), still provides A-Grade support to Safari 2. It's unlikely that future YUI release will. For now: bonus browser support!
    
-   We are going to begin archiving these individual updates more than we've done in the past. We've heard your request to have snapshots of the GBS chart at a particular moment in time. We plan to publish these detailed updates on this blog, and collect the links to the various updates in a new Archive section of the web site.
    
-   Currently browsers receiving A-Grade support are the only ones enumerated in chart form. I've heard your requests to see the other charts, and I'd sincerely hoped to have those ready to share by now. Unfortunately, some associated tools are not yet complete. But I'm working on it!