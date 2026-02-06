---
layout: layouts/post.njk
title: "Managing your JavaScript Modules with YUI 3 Stockpile"
author: "John Lindal"
date: 2012-11-06
slug: "managing-your-javascript-modules-with-yui-3-stockpile-2"
permalink: /2012/11/06/managing-your-javascript-modules-with-yui-3-stockpile-2/
categories:
  - "Development"
---
The [YUI Loader](http://yuilibrary.com/yui/docs/yui/loader.html) has revolutionized the management of JavaScript, and the [Gallery](http://yuilibrary.com/gallery/) has made it easy to distribute and use open source modules. However, I have always been concerned about the restriction to a single gallery version in the YUI configuration. If one must upgrade to a new gallery version to get a feature in module A, that will force upgrading to newer versions of all the other gallery modules. What if one of those new versions has a bug? Ideally, one should be able to specify a fixed version for each module so they can be upgraded separately.

Thus, eight months ago I began work on [YUI 3 Stockpile](https://github.com/jafl/YUI-3-Stockpile), a NodeJS combo handler which supports versioning. The name stockpile was chosen because it’s a synonym of gallery, but without the glamorous connotation. Since the Gallery contains all the open source modules, Stockpile is intended for managing collections of modules internal to an organization. Separate teams working at different speeds upload new versions whenever they are ready, and consumers upgrade to new versions when they have the time to do thorough testing.

Unfortunately, one side effect of having to specify a version for every module is that the list of versions can get quite long for complex modules that have many dependencies. In order to lessen this annoyance, YUI 3 Stockpile supports bundles of modules. The entire bundle is assumed to be released as a unit, just like the YUI core libraries, and thus a single version number applies to all the modules in a bundle. In addition to simplifying the configuration, bundling modules allows Stockpile to optimize its response to the YUI Loader, returning not only the requested modules but all the required dependencies within the bundle. This reduces the total number of requests made by YUI Loader, so `use(...)` can execute sooner.

Speaking of dependencies, I have seen various ways of defining the required version(s) of a dependency. In my opinion, none of these solutions were successful, because they were all painful to use and inevitably required hacks when I needed to use versions of modules which were not declared to be compatible. Stockpile therefore does not even try to tell you which versions are compatible. Module maintainers can indicate this information in the version notes, but it is ultimately up to the consumer to choose a version of each module and test the result thoroughly.

### Combo Handler

The core of Stockpile is the combo handler which responds to requests from YUI Loader. It is configured with a document root from which to serve JavaScript, CSS, and other assets. An MRU cache can be configured so the most common requests are served directly from memory instead of having to be read from disk every time. (A charting UI is planned, to help tune this cache.) Clustering is also supported, so the combo handler can use all the available cores. Unfortunately, since NodeJS clustering makes it very difficult to share state between the processes, the cache is local to each process. It is therefore advisable to use a separate cache on top of the combo handler if you want to use clustering. (See below for further discussion about caching.)

### Management Interface

Stockpile provides a command-line interface for uploading modules to the combo handler’s document root. This makes it easy to automatically upload a new version after a successful CI build. The command-line tools are written in Perl because it is ubiquitous.

The server that handles upload requests also provides a web interface for browsing the module repository. For each module or bundle, it displays version notes, the code required to configure the version in YUI Loader, and the source code.

### Development Mode

It would be very annoying if one had to upload a new version to Stockpile in order to test it. To enable rapid iteration, a separate dev combo handler can be layered on top of the normal combo handler. The dev version is configured to recognize the module names that are under development and return local files. All other modules names are retrieved from the normal combo handler. The local and remote results are then stitched together and returned to YUI Loader.

### Caching

As mentioned above, clustering and caching are incompatible. To get the highest throughput, clustering should be enabled in Stockpile, and caching should be layered on top. In order to support CDN's like [CloudFlare](http://www.cloudflare.com) which ignore query args, Stockpile accepts a custom format to make the request look like a normal URL: `/combo~a~b~c`

To use this format, simply configure the group for YUI Loader as follows:

```
comboBase: "http://host:port/combo~",
comboSep:  "~"

```

### Conclusion

While Stockpile is probably overkill for individuals and small projects, my hope is that larger organizations will find it to be useful when managing multiple applications built using YUI.

Stockpile is available under the [BSD License](https://github.com/jafl/YUI-3-Stockpile/blob/master/LICENSE). All the details about how to configure and use it are available on [github](https://github.com/jafl/YUI-3-Stockpile).

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) regularly contributes to the YUI 3 Gallery._