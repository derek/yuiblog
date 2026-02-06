---
layout: layouts/post.njk
title: "Context Menus and Focus in Opera"
author: "Unknown"
date: 2008-07-17
slug: "context-menus-and-focus-in-opera"
permalink: /2008/07/17/context-menus-and-focus-in-opera/
categories:
  - "Development"
---
As a JavaScript toolkit developer, there are two features lacking in Opera that have frustrated me for a while: support for the `contextmenu` DOM event and the ability to override the default rendering of focus via CSS. When Opera released version 9.5, I was disappointed to see that neither of these features were implemented. As frontend engineers, we spend a lot of time responding to decisions made by browser manufacturers, but we don't get much opportunity to learn the specific thought process behind those decisions. After exchanging some emails with the Opera team, I now have some insight into their decisions and the perspective that perhaps withholding such features could be beneficial to the user.

### Background

Although the capabilities of the browser have evolved significantly in recent years, the user's perception of the browser hasn't necessarily evolved with it. After the launch of Yahoo! Photos 3.0, I remember a friend of mine emailing me because she was having trouble viewing the large version of her photos. She was repeatedly clicking on each thumbnail without success. Eventually she figured out that she needed to double click on the thumbnails to view the full size image. Double clicking to open a folder or a file is, of course, a natural interaction on the desktop, but for years users were trained not to expect this interaction in the context of web applications.

Some users still don't expect desktop-like interaction from web applications. I remember logging into my Yahoo! Mail not long ago and seeing checkboxes next to each message. I paused. What were these checkboxes, these artifacts of Web 1.0, doing in my Web 2.0 application? I had been using the new DHTML, Outlook-like version of Yahoo! Mail since its early beta and had become used to dragging and dropping in order to move and delete messages. But the reappearance of these checkboxes was another sign that not every user's expectations had evolved with the capabilities of the browser.

As the browser has matured it has evolved it into a platform for rich application development, making it possible to deliver applications with a level of interactivity and visual fidelity of those found on the desktop. And while the browser is now a platform, it also continues to play its original Web 1.0 role of an application, a content viewer that enables users to surf all of the news sites, blogs, etc. scattered across the eclectic Web. But as the browser now plays these dual roles of being an application and an application development and delivery platform, how does this duality impact the user in terms of usability and accessibility? And what user-centric features and functionality can consumers expect of a browser, especially one battling with duality? I suspect that Opera's answer to these questions is that not all users understand the modern browser's dual role, and that is it necessary to render some fundamental things consistently across experiences within the browser.

### Context Menus

