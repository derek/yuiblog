---
layout: layouts/post.njk
title: "jQuery and YUI 3: A Tale of Two JavaScript Libraries"
author: "Mark Rall"
date: 2010-10-27
slug: "jquery-and-yui-3-a-tale-of-two-javascript-libraries"
permalink: /blog/2010/10/27/jquery-and-yui-3-a-tale-of-two-javascript-libraries/
categories:
  - "Development"
---
Recently I had the opportunity to build my first JavaScript front end application. What follows is a short story of the discovery and evolution that comes about when trying to use tools that aren't suited for the job at hand. It is an account of the learning acquired through developing the same front end application using two very different libraries, jQuery and YUI 3. Details of the client and the project have been intentionally omitted.

### Overview

The project involved the refactoring of several disparate Flash tools into a single interactive application based on open standards for a large content publisher. Of high importance, the application had to be highly optimised with a small initial foot print due the large number of daily page impressions the client receives. Several phases were involved, with the first being an initial proof of concept.

The concept involved the development of one view of what would be the completed application. It consisted of:

-   An initial seed file (< 1KB) responsible for the dynamic loading of any frameworks (e.g., jQuery or YUI 3) and the initial application file.
-   The development and inclusion of jQuery plugins to support form element styling and validation, and dynamic chart visualisations.
-   The generation and population of UI, based on user inputs, configuration defaults and the application's location within the publisher's site.
-   The calculation and presentation of information based on the user's input.

In the interest of full disclosure, my own experience up to this point had been in developing small, standalone solutions, the type of which you could typically describe as plugins. These included dynamic UI components such as image carousels, interactive maps and Twitter / Flickr widgets. At the time of first dabbling with JavaScript, jQuery was popular, easy to learn and allowed me to quickly pick up the basics needed for the projects I was working on. However these were all standalone units and had no need to interact with other code or as part of a larger application.

### First Attempt

