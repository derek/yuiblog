---
layout: layouts/post.njk
title: "Using WAI-ARIA Roles and States with the YUI Menu Control"
author: "Todd Kloots"
date: 2007-12-21
slug: "menu-waiaria"
permalink: /2007/12/21/menu-waiaria/
categories:
  - "Development"
---
<table border="0" cellspacing="10" width="51	0"><tbody><tr><td><img alt="Victor Tsaran (left) and Todd Kloots of Yahoo!" height="300" src="/yuiblog/blog-archive/assets/kloots_tsaran.jpg" width="430"></td><td style="font-size:10px;" valign="bottom"><a href="http://www.flickr.com/photo_zoom.gne?id=414400167&amp;size=o">Image of Victor Tsaran by Stephen Woods</a>; <a href="http://www.flickr.com/photo_zoom.gne?id=413976052&amp;size=l">image of Todd Kloots by Sandy Leung</a>. Used by kind permission.</td></tr></tbody></table>

**About the Authors:** _A [new YUI example](http://developer.yahoo.com/yui/examples/menu/menuwaiaria.html) demonstrates how to use the WAI-ARIA Roles and States with YUI's [Menu Control](http://developer.yahoo.com/yui/menu). In this article, YUI Menu author **Todd Kloots** and Yahoo! accessibility guru **Victor Tsaran** introduce the WAI-ARIA Roles and States, explain how they dovetail with Menu, and provide a detailed account of the user experience with two different screen readers._

### What are WAI-ARIA Roles and States?

Developed by IBM, and adopted by the W3C, the WAI-ARIA (Web Accessibility Initiative - Accessible Rich Internet Applications) Roles and States provide a means of making DHTML widgets and content accessible to assistive technologies such as screen readers. Much as CSS can be used to completely change the visual presentation of an HTML element, the WAI-ARIA Roles and States can be used to transform how HTML elements are presented to users of assistive technologies.

### How it works

Implemented as a set of HTML attributes, the WAI-ARIA Roles and States bridge the gap between DHTML and assistive technology. For example: while CSS provides a means of painting a `<ul>` element as a menu, and JavaScript allows for the implementation of the expected menu-like behaviors for that `<ul>` element, a screen reader only communicates to the user that the menu is a `<ul>` element. Therefore, there is a gap between the developer's intention for the role an HTML element is to play as a DHTML widget and how that widget is presented to a user of assistive technology. The WAI-ARIA Roles and States close this gap, allowing the developer to accurately communicate the role an HTML element is to play in the scope of a DHTML widget. When an element has WAI-ARIA Roles and States applied, a screen reader will announce its role and current state when it is focused. This allows `<ul>` elements to be presented as menus, `<div>` elements to be presented as modal dialogs, etc.

### The value of a DHTML Library

The application of the WAI-ARIA Roles and States alone does not make a widget accessible. It it is still up to the developer to implement the mouse and keyboard functionality that the user expects for the role applied to a given widget. For this reason, a DHTML widget library can be helpful in that the nitty gritty of implementing the correct keyboard and mouse behaviors is done for you. Such is the case with the YUI Menu library. The YUI Menu implements all of the expected menu-like keyboard and mouse behaviors, so all the developer needs to do is apply the WAI-ARIA Roles and States.

### Applying Roles and States to a YUI Menu

The WAI-ARIA Roles and States can be applied to a YUI Menu instance regardless of wether it is built using existing markup on the page, or entirely through JavaScript. However, since the WAI-ARIA Roles and States depend on Menu's JavaScript-based keyboard functionality, it follows that the attributes representing the WAI-ARIA Roles and States only be applied via JavaScript. This [progressive enhancement](http://en.wikipedia.org/wiki/Progressive_enhancement) strategy ensures the best possible user experience by only applying WAI-ARIA Roles and States when the browser technologies required to support them (in this case, CSS and JavaScript) are available.

When applying the attributes representing the WAI-ARIA Roles and States to a Menu widget, it is best to do so via a "render" event listener. Waiting for a Menu's "render" event to fire ensures that all of its DOM elements have been appended to the document and are available to be scripted. Roles and states are added to a Menu's DOM elements via the [setAttribute](http://www.w3.org/TR/2000/WD-DOM-Level-1-20000929/level-one-core.html#ID-F68F082) method and removed via the [removeAttribue](http://www.w3.org/TR/2000/WD-DOM-Level-1-20000929/level-one-core.html#ID-6D6AC0F9) method. The following excerpt from the [the Menu example](http://developer.yahoo.com/yui/examples/menu/menuwaiaria.html) demonstrates this technique.

```
/*
  Add the WAI-ARIA Roles and States to the MenuBar's DOM elements once it 
  is rendered.
*/

oMenuBar.subscribe("render", function () {

  /*
     Apply the "role" attribute of "menu" or "menubar" depending on the type of 
     the Menu control being rendered.
  */

  this.element.setAttribute("role", 
          (this instanceof YAHOO.widget.MenuBar ? "menubar" : "menu"));


  /*
     Apply the appropriate "role" and "aria-[state]" attributes to the label of
     each MenuItem instance.
  */

  var aMenuItems = this.getItems(),
    i = aMenuItems.length - 1,
    oMenuItem,
    oMenuItemLabel;
  

  do {

    oMenuItem = aMenuItems[i];


    /*
      Retrieve a reference to the anchor element that serves as the label for 
      each MenuItem.
    */

    oMenuItemLabel = oMenuItem.element.firstChild;


    // Set the "role" attribute of the label to "menuitem"

    oMenuItemLabel.setAttribute("role", "menuitem");


    // Remove the label from the browser's default tab order

    oMenuItemLabel.setAttribute("tabindex", -1);


    /*
      Optional: JAWS announces the value of each anchor element's "href"
      attribute when it recieves focus.  If the MenuItem instance's "url" 
      attribute is set to the default, remove the attribute so that JAWS 
      does announce its value.
    */

    if (oMenuItem.cfg.getProperty("url") == "#") {

      oMenuItemLabel.removeAttribute("href");
    
    }


    /*
      If the MenuItem has a submenu, set the "aria-haspopup" attribute to 
      true so that the screen reader can announce 
    */

    if (oMenuItem.cfg.getProperty("submenu")) {
    
      oMenuItemLabel.setAttribute("aria-haspopup", true);
    
    }

  }
  while (i--);
  

  /*
     Set the "tabindex" of the first MenuItem's label to 0 so the user can 
     easily tab into and out of the control.
  */

  if (this.getRoot() == this) {
  
    this.getItem(0).element.firstChild.setAttribute("tabindex", 0);
  
  }

});

```

The tables below lists the complete set of the menu-specific WAI-ARIA Roles and States and how they map to YUI Menu DOM elements.

#### [Related ARIA Roles](http://www.w3.org/TR/aria-role/#roles)

| WAI-ARIA Role | YUI Menu DOM Element |
| --- | --- |
| [menu](http://www.w3.org/TR/aria-role/#menu) | `<div class="yuimenu">` |
| [menubar](http://www.w3.org/TR/aria-role/#menubar) | `<div class="yuimenubar">` |
| [menuitem](http://www.w3.org/TR/aria-role/#menuitem) | `<a class="yuimenuitemlabel">` and `<a class="yuimenubaritemlabel">` |
| [menuitemcheckbox](http://www.w3.org/TR/aria-role/#menuitemcheckbox) | `<a class="yuimenuitemlabel">` |
| [menuitemradio](http://www.w3.org/TR/aria-role/#menuitemradio) | `<a class="yuimenuitemlabel">` |

#### [Related ARIA States](http://www.w3.org/TR/aria-state/#widgets)

| WAI-ARIA State | YUI Menu DOM Element |
| --- | --- |
| [haspopup](http://www.w3.org/TR/aria-state/#haspopup) | `<a class="yuimenuitemlabel">` and `<a class="yuimenubaritemlabel">` |
| [checked](http://www.w3.org/TR/aria-state/#checked) | `<a class="yuimenuitemlabel">` |
| [selected](http://www.w3.org/TR/aria-state/#selected) | `<a class="yuimenuitemlabel">` and `<a class="yuimenubaritemlabel">` |
| [disabled](http://www.w3.org/TR/aria-state/#disabled) | `<a class="yuimenuitemlabel">` and `<a class="yuimenubaritemlabel">` |

Once the WAI-ARIA Roles and States are applied, there are a few tweaks that can be made to the YUI Menu's DOM elements to further improve the user experience. For YUI Menu, the label of each MenuItem instance is represented in HTML as an anchor element (i.e. `<a class="yuimenuitemlabel">`), and in IE and Firefox, anchor elements are automatically part of the tab order. Having MenuItem labels in the tab order by default is important when JavaScript is disabled to ensure that the user can navigate a Menu via the keyboard with the tab key.

Since the YUI Menu code provides its own, desktop-like keyboard functionality when JavaScript is enabled, having every MenuItem label in the browser's default tab order can be a nuisance to users screen readers. When navigating the document with the tab key, users of screen readers have to tab through every single MenuItem label in a Menu, regardless of whether or not they want to use the Menu control. This problem can be solved by setting the "tabindex" attribute of every MenuItem label but the first to a value of -1. Setting an element's "tabindex" attribute to a value of -1 removes it from the browser's default tab order, while maintaining its focusability via JavaScript. Since the YUI Menu keyboard functionality is activated when any MenuItem label has focus, with just one MenuItem label in the browser's default tab order the Menu's keyboard functionality will be preserved, while at the same time giving the user the ability to quickly tab into and out of the control.

### Supported Browsers and Screen Readers

In order to take advantage of the WAI-ARIA Roles and States a user must have both a web browser and screen reader that support them. Firefox 1.5 was the first browser to support the WAI-ARIA Roles and States, and its implementation has evolved considerably in version 3, making it much easier for developers to apply the attributes representing roles and states. Both Microsoft and Opera are planing to implement the WAI-ARIA Roles and States in future versions of their browsers. The two major screen readers, Freedom Scientific's JAWS and GW Micro's Window-Eyes both support the WAI-ARIA Roles and States, JAWS as of version 7.1 and Window-Eyes as of version 5.5. Regardless of the screen reader you choose, it is necessary to turn off the [virtual buffer](http://juicystudio.com/article/making-ajax-work-with-screen-readers.php#screenmodes) in order to take advantage of the WAI-ARIA Roles and States.

### Known Issues

The YUI Menu example that uses the WAI-ARIA Roles and States was tested using Firefox 3 beta along with JAWS 8 and 9, and Window-Eyes 6.1. The user experience with JAWS and Window-Eyes was almost identical, but there were a few small differences worth mentioning.

#### JAWS

Each MenuItem in a YUI Menu has a url property that can be used to specify a URL that it will automatically navigate to when clicked. Setting the "url" property, sets the "href" attribute of the anchor element that serves as the MenuItem's label. If no value is specified for a MenuItem's "url" property, the "href" attribute of the anchor element is set to "#" by default. When a role of "menuitem" is applied to a MenuItem's anchor element, JAWS still reads the value of the "href" attribute, which can be undesirable if the value of the "href" is set to "#." In such cases, it is best to just remove the "href" attribute.

One of the cool feature of JAWS is that when navigating a page's DOM using the virtual buffer mode, if an element is selected that has one of the WAI-ARIA Roles applied, JAWS will automatically switch off the virtual buffer to take advantage of the WAI-ARIA Roles and States.

#### Window-Eyes 6.1

When the first item in a MenuBar receives focus, Window-Eyes doesn't announce the role of "menubar," but rather just the text label of the item along with its state.

#### YUI Menu and the disabled WAI-ARIA State

There is currently a minor issue with Menu and ARIA where the [disabled](http://www.w3.org/TR/aria-state/#disabled) state cannot be used with MenuItems. This is because if a MenuItem is disabled, Menu currently skips over it when navigating with the keyboard (a behavior based on menus in OS X). This keyboard behavior will be updated in a future release of YUI Menu so that disabled MenuItem instances can be properly communicated to assistive technology.

### Resources

-   [The new YUI Menu example demonstrating the use of WAI-ARIA roles and states](http://developer.yahoo.com/yui/examples/menu/menuwaiaria.html)
-   [ARIA: Accessible Rich Internet Applications/Relationship to HTML FAQ](http://developer.mozilla.org/en/docs/ARIA:_Accessible_Rich_Internet_Applications/Relationship_to_HTML_FAQ)
-   [Roles for Accessible Rich Internet Applications (WAI-ARIA Roles) Version 1.0](http://www.w3.org/TR/aria-role/)
-   [States and Properties Module for Accessible Rich Internet Applications (WAI-ARIA States and Properties) Version 1.0](http://www.w3.org/TR/aria-state/)
-   [Embedding Accessibility Role and State Metadata in HTML Documents](http://www.w3.org/WAI/PF/adaptable/HTML4/)
-   [Accessible DHTML](http://www.mozilla.org/access/dhtml/)
-   [Key-navigable custom DHTML widgets](http://developer.mozilla.org/en/docs/Key-navigable_custom_DHTML_widgets)
-   [Firefox 3 Beta 2](http://www.mozilla.com/en-US/firefox/all-beta.html)
-   [Freedom Scientific JAWS Screen Reader](http://www.freedomscientific.com/fs_products/software_jaws.asp)
-   [GW Micro Window-Eyes Screen Reader](http://www.gwmicro.com/Window-Eyes/)
-   [An Introduction to Screen Readers](http://video.yahoo.com/video/play?vid=514676)
-   [Making Ajax Work with Screen Readers](http://juicystudio.com/article/making-ajax-work-with-screen-readers.php)