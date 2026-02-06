---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Extensions for SVG, Created for SVG Wow!"
author: "Vincent Hardy"
date: 2010-10-18
slug: "gallery-svg"
permalink: /2010/10/18/gallery-svg/
categories:
  - "Development"
---
### Introduction

SVG ([Scalable Vector Graphics](http://www.w3.org/svg/ "W3C SVG Working Group")) provides a declarative syntax for interactive, animated 2D graphics: shapes, images and text. SVG support is [part of](http://www.w3.org/TR/html5/Overview.html#svg-0) the [HTML 5](http://www.w3.org/TR/html5/) specification and SVG is implemented by all major browsers, including Microsoft's Internet Explorer in [version 9](http://ie.microsoft.com/testdrive/).

The [svg-wow.org](http://svg-wow.org) web site showcases what can be done with SVG today. The demos on this web site were created for the [SVG Open](http://svgopen.org) conference, where the SVG Wow! sessions have been a tradition for several years. The SVG Wow! sessions were started by Dean Jackson, then in collaboration with myself and then continued by [Erik Dahlstrom](http://my.opera.com/MacDev_ed/blog/). Erik and I have collorated on the session for the [2009](http://www.svgopen.org/2009/keynotes.shtml) and [2010](http://www.svgopen.org/2010/registration.php?section=keynotes) editions of the conference.

For the past two years, the demos have increasingly used AJAX frameworks, applying their features to SVG instead of (or in addition to) HTML. [YUI](http://developer.yahoo.com/yui/ "YUI Library") is the most widely used framework on the web site, which uses both [YUI 2](http://developer.yahoo.com/yui/2/ "YUI 2 — Yahoo! User Interface Library") and [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library").

I'll start with a quick SVG overview and then discuss the type of demos that YUI supported and [the extensions I've added to the YUI 3 Gallery](http://yuilibrary.com/gallery/show/svg "YUI Library :: Gallery :: YUI SVG Extensions") to make it work with SVG. (These extensions are now free to use under the terms of [YUI's BSD license](http://developer.yahoo.com/yui/license.html "YUI Software License").)

### SVG overview

Like HTML, SVG is a W3C specification. It provides a syntax for describing basic shapes (rectangles, circles, lines, polygons, ellipses, polylines), arbitrary shapes (described in terms of path segments which can be lines, quadratic or cubic Bezier curves), text and images.

The following image is a screen capture of the [alternate stylesheet example on svg-wow.org](http://svgwow.org/blog/2010/08/14/alternate-stylesheets "SVG Wow!") and shows some SVG features at play: rich rendering (shadow effects, gradients, patterns) and simple and complex shapes. [![](/yuiblog/blog-archive/assets/hardy-svg/framed-alternate-stylesheet.png)](http://svgwow.org/blog/2010/08/14/alternate-stylesheets/)

Because SVG images are defined in terms of geometry and rendering attributes, it is possible to render them at any resolution. As a result, SVG images can be scaled to any size while retaining a high rendering quality, for example when printing (no more jagged edges).

The following zoomed-in view shows the same SVG image shown earlier but rendered at a higher resolution while preserving the high quality. [![](/yuiblog/blog-archive/assets/hardy-svg/framed-alternate-stylesheet-zoomed.png)](http://svgwow.org/blog/2010/08/14/alternate-stylesheets/)

Just like HTML, SVG supports interactivity: it is possible to add event listeners on graphic objects for mouse or keyboard interactions. Of course, SVG supports the Document Object Model, which makes it easy to manipulate the different properties of graphical objects, such as their geometry or rendering style.

There is a lot to the SVG specification: advanced rendering styles (stroking, filling, patterns, gradients), filter effects (blurs, shadows, color matrices), CSS styling, advanced text features (such as text on a path) and declarative animation. You can check out the references at the end of this post to learn more about the SVG format features.

### SVG and HTML

With [HTML5](http://en.wikipedia.org/wiki/HTML5 "HTML5 - Wikipedia, the free encyclopedia"), SVG can be inlined in HTML documents without further ado. Browsers are starting to support that feature (e.g., [Firefox 4](http://www.mozilla.com/firefox/beta/ "Firefox 4 Beta")). For the time being, all major browsers support SVG inlined in XHTML, which provides the same functionality. SVG in XHTML just requires that namespaces are properly declared.

```
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        ....
    </head>
    <body>
        <h1>Inline SVG</h1>

        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         width="100%" height="100%" id="backgroundSVG">
            <!-- svg content here -->
        </svg>
    </body>
</html>
        
```

All the [code samples](http://svg-wow.org/yui-animations/svg-animate.xhtml) on this page use this way of inlining SVG in XHTML.

### SVG and YUI

SVG supports declarative animation. For example, you can animate the radius of a `<circle>` element like this:

```
<circle cx="50" cy="100" r="40">
    <animate attributeName="r" values="40,60,20,40" dur="1.5s" />
</circle>
       
```

The `<animate>` tag is borrowed from the [SMIL](http://www.w3.org/TR/SMIL2/) specification and, along with the other animation elements, it provides a very powerful animation engine to SVG.

Unfortunately, until recently, browser support for SVG animation was sparse. It has improved over the past two years, but Microsoft [has made it clear](http://ie.microsoft.com/testdrive/info/ReleaseNotes/Default.html) it will not support declarative SVG animation in IE 9.

As a result, most of the demos on the svg-wow.org web site use scripted animation instead of declarative animations. On one hand, this is unfortunate because declarative animations are more efficient than scripted animations. On the upside, scripted animations can be very flexible, and they work across implementations very well.

The need for a good scripted animation solution is what drove the usage of YUI on the [svg-wow](http://svg-wow.org) demos. However, the demos also use other YUI features, in particular the [Loader](http://developer.yahoo.com/yui/3/yui/#loader) and [Node](http://developer.yahoo.com/yui/3/node/) modules.

#### Animating SVG with YUI

The demos on [svg-wow](http://svg-wow.org) use YUI to create [elastic drum beats](http://svg-wow.org/blog/2009/10/04/animated-lyrics/), [morphing shapes](http://svg-wow.org/blog/2010/10/05/gandhi-quotes/) or [rotating text and shapes](http://svg-wow.org/blog/2010/08/14/camera/) for example. Using YUI with SVG required a few YUI extensions; I'll describe these in just a moment.

<table><tbody><tr><td><a href="http://svg-wow.org/blog/2010/08/14/camera/"><img src="/yuiblog/blog-archive/assets/hardy-svg/framed-camera.png" width="200px"></a></td><td><a href="http://svg-wow.org/blog/2010/10/05/gandhi-quotes/"><img src="/yuiblog/blog-archive/assets/hardy-svg/framed-gandhi-quotes_poster.png" width="200px"></a></td></tr><tr><td><a href="http://svg-wow.org/blog/2010/08/14/camera/">rotating text and shapes</a></td><td><a href="http://svg-wow.org/blog/2010/10/05/gandhi-quotes/">morphing shapes</a></td></tr><tr><td><a href="http://svg-wow.org/blog/2009/10/04/animated-lyrics/"><img src="/yuiblog/blog-archive/assets/hardy-svg/framed-elastic-drums.png" width="200px"></a></td></tr><tr><td><a href="http://svg-wow.org/blog/2009/10/04/animated-lyrics/">elastic drum beats</a></td></tr></tbody></table>

The following illustrates how YUI comes in handy to simply animate and manipulate SVG graphics.

##### Animating the SVG `transform` attribute

All SVG graphical elements have a [`transform`](http://www.w3.org/TR/SVG/coords.html#TransformAttribute) attribute. That attribute specifies a 2D [affine transformation](http://en.wikipedia.org/wiki/Transformation_matrix#Affine_transformations) on elements, which can be used to scale, skew, rotate or translate.

The svg-wow.org YUI extensions for SVG allow animating the `transform` attribute like this:

```
var anim = new Y.Animate({
    node: '#circleA',
    from: {
        transform: {tx: 0, ty: 0, sx: 2, sy: 2}
    },
    to: {
        transform: {tx: 20, ty: 20, sx: 1, sy: 1}
    },
    transformTemplate: "translate(#tx, #ty) scale(#sx, #sy)",
    duration: 1
});
        
```

See the [transform animations](http://svg-wow.org/yui-animations/svg-animate.xhtml#transform-animations) tests.

You'll note that the transform values are defined in terms of "components" (such as `tx` or `ty`) which are combined to form a value using the `transformTemplate` found on the animation configuration object.

The template is a flexible mechanism for building transform values while separate components make it easy to compute the animated values. This is an example where the YUI animation model allowed more flexibility (and more expressive power) than SVG's SMIL animation element ([`animateTransform`](http://www.w3.org/TR/SVG/animate.html#AnimateTransformElement)). In order to create the animation described above, the equivalent SMIL declaration would have been:

```
<circle ...>
    <animateTransform attributeName="transform" type="translate"
                      from="0,0" to="20,20" dur="1s" begin="scaleAnim.begin"/>
    <animateTransform id="scaleAnim" attributeName="transform" type="scale"
                      from="2,2" to="1,1"  dur="1s" begin="indefinite"/>
</circle>
        
```

Note how the above snippet requires multiple `animateTransform` elements which have to be synchronized: the `begin` attribute of the first animation is set to `scaleAnim.begin` to synchronize the start of the two animations. A nice feature of the YUI animation engine is that the timing of an animation (i.e., start, end and duration) can be shared to apply to multiple element properties.

The YUI extension for animating SVG transforms is used extensively, such as in the [camera](http://svg-wow.org/blog/2010/08/14/camera/) and [animated lyrics](http://svg-wow.org/blog/2009/10/04/animated-lyrics/) examples. The former uses an extension of YUI 3 while the latter uses an extension of YUI 2.

##### Animating geometry

###### Basic Geometry

Animating SVG geometry with YUI is quite simple. The following example animates a `<rect>` element's width, height and corner radii:

```
var anim = new Y.Animate({
    node: '#rectA',
    from: {
        width: 200,
        height: 100,
        rx: 5,
        ry: 5
    },
    to: {
        width: 300,
        height: 100,
        rx: 10,
        ry: 10;
    },
    duration: 2,
    easing: Y.Easing.elasticOut
});
        
```

See the [shape animations](http://svg-wow.org/yui-animations/svg-animate.xhtml#shape-animations) tests.

As discussed later on, some changes under the YUI hood made this work. But from a developer's perspective, this animation works the exact same way as the animation of any other HTML attribute or CSS property.

###### The `<path>`'s `d` attribute

One geometry attribute is a little special: the [`d`](http://www.w3.org/TR/SVG/paths.html#DAttribute) attribute on the [`<path>`](http://www.w3.org/TR/SVG/paths.html#PathElement) element. The `<path>` element is used for arbitrarily complex geometry. A `<path>` can describe any shape. Its `d` attribute describes its geometry in terms of path segments which can be lines, arcs, quadratic or cubic [Bezier curves](http://en.wikipedia.org/wiki/Bezier_curves) (there are a few more commands, but they all map to Bezier curves).

Animating the `d` attribute also required a bit of extension to YUI's animation engine, but with that extension, the `d` attribute can be animated like any other, as shown below.

```
var anim = new Y.Animate({
    node: "#pathA",
    from: {d: "M 0 0 C 50 0 100 50 100 100 C 50 100 0 50 0 0 Z"},
    to: {d: "M 0 0 C 100 0 100 0 100 100 C 0 100 0 100 0 0 Z"},
    duration 1s,
    easing: Y.Easing.bounceBack
});
        
```

See the [paths animations](http://svg-wow.org/yui-animations/svg-animate.xhtml#path-animations) tests, which shows, among other things, a check mark morphing into a cross over time, as represented in the following images.

![](/yuiblog/blog-archive/assets/hardy-svg/framed-morphing-shapes.png)

The [Gandhi quotes](http://svg-wow.org/blog/2010/10/05/gandhi-quotes/) demo uses this technique of animating the `d` attribute to morph shapes into Gandhi's figure.

##### Animating other SVG attributes

Of course, the YUI animations are not limited to geometry attributes. Any SVG attribute can be animated. For example, the following animation animates the blur radius on a horizontal blur filter.

```
// SVG snippet
<filter ..
    <feGaussianBlur id="blurFilter" stdDeviation="10 10" ... />
</filter>

// JavaScript animation
var anim = new Y.Animate({
    node: '#blurFilter',
    from: {stdDeviation: [0, 20]},
    to: {stdDeviation: [0, 0]}
});
        
```

See the [filter animations](http://svg-wow.org/yui-animations/svg-animate.xhtml#filter-animations) tests. The following image shows how animating a Gaussian blur can be used to transition between button states.

![](/yuiblog/blog-archive/assets/hardy-svg/framed-filter-effect.png)

This type of effect is used in the [fast blur effect](http://svg-wow.org/blog/2009/10/04/fast-blur/) demo, even though that demo does not use YUI animation but declarative SMIL animation elements (at the expense of only running in browsers supporting that feature, as explained earlier).

##### Animating CSS properties

Like HTML, SVG elements have attributes and also CSS properties. SVG has some [specific CSS properties](http://www.w3.org/TR/SVG/styling.html#SVGStylingProperties). These properties can be animated, sometimes to create surprising effects. For example, the [`stroke-dashoffset`](http://svg-wow.org/blog/2010/10/05/gandhi-quotes/) property can be used to simulate drawing a shape.

```
// SVG snippet
<rect id="rectA" width="100" height="50" stroke-dasharray="300 300" stroke-dashoffset="300" />

// JavaScript
var anim = new Y.Animate({
    node: "#rectA",
    to: {'stroke-dashoffset': 0},
    duration: 0.25
});
        
```

See the [stroke animations](http://svg-wow.org/yui-animations/svg-animate.xhtml#stroke-animations) tests.

The [graffitis](http://svg-wow.org/blog/2010/09/06/graffitis/) demo uses this technique (even though without YUI animation) and so does the [camera](http://svg-wow.org/blog/2010/08/14/camera/) demo (this time with YUI animation).

[![](/yuiblog/blog-archive/assets/hardy-svg/framed-graffitis.png)](http://svg-wow.org/blog/2010/09/06/graffitis/)

### YUI and SVG: Under the hood

The svg-wow.org web site uses both YUI 2 and YUI 3 and has SVG-specific extensions for both. The following section of this article focuses on the YUI 3 extensions.

Extensions were needed to:

-   make YUI work with SVG's DOM specificities
-   account for implementation differences
-   add support for new attribute types such as SVG transforms
-   add additional animation timing and synchronization features

#### Accounting for SVG DOM Specificities

As described earlier, SVG attributes can be animated with declarative elements such as `<animate>`. To support SVG's animation model, SVG attribute values hold both an _animated_ and a _base_ value. For example, the `r` attribute on a [`<circle>`](http://www.w3.org/TR/SVG/shapes.html#InterfaceSVGCircleElement) element is an `[SVGAnimatedLength](http://www.w3.org/TR/SVG/types.html#InterfaceSVGAnimatedLength)` defined as follows:

```
interface SVGAnimatedLength {
  readonly attribute SVGLength baseVal;
  readonly attribute SVGLength animVal;
};

```

As a result, even in implementations that do not support declarative animation, we need to reach down to the `baseVal` to read an attribute's value:

```
var circle = document.getElementById('#myCircle');
var rValue = circle.getAttribute('r').baseVal.value;


```

Extensions were needed to allow the animation engine to account for the SVG attributes' unusual value model. Thankfully, YUI 3 has a concept of animation _behaviors_. Behaviors are essentially attribute-specific hooks, and it was fairly easy to add support to handle SVG attribute values. For example, `SVGAnimatedLength` attributes are handled like so:

```
var lengthBehavior = {
    set: function (anim, att, from, to, elapsed, duration, fun) {
        // SVG specific handling
    },

    get: function (anim, attr) {
        // SVG specific handling
    }
};

// Handle <circle>'s r attribute
Y.Animate.behaviors.r = lengthBehavior;

```

There are more extensions for other SVG attributes values such as the `transform` attribute, color attribute values (like `fill`, `stroke` or `stop-color`) and attributes such as `stdDeviation` mentioned earlier.

A few similar tweaks were required, for example in the `Y.Node.prototype.toString` method, again to account for SVG's `baseVal` (this time on the `className` node property). Another example is the default node setter in the `Node` module.

#### Accounting for browser differences

While the previous extensions are required because of specification differences between HTML and SVG, the following are required because of implementation variations between browsers.

SVG has a special category of attributes called [presentation attributes](http://www.w3.org/TR/SVG/styling.html#UsingPresentationAttributes). In implementations also supporting CSS styling (which all browsers support), these presentation attributes are really just another way to specify a CSS property with a low [specificity](http://www.w3.org/TR/CSS2/cascade.html#specificity). From the SVG specification:

> The presentation attributes thus will participate in the CSS2 cascade as if they were replaced by corresponding CSS style rules placed at the start of the author style sheet with a specificity of zero. In general, this means that the presentation attributes have lower priority than other CSS style rules specified in author style sheets or 'style' attributes.

Unfortunately, some browsers do not implement the specification correctly and `window.getComputedStyle` does not always account for all possible sources for setting the SVG CSS properties: CSS selectors, style attribute and presentation attributes.

YUI came to the rescue thanks to the `Node` module which could be extended to hide these browser differences. The `Y.DOM.CUSTOM_STYLES` and the `Y.Node.prototype.getComputedStyle` could be extended to offer a uniform way to read SVG style properties.

#### Extending `Y.DOM`

YUI wraps all DOM access through the `Node` interface. As a result, some SVG specific DOM methods, such as `getBBox` (used to compute the bounds of an SVG element), are not accessible on the wrapped object.

To make things easier to program for SVG, extensions to the default Y.DOM module (which `Node` uses) were added to either expose SVG DOM features or add convenience methods, commonly needed when manipulating content:

-   `firstElement/lastElement/prevElement/nextElement/removeAllChildren` (not SVG specific)
-   `getMatrix/setMatrix`. Provides an easy way to manipulate transforms on SVG elements, something notoriously difficult with the standard SVG DOM
-   `getBBox/getViewportBBox` provide simple ways to access bounding box in the element's coordinate system or in viewport space.
-   `loadContent`. A utility to insert a DOM fragment described using a JavaScript object literal. For example:
    ```
    myNode.loadContent({
        tag: 'g',
        fill: 'red',
        stroke: 'none',
        children: [{
            tag: "rect",
            x: 10,
            y: 10,
            width: 200,
            height: 300
        }, {
            tag: 'circle',
            r: 10,
            cx: 105,
            cy: 155
        }, {
            tag: 'image',
            'xlink:href': 'images/photo.png',
            width: 200,
            height: '300px'
        }, prevSibling);
            
    ```
    
    is a shorthand for making various DOM calls (such as `createElementNS`, `setAttributeNS` and `appendChild`) to create a `g` element and its children and inserting it before `prevSibling` under `myNode`. The utility deals with namespaces for attributes and elements.
    

#### Additions to the Animation engine for timing and synchronization

Many, if not most effects involving animation require multiple choreographed animation instances. Typically, several animations are required to create a desired effect, and the start or end of animations depend on each other, sometimes with a time offset: animations need to be synchronized.

For example, if you have a set of shapes which need to fade in one after the other, you will need to create a fade animation for each element and then chain their start time with a slight offset.

```
var chained = Y.all('#chained circle'),
    firstAnim, previousAnim;

chained.each(function (circle) {
    var anim = new Y.Animate({
        node: circle,
        from: {'fill': 'white'},
        to: {'fill': 'gray'},
        duration: 0.25
    });
    if (previousAnim !== undefined) {
        // Synchrnoize the start of anim to be 0.15 seconds after the begining
        // of the previous circle's animation (previousAnim).
        previousAnim.onBegin(anim, 0.15);
    } else {
        firstAnim = anim;
    }
    previousAnim = anim;
});

// Start the first animation 1s after a click on any of the circles.
// Note that this is an extension to the default YUI run method which does not
// take a time offset.
chained.on('click', function () {
    firstAnim.run(1);
});

```

See the [time offsets](http://svg-wow.org/yui-animations/svg-animate.xhtml#time-offsets) tests.

The method `onBegin` makes it easy to synchronize the start of two animations, with an optional time offset. Actually, `onBegin` can also invoke a function with a time offset. Likewise, the `onEnd` extension makes it easy to synchronize with the end of an animation.

By default, YUI animations have events which provide a way to synchronize. The `onBegin` and `onEnd` methods express the synchronization more concisely (a similar example of conciseness is shown below).

In addition, it is sometime necessary to synchronize an animation with an event, again with a time offset. The `beginOn` and `endOn` extensions allow us to express that. For example:

```
anim.beginOn(Y.one('#button'), 'click', 0.5);

```

will start the animation 0.5s after the element with id 'button' was clicked. This is a short-hand for:

```
Y.one('#button').on('click', function () {
    setTimeout(500 /* ms */, function () {anim.run();});
});

```

A final extension made to the animation class was the ability to make an animation object apply its first frame's state before it was actually started. This is often needed when creating animation effects involving multiple animations which start at different time offsets.

```
var anim = new Y.Animate({
    node: Y.one('#button'),
    from: {r: 30, 'fill-opacity': 0, color: 'crimson'},
    to: {r: 80, 'fill-opacity': 1, color: 'gold'},
    duration: 0.25
});

// the following will set the desired state on the target object prior to
// actually starting the animation.
anim.applyStartFrame();
anim.run(2);

```

The [picture shuffle](http://svg-wow.org/blog/2010/09/18/picture-shuffle/) demo uses animation offsets for the effect that spreads the stack of pictures or puts the pictures back in a stack.

[![](/yuiblog/blog-archive/assets/hardy-svg/framed-picture-shuffle_poster.png)](http://svgwow.org/blog/2010/09/18/picture-shuffle/)

### Conclusion

Working with SVG and YUI, and in particular YUI 3, has been a very enjoyable experience: a lot of the YUI functionality applies to SVG right out of the box and YUI's extensible architecture made it possible to work around occasional issues and to add desired functionality.

Of course, increased standard support for SVG in YUI would be helpful, in particular making YUI work with stand alone SVG documents and making the `Node` class wrap SVG elements without workarounds.

There are also a few enhancements that would be helpful. For example, it would help if animations could target multiple elements. Likewise, supporting multiple values (as in the [`<animate>`](http://www.w3.org/TR/SVG/animate.html#AnimateElement) SVG element for example) would be helpful to create more sophisticated effects.

The demos on svg-wow.org were written for YUI 3.1 and ported to 3.2 for the purpose of this blog. In 3.2, [transitions](http://developer.yahoo.com/yui/3/transition/) were introduced which make use of native [CSS transitions](http://www.w3.org/TR/css3-transitions/) if available in the browser. It might be possible for the YUI animation engine to similarly leverage SMIL animation where available (Opera, Firefox and WebKit at the time of this writing) which should also yield performance improvements.

The [SVG extensions on the svg-wow.org web site are available as a YUI 3 Gallery module](http://yuilibrary.com/gallery/show/svg "YUI Library :: Gallery :: YUI SVG Extensions") for those who want to enjoy the fun of working with YUI and SVG.

### References

-   [SVG Wow!](http://svg-wow.org)
-   [SVG Specification](http://www.w3.org/TR/SVG/)
-   [SVG Tutorial](http://www.w3schools.com/svg/default.asp)
-   [Adobe's SVG Zone](http://www.adobe.com/svg/)(a little dated, but still has good examples)
-   [carto.net examples](http://www.carto.net/papers/svg/samples/)
-   [KevLinDev](http://www.kevlindev.com/tutorials/basics/index.htm)