---
layout: layouts/post.njk
title: "Design Pattern Conversation: What's the Best Way to Communicate Patterns? Part One."
author: "Luke Wroblewski"
date: 2006-10-11
slug: "communicating_patterns_part_one"
permalink: /2006/10/11/communicating_patterns_part_one/
categories:
  - "Design"
---
Q: What's the best way to communicate a pattern?

![Jenifer Tidwell](/yuiblog/blog-archive/assets/dp_jenifer.jpg)

[Jenifer Tidwell](http://jtidwell.net/)  
Interaction designer/software developer, The MathWorks  
Author, [Designing Interfaces](http://www.oreilly.com/catalog/designinterfaces/)  
Curator, [UI Patterns and Techniques](http://time-tripper.com/uipatterns/)

Patterns communicate design ideas from one designer to another. From this simple fact, so much else follows - the importance of examples, the need for an insightful "Problem" or "Use when" statement, and the relative unimportance of strict formats and formal logic.

Different people learn in different ways. Some will appreciate detailed textual explanations in a UI pattern, but designers tend to be visually-oriented - many may actually find more value in a carefully-chosen array of examples. Many readers have told me that their favorite aspect of "[Designing Interfaces](http://designinginterfaces.com/)" is the illustrations. These readers get the essence of the pattern from the illustrated examples, and find them inspiring as a source book for their own work. (Furthermore, I don’t believe a good pattern can even be written without examples. You have to ground the pattern in existing, real-world usage before writing the rest.)

Speaking of starting with examples, I've found that a new pattern arises from three key insights:

-   The recognition that you've seen a technique or idea "work" in more than one place or context.
-   An understanding of why it works. A solid understanding of cognitive and graphic-design theory helps here, even though the "why" is sometimes nothing more than "it's just convention."
-   Insight into when it's appropriate to use the pattern, and when it's not.

That last one, I find, is by far the most difficult of the three - it requires careful, thoughtful design judgment to reach a non-obvious recommendation. It's too easy to present a tautology. "Problem: you need a context menu. Solution: use a context menu." It's harder, but far more useful, to say something like: "Problem: you need to present a short, dynamic list of item-relevant choices to the user, but you can't use a lot of screen space for it." Yes, it's committing. Writing such a recommendation goes against the grain for many designers, who (understandably) tend to trust intuitive judgments more than rules, but it's really much more helpful for less knowledgeable readers.

Finally, a word about formats. Within the patterns community, a lot of attention has been given to the pattern format - what sections they're supposed to have, what those sections are named, etc. I have found that it matters less than we think, as long as the basic answers are there. (I use these: What, Use When, Why, How, and Examples.) Remember that you're writing this pattern for a human audience. It needs to be readable, and too many sections - or too much jargon; who can explain what "Forces" means? - makes it harder for the reader to decipher what you're trying to say.

You're not writing code, either. Or formal specifications, or a components catalog. You may personally find it useful to work out very precise logic in your patterns, but I guarantee that most readers won't care. That also means that I don't think UI patterns, as I write them, have much value for design automation or code generation. But that's another story.

All that said, every information architect knows the value of a consistent format used across multiple content providers! We pattern writers have all gone off and experimented with format and structure variations, but now what happens to readers who want to search or cross-reference all of our patterns? Well, now we have a problem! This is something we need to address in the near future, but I think some kind of format evolution was necessary to find the best answers.

\- Jenifer