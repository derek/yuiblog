---
layout: layouts/post.njk
title: "Non-blocking JavaScript Downloads"
author: "Stoyan Stefanov"
date: 2008-07-22
slug: "non-blocking-scripts"
permalink: /blog/2008/07/22/non-blocking-scripts/
categories:
  - "Development"
---
External JavaScript files block downloads and hurt your page performance, but there is an easy way to work around this problem: use dynamic scripts tags and load scripts in parallel, improving the page loading speed and the user experience.

## The problem: scripts block downloads

Let's first take a look at what the problem is with the script downloads. The thing is that before fully downloading and parsing a script, the browser can't tell what's in it. It may contain `document.write()` calls which modify the DOM tree or it may even contain `location.href` and send the user to a whole new page. If that happens, any components downloaded from the previous page may never be needed. In order to avoid potentially useless downloads, browsers first download, parse and execute each script before moving on with the queue of other components waiting to be downloaded. As a result, any script on your page blocks the download process and that has a negative impact on your page loading speed.

Here's how the timeline looks like when downloading a slow JavaScript file (exaggerated to take 1 second). The script download (the third row in the image) blocks the two-by-two parallel downloads of the images that follow after the script:![Timeline - Blocking behavior of JavaScript files](/yuiblog/blog-archive/assets/non-block-yui/1.png)

