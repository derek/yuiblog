---
layout: layouts/post.njk
title: "Windows 8 Loves YUI"
author: "Jeff Burtoft"
date: 2013-03-12
slug: "windows-8-loves-yui"
permalink: /2013/03/12/windows-8-loves-yui/
categories:
  - "Development"
---
You get a lot for free when you use YUI. Benefits like componentization, scalability, prebuilt widgets, app framework and my personal favorite, cross browser support. YUI was doing polyfills before polyfills were even a thing. In our world of modern browsers and experimental implementations of HTML5 features, YUI normalizes the APIs you call to be sure that your code always works, even when browsers don't.

It was no surprise to me that YUI turned out to be an awesome tool for building Windows 8 Apps. I’m not talking about web apps (although that works great too), I am referring to Windows 8 Store apps. Along with Windows 8, Microsoft developed this kick-butt new development environment that lets developers write code in the languages they already know and love. One of the most popular of those is HTML5 and JavaScript. That’s right JS enthusiast, you can use web technologies like HTML5, CSS, and JavaScript to write Windows Store apps. This isn’t a native wrapper for a webview; this is a first class HTML5/JavaScript app. Windows 8 Apps use the same rendering engine and same JavaScript engine as IE10, so you can pull in your favorite JavaScript library to build your app. My favorite library has always been YUI, so my goal was to transform a YUI app into a Windows 8 App. Much to my surprise, nothing really needed to be "transformed." YUI not only worked well inside the app, it worked seamlessly. So this is my story. A love story really, of how Windows 8 Loves YUI.

### What You Need

If you're a YUI developer, you probably know how this all works. If you are able to use the Yahoo CDN, then there is very little barrier to entry to using YUI. You basically have two simple steps.

**Step 1: Add the YUI seed to your page.**

**Step 2: Start a new instance.**

Pretty Simple. Now for our example. We’ll be running code in the local context of our app, so we can't load our JS libraries from a CDN. It has to be packaged with the app. To accomplish this we use a tool provided by the YUI team, called [the YUI Configurator](http://yuilibrary.com/yui/configurator/). The Configurator will be used to determine what JS files we want to add to each of our pages. Also, you’re going to need a local copy of the library as well, so clone that from [GitHub.com](https://github.com/yui/yui3).

For the Windows 8 App, you’ll need a copy of Visual Studio 2012. There is the powerful commercial version of Visual Studio called Visual Studio Ultimate edition, but if you're only building a Windows 8 App, then [Visual Studio Express for Windows 8](http://www.microsoft.com/visualstudio/eng/products/visual-studio-express-for-windows-8) is the perfect tool and it carries the impressive price tag of FREE. Visual Studio 2012 has Windows 8 as a system requirement, so by default you need to be running on a windows 8 machine (or VM) as well.

### Shoot, a Duck

Let’s dive right into this. I found an entertaining little example from the YUI library that takes me back to my days of being raised by circus folk. It's a [duck shooting game](http://yuilibrary.com/yui/docs/node/ducks.html) that illustrates the use of NodeList. I basically want to pull this sample right off the library and dump into a Windows 8 App. If I turn around and sell this in the store for $2.99, I think I'll be well on my way to my first million.

So let’s get our environment up and running. Open up Visual Studio and under file, start a “New Project” which will present you with some options:

[![](/yuiblog/wp-content/uploads/2013/03/win8_001-300x207.png "click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_001.png)

If you look inside the templates tree, you’ll see options for a number of different languages. We're going to use "JavaScript" so we are working in a pure HTML5/JavaScript environment. Start simple by choosing a "Blank App," give it a name and hit "Ok."

Let's take a look at what's now in front of you.

[![](/yuiblog/wp-content/uploads/2013/03/win8_002-300x181.png "click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_002.png)

For web developers this should be a familiar landscape. In addition to some app-specific files (manifest, reference libraries), you have a few key components: default.html, default.css and default.js. These are generated files that are already set up to take advantage of the WinJS library. WinJS has a powerful feature set that can be used right alongside of YUI, but in this case, our app is already written in YUI so we’ll just put it aside.

I want to make sure we’re clear that your YUI code is just going to work. So we're going to take the code sample directly from the YUI library and run it in the app just as we would in the browser. Let's get started by finding our code example from the YUI library: [http://yuilibrary.com/yui/docs/node/ducks.html](http://yuilibrary.com/yui/docs/node/ducks.html)

[![](/yuiblog/wp-content/uploads/2013/03/win8_003-300x204.png "Click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_003.png)

On this page scroll down to the full code example, select it and copy. Now let's switch back to Visual Studio and go to our default.html file. Go ahead and delete the contents of the page and paste in your code sample. This gives you your HTML,CSS, and JavaScript, but not the images. Remember we're working in a local context here, so you'll need to copy your images over to the sample page as well. Just paste them into the "images" folder of your solutions explorer.

At this point there is one BIG thing missing. YUI. We need to load YUI into your app as well. Let's go over to github and clone a copy of the library. From the repo, copy the "build" directory and then head back to the solutions explorer in Visual studio and paste it into the "js" folder of your app.

[![](/yuiblog/wp-content/uploads/2013/03/win8_004-300x187.png "Click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_004.png)

That wasn't hard at all, but you're probably already prepping to jump to your feet and point out a tragic error that I haven't considered. When you use the YUI CDN along with the Loader, you get a magical file concoction that loads all the proper files for you based on your "YUI requires statement." Since we aren’t using the CDN, we don’t get that magic. The good news is, YUI's got a tool for that. It's called the YUI Configurator and it's pretty snazzy too. Let's quickly review our `use()` statement in our sample, and you will see that we are using two library components.

`YUI().use('transition', 'button', function (Y) {…`

In the Configurator we'll select those two components from the list of components. There are a few other settings we can update to make our life easier. First, make sure you have the box unchecked to load separate files, not combined files. Next, you can update your root path. In this case, we will update it to "/js/build" since that is where the files will be in our app. Once you have these settings in place, you should have a nice list of files that we need to load into our DOM in order to have our demo function.

Let’s paste that into the header of our default.html file. Now save that file, and then run the app.

Voila! Your demo game is running inside a Windows 8 App just as it was in the browser, only now as a local app.

[![](/yuiblog/wp-content/uploads/2013/03/win8_005-300x193.png "Click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_005.png)

Dropping a YUI app right into a Windows 8 Store app is pretty awesome from a development point of view, but it doesn't quite look like the money maker I want it to be. To dress it up a little, I’m going to add a few lines of CSS.

And now my YUI sample is a Windows 8 gem.

[![](/yuiblog/wp-content/uploads/2013/03/win8_0061-300x193.png "Click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_0061.png)

### Upgrade to Multi-touch

Before we go release this to the market, let’s make a few minor updates. I think this app will be more fun if it’s multi-touch. I should be able to knock down two, three, or even four ducks at once if I can. With IE10, Microsoft has introduced a new specification for dealing with inputs. It's called the [Pointer Events](http://blogs.msdn.com/b/ie/archive/2011/09/20/touch-input-for-ie10-and-metro-style-apps.aspx) Specification, and right now there’s a [Working Group in the W3C](http://www.w3.org/2012/pointerevents/) pounding out the details on this spec. You can think of Pointers as a normalization for all the popular screen inputs (mouse, touch and pen). The beauty of pointer events is that we as developers don't have to write one set of code for touch and another set of code for mouse. We write for pointers, and it just works across all three input types.

If you know how to use mouse events, then you know how to use pointers. Pointers produce event objects that are structures just like the parallel mouse event objects, except the event object contains a range of new data like pointer type, width and height. Pointers inherently support multi-touch. In the case of two fingers on the screen, any events triggered will fire once for each touch point. With this knowledge, let's update our YUI delegate event to be a pointer instead of a click.

`Y.one('.duck-row').delegate('click', duckClick, 'li');` To this.

`Y.one('.duck-row').delegate('MSPointerUp', duckClick, 'li');` Since pointer events are structured just like mouse events, our same code is just going to work. No other changes are necessary to make this a multi-touch app. One more quick addition. I want to make sure that when I use more than one finger it doesn't try to zoom the app in and out, since it may see it as an expansion on a touch interface. Let's add this CSS to the app.

This blocks the default touch behavior and gives full control to my delegate. Now let's give it a try.

[![](/yuiblog/wp-content/uploads/2013/03/win8_007-300x193.png "Click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_007.png)

### Accessing Windows APIs with YUI

One of the great things about being inside of a Windows 8 Store app is that you now have access to a whole range of Windows APIs. There are a lot of platform-specific features you can include, one of which is the share contract. The share contract allows you to share data between apps. In our case, we want to define what data will be passed to other apps when the user engages the share charm (part of the Windows 8 charms bar). In this case, I'm going to go into my YUI `use()` statement and add just a few lines of JavaScript.

We set up a listener here for an event called "datarequested" in which we set properties of our data object. At this point every app has declared (through the app manifest) what type of data can be shared to it. In this method, we are simply declaring what data we are going to share. Now when we reload our app and select the share charm from our charm bar, you’ll see a list of apps appear that are able to handle this type of shared content.

[![](/yuiblog/wp-content/uploads/2013/03/win8_0082-300x193.png "Click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_0082.png)

I’ll select the mail app and you can see how this data will be shared.

[![](/yuiblog/wp-content/uploads/2013/03/win8_009-300x193.png "Click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_009.png)

More information about the share contract and other [Windows APIs can be found here](http://msdn.microsoft.com/en-us/library/windows/apps/hh464906.aspx).

### YUI Everywhere

Now that we've completed our Windows 8 App, let's keep going with YUI and push this cool little app to the rest of the Windows stack. Since this is just JavaScript and HTML5, my code is going to work in any environment that supports modern web technologies. This same code that runs in my Widows 8 app, is going to work back in the browser as well. The value doesn’t stop there. Windows Phone 8 has a great webview that runs our YUI app as well.

While we’re at it, wouldn't you like to port your game to the Xbox? The Xbox now has the Internet Explorer browser, so fire up the web version of your app, and play duck shooter right on your Xbox. Choosing YUI helps you get your app everywhere:

[![](/yuiblog/wp-content/uploads/2013/03/win8_010-300x193.png "Click to expand")](/yuiblog/wp-content/uploads/2013/03/win8_010.png)

### Success!

We’ve built a Windows 8 Store app using our favorite JavaScript library, YUI. To summarize this whole experiment in a few words, "it just works." YUI works inside my Windows 8 Store app just as it would inside a browser, and I want to help you bring your YUI apps to Windows 8 as well. Use the skills you already have, and the code investments you’ve already made. It doesn’t stop at YUI, Windows 8 Apps are built on the engines that run IE10, so bring your favorite JavaScript library, your favorite YUI component or your favorite web app and go "Native" with Windows 8.

### More Information

By popular demand, the author has created a [github repo](https://github.com/boyofgreen/YUIWin8Duck) of the code examples used in this blog post. You can also catch a video of this blog post as well as it's [related post](http://www.html5hacks.com/blog/2013/03/10/build-a-windows-8-app-with-yui/) on [Channel 9](http://channel9.msdn.com/posts/Title-Build-Windows-8-Apps-with-YUI) or you can watch it below.

<iframe frameborder="0" scrolling="no" src="http://channel9.msdn.com/posts/Title-Build-Windows-8-Apps-with-YUI/player?w=512&amp;h=288" style="height:288px;width:512px"></iframe>

![](/yuiblog/wp-content/uploads/2013/03/jeffburt-150x150.png)_**About the author:** Jeff Burtoft (@boyofgreen) Jeff Burtoft is as an HTML5 Evangelist for Microsoft and an avid supporter of the JavaScript/HTML5 community. Being in the Web Development community for over 10 years, his job title has morphed from the likes of "Web Master" to “Front End Engineer” and everything in-between. Jeff is a huge proponent of web standards, and loves all programing languages, as long as they are JavaScript. Additionally, Jeff is co-author of HTML5 Hacks (O’Reilly Media) and is a founding blogger of html5hacks.com. Jeff lives in Bellevue, WA with his wife and three children._