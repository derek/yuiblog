---
layout: layouts/post.njk
title: "The Only Thing We Have To Fear Is Premature Standardization"
author: "Douglas Crockford"
date: 2008-08-14
slug: "premature-standardization"
permalink: /blog/2008/08/14/premature-standardization/
categories:
  - "Development"
---
The web is made of open standards. This was a significant factor in the web's displacement of proprietary application platforms. Openness is hugely attractive, so much so that the web dominates over competitors with better technologies. The difficult tradeoff that comes with a standards-based approach is that it is difficult to innovate. As a result, the basic technologies of the browser have been stalled for a decade. What innovation we've enjoyed, such as the Ajax revolution, has come by mining all of the latent, accidental potential of the existing standards. That potential has been used up.

If we are to go forward, we must repair the standards. This is something that must be done with great care. A revision to a standard is an act of violence, just like any surgical procedure. It should only be undertaken when the likely benefit far exceeds the cost and the pain and the risk. The web is particularly troublesome because it did not anticipate the management of software updates, which is why IE5, an ancient browser, still has more users than Safari and Opera combined. Changes to the standard can put developers in a very difficult position because the benefits to users of some browsers become the seeds of failure for the users of others. Developers must manage this gulf, and it is not easy. Developers are not well served by new standards that make their jobs even harder.

I think it is instructive to look at two approaches to managing innovation within a standards based system, one that I view as a success, and the other not so much. JavaScript was a promising but half-baked language that was irresponsibly rushed to market and then irresponsibly cast into a standard. That standard is called ECMAScript to avoid a trademark dispute. That standard was last revised in 1999.

It is clear that the language needs to be updated, but TC39 (the committee that is responsible for drafting a new standard) could not reach consensus on how to do it, so it split into two groups, each producing its own proposal. This was a good thing in that competition is healthy, and I believe that competition inspired improvements to both proposals. This was also a bad thing because no standards organization can adopt two proposal for the same standard. Without consensus, both proposals must fail.

On one side there was the proposal called ES4. It was unfortunate that it adopted that name because it strongly suggested that it was destined to be the Fourth Edition of ECMAScript, a fate that was not certain. The project was very open to new ideas and features, adopting a porkbarrel attitude that was almost Congressional in its expansiveness. Lots of good ideas were included without an adequate analysis of the language as a whole system. As a result, many overlapping features were adopted which would have significantly increased the complexity of the language.

ES4 was so large and so innovative that there were doubts about whether it could be successfully specified and implemented. More worrisome, there was no experience with the language itself. Would the interaction of features cause unintended problems as we saw in ES1 and ES3? The schedule for ES4 required that the standard be put in place and adopted by the browser makers before that question could be answered. This is a problem because once a bug is inserted into a standard, it can be extremely difficult to remove it. All of the features, considered individually, were attractive. But taken as a whole, the language was a mess.

On the other side was a proposal called ES3.1. Its name indicated a less ambitious proposal, being a smaller increment over the current Third Edition. This project was intended to repair as many of the problems with the language as possible while minimizing the pain of disruption. New syntax was considered only when it was already implemented and proven in at least three of the four major browsers. Feature selection tended to favor necessary improvements over desirable improvements.

ES3.1 was more minimal in approach. The set of feature interactions was much smaller and much easier to reason about. ES3.1 is likely to complete its specification and will be the candidate for the Fourth Edition.

ES4 had a large head start (by as much as seven years by some estimates), but was unable to meet its deadlines. Ultimately, the project fell apart when some of the key members left.

Some of the features that were in ES4 were reasonable, so a new project, called Harmony, is starting which will look at adapting the best of ES4 on top of ES3.1. The success of this project will depend on the ability of TC39 to do a better job of managing the tradeoffs between innovation and stability, and adopting a discipline for managing complexity. Simplicity should be highly valued in a standard. Simplicity cannot be added. Instead, complexity must be removed.

It turns out that standard bodies are not good places to innovate. That's what laboratories and startups are for. Standards must be drafted by consensus. Standards must be free of controversy. If a feature is too murky to produce a consensus, then it should not be a candidate for standardization. It is for a good reason that "design by committee" is a pejorative. Standards bodies should not be in the business of design. They should stick to careful specification, which is important and difficult work.

I see similar stories in HTML5. The early work of WHATWG in documenting the undocumented behavior of HTML was brilliant. It went off the rails when people started to just make new stuff up. There is way too much controversy in HTML5. I would like to see a complete reset with a stronger set of design rules. Things can be much worse than the way things currently are. Having smart people with good intentions is necessary but not sufficient for making good standards.