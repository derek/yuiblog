---
layout: layouts/post.njk
title: "Patterns Behind the Yahoo! Home Page Beta"
author: "Bill Scott"
date: 2006-05-15
slug: "patterns-behind-homepage"
permalink: /2006/05/15/patterns-behind-homepage/
categories:
  - "Development"
---
The yahoo.com home page team has been very busy over the last few months testing the new home page to create a richer experience for our users. There are many challenges to changing any home page. Just imagine the challenges with changing the most trafficked home page on the entire web!

One of the [design principles I regularly discuss](http://looksgoodworkswell.blogspot.com/2006/01/nine-tips-for-designing-rich-internet.html) is to

> Cross Page Boundaries Reluctantly

This principle captures the idea that every piece of logical content does not have to be on a different page. Instead when we design a content page, especially a home page, we should consider how we can expand the user's virtual space. In many ways this is similar to creating a play. At any given time the view on the stage is only a small part of the action. The backstage, props, and other actors are all being prepared for the next scene. A home page can provide ways to allow a user to take a "sneak peek" at additional content and essentially "open up" the page space.

This is just what the new Yahoo! home page has done.

## Personal Assistant

One of the really nice additions is the Personal Assistant. It gives a quick glance at what is happening in your personal space. All of the content that appears when you rollover the different areas is pulled in via an Ajax lookup. It also does a nice job of exposing and hiding content during exploration.

So here are some of the benefits of Ajax-ifying the home page.

## Live Information

Since each rollover is actually an Ajax lookup, you get the latest content. Rolling over Mail, will give you your last 5 messages.

![Personal assistant mail panel](http://static.flickr.com/44/147251911_076d2ed3c8_o.png)

## Dynamic Paging

When looking at your Messenger contacts notice the Next/Previous links. You can sub-page through the content in this exploded tab view. The paging is very fast since it uses Ajax to pull in content.

![Personal assistant messenger paging](http://static.flickr.com/52/147251896_202ad268bd_o.png)

Another variation on paging is found in the Movies and Radio Panels. Content can be scrolled in by using the Left/Right arrows.

![Personal assistant movie paging](http://static.flickr.com/49/147251921_d1d96cf049_o.png)

## In Context Configuration

On the Weather (or Local) panel, you can change the location by clicking the "Change Location" link. This overlays a configuration panel over the weather info. Change the location to see weather for a different area.

![Personal assistant weather panel](http://static.flickr.com/46/147251938_f7508f5178_o.png)

## Dynamic Local Content

In the Local panel, you can toggle between a view of traffic conditions or local events on a map. Ajax makes it easy to toggle and get the latest information since it is fetched just-in-time and live. And the map is live and draggable.

![Personal assistant local map](http://static.flickr.com/47/147251918_e3788d21b8_o.png)

## Tabbed Content Areas

While tabbed areas are not new, coupled with Ajax they make it fast to load the page and then get the additional content on demand. You can see Featured content as well as Entertainment, Sports, Money, News, World and Video in the tabbed content areas.

Notice the creative way the sub-content is handled in each of the tabbed areas. A hyper-linked area in the content shows more information when clicked on.

![Tabs with sub-content](http://static.flickr.com/46/147251933_6813ef7bd0_o.png)

## Tour

To aid in discoverability, the Yahoo! home page introduces a nice tour technology. Clicking the Tour button takes you through a Tour Wizard. The Dim and Brighten patterns are used to call attention to the area being shown.

![Yahoo! home tour](http://static.flickr.com/56/147251905_c0280811a7.jpg)

## Slide Outs

Both the "All Yahoo! Services" and the "Page Options" provide slide outs and drop downs that expose more navigation choices and configuration options.

![Yahoo! home configuration](http://static.flickr.com/44/147251923_6281ba9280_o.png)

Taken together, the changes make it possible to have a cleaner, more streamlined home page while at the same time allowing a lot more content to be easily accessible.