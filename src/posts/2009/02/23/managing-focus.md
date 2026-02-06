---
layout: layouts/post.njk
title: "Improving Accessibility Through Focus Management"
author: "Todd Kloots"
date: 2009-02-23
slug: "managing-focus"
permalink: /2009/02/23/managing-focus/
categories:
  - "Development"
---
A core requirement for developers using ARIA is to provide keyboard access for widgets, as users of screen readers rely on the keyboard to navigate web sites and applications. A large part of providing keyboard access is managing focus of a widget's descendants (e.g., buttons in a toolbar, tabs in a tablist, menuitems in a menu, etc.), and the W3C guidelines provide two different approaches for doing so. This article explains both approaches and provides some practical advice for choosing between them.

### The Benefit of Focus Management

As outlined in the [ARIA specification](http://www.w3.org/TR/wai-aria/ "Accessible Rich Internet Applications (WAI-ARIA) Version 1.0") and corresponding [Best Practices](http://www.w3.org/TR/wai-aria-practices/) document, providing keyboard access requires, in part, that each widget has one tab stop by default and is responsible for discreetly managing focus for its descendants. Following these guidelines enables users to quickly navigate a page or application by using the tab key to move between widgets. Once a user has tabbed into a widget, they can then use other keys (the arrow keys for example) to move focus amongst the widget's descendants.

### Two Approaches

When it comes to managing focus, the WAI-ARIA Best Practices document provides two different techniques for developers: the [Roaming TabIndex Technique](http://www.w3.org/TR/wai-aria-practices/#focus_tabindex) and use of the [`activedescendant`](http://www.w3.org/TR/wai-aria-practices/#focus_activedescendant) property.

### Using the Roaming TabIndex Technique

The Roaming TabIndex Technique requires each of a widget's descendants be focusable, either through the use of natively focusable HTML elements, or by making an element focusable using the [`tabIndex`](http://www.w3.org/TR/html401/interact/forms.html#adef-tabindex) attribute. To use this technique, begin by setting the `tabIndex` attribute of a widget's first descendant to a value that is equal to or greater than 0. (A value of 0 will result in the tab order of the widget being relative to its position in the page. Use a value greater than 0 to precisely control a widget's tab order.) Next, set the `tabIndex` attribute of all remaining descendants to -1. (A value of -1 removes an element from the default tab flow, while preserving its ability to be focused via JavaScript.) This ensures that all of a widget's descendants are focusable via JavaScript, but only one is in the default tab flow of its containing page or application, and therefore focusable by the user.

With these `tabIndex` values, use a `keydown` event handler to manage focus of the descendants once the widget is focused by the user. As the user presses the arrow keys, call the `focus` method to activate the appropriate descendant and update the `tabIndex` of the remaining descendants so that the currently focused element is the only one that is natively focusable.

The following menu button example illustrates how to use the Roaming TabIndex Technique to create a widget that is both keyboard and screen-reader accessible. To test this example yourself, you can use the free [NVDA Screen Reader](http://www.nvda-project.org/) and [Firefox 3](http://www.mozilla.com/en-US/firefox/). Alternatively, you can watch the screen cast of the example running in Firefox 3 using the NVDA screen reader.

#### Roaming TabIndex Example

[Test Menu Roaming TabIndex Example](/yuiblog/sandbox/yui/v300pr2/examples/aria/example-1.html)

#### Roaming TabIndex Example Screen Cast

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=12030121&amp;vid=4487975&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/7356/80165708.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=12030121&amp;vid=4487975&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/7356/80165708.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34" type="application/x-shockwave-flash" width="512"></object>

  
[Menu Button Using Roaming TabIndex Technique](http://video.yahoo.com/watch/4487975/12030121) @ [Yahoo! Video](http://video.yahoo.com)

#### The Roaming TabIndex Technique Best Practices

Having studied the WAI-ARIA Best Practices document, as well as having used the Roaming TabIndex Technique in several widget implementations, I have distilled several best practices for using this approach:

-   I prefer using natively focusable elements instead of using the `tabIndex` attribute to make non-focusable HTML elements focusable, for better backward compatibility in browsers that don't support the `tabIndex` attribute on all elements.
-   Use the `keydown` event when binding handlers used to manage focus since it is not possible to handle non-alphanumeric keys using the `keypress` event in IE.
-   In most cases it is necessary to prevent the browser's default behavior when handling key events.
-   When setting the `tabIndex` attribute, avoid using the `setAttribute` method, to prevent case-sensitivity mistakes in IE. Setting the `tabIndex` attribute using the camel-case DOM property is both the most compact and most compatible syntax across browsers. For example: `myElement.tabIndex = -1;`
-   When updating the `tabIndex` attribute of a widget's descendants, set the attribute's value to 0 before calling the `focus` method to ensure that the element's default focus outline is rendered in IE.
-   When styling a descendant's focused state, work with or augment the browser's default rendering of focus rather than suppress it. The default rendering of focus is familiar to the user and, in many cases, consistent with the browser's host OS. Working with the default focus model improves the learnability of the widget. If you suppress the browser's default rendering of focus, be sure to provide a focus model that is consistent across your entire site or application so that the user only has to recognize and learn one focus model within a single context.
-   Set focus to HTML elements using both the `setTimeout` method and a `try/catch` block. Using `setTimeout` can help screen readers keep up while the focus is being changed. I have found this to be true when testing on [VoiceOver](http://www.apple.com/accessibility/voiceover/) for the Mac. A `try/catch` block can help suppress unwanted XUL-related errors logged to the console when focusing elements in Firefox.

### Using the `activedescendant` Property

Unlike the Roaming TabIndex Technique, use of the `activedescendant` property doesn't require any of a widget's descendants to be focusable. Instead, this technique requires only that the widget's root element be made focusable via the `tabIndex` attribute. (Note: this technique doesn't work in the current version of Safari as it doesn't support the `tabIndex` attribute on all HTML elements.) Using this approach, the `activedescendant` property is applied to the widget's root element, and as the user presses the arrow keys, the value of the property is set to the id of the element that represents the user's current selection. Since this approach doesn't rely on focusing a widget's descendants via the `focus` method, the browser will not provide any default rendering of the user's current selection. Therefore, when using the `activedescendant` property the developer is responsible for rendering focus for the widget's currently active descendant via CSS.

#### `activedescendant` Example

The following example adapts the previous example to illustrate how to use the `activedescendant` property.

[Test `activedescendant` Example](/yuiblog/sandbox/yui/v300pr2/examples/aria/example-2.html)

#### `activedescendant` Example Screen Cast

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=12052104&amp;vid=4497444&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/7381/80255044.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=12052104&amp;vid=4497444&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/7381/80255044.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34" type="application/x-shockwave-flash" width="512"></object>

  
[Menu Button Using The "activedescendant" Property](http://video.yahoo.com/watch/4497444/12052104) @ [Yahoo! Video](http://video.yahoo.com)

As illustrated in the screen cast, the `activedescendant` property can provide a user experience that is identical to the Roaming TabIndex technique.

#### Best Practices for Using the `activedescendant` Property

-   Depending on the browser and the attribute's value, setting the `tabIndex` attribute on a widget's root element can result in a focus outline being drawn around the widget. For widgets with descendants, having a focus outline surround an entire control is both unfamiliar to the user (not something you'll see on the desktop), as well as ugly. So when using the `activedescendant` property, it is best to suppress the focus outline. This can be accomplished by setting the [`outline`](http://www.w3.org/TR/CSS21/ui.html#propdef-outline) CSS property in Firefox and IE 8, and using the [`hideFocus`](http://msdn.microsoft.com/en-us/library/ms533783\(VS.85\).aspx) attribute for IE 6 and 7. Unfortunately it is not possible to suppress the focus outline in the current version of Opera.
-   Use CSS to render focus for a widget's descendants in a way that is consistent with, and/or builds on, the default browser focus, or is consistent within the scope of the site or application.

### Choosing a Technique

Having evaluated both the Roaming TabIndex Technique and the use of the `activedescendant` property, the Roaming TabIndex Technique is the better choice, because it is a solution that works "with the grain". As such, it is more forward and backward compatible — especially when you are trying to support a [wide array of browsers](http://developer.yahoo.com/yui/articles/gbs/index.html) like we are at Yahoo!. Using the `activedescendant` property requires more effort for less overall benefit and compatibility. Here are the downsides to using the `activedescendant` property:

-   Requires browser support of the `tabIndex` attribute on all elements. Currently this not supported in Safari.
-   Suppressing the default focus outline drawn around a widget's containing element is a slight pain in that it requires different techniques for different browsers. It turns into a bigger pain in Opera, where it is not only currently impossible but also exacerbated by Opera's egregious focus model, illustrated in the following screen capture: ![Screen capture of the focus menu from the second example running in Opera 9.6](/yuiblog/blog-archive/assets/managing-focus/focus-opera.png)
-   Loss of the default, familiar focus outline drawn around a widget's descendants. The focus outline can be restored via CSS. However, developers get the focus outline for free when using the Roaming TabIndex Technique.
-   Since descendants aren't focusable they cannot be clicked by pressing the enter key or space bar. This requires that developers listen explicitly for these key events and route the code responsible for handling the `click` event accordingly. When using the Roaming TabIndex technique, developers can simply listen for the `click` event.
-   Every descendant needs a unique id.

Unlike the `activedescendant` property, the Roaming TabIndex Technique allows widgets to be both keyboard accessible and screen-reader accessible in browsers that don't support ARIA and don't support the `tabIndex` attribute on all elements. For example, if a widget's descendants are built using the set of natively focusable HTML elements, users of screen readers will still perceive them as actionable/clickable elements. Consider the following screen cast of our first example running in IE 7 (a browser without ARIA support) using JAWS 10.

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=12051469&amp;vid=4497181&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/7381/80252536.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=12051469&amp;vid=4497181&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/7381/80252536.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.34" type="application/x-shockwave-flash" width="512"></object>

  
[Screen reader accessible Menu Button](http://video.yahoo.com/watch/4497181/12051469) @ [Yahoo! Video](http://video.yahoo.com)

In this example, while the user doesn't perceive the button's menu as a menu, the screen reader does announce each button in the menu as it is focused — letting the user know that each item is actionable/clickable. Additionally, since the button's menu is built using the natively focusable `<button>` element, this widget will be keyboard accessible to all [A-Grade browsers](http://developer.yahoo.com/yui/articles/gbs/index.html), not just those that support the `tabIndex` attribute on all elements.

I suspect that the `activedescendant` property was developed as an alternative to the Roaming TabIndex Technique in part because the `focus` and `blur` events don't bubble like other DOM events. This was a problem since developers need to listen for these events in order to customize how focus is drawn in a way that works cross browser, and attaching individual `focus` and `blur` event handlers to each of a widget's focusable descendants has consequences for performance — especially for large composite widgets like trees and menus. That said, since [we now have an easy way of listening for `focus` and `blur` in a performance-conscious way](/yuiblog/blog/2008/10/07/onfocus-onblur/), I feel like there are currently more downsides than upsides to using the `activedescendant` property.