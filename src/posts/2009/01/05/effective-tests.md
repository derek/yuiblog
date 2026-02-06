---
layout: layouts/post.njk
title: "Writing Effective JavaScript Unit Tests with YUI Test"
author: "Nicholas C. Zakas"
date: 2009-01-05
slug: "effective-tests"
permalink: /blog/2009/01/05/effective-tests/
categories:
  - "Development"
---
One of the biggest under-the-radar movements in JavaScript development during 2008 was the reemergence of an interest in unit testing. [YUI Test](http://developer.yahoo.com/yui/yuitest/), YUI's unit testing framework, reached GA status in February and other libraries either introduced their own unit testing frameworks or started publicizing existing ones. As a result, there's a lot more documentation regarding the creation of unit tests for JavaScript. Simply having JavaScript unit tests isn't enough, though; if your tests are written improperly, they can lead to a lot of lost time. Learning to write effective JavaScript unit tests will save you time and headaches in the future.

## What are you testing?

The key to writing effective unit tests is to understand the word "unit." In testing terms, a unit is an isolated part of code that can be tested independent of other pieces of code. In an object-oriented language like JavaScript, each method is considered to be a unit. Proper OO design typically entails nicely encapsulated methods that serve a single purpose and are therefore easy to test.

Traditional unit testing is designed to test the implementation of an interface, so private methods don't get tested explicitly. This is called black box testing. The idea is that you can swap out the implementation of an interface and the unit tests will all still pass because they are completely agnostic to the underlying implementation. All the tests know is a set of constraints that must be met; they don't care how those constraints are met.

## Writing tests

As I said in my talk, unit tests should test inputs and outputs. Inputs can be named method arguments or changes in globally accessible variables that the method depends upon to function correctly. Outputs can be return values, changes in the state of variables, and even thrown errors. For each input-output set, there should be a single unit test. Each test should explicitly state, "given these inputs, I expect these outputs." Any deviation from that statement is a failed test.

Each test should be as simple as possible and test only one input-output set; combining sets into a single test minimizes the effectiveness of the unit test. For example, consider the following test of a function called `trim()`:

```
var testCase = new YAHOO.tool.TestCase({
    name: "trim() Tests",
    testTrim: function(){
        var result1 = trim(" Hello world");
        YAHOO.util.Assert.areEqual("Hello world", result1, "Leading white space should be stripped.");
        var result2 = trim("Hello world ");
        YAHOO.util.Assert.areEqual("Hello world", result2, "Trailing white space should be stripped.");
    }
});
```

Here, the `testTrim()` method of the test case is actually testing two different input-output sets:

1.  Input string has leading white space; return value has no leading white space.
2.  Input string has trailing white space; return value has no trailing white space.

The problem is that these two sets have literally no relation to one another, yet if the first input-output set fails to produce the correct result, the second set will never be tested. This is a situation where one failure masks another. It is more effective to separate out these input-output sets into two tests:

```
var testCase = new YAHOO.tool.TestCase({
    name: "trim() Tests",
    testTrimWithLeadingWhiteSpace: function(){
        var result = trim(" Hello world");
        YAHOO.util.Assert.areEqual("Hello world", result, "Leading white space should be stripped.");
    },
    testTrimWithTrailingWhiteSpace: function(){
        var result = trim("Hello world ");
        YAHOO.util.Assert.areEqual("Hello world", result, "Trailing white space should be stripped.");
    }
});
```

This code now properly tests the `trim()` function's input-output sets, keeping them separate.

Unit tests are always written as if the code being tested works correctly. Good software design involves mapping out these input-output sets ahead of time so that you know exactly what the result should be in each case. In this way, unit tests become a type of technical requirement document in addition to actual code.

## Effective assertions

One of the most important parts of writing unit tests is proper assertion definition. Each assertion specifies a condition that, if not met, indicates that the functionality isn't behaving appropriately. It's important to use only as many assertions as necessary to properly test the code output. Too many assertions can lead to false failures while too few can lead to false passes.

In the previous example, each test contains a single assertion because that is all that's needed. I know exactly the value that to be returned and so I test specifically for that. The tests may both look very simple, but they get the job done. Again, there's no rule about the number of assertions that make a good test, just make sure you're testing every expected output of the code for the given input.

To make test failures more coherent, you should include a failure message with each assertion. In YUI Test, this is always the last argument of any assertion method. A failure message should tell you what _should have_ happened, not what _did_ happen. Some examples:

```
//Bad failure message
YAHOO.util.Assert.areEqual("Hello world", result, "The result wasn't 'Hello world'");

//Good failure message
YAHOO.util.Assert.areEqual("Hello world", result, "Leading white space should be stripped.");

```

Note the difference between the bad and good failure messages: the bad tells you what happened and the good tells you what was expected. When running your tests, a failure already indicates that something unanticipated happened, so there's no need to simply repeat that something unanticipated happened. It's more helpful to know what should have happened because it is an exact representation of your requirement. By taking this approach, failures end up being a list of unfulfilled requirements that you can go back over and evaluate.

## Working with the DOM

JavaScript is unique to other languages in that it frequently has ties to the environment, the DOM. Methods that interact heavily with the DOM are difficult to unit test because the entire environment must be setup in order for the method to execute completely. Further complicating matters is the tendency of JavaScript to be triggered by a user action such as a mouse click. YUI Test provides event simulation to aid in creating tests for methods that are reliant on DOM interaction, however, this starts to cross over into the area of functional testing.

Functional testing, as opposed to unit testing, is designed to test the user's experience with the product rather than input-output sets for code. If you find yourself wanting to test that the user interface responds in a specific way due to user interaction, then you really want to write some functional tests rather than unit tests. YUI Test can be used to write some basic functional tests, but the most popular (and quite good) tool for such testing is [Selenium](http://seleniumhq.org/).

The best way to determine if something is a unit test is to ask if it can be written before the code that it's designed to test actually exists. Unit tests, as part of test-driven development, are actually supposed to be written ahead of the actual code as a way to guide development efforts. Functional tests, on the other hand, cannot exist ahead of time because they are so tied to the user interface and how it changes in response to user interaction.

## Structuring test hierarchies

YUI Test, just like other unit testing frameworks, supports a hierarchy of test cases and test suites. Each test suite can contain other test suites as well as test cases; only test cases can contain actual tests (methods beginning with the word "test"). The best way to organize your test hierarchy is to follow a very simple pattern:

-   Create one test suite for every object you're going to test.
-   Create one test case for every method of an object you're going to test and add it to the object's test suite.
-   Create one test in each test case for each input-output set.

In this way, your test hierarchy mirrors the code you're testing and it's easier to figure out where new tests should be created.

## Run your tests!

Perhaps the most important part of unit testing is to run your tests frequently. Testing is only effective when done on a regular basis. At a minimum, you should be running your unit tests before checking in changes to source control. Optimally, you'd also run the tests automatically on a regular basis to validate any changes after they've been committed to source control. This is how you'll get the biggest benefit of unit testing: quick discernment, and hopefully prevention, of regressions.

## Further information

-   [YUI Test](http://developer.yahoo.com/yui/yuitest/)
-   **YUI Theater:** [Test Driven Development with YUI Test, by Nicholas C. Zakas](http://video.yahoo.com/watch/3737228/10267335)
-   [FireUnit](http://www.fireunit.org/)
-   [FireUnit extension for YUI Test](http://www.nczonline.net/blog/2008/12/19/fireunit-extension-for-yui-test/)
-   [JavaScript is Code Too: Test It!](http://iridescence.no/post/JavaScript-is-Code-Too-Test-It!.aspx)
-   [JavaScript Unit Test Isolation](http://iridescence.no/post/JavaScript-Unit-Test-Isolation.aspx)