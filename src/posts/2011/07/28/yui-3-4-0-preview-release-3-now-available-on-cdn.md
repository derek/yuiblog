---
layout: layouts/post.njk
title: "YUI 3.4.0 Preview Release 3 Now Available on CDN"
author: "George Puckett"
date: 2011-07-28
slug: "yui-3-4-0-preview-release-3-now-available-on-cdn"
permalink: /2011/07/28/yui-3-4-0-preview-release-3-now-available-on-cdn/
categories:
  - "Development"
---
The YUI team has just completed the final development sprint for the 3.4.0 release. At this time we consider the code functionally complete. We are planning to spend our next sprint focusing on our final round of testing and creating more examples and documentation. We have posted an FC (functional complete) build to the CDN for community exploration and feedback. You can access this release at [http://yui.yahooapis.com/3.4.0pr3/build/yui/yui-min.js](http://yui.yahooapis.com/3.4.0pr3/build/yui/yui-min.js).

There are some particular areas of the library where we'd love to have community feedback:

-   **Loader** has had a significant update for 3.4.0. If you are doing manual load specifications via `use("*")` or make use of submodule configurations, we'd greatly appreciate you trying your code with the new Loader to be sure we are correctly handling all use cases. For more detailed information on the Loader changes in this release, refer to the [blog post describing 3.4.0 Loader changes](/yuiblog/blog/2011/07/01/yui-and-loader-changes-for-3-4-0/).
-   **Calendar** and **Panel** are fully functional and ready for developer use.
-   **Graphics:** There have been a few API changes that will affect any experimental code written on the Graphics API distributed in the PR2 release. `getShape()` has been renamed `addShape()`. There have also been several attribute replacements.
-   **Transition:** Native transitions are now supported in FireFox.
-   **WidgetButtons** has been released as a new Widget extension that allows you to place css-styled buttons in the header and footer of any widget that implements standard module support.
-   **Widget-Modality** and **Widget-AutoHide** plugins have been converted to extensions.
-   **Widget:** Added support for destroy(true) which will remove and destroy all child nodes (not just the boundingBox and contentBox) contained within the Widget's boundingBox. destroy() will maintain its current behavior due to the potentially high run-time cost of destroying all child nodes. If you destroy Widgets in your application or are a custom widget developer, your help in testing this change would be appreciated.
-   **ScrollView** now supports vertical paging, includes a scrollview-list plugin to add CSS classnames to immediate list elements, as well several bug fixes and refactoring
-   **App Framework**: We want to extend a sincere thank you to all of the developers in the community who have taken the time to test drive the new App Framework. We have received excellent feedback following the PR2 release. Please continue to explore these components and send us your observations and suggestions.

You can get additional information on the content of this release by reviewing the [History Rollup](http://yuilibrary.com/projects/yui3/wiki/ReadMe/RollUp_3.4.0PR3) and the [full list of tickets addressed in PR3](http://yuilibrary.com/projects/yui3/report/79). Please file any enhancement requests, bugs and regressions in [the ticket database on YUILibrary.com](http://yuilibrary.com/projects/yui3/newticket?version=3.4.0%20PR3).