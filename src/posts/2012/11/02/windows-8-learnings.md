---
layout: layouts/post.njk
title: "Windows 8 Learnings"
author: "Tilo"
date: 2012-11-02
slug: "windows-8-learnings"
permalink: /2012/11/02/windows-8-learnings/
categories:
  - "Development"
---
Windows 8 was released last week, and here at YUI, I've spent time hacking around with building [a native Windows app using YUI](https://github.com/tilomitra/Sights/). The app is pretty simple. It gets recent and popular photos from [Dribbble](http://www.dribbble.com) and presents them in a simple master/detail interface. The idea behind this app is to:

1.  Get exposed to the WinJS API
2.  Explore what role YUI can play when developing actual apps
3.  See if I can create a template that others can use for building Win8 apps with YUI

We recently added [support for Windows 8 and IE10](/yuiblog/2012/10/17/yui-3-7-3-windows-8-apps-and-ie-10/ "YUI 3.7.3 – Windows 8 Apps and IE 10") in YUI 3, so everything works great out of the box. However, JavaScript developers who want to get started with native Win8 development may face a few obstacles. In this post, I talk about the obstacles that I faced, and offer solutions around them.

### Including YUI in your WinJS Project

One of the restrictions placed on native Win8 apps written in HTML/CSS/JS is that they can't have references to external scripts or stylesheets. This means your scripts, stylesheets, and libraries - such as YUI 3 - have to be packaged locally. There are a few options available when it comes to locally including YUI 3:

