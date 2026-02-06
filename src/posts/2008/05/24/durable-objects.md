---
layout: layouts/post.njk
title: "Durable Objects"
author: "YUI Team"
date: 2008-05-24
slug: "durable-objects"
permalink: /2008/05/24/durable-objects/
categories:
  - "Development"
---
Cooperating applications, such as mashups, must be able to exchange objects with robust interfaces. An object must be able to encapsulate its state such that the state can be modified only as permitted by its own methods. JavaScript's objects are soft and currently the language does not include any means to harden them, so an attacker can easily access the fields directly and replace the methods with his own. Fortunately, JavaScript provides the means to construct durable objects that can perfectly guard their state by using a variation of the [Module Pattern](/yuiblog/blog/2007/06/12/module-pattern/). You'll recall that the Module Pattern makes it possible to make an object with privileged methods. Privileged methods are able to access the private state of the constructor's closure. By adding one simple rule, we can easily generate secure objects:

> A durable object contains no visible data members, and its methods use neither `this` nor `that`.

This is a template for a durable constructor: `function` durable`(`parameters`) {`  
    `var that = {}` or the product of another durable constructor`;`  
    `var` private variables`;`  
    `function` method`() {`  
        ...  
    `}`  
    `that.`method `=` method`;`  
    `return that;`  
`}` Define all of your methods as private methods. The methods you choose to expose to the public get copied into `that`. None of the functions defined or inherited make use of `that` or `this`. We can give the object created by the durable constructor to untrusted code. That code will be unable to get direct access to the private state. It can replace the methods with its own methods, but that only reduces the usefulness of the object to the attacker. It does not weaken or confuse the object. Each method is a capability. The object is just a collection of capabilities. Durable objects allow code from multiple (possibly untrusted) parties to cooperate. Durable objects can be expressed in a safe subset of JavaScript, such as ADsafe or Cajita.