---
layout: layouts/post.njk
title: "Who's Got Style?"
author: "Nicholas C. Zakas"
date: 2007-06-07
slug: "style"
permalink: /blog/2007/06/07/style/
categories:
  - "Development"
---
With DOM support across all [A-grade browsers](http://developer.yahoo.com/yui/articles/gbs/), many basic (and some complex) interactions can be accomplished with relative ease. Things like adding and removing elements, inserting HTML text, and working with events are now reasonably manageable on a cross-browser basis. There are, of course, some quirks that have to be accounted for, but generally speaking, most things work as you would expect them to. Except for dynamically inserting CSS into your page.

When writing HTML, CSS can be embedded in the page using the `<style>` element, like this:

```
<style type="text/css">
  a {
    color: red;
  }
</style>
```

This block of code can be placed anywhere in a page and its rules will be applied to the entire page. Since we have the DOM API, which gives us the ability to dynamically create elements, attributes, and text nodes with a document, one would assume that some very basic JavaScript code could be used to mimic this HTML code. Logically, it would work like this:

```
var styleElement = document.createElement("style");
styleElement.type = "text/css";
styleElement.appendChild(document.createTextNode("a { color: red; }"));
document.body.appendChild(styleElement);
```

It should be just that easy…but it's not. For Opera and Firefox, browsers that purport to have great standards support, this works perfectly well. In Safari and Internet Explorer it fails, though not for the same reason.

Safari requires dynamically created `<style>` elements to be inserted into the <head> for the rules to be applied, which is a fairly easy change to the previous code:

```
var styleElement = document.createElement("style");
styleElement.type = "text/css";
styleElement.appendChild(document.createTextNode("a { color: red; }"));
document.getElementsByTagName("head")[0].appendChild(styleElement);
```

This code now works in Opera, Firefox, and Safari. But what about IE? When IE encounters `style.appendChild()` it throws the rather obtuse and not-very-helpful error message, "unexpected call to method or property access". Try replacing that with a call to set innerHTML, and you'll get an equally useless error message of "unknown runtime error". What's going on here?

It turns out that IE won't let you manipulate `<style>` elements in this way. There is, however, a different way to do the same thing. IE supports a `styleSheet` property on each style element that allows for the manipulation of the style sheet and the rules contained within. The `styleSheet` property has a property called `cssText`, which can be used to set and retrieve the CSS text for the style sheet. So, the code can be modified to work in IE by doing this:

```
var styleElement = document.createElement("style");
styleElement.type = "text/css";
if (styleElement.styleSheet) {
  styleElement.styleSheet.cssText = "a { color: red }";
} else {
  styleElement.appendChild(document.createTextNode("a { color: red; }"));
}
document.getElementsByTagName("head")[0].appendChild(styleElement);
```

This code now works in all A-grade browsers and can be genericized into a function like this:

```
function addCss(cssCode) {
var styleElement = document.createElement("style");
  styleElement.type = "text/css";
  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = cssCode;
  } else {
    styleElement.appendChild(document.createTextNode(cssCode));
  }
  document.getElementsByTagName("head")[0].appendChild(styleElement);
}
```

Using this function, you can add as many new blocks of CSS code to your page as you would like.

**A warning:** IE only allows writing to `styleSheet.cssText` one time per `<style>` element. If you try to do it more than one time, it can crash the browser. For this reason, it's best not to reuse `<style>` elements on your page. Instead, remove them or just add new ones.