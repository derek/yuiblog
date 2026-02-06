---
layout: layouts/post.njk
title: "Generalizing Code Through Functional Programming"
author: "John Lindal"
date: 2012-04-30
slug: "generalizing-code-through-functional-programming"
permalink: /2012/04/30/generalizing-code-through-functional-programming/
categories:
  - "Development"
---
Abstraction is a hot buzzword, but many people say abstraction when they really mean generalization. These two concepts are very different. In fact, they apply to opposite ends of the coding process.

A lot has been written about how abstractions simplify the job of constructing software, when programming in the large. Unfortunately, abstractions leak, as demonstrated by [Joel Spolsky](http://www.joelonsoftware.com/articles/LeakyAbstractions.html) and [Jeff Atwood](http://www.codinghorror.com/blog/2009/06/all-abstractions-are-failed-abstractions.html). This is unsurprising, given the definition of abstraction: the process of considering something independently of its associations, attributes, or concrete accompaniments. In other words, abstractions ignore details, and this always comes back to bite us.

Generalization, on the other hand, is useful when focusing on a specific problem, i.e., programming in the small. The goal of generalization is to make a solution for one problem usable for a larger class of related problems. This is the ultimate in code reuse: build it once and use it over and over again. As long as the generalization is done correctly, there is no danger of it failing, though there is always the possibility of not taking it far enough.

There are many ways to generalize code. This article will focus on building higher order functions, a particular strength of functional languages. Let us start with two obvious examples: `map` and `reduce` which apply a function to each element in a collection. These generalize the concepts of generating a new collection or value, respectively, from an existing collection.

It should be possible to generalize `map` and `reduce` further, to work on a forest, i.e., a collection of trees, instead of only a collection of items. The problem, however, is that the code that recurses must know how the trees are stored. Is a tree simply nested arrays, e.g., `[1, [2, 3], 4]`, or is each node an object from which the array of child nodes must be extracted? For `reduce`, one can pass in a function that extracts the children:

```
function reduceForest(roots, initial, operation, children)
{
	return Y.Array.reduce(roots, initial, function(value, root)
	{
		return reduceForest(children(root), operation(value, root), operation, children);
	});
}

```

For `map`, however, it is more complicated, because there is also the question of what the result should look like. A nested array can be mapped to another nested array, and a tree of objects can be mapped to another tree of objects, but supporting both at the same time would make the code quite complicated. Knowing when to stop generalizing is just as important as knowing when to keep going!

We can branch out in a different direction, however, because there are many types of collections, but the above code requires the children to be stored in arrays. We need to generalize the concept of iteration.

YUI's `oop.js` provides this, in the private function `dispatch`. Here is the slightly adjusted version used by [gallery-funcprog](http://yuilibrary.com/gallery/show/funcprog):

```
function dispatch(action, o)
{
	var args = Y.Array(arguments, 1, true);
	switch (Y.Array.test(o))
	{
		case 1:
			return Y.Array[action].apply(null, args);
		case 2:
			args[0] = Y.Array(o, 0, true);
			return Y.Array[action].apply(null, args);
		default:
			if (o && o[action] && o !== Y)
			{
				args.shift();
				return o[action].apply(o, args);
			}
			else
			{
				return Y.Object[action].apply(null, args);
			}
	}
}

```

This is wonderfully general. It works for any action: map, reduce, filter, etc. Arrays are routed to `Y.Array`. Objects that implement the action are called directly, allowing individual classes to optimize individual actions. All other objects are operated on by the generic versions in `Y.Object` (provided by [gallery-object-extras](http://yuilibrary.com/gallery/show/object-extras)). Sharp readers will note that the order of iteration for object members is undefined, but this doesn't matter for `map`, `reduce` with commutative operators, `filter`, etc. (Use `Y.some` at your own risk, however.)

The option for objects to implement custom versions of the actions leads to yet another generalization: [gallery-iterable-extras](http://yuilibrary.com/gallery/show/iterable-extras). This mixin implements all the actions for any object that provides the `iterator` method. The only requirement is that `iterator` must return an object that exposes `next` and `atEnd`. This is especially efficient for linked lists, where indexed lookup is O(n), but it could also simplify other classes, e.g., `Y.NodeList`, because one then does not have to explicitly implement map, reduce, filter, etc.

Of course, generalization doesn't have to be this complicated. When I was writing [gallery-sort-extras](http://yuilibrary.com/gallery/show/sort-extras), I first built this function:

```
Y.Sort.compareKeyAsString = function(key, a,b)
{
    return compareAsString(a[key], b[key]);
};

```

But then I realized that I would have to write a separate `compareKeyAsNumber`, so instead I generalized it to:

```
Y.Sort.compareKeyAs = function(f, key, a,b)
{
    return f(a[key], b[key]);
};

```

Since `sort` requires a function that takes only `(a,b)`, one must use `Y.bind` to [fix the first two arguments](http://en.wikipedia.org/wiki/Partial_application):

```
sort(Y.bind(Y.Sort.compareAsKey, null, Y.Sort.compareAsString, key))
```

So far, we have only considered functions which operate on functions. One can also build functions that return functions. A simple example is a function to reverse the sort order:

```
Y.Sort.flip = function(f)
{
    return function(a,b)
    {
        return f(b,a);
    };
};

```

Hopefully, these examples of using functional programming to generalize code will inspire you to look for situations where you can do the same in your own code.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._