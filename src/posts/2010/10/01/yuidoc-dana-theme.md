---
layout: layouts/post.njk
title: "Carlo Zottmann's Dana Theme for YUI Doc"
author: "Carlo Zottmann"
date: 2010-10-01
slug: "yuidoc-dana-theme"
permalink: /2010/10/01/yuidoc-dana-theme/
categories:
  - "Development"
---
![Carlo Zottmann](/yuiblog/blog-archive/assets/dana/mugshot.jpg "Carlo Zottmann")_**About the author**: Carlo Zottmann (two n's) is a freelance web developer and former Yahoo! from Munich, Germany. These days, he's happy writing Ruby and Javascript for fun and profit. He has a [blog](http://blog.zottmann.org/) and is known to use [the Twitters](http://twitter.com/Carlo)._

I like to use [YUI Doc](http://developer.yahoo.com/yui/yuidoc/ "YUI Doc") for all my JavaScript documentation needs. I have found that it works well for documenting plain vanilla JS or jQuery code — it's not just for [YUI](http://developer.yahoo.com/yui/ "YUI Library")\-based projects.  

I was skeptical at first, as I tend to write more [jQuery](http://jquery.com/ "jQuery") than YUI code. It was a pleasant surprise to find that YUI Doc easily integrated into my workflow, and could produce useful documentation for my non-YUI projects. Sure, it has some expectations regarding a project's file structure etc., but none of these expectations are showstoppers for me. On the other hand, it is a light system and I can get it up and running in no time.

Having a tool parse my source code and automagically build quality documentation for me is great — not just for quickly looking up function calls etc. later on; to me it adds value in two ways:

Firstly, I document my code either way for my own sake — I'm probably going to have to re-visit it in a few months and I should be able to pick it up quickly. Not having documentation means certain confusion in the future, which is not an impression I want to give my customers.

Secondly, code documentation might be a bit of an abstract concept for a client: I can tell her it's there, but the only way I can "prove" my claim is by firing up my editor and point my finger at the comment blocks in my code. Which really don't look very impressive — at worst they look like a sorry excuse for "proper" documentation.

Yet firing up my browser and showing the very same comments parsed and processed by YUI Doc — clean, sparkling, coherent — now that's professional code monkeying right there, people.

(If you just thought _"code documented in a wiki is as good and less of a hassle"_, please accept my sad golf clap — because it's not.)

Unfortunately, I'm not a fan of the base YUI Doc skin. When I hand over a solidly documented piece of code to my clients, I want them to see solidly documented code; to me, YUI Doc's default theme doesn't shine brightly enough.

Looking around for replacement themes I couldn't find any. So a few weeks ago I decided to write my own — [Dana](http://github.com/carlo/yuidoc-theme-dana). Here's an example screenshot:

[![Screenshot of the YUI.widget.SimpleEditor class documentation](/yuiblog/blog-archive/assets/dana/screenshot.png "Screenshot of the YUI.widget.SimpleEditor class documentation")](/yuiblog/blog-archive/assets/dana/screenshot.png "Click to view full-sized image")

As you can see above, I've generated the well-known YUI API docs as an example. Here's the [original YUI documentation](http://developer.yahoo.com/yui/docs/index.html) — and here is the very same documentation sporting the new [Dana theme](http://zottmann.org/yuidoc-theme-dana-example/index.html).

I find the latter more pleasing to the eye — I hope you agree! Click around a bit, check some of the class documentations for a more in-depth comparison, play with the filters, feel the luxurious yet cheap plastic underneath.

So far, I've gotten plenty of positive feedback. My clients appreciate the cleaner look, and I feel better about the more professional presentation of the work I put into my projects, right down to the generated markup.

### How it was built

I started writing Dana by throwing away every bit of HTML inside the default YUI Doc templates, starting over from scratch and layering my own markup on top of the core blocks of YUI Doc [Cheetah](http://www.cheetahtemplate.org/) code. (Cheetah is the Python templating engine used by YUI Doc. The `#` blocks you'll find in the templates contain Python code executed by Cheetah.)

To be honest, figuring out what's going on in the templates wasn't really a walk in the park — YUI Doc's templates are not annotated, and getting oriented as a newcomer to the system took some time. When I had the feeling I understood the structure and Cheetah logic, I gutted the rest of the markup, replacing it with some really simple constructs, and built on top of that. It took a while.

If you think about writing your own themes, I'd recommend either using Dana's `main.tmpl` as a starting point, or looking at [the properly formatted original `main.tmpl`](http://gist.github.com/554938). Many Bothans died to bring you this template.

I am not a designer; I've tried to keep the look simple and clear without adding many bells and whistles.

### Built-in Goodies

I've taken the liberty of implementing an (IMHO) better display of object-type parameters: if several parameters are passed in as properties on a single object, only that object will be displayed as a parameter in the tables' first columns.

As an example, let's say you're documenting a method expecting an object-type parameter containing three properties:

```
* @param  obj.param1 {String} A string!
* @param  obj.param2 {Number} A number!
* @param  obj.param3 {Boolean} A boolean, surprisingly!
```

Here's how this method would be displayed in the generated documentation:

Default theme: `method( obj.param1, obj.param2, obj.param3 )`  
Dana theme: `method( obj )`

For a real-life example, see the docs for [YAHOO.widget.DataTable's events](http://zottmann.org/yuidoc-theme-dana-example/YAHOO.widget.DataTable.html#event_cellClickEvent).

I find that this treatment makes the output more concise.

### Requirements

Dana requires one of the [later YUI Doc builds](http://github.com/yui/yuidoc/downloads); for example, build 50 works just fine — but **it won't work with YUI Doc 1.0.0b1.**

### Installation / Usage

I assume you've got YUI Doc up and running at this point. Just download [Dana from GitHub](http://github.com/carlo/yuidoc-theme-dana/downloads), unpack it, and tell `yuidoc.py` to use it via the `-t/--template` option.

### Closing remarks

Dana is still a work in progress; there are some minor issues left, for example with some HTML `code` blocks which come out too wide. These aren't deal breakers _for me_, but your mileage may vary.

For those readers who, like me, get giddy at the idea of Markdown support in YUI Doc like I do _(hint, hint)_, check out [Mike West's YUI Doc fork](http://github.com/mikewest/yuidoc) which adds exactly that. While we wait for a new original YUI Doc release, I mean. _\*cough ;)\*_

You'll [find Dana on GitHub](http://github.com/carlo/yuidoc-theme-dana). If you're so inclined, you can download the [latest stable release as zip/tgz file](http://github.com/carlo/yuidoc-theme-dana/downloads), too. If you encounter any errors, please [create a ticket](http://github.com/carlo/yuidoc-theme-dana/issues).

Dana is dual-licensed under MIT & GNU GPL v2. It's been tested in Safari 5 (OSX), FF3.6 (OSX), IE8 (WinXP).