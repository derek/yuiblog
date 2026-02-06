---
layout: layouts/post.njk
title: "Date Formatting with YUI - Part I"
author: "Unknown"
date: 2009-02-11
slug: "date-formatting-pt1-2"
permalink: /2009/02/11/date-formatting-pt1-2/
categories:
  - "Development"
---
With the release of YUI 2.6.0, we've added a date formatting component as part of the [DataSource](http://developer.yahoo.com/yui/datasource/) utility. This date formatter brings the full power of [strftime](http://www.opengroup.org/onlinepubs/007908799/xsh/strftime.html) to Javascript. In a series of blog posts, we'll go through examples of using the date formatter to best effect.

To start off, we first need to include the DataSource utility:

```
 
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/event/event-min.js"></script> 
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datasource/datasource-min.js"></script> 

```

Now let's see it in action straight away:

```
<script type="text/javascript">
alert(YAHOO.util.Date.format(new Date(), {format: "%Y-%m-%d %T \n %B, %A"}));
</script>

```

Let's try something more interactive. We'll throw in some markup to read in a format and display the output:

```
<form>
<label>Enter a format: <input type="text" name="date-format" id="date-format" value=""></label><br>
<input type="submit" value="Show Me!" id="btnShow">
</form>
<div id="messages">

</div>

```

Finally, we write some JavaScript to read in a format from the textbox and write out the formatted date to the target div:

```
<script type="text/javascript">
YAHOO.namespace("YAHOO.example.DateFormatter");
YAHOO.example.DateFormatter.formatDate = function(e)
{
	YAHOO.util.Event.stopEvent(e);

	var el = document.getElementById("date-format");
	if(el && el.value)
	{
		var messages = document.getElementById("messages");
		var date_str = YAHOO.util.Date.format(new Date(), { format: el.value });
		messages.innerHTML = "<em>" + date_str + "</em>";
	}
};
YAHOO.util.Event.addListener("btnShow", "click", YAHOO.example.DateFormatter.formatDate);

</script>

```

Put it all together, and we have a [working example](/yuiblog/blog-archive/assets/dateformatting/simple-formats.html). Try some formats yourself, as defined by the [strftime](http://www.opengroup.org/onlinepubs/007908799/xsh/strftime.html) library. You can combine multiple formats and add your own text as well.

Format: