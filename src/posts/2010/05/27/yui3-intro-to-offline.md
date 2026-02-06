---
layout: layouts/post.njk
title: "An Introduction to Using YUI 3 in Offline Applications"
author: "Alexander Kessinger"
date: 2010-05-27
slug: "yui3-intro-to-offline"
permalink: /2010/05/27/yui3-intro-to-offline/
categories:
  - "Development"
---
_**About the author:** Alex Kessinger works as a front-end engineer at Yahoo! Past working as a front-end, he enjoys working on the entire stack. He also spends a lot of time reading, curating, and writing about the internet, social media, and building websites. You can find all of it at his website [alexkessinger.net](http://alexkessinger.net). You can also find him on twitter [@voidfiles](http://twitter.com/voidfiles)._

I could say that HTML5 is building steam, but that time is passed: HTML5 is here. Mobile is already huge, WebKit is growing rapidly, and the number of people who will have an HTML5-capable browser on their phone and/or laptop over the next few years will create a "new normal" in which HTML5 capabilities are the standard.

One of the awesome features in HTML5 is the [Application Cache](http://www.w3.org/TR/offline-webapps/#offline), which gives websites the ability to tell the browser which files to cache and to use the cached files when the browser doesn't have a network connection. You can use the Application Cache to ensure that a user will be able to access at least part of your app while he is offline. In the case of devices like phones or tablets (or even old-fashioned devices like laptops), this could mean that your users are able to use your app while on an airplane. Meanwhile, you get to continue building your app with web technologies rather than learning Objective-C.

Besides the [Application Cache](http://www.w3.org/TR/offline-webapps/#offline), there are also other APIs available in HTML5 that give web developers the tools to create useful offline experiences. There are two persistent storage APIs available in most newer browsers. One is a simple key/value data store, called [localStorage](http://dev.w3.org/html5/webstorage/#the-localstorage-attribute). The second is a [SQL database](http://www.w3.org/TR/offline-webapps/#sql). Both can be leveraged while the user is offline.

With these concepts in mind, I'm going to explore the evergreen "To Do list" application, using it as a springboard to look at how we can leverage the Application Cache and persistent storage in an app that builds upon everything we love about YUI 3, including the YUI 3 Gallery.

## Markup

Markup is always a great place to start when building anything related to the web. The basic shell of our HTML5 page:

```
<!DOCTYPE HTML>
<html
<head>
    <title>YUI ToDo</title>
    <link rel="stylesheet" href="base.css" type="text/css" media="screen" title="no title" charset="utf-8">
</head>
<body class="yui-skin-sam">
    <script src="yui-min.js"></script>
    <script src="base.js"></script>
</body>
</html>

```

Although we're building an offline-ready application, follow best practice but putting CSS in the head, and Javascript just before the closing body tag. Even if your page is going to be available offline, the initial page load should be responsive. (Note that we're using the awesomely simple HTML5 doctype here.)

The app needs some placeholder markup:

```
<!DOCTYPE HTML>
<html>
<head>
   <title>YUI ToDo</title>
   <link rel="stylesheet" href="base.css" type="text/css" media="screen" title="no title" charset="utf-8">
</head>
<body class="yui-skin-sam">
    <div id="doc3">
        <div class="hd">
            <h1>ToDo App</h1>
            <a class="callout" href="http://alexkessinger.net" target="_blank">by Alex Kessinger</a>
            <div class="item_entry">
                <form class="entry_form">
                    <input type="text" name="todo_item_input" class="todo_item_input">
                    <p class="toRight"><a class="addItem" href="#add">Add</a></p>
                </form>
            </div>
        </div>
        <div class="bd">   
            <div class="yui-main">
                <div class="yui-b">
                    <div class="todo_items">
                        <h2>Todo Items</h2>
                        <ul>
                            <li class="no_items">Fetching ToDo Items ...</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="debug"></div>
        <!-- Initialization process //-->
        <script src="yui-min.js"></script>
        <script src="base.js"></script>
    </div>
</body>
</html>

```

This will let the user know we're planning on getting some data for them when they first load the app. It also sets up our stage, a DOM structure for our Javascript to start working with.

### A Note About Progressive Enhancement

There is no reason that an application can't be built with principles of progressive enhancement and still made available for offline use. In this exploration, I'm omitting the additional complexity that would be involved in PE in order to focus as much as possible on the techniques required for offline support. Some might criticize that approach, and I'm sympathetic to that argument.

### Additional Properties for Handling mobile devices

iPhoneOS and Android browsers can handle most webpages without any special attention, but when dealing with mobile devices it's worth investigating how the content gets squeezed to fit on the smaller screen. Quirksmode has not [one](http://www.quirksmode.org/blog/archives/2010/05/a_tale_of_two_v.html) but [two](http://quirksmode.org/mobile/viewports2.html) in-depth articles on viewport that are well worth your time.

Briefly, there is a meta tag, called viewport. It looks something like this:

```
<meta name="viewport" value="">

```

The goal of the viewport tag is to help mobile browsers figure out how to display a really big webpage on a small screen. Mobile devices need help because most devices try to squeeze 700-1100px of content onto a 300-500px screen. Also, when we set our widths at 100%, the browser takes its best guess at how big the webpage should be, and then scales it from that big to fit inside the size of the device.

To help we could set the viewport to this.

```
<meta name="viewport" value="width=device-width">

```

This will tell the device to set the width of our page to the width of the device's screen. If we make sure our page is fluid, then our page will fill the screen on most mobile devices. This also means that if the phone has a landscape mode the page will expand to fill the extra space.

There are other things we can do to the viewport as well. If you have worked with mobile browsers, you know they allow you to zoom. If you are taking to time to build a website to fill the whole screen you may not want a user to be able to zoom. If we set our viewport to be something like the following, the user won’t be able to zoom in, or out. On a device like the iPhone this may make it feel more native. But if you do this, make sure that the content of your app gives the user no reason to ever want to zoom (e.g., small text); otherwise, this will be a frustrating usability constraint.

```
<meta name="viewport" value="width=device-width,user-scalable=no">

```

The viewport is not a W3C standard, but is a common convention. It's currently supported by WebKit browsers on the iPhone and Android operating systems. [Fennec](http://limpet.net/mbrubeck/2010/05/11/fennec-meta-viewport.html), the Mozilla mobile browser, will probably also support this convention.

## CSS

More then ever, using CSS's ability to be fluid and dynamic is important. When looking at the broad range of phones, tablets, and other small screens, developers of applications need to be aware that our apps are going to be used on a plethora of devices. Even though there is no magic wand we can wave to make everything just work, for most applications we may not need to be pixel perfect on every device. Just following best practices can take us most of the way to support the most devices.

Starting with setting the width of our app at its base in % is a great start. Using em’s to set font-sizes is also helpful because ems are calculated based on the rendered webpage. Another thing that helps is to make sure that you base column widths on percentages as well. Even column gutters can be set in em’s.

A great place to start, without having to do a lot of work is a CSS framework. [YUI 2 Grids CSS](http://developer.yahoo.com/yui/grids/ "YUI 2: Grids CSS") is naturally one of our favorites, and it helps us think of our page in terms of ratios instead static-width blocks.

So building off YUI 2 CSS Grids here is the starting CSS for my app.

```
.todo_items {
    padding-top:1em;
}
 
.todo_items ul{
    padding:0;
    margin:0;
}
.todo_items ul li {
    margin:.125em 0 .5em 0;
    padding:.125em 0 0 0;
    border-top:1px solid #ccc;
    list-style:none;
    display:block;
    word-wrap: break-word;
    text-wrap: suppress;
}
 
.toRight{
     text-align:right;
}
 
.yui3-console {
     text-align:left;
     margin-left:10px;
}
 
body h1 {font-size:200%;}
body h2 {font-size:150%;}

```

## Javascript

Next up for our offline to-do application is the JavaScript. First download [yui\_min.js](http://yui.yahooapis.com/3.1.1/build/yui/yui-min.js) to your document root, and add it to the markup like we have above. Then put this in your `base.js` file:

```
YUI().use('node', function (Y) {
    Y.one(".todo_items h2").setContent("I am flying");
});

```

Besides Node, I am also going to include the [YUI 3 CSS Reset](http://developer.yahoo.com/yui/3/cssreset/ "YUI 3: CSS Reset") and YUI 2 CSS Grids. I'm going to include a module from the [YUI 3 Gallery](http://yuilibrary.com/gallery), Ryan Grove's excellent [Storage Lite](http://yuilibrary.com/gallery/show/storage-lite), that will wrap all the possible local data storage methods in to one easy-to-use API.

```
YUI().use('cssreset','yui2-grids','gallery-storage-lite','node', function (Y) {

  // TO-DO LIST APPLICATION CODE

});

```

**Note:** I'm not going to dive into the to-do list code, nor into some of the techniques I'd use to make it easier to debug this sort of project on mobile devices. You can find all of that on github: [yui3-todo](http://github.com/voidfiles/YUI3-ToDo). Inside `base.js` you'll find the entirety of the app. You can also see the app up and running at [http://html5.alexkessinger.net/yui/ytodo/](http://html5.alexkessinger.net/yui/ytodo/). Here, I'm going to focus on the steps necessary to enhance this simple app with offline capabilities.

## Cache Manifest

The first step to taking a web app offline is the [Application Cache](http://www.w3.org/TR/offline-webapps/#offline). The Application Cache can tell your browser what files you want to download and keep offline. In this example, I know I want to keep my JavaScript and my CSS offline, as well as the main HTML page for the app. With that in mind, my cache manifest will look like this:

```
CACHE MANIFEST
 
index.html
base.css
yui_min.js
base.js

```

Some things to note about the cache manifest.

-   It must start with the line `CACHE MANIFEST`.
-   You must serve it with a Content-Type header of text/cache-manifest

If you are on Apache, you can add the following snippet to `.htaccess` to get the right content type.

```
AddType text/cache-manifest .manifest
```

With that in place, any file with a `.manifest` suffix will be served with the `text/cache-manifest` Content-Type header.

Next we need to inform the browser of the cache manifest, to do that we add an attribute to our HTML tag:

```
<html manifest="todo.manifest">

```

Now if you go to your page in a browser that supports offline apps you will probably see a notification stating that this webpage is requesting offline access.

## Offline / Online

With the manifest in place telling our browser what resources to cache, we're ready to think about what happens in online mode versus offline mode. There are now two "boot sequences," the first being the full online sequence that we already have (and during which resources are cached for offline use). This online sequence uses the Yahoo CDN to load the files, and the files are combo-handled so we have only a few HTTP requests.

But we are also building an offline boot procedure. We need to be able to detect the fact that the browser is offline and then initialize YUI properly to draw from cached resources.

```
var online = (navigator.onLine) ? true : false;
```

Now, we just need to choose a configuration object based on being offline, or online.

```
var YUI_ONLINE_CONF = {},
    YUI_OFFLINE_CONF = {
        base: "yui3/build/",
        combine:0,
        groups: {
            gallery: {
                base:'yui3-gallery/build/',
                patterns:  { 'gallery-': {} }
            },
            yui2: {
                base: '2in3/dist/2.8.0/build/',
                patterns:  { 
                    'yui2-': {
                        configFn: function(me) {
                            if(/-skin|reset|fonts|grids|base/.test(me.name)) {
                                me.type = 'css';
                                me.path = me.path.replace(/\.js/, '.css');
                                me.path = me.path.replace(/\/yui2-skin/, '/assets/skins/sam/yui2-skin');
                            }
                        }
                    } 
                }
            }
        }
     },
     ONLINE = (navigator.online) ? true : false; 
     CURRENT_CONF = (ONLINE) ? YUI_ONLINE_CONF : YUI_OFFLINE_CONF;
 
YUI(CURRENT_CONF).use('cssreset','yui2-grids','gallery-storage-lite','node', function (Y) {
    ...
});

```

The `YUI_OFFLINE_CONF` configuration might need some explanation. First, I am changing the base to my document root + `yui3/build/`. I have posted the full distribution of YUI 3 to my server because the W3C spec states that the offline cache has a strict single origin policy. _All cached resources must come from the same domain as does the manifest._ As a result, I can't rely on Yahoo! or Google or any other CDN to serve my files -- all of them must be available for caching from my server.

The next part, `combine:0`, tells the YUI loader to not automatically combo the files, because I don’t have a [combo-handler](http://blog.davglass.com/files/yui/combo/) installed on my own server.

Finally, I want to mention the `groups` config. [Groups](http://developer.yahoo.com/yui/3/examples/yui/yui-loader-ext.html) is a new feature in YUI 3.1.1 that allows you define whole groups of files that come from the same place. You can also configure them to be combo'd from the source. I set up the YUI 3 Gallery here to load from a local copy I have of the yui3-gallery repository on GitHub.

When we are online, we can bootstrap from the Yahoo CDN, but offline we need to have local copies of the files. This is easy to do. You can either download the files needs in a big zip file to your directory:

```
cd docroot;
wget http://yuilibrary.com/downloads/yui3/yui_3.1.0.zip;
unzip yui_3.1.0.zip;
mv yui yui3;
wget http://download.github.com/yui-yui3-gallery-gallery-2010.05.19-19-08-0-g2a49f06.zip;
unzip yui-yui3-gallery-gallery-2010.05.19-19-08-0-g2a49f06.zip;
mv yui-yui3-gallery-2a49f06 yui3-gallery;
wget http://download.github.com/yui-2in3-yui-2in3.3-0-gdf09025.zip;
mv yui-2in3-yui-2in3.3-0-gdf09025 2in3;

```

Or you can clone the git repositories from github directly if git is installed on your machine:

```
cd docroot;
git clone git://github.com/yui/yui3.git yui3;
git clone git://github.com/yui/yui3-gallery.git yui3-gallery;
git clone git://github.com/yui/2in3.git 2in3;

```

For testing purposes. I will sometimes set `ONLINE = false` and check how my site loads. If you do that, and then visit your app in a normal browser, you can see each file that needs to be included individually. To properly fill out our cache manifest, you need to take note of each file being pulled in, using something like Firebug. Then in your cache manifest you will list each file one by one. It will look something like this.

```
CACHE MANIFEST
# A comment
index.html
base.css
base.js
yui-min.js
yui3/build/loader/loader-min.js
yui3/build/widget/assets/skins/sam/widget.css
yui3/build/console/assets/skins/sam/console.css
yui3/build/oop/oop-min.js
yui3/build/event-custom/event-custom-min.js
yui3/build/intl/intl-min.js
yui3/build/console/lang/console.js
yui3/build/attribute/attribute-min.js
yui3/build/event/event-base-min.js
yui3/build/pluginhost/pluginhost-min.js
yui3/build/dom/dom-min.js
yui3/build/node/node-min.js
yui3/build/event/event-delegate-min.js
yui3/build/event/event-focus-min.js
yui3/build/base/base-min.js
yui3/build/classnamemanager/classnamemanager-min.js
yui3/build/widget/widget-min.js
yui3/build/substitute/substitute-min.js
yui3/build/console/console-min.js
yui3/build/cssreset/reset-min.css
2in3/dist/2.8.0/build/yui2-grids/yui2-grids-min.css
yui3-gallery/build/gallery-storage-lite/gallery-storage-lite-min.js
yui3/build/json/json-min.js
startup.png
icon.png

```

At this point we can go all the way offline. If you have an iPhoneOS or Android device (or any HTML5-capable browser) you can now visit your webpage, let it finish loading, and then reload the page with the device's internet access disabled.

## iPhone-Specific Goodies

The iPhone affords the WebApp developer the ability to give your app some space on the home screen just like all other apps. You can even have a glossy icon and startup screen as you'd have with a "native" application. First, you need to follow the [specs](http://developer.apple.com/safari/library/documentation/appleapplications/reference/safariwebcontent/ConfiguringWebApplications/ConfiguringWebApplications.html) for the icon and startup screen. And then you can add the following `meta` tags:

```
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="white" />
<link rel="apple-touch-icon" href="icon.png"/>
<link rel="apple-touch-startup-image" href="startup.png" />

```

The first two tags tell mobile Safari that your web page is a HTML5 WebApp and that you wan the color of the status bar at the top to be white. This will also remove all the navigation chrome around browser window. The second two tags point to the files you want to use for your icon and startup screen.

## What’s Next

The HTML5 spec is still a moving target. Keep an eye out for new developments. That said, even today there are fantastic new capabilities in modern browsers. As you can see from this tutorial, it's not hard to take a web application offline, dramatically increasing it's potential usefulness. And, when you go offline, don't hesitate to take YUI 3 with you, along with all the power you're accustomed to from the YUI 3 Gallery and the YUI 2 widget family.