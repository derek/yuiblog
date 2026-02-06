---
layout: layouts/post.njk
title: "YUI Implementation Focus: SugarCRM"
author: "YUI Team"
date: 2006-08-04
slug: "sugarcrm"
permalink: /blog/2006/08/04/sugarcrm/
categories:
  - "Development"
---
Recently I posted some examples of [how YUI is being put to use within Yahoo](/yuiblog/blog/2006/07/18/ten_things/). Another point of interest for those of us involved with the YUI Library and community is how the library is being used outside of Yahoo. Members of the Yahoo! Group [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/), which is the YUI community's key forum, have shared some great examples of applications using YUI. Occasionally, we'll explore some of those examples here as well to illustrate the kinds of projects for which YUI is being tapped.

[![SugarCRM](/yuiblog/blog-archive/assets/sugarcrm/sugar-home.gif)SugarCRM](http://www.sugarcrm.com), the largest open-source CRM platform with more than [800 customers](http://www.sugarcrm.com/crm/customers/index.html) and 80,000+ downloads per month, became one of the first major web application vendors to deploy YUI when it released its version 4.5 into beta last week (see C|Net's report, ["Open-source firm polishes interface with AJAX](http://news.com.com/Open-source+firm+polishes+interface+with+AJAX/2100-7344_3-6098649.html)" or [review recent blog coverage of SugarCRM](http://blog.news.search.yahoo.com/blog/search?&ei=UTF-8&p=sugarcrm&fr=moreblog)).

One of the principal enhancements arriving in SugarCRM 4.5 is an elegant, dynamic interface that incorporates a number of useful interaction patterns. Developers **Majed Itani**, **Ajay Gupta**, and **Wayne Pan** (among a team of about 25 total engineers at Sugar) implemented the new interactions using YUI. Pan told us he was about three days into a custom drag and drop implementation when the YUI Library was released as open source in February. "I downloaded YUI and my 300 lines of JavaScript turned into about 10," he said. "I was impressed. It just worked."

The main SugarCRM interface consists of a dashboard on which live configurable "dashlets." With release 4.5, those dashlets can be repositioned on the page using drag and drop. When new dashlets are added (or current ones are dismissed), animation is employed to gradualize the page change and make it more intuitive for the user. The modal DHTML options panel for each dashlet animates down from the top of the screen. When you add new dashlets, your choices are presented in a tree format. The administrative interface also received a major injection of interactive richness. To accomplish all of this, Itani, Gupta and Pan leveraged many of the YUI components: [Event](http://developer.yahoo.com/yui/event/), [Animation](http://developer.yahoo.com/yui/animation/), [Connection](http://developer.yahoo.com/yui/connection/), [Drag & Drop](http://developer.yahoo.com/yui/dragdrop/), [Container](http://developer.yahoo.com/yui/container/), and [TreeView](http://developer.yahoo.com/yui/treeview/).

![](/yuiblog/blog-archive/assets/sugarcrm/sugar-composite.gif)

To explore SugarCRM's new interface, visit [http://www.sugarcrm.com/crm/demo/45-community-preview.html](http://www.sugarcrm.com/crm/demo/45-community-preview.html).

_Do you have a YUI implementation that would be of interest to the YUI community? If so, please [share your link](http://groups.yahoo.com/group/ydn-javascript/links/YUI_Implementations_001149002597/) and post a message to the community forum at [YDN-JavaScript](http://groups.yahoo.com/group/ydn-javascript/), or leave us a message in the comments section below._