On completing the first phase of the project, it became painfully obvious that I was dealing with a very different beast than what I was used to. Having had little experience in code organisation, my code quickly became disorganised, inefficient and repetitive. As a result, the first part of what would become a much larger application was slow to load. In fact it took eight seconds to generate that single proof of concept. A big change was needed and while I had considered using a small library like [Dean Edward's Base](http://dean.edwards.name/weblog/2006/03/base/ "Dean Edward's Base") or [John Resig's Simple JavaScript Inheritance](http://ejohn.org/blog/simple-javascript-inheritance/ "John Resig's Simple JavaScript Inheritance") pattern to add class-based inheritance to jQuery, I decided to go one step further.

What I wanted was a complete, mature framework within which to develop my first OO application. Something that would effectively guide me through the process. In reviewing the available libraries I decided to adopt YUI 3 for the following reasons:

-   Integrated, inheritance-based application development support including attribute and class management.
-   Long term solution:
    -   Support for standards and accessibility.
    -   Funded by a large well known organisation, Yahoo!
    -   Associated with respected names like [Douglas Crockford](http://www.crockford.com/), [Nicholas Zakas](http://twitter.com/slicknet), and [Stoyan Stefanov](http://twitter.com/stoyanstefanov).
-   Performance optimisation:
    -   Initial seed file of only 7KB.
    -   Lazy-loaded modules on demand.
    -   CDN delivery.
-   Varied and comprehensive documentation:
    -   [Yahoo! Developer Network](http://developer.yahoo.com/yui/3/)
    -   [YUI 3 API Documentation](http://developer.yahoo.com/yui/3/api/)
    -   [YUI Theater](http://developer.yahoo.com/yui/theater/)
    -   [YUI Library](http://yuilibrary.com/)
    -   [YUI Blog](/blog-archive/)
-   Mature, consistent evolution between releases.
-   Integrated tools in [YUI Compressor](http://yuilibrary.com/projects/yuicompressor/), [YUIDoc](http://yuilibrary.com/projects/yuidoc), [YUI Builder](http://yuilibrary.com/projects/builder), and [Console](http://developer.yahoo.com/yui/3/console/).
-   Not just JavaScript, a CSS framework too.

### Take Two

Integrating YUI 3 brought several direct and indirect benefits to the project:

-   Inheritance-based architecture and class management through the [Attribute](http://developer.yahoo.com/yui/3/attribute/) interface, and [Base](http://developer.yahoo.com/yui/3/base/) and [Widget](http://developer.yahoo.com/yui/3/widget/) classes producing performant, reusable and organised code.
-   Separation of presentation from model and data using the [Widget](http://developer.yahoo.com/yui/3/widget/) class to render alternate views (inline or overlay) based on the application's location within the site.
-   [Sandboxing](http://developer.yahoo.com/yui/3/yui/#why) and dynamic [module](http://developer.yahoo.com/yui/3/yui/#modulelist) inclusion through YUI.use().
-   Cross-browser console debugging using [YUI Console](http://developer.yahoo.com/yui/3/console/).
-   On save, performance optimisation using [YUI Compressor](http://yuilibrary.com/projects/yuicompressor/) in Eclipse.
-   Easy inclusion and integration of pre-existing jQuery plugins.
-   On save, automated code documentation using [YUIDoc](http://developer.yahoo.com/yui/yuidoc/).

The final result was a happy client and a finished product with sub-second load times (remembering it took 8 seconds to load the initial proof of concept).

### Lessons Learned

Select the right tool for the job

In reading this post I'm sure some readers will view this as anti-jQuery. Not at all. jQuery is a fantastic project responsible for many innovations. But, as with any tool, it has its strengths and an intended purpose. Its strength lies in normalising browser inconsistencies, lowering the barrier to entry for the novice and improving the efficiency of experienced programmers. The primary learning that came out of the project was that you can't rely on one tool for every job. YUI builds on what jQuery can provide by also offering a well architected application framework. But it's fair to say that it comes at a cost, see the next point.

Steep learning curve

You need patience, especially when writing your very first application with an unfamiliar library as I did. However the payoff is immense. By learning another library, not only will your core JavaScript skills improve, you'll also develop a deeper understanding of how libraries work and the benefits they bring. I try to learn something new about YUI everyday and the more I learn, the more I'm in awe of the thought and sheer talent that's gone into building YUI.

Only load content when you need it

While it's certainly programmatically easier to just to load everything you may need upfront, the performance improvements gained as a direct result of lazy loading content only when you need it is huge. This was one of the key contributing factors for drastically improving the performance of the application.

Interact with the DOM as little as possible

This point doesn't relate to the specific library used. By caching the required DOM elements and utilising HTML templates more, UI rendering time fell considerably. Nodes can be cached using Y.one() while node lists can be captured using Y.all(). Also Y.Node.create() was very useful in efficiently converting large text strings of HTML to DOM elements prior to insertion.

Learn by example, use a CDN

In using YUI's CDN delivered library we decided to deliver all the project's assets via CDN. This was probably the next largest contributing factor to the performance improvement.

Pub, sub hubbub

For those experienced programmers out there, try not to laugh at this one. Having been used to writing little more than plugins in the past, I had no idea how applications should communicate internally. Even after reading "Custom Events allow you to publish the interesting moments or events in your own code so that other components on the page can subscribe to those events and respond to them," I still missed it.

As it turns out, YUI's custom event publish-and-subscribe model works beautifully for inter-class and inter-object communication. You can even subscribe pre and post to events and include dynamic logic to suppress bubbling based on certain conditions.

Integrate best practice into your workflow

Using Eclipse we were able to integrate JSLint and YUI Compressor into the build process. Put simply, every time you hit Ctrl / Cmd + S your JavaScript code is validated and optimised. That means you're testing against optimised, production grade code from the very first line of code. It also means that you won't forget to optimise in the frantic final race to the delivery deadline.

### Learning YUI on the Job

Although everyone has a different learning style, I thought I'd share what resources I used to learn YUI with a specific objective in mind.

-   Watch the relevant YUI Theater episodes to get a general overview of the library or learn a specific module. I can highly recommend starting with:
    -   [Eric Miraglia's Welcome to YUI 3](http://developer.yahoo.com/yui/theater/video.php?v=miraglia-yuiconf2009-yui3)
    -   [Todd Kloots on YUI 3 Sugar](http://developer.yahoo.com/yui/theater/video.php?v=kloots-yuiconf2009-sugar)
    -   [Matt Sweeney's YUI 3 Performance](http://developer.yahoo.com/yui/theater/video.php?v=sweeney-yuiconf2009-performance)
    -   [Luke Smith's Debugging in YUI 3](http://developer.yahoo.com/yui/theater/video.php?v=smith-yuiconf2009-debugging)
    -   [Isaac Schlueter on Solving Problems with YUI 3](http://developer.yahoo.com/yui/theater/video.php?v=schlueter-yuiconf2009-yui3)
    -   [Eric Ferraiuolo on Web App Development with YUI 3](http://developer.yahoo.com/yui/theater/video.php?v=ericf-yuiconf2009-webapps)
    -   [Luke Smith's Events Evolved](http://developer.yahoo.com/yui/theater/video.php?v=smith-yuiconf2009-events)
-   Read up on YUI on the [Yahoo! Developer Network](http://developer.yahoo.com/yui/3/). I try to read a little bit every week and learn more each time I re-read it.
-   Read the [API](http://developer.yahoo.com/yui/3/api/) documentation. If you can't find it on YUI Theater or on the Developer Network, dig into the API. It even pays to read the code directly.
-   Read and post questions to the [forum on YUILibrary.com](http://yuilibrary.com/forum/).
-   Play a lot and have fun!

### Conclusion

YUI 3 is a full-featured, mature and constantly evolving library suitable for small to large projects. As front end web applications become more complex, the need for libraries like YUI will grow. While for the uninitiated it can be a daunting experience at first, if you stick with it you will be rewarded.