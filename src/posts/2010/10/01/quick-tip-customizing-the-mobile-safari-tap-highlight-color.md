---
layout: layouts/post.njk
title: "Quick Tip: Customizing the Mobile Safari tap highlight color"
author: "Ryan Grove"
date: 2010-10-01
slug: "quick-tip-customizing-the-mobile-safari-tap-highlight-color"
permalink: /2010/10/01/quick-tip-customizing-the-mobile-safari-tap-highlight-color/
categories:
  - "Development"
---
Ever notice the semi-transparent gray background that appears sometimes when you tap on something in Mobile Safari? That's the default tap highlight color, which Mobile Safari displays when you tap on an element with a JavaScript click handler.

Unfortunately, Mobile Safari has no way to distinguish between normal click subscribers and delegated click subscribers, which is when the click event is attached to a container rather than to each child of that container. As a result, a delegated click will result in the entire container being highlighted rather than just the item that was tapped, and this can be both ugly and confusing for the user.

The good news is that Mobile Safari supports a CSS extension called `-webkit-tap-highlight-color`, which you can use to customize the color of the tap highlight or hide it completely.

The `-webkit-tap-highlight-color` property accepts any standard CSS color value, but you'll probably want to provide an rgba value in order to control the alpha transparency. Disabling the tap highlight is as simple as setting the alpha value to `0`, like so:

```
#container {
  -webkit-tap-highlight-color: rgba(0,0,0,0);
}
```

Fire up your favorite iOS device and [view this simple demo](http://dl.dropbox.com/u/131998/yui/demos/webkit-tap-highlight/index.html) to see what a delegated click looks like both with and without a tap highlight. For more details on `-webkit-tap-highlight-color` and other useful Mobile Safari CSS extensions, see the [Safari CSS Reference](http://developer.apple.com/library/safari/#documentation/AppleApplications/Reference/SafariCSSRef/Introduction.html).