1.  Cloning and including the entire yui3 repo (build/ and src/)
2.  Cloning the yui3 repo but only including build/
3.  Using the [Configurator](http://yuilibrary.com/yui/configurator/) to only include the modules that you need

I discounted Option 3 early on because it included several manual steps, was not very scalable if my dependencies changed, and did not allow for an easy way to keep up with library updates. Using the configurator required me to download the JavaScript files that were provided and manually add them to the project. The advantage of this method is the reduced file size, but it wasn't easy to use. Option 1 and 2 both rely on cloning the library, which is useful since you can fetch recent versions as they become available. However, including the entire library is unnecessary and radically increases application size (by > 100mb). Instead, I went with Option 2 (including just the `build/` directory), which is about 30mb. This allowed me to include the YUI seed file (more on that below) and pull down modules using `YUI().use(' ... ')`, as I would normally. Note, that if you need to use gallery modules, you'll need to pull those down as well. In that case, it's not worth it to pull down the entire yui3-gallery repo; just pull in the individual modules.

### Including the seed file

WinJS apps have a single-page navigation model. By default, every app has a `default.html`, which loads `default.css` and `default.js`. The `default.html` acts as a "wrapper" for all views within the app, and does not possess any UI. Similarly, `default.js` possesses general start-up code, not app-specific logic.![](/yuiblog/wp-content/uploads/2012/11/default-wrapper.png "default-wrapper")

Since `default.html` acts as a "wrapper" for all views, I included the YUI seed file in there instead of having to include it in every view. Additionally, I had a `YUI_config` variable defined with a path to all custom modules that were being loaded. [Here's what it looks like](https://github.com/tilomitra/Sights/blob/master/Sights/default.html). Adding the [`YUI_config`](http://yuilibrary.com/yui/docs/yui/#yui_config) makes my other `YUI().use(...)`statements much cleaner, and provides a single place for me to refer to for all custom modules.

### MVC and re-using code

As mentioned above, `default.html` acts as a wrapper around all views. By default (if you create a new app from a template), this file also has a reference to a JS file with some **model**\-data that is persistent across views. Each **view** within the app consists of an HTML file with optional CSS and JS files. I consider the CSS/HTML files to be view-related code and the JS file to be a **controller** for that given view. You can [take a look at my code](https://github.com/tilomitra/Sights/tree/master/Sights/pages/itemDetail) to see what these files look like, and how relationships are defined. So breaking it down, WinJS has:

-   A JavaScript file in default.html that is persistent across views.
-   Multiple views, where each view is represented by an HTML file with its own CSS and JS. The JS acts as the "controller" for the view.

#### Re-using Y.Model Code

One of the benefits of leveraging YUI is that code can be reused across environments. This is true here as well. When I started my app, I noticed that the sample model JS leveraged a lot of WinJS specific APIs. To me, a model should represent data irrespective of its environment, so I wrote my own models. I sub-classed [Y.Model](http://yuilibrary.com/yui/docs/model/index.html) and [Y.ModelList](http://yuilibrary.com/yui/docs/model-list/) from the YUI App Framework. Check out the code for my models, [ShotList.js](https://github.com/tilomitra/Sights/blob/master/Sights/js/ShotList.js) and [Shot.js](https://github.com/tilomitra/Sights/blob/master/Sights/js/Shot.js). These models have no Windows 8 specific code and are responsible for retrieving images from YQL. I instantiate these models and set them to a WinJS GridView in [ydata.js](https://github.com/tilomitra/Sights/blob/master/Sights/js/ydata.js), but am hoping to clean that code up more. More on that below.

#### Re-using Views

When it comes to views, there are a few options. You can either use WinJS APIs for native views, such as ListView, GridView, etc., or use HTML/CSS to make your own views. There is no performance hit of making your own views as opposed to leveraging the native APIs, that I know of, since the native APIs are still manipulating the DOM under-the-hood. When you consider this, it may be worth it to take some time to construct your own views just because you'll be able to re-use that code in other environments, if needed. A good example of this is in the Detail view for my Dribbble app:![](/yuiblog/wp-content/uploads/2012/11/sights-detail-med.png "sights-detail-med")

Although it looks like a Metro interface, I'm not using any WinJS views. It's just standard elements with my own CSS. YUI makes this easy with `Y.View`, interacting with a `Y.Model` or `Y.ModelList`. It's definitely an option to consider, especially since the APIs for regular WinJS views are a little tricky to understand (at least they seemed that way for me).

**An added benefit:** One of the advantages in this environment is that Microsoft includes a `ui.css`file in every page, so simply writing regular HTML automatically conforms it to reflect the Windows 8 UI style. Unlike in iOS, where you have to "mock" the native UI through a lot of detailed CSS, in WinJS, it just works. This makes it easy to write your own views.

#### Querying for data

We've done a bunch of work in YUI3.7.3, and one of them was to get [YQL](http://yuilibrary.com/yui/docs/api/modules/yql.html) working in this environment. In WinJS, the `yql-winjs` module is conditionally loaded and uses XHR with CORS to communicate with YQL. All this happens under the hood and just works. I use YQL to query for data in [`Y.ShotList`](https://github.com/tilomitra/Sights/blob/master/Sights/js/ShotList.js).

### Debugging

Although not YUI-specific, debugging can be frustrating in a new environment such as this. Luckily, Visual Studio has a few tools we can leverage:

-   It's pretty easy to set breakpoints. The console in Visual Studio helps with checking values, viewing the call stack, etc.
-   Visual Studio comes with a [Windows Simulator](http://blogs.msdn.com/b/visualstudio/archive/2011/09/29/first-look-at-windows-simulator.aspx), which simulates a WinRT touch device (very similar to iOS Simulator). You can build and run your app on the simulator by choosing "Simulator" instead of "Local Machine" as the build target.
-   If the app is running in the simulator, you can view the DOM at any time by using the [DOM Explorer](http://msdn.microsoft.com/en-us/library/windows/apps/hh441474.aspx#InteractiveDebugging). This is found in Debug > Windows > DOM Explorer.

Leave any other debugging tips in the comments!

### Still discovering things

This is a new environment, and I'm figuring things out as I build a real app. The good news is that all of the principles we apply in front-end engineering can be used here as well. Using YUI was a no-brainer for me since it allows me to write modular code that is not Windows-specific - at least not all of it. If Windows 8 development interests you, you should come to [YUIConf](http://lanyrd.com/2012/yuiconf) where I'll be talking more in depth about building native Win8 Apps with YUI.