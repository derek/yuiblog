---
layout: layouts/post.njk
title: "My PHP Backend Scripts for Use With YUI"
author: "YUI Team"
date: 2008-03-05
slug: "satyam-phpjson"
permalink: /2008/03/05/satyam-phpjson/
categories:
  - "Development"
---
[YUI](http://developer.yahoo.com/yui/) is designed to be flexible so it can work in all sorts of environments. Sometimes we start from scratch, both on the client side and the server side, and we might get a little disoriented with so many possibilities. PHP or Rails? JSON or XML? In [previous articles](/yuiblog/?s=satyam-datatable), I've shown how to use the [DataTable Component](http://developer.yahoo.com/yui/datatable/) and I've made some suggestions about how to manage the choices you have on the client.

[A recent article at my web site offers techniques and sample code for the server side if it runs PHP scripts](http://www.satyam.com.ar/yui/PhpJson.htm), which is a pretty common server-side choice for YUI deployments. It shows the code for several handy functions that make the server code easy to write. I begin by discussing a dispatcher function, [`ajaxReq`](http://www.satyam.com.ar/yui/PhpJson.htm#ajaxReq) which branches off to your individual responders, but not before setting the environment for a proper JSON reply. I also provide an [`ajaxReply`](http://www.satyam.com.ar/yui/PhpJson.htm#ajaxReply) function which makes it easy to produce the reply — for example, by simply passing it an SQL statement. I've recently updated `ajaxReply` to be able to produce replies suitable for the new [YUI Get Utility](http://developer.yahoo.com/yui/get/). Finally, the function [`BuildSql`](http://www.satyam.com.ar/yui/PhpJson.htm#BuildSql) is like a `sprintf` command designed for SQL, which makes it easy to build SQL statements with variables and can be used in any environment, AJAX or not.

[If you're using PHP with YUI, take a look](http://www.satyam.com.ar/yui/PhpJson.htm) — and feel free to leave feedback in the comments here.