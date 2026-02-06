---
layout: layouts/post.njk
title: "Design Pattern: Invitation"
author: "Bill Scott"
date: 2006-05-09
slug: "invitation"
permalink: /blog/2006/05/09/invitation/
categories:
  - "Design"
---
With the widespread acceptance of Ajax (and the resurgence of Flash) new ways of interacting on the web have emerged. In many ways, these interactions are not new. Interactions like drag and drop and inline editing have been mainstream on desktop applications for over 20 years. What is new, though, is the emergence of these idioms on the web.

This leads to two challenges.

First, **users must learn the idiom**. For example, inline editing on the web allows the user to actually change content on the page that _looks like normal content_. For years we have conditioned our users to expect a read-only web page. The ability to change content on-the-fly is unexpected. The classic example of this is editing photo titles in [flickr](http://flickr.com).

![Editing in flickr](http://static.flickr.com/50/141668545_cd97b3ce45_o.png)

Instead of having to moving to a new page to edit the photo title, the user can just click to edit and save their changes inline and in context to the page.

Second, let's say that a user learns this technique (idiom). How do they actually know that they can edit the photo title? How do they **discover the idiom**?

Repeated user research has confirmed the obvious fact that these deeper, richer interactions are less discoverable.

One solution to the problems of learning and discovering idioms is a set of patterns we are introducing in this release of the Design Pattern Library -- Invitations.

## Offer an Invitation

Rollover effects have been used for years on the web. Primarily they have given users a way to find out where the links or buttons on the page are at.

Invitations are a twist on rollover effects. They are sometimes as simple as a basic rollover (area lights up) but can also be more engaging by providing more feedback and animation when the mouse hovers over the area.

Additionally, as designers, we are often providing richer interactions like inline text editing (flickr.com), drag and drop of content modules (My Yahoo!) and rating movies directly (Netflix or Yahoo! News). It is no longer just about discovering a button but allowing the user to discover a deeper in page interaction.

Looking back at flickr.com we can see that when the mouse rolls over the area that can be edited the user is presented with three types of invitations:

-   Tool Tip Invitation. It simply says "Click to edit"
-   Cursor Invitation. The cursor changes to an I-Beam (insertion) indicating editability.
-   Hover Invitation. The editable area highlights as light yellow to indicate the scope of the edit.

![flickr invitations](http://static.flickr.com/51/141668532_51e1089622_o.png)

Together these invitations tell the user exactly what area will be affected (where), what operation will be performed and how to perform the edit.

You can see a similar set of invitations at 37 Signals in their backpackit product.

![Editing in backpackit](http://static.flickr.com/48/141668535_c2cc4f0336_o.png)

Notice they use the Hover and the Cursor invitations. The hover highlights as light yellow and displays a couple of inline context tools (Edit link and trashcan icon). The tooltip is not needed since the edit hyperlink is a fairly known idiom.

Invitations are powerful ways to clue the user in to deeper interaction. Its an invitation to call the user into deeper water. While it cannot solve all of the problems of discoverability it can make idioms and features more discoverable.

Here are two related articles you might find interesting:

-   Luke Wroblewski's article - [Bringing Desktop Interactions Online](http://lukew.com/ff/entry.asp?261)
-   My article on - [Musings on Mouse Hover](http://looksgoodworkswell.blogspot.com/2005/11/musings-on-mouse-hover.html)

You can find the Invitation pattern [here](http://developer.yahoo.com/ypatterns/parent.php?pattern=invitation).