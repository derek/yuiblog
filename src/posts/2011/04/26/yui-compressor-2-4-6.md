---
layout: layouts/post.njk
title: "Announcing YUI Compressor 2.4.6"
author: "Stoyan Stefanov"
date: 2011-04-26
slug: "yui-compressor-2-4-6"
permalink: /2011/04/26/yui-compressor-2-4-6/
categories:
  - "Development"
---
We're pleased to announce the immediate availability of version 2.4.6 of the [YUI Compressor](http://developer.yahoo.com/yui/compressor/). This version contains mostly updates related to Compressor's handling of CSS minification and introduces batch processing of multiple files with a single command.

### CSS minification

Highlights include:

-   Fixed numerous bugs that break the compressor and/or the resulting minified files.
-   Added [documentation](http://developer.yahoo.com/yui/compressor/css.html) on what exactly the minifier does and also which CSS hacks it tolerates.
-   There's a JavaScript port of CSS min in case it's more suitable for your build process. [Here's also a test web UI](http://tools.w3clubs.com/cssmin/) that uses the JavaScript port, where you can experiment with the minifier.
-   A significant number of [new tests](https://github.com/yui/yuicompressor/tree/master/tests/) added (but you can [add even more](http://developer.yahoo.com/yui/compressor/css.html#tests)).
-   Safe handling of some CSS features that are getting more adoption such as media queries and CSS3 transforms.

### Batch processing

Another welcome addition to Compressor is that it can now handle batches of files. This can significantly reduce the time your build process takes, especially if you have a great number of files to minify. For example the following commands minify all `.js` and `.css` files and write the minified files with a "-min.css" suffix.
```
$ java -jar yuicompressor.jar -o '.css$:-min.css' *.css
$ java -jar yuicompressor.jar -o '.js$:-min.js' *.js
```
Thanks go out to [Stephen Woods](http://twitter.com/ysaw) and the [Flickr team](http://www.flickr.com/about/#team) for this feature!

### Links

YUI Compressor 2.4.6 is available for immediate [download](http://yuilibrary.com/downloads/#yuicompressor). Feel free to help us out by [filing a bug or feature request](http://yuilibrary.com/projects/yuicompressor/report/1), [writing more tests](http://developer.yahoo.com/yui/compressor/css.html#tests), [forking the code](https://github.com/yui/yuicompressor) or [joining the conversation](http://yuilibrary.com/forum/).