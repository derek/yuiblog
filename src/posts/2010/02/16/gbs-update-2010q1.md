---
layout: layouts/post.njk
title: "Graded Browser Support Update: Q1 2010"
author: "Eric Miraglia"
date: 2010-02-16
slug: "gbs-update-2010q1"
permalink: /2010/02/16/gbs-update-2010q1/
categories:
  - "Graded Browser Support"
  - "Development"
---
This post announces an update to [Graded Browser Support](http://developer.yahoo.com/yui/articles/gbs/). The [GBS page on the YUI site](http://developer.yahoo.com/yui/articles/gbs/) always has the most current GBS table. This post includes:

-   [a list of changes](#changes);
-   [an updated chart of browsers that receive A-grade support](#graded-browsers);
-   [our GBS forecast, indicating the changes we expect to make in Q2 2010](#forecast);
-   and [a discussion section that lays out some of the strategy behind the current GBS update](#gbs0910_discussion).
    

### GBS Changes for Q1 2010

Specific changes for Q1 2010 include:

-   Initiated A-Grade support for Chrome 4.0. on Windows XP
-   Replaced Windows Vista with Windows 7 in the testing matrix (dropping IE7 from that platform while retaining it on XP)
-   Moved Opera 10. to X-Grade from A-Grade
-   Replaced Firefox 3.5. with Firefox 3.6. in the testing matrix

<table summary="This chart lists browsers that receive A-Grade support as defined by Graded Browser Support."><tbody><tr class="first"><td></td><th abbr="Win XP" class="pc" id="Windows_XP" scope="col"><abbr title="Microsoft Windows XP">Win XP</abbr></th><th abbr="Win 7" class="pc" id="Windows_7" scope="col"><abbr title="Microsoft Windows 7">Win 7</abbr></th><th abbr="Mac 10.5" class="mac" id="Macintosh_10.5" scope="col"><abbr title="Macintosh 10.5">Mac 10.5.</abbr></th><th abbr="Mac 10.6" class="mac" id="Macintosh_10.6" scope="col"><abbr title="Macintosh 10.5">Mac 10.6.</abbr></th></tr><tr><th abbr="Firefox 3" id="Mozilla_Firefox_3.0.†" scope="row"><abbr title="Mozilla Firefox 3.0.†">Firefox 3.0.</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Firefox 3.6." id="Mozilla_Firefox_3.6.†" scope="row"><abbr title="Mozilla Firefox 3.6.†">Firefox 3.6.</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="agrade">A-grade</td></tr><tr><th abbr="Chrome 4.0.†" id="Chrome 4.0.†" scope="row"><abbr title="Chrome 4.0.†">Chrome 4.0.†</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 8" id="Internet_Explorer_8.0" scope="row"><abbr title="Internet Explorer 8.0">IE 8.0</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 7" id="Internet_Explorer_7.0" scope="row"><abbr title="Internet Explorer 7.0">IE 7.0</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 6" id="Internet_Explorer_6.0" scope="row"><abbr title="Internet Explorer 6.0">IE 6.0</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Safari 4.0." id="Apple Safari_4.0." scope="row">Safari 4.0.</th><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td></tr></tbody></table>

_Notes:_

-   The dagger symbol (as in "Firefox 3.6.") indicates that the most-current non-beta version at that branch level receives support.
-   Code that may be used on pages with unknown doctypes should be tested in IE7 quirks mode.
-   Code that may appear in IE8's "compatibility mode," which emulates but is not identical to IE7, should be tested explicitly in compatibility mode.

### GBS Forecast

We expect to make the following changes in the Q2 2010 GBS update:

-   Discontinue A-grade for Firefox 3.0.†, moving it to X-grade.

### Discussion

This update [implements the guidance we provided in Q4 2009](/yuiblog/2009/10/16/gbs-update-2009q4/). That update generated significant discussion, and high-quality input from Opera is included in the comments thread; I encourage you to refer to that update for more details. Of interest in this update:

1.  **Chrome:** Chrome's [continued growth](http://www.computerworld.com/s/article/9142958/Google_s_Chrome_grabs_No._3_browser_spot_from_Safari) argues compellingly for its inclusion in the A-Grade. Discussion among members of the GBS committee focused around when, not if, Chrome would be promoted into the testing matrix, and there was a strong consensus that it belongs there today.
2.  **Opera:** [Refer to the Q4 2009 GBS update](/yuiblog/2009/10/16/gbs-update-2009q4/) for a discussion of the decision to move Opera to X-Grade. Worth noting here is that YUI specifically and Yahoo more broadly continue to support Opera — just as we continue to support X-Grade browsers in general. The GBS provides guidance for formulating QA testing matrices, and our recommendation as of Q1 2010 is that Opera be grouped in the X-Grade along with other high-quality, low-marketshare browsers. Opera is an excellent browser — we expect Opera users to have a good experience on Yahoo! sites and YUI-based sites, and we'll continue to investigate bugs related to Opera as they are identified.
3.  **Windows Vista and Windows 7:** By volume, client-side defects that are specific to a single version of Windows (as opposed to a version of Internet Explorer) are relatively low. Our experience has been that Vista-specific testing has not led to a significantly differentiated set of bugs compared with testing on XP. With that in mind, we've decided to replace Vista in the testing matrix with the newer and ascendant Windows 7 platform, keeping the testing surface to 4 unique platforms while bracketing the Windows continuum with the evergreen XP and the newer Windows 7. While Vista remains a popular operating system, and QA engineers and developers should retain access to Vista environments to investigate bugs when reported, we advise QA departments to begin migrating their automated testing platforms to Windows 7 at this point.

**Our quarterly reminder:** Graded Browser Support is a QA philosophy, not a report card on the quality of popular browsers. It's designed to provide guidance for QA teams about how best to use their limited testing resources (and to frontend engineers about how to sanely cross-check work across a finite set of browsers). The goal is to be conservative and calculating: We want to test the smallest possible subset of browser/platform combinations, leveraging implicit coverage by testing the most commonly shared core browser engines.

### The GBS Archive

-   [GBS Update, 2009-10-16](/yuiblog/2009/10/16/gbs-update-2009q4/)
-   [GBS Update, 2009-07-02](/yuiblog/2009/07/02/gbs-update-20090702/)
-   [GBS Update, 2009-01-28](/yuiblog/2009/01/28/gbs-update-20090128/)
-   [GBS Update, 2008-07-03](/yuiblog/2008/07/03/gbs-update-20080703/)
-   [GBS Update, 2008-02-19](/yuiblog/2008/02/19/gbs-update-20080219/)