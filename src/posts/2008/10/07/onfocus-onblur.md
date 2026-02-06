---
layout: layouts/post.njk
title: "Introducing onFocus and onBlur"
author: "Todd Kloots"
date: 2008-10-07
slug: "onfocus-onblur"
permalink: /blog/2008/10/07/onfocus-onblur/
categories:
  - "Development"
---
Back in April, PPK authored a blog entry titled [Delegating the focus and blur events](http://www.quirksmode.org/blog/archives/2008/04/delegating_the.html) in which he proposed a solution to the problem that neither the focus or blur events bubble in any browser. His solution (registering capture-phase event listeners for focus and blur) is a blessing to any developer wishing to avoid the code bloat and performance bottleneck that can result from binding discrete focus and blur event handlers for focusable elements.

We liked PPK's solution and decided to answer his call and be, in his words, "...one of those frightfully clever JavaScript librar\[ies to\] use this technique...". So for version 2.6 we've rolled PPK's solution into two methods of the Event Utility: [`addFocusListener`](http://developer.yahoo.com/yui/docs/YAHOO.util.Event.html#method_addFocusListener) and [`addBlurListener`](http://developer.yahoo.com/yui/docs/YAHOO.util.Event.html#method_addBlurListener) (or `onFocus` and `onBlur` for short). These two new methods encapsulate the nitty gritty of supporting this technique in all our [A-Grade browsers](http://developer.yahoo.com/yui/articles/gbs/), while delivering the sugar you've come to expect from the [`addListener`](http://developer.yahoo.com/yui/docs/YAHOO.util.Event.html#method_addListener) method of the Event Utility. The signatures of these new methods are as follows:

`onFocus(el, fn, obj, override)`  
`oBlur(el, fn, obj, override)`

The arguments for both methods are as follows:

el

An id, an element reference, or a collection of ids and/or elements to assign the listener to.

fn

The method the event invokes.

obj

An arbitrary object that will be passed as a parameter to the handler.

override

override If true, the obj passed in becomes the execution scope of the listener. If an object, this object becomes the execution scope.

### Using onFocus and onBlur

Here are several ways we've made use of the new `onFocus` and `onBlur` methods in YUI 2.6:

#### Improving Performance of Modal Dialogs

To support modality, a Dialog widget needs to direct focus back to itself when an element that is not one of its children receives focus. Previously this was accomplished by registering focus event listeners on every focusable element in the document when a modal Dialog was made visible, and removing those listeners when it has was hidden, a process that proved to be expensive and slow. Using PPK's technique we've been able to boost the time it takes to initially display a modal Dialog by over 50% in most browsers, and boost the time it takes to hide a modal Dialog by over 90%. To test, we used a page with [250 focusable elements](/yuiblog/sandbox/yui/v260/examples/container/modalitytest.php). Here is how the numbers break out for each browser:

Time (in milliseconds) to initially display a modal Dialog widget on a page with 250 focusable elements in YUI 2.5.2 and YUI 2.6.0
| Browser | YUI 2.5.2 | YUI 2.6.0 | % Faster |
| --- | --- | --- | --- |
| FF 3 Mac OS 10.4 | 245 | 107 | 56 |
| FF 3 Win XP | 158 | 88 | 44 |
| FF 2 Mac OS 10.4 | 368 | 161 | 56 |
| FF 2 Win XP | 320 | 131 | 59 |
| Opera 9.5 Mac OS 10.4 | 103 | 93 | 10 |
| Opera 9.5 Win XP | 71 | 60 | 15 |
| IE 7 | 200 | 70 | 65 |
| IE 6 | 220 | 121 | 45 |
| Safari 3.1 | 53 | 18 | 66 |

Time (in milliseconds) to hide a modal Dialog widget on a page with 250 focusable elements in YUI 2.5.2 and YUI 2.6.0
| Browser | YUI 2.5.2 | YUI 2.6.0 | % Faster |
| --- | --- | --- | --- |
| FF 3 Mac OS 10.4 | 65 | 1 | 98 |
| FF 3 Win XP | 57 | 1 | 98 |
| FF 2 Mac OS 10.4 | 198 | 2 | 99 |
| FF 2 Win XP | 221 | 0 | 100 |
| Opera 9.5 Mac OS 10.4 | 531 | 1 | 100 |
| Opera 9.5 Win XP | 380 | 0 | 100 |
| IE 7 | 381 | 30 | 92 |
| IE 6 | 371 | 40 | 89 |
| Safari 3.1 | 48 | 1 | 98 |

#### Improving Menu Keyboard Accessibility

In keeping with the [WAI-ARIA Best Practices for Menus](http://www.w3.org/TR/wai-aria-practices/#Menu), the [Menu widget](http://developer.yahoo.com/yui/menu/) uses the new `onFocus` method to listen for focus at the document level, so that when a popup Menu is hidden focus can be restored to the element in the DOM that had focus before it was made visible.

#### Providing Focus Feedback in Carousel

The new [Carousel widget](http://developer.yahoo.com/yui/carousel/) skins its next and previous buttons by wrapping each `<input type="button">` elements in a `<span>`. The `<input>` elements are then positioned off screen and a background image is applied to each `<span>`. While this technique allows the next and previous buttons to remain accessible to users of screen readers, with the actual next and previous buttons hidden off screen, sighted users don't receive any feedback from the UI when either button is focused. To fix this problem, Carousel uses the `onFocus` method to apply a class to the next and previous buttons that highlights focused buttons with an outline.

Of course, these are just a few places where we've used `onFocus` and `onBlur` — we think it will prove so useful in YUI and in YUI-based applications that we've added it to our Core, making it available to any application you build on top of YUI's Event Utility.