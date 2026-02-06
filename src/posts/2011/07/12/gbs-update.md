---
layout: layouts/post.njk
title: "Graded Browser Support Update"
author: "Jenny Donnelly and Matt Sweeney"
date: 2011-07-12
slug: "gbs-update"
permalink: /2011/07/12/gbs-update/
categories:
  - "Development"
---
### GBS Changes

Specific changes for this update include:

-   [No longer assign experience grades](#grades-deprecated)
-   [Discontinued prescribing specific operating systems (except for mobile)](#os-deprecated)
-   Added coverage for Internet Explorer 9
-   Added coverage for Firefox 4.
-   Added coverage for Firefox 5.

### Browser Test Baseline

<table border="1" cellpadding="2" cellspacing="0" style="text-align:center"><tbody><tr><th>Internet Explorer</th><td>6.0</td><td>7.0</td><td>8.0</td><td>9.0</td></tr><tr><th>Firefox</th><td colspan="2">3.†</td><td>4.†</td><td>5.†</td></tr><tr><th>Chrome †</th><td colspan="4">Latest stable</td></tr><tr><th>Safari</th><td>5.†</td><td colspan="2">iOS 3.†</td><td>iOS 4.†</td></tr><tr><th>Webkit</th><td colspan="4">Android 2.†</td></tr></tbody></table>

_Notes:_

-   The dagger symbol (as in “Firefox 4.�) indicates that the most-current non-beta version at that branch level receives support.
-   No guidance is given on iOS or Android OS device usage. The recommendation is that you choose the devices that are most representative of your user base for each OS.

### Removing Grades from the Browser Test Baseline

This edition of the GBS update represents a departure from our previous updates in that we are moving away from mapping browsers directly to experience grades (e.g. "A-grade" and "C-grade"). Rather than prescribe what user experience is appropriate for which browsers, we'll focus on defining an efficient baseline test strategy that maximizes test coverage and minimizes the testing surface. For example, IE6's still-significant global marketshare warrants continued testing; however today's GBS allows for the IE6 user experience to be different from the IE9 experience.

### Removing Operating Systems from the Browser Test Baseline

In order to streamline testing and minimize resource requirements, we no longer specify which operating system should be tested on. The only exception is when the browser is tightly coupled with the OS version, in which case we refer to the OS version rather than the browser version (e.g. "Safari iOS 4"). This allows us to focus test coverage on browser versions, and minimize redudant testing across platforms. Issues with the same browser across versions are negligible, and generally related to higher-level OS differences, such as key handling and available fonts. Code that is known to touch upon cross-platform issues should be tested on as many platforms as possible, but this testing generally can be isolated to the specific issues rather than running a full regression test of all features. We recommend aligning operating system testing priority with your user base.

### Why is IE6 Still on the List?

IE6 still has a significant enough global market share to warrant a verified acceptable user experience. One common misconception with the Progressive Enhancement strategy has been that once a browser enters "C-grade" that it becomes "unsupported", when in fact it really means that it should be delivered the HTML-only experience. Now that we no longer prescribe which browsers receive what experience, this is left for projects to decide based on their users and resources. The GBS focuses on specifying which browsers need a verified usable experience based on factors such as market share and influence. Defining what is "usable" and specifiying acceptable levels of degradation are left for teams to decide. We still promote a simple [Progressive Enhancement](http://developer.yahoo.com/yui/articles/gbs/) model, and discourage projects from creating new tiers without accounting for the additional costs in development, testing, and maintenance resources.

### GBS Forecast

We expect to make the following changes in the next update:

-   Discontinue coverage for Safari on iOS 3.
-   Add coverage for Webkit on Android 3.
-   Add coverage for Firefox 6.
-   Add coverage for Safari iOS 5.

### The GBS Archive

-   [GBS Update, 2010-11-03](/yuiblog/blog/2010/11/03/gbs-update-2010q4/)
-   [GBS Update, 2010-02-16](/yuiblog/blog/2010/02/16/gbs-update-2010q1/)
-   [GBS Update, 2009-10-16](/yuiblog/blog/2009/10/16/gbs-update-2009q4/)
-   [GBS Update, 2009-07-02](/yuiblog/blog/2009/07/02/gbs-update-20090702/)
-   [GBS Update, 2009-01-28](/yuiblog/blog/2009/01/28/gbs-update-20090128/)
-   [GBS Update, 2008-07-03](/yuiblog/blog/2008/07/03/gbs-update-20080703/)
-   [GBS Update, 2008-02-19](/yuiblog/blog/2008/02/19/gbs-update-20080219/)