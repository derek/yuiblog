---
layout: layouts/post.njk
title: "Next-Gen YSlow powered by YUI"
author: "Marcel Duran"
date: 2011-07-18
slug: "next-gen-yslow-powered-by-yui"
permalink: /blog/2011/07/18/next-gen-yslow-powered-by-yui/
categories:
  - "Development"
---
A couple of weeks ago, Yahoo! announced [YSlow for Mobile](http://developer.yahoo.com/blogs/ydn/posts/2011/06/yslowmobile/) at [Velocity 2011](http://velocityconf.com/velocity2011/public/schedule/detail/20287), bringing the power of YSlow performance analysis to the mobile world.

[YSlow for Mobile](http://developer.yahoo.com/yslow/mobile/) works as a [bookmarklet](http://en.wikipedia.org/wiki/Bookmarklet), making it possible to run on browsers other than [Firefox (as an add-on)](https://addons.mozilla.org/en-US/firefox/addon/5369) or [Chrome (as an extension)](https://chrome.google.com/webstore/detail/ninejjcohidippngpapiilnmkgllmakh).

The YSlow architecture was partially redesigned to work cross-platform and YUI was the essential factor in make sandboxing, cross-browser abstraction and simple YQL access possible.

### Sandboxing

In order to be embedded on a page without interfering with performance analysis and without messing with the page itself, YSlow is a bookmarklet that injects JavaScript and CSS into any page by leveraging the power of YUI sandboxing:

Bookmarklet URL:

```
javascript:(function (y, p, o) {
    p = y.body.appendChild(y.createElement('iframe'));
    p.id = 'YSLOW-bookmarklet';
    p.style.cssText = 'display:none';
    o = p.contentWindow.document;
    o.open().write('
        <head>
        <body onload = "
            YUI_config = {
                win: window.parent,
                doc: window.parent.document
            };
            var d = document;
            d.getElementsByTagName(\'head\')[0]
                .appendChild(
                    d.createElement(\'script\')
                ).src = \'http://d.yimg.com/jc/yslow-bookmarklet.js\'"
        >
    ');
    o.close()
}(document))

```

The code above:

-   creates an empty iframe;
-   appends it to the page body;
-   hides the iframe\*;
-   gets its window handler;
-   writes into its content the body of the iframe;
-   this body is empty but has an `onload` event
-   the `onload` event defines how to inject YSlow JS:
    -   sets `YUI_config`, so `win` and `doc` points to the page being analyzed `window` and `document` respectively
    -   dynamically injects YSlow URL by creating a `script` element into iframe's `head`

_\* the iframe is displayed by the time all YSlow presentation assets are loaded_

This will place an iframe into the page being analyzed. This iframe will act as a sandboxed environment and YSlow will reside within it. Since the iframe is dynamically created without the `src` attribute, it will have access to its parent (the page being analyzed) because there's no [same origin policy](https://developer.mozilla.org/en/Same_origin_policy_for_JavaScript) violation happening there.

The [YUI\_config](http://developer.yahoo.com/yui/3/api/config.html) object is handy because it sets `win` and `doc` to the iframe's parent (the page being analyzed), thus any new YUI instance will be bound to the parent document by default, wiring any call to `Y.all` and `Y.one` through `Y.config.win` or `Y.config.doc` from the YUI [`use`](http://developer.yahoo.com/yui/3/yui/#use) callback.

YSlow's presentation is handled by the iframe `window` and `document` references, allowing the YSlow main script to render the markup as well as fetch the external CSS within this iframe without conflicting with the parent page's styles. YSlow scans the parent page in order to get all the components (images, scripts, links, background-images, flash, etc.) required for later performance analysis. This is done by accessing `Y.config.win` and `Y.config.doc`, since they refer to the parent page.

### Cross-browser abstraction

Being a bookmarklet, YSlow for Mobile is supposed to work on any browser\*. YUI abstracts cross-browser issues by normalizing browser differences, resulting in a clean, easy-to-read and maintainable codebase.

YSlow was not fully ported to YUI 3 — only the controller layer (from the upcoming App component) for now — but still, all DOM manipulation and event handling are done by the [`node`](http://developer.yahoo.com/yui/3/node/) and [`event`](http://developer.yahoo.com/yui/3/event/) modules. In future releases we plan to port more YSlow features to YUI 3.

_\* not all browsers are currently supported_

### YQL

YSlow analyzes pages by checking the HTTP headers for the components found on the page. HTTP response headers are not available in the page, hence those components need to be requested again in order for YSlow get the response header information. This could be achieved by requesting the list of component URLs through XmlHttpRequest (AJAX) but unfortunately due to [same origin policy restriction](http://en.wikipedia.org/wiki/Same_origin_policy), this is not possible unless all components are in the same domain as the page which is very unlikely.

A common workaround for same origin policy restriction is using JSONP, where an external server works as a proxy requesting the list of components URLs and retrieving their HTTP response headers on behalf of YSlow. Due to YSlow's popularity and recent mobile performance analysis efforts, we're expecting quite heavy traffic for the YSlow for Mobile bookmarklet. In order to support such traffic, [YQL](http://developer.yahoo.com/yql/) was the scalable solution adopted by YSlow through an [open data table](http://www.datatables.org/) named [data.headers](http://developer.yahoo.com/yql/console/?q=select%20*%20from%20data.headers%20where%20url%3D%22http%3A//getyslow.com/%22&env=http%3A%2F%2Fdatatables.org%2Falltables.env), which retrieves the response headers and content for a given list of URLs while impersonating the user-agent to ensure the expected content is retrieved.

The [YQL Query](http://developer.yahoo.com/yui/3/yql/) component does all the work of managing YQL queries while managing JSONP requests under the hood, making the YSlow controller code much simpler and easy-to-maintain.

### Future enhancements: New YSlow for Mobile friendly interface

Currently the YSlow for Mobile user experience is the same as the desktop experience. Dealing with a long list of performance analysis data is not the best experience on small smart-phone screens. Since YUI also abstracts [cross-device gestures](http://developer.yahoo.com/yui/3/event/#gestures), YSlow for Mobile will get a brand new mobile-friendly interface in future releases.

### Performance of performance tool

YSlow for Mobile deployment was made carefully considering its performance impact on the load time of the page being analyzed. The YUI 3 modules used on YSlow were scrutinized to include only the modules needed to load YSlow as fast as possible. The YUI seed file and Loader [were not included](http://developer.yahoo.com/yui/3/configurator/) since all necessary modules and submodules were combined together following [Ryan Grove's Performance Zen](http://developer.yahoo.com/yui/theater/video.php?v=grove-zen) tips, which made it possible to load everything together into a single small single request: yslow-bookmarklet.js: 204KB, 66KB (gzip) where:

-   YUI: 75KB, 27KB (gzip)
-   YSlow: 129KB, 39KB (gzip)

### More about YSlow

Keep up-to-date with the latest YSlow announcements by:

-   Visiting the redesigned YSlow page at [getyslow.com](http://getyslow.com/)
-   Liking YSlow on Facebook: [facebook.com/getyslow](http://www.facebook.com/getyslow/)
-   Following YSlow on Twitter: [twitter.com/getyslow](http://twitter.com/getyslow/)

![Marcel Duran](/yuiblog/blog-archive/assets/next-gen-yslow/marcel.jpg)_**About the author:** Marcel Duran is the Front End Lead for Yahoo!'s Exceptional Performance Team. He has been into web performance optimization on high traffic sites in Yahoo! Front Page and Search teams where he applied and researched web performance best practices making pages even faster. He is now dedicated to YSlow and other performance tools development, researches and evangelism. His goal is to make the web even faster than it can be and believes there is no such thing as "just a few milliseconds won't hurt"._