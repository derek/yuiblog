---
layout: layouts/post.njk
title: "YUI and Travis sitting in a git-tree"
author: "Dav Glass"
date: 2012-05-11
slug: "yui-and-travis-sitting-in-a-git-tree"
permalink: /blog/2012/05/11/yui-and-travis-sitting-in-a-git-tree/
categories:
  - "Development"
---
[![Travis-CI](http://a0.twimg.com/profile_images/1788260785/travis_reasonably_small.png)](http://travis-ci.org/)Over the last few weeks, I have spent a great deal of time getting YUI's core tests executing on [Travis CI](http://travis-ci.org/). As of today, every push to our [YUI 3](https://github.com/yui/yui3) repo on GitHub results in over 6,000 (6,053 to be exact) unit tests being executed and logged. These tests include 1,130 of our core JavaScript-only unit tests executing natively inside of [Node.js](http://nodejs.org/) on versions 0.4.x and 0.6.x (with 0.7.x support to be added soon). We follow that with our full unit test suite (4,923 tests), running with my command-line [YUITest](http://yuilibrary.com/yuitest/)/[PhantomJS](http://phantomjs.org/) wrapper, [Grover](https://github.com/davglass/grover). Today I want to tell you a little more about how and why we are doing this.

### Why?

For the longest time, our tests and builds were a mystery to our users. They all happened behind closed doors and nobody really knew what we were doing. Over the last few years, we started adding more and more of our tests to our source tree, so that people can see what we are actively testing. This helped a little, but it didn't show that we run every test on every build and that if a test fails, we don't push that build to GitHub. Then along came Travis CI, the open source continuous integration platform that hooks directly into GitHub. I played around with it for a day and immediately began moving our tests around so we could use it. We want to be more transparent in our processes and allow the public to see what we test and how we do it. One thing we want to add to this process is access to our current code coverage report. Currently, we run a code coverage report daily from tests executed in FF12, Chrome-latest and IE8, but none of our users can see that we are at ~80% covered:

![Coverage Report](https://img.skitch.com/20120510-crr5xgn3wmguamnsjp3uixfwjb.jpg)

We are working very hard to rectify this issue and hopefully get this data out in the open for everyone to see.

### How?

I had to make minimal changes to our core test suites in order to get them to run under Node.js in Travis CI. By "core test suites", I mean any YUI module that can execute without the need for a working DOM. This includes, but is not limited to: YUI Core, Loader, YQL, Y.Array, Y.Object, etc. These modules are all perfectly usable inside of Node.js without modification. Let's look at the [YQL tests](https://github.com/yui/yui3/blob/master/src/yql/tests/unit/assets/yql-tests.js) as an example. All I had to do was create a Node.js wrapper similar to the standard test wrapper we use in a browser and include the exact same test that's executed in the browser. Here is the YQL module's wrapper: Now, this same test module can be executed in a browser and in Node.js without modification!

### Caveats?

In order for these tests to run natively in Node.js, they need to not interact with the DOM. For example, `Y.Array` consists of helper methods for dealing with `Array`s in JavaScript. But there are a few tests that include dealing with DOM elements to ensure that the helper methods return the right values. For these tests, I had to move the DOM-related code into a new test and add that test to the list of ignored tests when `Y.UA.nodejs` is detected. This way, such tests are ignored in Node.js, but still run in the browser. Here's an example: As you can see, it's relatively easy to make our tests run in both environments to ensure that our code is stable and fully functional when used in Node.js as it is in the browser.

### What is Grover?

Grover is a command-line tool that allows you to execute YUITest-based tests in PhantomJS. PhantomJS is a headless Webkit instance that allows you to render an HTML page without a GUI present. So Grover closes the gap on this and allows you to run our unit tests from the command-line inside of a CI system like Travis. Grover is free and available via: `npm install -g grover` (You must have the PhantomJS binary installed before using Grover.)

### How do we see all this?

Travis CI provides a full report of previous builds, as well as an up-to-date status information. Below are the links to our current projects hosted on Travis CI:

-   ![](https://secure.travis-ci.org/yui/yui3.png?branch=master) [YUI 3](http://travis-ci.org/#!/yui/yui3)
-   ![](https://secure.travis-ci.org/yui/yuidoc.png?branch=master) [YUIDoc](http://travis-ci.org/#!/yui/yuidoc)
-   ![](https://secure.travis-ci.org/yui/yeti.png?branch=master) [Yeti](http://travis-ci.org/#!/yui/yeti)
-   ![](https://secure.travis-ci.org/davglass/grover.png?branch=master) [Grover](http://travis-ci.org/#!/davglass/grover)

Here is a small snippet of what our build output looks like (from the [build history for the yui3 repo](http://travis-ci.org/#!/yui/yui3/builds)):

![Travis YUI 3 Build](https://img.skitch.com/20120510-ca63phps6gkw6pmtmrgf6kufd2.jpg)

### What else does it do?

We are trying out the new Travis/GitHub Pull Request feature on all of our projects. This means that whenever a developer submits a Pull Request to us, Travis will automatically pull their code, merge it into master (on their server) and run our full unit test suite against it. Their "Travis Bot" will automatically post a comment back to the Pull Request telling the developer whether or not their patch passed its tests. Here's an example of a Pull Request passing:

![travis bot commenting on a pull request](https://img.skitch.com/20120510-nx9urga4w3pn2mrx1u58erih2c.jpg)

And one where it fails:

![travis bot commenting on a failed pull request](https://img.skitch.com/20120510-d85wxnju6t8f5qx5g1qbfy9rfm.jpg)

### What's next

We plan on adding support for executing our tests with Yeti as soon as it becomes stable enough to run on each build. We are also looking into deploying our code coverage numbers as well. Other than that, feel free to tell us in what other ways we can be more open than we are now. I, for one, am very happy with all of these new features and I hope you are too!