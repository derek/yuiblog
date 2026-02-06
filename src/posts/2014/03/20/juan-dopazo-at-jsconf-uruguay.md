---
layout: layouts/post.njk
title: "Juan Dopazo at JSConf Uruguay"
author: "Juan Dopazo"
date: 2014-03-20
slug: "juan-dopazo-at-jsconf-uruguay"
permalink: /blog/2014/03/20/juan-dopazo-at-jsconf-uruguay/
categories:
  - "Development"
---
[![JSConfUY](http://farm3.staticflickr.com/2813/13289671583_e0606b08b4_b.jpg)](http://jsconf.uy)

Last Friday and Saturday [I crossed over the Rio de la Plata](http://maps.yahoo.com/directions/?lat=-34.76643521684169&lon=-57.273101806640625&bb=-33.957030069982295%2C-58.92791748046875%2C-35.576916524038616%2C-55.6182861328125&o=Buenos%20Aires%20City%2C%20Argentina&d=Montevideo%2C%20Uruguay&mode=6) to attend [JSConf Uruguay](http://jsconf.uy/) in Montevideo. The conference included talks from local and foreign speakers that covered JS libraries, best practices and emerging technologies. There were also workshops with hands-on experiences with [Node.js](http://nodejs.org/), [Nodebots](http://nodebots.io/) and [Firefox OS](http://www.mozilla.org/en-US/firefox/os/). It was a great event. It was very well organized and had fantastic speakers. Kudos to the organizers!

## Day one

The first day was opened by Guillermo Rauch ([@rauchg](https://twitter.com/rauchg)), creator of [Socket.io](http://socket.io/), who talked about new features coming to Socket.io like binary streams. He gave a great demo of a Gameboy emulator running in the server, with multiple web-based clients which all send commands at the same time. All rendering is done in the server and streamed using binary sockets to the client browser which then paints it to a canvas! It´s still online as an experiment to figure out how long it takes to collaboratively beat Pokemon Yellow. Check it out at [weplay.io](http://weplay.io/)!

Asynchronous APIs and functional programming were strong recurring themes in the conference. The first day we got an introduction to functional JavaScript, another introduction to promises, and Forbes Lindesay ([@ForbesLindesay](https://twitter.com/ForbesLindesay)) discussed [the intersection of promises and generators](http://slides.forbeslindesay.co.uk/promises-and-generators/#/).

![caption: Lenny Markus presenting Kraken.js - photo by @jsconfuy](http://farm4.staticflickr.com/3681/13293231065_1e0fa3e8de.jpg)  
Lenny Markus presenting Kraken.js - photo by [@jsconfuy](https://twitter.com/jsconfuy)

Day one also included a great recap by Lenny Markus ([@LennyMarkus](https://twitter.com/LennyMarkus)) about how they hacked their company's culture to switch from a heavily customized Java application to using Node.js in PayPal. They built a small team that managed to outpace the development of larger teams using their traditional stack. He then gave an introduction to [KrakenJS](http://krakenjs.com/), a small framework they developed to give some convention to Express applications. I particularly liked [Lusca](https://github.com/paypal/lusca) an Express middleware that implements several security measures to prevent clickjacking and cross-site request forgery.

Jeremy Ashkenas (@jashkenas), creator of Backbone and CoffeeScript, gave the closing presentation. He talked about good design practices in single-page apps and common patterns for Backbone apps. His slides were all beautiful photographs from his last trip across the world (you should check out [his blog](http://ashkenas.com/) for more!). Afterwards we got to hang out with Jeremy during the drink-up and he gave us some great travel tips. Also check out his [laptop sticker](https://twitter.com/dancalligaro/statuses/444616884076683264) (a pun about [@BrendanEich](https://twitter.com/BrendanEich)).

## Day two

James Halliday ([@substack](https://twitter.com/substack)) opened day two with an awesome live-coding presentation. He introduced his Node.js bundling tool for the client, Browserify. James presented different demos showcasing small modules that worked together to do impressive things such as replacing jQuery with minimal modules that do exactly what you want (making Ajax requests or using classlists). He also demoed using WebAudio to generate music using mathematical formulas, running the Fast Fourier Transform on the generated waves, and painting the result into a canvas based oscilloscope. His conclusion was to avoid big frameworks and instead write tiny modules that do one thing exceptionally well.

![caption: Zeno Rocha discussing Web Components - photo by @jsconfuy](http://farm8.staticflickr.com/7428/13293399993_ed6bd940e4.jpg)  
Zeno Rocha discussing Web Components - photo by [@jsconfuy](https://twitter.com/jsconfuy)

The rest of the day included talks about security best practices (see [Joe Petterson's slides](http://joe8bit.github.io/browser-security-talk/#/intro)), testing, and JSON Web Tokens. Zeno Rocha ([@zenorocha](https://twitter.com/zenorocha)), Liferay employee and YUI community member, gave a great presentation about the future of Web Components and the work he's been doing on polyfills and documentation in collaboration with Polymer and other Liferay developers.

During the afternoon I attended a [Nodebots](https://twitter.com/juanma_ari/statuses/445334721627553793) workshop which turned out to be a great introduction to Arduino and [Johnny-Five](https://github.com/rwaldron/johnny-five). I love the idea of communicating servers and hardware. I can't wait to get an Arduino kit!

The conference ended with [Douglas Crockford](https://twitter.com/matiascarranza/statuses/445213276134469632) and his talk _The Better Parts_. He enchanted everyone with his witty humor and discussed some of the new syntax coming in EcmaScript 6. His newly recognized good parts include the module system and the spread and [rest operators](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions_and_function_scope/rest_parameters). He also introduced [DEC64](http://dec64.org/), a potential standard for a new number type designed to be friendly to the web. He closed in typical Crockford style: "Don't make bugs".

Overall I got back home very impressed by the Uruguay JS community. Lots of smart people with great ideas. I'm looking forward to the next JSConfUY!