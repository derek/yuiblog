---
layout: layouts/post.njk
title: "Implementation Focus: Gaia Online"
author: "YUI Team"
date: 2007-09-25
slug: "gaia"
permalink: /blog/2007/09/25/gaia/
categories:
  - "YUI Implementations"
---
From a frontend engineering perspective, what are the core challenges you face in your work on Gaia Online?

Gaia is very graphically oriented by comparison to the typical web site, with a focus on avatars and a virtual world experience. As a result, the site has a constant need for rich visualizations to convey that sense of "world". From the header down to the graphical heavy modules on the site (contest winners, featured content, upcoming events, etc), just about every piece of the page is given a graphical treatment. In many ways, our goals were directly opposed, both to build as many unique visuals into the site as possible while reusing as many elements as we could to reduce load times and ease the strain of content development. At Gaia Online, we were building a new look and feel for a site that has been around for several years. Due to the size of the site (and legacy code issues), the entire site could not be upgraded in one fell swoop. Instead, we needed to find a way to introduce UI components for the required functionality without disturbing the existing infrastructure on the site; all while letting us still plan for the interactivity and internal page refreshes slated to appear over the next several months.

![The visually rich Gaia interface.](/yuiblog/blog-archive/assets/gaia/gaia-pixel-grids.jpg)

What role is YUI CSS playing in your project?

[YUI Reset CSS](http://developer.yahoo.com/yui/reset/) and [Grids CSS](http://developer.yahoo.com/yui/grids/) were the keys to creating our layouts in such a way they looked consistent across all browsers. During our migration, we created an alternate version of the reset.css, prefixing the declarations with `#gaia_content`. This let us mark the body tag on pages that had been converted to use both the reset.css and Yahoo's grid system. Once we have migrated all of the, the `body#id` becomes obsolete and can be phased out of the document, leaving us with the pure YUI CSS.

Because of Gaia's heavy graphical nature, we also found ourselves working with pixel based constraints as opposed to the em flexibility provided by the traditional YUI grid layouts. Not wanting to lose the all the power the grid layouts gave us, we made minor adjustments to our own `core.css` (an override loaded in addition to the YUI Grids and Reset). In this file, we used one higher layer of specificity to change the relevant measurements from em to px. It worked perfectly out of the box:

```
 
/* adaptation of yui-t7 */
/*  */
#gaia_content{
    width:950px;
    padding:10px 9px;
    border-left:1px solid #000;
    border-right:1px solid #000;
    margin:0;
    background:#e4ded8 url(/images/gaia_global/body/shared/rs_bodygradient.gif) repeat-x top left;
}

#gaia_content.lrec_mainLanding .yui-b .yui-gb .yui-u{
    width:310px;
    margin:0 0 0 10px;
}
#gaia_content.lrec_mainLanding .yui-b .yui-gb .first{
    margin:0;
    width:200px;
}
#gaia_content.lrec_mainLanding .yui-b .yui-gb .second{
    width:420px; 
}
#gaia_content.lrec_mainLanding #yui-main{
    margin:0 0 10px 0;
    height:250px;
    overflow:hidden;
}
#gaia_content.lrec_mainLanding .middle{
    margin:0 0 10px 0;
    height:260px;
    overflow:hidden; 
}

```

(**Note:** In the above example, we created several variations of the yui-t7 layout by adding an additional class to `div#gaia_content`.)

Beyond the CSS, we found ourselves using Yahoo's markup for more than just the YUI components. To remain consistent, modules were given the typical hd/bd/ft classes which could then be overridden with ID specific CSS. For our "pure graphical" modules such as advertisements, this let us give more semantic meaning to the modules, defining themselves for browsers that were not using CSS. Without knowing how the scope of the project would change after its launch, using these core class names and consistent styles make it possible to easily implement Drag/Drop, Panel, and Menu in the future depending on how the design might evolve.

You're making use of YUI's JavaScript Core (YAHOO, Dom, Event), Utilities and UI Controls, too?

-   [YUI Menu Control](http://developer.yahoo.com/yui/menu/) both from HTML (primary navigation) and for the Shortcuts menu (from JS)
-   [Panel Control](http://developer.yahoo.com/yui/container/panel/) for the world map navigation and the Daily Chance rewards
-   [Connection Manager](http://developer.yahoo.com/yui/connection/) in the map navigation and Daily Chance
-   [Animation Utility](http://developer.yahoo.com/yui/animation/) in the map navigation
-   [Event Utility](http://developer.yahoo.com/yui/event/) attachment in the header (menu items, map launching, Daily Chance)
-   [TabView Control](http://developer.yahoo.com/yui/tabview/) for rotating "features" on the logged in home page
-   [Drag and Drop Utility](http://developer.yahoo.com/yui/dragdrop/) in the Gaia Profiles
-   [YUI's Logger Utility](http://developer.yahoo.com/yui/logger/) to avoid `alert()` everywhere

For a tour of Gaia's current use of YUI the YUI components listed above, check out video below ([also available as a QuickTime movie](/yuiblog/blog-archive/assets/gaia/yui-gaia.mov)):

<embed flashvars="id=4227266&amp;emailUrl=http%3A%2F%2Fvideo.yahoo.com%2Futil%2Fmail%3Fei%3DUTF-8%26vid%3D1186695&amp;imUrl=http%253A%252F%252Fvideo.yahoo.com%252Fvideo%252Fplay%253Fei%253DUTF-8%2526vid%253D1186695&amp;imTitle=Screen%2BCapture%253A%2BYUI%2BComponents%2BUsed%2Bon%2BGaia%2BOnline&amp;searchUrl=http://video.yahoo.com/search/video?p=&amp;profileUrl=http://video.yahoo.com/video/profile?yid=&amp;creatorValue=ZXJpY21pcmFnbGlh&amp;vid=1186695" height="415" src="http://us.i1.yimg.com/cosmos.bcst.yahoo.com/player/media/swf/FLVVideoSolo.swf" type="application/x-shockwave-flash" width="500">

What's the most innovative thing you've done with YUI in the current Gaia release?

In Gaia's current release, the map navigation was a milestone for the site. It set the direction towards interactivity, making use of the existing "browse the world map" concept we had, and reusing it in a much more engaging way. On the content level, the adaptation of the grids.css made it possible to enjoy Yahoo's strong support for standards while accommodating the pixel-perfect requirements of the visual design team.

What would you like to see YUI developers improve on in upcoming releases of YUI?

The YUI documentation is very good, although sometimes we found it lacking in practical examples and applications, specifically on many of the more obscure (but very useful) methods that aren't covered on the default YUI site. In our most recent development, we've used the `[YAHOO.util.Dom.generateId()](http://developer.yahoo.com/yui/docs/YAHOO.util.Dom.html#generateId)` method for many situations where we need a unique element, but do not actually need to know the ID outside of the module's context.

In the actual code, the [Menu Control](http://developer.yahoo.com/yui/menu/) has placed itself in a very interesting position. At present it's hard to have both a lightweight and robust menu at the same time. We'd love to see Menu (and some of the "heavier" components) to make use of the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) once it is out of beta to include only as much code as needed. The second thing we would love to see improved as YUI grows is a way to access the underlying nodes that are created with so many of YUI's build-from-markup utilities. Being able to access a Menu's nodes and subnodes when built from HTML would be a prime example.