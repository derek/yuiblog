---
layout: layouts/post.njk
title: "YUI 2.3.0: Six New Components and a Prettier Face"
author: "Eric Miraglia"
date: 2007-07-31
slug: "yui-2-3-0-released"
permalink: /2007/07/31/yui-2-3-0-released/
categories:
  - "Releases"
  - "Development"
---
[![YUI 2.3.0 is now available as a download from SourceForge.](http://us.i1.yimg.com/us.yimg.com/i/ydn/yuiweb/download_1.gif)](http://developer.yahoo.com/yui/download/)We're pleased to announce today the release of YUI version 2.3.0. This release features six new additions to the library as well as a new skinning architecture and a new visual treatment for most of our UI controls. All of this, plus 250 enhancements and bug fixes, is [available for download immediately](http://developer.yahoo.com/yui/download/).

### **Here's what's new to YUI in version 2.3.0:**

1.  **Rich Text Editor (beta):** YUI developer [Dav Glass](http://blog.davglass.com/2006/06/yui-code-samples/) brings you the new [YUI RTE,](http://developer.yahoo.com/yui/editor/) featuring rich-text editing with robust [A-Grade browser support](http://developer.yahoo.com/yui/articles/gbs/). Cross-browser support has always been a major challenge for RTEs, and we think you'll be impressed with how well this editor works across the various environments. You can instantiate it with just a few lines of code for simple implementations, and when you need to go beyond the ordinary it's easy to extend the RTE's Toolbar with your own custom buttons.  
    [![Try out the YUI RTE with a custom Flickr photo extension.](/yuiblog/blog-archive/assets/rte.gif)](http://developer.yahoo.com/yui/examples/editor/flickr_editor.html)
2.  **Base CSS:** [Nate Koechley](http://nate.koechley.com/blog/) continues to extend and refine the YUI CSS foundation, which now includes four members — [Reset CSS](http://developer.yahoo.com/yui/reset/) neutralizes browser CSS treatments; the new [Base CSS](http://developer.yahoo.com/yui/base/) applies some consistent and common style treatments that many developers use as a foundation; [Fonts CSS](http://developer.yahoo.com/yui/fonts/) provides a foundation for typography; and [Grids CSS](http://developer.yahoo.com/yui/grids/) delivers CSS-driven wireframes for thousands of potential page designs.
3.  **YUILoader Utility (beta):** YUI's most prolific author Adam Moore has contributed the new [YUILoader Utility](http://developer.yahoo.com/yui/yuiloader), a mechanism for loading YUI components (and/or your own custom components) on the page via client-side script. YUILoader knows all about YUI's dependency tree and introduces into the page only those files that are needed to support your desired components. [It can load files from Yahoo! servers](http://developer.yahoo.com/yui/articles/hosting/) or from your own hosted location.
4.  **ImageLoader Utility (experimental):** Yahoo! Travel engineer Matt Mlinac authored the new [YUI ImageLoader Utility](http://developer.yahoo.com/yui/imageloader/), which allows you to defer the loading of some images to speed initial rendering time on your pages. If you suspect that you're serving a lot of images that are never actually seen by your users, you'll want to check out Matt's work on this clever utility.
5.  **Color Picker Control (beta):** Adam Moore built the new [YUI Color Picker Control](http://developer.yahoo.com/yui/colorpicker/) on top of his own Slider Control. The Color Picker provides a powerful UI widget for color selection, featuring HSV, RGB, and Hex input/output and a web-safe color-selection swatch.
6.  **YUI Test Utility (beta):** [Nicholas C. Zakas](http://www.nczonline.net/), who works on My Yahoo! when he's not writing books or blogging on YUIBlog, authored our new [YUI Test Utility](http://developer.yahoo.com/yui/yuitest/). YUI Test introduces a flexible unit-testing framework for the YUI ecosystem and serves as the foundation for our own unit-test battery.

### YUI Shows Some Skin

[![The new YUI Sam Skin.](/yuiblog/blog-archive/assets/skin.gif)](http://developer.yahoo.com/yui/articles/skinning/)YUI components have always been receptive to implementation-specific styling, but with 2.3.0 we've moved to a more formal [skinning approach](http://developer.yahoo.com/yui/articles/skinning/) that helps to separate core CSS definitions from purely presentational ones. YUI's support for skinning makes it easier for you to implement your own design on top of, say, the [TabView Control](http://developer.yahoo.com/yui/tabview/) — and it makes it easier to share that skin with others in the community.

In concert with that effort, Yahoo! designer Sam Lind pitched in over the past several months to help us create an attractive, consistent visual treatment for the many UI controls in YUI that ship with a default look-and-feel. This baseline skin is much more stylish than what we've shipped in the past; many thanks to Sam for his hard work. In his honor, we're calling this debut visual treatment the "Sam Skin". Hopefully this will be just the first of many YUI skins that evolve within the developer community as time goes on.

### More To Come

The YUI Team will have more to say over the coming weeks about what's new in 2.3.0, including in-depth looks at the Rich Text Editor, [the skinning approach](http://developer.yahoo.com/yui/articles/skinning/), other new components, and Jenny Han's significantly upgraded [DataTable Control](http://developer.yahoo.com/yui/datatable/). In the meantime, [George Puckett from the YUI team has posted a detailed release manifest to our forums](http://tech.groups.yahoo.com/group/ydn-javascript/message/15989) and there are release notes accompanying every component (available [on the website](http://developer.yahoo.com/yui/) and as part of [the download](http://developer.yahoo.com/yui/download/)).

We've been working hard on YUI since the last release and we're excited to share this work with everyone today. Please check out the new version and let us know what you think.