---
layout: layouts/post.njk
title: "YUI Version 2.2.0 Released: Browser History Manager, DataTable, and Button Components, New Versioning, and More"
author: "YUI Team"
date: 2007-02-20
slug: "yui-220-released"
permalink: /2007/02/20/yui-220-released/
categories:
  - "Releases"
  - "Development"
---
[![Download YUI](http://us.i1.yimg.com/us.yimg.com/i/ydn/yuiweb/download_1.gif)](http://developer.yahoo.com/yui/download/)We released version 2.2.0 of [the Yahoo User Interface Library (YUI)](http://developer.yahoo.com/yui/) today. This release is one of the most substantial revisions we've done to the library since its inception. Leading the change manifest is a new versioning track and three brand-new YUI components:

### New versioning, 0.12.2 —> 2.2.0:

YUI was released internally at Yahoo! about six months before it was released for public use under [a BSD license](http://developer.yahoo.com/yui/license.html) in February 2006. Although the internal and external versions of the library were identical, the way we built and distributed them was different and we managed those differences with separate versioning tracks. Today we're merging the internal and external project versioning and reaffirming that [the YUI you can download here](http://developer.yahoo.com/yui/download/) is exactly the same YUI Library used all across Yahoo!. Hence, we're retiring the old public version series (which had reached 0.12.2) and we're unifying the versioning of this release at v2.2.0.

### Browser History Manager

[![Read more about the new YUI Browser History Manager](/yuiblog/blog-archive/assets/history-chsh.gif)](http://developer.yahoo.com/yui/history/) Building desktop-style applications within web browsers — which were designed to read hyperlinked pages, not to run apps — has created many challenges. Not the least of these challenges involves handling "back/forward" navigation buttons and bookmarking. First, there's the tough question about just what the back button or bookmark _should_ do in your app to be consistent with your user's intuition/expectation. Then there's the question of how to make your desired implementation work across all the [A-Grade Browsers](http://developer.yahoo.com/yui/articles/gbs/). No one, as far as we know, has resolved the technical issues in a satisfactory way across the A-Grade. Today we're releasing the [YUI Browser History Manager](http://developer.yahoo.com/yui/history/), an [experimental](http://developer.yahoo.com/yui/articles/faq/#experimental) component that supports all A-Grade browsers in managing the back/forward button navigation and bookmarking for dynamic web pages. Stay tuned to YUIBlog for a deep-dive on Browser History Manager from its author, Julien Lecomte, later this week.

### DataTable Control

YUI engineer Jenny Han Donnelly, who brought you the [Logger](http://developer.yahoo.com/yui/logger/) and [AutoComplete](http://developer.yahoo.com/yui/autocomplete/) Controls, rolls out her third component today with the [DataTable Control](http://developer.yahoo.com/yui/datatable/) ([beta](http://developer.yahoo.com/yui/articles/faq/#beta)). Tabular data is one of the most common UI presentation tasks. DataTable allows you to present tabular data and allow your user to engage that presentation by modifying/enhancing the data, sorting and searching through it, and adjusting the presentation itself (by, for example, changing column widths). DataTable's debut featureset includes:

-   **Progressive enhancement:** DataTable is built on the foundation of HTML table element markup, providing a solid progressive-enhancement path.
-   **Nested column headers**
-   **Custom sort functions**
-   **XHR data sources:** Integration with [Connection Manager](http://developer.yahoo.com/yui/connection) offers robust support for pulling in off-page data.
-   **Inline editing:** Contents of cells can be editable, allowing users to update the information they're reviewing.

This is just our first release of the DataTable control, and we know that there are many possibilities for pushing this implementation further; we look forward to hearing your feedback in the [YUI Forums](http://tech.groups.yahoo.com/group/ydn-javascript/) about this release and what you'd like to see next.

### Button Control

Todd Kloots, author of the [Menu Control](http://developer.yahoo.com/yui/menu/), today brings you the new [Button Control](http://developer.yahoo.com/yui/button/) ([beta](http://developer.yahoo.com/yui/articles/faq/#beta)). Buttons are essential parts of most graphical interfaces, but the visual constraints of buttons in their various form-control implementations (submit buttons, radio buttons, check boxes, etc.) diminish their effectiveness in some applications. The Button Control provides a platform for implementing visually impactful buttons that range from standard click-to-navigate buttons to radio buttons and checkboxes to advanced split-buttons that can operate as both a button and a menu.

### Other Noteworthy Changes

In addition to the three new components and the new versioning scheme, YUI in 2.2.0 incorporates a number of other significant changes to the library generally and to components specifically. Some noteworthy changes include the following:

-   **Reorganization of utility classes:** Several utility classes (including [Element](http://developer.yahoo.com/yui/element/) and [KeyListener](http://developer.yahoo.com/yui/docs/YAHOO.util.KeyListener.html)) were originally introduced as part of the component for which they were written — Element, for example, was part of the [TabView](http://developer.yahoo.com/yui/tabview/) distribution. We have begun a reorganization of these utility classes, allowing them to serve a wider range of YUI components and to be more logically accessible within your own implementations. Today, KeyListener becomes part of Event and Element breaks out of TabView to become its own ([beta](http://developer.yahoo.com/yui/articles/faq/#beta)) component...and hence a new dependency for TabView.
-   **The YAHOO Global Object:**
    -   [![Read more about the enhanced YAHOO Global Object](/yuiblog/blog-archive/assets/yahoo-object-chsh.gif)](http://developer.yahoo.com/yui/yahoo/)**`YAHOO.lang`:** The [YAHOO Global Object](http://developer.yahoo.com/yui/yahoo/) now ships with a `lang` member; `extend` and `augment` are moved under `YAHOO.lang`, as are a variety of new utility methods for determining object types. Among `YAHOO.lang`'s members is a `hasOwnProperty` method normalizing the behavior of that test for Safari 1.3 and older. We have implemented `YAHOO.lang.hasOwnProperty` for all of YUI's `hasOwnProperty` invocations; although Safari 1.3 is not an [A-Grade browser](http://developer.yahoo.com/yui/articles/gbs/), this should allow YUI-based applications to degrade more generously on older versions of Safari.
    -   `**YAHOO.env**:` `YAHOO.env` is another new YAHOO-object member introduced with v2.2.0; it contains version and build information for all YUI components that have been loaded in the current window. Using `YAHOO.env`'s methods and data, you can determine which of your required components are already on a page and, if present, which version has been loaded. (Note that versioning information will only be available for implementations of YUI from v2.2.0 onward.) This facilitates, for example, the work of engineers creating YUI-based badges and modules that appear in diverse contexts, some of which already include YUI implementations.
-   **New YAHOO\_config global:** With this release we are introducing a new global variable, `YAHOO_config`, that allows you to define certain configuration characteristics of YUI prior to loading the YAHOO Global Object. The significant and immediate win here is that you can use `YAHOO_config` to define a listener that will be invoked any time a YUI component is loaded on the page. For scenarios where you're adding components dynamically, this will prove valuable in ensuring that dependencies are loaded in the correct sequence.

There's much more we could say about this release, and there's more to come on YUIBlog soon — plus a nice bit we're looking forward to sharing with you [at the party on Thursday](/yuiblog/blog/2007/02/05/first-year-party/). For now we encourage you to [download the new distribution](http://developer.yahoo.com/yui/download/), explore the updated documentation [on the YUI website](http://developer.yahoo.com/yui/), and begin exploring it for yourself. Release notes for each component can be accessed from that component's main documentation page; it's in those release notes that you'll find detailed change manifests for each component.