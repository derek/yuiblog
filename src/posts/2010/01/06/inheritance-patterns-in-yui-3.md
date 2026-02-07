---
layout: layouts/post.njk
title: "Inheritance Patterns in YUI 3"
author: "Stoyan Stefanov"
date: 2010-01-06
slug: "inheritance-patterns-in-yui-3"
permalink: /2010/01/06/inheritance-patterns-in-yui-3/
categories:
  - "Development"
---
This article discusses two JavaScript code reuse patters implemented in [YUI 3](http://developer.yahoo.com/yui/3/) - the classical inheritance pattern and the prototypal inheritance pattern.

## Satisfying dependencies

The prototypal pattern is available from the [core YUI 3 API](http://developer.yahoo.com/yui/3/yui/) in the yui-min.js seed file. The classical pattern requires the [`oop`](http://developer.yahoo.com/yui/3/api/YUI~oop.html) module, but since the `oop` module is a requirement for most of the other modules, you usually won't have to do anything special to get access to this functionality. But if you want to create a simple test page to play with the patterns yourself, you can satisfy the dependencies by including YUI like so:

```html
<script type="text/javascript" src="http://yui.yahooapis.com/3.0.0/build/yui/yui-min.js"></script>
<script>
YUI().use('oop', function(Y){
  // your code goes here
  // Y is the YUI instance
});
</script>
```

## (pseudo)Classical inheritance

You can call this pattern "classical" not because it comes from Plato's ancient Greece, but because it helps you think in terms of classes. JavaScript doesn't have classes (hence the "pseudo" part), but it has constructor functions instead.

In Java or other languages you can have a `Programmer` class inherit from a `Person` class. In JavaScript, you'll actually have a `Programmer` constructor function and a `Person` constructor function. The goal is to have objects created with the `Programmer` constructor inherit properties and methods as if they were created with the `Person` constructor.

Consider these two constructors:

```javascript
// parent
function Person() {
  // "own" members
  this.name = "Adam";
}

// properties of the parent's prototype
Person.prototype.getName = function() {
  return this.name;
};

// child constructor
function Programmer(){}
```

YUI 3's `oop` module offers the `Y.extend(...)` method to help you with the inheritance part. It's as simple as:

```javascript
Y.extend(Programmer, Person);
```

Then you can test that the `getName()` method was properly inherited:

```javascript
var guru = new Programmer();
alert(typeof guru.getName); // "function"
```

Note that the `Y.extend(...)` method will only inherit members of the prototype, not "own" members. It is considered a good practice to add all the reusable functionality to the prototype and leave all instance-specific properties as own properties (added to `this`). In the example above, only `getName()` gets inherited, while `name` does not. (In the prototypal inheritance pattern - discussed further in the article - you inherit both prototype and own members.)

### Extend and augment

`Y.extend(...)` allows you to inherit from a parent constructor and at the same time augment the child with new members. This is actually the de facto pattern used by YUI to build "class" extensions.

You can add properties to the prototype of the child constructor using the third parameter to `Y.extend(...)` and you can add properties to the constructor itself (class static properties) using the fourth parameter.

Here's an example of extending and augmenting at the same time:

```javascript
Y.extend(Programmer, Person, {groksHTML: true}, {LIMIT: "sky"});

// groksHTML is now a property of the child's prototype
alert(typeof Programmer.prototype.groksHTML); // "boolean"

// the property works for all new objects
var bob = new Programmer();
alert(bob.groksHTML); // true

// adding to the constructor is more for 
// "static" properties meant to act as constants
alert(Programmer.LIMIT); // "sky"
var limit = bob.LIMIT; // undefined
```

### Superclass

The pseudoclassical pattern described above gives you access to the prototype of the parent's constructor via the static property called `superclass`.

`superclass` points to the prototype of the parent and so `superclass.constructor` points to the parent constructor function. Consider an example:

```javascript
// inherit
Y.extend(Programmer, Person);

// child's access to the parent constructor
var parent = Programmer.superclass.constructor; 
// test
alert(parent === Person); // true

// access to the parent from an instance of the child
var guru = new Programmer();
guru.constructor.superclass.constructor === Person; // true
```

As noted earlier, with the classical pattern you only inherit prototype members. But using the `superclass` you can also initialize the parent constructor from the child and get the parent's own properties as the child's own properties.

You can modify the `Programmer` constructor to call the parent constructor, passing the child object (`this`) and any initialization arguments

```javascript
// ... parent definition same as shown before...

// child
function Programmer() {
  // initialize the parent using the child as "this"
  Programmer.superclass.constructor.apply(this, arguments);
}

// inheritance
Y.extend(Programmer, Person);

// test
var pro = new Programmer();
alert(pro.name); // "Adam"
```

As you can see, the programmer instances now have a `name` property and it's an own property.

```javascript
alert(pro.hasOwnProperty('name')); // true
alert(pro.hasOwnProperty('getName')); // false  
```

### Access to overridden methods

The fact that `superclass` points to the prototype of the parent lets the child gain access to overridden methods. Consider this classic example of `Triangle` that inherits `Shape`:

```javascript
// parent
function Shape(){}
Shape.prototype.toString = function() {
  return "shape";
};

// child
function Triangle(){}

// inheritance
Y.extend(Triangle, Shape);

// child overrides the parent's toString() method
// but thanks to the superclass property
// it still has access to the original method
Triangle.prototype.toString = function(){
  return Triangle.superclass.toString() + ", triangle";
};

// test
var acute = new Triangle();
acute.toString(); "shape, triangle"
```

## Prototypal inheritance

Douglas Crockford suggests this inheritance pattern, where you forget all about classes and have your objects inherit from other objects. For example:

```javascript
// parent object, created with a simple object literal
var parent = {
  name: "John",
  family: "Wayne",
  say: function() {
    return "I am " + this.name + " " + this.family;
  }
};

// the inheritance magic
// a new object is born from an existing one
var batman = Y.Object(parent);

// customize or augment the new object
batman.name = "Bruce";

// use
batman.say(); // I am Bruce Wayne
```

Using this pattern there are two steps in setting up your objects:

1.  You create a new object inheriting all the properties and methods from an existing object.
2.  You customize the new object - you can overwrite some of the members or add brand new ones.

Note that `Y.Object(...)` is available in the YUI core. You don't need to include the `oop` module.

### Prototypal inheritance discussion

If you're curious about the motivation behind the prototypal inheritance and how it works under the hood, you can study the pattern described in [Douglas Crockford's own words](http://javascript.crockford.com/prototypal.html).

Using this pattern, the parent's members are inherited via the prototype chain. That means that if you add a property with the same name to the child, the new property will not overwrite the one inherited from the parent, but it will take precedence. In other words, you can redefine the `say` method like so:

```javascript
batman.say = function() {
  return "Can't tell you my real name";
};

// test
batman.say(); // "Can't tell you my real name"
```

Unlike in the classical inheritance model afforded by `Y.extend`, there is no way to reference the parent's `say` method from the child object's `say` (vis. `superclass`). However, if you delete the `say` method of the child object, the parent's `say` will "shine through".

```javascript
delete batman.say;
batman.say(); // "I am Bruce Wayne"
```

### In ECMAScript 5

The [new edition of the ECMAScript standard](http://www.ecma-international.org/publications/files/ECMA-ST/ECMA-262.pdf) includes the prototypal inheritance pattern through a native method called `Object.create(...)`.

```javascript
// YUI3
var batman = Y.Object(parent);

// ECMAScript 5 (future)
var batman = Object.create(parent);
```

## More?

Thanks very much for reading! For more information and examples of the two patterns discussed in this article, you can consult these links:

-   [Todd Kloots' "YUI 3 Sugar" presentation](http://developer.yahoo.com/yui/theater/video.php?v=kloots-yuiconf2009-sugar) from YUIConf on [YUI Theater](http://developer.yahoo.com/yui/theater/)
-   `oop` module [API docs](http://developer.yahoo.com/yui/3/api/YUI~oop.html)
-   Highlighted source of the [`oop` module](http://developer.yahoo.com/yui/3/api/oop.js.html)
-   Functional examples of using [extend](http://developer.yahoo.com/yui/3/examples/yui/yui-extend.html)
-   The source for [Y.Object](http://developer.yahoo.com/yui/3/api/yui-object.js.html)

Stay tuned for a follow-up article that discusses even more code reuse patterns in YUI3.