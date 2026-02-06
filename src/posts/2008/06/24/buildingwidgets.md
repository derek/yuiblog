---
layout: layouts/post.njk
title: "Building Your Own Widget Library with YUI"
author: "Satyam"
date: 2008-06-24
slug: "buildingwidgets"
permalink: /blog/2008/06/24/buildingwidgets/
categories:
  - "Development"
---
The [Yahoo! User Interface Library](http://developer.yahoo.com/yui/) (YUI) has an ample assortment of components. Nevertheless, there will be always some functionality you want that a library like YUI hasn't anticipated or hasn't built yet. Sometimes you just want a subset of the many options a component might provide; in other cases, you may have a default configuration that you'd like to bake into a component to facilitate consistent use across your site. The flexibility built into YUI provides intrinsic support for extending, customizing, or creating wholly new components. If you find yourself in one of these situations, then building your own library of YUI-based components may make good sense.

This lengthy article is meant to get you started creating your own custom components using the tools available to you within YUI, including the Element Utility and the Event Utility. Understanding these tools can save you lots of time and make it easy to create API-driven components that expose powerful hooks to implementers making use of your work.

-   [Customizing Existing YUI Components](/yuiblog/blog/2008/06/24/buildingwidgets/#customizing)
    -   [Using `YAHOO.lang.extend`](/yuiblog/blog/2008/06/24/buildingwidgets/#usingextend)
    -   [Creating and Using Shortcuts for Common YUI References](/yuiblog/blog/2008/06/24/buildingwidgets/#shortcuts)
    -   [Registering a Component with YUI](/yuiblog/blog/2008/06/24/buildingwidgets/#register)
-   [Developing Wholly New Widgets with YUI](/yuiblog/blog/2008/06/24/buildingwidgets/#new)
    -   [The YUI Element Utility as a Foundation for Component Development](/yuiblog/blog/2008/06/24/buildingwidgets/#element)
    -   [Managing DOM Events and Custom Events with Element](/yuiblog/blog/2008/06/24/buildingwidgets/#events)
    -   [A Closer Look at `extend`](/yuiblog/blog/2008/06/24/buildingwidgets/#extend2)
    -   [Element and AttributeProvider](/yuiblog/blog/2008/06/24/buildingwidgets/#attributeprovider)
    -   [Adding a `render` Method](/yuiblog/blog/2008/06/24/buildingwidgets/#render)
    -   [Adding a Destructor](/yuiblog/blog/2008/06/24/buildingwidgets/#destroy)
    -   [Subclasses](/yuiblog/blog/2008/06/24/buildingwidgets/#subclasses)
    -   [Bundling Functionality: The Field Object and the Fields Object](/yuiblog/blog/2008/06/24/buildingwidgets/#bundling)
-   [Progressive Enhancement](/yuiblog/blog/2008/06/24/buildingwidgets/#pe)
-   [CSS Sprites](/yuiblog/blog/2008/06/24/buildingwidgets/#sprites)
-   [Final Thoughts](/yuiblog/blog/2008/06/24/buildingwidgets/#final)

## Customizing Existing YUI Components

Let's begin by looking at how you would go about creating your own custom version of an existing YUI component.

For example, a server-side transaction may take quite a while and you may want to signal to the user that it is in progress. The [YUI Panel](http://developer.yahoo.com/yui/container/panel/) component is a handy way to produce a floating pop-up window. Panel serves many purposes, though, so it is not specifically tailored for this "loading message" implementation. You will need to implement something like the following to have your "loading-panel" pop-up displayed:

```
if (!loadingPanel) {
    loadingPanel = new YAHOO.widget.Panel('loadingPanel',{
        width:"100px", 
        fixedcenter: true, 
        constraintoviewport: true, 
        underlay:"shadow", 
        close:false, 
        visible:false, 
        draggable:true
    });
    loadingPanel.setHeader("Loading ...");
    loadingPanel.setBody('<img src="loading.gif" />');
    Dom.setStyle(loadingPanel.body,'textAlign','center');
    loadingPanel.render(document.body);
}
                    
loadingPanel.show();
```

Variable `loadingPanel` holds a reference to the Panel instance; once this instance is declared, later popups just reuse the existing instance and are therefore faster and less resource-intensive. But including implementation code like this inline in every page you need is a waste of time (because any change needs to be made in multiple places) and, for your users, a waste of bandwidth. Let's trim this down by turning it into a custom version of YUI's Panel.

In the [first sample,](/yuiblog/blog-archive/assets/buildingwidgets/sample1.html) you can see this same code both as inline code and as a reusable custom component. The custom component would normally reside in a separate file that would be included in all pages. I defined it in the page in this sample to make it easier to compare the inline syntax with the library-style syntax. The page uses the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) to load components.

The YUI Library takes care to avoid using global variables that might collide with other libraries. In fact, the whole library is packed in the properties of a single global object called `YAHOO`; thus, as long as everybody keeps away from the `YAHOO` global variable, there should be little risk of collision. We can do the same for our own libraries because, though we control our own code, in the hopefully long life of that code other features might be added. Mashups, ad providers and others might use the global namespace carelessly and inadvertently break our application. Thus, the first step is to call the `YAHOO.namespace` static function to create an object space for our own library.

```
YAHOO.namespace('SATYAM');
```

This will create a property `SATYAM` under `YAHOO`. YUI uses only a very few names under `YAHOO`; you can keep safe by simply avoiding any of those few. None of those names uses anything but lowercase characters so any or all uppercase letters will keep you even safer.

You could create your own namespace by simply assigning an empty object to `YAHOO` directly, but the `namespace` function first checks to see if the namespace exists and preserves it if it does exist. If you have several library files, you will likely want to load more than one of them in any page. Each of those library files will want to make sure the new namespace exists but while preserving it if it has already been created by another of your library files.

Once you have your own branch under the `YAHOO` namespace, you define the constructor for your custom loading panel:

```
YAHOO.SATYAM.LoadingPanel = function(id) {
                
    YAHOO.SATYAM.LoadingPanel.superclass.constructor.call(this, 
        id || YAHOO.util.Dom.generateId() , 
        {
            width: "100px", 
            fixedcenter: true, 
            constraintoviewport: true, 
            underlay: "shadow", 
            close: false, 
            visible: false, 
            draggable: true
        }
    );

    this.setHeader("Loading ...");
    this.setBody('<img src="loading.gif" />');
    YAHOO.util.Dom.setStyle(this.body, 'textAlign', 'center');
    this.render(document.body);
};
```

### Using `YAHOO.lang.extend`

Compare this code with the previous code box; you'll note that it's quite similar. You might be wondering what `superclass` is. That is part of the inheritance mechanism provided by YUI's `extend` method. After you declare the constructor for your new object, you call `extend`:

```
YAHOO.lang.extend(YAHOO.SATYAM.LoadingPanel, YAHOO.widget.Panel);
```

The sequence of first defining the constructor for the new object and then extending it with the base object may seem counterintuitive when read in a linear fashion. When you think about the sequence of execution, though, it makes perfect sense: The new object is defined by what will become its constructor, but the constructor itself does not get executed immediately. The `extend` function _does_ get executed immediately, so by the time a new `LoadingPanel` object is instanced, our new object has already been extended.

After extending the new object, `this` will refer to both the new object and the base object. Our new object inherits from Panel methods such as `setHeader`, `setBody`, `render` as well as properties like `body` that can then be accessed via `this`.

Sometimes we might want to override a method of the base object. Indeed, we have already done that — by declaring the constructor of our custom object, we are overriding the constructor of the base class. The `extend` function places all original methods under a property named `superclass`, so you still have access to all the functionality of the original method. The first thing we do within the constructor of the new object is to call the constructor of the base (superclass) object and, since that is a static function, we need to adjust the scope of the superclass constructor so that it runs in the scope of our Loading Panel's constructor. We use method `call` of JavaScript native `Function` object, which takes the first argument as the execution scope of the function called and passes it the rest of the arguments.  The YUI Librarydocumentation often uses the term "class" or "superclass" as a carry over from classical programming languages. JavaScript doesn't actually have classes (objects are derived from one another and inheritance is prototypal instead of classical)  but the word "class" is loosely descriptive of the mechanism.

Calling the base class constructor does not need to be the first thing to do in the constructor of the new class; in fact, it might not be done at all, depending on the object you are defining. You are free to do it if and when you choose. The sequence of first defining the new constructor and then extending it before trying to create an instance of that object is mandatory.

Using the object we just created is easy:

```
if (!loadingPanel2) {
    loadingPanel2 = new YAHOO.SATYAM.LoadingPanel();
}
loadingPanel2.show();
```

We simply create a new instance if none exists, and then we show it. We don't use the optional argument, a string that would become the `id` of the HTML element that our widget will create. Since we don't care to, we leave it out and let our function make one up via [YUI Dom](http://developer.yahoo.com/yui/dom/)'s method `generateId`.

### Creating and Using Shortcuts for Common YUI References

When looking at the [example](/yuiblog/blog-archive/assets/buildingwidgets/sample1.html) you might find that most of the names of the basic YUI components are not spelled out in full. That is because, close to the top of the source file, I have declared several shortcuts — that is, local variables that hold references to those library components. This has several advantages:

-   since the shortcuts are local variables inside a function they don't trash the global namespace;
-   it is shorter to write;
-   it is easier on the interpreter since instead of, for example, looking for property `Dom` in object `util` within the object `YAHOO`, which is global and, thus, the last scope in which the interpreter will search for a symbol when all other local spaces fail, it simply looks for the shortcut, which is in the local scope, the first place it searches;
-   compression utilities such as the [YUI Compressor](http://developer.yahoo.com/yui/compressor/) are free to minify variables declared locally, something it cannot do with global ones because they could be referenced in other included files that might not be compressed.

So far, we've seen the mechanism YUI provides to make inheritance easy to handle but we haven't yet produced an actual library file. We'll do it YUI-style. The file [LoadingPanel.js](/yuiblog/blog-archive/assets/buildingwidgets/LoadingPanel.js) contains a single component — basically the code we've seen so far. It first declares the namespace to use:

```
YAHOO.namespace('SATYAM');
```

Then, it puts all the code within an anonymous function, which gets immediately executed (notice the empty parenthesis at the end). This allows us to declare the shortcuts for the YUI components we will use within the library without trashing the global namespace:

```
(function(){
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Panel = YAHOO.widget.Panel;

    // here goes the library contents itself

})();
```

Right in the middle of that block we put the library code exactly as we've seen it in the previous sample.

### Registering a Component with YUI

Finally, at the very end we add the following line:

```
YAHOO.register('SATYAM.LoadingPanel', YAHOO.SATYAM.LoadingPanel, {version: "0.99", build: '11'});
```

Method `register` stores the provided information in a well known place for the entire YUI Library to access. This serves several purposes. Some YUI Library components can use optional components, usually to provide some fancy behavior such as animated transitions, so knowing where to look for currently loaded components makes it easier to see whether your optional components are present.

Most important, though, is that if you use the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/), the `register` function is the one it uses to check whether the load it has initiated finally succeeds. The call to the `register` function should be the last thing you do in each source file; that line effectively tells YUI that the module you're registering _is now ready for use_. The [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) depends on this method invocation to know when your module is safe to use.

We use that library file in our [second example](/yuiblog/blog-archive/assets/buildingwidgets/sample2.html) file. To load the library we use the following code:

```
var loader = new YAHOO.util.YUILoader();
    
loader.addModule({
    name: 'SATYAM.LoadingPanel',
    type: 'js',
    requires: ['container'],
    fullpath: 'LoadingPanel.js'
});
  
loader.require('reset', 'grids', 'base', 'SATYAM.LoadingPanel');
```

After we declare the instance of the YUI Loader that we will use, we call method `addModule` providing the information about our library file. We have to use exactly the same name we declared when we called method `register` at the end of the library itself, we tell it it is a JavaScript file (the YUI Loader can also load CSS files), we tell the dependencies it has and finally we point to its location. Perhaps `fullpath` was not a good choice of a name for the property since usually we will provide a relative path. What it actually means is that it won't be concatenated with the base path declared elsewhere, which defaults to [Yahoo's servers](http://developer.yahoo.com/yui/articles/hosting/).

Once the library information is added to the instance of the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/), we can request it just as we would with standard YUI components. We just list it in the array of modules we require for our application using the same name we've given the module all along. Keep in mind that adding the module metadata via `addModule` does not actually load the module; _it simply lets YUI Loader know it exists_. It is the `require` method that tells YUI Loader which modules we actually need in this page. When we finally call method `insert`, the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) will go through all the modules requested, find their dependencies, calculate the load order based on the dependency tree, start loading them and wait for the loaded modules to call the `register` function to signal they are loaded and ready.

This same technique could be used to create your login boxes or other standard popups or your own equivalents to the browser's native "accept" and "confirm" dialogs inheriting from [Dialog](http://developer.yahoo.com/yui/container/dialog/index.html) and [SimpleDialog](http://developer.yahoo.com/yui/container/simpledialog/index.html) in the [YUI Container](http://developer.yahoo.com/yui/container/) component. You can also use it to customize many other standard objects: [Rich Text Editors](http://developer.yahoo.com/yui/editor/) with your own set of toolbar tools and functionality, a [DataSource](http://developer.yahoo.com/yui/datasource/) with your server communication options already set up, your own application-wide menu and so on. These are all based on existing YUI components that we simply customize to suit the environment of our application.

## Developing Wholly New Widgets with YUI

So far we've been looking at how to customize an existing component using `extend`. What if we want to develop a completely new component?

Let's say we want to develop a full set of input fields so we can build input forms via JavaScript. Our basic input component will be an HTML `<label>` coupled with an `<input>` element, plus an error indicator.

### The YUI Element Utility as a Foundation for Component Development

Most YUI visual components (widgets) use a common foundation, the [Element Utility](http://developer.yahoo.com/yui/element/). Element provides several features to help manage HTML elements; additional features are inherited from `AttributeProvider` and `EventProvider` (for managing configuration attributes and custom events). One of the main design goals of the YUI Library is that it should work the same in all supported browsers (those in the [A grade list](http://developer.yahoo.com/yui/articles/gbs/)). By wrapping an HTML element with `Element` and using its methods instead of the raw DOM methods, which can behave differently in each browser, you automatically achieve a degree of cross-browser compatibility.

You can see the results in the file [Fields.js](/yuiblog/blog-archive/assets/buildingwidgets/Fields.js). By now you should be familiar with the envelope: We declare the `SATYAM` namespace, enclose everything in an anonymous function that gets immediately executed, we end it with a call to `register`, and within the anonymous function we define the usual shortcuts. Though constants don't exist in JavaScript, we also declare a prefix for all the classNames of the HTML elements we will generate and we call it `CSS_PREFIX`, all in uppercase, following the coding convention of other languages which do support constants (which helps to make our intent more plain). We will be generous in giving CSS classNames to many of the elements we create so as to allow the visual designer granular control over the presentation without having to modify the program itself.

We have also included a [CSS stylesheet](/yuiblog/blog-archive/assets/buildingwidgets/Fields.css). The stylesheet is indispensable for design purposes; calling the [sample page](/yuiblog/blog-archive/assets/buildingwidgets/sample3.html) 'plain' when you don't use the stylesheet is being generous. You will notice in the sample page that there are two fieldsets, and one is the mirror image of the other. The JavaScript and HTML used to produce those two forms are exactly the same; they differ only in the CSS class applied. Achieving this kind of presentation independence with plain `<table>` elements (a common fallback used to build form layouts before CSS became ubiquitous) would have been impossible because the code and markup would have needed to be unique for each form.

There is very little to be done in the constructor:

```
var CSS_PREFIX = 'satyam_field_';
        
var TextField = function(oConfigs) {
        
    TextField.superclass.constructor.call(this, document.createElement('div') , oConfigs);

    this.createEvent('updateEvent');
        
};



YAHOO.SATYAM.TextField = TextField;
```

We call the constructor of the object we inherit from: [Element](http://developer.yahoo.com/yui/element/). (**Note:** We haven't called `extend` yet in the code above; we'll add that method in a moment.) As we have seen before, `YAHOO.lang.extend` places all prototype members of the base object under the `superclass` property, including its constructor. We call the constructor, adjusting the scope to the object itself. [Element](http://developer.yahoo.com/yui/element/) requires a reference to the HTML element for which it will provide a wrapper and an object containing any necessary configuration attributes. We simply create an HTML `<div>` element on the spot when calling the base constructor and we pass on the same configuration attributes we have received to our own constructor.

### Managing DOM Events and Custom Events with Element

[Element](http://developer.yahoo.com/yui/element/) already provides wrappers for many standard DOM events. By inheriting from [Element](http://developer.yahoo.com/yui/element/) we are already wrapping `click`, `dblclick`, `keydown`, `keypress`, `keyup`, `mousedown`, `mousemove`, `mouseout`, `mouseover`, `mouseup`, `focus`, `blur` and `submit` on the `div` that we create for each `TextField` instance. These events can be produced either by the DOM element wrapped in [Element](http://developer.yahoo.com/yui/element/) or they may bubble from the DOM elements that are descendants of the wrapped element. All of them can be listened to by subscribing through the `on` method:

```
myFieldInstance.on("click", someFunction);
```

In this case, we will add a "custom event" of our own called `updateEvent`. [Element](http://developer.yahoo.com/yui/element/) inherits from [EventProvider,](http://developer.yahoo.com/yui/docs/YAHOO.util.EventProvider.html) which provides a standard mechanism to create, fire and listen to custom events. Thus, handling of our `updateEvent` will be just like handling all actual DOM events; [EventProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.EventProvider.html) will make them all look alike. Actually, the call to `createEvent` is optional. EventProvider is capable of creating events on demand when they are subscribed to. When the library fires the event, if the data structure hasn't been created, it means nobody is listening to the event. Here's how you would subscribe to the `updateEvent`:

```
myFieldInstance.on("updateEvent", someFunction);
```

Note that the syntax is just the same as subscribing to the DOM-based click event as we saw above.

The `TextField` constructor function we just created is contained within the anonymous function so it is invisible outside of that function — there is no way (yet) to access this constructor globally. It is handy to have such a short name to refer to it and it is faster for the interpreter as well, but we do want to make it public. We do that by copying the reference to that object to `YAHOO.SATYAM.TextField`, which then becomes the public name for the object under the namespace we created before.

### A Closer Look at `extend`

Now, let's take a look at how we extend our TextField object with Element:

```
Lang.extend(TextField, YAHOO.util.Element, {
    initAttributes: function (oConfigs) { /* ... */ },
    render: function (parentEl) { /* ... */ },
    destroy: function () { /* ... */ },
    getValue: function () { /* ... */ },
    setValue: function (newValue) { /* ... */ },
    _renderInputEl: function (containerEl) { /* ... */ }
}

```

As I noted above, the mechanism for inheritance can seem counterintuitive in that we have to declare the inheritor constructor first and only then can we extend it with the properties and methods of the base object. We do this via the `YAHOO.lang.extend` method (`Lang` is the shortcut we declared for `YAHOO.lang`). We tell `extend` which object inherits from which. A third, optional, argument to `extend` is an object containing properties and methods that will also become part of the new object prototype (and will override members of the same name inherited from the superclass, if present). Here, we are declaring several additional methods, which I've stubbed out for now — we'll look at some of these more closely in a moment, and all of them appear in full in the functioning example. (If you want to learn a bit more about how `extend` works, [take a look at the dedicated example and tutorial provided for this method](http://developer.yahoo.com/yui/examples/yahoo/yahoo_extend.html) and at [its API doc reference](http://developer.yahoo.com/yui/docs/YAHOO.lang.html#method_extend).)

### Element and AttributeProvider

[Element](http://developer.yahoo.com/yui/element/) (via AttributeProvider) provides a standard mechanism for dealing with managed configuration attributes. It provides `get` and `set` methods to access them and reads initial values automatically via the constructor's `oConfig` argument as we saw above. [Element](http://developer.yahoo.com/yui/element/) already has a few attributes of its own, but when we create an object based on it we will usually add some custom attributes. [Element](http://developer.yahoo.com/yui/element/) creates and initializes its own in method `initAttributes`, we do the same with ours.

```
initAttributes: function (oConfigs) {
            
    TextField.superclass.initAttributes.call(this, oConfigs);

    var container = this.get('element');

    this.setAttributeConfig('labelEl', {
        readOnly: true,
        value: container.appendChild(document.createElement('label'))
    });
    
    this.setAttributeConfig('inputEl', {
        readOnly: true,
        value: container.appendChild(document.createElement('div'))
    });

    this.setAttributeConfig('name', {
        writeOnce: true,
        validator: Lang.isString
    });
            
    this.setAttributeConfig('id', {
        writeOnce: true,
        validator: function (value) {
            return /^[a-zA-Z][\w0-9\-_.:]*$/.test(value);
        },
        value: Dom.generateId(),
        method: function (value) {
            this.get('inputEl').id = value;
        }
    });

    this.setAttributeConfig('label', {
        validator: Lang.isString,
        method: function (value) {
            this.get('labelEl').innerHTML = value;
        },
        value: ''
    });

    this.setAttributeConfig('value', {
        value: null
    });

    this.setAttributeConfig('validator',{
        validator: Lang.isFunction,
        value: function (value) {
            return false;
        }
    });
}
```

Our method `initAttributes` overrides Element's own method; nevertheless, the original `initAttributes` is not lost because `extend` has copied all of the original members of Element's prototype to Field's `superclass` property. Within our `initAttributes` method, we first call the original `initAttributes`, adjusting the scope to that of our own object, and then we start defining our own attributes. We use method `setAttributeConfig` to do so. It requires a name for the attribute and then a series of optional arguments, some of which are shown in the codeblock above. An attribute can be `readOnly`, `writeOnce` or, if not stated otherwise, readable and writable. It can have a `validator` function that should return `true` if the value set is valid. We use some of YUI's own functions from `YAHOO.lang`, such as `isString`, `isBoolean` or `isFunction` to validate some of the attributes but we use our own function for the `id` attribute, since the DOM `id` property cannot be just any string. Some of the attributes have initial values whereas some will be left undefined. For `id`, the initial value will be produced by method `YAHOO.util.Dom.generateId` which ensures that you get a valid and unique id.

The final `setAttribute` property we want to look at is the `method` property. This property contains a function that will be executed when the configuration attribute is set. This, of course, is nothing more than what a normal property setter method should do but, since JavaScript does not provide for a standard and brief way to handle setters, YUI's [AttributeProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.AttributeProvider.html) does so.

When we set an attribute to a new value (`myComponent.set('someAttribute,'new value')`), if the attribute is not `readOnly` or if it is `writeOnce` it hasn't been written yet, the function in the `validator` property will be called, if present. If that returns `true`, the function in the `method` property will then be called. All this doesn't mean much to the end user who won't see a thing, but, if you load the `-debug` versions of Event and Element, YUI will output log messages at each step in a [Logger Control](http://developer.yahoo.com/yui/logger/) console or in the browser console.

In the sample above, we are using `Dom.generateId()` to produce a default `id` for `inputEl` and we have a function set in the `method` property that assigns the `id` to `inputEl`. However, the `method` function is not called for initial, default values, `inputEl` won't get the default value if not explicitly set. We can ensure the `method` function gets called by using [AttributeProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.AttributeProvider.html)'s `refresh` method sometime after we have called [Element](http://developer.yahoo.com/yui/element/)'s constructor:

```
this.refresh(['id'],true);
```

The first argument is an array containing the names of the attributes to be refreshed, the second tells whether it will trigger the notification events (more on them in the next paragraph), which you usually don't want fired the first time around so you set the `silent` argument to `true`. [AttributeProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.AttributeProvider.html) will then go through the attributes you listed and call the `method` function for each of them. Beware that if the attribute has been explicitly set in that `oConfig` argument we used above when creating the object, the `method` function would have been called once and calling `refresh` will call it once again so when using `refresh` be aware of this possible repetition

That, however, is not the whole story. The developer using your library might want to respond to the setting of a configuration attribute. Though possible, letting the developer using your library to override the `method` or `validator` properties is risky. [AttributeProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.AttributeProvider.html) provides a couple of events for each attribute the library user can listen to. After the new attribute value has been validated and right before calling the function assigned to the `method` property, [AttributeProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.AttributeProvider.html) will fire a `before_XXXX_Change` event, where the `_XXXX_` is the name of your attribute with its first letter changed to uppercase. Thus, `myComponent.set('something','whatever')` will fire the `beforeSomethingChange` event. If the function listening to this event returns exactly `false` (not a _falsy_ value such as not returning anything), the setting will be cancelled, the value of the attribute will remain unchanged and the function in the `method` property will not be called. Thus, a function listening to the `before_XXXX_Change` event may act as a `validator` function. If all listeners return a value that is not `false`, the `validator` returns true, and the value is finally set, [AttributeProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.AttributeProvider.html) will fire the `_XXXX_Change` event. Here the case of the attribute name in the `_XXXX_` part is preserved; the string 'Change' is simply appended to it. The event listener would then act pretty much like the function in the attribute's `method` property.

There is one more feature of [AttributeProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.AttributeProvider.html) that's worth highlighting. When initializing an object just created, quite often there are dependencies in between its settings (ie, you can't set one until you set some other). When you create an object derived from [Element](http://developer.yahoo.com/yui/element/), you will usually provide a set of attributes all at once. If these attributes are not set in the right order, the object will not initialize correctly. In [AttributeProvider](http://developer.yahoo.com/yui/docs/YAHOO.util.AttributeProvider.html) the attributes will be set in the order in which `setAttributeConfig` was called, not the order in which the attributes appear in the call to the constructor. In the example above, attributes `name`, `id` and `label` will be set in that order, regardless of the order they appear on the object creation options (the ones above them are either `readOnly` or are set as `writeOnce` and have been written to). In this way you have a predictable initialization sequence, regardless of the order in which configuration options are listed by your component's user.

### Adding a `render` Method

Calling [Element](http://developer.yahoo.com/yui/element/)'s constructor and overriding `initAttributes` are the only things we need to do to have all the benefits of inheriting from [Element](http://developer.yahoo.com/yui/element/). From now on, we can do as we please. However, to keep some consistency with the rest of the YUI Library we will provide a couple of more or less standard methods, `render` and `destroy` (some of the older YUI components lack these methods, but going forward they are _de rigueur_). Method `render` will create all the HTML elements that will make the component and will append them to the document.

```
render: function (parentEl) {
    
    parentEl = Dom.get(parentEl);

    if (!parentEl) {
        YAHOO.log('Missing mandatory argument in YAHOO.SATYAM.TextField.render:  parentEl','error','Field');
        return null;
    }
    
    var containerEl = this.get('element');
    this.addClass(CSS_PREFIX + 'container');
    
    var inputEl = this.get('inputEl');
    Dom.addClass(inputEl,CSS_PREFIX + 'input');

    var labelEl = this.get('labelEl');
    labelEl.setAttribute('for', inputEl.id);
    Dom.addClass(labelEl,CSS_PREFIX + 'label');
    
    this._renderInputEl(inputEl);

    parentEl.appendChild(containerEl);

    this.on('updateEvent', function (oArgs) {
        var errMsg = this.get('validator').call(this, this.get('value'));
        if (errMsg) {
            Dom.addClass(inputEl,CSS_PREFIX + 'error');
            inputEl.title = errMsg;
        } else {
            Dom.removeClass(inputEl,CSS_PREFIX + 'error');
            inputEl.title = '';
        }
    });
},

```

Method `render` needs to know which DOM element to append our component to. As with all YUI widgets, we accept either an actual DOM reference or the `id` attribute of an HTML element. YUI Dom's `get` method ensures that we end up having a valid DOM reference. If `parentEl` is not a valid object (possibly it doesn't exist) then we return after sending an error message to the [YUI Logger](http://developer.yahoo.com/yui/logger/). This is a good way to provide errors to the developer without troubling the end user who can do little about it anyway. If the [Logger](http://developer.yahoo.com/yui/logger/) component is loaded and active, `YAHOO.log` will write into it, otherwise, like in a production environment, it will do nothing, which is in line with what browsers normally do in most cases (fail quietly and get on with whatever happens next). For this example, I've made this call to `YAHOO.log`, but I've avoided further tests to keep the sample brief.

Calling `YAHOO.log` has another advantage: Such calls can be easily stripped out from the source once finished and tested by a simple regular expression search and replace. This partly explains the three flavors of the YUI files. Each YUI component comes in a `-debug`, a `-min` and a raw version, the first two being the suffixes in the file names. The `-debug` version is full of calls to `YAHOO.log` and it is good to use when you are debugging. The [Logger](http://developer.yahoo.com/yui/logger/) window lets you filter messages by type so you can concentrate on what you want. The raw version, with no suffix, is made from the `-debug` version with the calls to `YAHOO.log` stripped out. The `-min` version is derived from this last one by using the [YUI Compressor](http://developer.yahoo.com/yui/compressor/). Then there are the aggregate files, the result of concatenating several often-used groups of components together. These are always minified even though they lack the `-min` suffix. We have used one of those in the example: `yuiloader-dom-event.js` contains the [YUI Loader](http://developer.yahoo.com/yui/yuiloader/), the [YAHOO global object](http://developer.yahoo.com/yui/yahoo/) and the [Dom](http://developer.yahoo.com/yui/dom/), [Event](http://developer.yahoo.com/yui/event/) and [Get](http://developer.yahoo.com/yui/get/) utilities, all of which are so basic that it is easier and faster to load them all in one go. It is a good idea to adopt the same naming convention for your library files. The [YUI Loader](http://developer.yahoo.com/yui/yuiloader/) has a `filter` property that allows you to select the version of files you want, and it uses that naming convention to figure out which file is which version.

[Element](http://developer.yahoo.com/yui/element/) will save the object it wraps in property `element`. We fetch it and we append two HTML elements to it, one a `<label>` element and the other a `<div>` which will contain input fields. None of these are attached to the document yet; it's always a good idea to delay appending complex HTML to the document until everything is ready, because this prevents the browser's rendering engine from trying to repaint the page (which is both resource-intensive and can cause unwanted flickers). As with all the rest of the HTML elements, we are generous about adding `className`s to every element. We get the references to each of the elements created in `initAttributes` and add classNames to each. We also set the `for` attribute of the `<label>` element to point to the input field.

To actually build the input element we call `_renderInputEl`. Each type of element, text inputs/areas, radio buttons, and checkboxes will have its own renderer, so we make this method separate so it can be overridden. We simply call it, pass it its container element and trust it to do the right thing.

When all the HTML markup is done, we append it to the `parentEl`. We delay this until the very end so that the browser will calculate the layout of the page just once.

One of the configuration attributes for the `TextField` Control is a `validator` function. That function is expected to return an error message to be shown to the user or `false` if everything is ok. We subscribe to the `updateEvent` and call the function set in the `validator` attribute, adjusting the scope to that of our object, and pass it the value entered. If any error message is returned, we add a `className` that presumably will highlight the field and set the error message as the `title` (tooltip) for the field.

Method `_renderInputEl` starts with an underscore. This is a convention to indicate a private field. JavaScript does not support private variables; the underscore only means that the library user should refrain from using it because it is not part of the component's public API and may change in subsequent releases. Why not make it really invisible? By placing our shortcuts to YUI inside an anonymous function we made them invisible to anything outside of that function. Can't we do the same with this? Unfortunately, the trick we used with the shortcuts only works with static variables, not with instance variables such as `_renderInputEl`. We cannot make it invisible; thus, we can only signal the user our intent by using the underscore convention.

```
_renderInputEl: function (containerEl) {
    var input = containerEl.appendChild(document.createElement('input'));
    input.name = this.get('name');
    input.id = this.get('id') || input.name;
    input.value = this.get('value');
    Event.on(input, 'change', function(oArgs) {
        this.fireEvent('updateEvent', {
            event: oArgs,
            target: input
        });
    }, this, true);
    Event.on(input,'keyup', function (oArgs) {
        this.set('value', input.value);
    }, this, true);
},
```

Method `_renderInputEl` fills the container given with an actual input element. For our base object it will simply be a textbox. We draw it using the `name`, `id` and `value` saved elsewhere. We then listen to two events:

1.  on a `change`, we fire event `updateEvent`, which we declared in the constructor so as to communicate that the we are leaving the field and the value has changed;
2.  we also listen to event `keyup` so as to keep the `value` stored for this field constantly updated.

### Adding a Destructor

JavaScript does not have the concept of a destructor. When objects are no longer used, there is no destructor for the garbage collector to call and free resources. Unfortunately, most components create and/or make use of external resources that, if not freed, will take increasing amounts of memory (because garbage collection in JavaScript is not well implemented in some popular browsers). Though JavaScript does not support destructors, there is nothing preventing us from declaring one and documenting it for the programmer using our components.

```
destroy: function () {
    var el = this.get('element');
    Event.purgeElement(el, true);
    el.parentNode.removeChild(el);
},
```

Our `destroy` method takes the HTML element that represents our component, uses [YUI Event](http://developer.yahoo.com/yui/event/) `purgeElement` method to delete all event listeners from it and to recurse down through all children and finally remove the element itself. This will take the HTML element away from the document tree. We still have to delete the reference to our component, which cannot be done from within, that's up to the user.

### Subclasses

To define any new component derived from this one, we use a similar process. Here's how we might define a CheckboxField object based on the TextField object:

```
var CheckboxField = function(oConfigs) {
    CheckboxField.superclass.constructor.call(this, oConfigs);
};

YAHOO.SATYAM.CheckboxField = CheckboxField;

Lang.extend(CheckboxField, TextField, {


    initAttributes: function (oConfigs) {
        oConfigs = oConfigs || {};
        CheckboxField.superclass.initAttributes.call(this, oConfigs);
        
        this.setAttributeConfig('selected', {
            validator: Lang.isBoolean,
            method: function (value) {
                var c = this.get('checkboxEl');
                if (c) { c.checked = value; }
            }
        });
        this.setAttributeConfig('checkboxEl', {
            writeOnce: true
        });
    },
    
    _renderInputEl: function (containerEl) {
        
        containerEl.innerHTML += '<input type="checkbox" name="' + this.get('name') + 
            '" value="' + this.get('value') + '"' + (this.get('selected')?' checked ':'') + 
            ' id="' + this.get('id') + '" />';
        this.set('checkboxEl', containerEl.firstChild);
        Dom.addClass(containerEl, CSS_PREFIX + 'checkbox');
        Event.on(containerEl, 'click', function(oArgs) {
            var target = Event.getTarget(oArgs); 
            this.set('value', target.checked);
            this.fireEvent('updateEvent', {
                event: oArgs,
                target: target
            });
        }, this, true);
    }

});

```

In this case we are defining a field of type Checkbox which we base on our previous `TextField`. Since this declaration is still within the outer anonymous function, all previous shortcuts such as `TextField` are still valid.

The constructor for our `CheckboxField` component simply calls the base constructor. In other languages we might have skipped this declaration, but in JavaScript we declare an object by declaring its constructor, even if it is trivial. We make our component public by copying a reference to `YAHOO.SATYAM.CheckboxField` and then we make it an extension of `TextField`.

Finally, to change its behavior, we override a couple of methods of `TextField`. We override `initAttributes`, which `TextField` itself overrode, to add a couple more attributes. We then override `_renderInputEl` to draw our checkbox element. For the checkbox field we fire the `updateEvent` when we receive a click on the box.

The [source code](/yuiblog/blog-archive/assets/buildingwidgets/Fields.js) contains a definition for a `RadioField` which is quite similar to `CheckboxField`.

### Bundling Functionality: The Field Object and the Fields Object

Since input fields seldom go alone, it would be easier to create several of them at once. First, we will reduce the number of different objects we have to deal with. We will create a simple `Field` object that will be able to create any type of field. To do that we will add a `type` property to our configuration attributes, then a single `Field` object can create any type of field.

```
var Field = function(oConfig) {
    var Constructor = oConfig && oConfig.type && Field.types[oConfig.type];
    if (Constructor) {
        return new Constructor(oConfig);
    }
    return undefined;
};

YAHOO.SATYAM.Field = Field;

Field.types = {
    'text': TextField,
    'radio': RadioField,
    'checkbox':CheckboxField
};
```

This constructor is an unusual one in that it returns a value. Constructors by default return a reference to the object being constructed. However, a constructor can explicitly return something other than itself. Here, we first locate the constructor of the field type requested; we verify that there is an `oConfig` object, that that `oConfig` object has a `type` property and that we have the constructor for that type in our `types` table. If so, we return a new object of the type that that constructor creates; otherwise, we return `undefined`. We make public that `Field` object as `YAHOO.SATYAM.Field` and we also create the `types` table, which is static, since there can only be one set of fields for the library.

A curiosity of this object, of no practical value whatsoever, is that since it has no reference to `this` at all and the only property is static instead of an instance property, it can either be called as a constructor, using `new`, or as a plain function. These two statements produce the same results, though we will prefer to use the `new` keyword for consistency:

<table border="0" cellpadding="0" cellspacing="1" width="98%"><tbody><tr><td width="50%"><pre>var checkLeft = new YAHOO.SATYAM.Field({
    type: 'checkbox',
    name: 'check',
    label: 'Checkbox',
    selected: true,
    id: 'c4546'
});</pre></td><td width="50%"><pre>var checkLeft = YAHOO.SATYAM.Field({
    type: 'checkbox',
    name: 'check',
    label: 'Checkbox',
    selected: true,
    id: 'c4546'
});</pre></td></tr></tbody></table>

How come function `Field` can have a property `types`? In JavaScript, all functions are instances of `Function`, so all functions are objects — and as objects they can be augmented with additional properties such as `types`.

If the library user decides to create a new type of input field, it is easy to incorporate it into the `Field` object:

```
YAHOO.SATYAM.Field.types['newTypeName'] = YAHOO.SATYAM.NewInputField;
```

This standardization in the way to create fields makes it easier for us to create a set of fields all at once. We do it via the Fields object:

```
var Fields = function (oConfig) {
    this.fields = {};
    if (!Lang.isArray(oConfig)) oConfig = [oConfig];
    for (var f = 0; f < oConfig.length; f++) {
        var cfg = oConfig[f];
        var name = cfg.name;
        if (!name || this.fields[name]) {
            YAHOO.log('Missing or duplicate field name','error','Field');
            return undefined;
        }
        this.fields[name] = new Field(cfg);
    }        
};

YAHOO.SATYAM.Fields = Fields;

Fields.prototype = {
    render: function (container) {
        for (var name in this.fields) {
            if (this.fields.hasOwnProperty(name)) {
                this.fields[name].render(container);
            }
        }
    },
    destroy: function () {
        for (var name in this.fields) {
            if (this.fields.hasOwnProperty(name)) {
                this.fields[name].destroy();
            }
        }
    }
};


```

The `Fields` object will take an array of configuration attributes (as does `Field`), or it can even take a single object. It first checks that the argument is an array and, if not, makes it one. It then loops through its elements reading the `name` property. It will store the fields created in the `fields` object, using the `name` as the key. If there is no `name` property or the `name` is already in use, it will issue an error in the [YUI Logger](http://developer.yahoo.com/yui/logger/) and return nothing. If the name exists and it is unique, it will create the field using the `Field` object seen above, each with its own `cfg` attributes and file it under the field name. As usually, once the constructor is defined, we make it public. We then define two methods, `render` and `destroy`, which simply loop through the individual fields and call the corresponding method in each.

In the [example code](/yuiblog/blog-archive/assets/buildingwidgets/sample3.html), we build `textLeft` and `radioLeft` via their corresponding field objects, `TextField` and `RadioField`. Then we create `checkLeft` using the generic `Field` object and the three fields in the second, mirrored fieldset all at once via `Fields`.

Actually, the `Field` object and its `types` table provide such a simple and flexible mechanism that we can add to the `Field.types` object any other object with a similar interface. So far we have been handling individual fields but since `Fields` allows us to define sets of input elements, we could add a family of components to contain such groups of fields. The base object could be a `Group` object that draws a `<div>` element allowing us to manipulate hiding, disabling or styling for the whole group at once. A `fields` configuration attribute in this `Group` object would contain the definitions for the fields contained within it.

From `Group` we could derive a `FieldSet` object that would draw a `<FieldSet>` instead of a `<div>` and would also have a `legend` configuration attribute. We could also derive a `FoldingGroup` or `FoldingFieldSet` which would allow these groups to be collapsed or expanded, optionally using the [Animation](http://developer.yahoo.com/yui/animation/) utility, if loaded. The ultimate object derived from `Group` would be the `Form` which would also contain methods for form submittal and hooks for form-level validation. The code for this family of objects is not included since it would not show any relevant new techniques for the purpose of this article.

## Progressive Enhancement

If we want to reach the widest user population, we have to code for the widest variety of browsers, something the YUI Library helps us with, but we also have to consider those users who don't have JavaScript enabled. The YUI Library supports those users via 'progressive enhancement'. It assumes that, since there won't be any JavaScript active to draw the page, the server will provide a functional page in the traditional web style of a full-page reload per transaction. As a library developer we have to consider that our library might be used in those two circumstances, when we are fully in charge of drawing the elements on the page — as we have seen so far — or when we have a page with elements already in it and our library is used to enhance it, improving its appearance and providing extra functionality such as client-side validation and submission via XHR.

The most important enhancement in this process is adding listeners for all the events our library captures, which makes the page active and responsive. We would need to listen to form submission and handle it via XHR after passing through the configured validation. We would listen to changes in each of the fields and validate the input in each. We may add buttons to show calendars on the date input boxes, conditionally hide/show or enable/disable groups of controls based on inputs elsewhere in the form, offer autocomplete and so on.

If we mean to support progressive enhancement our input fields library has to be capable of finding out if the fields are already in the page and only if they are not there, draw them. We cannot be expected to support any arbitrary format for the fields we are meant to enhance. To start with, fields in a passive web page make no sense without an enclosing form so we will only enhance full forms. This makes our task easier since fields within forms don't make sense without a name (they could not be submitted otherwise) and that name is the key to locate them in the DOM as `form['name']` or `form.name`. So, our `Fields.render` method would have to first find out if the container is an HTML form and, if so, for each input element, we would try to locate a field with that name and enhance it with the rest of the information in the field configuration attribute. We might also try to locate the `<label>` elements pointing to our fields and also enhance them with the corresponding classNames and do likewise for the `<div>` that should enclose them both.

We're not going to delve further into this subject for the purposes of this already lengthy article. However, progressive enhancement has to be considered in the general design of the library if we want it to reach such a broad audience as the YUI Library does. An excellent use of this concept can be seen in the [YUI Menu](http://developer.yahoo.com/yui/menu/#start) component. The markup that the component can parse makes a perfectly functional menu should JavaScript be disabled. On the other hand, the [Calendar](http://developer.yahoo.com/yui/calendar/) component does not read existing markup since the functionality it provides could not be handled without JavaScript. As you build your own components, you'll need to make important decisions about which ones require progressive enhancement and which ones make sense only in a JavaScript-enabled environment.

## CSS Sprites

There is only one further technique which I have not mentioned. When signaling errors on the input fields I add a className to the container. The visual designer may use this class to set any visual clue to the user. In this case, an alert icon is shown (![](/yuiblog/blog-archive/assets/buildingwidgets/alerta.gif)). This icon is not added as an `<img>` tag to the field but as a non-repeating background image in the container which has a padding set on the corresponding side (depending on the skin used) to make space for it. The visual designer might have changed the color of the field itself or use any other visual clue; the code is, once again, completely agnostic in relation to visual presentation.

If several of these icons need to be packaged with the component, a further trick might be used: sprites. You can see a [sprite](http://yui.yahooapis.com/2.5.2/build/assets/skins/sam/sprite.png) that comes with the YUI standard skin. It is a collection of graphical elements of small size which can be used in backgrounds, some repeating, such as shades for bars, some non-repeating like in the example above, each one individually accessible by indicating the offset from the edge of the set (see: [background-position](http://www.w3.org/TR/CSS21/colors.html#background-properties)). This saves on connections to the server. Instead of loading each of the graphic elements when required you get all the graphic elements within the sprite in just one download. The size of the whole sprite is so small that it doesn't hurt to load something you might not use...it is better in most cases to have a slightly larger image download for the single sprite than to have all the extra HTTP requests required for multiple images.

## Final Thoughts

JavaScript is a very flexible language which is very good for the component developer, but it can be tough for those using the components if the component developer does not follow some common patterns. The YUI Library provides a useful component-development paradigm with EventProvider for managed custom events and AttributeProvider for managed attributes; this article describes that paradigm, which characterizes YUI's most recent UI controls.

**Author's Note:** _This article was done with the help of two Erics. One is Eric Abouaf, whose [inputEx](http://javascript.neyric.com/inputex/) library of controls, featured in the [YUI blog](/yuiblog/blog/2008/05/08/inputex/), was the reason to write this article. I realized there was no documentation to guide library developers on how to write a library. I have also used, with permission, his idea of a widget to draw sets of input fields. The code for the article, though (made for clarity rather than performance or completeness) was done anew. The other is Eric Miraglia who made significant edits and suggestions over my initial draft._