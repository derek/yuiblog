---
layout: layouts/post.njk
title: "Migrating a Date/Time Widget from YUI 2 to YUI 3: A Case Study"
author: "John Lindal"
date: 2014-02-21
slug: "migrating-a-datetime-widget-from-yui-2-to-yui-3-a-case-study"
permalink: /blog/2014/02/21/migrating-a-datetime-widget-from-yui-2-to-yui-3-a-case-study/
categories:
  - "YUI 3 Gallery"
---
I first started building YUI 2 widgets for dates back in 2006. One popped up a calendar under an input field, while another bound two calendars together to form a range. A few years later, there was a need for entering both dates and times, constrained by blackout ranges. Somebody hacked up a date/time range widget and handed it to me for enhancements. Unfortunately, they used copy/paste to build it as a monolithic blob managing both start and end times, so I chopped it into a date/time widget and a class to bind two widgets together into a range. I still wasn't happy with it, however, because now I had two separate widgets: one for a date and another for a date and time. In addition, they behaved inconsistently: the date used a popup calendar while the date/time displayed the calendar inline. Even worse, the date/time widget was quite complex: it supported radio buttons for choices like no selection and original date/time, and it generated all its own markup. But schedules being what they were, there was no time to clean it up further.

When `Y.Calendar` was released, it enabled another step in our application’s migration to YUI 3, so I finally got the chance to revisit the situation. I already knew I wanted to consolidate the existing widgets, but they had incompatible behaviors, e.g., no selection was rendered as part of the popup calendar, but was displayed as a radio button above the date input field in the date/time widget. I decided to ignore these minor issues and focus on the date/time widget since I was determined to make it subsume the popup calendar.

The best way to accomplish this seemed to be to make the date/time widget modular instead of monolithic. When I dug into the code, I re-discovered that it leveraged code from the popup calendar -- date formatting and parsing as well as logic to synchronize the input field value with the calendar selection -- so I took a detour to move the parsing and formatting into [gallery-datetime-utils](http://yuilibrary.com/gallery/show/datetime-utils) and the sync’ing into [gallery-input-calendar-sync](http://yuilibrary.com/gallery/show/input-calendar-sync). I was also unable to find a suitable module for turning a `Y.Calendar` into a popup, so I built a generic one: [gallery-popup](http://jafl.github.io/yui-modules/popup/).

There still seemed to be a lot of room for improvement, however. For example, the original date/time widget used menus for selecting the hour and minute, but this prevented use of helpers like [gallery-timepicker](http://yuilibrary.com/gallery/show/timepicker). I also wanted to provide the option to display the calendar either inline or as a popup.

Eventually, I decided on a radical new direction for the code: Instead of being a widget, it should only implement behavior. The minimum requirement would be one input field for entering a date. A calendar could be attached via [gallery-input-calendar-sync](http://yuilibrary.com/gallery/show/input-calendar-sync). The calendar could be a popup, if you used [gallery-popup](http://jafl.github.io/yui-modules/popup/). A second input field could be provided for entering a time, and this could be enhanced with a helper like [gallery-timepicker](http://yuilibrary.com/gallery/show/timepicker). Additional controls like radio buttons could be wired up, if needed, since the modules would not generate any markup.

Looking to the future, once all browsers have implemented `<input type="date">` and `<input type="time">` with native popup calendars and time pickers, the behaviors provided by the modules, e.g., enforcing minimum and maximum values, will still be useful. (`Y.Calendar` will never be obsolete, however, because it allows rendering blackouts.)

The results are finally available: [gallery-datetime](http://jafl.github.io/yui-modules/datetime/) and [gallery-datetime-range](http://jafl.github.io/yui-modules/datetime-range/).

Hopefully, this overview of the design decisions I made will inspire you when it comes time to migrate your YUI 2 or jQuery widgets to YUI 3.

_**About the author:** [John Lindal](http://jjlindal.net/jafl/blog/) ([@jafl5272](http://twitter.com/jafl5272/) on Twitter) regularly contributes to the YUI 3 Gallery._