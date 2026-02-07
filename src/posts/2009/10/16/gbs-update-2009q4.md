---
layout: layouts/post.njk
title: "Graded Browser Support Update: Q4 2009"
author: "Eric Miraglia"
date: 2009-10-16
slug: "gbs-update-2009q4"
permalink: /2009/10/16/gbs-update-2009q4/
categories:
  - "Graded Browser Support"
  - "Development"
---
This post announces an update to [Graded Browser Support](http://developer.yahoo.com/yui/articles/gbs/). The [GBS page on the YUI site](http://developer.yahoo.com/yui/articles/gbs/) always has the most current GBS table. This post includes:

-   [a list of changes](#changes);
-   [an updated chart of browsers that receive A-grade support](#graded-browsers);
-   [our GBS forecast, indicating the changes we expect to make in Q1 2010](#forecast);
-   and [a discussion section that lays out some of the strategy behind the current GBS update](#gbs0910_discussion).
    

### GBS Changes for Q4 2009

With this update, Mac OS 10.4 Tiger drops from the A-Grade testing matrix (replaced with Mac OS 10.6 Snow Leopard) and the testing surface is reduced to 12 browsers on 4 OS platforms (down from 14 browsers on 4 platforms). Specific changes include:

-   Initiated A-Grade support for Firefox 3.5. on Mac OS 10.6.
-   Initiated A-Grade support for Opera 10.0. on Windows XP
-   Discontinued A-Grade support for Firefox 3.0. on Mac OS 10.5.
-   Discontinued A-Grade support for Firefox 3.5. on Mac OS 10.5.
-   Discontinued A-Grade support for Safari 3.2. on Mac OS 10.4.
-   Discontinued A-Grade support for Opera 9.6. on Windows XP

<table summary="This chart lists browsers that receive A-Grade support as defined by Graded Browser Support."><tbody><tr class="first"><td></td><th abbr="Win XP" class="pc" id="Windows_XP" scope="col"><abbr title="Microsoft Windows XP">Win XP</abbr></th><th abbr="Win Vista" class="pc" id="Windows_Vista" scope="col"><abbr title="Microsoft Windows Vista">Win Vista</abbr></th><th abbr="Mac 10.5" class="mac" id="Macintosh_10.5" scope="col"><abbr title="Macintosh 10.5">Mac 10.5.</abbr></th><th abbr="Mac 10.6" class="mac" id="Macintosh_10.6" scope="col"><abbr title="Macintosh 10.5">Mac 10.6.</abbr></th></tr><tr><th abbr="Firefox 3" id="Mozilla_Firefox_3.0.†" scope="row"><abbr title="Mozilla Firefox 3.0.†">Firefox 3.0.</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Firefox 3.5." id="Mozilla_Firefox_3.5.†" scope="row"><abbr title="Mozilla Firefox 3.5.†">Firefox 3.5.</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="agrade">A-grade</td></tr><tr><th abbr="Opera 10.0.†" id="Opera_10.0.†" scope="row"><abbr title="Opera 10.0.†">Opera 10.0.</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 8" id="Internet_Explorer_8.0" scope="row"><abbr title="Internet Explorer 8.0">IE 8.0</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 7" id="Internet_Explorer_7.0" scope="row"><abbr title="Internet Explorer 7.0">IE 7.0</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 6" id="Internet_Explorer_6.0" scope="row"><abbr title="Internet Explorer 6.0">IE 6.0</abbr></th><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th abbr="Safari 4.0." id="Apple Safari_4.0." scope="row">Safari 4.0.</th><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td></tr></tbody></table>

_Notes:_

-   The dagger symbol (as in "Firefox 3.5.") indicates that the most-current non-beta version at that branch level receives support.
-   Code that may be used on pages with unknown doctypes should be tested in IE7 quirks mode.
-   Code that may appear in IE8's "compatibility mode," which emulates but is not identical to IE7, should be tested explicitly in compatibility mode.

### GBS Forecast

We expect to make the following changes in the Q1 2010 GBS update:

-   Discontinue A-grade for Opera across all OSs (if current data trends continue); the latest version of Opera (currently 10.0.) will be considered an X-grade browser as of Q1.
-   Initiate A-Grade support for the latest version of Google Chrome on Windows XP (if current data trends continue).
-   Initiate A-Grade support for IE8 on Windows 7.

### Discussion

This update pares the testing surface to 12 browser/platform combinations (down from a high of 15). The most significant aspect of this update is our guidance for Q1 in which we forecast Chrome beginning to receive A-Grade support and Opera 10 moving to the X-Grade. Here are notes from the GBS committee with respect to that guidance:

1.  **Chrome:** The rate of growth in Chrome's global usage has been dramatic. By some measures, including ours, it is now [double that of the A-Grade Opera browser](http://gs.statcounter.com/#browser-ww-monthly-200809-200910) (source: [StatCounter](http://gs.statcounter.com/#browser-ww-monthly-200809-200910)). Chrome on Windows is built around a solid WebKit core, supportive of web standards (including forward-looking HTML5 standards), and extremely performant. With Google's backing, the project is making rapid progress both on Windows and with the not-yet-released Mac OS X version. If this growth rate continues, we conclude that Chrome will require A-Grade attention as of Q1.
2.  **Opera:** Opera's marketshare, which is small and shows signs of diminishing, makes a compelling case for moving this excellent browser from the A-Grade to the X-Grade in Q1. X-Grade is a category designed to encompass modern, capable browsers with small marketshare, and Opera is squarely in that category today. Opera's marketshare in specific Eastern European and emerging markets might argue for some developers to retain this browser on their testing matrix beyond Q1. We encourage you to watch carefully [the argument presented by Opera's Andreas Bovens and David Storey recently with respect to the "marketshare myth" and reasons why Opera's importance transcends the global marketshare metric](http://developer.yahoo.com/yui/theater/video.php?v=bovens-opera) (source: [YUI Theater](http://developer.yahoo.com/yui/theater/)).

Graded Browser Support is a QA philosophy, not a report card on the quality of popular browsers. It's designed to provide guidance for QA teams about how best to use their limited testing resources (and to frontend engineers about how to sanely cross-check work across a finite set of browsers). The goal is to be conservative and calculating: We want to test the smallest possible subset of browser/platform combinations, leveraging implicit coverage by testing the most commonly shared core browser engines.

Inevitably (and by design), this leaves a lot of browsers out of the matrix. And, unfortunately, the percentage of users still tied to IE6 requires us to include that browser (not because we like IE6, but because we like the many tens of millions of users who rely on it).

One of the most interesting aspects of the quarterly GBS update is hearing your advice (often different than our own), and we'd love to hear your take on these issues in the comments section.

### The GBS Archive

-   [GBS Update, 2009-07-02](/yuiblog/blog/2009/07/02/gbs-update-20090702/)
-   [GBS Update, 2009-01-28](/yuiblog/blog/2009/01/28/gbs-update-20090128/)
-   [GBS Update, 2008-07-03](/yuiblog/blog/2008/07/03/gbs-update-20080703/)
-   [GBS Update, 2008-02-19](/yuiblog/blog/2008/02/19/gbs-update-20080219/)