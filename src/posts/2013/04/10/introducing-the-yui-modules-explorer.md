---
layout: layouts/post.njk
title: "Introducing the YUI Modules Explorer"
author: "YUI Team"
date: 2013-04-10
slug: "introducing-the-yui-modules-explorer"
permalink: /2013/04/10/introducing-the-yui-modules-explorer/
categories:
  - "Development"
---
### What is It?

[YUI Modules Explorer](https://github.com/ipeychev/yui-modules-explorer) automatically discovers the required modules for YUI based projects. It parses JavaScript files using [esprima](http://esprima.org/). The project is BSD licensed and contributions are welcome.

### Why is this project needed?

In YUI everything is a module. The modules are reusable and loaded on demand, only when needed. Every page loaded in browser (or script on the server) requires one or more modules. For example, if you want to work with DOM then you will need some YUI core modules like [node-core](http://yuilibrary.com/yui/docs/api/modules/node-core.html) which provides the [Node](http://yuilibrary.com/yui/docs/api/classes/Node.html) class. If you create your own [Widget](http://yuilibrary.com/yui/docs/widget/) then you will need modules like [widget-base](http://yuilibrary.com/yui/docs/api/modules/widget-base.html). [YUI Loader](http://yuilibrary.com/yui/docs/api/classes/Loader.html) is in charge of resolving and loading all dependencies of these modules. The developer only has to specify the modules which a given page requires but there is a potential issue. Sometimes this task is not as easy as it looks.

The goal is to specify the modules as clearly as possible and more importantly to not specify modules that are not required by the page, because this will only increase the network download size. The normal way to achieve this is to read the documentation and examples provided by YUI Team. In complex projects, this may be a hard task. In the past few years working on different YUI based projects, I get tired of doing this over and over again. This is a tedious task and leads to errors. That is why I decided to create a tool which will be able to do this automatically just by reading the source files. I needed some time to convince myself this is doable and it will worth the effort, and finally one weekend I sat down and [YUI Modules Explorer](https://github.com/ipeychev/yui-modules-explorer) (YME) was born.

### How does it work?

The developer has to specify one or more files (or a directory) and YME will scan and parse them using esprima. It will then create a file which contains the discovered modules. The output format is JSON so it can be easily read and further manipulated. To achieve this, YME relies on the data.json file which is being generated automatically by [YUIDoc](http://yui.github.com/yuidoc/). What is cool is that if your files are properly documented, YME will be able to discover your custom modules in addition to those which belong to YUI itself.

### What statements are supported?

I tried to cover all the typical usage scenarios I was able to discover. Here are some examples:

-   Simple usage of some class (for those who are familiar with these terms - “MemberExpression”):

In this case, YME will discover that only one module is needed - “overlay”.

-   Classes, referenced by aliases:

Here YPA is an alias of Y.Plugin.AutoComplete and we need “autocomplete-plugin” module.

-   Methods, directly attached to Y instances:

Here we need two modules - "node-core” and “yui-throttle".

-   Methods, required by values of class attributes. Typical example is YUI AutoComplete:

Here in addition to "autocomplete-plugin”, we need “autocomplete-filters" too.

### How to install it?

Just do `npm install -g yme`

## How fast is it?

Well, on my laptop with i5 processor running Ubuntu, it parses the whole yui3 src tree in about 6 seconds.

$ time yme -d ../yui/yui3/src

Successfully parsed: 1257 files  
Failed: 147 files  
Total: 1404 files

real 0m6.834s  
user 0m6.504s  
sys 0m0.352s

For the record, the files marked as “failed” contain invalid syntax and esprima cannot parse them.

Looking at the above numbers, I guess it is not so slow. Of course, everything could be improved and I will be really happy to get some feedback and contributions from the community.

The project is hosted on GitHub. If you discover any issues, please report them [here](https://github.com/ipeychev/yui-modules-explorer/issues?state=open). I will also wait for your contributions!

### Credits.

I would like to say “thanks” to YUI Team for their wonderful documentation and YUIDoc project. Without them this project couldn’t be released. Also, special thanks to Dav Glass ([@davglass](https://twitter.com/davglass)), who helped me with some YUI internals, and thanks as well to the [esprima](http://esprima.org/) project.

![iliyan](/yuiblog/wp-content/uploads/2012/11/iliyan-150x150.png) _**About the author:** Iliyan Peychev (@ipeychev)_ Iliyan Peychev started as a C developer eleven years ago, when he was writing software for banks and other financial institutions. Then he became a Java developer working in the area of SmartCards and Security. Today he is fully devoted to JavaScript and front-end development, and he is highly interested in server-side JavaScript, real time data processing, and remotely controlling and monitoring various devices and systems.