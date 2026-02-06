---
layout: layouts/post.njk
title: "Minification v Obfuscation"
author: "Douglas Crockford"
date: 2006-03-06
slug: "minification-v-obfuscation"
permalink: /blog/2006/03/06/minification-v-obfuscation/
categories:
  - "Development"
---
JavaScript is a load-and-go language. Programs are delivered to the execution site as text (not as executable or semi-compiled class files) where it is compiled and executed. JavaScript works well with the Web, which is a text delivery system, because it is delivered as text.

There are two downsides of textual delivery of programs. The first is code size. The source can contain material (such as whitespace and comments) which aids in the human interpretability of the program, but which is not needed for its execution. Transmitting superfluous material can significantly delay the download process, which keeps people waiting. If we could first strip out the whitespace and comments, our pages would load faster.

The second downside is code privacy. There might be a concern that someone could read the program and learn our techniques, and worse, compromise our security by learning the secrets that are embedded in the code.

There are two classes of tools which deal with these problems: minifiers and obfuscators.

A minifier removes the comments and unnecessary whitespace from a program. Depending on how the program is written, this can reduce the size by about half. An obfuscator also minifies, but it will also make modifications to the program, changing the names of variables, functions, and members, making the program much harder to understand, and further reducing its size in the bargain. Some obfuscators are quite aggressive in their transformations. Some require special annotations in the source program to indicate what changes might or might not be safe.

Any transformation carries the risk of introducing a bug. Even if the obfuscator didn't cause the bug, the fact that it might have is a distraction which will slow down the debugging process. The modifications to the program also add significantly to the difficulty of debugging.

After minifying or obfuscating, you should GZIP. GZIP can further reduce the size of the program. GZIP is so effective that the difference in the efficiency between minification and obfuscation becomes insignificant. So I prefer minification with GZIP because I don't have time for programming tools that can inject bugs into good programs.

<table class="empirical"><tbody><tr><td>&nbsp;</td><th scope="col">Full Source</th><th scope="col">Minified</th></tr><tr><th scope="row">Uncompressed</th><td>78151</td><td>38051</td></tr><tr><th scope="row">Compressed with gzip</th><td>15207</td><td>10799</td></tr></tbody></table>

The table shows the results of using a [minifer](http://javascript.crockford.com/jsmin.html) and [gzip](http://www.gzip.org/) on a [78K source file](http://www.jslint.com/fulljslint.js). The result of using the two techniques together produced a result that is only 14% the size of the original source file.

Then finally, there is that question of code privacy. This is a lost cause. There is no transformation that will keep a determined hacker from understanding your program. This turns out to be true for all programs in all languages, it is just more obviously true with JavaScript because it is delivered in source form. The privacy benefit provided by obfuscation is an illusion. If you don't want people to see your programs, unplug your server.