---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Stephen Woods' TimePicker Module"
author: "Stephen Woods"
date: 2010-03-03
slug: "gallery-timepicker"
permalink: /2010/03/03/gallery-timepicker/
categories:
  - "YUI 3 Gallery"
---
I was working on an internal product here at Yahoo! that required users to input time-of-day in a specific format. I decided that rather than force users to type exactly the right format it would be easier just to provide a UI widget for time input. I've always liked the [jQuery timepicker](http://haineault.com/media/jquery/ui-timepickr/page/); it's a simple and fast way to input time and meets my use case perfectly. Of course, we were using [YUI 3](http://developer.yahoo.com/yui/3/), so I decided to recreate the widget with YUI 3. (This is quick and easy with the [YUI 3 Widget foundation](http://developer.yahoo.com/yui/3/widget/).) I thought it might be useful to others working with YUI, so I decided to give it right back to the community for use in your own projects.

Using the picker should be pretty simple for you if you are familiar with the basics of YUI 3. (see a [live version](http://stephenwoods.net/demos/timepicker/demo.html) here).

[![](/yuiblog/blog-archive/assets/gallery-timepicker-20100301-135752.jpg)](http://stephenwoods.net/demos/timepicker/demo.html)

To use the picker in your own project include the script:

```
	<script type="text/javascript" src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js&gallery-2010.02.25-22/build/gallery-timepicker/gallery-timepicker-min.js"></script>

```

Then instantiate and render the widget:

```
YUI().use('gallery-timepicker', function(Y){
	//Pass a configuration object to the timepicker
       var picker = new Y.Saw.Timepicker(
           {
			   //an element that will contain the timepicker
               contentBox: 'div.foo', 

			   /the initial time
               time:{
                   hour:0, 
                   minute:0
               }, 
               strings:{
                   am:'AM', 
                   pm:'PM', 
                   seperator:':'
               }, 
               delay:5 //delay before selecting a box on mouseover
           }
       );
      picker.render();
});

```

Like all YUI 3 widgets the timepicker constructor takes a configuration object to control the initial display of the widget. Manipulating the widget is then done via the widget methods `render`, `hide` and `show`. The `render` method is where the actual DOM elements are created. `hide` and `show` simply add and remove the class `yui-timepicker-hidden` to the elements bounding box. This class (and the additional css classes for the widget) must be implemented for the widget to behave properly. For simplicity's sake, here are the styles I am using on the running example:

```
	/* yui reset assumed */
	.yui-timepicker{
        display: block;
        margin: 5px;
        left: 0;
        position: relative;
        background: transparent;
    }

    /* standard for widgets, in this case just pushing the hidden one off the screen*/
    .yui-timepicker-hidden{
        left: -9999em;
        position: absolute;
    }

    .yui-timepicker{
        color: #000;
        font-family: verdana;
        text-align: left;
    }

/* the picker is actually two ordered lists */
    .yui-timepicker ol{
        display: block;
        position: relative;
        left: 0;
        .left: 5px;
        margin: 0px;
        padding: 0px;
        height: 24px;
        text-align: left;
        -webkit-transition: left .1s ease-in;
    }

    .yui-timepicker li{
        list-style: none;
        display: block;
        float: left;
        position: relative;
        left: 0;
        overflow: hidden;
        width: 19px;
        padding: 1px;
        margin: 0 2px 0 0;
        border: 1px solid #999;
        text-align: center;
    }

    .yui-timepicker li{
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
    }

	/* highlight the selected times */
    .yui-timepicker li.yui-timepicker-active{
        background: #000;
        color: #fff;
        -moz-box-shadow: 2px 2px 2px #ccc;
        -webkit-box-shadow: 2px 2px 2px #ccc;
    }

```

I'm using webkit animations just for style; for your project, customize these styles as you see fit. For most purposes you will want to hide the picker initially. Calling the `hide` method just adds the `yui-timepicker-hidden` style to the widget's bounding box. I've added a click handler to my wrapper element so that a click on the element with the id `time` will cause the widget to appear/disappear:

```
	 picker.hide();
     Y.get('#main').on('click', function(e){
         var target =e.target;
         if(target.test('#time')){
             picker.toggle();
         }
     });

```

To make the picker actually useful I will listen to the

timeset event, which returns an object with information about the selected time, I'm going to use the "s24hour" member of the object passed to the handler. That's a string representation of the time in 24 hour format. (also available are `hour`, `minute`, `ampm` and `s12hour`):

```
	picker.subscribe('timeset', function(e){ 
        //timeset is a custom event that fires when the time is *set*
        //use this rather than timeChange
        Y.get('#time').set('value',e.s24hour);
    });
    
//add a handler to "cell click" to hide the picker when the user clicks on a cell
    picker.subscribe('cellclick', function(e){
       this.hide(); 
    },picker);

```

That's all there is to it! Enjoy.