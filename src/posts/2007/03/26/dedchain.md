---
layout: layouts/post.njk
title: "YUI Implementation Focus: Dustin Diaz's DED|Chain"
author: "John Resig"
date: 2007-03-26
slug: "dedchain"
permalink: /blog/2007/03/26/dedchain/
categories:
  - "Development"
---
pre {font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#6633CC; padding:7px; border-left:3px solid #EBEBEB; background:#F5EDFF;} /\* Site Header \*/ #hd { padding: 25px 20px 20px; } #hd .site-header { display: flex; align-items: center; } #hd .site-brand { display: flex; align-items: center; gap: 20px; } #hd .site-logo img { height: 52px; width: auto; } #hd .site-title { margin: 0; font-size: 32px; color: #30418C; line-height: 1.2; letter-spacing: normal; } #hd .site-title a { color: inherit; text-decoration: none; } #hd .site-tagline { margin: 5px 0 0; font-size: 15px; color: #666; letter-spacing: normal; }

Many people are acquainted with your blog, [/with Imagination](http://www.dustindiaz.com/); for those who may not read it as assiduously as we do at the YUI team, tell us a little bit about your background. When did you get started in programming? What drew you to frontend engineering, specifically?

(As I pour myself a nice tall glass of Widmer Hefeweizen Beer...) At CSU Sacramento, I was on track to receiving my Bachelor of Arts in Spanish, and a minor in Cultural Anthropology. I even wrote for the school newspaper ([www.statehornet.com](http://www.statehornet.com/)) as the assistant opinion editor. However during that journey I took Computer Science 01 (1999). That class taught me Q Basic and the power of `goto`. Aside from that, there was a two week portion of the class where the instructor taught us basic HTML. I was simply fascinated by the idea of having a webpage... so much that I spent the next six weeks working on making my webpage even cooler.

All that being said, that's the only formal education I have in computer science. However, I do have a degree in a foreign "language." Which perhaps made me more adept at writing in other languages.

The draw to frontend user interfaces is that frontend engineering just logically seems like the funnest place to be. But beyond that, it's "web interfaces" that makes it most exciting. I don't think I would have as much fun developing desktop applications simply because there is a removed layer that connects people. It is, in fact, building websites and web applications that hits the spot.

You've been writing JavaScript and writing about JavaScript for a long time now, but DED|Chain is your first foray into the world of JavaScript libraries. What motivated you to work on this project?

D|C started off as a plane ride sandbox experiment (I literally began the project on my laptop flying on an air plane). The motivation wasn't exactly clear; I just felt like prototyping to get my mind off of things. One thing that did come to mind, however, was that when visiting new people at SxSW, many designers preferred jQuery over any other library hand over fist. It wasn't because they thought it was sexy, or lightweight, or even cared that it had a stable development community around it. It was just easy to use with a very low learning curve.

[![](/yuiblog/blog-archive/assets/diaz-dedchain.gif)](http://dedchain.dustindiaz.com/)

JQuery engenders a lot of love among its users. As someone who has studied JQuery in some depth, what (beyond John Resig's genius) do you think makes JQuery so special and unique? What is it about the JQuery syntax that is so attractive to those of us who do web development?

jQuery entails many sexy attributes that attracts several kinds of developers. It truly is the library for everyone. It's object-oriented at heart, but has a procedural "get things done" interface. One of the biggest complaints I hear about YUI is the large namespaces. Comparatively speaking, YUI does it right, whereas jQuery gets it done. In today's real-world development practices, web developers just want to get it done. People don't want to think about OO structures, namespaces, closures, extending classes, and clever abstractions. The goals of both libraries are obviously vastly different. The core bread and butter of YUI is the utilities (not to say the widgets aren't great), and it felt like YUI is the kind of library you can use to build something like jQuery, but not vice versa. The two have polar opposite design styles.

With D|C, I wanted to take the jQuery style and philosophy a step further, but build on top of Yahoo! UI. There are of subtle differences in some syntax choices; for instance, every callback in D|C is executed in the scope of the DED bolt (yes, I'm calling them DED bolts). A DED bolt is the outer-most selector from which each chain is derived. For instance in jQuery, you could have something like this:

```
$('#content a').click(function(){
  $.post(this.href, function(resp) {
  $('#result').append(resp);
});
  return false;
});
```

In DED|Chain, it would look like this:

```
_$('#content a').on('click', function(el) {
  _$('#result').populate(el.href);
}, true);
```

You could even take this a step further and make it a better user experience:

```
_$('#content a').on('click', function(el) {
  this.fetch(el.href, {
    before: function() {
      _$('#spinner').show();
    },
    after: function(resp) {
      _$('#spinner').hide();
      _$('#results').setContent(resp);
    }
  });
}, true);
```

If the `_$` creeps you out, you can easily change the default namespace (just as you can with all methods in D|C).

```
DED.register({
  namespace: 'IAMSAM'
});
```

Now all chains begin with 'IAMSAM' instead of the default '\_$'.

DED|Chain joined the ever-expanding JavaScript library world in the same week as the library from another well-known name in the JavaScript community, [Dean Edwards](http://dean.edwards.name/weblog/) and his Base2. In the YUI-related space, we've seen [Jack Slocum's YUI-EXT](http://jackslocum.com) (now just EXT, and supporting not just YUI but JQuery, Prototype, and perhaps more in the future), [Peter Michaux](http://peter.michaux.ca/)'s [Fork](http://peter.michaux.ca/article/340), and now DED|Chain. Have you given any thought to where you see DED|Chain evolving in the future?

I see DED|Chain becoming the library of choice for people who just want to get things done. By the same token, I've built in a simple mechanism for easy extendibility for plugin developers (or other people who get bored on plane rides). For instance, if someone wants to build in a cool tooltip script for D|C, they can do the following:

```
DED.extendChain('tooltip', function(config) {
  // make cool tooltip script
});
```

The behavior instantly becomes available in the chain and one can use it like any other method:

```
// keep in mind this plugin is not currently available
// it's only used as an example of what one could do
_$('#content a').tooltip({
  id: 'unique_id',
  duration: 2,
  pause: 0.5
});
```

If I'm a YUI user, how should I approach using DED|Chain at this point — something to look at for immediate use? something to look at now and as it evolves? something to roll up my sleeves and contribute to?

D|C is easy to pick up. If you're a seasoned Yahoo! UI developer, take a peek at the source and you'll know exactly what's going on. You might want to just start prototyping out simple pages and see how comfortable you are with chaining. One thing to keep in mind is the philosophy behind DED|Chain. Its main goal is take the cruft out of development, and have more fun while you're writing code. The tagline is, of course, "Less cruft, more fun." Every "cruft cruncher" method has a direct purpose to make your life easier. Take for instance `YAHOO.util.Dom.setStyle`, which allows you to set a style property directly on elements. One problem I always encountered when using `setStyle` was the inability to set multiple styles at once. Of course I could use something like `YAHOO.util.Dom.addClass` and `YAHOO.util.Dom.removeClass`, but in some situations it wasn't ideal. So for this case, you could simply do the following in D|C:

```
_$('ul#nav li').setCSS({
  color: 'red',
  textTransform: 'uppercase',
  position: 'relative',
  left: '2px',
  fontFamily: '"trebuchet ms"',
 fontSize: '1.2em'
});
```

It encompasses the sexiness JavaScript developers like as well as the familiarity CSS authors know and love. In fact, JSON looks stuningly similar to CSS property values. They are both, in fact, just name:value pairs. And it's that very detail that lets developers not have to think about screwball API's that bridge JavaScript and CSS.

How good is the documentation at this point?

[It is good, and it is accurate](http://dedchain.dustindiaz.com/api/docs/). At this point, however, I am more interested in putting up live examples of practical uses, of which I do not have many at the moment. Nonetheless, finishing the documentation was a very important goal based on a conversation I had with a good friend, [Jim Rutherford](http://digitalmediaminute.com), who teaches a web development class at a university in Canada. At a certain point in the class, he teaches JavaScript to his students and allows them to pick out a JavaScript library to get their hands dirty with and do a little trick here and there. He tells me that each semester since YUI has been released, 100% of his students pick YUI. I asked him why, and he simply replied "they have excellent documentation, and my students know what to do with that."

As a former Yahoo of meretorious service, you're familiar with the corporate design mantra of "wow, delight, and love." What about DED|Chain will get implementers to the Wow stage and what is needed to get them to the Delight state? How do you keep 'em coming back and finding true love and a sense of oneness with the DED|Chain's approach to solving problems?

D|C will hopefully give developers the "wow" factor simply by example. The goal of "cruft free, more fun" in all honesty was carefully worded. If developers aren't saying "wow, you can do that?" I have failed. The example of `setCSS` would perhaps be one example that will hook in CSS authors because the syntax is near identical. The selector interface (thanks to Jack Slocum) is also a huge benefit that gives developers simplicity of DOM selection. We simply don't want to see `getElementById` and `getElementsByTagName`. I truly think css selector and xPath selector interfaces are the future for any JavaScript library. In fact, I'm looking forward to seeing a `YAHOO.util.Dom.getElementsBySelector` (hint hint, Matt Sweeney). \[_Note: [Matt Sweeney](http://video.yahoo.com/video/play?vid=111579) is the author of [YUI's Dom Collection](http://developer.yahoo.com/yui/dom/). -EM_\]

I think users of D|C will move onto delightness for the sheer fact that once they've learned it... they're done learning. There's no secret to DED|Chain. It works cross-browser, it's customizable, and the interface is dirt simple. I wouldn't be surprised if CSS developers begin building D|C plugins.

To the extent that you're using YUI as a underlying framework today, what do we need to do to help you ensure that DED|Chain matures to the point of generating Wow, Delight and Love in all its users?

Yahoo! needs to stay in business, and YUI needs to keep working. It cuts down on my own QA time, and also allows me to release headache free knowing that the underlying API from which I built it on "just works." From a D|C user perspective, one doesn't even have to know it's built on Y! UI. For D|C Developers (people who modify the framework), it would be nice for you to keep your docs online, because much of the functionality is based on `YAHOO.util.*`.

What's next for Dustin Diaz — beyond being a full-time blog author?

I'm co-authoring a book with [Ross Harmes](http://techfoolery.com/) called "JavaScript Design Patterns" which is due sometime near September this year. We are both admittedly writing the book we've always wish existed, and Apress is helping us do that. This book is ironically targeted at intermediate to advanced JavaScript developers.

Usually I ask people what their pain points are working with YUI. I'm going to turn that around this time and ask this instead: Was there anything you learned about YUI in this process that inspired Wow, Delight, and/or Love for you as you went about creating DED|Chain?

I love YUI, hands down. It works for me because it does exactly what I want out of a JavaScript library. It fixes the quirkiness that exists in JavaScript development across browsers. It's not JavaScript's fault, it's browser implementations of it that are bad. YUI fixed it. On top of that, they've made utilities, not a cluster full of widgets (yes, I understand there are widgets). Basically what that means is that I learned that, contrary to what might possibly be YUI's vision, I've always felt the goal of YUI was to give JavaScript developers the tools they need to build the "other" advanced interfaces they need to build. I can only hope D|C is reciprocal in the sense that D|C developers and users are working with something that allows them to "get stuff done."

_Do you have a YUI implementation that would be of interest to the YUI community? If so, please [share your link](http://groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/) and post a message to the community forum at [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/), or leave us a message in the comments section below._