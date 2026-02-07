---
layout: layouts/post.njk
title: "Event Delegation With YUI 3"
author: "Caridy Patino"
date: 2009-11-13
slug: "event-delegation-3"
permalink: /2009/11/13/event-delegation-3/
categories:
  - "Development"
---
More and more web applications are loading content on demand with AJAX or injecting DOM fragments into elements to update old content with new content. If the new content includes certain JavaScript functionality -- for example, links that trigger popup overlays -- we need to [add event handlers](http://developer.yahoo.com/yui/3/event/#domevents) after the content gets inserted and remove them just before newer content comes in, in order to [avoid memory leaks in IE](http://www.crockford.com/javascript/memory/leak.html "JScript Memory Leaks by Douglas Crockford"). These are situations where ["event delegation"](http://www.nczonline.net/blog/2009/06/30/event-delegation-in-javascript/) plays an important role for web applications.

### A Use Case

![YUI Developers on Twitter](/yuiblog/blog-archive/assets/caridy-delegation/twitter-yui-dev.png)Consider a widget that displays the latest tweets from [YUI Developers](http://twitter.com/miraglia/yui). The list is represented by a `ul` element, and each tweet is represented by a `li` element.

The list is refreshed every 2 minutes using AJAX and the user can filter the list using the search box. If a user clicks on an avatar image or a profile link, we want to display more information in a [YUI Overlay](http://developer.yahoo.com/yui/3/overlay/).

### Simple Solution

With YUI 3, it is simple to add event listeners to the elements directly, as soon as they become available:

```
Y.on("click", handleClick, "a.profile");
```

As you can see, this is pretty simple. But, we would have to do this every time the content changes, which adds overhead to our code, not to mention the need to remove each of the listeners with `Y.detach()` before replacing older content.

### The Bubbling Technique

Taking advantage of event bubbling, we can add a listener to a container element, or even to the `document`, to catch an event on its way up the bubble chain. In the callback function, we'd analyze the event target to identify if it's what we're expecting (by classname or id) before executing our overlay code.

This technique reduces the DOM overhead of adding event listeners to each individual element, but we still need to analyze every single click in the container and filter for the proper targets within our callback function. [I wrote an article about this technique a while ago](/yuiblog/2007/09/13/bubbling-library-by-caridy/ "The Bubbling Technique & Custom Event, YUI's Secret Weapon by Caridy Patino"), explaining in detail how the [Bubbling Library YUI Extension](http://bubbling-library.com/ "Bubbling Library YUI Extension") works.

But this is not new and already a widely used concept. So, what is new in YUI 3?

### Introducing `Y.delegate()`

YUI 3 introduces a new method called [`delegate()`](http://developer.yahoo.com/yui/3/api/YUI.html#method_delegate) which is based off the event delegation principle and adopts a familiar syntax:

```
// Defining simple listeners on each element:
Y.on("click", handleClick,
  "#container ul li a.profile");

// Defining listener on a container using the delegate() method:
Y.delegate('click', handleClick,
  '#container', 'ul li a.profile');

```

The difference here is that `delegate()` takes advantage of event bubbling and applies a listener on a container element (`'#container'`), but it doesn't stop there. When the event fires, each target is matched against the given selector (`'ul li a.profile'`) before the callback is executed. As you can see, the function definition for the callback function `handleClick()` can be _the same for both techniques_. From the callback's point of view, the differences are normalized by the Event utility. Here is the visual description of this:

```
// Markup
<div id="container">

  <ul>
    <li><a href="avatar1.html" class="profile"><img src="1.jpg"/></a> <a href="username1.html" class="username">Name 1</a></li>
    <li><a href="avatar2.html" class="profile"><img src="2.jpg" /></a> <a href="username1.html" class="username">Name 1</a></li></li>
    <li><a href="avatar3.html" class="profile"><img src="3.jpg" /></a> <a href="username1.html" class="username">Name 1</a></li></li>
  </ul>

</div>
```

If we click on the second avatar image (`ul li a img`), the event bubbles up the DOM tree to the `a` link with the classname `"profile"`, and the callback method `handleClick()` is called. Regardless of the technique used, it receives the same [Event Facade](http://developer.yahoo.com/yui/3/api/Event.Facade.html) structure:

```
// Markup
var handleClick = Function (e) {
   // e.target -> img: the actual click target
   // e.currentTarget -> anchor: the element the
   //                    listener was attached to (on:click),
   //                    or the element that matched
   //                    the delegation specification (delegate:click).
};
```

### Performance Gains

This new feature allow us to improve performance drastically, particularly in two areas:

-   Decreasing initial load time when multiple child elements require event handling
-   Decreasing run time of dynamic injections caused by user interaction

In both cases, improvements are gained by reducing the number of DOM interactions. As JavaScript engines get faster, the reality of the DOM bottleneck remains. Event delegation in YUI 3 moves the overhead of walking the DOM tree from the loading process to the point of user interaction, and decreases complexity by removing the need to match target elements within the callback. Instead, `delegate()` tests the event target (`e.target`) against the selector (`'ul li a.profile'`) after the event is fired but before the callback is executed, which is especially useful in complex DOM structures.

The true beauty behind this implementation, as I mentioned before, is that the callback signature is exactly the same. We don't need to change the code to introduce `delegate()` to our code. We just need to change how the listeners are defined and YUI 3 will do the rest.

### Adding Functionality

If we also want to display the profile overlay when a user clicks on the Twitter username, which is an anchor with class `"username"`, we just need to add one more selector to the final argument:

```
Y.delegate('click', function(e) {
   // e.target -> target node
   // e.currentTarget -> matching node
   // e.container -> container node (in this case "#container")
   // e.currentTarget.get('className') -> "profile" or "username"
   e.halt(); // shorthand for stopPropagation() and preventDefault()
}, '#container', 'ul li a.profile, ul li a.username');
```

The event delegation callback is similar to a simple listener callback, but it also provides additional information through the Event Facade object, like `e.container` which represents the element where the event was caught.

### Delegate as a Node Plugin

In the same way that `on()` is available not only from the `Y` instance, but also at the [YUI Node](http://developer.yahoo.com/yui/3/node/) instance level, `delegate()` is also available as a Node plugin. Here is an example:

```
// using YUI3 Node Delegate Plugin:
Y.one('#container').delegate('click', handleClick, 'ul li a.profile');
```

Just make sure to include in your `use()` statement either `"node"` or `"node-event-delegate"`, and the feature will be loaded for use in your sandbox. Also note that `delegate()` can be used with other events that bubble up in the DOM and even for those that are [emulated by YUI Event Utility](http://developer.yahoo.com/yui/3/event/#focusblur), like `focus` and `blur`.

### Conclusion

Event delegation with `delegate()` is a really cool feature, especially for those who want to create complex applications with a lot of user interaction and AJAX features. This is also something that you can introduce later in your application without any overhead or extra complexity in your code, for example, during a performance optimization process. And finally, you should know that most of the upcoming widgets in YUI 3 will be sure to take advantage this technique from the start.