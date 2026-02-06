---
layout: layouts/post.njk
title: "Announcing YUI Compressor 2.4.7"
author: "Satyen Desai"
date: 2011-11-14
slug: "announcing-yui-compressor-2-4-7"
permalink: /2011/11/14/announcing-yui-compressor-2-4-7/
categories:
  - "Development"
---
We're pleased to announce the immediate availability of version 2.4.7 of the [YUI Compressor](http://yuilibrary.com/projects/yuicompressor/). This version contains fixes to Compressor's handling of CSS minification in a couple of core areas. It does not contain any JS Compression changes.

### CSS minification

-   Fixed data URL handling, so that it large data URL values don't crash or slow down CSS Compression.
-   Fixed hex color value compression logic (#AABBCC -> #abc), so that the Compressor doesn't inadvertently compress ID selectors (#AddressBook {...}) .
-   All Java CSS Compressor fixes have been ported to the JS Compressor.
-   All fixes are backed up by unit tests.

### Links

YUI Compressor 2.4.7 is available for immediate [download](http://yuilibrary.com/downloads/#yuicompressor). Feel free to help us out by [filing a bug or feature request](http://yuilibrary.com/projects/yuicompressor/report/1), [contributing code or tests](https://github.com/yui/yuicompressor) or [joining the conversation](http://yuilibrary.com/forum/viewforum.php?f=94).