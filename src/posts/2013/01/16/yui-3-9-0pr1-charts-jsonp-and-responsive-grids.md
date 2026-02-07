---
layout: layouts/post.njk
title: "YUI 3.9.0pr1 - Charts, JSONP, and Responsive Grids"
author: "YUI Team"
date: 2013-01-16
slug: "yui-3-9-0pr1-charts-jsonp-and-responsive-grids"
permalink: /2013/01/16/yui-3-9-0pr1-charts-jsonp-and-responsive-grids/
categories:
  - "Releases"
  - "Development"
---
**YUI 3.9.0pr1** is now available to the developer community for feedback and testing on the [Yahoo! CDN](http://yui.yahooapis.com/3.9.0pr1/build/yui/yui-min.js "YUI 3.9.0pr1 seed file") (and as a [download](http://yui.zenfs.com/releases/yui3/yui_3.9.0pr1.zip "YUI 3.9.0pr1 zip distribution")), on [npm](https://npmjs.org/package/yui "Node.js Packaged Module"), and our [staging website](http://stage.yuilibrary.com/) has the updated documentation.

This branch was cut from the 3.x branch on **Tuesday, January 15th** and includes everything in master up to that point as well. Our current sprint will reach code freeze phase on **Friday, January 18th** with a release earmarked for **Tuesday, January 22nd**. The version number of a release will depend on its contents, so this preview release is from our 3.x branch and we rely on your feedback to decide if 3.9.0 will be the next production-ready release of YUI. If not, we will cut a release from our master branch as 3.8.1 at the end of the current development sprint.

### Chart Axis Modularization

[Tripp Bridges](https://github.com/tripp) has been working on refactoring [Charts](http://yuilibrary.com/yui/docs/charts/) under the hood. As you can see from this [comprehensive pull request](https://github.com/yui/yui3/pull/373) there have been some changes to the organization of axis classes. The primary goal for this is to allow users to include different modules that can be used to build custom chart applications.

If you are a current user of [Charts](http://yuilibrary.com/yui/docs/charts/) you are encouraged to try out this preview release and test your existing implementations. There should be no change in behavior, and you should not have to change anything about your own code. If you have any issues, please [file a ticket](http://yuilibrary.com/projects/yui3/newticket/).

### JSONP updates: Async Support and YQL Module

Part of our new process involves making sure all pull requests get reviewed and acted on once they are ready to go and approved by Reviewers. Once such pull request review (for [#371](https://github.com/yui/yui3/pull/371)) resulted in changes for [JSONP](http://yuilibrary.com/yui/docs/jsonp/) (pull request [#396](https://github.com/yui/yui3/pull/396)) which adds `Y.Get.js().execute()` support. (Special thanks to : [Luke Smith](https://github.com/lsmith), [Dav Glass](https://github.com/davglass), [Eric Ferraiuolo](https://github.com/ericf), and [Ryan Grove](https://github.com/rgrove) for making it happen so quickly! )

Another [pull request](https://github.com/yui/yui3/pull/395) related to JSONP added a new YQL module for using JSONP, effectively allowing it to be conditionally loaded if needed or not in environments like Node.js and Win8 that do not.

### Deprecated and Removed Modules

`datatable-deprecated` and `uploader-deprecated` have been [removed](https://github.com/yui/yui3/pull/390). `substitute` has been moved to [deprecated status](https://github.com/yui/yui3/pull/389). You should use `Y.Lang.sub` or `Y.Template` instead. If you rely on `substitute` in your codebase, this is a good time to start migrating to these alternative methods. Also note, `Y.Template` has added the concept of [default options](https://github.com/yui/yui3/pull/368).

### Node.js Script Loading

YUI community member [solmsted](https://github.com/solmsted) contributed [a change](https://github.com/yui/yui3/pull/367) to `Y.Get.js` to hook deeper into Node.js' module system to normalize the environment between scripts loaded by `Y.Get.js` and `require`. Please test this out in your own implementations now while we are in PR to uncover any potential bugs.

### Responsive Grids

[Tilo Mitra](https://github.com/tilomitra) has continued the work started in his ongoing [gridbuilder](http://yui.github.com/gridbuilder/) development and [folded those rules back](https://github.com/yui/yui3/pull/363) into CSSGrids. He's introducing a new file structure that creates `cssgrids-responsive.css` which includes `cssgrids-units.css`, `cssgrids-base.css`, and `cssgrids-responsive-base.css`. This also changes the classname `yui3-g-responsive` to `yui3-g-r`. Please check out the [documentation for this](http://stage.yuilibrary.com/yui/docs/cssgrids/) on the staging website and give us feedback on this new feature.

### Happy Testing!

For a complete list of changes in **3.9.0pr1**, please refer to the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.9.0-Change-History-Rollup) for this release.

We do these preview rleases so you can test them in your applications and give us your feedback. If you find a bug, or want to suggest an enhancement, please don't hesitate to [file a ticket](http://yuilibrary.com/projects/yui3/newticket/). **Thank you, and happy testing!**