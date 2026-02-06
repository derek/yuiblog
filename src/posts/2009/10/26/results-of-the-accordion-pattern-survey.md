---
layout: layouts/post.njk
title: "Results of the Accordion Pattern survey"
author: "Christian Crumlish"
date: 2009-10-26
slug: "results-of-the-accordion-pattern-survey"
permalink: /2009/10/26/results-of-the-accordion-pattern-survey/
categories:
  - "Development"
---
![accordion-yahoo-sports](/yuiblog/blog/wp-content/uploads/2009/10/accordion-yahoo-sports.png "accordion-yahoo-sports")A few months back [we shared our current thinking on the "accordion" navigation component](/yuiblog/blog/2009/03/23/survey-when-is-an-accordion-not-an-accordion/), and asked the community of web developers and designers who read this blog to take a survey to help us determine defaults, current practices, and other guidelines to incorporate into an Accordion pattern and provide input into an Accordion YUI component. I've had some time now to review and study the results and I wanted to share them with the community as we write up a "beta" version of the pattern and get ready to share it, so without further adieu, here are the results (note that this survey should not be considered strictly scientific). **Who Responded** Respondents identified themselves the following ways: ![accordion-respondents](/yuiblog/blog/wp-content/uploads/2009/08/accordion-respondents.png "accordion-respondents")

-   Designer 21.4%
-   Developer 32.1%
-   Hybrid (Both designer and developer) 42.3%
-   None of the Above 4.2%

**Terminology Distinctions** Overwhelming majorities across all respondents agreed that

-   Accordion and Accordion Menu mean the same thing (73%)
-   Accordions and Tree Controls are two different things (89%)

