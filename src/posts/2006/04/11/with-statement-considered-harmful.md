---
layout: layouts/post.njk
title: "with Statement Considered Harmful"
author: "Douglas Crockford"
date: 2006-04-11
slug: "with-statement-considered-harmful"
permalink: /2006/04/11/with-statement-considered-harmful/
categories:
  - "Development"
---
JavaScript's `with` statement was intended to provide a shorthand for writing recurring accesses to objects. So instead of writing

> ```
> ooo.eee.oo.ah_ah.ting.tang.walla.walla.bing = true;
> ooo.eee.oo.ah_ah.ting.tang.walla.walla.bang = true;
> ```

You can write

> ```
> with (ooo.eee.oo.ah_ah.ting.tang.walla.walla) {
>     bing = true;
>     bang = true;
> }
> ```

That looks a lot nicer. Except for one thing. There is no way that you can tell by looking at the code which `bing` and `bang` will get modifed. Will `ooo.eee.oo.ah_ah.ting.tang.walla.walla` be modified? Or will the global variables `bing` and `bang` get clobbered? It is impossible to know for sure.

The `with` statement adds the members of an object to the current scope. Only if there is a `bing` in `ooo.eee.oo.ah_ah.ting.tang.walla.walla` will `ooo.eee.oo.ah_ah.ting.tang.walla.walla.bing` be accessed.

If you can't read a program and be confident that you know what it is going to do, you can't have confidence that it is going to work correctly. For this reason, the `with` statement should be avoided.

Fortunately, JavaScript also provides a better alternative. We can simply define a `var`.

> ```
> var o = ooo.eee.oo.ah_ah.ting.tang.walla.walla;
> o.bing = true;
> o.bang = true;
> 
> ```

Now there is no ambiguity. We can have confidence that it is `ooo.eee.oo.ah_ah.ting.tang.walla.walla.bing` and `ooo.eee.oo.ah_ah.ting.tang.walla.walla.bang` that are being set, and not some hapless variables.