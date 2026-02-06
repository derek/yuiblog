---
layout: layouts/post.njk
title: "Image Optimization, Part 3: Four Steps to File Size Reduction"
author: "Stoyan Stefanov"
date: 2008-11-14
slug: "imageopt-3"
permalink: /2008/11/14/imageopt-3/
categories:
  - "Development"
---
_This is part 3 in an ongoing series. You can read the other parts here:_

-   [Image Optimization Part 1: The Importance of Images](/yuiblog/blog/2008/10/29/imageopt-1/)
-   [Image Optimization Part 2: Selecting the Right File Format](/yuiblog/blog/2008/11/04/imageopt-2/)
-   [Image Optimization Part 4: Progressive JPEG…Hot or Not?](/yuiblog/blog/2008/12/05/imageopt-4/)

This post is about some common tools you can use to reduce the file size of your images. The idea is to be able to just take the images your designer has created and instead of using them "as is", go ahead and tidy them up in short time and no effort, without even looking at them.

The good news is that this process is:

-   _lossless_ - you strip bytes, hence you lose some information, but not the pixel data and the resulting image looks exactly the same as the source with no quality loss
-   _uses free tools_ - all the tools we mention here are free and open-source, and work on both Windows and Unix
-   _automated_ - since these are command line tools, they are easy to script and automate; one example of such automation is the [smush.it](http://smush.it) tool

### Step 1: Crush PNG

PNGs store information in so-called "chunks" and not all of those chunks are required for the display of the image. In fact most of them are not. You can safely use a tool such as [pngcrush](http://pmt.sourceforge.net/pngcrush/) and strip all the unneeded chunks. For example:

```
> pngcrush -rem alla -brute -reduce src.png dest.png
```

Let's take a look at the options of this command:

-   `src.png` is the source image, `dest.png` is the destination (result) image
-   `-rem alla` means remove all chunks but keeps the one for transparency
-   `-reduce` tries to reduce the number of colors in the palette if this is possible
-   `-brute` tries over a hundred different methods for optimization in addition to the default 10. It's slower and most of the times doesn't improve much. But if you're doing this process "offline", one or two more seconds are not important since there's a chance if a filesize win. Remove this option in performance-sensitive scenarios.

Running this command on the PNGs found on Alexa's top 10 sites gives us an average file size reduction of **16.05%**. This means you can easily **strip weight off your PNG images**, save bandwidth and disk space and improve load times, without sacrificing quality and without even touching a single line of application code.

PNGcrush is only one of the available tools for this sort of optimizations. Other tools you can take a look at include:

-   [pngrewrite](http://www.pobox.com/~jason1/pngrewrite/)
-   [OptiPNG](http://www.cs.toronto.edu/~cosmin/pngtech/optipng/)
-   [PNGOut](http://advsys.net/ken/utils.htm)

Now that we've got a pretty good PNG solution, let's see if we can do the same for the other image types.

### Step 2: Strip JPG Metadata

JPEGs files contain meta data such as:

-   comments
-   application-specific (think Photoshop) meta data
-   EXIF information such as camera information, date the photo was taken and even thumbnails of the actual image or audio!

This meta data is not required for the display of the image and can safely be stripped with no pixel quality loss. As discussed previously, JPEG is a lossy format, which means you lose quality every time you save. But luckily there are some operations that are lossless. Such operations include cropping a part of the image, rotation and the personal favorite - copying metadata. One tool that allows you to do these is called [jpegtran](http://jpegclub.org/).

Here's a command to copy the source image, optimize it and don't carry over any metadata in the new copy:

```
> jpegtran -copy none -optimize src.jpg dest.jpg
```

Note that depending on the version you have, you might need to use the syntax ending with `src.jpg > dest.jpg`

The `-optimize` option will cause jpegtran to optimize the Huffman tables and improve compression.

Running this command on Alexa top 10 sites resulted in average savings of **11.85%**.

You may be able to further improve image size by using jpegtran's `-progressive` option. It produces JPEGs that load progressively in the browser, starting from a lower quality version of the image and improving as new image information arrives.

**Important note on stripping meta information: do it only for images that you own, because when jpegtan strips all the meta, it also strips any copyright information contained in the image file.**

### Step 3: GIF to PNG

What's the best way to improve a GIF? Convert it to a PNG. As funny as it may sound, it's true. Most of the time you get a smaller file size from a PNG and the same quality and browser support, [as we discussed in a previous article](/yuiblog/blog/2008/11/04/imageopt-2/). Note that PNG will not always be smaller, but most of the time it will be, so it's worth checking after the conversion and keeping the smaller of the two files.

In order to automatically change your GIFs, you can use ImageMagick's `convert`:

```
> convert image.gif image.png
```

If you want to force PNG8 format you can use:

```
> convert image.gif PNG8:image.png
```

This is probably not necessary, since GIFs will most likely be converted to a PNG8 anyway because ImageMagick picks the appropriate format based on the number of colors.

Once you've converted the GIF to a PNG, don't forget to still crush the PNG result (as shown in step 1).

If the top 10 sites switch all their GIFs for PNGs (except those that don't yield a smaller file size), on average, this will result in **20.42%** file size reduction. The only inconvenience here is that you also need to write a search/replace script to find all the references to the GIF files and change them to the new PNG versions.

### Step 4: Optimize GIF animations

Now that all GIFs are PNGs, PNGs are crushed and so are the JPEGs, what do we have left? GIF animations. One tool that can help you with those guys is called [GIFsicle](http://www.lcdf.org/gifsicle/). Since the animations consist of frames and some parts of the image don't change from one frame to another, GIFsicle doesn't carry over the duplicate pixel information. The way to run it is:

```
> gifsicle -O2 src.gif > dest.gif
```

### Smush.it

As we said at the beginning, the beauty of those four steps is that they don't cause quality loss, so you don't have to open and compare the results before and after. They are also all command-line tools that can be automated easily. So you have nothing to lose by running all your images through those tools before you FTP them to your web server, you can only win.

And you can always try the [smush.it](http://smush.it) tool, just to get an idea of how much you can potentially save.