Many commenters described the difference between accordions and trees along these lines: "Tree Control generally implies a depth of hierarchy that is not generally present with an accordion." A smaller majority said that Accordion and Collapsible Panels refer to the same thing (60%). These majorities were consistent across roles. **Presentation of Accordions** A solid majority (68%), said that accordions can be laid out horizontally as well as vertically (and in fact the pattern is well attested on the web). People suggested that the labels on a horizontal accordion should be written vertically and/or rotated. An even larger majority (72%) said that accordions can have only two levels (this aligns with the distinction between accordions and trees): ![accordion-2-levels](/yuiblog/blog/wp-content/uploads/2009/08/accordion-2-levels.png "accordion-2-levels") A slight majority (53%) said that accordions may be nested within other accordions. The written comments suggested that the wording of the question led some to answer that it's certainly possible but not necessarily desirable, making suggestions such as, "If you adequately gutter them, this would be possible, but generally a terrible idea - kind of like using too many tabs and having them wrap into multiple rows." ![accordion-nested](/yuiblog/blog/wp-content/uploads/2009/08/accordion-nested.png "accordion-nested") This was one of the questions where self-described designers and developers took opposing sides. 57% of Developers and Hybrids agreed that accordions may be nested, whereas 64% of Designers said they may not be. (None of the Aboves split 50/50!) If I had to guess, I'd say that developers (and hybrids), more intimately connected with the how than the why may have been expressing more of a "you could do it..." perspective, whereas designers may have been expressing more of a "...but you shouldn't" point of view. **How Accordions Should Behave** A small majority (54%) believes that accordions should allow for more than one panel to be open at a time. Both behaviors can be found online, so our impression is that this behavior may depend more on the constraints of the design space and the purpose of the accordion than on a blanket rule one way or the other. This question also split along identity lines, but in an ambiguous way. Hybrids preferred the one panel-at-a-time rule by a tiny majority, while Designers and Developers and None of the Aboves agreed that multiple panels are okay by slightly larger majorities. ![accordion-multi-open](/yuiblog/blog/wp-content/uploads/2009/08/accordion-multi-open.png "accordion-multi-open") A much larger majority (73%) believes that an accordion can have a completely closed state (that is, that it's not necessary that there always be one panel open). The only outlier is that the None of the Aboves broke 60% for the position that there must always be one panel open. ![accordion-panels-closed](/yuiblog/blog/wp-content/uploads/2009/08/accordion-panels-closed.png "accordion-panels-closed") Several commenters suggested that it is a good practice to have one panel open by default, and for that panel to be either the first one, the one most recently used. Another large majority (76%) believes an accordion's overall size can change as needed, rather than being constrained to a consistent size. (Of course, there are contexts, such as the screen of a mobile device, in which it may be a valid choice or even a design constraint that an accordion maintain a consistent size.) A very slight majority (51%) suggested that accordions should open on click (as opposed to on hover) and a nearly as large minority (45%) said that it depends. Interestingly, fewer than 4% were willing to state the accordions should open on hover as a rule. ![accordion-onclick](/yuiblog/blog/wp-content/uploads/2009/08/accordion-onclick.png "accordion-onclick") Written comments on this question offered plenty of good food for thought, such as:

> Opening a panel should require explicit action. If an accordion has multiple panels, opening on hover could be a jarring experience. Rather, use a tooltip to convey summary details of what is in the panel, and have the user explicitly "click" to open that panel.

> Depends on the configuration of each accordion. I put these examples together \[[multiple](http://bubbling-library.com/sandbox/accordion/multiple.html), [rollover](http://bubbling-library.com/sandbox/accordion/rollover.html)\], so the developer can actually use the "best fit" for each use case. Also, there should be the option to use rollover with different rules: (one most be open) or (elements should be opened on mouseover only).

> For advanced usages, an accordion should open on hover during drag and drop operations. In any other circumstance, you can't trust that the hover is intentional.

**Accessibility** Finally, we asked an open-ended question fishing for any known accessibility issues with accordions and got a lot of great answers. (For our example issue, most people agreed that making the entire label clickable and not just a small icon is important.) Here is a sampling of other insight about accessibility with accordions:

> I think it's safe to assume that an Accordion interaction is an advanced interaction. Lots of accessibility problems can arise.
> 
> 1.  Content is hidden behind panels so people may not find it.
> 2.  Depending on the size of the clickable area or the trigger to open/close the panels there could be issues with the manual dexterity needed.

> Accordions should open all panels if javascript is unavailable (though that may produce a "flicker" for those with javascript).

> It depends on whether content in the hidden panels is present in the DOM or is retrieved upon opening the panel. If it is being retrieved, focus needs to be placed on the newly opened panel.

> Well, I really believe the title should be clickable, specially if the content of the element will be loaded using AJAX (just like a tabview approach), but the reality is that sometimes the developer (should have)/(want) the control to customize that behavior. Here is [the list of examples](http://bubbling-library.com/sandbox/accordion/index.html) that I created for an accordion widget implementation based on YUI 2.x, it's probably one of the most used components from the bubbling YUI extension.

> We've had a case where the 'label' of the accordion was a link to a full blog post, and so could not be accordion-clickable. In that case, we wrote an icon into the source with js to do the job. Provided the icon is sufficiently large and/or comes with an accesskey, I don't see a major difficulty...

> Accordion controls server the purpose of fitting lots of content into less space. Since this is a visual concern, it would be fine for a screen reader to simply read all of the content and ignore the fact that it is displayed as an accordion visually. It is sufficient for an icon to be clickable to expand a panel. There could be a configuration option to allow the entire label to expand a panel, or it can be left up to the implementing developer to attach a listener to the label that calls a public "open" or "expand" function to add that functionality.

> Just think of an accordion as a tabbed view. The entire panel label area should be clickable, but if it contains other controls (e.g. a "dismiss" or "close" button) I suggest only the label (text) be clickable, or at least the clikable area only expand up to the interactive controls (i.e. for a caption containing a button, the area above, below and "after" the button should be clickable).

**Releasing the Draft Pattern** One commenter questioned the artificial constraints of the survey (a fair cop, if you ask me):

> I didn't like this survey. The questions were not flexible enough. As a designer/developer, I believe all interface elements need to be tailored to particular site or web application. Asking black and white questions does not leave room for the obvious differences between projects. Some projects need a hard and fast rule, while the same rule might be totally inappropriate for another application. For the most part, I could of answered every question with a "it depends" result.

Rest assured that the pattern will only gently recommend and the YUI code will be flexible and powerful. The survey wasn't designed to limit people's choices but rather to gather opinions and preferences, so even feedback about not having hard-and-fast rules is useful. We've published a beta version of the [Accordion pattern](http://developer.yahoo.com/ypatterns/navigation/accordion.html) in the Yahoo! Design Pattern Library. If you'd like to give further feedback on the pattern, in a free-form manner, please drop by or visit the related [forum](http://developer.yahoo.net/forum/index.php?showtopic=2980) discussion.