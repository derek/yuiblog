---
layout: layouts/post.njk
title: "YUI 3.4.0 Preview Release 2"
author: "Unknown"
date: 2011-06-23
slug: "yui-3-4-0-preview-release-2"
permalink: /2011/06/23/yui-3-4-0-preview-release-2/
categories:
  - "Releases"
  - "Development"
---
The YUI team has just completed the second sprint of the 3.4.0 development cycle. We've posted the results of the sprint to the CDN for community exploration and feedback. You can access this release at [http://yui.yahooapis.com/3.4.0pr2/build/yui/yui-min.js](http://yui.yahooapis.com/3.4.0pr2/build/yui/yui-min.js). There are some particular areas of the library where we'd love to have community feedback:

-   There have been some changes to Loader to support flattening the organization of dependencies in the library. In addition, the allowRollup config is now false by default. You'll need to pay close attention to your dependencies when working with this new configuration as the includes are more fine-grained to allow for smaller total downloads. There may be instances where additional files had been downloaded in the past as part of rollups that are no longer included with the revised Loader, so you may need to include more modules in your code's `use()` call. If you're doing manual load specifications via `use("*")` or make use of submodule configurations, please try your code with the updated Loader to be sure we're correctly handling your use case.
-   The new Calendar component is now included in the build. This is a very early release consisting of Calendar's core functionality. Skinning and additional features will continue to be added ahead of the 3.4.0 launch.
-   The App Framework, YUI's new suite of MVC infrastructure components, is fully functional and ready for use.
-   Two new widget-level plugins allow widgets to be modal and hide on certain user interactions.
-   WidgetPositionAlign syncs on scroll and window-resize.
-   You will also find updates to the Graphics API, performance enhancements in Base, bug fixes in Dial, and many more additions throughout the library.

You can get additional information on the content of this release by reviewing the [ReadMe Rollup](http://yuilibrary.com/projects/yui3/wiki/ReadMe/RollUp_3.4.0PR2) and the [full list of tickets addressed in PR2](http://yuilibrary.com/projects/yui3/report/76). Please file any enhancement requests, bugs and regressions in [the ticket database on YUILibrary.com](http://yuilibrary.com/projects/yui3/newticket?version=3.4.0%20PR2).