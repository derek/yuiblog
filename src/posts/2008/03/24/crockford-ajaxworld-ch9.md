---
layout: layouts/post.njk
title: "Crockford Speaks on \"Fixing the Web\" and Appears on Channel 9"
author: "YUI Team"
date: 2008-03-24
slug: "crockford-ajaxworld-ch9"
permalink: /blog/2008/03/24/crockford-ajaxworld-ch9/
categories:
  - "Development"
---
![Douglas Crockford speaking at AjaxWorld East 2008; photo by Noah Sussman.](/yuiblog/blog-archive/assets/crockford_ajaxworld.jpg)

Frequent YUIBlog contributor [Douglas Crockford](http://blog.360.yahoo.com/blog-TBPekxc1dLNy5DOloPfzVvFIVOWMB0li) gave a keynote at the [AjaxWorld East 2008](http://www.ajaxworld.com/general/keynotes0308.htm) conference in New York City last week. As ever, Douglas was pulling no punches — his title: "Can We Fix the Web?" The browser, Douglas says, was behind the times when it was introduced, and it hasn't aged well. It wasn't designed to do the kinds of things we're trying to make it do; we've exploited most of its potential and we're hitting a natural wall now that we've extracted from the browser about as much as is possible.

The browser has serious problems:

-   _It's insecure_: Once an attacker gets a foothold on the page, it can read the page, load additional scripts, make additional requests of the server, and send information anywhere in the world. The browser fails to prevent any of these things.
-   _It suffers from the Turducken problem_: Turducken, popularized by NFL analyst and Hall of Fame coach John Madden, is a turkey stuffed with a duck stuffed with a chicken. The Web is like this, with CSS stuffed in JavaScript stuffed in HTML. Text that's safe in one context may not be safe in another.
-   _The web standards **require** that these vulnerabilities be present_. Douglas identifies JavaScript, DOM and cookies as being standards that lead to vulnerability. JavaScript's global object and intrinsic insecurity are a problem; the nature of the DOM node tree, where every node can access every other node and the network, is a problem; and the ambient authority system of cookies presents a problem.

Reiterating an argument he's made elsewhere, Douglas went on to argue that, while mashups are the most interesting development in software in 20 years, they are spectacularly insecure. Any time you have scripts from two sources on the same page, you have an insecure situation, and that is often a baseline assumption in the mashup world. (But, Douglas notes, it's not limited to "traditional" mashups: advertising as implemented on the web is itself a mashup and is insecure.)

Douglas proposes a three-part approach to "fixing the web":

-   _Subsets of JavaScript_: It's possible to create safe subsets of JavaScript by eliminating the parts of the language that are dangerous. There are a few subsetting approaches out there; Douglas's own [ADsafe](http://adsafe.org) is one and [Caja (from Google)](http://code.google.com/p/google-caja/) is another.
-   _Small browser improvements_: Implementing solutions for cross-site data access (for mashups) — like [JSONRequest](http://www.json.org/JSONRequest.html) — that can replace current techniques like the script tag hack and iframes.
-   _Massive browser improvements_: Douglas suggests replacing JavaScript and the DOM and going from there — effectively building upon the ADsafe JavaScript subset using the tenets of object capability theory to create a secure toolkit for in-browser programming.

You can [download Douglas's slides here](/yuiblog/blog-archive/assets/crockford/crockford-fix.zip). The AjaxWorld team is pretty good about getting video up on their site, and we'll drop a link when we see it there; in the meantime, [YUI Theater has seven videos from Douglas](http://developer.yahoo.com/yui/theater/) to keep you going while you wait.

### Douglas Crockford, Alex Russell and Joseph Smarr on Channel 9

[![Douglas Crockford appeared on Microsoft's Channel 9 video series talking about the zen of JavaScript.](/yuiblog/blog-archive/assets/crockford_ch9.png)Douglas was also on Microsoft's Channel 9 last week](http://channel9.msdn.com/Showpost.aspx?postid=391047), appearing in a session filmed at MIX08 along with Alex Russell (of Dojo and SitePen) and Joseph Smarr (of Plaxo; [Joseph also appeared on YUI Theater talking about performance last year](/yuiblog/blog/2007/08/29/video-smarr/)).

> At MIX08, we were lucky enough to get three of the world's top JavaScript experts to talk to us about the future of the language, the "Zen" of JavaScript, and tips and tricks on performance and management of large JavaScript projects.

_[CC photo by Noah Sussman](http://www.flickr.com/photos/thefangmonster/2346102125/)._