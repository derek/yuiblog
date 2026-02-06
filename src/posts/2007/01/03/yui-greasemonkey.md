---
layout: layouts/post.njk
title: "Using YUI in Greasemonkey Scripts"
author: "Carlo Zottmann"
date: 2007-01-03
slug: "yui-greasemonkey"
permalink: /2007/01/03/yui-greasemonkey/
categories:
  - "Development"
---
#gmarticle span {line-height:inherit; font-size:11px;} .intro img {float:right; margin:0 0 .5em .5em; border:1px solid #666;} /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

I love [Greasemonkey](http://greasemonkey.mozdev.org/). I like how much power it gives me when it comes to bending other peoples' websites to my will, how I can add features to or or ditch them from a website, how I can use Greasemonkey scripts to pull data from all over the net to spice up the very page I am looking at. It makes my daily life as Yahoo! engineer easier.

Also, I love the [Yahoo! UI library](http://developer.yahoo.com/yui/). YUI contains JavaScript and CSS components that allow anyone to quickly build [some pretty](http://gallery.yahoo.com/yui) [amazing things](http://tech.groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/).

Wouldn't it be great if we could bring Greasemonkey and YUI together? How nice would it be to use YUI components _anywhere_, to have Greasemonkey dynamically load the libraries when needed and to attach YUI-powered thingamajigs to any page we like? For example to add [autocompletion](http://developer.yahoo.com/yui/autocomplete/) to form fields, or to make use of the advanced [event management](http://developer.yahoo.com/yui/event/) in your Greasemonkey scripts! The mind boggles.

In this brief article, I'll share with you my own effort to reach that goal — a Greasemonkey script that adds calls to external JavaScript libraries and CSS files to a given page and, once they are loaded, passes the [YAHOO global object](http://developer.yahoo.com/yui/yahoo/) to the code inside the Greasemonkey script. (All YUI components reside within this single single global variable, YAHOO — so, for example, you access the YUI Event Utility by referencing `YAHOO.util.Event`.) I'm sure that this approach is neither the perfect nor the only solution to achieving YUI/Greasemonkey integration, so suggestions and ideas are welcome! Please sound off in the comments and let me know what approaches you've taken to this problem in your own projects.

### An Example Greasemonkey Script Implementing a YUI Loader and Using YUI Components

What I am interested in sharing with you here, primarily, is the mechanism by which you can include and invoke YUI from within a Greasemonkey script while reusing (and not disturbing) existing YUI components already present in the document. I'll do that by exploring a simple Greasemonkey sample script that translates selected text on [YUIBlog.com](/blog-archive/), [Yahoo! News](http://news.yahoo.com/), or [my personal blog](http://carlo.zottmann.org/) using [Yahoo! Babelfish](http://babelfish.yahoo.com/); with the script installed, you can highlight any passage of text on one of those sites and, if you hold down the shift key while releasing the mouse, a [YUI Panel](http://developer.yahoo.com/yui/container/panel/) with a German Babelfish translation will pop up. (If you want to install and test the script, you can download it from [http://carlo.zottmann.org/code/yuigm\_example\_yuiblog\_babelfish.user.js](http://carlo.zottmann.org/code/yuigm_example_yuiblog_babelfish.user.js); the script is configured to operate only on `http://*yuiblog.com/*`, `http://news.yahoo.com/*`, and `http://carlo.zottmann.org/*` URIs).

In case you're not using Firefox, here's a quick example of the script in action. Click the screencapture below to see a 10-second QuickTime movie of the interaction:

[![The example script in action: The Greasemonkey script loads YUI components, sends selected text to Yahoo! Babelfish for translation, then displays the results in a YUI Panel Control.](/yuiblog/blog-archive/assets/yui-gm-babelfish.png)](/yuiblog/blog-archive/assets/yui-gm-babelfish.mov)

### Key Objects in the Script

We have four key objects in the script: `GM_YUILOADER`, `GM_YUILOADER_CONFIG`, `YBFLOOKUP`, and of course the `YAHOO` global object.

1.  `GM_YUILOADER` holds all the logic to inject the necessary JavaScript and CSS files, makes sure they are loaded and triggers execution of the main part of the script (the "payload").
2.  `GM_YUILOADER_CONFIG` contains the configuration parameters for our YUI usage, including the list of YUI JavaScript libraries and/or CSS files we want to load, the maximum time to wait for for said files to complete loading, the frequency with which to check for completion, and information about which callback function to fire once everything is loaded.
3.  `YBFLOOKUP` is the "payload", containing the code where we use YUI to achieve our goals. In our example this is the [Babelfish](http://babelfish.yahoo.com) YUI Panel (hence the name of the object) which will display a German translation for the English text on the page that was marked by the user.
4.  `YAHOO` is what you would expect — the `YAHOO` global object. It is avaible once `GM_YUILOADER` has triggered execution of the main part of the script.

### The Loader

The loader is the most critical component of the script, and it's the part that you are most likely to want to adapt in creating your own YUI-based Greasemonkey implementations. Here is the general workflow of the `GM_YUILOADER` technique.

1.  Greasemonkey triggers script execution.
2.  `GM_YUILOADER.loader()` is called and...
    -   adds a `GM_YUILOADER_DOC` property to Greasemonkey's `unsafeWindow.document` which (among other things) holds a counter, a so-called trigger variable and a function (which increments aformentioned counter; if the counter reaches the number of included `<script/>` tags, the trigger variable is set to true)
    -   adds new `<script src="..."/>` and/or `<link rel="stylesheet" type="text/css" href="..."/>` tags to the page (unless that YUI component is already included in the page, which is determined using object detection)
    -   adds `onLoad` event handlers to above `<script/>` tags (which call the  
        function inside `unsafeWindow.document.GM_YUILOADER_DOC`)
3.  `GM_YUILOADER.loaderCheck()` is run periodically, checking the status of the trigger variable, until one of two things happens: either the variable is true, in which case the payload logic is invoked (i.e. `YBFLOOKUP.run()`) after making the `YAHOO` global object available to the Greasemonkey script, or the maximum loading time is reached, which will cause the script to abort.

Let's take a look at some of the loader-specific code in the sample script. First, you specify the YUI components on which your Greasemonkey script will rely. You do so in an structured object — the `assets` member of the `GM_YUILOADER_CONFIG` object:

```
// Settings used by the loader "engine"
var GM_YUILOADER_CONFIG = {
    // List of JS libraries and CSS files to load. obj is used for the object
    // detection used in the loader. Basically, if the object already exists,
    // the script is not injected in the page.
    assets: [
        { type: 'css', url: 'http://developer.yahoo.com/yui/build/container/assets/container.css' },
        { type: 'js', obj: 'YAHOO', url: 'http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/yahoo_2.1.0.js' },
        { type: 'js', obj: 'YAHOO.util.Event', url: 'http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/event_2.1.0.js' },
        { type: 'js', obj: 'YAHOO.util.Dom', url: 'http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/dom_2.1.0.js' },
        { type: 'js', obj: 'YAHOO.util.Anim', url: 'http://us.js2.yimg.com/us.js.yimg.com/lib/common/utils/2/animation_2.1.0.js' },
        { type: 'js', obj: 'YAHOO.widget.Panel', url: 'http://us.js2.yimg.com/us.js.yimg.com/lib/common/widgets/2/container/container_2.1.0.js' }
    ],
```

By comparing this list with the YUI objects that may already be present in the `YAHOO` global object, the script creates a "to-do" list of needed-but-missing components. It can then loop through the needed assets and include them on the page. Here's the underlying code for that part of the loader:

```
// Now let's add the extra tags to the page that'll load the libraries and
    // CSS files.

    var numAssets = GM_YUILOADER_CONFIG.assets.length;

    for (var a = 0; a < numAssets; a++) {
        var tag;
        var asset = GM_YUILOADER_CONFIG.assets[a];

	switch (asset.type) {
		// CSS file
		case 'css':
			tag = document.createElement('link');
			tag.href = asset.url;
			tag.type = 'text/css';
			tag.rel = 'stylesheet';
			break;

		// Javascript library.
		case 'js':
			var injectScript = true;

			// Object detection
			try {
				injectScript = eval('window.' + asset.obj + ' === undefined');
			}
			catch (e) {}

			if (injectScript) {
				tag = document.createElement('script');
				tag.src = asset.url;

				// The crucial part: triggering document.GM_YUILOADER.countLoaded()
				// means keeping track whether all scripts are loaded yet.

				tag.setAttribute('onload', 'document.GM_YUILOADER_DOC.countLoaded();');

				// How many JS libraries are we dealing with again? Let's keep
				// track.

				ud.GM_YUILOADER_DOC.numberTotal++;
			}
			break;
	}

	document.body.appendChild(tag);
}

```

There are other details taken care of in the loader portion of the script, but this is the heart of the logic & and the code above captures the essence of this approach to marrying YUI with Greasemonkey.

### The Payload

The practical part of the script (a.k.a. the "payload") is pretty straightforward: a simple, invisible [YUI Panel](http://developer.yahoo.com/yui/container/panel/) is built, a `mouseup` event handler is attached to the document body. Once triggered, it'll check if text was selected and if the shift key is still pressed; if so, it'll grab the German translation for the text from [Babelfish](http://babelfish.yahoo.com), put it in the body of the Panel and invoke the Panel's `show()` method.

At the heart of the payload is an event listener listening for the mouseup event on the window object. Here's the beginning of that event handler:

```
// Event handler for mouseUp events
YBFLOOKUP.subscriberSelect = function(e) {
var selection = window.getSelection();
var selectionText = selection.toString();
// Shift key pressed? Anything selected?
if (!e.shiftKey || selectionText == '') { return; }
	YBFLOOKUP.panel.setBody('Loading Babelfish EN-DE translation, just a second...');
	YBFLOOKUP.panel.cfg.setProperty('x', e.clientX + 20);
	YBFLOOKUP.panel.cfg.setProperty('y', e.pageY + 20);
	YBFLOOKUP.panel.show();
```

From there, the script proceeds to make a call to Greasemonkey's built in facility for loading external pages (`GM_xmlhttpRequest`), loads the translation from Yahoo! Babelfish, and shows the result in the Panel.

### Closing Words

The ability to use YUI in Greasemonkey scripts can be quite beneficial to Greasemonkey developers. I know from personal experience that YUI brings a lot of new options and tools to the Greasemonkey playing field that, without a library, you would have to build on your own. Also I like the idea of playing with new YUI-powered gimmicks on a live site; for instance, it is rather easy now for me to to inject autocompletion into a form field on a live Yahoo! page just to see what it would look and how it would behave — without running the risk of destroying things and without having to set up a dedicated development environment, do exhaustive QA testing, or ask anyone for permission. Greasemonkey captures [the essence of hacking](http://www.hackday.org/) and it opens up wonderful creative opportunities.

For me personally, YUI and Greasemonkey are a perfect fit, and I'd like to use this opportunity to thank both the Greasemonkey developers and the YUI crew for their ingenuity and willingness to share the love with us.