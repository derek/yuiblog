---
layout: layouts/post.njk
title: "YUI Weekly – Aug 17th, 2012"
author: "Derek Gathright"
date: 2012-08-17
slug: "this-week-in-yui-aug-17th-2012"
permalink: /blog/2012/08/17/this-week-in-yui-aug-17th-2012/
categories:
  - "YUI Weekly"
---
-   The [Gallery](http://yuilibrary.com/gallery/) build & deploy process was reduced from 1.5 hours, to 4 minutes (← not a typo, O\_O ). This is actually related to all those CDN upgrades we did a few months back, as we're now taking advantage of some of the shiny new features.
    
-   ScrollView is nearing the end of a major remodeling. We don't have anything committed into Master yet, but soon. As part of the release process, we'd like to engage with some existing ScrollView users to assess any backwards compatibility issues that may be introduced. If interested, ping dgathright in the #yui IRC room on [freenode](http://webchat.freenode.net/). This update will introduce dualaxis support (no more nested ScrollViews!) as well as numerous bug fixes and additional enhancements.
    
-   We’re doing quite a bit of ongoing performance work on Event. If interested, CC yourself to [this bug](http://yuilibrary.com/projects/yui3/ticket/2532411) and we’d love to have some early adopters for our next PR release to test out some of these updates. Stay tuned.
    
-   Alex Kessinger (of the upcoming App.net project) wrote a great overview on their use of YUI Grids @ [How you can create a responsive grid system using YUI3 grids and SASS](https://gist.github.com/3362608). Responsive Grids is actually something we’re working on, and we’ll discuss in more detail in the future. In the meantime, here's [a preview](http://gridbuilder.herokuapp.com/).
    
-   Ryan Grove and Brian Strong [posted some thoughts](http://sorcery.smugmug.com/2012/08/09/speeding-up-smugmug-search/) on how they sped up SmugMug's search results page, and in doing so, created some [new](http://yuilibrary.com/yui/docs/api/classes/LazyModelList.html) [modules](https://github.com/rgrove/yui3/tree/node-scroll-info/src/node-scroll-info) they've since contributed back to YUI. Thanks guys!
    
-   If you are a GWT user, you might find the recently released [yui4gwt](http://code.google.com/p/yuigwt/) interesting. [Examples](http://cancerbero.vacau.com/yuigwt/). (credit: Cancerbero\_sgx)
    
-   Here’s a [proof of concept](https://gist.github.com/3375276) for using YUI inside of a WebWorker, pulling modules from the CDN (something the same-origin policy normally prevents). It’s a useful Gist to learn about modules & APIs like WebWorkers, gallery-async, gallery-yql-rest-client, BlobBuilder, createObjectURL, and more. (credit: solmsted, original [fiddle](http://jsfiddle.net/uqt5c/))
    
-   As of this week, TravisCI is now testing [YUICompressor](http://travis-ci.org/yui/yuicompressor), in addition to [YUI3](http://travis-ci.org/yui/yui3/).
    
-   Gallery updates this week: [gallery-accordion](http://yuilibrary.com/gallery/show/accordion), [gallery-datatable-footerview](http://yuilibrary.com/gallery/show/datatable-footerview), [gallery-handlebars-loader](http://yuilibrary.com/gallery/show/handlebars-loader), [gallery-idletimer](http://yuilibrary.com/gallery/show/idletimer), [gallery-imagecropper](http://yuilibrary.com/gallery/show/imagecropper), [gallery-log-filter](http://yuilibrary.com/gallery/show/log-filter), [gallery-md-model](http://yuilibrary.com/gallery/show/md-model), [gallery-paginator-view](http://yuilibrary.com/gallery/show/paginator-view).
    

If you have anything interesting to share, please leave a comment below. Thanks!