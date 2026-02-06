---
layout: layouts/post.njk
title: "Dr. Strangeloop or: How I Learned to Stop Worrying and Love Functional Programming"
author: "John Lindal"
date: 2012-04-09
slug: "dr-strangeloop-or-how-i-learned-to-stop-worrying-and-love-functional-programming"
permalink: /blog/2012/04/09/dr-strangeloop-or-how-i-learned-to-stop-worrying-and-love-functional-programming/
categories:
  - "Development"
---
Disclaimer #1: You’re already doing functional programming: everytime you pass a callback to `Y.on`. This article is about digging a bit deeper.

Disclaimer #2: Replacing for loops with function calls does add execution overhead. However, this is usually negligible, unless you are trying to compute the last digit of π. Remember Donald Knuth’s advice that premature optimization is the root of all evil, and the two rules of optimization: (1) Don’t do it. (2) Don’t do it yet.

Disclaimer #3: To run all the examples in this article, you will need to use the [Functional Programming](http://yuilibrary.com/gallery/show/funcprog) module in the YUI 3 Gallery.

OK, now on to the main event...

### List Processing

Any time you have a set of items that you need to process, you can use a for loop. However, it’s a bit ugly:

```
for (var i=0; i<list.length; i++) { var item = list[i]; ... }
```

When you need to iterate over an object, it gets worse, because you have to check `hasOwnProperty`:

```
for (var key in obj)
	if (obj.hasOwnProperty(key)) { var item = obj[key]; ... }

```

If you use `Y.each` instead, then you don’t have to do any of this:

```
Y.each(collection, function(item) { ... });
```

This works equally well for both lists and objects. It even works for instances of `Y.NodeList` and any class that mixes in [gallery-iterable-extras](http://yuilibrary.com/gallery/show/iterable-extras), e.g, [gallery-linkedlist](http://yuilibrary.com/gallery/show/linkedlist).

### Beyond `Y.each`

As nice as `Y.each` is, we can do much better in many cases. If you want to stop part way through the collection, you can use `Y.some`, which stops when your function returns `true`, or `Y.every`, which stops when your function returns `false`.

If all you want to do is find one particular item, then `Y.find` is much clearer than using `Y.some`. To find all the items that match a criterion, you can use `Y.filter`. To invert the matching, use `Y.reject`. If you need both sets, use `Y.partition` to get both `matches` and `rejects`.

### Map/Reduce

If you need to transform the collection, then it is much cleaner to use `Y.map` or `Y.reduce` rather than using `Y.each` with a closure to accumulate the desired result.

`Y.map` applies a transformation function to each element and returns the result as a collection. For example, you could map a list of strings to a list of their lengths:

```
var lengths = Y.map(strings, function(s) { return s.length; });
```

`Y.reduce` accumulates the result of a computation applied to each element. For example, you could reduce a list of strings to get the total length of all of them:

```
var total = Y.reduce(strings, function(sum, s) { return sum + s.length; });
```

Choosing between map and reduce can get tricky when the result will be a collection. The best guideline I have found so far is that, if the operation could be done in parallel, use map. It doesn’t matter in which order the items are processed, because the result is guaranteed to be in the same order as the original collection. If the operation must be done serially, use reduce. For example, if you want to flatten a tree, then you normally want to control the order of the items in the resulting list.

### The Big Payoff: Code Reuse

As nice as it is to simplify your code and iterate over many different types of collections, the real improvement comes when you start to reuse the functions passed to the iterators.

But, you ask, how can I reuse my big, complicated function which concatentes the contents of some of the nodes in a list into a string and also builds an array from the CSS classes of some other nodes in the list? The answer is: decompose this into simpler operations. First filter the list, then reduce the result to a string. Then filter the list again and map the nodes to CSS classes. (If you worry that this is slower because it iterates four times instead of once, then you’re right, but see Disclaimer #2 above.)

Once you begin decomposing your complicated logic into simple units usable with filter, map, and reduce, it is very likely that you will start to reuse the simple units. The simpler the operation, the more likely that it can be reused.

### Recursion

Another benefit of the above approach to iteration is that recursion becomes simpler. Instead of writing a function which loops over a collection and then calls itself, you can write a function which operates on a single item and then invokes map, reduce, etc. to recurse. By focusing on a single item, the problem and the resulting code become simpler.

### Conclusion

This article only touches on a few aspects of switching from a procedural (for loops) to a functional (iterator) way of building code, but hopefully the value of doing so is already clear. To dig even deeper, I recommend studying the Haskell programming language. The syntax is often very different from procedural languages, but the concepts are powerful and very applicable in JavaScript.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._