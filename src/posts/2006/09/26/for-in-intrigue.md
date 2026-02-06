---
layout: layouts/post.njk
title: "for in Intrigue"
author: "Douglas Crockford"
date: 2006-09-26
slug: "for-in-intrigue"
permalink: /blog/2006/09/26/for-in-intrigue/
categories:
  - "Development"
---
One of JavaScript's best features is the ability to augment the built-in types. If we want to add a new method to a type, we simply assign a function to the type's `prototype`. So, if I think that JavaScript strings should have a `trim` method (and they should) then I can write
```
String.prototype.trim = function () {
    return this.replace( /^\\s*(\\S*(\\s+\\S+)*)\\s*$/, "$1");
}
```
Now all of my strings have a `trim` method, even strings that were constructed before I did the augmentation. We can do this for any of the built-in types: `Object`, `Array`, `Function`, `Number`, `String`, and `Boolean`. This is a source of great expressive power which can help JavaScript realize its potential as dynamic, functional, object-oriented language. JavaScript is, sadly, also a flawed language, and one of its flaws interacts badly with augmentation of `Object`. But fortunately, we can mitigate the problem. The flaw is that the `for in` statement, which can enumerate the keys stored in an object, produces all of the keys in the object's prototype chain, not just the keys in the object itself. This causes inherited methods to appear in the enumeration, which is bad. If would have been nicer if JavaScript did not contain this flaw, but fortunately we can program around it. In all of the [A Grade browsers](http://developer.yahoo.com/yui/articles/gbs/gbs_browser-chart.html), we should always write `for in` statements in this form:
```
for (name in obj) {
    if (obj.hasOwnProperty(name)) {
        ...
    }
}
```
It is deeply annoying that we have to include the extra `if` statement to filter out the extraneous values. It would seem better to ignore the flaw and code in ignorance. This is possible if you can guarantee that your code will never interact with programs that will augment `Object.prototype`. But as we get better at mashups and code sharing, ignorance produces brittleness. The standard describes an augmentable `Object.prototype`. Ignore standards at your own peril. The `hasOwnProperty` method is useful in making JavaScript's objects act as general containers. For example, suppose you are keeping a list of key words where each word is used as a key. We can quickly determine if a word is in our list:
```
function check_word(word) {
    return !!words[word];
}
```
Unfortunately, the function can produce the wrong result if the `word` is `"constructor"` because there will be a `constructor` property in `words`'s prototype chain. We can use `hasOwnProperty` to filter out the chain.
```
function check_word(word) {
    return words.hasOwnProperty(word);
}
```
One of the unfortunate consequences of the language having gone through multiple versions is that not every JavaScript environment provides the `hasOwnProperty` method. IE 5.0 and Safari 1.3 do not. If your program has to run in those as well, then there is an older equivalent that is almost as good, in which we filter out function values.
```
for (name in obj) {
    if (typeof obj[name] !== 'function') {
        ...
    }
}
```
```
function check_word(word) {
    return typeof words[word] !== 'function';
}
```
Would it be better if JavaScript were not flawed? Absolutely. But it is flawed, and you can only get so far by pretending that it isn't.