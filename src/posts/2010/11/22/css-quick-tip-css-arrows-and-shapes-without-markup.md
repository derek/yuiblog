---
layout: layouts/post.njk
title: "CSS Quick Tip: CSS Arrows and Shapes Without Markup"
author: "YUI Team"
date: 2010-11-22
slug: "css-quick-tip-css-arrows-and-shapes-without-markup"
permalink: /2010/11/22/css-quick-tip-css-arrows-and-shapes-without-markup/
categories:
  - "CSS 101"
  - "Development"
---
![](/yuiblog/blog-archive/assets/cssarrows/headshot.jpg)Nate Cavanaugh is the Director of User Interface Engineering for [Liferay Inc.](http://liferay.com), in which he helps guide not only the interface for end user products, but also the interface for different development methodologies. Nate currently heads up Liferay's [AlloyUI project](http://alloy.liferay.com), which is built on top of YUI3. With an extensive history in UI design and development, he is constantly looking for ways to simplify the user and developer experience alike. While responsible day-to-day for everything from UI design and Javascript development to Java integration and code refactoring, in his off time he enjoys drawing, reading, watching movies and hanging out with his wife and two dogs. He sporadically tweets under the guise of [@natecavanaugh](http://twitter.com/natecavanaugh).

Often it's useful to show an arrow or some sort of contextual indication of what element something is related to. We see this frequently with tooltips that use arrows to point to the item that is triggering them.

Usually, however, adding in this arrow has a cost, both in markup and in CSS, which forces people who do not wish to use this style to not only compensate for this extra markup by hiding it from display, but also in the actual weight of the page for the markup of each arrow. The cost is even higher if you use an image to display this arrow, because there is the extra overhead of the data that needs to be transferred (and possibly an extra request if the treatment is not sprited).

Today I'm going to show you a way to add in these visual hints without having to create any markup. We use this technique inside of [Liferay](http://liferay.com) and [AlloyUI](http://alloy.liferay.com) for our tabs system. We had a legacy set of tabs we needed to style that support having the tabs live separately in the markup from the section they're logically related to, which makes it very difficult to visually indicate relationship. For instance, you can't put a border around both the tab section and the tabs, because they don't share a common parent.

Instead, we had to come up with some other way to indicate that the selected tab related to the currently displayed section. The other challenge was that each tab item needed to share the same markup and css structure as the AlloyUI tabview where they do share a common parent.

So we didn't want to add in custom markup to show visual relationship for one set of tabs vs. another.

![](/yuiblog/blog-archive/assets/cssarrows/shapes_0.png)

This technique builds on one that has been discussed by the [Filament Group](http://www.filamentgroup.com/lab/image_free_css_tooltip_pointers_a_use_for_polygonal_css/) and expertly pioneered by [Tantek Çelik](http://tantek.com/CSS/Examples/polygons.html) (whom we had the pleasure of seeing at this year's [YUIConf 2010](http://yui.zenfs.com/theater/yuiconf2010-tantek-hd.mov)).

I'll quickly cover the concept of what we'll be doing.

The root concept is creating polygonal shapes using very large borders. The way this is done is by setting the width and height of an element to 0, and setting a large border on the element. At the corner of a element's border, a natural shape is created. By selectively setting different sides of the border color to transparent, we can create different shapes.

![](/yuiblog/blog-archive/assets/cssarrows/shapes_1.png)

However, all of this has been covered in great depth before. What I think is pretty cool is how to do this without inserting markup into the page.

## Generating CSS Content

CSS allows us to generate content using a property called, appropriately enough, "content". However, we can only use this property using the `:after` or `:before` pseudo-elements, and we're somewhat limited on what we can insert (we can't insert more HTML for instance).

What's cool about this though is that with the content we insert, we can style it as if it were an element. This means we can transform it into a polygonal shape. And because the `:after` and `:before` pseudo-elements insert after or before _the content of our element_ (and not outside of the element), we can move it around and position it relative to our element. From there we can use it as a contextual pointer.

Let's go through the code.  
First, our HTML:

```
<div id="demo"></div>
```

Let's style our box to look like a box:

```
#demo {
	background-color: #333;
	height: 100px;
	position: relative;
	width: 100px;
}

```

You'll notice that we set position to relative. This is to allow us to set our pointer to absolute and have it stay relative to our box.

Now, let's go ahead and insert the base styling for our pointer:

```
#demo:after {
	content: ' ';
	height: 0;
	position: absolute;
	width: 0;
}

```

You'll notice a few things. One, we inserted just a blank space, which is enough to give us a handle to style. Second, we're setting position to absolute so we can move the pointer where we want in relation to box.

Now, here is the code to style the pointer to look like a shape:  

```
#demo:after {
	content: ' ';
	height: 0;
	position: absolute;
	width: 0;

	border: 10px solid transparent;
	border-top-color: #333;
}
```

Now, to top it off, let's go ahead and position the pointer around the box. Since our relative parent is our #demo element, our coordinates are relative to it's coordinates. It's also important to mention that the dimension of our pointer is controlled by the border width. So the overall width of our pointer in this case is 20px (one sloping side is 10px and the other sloping side is the other 10px).

So let's say we want to use the arrow to make the box look like a comment or tooltip, we would place it on the bottom and move it a few pixels in.  

```
#demo:after {
	...previous code...

	top: 100%;
	left: 10px;
}

```

Which makes our box look like this:  
![](/yuiblog/blog-archive/assets/cssarrows/shapes_2.png)

Or say we wanted to center our arrow, which is what we do in the tabs I showed earlier in Liferay.  
Setting the left to 50% will set the top/left points of the arrow to the middle of our box, which means visually, it will always be off center.

What we need to do instead, and why I mentioned that our arrow dimensions are controlled by the border size, is to position it 50% from the left, but set a negative left margin on it that is **exactly the same as the border-width** of our arrow.

So to center it horizontally, we would do:

```
#demo:after {
	...previous code...
	
	border: 10px solid transparent;
	border-top-color: #333;

	top: 100%;
	left: 50%;
	margin-left: -10px;
}
```

![](/yuiblog/blog-archive/assets/cssarrows/shapes_3.png)

And by changing which side of our arrow has color, we can easily change the orientation of the arrow. Basically, the rule is, whichever side of the arrow we want our box to show up on, that's the side of the border we give color to.

So if I want my box to display on the left side of the arrow, I change the color to being on the left side of the border:

```
#demo:after {
	...previous code...

	border: 10px solid transparent;
	border-left-color: #333;
}
```

Since it's on the left side, we also need to change the top/left coordinates of the arrow as well. So we'll change it to:  

```
#demo:after {
	...previous code...

	left: 100%;
	top: 10px;
}
```

Which gives us this:

![](/yuiblog/blog-archive/assets/cssarrows/shapes_4.png)

Now, the really cool part with this is that we can combine the `:before` and `:after` pseudos to add multiple arrows to a single element. This means we can not only have an element with pointers going in two directions, but you can also simulate a border by making one arrow slightly larger and centering it above another the other arrow.

For instance, code like this:

```
#demo {
	width: 100px;
	height: 100px;
	background-color: #ccc;
	position: relative;
	border: 4px solid #333;
}

#demo:after, #demo:before {
	border: solid transparent;
	content: ' ';
	height: 0;
	left: 100%;
	position: absolute;
	width: 0;
}

#demo:after {
	border-width: 9px;
	border-left-color: #ccc;
	top: 15px;
}

#demo:before {
	border-width: 14px;
	border-left-color: #333;
	top: 10px;
}

```

Can produce this:

![](/yuiblog/blog-archive/assets/cssarrows/shapes_5.png)

You can also take the arrow and use it to point inside of the box and (with some CSS3 styling) get a box that looks like this:

![](/yuiblog/blog-archive/assets/cssarrows/shapes_6.png)

By manipulating the left and right widths of the arrow, we can even do a fold over effect, and simulate a drop shadow with the other shape, using this code:

```
#demo:before {
	border-width: 10px;
	border-top-color: #ccc;
	border-left-width: 50px;
	border-right-width: 0;
	left: 0;
}

#demo:after {
	border-width: 2px;
	border-top-color: #777;
	border-left-width: 50px;
	border-right-width: 0;
	left: 0;
}

```

![](/yuiblog/blog-archive/assets/cssarrows/shapes_8.png)

## Caveats

#### Browser support

This is supported in every major browser, including IE8. The two exceptions, of course, are IE 6 and 7 which do not support the `:before` and `:after` pseudo-elements.

Now, why would an enterprise product like [Liferay](http://www.liferay.com/ "Enterprise open source portal and collaboration software - Liferay.com") be okay with shipping something that wasn't supported in 2 versions of IE that still claim a decent chunk of the enterprise browser market?

Mainly because we used this for something that was helpful to the user, but not critical to its function. For instance, in IE6 and 7, the tab still looks selected, it still has a background, it just does not have an indicator pointing to the content.

![](/yuiblog/blog-archive/assets/cssarrows/shapes_7.png).

So I would recommend when deploying this technique, if IE6 and 7 are important for you to support, choose areas where this technique will be helpful, but provide a graceful fallback or alternate style for those versions of IE.

#### Generated content is not part of the DOM

The generated content for the pseudo-element, though styleable, is not actually part of the DOM tree and doesn't exist as an element. While CSS 3 does provide a hook into this with the `::before` and `::after` psuedo-elements (notice the extra colon), it's there primarily as a designer hook, and the content doesn't exist as an actual element. There are a couple of implications to this.

#### Not inspectable

Since Liferay supports extensive theming, one of the more common questions I get asked is "Where are those arrows on the tabs coming from?", because the :after/:before pseudo-elements are not inspectable by Firebug, Webkit's Web Inspector, Opera's Dragonfly, etc.

Documentation helps with this, as does a clear and organized stylesheet, but you do miss out on the discoverability we've come addicted to with Firebug.

#### Not scriptable (kinda sorta)

The `:after`/`:before` pseudos are not directly targetable via JS, so you can't manipulate their properties directly via the normal route, for instance, if you wanted to dynamically set the arrow position.

However, you can use the really awesome [Stylesheet Utility](http://developer.yahoo.com/yui/3/stylesheet/) in YUI 3 to manipulate the pseudos for your content via that route. So while not directly targetable via script, you _can_ manipulate it with script.

For the most part, these caveats are developer caveats and are pretty minor in comparison to the benefits. In addition, with the work being done with data URI's and using MHTML, you can imagine using this technique to inject markup-free, request-free images as well.

Overall, this technique can be a very easy way to enhance elements on your page and provide context to your users.

## Further reading

-   [A Study of Regular Polygons](http://tantek.com/CSS/Examples/polygons.html)
-   [Image-free CSS Tooltip Pointers - A Use for Polygonal CSS?](http://www.filamentgroup.com/lab/image_free_css_tooltip_pointers_a_use_for_polygonal_css/)
-   [CSS generated content techniques - Opera Developer Community](http://dev.opera.com/articles/view/css-generated-content-techniques/)
-   [Data URIs explained](http://www.nczonline.net/blog/2009/10/27/data-uris-explained/)

### Work with YUI 3 at Liferay

Do you have a passion for front end development and love open source software? Liferay is hiring talented front end developers who want to change the world one line of code at a time. If that sounds like you, we want to meet. Go ahead and shoot us your resume at [careers@liferay.com](mailto:careers@liferay.com).