---
layout: layouts/post.njk
title: "Enhancing YUI-based Applications With Audio"
author: "Scott Schiller"
date: 2009-06-30
slug: "yui-soundmanager"
permalink: /2009/06/30/yui-soundmanager/
categories:
  - "Development"
---
Sound is one of the major senses and a major part of daily life, and yet is largely ignored on the web. Web developers know that when it comes to HTML, audio is not as easy to add to a web site as it should be. Why is that? The following are some thoughts on the historical problems with embedding sound, a few ideas and some demos of embedding and controlling sound from Javascript with YUI.

### Demos

If you're like me, you're probably wanting to see some fun stuff up-front because _reading_ is _work_, and _work_ is _boring_! ;) Feel free to play with the demos first and then read on for the details.

-   Demo 1 (practical): [Play MP3 Links Inline](http://www.schillmania.com/content/demos/yui-sm2/inline-mp3/)
-   Demo 2 (fun): [A Noisy DOM](http://www.schillmania.com/content/demos/yui-sm2/noisy-events/)

### A Brief History of HTML and "Multimedia"

The web is pretty good at visual presentation. It is easy to create, design and embed images, text, and links in HTML documents. Of the media formats natively supported today in HTML 4, audio and video - or rather, <audio> and <video> - are conspicuously missing.

HTML 5 should bring audio and video embedding closer to the simplicity of <img /> in the not-so-distant future. In the meantime, we have to resort to creative work-arounds to get HTML-5-like audio/video functionality across the gamut of today's common HTML 4-supporting browsers.

### The (HTML 4) Problem With Embedding Audio

For audio on web sites today, developers often display a list of HTML links directly to MP3 files. This method is simple, universally-understood and indexable by search engines, but makes for a confusing and inconsistent browsing experience by default.

Users are generally prompted to right-click, "save as" and finally open the file from their desktop, or click the link and have their browser download and open the MP3 file. The regular "click" typically opens in a new page with the embedded player or launches an external application like QuickTime or Windows Media Player.

Not only are "naked" MP3 links extra work and confusing for the user, the browser's method of handling them is a distraction and takes them away from the experience of your site.

Using <object>/<embed> is another generic way to directly embed MP3 or other content, but again suffers from the problem of inconsistency; the developer won't know what may show in that area of the web page, given the user could have any array of applications which may load in order to handle that file type - in this case, likely the same QuickTime or Windows Media Player which would handle direct downloads would be shown in-place in your page. Again, not a great solution.

Flash widgets are sometimes used as a solution for embedding MP3 content, but the UI and skins tend to be 100% Flash-based rather than HTML and CSS-based and thus are more difficult for most web developers to customize. HTML 5 should change this with standards-based, CSS-skinnable and scriptable audio/video elements.

In the meantime, some creative solutions can be used to get more "web developer-friendly" widgets for audio.

### Making MP3 Links "Just Work": YUI + SoundManager 2

To have "progressively-enhanced" links to MP3s that will play in-place when clicked, something must intercept the browser's normal download action and subsequently handle the request; by combining Javascript and Flash to handle the loading and playing of MP3 content, this can be done very effectively.

In a personal quest to get cross-browser audio control for a DHTML game back in 2002, I developed a JS + Flash audio API called SoundManager. Having since evolved to include video, [SoundManager 2](http://www.schillmania.com/projects/soundmanager2/ "Javascript + Flash sound library") implements and extends Flash's native sound API and exposes it to Javascript. The result is cross-browser/platform scripted audio functionality which can help to bridge the gap for JS-driven sound until HTML 5 is widely supported.

By combining SoundManager 2 with YUI's [DOM](http://developer.yahoo.com/yui/dom/ "YUI DOM documentation") and [Event](http://developer.yahoo.com/yui/event/ "YUI Event documentation") utilities, you have an effective solution for embedding and controlling audio which can gracefully degrade to a browser download or embedded player.

### Practical Example: Playable MP3 Links

The following demo uses YUI and SoundManager 2 to enhance MP3 links, making them playable inline. YUI's event utilities intercept clicks on links pointing to MP3 files and then use the SoundManager API to load and play the relevant URL before returning "false", and preventing the browser from loading the link. Subsequent clicks will toggle play/pause state.

In the event Javascript/Flash aren't present or if anything else goes wrong, the browser will simply fall through and load the MP3 link as usual.

-   **Demo 1 (practical):** [Play MP3 Links Inline](http://www.schillmania.com/content/demos/yui-sm2/inline-mp3/)

### Adding Audio To Your UI

Javascript-based animation, transition and motion effects add fluidity to web interface design and are becoming more commonplace. Smartly-applied audio can complement and further enhance the UI, making the experience more meaningful.

In certain applications, sound in the form of UI feedback can be appropriate and helpful to the user experience. Sound effects are common for Flash-based sites and web-based games, and in desktop gaming audio is usually a key part of telling the story.

### .. But Don't Over-Do It

It's important to know when to stop. Recall animated "under construction" .GIFs? How about the blink tag? Marquee text? Some things are best left alone. Not every HTML page needs to move, blink, slide, flash _and_ be noisy at the same time; even "fun" is best applied in moderation. Annoying your users with auto-playing music or noise can quickly lead to abandonment of your site.

There is probably good reason that standard HTML elements such as form controls and the like do not have sound effects or notifications associated with them. Perhaps "silence is golden" and it's best that the web be a quiet place by default, so as not to be annoying and distracting.

As one notable exception to the "silent web" theme, Internet Explorer usually makes a "click" sound when page navigation occurs, presumably to notify the user that an action has started. This has become more muted in recent times, but is still present and still seems to annoy some users to this day.

### "Fun" Example: A Noisy DOM

Despite the arguments for silence, the following is an example of what it might be like to have "noisy" form elements, buttons and DOM elements which provide audible feedback as they're being used. The novelty is certainly to wear off quickly, but it does add an element of childish fun to the UI.

-   **Demo 2 (fun):** [A Noisy DOM](http://www.schillmania.com/content/demos/yui-sm2/noisy-events/)

### Looking Forward: HTML 5

Native <audio> and <video> support will mean it will be much easier to embed and control more media formats within the browser without relying on third-party plugins. Furthermore, an extensive Javascript API should encourage developers to create increasingly-innovative experiences.