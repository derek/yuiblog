---
layout: layouts/post.njk
title: "Andrew Bialecki Wins the YUI 3 Gallery Contest 2010 with Effects Module"
author: "YUI Team"
date: 2010-03-24
slug: "gallery-contest-recap"
permalink: /2010/03/24/gallery-contest-recap/
categories:
  - "YUI 3 Gallery"
  - "Development"
---
Congratulations to Andrew Bialecki ([@abialecki on Twitter](http://twitter.com/abialecki)), whose Scriptaculous-inspired [Effects module](http://yuilibrary.com/gallery/show/effects "YUI Library :: Gallery :: Effects") won the [YUI 3 Gallery Contest 2010](/yuiblog/blog/2010/03/05/yui-3-gallery-contest-2010/ "YUI 3 Gallery Contest 2010 — Win a Ticket to JSConf 2010 » Yahoo! User Interface Blog (YUIBlog)").

Andrew, who lives in the D.C. area, will be attending [JSConf 2010](http://jsconf.us/2010/ "JSConf.US 2010 -- Swashbucklin' JavaScript!") next month with a complimentary ticket from the [Yahoo! Developer Network](http://developer.yahoo.com/ "Yahoo! Developer Network Home"). (Thanks, [@ydn](http://twitter.com/ydn)!)

### The Winning Entry: Effects

Andrew's project builds on the [YUI 3 Animation](http://developer.yahoo.com/yui/3/anim/ "YUI 3: Animation") component, adding to it a sugar layer inspired by the Scriptaculous API. The idea will be a familiar (and welcome) one for anyone used to this sort of syntax:

```
Y.one("#main_demo").move({ x: 300 }).fade();
```

The judges appreciated the utility and desirability of this package. Developers will appreciate the conciseness of the syntax and the discoverability of the effects, especially if they have experience working with it in other libraries.

[![](/yuiblog/blog-archive/assets/effects-docs-20100323-183540.jpg)](http://projects.sophomoredev.com/yui-gallery-effects/)

We also admired the professionalism of [the documentation Andrew provided for the module](http://projects.sophomoredev.com/yui-gallery-effects/ "YUI Gallery Effects"). Documentation is never an easy task, but it is the implementer's first touchpoint with your code, and thoroughly documenting the project tells your audience that you're taking its needs seriously. Andrew easily cleared that bar for us.

We can see `gallery-effects` showing up in a lot of `use()` statements in the future, and that was one of the deciding factors. Useful, expressive, and convincingly documented — in this case, a winning combination.

Thanks to Andrew for his submission. [Check out all of Andrew's gallery contributions on YUILibrary.com](http://yuilibrary.com/gallery/user/bialecki "YUI Library :: Gallery").

### Honorable Mentions

The quality of modules we judged for the competition made this a difficult choice — there is a lot of interesting work in this group. We singled out a few other notable entries worthy of particular praise:

-   **Usefulness: YUI Slideshow** — Josh Lizarraga's [YUI Slideshow module](http://freshcutsd.com/yui-slideshow-basic-usage/ "YUI Slideshow Basic Usage –  Fresh Cut - San Diego Graphic Design") (inspired by the jQuery Cycle plugin) is clean, elegant, and well documented. This is a strong contender if you're looking for an image cycler based on YUI 3.
-   **Uniqueness: Radial Menu** — Matt Snider's [Radial Menu](http://www.mattsnider.com/widget/yui-3-radial-menu-gallery-component/ "A JavaScript and Web Design/Programming Resource By Matt Snider | YUI 3 Radial Menu Gallery Component") is a novel approach to looking at a portfolio of thumbnail- or medium-sized objects. The use case for this component is arguably narrower than for some UI widgets, but deployed in the correct context it could be quite impactful and distinctive.
-   **Code Quality: Component Manager** — Eric Ferraiuolo's [Component Manager](http://yuilibrary.com/gallery/show/base-componentmgr "YUI Library :: Gallery :: Component Manager") struck us as being well written and as being a project that helps developers manage their own code structure. While it won't make your page shiny, it might help make your application work better, and that's worthy of an honorable mention in our book.
-   **Documentation: YUISand** — Lauren Smith's [YUISand](http://kickballcreative.com/yui/modules/yuisand/ "YUI Library :: Gallery :: YUISand") module, which is a slick implementation inspired by Quicksand for jQuery, was both well documented and interesting. It shared high marks in the documentation category with [James Punteney's commendable and modular Slideshow Base/Slideshow Animated tandem](http://www.punteney.com/builds/yui3-slideshow-base/ "Slideshow Base"), [Josh's cycle-style Slideshow](http://freshcutsd.com/yui-slideshow-basic-usage/ "YUI Slideshow Basic Usage –  Fresh Cut - San Diego Graphic Design"), and several others.

### 16 Modules in 17 Days

This was a short-running contest, but despite the narrow window there were 16 eligible modules submitted, and none of them disappointed. In fact, many of them may end up making a compelling contribution to one of your future YUI 3 applications. There was an [image magnifier](http://yuilibrary.com/gallery/show/magnifier "YUI Library :: Gallery :: Magnifier"), [two](http://yuilibrary.com/gallery/show/video "YUI Library :: Gallery :: Video") [video](http://yuilibrary.com/gallery/show/port "YUI Library :: Gallery :: Port Base") modules, a [wrapper for YUI 3 DataSource](http://yuilibrary.com/gallery/show/datasource-wrapper "YUI Library :: Gallery :: DataSource Wrapper") to make it work with YUI 2 components, a [carousel widget](http://yuilibrary.com/gallery/show/shoveler "YUI Library :: Gallery :: Shoveler"), and [a DOM-creation sugar module](http://yuilibrary.com/gallery/show/markout "YUI Library :: Gallery :: Markout"), and more.

With these recent arrivals (along with several others from the past few weeks that were not contest-eligible), [YUI 3 Gallery is up to 82 modules](http://yuilibrary.com/gallery/show/?show=all "YUI Library :: Gallery"). They range from the foundational to the whimsical, but the resource itself is already one of the most valuable aspects of the YUI 3 developer portfolio. ([And it may get even more valuable quite soon](/yuiblog/blog/2010/03/15/previewing-alloyui/ "Previewing AlloyUI, a YUI 3-based Component Library from Liferay » Yahoo! User Interface Blog (YUIBlog)").) Remember, as of the coming 3.1 release (just a few weeks away) you'll be able to use all of these modules [directly from your `use()` statement](/yuiblog/blog/2010/03/11/yui-2-in-3-coming-soon/ "YUI 2 in 3: Coming in YUI 3.1.0, a Simpler Way To Use YUI 2 Modules » Yahoo! User Interface Blog (YUIBlog)") with no additional configuration or overhead.

Thanks to everyone who submitted modules. Andrew, have fun at JSConf!