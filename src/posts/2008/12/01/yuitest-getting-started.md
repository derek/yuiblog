---
layout: layouts/post.njk
title: "Getting Started with JavaScript Unit Testing and YUI Test"
author: "Nicholas C. Zakas"
date: 2008-12-01
slug: "yuitest-getting-started"
permalink: /2008/12/01/yuitest-getting-started/
categories:
  - "Yeti"
  - "Development"
---
For a long time, the web has been a wild west of technology. It's only been within the past five years that any sort of rigor has been applied to web development and technologies such as HTML, CSS and JavaScript. JavaScript development has been the most affected, bringing discipline from other types of programming into what previously was a free-for-all of copy-paste code. Of the traditional programming techniques, unit testing has just started to make its way into JavaScript.

The purpose of unit testing is to test an individual part of a program (a "unit"). Testing the smallest part of a program and ensuring that it works gives some indicating as to the overall correctness/completeness of the entire program. In object oriented programming, this typically means testing each method individually, ensuring that certain inputs result in certain outputs. Having a suite of tests to run whenever you make changes can give you a measure of confidence that the changes didn't unintentionally introduce additional bugs or regressions.

YUI Test is our framework for unit testing JavaScript. The goal of YUI Test is to make creating JavaScript unit tests fast and easy. We know from experience that developers' main complaint about unit testing is that it takes too long, so everything about YUI Test is designed to make this process easier. Here's how you can get started:

## Step 1: Create an HTML file and include required files

Add in the YUI Test required files. These are outlined in the [documentation](http://developer.yahoo.com/yui/yuitest/#start):

```
<!--CSS-->
<link rel="stylesheet" type="text/css"
href="http://yui.yahooapis.com/2.6.0/build/logger/assets/logger.css
<link rel="stylesheet" type="text/css"
href="http://yui.yahooapis.com/2.6.0/build/yuitest/assets/testlogger.css">

<!-- Combo-handled YUI JS files: -->
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/logger/logger-min.js&2.6.0/build/yuitest/yuitest-min.js"></script>
```

## Step 2: Include your JavaScript

After including the default YUI Test files, you'll need to include the JavaScript that you want to test. The best approach is to include individual JavaScript files that encapsulate the functionality to test. If your JavaScript requires some markup or CSS on the page to work correctly, you may want to include those as well.

## Step 3: Create a test case

Test cases are created via the `YAHOO.tool.TestCase` constructor. The constructor accepts a single argument, which is an object that has at least a `name` property and one or more methods. If a method begins with the word "test" (all in lowercase), then it is considered a test to be run; all other methods are considered to be helpers.

To test your JavaScript, create one or more tests in the test case object. Each test should have at least one assertion. [Assertions](http://developer.yahoo.com/yui/yuitest/#assertions) are used to indicate the expected result of an operation and are expressed as methods on `YAHOO.util.Assert`, `YAHOO.util.ArrayAssert`, `YAHOO.util.DateAssert`, and `YAHOO.util.ObjectAssert`. The most frequently used assertion is `YAHOO.util.Assert.areEqual()`, which is used to determine if two values are equivalent. The first argument is the expected value and the second is the value you're testing. For example:

```
var testCase = new YAHOO.tool.TestCase({
    name: "trim() Tests",

    testTrimWithLeadingWhiteSpace: function(){
        var result = trim("    Hello world!");
        YAHOO.util.Assert.areEqual("Hello world!", result);
    }
});
```

This code tests a trim() function be sure that it removes leading white space from a string. A test string is passed through trim() and then the actual result is compared against the expected result. If the two don't match, then an assertion failure is thrown and testTrimWithLeadingWhiteSpace() is marked as failed. You can have multiple assertions in a single test if necessary, but it's generally a good idea to keep the number of assertions small so that you're not testing too much in a single test.

Each test case must be added to the test runner before it can be executed, so each test case should be added like this:

```
YAHOO.tool.TestRunner.add(testCase);
```

Test cases are executed in the order in which they are added to the test runner.

## Step 4: Execute tests

You can begin running tests once all of the test cases have been added to the test runner. This is generally done once the page has finished loading and so the `onload` event handler is a good place to begin:

```
window.onload = function(){

    //create the logger
    var logger = new YAHOO.tool.TestLogger("testLogger");

    //run the tests
    YAHOO.tool.TestRunner.run();
};

```

This code creates a new instance of the TestLogger, which outputs the results of the tests, and then runs all of the tests. This snippet of code can be used verbatim in any file to begin execution of the tests. As tests execute, the results are displayed in the TestLogger, which passes displayed in green and fails displayed in red.

All of this should be saved in a single HTML file. You need only load the file into your browser to see the results. For more, check out the [examples](http://developer.yahoo.com/yui/examples/yuitest/index.html) or take a look in the `tests` directory of the [YUI zip file](http://developer.yahoo.com/yui/download/).

## Wrap-up

That’s all it takes to get started writing unit tests for your JavaScript. Keep in mind that your JavaScript doesn't need to use YUI at all to take advantage of unit testing with YUI Test. The framework can be used to test any JavaScript code.

## More information

-   [YUI Test](http://developer.yahoo.com/yui/yuitest/)
-   [Test-Driven Development with YUI Test](http://video.yahoo.com/watch/3737228/10267335)
-   [YUI Test – The New Kid on the Block](http://www.vandamme.com/blog.aspx?id=1978&blogid=194)

## Video: Nicholas C. Zakas on Test-Driven Development and YUI Test:

  

    

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.30"> <param name="allowFullScreen" value="true"> <param name="AllowScriptAccess" value="always"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=10267335&amp;vid=3737228&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/5631/73581987.jpeg&amp;embed=1"><embed allowfullscreen="true" allowscriptaccess="always" bgcolor="#000000" flashvars="id=10267335&amp;vid=3737228&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/5631/73581987.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.30" type="application/x-shockwave-flash" width="512"></object>

[Nicholas C. Zakas: "Test-Driven Development with YUI Test"](http://video.yahoo.com/watch/3737228/10267335) @ [Yahoo! Video](http://video.yahoo.com)