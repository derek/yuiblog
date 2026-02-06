---
layout: layouts/post.njk
title: "YUI Gallery Deprecation Announcement"
author: "Julien Lecomte"
date: 2014-06-16
slug: "yui-gallery-deprecation-announcement"
permalink: /2014/06/16/yui-gallery-deprecation-announcement/
categories:
  - "YUI 3 Gallery"
---
Since it was [first introduced](/yuiblog/blog/2009/11/04/introducing-the-yui-3-gallery/) in 2009, the [YUI Gallery](https://yuilibrary.com/gallery/) has been a great tool for web developers, allowing them to contribute to the YUI library in a more open way, make their YUI modules more discoverable, and deploy them at scale using Yahoo’s CDN. As a result, the YUI Gallery now contains over 600 modules.

Since that time, the industry has drastically changed and evolved. New tools, which did not yet exist when the YUI Gallery was introduced, have since been widely adopted by the community. [GitHub](https://github.com/), package managers ([npm](https://www.npmjs.org/), [bower](http://bower.io/)), build tools ([grunt](http://gruntjs.com/) and its [myriad of plugins](http://gruntjs.com/plugins)) and free or cheap CDNs ([cdn.rawgit.com](http://rawgit.com/faq), [jsDelivr](http://www.jsdelivr.com/), [cdnjs](http://cdnjs.com/), [CloudFare](http://www.cloudflare.com/), etc.) have made it much easier for developers to share and deploy their modules efficiently. As a result, the YUI Gallery is not as actively used by the community as it used to be. However, the cost of maintaining it is still there. Therefore, **the YUI team has made the difficult but necessary decision to deprecate the YUI Gallery**.

The last gallery build will take place on **Thursday, July 31st, 2014**. All the modules that have been published to the gallery prior to that time will continue to be available from Yahoo!’s CDN as they have always been. However, after the last gallery build, it will not be possible to publish any new modules, or update an existing module, to the YUI Gallery. This means that modules will no longer be pushed to the [yui3-gallery repository on GitHub](https://github.com/yui/yui3-gallery) and no new gallery modules will be pushed to Yahoo!’s CDN. If you try to publish a module after that date, [yogi](http://yui.github.io/yogi/) will return an error. Finally, the YUI Gallery web site will be statically archived for posterity.

As I mentioned, all the modules that have been published to the YUI Gallery prior to Thursday, July 31st, 2014 will continue to be available from Yahoo!’s CDN as they have always been. But what if you need to update an existing module (to fix a bug for example)? After the last gallery build, updating your gallery component will not update the corresponding artifact on Yahoo!’s CDN. Thankfully, there is a very simple and straightforward solution to that problem. Because the source code and build artifacts of YUI Gallery modules are hosted on GitHub, you can load those modules directly by taking advantage of [cdn.rawgit.com](http://rawgit.com/faq). Here is a trivial example of how to do that:

Additionally, just like you would do with any other JavaScript resources, you can also bundle modules together, host them on your own servers, and deploy them using your own CDN provider.

If you publish a YUI module to the npm or bower registry (for example) and wish to make it more discoverable, we recommend that you tag your package with the `yui-module` tag.

If you need additional support, or have questions related to the deprecation of the YUI Gallery, feel free to post a question to the [gallery sub-component of the yui-support group](https://groups.google.com/forum/#!categories/yui-support/gallery).

Julien and the YUI team @ Yahoo