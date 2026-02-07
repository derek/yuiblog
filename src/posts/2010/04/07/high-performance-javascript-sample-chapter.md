---
layout: layouts/post.njk
title: "High Performance JavaScript from O'Reilly and Yahoo! Press: Free Chapter on Data Access"
author: "Eric Miraglia"
date: 2010-04-07
slug: "high-performance-javascript-sample-chapter"
permalink: /2010/04/07/high-performance-javascript-sample-chapter/
categories:
  - "Performance"
  - "Development"
---
[![High Performance JavaScript, by Nicholas Zakas (book cover)](/yuiblog/blog-archive/assets/high-performance-javascript-20100403-070804.jpg)](/yuiblog/blog-archive/assets/High_Perf_JavaScr_Ch2.pdf)Nicholas C. Zakas has teamed with a select group of fellow Yahoo! engineers to produce a new volume from O'Reilly and Yahoo! Press on _[High Performance JavaScript](http://www.amazon.com/High-Performance-JavaScript-Nicholas-Zakas/dp/059680279X/ "Amazon.com: High Performance JavaScript (9780596802790): Nicholas C. Zakas: Books")_.

Nicholas's coauthors on the project include Julien Lecomte and Stoyan Stefanov of Yahoo! Search, Ross Harmes of Flickr, and Matt Sweeney from the YUI team. Subjects include DOM scripting performance, algorithms and flow control, strings and regular expressions, Ajax, and performance optimization tools.

Nicholas and the publisher were kind enough to share a sample chapter with us here — [Chapter 2 on "Data Access"](/yuiblog/blog-archive/assets/High_Perf_JavaScr_Ch2.pdf "Data Access, from High Performance JavaScript"). In this chapter, Nicholas begins with a lucid explanation of scope chains in JavaScript and their implications for performance and then looks at different ways of managing data in JavaScript.

> One of the classic computer science problems is determining where data should be stored for optimal reading and writing. Where data is stored is related to how quickly it can be retrieved during code execution. This problem in JavaScript is somewhat simplified because of the small number of options for data storage. Similar to other languages, though, where data is stored can greatly affect how quickly it can be accessed later. There are four basic places from which data can be accessed in JavaScript:
> 
> -   **Literal values**: Any value that represents just itself and isn’t stored in a particular location. Java- Script can represent strings, numbers, Booleans, objects, arrays, functions, regular expressions, and the special values null and undefined as literals.
> -   **Variables**: Any developer-defined location for storing data created by using the var keyword.
> -   **Array items**: A numerically indexed location within a JavaScript Array object.
> -   **Object members**: A string-indexed location within a JavaScript object.
> 
> Each of these data storage locations has a particular cost associated with reading and writing operations involving the data. In most cases, the performance difference be- tween accessing information from a literal value versus a local variable is trivial. Ac- cessing information from array items and object members is more expensive, though exactly which is more expensive depends heavily on the browser.

You can meet Nicholas and his fellow authors on Tuesday, April 13, when they will be [presenting some of their work at a BayJax meetup here at Yahoo!](/yuiblog/2010/04/07/bayjax-april-2010/).