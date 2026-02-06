---
layout: layouts/post.njk
title: "Design Pattern Conversation: What's the Best Way to Communicate Patterns? Part Four."
author: "Bill Scott"
date: 2006-10-20
slug: "communicating_patterns_part_four"
permalink: /2006/10/20/communicating_patterns_part_four/
categories:
  - "Design"
---
Q: What's the best way to communicate a pattern?

![Martijn van Welie](/yuiblog/blog-archive/assets/design/dp_martijn.jpg)

[Martijn van Welie](http://www.welie.com/about.html)  
Senior Interaction Designer, Satama Amsterdam  
Curator, [Patterns in Interaction Design](http://www.welie.com/patterns/index.html)

Patterns communicate design solutions. Jenifer states that they communicate from "one designer to another". Although this may be true, it may also be from designer to software developer or even to a client. As in any design problem you need to know your audience! What I have learned is that for all audiences the illustrations and examples are the most important element. They support the task of browsing through the collection for ideas and to understand in one glance what the pattern is about.

In the past people in the "pattern-enthusiasts-community" have long debated the structure and form of patterns. Jenifer and I have both taken a 'liberal' path and changed our formats several times over time when it seemed appropriate. What most patterns nowadays share is that they all try to answer the questions of "What?", "Why?", "When?" and "How?. And that is the most important thing of all.

Recently I have experimented with building a bridge to technical aspects of the patterns. This work has done with Eelke Folmer who was doing his Ph.D. on Software Architecture at the time. See the [Multi-level Undo](http://www.welie.com/eelke/undo.html) and [Wizard](http://www.welie.com/eelke/wizard.html) patterns for some examples. The main idea was that we tried to add software architecture information to a pattern rather than actual code. Adding code always leads to the issue that you have to choose some particular language and assume a certain technical environment. At Yahoo!, Bill is handing out code examples and I can see the difficulty there on how to do this in a handy way.

What is of course also tricky is that not every pattern will have a technical solution with it. For example, a pattern like [Alternating Row Colours](http://www.welie.com/patterns/showPattern.php?patternID=zebra-table) will not have a technical solution to go with it. Neither does the [Tabs](http://www.welie.com/patterns/showPattern.php?patternID=tabbing) or the [Product Page](http://www.welie.com/patterns/showPattern.php?patternID=product-page) pattern.

From my experience writing patterns is really difficult. The difficulty is in deciding what the problem really is and why/when the solution works. Like Jenifer says, "it is difficult avoiding [tautologies](http://en.wikipedia.org/wiki/Tautology_%28rhetoric%29)." Even in my own patterns the problem statements should be improved.

Once a collection of patterns starts to contain more than, say 50 patterns, it becomes more and more relevant to link them all together. The reasons for linking can vary: some patterns solve similar problems, or they often are used together or one pattern is actually part of another pattern, and so on. In my collection the links are gradually being added so that a network of patterns is starting to appear. But what then happens is that you discover than you need to tweak your patterns again and refine the problem statement and the _use when_ sections so that it makes full sense again.

One interesting development in Bill's collection is that he [distinguishes between two kinds of problems](http://looksgoodworkswell.blogspot.com/2005/05/mind-mapping-design-patterns.html). One category is "user problems" and the other is "application problems". The user problems are the kind of problems that are easily linked to user needs while the application problems mainly make the user experience better without being linked to a specific user task. I always tried to write patterns related to user problems but I got stuck with some of them. I think Bill’s approach solves the issue very well and I hope this can be a new insight that we can all benefit from.

All in all, I have the feeling we are all converging in the format we use. What now becomes a very interesting issue is how we can link all the patterns together and form one large pattern language. Let's see how it can be done.

\- Martijn