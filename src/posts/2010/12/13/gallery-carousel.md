---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: The Carousel Module"
author: "Gopal Venkatesan and Fabian Frank"
date: 2010-12-13
slug: "gallery-carousel"
permalink: /blog/2010/12/13/gallery-carousel/
categories:
  - "Development"
---
_**About the authors:** [Gopal Venkatesan](http://g13n.in/) ([@g13n](http://twitter.com/g13n)) works for Yahoo! in Bangalore where he is one of the deans of the frontend engineering community; Gopal has been the lead engineer on the [YUI 2 Carousel](http://developer.yahoo.com/yui/carousel/ "YUI 2: Carousel Control") project since the 2.6.0 release. He is also the author of the new [YUI 3 Gallery Carousel](http://yuilibrary.com/gallery/show/carousel) module. [Fabian Frank](http://uk.linkedin.com/in/fabianfrank87) hails from Germany and works for Yahoo! in Beijing; Fabian has been with Yahoo since he finished his Master's of Research at the University of Glasgow._

### What is a Carousel?

A Carousel control provides a widget for browsing among a set of like objects arrayed vertically or horizontally in an overloaded page region. The "carousel" metaphor derives from an analogy to slide carousels in the days of film photography; the Carousel control can maintain fidelity to this metaphor by allowing a continuous, circular navigation through all of the content blocks.

The Carousel is part of a family of widgets that allow you to "overload" a space on the page, providing more content for that space than fits within its dimensions while providing an easy, intuitive mechanism for the user to discover and navigate the additional content. Accordions, Tabs, Trees and ScrollViews are other examples of this genre.

### Why yet another Carousel control?

YUI 3 needs a robust, feature-rich Carousel (as we have in [YUI 2](http://developer.yahoo.com/yui/carousel/ "YUI 2: Carousel Control")). The design goal for this Carousel was to make it lean and clean and add additional configurations through plugins, taking advantage of [YUI 3'](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library")s intrinsic support for modularity to preserve lightness and speed.

### YUI 3 Widget Framework

One of the biggest advantages of writing custom widgets using YUI 3 is the Widget framework (more on the Widget framework: [user's guide](http://developer.yahoo.com/yui/3/widget/ "YUI 3: Widget"), [in-depth video introduction](http://developer.yahoo.com/yui/theater/video.php?v=desai-yuiconf2009-widgets "Video: Satyen Desai — A Widget Walkthrough (YUI Theater)")). Comparing the [Carousel in YUI 2.8.2](http://developer.yahoo.com/yui/carousel/ "YUI 2: Carousel Control") to my [YUI 3 Gallery Carousel](http://yuilibrary.com/gallery/show/carousel "YUI Library :: Gallery :: Carousel"), the YUI 3 version is lean and elegant. This is because most of the heavy lifting with respect to providing the foundation providing common set of widget attributes, a disciplined lifecycle, progressive enhancement support, etc. come with the Widget class.

The YUI 3 Widget framework also provides a consistent MVC pattern which promotes every widget to adopt separation of state methods versus UI update methods. This makes the code very clean and maintainable. In fact this is one of the important factors why the YUI 3 Carousel is better than its earlier YUI 2-based cousin.

The [YUI 3 Plugin](http://developer.yahoo.com/yui/3/plugin/ "YUI 3: Plugin") model allows developers to add new functionality or modify existing behavior to objects. This allows adding additional functionality on top of Carousel to dynamically pull elements through Ajax, etc. So, the YUI 3 Carousel does not have animation code baked into it, but instead I have created a plugin which adds animation support for cases where it is needed. This helps to keep the component very lightweight.

### A Gallery Carousel for your own website

After reading about what a Carousel is and how it can help you to improve your website, you hopefully feel eager to get your hands dirty. Don't worry, with our YUI 3 Gallery Carousel extension, implementing a carousel on your website is as easy as providing a bulleted list in HTML. That's not just a sales pitch — that's how we recently integrated a Gallery Carousel into the Yahoo! Sports Search Results Page.

[![](/yuiblog/blog-archive/assets/carousel-sports.png)](http://sports.search.yahoo.com/search?p=usain+bolt&fr2=sb-top&fr=sports-us-ss "usain bolt - Yahoo! Sports Search Results")

### A simple example

Let's start with a simple example that will cover almost everything you need to know. The easiest way for you to use the new Gallery Carousel is to let YUI 3 automagically load it from Yahoo's content delivery network. Recalling what a Carousel is, a scrollable list of items, we create a list in HTML. We include the list in a div, which allows our JavaScript to easily find and work with it. If you already have some data that is represented in a list-like way in your markup, you might also just put the carousel div around it and test your luck! It is very important to say that, although we are using an image example here, you can use Gallery Carousel for anything you want!

```
<div class="carousel" id="container">
  <ol>
    <li><img src="img/c1.jpg"></li>
    <li><img src="img/c2.jpg"></li>
    <li><img src="img/c3.jpg"></li>
    <li><img src="img/c4.jpg"></li>
    <li><img src="img/c5.jpg"></li>
    </ol>
</div>
```

Now that we have our data to work with, we want to enhance the looks by showing all five items using the Carousel widget. Assuming that you are already using YUI 3 this is a straightforward task. The only thing that you might not have seen before, depending on how deep you have been digging into YUI 3 and the Gallery in the past, is that we are specifying a Gallery version explicitly. This is necessary because we are using a brand new widget, which is not including in the Gallery build that YUI's loader tries to load from by default. However, as YUI and YUI Gallery mature, this will not be necessary anymore in the future when the default build number is being increased.

```
YUI({gallery: 'gallery-2010.10.20-19-33'})
 .use("gallery-carousel", "gallery-carousel-anim", "substitute", function(Y) {
  var carousel = new Y.Carousel({ boundingBox: "#container",
   contentBox: "#container > ol" });
  carousel.plug(Y.CarouselAnimPlugin,{animation:{speed: 0.7}});
  carousel.render();
});
```

(By the way, if you are interested in getting brand new stuff you can visit the [YUI 3 Gallery repository](https://github.com/yui/yui3-gallery) on github or [Gopal's fork](https://github.com/g13n/yui3-gallery/tree/master/src/gallery-carousel), where he develops Carousel. If you find a bug, we are always happy to hear about it.)

Back to our example... YUI will take it from here. The loader automatically pulls Gallery Carousel and its dependencies from Yahoo's content delivery network. After that, the Carousel is being initialized and displayed. The user can then click the left or right arrow to scroll around. Please forgive me for bringing in one line of unnecessary complexity, but I couldn't resist. I used `Y.CarouselAnimPlugin` to let our carousel slide smoothly from one page to the other instead of just displaying the next page instantly. Feel free to play with the speed parameter if you wish.

![](/yuiblog/blog-archive/assets/carousel-1.png)

As you can see from the screenshot above, the Carousel is up and running. However, the CSS might not fit very well into the rest of your page. This leads us to our next section, where we'll discuss how to customize Gallery Carousel.

#### Customizing Gallery Carousel

Now that you have your Carousel up and running and identified a use case for your website, you hopefully want to integrate it seamlessly. As mentioned previously, we did so for our Sports Search Results Page. If you want to increase the number of visible items, for example from three to four, you can do so by modifying the line which instantiates Carousel.

```
var carousel = new Y.Carousel({ boundingBox: "#container",
 contentBox: "#container > ol", numVisible: 4 });
```

![](/yuiblog/blog-archive/assets/carousel-2.png)

Still not good enough? Yeah, right. Luckily CSS allows us to add our own style definitions and even overwrite the initial ones without touching any existing CSS. So your first step will probably be to remove the borders, because they are quite obtrusive. Just add the following CSS to your page header.

```
.YUI 3-carousel {
  border: none !important;
}
.YUI 3-carousel-nav {
  background: none !important;
}
.carousel ol li {
  border: none !important;
}
```

Now, that looks better. I've also used a negative margin to reduce the gap between my Carousel and the heading. However, we are still not completely there. I assume that you also want to use your own custom buttons, which integrate nicely into your page layout. For this example we will use the same buttons that are also used on Yahoo's search result pages. This requires a bit more, but still simple, CSS.

```
.YUI 3-carousel-button {
  background: url("sprite_button.png") no-repeat scroll 0 0 transparent !important;
  height: 20px !important; width: 28px !important;
}
.YUI 3-carousel-nav-item {
  background: url("sprite_button.png") no-repeat scroll 0 0 transparent !important;
  background-position: -133px 0 !important;
}
.YUI 3-carousel-first-button {
  background-position: -90px 0 !important;
  margin-right: 35px !important;
}
.YUI 3-carousel-first-button-disabled {
  background-position: -60px 0 !important;
  margin-right: 35px !important;
}
.YUI 3-carousel-next-button {
  background-position: -30px 0 !important;
}
.YUI 3-carousel-button-disabled {
  background-position: 0 0 !important;
}
.YUI 3-carousel-nav-item-selected {
  background-position: -121px 0 !important;
}
```

We will leave it to that for today and hope you feel ready to get started. At least that was all that we needed. However, depending on how big your site is and how interested you are in its performance, there are general thoughts about loading something from a third party content delivery network that also apply here. For example, Sidnei da Silva laid out some interesting thoughts in a blog post earlier this month. We would be happy to provide a How To that explains how a YUI widget and its dependencies can be moved to your own website, or even content delivery network, so you are able to keep the number of HTTP requests as low as possible. Let us know if you are interested, we are looking forward to your feedback!

### More to Explore in the Gallery

The [excellent team of Eduardo Lundgren and Nate Cavanaugh of Liferay](http://developer.yahoo.com/yui/theater/video.php?v=yuiconf2010-alloy "Video: Nate Cavanaugh and Eduardo Lundgren — A Whirlwind Tour of AlloyUI Components in the YUI 3 Gallery (YUI Theater)") have [a Carousel component in the Gallery as well](http://yuilibrary.com/gallery/show/aui-carousel "YUI Library :: Gallery :: AlloyUI Carousel") — certainly worth checking out if you're in the market for this kind of control.