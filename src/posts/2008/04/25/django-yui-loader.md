---
layout: layouts/post.njk
title: "DjangoSnippets: YUI Loader as Django Middleware"
author: "Eric Miraglia"
date: 2008-04-25
slug: "django-yui-loader"
permalink: /2008/04/25/django-yui-loader/
categories:
  - "Development"
---
[![YUI Loader integration on DjangoSnippets.com](/yuiblog/blog-archive/assets/djangosnippets.jpg)](http://www.djangosnippets.org/snippets/712/)

Over on DjangoSnippets.org, [akaihola has posted a YUILoader class](http://www.djangosnippets.org/snippets/712/) (based on [Adam Moore's client-side YUI Loader](http://developer.yahoo.com/yui/yuiloader/)) that makes it a snap to pull YUI components into your Django projects.

> This server-side middleware implements some of the functionality in the [Yahoo User Interface Loader](http://developer.yahoo.com/yui/yuiloader/) component. YUI JavaScript and CSS modules requirements can be declared anywhere in the base, inherited or included templates, and the resulting, optimized `<script>` and `<link rel="stylesheet">` tags are inserted at the specified position of the resulting page.
> 
> Requirements may be specified in multiple locations. This is useful when zero or more components are included in the HTML head section, and inherited and/or included templates require possibly overlapping sets of YUI components in the body across inherited and included templates. All tags are collected in the head section, and duplicate tags are automatically eliminated.
> 
> The middleware understands component dependencies and ensures that resources are loaded in the right order. It knows about built-in rollup files that ship with YUI. By automatically using rolled-up files, the number of HTTP requests is reduced.

Back in August on DjangoSnippets, [pigletto posted a nice YUI snippet for use with the YUI AutoComplete Control](http://www.djangosnippets.org/snippets/392/).