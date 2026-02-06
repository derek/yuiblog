---
layout: layouts/post.njk
title: "A JavaScript Module Pattern"
author: "Eric Miraglia"
date: 2007-06-12
slug: "module-pattern"
permalink: /blog/2007/06/12/module-pattern/
categories:
  - "Development"
---
[Global variables are evil](/yuiblog/blog/2006/06/01/global-domination/). Within [YUI](http://developer.yahoo.com/yui/), we use only two globals: `YAHOO` and `YAHOO_config`. Everthing in YUI makes use of members within the `YAHOO` object hierarchy or variables that are scoped to such a member. We advise that you exercise similar discipline in your own applications, too.

Douglas Crockford has been teaching a useful singleton pattern for achieving this discipline, and I thought his pattern might be of interest to those of you building on top of YUI. Douglas calls this the "module pattern." Here's how it works:

1\. **Create a namespace object:** If you're using YUI, you can use the `YAHOO.namespace()` method:

```
YAHOO.namespace("myProject");
```

This assigns an empty object `myProject` as a member of `YAHOO` (but doesn't overwrite `myProject` if it already exists). Now we can begin adding members to `YAHOO.myProject`.

**2\. Assign the return value of an anonymous function to your namespace object:**

```
YAHOO.myProject.myModule = function () {

	return  {
		myPublicProperty: "I'm accessible as YAHOO.myProject.myModule.myPublicProperty.",
		myPublicMethod: function () {
			YAHOO.log("I'm accessible as YAHOO.myProject.myModule.myPublicMethod.");
		}
	};

}(); // the parens here cause the anonymous function to execute and return
```

Note the very last line with the closing curly brace and then the parentheses `()` — this notation causes the anonymous function to execute immediately, `return`ing the object containing `myPublicProperty` and `myPublicMethod`. As soon as the anonymous function returns, that returned object is addressable as `YAHOO.myProject.myModule`.

**3\. Add "private" methods and variables in the anonymous function prior to the `return` statement.** So far, the above code hasn't bought us any more than we could have gotten by assigning `myPublicProperty` and `myPublicMethod` directly to `YAHOO.myProject.myModule`. But the pattern does provide added utility when we place code before the `return` statement:

```
YAHOO.myProject.myModule = function () {


	//"private" variables:
	var myPrivateVar = "I can be accessed only from within YAHOO.myProject.myModule.";
	
	//"private" method:
	var myPrivateMethod = function () {
		YAHOO.log("I can be accessed only from within YAHOO.myProject.myModule");
	}


	return  {
		myPublicProperty: "I'm accessible as YAHOO.myProject.myModule.myPublicProperty.",
		myPublicMethod: function () {
			YAHOO.log("I'm accessible as YAHOO.myProject.myModule.myPublicMethod.");

			//Within myProject, I can access "private" vars and methods:
			YAHOO.log(myPrivateVar);
			YAHOO.log(myPrivateMethod());

			//The native scope of myPublicMethod is myProject; we can
			//access public members using "this":
			YAHOO.log(this.myPublicProperty);
		}
	};

}(); // the parens here cause the anonymous function to execute and return
```

In the codeblock above, we're `return`ing from an anonymous function an object with two members. These members are addressable from within `YAHOO.myProject.myModule` as `this.myPublicProperty` and `this.myPublicMethod` respectively. From outside of `YAHOO.myProject.myModule`, these public members are addressable as `YAHOO.myProject.myModule.myPublicProperty` and `YAHOO.myProject.myModule.myPublicMethod`.

The private variables `myPrivateProperty` and `myPrivateMethod` can only be accessed from within the anonymous function itself or from within a member of the `return`ed object. They are preserved, despite the immediate execution and termination of the anonymous function, through the power of closure — the principle by which variables local to a function are retained after the function has returned. As long as `YAHOO.myProject.myModule` needs them, our two private variables will not be destroyed.

**4\. Do something useful with the pattern.** Let's look at a common use case for the module pattern. Suppose you have a list, some of whose list items should be draggable. The draggable items have the CSS class `draggable` applied to them.

```
<!--This script file includes all of the YUI utilities:-->
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/utilities/utilities.js"></script>

<ul id="myList">
	<li class="draggable">Item one.</li>
	<li>Item two.</li> <!--item two won't be draggable-->
	<li class="draggable">Item three.</li>
</ul>

<script>
YAHOO.namespace("myProject");
YAHOO.myProject.myModule = function () {

	//private shorthand references to YUI utilities:
	var yue = YAHOO.util.Event,
		yud = YAHOO.util.Dom;

	//private method:
	var getListItems = function () {
		
		//note that we can use other private variables here, including
		//our "yud" shorthand to YAHOO.util.Dom:
		var elList = yud.get("myList");
		var aListItems = yud.getElementsByClassName(
			"draggable", //get only items with css class "draggable"
			"li", //only return list items
			elList //restrict search to children of this element
		);
		return aListItems;
	};
	
	//the returned object here will become YAHOO.myProject.myModule:
	return  {

		aDragObjects: [], //a publicly accessible place to store our DD objects
		
		init: function () {
			//we'll defer making list items draggable until the DOM is fully loaded:
			yue.onDOMReady(this.makeLIsDraggable, this, true);
		},
		
		makeLIsDraggable: function () {
			var aListItems = getListItems(); //these are the elements we'll make draggable
			for (var i=0, j=aListItems.length; i<j; i++) {
				this.aDragObjects.push(new YAHOO.util.DD(aListItems[i]));
			}
		}

	};
}(); // the parens here cause the anonymous function to execute and return

//The above code has already executed, so we can access the init
//method immediately:
YAHOO.myProject.myModule.init();
</script>
```

This example is a simple one, and it's deliberately verbose — if this was all we were doing, we could doubtless write it in a more compact way. However, this pattern scales well as the project becomes more complex and as its API grows. It stays out of the global namespace, provides publicly addressable API methods, and supports protected or "private" data and methods along the way.