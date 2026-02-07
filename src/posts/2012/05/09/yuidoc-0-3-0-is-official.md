---
layout: layouts/post.njk
title: "YUIDoc 0.3.0 is Official!"
author: "Dav Glass"
date: 2012-05-09
slug: "yuidoc-0-3-0-is-official"
permalink: /2012/05/09/yuidoc-0-3-0-is-official/
categories:
  - "Releases"
  - "Development"
---
Today we are pleased to announce the official release of the new [YUIDoc](http://yui.github.com/yuidoc/), our JavaScript documentation generator. YUIDoc is a [Node.js](http://nodejs.org/) application that generates API documentation from comments in source, using a syntax similar to tools like Javadoc and Doxygen. YUIDoc is currently powering the [API documentation for YUI](http://yuilibrary.com/yui/docs/api/) and has been [actively updated over the last year](https://github.com/yui/yuidoc/graphs/commit-activity).

[![Click for a larger image](https://img.skitch.com/20120509-t3hxuyb4bi1rj7j47y5n9xh8w6.jpg)](http://img.skitch.com/20120509-c29b9x4yg1119ibypuug3sc5st.jpg)  
[\[View Larger Image\]](http://img.skitch.com/20120509-c29b9x4yg1119ibypuug3sc5st.jpg)

### YUIDoc provides:

-   **Live previews.** YUIDoc includes a standalone doc server, making it trivial to preview your docs as you write.
-   **Modern markup.** YUIDoc's generated documentation is an attractive, functional web application with real URLs and graceful fallbacks for spiders and other agents that can't run JavaScript.
-   **Wide language support.** YUIDoc was originally designed for the YUI project, but it is not tied to any particular library or programming language. You can use it with any language that supports `/* */` comment blocks.

Some of the new features added to this version are:

-   Markdown support in code comments
-   Support for many more tags out of the box
-   Logic separated to allow for easy extensibility
-   Better theming support
-   Server mode for development time previews
-   External data mixing
-   Easy cross platform installation
-   Cross-linking inside and out of current project
-   JSON based configuration

Let's get into a little more detail on some of these:

### Simple Installation

If you have Node.js and NPM installed, installation is easy:

> ```
> npm -g install yuidocjs
> ```

### Markdown support in code comments

YUIDoc will parse your comment with [Markdown](http://daringfireball.net/projects/markdown/) before it applies the Handlebars template giving you great flexibility when writing your docs.

### Logic separated to allow for easy extensibility

YUIDoc uses YUI's class infrastructure internally and exports all of these modules when you `require` the `yuidocjs` module. This allows end users to hook into YUIDoc's internals and change the way it does things. You can extend classes, augment them or just flat out change methods to suite your needs.

### Better theming support

In this release we use the built-in [`Y.Handlebars`](http://yuilibrary.com/yui/docs/handlebars/) helper to handle all template generation. We have also taken development into consideration when building this feature. YUIDoc will first search it's built in theme directory for partials, then it will search your local theme directory. This allows you to only have to maintain the files you wish to change in your theme and not have to copy every partial even if you are not modifying it.

### Server mode for development time previews

This is my favorite new feature! You can fire up YUIDoc in server mode and it will give you live previews of your documentation as you edit it. Simply save your file and reload the page from the built in server and see your changes live. Including external data and cross-linking. You no longer have to generate the docs for your entire project just to see a documentation change!

### External data mixing

YUIDoc now allows you to link your documentation to the rendered output from another YUIDoc instance. For example, if your project is using YUI and extending some of our core classes, you can link to our exported `data.json` file (from our YUIDoc build) and when YUIDoc parses your documentation it will fetch our data and cross-link all of your extended classes back to ours. This way you don't have to document another projects code, you simply point over to their docs like it was part of yours.

### Project Changes

All future YUIDoc development will be fully conducted on Github. We will be tracking the project on their wiki and using their issues to manage our tickets. It will be run like a native Node.js project completely in the open. We will also be using a Google Group for support requests, so [sign up today](https://groups.google.com/forum/#!forum/yuidoc)! We are also happy to report that YUIDoc's unit tests are hosted on [Travis-CI](http://travis-ci.org/#!/yui/yuidoc) and will run per Github push!

-   [Source](https://github.com/yui/yuidoc)
-   [Documentation](http://yui.github.com/yuidoc)
-   [API Docs](http://yui.github.com/yuidoc/api/)
-   [Google Group](https://groups.google.com/forum/#!forum/yuidoc)
-   [Travis-CI](http://travis-ci.org/#!/yui/yuidoc)

### What about the old version of YUIDoc?

The old Python source for YUIDoc is in a [branch](https://github.com/yui/yuidoc/tree/python) on the current Github repo where it will remain indefinately. There are no plans on accepting any pull requests or making any updates to that code base.