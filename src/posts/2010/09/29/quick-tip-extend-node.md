---
layout: layouts/post.njk
title: "YUI 3 Quick Tip: Adding Your Own Awesome"
author: "Eric Miraglia"
date: 2010-09-29
slug: "quick-tip-extend-node"
permalink: /2010/09/29/quick-tip-extend-node/
categories:
  - "Development"
---
Luke ([@ls\_n](http://twitter.com/ls_n)) posted this snippet in response to a question the other day, and I thought it was worth sharing here as a quick tip.

As with most selector-based idioms, a lot of YUI 3's expressive power comes from what you can do once you have reference to one or more HTMLElements — in YUI 3, that means having a Node reference, which you usually get via `Y.one(_selector string_)` or `Y.all(_selector string_)`. So, `Y.one("#foo")._doSomethingInteresting_` is a common pattern.

It's easy to extend YUI 3's expressiveness by adding your own magic to Node (and/or NodeList). Here's one way to make your extension modular and reusable.

First, create a new custom module (we'll call it `node++`):

```
YUI.add('node++', function (Y) {
	
	//define a function that will run in the context of a
	//Node instance:
	function doSomethingAwesome() {
		Y.log("Do something awesome here.");
	}

	//use addMethod to add doAwesomeThing to the Node prototype:
	Y.Node.addMethod("doAwesomeThing", doSomethingAwesome);
	
	//extend this functionality to NodeLists:
	Y.NodeList.importMethod(Y.Node.prototype, "doAwesomeThing");
	
}, '0.0.1', { requires: ['node'] });
```

[Luke's gist is here](http://gist.github.com/603391).

With that definition on the page, `node++` can be `use`d in any instance. In your implementation code, you would do:

```
YUI().use('node++', function (Y) {
	
	//use from a single Node:
        Y.one('#foo').doAwesomeThing();

	//use from a NodeList:
	Y.all('p').doAwesomeThing();
	
});
```

Note that only the YUI instance(s) to which you bind your `node++` module will have access to `doAwesomeThing`. One feature of this design that you'll like as you build complex apps is that your implementation logic won't need to change if the dependency list for `node++` evolves — that will get handled for you automatically at `use()` time, and the dependency declaration stays with the code to which it pertains.