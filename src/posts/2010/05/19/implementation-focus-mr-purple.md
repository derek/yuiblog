---
layout: layouts/post.njk
title: "Implementation Focus: Mr Purple's Movies and More"
author: "Jenny Donnelly"
date: 2010-05-19
slug: "implementation-focus-mr-purple"
permalink: /2010/05/19/implementation-focus-mr-purple/
categories:
  - "Development"
---
![Screenshot of Mr. Purple's Movies and More web site](/yuiblog/blog-archive/assets/mrpurple/screenshot.gif)

**Tell us a little about your project.**

I had been putting off a website for my uncle's company for some time, but with the help of YUI, I built his entire site from scratch in just 3 days.

**What is your background with YUI? Why did you choose YUI for this project?**

I have been using YUI for the past 2 years. In my previous job, I introduced it into every single internal application. I chose YUI for this project due to my familiarity with it, and because it does ALL of the hard work for you. In short, YUI makes me look very good on a daily basis.

**Which YUI components in particular are in use?**

I used the [Carousel](http://developer.yahoo.com/yui/carousel/), [AutoComplete](http://developer.yahoo.com/yui/autocomplete/) and my absolute favorite, the [DataTable](http://developer.yahoo.com/yui/datatable/).

**What have been the challenges of using YUI in this project?**

The main challenges were with a couple of Carousel bugs. These were issues I did expect, as it is still in beta. The only really major issue I had was figuring out why 2 carousels on the same page didn't play nicely together. Then I realized that their items shared the same IDs.![Screenshot of catalogue page](/yuiblog/blog-archive/assets/mrpurple/catalogue.gif)

**What are the things you're most proud of in this project?**

I am proud of the fact that I was able to provide a rich user experience very quickly. Specifically, the catalog page that uses the AutoComplete widget with the DataTable allows users to easily browse a movie catalogue of over 4000 movies and games.

**What are some upcoming features/projects you are tackling with YUI?**

Next order of business, finish the Form Validation component I have been working on with Luke Smith for YUI 2. I am excited to see how it's received by the YUI community. I also plan on introducing YUI to companies I will be working with in the near future.

**How did the YUI components perform?**

They performed excellent. The DataTable was able to handle 4000 records at a time without an issue. I have found that the performance of the YUI components has steadily improved with every release.