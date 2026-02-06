---
layout: layouts/post.njk
title: "YUI Moving from Builder to Shifter"
author: "YUI Team"
date: 2012-12-13
slug: "yui-moving-from-builder-to-shifter"
permalink: /2012/12/13/yui-moving-from-builder-to-shifter/
categories:
  - "Development"
---
YUI has moved from using [Builder](https://github.com/yui/builder) to create component build files for YUI to a new tool called [shifter](https://github.com/yui/shifter). Builder is being deprecated and further development on it will stop in favor of improving `shifter`.

`shifter` was created to replace Builder and provides essentially the same features. However, `shifter` has vastly improved performance during build times. `shifter` is written in JavaScript and takes advantage of Node.js. In addition, `shifter` uses [JSHint](http://jshint.com/) which may provide you a bit more flexibility with your linting tasks. `shifter` also includes a very handy `--watch` option which will automatically rebuild the current module as you make changes, resulting in a faster development cycle. Since `shifter` is available via [npm](https://npmjs.org/package/shifter), it is easier to keep up to date and allows you to adopt new features quickly. If there are features that you depended on with Builder which are not present in `shifter`, please file a issue [here](https://github.com/yui/shifter/issues) and note that this is something you were using in Builder that needs to be added.

If you are unfamiliar which how `shifter` works in the build process, please visit this wiki page on [Building YUI](https://github.com/yui/yui3/wiki/Building-YUI) as well as [shifter's docs](http://yui.github.com/shifter/). The wiki page will step you through the process of using `shifter` directly and `shifter`'s docs will give you more in depth detail on the various things it can do for you.

However, since `shifter` is just one tool in our growing toolbox, you should instead move to using `[yogi](http://yui.github.com/yogi/)`. `yogi build` uses `shifter` under the hood and does many other useful tasks to help you with YUI development.