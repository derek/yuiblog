---
layout: layouts/post.njk
title: "Implementation Focus: Notifu"
author: "Eric Miraglia"
date: 2008-11-13
slug: "notifu"
permalink: /blog/2008/11/13/notifu/
categories:
  - "YUI Implementations"
---
**[Notifu](http://www.notifu.com) is a "group messaging service." How does Notifu go beyond traditional messaging services like email, IM, and SMS?**

There are four key differences from traditional email, IM, and SMS...

-   **Integration**: Notifu allows you to send the same message to multiple recipients via email, IM, and SMS. So, you might send a message like "Let's move the meeting from 3pm to 4pm today" to Bob via email, Jim via Yahoo IM, Sarah via SMS, and Mark via voice phone.
-   **Delivery Confirmation**: Notifu can ask the users to acknowledge receipt of the message so the sender can know exactly who did and who did not receive the message.
-   **Escalations**: Notifu allows you to define alternative means to deliver a message to an individual. So, you might send a message "Please call me ASAP. 1 - Got it" to Mark first by email, then by IM, then by SMS, and then by home phone. The escalation automatically stops trying alternative addresses when Mark acknowledges receiving the message.
-   **Polling**: Notifu allows you to optionally define a response menu when you send a message allowing you to make quick group decisions. So, you might send a message like "Which live chat solution did you want to choose? 1 - Boldchat or 2 - Liveperson" and Notifu will tally the responses instantly to make your group decisions.

[![Notifu screenshot -- sending new messages.](/yuiblog/blog-archive/assets/notifu.png)](http://www.notifu.com)

**The registration path and some of the core interactions happen within a small canvas that employs lateral animations to move from pane to pane, similar to the way a typical iPhone application works. What was the inspiration for this design? What made you choose it for the app you deploy to big-screen browsers?**

Notifu has been designed as a widget that we plan to release across popular social and mobile platforms. As a widget, we designed Notifu to work within a limited amount of space.

Notifu does also leverage a side scrolling paradigm which we think is both a unique look and feel for a widget and an effective means to navigate pages. There is an obvious similarity to the iPhone user interface. What can we say...we love the iPhone user interface as well.

**You've employed [YUI Animation](http://developer.yahoo.com/yui/animation/) to handle the transitions, [Connection Manager](http://developer.yahoo.com/yui/connection/) to do your Ajax data transport, and other YUI components in other parts of your app. Tell us a little bit more about the role YUI plays in the Notifu frontend.**

YUI plays a critical role in the Notifu UI where we leverage...

-   [YUI Animation](http://developer.yahoo.com/yui/animation/) to do the side scrolling page transitions, the fade-in inserts as you add more To recipients to the Send New Message page, and the animated expand/collapse of messages within the View Messages page.
-   [YUI Connection Manager](http://developer.yahoo.com/yui/connection/) is used to make all the asynchronous calls to the Notifu server to send messages, add/edit/delete contacts, mark replies as read, etc.
-   [YUI Dom Collection](http://developer.yahoo.com/yui/dom/) and [YUI Selector](http://developer.yahoo.com/yui/selector/) are used extensively in the plumbing to retrieve and manipulate elements on each page.

**What aspects of your YUI implementation are you most proud of?**

I scanned our client code for a snippet that I thought would be the most interesting to share. This snippet inserts a new item in a list by doing a chained animation (first making the vertical space for the item and then fading in the item).

```
<html>

<head>
<!-- Combo-handled YUI JS files: --> 
<script type="text/javascript" src="http://yui.yahooapis.com/combo?
2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&2.6.0/build/animation/
animation-min.js"></script> 
</head>

<body>

<ul id='my-list'>
<li>Existing Item</li>
</ul>

<br/>

<a href="#" onClick="return addItem(event);">Add Item</a>

<script>
function addItem(event) {
	// Get the list element
	var ulElement = YAHOO.util.Dom.get('my-list');

	// Create and append an li element
	var liElement = document.createElement('li');
	YAHOO.util.Dom.setStyle(liElement, 'overflow', 'hidden');
	YAHOO.util.Dom.setStyle(liElement, 'height', '0px');
	YAHOO.util.Dom.setStyle(liElement, 'opacity', '0.0');
	ulElement.appendChild(liElement);

	// Create and append a div element
	var divElement = document.createElement('div');
	divElement.innerHTML = 'Hello World';
	liElement.appendChild(divElement);

	// Determine size of div
	var region = YAHOO.util.Dom.getRegion(divElement);
	var height = region.bottom - region.top;

	// Setup animations
	var animInsert = new YAHOO.util.Anim(liElement, {
		height: {
			from: 0,
			to: height
		}
	}, 0.4);

	var animFadeIn = new YAHOO.util.Anim(liElement, {
		opacity: {
			from: 0.0,
			to: 1.0
		}
	}, 0.8);

	animInsert.onComplete.subscribe(function() {
		YAHOO.util.Dom.setStyle(liElement, 'height', '');
		YAHOO.util.Dom.setStyle(liElement, 'overflow', '');
		animFadeIn.animate();
	});
	animFadeIn.onComplete.subscribe(function() {
		YAHOO.util.Dom.setStyle(liElement, 'filter', '');
	});

	// Do it
	animInsert.animate();
}
</script>

</body>
</html>

```

**What were the best and worst aspects of working with YUI on this project? Any frustrations?**

The best part is that YUI always works well across all major browsers saving us a lot of potential time tweaking javascript across browsers. It was important to us to be able to support all the major browsers IE 6/7, FF 2/3, Safari, Chrome, and Opera.

After writing javascript code and using JSLint to verify it, there is normally very little time needed to tweak functionality across the major browsers using YUI (wish the same could be said though for layout/CSS issues which does often involve significant tweaking across browsers).

The long YUI namespaces still trip me up from time to time. I refer back to the YUI documentation frequently just to get the right YUI namespace (is it `YUI.lang.Dom.get()` or `YUI.util.Dom.get()`?). I realize we could create aliases for the long YUI namespaces but this seems like clutter to me.

**What are the next challenges you intend to tackle as you evolve Notifu?**

We just launched Notifu on 10/29/2008 as a public beta and have big plans going forward including...

-   Implementing Notifu as a widget across popular social and mobile platforms (like OpenSocial for example)
-   Adding the ability to receive message updates (replies, delivery failures, votes) via email, IM, SMS and phone.
-   Integrating with popular sources of contacts to avoid re-entering contacts in Notifu.