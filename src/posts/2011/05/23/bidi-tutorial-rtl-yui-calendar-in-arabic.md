---
layout: layouts/post.njk
title: "Bidi Tutorial: RTL YUI Calendar in Arabic"
author: "YUI Team"
date: 2011-05-23
slug: "bidi-tutorial-rtl-yui-calendar-in-arabic"
permalink: /2011/05/23/bidi-tutorial-rtl-yui-calendar-in-arabic/
categories:
  - "Development"
---
This example shows how to create a right-to-left Arabic version of a ["Basic Popup Calendar"](http://developer.yahoo.com/yui/examples/calendar/popup.html) with YUI 2.9.0. The [YUI Calendar](http://developer.yahoo.com/yui/calendar/) component contains a number of useful APIs, including a configurable close button, dynamic iframe shim, and APIs for hiding and showing from the user. LTR: ![YUI Calendar in English screenshot](/yuiblog/blog-archive/assets/rtl-calendar/images/calendar-en.png) RTL: ![YUI Calendar in Arabic screenshot](/yuiblog/blog-archive/assets/rtl-calendar/images/calendar-ar.png) Click [here](/yuiblog/blog-archive/assets/rtl-calendar/examples/ar/calendar.html) to check out the working example. Click [here](/yuiblog/blog-archive/assets/rtl-calendar/rtl-calendar.zip) to download all the files needed to run the example locally.

### Steps to Bidirectionalize a Widget to RTL

1.  Declare the primary language and change the direction for the page inside the `<html>` tag with the `lang` attribute and `dir="rtl"`, this point in case the whole page is rtl, but if the page is ltr, we should add the rtl in widget.
2.  Convert CSS attributes and values that relate to direction in the style sheet, including float, image positions, text-align, margin, padding, border, etc. We recommend [CSSJanus](http://code.google.com/p/cssjanus/) for converting CSS.
3.  Update any JavaScript related to directionality. As much as possible, we recommend making direction configurable in your JavaScript code.
4.  Translate text strings from the original language to the RTL language in both the HTML page and JavaScript.
5.  Test sprite images in case they need to be flipped.
6.  Check A-grade compatibility, testing the calendar across browsers to be sure it's working fine.