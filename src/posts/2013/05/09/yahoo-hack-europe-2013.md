---
layout: layouts/post.njk
title: "Yahoo Hack Europe 2013"
author: "Matt Parker"
date: 2013-05-09
slug: "yahoo-hack-europe-2013"
permalink: /2013/05/09/yahoo-hack-europe-2013/
categories:
  - "Development"
---
[![IMG_1388](http://farm9.staticflickr.com/8544/8685680245_0dcbbd6e67.jpg)](http://www.flickr.com/photos/ydn/8685680245/ "IMG_1388 by Yahoo! Developer Network, on Flickr")I went down to [Yahoo! Hack Europe 2013](http://developer.yahoo.com/blogs/ydn/hack-europe-london-sneak-peek-fun-come-102919199.html) in London this weekend. I've got to say, Yahoo! can put on a good show. The venue and creature comforts were all very impressive. Saturday morning was filled with tech talks from a bunch of Yahoo! and other speakers (like [Twilio](https://www.twilio.com/) and [Firefox OS](https://twitter.com/torgo)) about their technologies and APIs we might want to use. It was nice to see Satyen bigging up [YUI](http://yuilibrary.com/) (and at the end to see some hacks that used it a bit).

The event itself was a solid 24 hours (although I went home to bed, I'm too old to pull all-nighters) and produced some nice hacks using a range of APIs. I enjoy these hack weekends for the chance to play with APIs that I would not normally have much reason to use, to work with new people, and to learn about new stuff I don't otherwise come across.

[![Contextificator3](http://farm9.staticflickr.com/8400/8692235560_e26611f524.jpg)](http://www.flickr.com/photos/79776482@N05/8692235560/ "Contextificator3 by mattyparker, on Flickr") My own effort was the '[Contextificator](https://github.com/mattparker/contextificator)' - a bookmarklet that tries to make the 'I wonder what/who/where that is -> select text -> new tab -> search -> read -> return to first page' pattern I frequently find myself doing. It uses the Yahoo [Content Analysis API](http://developer.yahoo.com/contentanalysis/) to look at the page (or text selection), and then pulls out search results, images, wikipedia text, or a map from [Yahoo! BOSS](http://developer.yahoo.com/boss/) and other APIs, and puts it all in a sidebar on the page you're reading.

I had resolved to try to do things reasonably properly, even though it was a hack. I didn't want to end up with 24 hours worth of spaghetti code, which is usually what happens. So I did try to structure things properly, extending `View` and `Model` and `Base` where that seemed right, writing and loading them all as separate modules, and so on.

So after about 10 hours I'd done quite a lot of that set up, trying to get a reasonable structure for the code... and all I had to show for it was an empty iframe. At that point I was beginning to feel slightly dispirited. However, the next morning it paid off. It all came together very quickly, which left me enough time to tussle with CSS so that it looked vaguely presentable.

Now on reflection I'm sure that at least some of the overall code design decisions I made were wrong. That's no surprise. But by the end I was struck again by the strength of YUI and that even in a 24 hour hack I reckon the investment in trying to structure your code properly (instead of a mess of callbacks and dubious hacks) was well worth it. That's largely because YUI gives you such a strong base to build from and establishes good practices to follow.

So yay to hack weekends. Yay to YUI. And happily the Contextificator won second prize overall, and I got my giant cheque presented by Nick d'Alosio (of Summly fortune - though of course the cheque he got from Yahoo! is several orders of magnitude larger, _\[and I'm old enough to be your father, dammit\]_)!

(If you're wondering, it's called 'Contextificator' mainly because my daughter uses a 'stapleriser' to make holes in paper.)

![mattparker](/yuiblog/blog/wp-content/uploads/2013/04/mattparker.jpg) _**About the author:** Matt Parker (@Lamplightdb)_ Matt is creator of [Lamplight Database Systems](http://www.lamplightdb.co.uk/), a powerful and affordable management system for charities. He is also a father of three, trombone and bazouki-ist in [Albino](http://www.albinomusic.com/), and a lapsed climber. Matt does not get to spend as much time as he would like writing JavaScript.