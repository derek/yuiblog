---
layout: layouts/post.njk
title: "State of YUI Compressor"
author: "Dav Glass"
date: 2012-10-16
slug: "state-of-yui-compressor"
permalink: /blog/2012/10/16/state-of-yui-compressor/
categories:
  - "Development"
---
YUI Compressor has been a great tool for obfuscating and compressing JavaScript and CSS files for several years, but as the web continues to evolve and change, so do the tools we use to develop it. YUI Compressor will be going through a deprecation process as the YUI team moves to using a [custom-wrapped UglifyJS](https://github.com/yui/yuglify) for JavaScript compression and a [more fully updated and maintained version of CSSMin](https://github.com/yui/ycssmin) for CSS compression. This will allow YUI to move beyond the limitations of the current YUI Compressor as well as take advantage of the current state of the art in compression. As a JavaScript library, we are always striving to remove non-JavaScript tools from our system. Having a full JavaScript stack allows our full team and every contributor to update, extend, and help maintain our tools. Which, for us, is a huge win!

The new compression utilities are wrapped into a single node package called [yuglify](https://github.com/yui/yuglify) and new issues can be filed against this project on [GitHub](https://github.com/yui/yuglify/issues). To be clear, this is not a “new compressor” project, this project contains a few tweaks and configuration options that allows us to use UglifyJS & CSSMin in a standard way across our tools. In fact, this new module was pulled directly from existing [Shifter](http://yui.github.com/shifter/) tasks to allow for better portability and re-use across any NodeJS tool.

We have migrated the existing [YUI Compressor website](http://developer.yahoo.com/yui/compressor/) to its [new location](http://yui.github.com/yuicompressor/) on GitHub (pending some redirects from the old site) as well as [previous releases](https://github.com/yui/yuicompressor/downloads). We are considering migrating all of the [current open tickets](https://yuilibrary.com/projects/yuicompressor/report) from the YUILibrary.com site over to GitHub's issue tracker but will only do so if any new community maintainers wish us to.

Not only are our tools evolving but the way we are open-sourcing development is as well! For the first time ever, we will be opening the YUI Compressor project to external community members, including commit access to the repo. We are working to implement a governance model that defines committer access across our product offering. Stay tuned for more details on the YUI Governance Model in the next few weeks. We are very excited to be starting this new chapter in the evolution of our project, and we invite to you participate in this new process and help us continue to build the best toolset for web development.