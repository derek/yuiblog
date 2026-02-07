---
layout: layouts/post.njk
title: "Survey: When is an Accordion not an Accordion?"
author: "Christian Crumlish"
date: 2009-03-23
slug: "survey-when-is-an-accordion-not-an-accordion"
permalink: /2009/03/23/survey-when-is-an-accordion-not-an-accordion/
categories:
  - "Development"
---
![example of an accordion](/yuiblog/wp-content/uploads/2009/03/accordion-pop.png)I'm looking for feedback from people who have designed or built an interface using an "accordion" module (or are considering doing so). You see, I've been working on a design pattern for accordion modules, and I'd like to throw out a handful of open questions to the community via [this brief survey](http://www.surveymonkey.com/s.aspx?sm=lGHKygw2YwMI8yoom00Tzg_3d_3d). I'll be listening elsewhere as well, on twitter ([@mediajunkie](http://twitter.com/mediajunkie)) and on mailing lists where web designers and developers hang out.

(I realize this is not a scientific survey. I'm just interested in engaging the wider community in a discussion instead of trying to impose my view or Yahoo!'s view on the community as authoritative.)

Everywhere I go lately, it seems that interaction designers and web developers are talking about accordion widgets and debating about what makes an accordion an accordion. Not everyone working in this field has heard the term (some may simply refer to "stacked panels" or "collapsible panels") but most get the gist fairly easily. Ironically, none of the UI elements described as accordions share the actual behavior of a real-world accordion (the musical instrument): namely, that stretching an accordion opens all the folds evenly.

Accordions have been an on-and-off topic of discussion [on the main IxDA mailing list](http://www.ixda.org/search.php?tag=accordion); we discussed them in our [Pattern Library](http://interaction09.crowdvine.com/talks/show/2574) workshop in Vancouver earlier this month, and there's been an ongoing discussion about accordions on our internal designer mailing list here at Yahoo!.

So I sat down with some folks from the YUI team (and Marco, the maker of an experimental [YUI accordion widget](/yuiblog/2008/07/25/accordionview/)) a little while ago to sort through a draft of an accordion pattern that might help inform the development of an official YUI component.

Broadly speaking, most people agree on what we're talking about when we talk about an accordion interface element. Everyone agrees that accordions are used to compress content into a limited space and that they consist of panels that can collapse or expand. Beyond this, there are a number of subtle nuances that not everyone agrees on.

One trend I've noticed is that front-end developers tend be agnostic about how the accordion should work, viewing it as really just a variant on a tree widget. Designers tend to be more prescriptive, saying that to be an accordion it must behave in thus and such a way (but not all designers agree on what these rules are).

In the end, the YUI folks will produce code that can be made to do just about anything. We aren't going to try to impose our own taste or preferences in design through the functionality of the code itself. However, we will use the associated pattern to make suggestions and recommendations drawn from the experience of the entire design community, and we will probably lobby for default behaviors that match what most people expect.

So, if you've got a few minutes and an opinion, please [visit the survey](http://www.surveymonkey.com/s.aspx?sm=lGHKygw2YwMI8yoom00Tzg_3d_3d) and let me know what you think!

I'll close the survey on April 30.