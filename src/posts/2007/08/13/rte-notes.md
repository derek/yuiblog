---
layout: layouts/post.njk
title: "Some Notes on the YUI Rich Text Editor"
author: "YUI Team"
date: 2007-08-13
slug: "rte-notes"
permalink: /2007/08/13/rte-notes/
categories:
  - "Development"
---
[![The YUI Rich Text Editor](/yuiblog/blog-archive/assets/rte.gif)](http://developer.yahoo.com/yui/editor)

About a year ago I made a [Rich Text Editor (RTE) prototype](http://blog.davglass.com/files/yui/editor/ "RTE Prototype") to show that it was possible to build one on top of YUI. Of all [my YUI examples](http://blog.davglass.com/2006/06/yui-code-samples/), it quickly became one of the most requested, and the project indirectly resulted in me joining the YUI team in a formal capacity.

Once I started on the YUI team, building a full-featured [YUI Rich Text Editor](http://developer.yahoo.com/yui/editor/) became my top priority. Even though there are many DHTML-based RTEs available in the open-source world, including [Moxiecode's](http://www.moxiecode.com/) excellent [TinyMCE](http://tinymce.moxiecode.com/), there were four key reasons I took on the challenge of building a new one for YUI.

-   **A-Grade browser support** - Most available RTEs fail to support the full spectrum of [A-Grade web browsers](http://developer.yahoo.com/yui/articles/gbs/). Most support IE and Firefox well, but few support Opera and I'm not aware of any that fully support Safari. For example, many existing RTEs don't offer list editing in Safari. I thought we could do better. Because YUI is committed to A-Grade browser support (and because I'm a fanatic Mac user) fully supporting Safari was a top priority for me. Wrestling Safari into submission was no small task, and I'll look at some of the specific challenges below.
-   **Extensibility** - I wanted to build an editor that would allow fellow developers to add their own unique functionality. The YUI Rich Text Editor's Toolbar is designed from the ground up to be extensible; the [Flickr example](http://developer.yahoo.com/yui/examples/editor/flickr_editor.html) is meant to illustrate this, as is the example of the [Calendar Control](http://developer.yahoo.com/yui/examples/editor/cal_editor.html) implementation.
-   **Accessibility** - What happens when users employing assistive technologies are presented with a rich-text-editing interface? What should happen? I spent time working with Yahoo! accessibility specialist Victor Tsaran to answer those questions. I believe that I have engineered some of the answers into the YUI Rich Text Editor. This is an area of ongoing development, and I'll share more details as the RTE progresses out of Beta status.
-   **Footprint and Performance** - I wanted to build an RTE that was small and fast. It's already lighter-weight than some, but let's be clear: _It is not there yet_. You can count on the fact that I'll be putting a lot of effort into shrinking its footprint and improving its performance, while maintaining (and improving) consistency across the A-Grade browsers.

## Current and Future Status

Before I get into the fundamentals of the YUI RTE, let me give you an update on the state of the project. First, this editor is currently a [Beta control](http://developer.yahoo.com/yui/articles/faq/#beta), and as such there is still much work to be done. Second, it's neither a site editor nor a development environment. It's designed for simple things like web mail systems, blog posts and comments, online reviews, and so forth. However, I did try to expose as many hooks and events as possible so that others could build upon the basic A-grade browser foundation that the RTE provides.

## The Development Path

My development approach was to bend Safari first. I built it to work in Safari 2 before retrofitting it back to Opera, then Firefox and lastly Internet Explorer. I figured that if I could make Safari do what I wanted, the other three would fall into place nicely. And they did. By choosing to make Safari work first I was able to make the others do things in a standard way as well. I hope that Safari will eventually catch up to its A-grade peers and add support for the things that I have "emulated", so I took that into consideration too.

### Hacking Around Safari

Safari 2 is a really good browser, but it was also the most challenging browser to support with the RTE project. It lacks some serious and critical features when it comes to editing HTML content from JavaScript. I will try to explain the main hurdles that Safari presents:

**Iframe Focus** - One of the biggest issues was actually quite simple to solve. Safari (and Internet Explorer) has an issue with selecting text inside of an embedded iframe. If you select text within the editor's iframe then click/focus the parent document, the selection within the iframe is lost. Clearly, this makes it rather difficult for a button click to take action on the selection (because the selection is lost when you click the button!). It also makes it difficult to use, say, a [YUI Menu Control](http://developer.yahoo.com/yui/menu/) for a drop down. As I investigated this problem, I determined that if you stop the mousedown event on the button/href the selection doesn't get lost. However, if something else (say a href in a dropdown menu) gets focus, the selection will still get lost. This leads me to the next Safari trick.

**Selection Object** - The selection object in Safari is very limited (to say the least). To work around its limitations, the YUI RTE caches a copy of the current selection in the `_getSelection` method. Then, the next time `_getSelection` is called I check to see if a cache existed. If the cache is there, I "rebuild" the selection and destroy the cached copy. This little trick is what lets Safari use a YUI Overlay as a menu instead of the more classic approach of a select element. It's roundabout, but it works.

**execCommand limitations** - This is the mother of all hacks for Safari (and the others). My biggest problem with the native `execCommand` method (in all browsers) is that the browser doesn't tell you what it applied the command to. So there is no real way to get an element reference back after running a command on a selection. The world of JavaScript editors would be so much more civilized if this would happen (_hint, hint, nudge, nudge_). So what I had to do was implement this feature myself. My current approach may not be the best way to do it (I have some other ideas that I am working through), but it does the job for now. The method is named `_createCurrentElement` and basically it runs `execCommand('fontname', false, 'yui-tmp');` on the given selection (since fontname is supported on all A-Grade browsers). It will then search the document for an element with the font-family/name set to `yui-tmp` and replace that with a span that has other information in it (attributes about the element that we wanted to create), then it will add the new span to the `this.currentElement` array, so we now have element references to the elements that were just modified. At this point we can use standard DOM manipulation to change them as we see fit. In short, I'm using the iframe's DOM to store metadata during editing as a way to enrich the communication that's possible between the editor and the iframe.

### Making it Your Way

Over the past few years I've implemented many of the available RTEs. Because of this I brought a "taste of your own medicine" mentality to the table. I wanted to build an editor that was easy to extend and change. The YUI RTE has [Custom Events](http://developer.yahoo.com/yui/event/#customevent) for everything that I could think of! I made all of the event handlers standalone functions that can be overloaded on the instance or on the prototype. I also tried to make as many things configurable as possible.

Just to give you an idea, let me show you a quick way to change one of the editor's default behaviors.

![Editing links in the YUI RTE.](/yuiblog/blog-archive/assets/rte-link-editor.gif)

**The Create Link Dialog** - Say you want to use a different input utility for link creation (a pre-defined links list maybe?) instead of the default link editor. Well, here's some sample code to turn it into a JavaScript prompt:

```
var oEditor = new YAHOO.widget.Editor('demo');
oEditor._handleCreateLinkClick = function() {
    oEditor.on('afterExecCommand', function() {
        var str = prompt('URL: ', 'link');
        var el = this.currentElement[0].setAttribute('href', str);
    }, oEditor, this);
};

```

Using this technique, you could easily write your own property editor. By the way, the "insert image" dialog can be overridden in exactly the same way (for example to make it a photo picker), just override the `_handleInsertImageClick` method. You could either override it as above, or you could override all editor instances (so every editor on the page would behave the same) like this:

```
YAHOO.widget.Editor.prototype._handleCreateLinkClick = function() {
};
```

## The Look and Feel

If you don't like the visual design of the RTE, simply change the CSS. As with YUI's entire family of controls, the visual presentation of the control is written in CSS and [can be reskinned to suit your implementation](http://developer.yahoo.com/yui/articles/skinning/). See the RTE's [skinning example](http://developer.yahoo.com/yui/examples/editor/skinning_editor.html) for more information on how CSS controls the presentation of the RTE specifically. We've even provided the [Photoshop source file](http://developer.yahoo.com/yui/editor/assets/rte-skinning.zip) for the icons to make it easier for you to create a design that's customized for your site. Maybe you like the colors, but you don't want to see the labels above the "groups"? Well, add these few lines of CSS:

```
.yui-skin-sam .yui-toolbar-container .yui-toolbar-group h3 {
	display: none;
}
.yui-skin-sam .yui-toolbar-container .yui-toolbar-group {
	margin-top: .75em;
}
```

Once you dig in, I think you will find that the YUI RTE is pretty flexible and easy to extend.

## In the End

Safari was tough, but I'm stubborn. When Safari properly supports execCommand, things will be even better. YUI's RTE is exceptionally extensible and customizable; from very low-level functionality all the way up through the visual layer. It's also semi-lightweight, and will be even lighter before I'm done with it.

I hope you enjoy my first YUI control. Please keep the feedback coming.