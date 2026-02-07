---
layout: layouts/post.njk
title: "YUI 3.13.0 Released"
author: "Andrew Wooldridge"
date: 2013-10-07
slug: "yui-3-13-0-released"
permalink: /2013/10/07/yui-3-13-0-released/
categories:
  - "Releases"
  - "Development"
---
We are very happy to announce the release of **YUI 3.13.0**! You can find this release via the [Yahoo CDN](http://yui.yahooapis.com/3.13.0/build/yui/yui-min.js), installable through [npm](https://npmjs.org/package/yui), or available as a [download](http://yui.zenfs.com/releases/yui3/yui_3.13.0.zip). We have also updated the [YUI Library website](http://yuilibrary.com/) to reflect changes in this release.

## In This Release

Much of the information about this release is detailed in our [Release Candidate blog post](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/). The components updated by this release are listed below.

-   [Router](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#router)
-   [Model](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#model)
-   [Button](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#button)
-   [Calendar](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#calendar)
-   [DataTable](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#datatable)
-   [Rich Text Editor](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#rich)
-   [Event, Custom Event, and Event ValueChange](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#event)
-   [File](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#file)
-   [Graphics](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#graphics)
-   [History](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#history)[](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#node)
-   [Node and ScrollInfo Node Plugin](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#node)
-   [Paginator](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#paginator)
-   [Transition](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#transition)
-   [Uploader](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#uploader)
-   [Widget](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#widget)
-   [YUI Core](/yuiblog/2013/10/02/yui-3-13-0-release-candidate-1/#yuicore)

## Removals and Deprecations

-   SimpleYUI - It was [deprecated a while back](/yuiblog/2013/06/04/yui-3-10-2-released/#deprecations), and has been removed for this release.
-   `.swf` files - All of the `.swf` files in the YUI repo have been [removed](https://groups.google.com/forum/#!topic/yui-contrib/_SaE7C8Asks), and a new unsupported repo ([yui3-swfs](https://github.com/yui/yui3-swfs)) has been created with the source files, if you want to compile and host your own `.swf` files.
-   `widget-locale` - This component was deprecated a long time ago, and now has been removed from the source code.
-   [YUI PHP Loader](https://github.com/yui/phploader) - It has been deprecated in this release and will no longer be supported.
-   [YUI 2in3](https://github.com/yui/2in3) - This component has been deprecated in this release and may be removed in a future release as per the [deprecation policy](https://github.com/yui/yui3/wiki/Deprecation-Policy).

## More Information

There was a total of [**544** commits by **19** contributors](https://github.com/yui/yui3/compare/v3.12.0...v3.13.0) for this release. If you would like to read more about the details of the changes for this release, check out the [Change History Rollup](https://github.com/yui/yui3/wiki/YUI-3.13.0-Change-History-Rollup) as well as the [GitHub comparison](https://github.com/yui/yui3/compare/v3.12.0...v3.13.0) with **YUI 3.12.0**. We run almost 9,000 tests per [target environment](http://yuilibrary.com/yui/environments/) daily on our source code and we are always looking into ways to improve the process. If you find an issue, [please file it on GitHub](https://github.com/yui/yui3/issues/new). If you would like to contribute tests, documentation, code fixes, and new features, please check out our [Contributing to YUI](https://github.com/yui/yui3/wiki/Contributing-to-YUI) Wiki entry. We also have a special set of [up for grabs issues](https://github.com/yui/yui3/issues?direction=desc&labels=up+for+grabs&page=1&sort=created&state=open) that can serve as an excellent way to get involved in the YUI community.