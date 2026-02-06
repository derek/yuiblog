---
layout: layouts/post.njk
title: "A Recipe for a YUI 3 Application"
author: "Satyam"
date: 2011-04-01
slug: "a-recipe-for-a-yui-3-application"
permalink: /blog/2011/04/01/a-recipe-for-a-yui-3-application/
categories:
  - "Development"
---
YUI 3 has been designed to build applications around modules. I won't discuss what a module is since it has been well described by Nicholas Zakas in his presentation [Scalable JavaScript Application Architecture](http://developer.yahoo.com/yui/theater/video.php?v=zakas-architecture). I'll just stick to how to build these modules. Most of what I will say can be found in the on-line documentation, along with several other alternatives, after all, that is the point of good documentation: to tell you about all the possible ways of doing things. That's why this is a recipe, just one way of doing it amongst many others. It also assumes a smallish application, with not as many layers as Nicholas' suggests, since this is just an article and not a book.

## Identifying the modules

The first step is to identify the modules we will need. A good approach is to start slicing the design of the application screen into individual sections: title bar, menu bar, content, side panels or whatever else there might be there. Then take a look at what the library has to offer. For example, YUI 3 has no Menu, but there is the [Node-MenuNav plugin](http://developer.yahoo.com/yui/3/node-menunav/), which takes a basic menu structure made of nested unordered list <UL> elements and turns them into an active menu. Or you may want to check the [YUI Gallery](http://yuilibrary.com/gallery/) for basic components. Anyway, you'll eventually reach the point where you have a box in that layout that you have to fill in yourself, so let's do that.

I recommend placing each module in its own file and its own directory by the same name. Thus, a `weather` module would be in `weather/weather.js`. The reason for this is because your module is likely to require some styling, some CSS and image files, it makes it easy for the built-in loader if you place them where it can easily find them, in this case, the main style sheet would be in `weather/assets/skins/sam/weather.css`, with the other assets, images and so on, alongside. This is assuming you are not using the YUI Builder which will already do things this way anyhow, but that is another story. The folder names `assets` and `skins` are more or less self-explanatory, `sam` however is not quite obvious. It is the default value for the `[skin](http://developer.yahoo.com/yui/3/api/config.html#property_skin)` property of the loader because that is the default skin shipped with YUI, named after the designer, Sam Lind. As this suggests, you are free to put your name on your own skins and the `skin` property allows you to tell YUI to load them, but to keep it simple, let's just go with the default.

## Module file template

This is the file structure I use more often, which I'll describe in a moment:

```
/*jslint devel: true,  undef: true, newcap: true, strict: true, maxerr: 50 */ 
/*global YUI*/ 
/** 
 * The module-name module creates the blah blah 
 * @module module-name 
 */ 
YUI.add('module-name', function (Y) { 
    "use strict"; 
    // handy constants and shortcuts used in the module 
    var Lang = Y.Lang, 
        CBX = 'contentBox', 
        BBX = 'boundingBox',
        NAME = 'xxxx'; 

 
    /** 
     * The Xxxx class does .... 
     * @class Xxxx 
     * @extends Widget 
     * @uses WidgetParent 
     * @constructor 
     * @cfg {object} configuration attributes 
     */ 
    Y.Xxxx = Y.Base.create( 
        NAME, 
        Y.Widget, 
        [Y.WidgetParent], 
        { 
            // Instance members here 
        }, 
        { 
            // Static members here, specially: 
            ATTRS: { 
            } 
        } 
    ); 

 
}, '0.99', { 
    requires: ['widget','widget-parent'], 
    skinnable: true 
});
```

The first two lines of comments are for the benefit of [JSLint](http://www.jslint.com/), the JavaScript verification tool which I really recommend. If you go to the [web version](http://www.jslint.com/), there is a box to set options. At the bottom of that options box you can see the way to encode those options into the file itself. If you use the YUI Builder, it will run JSLint for you and set these options for you but you can still override them for any individual file if you wish.

The doc comments are for the YUI API docs builder. It is less of a headache if you include the initial template for those API docs, eventually you will fill them. As the application grows and you are unable to remember it all, you'll need them.

Now comes the first actual line of code, the `YUI.add()` statement. This is the way to tell the YUI Loader the name and contents of the module and several other pieces of information. Module names are usually named with all lowercase letters and hyphens in between words. Those are the names you see in the [API Docs](http://developer.yahoo.com/yui/3/api/index.html) in the top-most index on the left. You can see the convention is not strictly followed, some module names don't have any hyphens. Anyway, this is mostly up to you as long as you use it consistently.

The second argument of the `YUI.add()` statement is a function that receives a single argument, conventionally called `Y`. That function contains the body of the module and `Y` is the reference to a sandboxed instance of YUI which is where you can find all the other YUI and Gallery modules you have asked for. Jumping to the bottom of that code box, you can see the rest of the arguments of the `.add()` method, the version (`'0.99'` or not quite there yet) and the configuration for this module, an object with a a series of properties. Here, I tell the Loader that this module requires `widget` and `widget-parent` and that it has a skin. Listing `widget` is redundant, since `widget-parent` already requires `widget`, but don't trouble yourself with that, the Loader won't load a module twice and, if at a later point you drop one dependency, you don't need to check for other assumptions you might have made: state them all and let the Loader deal with it. You can find a list of all the options in the API docs for the `[.addModule()](http://developer.yahoo.com/yui/3/api/Loader.html#method_addModule)` method of the Loader.

Within the body of the function, the first thing is the `"use strict";` declaration. This is for your code to comply with the ECMAScript 5 standard, which at this point puts you on the safe side to ensure compatibility with all the platforms you are likely to encounter in the future. For older interpreters, this declaration is nothing more than a string which is not assigned to anything and is ignored. The `"use"` declaration has function scope and it is safer to place it within the function body than at the top of the file, so that it only affects the module you are defining. If you place it at the top of the file, it would also apply to any other JavaScript file you load afterwards, and many of them might not comply with ES5.

Then come the shortcuts and constants, which are constants only in usage since JavaScript has no concept of constants. We name them in all-uppercase letters and underscores, as constants often are in other languages. There are two good reasons to use constants, specially string constants. First is that when you write the same string several times, you might mistype one of them and you will only notice when a bug pops up. If you use constants, JSLint will warn you when you type the constant name wrong, since it will be undefined. The second reason is that the YUI Compressor can do a better job since constant names can be compressed while string literals cannot. Good candidates for named constants are the names of configuration attributes and events.

Shortcuts, such as `Lang` for `Y.Lang` are also good because they allow you to type less, the interpreter has less to evaluate (each dot implies a new search into the object members) and they can be compressed by the YUI Compressor.

After the API docs comments for the class, we get to the actual declaration. We have to declare our class as a property of `Y`, thus `Y.Xxxx`. My suggestion is to use `Y.Base.create()` to create it, as shown here. It can only create classes derived of `Base` (and `Widget` which also is a subclass of `Base`) but that will cover most of the modules you will use so it is unusual to need to do it in other way. The first argument is the name of the module, the `[NAME](http://developer.yahoo.com/yui/3/base/#nameprop)` property described for the `Base` component. Conventionally, the `NAME` property is a camel-case version of the class name. This name is used as the prefix for events (the part before the colon like `“io:success”`), for CSS class names generated by the `Widget` class (i.e.: `"yui3-xxxx-content"`) and for the default implementation of `toString()`, which you will often see in traces by the debugger. Here I use the value of the constant `NAME` to define the class `NAME` property.

The second argument is the class it extents. You will often use either `Y.Base`, for utility modules which will have no user interface, `Y.Widget` for those that will have a UI, `Y.Plugin.Base` for plugins or any other class derived from `Y.Base`, such as any you might have already created using `Y.Base.create()`.

The third argument holds the extensions you will use. Extensions are classes whose properties and methods you want to have mixed into your class. Good candidates for extensions are `ArrayList` for `Base` or any of the `Widget-Xxxx` submodules for `Widget`. `Attribute`, `EventTarget` and `PluginHost` come already mixed into `Base` so you can always count on those three being there. Extensions are very powerful, if you look at the [source code for `Overlay`](http://developer.yahoo.com/yui/3/api/Overlay.js.html), you can see there is nothing but `Widget` and extensions. Several extensions can be mixed into a component so the third argument is an array.

Finally, we get to the actual code. The fourth and fifth arguments are both object literals containing the instance and static members of the class. Instance members are the properties and methods that go into the class `prototype`, those that each instance will get a copy and usually need to be references by `this`. Static members are those that will be shared by all instances.

## Configuration Attributes

The most important of these static members is the `ATTRS` property. This lists the configuration attributes your class will have. For example, lets say we want to have a configuration attribute called `value` to hold numeric values and initially set to 0. Within the fifth argument, we would declare it thus:

```
ATTRS: {
    value: {
        value: 0,
        validator: Lang.isNumber
    }
}
```

We can list any number of attributes in the `ATTRS` property and each can be configured with several options, two of which I've shown here. You can read about the rest of the options in the `[addAttr()](http://developer.yahoo.com/yui/3/api/Attribute.html#method_addAttr)` method of `Attribute`. As can be seen, I have used the `Lang` shortcut that I declared at the beginning of the module declaration. The `validator` must be a function that takes the value to verify and returns a Boolean. All of the `Y.Lang.isXxxx` methods do exactly that so they can be used directly. For more elaborate validators, setters or getters, you need to define functions. I recommend providing the name of the function as a string, `Attribute` takes care of resolving the function name to the actual function. For example, if I were to define a, say, `validCodes` attribute that can either take an single valid code or an array of valid codes but should always return an array, I would do:

```
ATTRS: {
    validCodes: {
        setter: '_setValidCodes'
    }
}
```

We need to declare the `_setValidCodes` method along the other instance members in the fourth argument of `Y.Base.create()`:

```
_setValidCodes: function (value) {
    if (!Lang.isArray(value)) {
        value = [ value ];
    }
    return value;
}
```

It is best to declare setters, getters and any but the most trivial of validators as separate instance functions and let `Attribute` resolve the function name into the actual function call.

In general, use setters to normalize the value, as shown above, not to produce secondary effects. All configuration attributes will fire before and after change events with the before event able to prevent the attribute from changing. Use these change events to produce any secondary effects, not the setter. The after event is the best since by then you know that nothing prevented the attribute from being set since other code might have subscribed to the before (on) change event and canceled it.

You can make your attribute more or less strict depending on how you define your validator and setter. If you make the validator very restrictive, your attribute will be very strict, accepting only valid values, in this case, the setter might be unnecessary. On the other hand, you might not use a validator at all and rely completely on the setter to massage any value received into something acceptable. For example, you can have either of these two:

```
validator: Y.Lang.isBoolean,   // to make the attribute accepts strictly a Boolean
setter: Boolean, // to make the attribute accept any value and have Boolean turn it into one
```

Setters can also serve as validators. Setters should return the value to be assigned to the attribute but they can also return `Y.Attribute.INVALID_VALUE` which will leave the attribute unchanged, as if a validator had rejected it.

When I define a configuration attribute I often define a constant for it, which I place at the top of the module (along `CBX`, `BBX` and the shortcuts), for example:

```
var VALUE = 'value',
    VALID_CODES = 'validCodes';
```

The chances are that I will use those configuration attributes several times within the module and this will save me some troubles. However, be careful, don't use that constant when declaring the attribute, don't do this:

```
ATTRS: {
    // *** Don't do this *** //
    VALUE: {
        value: 0,
        validator: Lang.isNumber
    }
}
```

If you do this, you would get an attribute called `VALUE` instead of `value`. This is a JavaScript issue, not a YUI one. Also, be careful not to overstep on any of the configuration attributes already declared for either the base class or any of the extensions. `Widget` already has a bunch of attributes declared (see [table](http://developer.yahoo.com/yui/3/widget/#attributes)) and though you would hardly add a `boundingBox` attribute yourself, you might easily forget that `visible`, `disabled`, `height` or `width` are already defined. If your intended use matches what `Widget` uses them for, everything will be fine. That said, you can alter the definition of any of them. `Y.Base.create()` merges the definition of the configuration attributes of the extension with those of the base class so, if you want to change, say, the default value for an existing attribute, you can do so by declaring that attribute again in your subclass.

Be careful if you mean to initialize an attribute with an array or an object. Objects (and arrays are objects) are passed by reference and if you initialize an attribute with an object, they might all end up pointing to the same object so that when you alter part of it (remove an item from an array or add a property to the object) you end up altering all of the instances at once. `Base`, however, has some internal logic that will allow you to safely initialize an attribute with object and array literals. If the initialization value is an object or array literal then `Base` will clone it. Use the `valueFn` option or initialize it in the class initializer for other objects.

## Other Static Members

There are two other static members you might define in the fifth argument of `Y.Base.create()`. If you are creating a plugin, you absolutely must declare the `NS` property, if you don't, the plugin will not work and silently fail. The `NS` property must be set to a string which will be used as the property name to store the plugin within the host object, keep this in mind when you pick the name so you don't override any existing property.

If you are building a widget and you plan it to support progressive enhancement, then you will use the `HTML_PARSER` static property. This is set to an object which contains properties named after the configuration attributes to set from parsing the existing HTML and either CSS3 selectors or functions that will produce their values. See [Progressive Enhancement](http://developer.yahoo.com/yui/3/widget/#progressive) in the Widget user guide.

You might also want to provide values to be used by developers using your class. The constants declared at the top of the file are completely invisible from outside the module itself. If you want to provide public constants, this is the place to do it. Examples of such are the `HEADER`, `BODY` and `FOOTER` constants of `[WidgetStdMod](http://developer.yahoo.com/yui/3/api/WidgetStdMod.html#property_WidgetStdMod.BODY)` (to use them you actually have to use the fully qualified name: `Y.WidgetStdMod.BODY` and such).

## Instance Members

The fourth argument of `Y.Base.create()` are the properties and methods that will go into the `prototype` of the created class. Usually, we declare properties first and methods later. I don't have any reason for this, the order is actually irrelevant, neither JavaScript nor YUI require you to do it this way, but it makes it easier to locate things in the source file. Though instance properties can be created on the fly in the initializer, I do recommend declaring them explicitly and initializing them. Each property should be preceded by an API doc comment.

Properties will usually be private and its name prefixed by an underscore. It is best if the public interface of the object is exposed via configuration attributes and not properties. Properties are very dumb, configuration attributes can have validators, type conversion (via setter) and produce secondary effects (via change events) and it is often not long until you find out that you want all those features.

As with configuration attributes, don't initialize properties to objects or arrays, they all end up pointing to the same object and you run into trouble. It is better to set properties that are to hold objects to `null`. Also, don't leave properties unset, if you don't know their value yet, set them to `null` instead. Later on, when debugging, a property set to `undefined` points to an error, usually a typo.

### Base Instance Methods

You might have noticed that we have not declared any constructor for our subclass. `Base` does the initialization of the module and then calls a method called `initializer`, if it exists, with the same arguments it has received when instantiated so, for all purposes, you may consider that `initializer` is your constructor. All classes derived from `Base` usually take a single argument when being created, an object containing the configuration attributes. `Base` (or `Widget`, since it is a class of `Base`) reads this argument and sets the configuration attributes before calling `initializer`. For a `Widget`, if there is an `HTML_PARSER` property, it would also have been processed and the values for the attributes read from the markup will be set as well.

The `initializer` method has several tasks. First, it should set any properties that need to be initialized to objects or arrays. Then it will publish all the events this class will produce. `EventTarget` will allow you to fire an event that has not been published first using the default settings for events, but even in this case, I suggest you declare them anyway. This is a good place to add the API docs comments for those events even if it looks a little weird, being in the body of a function declaration, but there is no better place to do so.

The argument received by `initializer` would have been processed by then, but sometimes you want some extra options to be used on initialization and you don't care to keep actual attributes for them. For example, `Base` accepts the attributes `on`, `after`, `bubbleTargets` and `plugins` (see `[Base](http://developer.yahoo.com/yui/3/api/Base.html)`) though it has no configuration attributes for those. Likewise `WidgetParent` takes a `children` attribute on initialization but has no configuration attribute of that name. The `initializer` method is the one that processes them. Thus, though your class will end up taking only one argument on instantiation, this single argument can carry all the information you might need.

JavaScript has no notion of destructors. `Base` compensates for this by allowing you to declare a `destructor` method where you can place the code to free the resources your object might have taken. This is only a partial solution, the JavaScript interpreter does not call it automatically when dropping an object so you are still responsible for destroying an object before discarding it, but at least you know a destructor will be there.

Users of your class will never call `initializer` and `destructor` directly. `Base` will call them when required. `initializer` will be called when the object is instantiated, `destructor` will be called when the user of your class calls its `destroy` method.

One of the things that often produce memory leaks are event listeners left behind. `Widget` tries to detach all listeners attached to elements of the user interface contained within the Bounding Box element, but it cannot detach any others. `Base` cannot detach any event listeners at all. This is the code I use to help me with that. Along the other private, instance properties I declare the `_eventHandles` property:

```
_eventHandles: null,
```

Then, in the `initializer` method, I set it to an array:

```
initializer: function (cfg) {
    this._eventHandles = [];
    // … ...
},
```

In the same `initializer` (also in `bindUI` if it were a `Widget`) I would then attach listeners by doing:

```
this._eventHandles.push(this.after('someAttributeChange', this._afterSomeAttributeChange, this));
```

Then, in `destructor`, I have:

```
destructor: function () {
    Y.each(this._eventHandles, function (handle) {
        handle.detach();
    });
},
```

It is here, in the `initializer`, that you hook up the event listeners for the attributes that should produce secondary effects (you may differ it for `bindUI` if this secondary effect has to deal with the UI). As I said earlier, attribute setter functions should only deal with normalizing the value of the attribute. Should that setting produce any effects beyond storing the value, these should be handled by event listeners. In the above example, I have set the method `_afterSomeAttributeChange` to listen for any change in the `someAttribute` attribute. Event listeners will receive a single argument, the event facade which I usually call `ev`, an object with several properties, one of them, `newVal` containing the value being set.

### Widget Instance Properties

Two important properties that `Widget` uses are `BOUNDING_TEMPLATE` and `CONTENT_TEMPLATE`. Both are initially set to `"<div></div>"` which produces the standard structure of two containers one within the other that most widgets use. This, however, might not be suitable for all widgets, for example, a `Button` widget might better be served by a `<span>` element within an anchor (`<a>`) element instead of two nested `<div>`s. In fact, you might not care to have a `contentBox` at all, `Widget` doesn't require you to. You can set these two instance properties to any markup you want. For example, for the `Button` class I might have:

```
BOUNDING_TEMPLATE: '<a>',
CONTENT_TEMPLATE: null,
```

Having `CONTENT_TEMPLATE` set to `null` will tell `Widget` that you don't want a `contentBox` at all. In this case the `contentBox` configuration attribute will point to the same element as the `boundingBox` configuration attribute does.

You should not put into these templates the whole HTML for the widget, make these two simple HTML elements and create any extra markup via code in `renderUI` (which we'll see later).

`Widget` will add an `id` attribute and the standard classes it uses to any markup you want, such as `yui3-xxxx`, `yui3-xxxx-visible` or `yui3-xxxx-disabled`, where `xxxx` is the value of the `NAME` property turned into lowercase.

### Widget Instance Methods

`Widget` splits its initialization in several steps. Beyond the `initializer`, called when the object is instantiated, and the `destructor`, called by `destroy`, both methods handled by `Base`, `Widget` adds `renderUI`, `bindUI` and `syncUI` for the building phase, which will be called in sequence when `Widget`'s `render` method is called.

The `renderUI` method takes care of producing the basic HTML for the widget. Both the `boundingBox` and `contentBox` have been rendered at this point. If using progressive enhancement, `renderUI` first has to check whether the elements already exist on the page. If we have used the `HTML_PARSER` property then the configuration attributes holding the references to those elements will have been set by then, if not, we need to create them.

To do so, the easiest way (assuming no progressive enhancement) is to use `Y.Node.create`, like this:

```
renderUI: function () {
    var cbx = this.get(CBX);
    cbx.append(Y.Node.create(Y.substitute(Y.Xxxx.TEMPLATE, CLASS_NAMES)));
},
```

This assumes a lot of things, which I'll explain right away. First, I have the `CBX` constant declared as shown in the first code box in this article. Then it assumes `Node` is loaded, which `Widget` uses so it is safe, but it also assumes `Y.substitute` is there, which is optional. You have to add `'substitute'` to the `requires` list for your module. Then it expects a template for the widget to be in a static variable called `TEMPLATE` which is up to you to define along other static class members (right by `ATTRS` and such). Finally it assumes there is a constant `CLASS_NAMES` declared somewhere.

I usually declare `CLASS_NAMES` up in my module definition, along BBX and CBX (see the first code box in this article), like this:

```
var BBX = 'boundingBox',
    CBX = 'contentBox',
    NAME = 'button',
    // other constants and shortcuts ….
    YCM = Y.ClassNameManager.getClassName,
    getClassName = function () {
        var args = Y.Array(arguments);
        args.unshift(NAME);
        return YCM.apply(this, args).toLowerCase();
    },
    LABEL = 'label',
    PRESSED = 'pressed',
    ICON = 'icon',
    CLASS_NAMES = {
        pressed: getClassName(PRESSED),
        icon: getClassName(ICON),
        label: getClassName(LABEL),
        noLabel: getClassName('no', LABEL)
    };
```

`CLASS_NAMES` will then be a constant containing an object with properties created by `ClassNameManager` (which also comes included with `Widget`). In the code above, I first create the shortcut `YCM` to make later accesses faster, then I create the function `getClassName`, a private function that is only accessible within the module definition. The function works pretty much like the method of the [same name](http://developer.yahoo.com/yui/3/api/Widget.html#method_getClassName) of `Widget`, but it is a static function which I can use to define further static values. That is exactly what I do later on, when I create `CLASS_NAMES` as an object with the generated class names as their properties. This allows me to write a `TEMPLATE` string such as:

```
TEMPLATE: '<label class=”{label}”><input/>',
```

Which is pretty dumb so far. I would also like to merge into this template values from other sources, specifically, configuration attributes. This is how I get to do it:

```
this.get(CBX).append(Y.Node.create(Y.substitute(TEMPLATE , CLASS_NAMES, Y.bind(function (key, suggested, arg) {
    return (key === '_'?this.get(arg):suggested);
},this))));
```

I add a third argument to `Y.substitute`, a function. Usually, placeholders for `Y.substitute` are made of characters enclosed in between curly brackets, however, if there is a space, it will split the placeholder in two, the part up to the space being the key and the second an optional argument. This comes handy when the third argument is a function, such as here. The function will receive three arguments, the first is the key, the second is the value found in the replacement object, here `CLASS_NAMES`, if any, and the third is the optional argument. So, in the statement above, I can use a template like this:

```
TEMPLATE: '<label class=”{label} for=”{_ id}”/><input id=”{_ id}” value=”{_ value}” />',
```

`Y.substitute` will find `{label}` and search for it in `CLASS_NAMES`. It will find it and get `'yui3-button-label'`. It will then call the replacement function with arguments `'label'`, `'yui3-button-label'` and `undefined`. Since `key` is not equal to `'_'` it will return the value in the second argument, the original class name. When it gets to `{_ id}`, there is no value for a property called `_` in `CLASS_NAMES` so it will call the replacement function with arguments `'_'`, `undefined` and `'id'`. With `key` equal `'_'`, the function will go and fetch the value of the `'id'` attribute. It will do the same again for the `{_ value}` placeholder.

All the constants declared at the top are hidden from any code outside the module but you might want to make some of them visible, such as `CLASS_NAMES`. To do that, in the static members section, the last argument to `Y.Base.create`, you could have:

```
CLASS_NAMES: CLASS_NAMES
```

Then the object with all the class names would be visible as `Y.MyWidget.CLASS_NAMES`.

I suggest you do as much formatting as you can with the HTML string that will make the widget's content. String manipulation in JavaScript is much faster than accessing the DOM so the more you do before calling `Y.Node.create` with that string, the faster you'll get it done.

The next instance method called for any widget is `bindUI`. This is where you attach event listeners to any elements created by `renderUI`, for example, the listener for any changes in the value in the `<input>` box of the `TEMPLATE` above. The value on the textbox and that in the configuration attribute should always be kept in sync. The `value` attribute can be changed either via code or by the user typing into the input box. If it comes from external code, the textbox should be refreshed, if it comes from the textbox, it should not, otherwise you risk entering an infinite loop: the change in the textbox sets the `value` attribute which then sets the `value` on the textbox which then changes and sets the `value` attribute and so on. Lets see how to handle this case. We set a listener on the synthetic `valueChange` event on the input box. To do that we need to add the `event-valuechange` module to the `requires` list of this module.

```
this._eventHandles.push(this._inputEl.after('valueChange', this._afterInputChange, this));
```

We assume the object has a reference to the textbox saved in `_inputEl`. The listener does this:

```
_afterInputChange: function (ev) {
    this.set(VALUE, ev.target.get(VALUE),{source:UI});
},
```

Here we assume we have the constants `VALUE` and `UI` declared as `'value'` and `'ui'` respectively. We simply set the attribute `value` to the value read from the input box. However, we are adding a third argument to the set method: `{source:UI}`. The `set` method can take a third argument, an object, whose properties will be mixed into the event facade of the attribute change event. This is the way we can tell the difference in between value being set from the textbox or from external code. In `bindUI` we would have had set this listener:

```
this._eventHandles.push(this.after('valueChange',this._afterValueChange));
```

This is the listener for a change in the `value` attribute of your object, the other was for a change in the value of the `<input>` box, they are called the same, after all, they both listen to changes in something called _value_, but are not the same thing. Usually, listeners for attribute changes are set in the `initializer`, but since this one affects a UI element, we put it in `bindUI` so that we know the textbox will be there. The listener will have:

```
_afterValueChange: function (ev) {
    if (ev.source === UI) {
        return;
    }
    this._inputEl.set(VALUE, ev.newVal);
},
```

The first thing we do is to check the `source` of the event. If it comes from the `UI` then we ignore it. Both the property name, `source` and its value, `UI` are arbitrary, those are the ones I used when setting the `value` attribute so those are the ones I check for in the listener, but any name/value would do just as well. Actually, `Widget` provides a constant for that, `[Y.Widget.UI_SRC](http://developer.yahoo.com/yui/3/api/Widget.html#property_Widget.UI_SRC)`, but it is kind of long so I would probably use a shortcut anyway.

Another tidbit: you can set attributes declared as read-only by using `_set` instead of `set`. The `_set` method is meant to be protected, to be used internally but, as we know, JavaScript knows nothing about security so `_set` is open to any but, at least, we try by declaring the attribute with `readOnly:true` and documenting it as such in the API docs.

Finally we declare `syncUI`. While the first two, `renderUI` and `bindUI` are going to be called once and only once, `syncUI` will be called at least once by Widget itself and you might call it several times afterwards. Its purpose is to refresh the UI to reflect the current state of the object. Since the state might change, the UI might need to be refreshed over time. However, I can't provide a simple recipe for handling this. For a simple UI, `syncUI` might refresh everything in the screen and be called every time anything changes. For more complex UIs refreshing the whole UI might take time and cause flickering so you might want to refresh only the bits and pieces you need. If so, you will have separate methods to refresh each of these parts and `syncUI` will call each of them just once. Moreover, as I've shown in the example for `renderUI`, I set the value of the textbox right there, though that should be done in `syncUI`.

In the more general case, you will have a function for each UI element that can be set separately. That function will be called once from `syncUI`, when initializing, and any number of times from the after attribute change event listener. For example, we could have:

```
_valueUIRefresh: function (value) {
    this._inputEl.set(VALUE, value);
}
```

Which could be called from `syncUI` along other similar setters:

```
syncUI: function () {
    this._valueUIRefresh(this.get(VALUE));
    // other such refreshers 
},
```

and by the after listener:

```
_afterValueChange: function (ev) {
    if (ev.source === UI) {
        return;
    }
    this._valueUIRefresh(ev.newVal);
},
```

## Communicating with others

Once you have the logic of one of your modules finished, you want it to interact with other modules on your page. If you've seen Nicholas Zakas video, you already know what tight and loose coupling is. Calling methods and setting attributes from one module to another means having those modules tightly coupled and it is the traditional way, so I won't talk about it since you know how to do it. The other way to do it is to fire custom events. `Base` already includes everything you need to do that.

First, in `initializer`, you `publish` the custom events you want everybody to find out about.

```
initializer: function (cfg) {
    this.publish('eventName', { /*… options … */});
},
```

Normally, the name of the event will come from a constant, since you will use that same name every time you fire it and you don't want typos there.

Normally, when you have a reference to an object, such as:

```
var myWidget = new Y.MyWidget({ /* .. attributes … */ });
```

you can listen to its events by doing:

```
myWidget.after('eventName', this._eventNameListener, this);
```

However, to do this, you need to have a reference to `myWidget`, which is not as tightly coupled as calling its methods directly but it is still quite tight: at least one module knows about the other or, perhaps, a supervisor module knows about both and sets the links in between them. Two options are important to get modules to communicate in between themselves, `broadcast` and `emitFacade`.

The first, `broadcast`, lets you set listeners for that event in other modules. When `broadcast` is left at 0, the default, you have to do as shown above. If you want the event to be listened to elsewhere, you will want `broadcast` set to 1, so events are `broadcast` within the same sandbox and sometimes 2, so they can go across sandboxes. In this context, a sandbox is what you get when you call:

```
YUI().use( 'module1', …, 'moduleN', function (Y) {
    // this is your sandbox
});
```

You can have several such sandboxes in your page:

```
YUI().use( 'module1', …, 'moduleN', function (Y) {
    // this is your sandbox
});
YUI().use( 'moduleX-1', …, 'moduleX-N', function (Z) {
    // this is another sandbox
});
```

If you set `broadcast` to 2, then an object in the second sandbox can listen to an event when fired in the first. You can see the details in the [Event user guide](http://developer.yahoo.com/yui/3/event/#broadcast). Lets just stick to the simple sandbox case.

To listen to an event fired from another module within the same sandbox you need to know the value of the `NAME` static property of that module and the name of the event. Remember, `Y.Base.create` takes, as its first argument, the value that it will use for its `NAME` property, thus, if you created a module in this way:

```
Y.MyWidget = Y.Base.create(
    'xxxx',
    Y.Widget,
    // … and so on
```

and then, in the initializer you published the `'help'` event like this:

```
initializer: function (config) {
    this.publish('help', {
        broadcast: 1,
        emitFacade: true
    });
},
```

To listen to that event in any other module within the same sandbox, you do:

```
Y.after('xxxx:help', function (ev) { … }, this);
```

Here, I am calling `Y.after`, not `myWidget.after`, I don't need to have a reference to the module firing the event. This is the same method used to listen to DOM events or other synthetic events such as `'valueChange'` the only difference being the prefix, the part before the colon. `Base` already takes care to prefix all events with the value of the `NAME` property so you don't have to take care of that when publishing them. You can do so, you can even use something else as a prefix; if one such prefix is there, `Base` will respect it, but usually you just want the default, which `Base` provides.

You also want to set `emitFacade` because you will want to have a reference to the instance that fired the event, which the event facade provides in `ev.target`. But wait, if the listener module gets a reference to the firing module, don't they become tightly coupled once again? Not quite, as long as you don't preserve that reference in the listening module, the coupling will be volatile. Still, we can do better.

When firing the event we may add all the information the listener needs in the facade, like this:

```
this.fire('help', {helpTopic: 'Event Broadcasting'});
```

Method `fire` takes the name of the event being fired (which `Base` will further prefix with the `NAME` of the class) and an object containing any number of properties which will be merged into the event facade. The listener then doesn't need to query the firing module for any information, all that might be needed is there. This is as loose as it gets. The listener simply knows that some module, and there may be many such modules, is asking for help on 'Event Broadcasting' and that is really all it needs to know. It doesn't even care which module asked for it. New modules may be added later and the help system will also work for them.

## Events and Default Behaviors

The usual solution to changing the behavior of a class is to sub-class it so you can override one of its functions and do whatever it is you want to do instead. You can still do that. You can use `Y.Base.create` to define a module based on, say `Y.Widget` and then use `Y.Base.create` again using your new module as the base to change a particular behavior. For example, I might have:

```
Y.MySimpleWidget = Y.Base.create(
    'simpleWidget',
    Y.Widget,
    [],
    {
        // instance members here, amongst them:
        renderUI: function () {
            this.get(CBX).append(Y.Node.create(' … whatever goes into the widget … ' ));
        }
    },
    {
        ATTRS: {
            // configuration attributes
        }
        // other static members
    }
);
```

and then:

```
Y.MyFancyWidget = Y.Base.create(
    'fancyWidget',
    Y.MySimpleWidget,
    [],
    {
        renderUI: function () {
            Y.MyFancyWidget.superclass.renderUI.apply(this, arguments);
            this.get(CBX).append(Y.Node.create(' … add some bells and whistles … ' ));
    }
    // Presumably the fancy version does not need any further static members so I skip the last argument
);
```

`MyFancyWidget` improves over `MySimpleWidget` by adding some bells and whistles. This might be too much of a trouble in some cases, you might plan for a base class more flexible and easier to change. Custom events can help with that.

Imagine you have a class that has a `sort` function. The sort function takes a `key` and `direction` argument and is declared like this:

```
sort: function (key, direction) {
     // sorting happens here
},
```

If you know that the behavior of that function might be changed in some circumstances, you might do the following. In the `initializer` method, you can have:

```
initializer: function (config) {
    // amongst many other things:
    this.publish(SORT, {defaultFn: this._defSortFn});
},
```

Where `SORT` is a constant containing `'sort'`. Then, you declare the `sort` function like this:

```
sort: function(key, direction) {
    this.fire(SORT, {key:key, direction:direction});
},
```

The `sort` function simply transforms the standard function call into a fired event containing the same arguments. Though this is meant to provide alternatives, you still want the class to sort somehow, you do that through the default sort function:

```
_defSortFn: function (ev) {
    var key = ev.key, direction = ev.direction;
    // same code as the original sort function
},
```

The class will do sort as before, the body of `_defSortFn` might be just the same as the original one, once you have read the `key` and `direction` arguments from the event facade, but any other piece of code can set a listener for that same sort event and change it, for example:

```
myObjectThatSorts.on('sort', function (ev) {
    var key = ev.key, direction = ev.direction;
    ev.preventDefault();
    // now do your own sort
});
```

By calling `preventDefault` I tell `myObjectThatSorts` not to call `_defSortFn`. I could do this conditionally and decide, based on whatever I want, whether I may leave the original sort go ahead or unconditionally stop it, as I did here. I might not even care to stop it ever, I might listen to the `after` event and simply flip an arrow somewhere in the UI to signal which way the sort went.

I may also alter the event facade. There is only one copy of the event facade that gets built when the event is fired and it is propagated through all before (on) listeners, to the default function and then to the after listeners until finally it is dropped. You can change the values of its properties at any point. Of course, it hardly matters any changes you might do after the default function is called but any changes done in the before (on) listeners will reach the default function, for example:

```
myObjectThatSorts.on('sort', function (ev) {
    ev.direction = (ev.direction==='desc'?'asc':'desc');
});
```

This would get the sort done upside down.

## YUI\_config

The easiest way to get your module on your page is to include it in its own `<script>` tag or in a script tag pointing to a combo URL (via creating a file on the server that is a manual concatenation of files or a combo service is the server supports one). Integrating custom modules into the Loader is a more advanced option, though it might improve performance. The important point in this case is to make sure the `YUI.add()` includes the `requires: [...]` in the last parameter, so `use()` will apply the module and its dependencies in the proper order.

For small applications, you will probably have everything loaded from the start as outlined above. However, for larger applications, you might not want everything loaded from the start since it can take too long. You can call `use()` more than once to request extra functionality as needed. However, having the Loader find out about each module's dependencies when it loads each is time consuming since it might take several sequential requests until it finally gets everything it needs. Instead, you can forewarn the Loader of your modules and their dependencies so, when the time comes, it knows how to deal with them and can load them all in parallel.

To do so, you need to add the module description and requirements to the tables that the YUI Loader uses to fetch modules. The easiest way is to build a `yui_config.js` file (or whatever you want to call it) that contains all those definitions. That file will look like this:

```
YUI_config = {
    filter:'raw',
    //combine:false,
    gallery: 'gallery-2011.02.18-23-10',
    groups: {
        js: {
            base: 'build/',
            modules: {
                'myWidget': {
                    path: 'myWidget/myWidget.js',
                    requires: ['widget', 'widget-parent', 'widget-child', 'widget-stdmod', 'transition'],
                    skinnable: true
                },
                // other modules here
            }
        }
        // other groups here
    }
};
```

You include this file in a regular `<script>` tag in your HTML file before you issue the first `YUI().use()` statement. They replace those options you would otherwise place as the first argument to `YUI().use()`, as if you did `YUI(YUI_config).use()`, but YUI does it for you. You can use any of the options listed [here](http://developer.yahoo.com/yui/3/api/Loader.html).

The `filter` option can be set to `'min'` for production code (the default so you would usually comment out), `'debug'` for the fully expanded with log statements (which might overwhelm your console) and `'raw'` for fully expanded without log statements, the last two used only in development. Likewise with the `combine` option, only used when you have really tough bugs and you want to find out what is going on and get lost in those huge combos. Then you put your `gallery` option, if you use any gallery modules, to freeze your gallery modules to a version you know it works.

The `groups` option is where you start describing your own modules. The first name, in this case `js`, can be anything, whatever you want to call your group of files. You could create one such group for each family of files in a common location. The first declaration in each group is the `base` location of the group of files relative to the home page or an absolute path. That is, basically, the criteria for grouping files, however, there are several more options, listed [here](http://developer.yahoo.com/yui/3/api/Loader.html#method_addGroup).

Finally, in the `modules` section you start listing your modules. The key for each entry is the module name, the very same name that you have used as the first argument in the `YUI.add` in your file and the same that you will use in the module list when you issue the `YUI().use()` call in your application. Then you specify the location of the module file, relative to the previous `base` or the `fullpath` if located elsewhere, and the rest of the options that where at the very end of the `YUI.add` declaration and are listed [here](http://developer.yahoo.com/yui/3/api/Loader.html#method_addModule). The `requires` list can list YUI modules, gallery modules or modules of your own either within the same group or from other groups in your config file. Skins will be loaded automatically by setting `skinnable:true` if you locate them as I recommended at the beginning of this article.

To simplify things for myself, I created a [Windows script file](http://www.satyam.com.ar/yui/3.0.0/YUIconf.zip) that builds the `YUI_config` options for me. It basically scans the folder with the module files and reads each of them and extracts the information from each `YUI.add` call by defining a fake `YUI.add` function that extracts the arguments for me. It makes plenty of quite simplistic assumptions but it works for me as it is, you use it at your own risk.

## Conclusion

YUI3 is very flexible and you can build your modules in many ways. This is no more than one way to do that; I don't always do it this way, sometimes, not often, I don't need all of what `Base` provides so `Y.Base.create` is of no use, but this works most of the time.