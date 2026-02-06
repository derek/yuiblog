---
layout: layouts/post.njk
title: "Implementation Focus: World of Solitaire by Robert Schultz"
author: "YUI Team"
date: 2007-08-20
slug: "schultz-solitaire"
permalink: /blog/2007/08/20/schultz-solitaire/
categories:
  - "YUI Implementations"
---
[![World of Solitaire by Robert Schultz](/yuiblog/blog-archive/assets/solitaire-gameplay.jpg)](http://worldofsolitaire.com)

**Tell us a little bit about your background in frontend engineering. When did you get started? What kinds of projects have you been involved with?**

My Dad brought home a Commodore 128D when I was about 9 years old. He showed me how to write BASIC programs for it and shortly thereafter I found myself writing text adventure games at 2 in the morning when I was supposed to be sleeping for school the next day. I knew then what I wanted to be when I grew up. In the early to mid 1990's I created my first web pages and coded some MacOS 8/9 applications using Pascal and C. Shortly after graduating high school, I got my first programming job in 1999 which lasted for 7 years. In that time my capabilities grew immensely and I learned a very wide variety of technologies and languages.

However, what truly stuck with me and matured was my love of coding for the web. This was especially true after experimenting with IE4 DHTML and JavaScript Remote Scripting, an early precursor to modern AJAX. I moved to Boston in early 2006 for my second job where creating a rich AJAX front end was my first task. I examined a large number of JavaScript toolkits and ended up choosing the newly released [YUI Library](http://developer.yahoo.com/yui/). I've been working with it ever since then.

**You've developed a slick Solitaire implementation using YUI. What got you started down that path — what made you want to build a great Solitaire experience for the browser?**

Well I had been trying to come up with a project I could work on in my spare time for several months. I was browsing the web one day and saw that someone had implemented a JavaScript version of Solitaire. I had not thought of the idea before then. I searched the web for more implementations of Solitaire with JavaScript and was fairly disappointed by all of them. They were all basically just unpolished prototypes with various bugs and glitches. I was fairly certain that I could produce a very nice looking version that was truly a game rather than just a proof of concept. After a few more weeks of tossing the idea around my head I finally decided to do it.

[![Choosing a deck style in World of Solitaire.](/yuiblog/blog-archive/assets/solitaire-cards.jpg)](http://worldofsolitaire.com)

**What was the hardest part about building the game?**

I had thought about the parts of the game I anticipated would be difficult long before I started writing any code. Things like card flipping, making a "solitaire engine" instead of a single type of solitaire, board layout and resizing of cards based on window size, etc. I felt pretty confident when coding started that I had "worked out" the tough parts in my head and on my 2-page design document.

For the most part that was true. However, one part of the game proved to be a constant thorn in my side throughout most of the development. This part was ensuring that cards were positioned above or below other cards correctly.

You wouldn't think it would be that difficult a task: set a CSS z-index and that's that. However with animation, card dragging, auto play, and the possibility to enable or disable these features there is a lot to keep track of. I ended up writing this part of the code at least four or five times. Each implementation either had hard-to-track-down bugs, used too much CPU or ran too often. When I finally nailed down this piece in a way that met the level of code elegance that I strive to maintain, I was quite relieved :)  

**What are your goals with the game and site? Do you plan to commercialize it or sell it to an online gaming site, or to build up traffic on your own site?**

Goals I set for the game when I started included creating a nice looking game, one with a lot of features and different game types, and one that works in the big 5 web browsers: IE, Firefox, Safari, Opera and Konqueror. I believe for the most part that I've accomplished those goals. My current goals include adding more game types, more features and to continue to keep things as clean and as bug-free as feasible. I've thought about maybe creating some forums or a blog or something to build a community around the game. However, I'm not so sure that's something I'm really interested in doing as that would require time to manage in order to do well and I'm not sure I want to devote my time to that.

I have no plans at all to commercialize it in any way. I do not wish to ever charge for it as that would reduce the number of people who might enjoy it. I also don't intend to add any advertisements as that I feel would pollute the game experience.

I've only been working on it for about 2 months so far, and my primary goal is that people enjoy playing. My motivation to create it was not financial, but rather social. To bring happiness to people who play and because I love receiving thank you e-mails from people who enjoy playing.  

**What role did YUI play in the building of your Solitaire game? Which YUI components are you employing, and how are you using them?**  

YUI played a very key role in creation of the game. It's at the heart of the game and would have taken a SIGNIFICANT amount of extra time had I chosen not to use it.

The YUI components that are used in the game include:

-   [Event Utility](http://developer.yahoo.com/yui/event/) — Handles clicks and mouse overs on the cards and menus
-   [Animation Utility](http://developer.yahoo.com/yui/animation/) — Animates all the flying, flipping and exploding cards
-   [Drag & Drop Utility](http://developer.yahoo.com/yui/dragdrop/) — Enables the cards to be dragged dragged around and dropped
-   [Container Family](http://developer.yahoo.com/yui/container/) — Powers the various dialogs in the game
-   [Dom Collection](http://developer.yahoo.com/yui/dom/) — Retrieves height, width and XY coordinates for various elements
-   [Connection Manager](http://developer.yahoo.com/yui/connection/) — Stores and retrieves game stats to and from the server
-   [Slider Control](http://developer.yahoo.com/yui/slider/) — Responsible for the 'Animation Speed' slider
-   [TreeView Control](http://developer.yahoo.com/yui/treeview/) — Used for the game selection
-   [TabView Control](http://developer.yahoo.com/yui/tabview/) — Different types of statistics are on different tabs
-   [Reset](http://developer.yahoo.com/yui/reset/) & [Fonts CSS](http://developer.yahoo.com/yui/fonts/) — I sure do like a clean, cross-browser CSS base
-   [YUI Compressor](http://www.julienlecomte.net/blog/2007/08/13/introducing-the-yui-compressor/) — Before a new version is put live on the server I run a bash script which parses the index page, concatenates all the JavaScript, runs the YUI Compressor and then updates a new index page with the concatenated compressed version. The difference in loading speed between 1 compressed JavaScript file and almost 60 uncompressed ones is quite substantial.

None of the components' core behavior needed to be modified in any significant way except for a slight change to the Drag & Drop code dealing with how it handles locked objects.  

**What led you to choose YUI as a foundation library for this project?**

I chose it for many reasons.

First, it has great browser support and that was a key goal of the game. Second, YUI has a very clean, stable and modular API. The API has stellar documentation [wonderful examples](http://developer.yahoo.com/yui/examples/) as well. Lastly I had been using YUI since it was first released as open source, and so I was very comfortable using it and was confident it could get the job done.  

**What projects are you taking on next?**

I'm not really sure. Perhaps another JavaScript game. Maybe something with multiple players or maybe one that is a bit more original than Solitaire. I have a big document full of ideas that I've had over the past few years. Maybe I'll take a peek through those. Maybe the release of this game will open up some new opportunities or spin up some new ideas. I haven't really thought too much about what might be next.

For the time being I plan on continuing to enhance and support Solitaire until such a point where I feel it is complete enough for me to start working on something new.