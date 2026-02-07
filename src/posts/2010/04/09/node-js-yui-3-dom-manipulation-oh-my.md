---
layout: layouts/post.njk
title: "Node.js, YUI 3 & Dom Manipulation... Oh My!"
author: "Dav Glass"
date: 2010-04-09
slug: "node-js-yui-3-dom-manipulation-oh-my"
permalink: /2010/04/09/node-js-yui-3-dom-manipulation-oh-my/
categories:
  - "Development"
---
_**Update from [the previous article](/yuiblog/2010/04/05/running-yui-3-server-side-with-node-js/ "Running YUI 3 Server-Side with Node.js » Yahoo! User Interface Blog (YUIBlog)")**: YUI 3 no longer runs in the global scope. I have made some adjustments to my [nodejs-yui3](http://github.com/davglass/nodejs-yui3) project to allow YUI 3 to run fully as a proper non-global module._

[Early this week](/yuiblog/2010/04/05/running-yui-3-server-side-with-node-js/) I gave you a peek at running [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library") on the server with [Node.js](http://nodejs.org/ "node.js"). Now I'm back to tell you what I have been up to over the last week or so. A couple of weeks ago I stumbled across a project on GitHub called [jsdom](http://github.com/tmpvar/jsdom) by [Elijah Insua](http://github.com/tmpvar) ([@tmpvar](http://twitter.com/tmpvar)). jsdom describes itself as:

> \[A\] [CommonJS](http://commonjs.org/ "CommonJS: JavaScript Standard Library") implementation of the DOM intended to be platform-independent and as minimal/light as possible while completely adhering to the w3c DOM specifications.

That sounded interesting to me, so I forked the repository and started playing around with it to see what I could get it to do. To my surprise, it just worked. And because it's written in JavaScript, it was easy to start hacking and adding new features. The only issue I could see was that it's a pure DOM layer, lacking some BOM features that are necessary for most common web application development. So I set out to add the features I would need to run YUI 3 against jsdom. After a couple of days of hacking, I had a baseline implementation of jsdom that supports almost all of YUI 3's needs.

### Getting YUI 3 running with jsdom

I started by just including [jsdom](http://github.com/tmpvar/jsdom) and setting up the "fake" document object. At this point I could load our core [YUI 3 DOM functionality](http://developer.yahoo.com/yui/3/node/ "YUI 3: Node"), but the Event module would't load. That's when I noticed that some key BOM abstractions were missing — for example, Event needs some kind of a `window` object. So I created a "fake" window object to match my "fake" document and things started to load. As I said in the previous article, YUI 3's module system is fantastic and makes this kind of work much easier to do.

Most scripts access `document` and `window` directly. YUI 3 doesn't do that; instead, we have references to the active document/window in a config attached to each YUI instance. These can be accessed by `Y.config.doc` and `Y.config.win`. All YUI 3 modules adhere to this practice (and we strongly recommend you do the same in your [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery") modules or your own bespoke components).

Some might think this is a little excessive, but I've already used this feature in my early work on Editor for YUI 3. I am able to create a YUI instance and have it bound to an iframe's window/document. This means that I can run Selector and Event inside the iframe without having to load YUI inside that document. On the server, this makes even more sense. You may have several documents open in the same process, but your YUI 3 instances only need to know about the document they're using.

To support this work, I've created a new YUI 3 module called `nodejs-dom`. This module will include the proper libraries, if available, and set up the YUI instance with a `document` and `window` reference. Along with the configuration, it will create a new object on the instance called `Browser`. Since all YUI 3 module use Node and Node uses `Y.config.doc`, you shouldn't need to do anything else to make YUI 3 code work on the server. But if you're working with older JavaScript and need to access the `document`, `window`, `location` or `navigator` objects, they're all available on the `Browser` object. Here's a quick view of what the `Y.Browser` object looks like:

```
{navigator: 
   { userAgent: 'Node.js (darwin; U; rv:0.1.33)'
   , appVersion: '0.1.33'
   , platform: 'darwin'
   }
, window: 
   { screenTop: 0
   , pageYOffset: 0
   , screenY: 0
   , navigator: [Circular]
   , innerHeight: 768
   , pageXOffset: 0
   , screenLeft: 0
   , screenX: 0
   , innerWidth: 1024
   , length: 1
   , scrollY: 0
   , outerHeight: 768
   , contentWindow: [Circular]
   , frames: [ [Circular], [length]: 1 ]
   , setInterval:  [Function]
   , name: 'nodejs'
   , scrollX: 0
   , document: '#DOCUMENT'
   , outerWidth: 1024
   , setTimeout: { [Function]
   , location: { href: '/Users/davglass/.node_libraries/browser.js' }
   }
, self: [Circular]
, document: [Circular]
, location: [Circular]
}

```

### innerHTML support

Since `innerHTML` is not in the DOM Level1 spec, it's not in jsdom. This was a requirement for me, so I needed to find a solution. I found a project on GitHub called [node-htmlparser](http://github.com/tautologistics/node-htmlparser) and it claimed to be able to parse HTML, including malformed syntax. [I forked it](http://github.com/davglass/node-htmlparser) and made some code changes, cleaned up the syntax and fixed a couple of issues. I'd recommend using my fork if you're following along at home; I know my fork will work and I'll continue to maintain it as long as needed. Eventually someone will write a parser based on [@izs](http://twitter.com/izs)'s [sax-js](http://github.com/isaacs/sax-js) module.

### Let's see some code

This is a very simple hello world example:

```
YUI().use('nodejs-dom', 'event', 'node', function(Y) {
    var document = Y.Browser.document;
    document.title = 'This is a test';
    var i = Y.Node.create('<i>Test This</i>');
    i.addClass('foo');
    Y.one('body').append(i);

    var div = document.createElement('div');
    div.id = 'foo';
    div.innerHTML = '<em id="foo">Test</em> this <strong id="bax">awesome!</strong>';
    document.body.appendChild(div);
    
    var foo = Y.one('#foo');
    foo.addClass('bar');
    sys.puts(document.outerHTML);
});

```

The above code will return this snippet of HTML:

```
<html>
  <head>
    <title>This is a test</title>
  </head>
  <body>
    <i class="foo">Test This</i>
    <div id="foo" class="bar">
      <em id="foo">Test</em> this <strong id="bax">awesome!</strong>
    </div>
  </body>
</html>

```

### Is that what I think it is?

That's the most common question I've received when showing demos of this stuff. The answer: **YES**, this is what you think it is: **a full document rendered on the server by writing standard JavaScript against standard DOM and BOM APIs**. I have several examples of its use in the [GitHub project](http://github.com/davglass/nodejs-yui3). These examples include rendering YUI 3 [Tabviews](http://developer.yahoo.com/yui/3/tabview), [Sliders](http://developer.yahoo.com/yui/3/slider) and [Overlays](http://developer.yahoo.com/yui/3/overlay). Using the [2 in 3](/yuiblog/2010/03/11/yui-2-in-3-coming-soon/) project I was also able to render a YUI 2 [Calendar](http://developer.yahoo.com/yui/calendar) and [Layout Manager](http://developer.yahoo.com/yui/layout).

### Examples

I tossed up a couple of the examples from my git repo so you can see them in action:

-   [Functional YUI 2 Calendar rendered server-side](http://yuiloader.davglass.com/calendar/) ([source](http://github.com/davglass/nodejs-yui3/blob/master/examples/tnt-calendar-serve.js))
-   [Simple Templating Demo](http://yuiloader.davglass.com/template/) ([source](http://github.com/davglass/nodejs-yui3/blob/master/examples/y-server-template.js))

The Calendar demo is designed to show an example of progressive enhancement by using YUI to generate the Calendar on the server and provide static navigation to selected days and months. This implementation uses the same JavaScript to generate the server-side view as you would use on the client to render it in pure JavaScript. There is intentionally no client side JavaScript. Think of this as the baseline you'd use for progressive enhancement, rendering a fully-functional DOM on the server side to provide functionality to clients with no JavaScript support.

The second example shows how you can mix and match what is server data and what is client data. If I have a true MVC framework, which YUI 3 provides, I can separate my data (JSON) from my widget templates (DHTML) and from page templates (static HTML). The example shows how you can use the same data but access it from 3 different places to get only the parts you want.

I hope you see the power here that I see, including a possible future free of context switching and free of writing multiple levels of rendering code in the various levels of an application to support progressive enhancement. Enjoy! ([@davglass](http://twitter.com/davglass))