---
layout: layouts/post.njk
title: "Help Us Help Others!"
author: "Unknown"
date: 2012-04-25
slug: "help-us-help-others"
permalink: /blog/2012/04/25/help-us-help-others/
categories:
  - "Development"
---
One of the best things about YUI is our documentation. It’s been known in the community for years that documentation is a high priority for our developers. One of our other priorities is exceptional API documentation. We have always had high quality documentation but that comes with a price tag, time.

## Did you know that you can help us with this?

All of our documentation is available in our Github repo and the tools we use to generate this documentation are available for you to use. Yes, that’s right, everything we use to make our documentation is available right now. In this article I will show you how you can **fix API documentation** and **update an example** to help other developers just like you.

This article is about modifying existing examples, landing pages and API documentation. Check out [the screencast at the bottom](#new-example-screencast) if you're more interested in creating new examples from scratch.

## What do you need?

You need a working install of [Node.js](http://nodejs.org/#download) **(0.6.x or higher is recommended)**, [NPM](http://npmjs.org/) **(packaged with node)**, [Selleck](http://rgrove.github.com/selleck) **our custom documentation tool** and [YUIDoc](http://davglass.github.com/yuidocjs) **our api documentation tool**. These tools are freely available and very easy to install. Simply [go here](http://nodejs.org/#download) and choose your environment to install Node.js. Once it’s installed, you can install our two tools with this command:

```
npm -g install selleck yuidocjs
```

Once that completes, you’re all set!

**\*\* You will, of course, need git installed, have a Github account and have already forked the yui3 repo**

## Where things live

All of our examples are kept in our main source tree, this makes it easier to associate an example with the code it belongs to. In this example, I will be working with the [DragDrop](http://yuilibrary.com/yui/docs/dd/) examples and API docs.

The main landing page and example files are located under [`yui3/src/dd/docs`](https://github.com/yui/yui3/tree/master/src/dd/docs). All of the API docs are parsed from the [raw source files](https://github.com/yui/yui3/tree/master/src/dd/js) **(we’ll get into that in a bit)**.

## Seeing a rendered example

The hardest part of any example is seeing how it looks once it’s ready. This is where **Selleck** comes in to play. **Selleck** has a “server mode” that you can fire up and see our examples “parsed and loaded”. Turning on **Selleck's**"server mode" is very simple:

```
cd yui3/src;
selleck --server

```

This will print the following to the console:

```
[info] Selleck is now giving Ferrari rides at http://localhost:3000
```

Now visit `http://127.0.0.1:3000` in your browser of choice and you should see the main **Selleck** page displaying a list of all the components that it found under the `src` directory.

**If you don’t want Selleck to bind to port 3000, simply add a port to the command above (`selleck --server 5000`)**

One of the advantages of using **Selleck** in server mode is that you do not need to restart the server **(unless you add new json files for new examples)** to see your changes. Just open a file, edit, save and reload! It’s that easy!

## Fixing API Documentation

All of our API documentation is parsed directly from our source files `yui3/src/dd/js` with [YUIDoc](http://davglass.github.com/yuidocjs/). This makes reading them in the source files a little difficult (unless you can parse JSDoc tags and Markdown syntax in your head). Luckily **YUIDoc** also has a server mode to help you with this. Turning on **YUIDoc’s** server mode is just as easy as **Selleck’s**:

```
cd yui3/src;
yuidoc --server

```

This will print out some **YUIDoc** debugging info ending with:

```
info: (server): Starting server: http://127.0.0.1:3000

```

Now visit `http://127.0.0.1:3000` in your browser of choice and you should see the main **YUIDoc** page listing all of the parsed API docs.

**If you don’t want YUIDoc to bind to port 3000, simply add a port to the command above (`yuidoc --server 5000`)**

**YUIDoc’s** server mode works a lot like **Selleck’s** in that you do not need to restart the server to see your changes. **YUIDoc** will reparse all of the source code on each page load and show you the updated API docs. Just open a file, edit, save and reload! It’s that easy!

## Things to remember

Some things to remember when you are working on something you want to contribute:

-   Always work in a branch `git checkout -b mydocpatch`
-   Push to your branch `git push origin mydocpatch`
-   Submit the Pull Request from your branch
-   (optional) If you're comfortable with git, we recommend working against yui/yui3's "live-docs" branch

## What to do after I update things?

As with anything else in YUI, once you update your files, simply commit them and issue us a **Pull Request** as usual. One of our developers will verify the changes and either merge them in or give you some feedback.

## How often are things updated on the site?

Our current site deployment is very easy, we often deploy to [yuilibrary.com](http://yuilibrary.com/) at least once a week. Sometimes we even push daily! So, get your changes in and give back to the community!

## More Information

YUI Engineer [Luke Smith](http://twitter.com/ls_n) put together the following screen cast showing how to create a new example from scratch. Take a look at it and more videos over on our [YouTube Channel](http://www.youtube.com/yuilibrary).

<iframe allowfullscreen="allowfullscreen" frameborder="0" height="315" src="http://www.youtube.com/embed/0Ai2q9ioCe4" width="420"></iframe>