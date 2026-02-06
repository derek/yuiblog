---
layout: layouts/post.njk
title: "Graded Browser Support Update"
author: "Nate Koechley"
date: 2008-07-03
slug: "gbs-update-20080703"
permalink: /2008/07/03/gbs-update-20080703/
categories:
  - "Development"
---
Updated July 8th: The chart below has been corrected to include Safari 3.1†, replacing Safari 3.0†.

This post announces an update to Graded Browser Support. The [GBS page on the YUI site](http://developer.yahoo.com/yui/articles/gbs/) always has the most current information. This post includes a list of [primary changes](#changes), the [updated chart of browsers that receive A-grade support](#graded-browsers), the [GBS forecast](#forecast), and [notes specific to the YUI Library](#notes-for-yui).

### Primary Changes

These changes are included in this update.

-   A-grade support for Firefox 3 begins.
-   A-grade support for Firefox 2 is reduced to Win XP and Mac 10.5.
-   A-grade support for Opera 9.5 begins on Win XP and Mac 10.5.
-   A-grade support for Win 98 is discontinued, as previously forecast.

<table summary="This chart lists browsers that receive A-Grade support as defined by Graded Browser Support."><tbody><tr class="first"><td></td><th abbr="Win 2000" class="pc" id="Windows_2000" scope="col"><abbr title="Microsoft Windows 2000">Win 2000</abbr></th><th abbr="Win XP" class="pc" id="Windows_XP" scope="col"><abbr title="Microsoft Windows XP">Win XP</abbr></th><th abbr="Win Vista" class="pc" id="Windows_Vista" scope="col"><abbr title="Microsoft Windows Vista">Win Vista</abbr></th><th abbr="Mac 10.4" class="mac" id="Macintosh_10.4" scope="col"><abbr title="Macintosh 10.4">Mac 10.4</abbr></th><th abbr="Mac 10.5" class="mac" id="Macintosh_10.5" scope="col"><abbr title="Macintosh 10.5">Mac 10.5</abbr></th></tr><tr><th abbr="Firefox 3.0." id="Mozilla_Firefox_3.0." scope="row"><abbr title="Mozilla Firefox 2.0.">Firefox 3.†</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="agrade">A-grade</td></tr><tr><th abbr="Firefox 2.0." id="Mozilla_Firefox_2.0." scope="row"><abbr title="Mozilla Firefox 2.0.">Firefox 2.†</abbr></th><td class="na"></td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td></tr><tr><th abbr="IE 7" id="Internet_Explorer_7.0" scope="row"><abbr title="Internet Explorer 7.0">IE 7.0</abbr></th><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td></tr><tr><th abbr="IE 6" id="Internet_Explorer_6.0" scope="row"><abbr title="Internet Explorer 6.0">IE 6.0</abbr></th><td class="agrade">A-grade</td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="na"></td></tr><tr><th id="Opera_9.5" scope="row"><abbr abbr="Opera 9." title="Opera 9.">Opera 9.5†</abbr></th><td class="na"></td><td class="agrade">A-grade</td><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td></tr><tr><th abbr="Safari 3.1" id="Apple Safari_3.1" scope="row"><abbr title="Apple Safari 3.1">Safari 3.1†</abbr></th><td class="na"></td><td class="na"></td><td class="na"></td><td class="agrade">A-grade</td><td class="agrade">A-grade</td></tr></tbody></table>

The dagger symbol (as in "Firefox 3.†") indicates that the most-current non-beta version at that branch level receives support. Put another way, † means "the most recent" instead of "all."

### GBS Forecast

In addition to the effective-immediately changes, we’re keeping our eyes on pending developments.

-   #### Internet Explorer 8
    
    GBS does not extend A-grade support to beta versions of browsers. (They receive X-grade support by definition.) However, it's important to be aware of forthcoming releases, especially from established brands that enjoy rapid adoption once generally available (GA). We are currently watching the development progress of Internet Explorer 8.
    
    We made an exception to our "no-betas" stance during IE7's beta phase in recognition of IE's market share and ability to promote rapid adoption. The exception -- committing development and QA resources to provide A-Grade prior to a GA release -- gives us an opportunity to learn the new browser's quirks and provide feedback while it is still being developed. And it means our sites are prepared when it goes GA. We will likely extend the same accommodation to IE8. Stay tuned.
    

### Notes Specific to the YUI Library

-   #### YUI version 2.5.2
    
    YUI 2.5.2, released May 28, 2008, includes full support for Firefox 3.0 and Opera 9.5, even though those two browsers were just added to GBS in this update.
    

#graded-browsers {} #graded-browsers table {margin-bottom:1em;margin-top:1em;} #graded-browsers caption {margin:1em;} #graded-browsers th,#graded-browsers td {padding:.6em;border:1px solid #fff;font-family:verdana;font-size:11px;} #graded-browsers th, #graded-browsers th abbr {color:#000;} #graded-browsers th {background-color:#ddd;font-family:verdana;font-size:11px;} #graded-browsers th, #graded-browsers td {border-width:0 1px 1px 0;border-collapse:collapse;} #graded-browsers td.xgrade {color:#555;background-color:#FFFBCF;} #graded-browsers td.cgrade {color:#555;background-color:#FFBFBF} #graded-browsers td.na {color:#AAA;} #graded-browsers td.agrade {background-color:#CFC;} #graded-browsers tr.first th {text-align:center;} #graded-browsers tr th {text-align:right;} #graded-browsers abbr {cursor:help;} #graded-browsers p.gbs-dagger-note {font-size:11px;font-family:verdana;} /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }