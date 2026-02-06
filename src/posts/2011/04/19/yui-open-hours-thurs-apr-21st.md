---
layout: layouts/post.njk
title: "YUI: Open Hours Thurs Apr 21st"
author: "Luke Smith"
date: 2011-04-19
slug: "yui-open-hours-thurs-apr-21st"
permalink: /2011/04/19/yui-open-hours-thurs-apr-21st/
categories:
  - "Development"
---
### YUI Remote Loader Service

For a while now, [Reid Burke](http://twitter.com/reid) has been working on a Node.js based service to speed up the process of calculating and requesting module dependencies in YUI 3. He's got it pretty close to buttoned up at this point, and wants to share what he's got and get your ideas for what would make it even awesomer.

### The problem

For a while now we've known that, while really convenient for developers, the `Y.use(_modules_,...)` method introduces an unnecessary delay in the spin up time of your implementation code. It turns out that it's a lot of work calculating dependency trees, and the metadata alone can be burdensome on the overall memory footprint of your page. The traditional method of including the YUI seed file (`yui-min.js`), then bootstrapping with `YUI().use(...)` first tells YUI to load the Loader module—which is saddled with dependency metadata for the entire library in its source—then have Loader calculate the complete list of required modules based on your `use(...)` statement _on the client machine_.

### The solution

The Remote Loader Service moves this calculation to the server, making your code initialize faster and reducing your site's client memory profile because the metadata and Loader are no longer necessary on the client machine. It also serves as the combo handler, returning all the code directly rather than routing through to the yahooapis combo service (less network traffic), **and** is capable of being deployed on a Node.js server on your domain.

The plan is to have Reid demo what's working today, including some pretty impressive stats from its use on [yuilibrary.com](http://yuilibrary.com), then open the call to feedback and requests. Come check out what the future of YUI Loader is looking like!

### Time & Details

We'll be online from **10am to 11am PDT Thursday**. The connection details are the same as usual.

1.  Dial in to 1-888-371-8922 (Skype works great for non-US participants\*)
2.  Enter the attendee code 47188953#
3.  [Join the screen sharing session](https://www.meeting.corp.yahoo.com/r82701271/) (this will prompt you to install the Adobe Connect plugin if this is your first time using it)

\* - If Skype is not an option, email me or catch me (ls\_n) in the #yui IRC channel on freenode for a local number.