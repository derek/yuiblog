---
layout: layouts/post.njk
title: "Implementation Focus: Adify"
author: "YUI Team"
date: 2009-11-11
slug: "implementation-focus-adify"
permalink: /blog/2009/11/11/implementation-focus-adify/
categories:
  - "Development"
---
![Members of Adify team: (From left to right) Kunal Cholera, Reynold Wang, Takashi Arai, Levi Wolfe, Robert Porter, Edwin Jarlos, Melroy Saldanha](/yuiblog/blog-archive/assets/adify/team.png)

**Members of the Adify team:** _(From left to right) Kunal Cholera, Reynold Wang, Takashi Arai, Levi Wolfe, Robert Porter, Edwin Jarlos, Melroy Saldanha._

**Tell us about your company/product/website.**

Adify offers two related services — the Adify Network Builder platform and Adify Media. Adify Network Builder is a fully integrated, end-to-end technology platform developed and optimized for the unique requirements of premium vertical ad networks and their publisher partners. Adify Network Builder enables enterprises such as Warner Brothers, Univision and Forbes and entrepreneurs such as Resonate, Yardbarker, and MOG to build and commercialize branded vertical networks. Adify Media is the media services division of Adify. Built on the Adify Network Builder platform technology that powers more than 200 vertical ad networks, Adify Media has unique access to over 12,000 sites in networks built by top media companies. Adify Media reaches advertisers' goals by delivering creative and content with 100 percent transparency to quality mid-tail sites. ![Screenshot of Adify's Network Forecast page, which uses YUI Charts.](/yuiblog/blog-archive/assets/adify/chart.png)

**What is your team's approach to development?**

Unlike a lot of other projects using YUI, we are building a business application. Our users want a fast, responsive application that they can log into, get their reports, and get out. We want our application to feel as professional and solid as a desktop application, without being held back by traditional limitations of a web-based environment.

**What made YUI a good fit for your project?**

As YUI is completely client side, it integrates extremely well with many server technologies (ASP.NET included). It is very stable and professionally maintained. This can be seen in everything from the numerous examples and very helpful API documentation to the active forums and bug tracking. I'm impressed Yahoo! has such talented people working on something they give away for free.

**How are you using YUI?**

