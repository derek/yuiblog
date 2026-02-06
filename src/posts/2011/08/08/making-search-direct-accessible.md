---
layout: layouts/post.njk
title: "Making Search Direct Accessible"
author: "Caridy Patino"
date: 2011-08-08
slug: "making-search-direct-accessible"
permalink: /blog/2011/08/08/making-search-direct-accessible/
categories:
  - "Development"
---
A few months ago we launched the first beta release of Search Direct. This new product explores the concept of real-time feedback, instantly delivering answers to the user with each keystroke. Given the diversity of Yahoo!'s audience, we wanted to make Search Direct as accessible as possible. Initially, we believed that this would be an easy task since this product would be based on YUI 3, a JavaScript library with accessibility baked into its DNA. Contrary to my expectations as an engineer, this task turned out to be more difficult than we anticipated.

### Introducing Search Direct

Although Search Direct is built from the ground up using YUI's component infrastructure, its most visibly prominent interface is based on the [YUI AutoComplete widget](http://developer.yahoo.com/yui/3/autocomplete/) which includes many accessibility features right out of the box. Suggestions related to a particular query are displayed in this autocomplete implementation. Search Direct also features a content panel, a.k.a. the _rich panel_, where suggestion-related content is displayed. The intention of the rich panel is to provide a direct answer to the user when a suggestion from the autocomplete list is selected.[![Search Direct Screenshot - Query: jen, Soft-selection: Jennifer Aniston](/yuiblog/blog-archive/assets/accessible-search-direct/sd.jpg)](http://search.yahoo.com/)

A new set of suggestions is displayed in the list on every keystroke, and the first suggestion is selected by default. This default selection is called a _soft selection_. Soft selections and subsequent interactions with the suggestion list dictate the content that is rendered into the rich panel. In reality, things are a bit more complicated (performance optimizations, additional cache layers, etc), but for the sake of simplicity we can assume that this is the common workflow.

### Accessibility features

In the quest for making Search Direct accessible, we looked at the implementation of Search Assistant, a technology that Yahoo! pioneered a few years back, as well as the native accessibility features of YUI.

After this investigation, three primary accessibility features were proposed for Search Direct:

