---
layout: layouts/post.njk
title: "Implementation Focus: MiaCMS"
author: "Eric Miraglia"
date: 2008-06-09
slug: "implementation-focus-miacms"
permalink: /blog/2008/06/09/implementation-focus-miacms/
categories:
  - "YUI Implementations"
---
**How does MiaCMS differentiate itself from other CMS projects out there? Why would someone choose MiaCMS over Drupal or Joomla or other well-known apps in this space?**

Yes, there are quite a few content management systems to compete with. Luckily we aren't really new to the game. Our team contributed toward making Mambo the CMS it is today. We will continue building on that same award-winning base with MiaCMS. (As a side note, it's worth pointing out that Joomla was also initially based on Mambo about three years ago.)

Some of our current features are:

-   Simple Installation
-   WYSIWYG Content Editors
-   RSS Content Syndication
-   Powerful/Extensible 3rd Party Extension System
-   Flexible Site Theming Capabilities
-   Site Search
-   Sitemap Generation
-   REST Enabled Content & Statistics
-   User Management
-   Multilingual Core

MiaCMS will differentiate itself by making standard content management operations even easier and more flexible than they have been in the past. We will cleanup much of the old legacy code and enhance the extensions interface to simplify custom 3rd party extension development. With the 4.7 release the team will drop support for PHP4 to take advantage of the object-oriented capabilities of PHP5. The team plans to continue building close ties to the community and listening to their feedback. The next few releases will focus on building out many of the wishlist items we have already received from the community.

