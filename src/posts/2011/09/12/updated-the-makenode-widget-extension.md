---
layout: layouts/post.njk
title: "Updated: The \"MakeNode\" Widget Extension"
author: "Satyam"
date: 2011-09-12
slug: "updated-the-makenode-widget-extension"
permalink: /blog/2011/09/12/updated-the-makenode-widget-extension/
categories:
  - "Development"
---
**Editor's Note:** This article was [originally published earlier this year](/yuiblog/blog/2011/07/08/the-makenode-widget-extension/). Since then, the [MakeNode module has been published to the YUI Gallery](http://yuilibrary.com/gallery/show/makenode) and received some enhancements. Today's article reflects all the latest changes to MakeNode.

In my previous article, [A Recipe for a YUI 3 Application](/yuiblog/blog/2011/04/01/a-recipe-for-a-yui-3-application), I showed a way to use `Y.substitute` as a very basic template processor. The idea took life from there, with suggestions from the folks in the #yui IRC channel, and I made it a Widget extension that is available on the YUI Gallery, called [MakeNode](http://yuilibrary.com/gallery/show/makenode). MakeNode is not a generic template processor and it is not meant as one. On the other hand, it is tightly integrated with the YUI [Widget](http://developer.yahoo.com/yui/3/widget/) foundation class, including className and event helpers and internationalization. In this article, I will take the [Spinner](http://developer.yahoo.com/yui/3/examples/widget/widget-extend.html) example and modify it to follow the guidelines from my previous article and to use MakeNode. [MakeNode](http://yuilibrary.com/gallery/show/makenode) is available as a gallery component as well as the modified [Spinner](http://yuilibrary.com/gallery/show/md-spinner) component and the [example](http://satyam.github.com/makenode/sample.html) that will be used in this article.

## Extending your component

To load MakeNode you need to include the module in your `YUI().use()` statement using the name `'gallery-makenode'`or, if defining a module via `YUI.add()`, list it as the `requires` array. Then, to extend your widget, you list it in the third argument to `Y.Base.create()`, like this:

```
Y.Spinner = Y.Base.create(
     'Spinner',
     Y.Widget,
     [Y.MakeNode],
     {
        // instance members …
     },
     {
         // static members
     }
); 
```

You can add MakeNode along any number of suitable extensions for Widget, such as WidgetParent, WidgetChild, WidgetStdMode, etc. MakeNode adds two protected methods to be used by the developer, `_makeNode` and `_locateNodes,` and it will read from several static properties, if found.

