---
layout: layouts/post.njk
title: "YUI App Framework in Cordova"
author: "Jackson Pauls"
date: 2014-05-13
slug: "yui-app-framework-in-cordova"
permalink: /2014/05/13/yui-app-framework-in-cordova/
categories:
  - "Development"
---
[Apache Cordova](http://cordova.apache.org/) is a framework for developing cross-platform smartphone apps using HTML, CSS, and JavaScript. I recently had the opportunity to create an app for Android and iOS devices, and it was great to be able to do this using familiar web technologies.

One unfamiliar aspect, however, was building a **single-page app**. It is possible to create multi-page apps with Cordova, but you lose the program state when changing from one page to another, and a lag is introduced as assets for the new page are loaded and parsed. Fortunately using a JavaScript framework makes it relatively easy to build single-page apps, as a long-time YUI user I naturally gravitated towards [YUI's App Framework](http://yuilibrary.com/yui/docs/app/).

There is good documentation on setting up Cordova, so I won't go into that. Once set up, here's all that's needed to create a new app, using the Android platform as an example:

```
[~]$ cordova create scotchapp com.example.scotchapp "ScotchApp"
[~]$ cd scotchapp/
[scotchapp]$ cordova platform add android

```

This creates a `www` folder for the app's code:

```
[scotchapp]$ ls www/
css  img  index.html  js

```

## A Simple App

Let's make a simple test app, with all code in `index.html` for simplicity.

First we'll include [Pure](http://purecss.io/) (a set of CSS modules that play nice with YUI) and the YUI seed file:

While loading remote assets like this is okay for this sample app, I'd recommend switching to using **local copies of the CSS and JavaScript** modules once the requirements are settled: we don't want to rely on devices being connected to the Internet, or make users wait for these resources to download.

Now we can add the code for our app:

**And that's it!** We can now run the app on a connected device or an emulator:

```
[scotchapp]$ cordova run android

```

This also creates an apk file in `platforms/android/ant-build/`. If you have an Android device and would like to give it a spin, [download the apk for this sample app](http://www.jacksonpauls.com/ScotchApp-0.0.1.apk).

That was pretty easy, but when making a more complicated app there are some device quirks to be wary of: I'll cover some of those I came across next.

## Tap Lag and Ghost Clicks

On iOS and older Android devices, there is about **300ms delay** between when a user taps the screen and the `click` event is fired. This is because the device is waiting to check for a double-tap. You can get rid of this delay by adding YUI's [`event-tap` module](http://yuilibrary.com/yui/docs/event/tap.html) and listening for `tap` events rather than `click` events:

```
YUI().use('app', 'event-tap', function (Y) {
  // ...
  events : {
    'button' : {
      tap : function (e) {
  // ...

```

There is, however, a catch: **ghost clicks**. A `tap` event will fire instantly, but the `click` event will still fire after 300ms, and can even trigger an action on a new view the app has just rendered. I ended up using a transparent `<div>` with a high `z-index` to capture ghost clicks when transitioning between views, removing it after 400ms, but I can't claim that's a very elegant solution.

## Other Quirks

Cordova and YUI both support Android devices back to version 2.3, but there are some quirks. [Cordova's device detection](http://cordova.apache.org/docs/en/3.3.0/cordova_device_device.md.htm) can be used to trigger different code paths depending on what OS the device is running.

Android devices use an overlay with a list of options when a user taps a `<select>`, but Android 2.3 can **fail to detect `<select>` tags when they're added dynamically**, for example when rendered in a `Y.View`. I ended up using `<radio>` tags on Android 2.3 devices as a replacement.

Once a `Y.View` has rendered, adding additional dynamic content with **`setHTML()`** to one of its nodes **can cause all content to disappear** in Android 2.3. For example, if data for a table in a view needs to be loaded from a remote source, it might be nice to:

-   make an AJAX request for the data,
-   render the view,
-   update the view's table once the AJAX request has completed.

But on Android 2.3 I found I had to fetch the table data then render the view, otherwise I ended up with a blank screen when trying to update the view.

On a couple devices (HTC One X on 4.2.2 and Samsung Galaxy Note II on 4.1.1), I found that after the app had rendered its initial view, **navigating** to a new view didn't work with **transitions** enabled. Try setting `transitions: false` when initializing `Y.App` if you think you're hitting the same issue:

```
var app = new Y.App({
  transitions : false,
  // ...

```

## Closing Thoughts

Overall, YUI's App Framework and Apache Cordova make a great combination, I'd certainly use it again. If you have a team with experience building websites and want to start also making mobile apps, this might also be the right choice for you.

## Full Code Listing

_**![Jackson Pauls](http://www.jacksonpauls.com/jp.jpg)About the author:** [Jackson Pauls](https://plus.google.com/+JacksonPauls/?rel=author) is a Holistic software engineer based in Edinburgh, Scotland._