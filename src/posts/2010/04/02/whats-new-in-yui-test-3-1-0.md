---
layout: layouts/post.njk
title: "What's new in YUI Test 3.1.0"
author: "Nicholas C. Zakas"
date: 2010-04-02
slug: "whats-new-in-yui-test-3-1-0"
permalink: /2010/04/02/whats-new-in-yui-test-3-1-0/
categories:
  - "Releases"
  - "Development"
---
One of the big pushes around YUI Test for the YUI 3.1.0 release was in the area of automation. While it's great that developers are starting to write unit tests for their JavaScript, test-driven development reaches its true potential only when these tests are run automatically and reports are generated to track trends. This entire process requires more than just JavaScript, of course, and so this latest version of YUI Test has a number of new features to make usage in a continuous integration environment easier.

### New TestRunner Methods

One of the more popular browser testing automation tools is [Selenium](http://seleniumhq.org). In speaking with engineers who use YUI Test regularly, we learned that many were already using Selenium to automate their JavaScript unit tests. There were two major pain points that arose from these discussions:

1.  It was difficult to determine whether tests were still being executed or not.
2.  There was no easy way to extract the results of the tests.

To address these two concerns, two new methods were added to the `TestRunner` interface. The first method, `isRunning()`, returns true when the TestRunner is in the middle of running tests and false otherwise. This enables easy usage with Selenium's `[waitForCondition()](http://wiki.openqa.org/display/SEL/waitForCondition)` method to determine when tests have completed. The second new method is `getResults()`. While tests are being executed, this method always returns `null`. Once tests are completed, this method returns an object containing all of the test result information. Optionally, you can pass in one of the test result formats (available on `Y.Test.Format`) to return a string containing test result information in the specified format. For example:
```
var results = Y.Test.Runner.getResults(Y.Test.Format.XML);
```
This method also makes scripting with Selenium easier, as you're able to retrieve the test result information from your script in a usable format. _Note:_ Selenium's scripting capabilities can only access objects in the global scope, so you'll need to make sure the `TestRunner` instance is available globally.

### New Results Formats

There are a lot of tools that can take unit test results and produce reports. Prior to YUI 3.1.0, YUI Test supported only basic test result formats in XML and JSON. Although these could be transformed into other formats, it made sense to implement two other popular formats natively: [JUnit](http://www.junit.org/) XML and [TAP](http://testanything.org). You can access the results in these new formats using `getResults()`:
```
var junitXml= Y.Test.Runner.getResults(Y.Test.Format.JUnitXML);
var tap = Y.Test.Runner.getResults(Y.Test.Format.TAP);
```
JUnit XML is one of the most widely supported test result formats amongst existing tools. Though its format doesn't map exactly to YUI Test structure (for example, there isn't a concept of nested test suites in JUnit XML), you still get enough information captured to make reasonable reports. TAP is a newer test results format that is free-form text. Unlike JUnit XML, TAP has no concept of grouping tests, and so YUI Test inserts comments into the output to identify test suites and test cases. To learn more about the new test formats, as well as to see example output, please see the [Viewing Results](http://developer.yahoo.com/yui/3/test/#viewing-results) section of the YUI Test documentation. These new formats can also be used with the already existing [Test Reporting](http://developer.yahoo.com/yui/3/test/#test-reporting) mechanism.

### More Automation On The Way

These are just the first steps toward improving the automation of JavaScript unit tests with YUI Test. Over the next year, you'll be hearing more about YUI Test and test automation. JavaScript continuous integration is an evolving discipline and we'd love to hear your feedback on how YUI Test can make this job easier for developers.