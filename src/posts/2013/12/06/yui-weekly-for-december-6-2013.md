---
layout: layouts/post.njk
title: "YUI Weekly for December 6, 2013"
author: "YUI Team"
date: 2013-12-06
slug: "yui-weekly-for-december-6-2013"
permalink: /2013/12/06/yui-weekly-for-december-6-2013/
categories:
  - "Development"
---
Hey everyone! It's Friday again, which means it's time to fire another callback for YUI Weekly! We've got two weeks of YUI news to catch up on because of the holidays, so this one's going to be packed.

# Release News

We released **YUI 3.14.0** on November 25th, notably containing major improvements to Charts and the work we've started to do to let developers use ES6 modules with YUI. We also got a lot of great contributions from the community during this release, so a big thank you to everyone who helped to make YUI better.

It's available for you to use [directly off our CDN](http://yui.yahooapis.com/3.14.0/build/yui/yui-min.js), as a [zip](http://yui.zenfs.com/releases/yui3/yui_3.14.0), or installable through [npm](https://npmjs.org/package/yui).

You can see the full list of all of the changes in [our release rollup right here](/yuiblog/blog/2013/11/25/yui-3-14-0-released/). Please definitely let us know if you come across any bugs by [filing an issue on GitHub](https://github.com/yui/yui3/issues).

# Open Roundtable

This week's [Open Roundtable](http://www.youtube.com/watch?v=lJPdH8xmOWg) kicked off **YUI in the Wild**, a new Roundtable series we're starting based on the ['In the Wild' blog posts](/yuiblog/blog/category/in-the-wild/) from quite a while back!

For our first guest, we had [Jeff Pihach](https://twitter.com/FromAnEgg) from Canonical come in to talk about building [Ubuntu Juju](https://juju.ubuntu.com/)'s GUI using YUI. He showed us how the Juju team structured their YUI App Framework application, how they bundled together their modules for a long-running app, and how they extended `Y.Router` to create URL flags for beta application features. Check out the video for all of that, and a lot more!

The Juju GUI is open source, so you can go and [check out their source code online](https://launchpad.net/juju-gui)!

If your company or team is interested in being featured on the next **YUI in the Wild**, feel free to contact [Andrew Wooldridge](https://twitter.com/triptych), our Community Engineer, and we can help you set up a time or discuss content!

# New this Week

-   [Derek Gathright](twitter.com/derek) wrote a [blog post introducing YUI Benchmark](http://derek.io/blog/2013/yui-benchmark/), a tool to make it easier for you to compare the performance of your JavaScript applications across your project's commits, whether they're in the browser or Node. Try it out, and feel free to [leave any feedback or feature requests](https://github.com/derek/yui-benchmark)!
    
-   [Wells Fargo](https://www.wellsfargo.com/) annnounced their [pilot of 89 new web and mobile applications](http://www.americanbanker.com/issues/178_205/wells-fargo-rebuilds-website-mobile-apps-for-corporate-clients-1063089-1.html), all built using the YUI App Framework. Keep an eye out for the video of their YUIConf 2013 talk coming out soon!
    
-   [Caridy Patiño](twitter.com/caridy) added support to the [Grunt ES6 Module Transpiler](https://github.com/joefiorini/grunt-es6-module-transpiler) task to output YUI modules. You can now automate building your ES6 code into YUI modules with ease!
    

# The World of JavaScript

-   [Happy 18th birthday to JavaScript](http://resin.io/happy-18th-birthday-javascript/)! It's been 18 years since JavaScript was first announced by Netscape and Sun, and it's definitely come a long way since then.
    
-   Check out the latest part in [Ariya Hidayat](http://ariya.ofilabs.com)'s [Kinetic Scrolling series](http://ariya.ofilabs.com/tag/kinetic) that shows us how exponential decay can help create more natural scrolling! Look out for both of Ariya's YUIConf 2013 talks as well, coming out soon!
    
-   Want to build your own compile-to-JS language? Take a look at this article by [Tristan McNab](http://neuromancer.io) on joining the [Compiler Creation Club](http://neuromancer.io/join-the-compiler-creation-club/)!