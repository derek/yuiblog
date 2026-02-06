---
layout: layouts/post.njk
title: "Writing a WYSIWYG Wiki Editor with YUI and Grails"
author: "Eric Miraglia"
date: 2008-05-01
slug: "wiki-rte"
permalink: /2008/05/01/wiki-rte/
categories:
  - "Development"
---
[![Read Glen Smith's tutorial on using the YUI RTE to create and edit wiki text.](/yuiblog/blog-archive/assets/wikirte-1.png)](http://blogs.bytecode.com.au/glen/2008/05/01/writing-a-wysiwyg-wiki-editor-with-yui-and-grails.html)

[![Check out Glen's screencast showing the editor in action.](/yuiblog/blog-archive/assets/wikirte-2.png)](http://blogs.bytecode.com.au/glen/2008/05/01/images/2008/wikiEditor.mov)One of the challenges faced in creating and deploying Rich Text Editors is the number of markup formats you may need to support on the output side — ranging from HTML to Wiki-style text to purely idiosyncratic markup styles. Dav worked hard on [the YUI Rich Text Editor](http://developer.yahoo.com/yui/editor/) to make output transformations as straightforward as possible. (If you're doing YUI RTE work and haven't seen Dav's video intro to the component, [you can check it out here](http://video.yahoo.com/watch/2359450/7378948).)

Glen Smith from Canberra shared some antipodean YUI goodness today with [a quick tutorial on using the YUI RTE for editing Wiki text](http://blogs.bytecode.com.au/glen/2008/05/01/writing-a-wysiwyg-wiki-editor-with-yui-and-grails.html). He's been using the [Grails YUI Plugin](http://grails.codehaus.org/YUI+Plugin), mixing in a little [textile-j](https://textile-j.dev.java.net/), and he's got something working well enough for version 1:

> Turns out the recipe for making all this work is pretty straighforward:
> 
> -   When switching from Wiki markup to HTML, do an Ajax call to a backend Grails controller that uses [textile-j](https://textile-j.dev.java.net/) to convert from textile markup to html. Feed the result of the AJAX call to the YUI Rich Editor and you're in business.
> -   To support switching from RichText to Textile, again do an Ajax call back to the Grails controller to the do the conversion. This time you're on your own in regexp land, but you can trim the amount of work you've got to do by what you expose in the Rich editor. Return the results and inject into the Wiki textarea.
> -   To get the underlying html from the editor just use `myEditor.getEditorHTML()`. Awesome!

For more, check out Glen's [blog post](http://blogs.bytecode.com.au/glen/2008/05/01/writing-a-wysiwyg-wiki-editor-with-yui-and-grails.html) and accompanying [QuickTime movie](http://blogs.bytecode.com.au/glen/2008/05/01/images/2008/wikiEditor.mov).