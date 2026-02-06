---
layout: layouts/post.njk
title: "Creating Custom Modules with YUI Using the YUI Module Control"
author: "Cyril Doussin"
date: 2007-12-19
slug: "custommodules"
permalink: /2007/12/19/custommodules/
categories:
  - "Development"
---
## Introduction

The [Yahoo! User Interface Library](http://developer.yahoo.com/yui/) ships with a few controls such as [Calendar](http://developer.yahoo.com/yui/calendar/) or [Panel](http://developer.yahoo.com/yui/container/panel/) which allow a Javascript programmer to quickly add highly interactive functionality to a web site. As stated in the documentation:

> The [Container](http://developer.yahoo.com/yui/container/) family of components is designed to enable developers to create different kinds of content-containing modules on the web. [Module](http://developer.yahoo.com/yui/container/module/) and [Overlay](http://developer.yahoo.com/yui/container/overlay/) are the most basic containers, and they can be used directly or extended to build custom containers. Also part of the Container family are four UI controls that extend Module and Overlay: [Tooltip](http://developer.yahoo.com/yui/container/tooltip/), [Panel](http://developer.yahoo.com/yui/container/panel/), [Dialog](http://developer.yahoo.com/yui/container/dialog/), and [SimpleDialog](http://developer.yahoo.com/yui/container/simpledialog/).

These four UI controls actually all extend Overlay, which itself extends Module. The [YAHOO.widget.Module](http://developer.yahoo.com/yui/container/module/) object provides a basic framework that you can use to create custom UI controls which follow the common header/body/footer paradigm. This isn't the only pattern you can use in building YUI-based widgets, but it's one I've used to good effect in my own projects.

If you would like to build a similar content-containing Control, YAHOO.widget.Module provides you with a good base for several reasons:

-   the logic of your Control will have a flexible, event-driven, execution flow
-   your code will be structured and easily maintainable
-   you will inherently be able to have multiple, independant instances of your Control on the same page, without any code conflict occuring

This article looks at the process of extending YAHOO.widget.Module in order to build such a Control. Our example will be a potentially long list of contacts, which we will turn into a customisable, paginated list.

## Structured Markup

The basic markup for our example will be a small contact list: <h2>Contacts</h2> <ol> <li> <dl> <dt>Name</dt> <dd>Ed Eliot</dd> <dt>Web site</dt> <dd><a href="http://www.ejeliot.com/">ejeliot.com</a></dd> </dl> </li> <li> <dl> <dt>Name</dt> <dd>Stuart Colville</dd> <dt>Web site</dt> <dd><a href="http://muffinresearch.co.uk/">Muffin Research Labs</a></dd> </dl> </li> <li> <dl> <dt>Name</dt> <dd>Ben Ward</dd> <dt>Web site</dt> <dd><a href="http://ben-ward.co.uk/">ben-ward.co.uk</a></dd> </dl> </li> </ol>

As detailed in the [YAHOO.widget.Module](http://developer.yahoo.com/yui/container/module/index.html) documentation, a [standard markup structure](http://developer.yahoo.com/yui/container/module/index.html#html) has been defined for all Modules. So let's apply it to our control: <div id="contact-list"> <div class="hd"> <h2>Contacts</h2> </div> <div class="bd"> <ol> <li> <dl> <dt>Name</dt> <dd>Ed Eliot</dd> <dt>Web site</dt> <dd><a href="http://www.ejeliot.com/">ejeliot.com</a></dd> </dl> </li> <li> <dl> <dt>Name</dt> <dd>Stuart Colville</dd> <dt>Web site</dt> <dd><a href="http://muffinresearch.co.uk/">Muffin Research Labs</a></dd> </dl> </li> <li> <dl> <dt>Name</dt> <dd>Ben Ward</dd> <dt>Web site</dt> <dd><a href="http://ben-ward.co.uk/">ben-ward.co.uk</a></dd> </dl> </li> </ol> </div> <div class="ft"></div> </div>

This may at first seem like unnecessary extra markup, but as you develop many controls, you will appreciate the consistency that this markup structure brings to your code (both Javascript and CSS), and the shortcuts YAHOO.widget.Module makes available to you as a result.[Example 1](/yuiblog/blog-archive/assets/cyril-module/1.html)

## Including YUI dependencies

We will be using the [YAHOO](http://developer.yahoo.com/yui/yahoo/), [YAHOO.util.Dom](http://developer.yahoo.com/yui/dom/) and [YAHOO.util.Event](http://developer.yahoo.com/yui/event/) objects, along with the base code for YAHOO.widget.Module, which is contained in container-min.js:<script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/yahoo-dom-event/yahoo-dom-event.js"></script> <script type="text/javascript" src="http://yui.yahooapis.com/2.4.0/build/container/container-min.js"></script>

## Building the Control step by step

YUI offers functionality such as namespacing, extension, configuration objects, and [Custom Events](http://developer.yahoo.com/yui/event/#customevent) which you can make use of when creating your own UI controls. After analysing each of these features separately, we will end up with a structured template of code which we will then use for our control.

### Namespacing

You should use `YAHOO.namespace` in order to isolate your code into its own namespace, making sure it does not pollute the global scope or conflicts with any third party code (including YUI itself). Grouping all your code in an object under the global `YAHOO` object is considered standard practice:YAHOO.namespace('Cyril');

### Extending

You then need to define your constructor and specify that your new Object will be inheriting YAHOO.widget.Module:YAHOO.Cyril.ContactList = function(el, userConfig) { YAHOO.Cyril.ContactList.superclass.constructor.call(this, el, userConfig); }; YAHOO.extend(YAHOO.Cyril.ContactList, YAHOO.widget.Module); // make our widget an event provider YAHOO.lang.augmentProto(YAHOO.Cyril.ContactList, YAHOO.util.EventProvider);

The two parameters accepted by the constructor are:

el

A reference to the main HTMLElement for the Control (the "contact-list" element in our example)

userConfig

A configuration object (more on this later)

We are also augmenting at this stage our Control's prototype with EventProvider (see [Custom Events](#custom_events)).

We are now ready to instantiate our Control:YAHOO.util.Event.onDOMReady(function() { var contact\_list = new YAHOO.Cyril.ContactList('contact-list'); // store a reference to the instance YAHOO.Cyril.contactLists = \[ contact\_list \]; });

And start taking advantage of the functionality offered by YAHOO.widget.Module, for example the "element", "header", "body" and "footer" properties:YAHOO.util.Event.onDOMReady(function() { var contact\_list = new YAHOO.Cyril.ContactList('contact-list'); YAHOO.Cyril.contactLists = \[ contact\_list \] YAHOO.util.Dom.batch(\[ contact\_list.element, contact\_list.header, contact\_list.body, contact\_list.footer\], function(el) { el.style.border = '1px solid red'; }) }); [Example 2](/yuiblog/blog-archive/assets/cyril-module/2.html)

### Configuration

You can define a default configuration for the properties of your Control. These could for example define how your Control should behave in a particular situation.

You can also override this default configuration for each instance of your Control. This is a structured way of implementing customisation./\*\* \* Initializes the class's configurable properties which can be changed \* using the Overlay's Config object (cfg). \* @method initDefaultConfig \*/ YAHOO.Cyril.ContactList.prototype.initDefaultConfig = function () { YAHOO.Cyril.ContactList.superclass.initDefaultConfig.call(this); /\*\* \* Maximum number of contacts to show \* @config \* @type Number \* @default 2 \*/ this.cfg.addProperty('num\_contacts', { handler: this.configNumContacts, validator: this.validateNumContacts, suppressEvent: true, supercedes: false, value: 2 }); /\*\* \* Makes sure that the "num\_contacts" config property cannot be set to anything else than 1, 2 or 3. \* @method initDefaultConfig \* @param {NUmber} value \*/ YAHOO.Cyril.ContactList.prototype.validateNumContacts = function(value) { value = parseInt(value); return !(isNan(value) || (value < 1) || (value > 3)); };

The optional attributes of a configuration property are:

handler

Function called whenever the configuration property is set

validator

Function returning a Boolean to validate the new value for the property.

suppressEvent

When adding a new configuration property or setting a property's value, a CustomEvent is normally fired. Setting this option to true prevents the event from being fired.

supercedes

Array of Custom Event keys. When a Custom Event is fired after adding a new property or setting or property's value, it is possible to replace any previous Custom Event of the same type which is currently queued for firing by specifying its type in this Array.

You can then use the setProperty and getProperty functions of your Control's config object to modify and access the values of your properties. contact\_list.config.setProperty('num\_contacts', 1); alert(contact\_list.getProperty('num\_contacts));

### Custom Events

YAHOO.util.Event provides a powerful mechanism for you to define custom events which can be triggered by your Controls and listened to by any other javascript function. This allows you to put in practice [Event-Driven Development](/yuiblog/blog/2007/01/17/event-plan/) in a simple, lightweight way.

The first thing the YAHOO.widget.Module.prototype.init function does is to call the "initEvents" method. This means you can define any custom event you wish to use for your Control by defining this "initEvents" function as part of your object's prototype:/\*\* \* Initializes the custom events for YAHOO.Cyril.ContactList. This method gets called by YAHOO.widget.Module.prototype.init \* @method initEvents \*/ YAHOO.Cyril.ContactList.prototype.initEvents = function() { // call the base class method to make sure inherited custom events get set up YAHOO.Cyril.ContactList.superclass.initEvents.call(this); /\*\* \* CustomEvent fired before showing a different contact \* @event beforeShowContactEvent \* @param {HTMLElement} contactElement LI HTMLElement for the contact to show \*/ this.createEvent('beforeUpdateContacts'); /\*\* \* CustomEvent fired after showing a different contact \* @event updateContactsEvent \* @param {HTMLElement} contactElement LI HTMLElement for the contact now displayed \*/ this.createEvent('updateContacts'); };

We are using the createEvent function which we made available by previously extending our Control's prototype with YAHOO.util.EventProvider. This is the standard way of creating Custom Events, which you should implement through all your YUI-based Objects (whether they extend YAHOO.widget.Module or not).

The code showing a different contact should then look like the following:

var contactElement = get a reference to the new contact element here; if (this.fireEvent('beforeUpdateContacts')) { // ... change the contact displayed to contactElement here } this.fireEvent('updateContacts');

Note the fireEvent function is also part of YAHOO.util.EventProvider.

Any javascript function can now be set up as a subscriber (also commonly called "listener") to these events, with the possibility of cancelling the custom event. When a custom event fires, the subscriber functions will be called on a "first subscribed, first called" basis. contact\_list.updateContactsEvent.subscribe(function(type, args) { alert(args\[0\].current\_index); });

### Init function

The init method of your Control is called upon instantiation. Although you are theoretically free to do what you want in this function, there are some important things you should make it do:

#### Call the init function of the superclass (ie. call YAHOO.widget.Module.prototype.init)

YAHOO.Cyril.ContactList.superclass.init.call(this, el/\*, userConfig\*/);

#### Fire "beforeInit" and "init" events when appropriate

this.beforeInitEvent.fire(YAHOO.Cyril.ContactList); // .. rest of the init function this.initEvent.fire(YAHOO.Cyril.ContactList);

Note there is no need to call this.initEvents(...) to initialise Custom Events as this gets done automatically when calling YAHOO.widget.Module.prototype.init.

#### Caching DOM references

YAHOO.widgets.Module automatically caches references to the main widget's HTML Element, and its header, body and footer child elements if they exist (class="hd", class="bd" and class="ft").

If you often need to manipulate certain HTML Elements in your Control, it is generally recommended to cache references to them as properties of your Control. Accessing a reference is faster than calling document.getElementById every time you wish to access an HTMLElement.

Having your main Element cached also means that, should you need to remove your Control from the page and then it it again later on, the state of your Control and all its HTML Elements will be preserved (see [example 4](/yuiblog/blog-archive/assets/cyril-module/4.html)). this.some\_element = document.getElementById('some\_element\_id');

I also systematically do a few things before exiting the init function:

#### initDOMManipulations

I call a function named initDOMManipulations which performs any DOM manipulation/transformation required in order to set up the Control. In our example, this is where the "previous" and "next" pagination links which sit in the footer will be created. // create/modify DOM elements (ie. previous/next links) this.initDOMManipulations();

#### initEventListeners

I call a function named initEventListeners sets up any Event listener needed for the control to function. Note this can be regular DOM Events (set up using YAHOO.util.Event.addListener) or YUI Custom Events (using YAHOO.util.CustomEvent.prototype.subscribe).

In our example we will use [event delegation](/yuiblog/blog/2007/01/17/event-plan/) ([see this Event Utility example for more on event delegation in YUI](http://developer.yahoo.com/yui/examples/event/event-delegation.html)) and set up a listener for the "click" event on our Control. The listener function will then perform the appropriate logic if the target of the Event was a pagination link. // initialise event delegation this.initEventListeners();

#### Default behaviour

And of course you can call any function of your Control's code that needs to execute when the Control is first instanciated.

In our example we will update the display of our contact list to only show contacts meant to be on the first page. // show/hide contact elements this.updateDisplay();

To sum it up, here is the complete code of our init function: YAHOO.Cyril.ContactList.prototype.init = function(el, userConfig) { // Note that we don't pass the user config in here // yet because we only want it processed once, at the // lowest subclass level (by calling this.cfg.applyConfig later on) // this also calls this.initEvents YAHOO.Cyril.ContactList.superclass.init.call(this, el/\*, userConfig\*/); // fire event saying we are about to start the initialisation this.beforeInitEvent.fire(YAHOO.Cyril.ContactList); if (userConfig) { this.cfg.applyConfig(userConfig, true); } this.contact\_elements = this.body.getElementsByTagName('li'); if (this.contact\_elements.length == 0) { return; } this.current\_index = 0; // create/modify DOM elements (ie. previous/next links) this.initDOMManipulations(); // show/hide contact elements this.updateDisplay(); // initialise event delegation this.initEventListeners(); // fire event saying initialisation of the Control is done this.initEvent.fire(YAHOO.Cyril.ContactList); };

### Multiple Controls on the same page

You may want to have several instances of your Control on the same page (eg. for controls such as calendars). A good way to do this is to simply assign a class attribute to your Control's main container Element, fetch all Elements with this class once the page has loaded and create a new instance for each. You may also want to store references to your Control instances for later manipulations.YAHOO.util.Event.onDOMReady(function() { // create an array to hold references to the Control's instances YAHOO.Cyril.contactLists = \[ \]; // grab all contact lists by their classes and instanciate them. var contact\_lists = YAHOO.util.Dom.getElementsByClassName('contact-list'); for (var i = 0, contact\_list; contact\_list = contact\_lists\[i\]; i ++) { var control = new YAHOO.Cyril.ContactList(contact\_list); // store a reference to the instance YAHOO.Cyril.contactLists.push(control); // use YAHOO.util.EventProvider's subscribe function to add a listener to a Custom Event. control.subscribe('updateContacts', function(type) { alert('Current index: ' + this.current\_index); }); } });

### Putting it all together

[Example 3](/yuiblog/blog-archive/assets/cyril-module/3.html) shows a complete example making use of everything we have seen in this article.

[Example 4](/yuiblog/blog-archive/assets/cyril-module/4.html) is a more comprehensive example and uses the recently released [YUI Profiler](http://developer.yahoo.com/yui/profiler/) to demonstrate the speed advantage of caching references and Module instances, as opposed to always destroying your Elements and Objects. You will also notice that the current page is preserved when removing/reading a Control.

## Note regarding YAHOO.util.Element

If your control deals mainly with one HTML Element and doesn't have a header/body/footer like structure, you may want to look at extending [YAHOO.util.Element](http://developer.yahoo.com/yui/element/), which by default provides you with a few things:

EventProvider

allows you to use [Custom Events](http://developer.yahoo.com/yui/event/#customevent), and to attach listeners to CustomEvents before their creation (defined in event.js)

AttributeProvider

allows you to use handle the configuration of all your Element's properties and attributes, including triggering events before and after their values are changed, via a unified API.

YAHOO.util.Element serves as the foundation for the [DataTable](http://developer.yahoo.com/yui/datatable/) and [Charts](http://developer.yahoo.com/yui/charts/) controls.