---
layout: layouts/post.njk
title: "Migrating from YUI 2 to YUI 3:  A Case Study"
author: "YUI Team"
date: 2012-04-02
slug: "migrating-from-yui-2-to-yui-3-a-case-study-2"
permalink: /2012/04/02/migrating-from-yui-2-to-yui-3-a-case-study-2/
categories:
  - "Development"
---
When I sat down to build the YUI 3 version of [Page Layout](http://yuilibrary.com/gallery/show/layout), I knew it would be a big job. Even though the YUI 2 version was on its third incarnation, the code was still a mess. The original design, dramatically simplified from the performance disaster of the second incarnation, called for only row-based layouts, but then somebody needed a column-based layout, and they needed it fast, so instead of refactoring the code cleanly, I duplicated it and rewrote only the layout engine. In addition, I knew that the only way to get people to migrate from the YUI 2 version to the YUI 3 version would be to maintain exactly the same API in the YUI 3 version, so nobody would have to rewrite their code. To make matters worse, the YUI 2 version was a global object that automatically instantiated itself when the script loaded, so application code could configure it and subscribe to events before domready. The worst implication of this was that the initial object assumed a row-based layout, and then, on domready, if a column-based layout was detected, the object silently replaced itself, copying the settings from the old object! (The row and column versions shared the same event objects, so the subscribers were not affected.)

With all this to consider, the first thing I did was to ignore it all because I wanted to get the YUI 3 version right. I was satisfied with the basic API, but the two copies and the silent switching on domready had to go. Inspired by the YUI 3 Plugin architecture, I decided that the ideal solution would be to have a single class which detected the layout type and used the corresponding layout engine. The YUI Loader would even allow me to load the layout engine on demand! It took a couple of weeks to shred the two YUI 2 classes and merge them into a single class with plugins, but the result was clean and (as long as you don't look too closely at the code in the layout engine plugins) simple.

Now came the hard part: how to make this a drop-in replacement for the YUI 2 version. The applications that use it still have lots of YUI 2 code, and this cannot reference `Y`, so `YAHOO.APEX.PageLayout` had to be defined, it had to be created when the script loaded, and it had to expose all the required functions and event signatures. To muddle things further, YUI 3 event signatures are fundamentally different from YUI 2 event signatures.

There was also another serious complication: YUI 3 doesn't really like global objects. Everything is normally confined to the `Y` sandbox created by `YUI().use()`.

The first step was to break the sandbox by storing the instance of `Y.PageLayout` in `YUI.SATG.prototype.layout_mgr`. (By instantiating `YUI.SATG`, each sandbox starts with the same initial values and can then safely modify `Y.SATG` without affecting other sandboxes. Of course, overwriting `Y.SATG.layout_mgr` would be a bad idea, but there is other stuff in this object, too.)

Breaking the sandbox is not something to be done lightly, however. The most dramatic problem is that `instanceof` does not work on objects passed between sandboxes. This is disasterous for `Y.PageLayout.elementResized()`, since the argument, an instance of `Y.Node`, is likely to come from a sandbox other than the one where `Y.PageLayout` was instantiated. Thankfully, YUI 3.5.0 switched from `instanceof Y.Node` to testing for the `_node` member!

The next step was to define `YAHOO.APEX.PageLayout` (but only if `YAHOO` already existed, of course). This object turned out to be very thin, since it only had to act as a relay. It stores references to functions in `Y.PageLayout`, including a couple of renames, and instances of `YAHOO.util.CustomEvent`.

The final step was to subscribe to the events from `Y.PageLayout`, repackage the data, and fire the corresponding events in `YAHOO.APEX.PageLayout`. As an example:

```
page_layout.on('beforeResizeModule', function(e)
{
	YAHOO.APEX.PageLayout.onBeforeResizeModule.fire(e.bd, e.height, e.width);
});

```

I hope this overview of the challenges I faced will inspire you, or at least make the task seem less daunting, when you to migrate to YUI 3.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) is one of the lead engineers constructing the foundation on which [Yahoo! APT](http://apt.yahoo.com/) is built. Previously, he worked on the Yahoo! Publisher Network._