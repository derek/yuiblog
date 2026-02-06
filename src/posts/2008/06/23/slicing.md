---
layout: layouts/post.njk
title: "Image Transformations in Canvas with Slicing"
author: "Ross Harmes and Ernest Delgado"
date: 2008-06-23
slug: "slicing"
permalink: /blog/2008/06/23/slicing/
categories:
  - "Development"
---
We've been obsessed with the `canvas` tag for a while now; we think it represents a huge opportunity for creative interfaces on the web, and current browser support for the tag is excellent (as long as you don't mind using excanvas.js for IE6/7). That being said, there are some limitations. The only available built-in transformations are [translation](http://developer.mozilla.org/en/docs/Canvas_tutorial:Transformations#Translating), [rotationg](http://developer.mozilla.org/en/docs/Canvas_tutorial:Transformations#Rotating) and [scale](http://developer.mozilla.org/en/docs/Canvas_tutorial:Transformations#Scaling). Performing a complex transformation, such as keystoning an image so that it can be used in a faux 3D environment, has been difficult. ![](/yuiblog/blog-archive/assets/slicing/slice-diagram.gif)

However, there is an easy way to _simulate_ arbitrary transformations on images in canvas. If you cut the image into slices, you can redraw each slice with different dimensions. The code is simple: using the [slicing variation of the `drawImage` method](http://developer.mozilla.org/en/docs/Canvas_tutorial:Using_images#Slicing), it's possible to take a slice of a source image and draw it to the canvas. This slice can be scaled horizontally and vertically according to a formula. As the number of slices increases, the edges of the image become smoother and less jagged. It's important to note that you only need one copy of the source image, and that drawing many slices doesn't mean there are many copies of the image in the page. You are able to use one source image to draw multiple images on a destination canvas.

Creating a keystone effect looks complex but is actually very straightforward:

```
function keystoneAndDisplayImage(ctx, img, x, y, pixelWidth, 
								 scalingFactor) {
	var h = img.height,
	     w = img.width,
        
	    // The number of slices to draw.
	    numSlices = Math.abs(pixelWidth),
        
	    // The width of each source slice.
	    sliceWidth = w / numSlices,
        
	    // Whether to draw the slices in reverse order or not.
	    polarity = (pixelWidth > 0) ? 1 : -1,

	    // How much should we scale the width of the slice 
	    // before drawing?
	    widthScale = Math.abs(pixelWidth) / w,
        
	    // How much should we scale the height of the slice 
	    // before drawing? 
	    heightScale = (1 - scalingFactor) / numSlices;

	    for(var n = 0; n < numSlices; n++) {

		// Source: where to take the slice from.
		var sx = sliceWidth * n,
		    sy = 0,
		    sWidth = sliceWidth,
		    sHeight = h;
		
		// Destination: where to draw the slice to 
		// (the transformation happens here).
		var dx = x + (sliceWidth * n * widthScale * polarity),
		    dy = y + ((h * heightScale * n) / 2),
		    dWidth = sliceWidth * widthScale,
		    dHeight = h * (1 - (heightScale * n));

		ctx.drawImage(img, sx, sy, sWidth, sHeight, 
        			  dx, dy, dWidth, dHeight);
	}
}

```

We take slices from the source image one at a time, apply a horizontal and vertical transformation, and then draw it in the correct order. This also allows us to do something interesting; if the slices are drawn in reverse order, we can reverse the image. The [keystone demo page](/yuiblog/blog-archive/assets/slicing/slicing_test.html) shows this code in action. The two sliders control the values entered into the function as `pixelWidth` and `scalingFactor`. Keystoning has a lot of potential applications. For instance, If you animate both width and scaling, you can create a page turning effect for any image. ![](/yuiblog/blog-archive/assets/slicing/vr.png)

You can apply any transformation to the slices. If you were to scale the height of the slices based on a parabolic curve, you could create a cylindrical distortion that mimics a panorama view. We set up a [Quicktime VR-style panorama](/yuiblog/blog-archive/assets/slicing/vr_test.html) using this technique. Be sure to view it with the rest of the canvas both shown and hidden to see how it works. It would also be possible to add an animating flag-ripple effect to any image, just by varying `dy`. We believe that image slicing transformations have a lot of applications in mimicing 3D environments and creating image effects. All you have to do is apply a formula to change the slice dimensions or position.