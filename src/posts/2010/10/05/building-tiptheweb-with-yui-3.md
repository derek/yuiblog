---
layout: layouts/post.njk
title: "Building TipTheWeb with YUI 3"
author: "Eric Ferraiuolo"
date: 2010-10-05
slug: "building-tiptheweb-with-yui-3"
permalink: /blog/2010/10/05/building-tiptheweb-with-yui-3/
categories:
  - "Development"
---
_**About the Author:** Eric Ferraiuolo is a Director of [TipTheWeb](http://tiptheweb.org/) and Co-Founder of [Oddnut Software](http://oddnut.com/). He writes on his **blog**: [925 HTML](http://925html.com/), and can be found on **Twitter**: [@ericf](http://twitter.com/ericf). [Eric was a featured presenter at YUIConf 2009](http://developer.yahoo.com/yui/theater/video.php?v=ericf-yuiconf2009-webapps)._

[TipTheWeb](http://tiptheweb.org/) is a new service that lets people directly support their favorite web content by tipping it. For instance, if you find a great blog post, you could tip it 25 cents.

TipTheWeb is a **non-profit** organization﻿ promoting **freely-accessible**, high-quality web content by **awarding publishers** that receive tips. If you publish online, you can use your TipTheWeb account to claim the places you publish to receive tips and be eligible to receive awards from TipTheWeb.

![Screenshot showing the Landing page of tiptheweb.org](/yuiblog/blog-archive/assets/ttw/ttw_landing.png)

### TipTheWeb's Use of YUI 3

The user interface of TipTheWeb is _completely_ built on top of YUI 3 (we drank the Kool-Aid.) The approach we took was to use YUI 3 as the foundation and structure for our JavaScript code. We've built **33 custom YUI 3 modules** (56 if you include submodules, plugins, and roll-ups), several of which we contributed the **YUI 3 Gallery**: [Component Manager](http://yuilibrary.com/gallery/show/base-componentmgr), [Markout](http://yuilibrary.com/gallery/show/markout), [Overlay Extras](http://yuilibrary.com/gallery/show/overlay-extras), and [REST Resource](http://yuilibrary.com/gallery/show/resource).

#### Page-Level Classes

The core features of TipTheWeb are implemented on a few highly-functional web pages which communicate with the server over Ajax. For each of these pages we created a custom YUI 3 module that exposes a **page-level class** used to coordinate actions between the functional parts of the page.

﻿In one of our application's main pages, the Tips page, you can see how this approach is applied with the page-level class **TipsWindow**. The main functional parts of the page are the widgets: **CreateTip** used for creating tips, and the **TipList** widgets for editing, canceling, and funding existing tips.

![Annotated diagram labeling the main Widgets and Components that make up the Tips page of TipTheWeb](/yuiblog/blog-archive/assets/ttw/ttw_tips.png)

#### A Lot of Overlays

We use `Y.Overlay`s extensively throughout our application's UI to implement user-interactions; this allows us to keep the interface clutter-free while still having the functionality for advanced features available on the page. We needed features that were not built into ﻿`Y.Overlay`, so we developed ﻿[Overlay Extras](http://yuilibrary.com/gallery/show/overlay-extras), which is in the YUI 3 Gallery and being used by a lot of other YUI 3 powered sites. Here are some place where we use Overlays on TipTheWeb:

![Screenshot showing the confirmation overlay that appears when canceling a tip](/yuiblog/blog-archive/assets/ttw/ttw_cancel_confirm.png)

![Screenshot showing the overlay which contains a slider to allow a custom amount to be set when donating to TipTheWeb](/yuiblog/blog-archive/assets/ttw/ttw_donate_custom.png)

![Screenshot showing the menu which lists the various places a user can claim and accept tips at](/yuiblog/blog-archive/assets/ttw/ttw_claim_menu.png)

### Current State of TipTheWeb

We'd love for you to try out [TipTheWeb](http://tiptheweb.org/); right now we are in invite-only beta, so **[request an invite](http://tiptheweb.org/notify)** on our site and we'll send you an invite code.

Be sure to catch our talk at ﻿**[YUIConf 2010](/yuiblog/blog/2010/09/09/register-now-for-yuiconf-2010/)** where we will be presenting (more in depth) on how we use YUI 3 and YQL at TipTheWeb.