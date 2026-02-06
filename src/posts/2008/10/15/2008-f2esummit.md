---
layout: layouts/post.njk
title: "Reflections on the 2008 Yahoo! Frontend Engineering Summit"
author: "YUI Team"
date: 2008-10-15
slug: "2008-f2esummit"
permalink: /blog/2008/10/15/2008-f2esummit/
categories:
  - "Development"
---
It's that time of year again. We just had the third annual Yahoo Front-end Engineering (F2E) Summit, an internal conference that brings together Yahoo F2E talent from around the world. We'll release some of the videos shortly ([the YUI 3 presentation by Eric Miraglia and Matt Sweeney is up today](/yuiblog/blog/2008/10/14/video-yui3/)). In the meantime here are some reflections on what we talked about last week.

[![David Filo talks to Yahoo frontend engineers last week at Yahoo HQ in Sunnyvale, CA.](http://farm4.static.flickr.com/3237/2927870413_dbfef09488.jpg?v=0)](http://www.flickr.com/photos/equanimity/2927870413/in/set-72157594305864452/)Yahoo co-founder David Filo opened the summit with a talk about the role of F2Es at Yahoo and why they are important. I think David made some really excellent points which follow on from work [Nate Koechely from the YUI team](http://nate.koechley.com/) has been doing on F2E professionalism. Keynote addresses by [Bill Scott](http://looksgoodworkswell.blogspot.com/) and [Douglas Crockford](http://blog.360.yahoo.com/douglascrockford) added depth and nuance to the conversation as well.

While many people are involved in making a web site it is the work of the F2Es that touches the users directly. We translate the designs of the designers and the data of the back-end engineers into an experience for our customers. That's a pretty big responsibility.

[![Philip Tellis presenting on Flickr](http://farm4.static.flickr.com/3055/2925711457_e341e6e561.jpg)](http://www.flickr.com/photos/rmsguhan/2925711457/)

That's why we choose to create the YUI team: We want to do things once, do them right...and in fact do them right once. YUI means the whole company has a rich interaction and widgets library to draw from, one built on the best practices we follow.

Best practices like security, performance, internationalisation, accessibility and error handling are the measure of how we are succeeding. F2E at Yahoo is pretty good already. Our goal is to push the envelope to support that last 1%. When we are reaching out to approaching a billion people, that last 1% is a big number. If you think of the web industry as a whole, that last 1% is an incredible number.

David's thoughts really set the scene for a conference with more talks than I could even physically attend. The bar is getting higher every year, but there were a few talks this year that I particularly enjoyed.

Nicole Sullivan presented on design guidelines to increase your site performance. Nicole had an endless supply of excellent advice on how to work with your designers to optimise performance. These resolved into 9 rules. A few highlights: She recommends the use of CSS grids (such as the [YUI grids](http://developer.yahoo.com/yui/grids)). Shared components like grids are great because you can use them again and again without impacting your performance. Nicole suggests components are like lego blocks. You use the same blocks repeatedly and mix and match them without adding any extra page weight.   

<object height="355" style="margin:0px" width="425"> <param name="movie" value="http://static.slideshare.net/swf/ssplayer2.swf?doc=designingfastwebsites-1224025689783608-8&amp;stripped_title=designing-fast-websites-presentation"> <param name="allowFullScreen" value="true"> <param name="allowScriptAccess" value="always"><embed allowfullscreen="true" allowscriptaccess="always" height="355" src="http://static.slideshare.net/swf/ssplayer2.swf?doc=designingfastwebsites-1224025689783608-8&amp;stripped_title=designing-fast-websites-presentation" type="application/x-shockwave-flash" width="425"></object>

I also enjoyed the show and tell session on progressive enhancement. A number of Yahoo properties showed off some of the great work they are doing on progressive enhancement.

Fantasy Sports is rife with great examples. A simple one that everyone should be able to achieve is their Ajax tabs that also work without JavaScript. You can see in the screenshot below that when JavaScript is turned off the page reloads with a variable in the URL corresponding to the tab to be viewed. This simple solution means that the tabs work as well without JavaScript as they do with.

![](http://farm4.static.flickr.com/3051/2944717399_6e16b1fd3e_o.jpg)

Another great example is from the European TV listing. Here, the search box is represented as a tabbed control which allows the user to select which part of Yahoo they want to search. However, rather than using the traditional approach of tab controls the form has been built using radio buttons. When we remove the styling from the form it becomes apparent that in this scenario radio buttons allow the user to select what they want to search. This approach is preferable to them having to navigate to another page and then search.

![](http://farm4.static.flickr.com/3044/2944717419_7988b8bcb1_o.jpg)

Thinking about more than just the visual metaphor or mental model of sighted users is important. Getting the basic interaction model correct is also important and the best medium to do that in is HTML without styling.

Finally, Todd Kloots from the YUI team presented the progressive enhancement features of the [YUI Menu Control](http://developer.yahoo.com/yui/menu) which [he's blogged about here previously](/yuiblog/blog/2007/12/21/menu-waiaria/).

Jenny Han Donnelly (YUI engineer and author of the YUI DataTable, among other things) chaired the conference, and it was our best summit yet. Can't wait for next year's edition!

_Tom Hughes-Croucher is an evangelist with the [Yahoo! Developer Network](http://developer.yahoo.com/)._