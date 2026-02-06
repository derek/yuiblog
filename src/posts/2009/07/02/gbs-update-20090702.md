---
layout: layouts/post.njk
title: "Graded Browser Support Update: Q3 2009"
author: "Eric Miraglia"
date: 2009-07-02
slug: "gbs-update-20090702"
permalink: /2009/07/02/gbs-update-20090702/
categories:
  - "Development"
---
This post announces an update to Graded Browser Support. The [GBS page on the YUI site](http://developer.yahoo.com/yui/articles/gbs/) always has the most current information. This post includes a list of [changes](#changes), the [updated chart of browsers that receive A-grade support](#graded-browsers), and our [GBS forecast](#forecast). The [discussion](#gbs0907_discussion) section breaks out some of the strategy behind the current GBS update.

### GBS Changes for Q3 2009

This GBS update adds A-grade support for Firefox 3.5 and for Safari 4.0. A-grade support is discontinued for Firefox 2, Opera on Mac OS X, and IE6 on Windows 2000. With this update, Windows 2000 drops from the A-Grade testing matrix and the testing surface is reduced to 14 browsers on 4 OS platforms (down from 15 browsers on 5 platforms).

-   Initiated A-grade support for Firefox 3.5, Windows XP
-   Initiated A-grade support for Firefox 3.5, Windows Vista
-   Initiated A-grade support for Safari 4.0, Mac OS 10.4
-   Initiated A-grade support for Safari 4.0, Mac OS 10.5
    
-   Discontinued A-grade support for IE6, Windows 2000
    
-   Discontinued A-grade support for Firefox 3.0, Windows Vista
-   Discontinued A-grade support for Firefox 2.0, Mac OS 10.5
-   Discontinued A-grade support for Firefox 2.0, Windows XP
-   Discontinued A-grade support for Opera 9.6, Mac OS 10.5

<table summary="This chart lists browsers that receive A-Grade support as defined by Graded Browser Support."><tbody><tr class="first"><td></td><th abbr="Win XP" class="pc" id="Windows_XP" scope="col"><abbr title="Microsoft Windows XP">Win XP</abbr></th><th abbr="Win Vista" class="pc" id="Windows_Vista" scope="col"><abbr title="Microsoft Windows Vista">Win Vista</abbr></th><th abbr="Mac 10.4" class="mac" id="Macintosh_10.4" scope="col"><abbr title="Macintosh 10.4">Mac 10.4.</abbr></th><th abbr="Mac 10.5" class="mac" id="Macintosh_10.5" scope="col"><abbr title="Macintosh 10.5">Mac 10.5.</abbr></th></tr><tr><th abbr="Firefox 3" id="Mozilla_Firefox_3.0." scope="row"><abbr title="Mozilla Firefox 3.0.">Firefox 3.0.</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td></tr><tr><th abbr="Firefox 2" id="Mozilla_Firefox_2.0." scope="row"><abbr title="Mozilla Firefox 2.0.">Firefox 3.5.</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="agrade">A-grade</td></tr><tr><th abbr="Opera 9.6" id="Opera_9.6." scope="row"><abbr title="Opera 9.6 ">Opera 9.6.</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 8" id="Internet_Explorer_8.0" scope="row"><abbr title="Internet Explorer 8.0">IE 8.0</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 7" id="Internet_Explorer_7.0" scope="row"><abbr title="Internet Explorer 7.0">IE 7.0</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 6" id="Internet_Explorer_6.0" scope="row"><abbr title="Internet Explorer 6.0">IE 6.0</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Safari 3.2" id="Apple Safari_3.2" scope="row"><abbr title="Apple Safari 3.2">Safari 3.2.</abbr></th><td class="na"></td><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td></tr><tr><th abbr="Safari 3.2" id="Apple Safari_3.2†2" scope="row">Safari 4.0.<abbr title="Apple Safari 3.2†"></abbr></th><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td></tr></tbody></table>

_Notes:_

-   The dagger symbol (as in "Firefox 3.5.") indicates that the most-current non-beta version at that branch level receives support.
-   Code that may be used on pages with unknown doctypes should be tested in IE7 quirks mode.
-   Code that may appear in IE8's "compatibility mode," which emulates but is not identical to IE7, should be tested explicitly in compatibility mode.

### GBS Forecast

We expect to make the following changes in the Q4 2009 GBS update:

-   Discontinue A-grade support for Firefox 3.0.x across all OSs.
-   Discontinue A-grade support for Safari 3.2.x on Mac OS 10.5.
-   Begin publication of A-grade matrix for smartphones
-   Re-evaluate status of Google Chrome

### Discussion

1.  [![Opera's marketshare in eastern Europe.](/yuiblog/blog-archive/assets/russia-opera-marketshare-20090630-142910.jpg)](http://people.opera.com/dstorey/images/OperaMarketShareEEhover.svgz)**Opera:** Opera continues to be an important independent browser manufacturer, but its sub-1% global marketshare is now superseded by other browsers whose user base is growing more rapidly (including Safari on Apple's iPhone OS and Google's Chrome on Windows). In many ways, the X-grade browser class, which is full of excellent small-marketshare browsers, is the right category for Opera at this point. However, for developers of global products, [Opera's strong position in Russia and eastern Europe](http://people.opera.com/dstorey/images/OperaMarketShareEEhover.svgz) (source: [StatCounter](http://gs.statcounter.com/#browser-RU-daily-20090601-20090630)) argues persuasively for its continued inclusion in the A-grade. Hence, our advice remains that you continue to test your applications in the latest version of Opera on Windows XP. We've dropped A-grade support for Opera on Mac OS 10.x to reduce the testing surface and accommodate future inclusion of browsers with rapidly growing marketshare.
2.  **Chrome:** One of the most common questions we get about GBS today is: "What about Google Chrome?" It's a fair question. Chrome is an excellent, innovative browser that adheres to web standards, and it has a rapidly expanding marketshare. Chrome remains an X-grade browser today because its marketshare is still very small on a relative basis. If Chrome maintains its current marketshare growth, it will be reclassified as A-grade within one or two quarters. Note that [Google's developer page for Chrome](http://www.google.com/chrome/intl/en/webmasters.html) suggests that "if you've tested your website with Safari 3.1 then your site should already work well on Google Chrome." This is good advice.
3.  ![Yahoo! Search running on the iPhone OS version of Safari.](/yuiblog/blog-archive/assets/iphone-20090630-145715.jpg)**Safari on the iPhone OS:** The OS that drives Apple's iPhone and iPod Touch devices is another ascendant category of browser traffic. Is Safari for the iPhone OS an A-grade browser? Our answer: No, but that doesn't mean you can ignore it in your product planning and testing. We regard the emerging class of full-featured browsers on handheld devices to be a category that requires its own GBS matrix. Such a matrix should include testing advice for browsers including Safari on iPhone as well as the browsers that ship with Google's Android OS and Palm's Pre OS. Treating these browsers as X-grade today is the right decision based on their marketshare -- remember, X-grade browsers are expected to support current web standards and to perform well in browsing well developed sites. But the rapid growth of web traffic coming through these browsers, their unique form factors (much smaller screens), and their new interaction paradigms (including touch-screen gestures) argue for an intentional and sometimes differentiated approach to web-application design and implementation. While most content should "just work" and work well, these devices need to be considered at the product-design stage. Providing an "A-grade" experience for your application may not be a question of whether your app runs in the browser but whether your app's usability on a small touchscreen retains its usability. With this in mind, we'll begin delivering a smartphone GBS matrix beginning in Q4 2009.

We'd love to hear your take on these issues and others in the comments section.

### The GBS Archive

-   [GBS Update, 2009-01-28](/yuiblog/blog/2009/01/28/gbs-update-20090128/)
-   [GBS Update, 2008-07-03](/yuiblog/blog/2008/07/03/gbs-update-20080703/)
-   [GBS Update, 2008-02-19](/yuiblog/blog/2008/02/19/gbs-update-20080219/)