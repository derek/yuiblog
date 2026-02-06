---
layout: layouts/post.njk
title: "Design Pattern Conversation: What’s the Best Way to Communicate Patterns? Part Two."
author: "Jenifer Tidwell"
date: 2006-10-16
slug: "communicating_patterns_part_two"
permalink: /2006/10/16/communicating_patterns_part_two/
categories:
  - "Design"
---
Q: What's the best way to communicate a pattern?

![Luke Wroblewski](/yuiblog/blog-archive/assets/design/dp_luke.jpg)

[Luke Wroblewski](http://www.lukew.com/about/luke/)  
Principal Designer, Yahoo! Inc.  
Founder/Principal, [LukeW Interface Designs](http://www.lukew.com)  
Author, [Site-Seeing: A Visual Approach to Web Usability](http://www.lukew.com/resources/site_seeing.html)

Jenifer makes some great points about the key ingredients of a design pattern. I'd second the importance of examples and thoughtful "problem" and "use when" descriptions. Beyond these defining elements, the right metadata for a design pattern is often dicated by your audience.

When I was working on the first iteration of eBay's internal design pattern library, the user experience design group had been grounded in guidelines and standards. Perfectly understandable given the amount of people that were working on a single product: the eBay marketplace. Because so many different people contributed to the design and development of a single "site", rules had to be put in place to ensure some degree of consistency.

Over time these rules evolved into high-level architecural guidelines and detailed descriptions of presentation and interaction. We called these types of rules frameworks and components. Frameworks outlined the interaction and visual structure of task flows and screen types. For example, the process of registration is a flow and a Help page is a screen type. Frameworks helped to establish where and when content and actions should be presented to users. Components described our basic user interface building blocks (menus, forms, toolbars, etc.). They were designed to optimize usability and drive consistency across all of eBay.

So we had frameworks establishing where and when UI elements should be used and we had components detailing what those elements looked like and how they behaved. But we were still struggling to deliver consistent interface designs.

To use the terminology of the IDEO crowd, creative professionals are innately curious and often apply "the mind of a child" - open to new ideas and observations - to their unique form of problem solving. We had plenty of creative designers at eBay and they approached their work in exactly this way. They strove for new ideas and solutions and were innately curious about the rationale behind the frameworks and components we were using to drive consistency. As a result, lots of new solutions were proposed, and often adopted. As you can imagine this created an interesting dynamic between the "rules" and design - a naturally iterative and abductive approach to problem solving.

To embrace the design process within our redesigned "rules", we decided to morph our frameworks and components into a set of design patterns. Like rules, patterns could be tested, verified, and reviewed. Unlike rules, however, they were repeatable design solutions to common problems. This was a key distinction as the emphasis shifted away from "here's how it has to be done" to "here's a way to make your job easier."

In order to make this transition, we modified our documentation of frameworks and components. To our initial explanations of where and what, we added:

-   Why: what opportunities or constraints helped to define this pattern? Was there any research done to support it?
-   How: in an effort to make pattern adoption as easy as possible we included direct links to visual specifications and code where possible. We also provided an indication of status to ensure proper usage: under development, required, recommend, etc.
-   Who: direct links were provided to the people that had documented, identified, or designed the pattern.

Given our audience (a central design team working on a myriad of ultimately integrated products and features), this approach afforded a lot more flexibility in how we shared and documented design best practices. That said there's clearly some differences in our approach to the one Jenifer advocated earlier. Integration of code samples and visual specifications was important in order to make things easier for our designers and we included some fields that may be extraneous for a general-purpose audience. The basic answers our pattern documentation provide though were the same: "What, Use When, Why, How, and Examples."

\- Luke