All members of this extension are either protected or private since they are meant to be used by the component developer and not by the implementer using those components, who should not be bothered with them. Remember to check the "Show Protected" option when viewing the [API docs](http://satyam.github.com/apiDocsGallery/MakeNode.html).

## Defining the template

The first thing you will normally do is to define the template for your component. For the Spinner, our template will be:

```
_TEMPLATE: [
    '<input type="text" title="{s input}" class="{c input}">',
    '<button type="button" title="{s up}" class="{c up}"></button>',
    '<button type="button" title="{s down}" class="{c down}"></button>'
].join('\n'),
```

The default template will usually be named `_TEMPLATE` and declared along the other static properties of the class, such as `ATTRS`. MakeNode will use this template if none other is explicitly provided. The template is made of plain HTML plus a series of placeholders enclosed in curly brackets, each made of a single character (the processing code) and followed by one or more arguments. The placeholders and what they produce are:

-   `{@ attributeName}` configuration attribute value
    
-   `{p propertyName}` instance property value
    
-   `{m methodName arg1 arg2 ….}` return value of the given method. The processing code is followed by the method name and any number of arguments separated by whitespace.
    
-   `{c classNameKey}` CSS className generated from the `_CLASS_NAMES` static property (see [The \_CLASS\_NAMES property](#_CLASS_NAMES) section below)
    
-   `{s key}` string from the `strings` attribute, using `key` as the sub-attribute.
    
-   `{?` `_condition_` `_valueIfTrue valueIfFalse_``}` much like the `?:` operator of JavaScript, evaluates to `valueIfTrue` if condition is truish, `valueIfFalse` otherwise.
    
-   `{1` `_condition valueIfOne valueIfMore_``}` used to produce singular/plural words based on the value of condition.
    
-   `{}` any other value will be handled just like `Y.substitute` does.
    

For example, `{@ value}` will translate to `this.get('value')` while `{p value}` translates to `this['value']`.

When placeholders have arguments, like `{m}`, `{?}` and `{1}`, strings must be enclosed in double quotation marks. Numbers, booleans and `null` (all unquoted) will be parsed to their proper data types. Placeholders can be nested. The `{?}` and `{1}` placeholders will usually contain a nested placeholder for the condition and quite possibly for their values, for example:

```
{p qty} {1 {p qty} "unit" "units"} 
```

If the property `qty` is 1, it will evaluate to `"1 unit"`, for 2 or more it will return `"2 units"` and so on. A more elaborate version dealing with zero would be:

```
{? {p qty} "{p qty} {1 {p qty} "unit" "units"}" "none"} 
```

Note that the result of processing the inner placeholders, if a string, must be enclosed in its own set of quotes.

To include a double quote inside a quoted string, use `\\"`, the double backslash being required because JavaScript will interpret a single one and discards it before it gets to MakeNode. Only double quotes are allowed; MakeNode does not use `eval()` so the parser is limited but safe. Anything but numbers, `null`, booleans and double quoted strings will be ignored.

The `{?}` placeholder is also handy to use with checkboxes and radio buttons. It can be used to produce the string `"checked"` depending on the truth value of the processing instruction code that follows. Thus, `<input type="checkbox" {? {m getLength} "checked" ""}/>` will produce a marked checkbox if the `getLength` method returns anything but zero.

For the `{c}` placeholder, we need to have a `_CLASS_NAMES` property defined.

Further placeholders can be added to MakeNode by adding them into the `_templateHandlers` hash.

## The \_CLASS\_NAMES property

Along with the `ATTRS` and `_TEMPLATE` static properties, we can define a `_CLASS_NAMES` static property which points to an array of strings. Each of those strings will be used to generate a className. Thus `_CLASS_NAMES: ['input']` will produce the className `"yui3-spinner-input"`. Those classNames are stored in an instance property `this._classNames`. The `{c input}` placeholder in the template above will be replaced by `"yui3-spinner-input"`. I call the strings listed in `_CLASS_NAMES`, such as `'input'`, the "className _keys_" since they can be used as a key to refer to the actual className or the elements containing those classNames, as we'll see later.

You can use the `_CLASS_NAMES` property to generate any number of classNames, whether you use them in the template or not. You can still reach those extra classNames from within `this._classNames`. The className is generated using the `yui3` prefix followed by the value of the `NAME` static property turned lowercase, and then the string given in `_CLASS_NAMES` (this last one will not be turned lowercase), all separated by hyphens. The `_classNames` hash will also contain the classNames for the `boundingBox` and the `contentBox`, the first under the `"boundingBox"` key and the second under the `"content"` key. Widget assigns to the `boundingBox` the classNames derived from the values of the `NAME` property of each of the classes in the inheritance chain, starting with `yui3-widget`. MakeNode stores into `this._classNames` only the top-most className for the `boundingBox`.

If the WidgetStdMod module is loaded, MakeNode will also generate entries for its `HEADER`, `BODY` and `FOOTER` sections with those same keys, which are also the constants defined in that same module.

If a component is several levels away from Widget, like `SuperSpecialSpinner` inheriting from `SuperSpinner` which inherits from `Spinner` which inherits from `Widget,` and if any or all of them have `_CLASS_NAMES` properties defined, MakeNode will produce classNames for all of them and store them in `this._classNames`. You don't need to include at each level the names already declared in the previous levels. In fact, it is better that you don't since the classNames produced at each level will use the value of the `NAME` property of that level. Thus, in `SuperSpecialSpinner`, `{c input}` will still result in `"yui3-spinner-input"` and not `"yui3-superspecialspinner-input"` and so it will keep your CSS file still valid.

## The {s} placeholder

Widget has a `strings` configuration attribute defined, though it is not initialized with any value. This attribute is meant to hold strings that are visible to (or, via screen readers, read to) the user. It is important that you never include visible strings directly in the template. This is not a requirement of MakeNode — it has never been a good idea at all. All strings that are to be viewed by or read to the user should always be placed in the `strings` attribute. The `strings` attribute contains a hash where each individual text is located by its key. The Spinner component has the following strings, which you can see used in the template above.

```
strings: {
    value: {
        input: "Press the arrow up/down keys for minor increments, page up/down for major increments.",
        up: "Increment",
        down: "Decrement"
    }
},
```

The best part of doing this is that your component can be localized to other languages very easily by developers using your component. When creating an instance of Spinner, you might do:

```
var mySpinner = new Spinner({strings: Y.Intl.get('spinner')});
```

Setting the configuration attribute `strings` in this way replaces the default `strings` values with those from the language resource file using the language previously defined. The `{s}` placeholder accesses the strings stored in the `strings` attribute, either the default ones or the translated ones, if set. The `{s xxxx}` placeholder is almost like using `{@ strings.xxxx}` except that the localized replacement strings can have placeholders which will be further processed. This is important for translations since syntactical order varies from language to language and this allows rephrasing the text, including its placeholders to suit any language. Strings can also be accessed using `{@ strings.xxxx.yyyy.zzzz}`, which will allow access to strings nested deeper down and will prevent further substitutions. Curly braces can be included in a text by using `{LBRACE}` and `{RBRACE}` as placeholders.

## Using \_makeNode in renderUI

We use the template to create the markup for our component. To do so, we can call MakeNode's `_makeNode` method, like this:

```
renderUI : function() {
    this.get('contentBox').append(this._makeNode());
},
```

This will fill in the `contentBox` of our widget with the markup from processing the template. The `_makeNode` method returns an instance of `Y.Node` which can be appended or inserted anywhere or just held for later use. It does not return a string, it produces a `Node` instance. (If you do need a string and not a Node, you can use the `_substitute` method, which requires that you pass in a template.)

The `_makeNode` method takes two optional arguments: a reference to a template and an object to fill in placeholders, as `Y.substitute` does. In our simple Spinner example there is a single template for the whole widget but other widgets might require bits and pieces made out of several templates. In that case, you would usually call `_makeNode` with no arguments for the main part and call it once again with different templates to fill in the extra parts. The [example](http://satyam.github.com/makenode/sample.html) contains this `renderUI` method:

```
renderUI: function () {
    var fieldset = this._makeNode();
    this.each(function (item) {
        fieldset.appendChild(this._makeNode(MultipleTemplates.RADIO_TEMPLATE, item));
    }, this);
    this.get('contentBox').append(fieldset);
}
```

The first call to `_makeNode` returns a `Node` instance stored in the variable `fieldset`. The sample component is also extended with `Y.ArrayList` so the `RADIO_TEMPLATE` will be filled with values taken from the items stored in the array list and the resulting Nodes appended to the `fieldset` before it is finally appended to the `contentBox`. The special placeholders such as `{@}` or `{p}` will still refer to attributes or properties in the main object. The nested items will be processed just as `Y.substitute` would.

## The \_locateNodes method

MakeNode further provides a `_locateNodes` method which will try to locate all the elements with the classNames declared in `_CLASS_NAMES`. To locate specific elements you can pass any number of className keys, otherwise, `_locateNodes` tries them all. For each element found of each className, `_locateNodes` will produce a private instance property using the underscore prefix followed by the key name and the `"Node"` suffix. Thus, in our Spinner example, `_locateNodes` will generate the properties `_inputNode`, `_upNode` and `_downNode`. If several elements have the same className, `_locateNodes` will return a reference to the first of them. If an element is not found, no variable will be created.

In the Spinner component we use `_locateNodes` after creating the markup:

```
renderUI : function() {
    this.get(CBX).append(this._makeNode());
    this._locateNodes();
},
```

## The \_EVENTS static property

One further property can be defined along the lines of `_TEMPLATE` and `_CLASS_NAMES` and that is `_EVENTS`. `_EVENTS` will contain a hash made up of class name keys, each containing a hash of event types and methods to handle them. It is better explained with an example:

```
_EVENTS: {
    input: 'change',                    // calls this._afterInputChange
    boundingBox: [
        {
            type: 'key',
            fn:'_onDirectionKey',       // calls this._onDirectionKey
            args:((!Y.UA.opera) ? "down:" : "press:") + "38, 40, 33, 34"
        },
        'mousedown'                     // calls this._afterBoundingBoxMousedown
    ],
    document: 'mouseup',                // calls this._afterDocumentMouseup,
    Y: 'broadcastingObject:someEvent'   // calls this["_afterYBroadcastingObject:someEvent"]
},
```

`_EVENTS` is an object (a hash) with any number of entries. The names of the properties, that is, the keys of the hash, identify the nodes whose events we will listen to. They are the same className keys defined in `_CLASS_NAMES`. There are several extra special keys:

-   `"boundingBox"` will refer to the bounding box itself.
    
-   `"document"` refers to the document containing this widget.
    
-   `"THIS"` refers to the widget itself
    
-   `"Y"` refers to the `Y` instance.
    

If the Widget has been extended with WidgetStdMod as well, the keys `HEADER`, `BODY` and `FOOTER` will refer to those sections since they will be available in the `_classNames` hash. JavaScript does not need the keys to be quoted if they are valid identifiers so none of the above need to be quoted.

The `_EVENTS` property is processed after the `renderUI`, `bindUI` and `syncUI` methods have been called so the widget is expected to be already inserted within the document body, otherwise the `"document"` identifier will fail.

For each of those elements there is an event identifier or an array of event identifiers. An event can be identified by the type of event to listen to or an object with further details. By default, MakeNode will use as a listener a method named using the `"_after"` prefix followed by the element identifier with its first character capitalized followed by the event type with its first character capitalized. The code block above shows the methods called for each event.

An event identifier can also be an object with properties `type`, `fn` and `args`. The `type` is mandatory and indicates the type of event being listened to. The `fn` property gives the name of the method that will listen to the event thus avoiding the automatic naming. Since `_EVENTS` is a static property, it has no access to `this` so it cannot take an actual reference to a method, only its name. The `args` argument can be used to pass further arguments to the caller such as with the `key` event which requires a keys specification.

MakeNode will use `Node.delegate` to listen to events on elements within the `boundingBox`, while it will use `Node.after` to listen to events from the `boundingBox` and the document body. It will use `this.after` to listen to events under the `THIS` key and `Y.after` for listeners listed under the `Y` key. All events are listened to using _after_ event listeners since they are meant to make the widget respond to events, not to filter the behavior of the object that fires them so in no case these events can be prevented or stopped. (Note: listening to the `key` event on any nested element works only with version 3.4.0pr1 and above, since delegation of the `key` event was not available before. All the other features work with previous versions as well).

The `_EVENTS` declarations are cumulative when components inherit from one another. Each class in the inheritance chain will have its own `_EVENTS` declaration processed separately.

## The \_ATTRS\_2\_UI static property

Events go both ways, from the UI to the component and from the component to the UI. The first are handled by the `_EVENTS` property. Then there are the events fired by attribute value changes that need to be reflected in the user interface. As I mentioned in the previous article, when there are any secondary effects from changing a configuration attribute, they should be handled by _change_ event listeners, not by the optional `setter` method of the attribute, which should only deal with normalizing the value being set. The UI should reflect the state of the configuration attributes, first in `syncUI`, when being initialized and then on every attribute change event. For the latter, we need to attach an event listener, which we would normally do in `bindUI`. Widget already provides a mechanism to make that simple, which I described in the comments to the previous article.

Widget uses the instance property `_UI_ATTRS` that contains an object with two further properties, `SYNC` and `BIND`. Each of these is an array listing the names of the configuration attributes to be initially synched and then listened to in order to keep the UI reflecting current values. Widget expects each of those entries to have a method associated with it, named after the attribute name prefixed by `_uiSet` with the first character of the attribute name converted to uppercase to have the method name in proper camel case. Thus, if `"value"` was listed in any of the `_UI_ATTRS` arrays (in either `SYNC` or `BIND`), Widget would expect to find a `_uiSetValue` method. This method will receive two arguments, the `value` being set and the `src` of the change. This is the code for our Spinner `_uiSetValue` method:

```
_uiSetValue : function(value, src) {
    if (src === UI) {
        return;
    }
    this._inputNode.set(VALUE, this.get(FORMATTER)(value));
},
```

All the uppercase identifiers you see in this piece of code correspond to string constants declared elsewhere, to allow the YUI compressor to do its job better. The method, basically, sets the `value` HTML attribute in the `<input>` box to the new value set, after being formatted. The reference to the textbox was provided by `_locateNodes`. The `src` argument is initially checked to see if set to the string value `'ui'`. If this is so, no action will be taken. This is to avoid endless loops. If the user enters something in the input box, its value would go into the `value` configuration attribute which then would fire a `valueChange` event, which would get `_uiSetValue` called which, if unchecked, would then go and change the value of the input box, which would trigger the whole process again. Thus, in `_uiSetValue`, if we know the change comes from the UI, we do nothing and so break the loop. However, this requires another piece of code elsewhere. In the listener for the DOM event, when we set the configuration attribute, we use the third optional argument to set, like this:

```
_afterValueChange : function(ev) {
    this.set(VALUE, ev.newVal, {src: UI});
}
```

It is up to us to ensure that changes coming from the UI are flagged thus and then check that same flag to avoid loops. Do use the identifier `src` when setting the value of the attribute, not `source` which will not be recognized.

With all this said, I haven't yet talked about the static property `_ATTRS_2_UI` mentioned in the heading of this section. As the comments in my previous article shows (through the blunders I made in them), making sure that all attributes affecting the UI are properly listed is somewhat messy. You should never initialize `_UI_ATTRS` from scratch since Widget already lists a whole lot of attributes and those would be lost. You have to concatenate new attribute names over the existing ones, which is somewhat hard to remember how to do it right. To make it simple, MakeNode will read from the static property `_ATTRS_2_UI` and do that concatenation for you. It will concatenate all such lists from each and every class in the inheritance chain so at each level each class can handle its own attributes. In Spinner, we have:

```
_ATTRS_2_UI: {
    BIND: VALUE,
    SYNC: VALUE
},
```

MakeNode will accept both an array of names or a single attribute name, as in this case.

The question naturally arises, why two lists, one for binding the other for syncing? `SYNC` is used the first time around, after the `renderUI` and `bindUI` methods, if they exist, are called and before `syncUI` while those listed in `BIND` will be bound to the corresponding attributes for later changes. Quite often the `SYNC` array has fewer entries than the `BIND` list and this is because the template for the component might already have the very same default value as the configuration attribute and there is no need to do an initial syncing. So, if the default value for the `value` configuration attribute is an empty string and the `<input>` element in the template has no `value` attribute, then there is no need to sync them on initialization.

Attributes listed in `BIND` will have their `_uiSet``_Xxxx_` methods called in any order, as attributes can be set in any order. Attributes listed in `SYNC` will be called once in the order in which they are listed with those of ancestors before their inheritors, so if one is dependent on another (which they shouldn't), the order might be important.

MakeNode will check for duplicate entries in any of these arrays. If any appear, it means that a class our component inherits from already handles this attribute and any new declaration would most likely overstep the `_uiSet``_Xxxx_` handler for it. Incidentally, MakeNode also checks for duplicate entries in `_CLASS_NAMES`, which can also cause conflict in some, though not all, circumstances. MakeNode will write a message to the log for any such error.

## The \_PUBLISH property

Finally, the `_PUBLISH` static property will list those events that have to be published. It contains a hash using the name of the event as its keys and an object literal of configuration attributes as its values. It will publish all the events listed in any such property in all the inheritance chain. The same event name can be published in a class and in any class inheriting from it, which will make the configuration attributes of later ones override the ones in the older ones. For example, you might want to make an existing event broadcast globally. Just as with the `_EVENTS` property, since `_PUBLISH` is a static property without access to `this`, when specifying functions, it is the name of the method, as a string, that needs to be given.

## Conclusion

MakeNode provides a very simple template processor, with functionality that is highly integrated with the Widget foundation class. It also provides helper methods to create classNames to be used in the template and to use those names to locate and refer to the nodes created. It also provides the means to hook into the events generated both by the UI and the component itself and associate each with a method. It does all these things, while taking care to respect the inheritance chain straight up to Widget and any level of classes you may define.

It does not provide for absolutely all possibilities, but covers a good range of them. Nevertheless, it does not preclude you from adding extra functionality. You might rarely have to write a `bindUI` or `syncUI` method if you use the glue provided by MakeNode, but you may do so, since MakeNode does not use them.

As a bonus to those who had the patience to read this far, I have also modified Anthony Pipkin's Button set of gallery components and made an Accordion and TimeSpinner components, all available in the [Gallery](http://yuilibrary.com/gallery/tag/satyam).

![Satyam](/yuiblog/blog-archive/assets/makenode/satyam.jpg)_**About the author:** Daniel Barreiro (screen name Satyam) has been around for quite some time. The ENIAC was turned off the day before he was born, so he missed that but he hasn’t missed much since. He’s had a chance to punch cards, program 6502 chips (remember the Apple II?), own a TRS-80 and see some fantastic pieces of operating equipment in his native Argentina which might have been in museums elsewhere. When globalization opened the doors to the world, his then barely usable English (plus an Electrical Engineering degree) put him on the career path which ended in a 5-year job in the Bay Area back in the days of NCSA Mosaic. Totally intrigued by the funny squiggles a friend of his wrote in his plain text editor, full of <’s and >’s, he ended up learning quite a lot about the world of frontend engineering. It’s been a long journey since COBOL and Fortran. Now he lives quite happily semi-retired in the Mediterranean coast close to Barcelona, Spain._