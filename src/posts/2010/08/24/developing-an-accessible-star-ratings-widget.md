---
layout: layouts/post.njk
title: "Developing an Accessible Star Ratings Widget"
author: "Thierry Koblentz"
date: 2010-08-24
slug: "developing-an-accessible-star-ratings-widget"
permalink: /2010/08/24/developing-an-accessible-star-ratings-widget/
categories:
  - "Development"
---
In a hurry? Skip to the [demo page](http://tjkdesign.com/lab/stars/demo.html).

Many ecommerce sites, social networking services, and online communities include rating or assessment features. Soliciting people's opinion has even become a business model; there are now sites dedicated to rating products, services, businesses, and more.

The most common interface used to display votes is the "star rating system," in which a particular number of points (often expressed as stars) is assigned to an item by each reviewer. We find this model on many sites, from Amazon to Yelp.

![Examples of star rating systems](/yuiblog/blog-archive/assets/star-examples-20100823-131202.jpg)

Figure A. Star rating examples from [Amazon](http://www.amazon.com) and [Yelp](http://www.yelp.com).

As [Figure A](#A) shows, both visual interfaces are similar, but what makes these two solutions _interesting_ is their markup base. One relies on `<map>`, the other on `<img>`.

You might think that most rating systems would be based on some markup proven to be semantic and "operational" across many User Agents — that is, that rating systems would be based on a specific set of HTML elements and attributes to which one applies behavior and style via JS and CSS. That would make sense, but it is far from the truth. When it comes to markup, authors try just about everything:

-   `<a>`,
-   `<img>`,
-   `<span>`,
-   `<li>`,
-   `<map>`,
-   `<div>`,
-   `<input>`,
-   and more...

### The case of Microformats

Before presenting a few image-based techniques to mark up ratings, I think it is worth mentioning a basic and straightforward approach (from [Microformats](http://microformats.org/wiki/hreview)) that uses _characters_:

```
<abbr class="rating" title="3 stars">***</abbr>
```

Pros

It is straightforward and semantic.

The markup is minimal.

The method is not reliant on CSS.

The method is not reliant on images.

There is no HTTP request.

Cons

It is impossible to represent half values (i.e. 3.5 stars)

It "works" only with asterisks ("star rating").

Screen-readers, by default, do not expand abbreviations (which may not be a big deal in this case).

_Note_: I use "\*" rather than ★ (★) because screen-readers (at least [JAWS](http://www.freedomscientific.com/products/fs/jaws-product-page.asp) and [NVDA](http://www.nvda-project.org/)) seem to ignore html entities.

### Markup to _display_ image-based ratings

When it comes to display images, authors have many options.

#### One image per rating

Using a single image:

```
<img src="4stars.png" alt="4 out of five">
```

One star

![1 out of five](/yuiblog/blog-archive/assets/starTutorial/1-star.png)

Two stars

![2 out of five](/yuiblog/blog-archive/assets/starTutorial/2-stars.png)

Three stars

![3 out of five](/yuiblog/blog-archive/assets/starTutorial/3-stars.png)

Four stars

![4 out of five](/yuiblog/blog-archive/assets/starTutorial/4-stars.png)

Five stars

![5 out of five](/yuiblog/blog-archive/assets/starTutorial/5-stars.png)

Pros

Using one image per rating is straightforward and semantic.

The method is not reliant on CSS.

Minimal markup.

Cons

It creates many HTTP requests as there are many different images.

On top of the performance issue, it can be a maintenance nightmare as authors have to deal with _more_ assets (images to create, to push to a CDN, to modify when site colors change, etc.).

Text selection _is not possible_ in Opera (at least in version 9.52) as the _alternate text_ is ignored

#### One image per unit

From the whatwg's [working draft](http://www.whatwg.org/specs/web-apps/current-work/multipage/embedded-content-0.html#a-group-of-images-that-form-a-single-larger-picture-with-no-links):

```
<img alt="4 out of 5" src="one-star.png">
<img alt="" src="one-star.png">
<img alt="" src="one-star.png">
<img alt="" src="one-star.png">
<img alt="" src="no-star.png">
```

One star

    ![1 out of five](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png)

Two stars

    ![2 out of five](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png)

Three stars

    ![3 out of five](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png)

Four stars

    ![4 out of five](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/no-star.png)

Five stars

    ![5 out of five](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png) ![](/yuiblog/blog-archive/assets/starTutorial/one-star.png)

Pros

Using two `img` elements per rating diminishes the number of HTTP requests.

The method is not reliant on CSS.

Cons

In Opera, when images are disabled, _alternate text_ is not selectable, and (in small-screen view) that text is rendered with a border which makes it less legible.

Note that this is taken from a _controversial working draft_. In my opinion, this method is not acceptable because the alternate text does not describe the image _accurately_ and succinctly. Besides, if the basis of this approach is that these images represent content, then why leave some of them with _no_ `alt` text?

On [Ajaxian](http://ajaxian.com/), for example, the author is using alternate text with _every single image_, which makes a lot of sense if he considers that _each one is content_:

```
<img [snip] alt="+" src="star1.png"/>
<img [snip] alt="+" src="star1.png"/>
<img [snip] alt="+" src="star1.png"/>
<img [snip] alt="-" src="star0.png"/>
<img [snip] alt="-" src="star0.png"/>
```

In any case, using as many images as there are stars versus using a single element (an `img` or something else) has the main advantage of facilitating voting mechanisms - where a user selects one of the stars to cast his vote. So we should keep this in mind...

#### A sprite for background images

The following technique is a adaptation of a strategy originally implemented by developers at [Yahoo! Music](http://new.music.yahoo.com/):

##### Markup

```
<span class="rating r1 stars">1 of 5</span>
<span class="rating r2 stars">2 of 5</span>
<span class="rating r3 stars">3 of 5</span>
<span class="rating r4 stars">4 of 5</span>
<span class="rating r5 stars">5 of 5</span>

```

##### CSS

```
.stars {
  background: transparent url(img/sprite.png) no-repeat; 
}
.rating {
  font-size: 0;
  height: 19px;
  overflow: hidden;
  vertical-align: middle;
  width: 96px; 
  display: block;
}
.r1 { background-position: -385px 0; }
.r2 { background-position: -288px 0; }
.r3 { background-position: -192px 0; }
.r4 { background-position: -96px 0; }
```

One star

_1 of 5_

Two stars

_2 of 5_

Three stars

_3 of 5_

Four stars

_4 of 5_

Five stars

_5 of 5_

Pros

This method requires a single HTTP request as it relies on a single sprite image.

Minimal "foot print".

Cons

Content is not revealed with images off.

Nothing shows when the page is printed (a print stylesheet could take care of this issue).

In Opera, the high contrast stylesheet makes all the stars disappear; the same is true in [High Contrast Mode Optimization](http://www.artzstudio.com/2010/04/img-sprites-high-contrast/).

Text selection is possible, but it's not obvious (via highlighting).

#### A sprite in the markup

This approach is based on the [TIP method](http://tjkdesign.com/articles/how-to_use_sprites_with_my_Image_Replacement_technique.asp), which uses a [sprite image](http://tjkdesign.com/lab/stars/img/sprite.gif) as an `<img>` element rather than a background image:

##### Markup

```
<span title="1 of 5" class="rating r1"><img width="0" height="1" src="sprite.gif" alt=""/>1 out of 5</span>
<span title="2 of 5" class="rating r2"><img width="0" height="1" src="sprite.gif" alt=""/>2 out of 5</span>
<span title="3 of 5" class="rating r3"><img width="0" height="1" src="sprite.gif" alt=""/>3 out of 5</span>
<span title="4 of 5" class="rating r4"><img width="0" height="1" src="sprite.gif" alt=""/>4 out of 5</span>
<span title="5 of 5" class="rating r5"><img width="0" height="1" src="sprite.gif" alt=""/>5 out of 5</span>

```

##### CSS

```
.rating {
  position: relative;
  height: 1.6em;
  width: 8.1em;
  overflow: hidden;
  vertical-align: middle;
  display: block;
}
.rating img {
  position: absolute;
  width: 40.5em;
  height: 1.55em;
  top: 0;
  border: 1px solid #fff;
}
.r1 img { right: 0; }
.r2 img { left: -24.4em; }
.r3 img { left: -16.2em; }
.r4 img { left: -8.1em; }

```

One star

![](/yuiblog/blog-archive/assets/starTutorial/sprite.gif)1 out of 5

Two stars

![](/yuiblog/blog-archive/assets/starTutorial/sprite.gif)2 out of 5

Three stars

![](/yuiblog/blog-archive/assets/starTutorial/sprite.gif)3 out of 5

Four stars

![](/yuiblog/blog-archive/assets/starTutorial/sprite.gif)4 out of 5

Five stars

![](/yuiblog/blog-archive/assets/starTutorial/sprite.gif)5 out of 5

Pros

This method requires a single HTTP request.

This technique is the only one of the four methods above that _reveals_ content when Firefox users select "hide images" or "make images invisible" (from the developer's toolbar).

When images are unavailable a red "x" appears only in the highest rating (i.e. 5 out of 5) instead of in each one as it is the case with other solutions that rely on `img` elements.

Cons

The display of images is reliant on CSS.

It is worth noting that unlike other Image Replacement techniques, this method allows:

-   images to _scale_ depending on text-size settings.
-   images to be _printed_.
-   alternate text to be easily _selected_ as the whole image appears highlighted (Firefox).
-   the image to not disappear in a high-contrast setting/stylesheet.
-   alternate text selection in Opera (when images are disabled).
-   borderless alternate text in Opera's small screen view.

### Markup to _cast_ votes

#### Starting with a native mechanism

To _cast votes_, we need a low-level voting mechanism that allows simple user selection and submission. For this, we can rely on using a form with labels and controls:

##### Markup

```
<fieldset>
  <legend>Rating</legend>
  <label><input type="radio" name="movie" value="1_5">1/5</label>
  <label><input type="radio" name="movie" value="2_5">2/5</label>
  <label><input type="radio" name="movie" value="3_5">3/5</label>
  <label><input type="radio" name="movie" value="4_5">4/5</label>
  <label><input type="radio" name="movie" value="5_5">5/5</label>
</fieldset>
```

##### Result

Rating 1/5 2/5 3/5 4/5 5/5

#### Adding breaks and whitespace

For better legibility, we add `<br>` and whitespace.

##### Markup

```
<fieldset>  <legend>Rating</legend>
  <label><input type="radio" name="movie" value="1_5"> 1/5</label><br>
  <label><input type="radio" name="movie" value="2_5"> 2/5</label><br>
  <label><input type="radio" name="movie" value="3_5"> 3/5</label><br>
  <label><input type="radio" name="movie" value="4_5"> 4/5</label><br>
  <label><input type="radio" name="movie" value="5_5"> 5/5</label>
</fieldset>
```

##### Result

Rating  1/5  
 2/5  
 3/5  
 4/5  
 5/5

#### Introducing the sprite image in the markup

For this solution, we are using a smaller sprite than the one in the example above. It is now composed of [two single stars](http://tjkdesign.com/lab/stars/img/small-sprite.gif) ("on" and "off").

We place `img` elements inside the labels. We assume they will have no value without CSS support, thus we "hide" them by setting specific dimensions via their `width` and `height` attributes. Note that using `0` with both attributes would show a broken image in some UAs.

```

<form ...>
  <fieldset>
    <legend>Rating</legend>
    <label class="one" title="1 out of 5"><input name="LandOf" value="1" checked="checked" type="radio"> 1/5<img src="star-sprite.gif" alt="" height="0" width="0"></label>
    <label class="two" title="2 out of 5"><input name="LandOf" value="2" type="radio"> 2/5<img src="star-sprite.gif" alt="" height="0" width="0"></label>
    <label class="three" title="3 out of 5"><input name="LandOf" value="3" type="radio"> 3/5<img src="star-sprite.gif" alt="" height="0" width="0"></label>
    <label class="four" title="4 out of 5"><input name="LandOf" value="4" type="radio"> 4/5<img src="star-sprite.gif" alt="" height="0" width="0"></label>
    <label class="five" title="5 out of 5"><input name="LandOf" value="5" type="radio"> 5/5<img src="star-sprite.gif" alt="" height="0" width="0"></label>
  </fieldset>
</form>
```

Note that with the above markup, we can expect (in most browsers) field selection via label selection.

##### Considering Accessibility

Unfortunately, _as is_, this markup creates issues in at least two screen-readers: [JAWS](http://www.freedomscientific.com/products/fs/jaws-product-page.asp) and [NVDA](http://www.nvda-project.org/) (see [test case](http://public.yahoo.com/~thierryk/test-case/implicit-labeling-and-attributes.html) for these bugs). The problem is related to the use of a `title` attribute and an empty string for alternate text.

The workaround to not confuse screen-reader users is to use "stars" as alternate text (`alt`) and use JavaScript to insert `title` on _mouseover_.

##### Better Markup

```
<fieldset>  <legend>Rating</legend>
  <label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="1_5"> 1/5</label><br>
  <label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="2_5"> 2/5</label><br>
  <label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="3_5"> 3/5</label><br>
  <label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="4_5"> 4/5</label><br>
  <label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="5_5"> 5/5</label>
</fieldset> 
```

##### Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

### Styling

#### Giving dimensions to the image via CSS

We use `em` to allow the image to grow or shrink depending on font-size.

##### Markup

Unchanged

##### CSS

```
img {
  width:2.8em;
  height:1.4em;
}
```

##### Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

As you can see already, clicking on an image selects the corresponding radio button. There is no need for scripting as implicit labeling produces this behavior (except in IE).

#### Removing the image from the flow

Styling the `label` with `position:relative` and the image with `position:absolute` with `top`/`left` values is enough to hide `input` and text inside the labels.

##### Markup

Unchanged

##### CSS

```
label {
  position:relative;
}
img {
  width:2.8em;
  height:1.4em;
  position:absolute;
  top:0;
  left:0;
}
```

##### Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

#### Displaying one star per label

We style the label so its dimensions match the height and width of a single star.

##### Markup

Unchanged

##### CSS

```
label {
  position:relative;
  height:1.4em;
  width:1.4em;
  overflow:hidden;
  display:block;
}
img {
  width:2.8em;
  height:1.4em;
  position:absolute;
  top:0;
  left:0;
}
```

##### Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

#### Displaying the stars horizontally

We remove the `br`s and we float the labels.

##### Markup

Unchanged

##### CSS

```
br {
  display:none;
}
label {
  position:relative;
  height:1.4em;
  width:1.4em;
  overflow:hidden;
  display:block;
  float:left;
}
img {
  width:2.8em;
  height:1.4em;
  position:absolute;
  top:0;
  left:0;
}
```

##### Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

#### Displaying the sprite image depending on rating

To set a "3 out of 5" rating, we apply the same class to the last two labels. This class will shift the position of the image inside the label.

##### Markup

```
<fieldset>
<legend>Rating</legend>
<label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="1_5"> 1/5</label><br>
<label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="2_5"> 2/5</label><br>
<label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="3_5"> 3/5</label><br>
<label class="no_star"><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="4_5"> 4/5</label><br>
<label class="no_star"><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="5_5"> 5/5</label>
</fieldset>
```

##### CSS

```
br {
  display:none;
}
label {
  position:relative;
  height:1.4em;
  width:1.4em;
  overflow:hidden;
  float:left;
}
img {
  width:2.8em;
  height:1.4em;
  position:absolute;
  top:0;
  left:0;
}
.no_star img {
  left:-1.4em;
}
```

##### Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

#### Not relying on image alone to display information

It's important to offer an alternative to the display of stars in case images are not available. This is because labels and radio buttons are styled to be on top of each other. A simple solution is to move `input` and text off-screen (i.e. using `text-indent:-999em`) and apply a background color to the labels.

##### Markup

No change

##### CSS

```
br {
  display:none;
}
label {
  position:relative;
  height:1.4em;
  width:1.4em;
  overflow:hidden;
  float:left;
  background:teal;
  margin-right:1px;
  text-indent:-999em;
}
img {
  width:2.8em;
  height:1.4em;
  position:absolute;
  top:0;
  left:0;
}
.no_star {
  background:#ccc;
}
.no_star img {
  left:-1.4em;
}
```

_Note_:

-   `text-indent` also fixes a upwards jump of the image each time the controls get focus.
-   the right margin is to make sure background colors create squares and not rectangles (which would happen with adjacent labels sharing the same background color).

##### Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

#### Finishing touch

-   We use the pseudo-class `:hover` to create some rollover effect,
-   We hide the fieldset border,
-   We hide the legend,
-   We style the cursor.

##### Markup

Unchanged

##### CSS

```
br {
  display:none;
}
label {
  position:relative;
  height:1.4em;
  width:1.4em;
  overflow:hidden;
  float:left;
  background:teal;
  margin-right:1px;
  text-indent:-999em;
}
input {
  position:absolute;
  left:-999em;
  top:.5em;
}
img {
  width:2.8em;
  height:1.4em;
  position:absolute;
  top:0;
  left:0;
  cursor: pointer;
}
.no_star {
  background:#ccc;
}
.no_star img {
  left:-1.4em;
}
label:hover {
  opacity:.5;
  filter:alpha(opacity=50);
}
fieldset {
  border:0;
}
legend {
  text-indent:-999em;
}
```

_Note_: `label:hover` is ignored by IE6 and in Opera the background color bleeds through the images. In the [demo page](http://tjkdesign.com/lab/stars/demo.html), instead of using `opacity`, I am using a [different sprite](/yuiblog/blog-archive/assets/starTutorial/star-sprite.gif) that shows four states.

#### Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

### Displaying the ratings without allowing user interaction

We can make the ratings "read-only" by adding `disabled` and `checked` attributes in the appropriate `input` fields.

#### Markup

```
<fieldset>
  <legend>Rating</legend>
  <label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="1_5" disabled> 1/5</label><br>
  <label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="2_5" disabled> 2/5</label><br>
  <label><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="3_5" checked="checked"> 3/5</label><br>
  <label class="no_star"><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="4_5" disabled> 4/5</label><br>
  <label class="no_star"><img src="img/small-sprite.gif"  width="0" height="1" alt="stars"><input type="radio" name="movie" value="5_5" disabled> 5/5</label>
</fieldset> 
```

#### CSS

The rule using `:hover` has been removed h4>Result

Rating ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 1/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 2/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 3/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 4/5  
 ![stars](/yuiblog/blog-archive/assets/starTutorial/small-sprite.gif) 5/5

### Giving more thought to the process

At this point, it is possible to cast votes without script support, but sighted users have no clue about their selection. So we use JavaScript to:

-   give feedback to the user regarding his selection,
-   give keyboard users a visual clue while they navigate through the radio buttons.

At the same time, we take advantage of using a script to insert `title` attributes that will create "tooltips" when users hover over the labels/stars.

Because of the lack of feedback regarding selection without JavaScript, we style labels and form controls _only_ if there is script support. To do so we use JavaScript to set a flag on the `html` element and then we create a rule based on descendant selectors containing that hook. If the flag is missing, that rule does not apply and elements are **not** styled.

This is the [demo page](http://tjkdesign.com/lab/stars/demo.html), the final product. To see how this solution behaves according to various settings, you may want to use your favorite developer tools to increase text-size, break image paths, disable JavaScript, turn CSS off, and more...

### Wrap up

Coming up with a "acceptable" solution requires to identify users' needs, User Agents' peculiarities, User Agents' settings and more - which means extensive testing.

In this process, users' feedback is essential because following best practices is not always a sure thing. For example, as mentioned earlier, setting no value for the `alt` attribute of the images within the labels seem to be the safe thing to do, but it turns out that it creates issues with at least two screenreaders (see [test case](http://public.yahoo.com/~thierryk/test-case/implicit-labeling-and-attributes.html "TITLE and ALT create issues in JAWS and NVDA")).

Also, feedback from assistive devices' users allows to ignore some validation error messages - as the one that the Firefox Accessibility Toolbar reports (according to [http://bestpractices.cita.uiuc.edu/html/nav/form/](http://bestpractices.cita.uiuc.edu/html/nav/form/)).

The goal here was not to fix everything, though. Being able to cast votes without a pointing device was one of my priorities, but improving the look and feel of the solution in Opera when images are disabled is not something I consider essential.

The most interesting part of this "journey" was to make the solution accessible to many users under various conditions, addressing issues such as:

-   images off,
-   javascript off,
-   CSS off,
-   a combination of the above.

It is also nice to know that this technique relies on `img` elements rather than background images, which allows the stars to:

-   resize themselves according to the user's settings,
-   show in high contrast mode,
-   be printed by default (unlike background images).

All of this comes without sacrificing performance, as this solution relies on this single sprite: ![stars](/yuiblog/blog-archive/assets/starTutorial/star-sprite.gif)

### Late finding

I recently discovered the system Amazon has built for its voting page. It is quite interesting as they serve a _different_ solution depending on script support. If there is script support, they use an image `<map>` (interesting approach), if there is no script support they use **radio buttons**. In both cases, the solution is _accessible_ to keyboard users, and this helps to maximize access to a feature that is a core differentiator for the Amazon platform.

Note that they do not use JavaScript to _replace_ the radio buttons with a image `<map>`; instead, they use `noscript` elements in which table markup contains radio buttons.

### "Out of the box" solutions

Dreamweaver®

[Spry Rating Widget](http://labs.adobe.com/technologies/spry/samples/rating/RatingSample.html)

YUI

[Star Rating Script for YUI](http://www.unessa.net/en/hoyci/projects/yui-star-rating/)

[Star Rating script with YUI](http://www.devseo.co.uk/blog/view/star-rating-script-with-yui)

JQuery

[Half-Star Rating Plugin](http://www.javascriptplugins.com/framework/jquery/half-star-rating-plugin/)

[jQuery Ajax Rater](http://www.javascriptplugins.com/framework/jquery/jquery-ajax-rater/)

[Simple Star Rating System](http://www.javascriptplugins.com/framework/jquery/simple-star-rating-system/)

[5 star rating system in PHP, MySQL and jQuery](http://webtint.net/tutorials/5-star-rating-system-in-php-mysql-and-jquery/)

Wordpress

[GD Star Rating System for WordPress](http://www.blogperfume.com/plugin-gd-star-rating-system-for-wordpress/)

[GD Star Rating](http://wordpress.org/extend/plugins/gd-star-rating/)

[Star Rating for Reviews](http://www.channel-ai.com/blog/plugins/star-rating/)

Flash

[5 Star rating system component](http://www.adriantnt.com/products/rating_system/?gclid=CL3Vm--7oKECFSCjiQodwxTvyA)

Misc.

[How a star rating should be](http://nofunc.org/AJAX_Star_Rating/)

[Starry widget 2](http://www.duarte.com/starry/)

### Special thanks

Special thanks to Victor Tsaran and Todd Kloots for their valuable feedback.