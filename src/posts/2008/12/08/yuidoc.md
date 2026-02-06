---
layout: layouts/post.njk
title: "YUI Doc: A New Tool for Generating JavaScript API Documentation"
author: "Eric Miraglia"
date: 2008-12-08
slug: "yuidoc"
permalink: /2008/12/08/yuidoc/
categories:
  - "Development"
---
[![](/yuiblog/blog-archive/assets/yuidoc-20081205-153330.jpg)](http://developer.yahoo.com/yui/yuidoc/)

We're pleased today to release the first public version of [YUI Doc](http://developer.yahoo.com/yui/yuidoc/), a python-based documentation tool that generates API documentation for JavaScript code. YUI Doc was developed by Adam Moore, one of the principal engineers on the YUI project since its inception, to support YUI's API-level documentation.

-   [YUI Doc User's Guide](http://developer.yahoo.com/yui/yuidoc/)
-   [YUI Doc sample output (YUI API documentation)](http://developer.yahoo.com/yui/docs/)
-   [YUI Doc community forum](http://yuilibrary.com/forum/viewforum.php?f=26)
-   [YUI Doc download](http://yuilibrary.com/downloads/)

Those familiar with JavaDoc, JSDoc, or the [JsDoc Toolkit](http://code.google.com/p/jsdoc-toolkit/) (the latter superceded JSDoc, which no longer sees active development) will find YUI Doc's conventions familiar. It is a comment-driven system in which documentation is parsed from comment blocks that describe the structure of your code. Unlike some analagous systems, YUI Doc is designed to work purely from comments; as a result, there is no idiom or code pattern with which the tool is incompatible.

YUI Doc's principal organizational structures are these:

-   **Project**: The project is the top-level bucket into which a set of documentation is grouped. In the case of YUI's documetnation, YUI itself is the project.
-   **Module**: A module is used to group pieces of code that relate to a functional unit. For example, in YUI the Drag and Drop Utility is a module; the AutoComplte Control is a module; etc. Modules can depend on one another and can be further subdivided into submodules (in YUI 3, we make extensive use of submodule structures to deliver the smallest possible code payloads).
-   **Class**: Classes (and inner classes) are used to describe objects that function as instantiable or static classes in JavaScript. YUI Doc also supports concepts like augmentation, allowing you to document the inheritance structures that characterize your object-oriented applications.
-   **Methods** and **Properties**: Methods and properties are used in the conventional sense to document class members.
-   **Events**: We've added the event construct to YUI Doc to support YUI's Custom Event infrastructure. Where you are building modules that publish events with well known parameters, YUI Doc can help you expose that information through this construct. (As a simple example, when a date is selected in the YUI Calendar Control, the `[selectEvent](http://developer.yahoo.com/yui/docs/YAHOO.widget.Calendar.html#event_selectEvent)` is fired.

YUI Doc is most likely to be of interest to those who are building library-style code to be used by other developers. Because it requires in-line documentation, it is only appropriate to use YUI Doc in combination with a minification tool (like Douglas Crockford's [JSMin](http://www.crockford.com/javascript/jsmin.html) or Julien Lecomte's [YUI Compressor](http://developer.yahoo.com/yui/compressor)). A common scenario would be to incorporate YUI Doc into an existing continuous-build process to generate and publish documentation at build time; your code might be concatenated and version-stamped by Ant, verified by [JSLint](http://www.jslint.com/), documented by YUI Doc, and then minified by YUI Compressor.

![YUI and Git; photo by Dav Glass](/yuiblog/blog-archive/assets/yui-git-by-davglass-20081208-135921.jpg)YUI Doc joins YUI Compressor in the portfolio of build-time processes that we're making available as part of the YUI project. We look forward to your feedback on this beta release. [The source code for YUI Doc has been published on GitHub](http://github.com/yui); if you'd like to get involved in YUI Doc development, we invite you to check out the source ([instructions here](http://yuilibrary.com/gitfaq/)), [sign a CLA](http://developer.yahoo.com/yui/community/contribute.html), and join us in making this the best documentation engine available for serious frontend engineers.

**Footnote:** We're hard at work prepping the YUI 2.x and 3.x code repositories for GitHub deployment as well. We'll have more to share with you on that front in the near future.