---
layout: layouts/post.njk
title: "Implementation Focus: Genius.com"
author: "Jack Slocum"
date: 2007-02-06
slug: "genius"
permalink: /blog/2007/02/06/genius/
categories:
  - "YUI Implementations"
---
**At what point did you begin evolving your application to use a rich interface? What were the original tools/libraries you used?**

The company from day one started as a Web 2.0-focused project, but we didn't have the engineering resources to create everything ourselves — we knew that from the beginning. So we looked at a lot of UI libraries back when we were getting started on the product. We looked at Dojo, and we looked at Google's web toolkit and some of the commercial libraries. We had a big decision to make about whether to spend money on a commercial product or use one of the open source packages. Ultimately, we found that what we could get from the open source community was more than enough for us.

[![](/yuiblog/blog-archive/assets/genius.com.gif)](/yuiblog/blog-archive/assets/genius.com.mov "In this 18-second screen capture, you can see YUI Event, Dom, animation and Connection Manager utilities at work in the rich Genius.com interface.")**Why did you choose YUI as part of your JavaScript foundation?**

What attracted us to YUI specifically was the documentation, first and foremost. It was surprising, at the time we were doing this research, how many good tools were out there that simply didn't have enough documentation to make us feel confident about doing complex implementations. YUI's documentation makes it easier for us to hire people, too, because with YUI we don't need to hire someone with YUI-specific skills. A good programmer can come to YUI and learn it based on the documentation. That's been important to us lately as we've grown the company.

The YUI examples were another factor that drew us to YUI; you could see immediately how each component was meant to be used and whether it solved our core problems.

The final key draw to YUI for us was the quality of the APIs throughout the library. It was compelling to see how much thought was given to writing the APIs and designing them in such a way that it would make sense to use and to build on. The APIs resonated for us, made sense immediately in many cases, and that made it much easier for us to feel comfortable building on YUI.

There's a sense, too, that with Yahoo! behind this it will be around for a long time and will continue to receive real development commitment.

**How are you using YUI in your site today?**

Today we're using the [Animation Utility](http://developer.yahoo.com/yui/animation/), the [Dialog Control](http://developer.yahoo.com/yui/container/dialog/), the [Calendar Control](http://developer.yahoo.com/yui/calendar/), and [Jack Slocum](/yuiblog/blog/2006/10/10/ten-questions-slocum/)'s [YUI-ext Grid](http://www.jackslocum.com/blog/2006/08/30/a-grid-component-for-yahoo-ui-extensions-v1/), among other things. We're beginning to implement [Connection Manager](http://developer.yahoo.com/yui/connection/) for XHR transactions, and we do a lot of that. We have a lot of work under development that extends this even further. We're in the process of converting wholly to YUI from some in-house components and from some other third-party pieces. We're now in the process of converting every XHR call to Connection Manager; in one place, we've ripped out about 700 lines of XHR code and replace it with 130 lines based on Connection Manager.

We're also in the process of converting every table from an old hand-rolled solution to Jack's Grid or the upcoming YUI DataTable.

**You've mentioned that you're using Jack Slocum's YUI-ext library, an extension of YUI. What holes has Jack's work filled for you?**

Jack's work was one of the things that put us over the top for using YUI . Some of the components we really needed, like the Grid, weren't in YUI, but Jack had them; Jack's Grid really made it possible for us to use YUI. And we could see how Jack was extending YUI and the patterns he used to do that; that showed us that there was a solid foundation for building our own implementations and going beyond just what YUI did out of the box. Another thing that we really liked about Jack's work is the richness of his examples visually; he goes beyond the base YUI in terms of styling his examples, which is really important to us as we try to style our own components. We've also gotten accustomed to Jack's implementation of the API documentation, which is based upon but styled differently than the documentation on the YUI site.

**How has the YUI implementation process gone for you so far?**

Our CTO really pushed us in this direction. We knew we needed to get ourselves onto a coherent platform, whether it was Dojo or YUI or something else. And when we went down this path, the experience really validated the decision to migrate to a platform. Things we'd been struggling with for a long time we were able to mock up in a couple of days once we moved to YUI. Jack's Grid was a good example of that.

Compared to where we were, it's been a huge step forward.

**What are some of the pain points you've experienced while using YUI?**

It would be better for us if there was more attention given to the graphical or visual aspect of the examples. It would be easier for our visual designers to work with the examples if they had more of the visual richness that will ultimately be part of the product.

Getting started was tough back in the early days for us — there's _so_ much information on the YUI website, it can be hard to know where to start. There were challenges early on, too, in just tracking what includes were needed — that information was available in the documentation, but not in the API docs, and so we spent some time learning how to track dependencies (_Editor's note: dependencies are now [included in API docs](http://developer.yahoo.com/yui/docs/) as well as in user guides)._ Back in the early days, we would have benefitted from a "Getting Started with YUI" guide or tutorial.

_Do you have a YUI implementation that would be of interest to the YUI community? If so, please [share your link](http://groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/) and post a message to the community forum at [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/), or leave us a message in the comments section below._