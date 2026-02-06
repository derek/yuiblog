---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Matt Taylor's RaphaelJS Module"
author: "Matthew Taylor"
date: 2010-09-27
slug: "gallery-raphaeljs"
permalink: /2010/09/27/gallery-raphaeljs/
categories:
  - "Development"
---
[RaphaelJS](http://raphaeljs.com "RaphaelJS website") is a powerful JavaScript library that manages [SVG](http://www.w3.org/Graphics/SVG/ "W3C SVG site") drawings and animations. It allows you to easily create SVG canvases and draw basic shapes and paths very easily, even grouping them into sets and applying transformations to one or many vectors. You can draw shapes, manipulate images, and animate everything. RaphaelJS provides a nice [API](http://raphaeljs.com/reference.html "RaphaelJS Documentation") to create and modify SVG elements with ease.

While the library is impressive, but I've found that I can add some important features to elements of the RaphaelJS library with YUI3. I've started off these efforts with the new [RaphaelJS Gallery Module](http://yuilibrary.com/gallery/show/raphael "RaphaelJS Gallery Module on YUI Library").

### Lazy Loading RaphaelJS and Plugins

The first feature is the lazy-loading of not only the RaphaelJS library, but any RaphaelJS [plugins](http://raphaeljs.com/reference.html#plugins-canvas "Plugins documentation on RaphaelJS site") you might need. The [RaphaelJS Gallery Module](http://yuilibrary.com/gallery/show/raphael "RaphaelJS Gallery Module on YUI Library") will only load these files when you declare you'll be using them within a YUI sandbox. For example:

```
 
YUI({gallery: 'gallery-2010.09.22-20-15'}).use('gallery-raphael', function(Y) {
 
	Y.Raphael().use(function(Raphael) {
		
		// use Raphael here just like you would outside YUI
		var paper = Raphael('myPaper', 500, 500);
 
	});
 
});

```

If you are using RaphaelJS plugins, specify their paths in an array and send that as the first parameter in the Y.Raphael().use() function:

```
 
YUI({gallery: 'gallery-2010.09.22-20-15'}).use('gallery-raphael', function(Y) {
 
	var myPlugins = ['plugins/raphael.awesomePlugin.js', 'plugins/raphael.wickedPlugin.js'];
 
	Y.Raphael().use(myPlugins, function(Raphael) {
 
		// use Raphael here just like you would outside YUI
		var paper = Raphael('myPaper', 500, 500);
		// the 'paper' will have any new functions added by your plugins now
	});
 
});

```

The RaphaelJS library is loaded first, then any specified plugins are loaded before your callback function is executed with the Raphael object as the only parameter.

### Custom Events

Once you've created a drawing space with the Raphael object, then you can immediately get down to the drawing. When you call methods like `rect`, `circle`, and `path` on the drawing space, you'll receive back objects representing SVG vectors. Normally, you'll have access to their corresponding DOM elements through the `node` property. For example:

```
 
var paper = Raphael('myPaper', 500, 500);
var square = paper.rect(0, 0, 100, 100);

```

This creates a rectangular vector object at coordinates \[0,0\] with a width and height of 100 pixels. You have access to the underlying DOM element (which is an SVG `rect` element) like so:

```
 
var rectNode = square.node;
rectNode.onclick = function() {
	alert('Congratulations, you clicked a square!');
};

```

If you are an avid YUI user, you'd probably like something more than this. How about a built in `Y.Node` as well? Just like the `node` property refers to the HTMLElement behind the SVG object, the `$node` property refers to the `Y.Node` wrapper for that element. So you can do things like this:

```
 
square.$node.on('mouseover', function() {
	alert('Congratulations, you can move a mouse!');
});

```

Let's try something more complex now. An interaction with one vector should be able to cause other drawn vectors to update their styles, right? How about we create some bars that all render their colors dependent on where a the mouse is located on a circle on the page:

```
 
var paper = Raphael('rcanvas', 600, 800);
 
var circ = paper.circle(350, 200, 100).attr({fill: 'pink', stroke: 'black'});
 
// pushing a bunch of rectangles into an array
var i=0; rectangles = [];
for (; i<10; i++) {
	rectangles.push(paper.rect(0, 40*i, 200, 20).attr({fill: 'red', stroke: 'yellow'}));
}
 
// looping through the rectangles, adding specific circle mousemove handlers for each
Y.Array.each(rectangles, function(rect, index) {
	var i = index + 1;
	circ.$node.on('mousemove', function(evt) {
		// the fill color is dynamic, dependent on the location of this rectangle
		// in the array as well as the location of the mouse
		var lf = circ.attrs.cx - circ.attrs.r,
			rt = 2 * circ.attrs.r + lf,
			x = evt.clientX - lf,
			top = circ.attrs.cy - circ.attrs.r,
			btm = 2 * circ.attrs.r + top,
			y = evt.clientY - top;
			red = (((128 * x) / (2 * circ.attrs.r))-1) * i/6,
			green = 256 - ((((128 * x) / (2 * circ.attrs.r))-1) * i/6),
			blue = (((128 * y) / (2 * circ.attrs.r))-1) * i/6;
		rect.attr('fill', 'rgb(' + red + ', ' + green + ', ' + blue + ')');
	});
});

```

This example is running [here](http://s.dangertree.net/js/raphael/gallery-raphael/examples/test2.html "RaphaelJS Gallery Module example 1"), but as you can see in the snapshots below, the color of each bar is dependent on the mouse location over the circle as well as the order of the bar.

[![](http://s.dangertree.net/js/raphael/images/raph_ex1.png)](http://s.dangertree.net/js/raphael/gallery-raphael/examples/test2.html "RaphaelJS Gallery Module example 1")  
[![](http://s.dangertree.net/js/raphael/images/raph_ex2.png)](http://s.dangertree.net/js/raphael/gallery-raphael/examples/test2.html "RaphaelJS Gallery Module example 1")  
_Depending on where your mouse cursor is located over the circle, the bar colors change individually._

So you can see that `$node` is a useful shortcut, but nothing spectacular. It would really be [fantastic](http://en.wikipedia.org/wiki/Ninth_Doctor "Obscure Doctor Who reference") if each SVG object you create with RaphaelJS could fire [custom events](http://developer.yahoo.com/yui/3/event/ "YUI3 Event Documentation"). That would allow your individual drawing elements to fire custom events, and anything on the page could listen and respond. This can be useful in many ways. For starters, it provides rich interactions between your drawings. User interactions with one vector can now notify any other vectors of the interaction on demand. This means you can programatically fire events from your drawings when certain conditions are met. Not only does this allow your drawings to notify other vectors, but anything on the page can listen in.

```
 
var paper = Raphael('rcanvas', 600, 800);
 
var circ = paper.circle(350, 200, 100).attr({fill: 'pink', stroke: 'black'});
 
// making arrays of rectangles and circles
var i=0, rectangles = [], circles = [];
for (; i<10; i++) {
	rectangles.push(paper.rect(0, 40*i, 40*i, 20).attr({fill: 'red', stroke: 'yellow'}));
	circles.push(paper.circle(0,0,20).hide());
}
Y.Array.each(rectangles, function(rect, index) {
	var i = index + 1;
	circ.$node.on('mousemove', function(evt) {
		var lf = circ.attrs.cx - circ.attrs.r,
			rt = 2 * circ.attrs.r + lf,
			x = evt.clientX - lf,
			top = circ.attrs.cy - circ.attrs.r,
			btm = 2 * circ.attrs.r + top,
			y = evt.clientY - top;
			newWidth = (((256 * x) / (2 * circ.attrs.r))-1) * i/6,
			red = (((128 * x) / (2 * circ.attrs.r))-1) * i/6,
			green = 256 - ((((128 * x) / (2 * circ.attrs.r))-1) * i/6),
			blue = (((128 * y) / (2 * circ.attrs.r))-1) * i/6;
		// this time, not only changing the color, but also the rectangle width
		rect.attr({
			width: newWidth,
			fill: 'rgb(' + red + ', ' + green + ', ' + blue + ')'
		});
		// firing custom event to notify that this rectangle width has changed
		rect.fire('width-changed', {width:newWidth, source: rect, order: index});
	});
	
	// each rectangle gets a listener that fires on width-changed
	rect.on('width-changed', function(evt) {
		var attrs = evt.source.attrs;
		// get the corresponding circle and move it to the right end of the rectangle
		circles[evt.order].attr({
			cx: attrs.x + attrs.width,
			cy: attrs.y,
			fill: 'cornflowerblue'
		}).show();
		
	});
	
});

```

Take a look at this running example [here](http://s.dangertree.net/js/raphael/gallery-raphael/examples/test3.html "RaphaelJS Gallery Module example 1"). You can also see from the snapshot below that circles are being drawn on the right ends of the rectangles. This is occuring in response to each individual rectangle's custom event firing, being caught by a handler that moves the circle to a position relative to the current attributes of the rectangle.

[![](http://s.dangertree.net/js/raphael/images/raph_ex3.png)](http://s.dangertree.net/js/raphael/gallery-raphael/examples/test3.html "RaphaelJS Gallery Module example 3")

This opens up some interesting possiblities for RaphaelJS within YUI3. For example, what if we could create a group of vector shapes with the group itself being the entity that fires events to the outside world? Internally, each vector drawing could communicate with its container via custom events, and the container would make decisions about what data it fires to the outside world. This opens up the idea of fully encapsulated, interactive SVG controls.

### Summary

With the ascendance of HTML5 and its satellite technologies, there are so many more options other than Flash for rich interactions. Ideally, any vectored elements on the page should be fully accessible and standardized. This opens up wonderful possiblities for us to create accessible, standard web controls without resorting to Flash. SVG is an appealing option because every vector drawn on the page is backed up by a DOM node that we can modify with YUI just like any other DOM node. That's what allows the [RaphaelJS Gallery Module](http://yuilibrary.com/gallery/show/raphael "RaphaelJS Gallery Module on YUI Library") to augment all SVG objects being created by RaphaelJS, and that is a key to rich interaction with these elments from elsewhere on the page.