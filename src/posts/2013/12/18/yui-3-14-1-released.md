---
layout: layouts/post.njk
title: "YUI 3.14.1 Released"
author: "Andrew Wooldridge"
date: 2013-12-18
slug: "yui-3-14-1-released"
permalink: /2013/12/18/yui-3-14-1-released/
categories:
  - "Development"
---
We are happy to announce the release of **YUI 3.14.1**! This release can be found on the [Yahoo CDN](http://yui.yahooapis.com/3.14.1/build/yui/yui-min.js "Yahoo CDN"), through [npm](https://npmjs.org/package/yui "npm"), and via [download](http://yui.zenfs.com/releases/yui3/yui_3.14.1.zip). We also have updated the [YUI Library website](http://yuilibrary.com/) to reflect the changes in this release.

## What's New In This Release

The primary purpose of this "point" release is to add IE11 and Android 4.4 to our [Target Environments](http://yuilibrary.com/yui/environments/). We've been testing this release both manually and through CI to ensure that any new issues were addressed.

### Support Added for IE11 and Android 4.4

There were fixes to several tests this time around to resolve issues specific to IE11 and Android 4.4. This included an [issue](https://github.com/yui/yui3/pull/1482) with [ImageLoader](http://yuilibrary.com/yui/docs/imageloader/) fetching images that were out of date, an [issue](https://github.com/yui/yui3/pull/1501) with skin loading, and [issues](https://github.com/yui/yui3/pull/1505) with [Editor](http://yuilibrary.com/yui/docs/editor/).

Also, there were several code changes such as a [fix](https://github.com/yui/yui3/issues/1483) by [Ryan Grove](https://github.com/rgrove) to [ScrollInfo](http://yuilibrary.com/yui/docs/api/classes/Plugin.ScrollInfo.html) and a [refactor](https://github.com/yui/yui3/commit/680a9e80751528748eb64857eb80745eb66d0dd3) of the feature detection in [XML-parse](http://yuilibrary.com/yui/docs/api/files/xml_js_xml-parse.js.html).

### Charts Regression Fix

Also, there was an [issue](https://github.com/yui/yui3/issues/1475) (introduced in **YUI 3.14.0**) in [Charts](http://yuilibrary.com/yui/docs/charts/) that is fixed for this release. The issue was that the `_maxSize` property was not updated for a single series histogram and would cause the column/bar to disappear on mouseover.

## Additional Information

There was a total of 28 commits by 5 contributors for this release. You can find the details of the changes by reading the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.14.1-Change-History-Rollup) as well as looking at the [differences between 3.14.0 and 3.14.1](https://github.com/yui/yui3/compare/v3.14.0...v3.14.1) in GitHub. Over 9,000 tests in CI are run across our target environments for every commit to our source. If you run across an issue, please feel free to [file it in GitHub](https://github.com/yui/yui3/issues/new) (after signing in) so we can continuously improve YUI!