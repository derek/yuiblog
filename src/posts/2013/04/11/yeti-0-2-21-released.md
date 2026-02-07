---
layout: layouts/post.njk
title: "Yeti 0.2.21 Released"
author: "Reid Burke"
date: 2013-04-11
slug: "yeti-0-2-21-released"
permalink: /2013/04/11/yeti-0-2-21-released/
categories:
  - "Releases"
  - "Yeti"
---
We're using [Yeti](http://yeti.cx) to test YUI on all of our [Target Environments](http://yuilibrary.com/yui/environments/). In CI, we use Yeti with Selenium to start and stop browsers. Today's release improves issues we've found while using Yeti with Selenium. Here's what's new in 0.2.21.

## Use Only Launched Browsers

When specifying browsers to launch, Yeti 0.2.21 will ignore browsers that are manually connected and will only use browsers launched by Selenium to test that batch.

## Recognize Browsers & Environments Used by Sauce Labs

We've included browser names, versions, and OS options that are used by [Sauce Labs](https://saucelabs.com/). We also added `latest` as a version. New options include:

-   Windows 2003
-   Windows 2008
-   Windows 2012
-   Mac 10.6
-   Mac 10.8
-   iPad
-   iPhone

These can be used together to launch browsers like this:

-   `-b chrome/xp`
-   `-b "ie/6/windows 2003"`
-   `-b "ie/10/windows 2012"`
-   `-b "iphone/6/mac 10.8"`
-   `-b firefox/latest/xp`

## Full Changelog and Bugfixes

We also fixed a few bugs. The full changelog is below:

-   Batches that use WebDriver only use browsers launched by WebDriver, not existing browsers.
-   Accept `latest` as a WebDriver browser version.
-   Add browsers used by Sauce Labs.
-   Fix server-side `wd-url` command-line option.
-   Fix issue with echoecho JSONP when using a query string like `&callback=foo`.
-   Fix possible hang during WebDriver browser launching.
-   Fix possible quit before JUnit XML was completely written to stdout.

## Upgrade Now & Release Links

You can upgrade now as usual: `npm install -g yeti`.

-   [Compare 0.2.21 source code to 0.2.20](https://github.com/yui/yeti/compare/v0.2.20...v0.2.21)
-   [API documentation](http://yeti.cx/docs/v0.2.21/api/)
-   [Unit code coverage](http://yeti.cx/docs/v0.2.21/coverage/unit/)
-   [Functional code coverage](http://yeti.cx/docs/v0.2.21/coverage/functional/)

## What's Next

We continue to improve Yeti as we use it to test YUI 3.10.0. [Support for HTTP proxies during Yeti's installation](https://github.com/yui/yeti/pull/34) is coming soon thanks to an in-progress pull request by [@ryanvanoss](https://github.com/ryanvanoss) which is coming in the next release.