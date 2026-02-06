---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Caridy Patiño Mayea's Event Binder Module Provides Support for Early Event Binding and Event-driven Module Loading"
author: "Caridy Patino"
date: 2010-06-23
slug: "event-binder"
permalink: /blog/2010/06/23/event-binder/
categories:
  - "Development"
---
_This article introduces my [Event Binder module](http://yuilibrary.com/gallery/show/event-binder), recently released in the YUI 3 Gallery._

[YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") is getting good traction in the developer community, with significant adoption of the latest 3.1.1 release and a huge infusion of new, innovative projects in the [YUI 3 Gallery](http://yuilibrary.com/gallery/show "YUI Library :: Gallery"). Many developers are getting their heads around the on-demand nature of YUI 3 and starting to leverage those capabilities in their designs. This approach has big advantages, but it also can present some challenges.

One of these challenges is to catch user interactions early. Even as the browser starts rendering the page, we want the user to be able to start interacting with page elements. In many cases, those interactions might happen before the JavaScript initialization process (including the attachment of event listeners) has completed.

In many cases you can streamline your initialization code by setting only your event listeners and then adding the logic for loading the pieces that you need for every user interaction. Recently, engineers at Facebook talked about a similar approach to improve the loading process — [see the interview from Rey Bango](http://blog.reybango.com/2010/04/21/jsconf-2010-video-interviews-with-top-javascript-developers/) at JSConf. Here is an example of how this technique might work in YUI 3:

```
 <script src="http://yui.yahooapis.com/combo?3.1.1/build/yui/yui-min.js&
 
	3.1.1/build/oop/oop-min.js&3.1.1/build/event-custom/event-custom-base-min.js&
	3.1.1/build/event/event-base-min.js&3.1.1/build/dom/dom-base-min.js&
	3.1.1/build/dom/selector-native-min.js&3.1.1/build/dom/selector-css2-min.js&
	3.1.1/build/node/node-base-min.js"></script>
 
YUI().use('event-base', function(Y) {
    // wait until the user focuses on an input element to start loading assets
    Y.on("click", function(e) {
 
      Y.use ('anim', 'io', function() {
          // load a remote content and display it using an animation here
      });
 
      e.halt(); // stop the propagation
    }, "#demo");
});
```

This introduces some complexity in your code because listeners not only have to deal with the user interaction but also with some loading logic. Another downside to this approach is that you still have to load some JavaScript code at the top (in this case YUI seed, the Event Utility, and some dependencies) in order to define at least the listener and the loading logic to catch early actions. So, let’s consider this as two separate use-cases:

-   [Capturing early user interactions](#early-interactions)
-   [Facilitating the on-demand nature of some user interactions](#on-demand-interactions)

To address these needs I've created a new module for [YUI 3](http://developer.yahoo.com/yui/3/). My main focus has been to create a component that works without affecting your application logic. This new module is called "[gallery-event-binder](http://yuilibrary.com/gallery/show/event-binder)" and is now available through the YUI Loader.

### Capturing early user interactions

The main goal of this feature is to guarantee that user interactions are queuing until event listeners are initialized.

Let’s see an [event binder example](http://caridy.github.com/examples/gallery-event-binder/simple.html):

```
YUI({
    //Last Gallery Build of this module
    gallery: 'gallery-2010.06.07-17-52'
}).use('gallery-event-binder', 'event', function(Y) {
 
    Y.on('click', function(e) {
 
        // do your stuff here
        e.halt(); // stop the event propagation if you want...
 
    }, '#demo');
 
    // flush early user interactions
    Y.EventBinder.flush('click');
 
});
```

In this example, YUI Loader will try to load the `gallery-event-binder` and `event` modules on-demand, and once they're both ready along with their dependencies, the code within the callback function (third argument) will be executed. During execution, a listener is set for an element with `id=demo`. The trick here is that once `Y.EventBinder.flush('click')` gets called, the system will flush some of the click events that might have happened before this initialization code gets executed.

#### The configuration

This technique requires some extra configuration, specifically the definition of `YUI_config` as a global variable to tweak the YUI execution. Don't worry, it's very simple. Let's see an example in details:

```
 
YUI_config = {
    // standard YUI_config configuration
    combine: true,
    filter: 'min',
 
    // event binder configuration starts here
    eventbinder: {
        // Event handler to store events that you want to redispatch.
        fn: function(e) {
            var binder = YUI_config.eventbinder,
                filter = /yui3-event-binder/,
                container = (e.target || e.srcElement),
                info = {
                    target: container,
                    type : e.type
                };
 
            // look for an element with the class yui3-event-binder
            while (container && !filter.test(container.className)) {
                container = container.parentNode;
            }
 
            if (container) {
                (binder.q = binder.q || []).push(info);
 
                // prevent the default browser action for this event
                if (e.preventDefault) {
                    e.preventDefault();
                }
                return (e.returnValue = false);
            }
        },
        // interface to listen for specific events
        listenFor: function(type) {
            var d = document;
            // Before the library loads, we have to deal with browser inconsistencies
            if (d.addEventListener) {
                d.addEventListener(type, this.fn, false);
            } else {
                d.attachEvent('on' + type, this.fn);
            }
 
            return this;
        }
    }
};
// add events to the monitoring process
YUI_config.eventbinder.listenFor('click');

```

This code should be included at the very top of the page. It will be just a few bites once you [minify](http://yui.2clics.net/ "Online YUI Compressor") this configuration object. I recommend using a cacheable (external) file for production and including it in the head section in your pages. You can read more about `YUI_config` and the different configurations that you can tweak through this object in the [official API documentation](http://developer.yahoo.com/yui/3/api/config.html).

You can modify this configuration to suit you best, and define events that you care about as well. In the above example, we added 'click' to the monitoring list (last line). You can add multiple events to the monitoring list using chaining:

```
YUI_config.eventbinder.listenFor('click').listenFor('keyup').listenFor('mouseover');
```

**How does this feature work?**

Once the configuration (i.e., `YUI_config`) logic is executed, along with the call to `YUI_config.eventbinder.listenFor`, a listener for a specific event type will be defined. Only events that bubble up will be monitored as the listener will be defined for the `document` element. When a user interaction is caught at this level, it will be analyzed, specifically checking if the target element or any of its ancestors has classname `yui3-event-binder`. If so, the event will be added to a queue and the default behavior for that event will be prevented. This technique provides an easy way to monitor specific types of interaction in specific areas of the page.

When this code is executed, listeners for events of the specified type or types are added to the `document`, so when those events occur and bubble up (this only monitors events that bubble), they will be stopped and their information stored in a processing queue. Later, in your `use()` callback when your initialization is finished, simply call `Y.EventBinder.flush` to redispatch all the stored click events as if they happened just then—courtesy of the event-simulate module.

### Facilitating the on-demand nature of some user interactions

The main goal of this feature is to help developers to define loading logic based on user interactions.

Here’s [another event binder example](http://caridy.github.com/examples/gallery-event-binder/modules-on-demand.html):

```
 
YUI({
  modules: {
    'my-custom-module': {
      fullpath: './my-custom-module.js'
    }
  }
}).use('gallery-event-binder', 'node', function(Y) {
 
  // set a listener for '#demo a' and rely on 'my-custom-module' 
  // to handle that particular event.
  Y.EventBinder.on('click', 'my-custom-module', '#demo a');
 
  // set a delegate listener for all the anchors in a list and rely  
  // on 'my-custom-module' and 'my-another-module' to handle those particular events
  Y.EventBinder.delegate('click', ['my-another-module'], '#mylist', 'li a');
 
});

```

Here we use `Y.EventBinder.on` and `Y.EventBinder.delegate` to define some listeners. These two methods wrap `Y.on` and `Y.delegate` to drive loading logic through a user interaction. This lets us defer loading of specific functionality on a page until the user tries to use a particular feature.

In this case, when a user clicks on one of the elements, we load one or more custom YUI modules that implement all the features associated with that particular click. Once those modules become available (and new listeners are set), the binder will flush the event that was on hold during the loading process to preserve the state of the action.

This feature doesn't require any initial configuration. Both of Event Binder's features can be used at the same time to cover early and on-demand user-interactions. In this case, you need to define the configuration, then set the on-demand listeners, and finally flush the early events.

Here’s [an end-to-end event binder example](http://caridy.github.com/examples/gallery-event-binder/end2end.html):

```
 
// configuration
YUI_config = { /* your custom event-binder configuration here */ };
YUI_config.eventbinder.listenFor('click')
 
// initialization
YUI({
  modules: {
    'my-custom-module': {
      fullpath: './my-custom-module.js'
    }
  }
}).use('gallery-event-binder', function(Y) {
  
  Y.EventBinder.delegate('click', ['my-custom-module'], '#doc', '.yui3-event-binder a');
  Y.EventBinder.flush('click');
 
});

```

### A more advanced configuration

You can modify the `fn` function in your configuration to be more selective about which events to queue and you can store more information about the events. Additionally adds a `yui3-waiting` class to the click target which we style in CSS to display a loading spinner:

```
 
YUI_config = {
    // standard YUI_config configuration
    combine: true,
    filter: 'min',
 
    // event binder configuration starts here
    eventbinder: {
        // set of options that should be preserved for every event (all optional)
        eventProperties: [
            "ctrlKey", "altKey",
            "shiftKey", "metaKey",
            "keyCode", "charCode",
            "screenX", "screenY",
            "clientX", "clientY",
            "button",
            "relatedTarget"
        ],
 
        // listener callback function
        fn: function(e) {
            var binder = YUI_config.eventbinder,
                props = binder.eventProperties,
                filter = /yui3-event-binder/,
                target = (e.target || e.srcElement),
                container = target,
                info = {
                    target: target,
                    type : e.type
                },
                i;
 
            if (target.nodeType === 3) {
                // target is a text node, so use its parent element
                target = target.parentNode;
            }
 
            // look for an element with the class yui3-event-binder
            while (container && !filter.test(container.className)) {
                container = container.parentNode;
            }
 
            if (container) {
                target.className += ' yui3-waiting';
 
                // back up the event properties to simulate the event later on
                for (i = props.length - 1; i >= 0; --i) {
                    info[props[i]] = e[props[i]];
                }
 
                (binder.q = binder.q || []).push(info);
 
                // prevent the default browser action for this event
                if (e.preventDefault) {
                    e.preventDefault();
                }
                return (e.returnValue = false);
            }
        },
 
        listenFor: function(type) {
            var d = document;
 
            if (d.addEventListener) {
                d.addEventListener(type, this.fn, false);
            } else {
                d.attachEvent('on' + type, this.fn);
            }
 
            return this;
        }
    }
};
// add events to the monitoring process
YUI_config.eventbinder.listenFor('click');

```

Check out this [event binder example](http://caridy.github.com/examples/gallery-event-binder/end2end.html) to see this advanced configuration in action.

**Conclusion:**

For high performance web applications, it's important for pages to load and become responsive quickly. To accomplish this, we have to rely on on-demand loading techniques. Once you start using them, it's equally important to control user interactions that can happen before the corresponding code for an action become available.

[Event Binder (gallery-event-binder)](http://yuilibrary.com/gallery/show/event-binder) provides friendly APIs to deal with both use-cases without you having to change your application logic. It can be applied to any [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") application without introducing extra complexity to your code.