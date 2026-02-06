---
layout: layouts/post.njk
title: "YUI 3.7.3 - Windows 8 Apps and IE 10"
author: "Eric Ferraiuolo"
date: 2012-10-17
slug: "yui-3-7-3-windows-8-apps-and-ie-10"
permalink: /2012/10/17/yui-3-7-3-windows-8-apps-and-ie-10/
categories:
  - "Releases"
---
[Windows 8](http://windows.microsoft.com/en-US/windows/home) will be released in 9 days (on October 26, 2012), and **YUI is ready to power JavaScript-based Windows 8 apps!**

With Windows 8, Microsoft is now enabling developers to use web technologies to build first-class apps for the Windows platform. These apps are also distributed through the Windows Store. We wanted to make sure YUI could be used to power Windows 8 apps, and today we are releasing YUI 3.7.3 which works excellently in all of the IE 10 runtimes in Windows 8, including the native Windows Runtime (which is used by Windows 8 apps.)

**YUI 3.7.3** is now available on the [Yahoo! CDN](http://yui.yahooapis.com/3.7.3/build/yui/yui-min.js "YUI 3.7.3 Seed file") (and as a [download](http://yui.zenfs.com/releases/yui3/yui_3.7.3.zip "YUI 3.7.3 Zip file")). The [YUI Library website](http://yuilibrary.com/) has been updated with the latest documentation, including the addition of IE 10 and the Windows 8 runtimes to our [Target Environments](http://yuilibrary.com/yui/environments/).

### IE 10 Runtimes in Windows 8

Windows 8 has two main modes: **Start screen**, and **Desktop**. The Start screen mode (formerly known as Metro) is the new face of Windows, while the Desktop mode is the traditional interface. Both the Start screen and the Desktop have Internet Explorer apps powered by IE 10 runtimes, but Internet Explorer on the Start screen is more restrictive, and does not allow Flash, Silverlight, or ActiveX controls. It's also important to note that the **Start screen mode is the default** GUI in Windows 8.

Beyond the Internet Explorer apps in Windows 8, there are two other IE 10 runtimes: **WebView** and the **native Windows Runtime**. WebViews can be used in Windows 8 apps, but this environment is the most restrictive of the four. The native Windows Runtime environment has also been tightened down for security, but it provides APIs which extend its functionality and this is the environment in which JavaScript-based Windows Store apps run.

We have [more details](https://github.com/yui/yui3/wiki/Windows-8-JavaScript-Runtimes) on the four IE 10 runtimes in Windows 8 on our Wiki.

### How We Quickly Added Support for Windows 8 and IE 10

We were very confident when we set out to make YUI work in Windows 8 and IE 10. We felt that we would be able to fully identify issues, fix them, and test the fixes in a short amount of time. **We gave ourselves 10 days** (which included weekends) to get the job done. In those 10 days, we've thoroughly tested YUI in all four IE 10 runtimes, and we've made the necessary changes in this release to make sure you can use YUI to power your Windows 8 apps. We were able to meet our strict schedule and add support for all these new environments very quickly because of YUI's architecture.

We did _not_ have to package a new version of YUI for these new Windows 8 runtime environments. Instead, we followed the same patterns we've used to make YUI run on mobile devices and on Node.js. We used **YUI's powerful conditional loading infrastructure**, our **gesture/input normalization layer**, and standard environment normalization techniques to implement the changes which make YUI work in the IE 10 runtimes in Windows 8.

As an app developer you can write the same JavaScript code on top of YUI which will work on the server, desktop web, mobile web, and now in native Windows apps! This is a key advantage of using YUI.

Below are some changes in this release that we'd like to highlight:

#### Add XHR with CORS as a YQL transport

We added the [`yql-winjs`](http://yuilibrary.com/yui/docs/api/modules/yql-winjs.html) module, which is automatically used when the [`yql`](http://yuilibrary.com/yui/docs/api/modules/yql.html) module is loaded in the native Windows Runtime. One of the native Windows Runtime restrictions is not supporting JSONP, and our default implementation of our `yql` module uses JSONP as its transport. Since the native Windows Runtime supports [CORS](https://developer.mozilla.org/en-US/docs/HTTP_access_control) in XHR, and the YQL web service support CORS, we're able to use XHR with CORS as a YQL transport.

#### Enhance Gesture Normalization

YUI has had a mouse/touch gesture normalization layer for over two years — we were the first major JavaScript library to be agnostic to device-specific user inputs. Microsoft has created gesture abstractions which are present in all of the IE 10 runtimes, and YUI's gesture normalization layer will now leverage Microsoft's new `msPointer` APIs, when they're detected.

**Note:** The XHR with CORS transport is something we’ll be exploring as the YQL transport for other environments as well.

#### Support CSS3 Transitions Without Vendor Prefixes

The [`transition`](http://yuilibrary.com/yui/docs/api/modules/transition.html) module has been improved to work both with and without vendor prefixes. Enabling `Y.Transition` to not require vendor prefixes means that **IE 10 and Opera have gained support for native CSS3 Transitions**.

This change also means that [`Y.App` transitions](http://yuilibrary.com/yui/docs/api/classes/App.Transitions.html) are now supported in IE 10 and Opera as well.

#### Leverage Native XML Parsing APIs

We were able to retain YUI's XML parsing features in modules like `datatype-xml` for Windows 8 apps by leveraging the `Windows` APIs in the native Windows Runtime.

#### Add Y.UA.winjs and Y.UA.touchEnabled

[`Y.UA.winjs`](http://yuilibrary.com/yui/docs/api/classes/UA.html#property_winjs) provides a way for you to identify that your code is running in Windows 8 app on the native Windows Runtime. With this environment being restrictive, having this hook is very useful.

[`Y.UA.touchEnabled`](http://yuilibrary.com/yui/docs/api/classes/UA.html#property_touchEnabled) provides a hook to determine if the device supports touch-based gestures. The IE 10 runtimes in Windows 8 are the first environments to expose both touch _and_ mouse based gestures to the browser.

### Known Issues

After adding support for all of the IE 10 runtimes in Windows 8, there are a couple remaining known issues:

-   Any element that you wish to tap/flick on using `event-tap` or `event-flick`, requires the following CSS:
    
    ```
    #myNode { -ms-touch-action: none; }
    ```
    
    See the Event Gestures user guide for [more](http://yuilibrary.com/yui/docs/event/gestures.html#ie10-gestures-and--ms-touch-action) [details](http://yuilibrary.com/yui/docs/event/gestures.html#known-issues-in-ie10-touch-mode).
    
-   Editor will currently not function inside of the WinJS Windows 8 application environment. See the Rich Text Editor user guide for [more details](http://yuilibrary.com/yui/docs/editor/#knownissues).
    

#### Bugs Filed with Microsoft

During our testing of YUI on these new IE 10 runtimes, we've found several bugs which we've reported to Microsoft. To view the contents of these bugs, you **must** first [join the Internet Explorer Feedback Program](http://connect.microsoft.com/directory/accepting-bugs/internet/).

-   [IE10 Dynamic Script Loading Bug - async + 404s](https://connect.microsoft.com/IE/feedback/details/763466/ie10-dynamic-script-loading-bug-async-404s)
-   [Dynamically loaded scripts with 304s responses interrupt the currently executing JS thread onload](https://connect.microsoft.com/IE/feedback/details/763871/dynamically-loaded-scripts-with-304s-responses-interrupt-the-currently-executing-js-thread-onload)
-   [Win8 App/MSAppHost : Cannot set secure, valid HTML using innerHTML if it contains form fields with \`name\` set](https://connect.microsoft.com/IE/feedback/details/765964/win8-app-msapphost-cannot-set-secure-valid-html-using-innerhtml-if-it-contains-form-fields-with-name-set)
-   [\`-ms-touch-action\` does not allow a way to programmatically prevent default touch behavior](https://connect.microsoft.com/IE/feedback/details/767646/ms-touch-action-does-not-allow-a-way-to-programmatically-prevent-default-touch-behavior)
-   [IE10 doesn't support the common feature test for async support](https://connect.microsoft.com/IE/feedback/details/763477/ie10-doesnt-support-the-common-feature-test-for-async-support)

### Complete Changelog

For a complete list of changes in YUI 3.7.3, please refer to the [change history rollup](https://github.com/yui/yui3/wiki/YUI-3.7.3-Change-History-Rollup) for this release.

We spent last week documenting and re-testing these changes across all of our target environments. Using [Yeti](http://yeti.cx/), we are able to pump all 7,500+ of our unit tests to devices which are running a variety of browsers to make sure we did not introduce any regressions.

You should feel confident that upgrading to YUI 3.7.3 should be without issue, but if you find a bug, or want to suggest an enhancement, please don’t hesitate to [file a ticket](http://yuilibrary.com/projects/yui3/newticket/).