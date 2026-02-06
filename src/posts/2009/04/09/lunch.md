---
layout: layouts/post.njk
title: "Implementation Focus: Lunch.com"
author: "Eric Miraglia"
date: 2009-04-09
slug: "lunch"
permalink: /blog/2009/04/09/lunch/
categories:
  - "YUI Implementations"
---
### Special invite to Lunch's private beta for YUIBlog readers:

-   Go to [http://www.lunch.com](http://www.lunch.com).
-   On the right-hand side of the screen in the Get an Invite! box is a "Have an invite code?" message. Click on the _click here_ link.
-   Enter the Invite Code _YUIBlog_ and a valid email address. Click Submit.
-   Lunch.com will immediately send you a confirmation email.
-   Open that email and click on the confirmation link.
-   Sign into Lunch.com.

[![Lunch.com, a new online community based on the premise that the most useful information comes from people who share your interests, tastes and point of view.](/yuiblog/blog-archive/assets/lunch-main-20090403-175746.jpg)](http://www.lunch.com/)

**Design and interface quality are huge differentiators for startups. What are the strengths you wanted to build around in the Lunch.com interface?**

At Lunch, our strengths are the community's ability to contribute both facts and opinions about almost everything and our Similarity Network which, based on site interactions, connects each person to others who share similar interests, opinions, and ideas. To clearly deliver and communicate to the user it is important for the interface to be clean and easy to understand.

**You chose YUI's JavaScript library to help drive the UI. What led you to make that choice?**

We selected YUI for a number of reasons.

First and foremost, we felt that Yahoo's commitment to this technology gave a significant advantage in the areas of test coverage, maintenance, and longevity. Standard open source frameworks have the potential hazard of falling into the "flavor of the day" category, where there is an initial surge of enthusiasm that can quickly be abandoned for the "next big thing." We wanted a framework that was going to have a lasting presence.

Secondly, we were impressed by YUI's architecture. The quality and modularity of the interface is impressive. Clearly, there is a concern for keeping the interface clean, whereas other frameworks have a tendency to become bloated over time. Yahoo's architectural shepherding of the interface gives it a better chance of staying slim, usable, and maintainable over the long haul.

Thirdly, we found the [documentation](http://developer.yahoo.com/yui/) and supporting resources to be very helpful. The number of [examples](http://developer.yahoo.com/yui/examples/) and easily navigated Web site facilitate a short learning curve and rapid development. We also appreciated the wealth of JavaScript information available from the [YUI Theater](http://developer.yahoo.com/yui/theater/).

Finally, we found the [YUI blog](/blog-archive/) to be a robust source of tutorial information and the [YUI discussion forum](http://tech.groups.yahoo.com/group/ydn-javascript/) to be a vibrant community of helpful implementers willing to share their knowledge and address issues. We didn't want to feel like we were "on our own" when problems arose.

All of these reasons led us to choose YUI and we have not been disappointed.

**What YUI components are in use on the site?**

[Yahoo](http://developer.yahoo.com/yui/yahoo/), [Dom](http://developer.yahoo.com/yui/dom/), [Event](http://developer.yahoo.com/yui/event/), [Connection Manager](http://developer.yahoo.com/yui/connection/), [Get](http://developer.yahoo.com/yui/get/), [JSON](http://developer.yahoo.com/yui/json/), [Animation](http://developer.yahoo.com/yui/animation/), [Container](http://developer.yahoo.com/yui/container/), [AutoComplete](http://developer.yahoo.com/yui/autocomplete/), [ImageCropper](http://developer.yahoo.com/yui/imagecropper/), [TabView](http://developer.yahoo.com/yui/tabview/), and [OverlayManager](http://developer.yahoo.com/yui/examples/container/overlaymanager.html).

[![The Lunch.com UI, employing YUI overlays for contextual popups in the ExhiliRATE feature.](/yuiblog/blog-archive/assets/lunch-ui-20090403-180038.jpg)](http://www.lunch.com/)

**What's next for the interface of Lunch.com in coming releases?**

Currently we are in private beta but we will be opening it up in the next few weeks. Our goals for the interface, are to continue to optimize the experience for both existing community members and for people just looking to gain knowledge or insight into specific areas of interest. As we move from the closed beta to an open beta it is important that new visitors can understand the value of Lunch and easily jump in and start getting personalized information based on their interests. Creating those easy on-ramps and access points that can engage and drive adoption will be the key priorities moving forward.