---
layout: layouts/post.njk
title: "Dynamic Loading and Rendering with YUI's Menu and TreeView Controls"
author: "YUI Team"
date: 2006-08-02
slug: "dynamic_loading"
permalink: /2006/08/02/dynamic_loading/
categories:
  - "Development"
---
The richness revolution on the web is about improving the user experience. A richer interface can feel faster and more responsive because it can bring users closer to their data and to powerful tools for enhancing, filtering, or sharing that data. We add richness to pages to make our applications faster, lighter, and more responsive to the user's needs.

At the same time, adding richness and interactivity to a web page invariably means adding code complexity. Instead of simply loading the data required to represent a document, we load data related to visual and informational transformations that might take place within the document based on user interactions. This infusion of information (and rules about behavior and presentation related to that information) adds weight to the page — weight on the wire, weight in terms of processing and parsing information and rules, and weight within the browser as it holds all of this richness in memory.

One place where we run up against practical limitations of richness in web applications is in UI controls like [TreeView](http://developer.yahoo.com/yui/treeview) and [Menu](http://developer.yahoo.com/yui/menu/) in which nodal information structures are given easily-navigated UI treatments. A library of 1,000 nodes might live very compactly in a 100x200 pixel space using a Tree or Menu — ten top-level nodes with ten children each yield 100 nodes just in the top two levels; a third level, again with ten children per node, gets us to 1,000.

This compression of data in visual space is one of the powers of richness, but it also highlights the potential for rich UI controls to grow exponentially in their resource consumption. Where a UL with ten links would typically require a trivial amount of memory and rendering power, a Menu with 10 top-level nodes and 1000 nodes in total might increase data load by a few orders of magnitude. And it might increase the complexity of the DOM by just as much, while creating an additional burden of an object model in JavaScript in which every node in the Menu is represented by one or more JavaScript objects.

Both the TreeView and Menu Controls in YUI support strategies for reducing the impact that this added complexity has on initial pageload times and in-page resource consumption. In this article, we'll review those strategies and look under the covers at how this can be accomplished in the Menu Control.

### Dynamic Loading in the YUI TreeView Control

The [YUI TreeView Control](http://developer.yahoo.com/yui/treeview/) helps you address the problem of navigating vast node collections by providing support for _dynamic loading_. Dynamic loading is a mechanism whereby the children of a node are only loaded when the user expands that node. This allows you, for example, to use YUI's [Connection Manager](http://developer.yahoo.com/yui/connection/) to make XHR calls as TreeView nodes are expanded, gradually filling out the data for the node library — but only doing so as the user demonstrates a need for that information.

Adam Moore, the author of the TreeView Control, has provided [a nice example of dynamic loading in the TreeView Control](http://developer.yahoo.com/yui/examples/treeview/dynamic.html). While this example doesn't use Connection Manager to fetch data (rather, it randomly creates data for the nodes), it does illustrate the dynamic loading implementation pattern. Adam walks through the pattern on the example page and breaks out the key elements of the technique.

Dynamic loading in TreeView can be configured for the entire TreeView instance or on a node-by-node basis, giving you flexibility in how you manage your initial pageweight and the corresponding complexity of your DOM structure.

### Progressive Rendering in the YUI Menu Control

[![The progressively-rendered menu example](/yuiblog/blog-archive/assets/menu.gif)](http://developer.yahoo.com/yui/examples/menu/example13.html)Todd Kloots, author of the [YUI Menu Control](http://developer.yahoo.com/yui/menu/), this week added a new example to Menu's documentation that illustrates a similar technique using Menu. His _[progressive rendering](http://developer.yahoo.com/yui/examples/menu/leftnavfrommarkup.html)_ [example](http://developer.yahoo.com/yui/examples/menu/leftnavfrommarkup.html) exemplifies the creation of a Menu based on an in-memory JavaScript data model. The result is a lightweight, fast-rendering Menu with 50+ child nodes built around a scalable technique. Let's peek under the covers of his implementation.

First, Todd puts his markup on the page for the top level of the menu in which his four top-level nodes or menu items (Communication, Shopping, Entertainment, and Information) are displayed. He does this using a standardized module format shared by a number of YUI components; this format is documented with the [Module component](http://developer.yahoo.com/yui/container/module/) on the YUI web site. The basic menu information structure is nodal; Menu can consume data for menu items from an unordered list in the markup.

```
<div id="productsandservices" class="yuimenu">
  <div class="bd">
    <ul class="first-of-type">
      <li class="yuimenuitem"><a href="http://communication.yahoo.com">Communication</a></li>
      <li class="yuimenuitem"><a href="http://shopping.yahoo.com">Shopping</a></li>
      <li class="yuimenuitem"><a href="http://entertainment.yahoo.com">Entertainment</a></li>
      <li class="yuimenuitem">Information</li>
    </ul>            
  </div>
</div>
```

With this markup in place, Todd instantiates the main menu:

```
var oProductsServicesMenu = new Menu("productsandservices");
```

The main menu is now in place; it's time to lay a foundation for progressive rendering of submenus. Each of the four top-level menu items will have its own submenu populated by data that's not yet in the DOM. Todd begins by creating an object containing all the data he'll use for his submenus; it's organized into buckets corresponding to the four top-level items. Here's the beginning of that code block, with the data being shaped into an object literal:

```
var oMenuData = {
"communications": [ 
  { text: "360", url: "http://360.yahoo.com" },
  { text: "Alerts", url: "http://alerts.yahoo.com" },
  { text: "Avatars", url: "http://avatars.yahoo.com" },
  ...
```

The next step is to create the four top-level submenus (instances of `YAHOO.widget.Menu`) and link them to the data provided in oMenuData above:

```
 var oCommunicationsMenu = new YAHOO.widget.Menu("communications"),
  oShoppingMenu = new YAHOO.widget.Menu("shopping"),
  oEntertainmentMenu = new YAHOO.widget.Menu("entertainment"),
  oInformationMenu = new YAHOO.widget.Menu("information");

oCommunicationsMenu.itemsData = oMenuData["communications"];
oShoppingMenu.itemsData = oMenuData["shopping"];
oEntertainmentMenu.itemsData = oMenuData["entertainment"];
oInformationMenu.itemsData = oMenuData["information"];
```

Now Todd has a top-level Menu and we have Menu instances for each of the four main submenus. At this point he applies his progressive rendering technique, a strategy that relies on Menu's intrinsic BeforeShowEvent ([inherited from Module](http://developer.yahoo.com/yui/docs/container/YAHOO.widget.Module.html#beforeShowEvent)). By writing a handler to execute just before a Menu is shown, we can defer its rendering (and all of its overhead in terms of DOM element creation) until the Menu is actually needed. Here is Todd's `onBeforeShowEvent` handler:

```
function onMenuBeforeShow(p_sType, p_sArgs, p_oMenu) {

  // Check if the menu has any items. If not, add them                
  if(this.getItemGroups().length == 0) {

    var aItemsData = this.itemsData,
      nItems = aItemsData.length,
      oItemData,
      oItemConfig,
      oSubmenu;

    for(var i=0; i<nItems; i++) {
      oItemData = aItemsData[i];
      if(oItemData) {
        oItemConfig = {};
        if(oItemData.url) {
          oItemConfig.url = oItemData.url;
        }
        if(oItemData.submenuItems) {
          oSubmenu = new YAHOO.widget.Menu(oItemData.submenuId);
          oSubmenu.itemsData = oItemData.submenuItems;
          oSubmenu.beforeShowEvent.subscribe(onMenuBeforeShow, oSubmenu, true);
          oItemConfig.submenu = oSubmenu;
        }

        // Add the new MenuItem instance to the Menu
        this.addItem(new YAHOO.widget.MenuItem(oItemData.text, oItemConfig));
      }
    }

    // Render the submenu into its parent MenuItem 
    // instance's element
    this.render(this.parent.element);                       
  }                
}

```

The approach here is a simple one: Build submenus only in response to user interaction. The submenus begin as empty vessels that know _about_ their intrinsic data (it's in their `itemsData` property); however, they don't render that data until they're activated by the user. When that happens, the `onBeforeShowEvent` (to which we'll attach this method as a handler) fires. It takes the following steps:

1.  Checks to see if this submenu has already been rendered (line 3); if it has, its `getItemGroups` method will return subitems, and nothing more needs to be done here.
2.  Loops through each menu item in this submenu (line 12-29), gathering its configuration properties and creating any submenus that might be associated with this menu item (line 19-24). Once all necessary information is in hand, the menu item is added to its parent Menu (line 27).
3.  Renders the menu, preparing it to be shown (line 33).

The finishing touches for Todd's implementation involve subscribing this function to the `onBeforeShowEvent` of each of the four main submenus, assigning those submenus to the Menu instance created from markup, and then rendering and showing the main menu:

```
// Assign a "beforeshow" handler to each submenu of the 
// items in the root menu. 
oCommunicationsMenu.beforeShowEvent.subscribe(onMenuBeforeShow, oCommunicationsMenu, true);
oShoppingMenu.beforeShowEvent.subscribe(onMenuBeforeShow, oShoppingMenu, true);
oEntertainmentMenu.beforeShowEvent.subscribe(onMenuBeforeShow, oEntertainmentMenu, true);
oInformationMenu.beforeShowEvent.subscribe(onMenuBeforeShow, oInformationMenu, true);

// Add the empty submenus to the items in the root menu instance 
oProductsServicesMenu.getItem(0).cfg.setProperty("submenu", oCommunicationsMenu);
oProductsServicesMenu.getItem(1).cfg.setProperty("submenu", oShoppingMenu);
oProductsServicesMenu.getItem(2).cfg.setProperty("submenu", oEntertainmentMenu);
oProductsServicesMenu.getItem(3).cfg.setProperty("submenu", oInformationMenu);

// Render and display the root menu
oProductsServicesMenu.render();
oProductsServicesMenu.show();
```

The result of this particular technique is a Menu with 50+ nodes, of which only a small fraction need to be rendered when the page loads. In this implementation, the data for the remaining nodes is in the page (and has weight on the wire during initial pageload as a result) but takes up only trivial resources until called upon. And, for a more complex Menu with a few more levels (and potentially 500, 5000 or more menu items), it's easy to see how [Connection Manager](http://developer.yahoo.com/yui/connection) could be built into your `onBeforeShowEvent`, with the ConnectionManager `success` callback being used to add menu items, `render` the menu, and `show` it.

### Conclusion: Richness on a Diet

The bottom line here is that we can get richer pages that overload small pieces of screen real estate with powerful interactive paths, and we can do this in ways that don't add massive weight and resource consumption to their contexts. Doing necessitates more thought up front. However, this kind of forethought is the price of entry for most high-volume web applications that want to include more and richer interactions within a single page. Using dynamic loading and progressive rendering in TreeViews and Menus can lead to light pageweights and fast rendering, giving you the best of both worlds: Rich interactive power along with lightness on the wire and in the page. Extending that technique throughout your site using Connection Manager can help you achieve real richness and solid performance even in highly interactive contexts.