---
layout: layouts/post.njk
title: "Global Domination, Part Two"
author: "Douglas Crockford"
date: 2008-04-16
slug: "global-domination-part-two"
permalink: /blog/2008/04/16/global-domination-part-two/
categories:
  - "Development"
---
As I continue the practice of the craft of programming, I am always examining my practices. Can I improve the patterns that I use so that I can make my programs clearer, stronger, better? This is particularly important when working with a language like JavaScript which has a bias that favors patterns that are confusing, weak, and worse.

One of the worst features of JavaScript is its reliance on global variables. This can be mitigated with [global abatement](/yuiblog/blog/2006/06/01/global-domination/) and the [module pattern](/yuiblog/blog/2007/06/12/module-pattern/), which can significantly reduce the number of global variables that we need to declare.

But when we must declare a global variable, how best should we do that? JavaScript provides three ways of declaring a global variable, and they all have problems. Which is least worst?

The first is to assign to a new name outside of any function.

```
    pity = {};  // The first form
```

The second is to use the `var` keyword outside of any function.

```
    var pity = {};  // The second form
```

The third is to assign to a property of the global object.

```
    this.pity = {};  // The third form
```

All three forms do the same thing. (There is also a fourth way, the abominable implied global, but we will not speak of that here. And don't get me started on the fifth and sixth ways.)

So, given three ways to do the same thing, which should we use? I used to favor the second way. It looked to me the clearest in stating (or at least suggesting) my intention to declare something.

But it wasn't completely satisfactory. First, some people read `var` in that position as declaring the variable in the scope of the compilation unit, similar to the way `static` works in C. This would be a useful reading, except that JavaScript does not have compilation unit scope. A knowledgeable programmer should know that, but an alarming percentage of web developers program in ignorance of the language, so this is a mild concern.

A greater concern is that the second form is larger than the first form, but does the same thing. Generally, I prefer minimal forms.

But the thing that finally convinced me that the first form is the least worst is that IE gets the second form wrong, so that responsibly adaptive programs fail when using constructs like

```
    var pity = this.pity || {};
```

In order to be maximally productive, I want to avoid features that have portability problems. It took me too long to accept that the second form is problematic and should therefore be avoided.

The thing I liked about the second form was that it seemed more intentional. By typing `var`, I declared that this isn't an accidental misspelling. I am intentionally declaring a new global variable. But JavaScript paid no attention. I still feel the need to state that intention, so I state it in a comment.

```
    /*global pity*/
    pity = {};
```

[JSLint](http://JSLint.com/) is able to understand that comment, and can alert me to any global variables that I did not intentionally declare. That gives me confidence that I am not making a common mistake. The second form made me feel good, but didn't actually give me any real assurance.

I am still learning how to program. I read code, and I consider the opinions of other programmers. I still have the capacity to change my practices. It is hard sometimes to admit that my previous practices were weak. But that is more than offset by adopting practices that are stronger.