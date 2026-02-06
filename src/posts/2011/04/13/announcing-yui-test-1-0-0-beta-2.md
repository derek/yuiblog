---
layout: layouts/post.njk
title: "Announcing YUI Test 1.0.0 Beta 2"
author: "Nicholas C. Zakas"
date: 2011-04-13
slug: "announcing-yui-test-1-0-0-beta-2"
permalink: /blog/2011/04/13/announcing-yui-test-1-0-0-beta-2/
categories:
  - "Development"
---
Late last year we released the [beta 1 version](/yuiblog/blog/2010/11/09/introducing-the-new-yui-test/) of YUI Test. Since that time, we've been gathering feedback, fixing bugs, and implementing new features. Today I'm happy to announce the availability of YUI Test 1.0.0 beta 2, the last planned beta release before GA. This release features some new core functionality as well as initial support for Node.js. All of this is designed to make YUI Test a more complete testing solution no matter where you write JavaScript.

## Core Changes

Based on feedback from the YUI community, there have been some important additions to the YUI Test core. The first such change is the introduction of `init()` and `destroy()` on `TestCase` objects. Prior to this release, you could use `setUp()` and `tearDown()` to initialize and cleanup data needed to run tests. In the traditional xUnit style, `setUp()` ran before every test and `tearDown()` ran after every test. The `init()` and `destroy()` methods each run only once per `TestCase` object: `init()` runs first, before the first call to `setUp()`, and `destroy()` runs last, after the last call to `tearDown()`. These methods are useful for setting up data that the entire `TestCase` needs. For example:

```
var testCase = new YUITest.TestCase({

    name: "TestCase Name",
    
    //---------------------------------------------
    // init and destroy
    //---------------------------------------------
    
    init : function () {
        this.data = { name : "Nicholas", age : 28 };
    },

    destroy : function () {
        delete this.data;
    },

    //---------------------------------------------
    // Tests
    //---------------------------------------------

    testName: function () {
        YUITest.Assert.areEqual("Nicholas", this.data.name, "Name should be 'Nicholas'");
    },

    testAge: function () {
        YUITest.Assert.areEqual(28, this.data.age, "Age should be 28");
    }    
});


```

Another change is the introduction of a feature called context data. When the `TestRunner` begins, it creates an object that is passed into every `init()`, `setUp()`, `destroy()`, `tearDown()`, and test method. The object is empty by default and you can use it to easily share data amongst methods and `TestCase` objects. For example:

```
var testSuite = new YUITest.TestSuite({
    name: "Test Suite Name",
    
    setUp: function(data){
        data.topLevel = 1;
    }
});

testSuite.add(new YUITest.TestCase({

    name: "First Test Case",
    
    init: function(data){
        data.foo = "bar";
    },
    
    testValueOfFoo : function (data) {
        YUITest.Assert.areEqual("bar", data.foo);   //from init
    },
    
    testValueOfTopLevel: function(data){
        YUITest.Assert.areEqual(1, data.topLevel);  //from test suite
    }
});

testSuite.add(new YUITest.TestCase({

    name: "Second Test Case",
    
    testValueOfFoo : function (data) {
        YUITest.Assert.areEqual("bar", data.foo);   //from init in First Test Case
    },
    
    testValueOfTopLevel: function(data){
        YUITest.Assert.areEqual(1, data.topLevel);  //from test suite
    }
});

```

How you use context data is completely up to you. You can choose to ignore it completely and all of your tests will continue to work just fine.

## YUI Test for Node.js

Continuing with our goal of making YUI Test a ubiquitous fixture for JavaScript unit testing, beta 2 introduces YUI Test for Node.js. You can install YUI Test for Node.js via [npm](http://npmjs.org) using the following command:

```
npm install yuitest
```

Once installed, you can pass in files and directories containing JavaScript tests to run. Example:

```
yuitest testfile.js path/to/tests
```

The only difference between writing tests for the browser and writing tests for Node.js is that you must include YUI Test in the JavaScript file. The following format works well if you'd like to create a JavaScript test file that can be run both in the browser and using Node.js,

```
(function(){
    
    //define local version of YUITest based on what's available.
    var YUITest         = this.YUITest || require("yuitest");
    
    var testCase = new YUITest.TestCase({
    
        //test case details

    });
    
    YUITest.TestRunner.add(testCase);
})();

```

Keep in mind that Node.js is not a browser environment and as such tests that rely on browser features such as the DOM will likely throw errors.

## Moving Towards GA

There's still a lot of work to be done before YUI Test 1.0.0 reaches GA, and you can help! [Download beta 2](http://yuilibrary.com/downloads/#yuitest) today and start [filing bugs](http://yuilibrary.com/projects/yuitest/newticket) for the issues you find. Fork the code on [GitHub](http://github.com/yui/yuitest) and submit patches. For the GA release we'll be looking at more bug fixes, better documentation, and anything else that the community feels is important for the release.