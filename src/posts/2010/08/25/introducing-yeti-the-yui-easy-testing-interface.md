---
layout: layouts/post.njk
title: "Introducing Yeti: The YUI Easy Testing Interface"
author: "Reid Burke"
date: 2010-08-25
slug: "introducing-yeti-the-yui-easy-testing-interface"
permalink: /2010/08/25/introducing-yeti-the-yui-easy-testing-interface/
categories:
  - "Yeti"
  - "Development"
---
[![Welcome to Yeti](/yuiblog/blog-archive/assets/yeti/splash.jpg)](http://yuilibrary.com/projects/yeti/)

Testing JavaScript is an important but often overlooked part of web development. One reason is because developing for the web means targeting more than one browser. YUI currently classifies [11 different environments](http://developer.yahoo.com/yui/articles/gbs/) that enjoy our highest support level. In addition, we also test YUI on emerging X-grade environments like mobile devices. When you have so many different environments to support, it's tempting to just pick a couple important ones to develop with locally and hope for the best.

At YUI, we use [Selenium](http://seleniumhq.org/) and [Hudson](http://hudson-ci.org/) for running [YUI Test](http://developer.yahoo.com/yui/3/test/)\-based unit tests on various browser and operating system configurations as part of our continuous integration strategy. This is great for catching problems that result from integrating your work with the rest of a complex software stack. It comes with a price: CI tools like these are complicated to setup and maintain. In any case, they don't help you while you're developing code and testing _before_ you commit.

Today, I'm excited to release [Yeti](http://yuilibrary.com/projects/yeti/) 0.1.0, an experimental command-line tool designed to make cross-browser testing easier before you commit a line of code.

Yeti automatically launches JavaScript unit tests in a browser and reports the results without leaving your terminal. It's very simple to use: Just run `yeti test.html` to get the results of the YUI Test-based test in `test.html`. You can pass multiple HTML documents to test multiple components at once.

```
$ yeti dom/tests/dom.html attribute/tests/attribute.html json/tests/json.html 
✔  DOM Tests from Safari (Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-us) AppleWebKit/533.16 (KHTML, like Gecko) Version/5.0 Safari/533.16)
  20 passed
  0 failed

✔  Y.JSON (JavaScript implementation) from Safari (Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-us) AppleWebKit/533.16 (KHTML, like Gecko) Version/5.0 Safari/533.16)
  68 passed
  0 failed

✔  Attribute Unit Tests from Safari (Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-us) AppleWebKit/533.16 (KHTML, like Gecko) Version/5.0 Safari/533.16)
  106 passed
  0 failed

194 tests passed! (3217ms)

```

The real power of Yeti is running tests in multiple browsers simultaneously. Although Yeti can open your tests one-by-one on your computer, Yeti allows you to run tests on any browser on any device—all at the same time.

If you run Yeti without arguments, it will start a web server that you can access at `http://localhost:8000`. You can then point browsers or devices on your network to that URL and every test you run from that point will be executed on all browsers visiting the test page.

[![Multiple browsers with Yeti](/yuiblog/blog-archive/assets/yeti/multiple-browsers.jpg "Yeti running a test on these browsers. Note that even uncaught exceptions are captured!")](http://yuilibrary.com/projects/yeti/)

When combined with the excellent [localtunnel](http://localtunnel.com/), firewalls between you and other computers are less painful. If you're not working with sensitive information, it's a simple way to make your Yeti available to the internet:

```
$ localtunnel 8000
   Port 8000 is now publicly accessible from http://example.localtunnel.com

```

You can then visit that URL to access Yeti and start running tests:

[![Yeti on iOS 4 Safari](/yuiblog/blog-archive/assets/yeti/mobilesafari.jpg)](http://yuilibrary.com/projects/yeti/)

This is especially useful for cellular devices: You can use your carrier's internet connection without needing to get your device on the same network as your development computer.

Yeti aims to make JavaScript testing easier; however, it's far from being complete. (Don't take the 0.1.0 version number lightly.) Yeti assumes you're using YUI Test, has only been tested on Mac OS X, and may not work with some kinds of testing scenarios. Despite these shortcomings, Yeti has been so useful internally that we didn't want to wait any longer to share it with the YUI community.

#### Getting the code

Yeti is [available on GitHub](http://github.com/yui/yeti) and offered under [YUI's BSD license](http://developer.yahoo.com/yui/license.html).

#### Installing

Yeti is written entirely in JavaScript and runs on top of [NodeJS](http://nodejs.org/). If you're already a NodeJS and [npm](http://npmjs.org/) user, installing is very simple:

```
$ npm install yeti@stable

```

If you haven't installed NodeJS and npm and you're on a recent Mac, you can still install Yeti with a convenient installer.

<table><tbody><tr><td><a href="http://yuilibrary.com/downloads/download.php?file=3716057163a82b4b00c2a00ab0bb186e"><img alt="Yeti Icon" src="/yuiblog/blog-archive/assets/yeti/download0.jpg"></a></td><td><a href="http://yuilibrary.com/downloads/download.php?file=3716057163a82b4b00c2a00ab0bb186e" style="font-size:120%;font-weight:bold">Download the Yeti 0.1.0 Installer</a> 2.7 MB<br><span style="color:#666">Requires Mac OS X 10.6 and a Intel Core 2 processor or better</span></td></tr></tbody></table>

If your computer doesn't meet the installer's requirements, you can still use Yeti if you're able to install npm. More installation and usage instructions are available in [Yeti's README](http://github.com/yui/yeti/blob/master/README.md).

#### Your participation is welcome

Yeti is the first project we've launched in [YUI Labs](http://yuilibrary.com/labs/), an umbrella category where our new ideas and initiatives will take shape. As such, Yeti is offered without the same level of support as our other projects. We still encourage you to ask questions and give feedback in [Yeti's forums](http://yuilibrary.com/forum/viewforum.php?f=230) and hope Yeti makes testing easy and fun. If it doesn't, please [tell us](http://yuilibrary.com/forum/viewforum.php?f=230), [file a bug](http://yuilibrary.com/projects/yeti/newticket) or consider [contributing to Yeti](http://yuilibrary.com/projects/yeti/pullreq).

Happy testing!

_**About the Author:** Reid Burke ([@reid](http://twitter.com/reid)) is the newest member of the YUI team. He loves abominable snow monsters and JavaScript._