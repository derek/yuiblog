---
layout: layouts/post.njk
title: "Yeti 0.2.20 Released"
author: "Reid Burke"
date: 2013-03-20
slug: "yeti-0-2-20-released"
permalink: /2013/03/20/yeti-0-2-20-released/
categories:
  - "Yeti"
---
Yeti 0.2.20 resolves a few issues, including bugs that could cause tests to be skipped or report incorrect results.

## What is Yeti?

[Yeti](http://www.yeti.cx/) is a JavaScript test runner for browsers built on Node.js. We use Yeti to test YUI every one of our [target environments](http://yuilibrary.com/yui/environments/) before release. Since Yeti 0.2.0 released last year, Yeti was covered on the retired [Yeti Blog](http://www.yeti.cx/blog/). Since Yeti is becoming a very important part of YUI development, future Yeti news will be found right here on YUI Blog!

## Changelog

-   [Report results for the correct test. Never run tests twice.](http://yuilibrary.com/projects/yeti/ticket/129)
-   Run Android tests faster by removing unneeded timeout between tests. (c252285)
-   Improve error messages that can occur during WebDriver launching. (559d887, 048a722)
-   [Allow client to set `wd-url` for a Hub to launch browsers.](https://github.com/yui/yeti/pull/32)
-   Prevent calling WebDriver launcher callback twice, which can cause a crash. (ac13083)

## Release links

-   [Quick start](http://www.yeti.cx/docs/v0.2.20/quick-start)
-   [API documentation](http://www.yeti.cx/docs/v0.2.20/api/)
-   [Unit code coverage](http://www.yeti.cx/docs/v0.2.20/coverage/unit/)
-   [Functional code coverage](http://www.yeti.cx/docs/v0.2.20/coverage/functional/)

## What's next: focus on YUI 3.10.0

As we prepare to ship a well-tested YUI 3.10.0 release, we'll be using Yeti quite a bit. Expect incremental improvements in Yeti releases over the next few weeks as we continue to abuse it daily.

Yeti 0.2.20 tests Firefox and Chrome—simultaneously, using 12 instances of each browser—inside our upcoming CI build for YUI. This new setup will replace our existing CI build that tests one browser instance at a time. We'll be working to hook up our [public build results](http://yui.github.com/builds/yui3/) to use our Yeti-based CI setup over the next couple weeks.