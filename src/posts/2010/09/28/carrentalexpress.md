---
layout: layouts/post.njk
title: "Implementation Focus: Car Rental Express"
author: "Stefan Klopp"
date: 2010-09-28
slug: "carrentalexpress"
permalink: /blog/2010/09/28/carrentalexpress/
categories:
  - "YUI Implementations"
---
**About the author:**![](/yuiblog/blog-archive/assets/carrentalexpress/profile-picture-small.jpg) Stefan Klopp is the Director of Development for [ExpressITech](http://www.expressitech.com/ "Express Internet Technologies"), the parent company of [Car Rental Express](http://www.carrentalexpress.com "Car Rental Express"). Stefan has been developing highly usable web solutions for the car rental industry in various roles over the last 6 years. He currently lives and works in Vancouver, British Columbia, Canada.

[Car Rental Express](http://www.carrentalexpress.com/ "Cheap Car Rentals - Compare Rental Agencies with Car Rental Express") is the leading independent car rental comparison website on the Internet. It lets users rent cars online in more than 1000 cities and airports around the world.

Our user base is largely non-technical, which means they want to compare prices and rent cars as easily as possible. With the relaunch of our website in June of 2010 we have implemented many components of YUI 2 to help provide our customers with an intuitive experience.

**Which YUI components are we using?**

The components that we've been using include [Connection Manager](http://developer.yahoo.com/yui/connection/ "YUI 2: Connection Manager"), [AutoComplete](http://developer.yahoo.com/yui/autocomplete/ "YUI 2: AutoComplete"), [DataSource](http://developer.yahoo.com/yui/datasource/ "YUI 2: DataSource"), [Calendar](http://developer.yahoo.com/yui/calendar/ "YUI 2: Calendar"), [Animation](http://developer.yahoo.com/yui/animation/ "YUI 2: Animation"), [JSON](http://developer.yahoo.com/yui/json/ "YUI 2: JSON utility"), and [Container](http://developer.yahoo.com/yui/container/ "YUI 2: Container").

**Why we chose YUI**

When reviewing the different JavaScript libraries that we could potentially use on [Car Rental Express](http://www.carrentalexpress.com/ "Cheap Car Rentals - Compare Rental Agencies with Car Rental Express"), we found that the YUI was the most complete for our needs. The biggest selling features for us was the very modular approach the YUI took to implement different design patterns, as well as the robust documentation and examples they provided. From a development standpoint this led to rapid development of our application without having to struggle with a library.

**How we use YUI**

We utilize the YUI in a number of ways. Our 4 most used components are AutoComplete, Calendar, Container, and Connection Manager. Here are some of the ways we use each of these components.

**[AutoComplete](http://developer.yahoo.com/yui/autocomplete/ "YUI 2: AutoComplete")**

The AutoComplete component is used extensively on our site to help users find a city or airport in which to rent a car. We really liked how easy it was to implement this component, and how quickly it responds. We cache search results server-side to help improve search results; however, having the client-side caching also helped tremendously in speeding up the response of the component. Another feature that we really took to was how easy the results were to style. When displaying the locations to the user this was crucial as we needed to identify which locations where found in cities and which were found at airports.

![](/yuiblog/blog-archive/assets/carrentalexpress/auto-complete-styled.png "Auto Complete Component Styled")

**[Calendar](http://developer.yahoo.com/yui/calendar/ "YUI 2: Calendar")**

The Calendar component is also used throughout the site when a renter is filling in dates to conduct a search. We are using a customized version of John Peloquin's [Interval Selection Calendar](http://developer.yahoo.com/yui/examples/calendar/intervalcal.html "YUI Library Examples: Calendar Control: Interval Selection Calendar") and displaying it in a [YUI Dialog](http://developer.yahoo.com/yui/container/dialog/ "YUI 2: Dialog"). Essentially what we wanted to do was give the renter a two-month view when choosing their dates, as well as visually show them what date range they currently have selected. Again, this was extremely straightforward to implement using YUI 2 Calendar, and it basically came down to creating a YUI Dialog, setting the body to contain a div for the Calendar, then attaching a YUI Interval Calendar to that div.

![](/yuiblog/blog-archive/assets/carrentalexpress/calendar.png "Interval Calendar")

**[Containers](http://developer.yahoo.com/yui/container/ "YUI 2: Container")**

We utilize YUI Containers throughout our website in a number of different ways. In the example above we were using a Dialog to help us display the Interval Calendar when a user was selecting a date. On our rate search results page we make heavy use of Containers to give the renter more information on different aspects of the car rental agency and the vehicle they might potentially rent. Most of the containers on this page are [Panels](http://developer.yahoo.com/yui/container/panel/ "YUI 2: Panel") that we re-use for each different listing. For example, the vehicle display features Panel:

![](/yuiblog/blog-archive/assets/carrentalexpress/standard-panel.png "Standard Panel")

Things got a little more fun with the Renter Rated agency ratings. When displaying the ratings, we really wanted to focus the user's attention to the scores an agency received and to display this information in a clean, easy-to-view way. By utilizing the Dialog Control we were able to constrain the viewport and center the dialog easily to help us achieve this goal. By setting a blank header and footer it made styling simple by just adding the appropriate styles to our CSS. The end result was a clean ratings container that provides the renter with the information they want.

![](/yuiblog/blog-archive/assets/carrentalexpress/renter-rated-dialog.png "Dialog Container Styled")

**[Connection Manager](http://developer.yahoo.com/yui/connection/ "YUI 2: Connection Manager")**

Connection Manager is used throughout the site whenever we need to pull data via a XHR request. In some of the examples above we utilize this component for requesting cities and airports for the AutoComplete implementaitons and pulling the rating information for the Renter Rated Dialog.

One interesting way we utilize Connection Manager is with our rental center block that sits on most pages. To help with performance we do a lot of full-page caching on many of our content pages. However, we still wanted to display the dynamic rental center block on these pages. This presented us with a problem we were able to solve with Connection Manager. Rather than having to break up our fully cached page and cache only aspects of the page we found it was easier to just include the rental center block via a simple asynchronous request. We found that this allowed us to retain the performance from having a fully cached page, yet still display dynamic content in our rental center box.

![](/yuiblog/blog-archive/assets/carrentalexpress/rental-center-included-va-connection.png "Rental Center included via Connection Component")

**Final Thoughts**

Overall we have been extremely happy with our choice to use YUI. It provides us with a modular library that is well documented, easy to use and implement.