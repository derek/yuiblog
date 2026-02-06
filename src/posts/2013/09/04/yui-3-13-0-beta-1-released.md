---
layout: layouts/post.njk
title: "YUI 3.13.0 Beta 1 Released"
author: "Andrew Wooldridge"
date: 2013-09-04
slug: "yui-3-13-0-beta-1-released"
permalink: /blog/2013/09/04/yui-3-13-0-beta-1-released/
categories:
  - "Development"
---
We are happy to announce the release of a new YUI beta: **YUI 3.13.0 beta 1**. It is available on [Yahoo! CDN](http://yui.yahooapis.com/3.13.0-beta-1/build/yui/yui-min.js), a [zip download](http://yui.zenfs.com/releases/yui3/yui_3.13.0-beta-1.zip), and on [npm](https://npmjs.org/package/yui). Our YUI Library [staging website](http://stage.yuilibrary.com/) has been updated as well with the latest changes in this release.

## What's new in this release?

### Editor updates

The primary focus of this release is to provide a build for developers to test a new feature in [Editor](http://stage.yuilibrary.com/yui/docs/editor/). We are adding the ability to use an editor on any node without using iFrames by using HTML 5's [content editable feature](https://developer.mozilla.org/en-US/docs/Web/HTML/Content_Editable). Content editable has been around for quite some time, but recently became standardized by the [WHATWG](http://www.whatwg.org/) and now is available in YUI as an Editor option! The API is the same as the iFrame Editor you may be already familiar with. This means gallery modules or local modules you have that are able to work with the original Editor are now able to work with the [InlineEditor](http://stage.yuilibrary.com/yui/docs/api/classes/InlineEditor.html).

### Other updates

This release also has updates from developers who have been checking in changes and fixes to the `dev-3.x` branch. These changes include the following items.

-   Updates to [DataTable](http://stage.yuilibrary.com/yui/docs/datatable/) include an addition of `contentUpdate` after a DataTable has been updated from a `dataChange`event, a fix to an issue where recursive nesting objects was cloned infinitely, and a fix to Paginator coming out of sync with DataTable when DataTable data was modified.
-   Updates in [History](http://stage.yuilibrary.com/yui/docs/history/) include a fix for an exception in IE10 and another fix for an issue with `parsehash` not parsing blank values in the hash string.
-   In [ScrollInfo](http://stage.yuilibrary.com/yui/docs/api/modules/node-scroll-info.html) there was a fix for `getOffscreenNodes()` and `getOnscreenNodes()` not returning correct values.
-   Fixes in [Widget](http://stage.yuilibrary.com/yui/docs/widget/) include removing the widget-locale module and improving support for single-box widgets (BB === CB) by defaulting `boundingBox` to `srcNode` if `CONTENT_TEMPLATE` is null.

If you are using any of the components listed above please take some time to download and test out this release in your own environments. Every bit of feedback you can give is vital for us to make this release the best one yet, so if you come across a problem please [file a new issue](https://github.com/yui/yui3/issues/new) on GitHub. For a more detailed list of the changes made in this release, please check out the [Change History Rollup](https://gist.github.com/triptych/6430650).

Good luck and happy coding!