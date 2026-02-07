---
layout: layouts/post.njk
title: "Yeti 0.2.24 Released"
author: "Reid Burke"
date: 2013-07-19
slug: "yeti-0-2-24-released"
permalink: /2013/07/19/yeti-0-2-24-released/
categories:
  - "Releases"
  - "Yeti"
---
Today's release of [Yeti](http://yeti.cx) 0.2.24 features improvements to browser launching, [integration with other testing tools](http://yeti.cx/docs/v0.2.24/quick-start/index.html#Client-Side-Yeti-Integration), and distinguishing between different uses of Yeti in Jenkins builds with the new `--name` option. We have added official support for IE 6 and 7, since we have used [Yeti's previous release](/yuiblog/2013/05/23/yeti-0-2-23-released/) to automate YUI tests for those browsers during the last few weeks.

Yeti was an important tool for delivering [YUI 3.11.0](/yuiblog/2013/07/16/yui-3-11-0-released/) this week. For that release, we used Yeti to automate the testing of YUI's example pages in addition to YUI's unit tests. Yeti automates over 120,000 tests for YUI during a daily test run across 13 of our 15 [target environments](http://yuilibrary.com/yui/environments/).

## Changes

-   Report root cause of Selenium/WebDriver errors that occur during browser launching.
-   Allow `WINDOWS` as a platform name in the `--browser` launch option for Selenium.
-   Add new Sauce Labs platform names: `Windows XP`, `Windows 7`, `Windows 8`, `OS X 10.6`, and `OS X 10.8`.
-   Add Client-Side Yeti Integration (Generic Driver) for using Yeti to automate other frameworks.
-   Add `--name` option to label JUnit XML tests for display in Jenkins merged test reports.
-   Display friendlier session names in the Sauce Labs dashboard. Uses Jenkins-provided `BUILD_TAG` environment variable, if available, to distinguish Sauce sessions between different builds.
-   Update request and graceful-fs dependencies.

## Get Yeti

You can upgrade now by running `npm install -g yeti`. Learn more about Yeti at [yeti.cx](http://yeti.cx).

-   [Compare v0.2.23 source code to v0.2.24](https://github.com/yui/yeti/compare/v0.2.23...v0.2.24)
-   [v0.2.24 documentation](http://yeti.cx/docs/v0.2.24/)
-   Code coverage: [unit](http://yeti.cx/docs/v0.2.24/coverage/unit/), [functional](http://yeti.cx/docs/v0.2.24/coverage/functional/)