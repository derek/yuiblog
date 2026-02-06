---
layout: layouts/post.njk
title: "ARIA Plugins for YUI Widgets"
author: "Todd Kloots"
date: 2008-10-02
slug: "yui-aria"
permalink: /blog/2008/10/02/yui-aria/
categories:
  - "Development"
---
For YUI 2.6, a handful of widgets have examples illustrating how to use new YUI ARIA plugins. These plugins make it easy to use the [WAI-ARIA Roles and States](http://www.w3.org/TR/wai-aria/) to make each widget more interoperable with assistive technologies (AT), such as screen readers, and in turn, more accessible to users with disabilities. For example, the following video illustrates how the YUI ARIA Plugin for Carousel improves the user experience of the new Carousel widget for users of screen readers:

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.30"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=9957126&amp;vid=3609568&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/5335/72446715.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=9957126&amp;vid=3609568&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/5335/72446715.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.30" type="application/x-shockwave-flash" width="512"></object>

  
[Using the Carousel ARIA Plugin](http://video.yahoo.com/watch/3609568/9957126) @ [Yahoo! Video](http://video.yahoo.com)

### Using the ARIA Plugins

Using the YUI ARIA Plugins is easy. Simply include the source file(s) for the ARIA plugin after the widget source file(s) as indicated on the widget's landing page. That's it. Currently, the source files for each plugin are available in the [YUI 2.6 package on SourceForge](http://developer.yahoo.com/yui/download/), and can also be [downloaded from the YUI blog sandbox](/yuiblog/sandbox/yui/v260/aria-plugins.zip). In a future release of YUI, the plugins will be served from our CDN.

### Browser Support

All YUI ARIA Plugins require the user's browser and AT support the WAI-ARIA Roles and States. Currently only [Firefox 3](http://www.mozilla.com/en-US/firefox/) and [Internet Explorer 8](http://www.microsoft.com/windows/products/winfamily/ie/ie8/getitnow.mspx) have support for ARIA _and_ are supported by several screen readers for Windows that also offer ARIA support. Opera also has support for ARIA as of version 9.5, but unfortunately isn't supported by any screen readers. For this reason the YUI ARIA Plugins are only enabled by default for Firefox 3 and IE 8. To enable the ARIA plugin for other browsers, simply the set the `usearia` configuration property to `true`. For example:

```
var oMenu = new YAHOO.widget.Menu("menu-1", { usearia: true });

```

### Why Plugins?

Rather than integrate ARIA directly into a widget, we chose to deliver this functionality as a plugin for two main reasons:

-   _Performance:_ We've got many extremely byte-conscious users. And while we certainly don't want users opting out of a more accessible interface, we need to be respectful of those developers that need to make tough choices on KB weight.
-   _The right fit:_ For most widgets (like Menu) there is an ARIA role that is a perfect match. For some, like Carousel, or AccordionView, there either isn't a clear match, or there are several different roles that could work depending on the circumstances. For widgets that fall into this category we can offer several different ARIA plugins that meet the desired use case.

### Widgets with ARIA Plugin Support

The following table illustrates which YUI widgets currently have an ARIA plugin, along with their corresponding WAI-ARIA Roles.

| Widget | ARIA Role(s) |
| --- | --- |
| [Button](http://developer.yahoo.com/yui/examples/button/button-ariaplugin.html) | [checkbox](http://www.w3.org/TR/wai-aria/#checkbox), [radio](http://www.w3.org/TR/wai-aria/#radio), [radiogroup](http://www.w3.org/TR/wai-aria/#radiogroup) |
| [Carousel](http://developer.yahoo.com/yui/examples/carousel/carousel-ariaplugin.html) | [toolbar](http://www.w3.org/TR/wai-aria/#toolbar), [button](http://www.w3.org/TR/wai-aria/#button), [listbox](http://www.w3.org/TR/wai-aria/#listbox), [option](http://www.w3.org/TR/wai-aria/#option) |
| [Container](http://developer.yahoo.com/yui/examples/container/container-ariaplugin.html) | [dialog](http://www.w3.org/TR/wai-aria/#dialog), [alertdialog](http://www.w3.org/TR/wai-aria/#alertdialog), [tooltip](http://www.w3.org/TR/wai-aria/#tooltip) |
| [Menu](http://developer.yahoo.com/yui/examples/menu/menuwaiaria.html) | [menu](http://www.w3.org/TR/wai-aria/#menu), [menubar](http://www.w3.org/TR/wai-aria/#menubar), [menuitem](http://www.w3.org/TR/wai-aria/#menuitem) |
| [TabView](http://developer.yahoo.com/yui/examples/tabview/tabview-ariaplugin.html) | [tablist](http://www.w3.org/TR/wai-aria/#tablist), [tab](http://www.w3.org/TR/wai-aria/#tab), [tabpanel](http://www.w3.org/TR/wai-aria/#tabpanel) |

### Screen Reader Testing

We'd love the community to help us test these plugins, find bugs and suggest enhancements. As mentioned above, each plugin requires AT that supports ARIA. Two of the leading screen readers for Windows, [JAWS](http://www.freedomscientific.com/fs_products/software_jaws.asp) and [Window-Eyes](http://www.gwmicro.com/Window-Eyes/), support ARIA. Free, trial versions of both are available for download, but require Windows be restarted every 40 minutes. For that reason, the open-source [NVDA Screen Reader](http://www.nvda-project.org/) is the best option for developers looking to test the YUI ARIA Plugins as it is both free and provides excellent support for ARIA.