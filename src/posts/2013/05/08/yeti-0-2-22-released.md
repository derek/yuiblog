---
layout: layouts/post.njk
title: "Yeti 0.2.22 Released"
author: "Reid Burke"
date: 2013-05-08
slug: "yeti-0-2-22-released"
permalink: /2013/05/08/yeti-0-2-22-released/
categories:
  - "Yeti"
  - "Releases"
  - "Development"
---
Today's release of [Yeti](http://yeti.cx) v0.2.22 includes improvements for testing slower browsers. In particular, we focused on the slow and sometimes flaky Android emulators hosted by [Sauce Labs](https://saucelabs.com).

We continue to rely on Yeti in CI and we've fixed a few bugs along the way. Today, we run 17,202 tests in browsers on every YUI library commit using Yeti. An additional 45,665 tests run about once a day. We can easily reach 100,000 tests running daily with our setup (assuming 4 commits per day) and we still have more browsers and devices yet to come.

## Changes

-   Automatically restart stalled browsers when using WebDriver.
-   Avoid Selenium proxy in Sauce Labs to support IE 6-9.
-   Maximum duration for sessions in Sauce Labs is now 2 hours.
-   [Support for `HTTP_PROXY` and `HTTPS_PROXY` environment variables when installing Yeti dependencies.](https://github.com/yui/yeti/pull/34) Thanks, [@ryanvanoss](https://github.com/ryanvanoss)!
-   Crash fix: prevent calling \_launch twice when starting a browser.
-   [Crash fix: properly close duplicate connection.](https://github.com/yui/yeti/issues/38)
-   Bugfix: Yeti exits with code 1 when tests fail using the JUnit XML reporter.
-   Bugfix: Fix bug in Batch.disallowAgentId.
-   Bugfix: Uncaught exceptions are now reported in JUnit XML results.
-   Bugfix: Improve handling of browser-sent events on load.
-   Upgrade glob and request dependencies.

## Get Yeti

You can upgrade now by running `npm install -g yeti`. Learn more about Yeti at [yeti.cx](http://yeti.cx).

## Release Links

-   [Compare v0.2.21 source code to v0.2.22](https://github.com/yui/yeti/compare/v0.2.21...v0.2.22)
-   [v0.2.22 documentation](http://yeti.cx/docs/v0.2.22/)
-   [Unit code coverage](http://yeti.cx/docs/v0.2.22/coverage/unit/)
-   [Functional code coverage](http://yeti.cx/docs/v0.2.22/coverage/functional/)