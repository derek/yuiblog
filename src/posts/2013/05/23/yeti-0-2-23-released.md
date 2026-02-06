---
layout: layouts/post.njk
title: "Yeti 0.2.23 Released"
author: "Reid Burke"
date: 2013-05-23
slug: "yeti-0-2-23-released"
permalink: /2013/05/23/yeti-0-2-23-released/
categories:
  - "Yeti"
---
Last night, [Yeti](http://yeti.cx) 0.2.23 was released to fix a few bugs.

Our focus is on stabilizing IE 6+ with Yeti in CI, so this small release addresses a bug that occurs on IE 9 when Yeti is served from port 80 or 443.

## Changes

-   "Ignoring --server option" no longer appears when glob config is used with `-s`. Fix [GH-35](https://github.com/yui/yeti/issues/35).
-   Fix thrown SyntaxError on IE for every test when Yeti is used on port 80 or 443. Fix [GH-46](https://github.com/yui/yeti/issues/46).
-   Avoid using devDependencies during postinstall. Workaround for npm bugs. Fix [GH-42](https://github.com/yui/yeti/issues/42).
-   Update onyx dependency.

## Get Yeti

You can upgrade now by running `npm install -g yeti`. Learn more about Yeti at [yeti.cx](http://yeti.cx).

-   [Compare v0.2.22 source code to v0.2.23](https://github.com/yui/yeti/compare/v0.2.22...v0.2.23)
-   [v0.2.23 documentation](http://yeti.cx/docs/v0.2.23/)
-   [Unit code coverage](http://yeti.cx/docs/v0.2.23/coverage/unit/)
-   [Functional code coverage](http://yeti.cx/docs/v0.2.23/coverage/functional/)