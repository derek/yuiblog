---
layout: layouts/post.njk
title: "The Bubbling Technique & Custom Event, YUI's Secret Weapon by Caridy Patiño Mayea"
author: "Caridy Patino"
date: 2007-09-13
slug: "bubbling-library-by-caridy"
permalink: /2007/09/13/bubbling-library-by-caridy/
categories:
  - "Development"
---
There have been many influential articles about [event-driven programming within the web browser](/yuiblog/2007/01/17/event-plan/), and developers are increasingly using this technique. But there is room to push the approach even further, and with it the capabilities of our web applications. In this article I'll share my experiences in this space and show how my [Bubbling Library](http://www.bubbling-library.com/), combined with YUI's [Custom Event](http://developer.yahoo.com/yui/event/#customevent) capabilities, can create an unobtrusive behavioral layer suitable for powerful web applications.

### Trickling & Bubbling, the DOM Event Model:

In the beginning, behaviors were defined as inline attributes in the HTML layer. For example, we could assign a click handler inline by writing `<span onclick="foo()">`. But with the rise of [unobtrusive JavaScript](http://en.wikipedia.org/wiki/Unobtrusive_JavaScript) — and DOM Level 2 — this technique became deprecated. The new school promotes using the `addListener` method to attach behavior to DOM elements. I call this "simple handling." Simple handling — widely used by the JavaScript developers — is a simplification of the bubbling technique: The target of the event is the same element that will catch the event.

In general, the [DOM event model](http://www.w3.org/TR/DOM-Level-2-Events/events.html) is based on two main concepts, "Event Capture" (Trickling) and "Event Delegation" (Bubbling). You can define where to catch the event, but experts [like Douglas Crockford](/yuiblog/2007/01/24/video-crockford-tjpl/) caution you against using the trickling method and instead let the browser reach the event target. One reason for this is that it will be tough to combine trickling with the simple handling technique because the event will be caught before reaching a certain target. Another reason is that Internet Explorer provides incomplete support for the DOM-standard event handling during the capture or "trickling" phase.

![diagram showing the event propagation differences between Tricklinig (where the event target is located by walking down the DOM from the root) and Bubbling (where the event is passed up the DOM from the target until it reaches the root node.](/yuiblog/blog-archive/assets/caridy-graph1.jpg)

The _Simple Handling_ process will be run exactly after the trickling process and before the bubbling process.

In the event delegation, or bubbling model, the propagation process will continue (bubbling) upward until the event is canceled or reaches the document's root (whichever comes first). You can intercept the event at any node on its path up the DOM by adding event listeners. (It is "simple handling" if the event listener is attached to the event target itself.) These listeners watch for specific events, for example `click` or `mouseover`. They know which method or function to call and they know which element was the target of the event. If desired, they can stop the event from continuing all the way up to the root. Using DOM level 2's `addListener` method, you can add as many listeners as you like and have them wait for as many different events and call as many methods as you like.

### The YUI Custom Event approach

The [Yahoo! User Interface Library](http://developer.yahoo.com/yui) (YUI) implements a [Custom Event](http://developer.yahoo.com/yui/event/#customevent) Object. This pattern allows you to define events unique to your application, subscribe listener methods to them, and fire the events whenever you want. These "[Interesting Moments](http://looksgoodworkswell.blogspot.com/2005/12/storyboarding-interesting-moments.html)" can immediately notify an unlimited number of components, controls, and widgets. The trigger of these interesting moments can be an event within the user interface, or a direct call fired by logic in your application.

#### A Quick Example of a Custom Event:

Imagine a HTML page that has a dynamic content area that is updated by an AJAX method (using, for example, the [YUI Connection Manager](http://developer.yahoo.com/yui/connection/)). Imagine that other components in the page need to know when new content arrives (so they can take some action). There are two ways to implement this:

-   For each and every component that needs to be notified of new content's arrival, add a new method to your AJAX method. Then, each time this roster of curious components grows, shrinks or changes, manually modify the central AJAX method. This pattern is disliked because it requires ongoing maintenance and awareness and introduces brittleness.
-   The alternative, preferred approach is to define a custom event within your AJAX method. This custom event (publisher) fires without caring who, if anybody, is listening (subscriber). You can have an unlimited number of subscribers without modifying the AJAX method. (See image.) Note that subscriber methods are executed in the order they subscribed, which can be potentially tricky if you have priorities for different components.

```
var Foo = function () {
  var obj = {};
  // private stuff
  var callback = {
    success: function (o) {
      // content substitution here...
	  // ...
      // notification  to every component of the new content's arrival...
      obj.onArrive.fire();
    },
    failure: funciton (o) {}
  }
  handle = null;

  // public vars
  obj.onArrive = new YAHOO.util.CustomEvent('onArrive');

  // public methods
  obj.fetch = function (uri) {
    handle = YAHOO.util.Connect.asyncRequest('GET', uri, callback);
  };
  return obj;
}();

Foo.onArrive.subscribe ( YAHOO.example.SnapShot );
Foo.onArrive.subscribe ( YAHOO.example.FormValidation );

```

The second approach, based on Custom Events, is preferable because it follows [Modular Design](http://www.w3.org/DesignIssues/Principles.html#Modular) principles, reducing brittleness and maintenance.

Another useful feature of Custom Events involves scope. During the creation of the object you can specify which object will be used as the default scope during the execution chain. You can also set a scope for each subscriber: each component can subscribe to other's behaviors while keeping the execution within the component's own scope. This is illustrated in the code below:

```
var navigate = new YAHOO.util.CustomEvent('navigate', navigateGlobalScope);
var onNavigate = function(e){
  var t=(e?YAHOO.util.getTarget(e):null);
  navigate.fire(e, {action: 'navigate', target: t, decrepitate: false});
};
navigate.subscribe ( YAHOO.example.myComponent.myBehavior, YAHOO.example.myComponent, true );
navigate.subscribe ( YAHOO.example.myOtherComponent.myOtherBehavior );

```

In this case the `myBehavior` method is executed under the scope of the component (`myComponent`), but in the other subscriber the scope of the execution will be the `navigateGlobalScope` object. By default the `navigateGlobalScope` param is the `window` object.

#### Propagation in the execution chain:

Another possible issue in the execution chain is event propagation; you can't stop the event's bubbling after certain subscribers execute. To solve this problem you can define a custom event's scope value, and a condition based on the subscriber execution using this value.

How to deal with propagation in the Custom Event technique:

```
// preparing the Subscriber
var myGlobalBahavior = function (layer, args) {
  // verifying if the event was already adopted, and checking if the target is available
  if (!args[1].decrepitate && YAHOO.lang.isObject(args[1].target)) {
    // Adopting the event and doing your stuff here
    // ...
    // Stopping the event's bubbling & preventing the default behavior (window) for this event
  	YAHOO.util.Event.stop(args[0]);
  	// Reclaiming the event and stopping the propagation
    args[1].decrepitate = true;
  }
};

// preparing the Custom Event
var navigate = new YAHOO.util.CustomEvent('navigate');
var onNavigate = function(e){
  var t=(e?YAHOO.util.getTarget(e):null); // getting the event target
  // starting the execution and defining the custom event's scope values
  navigate.fire(e, {action: 'navigate', target: t, decrepitate: false}); 
};

navigate.subscribe ( myGlobalBahavior );

```

In this example we use a scope variable called "decrepitate" to track the status of the custom event execution chain. If the value is true, the event has already been consumed by one of the subscribers.

#### Defining a behavior layer for your application

With event delegation you attach event listeners at high DOM-tree levels (closer to the root node). These listeners catch an event as it bubbles up the DOM during the bubble phase from a child node up through its parents. This allows us to have fewer event listeners while still processing events before the browser fires the default behavior for that event.

The corresponding code for catching events at a high DOM level is shown below:

```
YAHOO.util.Event.addListener(window, "resize", function (e) {} );
YAHOO.util.Event.addListener(document.body, "click", function (e) {} );
YAHOO.util.Event.addListener(document.body, (isOpera?"mousedown":"contextmenu"), function (e) {});
YAHOO.util.Event.addListener(document.body, "mouseover", function (e) {} );
YAHOO.util.Event.addListener(document.body, "mouseout", function (e) {} );

// For "document.body" listeners you must wait until the DOM structure is ready (onDOMReady).

```

After we apply these listeners we can catch all applicable events and get their target — unless an event handler attached below our listener purposely stops the propagation process, of course. By doing this, we have created a behaviors "layer" because all the events will be listened for and caught at the same high level (close to or at the root). With this in place, our challenge is to manage all the events and bind certain targets (DOM elements) with certain behaviors (JavaScript functions).

### Let's rock!

The trick is to change the way we understand the connection between target and event. Usually you need to attach a listener (using, say, [YAHOO.util.Event.addListener](http://developer.yahoo.com/yui/event/#event)) to fire a certain behavior on a certain target. This approach is unfortunately overly DOM-centric: You need to wait until a DOM element is available to attach the listener. Before looking at a superior alternative, let's look at a few additional disadvantages:

-   If a certain element (used by a component) is generated or loaded by another component there is an undesirable dependency between components.
-   Event listeners that aren't removed from deleted DOM structures can leak memory. To avoid this one must be disciplined about "garbage collection." This maintenance requirement is nice to avoid.
-   Because element IDs are often used to attach listeners, this system encourages authors to create too many and sometimes-superfluous IDs.
-   Code reuse is difficult because you need to analyze the environment thoroughly and accurately to verify the correct behavior. Has everything matched up correctly?

There is a nearly opposite approach: when an event is fired all available components are queried and action is taken if the event target corresponds. In this case, every component hangs its behaviors to the corresponding behavior layer (click, mouseover, mouseout, keypress, etc). This is a less-brittle approach because whether or not the component is available your application will function without error. (Note: priority, as mentioned above, is still important.) The disadvantages of this method are:

-   The application spends processing cycles matching behaviors.
-   The behavior chain needs to be created in a logical order when you use similar behaviors for the same element.

### Steps for the creation of a behavior layer for click events:

1.  Create a Custom Event instance (navigate).
2.  Create a Custom Event trigger method (onNavigate).
3.  Bind the Custom Event trigger to the highest level in the DOM (document.body).

```
var navigate = new YAHOO.util.CustomEvent('navigate');

var onNavigate = function(e){
  var t=(e?YAHOO.util.getTarget(e):null);
  navigate.fire(e, {action: 'navigate', target: t, decrepitate: false});
};
YAHOO.util.Event.addListener(document.body, "click", onNavigate);

```

The next challenge is identifying the available behaviors for a certain event. The process is simple: after the creation of the behaviors layers — and right after the subscribers are ready — every event will reach its corresponding behavior layer depending on the event type (`click`, `mouseover`, etc) carrying its target reference. Using the event's type (for example, `click`) and target (the DOM element), you can query every behavior. If a behavior accepts the event it can flag it (but not stop it) and notify subsequence behaviors that the event has already been "consumed." (You can ignore this flag, of course.)

There are various ways to identify the target:

-   Use the "id" attribute. Not recommended because it's a GUID for the entire document which makes it difficult to use the same behavior for different elements.
-   Use the "rel" attribute. Not recommended because not all elements support this attribute [according to the W3C](http://www.w3.org/TR/REC-html40/struct/links.html#adef-rel).
-   Use the "class" attribute. This works best because elements can have one or more classes, and because different elements share class values.

Each behavior will analyze each event based on:

-   If the current event was consumer by another behavior in the execution chain (if the custom event was flagged)
-   The event type (`click`, `mouseover`, `mouseout`, etc.)
-   The `tagName` of the target, depending on the element type
-   The `className` of the target, verifying if the target or an ancestor have a certain className attached

Using my [bubbling library](http://www.bubbling-library.com/) (free, BSD license), a global behavior would look like this:

```
// If the event's target has a certain className ('actionMyGlobalBehavior'), this behavior will adopt the event
YAHOO.CMS.Bubble.addDefaultAction('actionMyGlobalBehavior',
  function (layer, args) {
    // Arguments:
    // args[1].decrepitate - (Boolean) "True" If the event was already adopted
    if (!args[1].decrepitate) {
      // args[0]         - (Event object)
      // args[1].target  - (DOM reference) Target element 
      // args[1].anchor  - (DOM reference) If the target was an anchor 
      // args[1].button  - (YUI button reference) If the target was a YUI button 
      // args[1].input   - (DOM reference) If the target was an input 
      // ---------------
      // your stuff here
      //----------------
      // consuming the event, and stopping the propagation
      return true; // is equivalent to: args[1].decrepitate = true; args[1].stop = true;
    }
  }
);

```

As you may have noticed, it's very simple to reuse components in different environments: Just include the component in the execution session (or load `onDemand`) and the component will attach its behaviors to the corresponding layers. If a class of DOM elements is available in a certain moment, the event will be caught and passed to a certain component. In this way you can have a library of components that may be used in different applications in a simple way without needing to modify the component's behaviors.

![Simple Handling and Bubbling Techniques](/yuiblog/blog-archive/assets/caridy-models.jpg)

[Christian Heilmann](http://wait-till-i.com/) mentioned the biggest plus of this approach in his January 2007 YUI Blog article [Event-Driven Web Application Design](/yuiblog/2007/01/17/event-plan/).

> ...\[It's good because you can\] cut the big application down into manageable chunks and components and you can plan the detailed usability, information architecture and accessibility for each component separately. This allows you to develop in parallel with the design or information architecture team and results in reusable components for other applications.

### Examples illustrating the benefits of these principles:

#### The first example is a common problem related to the actions' trigger:

-   **Situation:** You have a link (anchor) in the page, with a certain behavior attached (using the simple handling technique: `addListener`), and you'd like to change the element to a [YUI Button Control](http://developer.yahoo.com/yui/button/).
-   **Problem:** You need to change the visual layer (CSS / XHTML), change the initialization process to switch the anchor for the Button instance, and change the behavioral layer to change the way you add the listener to the button.
-   **Solution:** Create a global behavior, and make action's trigger relevant (you can react differently for links versus buttons) but not determinant (you can forget the target element type), and you don't need to change anything in the behavioral layer.
-   [See the example here.](http://www.bubbling-library.com/sandbox/bubbling/behavior-actionprompt-anchor-button.html)

#### The second example is related to the dynamic navigation theory:

-   **Situation:** You have a dynamic website with various menus and a main content area. Some links display information in the main area without reloading the whole page; links to external sites navigate to that new page. Other links are used by widgets to fire certain dynamic behaviors.
-   **Problem:** The first challenge is identification because you need to know the link type (its destination) before you can fire the appropriate behavior. Links inside the main area are even more difficult because they are replaced by new links as new content is loaded into the region.
-   **Solution:** The pre-processing method can solve this problem (pre-process every link every time you load new content and attach to every link the corresponding behavior. This approach is inefficient and will drive you crazy when you use many widgets and different dynamic areas. The better solution is the creation of a global behavior (in the navigation layer) that will process every click in the document and will fire a certain behavior depending of the event target.
-   [See the example here](http://www.bubbling-library.com/sandbox/dispatcher/framework/simple.php)

[There are many additional examples you can explore.](http://www.bubbling-library.com/eng/examples)

## Conclusions

-   The creation of a global behavior layer is superior for dynamic web sites and web applications. It is an evolutionary step in web application development and offers easy and fast component integration.
-   The bubbling technique and YUI Event Utility's Custom Event functionality is a powerful tool for event-driven web application design.
-   This programming pattern will free your application from the constraints of defined elements. It will decrease the number of event listeners, unbind behavior from specific DOM elements, and improve the "unobtrusiveness" of our web applications. It minimizes the pre-processing (DOM walking) for content loaded on-demand.
-   The [Bubbling Library](http://www.bubbling-library.com/) is an easy-to-adopt YUI extension that facilitates this pattern.