[![The YUI Menu Control's ContextMenu in Safari (top) and Opera (bottom); Opera does not allow developers to customize the context menu in web applications.](/yuiblog/blog-archive/assets/klootsopera/contextmenu.gif)](http://developer.yahoo.com/yui/examples/menu/contextmenu_source.html) Consider context menu functionality. By not implementing the `contextmenu` event, Opera does not allow frontend engineers to override the default context menu provided by the browser; all other [A-Grade browsers](http://developer.yahoo.com/yui/articles/gbs/) support this feature. What benefit could there be to not implementing the `contextmenu` event?

If some users perceive everything inside the scope of the browser as a web page, that influences the user's expectation of what functionality will be surfaced in a context menu. Over the years many users have come to expect that raising a context menu in the scope of a browser will surface browser-centric functionality relative to HTML content (i.e. "Open Link in New Window"), rather than functionality of the web application running within the browser. Therefore, providing a custom context menu for a web application might not be expected or seen as helpful for users who have come to rely on functionality in the browser's context menu.

The downside is that, by not allowing the developer to provide custom context menu implementations (such as those provided by the [YUI Menu Control](http://developer.yahoo.com/yui/menu/)), Opera is in a small way preventing the user from understanding the browser as a platform for rich application development.

### Focus

Focus could be considered as sacred as the context menu. Knowing what element has focus is fundamental to keyboard accessibility. And while most modern browsers support customization of the rendering of focus, is it a good idea to do so? The presentation and behavior is of HTML is now so completely customizable via CSS and JavaScript that the user experience can differ drastically across sites and applications on the web. Keeping something as fundamental as focus consistent means one less thing the user has to re-learn when navigating the across the web. Consider the following example:

#### [Example 1: Anchor Elements (The Good)](/yuiblog/sandbox/yui/v252/examples/button/example10.html#example-1)

<table><tbody><tr><td><img alt="Screen capture of a focused anchor in Opera 9.5 for Mac" height="25" src="/yuiblog/blog-archive/assets/klootsopera/anchor.png" width="51"></td><td>Focused anchor in Opera 9.5 (Mac)</td></tr><tr><td><img alt="Screen capture of a focused anchor styled as a button in Opera 9.5 for Mac" height="34" src="/yuiblog/blog-archive/assets/klootsopera/link-button.png" width="69"></td><td>Focused anchor styled as a button in Opera 9.5 (Mac)</td></tr></tbody></table>

This example illustrates how the focused state of an anchor element is rendered consistently in Opera regardless of how it is styled. This consistency can be considered helpful to the user in that the familiarity of the focus outline conveys the element's role. Therefore, the user knows what to expect when the element is clicked regardless of how it is styled. However, as illustrated in the following example, this benefit breaks down a little as the focus model for buttons isn't the same as it is for anchor elements.

#### [Example 2: Buttons (The Bad)](/yuiblog/sandbox/yui/v252/examples/button/example10.html#example-2)

<table><tbody><tr><td><img alt="Screen capture of a focused button in Opera 9.5 for Mac" height="24" src="/yuiblog/blog-archive/assets/klootsopera/button-1.png" width="69"></td><td>Focused, unstyled button in Opera 9.5 (Mac)</td></tr><tr><td><img alt="Screen capture of a focused, styled button in Opera 9.5 for Mac" height="26" src="/yuiblog/blog-archive/assets/klootsopera/button-2.png" width="70"></td><td>Focused, styled button in Opera 9.5 (Mac)</td></tr></tbody></table>

This example illustrates a potential flaw in Opera's rendering of focus in version 9.5: unlike anchor elements, unstyled and styled buttons get two different renderings of focus, both of which are completely different, and different from the focus style applied to anchor elements. So, in Opera 9.5 there are three different focus implementations for the user to learn: the system default, the Wii-style focus and the dotted border. Compare Opera's focus implementation to that of Safari or Internet Explorer, where by default focus is rendered consistently across elements of various types.

| Opera | Safari | Description |
| --- | --- | --- |
| ![Screen capture of a focused anchor in Opera 9.5 for Mac](/yuiblog/blog-archive/assets/klootsopera/anchor.png) | ![Screen capture of a focused anchor in Safari for Mac](/yuiblog/blog-archive/assets/klootsopera/anchor-safari.png) | Focused, unstyled acnhor |
| ![Screen capture of a focused anchor styled as a button in Opera 9.5 for Mac](/yuiblog/blog-archive/assets/klootsopera/link-button.png) | ![Screen capture of a focused anchor styled as a button in Safari for Mac](/yuiblog/blog-archive/assets/klootsopera/anchor-button-safari.png) | Focused anchor styled as a button |
| ![Screen capture of a focused, unstyled button in Opera 9.5 for Mac](/yuiblog/blog-archive/assets/klootsopera/button-1.png) | ![Screen capture of a focused, unstyled button in Safari for Mac](/yuiblog/blog-archive/assets/klootsopera/button-safari.png) | Focused, unstyled button |
| ![Screen capture of a focused, styled button in Opera 9.5 for Mac](/yuiblog/blog-archive/assets/klootsopera/button-2.png) | ![Screen capture of a focused, styled button in Safari for Mac](/yuiblog/blog-archive/assets/klootsopera/yuibutton-safari.png) | Focused, styled button |

Since the default implementation of focus can be customized in other browsers, perhaps Opera users still fair better since learning Opera's three, fixed focus models is ultimately better than having to learn potentially infinitely more. That said, if Opera is going to prevent customization of focus in the interest of usability and accessibility, they could further improve the user experience by providing a consistent implementation of focus across elements. As it stands in Opera 9.5, the following mixed styles can appear together, presenting a confusing set of visual cues:

#### [Example 3: Mixed types together (The Ugly)](/yuiblog/sandbox/yui/v252/examples/button/example10.html#example-3)

<table><tbody><tr><td><img alt="Screen capture of a focused anchor styled as a button in Opera 9.5 for Mac" height="34" src="/yuiblog/blog-archive/assets/klootsopera/link-button.png" width="69"></td><td>Focused anchor styled as a button in Opera 9.5 (Mac)</td></tr><tr><td><img alt="Screen capture of a focused, styled button in Opera 9.5 for Mac" height="26" src="/yuiblog/blog-archive/assets/klootsopera/button-4.png" width="70"></td><td>Focused, styled button in Opera 9.5 (Mac)</td></tr></tbody></table>

As illustrated by the first and second examples, Opera has three different, yet fixed implementations of focus. While Opera's implementation of focus can be considered good insofar as the user only has a limited number of focus models to learn, it might also be considered bad in that it makes it harder to provide a consistent user experience within a single site or web application. For example, if you wanted to place an anchor and button next to each other in a toolbar, but style them consistently so that they both look like buttons, each would still render focus differently in Opera, leaving the user to wonder how the difference is significant.

### Conclusion

In Opera designers and developers lose a degree of customization, but the user gains a slightly more consistent browsing experience. In some ways this consistency benefits the user in that fundamental interactions like focus and context menus remain the same regardless of the site or web application in use. However, by limiting certain types of customization designers and developers will find it just a bit harder to provide a consistent user experience within their site or application and to train the user to expect more from Web 2.0.