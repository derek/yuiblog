---
layout: layouts/post.njk
title: "Implementation Focus: Fun and Games with Kris Cieslak"
author: "YUI Team"
date: 2007-02-27
slug: "cieslak"
permalink: /blog/2007/02/27/cieslak/
categories:
  - "YUI Implementations"
---
What is your background in frontend engineering?

I started programming when I was 10, writing a few games in BASIC on my Commodore 64k. When I bought my first PC I started learning Pascal, C/C++ and assembly language. I was on the Polish demo scene, as a very newbie coder, and I learned a lot from the professional coders. In college I worked on Windows XP Registry and wrote an advanced Registry Manager in Delphi. Recently I started programming in JavaScript and started my blog.

When did you first learn about YUI? What was the first application you wrote with it?

About six months ago. I've really the Yahoo APIs; this is why I decided to spend more time working with them and with [YUI](http://developer.yahoo.com/yui/). My first application based on Yahoo services was [Image-Search!](http://www.digitalinsane.com/api/yahoo/image-search/) and the first project I created with YUI was [Yetris!](http://www.digitalinsane.com/api/yahoo/yetris/).

What games have you written using YUI?

[![Kris Cieslak's Yetris!](/yuiblog/blog-archive/assets/cieslak/tilegame.jpg)](http://www.digitalinsane.com/api/yahoo/yetris/)I've written four games based on YUI. The first was [Yetris!](http://www.digitalinsane.com/api/yahoo/yetris/) — a JavaScript version of the classic game which probably everyone knows. This was my first project based on YUI and I spent four days working on it. I spent most of that time reading the YUI's documentation and trying to adjust my ideas to the YUI environment. I started writing Yetris on 31 December 2006 about four hours before midnight; many people spend that time at New Year's parties but I was learning YUI.

[![Kris Cieslak's Puzzle](/yuiblog/blog-archive/assets/cieslak/flickrgame.jpg)](http://www.digitalinsane.com/api/yahoo/puzzle/)The second and my favorite game is [Puzzle](http://www.digitalinsane.com/api/yahoo/puzzle/). This application is based on YUI and [the Flickr API](http://developer.yahoo.com/flickr/). The hardest part was to figure out how to divide photos into small pieces using only JavaScript. If you have one or two images you can use graphics applications to do that, but what if you have to manipulate millions of photos? As you can see, I found a solution.

When I had finished the Puzzle, I remembered a version of [Space Invaders](http://www.digitalinsane.com/api/yahoo/space-invaders/) written in assembly language which I found on programmersheaven.com, and that inspired me to write a JavaScript clone of that classic game. I had a real problem with performance in Firefox and I had to spend lot of time optimizing the code especially for that browser.

[Solitaire](http://www.digitalinsane.com/api/yahoo/solitaire/) is my most recent project. I spent one week, six hours per day working on it. I hadn't used drag and drop techniques before, and there was a lot to learn. When you look  
at the code you will see that it is complex but it is also very compact. Without YUI the problem would be very hard to resolve. I wrote four different versions of that game using four different techniques. And the last technique proved the best and works very well on three popular browsers.

[![Kris Cieslak's Solitaire](/yuiblog/blog-archive/assets/cieslak/cardgame.gif)](http://www.digitalinsane.com/api/yahoo/solitaire/)

In using YUI for these projects, what aspects of the library have been particularly pleasing to work with and powerful in solving problems?

YUI does a great job keeping balance between functionality, the size of the library and performance of the functions. Generally I'm using YUI because it's solving the problems with cross-browser compatibility, because I can easy manipulate each element/layer, because I can get or change the position, color, transparency of each object, because I can use the [Drag and Drop Utility](http://developer.yahoo.com/yui/dragdrop/), and of course because of the [Animation Utility](http://developer.yahoo.com/yui/animation/) — very effective and simple in use.

For me, the most important parts of the YUI are [Dom](http://developer.yahoo.com/yui/dom/) and [Event](http://developer.yahoo.com/yui/event/). These libraries resolve most of my problems with browser compatibility.

What pain points have you noticed in using YUI? What would you like the YUI team to focus on next?

At the beginning, I had the problems with documentation. Each of the functions is clearly described. However, I didn't know how to use them. I would like to see more simple examples; these are more important than any description, especially for complex functions.

As for what to add to the library, maybe advanced mathematical libraries (numbers conversion, vectors, complex, angles, statistics, calculator widget etc...) would be nice to see in YUI.

What's next on your plate? Any exciting projects coming down the pike?

Doom3.js! I'm joking. However, creating 3d shooter in JavaScript is not impossible. I think it is possible to make a game similar to the early version of Wolfenstein 3d but without textures and animated sprites (enemies), with very, very simple levels.

_Do you have a YUI implementation that would be of interest to the YUI community? If so, please [share your link](http://groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/) and post a message to the community forum at [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/), or leave us a message in the comments section below._