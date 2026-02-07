---
layout: layouts/post.njk
title: "App Framework Changes in YUI 3.5.0"
author: "Ryan Grove"
date: 2011-12-12
slug: "app-framework-350"
permalink: /2011/12/12/app-framework-350/
categories:
  - "Releases"
  - "Development"
---
Since the initial release of the [App Framework](http://yuilibrary.com/yui/docs/app/) in YUI 3.4.0, we've been astonished by how quickly it's been adopted. In projects [large](http://www.smugmug.com/) and [small](http://photosnear.me/), both long-time YUI users and those who are completely new to the library have been enthusiastically using the App Framework's MVC components and providing great feedback and bug reports. Thank you!

In YUI 3.5.0, the App Framework will receive lots of bug fixes and some major enhancements. Eric Ferraiuolo covered many of the upcoming changes in his [fantastic YUIConf talk](http://www.youtube.com/watch?v=wCexiX_eUJA&hd=1), but we want to highlight them here as well so you'll know what's coming and what you should prepare for if you plan to upgrade App Framework-based code from 3.4.x to 3.5.0. These changes are already in [YUI 3.5.0 PR1](/yuiblog/blog/2011/12/12/yui-3-5-0-pr1-is-now-available-on-cdn/), which was released today, so now's a great time to start testing them.

### Y.Controller is now Y.Router

"Controller" was a silly and confusing name for a component that really concerns itself more with URL-based routing, especially given the more traditionally controller-like role that Y.View plays. We've decided to bite the bullet and rename the Y.Controller class to Y.Router in 3.5.0. Y.Controller will become an alias to preserve backwards compatibility, but this alias will eventually be removed, so you should update your code to refer to the new name.

### New route handler signature

The method signature for route handler functions in Y.Router has changed slightly to make it more similar to [Express](http://expressjs.com/) and to make Router's API more natural when used on the server (a feature we're currently working on for 3.5.0).

Previously, a route handler function received two arguments: `req` (a request object) and `next` (a function). In 3.5.0, route handlers will receive three arguments: `req`, `res` (a response object), and then `next`.

For the sake of backwards compatibility, the new `res` argument is also a function that behaves exactly like `next`, so old-style route handlers that expect `next` as the second arg will continue to work fine in 3.5.0. However, this compatibility shim will eventually be removed, so don't wait too long to update your code.

### Some properties are now attributes

We experimented with a not-entirely-YUI-like style of using properties for configurable options in the App Framework components in 3.4.0, but this turned out to be a little confusing and more than a little limiting, since properties don't benefit from change events, setters, and validators like attributes do. So in 3.5.0, we're converting many of these properties to attributes.

Unfortunately, this change is not backwards compatible, so existing code that uses Y.Controller (now Y.Router) or Y.View may need to be updated. Specifically, Y.Router's `html5`, `root`, and `routes` properties are now attributes, and Y.View's `container`, `model`, and `modelList` properties are now attributes as well.

In addition to this, Y.View's `container` attribute now treats string values as CSS selectors used to find nodes on the page. In 3.4.x, it assumed a string value represented raw HTML that should be converted into a node. To get the old behavior, just change your existing HTML string values from `'<div>foo</div>'` to `Y.Node.create('<div>foo</div>')`.

### Documentation for 3.5.0 PR1

Work-in-progress documentation for these changes and other changes in YUI 3.5.0 PR1 can be found on our [staging website](http://stage.yuilibrary.com/yui/docs/guides/). Here are some links to relevant staging docs that include information on App Framework deprecations in 3.5.0 and details about how to upgrade your code:

-   [Router](http://stage.yuilibrary.com/yui/docs/router/)
-   [View](http://stage.yuilibrary.com/yui/docs/view/)

Note that the content at stage.yuilibrary.com reflects ongoing work in progress and may be incomplete or even occasionally broken as we test new stuff. You'll always find the docs for the latest stable release at our production site, [yuilibrary.com](http://yuilibrary.com/).

### What else is new?

In this blog post I've summarized the important deprecations coming to the App Framework in 3.5.0, but there are also lots of feature enhancements and under-the-hood bug fixes. For a complete list of App Framework changes in 3.5.0 PR1, [consult the HISTORY file](https://github.com/yui/yui3/blob/master/src/app/HISTORY.md).

Also, look for a blog post from Eric soon about Y.App, an awesome new high-level component of the App Framework that wraps up URL-based routing and view management into a single easy-to-use API that'll get you from zero to a working application in no time.

We hope you love the preview release, and we'd love to hear from you! You can send us feedback in [the forums](http://yuilibrary.com/forum/), in [a bug report](http://yuilibrary.com/projects/yui3/newticket/), [on Twitter](https://twitter.com/yuilibrary), on the #yui IRC channel on Freenode, or just chime in here with a comment.