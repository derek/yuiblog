---
layout: layouts/post.njk
title: "Shifter, fast YUI module building"
author: "Dav Glass"
date: 2012-08-27
slug: "shifter-fast-yui-module-building"
permalink: /2012/08/27/shifter-fast-yui-module-building/
categories:
  - "Development"
---
Our build system has been on my mind lately, our old ant system was just getting too slow to keep up with the changes I was making and it was making it very difficult for our Automatic [Travis](http://travis-ci.org/yui/yui3 "Travis") Pull Request builds to test incoming changes properly if it took so long to build our modules. One night a week or so back I couldn't sleep, so I built [Shifter](http://yui.github.com/shifter/ "Shifter"). Shifter is a command line tool built in [Node.js](http://nodejs.org "Node.js") using the [Gear.js](http://gearjs.org/ "Gear.js") build system. Gear.js was chosen as the base system because it's what powers [Mojito Shaker](https://github.com/yahoo/mojito-shaker) plus it's small and good at what it does. ![](/yuiblog/blog/wp-content/uploads/2012/08/ShifterBlog.jpg "ShifterBlog")

### Why It's Faster

Shifter get's a lot of its speed from streaming changes throughout the build process. Our old builder would write files into a temp directory, then perform its tasks on them (compress, filter, concat, etc). This made it inherently slow to begin with. Shifter processes all its files as strings and only writes to disk when it has completed its job. Shifter replaces our need to use Ant, but we still have a Java dependency (for YUI Compressor and YUI Test Coverage). However, these Java dependencies have been streamlined so they don't use file access either. Both [YUI Compressor](https://npmjs.org/package/yuicompressor) and [YUI Test Coverage](https://npmjs.org/package/yuitest-coverage) have npm packages that allow them to be required as a Node.js module and used asynchronously. YUI Test Coverage was updated to allow you to pipe a file into the jar and print the results to standard out similar to the way YUI Compressor handles it. This allows the Node.js module to spawn the Java process under the hood while piping the files into the jar and not writing files to disk. The other way that Shifter optimizes builds is that it doesn't do anything twice if it doesn't have to. With the old builder, modules would get built once for debug, raw and minified files, then again for rollups and again for coverage files. This wasted a lot of cycles, but it was more of a limitation of ant (XML is not a coding language). Shifter deals with rollups a little differently. Instead of building the files again, the default action for a rollup is merging several prebuilt modules into one file and stamping it with the rollup module stamp (the `YUI.add` wrapper. Depending on your system, you should see build times improved anywhere from 30% to 1000%!

### Installation

Installation is simple, `npm -g install shifter`, it's been tested on OSX, Linux and Windows as long as you are running a recent Node.js build.

### When To Use It

We are recommending anyone that builds a YUI module (for themselves or as a contribution) should switch to using Shifter. When you run Shifter on your module the first time, it will parse your ant build files for you and create a `build.json` file to use in their place. Once you have verified that your module builds properly, we are recommending that you remove your ant files and forget about them.

### Gallery Builds

For now, please do **not** remove your ant files from your Gallery modules. The current Gallery build is being rewritten, once that is complete it will have support for Shifter builds (actually it will only use Shifter). For now, feel free to use it to build your Gallery modules but remember that if you submit a CDN request you must have your ant files in your repository.

### Docs and Stuff

Of course it [has docs](http://yui.github.com/shifter/), how else are you going to know how to if it's a feature or a bug! I've also documented the relevant keys from the [build.json](http://yui.github.com/shifter/#build.json) file to help when you are building your own. And as always, [Pull Requests](https://github.com/yui/shifter) are always welome!