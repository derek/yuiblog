---
layout: layouts/post.njk
title: "Introducing the New YUI Test"
author: "Nicholas C. Zakas"
date: 2010-11-09
slug: "introducing-the-new-yui-test"
permalink: /2010/11/09/introducing-the-new-yui-test/
categories:
  - "Development"
---
When [YUI Test](http://yuilibrary.com/yuitest/) first debuted over three years ago, the JavaScript testing landscape looked very different. [JsUnit](http://www.jsunit.net/ "JsUnit") was the de facto standard and there was very little interest or attention paid to this area. YUI Test began as a weekend project of mine and evolved into one of the most complete testing frameworks available, being the first to have full event simulation for keyboard and mouse events across all A-grade browsers and one of the first to support asynchronous testing.

Since the time that YUI Test was first released, there has been an increased level of interest in JavaScript testing as organizations small and large came to realize its value. Every major JavaScript library now comes bundled with a set of unit tests as well as a test runner, which is a huge step forward for these libraries. Additionally, a series of testing utilities has made its way into the world of JavaScript testing. As a result of these changes, it was time for YUI Test to evolve.

Today we're announcing [a new YUI Test project](http://yuilibrary.com/yuitest/). The goal is to create a complete JavaScript testing solution that encompasses all parts of the testing process.

### YUI Test Standalone Library

One of the original goals of YUI Test was to eliminate most of the common complaints about JavaScript testing. In my travels, I received a lot of positive feedback about the ease with which tests could be setup. I also received some comments from users of jQuery, Dojo, and other JavaScript libraries that they'd like to use YUI Test but felt they couldn't because they weren't using YUI itself. Even though it is possible to test non-YUI code with YUI Test (here's an [article talking about using YUI Test with jQuery](http://www.pabich.eu/blog/archive/2010/07/22/Java-Script-unit-testing-with-YUI-Test-and-Jack-mocking.aspx)), there was still a perception that YUI dependencies meant you must use YUI if you wish to use YUI Test. Considering that feedback, in addition to the trend towards standalone JavaScript testing tools, it seemed that the best way to address the concerns was to eliminate YUI as a dependency altogether. With that thought, the YUI Test standalone library was born.

The [standalone](http://yuilibrary.com/yuitest/) library is a superset of all features from YUI Test for YUI 2.x and YUI Test for YUI 3.x. This will then allow us to use the standalone library as the core of both versions of YUI Test. In the end, there will officially be three flavors of YUI Test to use: 1) the standalone library if you're not using YUI, 2) the YUI 2.x version, and 3) the YUI 3.x version. All three will share the exact same functionality but with different interfaces so that already-existing tests continue to work.

### YUI Test Selenium Driver

Another major shift that happened in the past few years was a movement towards continuous integration and automated testing. For any large code base, the ability to automatically run tests at regular intervals is a must-have. The big challenge for JavaScript testing has always been how to run your code in as many browsers as possible and aggregate the results in some sort of usable format. This is where [Selenium](http://seleniumhq.org) comes in.

Selenium is a testing tool widely used by QA organizations for functional testing. The interesting part of Selenium as it relates to JavaScript testing is its ability to start up a browser, execute some commands, and then shut down the browser. This capability, plus Selenium's already impressive usage and availability in organizations, made it an ideal tool upon which to build the first test driver for YUI Test.

The YUI Test Selenium Driver is designed to interact with a Selenium Remote Control or Selenium Grid server to enable testing of JavaScript across multiple browsers. Using the command line, you can specify a Selenium server, browsers to run tests on, and which test files to execute. The Selenium Driver then takes over, executing the tests and collecting the results in [JUnit](http://www.junit.org/) XML format. Although other formats are available, JUnit XML is used as the default due to its wide support in test reporting and continuous build tools such as [Hudson](http://hudson-ci.org).

### YUI Test Coverage

Once you have your tests and are able to execute them automatically, the next part of the puzzle is to determine how much of your code is actually being tested. YUI Test Coverage is a code coverage tool for JavaScript that tracks which lines of code and which functions are actually executed in your JavaScript. It does this by creating an instrumented version of your JavaScript code that keeps coverage statistics. This file is used while executing tests to gather statistics, and at the end, you have a report indicating which lines of code were executed. Coverage data helps you determine where more tests are needed to properly exercise all code paths.

YUI Test Coverage is designed primarily for use in a continuous integration system, though you can get access to the coverage data programmatically as well. YUI Test Coverage is also designed to work with YUI Test Selenium Driver so that code coverage statistics are automatically gathered when available.

### Help us!

This release of the YUI Test project is considered 1.0.0 beta 1, which means we need your help and feedback to reach a final 1.0.0 version. The source code for all of the YUI Test project is now available on [GitHub](http://github.com/yui/yuitest/) and you can find project details and file bugs at [YUILibrary.com](http://yuilibrary.com/projects/yuitest/). [Documentation for the testing tool is on YUILibrary.com](http://yuilibrary.com/yuitest/), and you'll find [additional documentation and examples in the download](http://yuilibrary.com/downloads/#yuitest). YUI Test is released [under YUI's BSD License](http://developer.yahoo.com/yui/license.html).

There are a lot of details to discuss about the new project, and this post is really just an introduction to the new project. A lot more documentation and information is forthcoming as the project continues to evolve.