---
layout: layouts/post.njk
title: "Event-Driven Web Application Design"
author: "Unknown"
date: 2007-01-17
slug: "event-plan"
permalink: /blog/2007/01/17/event-plan/
categories:
  - "Development"
---
Frontend engineering rocks right now. The era of boring web sites is over and we're all into pushing the envelope, erasing boundaries and getting beyond whatever prevents us from building the next killer web application. New companies building quick-turnaround web products spring up like mushrooms and many an old convention of web design is cast aside to make way for quick prototyping and agile development.

The real confusing part of it — at least to me — is that we don't try out new ways to approach web application development. Instead, there seem to be two separate schools of development approach:

-   You either use a framework (like Ruby on Rails, Spring or Microsoft .NET) to build your web-app or
-   You build your web app with best-practices ideas coming from more traditional web design and/or application design.

The framework approach relies heavily on the quality of the generated code and the accessibility and usability of the out-of-the-box page widgets and components. The pure web design approach relies on what HTML allows you to do and most of the time doesn't take scripting-enhanced widgets into consideration.

As there are not many developers that follow both approaches there is a big divide in skill sets. People tend to become experts in one or another and stay within this comfort zone when talking to other developers. This is a real big waste as both factions could learn a lot from each other. All we need to overcome are the competing notions that (a) web standards and accessibility are show-stoppers for rapid framework-driven development and that (b) frameworks are a source of bad and invalid code. Both approaches are flexible: Frameworks [can be extended to produce cleaner code](http://www.ujs4rails.com) and web standards can be seen as an agreed way of working with one another rather than as immutable laws that are never to be broken.

## A Problem of Approach

The sad truth now is that both approaches often lead to hard-to-maintain products that don't scale gracefully and are a pain to make accessible, localise to different languages or customise to different needs and channels. This is caused by false assumptions made by practitioners of both approaches:

-   The framework approach relies on a silver bullet and approaches web development with fat-client application ideals from higher programming languages like Java or C++. This does not take into consideration the fact that web development is a discipline that operates with great uncertainties regarding the nature of client-side hardware and software. Optimization has to be for the user and not for the developer (although these don't necessarily have to be mutually exclusive).
-   The web standards approach would not be a problem at all if people would follow standards with the goal of making things easier by following an agreed approach and not see following the words of the W3C to the last detail as the only way to do things. Web standards are there to take the randomness out of web development and not to act as a policing tool.

The crux of the matter is that we don't really yet understand how to build a real web application. We take tried and true methodologies that cover other development scenarios and try to shoe-horn them into something that helps us to achieve what we want on-time and within budget (and when was the last time that happened?).

The other problem is that we approach web application design with browser limitations in mind and plan only for what browsers can do rather than what the application should offer the user.

When it boils down to it, the main differentiator of a _web application_ and a _web site_ is that an app has much more interaction and is process-focused rather than content-driven. Users come in to achieve a goal: They provide data to the application, they use the application to enhance that data, and then they expect data to come out. They interact with components of the application and expect them to do something that brings them closer to their goal. It is of utmost importance that we plan for how users interact with the product and react accordingly.

When trying to accomplish this in the browser, there is one core technique at our disposal: Event handling.

## Understanding Events

We must try to understand what an event is when it comes to user interaction through the duration of a user session.

Events as [defined by the W3C](http://www.w3.org/TR/DOM-Level-2-Events/events.html) are very complex and can be tough to understand. However, the most common way of thinking about events in JavaScript is:

-   Something happens to an element, to the main document, or to the browser window and that _event_ triggers a reaction. For example, the window finishes loading and on that event we start an initialization method; or the user clicks a link and we use that event to trigger another function.

Most framework-generated code or even handcoded methods use this kind of event handling. We take the window, or a certain element and add handlers defining the event that should trigger a function. This leads to a rigid relationship between the markup and the functionality. As the interface of a web application might change (more links in a component, other buttons, more complex forms) this need to add more cruft begins to cripple our applications. It also means that maintenance must happen in two places — a change to our HTML means that our JavaScript needs to change, too.

The DOM Event Model however goes a bit further. It has a more granular definition of the workflow:

-   Something happens; an event occurs.
-   The investigation begins what element was activated and how. This happens by questioning each element from the window to the body to the first child node and so on until the element that was activated, the _event target_, is reached. This is called event capturing.
-   When the element is reached, the process of reporting goes back up through the DOM right back up to the window. This is called event bubbling.
-   You can intercept events on both legs of this journey at any time by adding event listeners to either the window or any of the objects that get queried. Event listeners define what event to look out for (click, keypress, load, mousedown...), the object to which the handler should be applied, and what method to call when it happens.
-   You can stop events from going back up to the window by calling a `cancelEvent()` method and you can retrieve the object the event occurred on, the _event target_, with a helper method called `getTarget()`.
-   You can add as many listeners waiting for as many different events and each calling as many methods as you like.

Understanding and implementing this event model can free your application from the constraints of defined elements. For example, instead of applying an event listener for each link in a menu, you can assign a single listener to the menu item itself and retrieve the event target. That way you don't need to change your script when the menu gets larger or when links get removed from it.

This is a very powerful and flexible approach often referred to as [event delegation](http://icant.co.uk/sandbox/eventdelegation/). Event delegation allows you to react to changes in the document while applying fewer event listeners. You can assign different handlers to different parts of your document (the menu, the main content, a sidebar, a language change menu) and define methods for each event (was it clicked? was a key pressed on it?). These methods then retrieve the element that was affected and react accordingly; for example, you can react differently for links versus buttons.

When using this idea (waiting for an event, investigating where it happens and acting accordingly) in web applications we mostly confine ourselves to what the browser reports us — the DOM events. This is not really necessary, and it's a big limitation. Much that happens in an application — like a user switching between tabs in a [TabView Control](http://developer.yahoo.com/yui/tabview/) — could be thought of as an event and dealt with in the same manner.

## Planning an Event-Driven Application

You can apply the same DOM-event style logic to anything that happens within your application itself. You can plan your application that way from the outset:

-   Application is loaded
    -   Initialize the stage
    -   Get the locale
    -   Load extra content
    -   Load adverts
    -   Display stage
-   User changes language by activating a language component
    -   Load extra content
    -   Load adverts
    -   Display Stage

The only thing that's missing is turning this event plan (once it is finished for the first phase) into real code, and this is where the browser or JavaScript does not give us the built-in interfaces that we'd like to have for the purpose.

## Beyond DOM Events: The Custom Event

Whenever the browser or JavaScript itself lets us down we turn to JavaScript libraries to solve the problem. In this case we'll use the [Yahoo! User Interface Library (YUI)](http://developer.yahoo.com/yui/) with its [Custom Event Object](http://developer.yahoo.com/yui/event/#customevent). This object allows you to define any event you like, subscribe listener methods to it, and fire the event whenever you want. It's like simulating a click on a button. Internally, the YUI uses Custom Events a lot to trigger different reactions. For example the [Animation utility](http://developer.yahoo.com/yui/animation/) allows not only for the animation of elements but makes it easy to create successive animations by providing `onStart`, `onComplete` and `onTween` Custom Events.

Using these events you can put together a web app that is easy to change, extend and maintain.

## A Quick Example of an Event-Plan Driven Application

Let's take a look at an example how all of this could work. As our application example we have an HTML document with two components: one to change the language, and another to change the layout. The application links DOM events (such as click events when the user clicks on links) to meaningful "interesting moments" in the application, moments that we encapsulate in Custom Events; for example, the user choosing to change the layout of the page is encapsulated in a Custom Event, and when that event is triggered we activate the scripts which perform layout modification.

All links here point to PHP scripts that would perform similar transformations on the server side to ensure that we are not dependent on JavaScript (for this example, however, we'll look only at the client-side code).

#### eventPlanExample.html (excerpt):

```
<ul>
  <li>Change Language:
    <ul id="languages">
      <li><a href="test.php?lang=en">English</a></li>
      <li><a href="test.php?lang=de">Deutsch</a></li>
      <li><a href="test.php?lang=nl">Neederlands</a></li>
    </ul>
  </li>
</ul>
<ul>
  <li>Change Layout:
    <ul id="layout">
      <li><a href="test.php?layout=onecolumn">One Column</a></li>
      <li><a href="test.php?layout=threecolumns">Three Columns</a></li>
    </ul>
  </li>
</ul>
```

Now for the important bit: we define an event plan with Custom Events and subscribe the necessary tool methods to each custom event:

#### customEvents.js:

```
// Changing the language
  languageChange = new YAHOO.util.CustomEvent('language change');

  languageChange.subscribe(retrieveData);
  languageChange.subscribe(renderLayout);
  languageChange.subscribe(ads);
  languageChange.subscribe(pageWidgets);
	
// Changing the layout
  layoutChange = new YAHOO.util.CustomEvent('layout change');

  layoutChange.subscribe(renderLayout);
  layoutChange.subscribe(ads);
  layoutChange.subscribe(pageWidgets);
```

Adding or removing tool methods here makes it very easy to extend the application by adding or removing functionality without having to change any of the methods themselves. We can also add and remove whole modules of component logic simply by commenting them out.

The tool methods used are stubs in this example, and all they do is report that they were activated:

#### pageMethods.js:

```
function retrieveData(type,args){
  log('retrieving Data for ' + args[0]);
};
function renderLayout(type,args){
  if(type==='layout change'){
    log('changing layout for ' + args[0]);
  } else {
    log('changing language layout for ' + args[0]);
  }
};
function ads(type,args){
  log('changing ads for ' + args[0]);
};
function pageWidgets(type,args){
  log('changing page widgets for ' + args[0]);
};
function log(msg){
  document.getElementById('output').innerHTML+='<p>'+msg+'</p>';
}
```

In the main JavaScript, we'll apply the normal browser handlers to the components via Event Delegation, get the settings that should be applied from the links and fire the Custom Events. The important parts are in bold:

#### eventTriggers.js:

```
function initLanguages(){
    YAHOO.util.Event.addListener(this, "click", changeLanguage); 
};
function initLayout(){
    YAHOO.util.Event.addListener(this, "click", changeLayout); 
};
function changeLanguage(e){
  var t=YAHOO.util.Event.getTarget(e);
  if(t.nodeName.toLowerCase()==='a'){
    document.getElementById('output').innerHTML = ''; 
    var lang = t.href.replace(/.*?lang=/,'');
    languageChange.fire(lang);

  }
  YAHOO.util.Event.preventDefault(e);
};
function changeLayout(e){
  var t=YAHOO.util.Event.getTarget(e);
  if(t.nodeName.toLowerCase()==='a'){
    document.getElementById('output').innerHTML = ''; 
    var lang = t.href.replace(/.*?layout=/,'');
    layoutChange.fire(lang);
  }
  YAHOO.util.Event.preventDefault(e);
};
YAHOO.util.Event.onAvailable('languages', initLanguages);  
YAHOO.util.Event.onAvailable('layout', initLayout);
```

You can [download the demo](/yuiblog/blog-archive/assets/eventPlanDemo.zip) or [try it out for yourself](/yuiblog/blog-archive/assets/eventPlanDemo/eventPlanExample.html).

## The Key Differentiator and Where This Can Go

You could argue that the same functionality could be achieved without Custom Event handling (by having methods that encapsulate all subsidiary methods to be called for each event). The difference here is that we took the procedural nature of JavaScript out of the equation and we really link the interesting moments of the interaction to the relevant components of our application's functionality in a single, centralized repository.

This also means that we can make a logging component subscribe to each of the events and store the current state of the whole application in a data repository, allowing for easily implemented "undo" functionality and storage of the application state, something that is a true pain to achieve without an underlying event plan.

## Event-Driven Web Application Design as an Evolutionary Step

If the benefits of this approach are not obvious to you yet, think of the following: The evolution of web design happened mainly via separation of different layers.

-   When we created the first web applications connection speeds were slow and being connected to the internet cost us money by the minute.
-   Therefore we used frames to only load what has changed in the app. This led to the problem that if one frame didn't load properly the app didn't work and users were forced to reload the parent page.
-   The next problem was that browsers didn't support CSS and we used tables and font tags to define the look and feel which made it hard to change them and the documents themselves rather heavy.
-   When CSS support became more consistent and usable, we were able to get rid of the extra HTML, documents got lighter and we could get rid of the frames again.
-   The next problem we encountered was that mixing backend logic and HTML output was problematic for maintenance (maintainers needed both skills). As a result, we came up with templating languages that allowed for separation of server-side logic and the structure of the interface.
-   Right now we still see the browser or the framework capabilities as the boundary of our applications. This is a pragmatic approach but limits us in our creativity and binds the application planning and documentation to browsers as the means of display.
-   However, if we take _events_ — including both DOM events and Custom Events — as the main consideration when planning the application we can free ourselves of these limitations and become a lot more independent of the technology in use.
-   An application developed with an underlying Event Plan could be easily shifted to another technology like Flash or become a plug-in for thick clients like instant messengers or even operating systems.

The other big plus of starting an application with an event plan is that you cut the big application down into manageable chunks and components and you can plan the detailed usability, information architecture and accessibility for each component separately. This allows you to develop in parallel with the design or information architecture team and results in reusable components for other applications.