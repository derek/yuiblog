---
layout: layouts/post.njk
title: "More code reuse patterns in YUI3"
author: "Stoyan Stefanov"
date: 2010-01-07
slug: "more-code-reuse-patterns-in-yui3"
permalink: /2010/01/07/more-code-reuse-patterns-in-yui3/
categories:
  - "Development"
---
This post is a follow-up to the article ["Inheritance patterns in YUI3"](/yuiblog/blog/2010/01/06/inheritance-patterns-in-yui-3/) and dives deeper into the YUI3 APIs showing more patterns for code reuse. The [Gang of Four book](http://en.wikipedia.org/wiki/Design_Patterns_%28book%29) advocates that we should "prefer object composition to class inheritance". And in fact, inheritance is sometimes used as a workaround in strongly typed languages where the signature of an object or a class needs to be fixed at compile time. JavaScript is loosely typed and objects can be composed, mixed and augmented at any time.

## Augmenting objects

In real-life JavaScript, it's rare that you would have to setup deep inheritance chains. Often you may only want to augment an existing object (or a constructor) with the members of another, without necessarily forming a parent-child relationship. YUI offers the method `Y.augment(...)` to do just that.

The following example illustrates the difference between the proper inheritance with `Y.extend(...)` and the simple object augmentation with `Y.augment(...)`.

```
// parent, a.k.a. supplier of functionality
function Programmer(){}
Programmer.prototype.writeCode = function(){};

// a constructor that gets augmented with supplier's members
function CodeMonkey(){}
Y.augment(CodeMonkey, Programmer);
var monkey = new CodeMonkey();

// a constructor that inherits from the parent-supplier
function Guru(){}
Y.extend(Guru, Programmer);
var guru = new Guru();

```

Now that we've reused `Programmer`'s functionality in two ways, let's test the outcome. Both objects `monkey` and `guru` now get a `writeCode()` method, but only the `guru` is part of the inheritance chain.

```
alert(typeof monkey.writeCode); // "function"
alert(typeof guru.writeCode); // "function"

// monkey is not a Programmer, while guru is
alert(monkey instanceof Programmer); // false
alert(guru instanceof Programmer); // true

```

`Y.augment(...)` can also take an object (as opposed to a constructor) to be augmented.

```
var n00b = {};
Y.augment(n00b, Programmer);

// now n00b can writeCode
alert(typeof n00b.writeCode); // "function"

```

`Y.augment(...)` allows the recipient to be more picky when reusing code from the supplier. An optional third parameter to `Y.augment(...)` defines whether existing properties should be overwritten (`false` by default, meaning preserve the original properties of the recipient). The fourth parameter can optionally provide a whitelist - an array containing the names of the properties that should be carried over.

## Cloning

Cloning objects is yet another pattern for code reuse, which allows you to create brand new objects which are just like existing ones. In a way, the idea is similar to the prototypal inheritance (see `Y.Object(...)` in the previous article), where objects inherit from objects. The main difference is that when cloning, the parent's properties get copied to the child directly, not through the prototype chain.

`Y.clone(...)` creates a deep copy, meaning it recurses through array and object properties. It also creates copies by value, so that the cloned object doesn't modify the parent by mistake (in JavaScript arrays, objects and functions are copied by reference).

To illustrate the difference, consider an object `pro` that gets cloned into a new object `clone` and also inherited as `wiz` using `Y.Object(...)`.

```
// original object
var pro = {groks: ['html']};

// inherit
var wiz = Y.Object(pro);

// clone
var clone = Y.clone(pro);

```

Now let's add a new array element to the original object

```
pro.groks.push('css');

```

The child object sees the updated value, while the clone doesn't, because the clone is a snapshot of what the object was at the time of cloning.

```
wiz.groks.join(); // "html,css"
clone.groks.join(); //"html"

```

This works the other way around as well - when the child modifies the array.

```
wiz.groks.push('js');
pro.groks.join(); // "html,css,js"
clone.groks.join(); // "html"

```

### Clone discussion

As you can see `Y.clone(...)` creates new objects by deep-copying all their properties and methods. Although this is probably not what you'd normally call inheritance, it's still a pretty simple and straightforward pattern for code reuse. After all code reuse is about avoiding the need to duplicate code and reusing existing functionality.

Something you may be wondering - what about performance? Isn't it inefficient to copy values like that. The answer is - yes, it could be inefficient. But for most applications this would rarely be the bottleneck. In fact [Firebug](http://getfirebug.com) (Firefox extensions are written in JavaScript), which is a pretty complex piece of software has an `extend()` method which works by simply copying properties from the parent object to the child object, using a shallow copy (not recursing into objects and arrays).

So, since cloning is just deep-copying properties from one object to another, wouldn't it be nice if you can inherit functionality from multiple objects, not only from one? This is where `Y.merge(...)` comes to help you with this sort of mix-in objects.

## Mixin objects with `Y.merge(...)`

The mixin pattern allows you to grab properties and methods from multiple objects and carry them over into a new object. YUI3 provides the method `Y.merge(...)` which can take any number of objects and return a single one which is a mix of all source objects.

Here's an example:

```
var mad_skillz = {bake: function(){}, mix: function(){}, eat: function(){}};
var ingredients = {sugar: "lots", flour: 1, eggs: 2};
var dairy = {milk: 1};

// mixin
var cake = Y.merge(mad_skillz, ingredients, dairy);

```

Now you can test which properties got carried over to the `cake` object using the convenient method `Y.Object.keys(...)` which gives you an array of all property names.

```
Y.Object.keys(cake).join(); // "bake,mix,eat,sugar,flour,eggs,milk"

```
`Y.merge(...)` resembles cloning, but instead of deep-copying one object, it creates a shallow copy and can take multiple objects to mix with the same method call. The overwriting logic of `Y.merge(...)` in cases of property naming collisions is different than most other methods - if you have two members with the same name, the last one wins and overwrites the previous.

Just like with `Y.clone(...)`, `Y.merge(...)` is not necessarily limited to the purposes of code reuse. You can use them also for manipulating arrays or any sort of hash-like objects, such as configuration objects.

## `Y.mix(...)`

`Y.mix(...)` is the lower-level method behind most of the functionality discussed above. It offers you a fine-grained control over which properties get copied and where exactly. It also allows you to combine two properties with the same names, ignore certain properties and so on.

Here's a somewhat complex example of using the `Y.mix(...)` API:

```
// an object
var pro = {
  groks: ['html', 'css', 'js'], 
  speaks: ['Latin'], 
  tweets: true
};

// a constructor
function WebGuru(){}

// augmenting the prototype of the constructor
// with some of pro's properties
Y.mix(WebGuru, pro, true, ['groks', 'tweets'], 4);

// test
var guru = new WebGuru();
guru.groks.join(); // "html,css,js"
guru.tweets; // true
guru.speeks; // undefined

```

If you look at the call to `Y.mix(...)`, we have 5 arguments, meaning:

1.  `WebGuru` gets more members...
2.  from `pro` ...
3.  overwriting any existing ones...
4.  only if they are in this whitelist array `['groks', 'tweets']`. This means that the `speaks` property will not be mixed
5.  4 is the mode. There are five mixing modes - 0 to 4, where 4 means that the _prototype_ of `WebGuru` will receive members from `pro`.

You can [check the docs](http://developer.yahoo.com/yui/3/api/YUI.html#method_mix) for more information on the parameters accepted by `Y.mix(...)`.

## That's all folks!

Thank you for reading! For more information and examples on the OOP functionality in YUI3, you can consult these links:

-   [Todd Kloots' "YUI 3 Sugar" presentation](http://developer.yahoo.com/yui/theater/video.php?v=kloots-yuiconf2009-sugar) from YUIConf on [YUI Theater](http://developer.yahoo.com/yui/theater/)
-   OOP module [API docs](http://developer.yahoo.com/yui/3/api/YUI~oop.html)
-   Highlighted source of the [OOP module](http://developer.yahoo.com/yui/3/api/oop.js.html)
-   Functional examples of using [augment](http://developer.yahoo.com/yui/3/examples/yui/yui-augment.html), [mix](http://developer.yahoo.com/yui/3/examples/yui/yui-mix.html) and [merge](http://developer.yahoo.com/yui/3/examples/yui/yui-merge.html)