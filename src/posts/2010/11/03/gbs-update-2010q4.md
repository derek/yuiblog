---
layout: layouts/post.njk
title: "Graded Browser Support Update: Q4 2010"
author: "Eric Miraglia and Matt Sweeney"
date: 2010-11-03
slug: "gbs-update-2010q4"
permalink: /blog/2010/11/03/gbs-update-2010q4/
categories:
  - "Development"
---
This post announces an update to [Graded Browser Support](http://developer.yahoo.com/yui/articles/gbs/), Yahoo!'s recommended browser testing matrix. The [GBS page on the YUI site](http://developer.yahoo.com/yui/articles/gbs/) always has the most current GBS table. This post includes:

-   [a list of changes](#changes);
-   [an updated chart of browsers that receive A-grade support](#graded-browsers);
-   [an updated draft list of C-grade browsers](#cgrade);
-   [our GBS forecast, indicating the changes we expect to make in Q1 2011](#forecast);
-   and [a discussion section that lays out some of the strategy behind the current GBS update](#discussion).
    

**Reminder:** Graded Browser Support is a QA philosophy, not a report card on the quality of popular browsers. It is designed to provide guidance for QA teams about how best to use their limited testing resources (and to frontend engineers about how to sanely cross-check work across a finite set of browsers). The goal is to be conservative and calculating: We want to test the smallest possible subset of browser/platform combinations, leveraging implicit coverage by testing the most commonly shared core browser engines.

### GBS Changes for Q4 2010

Specific changes for Q4 2010 include:

-   Revised support for the fast-iterating [Chrome browser](http://www.google.com/chrome "Google Chrome - Get a fast new browser. For PC, Mac, and Linux"); Chrome A-grade testing coverage is now recommended for the latest major, stable version of the browser on Windows XP.
-   Dropped A-Grade coverage for Firefox 3.0. (moves to X-grade).
-   Dropped A-Grade coverage for Safari 4 on Mac OS 10.5. (moves to X-grade).
-   Updated Safari coverage to 5. on Mac OS 10.6.
-   Initiated A-grade coverage for WebKit browsers on iOS and Android OS.
-   Forecast A-grade coverage for Firefox 4. and Internet Explorer 9 on Windows 7 upon their GA release.
-   Addition of Firefox versions prior to 3.0 to C-grade list.
-   Forecast discontinuation of A-grade coverage for Internet Explorer 6 in Q1 2011; we expect to move IE6 to the C-grade browser list as of the next update.

<table summary="This chart lists browsers that receive A-Grade support as defined by Graded Browser Support."><tbody><tr class="first"><td></td><th abbr="Win XP" class="pc" id="Windows_XP" scope="col"><abbr title="Microsoft Windows XP">Win XP</abbr></th><th abbr="Win 7" class="pc" id="Windows_7" scope="col"><abbr title="Microsoft Windows 7">Win 7</abbr></th><th abbr="Mac 10.6" class="mac" id="Macintosh_10.6" scope="col"><abbr title="Apple Macintosh OS X 10.6">Mac 10.6.</abbr></th><th abbr="Apple iOS 3." class="mac" id="iOS 3." scope="col">iOS 3.</th><th abbr="Apple iOS 4." class="mac" id="iOS 4." scope="col">iOS 4.</th><th abbr="Google Android OS 2.2." class="google" id="Android OS 2.2." scope="col"><abbr title="Google Android OS 2.2.">Android 2.2.</abbr></th></tr><tr><th abbr="Safari 5." id="Apple Safari_5." scope="row">Safari 5.</th><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Chrome † (latest stable)" id="Chrome † (latest stable)" scope="row"><abbr title="Chrome † (latest stable)">Chrome † (latest stable)</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Firefox 4." id="Mozilla_Firefox_4.†" scope="row"><abbr title="Mozilla Firefox 4.†">Firefox 4.</abbr></th><td class="na"></td><td class="future">A-grade (upon GA release)</td><td class="future">A-grade (upon GA release)</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Firefox 3.6." id="Mozilla_Firefox_3.6.†" scope="row"><abbr title="Mozilla Firefox 3.6.†">Firefox 3.6.</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 8" id="Internet_Explorer_9.0" scope="row"><abbr title="Internet Explorer 9.0">IE 9.0</abbr></th><td class="na"></td><td class="future">A-grade (upon GA release)</td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 8" id="Internet_Explorer_8.0" scope="row"><abbr title="Internet Explorer 8.0">IE 8.0</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 7" id="Internet_Explorer_7.0" scope="row"><abbr title="Internet Explorer 7.0">IE 7.0</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 6" id="Internet_Explorer_6.0" scope="row"><abbr title="Internet Explorer 6.0">IE 6.0</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th id="Safari" scope="row">Safari for iOS</th><td class="na"></td><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td></tr><tr><th id="WebKit for Android OS" scope="row">WebKit for Android OS</th><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td></tr></tbody></table>

_Notes:_

-   The dagger symbol (as in "Firefox 3.6.") indicates that the most-current non-beta version at that branch level receives support.
-   Code that may be used on pages with unknown doctypes should be tested in IE7 quirks mode.
-   Code that may appear in IE8's "compatibility mode," which emulates but is not identical to IE7, should be tested explicitly in compatibility mode.
-   No guidance is given on iOS or Android OS device usage. The recommendation is that you choose a device most representative of your user base for each OS.

### C-Grade Browser List (Draft)

This list represents browsers from which CSS and JavaScript should be withheld. This list remains in draft status.

-   IE < 6 (including Mac OS versions)
-   Safari < 3
-   Firefox < 3
-   Opera < 9.5
-   Netscape < 8

### GBS Forecast

We expect to make the following changes in the Q1 2011 GBS update:

-   Discontinue A-grade for Internet Explorer 6, moving it to C-Grade.
-   Discontinue A-grade for Firefox 3.6. on Windows XP.
-   Move Chrome support from Windows XP to Windows 7.

### Discussion

This update [implements the guidance we provided in Q1 2010](/yuiblog/blog/2010/02/16/gbs-update-2010q1/). Of interest in this update:

1.  **Internet Explorer 6:** We are forecasting the transition of Internet Explorer 6 from A-grade to C-grade in the next GBS update. The calculus here is simple: The proliferation of devices and browsers on the leading edge (including mobile) requires an increase in testing and attention. That testing and attention should come from shifting resources away from the trailing edge. By moving IE6 to the C-grade, we ensure a consistent baseline experience for those users while freeing up cycles to invest in richer experiences for millions of users coming to the internet today on modern, capable browsers. **Note**: This forecast should not be taken as an indication that IE6 users will see an abrupt change in their experience of Yahoo! websites in Q1 2011; the change in philosophy toward IE6 will be reflected in new development and products and applied in ways that make sense based on product needs.
2.  **Chrome:** Chrome has been progressing rapidly through versions, and Google has communicated its intent to continue rapid development and short release cycles. As a result, we've modified our GBS strategy for Chrome to advise testing on the latest GA release of Chrome as soon as it is issued, with prior versions moving to X-grade as soon as they are superseded.
3.  **Mobile:** We're taking a conservative approach to the addition of mobile browsers to the QA matrix, beginning in this release with the current Android version (2.2) and the two latest releases of Apple's iOS (which covers the current OS version for iPad and iPhone/iPod Touch devices). We recommend including devices running these operating systems at minimum in your QA battery. Depending on your resources and your focus, you may want to be much more aggressive in supporting variants of Android and other operating systems (like Palm/HP's WebOS). This GBS recommendation provides a testing surface of 15 browser/platform combinations (once IE 9 and Firefox 4 reach GA), bringing in this first wave of A-Grade mobile browsers while keeping the testing surface at a level consistent with previous quarters.

### The GBS Archive

-   [GBS Update, 2010 Q1](/yuiblog/blog/2010/02/16/gbs-update-2010q1/)
-   [GBS Update, 2009-10-16](/yuiblog/blog/2009/10/16/gbs-update-2009q4/)
-   [GBS Update, 2009-07-02](/yuiblog/blog/2009/07/02/gbs-update-20090702/)
-   [GBS Update, 2009-01-28](/yuiblog/blog/2009/01/28/gbs-update-20090128/)
-   [GBS Update, 2008-07-03](/yuiblog/blog/2008/07/03/gbs-update-20080703/)
-   [GBS Update, 2008-02-19](/yuiblog/blog/2008/02/19/gbs-update-20080219/)