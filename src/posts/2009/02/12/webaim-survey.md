---
layout: layouts/post.njk
title: "WebAIM Survey Shines Light on Screen Reader Usage"
author: "Victor Tsaran"
date: 2009-02-12
slug: "webaim-survey"
permalink: /2009/02/12/webaim-survey/
categories:
  - "Development"
---
### "What you hear is what you see"

For many developers, the screen reader is still a misunderstood assistive technology. Using a screen reader can be compared to looking at a web page through a straw because you need to explore (hear) many items in chunks and then piece them in your memory or imagination. The user knows that an item is present on the screen only after they've heard their screen reader announce it. A different approach needs to be applied in order to successfully code for this type of technology. We shouldn't stop at using visual cues to attract user attention, but visual attributes alone cannot be relied on when communicating important information to the user. The recent [WebAIM screen reader survey](http://webaim.org/projects/screenreadersurvey/ "WebAIM screen reader survey") of 1121 screen reader users is a great step towards understanding how blind, deaf-blind, or visually impaired users \*actually\* interact with the web.

### Use Headings (<Hn> tags)

The survey results are pretty clear on this one: [90% of respondents](http://webaim.org/projects/screenreadersurvey/#headings "WebAIM survey results for headings usage") use headings to navigate web pages "sometimes", "often", or "whenever they're available". WebAIM says, "It is clear that providing a heading structure is important to screen reader users...." Most screen readers provide one or more mechanisms for a user to jump between HTML headings on the page, either through a set of shortcut keys or through a custom list of headings. Because reading with a screen reader happens in a linear fashion, headings provide a way to jump between sections of a web page in a quick and efficient way. This not only enables the user to skip over repetitive navigation menus and unwanted content, but also helps them to learn about the structure and the order of the content on the page. Proper usage of HTML headings is semantic, easy, and most of all indispensible to screen reader users.

### Access Keys

The access key is an HTML attribute that enables any focusable element on the page to become reachable via a shortcut key. Of survey respondents, [88% use access keys](http://webaim.org/projects/screenreadersurvey/#accesskeys "WebAIM survey results for access keys usage") "sometimes", "often", or "whenever they're available". I've always assumed that access keys are of more use to advanced users, but the survey results actually suggest that beginners will tend to use access keys more often than their advanced counterparts.

Here are a couple of points to keep in mind when implementing access keys:

-   Shortcut keys are not implemented across all browsers consistently: Internet Explorer uses the ALT key as a modifier, Firefox uses ALT+SHIFT, and Safari uses CONTROL.
-   Access keys may potentially conflict with the particular browser's built-in shortcut keys: "F" for "File" menu, "E" for "Edit" menu, etc.
-   Access keys have to be appropriate to the user's locale in order to make them intuitive. For example, the first letter for the English word "Search" would be different than for the same word in French. And what about languages that use the Cyrilic alphabet?
-   Using numbers instead of letters for access keys makes them less intuitive because number-based shortcut keys are harder to associate with particular words.

This is not to suggest that access keys should not be used at all, rather that they should be used sparingly and thoughtfully. Screen reader applications provide a lot of ways for users to reach various HTML elements on the page, so these types of users may not end up using your access keys if they are too difficult to remember. If you do implement access keys, please take care to account for the different languages of your audience as well as check for possible conflicts with browser built-in keystrokes.

### "Skip" links

[66% of survey respondents](http://webaim.org/projects/screenreadersurvey/#skipnav "WebAIM survey results for skip links usage") say they use "skip to content" or "skip navigation" links "sometimes", "often", or "whenever they're available". These are internal anchor links that point to different content areas. Many screen reader applications provide a native "skip to text" feature which attempts to skip navigational links and place focus on the first text string on the page. You can not always rely on this feature because the first text on the page is not necessarily relevant content. Therefore, HTML-based "skip" links, that are embedded directly in the page, provide an extremely valuable convenience that links to the place where actual main content or content of interest begins. When deciding to implement "skip" links, keep the following points in mind:

-   Implement "skip" links because they are quite useful for keyboard users to save excessive tabbing through repetitive menus by providing a way to quickly jump to another part of the page, e.g., the beginning of the main content.
-   Do not be ashamed of "skip" links and do not hide them off-screen. They are useful for people with motor disabilities or repetitive strain injuries, and for keyboard users in general, enabling anyone to quickly skip to the main content using their keyboard.
-   Name "skip" links to clearly indicate where you are sending users when the link is activated. Good examples are "Skip to main content" or "Skip to navigation menus".
-   Please remember to localize "skip" links as well; they are now a part of your content.
-   Last but not least, ensure that the "skip" links actually work. (Yes, I have seen a lot of sites where they don't.) Tab to the "skip" link and activate it, making sure that the focus moves to the intended place on the page.

### Know Your Audience

One of the conclusions of the recently conducted [WebAIM screen reader survey](http://webaim.org/projects/screenreadersurvey/) is the fact that there is no one way that screen reader users interact with the web. Too often, developers, product managers, and designers tend to assume the preferences, likes, and dislikes of screen reader users without ever asking them directly for their input.

Screen reader applications are used by blind, deaf-blind, or visually impaired users, as well as developers who test the accessibility of their web sites, teachers who instruct their students with visual impairments, and individuals who want to simply listen to the content on the screen. They are novice and advanced users of the software, who have made many configurations or left the default preferences alone. What they have in common is that they will use known techniques to navigate web pages such as:

-   using headings to move between different parts of the page
-   reading the whole content of the page before interacting with it
-   navigating between focusable elements (links, form fields, etc.) on the page with a TAB and SHIFT+TAB key
-   using the "find" feature of the browser or a screen reader to search for particular keywords on the page

It is vitally important to know your audience and how they interact with the web in order to write more usable code. Adopting these best practices will go a long way towards making your web pages more accessible for everyone.