---
layout: layouts/post.njk
title: "Fybit Riatrax4Js: Program YUI in Java"
author: "YUI Team"
date: 2010-02-02
slug: "fybit-riatrax4js"
permalink: /blog/2010/02/02/fybit-riatrax4js/
categories:
  - "Development"
---
### Fybit Riatrax4Js: Write YUI in Java

YUI is not only a fantastic JavaScript library, it is also a great community. Developers contribute to YUI and allow others to benefit from it. Now, [Fybit](http://www.fybit.com/) joins the YUI community with [Riatrax4Js](http://www.fybit.com/products/riatrax4js/), a toolkit for rich internet applications (RIAs) based on YUI. Riatrax4Js allows you to program RIAs in plain Java and automatically translates your code to JavaScript, using YUI as a foundation layer. With YUI being available from [Python](/yuiblog/blog/2010/01/05/enterprise-web-developer/), Java and JavaScript, one fourth of all developers get access to YUI. And [with 18%](http://www.tiobe.com/index.php/content/paperinfo/tpci/index.html), Fybit's Riatrax4Js covers the largest part, consisting of Java developers.

### Riatrax4Js: Java benefits, powerful YUI widgets

We just launched the Riatrax4Js alpha version with the goal of easing development of YUI-based RIAs. Riatrax4Js combines the advantages of Java with the extensive widget set and controls of YUI. Consequently, you get the benefits and comfort of Java programming such as:

-   Type safety
-   Inheritance
-   IDE support ([Eclipse](http://www.eclipse.org/), [NetBeans](http://netbeans.org/), ...)
-   Debugging
-   Test tools like [JUnit](http://www.junit.org/)
-   Access to many 3rd party libraries

And you all know how fantastic YUI is:

-   Many powerful widgets
-   Compatible with all major browsers
-   Great performance
-   Yahoo! experts develop YUI

Add up the advantages of Java and YUI, you get the properties of Riatrax4Js. Riatrax4Js is not a server-side framework. It compiles Java to JavaScript, leveraging the standard Java compiler to give you unlimited scalability and speed. Moreover, Riatrax4Js allows you to connect your YUI frontend to the web server and backend with a simple annotation-based remoting mechanism.

### A simple example: Show the server's time on a button's label when clicked

This section walks you through a simple example that is available for [download](http://www.fybit.com/demo/) from our website. Riatrax4Js apps consist of regular Java classes that can use the Java version of YUI that ships with Riatrax4Js. Here is how simple that is:

```
@MainPanel(name="index")
public class DemoPanel {
		
	@Services(implementation=TimeServiceImpl.class)
	protected static TimeService service;
	
	public DemoPanel () {
		final Button syncButton = Button.create("syncButton");
		syncButton.addClickListener(new Listener() {
			public void perform () {
				syncButton.setConfLabel("Sync: " + service.getTime());
			}
		});
	}
}
		
```

The code starts with a `@MainPanel` annotation to allow Riatrax4Js to find the entry point to your program. Next, there is a field `service` that is annotated with the `@Services` annotation. Thanks to this annotation, the server can be called to get the time (or any other value/object you want to use on the client). It does not have to be explicitly initialized, Riatrax4Js does the dirty work for you and ensures that the client and server parts are connected by injecting an appropriate proxy. A YUI Button is then created by replacing an existing HTML button "syncButton" of your HTML page. A click listener which invokes the time service on the server is attached to the button. This is a synchronous (i.e., blocking) call. Async calls are just as easy: The generated proxies contains an async variant of each method in the interface that can be readily used. Here is the corresponding HTML page for the code:

```
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Fybit New</title>
		<script type="text/javascript" src="codebase/app-index.js"></script>
	</head>
	
	<body class="yui-skin-sam">
		<button id="syncButton">Synchronous Call</button>
	</body>
</html>
		
```

The most important line is the script tag at the beginning. It includes a single JavaScript file app-index.js where "index" is the name given in the `@MainPanel` annotation above. In the HTML body, you can find the aforementioned HTML button. Riatrax4Js wraps the YUI Button over this button.

![A YUI button with server invocation](/yuiblog/blog-archive/assets/buttons.jpg)

When you compile the application, Riatrax4Js analyses the source files and generates the file app-index.js consisting of the Java classes needed in the browser translated to JavaScript as well as the necessary YUI JavaScript code. Unlike with native YUI, you don't have to care about YUI dependencies or which YUI files to include — Riatrax4Js includes them automatically!

This is just a small excerpt from a [larger demo](http://www.fybit.com/demo/). The full demo also explains how to call the server asynchronously and how to use other YUI widgets (text editors, auto-completion, menus etc.). Apart from generating web application from scratch, using Riatrax4Js you can improve existing web applications easily with interactive features by wrapping ordinary HTML elements with YUI elements.

[![The full Fybit sowcase](/yuiblog/blog-archive/assets/showcase.jpg)](http://www.fybit.com/Riatrax4JsNew/showcase.html)

### Beyond demos: "PublicationManager" written with Riatrax4Js

We used Riatrax4Js to develop a user-friendly web application to manage publications for a research group at a university in Switzerland. This application facilitates the process of entering and modifying publication records and it has been put into operation in November 2009. The [PublicationManager](http://www.fybit.com/demo/) features YUI dialogs, sortable and resizable tables, paginators and auto-completion. The records entered by the users are stored in a database and can be edited and complemented with files with just a few clicks.

[![Publication manager for a research group at ETH Zurich](/yuiblog/blog-archive/assets/publicationmanager.jpg)](http://www.fybit.com/PaperManager/)

### Security

Riatrax4Js is designed to make applications as secure as possible by default. But because Riatrax4Js uses JavaScript, applications are as hard to secure as any other dynamic web app. Fybit offers separate extension to Riatrax4Js, [Riatrax Security](http://www.fybit.com/products/riatrax-security/). It is based on Riatrax4Js's program code analysis and secures the application by filtering invalid or malicious content and blocking it before it reaches your code and/or application server. Fybit Riatrax Security is also configured with Java annotations.

### Want to try?

The alpha version of Riatrax4Js is currently [available on our web site](http://www.fybit.com/) to registered users. It's great to see the user base of Riatrax4Js grow and be used by developers at this stage.

Fybit's goal is to make Riatrax4Js the best Java RIA toolkit available and support it in the long run. We believe that the YUI community and YUI developers can give us important feedback about Riatrax4Js. We are excited to hear your questions and suggestions, e.g.

-   How can we improve Riatrax4Js?
-   For what kind of projects would you consider Riatrax4Js?
-   What is the best way for us to distribute the product?

As Fybit is a small startup company, we appreciate everyone who wants to contribute to Riatrax4Js to make it the number one RIA framework. Just [drop us a line](http://www.fybit.com/about-us/contact/) if you are interested or want to know more.