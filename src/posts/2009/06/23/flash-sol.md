---
layout: layouts/post.njk
title: "Flash SOL: Persistent Data with Local SharedObjects"
author: "Unknown"
date: 2009-06-23
slug: "flash-sol"
permalink: /blog/2009/06/23/flash-sol/
categories:
  - "Development"
---
I've been working with [Matt Snider](http://mattsnider.com/) of [Mint.com](http://mint.com/) to develop a [new local storage utility for YUI](http://yuilibrary.com/projects/yui2/roadmap). The utility will use a cascading storage system to detect the best way to store information through the browser, allowing a developer to store data more efficiently than a typical browser cookie — and in greater amounts. One of the storage mechanisms employs the [Adobe Flash Player](http://www.adobe.com/products/flashplayer/), and this use case has been the focus of my recent work.

Flash has a built-in persistent storage system called [SharedObjects](http://livedocs.adobe.com/flex/3/langref/flash/net/SharedObject.html), which can be thought of as "super-cookies", allowing the developer to store, by default, 100kb — or more, if the user allows. One of the benefits of SharedObjects, besides their capacity, is that they can store core ActionScript types, and even entire custom classes, in a binary format on the user's hard drive. SharedObjects use the ActionScript Message Format (AMF), making them efficient and compact.

These SharedObjects are not encrypted, so while difficult to read, they are not what you would call secure storage. We'd never recommend storing important data such as user names, passwords, or other private data via a SharedObject unless you've implemented your own encryption mechanism. Also, SharedObjects are different from a cookie in more ways than capacity — SharedObjects are generally not attached to a specific browser but are stored independently.

These differences of the Flash storage system provide a number of benefits to the developer and the end user. However, while extremely convenient, they can also be misleading to the average user, many being unaware that such data even exists on their machine. While great lengths have been taken to provide transparency and control over private data to users via their browser (Firefox and Safari in particular providing a nice set of tools to view, edit, and remove cookies for various sites), the Flash storage system, due to its plugin nature, stores information in a separate location. This means that clearing your browser cookies does not clear these SharedObjects.

If you're interested in viewing these bits of storage on your machine, you can check out the following locations:

Linux:

```
/.macromedia/Flash_Player/
```

Mac:

```
/Library/Preferences/Macromedia/Flash Player/
```

Windows:

```
/Application Data/Macromedia/Flash Player/
```

SharedObjects are typically stored in separate folders under these locations, in directories with such descriptive names as `8GKWKDQM` and `227MDWL4`. Under such folders are subdirectories corresponding to the domain in which the SharedObject came from.

The actual files have the `*.sol` extension, and there may be more than one for each domain. For instance, I found three separate SharedObject files on my machine under the youtube.com folder. They're not human readable, as they are stored in binary.

When developing this storage utility, I wanted to be able to see the actual data stored in its raw form — but I didn't have the time to parse through it all using a ByteArray, so I looked for a tool to do the job. I found a handy AIR application called [Minerva](http://blog.coursevector.com/minerva), which can open a `*.sol` file and display its information. As of this writing, the current version doesn't allow editing of the actual values stored, but there may be some other applications out there that I didn't find.![Screenshot of Minerva application](/yuiblog/blog-archive/assets/flash-sol/minerva.png)

If you'd like to remove some or all of these "Flash cookies", you can simply delete the files or directories as needed. Note, however, that some sites make extensive use of SharedObjects, so removing them may cause unexpected behavior. Financial institutions in particular take advantage of them to aid in the security of their sites. So make sure you know what you're doing, or create a backup before wreaking havoc.

An alternative to browsing through directories is to use [Adobe's Settings Manager](http://www.macromedia.com/support/documentation/en/flashplayer/help/settings_manager07.html). This is a Flash-based tool with special privileges that will allow you to view information about the storage on your machine, remove some or all of the stores, and set restrictions on future storage.

So, next time you want a clean slate for your browser, remember that there may be some additional information lurking on your machine that the browser can't get to.