[Here's the example](/yuiblog/blog-archive/assets/non-block-yui/before.html) to test yourself.

## Problem 2: number of downloads per hostname

Another thing to note in the timeline above is how the images following the script are downloaded two-by-two. This is because of the restriction of how many components can be downloaded in parallel. In IE <= 7 and Firefox 2, it's two components at a time (following the HTTP 1.1 specs), but both IE8 and FF3 increase the default to 6.

You can work around this limitation by using multiple domains to host your components, because the restriction is two components _per hostname_. For more information of this topic check the article "[Maximizing Parallel Downloads in the Carpool Lane](/yuiblog/blog/2007/04/11/performance-research-part-4/)" by Tenni Theurer.

The important thing to note is that _JavaScripts block downloads across all hostnames_. In fact, in the example timeline above, the script is hosted on a different domain than the images, but it still blocks them.

## Scripts at the bottom to improve user experience

As [Yahoo!'s Performance rules](http://developer.yahoo.com/performance/rules.html) advise, you should put the scripts at the bottom of the page, towards the closing `</body>` tag. This doesn't really make the page load faster (the script still has to load), but helps with the progressive rendering of the page. The user perception is that the page is faster when they can see a visual feedback that there is progress.

## Non-blocking scripts

It turns out that there is an easy solution to the download blocking problem: include scripts dynamically via DOM methods. How do you do that? Simply create a new `<script>` element and append it to the `<head>`:

```
var js = document.createElement('script');
js.src = 'myscript.js';
var head = document.getElementsByTagName('head')[0];
head.appendChild(js);

```

Here's the same test from above, modified to use the script node technique. Note that the third row in the image takes just as long to download, but the other resources on the page are loading simultaneously:

![Non-blocking JavaScript timeline](/yuiblog/blog-archive/assets/non-block-yui/2.png)

[Test example](/yuiblog/blog-archive/assets/non-block-yui/after.html)

As you can see the script file no longer blocks the downloads and the browser starts fetching the other components in parallel. And the overall response time is cut in half.

## Dependencies

A problem with including scripts dynamically would be satisfying the dependencies. Imagine you're downloading 3 scripts and `three.js` requires a function from `one.js`. How do you make sure this works?

Well, the simplest thing is to have only one file, this way not only avoiding the problem, but also improving performance by minimizing the number of HTTP requests ([performance rule #1](http://developer.yahoo.com/performance/rules.html#num_http)).

If you do need several files though, you can attach a listener to the script's `onload` event (this will work in Firefox) and the `onreadystatechange` event (this will work in IE). Here's a [blog post](http://www.phpied.com/javascript-include-ready-onload/) that shows you how to do this. To be fully cross-browser compliant, you can do something else instead: just include a variable at the bottom of every script, as to signal "I'm ready". This variable may very well be an array with elements for every script already included.

## Using YUI Get utility

The [YUI Get Utility](http://developer.yahoo.com/yui/get/) makes it easy for you to use script includes. For example if you want to load 3 files, `one.js`, `two.js` and `three.js`, you can simply do:

```
var urls = ['one.js', 'two.js', 'three.js'];
YAHOO.util.Get.script(urls);

```

YUI Get also helps you with satisfying dependencies, by loading the scripts in order and also by letting you pass an `onSuccess` callback function which is executed when the last script is done loading. Similarly, you can pass an `onFailure` function to handle cases where scripts fail to load.

```
var myHandler = {
    onSuccess: function(){
        alert(':))');
    },
    onFailure: function(){
        alert(':((');
    }
};

var urls = ['1.js', '2.js', '3.js'];
YAHOO.util.Get.script(urls, myHandler);

```

Again, note that YUI Get will request the scripts in sequence, one after the other. This way you don't download all the scripts in parallel, but still, the good part is that the scripts are not blocking the rest of the images and the other components on the page. [Here's a good example and tutorial on using YUI Get to load scripts](http://developer.yahoo.com/yui/examples/get/get-script-basic.html).

YUI Get can also include stylesheets dynamically through the method `YAHOO.util.Get.css()` \[[example](http://developer.yahoo.com/yui/examples/get/get-css-basic.html)\].

Which brings us to the next question:

## And what about stylesheets?

Stylesheets don't block downloads in IE, but they do in Firefox. Applying the same technique of dynamic inserts solves the problem. You can create dynamic link tags like this:

```
var h = document.getElementsByTagName('head')[0];
var link = document.createElement('link');
link.href = 'mycss.css';
link.type = 'text/css';
link.rel = 'stylesheet';
h.appendChild(link);

```

This will improve the loading time in Firefox significantly, while not affecting the loading time in IE.

Another positive side effect of the dynamic stylesheets (in FF) is that it helps with the progressive rendering. Usually both browsers will wait and show blank screen until the very last piece of stylesheet information is downloaded, and only then they'll start rendering. This behavior saves them the potential work of re-rendering when new stylesheet rules come down the wire. With dynamic `<link>`s this is not happening in Firefox, it will render without waiting for all the styles and then re-render once they arrive. IE will behave as usual and wait.

But before you go ahead and implement dynamic `<link>` tags, consider the violation of the rule of separation of concerns: your page _formatting_ (CSS) will be dependent on _behavior_ (JS). In addition, this problem is going to be addressed in future Firefox versions.

## Other ways?

There are other ways to achieve the non-blocking scripts behavior, but they all have their drawbacks.

| Method | Drawback |
| --- | --- |
| Using `defer` attribute of the `script` tag | IE-only, unreliable even there |
| Using `document.write()` to write a script tag | 
1.  Non-blocking behavior is in IE-only
2.  `document.write` is not a recommended coding practice

 |
| `XMLHttpRequest` to get the source then execute with `eval()`. | 

1.  "`eval()` is evil"
2.  same-domain policy restriction

 |
| XHR request to get the source, create a new script tag and set its content | 

1.  more complex
2.  same-domain policy

 |
| Load script in an iframe | 

1.  complex
2.  iframe overhead
3.  same-domain policy

 |

## Future

Safari and IE8 are already changing the way scripts are getting loaded. Their idea is to download the scripts in parallel, but execute them in the sequence they're found on the page. It's likely that one day this blocking problem will become negligible, because only a few users will be using IE7 or lower and FF3 or lower. Until then, a dynamic script tag is an easy way around the problem.

## Summary

-   Scripts block downloads in FF and IE browsers and this makes your pages load slower.
-   An easy solution is to use dynamic `<script>` tags and prevent blocking.
-   [YUI Get Utility](http://developer.yahoo.com/yui/get/) makes it easier to do script and style includes and manage dependencies.
-   You can use dynamic `<link>` tags too, but consider the separation of concerns first.