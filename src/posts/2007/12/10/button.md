---
layout: layouts/post.njk
title: "The Versatile Button Control"
author: "Todd Kloots"
date: 2007-12-10
slug: "button"
permalink: /2007/12/10/button/
categories:
  - "Development"
---
[![New YUI Button Control examples from engineer Todd Kloots.](/yuiblog/blog-archive/assets/buttons.png)](http://developer.yahoo.com/yui/examples/button/)

With the [release of YUI 2.4.0](/yuiblog/2007/12/04/yuii-240/), there are [several new examples](http://developer.yahoo.com/yui/examples/button/) designed to demonstrate the [Button Control](http://developer.yahoo.com/yui/button/)'s versatility. By default, the Button Control enables the creation of rich, graphical buttons that function like traditional HTML form buttons. Button also seamlessly integrates with both the [Overlay](http://developer.yahoo.com/yui/container/overlay/) and [Menu](http://developer.yahoo.com/yui/menu/) Controls, making it possible to create both menu buttons and split buttons whose menu can be used to display another YUI control. This extends the developer's toolkit my making it easy to dream up and implement new types of UI controls for web applications.

## Menu or Overlay?

Both split buttons and menu buttons incorporate a menu that can be created using either an Overlay or Menu Control. Choose Menu if you want the Button to pop up a traditional menu or a canvas with the default Menu styling. Choose Overlay if you want the basics: a blank canvas with no default style or behaviors — a canvas that can contain any content or UI control. Overlay is also lighter in file size. In either case, you'll have the flexibility of being able to create the menu using existing HTML or script alone, and both Overlay and Menu provide an <iframe> shim to prevent <select> elements from poking through your Button's menu in IE 6.

## Two Approaches to a Popup Calendar

[![Popup Calendar -- Menu Button Version](/yuiblog/blog-archive/assets/popup-calendar.png)](http://developer.yahoo.com/yui/examples/button/btn_example09.html)Two of the new Button Control examples demonstrate how to create a popular control found all over the web: a popup calendar.

-   [Calendar Menu Button](http://developer.yahoo.com/yui/examples/button/btn_example09.html)
-   [Calendar Split Button](http://developer.yahoo.com/yui/examples/button/btn_example10.html)

The purpose of the first example is to show how easy it is to create a traditional calendar popup implementation by rendering a [Calendar Control](http://developer.yahoo.com/yui/calendar/) instance inside the menu of a menu button. The implementation is straightforward, performance-conscious, and less than one hundred lines of code.

[![Popup Calendar -- Split Button Version](/yuiblog/blog-archive/assets/popup-calendar2.png)](http://developer.yahoo.com/yui/examples/button/btn_example10.html)The second example takes a slightly new approach to a calendar popup. Using a split button, the button's face displays the currently selected date, while the other section of the button can be pressed to display a Calendar control. The result is a powerful date picker control that consumes a tiny amount of screen real-estate.

## New Useful Combinations

Using the menu as your canvas and the palette of YUI widgets, it is possible to use both the menu button and split button controls to create new UI controls not natively available in HTML, as illustrated by both the [Slider Button](http://developer.yahoo.com/yui/examples/button/btn_example14.html) and [Color Picker Button](http://developer.yahoo.com/yui/examples/button/btn_example11.html) examples. In both examples, the face of the button is used to reflect the current value of the control embedded in the menu. While the slider button example mimics the opacity slider found in Adobe Photoshop, a slider button could also be used to for other purposes. Imagine, for example, a new take a on a rating widget.

\* \* \* \* \*

If you've implemented Button, I'd love to know what you're using it for. Please share your ideas and links to your implementations in the comments section. Is anything missing for you in the current Button Control? I'd love to hear about that, too.