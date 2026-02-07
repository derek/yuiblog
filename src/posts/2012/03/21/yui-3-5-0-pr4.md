---
layout: layouts/post.njk
title: "YUI 3.5.0 PR4 Is Now Available"
author: "YUI Team"
date: 2012-03-21
slug: "yui-3-5-0-pr4"
permalink: /2012/03/21/yui-3-5-0-pr4/
categories:
  - "Releases"
  - "Development"
---
![YUI 3.5.0 PR4](/yuiblog/wp-content/uploads/2012/03/350pr41.jpg "YUI 3.5.0 PR4") Illustration is adapted from [a photo by Michael Myers (@Fristle on Flickr)](http://www.flickr.com/photos/fristle/4503812795/)

YUI 3.5.0 Preview Release 4, the last preview before the official release, is now available to the developer community for feedback and testing on the Yahoo! CDN at [yui.yahooapis.com/3.5.0pr4/build/yui/yui-min.js](http://yui.yahooapis.com/3.5.0pr4/build/yui/yui-min.js), or [as a download](http://yui.zenfs.com/releases/yui3/yui_3.5.0pr4.zip) if you plan to test it locally. As [previously noted](/yuiblog/2012/03/12/update-on-3-5-0-release-schedule/), we are simultaneously releasing PR3 and PR4 and actively seeking community feedback against PR4 now.

The [rollup of 3.5.0 changes introduced up through PR4](https://github.com/yui/yui3/wiki/YUI-3.5.0-Change-History-Rollup) is available on our GitHub Wiki. You can also take a look at the lists of resolved tickets for [PR3](http://yuilibrary.com/projects/yui3/report/118) and [PR4](http://yuilibrary.com/projects/yui3/report/119).

Work-in-progress [user guides](http://stage.yuilibrary.com/yui/docs/guides/) and [API docs](http://stage.yuilibrary.com/yui/docs/api/) for 3.5.0 can be found on our [staging site](http://stage.yuilibrary.com), but beware that these docs may be incomplete or even broken until the official release. Official docs for the latest stable release can always be found on our production site, [yuilibrary.com](http://yuilibrary.com/).

A few items of note in this release:

-   The old (3.4.1) **Uploader** and **DataTable** modules have been deprecated in lieu of new replacements and are now available as **uploader-deprecated** and **datatable-\*-deprecated**, respectively.
-   **Button** underwent a significant refactoring. Please take a moment to check out the new API and file any issues in our [bug tracking system](http://yuilibrary.com/projects/yui3/newticket/).
-   **WidgetButtons**, which adds support for buttons in a **Panel** has been significantly improved.
-   A new event submodule, **event-contextmenu** has been introduced.
-   **Calendar** has been made keyboard-navigable and accessible, and calendar navigation now supports disabled button states.
-   **Uploader**'s queue management has been refined, and **UploaderFlash** now supports keyboard navigation.
-   **App.Transitions** has added cross-fade and slide transitions to **Y.App**s.
-   **Y.Handlebars** has been fully and thoroughly documented.

To file bugs against this release, please visit our [bug tracking system](http://yuilibrary.com/projects/yui3/newticket/). If you'd like to provide input on these and future modules, the ongoing discussions on various topics relating to the 3.5.0 release are happening on our [GitHub wiki.](https://github.com/yui/yui3/wiki/Ongoing-development-discussions)

We plan to release 3.5.0 final in mid-April. Happy testing!