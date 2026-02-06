---
layout: layouts/post.njk
title: "Using YUI at EtreProprio.com"
author: "Philippe Bernou"
date: 2010-03-02
slug: "using-yui-at-etreproprio"
permalink: /blog/2010/03/02/using-yui-at-etreproprio/
categories:
  - "Development"
---
EtreProprio.com aims to provide high quality classifieds for free ([see an example of a listing here](http://www.etreproprio.com/21771)). There are currently more than five thousand property owners selling their houses on EtreProprio.com. We wanted to provide a simple but powerful interface, and we needed a lot of front-end logic. After a little experimentation, we chose YUI which struck us as powerful, robust, very well documented and highly customizable. As a consequence, EtreProprio.com is using YUI (2.8.0) heavily for its front-end.

The following modules are used:

-   **CSS:** Reset, Base
-   **Utilities:** Animation, Connection Manager, Cookie, Datasource, Drag and Drop, JSON
-   **Widgets:** AutoComplete, Button, Calendar, Container, DataTable, RTE, Slider, TabView, Uploader

Let's go deeper on three implementations: Advanced Search, Photo Uploader and TabView.

### Advanced Search

The form used to find properties is developed on top of [AutoComplete](http://developer.yahoo.com/yui/autocomplete/) and [Dual Slider](http://developer.yahoo.com/yui/slider/). The labels above slider thumbs are positioned by listening to change event. Then, they are repositioned if a collision occurs between min and max labels. The AutoComplete implementation can display mixed elements such as cities, postal codes or regions. Each element has its own display format.

  

<object height="385" width="480"><param name="movie" value="http://www.youtube.com/v/HVUaI7Jlcq0&amp;hl=fr_FR&amp;fs=1&amp;rel=0"> <param name="allowFullScreen" value="true"> <param name="allowscriptaccess" value="always"><embed allowfullscreen="true" allowscriptaccess="always" height="385" src="http://www.youtube.com/v/HVUaI7Jlcq0&amp;hl=fr_FR&amp;fs=1&amp;rel=0" type="application/x-shockwave-flash" width="480"></object>

[Try it live](http://www.etreproprio.com/recherche).

### Photo Uploader + Management

We used [YUI's Uploader](http://developer.yahoo.com/yui/uploader/), [DataTable](http://developer.yahoo.com/yui/datatable/) and [Drag and Drop](http://developer.yahoo.com/yui/dragdrop/) modules in order to create simple form for photo uploading. First, the user selects the photos on his computer. Then he clicks "Send all" and as the photos are sent, a table below is populated with the photos and details. Drag and drop is applied to the rows of the table, it allowing users to easily reorder the photos. The description of each photo can be modified using a simple text input and YUI's XMLHttpRequest utility, [Connection Manager](http://developer.yahoo.com/yui/connection/).

See the video below for a demonstration:

  

<object height="385" width="480"><param name="movie" value="http://www.youtube.com/v/P44wFOFi-Eo&amp;hl=fr_FR&amp;fs=1&amp;"> <param name="allowFullScreen" value="true"> <param name="allowscriptaccess" value="always"><embed allowfullscreen="true" allowscriptaccess="always" height="385" src="http://www.youtube.com/v/P44wFOFi-Eo&amp;hl=fr_FR&amp;fs=1&amp;" type="application/x-shockwave-flash" width="480"></object>

### TabView

As there is a lot of information to display in a classified detail, we used [TabView](http://developer.yahoo.com/yui/tabview/) to design the page. The CSS personalization capabilities of TabView allow us to integrate it perfectly with the rest of the page from a design perspective. Tabview also saves us bandwidth as only interested users click on all the tabs — TabView has support for [lazyloading Tab content](http://developer.yahoo.com/yui/examples/tabview/datasrc.html "YUI Library Examples: TabView Control: Getting Content from an External Source"), and that pattern works well for us here.

  

<object height="385" width="480"><param name="movie" value="http://www.youtube.com/v/iDc00l2mO6Y&amp;hl=fr_FR&amp;fs=1&amp;rel=0"> <param name="allowFullScreen" value="true"> <param name="allowscriptaccess" value="always"><embed allowfullscreen="true" allowscriptaccess="always" height="385" src="http://www.youtube.com/v/iDc00l2mO6Y&amp;hl=fr_FR&amp;fs=1&amp;rel=0" type="application/x-shockwave-flash" width="480"></object>