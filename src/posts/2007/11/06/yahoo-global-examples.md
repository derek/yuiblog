---
layout: layouts/post.njk
title: "Using the Yahoo Global Object to Manage Object Inheritance and Composition: Four New YUI Examples"
author: "Unknown"
date: 2007-11-06
slug: "yahoo-global-examples"
permalink: /blog/2007/11/06/yahoo-global-examples/
categories:
  - "Development"
---
![YUI Engineer Luke Smith](/yuiblog/blog-archive/assets/lsmith.png)This morning we posted four new examples that step through some of the most important methods in the YUI Library — particularly `YAHOO.lang.extend,` `YAHOO.lang.augmentObject`, and `YAHOO.lang.augmentProto`. These methods are used internally in the library to manage inheritance and composition, and we think you'll find them useful in your own code, too. This is also a good excuse to introduce you to Luke Smith (pictured), the newest member of the YUI engineering team and the author of this new example set.

-   [**Creating Class Hierarchies with `YAHOO.lang.extend`**](http://developer.yahoo.com/yui/examples/yahoo/yahoo_extend.html) — explores the use of `YAHOO.lang.extend` to build traditional class-style hierarchies in JavaScript;
-   [**Creating a Composition-Based Class Structure Using `YAHOO.lang.augmentProto`**](http://developer.yahoo.com/yui/examples/yahoo/yahoo_augment_proto.html) — as Luke puts it, "the intent of augmentProto is to aid in extracting nonessential behaviors or behaviors shared by many classes, allowing for a composition-style class architecture"; in this example, he shows you how to do that by applying [the YUI Event Utility's](http://developer.yahoo.com/yui/event/) `EventProvider` functionality using `augmentProto`;
-   [**Add Behavior to Objects or Static Classes with `YAHOO.lang.augmentObject`**](http://developer.yahoo.com/yui/examples/yahoo/yahoo_augment_object.html) — `augmentObject` provides functionality similar to that of `augmentProto`, but is designed for work with static classes where you want to confine your augmentation to the target object (rather than its prototype);
-   [**Combining Simple Data Sets with `YAHOO.lang.merge`**](http://developer.yahoo.com/yui/examples/yahoo/yahoo_merge.html) — in a different category, `YAHOO.lang.merge` allows you to combine two objects together, outputting a third (new) object.

Any questions for Luke on these? Post them here, or jump over to [the YUI developer forum](http://tech.groups.yahoo.com/group/ydn-javascript/) and start a thread there.