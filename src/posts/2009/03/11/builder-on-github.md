---
layout: layouts/post.njk
title: "YUI Builder Now Available on GitHub"
author: "Jenny Donnelly"
date: 2009-03-11
slug: "builder-on-github"
permalink: /blog/2009/03/11/builder-on-github/
categories:
  - "Development"
---
The ANT-based component build tool that we use to build YUI components from their source code is now publicly available on [GitHub](http://github.com/yui/builder/tree/master). This is a component build tool targeted at processing the source for a single component (say, TabView) and creating its relevant build files into the /build directory. This tool does the following:

1.  Lints (JSLint) and minifies (YUI Compressor) source JavaScript
2.  Minifies source CSS (YUI Compressor)
3.  Concatenates source files to create single JS files and single CSS files
4.  Creates fully minified JS files and -debug versions (with YAHOO.log statements preserved for debugging)
5.  Other minor housekeeping

With this tool publicly available, you can now build and test changes you make to a YUI component after you've forked the source code on GitHub.

For more information about the Build Tool, start with the collection of links here: [http://yuilibrary.com/projects/builder](http://yuilibrary.com/projects/builder).

[A forum is available on YUILibrary.com](http://yuilibrary.com/forum/viewforum.php?f=95) to support you as you begin exploring the Build Tool.

Thanks and congratulations to Satyen Desai, the YUI engineer who has been evolving this tool and who did the work to prepare and document the tool for public distribution.