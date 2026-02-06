---
layout: layouts/post.njk
title: "An Interview with Ted Husted, Creator of YUI Community Site \"Planet Yazaar\""
author: "Ted Husted"
date: 2007-06-04
slug: "husted-yazaar"
permalink: /blog/2007/06/04/husted-yazaar/
categories:
  - "Development"
---
Tell us a little bit about your background and your current work; you are, among other things, an Apache Foundation contributor, correct?

I've been a volunteer ASF committer since 2001 and a Member since 2002. Today, the ASF has about two thousand committers contributing to over forty different software projects, ranging from the HTTP web server to the Ant build tool. But, I spend most of my time writing web applications for people that pay me :)

Lately, I've been working on a set of intranet applications for a state water authority. Before that I worked on outward-facing applications for a public broadcasting station, including an auction application based on Apache Struts. Back in the 20th century, I created desktop applications using Microsoft Access and Clarion, and when DOS ruled the earth, PC-File and Turbo Pascal :)

You've been an increasingly significant presence in the YUI developer community during the past several months. When did you start working with YUI? What kinds of projects are you using it for these days?

We started our YUI spike in Februrary 2007, just in time for the [DataTable beta](http://developer.yahoo.com/yui/datatable/ "The YUI DataTable Control"). We've been working on moving the permitting process for a water authority to web-based application. Various departments with the authority play different roles in the process, and we are writing a series of "point applications" for each department that share a common database. It's a typical business application that accesses a database for data-entry and reporting.

We did the first departmental application in ASP.NET, but after the second major release, we started to hit some walls. For richer workflows, we often found ourselves struggling with the lockstep page-rendering cycle. We were starting on another application for a different department, and so we decided to try using standard AJAX on the front-end, but keep the same database facade on the back-end. The [Jayrock library](http://jayrock.berlios.de/) has made it very simple to access our business facade through a generic .NET "handler". (Essentially, a Java servlet.)

After looking at several other libraries, and trying our usual test application in three, we decided to base our UI on YUI. We like the clean design and the excellent documentation "sealed the deal". :)

Much of our work is based on the DataTable component. Because it's new and beta, there have been some bugs. But, we have yet to find a bug we couldn't patch! When we found bugs in the ASP.NET DataGrid, we didn't have the same luxury. We had to resort to awkward workarounds, or just plain do without.

[![](/yuiblog/blog-archive/assets/yazaar.gif)](http://yazaar.org)You've started a companion project to YUI, one that you call Yazaar. I gather Yazaar is an attempt to blend the "cathedral" development model YUI has followed with the intrinsic power of the bazaar, bringing the YUI developer community together to leverage each other's energies on top of YUI's open-source license?

Yes. The concept is to complement the all-corporate YUI team with an all-volunteer Yazaar group, so that the YUI community can enjoy the best of both worlds.

What kinds of projects are you hoping to attract under the Yazaar umbrella?

It's not so much "projects" as "components" or "scripts". In developing any application, most of us end up building one or more reusable components. Jamie Curnow built [an unobstrusive validator](http://yazaar.org/examples/extras/jc21/validate.html) over the [YUI Dom component](http://developer.yahoo.com/yui/dom/). Victor Morales [extended DataTable to add autocomplete row filtering and row hiding](/yuiblog/blog/2007/04/23/dataview/). Matt J. Cormier created a YUI Picker, also based on the DataTable. Caridy Patiño has been developing several scripts that extend YUI components, like the [TabView](http://developer.yahoo.com/yui/tabview/). Both Satyam and I have been extending the DataTable to add editing row in a separate form window. We also have people like [Douglas Crockford](http://blog.360.yahoo.com/douglascrockford) and David Linquist posting scripts that add missing features or add support for common features, like cookies.

At some point, some of these scripts might be replicated by the standard YUI library. Or not. In the meantime, Yazaar provides a place where a developer can contribute a script without a lot of falderol.

Right now, the scripts are kept in three sections, "extras", "patched", and the main section. In the "extras" section, we share copies of miscellaneous third-party scripts, which are also available from the respective authors. Most of these are under the BSD license, just like YUI. The extras are provided in their original form, without modification.

In the "patched" section, we carry modified version of YUI scripts that fix known issues with the current releases. We make a point of reporting any patches to the YUI tracker and cross-referencing the issue number in the patched code.

In the main section, we carry original scripts that are being created and maintained by Yazaar contributors specifically for the YUI library. Anyone with an original script to contribute is invited to join the project. The scope of the library is any script that is useful to a developer's YUI application, would also be useful to other applications, and is available under the BSD license.

To keep this a "win-win" proposition, the copyright for the various Yazaar scripts remain with the original authors, so no one is signing anything away. Details are on the Yazaar Charter page.

Author and poet [Richard Brautigan](http://education.yahoo.com/reference/encyclopedia/entry/Brautigan) wrote of a library where if "someone writes a book, they bring it to the library and place it on a shelf anywhere they choose." Planet Yazaar is Brautigan Library for the YUI community :)

Are you planning a ratings system or other reputation management system to help YUI implementers see the projects that organically rise to the top within Yazaar?

I'm not, since that use case wouldn't apply to the applications that I'm writing now. The point of Yazaar is to provide a way to share scripts that we already have. Of course, if I were working for InfoQ, or Nabble, or Amazon, where the application scope includes rating features, then I'd certainly try to create a ratings script that we could use at Yazaar and that other sites could use too. It would be fantastic if someone had a ratings script to contribute.

As an experienced YUI user, what feedback do you have for the YUI team at this point? Any significant pain points you're hoping to see addressed? Any particular virtues in the library today that you want to see preserved?

That's a tough one. [Team YUI](/yuiblog/blog/2007/03/29/yuiteam/) is already doing a vast number of things right. Overall, the project seems to be nothing but "virtues that should be preserved." :)

To suggestions that we've already discussed on the list, like "Happy Trails" \[_a more intuitively arranged, less encyclopedic guide to the YUI components_\] and "starter applications" \[_holistic examples that integrate multiple YUI components_\], I'd next add: "Learn the lesson of Wikipedia."

No one organization has the resources to do what Wikipedia is able to do. And no one has the resources to do everything YUI might want to do. For example, if Team YUI doesn't have the resources to bring out the API tool as another team-supported artifact, try it as a conventional open source project. Let the YUI corporate developers work alongside peer developers from other projects. The YUI tool and tags may not be based directly on ScriptDoc or JsDoc or JsDoc Toolkit, but that doesn't mean those groups wouldn't be eager and able to help! It would a Good Thing if the ScriptDoc "specification" were expanded to include the tags that teams like YUI actually use. (I've started an omnibus list of tags on the Yazaar wiki.)

Speaking of wikis, a YUI community wiki might be another great community resource. That's part of what we're trying to do with Planet Yazaar, but an YUI-sponsored community wiki, open to everyone, could quickly grow into a vital resource.