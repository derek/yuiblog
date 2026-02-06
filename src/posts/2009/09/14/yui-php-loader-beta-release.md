---
layout: layouts/post.njk
title: "YUI PHP Loader Beta Release"
author: "Eric Miraglia"
date: 2009-09-14
slug: "yui-php-loader-beta-release"
permalink: /2009/09/14/yui-php-loader-beta-release/
categories:
  - "Development"
---
The [YUI PHP Loader](http://developer.yahoo.com/yui/phploader/) is a server-side utility for loading YUI JavaScript and CSS; version 1.0.0 beta 1 is [available for download from YUILibrary.com today](http://yuilibrary.com/downloads/).

PHP Loader, originally written by longtime YUI engineer Adam Moore and now developed and maintained by fellow Yahoo Chad Auld, has several key features that make it easier to use YUI in PHP-based applications:

-   **Reliable, sorted loading of dependencies:** You specify the version of YUI that you're using, the modules you want to use, and PHP Loader outputs the requisite `script` and `css` tags for your implementation. Even if YUI's dependency tree changes in a future version, your code won't have to.
-   **Support for performance best-practices:** PHP Loader has three strategies to help you reduce HTTP requests — support for the Yahoo! CDN and its combo-handler (which aggregates YUI files into single HTTP requests on the fly), support for YUI's rollup files, and (in the event you don't want to serve YUI from Yahoo!'s servers) a lightweight combo-handler of its own. Server-side performance is fast as well, leveraging PHP's APC cache.
-   **Extensible metadata format:** YUI PHP Loader ships with YUI library metadata (for both YUI 2 and YUI 3); however, the application is generic and can be extended to support your own custom JavaScript and CSS modules — whether or not they use YUI at all.

PHP Loader is simple to use:

```
include("loader.php");
$loader = new YAHOO_util_Loader("2.7.0");

//Configure your instance; for example, you can turn off rollups
$loader->allowRollups = false;

//Specify YUI components to load
$loader->load("yahoo", "dom", "event", "tabview", "grids", "fonts", "reset");

//Output the tags (this call would most likely be placed in the document head)
$loader->tags();
```

The above PHP script would output the following to the page:

```
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/grids/grids-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset/reset-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/tabview/assets/skins/sam/tabview.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/yahoo/yahoo-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/dom/dom-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/event/event-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/element/element-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.7.0/build/tabview/tabview-min.js"></script>
*/
```

Leveraging the combo-handler on Yahoo!'s servers, you can flip the `combine` setting on...

```
$loader->combine = true;
```

...and end up with just a single HTTP request for CSS and one more for JavaScript:

```
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.7.0/build/reset-fonts-grids/reset-fonts-grids.css&2.7.0/build/tabview/assets/skins/sam/tabview.css"> 

<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/yahoo-dom-event/yahoo-dom-event.js&2.7.0/build/element/element-min.js&2.7.0/build/tabview/tabview-min.js"></script>
```

### YUI PHP Loader links:

-   [Read the documentation](http://developer.yahoo.com/yui/phploader/)
-   [Download the latest release, including functional examples, from YUILibrary.com](http://yuilibrary.com/downloads/)
-   [File bug reports or feature requests on YUILibrary.com](http://yuilibrary.com/projects/yuiphploader/)
-   [YUI PHP Loader is hosted on GitHub, where you grab the latest source](http://github.com/yui/)

### Welcoming a New YUI Contributor: Chad Auld

![Chad Auld of the MiaCMS project](/yuiblog/blog-archive/assets/cauld.png)[Chad Auld](http://twitter.com/chadauld) has driven the release of PHP Loader, and big thanks are owed to him for taking ownership of this application and adding a series of fantastic features as he prepped it for this beta release. You may know Chad from his work on [MiaCMS](http://miacms.org/) and the [Sideline](http://sideline.yahoo.com./) AIR application for Twitter search. We've been looking for an opportunity to collaborate with him for awhile, and we couldn't be happier to have that happening on this project.