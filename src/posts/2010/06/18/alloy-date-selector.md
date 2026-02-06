---
layout: layouts/post.njk
title: "Using the YUI 3 Calendar Date Selector from Alloy"
author: "Eric Miraglia"
date: 2010-06-18
slug: "alloy-date-selector"
permalink: /blog/2010/06/18/alloy-date-selector/
categories:
  - "Development"
---
[![](/yuiblog/blog-archive/assets/alloycalendar-20100618-113307.jpg)](http://ericmiraglia.com/yui/demos/alloycalendar.php)

The [Alloy](http://alloy.liferay.com/ "Alloy UI - A project of Liferay") components (contributed by Nate Cavanaugh and Eduardo Lundgren from Liferay) in the [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery") are simple to use. [This example](http://ericmiraglia.com/yui/demos/alloycalendar.php) illustrates the use of the Alloy calendar to progressively enhance a set of `select` elements for date selection.

Let's start with the markup — the HTML that will be on the page and functioning regardless of whether JavaScript is enabled. Alloy's Calendar module does not require this markup; you can feed it an empty element and it will create the `select` elements for you in the event that your use case would not benefit from progressive enhancement.

```
<div id="calendar">
	<select class="yui3-datepicker-month" name="month" id="monthselect">
		<option value="0">
			January
		</option>
		<option value="1">
			February
		</option>

...

	</select>

        <select class="yui3-datepicker-day" name="day" id="dayselect">
		<option value="1">
			1
		</option>
		<option value="2">
			2
		</option>

...

	</select>

        <select class="yui3-datepicker-year" name="year" id="yearselect">
		<option value="2009">
			2009
		</option>

...

	</select>
</div>
```

With this markup in place (or with just an empty root element if we aren't progressively enhancing existing form fields), we bring in the [Alloy Calendar module with datepicker selection support](http://yuilibrary.com/gallery/show/aui-calendar-datepicker-select "YUI Library :: Gallery :: AlloyUI Calendar Datepicker Select") from the [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery"). This requires us to have YUI 3 on the page and then to follow the configuration step outlined on [the module's Gallery page](http://yuilibrary.com/gallery/show/aui-calendar-datepicker-select "YUI Library :: Gallery :: AlloyUI Calendar Datepicker Select").

```
<script src="http://yui.yahooapis.com/3.1.1/build/yui/yui-min.js"></script>
<script>
YUI({
	// All of this configuration information can be cut-and-pasted from the Gallery entry for
	// this module: http://yuilibrary.com/gallery/show/aui-calendar-datepicker-select
    gallery: 'gallery-2010.06.07-17-52',
    modules: {
        'gallery-aui-skin-base': {
            fullpath: 'http://yui.yahooapis.com/gallery-2010.06.07-17-52/build/gallery-aui-skin-base/css/
							gallery-aui-skin-base-min.css',
            type: 'css'
        },
        'gallery-aui-skin-classic': {
            fullpath: 'http://yui.yahooapis.com/gallery-2010.06.07-17-52/build/
							gallery-aui-skin-classic/css/
							gallery-aui-skin-classic-min.css',
            type: 'css',
            requires: ['gallery-aui-skin-base']
        }
    }
}).use('gallery-aui-calendar-datepicker-select', function(Y) {
    var datePickerSelect = new Y.DatePickerSelect({
		displayBoundingBox: '#calendar',
		dateFormat: '%m/%d/%y',
		yearRange: [ 2009, 2012 ],
		dayField: Y.one("#dayselect"),
		dayFieldName: "day",
		monthField: Y.one("#monthselect"),
		monthFieldName: "month",
		yearField: Y.one("#yearselect"),
		yearFieldName: "year"
	}).render();
});

</script>
```

[Here's a live version of this simple example](http://ericmiraglia.com/yui/demos/alloycalendar.php).

It's as simple as that. The configuration properties for `datePickerSelect` are [lucidly defined in the Alloy documentation](http://alloy.liferay.com/deploy/api/DatePickerSelect.html "API: aui-calendar  DatePickerSelect   (YUI Library)"). In this example, the properties are used to set the root element, format the date, set the date range, and then wire up our existing `select` elements to the widget instance so that it knows which form fields to use for progressive enhancement. In practice, only the root element (`displayBondingBox`) is a required property.

[Check out the YUI 3 Gallery roster for a full list of the Alloy UI contributions](http://yuilibrary.com/gallery/show).