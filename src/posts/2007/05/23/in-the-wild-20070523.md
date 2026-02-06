---
layout: layouts/post.njk
title: "YUI In the Wild #2"
author: "Nate Koechley"
date: 2007-05-23
slug: "in-the-wild-20070523"
permalink: /2007/05/23/in-the-wild-20070523/
categories:
  - "Development"
---
Based on positive feedback to last week's post (thanks!), I'm going to keep writing these _In the Wild_ columns. There's tons of great YUI content created by the community but it can be time consuming to find, and so I hope this roundup continues to be useful. (Also new this week is a [Features Job Opening](/blog-archive/#featured-jobs) sidebar module on this blog. We hope it's unobtrusive over there, while still getting the word out about a few of our key opportunities.)

-   [JavaScript Libraries: The Big Picture](http://simonwillison.net/2007/May/16/libraries/) was presented at XTech in Paris last week by Simon Willison. Simon is the rare person who has real experience with multiple leading JavaScript libraries. Because of this he's able to compare and contrast them with insight. He also gives great presentations, and this is no exception: the 52 slides provide an overview of leading libraries, their design choices, and his thoughts on the state of things.
    
-   [Another Tabbed Interface](http://www.nodetraveller.com/blog/javascript/another-tabbed-interface/), a new post from Yahoo! London's Lawrence Carvalho's personal blog, shares how he built [Draggable/Reorderable Tabs](http://www.nodetraveller.com/sandbox/moduleTabs/draggable.php) and [Closable Tabs](http://www.nodetraveller.com/sandbox/moduleTabs/closeable.php) by extending YUI Tabs and Aspect Oriented Programming (AOP) concepts.
    
-   [Creating a fancy slider in JavaScript using YUI](http://20bits.com/2007/03/28/creating-a-fancy-slider-with-yui/) on 20bits.com has some helpful tips for understanding, creating, and extending sliders. In my _personal_ opinion, sliders--in all their varied visual manifestations--can be powerful interface widgets but are too often underused.
    
-   [Using the YUI Menu Control](http://www.devarticles.com/c/a/JavaScript/Using-the-YUI-Menu-Control/) by Dan Wellman is a tutorial covering how to create a basic menu, how to render and display the menu, and how to change the menu's styling. Thanks Dan!
    
-   [Remote JavaScript includes without the performance penalty](http://wonko.com/article/513) is a two-part series by Ryan Grove. Fast is good, so take a look.
    
-   [ETags are not a panacea](http://www-03.ibm.com/developerworks/blogs/page/pmuellr?entry=etags_are_not_a_panacea) -- Speaking of speed, ~IMB~ IBM Senior Technical Staff member Patrick Mueller writes on their developerWorks site about the role and impact of ETags and explores ways to make your sites and apps faster. In addition to the insights about ETags, he takes a look at [YUI's free hosting](http://developer.yahoo.com/yui/articles/hosting/) and has this to say (my emphasis):
    
    > Good stuff! The Expires and Cache-Control headers render this file pretty much immutable, as it should be. When Yahoo! releases the next version of the toolkit, it'll be hosted at a different url base, and so will be unaffected by the headers of this particular file; they will be different urls. **This sort of behaviour is highly optimal** for web 2.0-ey apps, which are wont to download a lot of static html, css and javascript files, which, for some particular version of the app, will never change. And thus, by having the files cached on the client in such a way that it never asks the server for them again, the app will come up all the quicker.
    
-   [Beginning AJAX using the YUI Library](http://www.evotech.net/blog/2007/05/beginning-ajax-using-the-yui-library/) is the perfect little-step-by-little-step guide to getting started with Ajax and YUI from Estelle Weyl on the _CSS, JavaScript and XHTML Explained_ blog.
    
-   [Planet Yazaar](http://yazaar.org/) creates and maintains community-supported additions to YUI (Yahoo + Bazaar = Yazaar). One contribution to that site so far is a [YUI Unobstrusive Javascript Validation](http://blog.jc21.com/2007-02-05/yui-unobstrusive-javascript-validation/) from Jamie Curnow.
    
-   [ASP.NET Web Controls for the Yahoo! User Interface Library](http://www.codeproject.com/aspnet/YahooInterfaceLibWebCtrls.asp) by Luke ~Frost~ Foust looks to be a very promising effort. He writes:
    
    > In order to make these controls work well in an ASP.NET environment, it is a useful exercise to create custom web controls which can make it easy to drop these controls onto any ASP.NET page. Currently, the following YUI controls are supported: Button, Calendar, Panel, Tooltip, Logger, Menu, and TabView.
    
-   When we put together this year's internal front-end engineering summit at Yahoo! back in March — an annual event bringing together hundreds of our front-end specialists from across the globe — we invited Brad Neuberg to give the keynote. His speech was titled "[Inventing the Future](http://codinginparadise.org/weblog/2007/05/yahoo-frontend-summit-inventing-future.html)" and he blogged about the experience this week.
    
-   [BarCamp in Charlottesville on June 15/16](http://www.barcamp.org/beCamp) lists YUI prominently on their agenda, so if you're in the Virgina area you might want to check it out.
    
-   [Molu - The Search Spider](http://www.themolu.com/) is a new search engine (in beta) that uses YUI extensively.
    
-   Scott Jungling, Web Apps developer at California State University at Chico, [has been upgrading their templates](http://blogs.csuchico.edu/ik/2007/05/15/attack-of-the-yui/) with a nice dose of [YUI CSS Grids](http://developer.yahoo.com/yui/grids/) (and Reset and Fonts).
    
-   [Detailed steps to read data from a MySQL database and display it in a jMaki-wrapped Yahoo DataTable widget](http://weblogs.java.net/blog/arungupta/archive/2007/05/jmaki_on_rails.html) from Arun Gupta's Blog.

OK, that's it for now. If you have links for me to cover in the next installment (or feedback on the format) please add them to the comments, send them to me directly (natek at yahoo dash inc dot com) or tag them [yui.blog on del.icio.us](http://del.icio.us/tag/yui.blog).

(Update: Note that I corrected two errors above: it's Luke _Foust_ not ~Frost~, and Patrick Mueller works at _IBM_ not ~IMB~.)