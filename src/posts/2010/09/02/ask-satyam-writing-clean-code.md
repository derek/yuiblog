---
layout: layouts/post.njk
title: "Ask Satyam: Writing Clean, Debuggable Code"
author: "Satyam"
date: 2010-09-02
slug: "ask-satyam-writing-clean-code"
permalink: /2010/09/02/ask-satyam-writing-clean-code/
categories:
  - "Development"
---
> [![](/yuiblog/blog-archive/assets/satyam-book-small-20100809-120823.jpg)](https://www.packtpub.com/yahoo-user-interface-yui-2-8-learning-library/book)Satyam (a.k.a Daniel Barreiro) is a long-time YUI contributor and one of the most prolific, generous experts in the [YUI forums](http://yuilibrary.com/forum/ "YUI Library :: Forums :: Index page"). He is also [the author of a new book on YUI 2.8.0, _YUI 2.8.0: Learning the Library_](https://www.packtpub.com/yahoo-user-interface-yui-2-8-learning-library/book). This article in the "Ask Satyam" series [was suggested by JoeDev](/yuiblog/blog/2010/07/29/ask-satyam/#comment-593089 "Ask Satyam — and Be Eligible for a Free Copy of the New YUI 2.8 Book from Packt » Yahoo! User Interface Blog (YUIBlog)"). While its focus (like the focus of the new book) is mostly on YUI 2, many of the practices described here are applicable to YUI 3 as well — and to frontend development in general, regardless of your library of choice.

Before posting a question [in the YUI Library forums](http://yuilibrary.com/forum/ "YUI Library :: Forums :: Index page"), there are plenty of things you can do by yourself and, if you have your tools handy, you may find your answer all by yourself in no time. Besides, clean code is robust code, much less likely to break when subjected to stress. Good practices not only avoid fatal errors (the kind that drive you to the IRC channel or forums in search of help), but they surface warnings about minor errors and help you stay away from the fatal edge.

In this article, I'm going to take a look at some of those best practices. Some of these are specific to developing with [YUI](http://developer.yahoo.com/yui/ "YUI Library"), but the vast majority apply to frontend development regardless of your choice of Ajax library.

### JSLint

A trip through [JSLint](http://www.jslint.com/) is part of the build process for YUI. JSLint, itself fully written in JavaScript, is like a compiler but without code generation. It will, however, produce many of the useful error messages and warnings that a compiler would. A browser's JavaScript interpreter forgives many errors and assumes defaults you might be unaware of; JSLint forgives little, and it points you to better choices in your program. [![Yahoo! Widget for JSLint](/yuiblog/blog-archive/assets/JSLintYahooWidget-20100827-130355.jpg)](http://widgets.yahoo.com/widgets/jslint-1 "JSLint - Yahoo! Widgets")JSLint is available in many formats; the [YUI Builder tool](http://yuilibrary.com/projects/builder "YUI Build Tool :: YUI Library") uses it as a standalone command line application, but you can also integrate it into Eclipse or whatever IDE or more-or-less capable editor you use — there is even a [Yahoo! Widget for JSLint](http://widgets.yahoo.com/widgets/jslint-1 "JSLint - Yahoo! Widgets").

If the zillion lines of code in the YUI library can go through JSLint with no errors and few warnings (it can't avoid a few things), so should your code. I find JSLint very helpful when I'm tired. Bean counting in the late evening is a waste of time; you are likely to miss the most obvious errors. JSLint doesn't care what time of the day it is and will point you straight to that mismatched curly bracket or misspelled variable that's at the root of the problem.

JSLint is most helpful if you keep your code clean from the start. If you've never used JSLint before and try it out on an application that is already hundreds of lines long, it will flood you with so many warnings that it will feel that it hampers your job more than it helps. However, that only happens the first few times. Once you learn to stay away from bad coding practices, JSLint diagnostics will be few and straight to the point; your real error, the one that's driving you nuts, will clearly stand out. In the meantime, JSLint will teach you to make your code safe and robust.

So, don't wait for a tough error to show up. If you have never used JSLint, try it with what you believe to be good code, it might not be as good as you assumed. As [Douglas Crockford](/yuiblog/crockford/ "Crockford on JavaScript: A Public Lecture Series at Yahoo!") (author of JSLint) says, "JSLint will hurt your feelings." But that's a small price to pay for better code.

### Global and unused variables

One of the things JSLint will warn you about is the use of global variables. There should be no global variables except those you know about, such as the ones created automatically like `window` or `document` and those for the libraries you are using such as `YAHOO` (in [YUI 2](http://developer.yahoo.com/yui/2/ "YUI 2 — Yahoo! User Interface Library")) or `YUI` (in [YUI 3](http://developer.yahoo.com/yui/3/ "YUI 3 — Yahoo! User Interface Library")). You may also want to create a single global for your own namespace.

[Global variables are dangerous](/yuiblog/blog/2006/06/01/global-domination/ "Global Domination » Yahoo! User Interface Blog (YUIBlog)"), and there are usually more of them than you'd expect; moreover, "extras" such as mashups and banners might add more of them. Since the `window` HTML DOM namespace can be omitted from compound names, `window.name`, `window.length` and `window.location` become the global variables `name`, `length` and `location`. Have you never used such variable names in your code? I don't mean in their HTML DOM sense but as everyday field names in a table — like the _name_ of a person, the _length_ of an object or the _location_ of a book on the shelf. What if you use those variables without declaring them? You might assume that `length` is initially `undefined` but, in fact, if you don't declare your own local copy of it (and initialize it), `length` will be a reference to `window.length`. And if you assign something to `location`, you might accidentally cause your user to navigate away from the current page. Here, I am just giving examples of possible collisions with the browser's built-in variables, but if you start adding libraries from other sources, the chance for collisions increases. The JavaScript syntax highlighter used in YUI's examples uses the global variable `dp` as its root and the number of global variables any Google script might add when you insert a map or other tool in your page is impolite, to say the least.

It's not merely that you want to step lightly with respect to other people's variables — by staying out of the global namespace, you reduce the risk that they will step on yours (or that you'll step on your own). With asynchronous threads weaving themselves around each other, as is often the case in modern JavaScript applications, you can't really be sure the order in which your various pieces of code will execute and what global variable will be left at what value by whom. The only sane approach is to avoid them whenever possible.

Global variables might also point to a typo. If you have a global variable you didn't mean to have and you have an unused variable with a similar name, you might have misspelled one of them: that is, you may have declared it with one name and used it with another different spelling. It can also mean that you have declared it after you have used it, which means that at execution time you might find your variable not initialized as you would have expected.

### Using `this`

Using `this` is often troublesome for beginners because it's easy to lose track of where we are in the scope chain. Until we get some practice, keeping track of scope can be an issue. Also, developing a coding style and a structure for the application helps greatly; after all, it's all about knowing where you place things. If you learn to organize your code consistently and store state in logical places (`this` points to one such place), information in your program will be easy find. Any debugger will show you what `this` points to at each step. It's always a good thing to check first if `this` is referencing the object you expect. A lot of times when we have a bug, it's be because `this` is pointing to `window`. There are several situations that can produce this result.

If we have a method with an inner function, when we call that inner function it won't get the scope of the caller but rather that of `window`. This example shows that the inner function doesn't share the scope of the method within which it is contained:

```
var someObject = {
    outerFunction: function () {
        console.log('outer',this); // prints outer Object {}
        var innerFunction = function () {
            console.log('inner',this);// prints inner Window 
        };
        innerFunction();
    }
};
someObject.outerFunction();
```

There are a couple of ways to fix this. In this example, we ask JavaScript to correct the scope using `call()`:

```
var someObject = {
    outerFunction: function () {
        console.log('outer',this); // prints outer Object {}
        var innerFunction = function () {
            console.log('inner',this); // prints inner Object {}
        };
        innerFunction.call(this);
    }
};
someObject.outerFunction();
```

In the next example, we take advantage of the ability for inner functions to share the variables of containing functions. We create a variable `self` which we initialize to the value of `this` in the outer function. We can then use `self` in the inner function to refer to the outer function:

```
var someObject = {
    outerFunction: function () {
        console.log('outer',this); // prints outer Object {}
        var self = this; 
        var innerFunction = function () {
            console.log('inner',self); // prints inner Object {}
        };
        innerFunction();
    }
};
someObject.outerFunction();   
```

Finally, with events, the scope of the listener is that of the element to which the listener is attached:

```
var someObject = {
    outerFunction: function () {
        console.log('outer',this); // prints outer Object {}
        YAHOO.util.Event.on('button','click',function () {
            console.log('inner',this); // prints inner <button id="button"> 
        });
    }
};
someObject.outerFunction();
```

Unless we adjust the scope of the listener when setting it up

```
var someObject = {
    outerFunction: function () {
        console.log('outer',this); // prints outer Object {}
        YAHOO.util.Event.on('button','click',function () {
            console.log('inner',this); // prints inner Object {} 
        },this,true);
    }
};
someObject.outerFunction();
```

This also applies to YUI components. If we listen to a click event on a DataTable cell, a TreeView node or a MenuItem, the scope of the listeners will be those of the YUI component instance that owns the event — unless it is explicitly set otherwise.

### Sandboxes for applications

Another good way to keep your code clean is to start with a clean skeleton. The style of coding JavaScript applications has changed over time. Nowadays, most developers use two different styles: one for applications and one for library components. Most YUI 2 examples reflect the old style, where we used `YAHOO.namespace` to create a namespace for our own code.

Nowadays, for our applications, we mostly use a single sandbox declared within the scope of an anonymous function that executes `onDOMReady`:

```
YAHOO.util.Event.onDOMReady(function() {
    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event,
        Lang = YAHOO.lang;
 
    var yourVariable = initialValue,
        moreOfTheSame = otherInitialValue;
    
    var myFunction1 = function ( …) {
        // body of function;
    };
    var myFunction2 = function (… ) {
        // body of function;
    };
    ...
});
```

This technique has several benefits.

1.  We check for the readiness of the DOM right from the start, ensuring that all the pieces of HTML that we might want to manipulate are present and safe to use.
2.  The function provided to `onDOMReady` is not wasted at all; it's the container of the sandbox and, because it's anonymous, it does not pollute the global namespace.
3.  We immediately start defining our variables, including aliases or short names for our most often-used objects. This has several other advantages of its own:
    1.  We save some typing
    2.  The YUI Compressor can compress our short names, whereas it cannot compress a global name like `YAHOO` or its properties such as `util` or `Menu` no matter how deep they might be. If they are anchored in a global name such as `YAHOO`, the whole branch is untouchable. Thus our already short names `Dom`, `Event` and `Lang` might be further reduced to `A`, `B` and `C` when Compressor is run at build time.
    3.  The interpreter does not need to resolve over and over again the long names. Each dot in a name such as `YAHOO.util.Event.onDOMReady` is time consumed in a symbol table look up.
    4.  All variables will be available anywhere inside this anonymous function, even to functions defined within, unless a variable of the same name was defined in them. Basically, it is as if a sub-global environment has been defined within, and all variables there will be available anywhere just by name.
    5.  For the variables in the sandbox we don't need to use `**this**`, which gives us such headaches when using traditional OOP technique of making even the main function an object.
4.  We define our functions. We can do this with the `var` statement, as I did above or the `function` statement; there is a subtle difference but it is mostly irrelevant. I use the `var` statement to highlight that they are just as accessible as the other variables: we can access them anywhere in the sandbox.
    

Of course this relies on the ability of JavaScript to allow us to define functions within functions and on the fact that the inner functions have access to all the variables defined in the outer function. Basically, each function you define creates a new local environment accessible to any further functions within.

Sandboxing is the standard way of doing things in YUI 3:

```
YUI().use('module1', … , function (Y) {
    // This is the sandbox
});
```

### Namespaces for libraries

While the sandboxing technique is great for final applications, it's not good for libraries. What happens in the sandbox stays in the sandbox, completely invisible to the outside world. However, when you define a library utility or component of your own, you want to re-use it, so it needs to be globally accessible (which is not the same as being purely global). Anything you define under `YAHOO.example` — e.g., `YAHOO.example.myUtility` — is globally accessible. You can access it by its full name once it has been defined. `myUtility`, as a member of the global `YAHOO`, is not global but it is globally accessible.

When we build libraries, we usually use the sandbox for our code and namespacing for sharing, like this:

```
(function () {
    var MyClass = function () {
        // this would be the constructor
    };
    MyClass.prototype = {
        // properties and methods 
    };
    YAHOO.namespace('MyLibrary');
    YAHOO.MyLibrary.MyClass = MyClass
})();
```

We create a sandbox by defining everything within an anonymous function, which we immediately execute (see all those parenthesis there?, they mean 'take the result of defining this function and execute it'). Here, we don't wait for the DOM to be ready; libraries seldom do, since the application that uses them is responsible to check that everything is in place. Within the sandbox, we have the same advantages as with the previous sandbox. We can define short names for anything we use often, even for the class we are defining: none of them will be visible outside. Then, to make it globally accessible, we create a namespace of our own and place our recently created class in it.

### YUI Logger

Let's say we have our code nice and clean, with no JSLint errors or warnings, but we still have problems to debug. YUI can be helpful in telling us what's wrong. For production code, we will usually load the minified versions of the YUI components, but there are also two other versions. The \-debug.js version is the one that can help us uncover problems. For example, we might be using Dom Collection's method `setStyle` to, lets say, change the color of a block of text. The change doesn't happen and we can't find what's wrong. The file dom-debug.js has this helpful line, which is deleted in the `-min` version:

```
YAHOO.log('element ' + el + ' is undefined', 'error', 'Dom');
```

This is executed when `setStyle` tries to locate the element to be styled and does not find it. The error message will probably show a misspelled element id or some such error that is so hard to pick after a long day of staring at the same code.

It's easy to get the logger up and running; you just need to [include its files](http://developer.yahoo.com/yui/articles/hosting/?logger&MIN&loadOptional&norollup "YUI 2: Dependency Configurator"):

```
<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.8.1/build/logger/assets/skins/sam/logger.css">
<script src="http://yui.yahooapis.com/2.8.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script src="http://yui.yahooapis.com/2.8.1/build/dragdrop/dragdrop-min.js"></script>
<script src="http://yui.yahooapis.com/2.8.1/build/logger/logger-min.js"></script>
```

The basic `yahoo-dom-event` aggregate is most likely to be there already while the Drag & Drop optional dependency is handy to move the logger window out of the way. Then, just add:

```
var myLogReader = new YAHOO.widget.LogReader();
```

Then, it's a matter of loading the `-debug` versions of the component files and all the messages they produce will be shown. The amount of information can be overwhelming so, it is wise not to load all `-debug` versions at once. The Logger can also filter the information it displays and you may uncheck the Info category of messages to concentrate on Warn and Fail. The filters do not affect what is logged, only what is shown; Logger logs all messages, regardless of whether the LogReader displays them or not. There is only one message queue per application and logging will start as soon as the Logger component file is loaded, it doesn't matter whether it is shown or not.

Another power-user strategy for YUI debugging with the Logger Control is to take advantage of Logger's ability to leverage the browser's console (in supported browsers):

```
YAHOO.widget.Logger.enableBrowserConsole();
```

With this line of code, you can pipe all Logger messages to the browser console, which is a natural part of your workflow in development in any case.

The only tedious thing about the Logger is remembering to change the component files from the minified, aggregates and combos to the `-debug` versions. In this, as always, the [Dependency Configurator](http://developer.yahoo.com/yui/articles/hosting/) is a great help; click on the `-debug` button on the top left and it will produce the correct list of files.

And, now that I've mentioned it:

### Check your dependencies

It's a good idea when you start with YUI to pick an example that closely resembles what you want to do and modify it. As you add more features, you take bits and pieces from other examples and incorporate them into your developing application. One frequent source of problems are the dependencies. Many people paste the dependency files of each and every example into their application, duplicating some of them over and over again. Missing, duplicate or out of order dependencies might produce unexpected errors. Not having the YAHOO Global Object loaded before anything else is most certainly going to be fatal. At any rate, loading something twice will certainly increase the time it takes your page to load.

Finally, if you are using your own servers to load the YUI library, you might have the base path for your copy of the library wrong. If you have Firebug, go to the Net tab and check that there are no lines in red. Those would mean that a requested resource could not be found.

### Debugging

The Firebug add-on for Firefox is still the best debugger around, plus it is free. By default, when the debugger is activated the "Break on all errors" option is on, which means that Firebug will stop at the point where it finds an error and show the error message and source code. Some of those errors will be the same that JSLint would have diagnosed, so JSLint is still the first place to start — especially because Firebug can only signal one error on each run while JSLint can signal them all at once. Some errors will only show up at runtime, so the debugger is the only option. Whenever you get to such a break, the first thing to check is `this`, a four-letter word of the trickiest sort.

When using a sandbox, debuggers will usually show local variables and arguments, but they will not normally offer to show the variables in containing functions, such as those declared in the sandbox and used from within the inner functions. The debugger will be able to show their value if you explicitly ask for them by name, but it will not show them automatically. Another alternative is to make them globally accessible. For example, since `YAHOO.example` is always available (when YUI 2 is on the page), if you want to keep an eye on a certain component at all times you can simply copy it there:

```
var myTree = new YAHOO.widget.TreeView('tree-container');
YAHOO.example.myTree = myTree;
```

We add the last assignment while debugging so we can keep an eye on the TreeView instance while debugging since `myTree` would normally be within the sandbox and invisible elsewhere.

### Don't use members starting with underscore

Many people use the debugger to look for the names of variables or properties holding the information they need. Sometimes that information is stored in properties starting with an underscore, like `_nodes`. By convention, those are _private_ properties, not for general use. JavaScript enforces no true concept of private or protected members; thus the leading underscore is the conventional way to signal the intent of the class developer to keep that property private. These properties can present a temptation (after all, you can see them there in the debugger), but there are a couple of good reasons why it is not wise to use them in your programs.

First, only public interfaces are supported. Since you are not supposed to use a property starting with an underscore, the class developer is free to change it at any time. The developer should have provided some public mechanism to access this same value; for example, a `_nodes` private property might have a `getNodes()` method or a `nodes` configuration attribute. Either of these would be the public interface to that same value. The second reason not to use properties with leading underscores is that their accessors might need to produce a secondary effect which accessing the private property would completely bypass. The component would then be left in an inconsistent, fragile state.

So, if you are using the debugger to look for a value and you find it in a property starting with a leading underscore, don't use it. Go instead to the API docs and look in the Methods index for some `getXxxx()` method with a similar name or in the Configuration Attributes index. Avoid using private variables.

### Stack Traces

The YUI library is robust and reliable. If the debugger breaks within the YUI library, it's more likely that it is because of an error induced by your code that by some failure in YUI itself. JavaScript was designed to carry on, always coping with errors as best as possible. The YUI library does likewise. The `-debug` versions will have extra checks and will emit diagnostic messages, but they are all stripped out in the minified versions. If you see an error in a YUI file it is likely that it got there out of pure stubbornness, but don't try to find the error there. When the debugger stops it is not because it has found the cause of the error but because the JavaScript interpreter can no longer carry on.

Breaks in minified files are not helpful, if you get a message such as...

```
F is not an object in line 7 of dom-min.js
```

...it is pointless to ask in the forum about it. First of all, `F` is an alias generated by YUI Compressor to replace a longer, descriptive variable name in the original uncompressed file; secondly, the first few lines of a component file are usually taken by the copyright notice, which the YUI Compressor always respects. And since the YUI Compressor also deletes all new-line characters, as it does with other white space, all the executable code in `dom-min.js` is in lines 7, 8 and 9 — so the line number doesn't say much either.

That is when the Stack Trace tab in the right sub-panel of the Script tab of Firebug (or wherever you can find the stack trace in your debugger) comes handy. It tells you how you got there. Here is a screen capture from Firebug:

![Firebug's Script tab.](/yuiblog/blog-archive/assets/asksatyam3-stack-20100902-080216.jpg)

The item on top of the right panel, `createEvent()`, is the name of the function where the current statement is; the one below is the place where `createEvent()` was called; the one below that the function that called the previous one; and so on. Most debuggers will let you select any of those trace points and see how you got to where you are. Firebug also lets you check the value of the variables at each of the trace points. We can see in the left subpanel the yellow arrow pointing to `createEvent()`. We got lucky this time, as it will always point to the line containing the offending code, but that code might be anywhere within that line; fortunately, `createEvent()`happens to be at the beginning of the line. See the variables and arguments? `B`, `G`, `L`...there is no guessing what the original names could have been, as this is the YUI Compressor at work. However, note that `YAHOO` is untouched and the copyright notices are preserved.

You might not recognize many of the names in the stack trace, as they might be functions within functions within the YUI library itself. Eventually, you might see function names you recognize. In this image, I know `showAlbums`, which calls the constructor for the `REDT` class (which is code I wrote). I don't have a clue about anything else. That's where I will go looking...to the ones I know.

If you are not sure, you can go through the full list. If you see compressed code (assuming you have not compressed your own yet), simply ignore it, or switch to the non-minified version of the YUI source files. But focus primarily on those names you recognize that belong to your own code. Note that Firebug uses `(?)()` for traces it cannot name. Usually, your code in the sandbox will be signaled that way since the sandbox is contained in an anonymous function. At any such point in your trace, check the values of the variables you provided as arguments; some of them might not be what you assumed. Check them against the API docs to see if it is a valid argument value.

If the argument and variable values you see are inconclusive, at least you can place a breakpoint right before your code calls the YUI component. You might then be able to see how you got into the mess.

Stack traces are often ignored by developers but with JavaScript's tendency to keep digging itself into an ever deeper hole as it tries to carry on, it is good to be able to come up to the surface to look around. As with all debugging techniques, it might not always work, but it is nice to know it is there. Let's be honest, if you have read this far, you know what desperation is.

### Asynchronous calls

A lot of the interactivity that characterizes Web2.0 apps is based on the ability to handle asynchronous events. In contrast with the original style of web applications, where every interaction involved waiting for a new page to be delivered from the server, the modern interactive applications involve setting things up and listening for any of several possible events to happen...and then responding to those events. We set listeners for clicks or keystrokes and or other programmatic events; these are usually intuitive. Asynchronous calls and their callbacks, however, often are harder to understand.

The most common error I see in implementations on the forums is to place code right after an asynchronous call such as Connection Manager's `asyncRequest()`or DataSource's `sendRequest()` methods, assuming that such code will be executed when the operation is completed. When you call such a function, you are just priming the operation, not executing it in full. No data will be available after the call to the async method. Only the request for such data would have been produced so far. The server must receive it and process it, and the reply (if it ever comes) is still off in the future. That is why for such asynchronous operations we use callback functions.

A callback is like the function we assign as a listener for an event such as a click on a button in a form; when the user clicks, the listener gets called. The callback on a asynchronous event is very much like this; just as we send a form for a user to fill in, we send a request message to the server, and just as we wait for the filled-in form to be submitted back to our program, we wait for the reply sent by the server to come back to us. We cannot know when the user will submit the form or the server send the reply; that's why we set what for a user action we call an event listener and for an asynchronous event we call a callback function. It might seem the server reply is fast if not instantaneous, but it means ages in CPU time.

### Debugging asynchronous calls

Sometimes there is no alternative but to single-step through the code. Be careful when you get to asynchronous calls such as Connection Manager's `asyncRequest()` method, DataSource's `sendRequest()` or DOM's `window.setTimeout()`. These start an asynchronous request for data against the server or delay some action a given time and their callbacks get called when the data has been received or the time has elapsed. There are two issues to consider; first, the debugger won't step into the callback automatically. If you want to catch up with the reply, you have to put a breakpoint inside the callback function. Lots of people reach the point of calling the asynchronous method and expect the single-stepping to resume within the callback when the async operation is finished. This will not happen; the thread of execution does not flow automatically into the callback, and the debugger cannot be expected to figure that one out.

Second, when you reach the line with the asynchronous call, put the breakpoint in the callback and then let the application run. Usually, whatever goes after the async call is not really important; in fact, the async call is normally at the end of a function, since there isn't much to do until the reply arrives. Don't single-step over the async call, because the debugger will keep the JavaScript interpreter on hold and, when the reply arrives or the time lapses, it will be missed since the interpreter was frozen and unable to handle it. So, if you were clicking on Step Over, when you get to the async call, make sure you have the breakpoint in the callback and then click Run so the JavaScript interpreter is active and able to handle the reply.

For repetitive events such as callbacks to `window.setInterval()` or other time-critical operations, it is better not to put breakpoints in them. While you are on hold, many events will be missed. It is usually better to use `console.log` or the YUI Logger to simply signal that the event is happening and show a few critical values. Don't use `window.alert()` for the same reason; it puts a hold on the browser and the events you care about will be missed.

### Conclusion

There are many tools to help us find out what is happening in our programs. With the proper tools at hand, we can find an error in less time than what it takes us to write a question in the forums. The first step, however, is to write good and reliable code and make JSLint an integral part of your development process.