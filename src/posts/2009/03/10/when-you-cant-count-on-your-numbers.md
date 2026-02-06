---
layout: layouts/post.njk
title: "When You Can't Count On Your Numbers"
author: "Douglas Crockford"
date: 2009-03-10
slug: "when-you-cant-count-on-your-numbers"
permalink: /blog/2009/03/10/when-you-cant-count-on-your-numbers/
categories:
  - "Development"
---
JavaScript has a single number type: IEEE 754 Double Precision floating point. Having a single number type is one of JavaScript's best features. Multiple number types can be a source of complexity, confusion, and error. A single type is simplifying and stabilizing.

Unfortunately, a binary floating point type has some significant disadvantages. The worst is that it cannot accurately represent decimal fractions, which is a big problem because humanity has been doing commerce in decimals for a long, long time. There would be advantages to switching to a [binary-based number system](http://www.math.utah.edu/pub/tex/bib/dr-dobbs-1980.html#Crockford:1982:SCM), but that is not going to happen. As a consequence, `0.1 + 0.2 === 0.3` is `false`, which is the source of a lot of confusion.

When working with floating point numbers, it is important to understand the limitations and program defensively. For example, the Associative Law does not hold. `(((a + b) + c) + d)` is not guaranteed to produce the same result as `((a + b) + (c + d))`.

Let's demonstrate this. We'll start with a `partial_reduce` function. We pass it an array and a function, and it returns in array containing the results of calling the function on pairs of elements. This sort of thing might be popular in the future to take advantage of parallelism because work on each of the pairs could happen simultaneously.

```
    var partial_reduce = function (array, func) {
        var i, result = [], x = array.length - 1;
        for (i = 0; i < x; i += 2) {
              result.push(func(array[i], array[i + 1]));
        }
        if (i === x) {
            result.push(array[i]);
        }
        return result;
    };

```

We can then write an `add` function and a `totalizer` function that works by looping over `partial_reduce` until it produces a single value.

```
    var add = function (a, b) {
        return a + b;
    };
    var totalizer = function (array) {
        while (array.length > 1) {
            array = partial_reduce(array, add);
        }
        return array[0];
    };

```

If I make an `array` containing 10000 elements all set to `0.01`, then `totalizer(array)` produces `100`, which is good.

Now let's try totaling the same `array` the old fashioned, sequential way. `array.reduce(add, 0)` produces `100.00000000001425` which is close, but no cigar. Every floating point operation can potentially accumulate some noise. The order in which you perform the operations can have an impact on the amount of noise you get.

There is work on a decimal flavor of IEEE 754, and we looked at incorporating it into the next edition of ECMAScript. Unfortunately, adding a second number type to a language having only one can do a lot of violence to the language, so we deferred consideration of the decimal type to a future edition. Also, the proposed decimal type is extremely slow in execution, and to my eye is much too complicated in its specification.

Note: The `reduce` method will appear in the next edition.