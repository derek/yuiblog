---
layout: layouts/post.njk
title: "Strict Mode Is Coming To Town"
author: "Douglas Crockford"
date: 2010-12-14
slug: "strict-mode-is-coming-to-town"
permalink: /2010/12/14/strict-mode-is-coming-to-town/
categories:
  - "Development"
---
This is the time and season when people all over the world forget their differences and come together in peace and fellowship to celebrate the first anniversary of the ECMA General Assembly’s approval of The ECMAScript Programming Language Standard, Fifth Edition. The most important feature in ES5 is the new Strict Mode. Strict Mode is an opt-in mode that repairs or removes some of the language’s most problematic features.

## Specifying Strict Mode

There are two ways to request strict mode. The first is to insert this pragma

```
"use strict";
```

at the top of a file or compilation unit. It must appear before any other statements, but it may be preceded by whitespace and comments. It has the form of a useless string literal statement, so it will be ignored by ES3 systems. This means that it is possible to write ES5/strict programs that can also run on the older browsers. Strict code can also interact with non-strict (or _sloppy_) code, so strict functions can call sloppy functions, and sloppy functions can call strict functions. This high level of compatibility makes adoption of strict mode easy.

All of the code in the file or compilation unit with the `"use strict";` preamble will be processed as strict code. There is a problem, though. [Performance considerations](/yuiblog/2007/09/04/video-souders/) currently compel us to concatenate many JavaScript files together to avoid cumulative HTTP delays. If a file with a `"use strict";` preamble has sloppy code appended to it, the sloppy code will be processed as strict and will probably fail. There is an easy rule: Do not mix strict and sloppy in the same file, but we have already seen some famous websites get this wrong.

The second way is to insert the pragma is as the first statement of a function. That declares that the whole function will be strict, including any functions that are nested within it. Strictness respects function scope, so strict code and sloppy code can be mixed in the same file. This second form works very well with the [Module Pattern](/yuiblog/2007/06/12/module-pattern/) and its many variations. The second form is preferred because it avoids the concatenation hazard.

```
(function () {
   "use strict";
   // this function is strict...
}());

(function () {
   // but this function is sloppy...
}());
```

## Scope

Historically, JavaScript has been confused about how functions are scoped. Sometimes they seem to be statically scoped, but some features make them behave like they are dynamically scoped. This is confusing, making programs difficult to read and understand. Misunderstanding causes bugs. It also is a problem for performance. Static scoping would permit variable binding to happen at compile time, but the requirement for dynamic scope means the binding must be deferred to runtime, which comes with a significant performance penalty.

Strict mode requires that all variable binding be done statically. That means that the features that previously required dynamic binding must be eliminated or modified. Specifically, the [with statement](/yuiblog/2006/04/11/with-statement-considered-harmful/) is eliminated, and the `eval` function’s ability to tamper with the environment of its caller is severely restricted.

One of the benefits of strict code is that tools like [YUI Compressor](http://developer.yahoo.com/yui/compressor/) can do a better job when processing it.

## Implied Global Variables

JavaScript has implied global variables. If you do not explicitly declare a variable, a global variable is implicitly declared for you. This makes programming easier for beginners because they can neglect some of their basic housekeeping chores. But it makes the management of larger programs much more difficult and it significantly degrades reliability. So in strict mode, implied global variables are no longer created. You should explicitly declare all of your variables.

## Global Leakage

There are a number of situations that could cause `this` to be bound to the global object. For example, if you forget to provide the `[new](/yuiblog/2006/11/13/javascript-we-hardly-new-ya/)` [prefix](/yuiblog/2006/11/13/javascript-we-hardly-new-ya/) when calling a constructor function, the constructor’s `this` will be bound unexpectedly to the global object, so instead of initializing a new object, it will instead be silently tampering with global variables. In these situations, strict mode will instead bind `this` to `undefined`, which will cause the constructor to throw an exception instead, allowing the error to be detected much sooner.

## Noisy Failure

JavaScript has always had read-only properties, but you could not create them yourself until ES5’s `Object.createProperty` function exposed that capability. If you attempted to assign a value to a read-only property, it would fail silently. The assignment would not change the property’s value, but your program would proceed as though it had. This is an integrity hazard that can cause programs to go into an inconsistent state. In strict mode, attempting to change a read-only property will throw an exception.

## Octal

The octal (or base 8) representation of numbers was extremely useful when doing machine-level programming on machines whose word sizes were a multiple of 3. You needed octal when working with the CDC 6600 mainframe, which had a word size of 60 bits. If you could read octal, you could look at a word as 20 digits. Two digits represented the op code, and one digit identified one of 8 registers. During the slow transition from machine codes to high level languages, it was thought to be useful to provide octal forms in programming languages.

In C, an extremely unfortunate representation of octalness was selected: Leading zero. So in C, 0100 means 64, not 100, and 08 is an error, not 8. Even more unfortunately, this anachronism has been copied into nearly all modern languages, including JavaScript, where it is only used to create errors. It has no other purpose. So in strict mode, octal forms are no longer allowed.

## Et cetera

The `arguments` pseudo array becomes a little bit more array-like in ES5. In strict mode, it loses its `callee` and `caller` properties. This makes it possible to pass your `arguments` to untrusted code without giving up a lot of confidential context. Also, the `arguments` property of functions is eliminated.

In strict mode, duplicate keys in a function literal will produce a syntax error. A function can’t have two parameters with the same name. A function can’t have a variable with the same name as one of its parameters. A function can’t `delete` its own variables. An attempt to `delete` a non-configurable property now throws an exception. Primitive values are not implicitly wrapped.

If your program passes [JSLint](http://www.JSLint.com/), it will probably work in strict mode.

## It Is Still An Imperfect World

There are still problems in JavaScript that strict mode does not address. For example, semicolon insertion is still a hazard, and 0.1 `+` 0.2 is still not equal to 0.3. Correction of these problems will have to wait for future editions.

## Why Strict Mode Matters

In addition to the obvious benefits to program reliability and readability, strict mode is helping to solve the Mashup Problem. We want to be able to invite third party code onto our pages to do useful things for us and our users, without giving that code the license to take over the browser or to misrepresent itself to the user or our servers. We need to constrain the third party code. Systems like [Google’s Caja](http://code.google.com/p/google-caja/) do this, but at a significant cost in performance and inconvenience. My own [ADsafe](http://www.ADsafe.org/) system also does this, but at the cost of eliminating `this` and `[]` subscripting from the language, which can make adoption difficult. Strict mode allows us to make third party code with the convenience and performance of ADsafe and the expressiveness of Caja. This will be critically important as our sites become more complex and more connected.

Strict mode does not solve the XSS problem. The solution to that problem depends on [W3C taking some positive action](http://ajax.sys-con.com/node/1544072).

ES5/strict is now in previews, and will soon be standard equipment in all standards compliant browsers everywhere.