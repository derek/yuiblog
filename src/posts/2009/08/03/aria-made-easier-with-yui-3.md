---
layout: layouts/post.njk
title: "ARIA Made Easier With YUI 3"
author: "Todd Kloots"
date: 2009-08-03
slug: "aria-made-easier-with-yui-3"
permalink: /2009/08/03/aria-made-easier-with-yui-3/
categories:
  - "Development"
---
As mentioned in my talk [Developing an Accessible Web 2.0 Widget Framework](http://video.yahoo.com/watch/5100659/13530238 "Todd Kloots: "), one of the goals of [YUI 3](http://developer.yahoo.com/yui/3/) is to make it easier for developers to build accessible user interfaces. To that end we've taken accessibility into consideration from the very start while building YUI 3, and the recent [YUI 3.0.0 beta 1 release](http://yuilibrary.com/downloads/#yui3) introduces several new additions that make it easier for developers to build [ARIA](http://www.w3.org/TR/wai-aria/)\-enabled widgets.

### ARIA Attribute Support Added to Node

The [Node Utility](http://developer.yahoo.com/yui/3/node/ "The Node Utility") is YUI 3's primary interface for interacting with the DOM, and it provides not only an abstraction model but built-in support for CSS Selector queries as a means of accessing HTML elements. Support for ARIA attributes has been added to the Node interface in the YUI 3.0.0 beta 1 release, allowing developers to use the expressive power of CSS Selector queries to apply and manage an element's ARIA [roles](http://www.w3.org/TR/wai-aria/#roles) and [states and properties](http://www.w3.org/TR/wai-aria/#state_prop_def).

Apply any of the ARIA attributes via Node's `set` method. For example, to apply the `role` of [`toolbar`](http://www.w3.org/TR/wai-aria/#toolbar) to a `<div>` with an id of "toolbar":

```

YUI().use('node', function(Y) {
    var node = Y.get('#toolbar').set('role', 'toolbar');
});


```

In addition to Node's built-in support for CSS selector queries, it also supports chaining and the ability to set multiple attributes on a single Node. When used together, these features of Node make it especially easy to apply the ARIA roles, states, and properties when building DHTML widgets with a large subtree.

For example, when building a menubar widget it is necessary to apply a `role` of [`menubar`](http://www.w3.org/TR/wai-aria/#menubar) to the root DOM element containing the menubar, and the `role` of [`menu`](http://www.w3.org/TR/wai-aria/#menu) to the root DOM element containing each submenu. Additionally, as each submenu is hidden by default, the [`aria-hidden`](http://www.w3.org/TR/wai-aria/#aria-hidden) state will need to be applied to each submenu as well. The Node interface makes it possible to do all of this in one line of code:

```

YUI().use('node', function(Y) {
    Y.get('#rootmenu').set('role', 'menubar').queryAll('.menu').setAttrs({ role: 'menu', 'aria-hidden': true });
});


```

### Keyboard Support with the New Focus Manager Node Plugin

To work, ARIA requires developers provide keyboard access for widgets, since users of screen readers rely on the keyboard to navigate web sites and applications. As outlined in the [ARIA specification](http://www.w3.org/TR/wai-aria/ "Accessible Rich Internet Applications (WAI-ARIA) Version 1.0") and corresponding [Best Practices](http://www.w3.org/TR/wai-aria-practices/) document, providing keyboard access requires, in part, that each widget has one tab stop by default and is responsible for discretely managing focus for its descendants. Following these guidelines enables users to quickly navigate a page or application by using the tab key to move between widgets. Once a user has tabbed into a widget, they can then use other keys (the arrow keys for example) to move focus amongst the widget’s descendants.

The [Focus Manager Node Plugin](http://developer.yahoo.com/yui/3/node-focusmanager/ "The Focus Manager Node Plugin"), which is available as of the YUI 3.0.0 beta 1 release, makes it easy to define a Node's focusable descendants, define which descendant should be in the default tab flow, and define the keys that move focus among each descendant. Additionally, since the CSS pseudo class [`:focus`](http://www.w3.org/TR/CSS21/selector.html#x38) is not supported on all elements in all [A-Grade browsers](http://developer.yahoo.com/yui/articles/gbs/), the Focus Manager Node Plugin provides an easy, cross-browser means of styling focus.

### New ARIA Examples

For YUI 3.0.0 beta 1 we've also added a handful of examples that demonstrate the power of the Focus Manager Node Plugin to implement keyboard support to existing widgets and exercise Node's new ARIA-related APIs.

-   [ARIA-Enabled Toolbar](http://developer.yahoo.com/yui/3/examples/node-focusmanager/node-focusmanager-1.html "YUI Library Examples: Focus Manager Node Plugin: Accessible Toolbar")
-   [ARIA-Enabled TabView](http://developer.yahoo.com/yui/3/examples/node-focusmanager/node-focusmanager-2.html "YUI Library Examples: Focus Manager Node Plugin: Accessible TabView")
-   [ARIA-Enabled Menu Button](http://developer.yahoo.com/yui/3/examples/node-focusmanager/node-focusmanager-3.html "YUI Library Examples: Focus Manager Node Plugin: Accessible Menu Button")

Developers wishing to experience the benefits that ARIA provides can download the open-source [NVDA Screen Reader](http://www.nvda-project.org/) and [Firefox](http://getfirefox.com) to test each example themselves. Alternatively, I've made screencasts of each example running with NVDA and Firefox.

#### YUI 3 Beta 1 ARIA Toolbar Video

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=14686161&amp;vid=5595217&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//l.yimg.com/a/p/i/bcst/videosearch/10189/89984503.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=14686161&amp;vid=5595217&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//l.yimg.com/a/p/i/bcst/videosearch/10189/89984503.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40" type="application/x-shockwave-flash" width="512"></object>

  
[YUI 3 Beta 1 ARIA Toolbar](http://video.yahoo.com/watch/5595217/14686161) @ [Yahoo! Video](http://video.yahoo.com)

#### YUI 3 Beta 1 Menu Button Video

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=14686277&amp;vid=5595263&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//l.yimg.com/a/p/i/bcst/videosearch/10189/89984976.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=14686277&amp;vid=5595263&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//l.yimg.com/a/p/i/bcst/videosearch/10189/89984976.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40" type="application/x-shockwave-flash" width="512"></object>

  
[YUI 3 Beta 1 ARIA Menu Button](http://video.yahoo.com/watch/5595263/14686277) @ [Yahoo! Video](http://video.yahoo.com)

#### YUI 3 Beta 1 ARIA Tabview Video

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=14686262&amp;vid=5595254&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//l.yimg.com/a/p/i/bcst/videosearch/10189/89984890.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=14686262&amp;vid=5595254&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//l.yimg.com/a/p/i/bcst/videosearch/10189/89984890.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.40" type="application/x-shockwave-flash" width="512"></object>

  
[YUI 3 Beta 1 ARIA Tabview](http://video.yahoo.com/watch/5595254/14686262) @ [Yahoo! Video](http://video.yahoo.com)

### The Road Ahead

While YUI 3 is presently composed mostly of utilities, we are hard at work polishing our widget infrastructure and will soon begin building out widgets. With YUI 3 our goal is to make it as easy as possible to build accessible user interfaces, whether you are building a widget from scratch, or implementing one of ours. We think we're off to a good start with ARIA support incorporated into the Node interface and the Focus Manager Node Plugin. So, I want to encourage developers to start using these interfaces, and to let us know what's missing, what's not working, and what it is.

### Additional Resources

-   [Developing Accessible Widgets Using ARIA](http://video.yahoo.com/watch/4073211/10996186 "Todd Kloots: ")
-   [Improving Accessibility Through Focus Management](/yuiblog/2009/02/23/managing-focus/ "Improving Accessibility Through Focus Management » Yahoo! User Interface Blog")
-   [Configuring Your Machine For Testing With A Screen Reader](/yuiblog/2008/12/30/configuring-screen-readers/ "Configuring Your Machine For Testing With A Screen Reader » Yahoo! User Interface Blog")