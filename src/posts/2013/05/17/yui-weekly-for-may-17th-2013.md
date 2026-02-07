---
layout: layouts/post.njk
title: "YUI Weekly for May 17th, 2013"
author: "Derek Gathright"
date: 2013-05-17
slug: "yui-weekly-for-may-17th-2013"
permalink: /2013/05/17/yui-weekly-for-may-17th-2013/
categories:
  - "YUI Weekly"
---
_Welcome to YUI Weekly, the weekly roundup of news and announcements from the YUI team and community. If you have any interesting demos or links you’d like to share, feel free to leave a comment below._

-   This week saw two new releases for YUI projects. First up was [YUI 3.10.1](/yuiblog/2013/05/14/yui-3-10-1-released-to-fix-swf-vulnerability/), a patch release to resolve a vulnerability detected in the `.swf` files used in the IO utility and Uploader components. Please see [this security bulletin](http://yuilibrary.com/support/20130515-vulnerability/) for more details on the issue and steps to ensure your applications are secure. Also released this week was [YUICompressor 2.4.8](/yuiblog/2013/05/16/yuicompressor-2-4-8-released/), which includes improved compression results as well as general fixes.
    
-   At this week's Open Roundtable ([YouTube](http://www.youtube.com/watch?v=pocEg6a6ZpM)) we invited our friends at Wells Fargo to join us. After some quick intros, we began a discussion about their products and interest in YUI, then dove a bit deeper into some talking points regarding DataTable, Skinning, and Tooling. If DataTable development is something interesting to you, you'll find quite a bit of discussion in [the video](http://www.youtube.com/watch?v=pocEg6a6ZpM) about details of the component and its [upcoming roadmap](https://trello.com/board/datatable-roadmap/518a5e5af277b61271001c3c).
    
-   YUI's [Shifter](https://github.com/yui/shifter/) build tool got a version bump to v0.4.0 this week and you can upgrade via `npm -g install shifter`. This update fixes an issue that was discovered after our migration to Grunt for building releases. The version bump is a minor version (as opposed to a patch version, e.g. v0.3.9) because this does introduce a backwards incompatibility. If you are using a `copy` directive in any of your component `build.json` files, the 2nd parameter is now relative to your component's build path as opposed to the source path, so you'll need to make the appropriate update when you upgrade your copy of Shifter. An example of this change can be seen in [commit 609f7d](https://github.com/yui/yui3/commit/609f7dde90703d819a1d6a50b9f48cd2fafa7969#src/uploader/build.json), which includes updates to `/src/io/build.json` and `/src/uploader/build.json`.
    
-   Thanks to the [AlloyUI](http://www.liferay.com/community/liferay-projects/alloy-ui/overview) crew for our [awesome new t-shirts](https://twitter.com/AlloyUI/status/335433971431264256/photo/1)! If you are unfamiliar with AlloyUI, it's a self-described "UI framework built on top of YUI3 that provides a simple API for building high scalable applications." Their website is full of goodies, such as [examples](http://alloyui.com/examples/), [Tutorials](http://alloyui.com/tutorials/), and [API docs](http://alloyui.com/api/). Check it out!
    
-   Do you have experience with JavaScript, Java, Internationalization, and love solving complex problems at massive scale? Yahoo's internationalization team [is hiring](/yuiblog/2013/05/17/yahoos-international-team-is-hiring/)!
    
-   New and updated [Gallery](http://yuilibrary.com/gallery/) modules include: [debounce](http://yuilibrary.com/gallery/show/debounce), [dd-momentum-plugin](http://yuilibrary.com/gallery/show/dd-momentum-plugin), [task](http://github.com/juandopazo/yui3-task), [scrollspy](http://github.com/juandopazo/yui3-scrollspy), [io-utils](https://github.com/juandopazo/yui3-io-utils), and [affix](http:////github.com/juandopazo/yui3-affix).
    
-   Links of the Week (thanks to [JavaScript Weekly](http://javascriptweekly.com) )
    
    -   [Draft Specification for ES.next (Ecma-262 Edition 6)](http://wiki.ecmascript.org/doku.php?id=harmony:specification_drafts)
    -   [Introducing Augmented JavaScript](http://blog.alxandr.me/2013/05/13/introducing-augmented-javascript/)
    -   [Introduction to Map and Reduce in Javascript](http://www.49lights.com/blogg/2013/05/introduction_to_map_and_reduce_in_javascript/)
    -   [JavaScript Regular Expression Enlightenment](http://tech.pro/tutorial/1214/javascript-regular-expression-enlightenment)
    -   [... and more](http://javascriptweekly.com/archive/130.html)