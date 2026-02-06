---
layout: layouts/post.njk
title: "Implementation Focus: pulpTunes"
author: "Eric Miraglia"
date: 2008-12-17
slug: "pulptunes"
permalink: /2008/12/17/pulptunes/
categories:
  - "YUI Implementations"
---
What got you interested in building a web interface to iTunes? Or is that a dumb question?

(No, not a dumb question :)) I've got a sizable song collection in my iTunes. An app for providing myself with web access seemed like a nice thing to have, and it would give me the opportunity to play with web and desktop technologies in the same application.

You chose YUI for many of the UI elements in your app. What specific YUI components are you using, and for what purposes?

YUI's consistency and reusage of components accross the whole ecosystem lets you easily pick up on any new component you might need as the project advances. So I've been trying to stick with YUI-only, and I had to look elsewhere just for the flash song player, for obvious reasons.

![](/yuiblog/blog-archive/assets/pulptunes-20081203-175406.jpg)

pulpTunes produces a single web page, whose layout is declared through the [Grids CSS](http://developer.yahoo.com/yui/grids/) lib. No need of nasty CSS hacks, and you can guarantee your page will look the same in all major browsers. This is one of my favorite YUI libraries, because of the huge time savings and peace of mind it provides.

The songs list is a [DataTable](http://developer.yahoo.com/yui/datatable/) accompained by a [Paginator](http://developer.yahoo.com/yui/paginator/), fed through an XHR connection. Customizing the table and pagination looks was really easy by just overriding some CSS rules from the Sam skin, which is very well commented. The custom formatter for the Rating column is a 3-liner javascript code. The table (and the playlist section to the left) make use of the menu component to show a context menu to perform operations on a song or playlist.

I'm using a [Slider](http://developer.yahoo.com/yui/slider/) component to adjust the player's buffer. With it you point at which point in download progress you want the song to start playing.

There are few popup messages and dialogs in the app, that are rendered using the [Container](http://developer.yahoo.com/yui/container/) component.

Most of the YUI components I used (there are 12) are fetched from `yui.yahooapis.com` in a single request through the very convenient [YUI Loader](http://developer.yahoo.com/yui/yuiloader/). And of course, I'm using the YUI compressor to compress to 15k the one javascript file that holds all the app's logic.

You're using [Dav Glass's Effects Package](http://github.com/davglass/yui-effects/tree/master) in addition to YUI. What functionality are you drawing from Dav's collection specifically?

Coming from a Prototype+Scriptaculous world, I was very relieved to find that somebody had already ported to YUI all the great effects from Scriptaculous. And \[because Dav is a member of the\] YUI team, I could rest assured about its quality. I'm using the BlindDown and BlindUp effects to show and hide the songs cover art.

One of the main elements of your app is the DataTable that you use to display the songlists. What was your experience like building an XHR-fed DataTable with JSON data? What lessons did you learn that are worth sharing with other developers?

The XHR feeding part was pretty straightforward. Although I remembered trying to return some HTML in the JSON response which didn't work, but that looked like a browser bug.

Pagination and sorting was easy as well, but I had to provide a custom generateRequest function because, if I recall correctly, YUI assumes the records should be sorted since the first request to the server, and in my case I wanted to wait till the user actually clicked on a column header to start returning sorted records.

I also had some trouble at first when trying to retrieve specific records in the table, but then I realized the existance of a whole bunch of helper methods just for that, like `getTrEl()` and `getRecord()` that are not mentioned in the general docs. So my obvious advice is that your read the entire API for any component you'll be doing heavy work on.

[pulpTunes is a SourceForge project](https://sourceforge.net/projects/pulptunes/). Are you looking to build a community of developers to work on the project with you?

Yes, that's the idea. I'm also using SourceForge to track bugs and feature requests, so any kind of feedback from users is also welcomed. Graphical designers are invited as well, if they want to provide additional skins for the app.

What's next for pulpTunes?

It's been just a few days since the first stable release is out, and the response has been tremendous. I think I have already a pretty good idea of the major features for the next version: user authentication, search, shuffle and repeat buttons, and ability to rate songs.