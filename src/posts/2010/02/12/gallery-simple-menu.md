---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Julien Lecomte's 1.3KB SimpleMenu with Keyboard and ARIA Support"
author: "Eric Miraglia"
date: 2010-02-12
slug: "gallery-simple-menu"
permalink: /blog/2010/02/12/gallery-simple-menu/
categories:
  - "YUI 3 Gallery"
---
[![](/yuiblog/blog-archive/assets/simplemenu-20100212-091230.jpg)](http://ericmiraglia.com/yui/demos/simplemenu.php)

Julien Lecomte wrote the [SimpleMenu module](http://yuilibrary.com/gallery/show/simple-menu) for use on [Yahoo! Search](http://search.yahoo.com) (the "More" link uses this code). It's superbly light — a 1.3KB minified script leveraging the YUI 3 core, [plugin architecture](http://developer.yahoo.com/yui/3/plugin/), and keyboard/[focus](http://developer.yahoo.com/yui/3/node-focusmanager/) management utilities. Moreover, it's simple to use. He's shared it in the YUI 3 Gallery — you can use it under [YUI's BSD license](http://developer.yahoo.com/yui/license.html) or you can [grab the source from GitHub](http://github.com/yui/yui3-gallery/blob/master/src/gallery-simple-menu/js/simple-menu.js) and use Julien's code as starting point for your own project.

Julien hasn't had time to document the widget fully, so [I wrote up a common use case](http://ericmiraglia.com/yui/demos/simplemenu.php).

Take a simple piece of markup:

```
<!--menu activator-->
<a href="http://developer.yahoo.com/yui/" id="optionsmenu">YUI-Related Links</a>

<!--menu contents-->
<div id="optionsmenucontainer" class="yui-cssreset">
<ul>
<li><a href="http://developer.yahoo.com/yui/">YUI documentation</a></li>
<li><a href="http://yuilibrary.com">YUI project site</a></li>
<li><a href="http://yuilibrary.com/forum/">YUI discussion forums</a></li>
<li><a href="/blog-archive">YUIBlog</a></li>
<li><a href="http://developer.yahoo.com/yui/theater/">YUI Theater</a></li>
<li><a href="http://yuilibrary.com/gallery/">YUI 3 Gallery</a></li>
<li><a href="http://twitter.com/yuilibrary">@YUILibrary on Twitter</a></li>
<li><a href="http://twitter.com/miraglia/yui/members">@YUILibrary developers on Twitter</a></li>
</ul>
</div>
```

And the following script:

```
<script type="text/javascript" 
src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js&gallery-2010.02.10-01/
build/gallery-simple-menu/gallery-simple-menu-min.js"></script>

<script language="javascript">
YUI().use('gallery-simple-menu', function(Y) {
    Y.one('#optionsmenu').plug(Y.Plugin.SimpleMenu);
});
</script>

```

What remains is simply some CSS styling. Julien's widget applies the `.menu-visible` class when the menu is activated; a simple approach is to set the menu container's default position to absolute and move it off-screen. Then, in your `.menu-visible` declaration, remove the offset and allow the widget to position the container under its activator element:

```
#optionsmenucontainer {
    left:-4500px;
    position:absolute;
}

#optionsmenucontainer.menu-visible {
    left:auto;
}

```

[Click through](http://ericmiraglia.com/yui/demos/simplemenu.php) to try this example in action.