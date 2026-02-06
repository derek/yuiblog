---
layout: layouts/post.njk
title: "Helping the YUI Compressor"
author: "Nicholas Zakas"
date: 2008-02-11
slug: "helping-the-yui-compressor"
permalink: /blog/2008/02/11/helping-the-yui-compressor/
categories:
  - "Development"
---
Julien’s [YUI Compressor](http://developer.yahoo.com/yui/compressor/) is an incredibly useful tool for decreasing the size of your JavaScript files. Since it uses [Rhino](http://www.mozilla.org/rhino/ "Rhino: JavaScript for Java") to parse your JavaScript code, it can perform all kinds of smart operations to save bytes in a completely safe way:

-   Replacement of local variable names with shorter (one, two, or three character) variable names.
-   Replacement of bracket notation with dot notation where possible (i.e. `foo["bar"]` becomes `foo.bar`).
-   Replacement of quoted literal property names where possible (i.e. { `"foo":"bar"` } becomes { `foo:"bar"` } ).
-   Replacement of escaped quotes in strings (i.e. `'aaa\'bbb'` becomes `"aaa’bbb"`).

Running your JavaScript code through YUI Compressor results in tremendous savings by default, but there are things you can do to increase the byte savings even further.

### Use Constants for Repeated Values

In my talk, [Maintainable JavaScript](/yuiblog/blog/2007/05/25/video-zakas/), I talk about using constants (really, just variables that you have no intention of changing) to store repeating values. The idea is that your code is more maintainable because you have a single place to change a value instead of multiple places. As it turns out, this technique also helps YUI Compressor to remove more bytes. Consider the following function:

```
function toggle(element){
    if (YAHOO.util.Dom.hasClass(element, "selected")){
        YAHOO.util.Dom.removeClass(element, "selected");
    } else {
        YAHOO.util.Dom.addClass(element, "selected");
    }
}
```

This simple function is designed to toggle the “selected” class on a given element. If the element has the class, then it’s removed; if the element doesn’t have the class, it’s added. As a result, the string “selected” appears three times in the function. The function takes 212 bytes (including white space). When compressed, the resulting code is as follows:

```
function toggle(A){if(YAHOO.util.Dom.hasClass(A,"selected")){YAHOO.util.Dom.removeClass(A,"selected")}else{YAHOO.util.Dom.addClass(A,"selected")}}

```

This code weighs in at 146 bytes (a savings of 30%), but you can see that the string “selected” still appears three times. Moving the repeated value into a variable makes the code more maintainable and allows YUI Compressor to remove extra space. Here’s the rewritten function:

```
function toggle(element){
    var className = "selected";
    if (YAHOO.util.Dom.hasClass(element, className)){
        YAHOO.util.Dom.removeClass(element, className);
    } else {
        YAHOO.util.Dom.addClass(element, className);
    }
}
```

This code is slightly larger than the original (241 bytes versus 212 bytes), but compresses down to the following:

```
function toggle(A){var B="selected";if(YAHOO.util.Dom.hasClass(A,B)){YAHOO.util.Dom.removeClass(A,B)}else{YAHOO.util.Dom.addClass(A,B)}}

```

Note that this compressed code only has one instance of “selected”, resulting in a final byte size of 136 bytes, 10 bytes fewer than the previous version. The savings grow as the instances of the string increase, so if you have 20 places where “selected” was being used, you’d see even greater savings.

Replacing repeated values in your code can lead to greater incremental savings as the number of repeated values increases, as well. It is worthwhile to consider this approach not just for strings, but also for numbers (even Boolean values, if you so desire).

### Store Local References to Objects/Values

The YUI Compressor can’t perform variable replacement for either global variables or multi-level object references, so it’s better to store these in local variables. The previous example has three instances of YAHOO.util.Dom in the source code, and so the compressed version also has three instances. By storing YAHOO.util.Dom in a local variable, you can reduce the number of times that it appears in the compressed code. For example:

```
function toggle(element){
    var className = "selected";
    var YUD = YAHOO.util.Dom;
    if (YUD.hasClass(element, className)){
        YUD.removeClass(element, className);
    } else {
        YUD.addClass(element, className);
    }
}
```

This version of the function is 238 bytes, and when compressed, shows even greater savings than the previous versions of the function:

```

function toggle(A){var B="selected";var C=YAHOO.util.Dom;if(C.hasClass(A,B)){C.removeClass(A,B)}else{C.addClass(A,B)}}

```

The final weight for this version is 118 bytes, a savings of 28 bytes over the original compressed function and 120 bytes smaller from the uncompressed version. And this is just one function, imagine if you got the same savings for all functions in your script.

Keep in mind that this technique also applies to object properties, so if className were a member of an object, its value should be stored locally as well. For instance:

```
function toggle(element){
    var YUD = YAHOO.util.Dom;
    if (YUD.hasClass(element, Constants.className)){
        YUD.removeClass(element, Constants.className);
    } else {
        YUD.addClass(element, Constants.className);
    }
}
```

In this function, Constants.className contains the class to use. The variable Constants is global, so its name cannot be replaced. You could set up a reference to Constants, but that is inefficient because you’re only using one property of that object in the function, so set up a reference to Constants.className to save even more bytes:

```
function toggle(element){
    var className = Constants.className
    var YUD = YAHOO.util.Dom;
    if (YUD.hasClass(element, className)){
        YUD.removeClass(element, className);
    } else {
        YUD.addClass(element, className);
    }
}
```

### Avoid `eval()`

By this point, you’ve been told that `eval()` is evil multiple times and by multiple people. YUI Compressor agrees. The nature of `eval()` is such that the code executed has access to the variables that are present in the scope in which `eval()` was called. Because of that, YUI Compressor can’t safely do variable name changing when `eval()` is present. For example:

```
function doSomething(code){
    var msg = "hi";
    eval(code);
}

doSomething("alert(msg)");   //”hi”
```

Even though the string that is being passed to `eval()` exists outside of the function in which `eval()` is called, it still has access to the local variables in that function. Since YUI Compressor can’t possibly know that the variable code contains a reference to a variable in the function, it doesn’t change the variable names in the `doSomething()` function, resulting in a less-than-optimal compression. Remember this: any time you use `eval()` in a function, that function’s variables cannot be renamed. The best approach is, as often said, to avoid `eval()` at all costs. If you absolutely must use `eval()` for some reason, try to isolate it away from other code so that the amount of variable renaming issues are minimal. For example:

```
function myEval(code){
    return eval(code);
}

function doSomething(code){
    var msg = “hi”;
    var count= 10;

    myEval(code);
}
```

In this code, the call to `eval()` is isolated away from the main body of the `doSomething()` function. Now, YUI Compressor is free to replace variables in `doSomething()`.

### Avoid `with`

The `with` statement is another that is often [recommended to avoid in JavaScript](/yuiblog/blog/2006/04/11/with-statement-considered-harmful/). For YUI Compressor, the reason is the same for `eval()`: just the presence of `with` in a function causes variable renaming to be skipped for the entire function. There is just no way to keep track of variables versus object properties in the context of a `with` statement, so YUI Compressor rightly leaves the code as-is to avoid breaking the functionality. The best advice here is to avoid using `with` altogether. If you follow the advice of [storing local copies of objects/properties](#store-local-references-to-objects-and-values), you should have no use for `with`.

### Use the Verbose Option

YUI Compressor has a “verbose” option (activated by the `–v` command line switch) that can help in the identification of some of these issues as well as a few others. The verbose option prints out warnings to the console indicating things that are preventing the YUI Compressor from fully doing its job. It will, for instance, tell you that a function contains `eval()` or the `with` statement, and therefore cannot be properly compressed. It also does analysis of variables, telling you if a variable was never defined (in which case it becomes global and cannot have its name replaced), if a variable was defined and never used (which just wastes space), and if a variable has been declared multiple times (also a waste of space).

### Conclusion

When used alone, the [YUI Compressor](http://developer.yahoo.com/yui/compressor) achieves an excellent compression rate of your JavaScript code. The greatest byte savings are achieved by taking full advantage of variable replacement. The hints presented here have the primary goal of ensuring the YUI Compressor can do variable replacement whenever possible. Using constants to represent repeated values not only aids in compression, but also aids in the maintainability of your code by limited the number of areas that must be updated to accommodate a change in the value. Using local variables for multi-level object references allows for greater compression through variable replacement as well as providing faster runtime performance (local variable access is faster than global variable access and object property lookup). Perhaps most important is to ensure that you don’t use `eval()` or `with` when they’re not necessary, as each causes variable replacement to be turned off in the containing function. The YUI Compressor does a lot for you, but it can’t do everything. You can help it out greatly by following these tips.