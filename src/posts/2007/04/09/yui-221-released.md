---
layout: layouts/post.njk
title: "YUI Version 2.2.1 Released, and Graded Browser Support Update"
author: "YUI Team"
date: 2007-04-09
slug: "yui-221-released"
permalink: /2007/04/09/yui-221-released/
categories:
  - "Development"
---
Today is the release of version 2.2.1 of the Yahoo User Interface (YUI) Library, and the update to our [A-Grade Browser Chart](http://developer.yahoo.com/yui/articles/gbs/#gbschart). While the previous release brought new components and significant revisions, this release is primarily about bug fixes. [Download the new distribution](http://developer.yahoo.com/yui/download/) or point to the new [hosted urls](http://developer.yahoo.com/yui/articles/hosting/) to get the latest code. You can read about the fixes in the release notes, though there are two notable changes we'd like to highlight.

### DataTable

There's been a flurry of discussion in the [YUI Forums](http://tech.groups.yahoo.com/group/ydn-javascript/) about the [DataTable control](http://developer.yahoo.com/yui/datatable/). Thank you all for testing it out and providing the feedback that we count on, especially during this beta period. DataTable is still a beta control in this release, but it's much improved now with many significant fixes such as:

-   The **pagination API** has been refactored and updated.
-   **Row selection** has been changed to better mimic the desktop paradigm.
-   **Scrolling** is now customizable via CSS.
-   **Table messaging** has been improved for empty and error states.
-   A number of other smaller fixes, including:
    -   Links within the body of the table
    -   Column sorting of empty values
    -   Fields with the name "id"
    -   Resizability in the `-min` build
    -   And many more!

### Event

There's also been [discussion](http://ajaxian.com/archives/when-do-dom-elements-become-available) in the blogosphere about `window.onload`, `DOMContentLoaded`, and `defer`. In short, the `window.onload` event fires after all of the page's content has been loaded: DOM, images and all. But what if you want to execute your script when just the DOM loads, without waiting for everything else?

Dean Edwards [addressed this problem](http://dean.edwards.name/weblog/2005/09/busted/) for Internet Explorer and Mozilla/Firefox, and later [included an update](http://dean.edwards.name/weblog/2006/06/again/) for embedded JavaScript ([from Matthias Miller](http://www.outofhanwell.com/blog/index.php?title=the_window_onload_problem_revisited)) and Safari (from [John Resig's jQuery](http://jquery.com/)).

We're happy to announce the inclusion of the `onDOMReady` event in the [Event utility](http://developer.yahoo.com/yui/event/)! Now YUI developers can execute their JavaScript when the DOM loads, and before everything else loads too. This utility also provides the `onAvailable` event, which fires when a specified DOM node loads, and the `onContentReady` event, which fires when a specified DOM node, plus all of its children, loads.

### Graded Browser Support Update

We typically provide an update to our [chart of A-Grade browsers](http://developer.yahoo.com/yui/articles/gbs/index.html#gbschart) at the beginning of each quarter. There are two important changes in this update. First, we've initiated A-grade support for Firefox 2.† and IE 7.0 on Windows Vista. Second, we've started to use the dagger symbol (†) to indicate a single flexible version number that receives support.

The dagger symbol (as in "Firefox 2.†") indicates that "the latest single non-beta version at that branch level" receives support. Put another way, "Firefox 2.†" means we support v2.0.0.4, but not v2.0.0.3 (because it's not the single newest) nor v3.0 (because that's outside of the 2.† branch). If Firefox 2.0.0.5 is released, 2.0.0.4 will no longer receive A-grade support; † means "the most recent" instead of "all."

Having this flexibility for certain browsers allows us keep up with frequently released browsers while still maintaining a sane QA testing footprint.