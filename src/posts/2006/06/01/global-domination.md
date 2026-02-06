---
layout: layouts/post.njk
title: "Global Domination"
author: "Douglas Crockford"
date: 2006-06-01
slug: "global-domination"
permalink: /blog/2006/06/01/global-domination/
categories:
  - "Development"
---
JavaScript, as realized in browsers, is a load-and-go programming language. Programs are delivered to the execution site as text. This is a good fit for the web, which is at its root a text delivery system. The program text is `eval`'d, which compiles it into an executable form and then immediately executes it. That execution can leave artifacts in the window's global object.

The global object is the global namespace that holds the top level functions and global variables. Variables which are not explicitly defined are implied global variables, and their names are also kept in the global object. This was a convenience for the little scripts that Navigator 2 was expected to support. In the decade since NS2, those little scripts have grown into Ajax applications, and the true nature of the global object is revealed:

**Global variables are evil.**

Global variables are a source of unreliability and insecurity. Fortunately, JavaScript includes tools for allowing us to drastically minimize our use of globals, which makes our programs more robust. This becomes increasingly important as our programs get bigger, and as we mix in and mash up program components from multiple authors. Reducing our dependency on globals increases the likelihood that collisions are avoided and that the program components work harmoniously.

An objective measure of the quality of a JavaScript program is _How many global variables and global functions does it have?_ A large number is bad because the chance of bad interactions with other programs goes up. Ideally, an application, library, component, or widget defines only a single global variable. That variable should be an object which contains and is the root namespace for all of your stuff.

Yahoo's single global is `YAHOO`. It is spelled in all caps to identify it as something special, since all lower case is ordinary and initial caps indicates a constructor. Being in all caps, it is unlikely that someone would use it accidentally, which further reduces the likelihood of collision.

Yahoo is the world's biggest website. Eventually, all of Yahoo's JavaScript and browser webstate will be accessible through the `YAHOO` object.

But this technique also works well with the smallest library or widget. It is a clean, efficient way of organizing your program's resources. The performance hit in having to access through a single global is negligible. JavaScript is very good at resolving such expressions. It is more than offset by the self-documentation and reliability benefits.

Generally a shallow tree is better than a deep tree. One could imagine that `YAHOO.util.Dom.get` could have been factored more compactly perhaps as `YAHOO.get`. And perhaps someday it will, but for now `YAHOO.util.Dom.get` is not measurably slower, and it is helping Yahoo to manage its evolving codebase. (And if you don't like the length, you only have to type it once. See [`with` Statement Considered Harmful](/yuiblog/blog/2006/04/11/with-statement-considered-harmful/).)