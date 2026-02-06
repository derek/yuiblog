---
layout: layouts/post.njk
title: "What is the meaning of this?"
author: "YUI Team"
date: 2012-03-30
slug: "what-is-the-meaning-of-this"
permalink: /2012/03/30/what-is-the-meaning-of-this/
categories:
  - "Development"
---
JavaScript is an amalgam of good parts and bad parts. Its best parts came from Self (prototypes) and Scheme (lexically scoped nested functions). But the interaction of those two very good parts produced some bad parts.

When a function is called with the function invocation pattern, its `this` is not bound to the outer function's `this` as we would hope, but is instead bound to the global object, which is horrible. (ES5/strict binds the inner function's `this` to `undefined`, which is much less wrong than binding the global object, but is still not right.) The workarounds for this include the use of `bind` functions and riddles like

> `var that = this;`

Most functions are not intended to be used as constructors, yet every function has a `prototype` object just in case it turns out to be one of the rare functions that is a constructor. This is an obvious source of inefficiency.

Function objects are mutable like other objects. This will make the securing of JavaScript more difficult because every function object can be used as a channel to facilitate unwanted collusion between widgets. ES5 provides tools to freeze functions, making them immutable, but the tools are really difficult to use for that purpose.

The Sixth Edition of ECMAScript may correct all of these problems.

_The Sixth Edition is still being debated and drafted. We won't know for certain what will be in the next edition until it is approved by the ECMA General Assembly, a milestone that will not occur this year. It is impossible to speak with certainty about future editions. The following prediction is based on my understanding of current developments, but it could ultimately prove to be wrong in every detail._

The next edition may have a more compact alternative to the `function` operator: the `=>` operator. It takes a parameter list on the left, and on the right it takes either a function body wrapped in braces, or an expression. If the thing on the right is an expression, then a function body that returns the value of the expression is made for you. So instead of writing

> `function (x) {     return x * x; }`

you can instead write

> `(x) => x * x`

Functions written in this new **fat arrow** form always use the `this` of the outer function, even when invoked as a method. That means that it is no longer necessary to use `bind` or resort to `that` tricks.

If you want a method that receives a dynamic binding to the method's object, then you must include `this` as the first pseudo parameter.

> `(this, x) => {     this.property = x; }`

This gives us a way to easily distinguish functions from methods. Functions use the outer function's `this`, and methods explicitly name `this` in their parameters. Using the function invocation form on a method throws a type error.

Fat arrow functions do not have `prototype` properties, which makes them cheaper to make. They are immutable.

I am looking forward to using these new functions. They are lighter in appearance and implementation, and they correct a lot of the problems of conventional functions. As aways, there are tradeoffs. Adding new kinds of functions makes living with the language more complicated. The language will be a little more difficult to talk about.

If you are creating a simple factory function, you cannot put an object literal on the right of the `=>` because a brace will be interpreted as a function body. So instead you must write either

> `() => ({})` // wrap the object literal in parens

or

> `() => {     return {};` // wrap the object literal in a function body `}`

Fortunately, JSLint will be able detect these sorts of ambiguities.

I am looking forward to using the new functions. But there is still a role for the old style functions. The new functions do not have names, so you will need to use the old functions to write self-recursive functions. You need the old functions for constructors, although I don't recommend use of constructors. You will need the old functions to make mutable functions, although I don't recommend those either. You will need the old functions if you want access to `arguments`, which you shouldn't because we will have a new `...` operator. And you will need the old functions to make generators that use the new `yield` operator.