-   Using the [YUI Internationalization utility](http://developer.yahoo.com/yui/3/intl/) to serve localized content.
-   Setting `role` and `aria-*` attributes on elements within the autocomplete widget, that need to be identified and processed by screen readers.
-   Using a hidden `div` that represents a live region (`aria-live`) to notify the user when something happens. E.g., the number of available suggestions, the selected suggestion, etc.

The plan was to notify the user of any changes in the Search Direct interface, and provide a set of keyboard shortcuts to navigate the following visual components:

-   Searchbox
-   Submit button
-   Suggestion list
-   Rich panel

Sounds like a breeze, right? Well, let's take a step back.

### The problem

What we have here are two asynchronous processes — one of them for updating the suggestion set and the other one for retrieving corresponding answers — and they're both _really_ fast. We're talking about 250ms end to end. Since the interface is changing at such a rapid pace, keeping track of everything can be difficult for a screen reader user. It gets an order of magnitude more complicated when updates happen in an asynchronous, near real-time manner. Because the screen reader was being notified of every change in the interface, the resulting chatter made it difficult to make sense of what was going on.

Lacking an acceptable solution, we started collaborating with Yahoo!'s resident accessibility guru, Victor Tsaran ([@vick08](http://twitter.com/#!/vick08)) to try and come up with something better.

The first time we watched Victor interact with Search Direct, it was immediately clear to me that a majority of his focus was on the rich panel instead of the suggestion list. This was a surprise for me, as we viewed the list as the "source of truth". During one of our sessions, we had a stroke of luck when we happened to disable all the accessibility features of the list. As soon as the noise introduced by the list was cut out, Search Direct started to make sense to Victor!

### How users of screen readers perceive Search Direct

After realizing that we were trying to solve the wrong problem, we went back to the original user story: _"As a user, I can get an answer as I type"_. Getting the answer across to the user was the priority. After redefining the problem, we concentrated our accessibility efforts on an implementation where the screen reader prioritized the rich panel content over the suggestion list.

For example, if the user types `"miami wea"`, the screen reader will tell them two things:

-   10 suggestions.
-   WEATHER MIAMI, FL. TODAY, Scattered Thunderstorms, 89°F 77°F. TOMORROW, Isolated Thunderstorms, 90°F 74°F...

It will then continue reading out the rest of the rich panel content. The user doesn't need to know all 10 suggestions up front, every time the list updates. If they do want to know, the information is readily accessible via keyboard navigation.

To ensure that the suggestion list is adding value to the experience, we make sure that the first phrase in the rich panel is closely related to its corresponding suggestion. For instance, based on the previous example, `"weather miami"` is the first phrase in the rich panel for the suggestion: "miami weather".

Victor Tsaran, of the Yahoo! Accessibility Lab, shows how it works on FireFox with the NVDA screen reader:

<iframe allowfullscreen="allowfullscreen" frameborder="0" height="349" src="http://www.youtube.com/embed/Vd_W_8tIDNA" width="560"></iframe>

The screen reader experience for our application is easier to follow since we now only focus on the following two visual components:

-   Searchbox
-   Rich panel

Changes to the autocomplete list as a whole are no longer tracked, and the submit button is ignored since the user can always hit enter for the current query or use a keyboard shortcut (tilda access key: `[control, alt or shift] + ~`) to switch between the input element and the rich panel. These keyboard navigation options are revealed to the user when the searchbox is acknowledged by the screen reader.

From an engineering perspective, this change greatly simplified things. The amount of DOM manipulation in the most active component was drastically reduced, improving the overall performance of Search Direct. Here is an example of the implementation:

```
function SDAAria () {
    var node = this._liveRegion = Y.Node.create('<div role="status" class="off-screen" aria-live="assertive"></div>');
    // Create the ARIA live region...
    Y.one('body').append(node);
    // listening for aria:live messages to update the live region
    this.on('aria:live', this._handlerMsg, this);
    // listening for gossip:refresh to announce how many suggestions
    this.on('gossip:refresh', this._handleGossipRefresh, this);
}
SDAAria.ATTRS = {
     strings: {
         valueFn: function () {
             return Y.Intl.get('sd-aria');
         }
     }
};
SDAAria.prototype = {
    _ariaSay: function (stringId, subs) {
        var message = this.get('strings.' + stringId) || '';
        this._liveRegion.setContent( subs ? Y.Lang.sub(message, subs) : message );
    },
    _handlerMsg: function (e) {
        if (e.id) {
            this._ariaSay(e.id, e.subs);
        }
    },
    _handleGossipRefresh: function () {
        var size = this.get('suggestions').size();
        this._ariaSay( (size > 0 ? 'SUGGESTIONS' : 'NO_SUGGESTIONS'), {
            n: size
        });
    }
};

```

### Lessons learned

When creating an accessible interface, it's important to ask the right questions. Making every bit of your application accessible may not be the right approach.

Request early feedback from users of screen readers — don't assume that you have your bases covered until you get some user feedback. Utilizing every tool and feature at your disposal may not have the intended effect.

Users of screen readers may have difficulty keeping track of real-time updates, especially if screen readers are bombarded with notifications. In these scenarios, less can be more. Identify and focus on what is important for the user instead of trying to replicate the raw experience of the application for the screen reader.

![Caridy Patiño](/yuiblog/blog-archive/assets/accessible-search-direct/caridy.jpg)_**About the author:** Caridy Patiño, Principal Frontend for Yahoo! Search Direct. He has been a longtime YUI Contributor and creator of Bubbling Library YUI Extension, as well as guest blogger at YUIBlog.com sharing some of his extensive experience building high performance web applications. Loading strategies, event-driven architectures and SSJS are some of the subjects where Caridy spends most of his time these days._