---
layout: layouts/post.njk
title: "Design Pattern Conversation: What’s the Best Way to Communicate Patterns? Part Three."
author: "Bill Scott"
date: 2006-10-18
slug: "communicating_patterns_part_three"
permalink: /blog/2006/10/18/communicating_patterns_part_three/
categories:
  - "Design"
---
Q: What's the best way to communicate a pattern?

![Bill Scott](/yuiblog/blog-archive/assets/design/dp_bill.jpg)

[Bill Scott](http://billsportfolio.com)  
Ajax Evangelist, Yahoo! Inc.  
Blogger, [Looks Good Works Well](http://looksgoodworkswell.com)  
Former Curator, [Yahoo! Design Pattern Library](http://developer.yahoo.com/ypatterns/)

The question of "What is the best way to communicate patterns?" has several dimensions.

How Will Patterns be Distributed?

In answering the main question, it is important to ask specifically "how the patterns will be distributed?" At Yahoo! the User Experience & Design (UED) team (at that time spearheaded by Erin Malone, Matt Leacock, Chanel Wheeler and others) [created the pattern library](http://www.boxesandarrows.com/view/implementing_a_pattern_library_in_the_real_world_a_yahoo_case_study) using a popular open source content management system (CMS) – Drupal. This is important because one of the key benefits of a CMS is the ease in which it allows content (e.g., patterns) to be created by anyone designated as an author (in this case open to all of Yahoo! UED).

This has allowed the Yahoo! Design Pattern library to grow organically across the organization. Instead of a single pattern author controlling the library, anyone can add patterns to the library (although a review process exists to bring them to full publication.)

However, the [public pattern library](http://developer.yahoo.com/ypatterns/) does not use the Drupal system. The CMS system is best suited for adding content (patterns) but not so flexible in organizing the patterns in an easily findable manner. With the public library we chose a flexible design to help solve the "findability problem." Of course we have not solved all findability problems—but we are no longer constrained by the CMS. For the external pattern library the patterns are represented in JavaScript Object Notation ([JSON](http://json.org)) format. This will allow us to distribute patterns as web services - not just as web pages. This will make it possible to publish the patterns in different formats to different devices. And finally, other pattern sites will be able to [mashup](http://en.wikipedia.org/wiki/Mashup_\(web_application_hybrid\)) their patterns with the Yahoo! patterns into a single web site.

Why does all this matter? Patterns distributed in online format are easier to share than patterns that do not have an online presence. This does not discount that there are clear benefits to other formats (e.g., book.) Distributing patterns as web pages and web services gets them to the masses quicker yielding a higher adoption rate.

How Will Patterns be Constrained?

The next thing to consider is what legal constraints will be applied to patterns. This should not be taken lightly. At Yahoo! we chose the least restrictive Creative Commons License ([by attribution](http://creativecommons.org/licenses/by/2.0/).) This was on purpose. We felt this was the best way to give our patterns "wings".

What was the result of setting our patterns free? First, we have received an enormous amount of goodwill from the design and engineering community. Second, it has exposed the concept of patterns to a much wider audience. And finally other companies have decided (or are considering) releasing some or all of their patterns to the public as a result. This can only mean good things for the design and development community at large.

Who are the Users of our Patterns?

Good design always starts with, "Who is the user?" and "What is the user’s goal?" Primarily our patterns are targeted for web designers since this is the core of Yahoo!’s business.

Knowing our target audience led us to think about how we wanted to organize our pattern library. Of course, there is no one single taxonomy for organizing a pattern library.

A year back I took all the patterns from Jenifer Tidwell, Martijn Van Welie and Sri Laakso and set out to find a good way to structure them. What an exhausting effort! I eventually experimented with [Mind Mapping](http://en.wikipedia.org/wiki/Mind_mapping) software to help me grapple with the complexity.

After several mind mapping sessions, [I finally realized](http://looksgoodworkswell.blogspot.com/2005/05/mind-mapping-design-patterns.html) the obvious. If a designer is coming to the pattern library, they most likely have a problem and are looking for a solution (yes, that should have been obvious.) Knowing that patterns contain a problem statement and a solution, it only seemed natural to organize them in a way consistent with their problem statements. A typical problem statement might say, "The user needs needs to re-arrange the layout of modules on a web page directly." This would fall under the category of User Needs and Customization (user needs to customize…). It turns out that a number of patterns directly satisfy user needs and the rest are driven by system constraints that the designer must account for. This means that some patterns are goal-directed, the rest are constraint-based. This led to the current organization of the public pattern library.

So What Makes up a Pattern?

I think it is important to structure the patterns in a consistent manner with a few clear, concise sections. We chose to first state the problem, next we show a sensitizing example, then we move to usage and wrap up with the solution. We also have a couple of optional sections: a rationale that can go into more detailed design nuances as well as an accessibility section.

In addition, we provide code examples with most of our patterns. These patterns include not just a design solution but also starter code to get teams moving as fast as possible. As a matter of convention, we place the code solutions in the sidebar and not in the main pattern content body. This emphasizes that while the code is related to the pattern, it is not a direct part of the pattern. I think adding code is a great solution for company-specific pattern libraries. But I also agree with Jenifer that general purpose pattern libraries should generally avoid providing code samples.

A final point of clarification is that internally we separate the Visual Design Guidelines (written as Visual Design Patterns) from the Interaction Design Patterns (like what you see on the public site.) This allows us to keep the interaction patterns more general by separating the style (spacing, fonts, colors, etc.) from the interaction.

\- Bill