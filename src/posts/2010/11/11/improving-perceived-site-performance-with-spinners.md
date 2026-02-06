---
layout: layouts/post.njk
title: "Improving perceived site performance with spinners"
author: "Matt Parker"
date: 2010-11-11
slug: "improving-perceived-site-performance-with-spinners"
permalink: /2010/11/11/improving-perceived-site-performance-with-spinners/
categories:
  - "Performance"
  - "Development"
---
At the [London Ajax meetup](http://www.meetup.com/londonajax/) this week, [Piotr](http://webdev.zalewa.info/) (one of the creators of the rather good [jsfiddle.net](http://www.jsfiddle.net) talked about spinners — the pretty common "I'm doing something" indicator — and how users perceive them. Apparently, people perceive Chrome to be faster in part because the little activity indicator keeps changing — it appears and disappears, and changes speed — while a page is loading. This sense of something happening persuades people that something is in fact happening, and faster, even if the actual speeds are identical. So Piotr set up a randomized survey, comparing perceptions of load speed after clicking two buttons — it's [here](http://survey.jsfiddle.net/) if you're interested. When you click the button there's a delay before the spinner is shown, and then a short (random) time later the results are shown. Then you click another button, and the same thing happens. And then you say which was faster. He also allowed for a "this thing seems broken option". (If you're going to do the survey, do it now and then come and read the conclusions — I don't want to spoil it for you!). The results are [here](http://survey.jsfiddle.net/spinner/results/). The conclusion is that by delaying the display of the spinner slightly, users perceive things to be happening quicker. But wait too long and they start to think something's broken — 0.4s seemed to be the optimal delay, from the survey results. And it may be worth thinking about other indicators if things take longer — add a "loading..." text overlay after 1 sec, perhaps.