**At some point, you and the development team made the decision to build [YUI](http://developer.yahoo.com/yui/) into MiaCMS. What were the factors that guided your decision?**

![YUI Menu and TabView on MiaCMS.](/yuiblog/blog-archive/assets/mia1.png)

We based our decision on a number of important factors; maturity, browser support, documentation, support community, functionality, and flexibility. YUI has a large selection of time-tested components and continues to make valuable additions with each release. For us it is important that the selected framework continue maturing and growing right along side of us. We didn't want to add yet another library to the system and so it was important to be able to replace existing parts of the CMS with canned components and/or have the flexibility to hook into the framework and use it as a building block for custom components. The YUI documentation is first-class. In fact, it represents some of the best documentation I've come across for an open source project. Between the user guides, cheatsheets, api browser, examples, and developer videos, you have just about everything you could ask for. Of course, sometimes documents just aren't enough. Luckily, we've found the YUI support group to be a good place to find additional answers. Last but not least is the topic of browser support. While we'd love to support every browser in existence, it simply isn't possible. But we do our best to test and code for as many as we can. We think Yahoo! has taken the right approach with its [Graded Browser Support](http://developer.yahoo.com/yui/articles/gbs/index.html) model.

**What components of YUI are used in Mia?**

We are currently utilizing the [Reset](http://developer.yahoo.com/yui/reset/)\-[Fonts](http://developer.yahoo.com/yui/fonts/)\-[Grids](http://developer.yahoo.com/yui/grids/) CSS, [Dom Collection](http://developer.yahoo.com/yui/dom/), [Event Utility](http://developer.yahoo.com/yui/event/), [Tabview Control](http://developer.yahoo.com/yui/tabview/), [Button Control](http://developer.yahoo.com/yui/button/), [Color Picker Control](http://developer.yahoo.com/yui/colorpicker/), [Rich Text Editor](http://developer.yahoo.com/yui/editor/), [Animation Utility](http://developer.yahoo.com/yui/animation/), [Element Utility](http://developer.yahoo.com/yui/element/), [Container Family](http://developer.yahoo.com/yui/container/), and [Menu Control](http://developer.yahoo.com/yui/menu/). Our production releases also make use of the [YUI Compressor](http://developer.yahoo.com/yui/compressor/) which we have integrated with our ANT packager to compress all the CSS and JavaScript in the system. The entire YUI library is included in the system so we are hoping our 3rd party developer community will make use of the library as well. Each custom component comes with its own set of unique requirements and we are confident that YUI can meet their needs, help improve their extensions, and reduce the number of 3rd party libraries the system must carry. In the last release we also build a dynamic loader into the system which allows MiaCMS users to decide between serving files from the local YUI library and serving them from the Yahoo hosting service for the advantages its CDN can bring.

![YUI Rich Text Editor on MiaCMS.](/yuiblog/blog-archive/assets/mia2.png)

**Where do you see opportunities for deeper YUI integration with MiaCMS in the months ahead?**

We've still got a lot more planned for YUI. Mia is carrying a fair amount of legacy JavaScript code in the system since its Mambo base was started about 7 years ago. We'll be rewriting a good chunk of the JavaScript in Mia over the next few releases and utilizing YUI where possible. Users can expect a drastic reduction in inline JavaScript. We also plan to move away from older styles of event handling like coding individual onclick/onmouseover events and instead rely on the [YUI Event Utility](http://developer.yahoo.com/yui/event/) to subscribe to DOM events and help us create custom events with the application. Future releases will make heavy use of the [YUI Dom Collection](http://developer.yahoo.com/yui/dom/) as well as the Event and [Selector](http://developer.yahoo.com/yui/selector) utilities.

In addition to the custom JavaScript found in the CMS there are also a number of external JavaScript libraries included to handle specific functions like tooltips, menus, calendaring, etc. A goal for the project will be to reduce the number of external dependencies and rely on YUI where possible. Two such replacements have already been almost fully implemented within the CMS core and we have started to encourage our 3rd party developers to make the switch as well with their custom extensions. In past releases the menu system relied on JSCookMenu and all tabs within the system relied on WebFX Tab Pane. JSCookMenu has now been fully replaced with the [YUI Menu Control](http://developer.yahoo.com/yui/menu/) and the WebFX Tab Pane conversion to [YUI TabView](http://developer.yahoo.com/yui/tabview/) is about 98% complete. We are currently in the process of replacing overLib tooltips with the [YUI Tooltip Control](http://developer.yahoo.com/yui/container/tooltip/). We will also soon replace "The DHTML Calendar" with the [YUI Calendar Control](http://developer.yahoo.com/yui/calendar/). It would also be pretty safe to say you'll eventually find [ContextMenus](http://developer.yahoo.com/yui/examples/menu/contextmenu.html), [TreeView](http://developer.yahoo.com/yui/treeview/), [DataSource](http://developer.yahoo.com/yui/datasource/), [DataTable](http://developer.yahoo.com/yui/datatable/), [Connection Manager](http://developer.yahoo.com/yui/connection/), and [JSON](http://developer.yahoo.com/yui/json/) being used within MiaCMS. We recently selected Open Flash Charts, but as the [YUI Charts Control](http://developer.yahoo.com/yui/charts/) matures and evolves out of an experimental state that may also find it's way into Mia.

**Having developed a complex application implementing YUI, what are your thoughts on the state of YUI as a toolkit? What's working super well at this point? What weaknesses are you hoping the YUI team will address?**

YUI is a feature-rich, well designed, state of the art toolkit. The available components cover a wide variety of the common tasks needed for web application development. We have had great success integrating YUI deeply into the MiaCMS core which we will continue to do with each passing release. The community feedback on the YUI-related changes has been very positive so far. Support for the major browsers is top-notch, the components degrade nicely, and performance is solid. Tools like the [YUI Compressor](http://developer.yahoo.com/yui/compressor/) and [YSlow](http://developer.yahoo.com/yslow/) are also key in helping us take performance to the next level.

Nothing much to complain about. Overall we have been very happy with our selection of the YUI Library. One of the things I really like about jQuery is the powerful CSS style selectors. I am really looking forward to the [YUI Selector Utility](http://developer.yahoo.com/yui/selector/) coming out of beta. We'll probably start making heavy use of it even before then, but obviously the more stable it is the better. I also see a lot of potential for the experimental Charts component so I'd like to see it polished up with its functionality being continually expanded as well.

**What are the next big frontiers for the MiaCMS project as a whole?**

Below is the list of roadmap items in no particular order. Some are already being worked on, some are almost complete, and others are in the planning stages.

-   Improved ACL's (User/Group Permissions)
-   Database Portability
-   LDAP Support
-   OpenID
-   Dublin Core Metadata
-   OAuth
-   N-Level Content Organization (remove the two tier section/category limitation)
-   Content Versioning
-   Multilingual Content Management
-   Writeable REST Interface
-   Multi-Site Management
-   Improved File & Image Management