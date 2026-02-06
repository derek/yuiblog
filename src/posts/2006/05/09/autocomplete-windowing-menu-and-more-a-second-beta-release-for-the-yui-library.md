---
layout: layouts/post.njk
title: "AutoComplete, Windowing, Menu and More: A Second Beta Release for the YUI Library"
author: "Nate Koechley"
date: 2006-05-09
slug: "autocomplete-windowing-menu-and-more-a-second-beta-release-for-the-yui-library"
permalink: /blog/2006/05/09/autocomplete-windowing-menu-and-more-a-second-beta-release-for-the-yui-library/
categories:
  - "Development"
---
I’m very happy to announce today a whole bunch of new stuff in both the Yahoo! Design Patterns Library and the Yahoo! User Interface Library. On the design side, there are more than a dozen new patterns (as well as oft-requested examples for some existing patterns like Tabs and AutoComplete). On the development side, we’ve updated all the existing components and broadened the platform’s reach with several important UI controls. With this release, we’re offering CSS packages for the first time. And, as part of the evolution of our open-source processes, we’ve migrated YUI Library distribution to SourceForge.

### Development

Let me call your attention to several things on the development side: We’re proud to offer three new JavaScript packages. The first is a suite of [DHTML windowing controls](http://developer.yahoo.com/yui/container/), each of which implements a distinct contextual-window interaction with just a few lines of JavaScript. These components — we call them the Container family of controls — build upon a standard unit for modular content (the [Module control](http://developer.yahoo.com/yui/container/module/)) and a common foundation in which a module floats over its page context (the [Overlay control](http://developer.yahoo.com/yui/container/overlay/)). Four Container-family UI controls build upon the Module/Overlay system: [Tooltip](http://developer.yahoo.com/yui/container/tooltip/), [Panel](http://developer.yahoo.com/yui/container/panel/), [Dialog](http://developer.yahoo.com/yui/container/dialog/), and [SimpleDialog](http://developer.yahoo.com/yui/container/simpledialog/).

A fifth control, [Menu](http://developer.yahoo.com/yui/menu/), shares the same Module/Overlay foundation and allows you to create mouse-and-keyboard-accessible, application-style fly-out menus in just a few lines of code. Extending [Progressive Enhancement](http://en.wikipedia.org/wiki/Progressive_Enhancement) into the world of UI controls, Menu can be dynamically generated or layered on top of simple, semantic unordered lists.

Our third new YUI Library component for this release is the highly-anticipated [AutoComplete](http://developer.yahoo.com/yui/autocomplete/) control which allows you to streamline a variety of user interactions involving text-entry. It’s robust, configurable, and easy to implement; I hope you’ll agree it was worth the wait.

In addition to these new additions to the Library, we’ve updated and improved all existing packages with numerous optimizations, bug fixes, increased functionality, and improved consistency. Each component includes reworked and expanded examples and more detailed documentation on our [Yahoo! Developer Network](http://developer.yahoo.com/yui/) website. In the distribution, you’ll find a README file with a detailed change log accompanying each component.

This time around, we’re going beyond new and updated JavaScript components and including what we think is some important, useful work around the intrinsic challenges of CSS. Three CSS packages are included in this initial release. [CSS Reset](http://developer.yahoo.com/yui/reset/) is a simple foundational file that normalizes browser-supplied CSS defaults. [CSS Fonts](http://developer.yahoo.com/yui/fonts/) provides cross-browser font families, and, importantly, recommends what we think is the optimal font-sizing strategy. CSS Fonts also works to normalize the width of an _em_ across browsers and platforms. The normalizing strategies applied in CSS Reset and CSS Fonts provide a stable foundation for my favorite CSS package, the [CSS Page Grids](http://developer.yahoo.com/yui/grids/). Its single file, weighing less than 2KB (minified), provides seven basic wireframes and numerous subsection grid components which together offer more than 100 page layouts — all of which scale up in size when the user applies browser-level font zooming.

### Design

On the Design side, our User Experience and Design team has published over a dozen new patterns codifying our language of [Invitations](http://developer.yahoo.com/ypatterns/parent.php?pattern=invitation) and [Transitions](http://developer.yahoo.com/ypatterns/parent.php?pattern=transition), and they’ve added a companion pattern for [Page Grids](http://developer.yahoo.com/ypatterns/pattern.php?pattern=grid). These topics are critical as richer interfaces proliferate. Discoverability of new functionality remains a challenge, and as content change continues to be divorced from page-load events we need new types of transitions to help sustain the user’s intuition about what’s happening on the screen. We hope you’ll find information in these new patterns that helps you boost the intuitiveness of your applications even as you increase their richness.

Many of you have asked since our debut in February for implementation code to support both Tabs and AutoComplete. With this release, code for both of these patterns is now available. Moreover, all of the new patterns link to code samples.

### Infrastructure

The YUI Library’s emergence as an open-source project important to the work of developers throughout the world during the past four months has been exciting and gratifying. Much work remains to be done with respect to managing community-contributed bug reports, feature requests, implementation samples, and code patches. However, we’re taking an important step in that process with this release, moving our code distribution and public bug reporting to [SourceForge](http://sourceforge.net/projects/yui). This move will give us better and more flexible control over distribution of the code — and it will improve our ability to release critical patches between releases in a timely, convenient manner. Formalizing our public bug reporting on SourceForge will make it easier for the YUI community to report, research and track issues related to library components.

Note that we will continue to rely on the [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/) group for community communications and we will not, as yet, be using SourceForge for community-contributed code submission.

We hope you find a lot to smile about in this major step in the YUI Library’s beta cycle. I know I speak on behalf of the entire team when I say that I can’t wait for you to get your hands on these new components. Go check it out. Don’t forget to stop back here, or over at [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/) or [YDN-patterns](http://developer.yahoo.com/ypatterns/), to let us know what you think.

Thanks,  
Nate Koechley  
Yahoo! Presentation Platform Engineering