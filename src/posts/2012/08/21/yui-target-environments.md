---
layout: layouts/post.njk
title: "YUI Target Environments"
author: "Eric Ferraiuolo"
date: 2012-08-21
slug: "yui-target-environments"
permalink: /2012/08/21/yui-target-environments/
categories:
  - "Development"
---
We [recently updated](/yuiblog/2012/07/26/gbs-update-2012q3/ "Graded Browser Support Update: Q3 2012") the matrix of browsers in which YUI is tested. We decoupled the Browser Test Baseline matrix from Graded Browser Support [last year](/yuiblog/2011/07/12/gbs-update/ "Graded Browser Support Update: Q3 2011"), but today we're taking this a step further…

### Introducing YUI Target Environments

We've added a new page to our site: [**YUI Target Environments**](http://yuilibrary.com/yui/environments/). Here's the matrix of the environments which YUI currently targets:

<table class="environments"><tbody><tr><th>Internet Explorer</th><td>6.0</td><td>7.0</td><td>8.0</td><td>9.0</td></tr><tr><th>Chrome †</th><td colspan="4">Latest stable</td></tr><tr><th>Firefox †</th><td colspan="4">Latest stable</td></tr><tr><th>Safari</th><td colspan="2">Latest stable (desktop)</td><td>iOS 4.†</td><td>iOS 5.†</td></tr><tr><th>WebKit</th><td>Android 2.2.†</td><td>Android 2.3.†</td><td colspan="2">Android 4.†</td></tr><tr><th>Node.js*</th><td>0.4.†</td><td>0.6.†</td><td colspan="2">0.8.†</td></tr></tbody></table>

#### Notes:

-   † The dagger symbol (as in "iOS 5.†") indicates that the most-current non-beta version.
-   [Certain modules](http://yuilibrary.com/yui/environments/#node.js) have native Node.js support, while others are DOM dependent.

Our [Graded Browser Support](http://yuilibrary.com/yui/docs/tutorials/gbs/) page has been doing double-duty, both promoting progressive enhancement development practices and defining YUI's supported browsers. This led to confusion that the matrix was a recommendation about where your application should work. To reduce this confusion we have created a separate page, [YUI Target Environments](http://yuilibrary.com/yui/environments/), to house the matrix of YUI's target environments (both browsers and Node.js).

There's a good chance the set of environments that you're targeting for your project is either the same as or a subset of the ones YUI targets. However, we understand that the audience for each app is different; data gathered from your web analytics should be used to make informed decisions when choosing which environments you're going to target. These are engineering and business decisions which require weighing the tradeoffs—a one-size-fits-all recommendation will not account for these specifics.

### Why Does YUI Still Target IE 6 and 7?

Based on our internal browser data gathered from Yahoo!'s worldwide traffic, the percentage of users on IE 6 and 7 is still relatively high. While Yahoo!'s traffic is a great representation of general browser usage, **your app's browser usage statistics may be very different**. For a JavaScript library like YUI, it's important to target the popular and emerging environments which people are using. This way if your app needs to support older versions of IE, you can feel confident when using YUI because the library is fully tested on them. IE 6 and 7 are still popular enough to warrant YUI's continued support for these environments.

Additionally, the modular architecture of YUI supports capability-based loading for those environments which need additional code or alternate implementations of features (like old versions of IE.) This means IE 6/7-specific code will only be downloaded and executed in those environments which need it. A person using your app in the latest version of Google Chrome will _not_ incur the cost or overhead of loading code needed for old versions of IE. Capability-based loading is seamless and will be taken care of for you—it's baked into YUI's core.

### Node.js

The environments which YUI targets are not all browsers. YUI is tested in and designed to work in a [Node.js](http://nodejs.org/) server environment. Over the past year, [a lot of work](http://yuilibrary.com/yui/docs/yui/nodejs.html "YUI on Node.js") has been done in YUI to target Node.js as a first-class environment.

It's important to note that YUI support in Node.js is on a module-by-module basis. Node.js differs from browser environments in a drastic way—it does _not_ come with an implementation of the DOM APIs. YUI does not come with server-side DOM support either. In fact, we recommend _against_ running a DOM on the server for performance reasons. This means that only a subset of YUI modules will run natively within a Node.js environment: those modules which do not depend on DOM APIs. If you're inclined to run a DOM on the server, refer to [this example](http://yuilibrary.com/yui/docs/yui/nodejs-dom.html).

The new YUI Target Environments page contains [a section on Node.js](http://yuilibrary.com/yui/environments/#node.js "Module Support in Node.js") with two lists of modules: those with native Node.js support, and those which are DOM dependent.

Being able to use YUI on the server opens up many opportunities to share code between the browser and server environments; a great example being [Mojito](http://developer.yahoo.com/cocktails/mojito/), which takes full advantage of this.

### The Future of Graded Browser Support

Our plan is to phase out the term "Graded Browser Support" (GBS) in favor of "Progressive Enhancement" (PE) shortly. The core idea behind graded browser support _is_ progressive enhancement, so really this is a change to what we call it.

We will continue to promote the concepts and strategy of taking a progressive enhancement approach to web development, while separating it from the matrix of specific environments which YUI targets. We want to help developers use this information to make informed decisions about which environments they'll target for their projects.