We have nearly 200 aspx pages, and almost all of them are using YUI in some way. We're using [Fonts](http://developer.yahoo.com/yui/fonts/) and [Grids](http://developer.yahoo.com/yui/grids/) CSS components (we haven't quite worked up to [Reset](http://developer.yahoo.com/yui/reset/) yet). We use the core components to navigate and manipulate the DOM, and to smooth over browser differences. Some of the more commonly called functions include [Dom.addClass()](http://developer.yahoo.com/yui/docs/YAHOO.util.Dom.html#method_addClass), [Dom.getElementsByClassName()](http://developer.yahoo.com/yui/docs/YAHOO.util.Dom.html#method_getElementsByClassName), [Event.stopEvent()](http://developer.yahoo.com/yui/docs/YAHOO.util.Event.html#method_stopEvent), and [Event.onDOMReady()](http://developer.yahoo.com/yui/docs/YAHOO.util.Event.html#method_onDOMReady).

We probably use about half of the widget components, some highlights are:

1.  Using [DataSource](http://developer.yahoo.com/yui/datasource/) to power [Charts](http://developer.yahoo.com/yui/charts) and [DataTable](http://developer.yahoo.com/yui/datatable/). It becomes incredibly easy to switch between local or XHR sources depending on the amount of data, which is great for client performance.
2.  Using the [ColorPicker](http://developer.yahoo.com/yui/colorpicker/) control to create a highly customizable [white-label](http://en.wikipedia.org/wiki/White-label_product) interface. We are then able to easily reskin various components with a small amount of dynamic CSS.
3.  Integrating a [YUI Panel](http://developer.yahoo.com/yui/container/panel/) with an ASP.NET [UpdatePanel](http://msdn.microsoft.com/en-us/library/system.web.ui.updatepanel.aspx) to make something we call an UpdateDialog. This gives us an in-page modal dialog box that can use AJAX to dynamically load its contents or make a server call based on the user's decision without reloading the entire page.

![Screenshot of Adify's Network Campaigns page, which uses YUI DataTable.](/yuiblog/blog-archive/assets/adify/table.png)

**What is your approach to integrating YUI with ASP.NET?**

One of the biggest benefits of ASP.NET is the ability to encapsulate common behaviors or widgets into highly reusable custom server controls. The control developer becomes intimately familiar with YUI while the page developer merely needs to learn how to use the custom ASP.NET control. We wrap all the YUI widgets we use with a custom control that inherits from [WebControl](http://msdn.microsoft.com/en-us/library/system.web.ui.webcontrols.webcontrol.aspx). The control is responsible for rendering the required markup and registering YUI scripts. For instance, if I wanted to put a ColorPicker that defaults to red on my .aspx page, all I would write is:

```
<Adify:ColorPicker ID="myPicker" Color="#ff0000" runat="server" />
```
![Screenshot of Adify's ColorPicker implementation.](/yuiblog/blog-archive/assets/adify/colorpicker.png)

Then in my server side code-behind file, I can just get or set myPicker.Color to use it. Here is a more complicated example of how we could use a DataTable in an .aspx page to show clicks over time:

```
<Adify:YuiDataSource ID="LastMonthData" OnRowDataBound="OnDataSourceBound" runat="server">
<Columns>
	<Adify:YuiDataSourceColumn Name="Time" />
	<Adify:YuiDataSourceColumn Name="Clicks" />
	<Adify:YuiDataSourceColumn Name="CTR" />
</Columns>
</Adify:YuiDataSource>

<Adify:YuiDataTable DataSourceId="LastMonthData" runat="server">
<Columns>
	<Adify:YuiDataTableColumn Key="Time" Formatter="Date" />
	<Adify:YuiDataTableColumn Key="Clicks" Formatter="Number" />
	<Adify:YuiDataTableColumn Key="CTR" Label="Click Through %" Formatter="Percent3" />
</Columns>
</Adify:YuiDataTable>

```

We've created our own [custom data-bound](http://msdn.microsoft.com/en-us/library/ms366539.aspx) YuiDataSource web server control. It is responsible for serializing objects to JavaScript in the case of local data sources, or caching objects server side for XHR data sources. It renders itself in the page's HTML as a YuiDataSource and could be used by a Chart or DataTable (or both). Our YuiDataTable control [exposes a collection property](http://msdn.microsoft.com/en-us/library/9txe1d4x.aspx) called Columns which is a collection of YuiDataTableColumn objects. It serializes the Columns collection into a JavaScript array of objects passed to the DataTable constructor.

The main point here is that the custom controls are as simple as possible to use. They expose properties for any of the options YUI provides, and override the [OnPreRender](http://msdn.microsoft.com/en-us/library/system.web.ui.control.onprerender.aspx) event to render themselves as JavaScript calls to YUI. This frees up the page author to think about the logic on his page, and not the gory details of instantiating a YUI widget.

**How has YUI helped your project achieve success?**

Application developers tend to make good ASP.NET developers since they usually have a strong computer science background. Unfortunately they don't always have quite as much experience dealing with the multitude of browsers or with JavaScript (which I've learned over the years is far more powerful and complex than initially suspected).

YUI helps in several ways. First, it helps abstract away a number of browser differences, so we don't all have to know every last detail about how some obscure browser version affects our code. Second, browsing some of the samples has served as inspiration. I've even seen a Product Manager make a quick prototype using a YUI sample to explain how he wanted a feature to work.

Finally, I can't even count how many hours we've saved or how improved our interface has become thanks to all the widgets. We replaced a very basic palette chooser with the ColorPicker, ASP.NET's built-in Calendar with YUI's, and a powerful but hard-to-maintain JavaScript grid with the DataTable. In every case, we greatly increased the usability of our application while simultaneously decreasing the amount of effort spent fixing bugs in our controls.

**What have been the challenges of using YUI in your project?**

Honestly, writing JavaScript that lives up to YUI. If there is one thing that has pushed us to write better client-side code, it would be the example of YUI. We've really tried to apply the same discipline and rigor when writing JavaScript as when developing server code in C#.

**What are some YUI-related projects on your roadmap?**

We have a small internal tool written using the [Uploader](http://developer.yahoo.com/yui/uploader/) control that became very popular. We definitely want to integrate the Uploader into our main product. We're all really happy with the DataTable control, and want to start adding inline-editing where appropriate. We also need to keep up with all the great improvements to the Chart control.

We're also keeping a close eye on YUI 3 and can't wait to start seeing widgets based on the new architecture.