---
layout: layouts/post.njk
title: "I'd Rather switch Than Fight!"
author: "Douglas Crockford"
date: 2007-04-25
slug: "id-rather-switch-than-fight"
permalink: /2007/04/25/id-rather-switch-than-fight/
categories:
  - "Development"
---
JavaScript's `switch` statement was inspired by Java's `switch` statement, which was inspired by C++'s `switch` statement, which was inspired by C's `switch` statement, which combined aspects of C. A. R. Hoare's `case` statement and Fortran's computed `goto` statement. Dijkstra considered the `goto` statement to be harmful, which it in fact is, which is why the `goto` has been omitted from most modern programming languages. But some of the `goto`'s problematic nature survives in the `switch`, so some extra care must be employed when using it. The problem with `switch` was once thought to be its cleverest feature: Fallthru. If you do not explicitly interrupt the flow of control, after executing the code associated with a case, the code of the next case is run too. This provides for a sort of local code reuse, but it can make programs that are harder to read, and it can mask bugs. Accidental fallthru bugs can be very expensive to identify and fix. The best defense against them is to never intentionally use fallthru. That way, if a fallthru ever appears in your code, you can immediately recognize it as a defect that needs correction. That is a lot easier than trying to figure out which fallthrus are accidental and which are not. Features like fallthru are _attractive nuisances_. They are sometimes useful, but they encourage weak coding patterns. JavaScript has more than its share of attractive nuisances ([`with`](/yuiblog/blog/2006/04/11/with-statement-considered-harmful/), [implied globals](/yuiblog/blog/2006/06/01/global-domination/), [`new`](/yuiblog/blog/2006/11/13/javascript-we-hardly-new-ya/), and semicolon insertion, to name a few). Your programs will be stronger if you avoid them. JavaScript's `switch` is better than Java's because it allows matching on strings. This is really useful. The ability to switch on strings satisfies the role that `enum` provides in other languages. Being able to do more with less is a mark of a good programming language. JavaScript matches its cases with the `===` operator, which tests for equality without type coercion. (The `==` operator does type coercion, which sometimes produces surprising results. It is another attractive nuisance.) The value `NaN` cannot be found to be equal to itself, so

> `case NaN:`

will never match.