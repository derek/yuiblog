---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: Peter Peterson's Ratings Widget"
author: "Unknown"
date: 2010-04-28
slug: "gallery-ratings"
permalink: /2010/04/28/gallery-ratings/
categories:
  - "Development"
---
_**About the author:** Peter Peterson is a lead front-end engineer for Yahoo!'s internal developer tools._

I wanted to get my feet wet with the finalized [widget infrastructure](http://developer.yahoo.com/yui/3/widget/) presented in YUI 3.1.0, and I've always felt the best way to do that is to write some code. I wanted something easy, and I found that in a CSS ratings implementation I found on [Komodo Media](http://www.komodomedia.com/blog/2007/01/css-star-rating-redux/). The resulting widget is the [YUI3 Ratings Widget](http://yuilibrary.com/gallery/show/ratings) ([demo](http://peterpeterson.net/gallery-ratings/)). The bulk of the work of the widget is handled by CSS and is described well in the Komodo Media article. The only trouble with that widget, was once a rating was chosen, nothing really happened unless the page was reloaded, and when the widget lost focus, it lost its rating. This is where the YUI 3 Gallery Ratings widget comes in.

[![](/yuiblog/blog-archive/assets/ratings/ratings1.png)](http://peterpeterson.net/gallery-ratings/ "Ratings Widget Tester")

My goals for the project were:

-   The code for the widget should be just enough to touch on the basics for how to create a YUI 3 widget
-   The widget would progressively enhance the page
-   The user's interaction with the widget is easily captured
-   Add a clear rating button which does not exist in the original design
-   The widget should be accessible for people using screen readers
-   Make the instantiation and interaction with the widget dead simple with as little code as possible.

It is easy to add the ratings widget to your page using the YUI loader:

```
YUI({
    gallery: 'gallery-2010.04.14-19-47'
}).use('gallery-ratings','event', function(Y) {
    // Program logic...
});

```

You'll also need the image assets and CSS file located located at [github](http://github.com/yui/yui3-gallery/tree/master/build/gallery-ratings/assets/) or from your own copy of the gallery.

Simply add a node in your source that contains the current rating (any number between 0 - 5) or is empty.

```
<span id="myWidget">2.5</span>

```

You can then instantiate the widget with the following code in your sandbox:

```
var myRating = new Y.Ratings({ srcNode: "#myWidget" });
myRating.render();

```

I felt that it was important to make this widget easy to customize and so I added some configuration to the constructor. `inline` when set to true will display the rating inline with text on the page (defaults to false). `skin` can be set to "small" to decrease the size of the widget ( Example: ![](/yuiblog/blog-archive/assets/ratings/ratings2.png) )

On its own, the ratings widget does little more that set up the rating interaction for the user. A little more work needs to be done to actually use the value. I'm leaving that up to the implementer to consider; whether to add a callback to the event fired when the rating changes, or to supply a plugin to the widget to handle it automatically. To get you started, whenever a rating is changed the `ratingChange` event fires. It is easy to set up an event listener to catch the `ratingChange` event for all the widgets on the page. In this example, I log the Rating Widget `srcNode`'s id, the previous rating, and the new rating for any rating widget on the page when the rating changes:

```
Y.on("ratings:ratingChange",function(e){
  var id = e.target.get("contentBox").get("id");
  Y.log(id+" New Value: "+e.newVal+" was: "+e.prevVal);
});  

```

### Future ideas for the project:

-   Progressively enhance form elements
-   Make the clear rating button optional
-   Make the rating range configurable
-   More skins, and combination of the CSS sprites
-   Internationalization