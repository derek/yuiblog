---
layout: layouts/post.njk
title: "What's New in YUI Test 3.0.0"
author: "Unknown"
date: 2009-12-10
slug: "whats-new-in-yui-test-3"
permalink: /2009/12/10/whats-new-in-yui-test-3/
categories:
  - "Releases"
  - "Development"
---
A new version of [YUI Test](http://developer.yahoo.com/yui/3/yuitest/ "YUI 3: YUI Test") accompanied the release of [YUI 3.0.0](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library"). YUI Test for 3.0.0 is more than just a port of the 2.x-compatible version of YUI Test, however, introducing several new features. These have come about as a result of developer requests and conversations I've had with those already using the tool.

### Promotion of event simulation

Event simulation was originally introduced in the 2.x version of YUI Test via the `YAHOO.util.UserAction` object. As it turned out, developers really liked this functionality and found uses for it outside of the testing environment. As a result, the event simulation tool have been promoted to be a first-class member of the [YUI 3.0.0 Event utility](http://developer.yahoo.com/yui/3/event/ "YUI 3 — Event Utility"), accessible in a single method, `Y.Event.simulate()`. You can include the event simulation component by passing `"event-simulate"` into the `YUI().use()` method:

```
YUI().use("event-simulate", function(Y){
    Y.Event.simulate("#node", "click", 
                     { clientX: 25, clientY: 30});
});
```

### Mock objects

YUI Test for YUI 3.0.0 introduces a new capability: creation of mock objects. Mock objects are useful to isolate your unit tests from dependencies. In complex software systems, there are often any number of pieces that rely on one another. The problem then becomes isolating which part of the system failed when something goes wrong.

For example, suppose you have a method called `logToServer()` that is to create an `XMLHttpRequest` object and send a message to the server. If your test includes the actual XHR object in an attempt to test the functionality, you have two major dependencies: the XHR object itself and the server. If either of these two dependencies fail, then your test fails even though it's not your code that's at fault. By using a mock XHR object, you can test the code in isolation and guarantee that it's working. For example:

```
//create a new mock object
var mockXhr = Y.Mock(); 

//I expect the open() method to be called with the given arguments 
Y.Mock.expect(mockXhr, { 
    method: "open", 
    args: ["get", "/log.php?msg=hi", true]                             
}); 
 
//I expect the send() method to be called with the given arguments 
Y.Mock.expect(mockXhr, { 
    method: "send", 
    args: [null]                             
}); 
 
//now call the function 
logToServer("hi", mockXhr); 
 
//verify the expectations were met 
Y.Mock.verify(mockXhr);
```

This example creates a mock XHR object that is used in place of a regular XHR object. Once all of the operations have been completed, the code verifies that the expected methods that were called. The YUI Test mock object API is purposely minimal to be as clear and useful as possible. To learn more about mock objects in YUI Test, please see the [documentation](http://developer.yahoo.com/yui/3/test/#mockobjects "YUI 3: Test").

### Friendly test names

YUI Test initially used the xUnit-style of test methods whereby each test method's name must begin with `test`. YUI Test for 3.0.0 goes one step further, allowing you to specify friendly test names in additional the xUnit-style names. Friendly names are more sentences than anything else, and the only restriction is that name contains at least one space and the word "should". For example:

```
var testCase = new Y.Test.Case({ 
     
    name: "TestCase Name", 
    
    //xUnit-style test name
    testSomeFunction: function(){
    
    },
    
    //friendly test name
    "Something should happen here" : function () { 
        ... 
    } 
});
```

Friendly test names allow you to describe the functionality being tested in a more readable way. Writing a phrase such as "Method should return 4 when passed 2 and 2", and having that show up in the test results, makes it easier to interpret the test results and what else must be addressed.

### What's next?

YUI Test continues to evolve and grow as feedback is received from developers. There are several features currently in the works:

-   More test result formats, such as JUnit XML and TAP.
-   Code coverage gathering and reporting.
-   Test automation using Selenium.

If you have ideas or feedback, we'd love to hear from you at [YUILibrary.com](http://yuilibrary.com/ "YUI Library :: Home"), where you can [file feature requests](http://yuilibrary.com/projects/yui3/newticket "YUI 3 -- New Ticket Submission") or start a discussion in the [forum](http://yuilibrary.com/forum/ "YUI Library :: Forums :: Index page"). With your help, YUI Test can continue to evolve to meet the needs of the ever-changing web development community.