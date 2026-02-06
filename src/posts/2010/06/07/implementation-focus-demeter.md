---
layout: layouts/post.njk
title: "Implementation Focus: Demeter"
author: "Jenny Donnelly"
date: 2010-06-07
slug: "implementation-focus-demeter"
permalink: /blog/2010/06/07/implementation-focus-demeter/
categories:
  - "Development"
---
![](/yuiblog/blog-archive/assets/demeter/genmcdemeter-image1.png)

### Tell us a little about your project.

“Demeter” is the codename for a recent web 2.0 application we built which provides powerful solutions to web conferencing, ad hoc meeting, and account management. Currently we have two major product suites: “Meeting Center” and “Admin Module”.

Although it’s still in RC phrase with no public access to view it, I have extracted a [prototype of the Admin Module](http://cz9908.com/blog/Niko-weblog-labs/lab-YUI/for-example/yui2-datatable-simple-extention/demo-edit-properties.html) that demonstrates the management of portal properties.

![](/yuiblog/blog-archive/assets/demeter/genmcdemeter-image2.png)

### Which components of the YUI Library are used in your project?

When we were initially trying to decide which JS framework and UI library to use, there were three things that sold us on YUI: the great documentation, the wide variety of mature widgets, and the BSD license, so I introduced YUI to my company. The following modules are used in our project:

-   **CSS:** Reset, Fonts
-   **Core:** YAHOO, Dom, Event
-   **Utilities:** Connection Manager, DataSource, Element, JSON
-   **Widgets:** Calendar, Container, DataTable
-   **Tools:** Logger, Test

### Admin module implementation overview

Our main requirements for the Admin module included:

-   datatable with a customized editor popup
-   theme/skin customization
-   browser compatibility

Here is the simple markup that sets up the UI:

```
    <div id="datatable-ux">
		<div id="datatable-ux-hd"></div>

		<div id="datatable-ux-bd">
			<div id="node-depths" style="display: none">root  > Testing  > 5_Dev Testing BA  > 80000_1010</div>

			<div id="output"></div>
			<div id="yui-datatable" class="yui-dt">
			  <img src="images/icon-loading.gif" alt="loading" align="absmiddle" style="margin: 30px 0;" /> loading data...
			</div>
		</div>

		<div id="datatable-ux-ft"></div>
    </div>

	<div id="node-apply-wrap" style="display: none;">
		<fieldset>
			<legend>Apply to</legend>

			<input type="radio" name="node-apply" checked="checked" />Current node only<br />
			<input type="radio" name="node-apply" />Current node and child nodes<br />
			<input type="radio" name="node-apply" />Child nodes only
		</fieldset>
	</div>


```

Here is a code snippet of the simple extension I built for DataTable TextboxCellEditor:

```
   // simple example to extend the CellEditor Classes
   // short alias
   var lang = YAHOO.lang,
	  util = YAHOO.util,
	  widget = YAHOO.widget,
	  Dom = util.Dom,
	  Event = util.Event;

   // extend TextboxCellEditor
   Gcc.admin.TextboxCellEditor = function(config) {
	   Gcc.admin.TextboxCellEditor.superclass.constructor.call(this, config);
   };
   lang.extend(Gcc.admin.TextboxCellEditor, widget.TextboxCellEditor, {
	   renderForm : function() {
		   Gcc.admin.TextboxCellEditor.superclass.renderForm.call(this);

		   var oHd = document.createElement('DIV');
		   this.getContainerEl().insertBefore(oHd, this.textbox);
		   oHd.id = container.id + '-admin-editor-head';
		   Dom.addClass(oHd, 'admin-editor-hd');

		   var oCurrNode = document.createElement('DIV');
		   this.getContainerEl().insertBefore(oCurrNode, this.textbox);
		   oCurrNode.innerHTML = 'Current node: ' + Dom.get('node-depths').innerHTML;
		   Dom.addClass(oCurrNode, 'admin-editor-pd');

		   var oApply = document.createElement('DIV');
		   this.getContainerEl().appendChild(oApply);
		   oApply.innerHTML = Dom.get('node-apply-wrap').innerHTML;
		   Dom.addClass(oApply, 'admin-editor-fieldset');
	   },

	   move : function() {
		   Gcc.admin.TextboxCellEditor.superclass.move.call(this);
		   Dom.addClass(this.textbox, 'admin-editor-pd');
	   }
   });

```

Then a cellClickEvent handler detects the underlying type of data value being edited and calls one of the customized cell editors.

![](/yuiblog/blog-archive/assets/demeter/genmcdemeter-image3.png)

With our server architecture consisting of the Apache Struts framework and the application container Weblogic, we found that YUI plays a good companion role as the “Clientside-Controller” and works well with Struts action results as a dynamic datasource.

```
<%@ page pageEncoding="UTF-8" contentType="application/json; charset=UTF-8" %>
<%@ taglib prefix="s" uri="/struts-tags" %>
{"PropertySet":{
"Property":[
<s:iterator value="displayPropertyResultList" status="index">;
    {
    "Id":"<s:property value="id" />",
    "Name":"<s:property value="name" />",
    "Type":"<s:property value="type" />",
    "Value":"<s:if test="%{value != null}"><s:property value="value" /></s:if>",
    "ApplyFrom":"<s:property value="applyFrom" />",
    "ApplyTo":"<s:property value="applyTo" />",
    "Readable":"<s:property value="readable" />",
    "Writable":"<s:property value="writable" />"
    }
    <s:if test="%{!#index.last}">,</s:if>

</s:iterator>
]}
}

```

More details and source code are available on [GitHub](http://github.com/bluepower/YUI-UX/tree/master/examples/yui2-datatable-simple-extention/), where I have extracted a prototype of the Admin UI using a local datasource as a simple demonstration.

### What have been the challenges of using YUI in this project?

The main challenges have been around the fact that most of our developers are in fact not frontend engineers. They don’t always have quite as much experience dealing with cross-browser issues or JavaScript-specific tricks. Fortunately YUI helps us a lot to make good code structures and to smooth out most browser compatibility issues.

### What’s next for Demeter? What are some upcoming features you are tackling with YUI?

One of the upcoming features we are working on is a reporting module that will make heavy use of [YUI Charts](http://developer.yahoo.com/yui/charts/). And we are also planning to use [TreeView](http://developer.yahoo.com/yui/treeview/) widget to refactor our addressbook module.

We are still using [YUI 2](http://developer.yahoo.com/yui/2/), but if more and more official widgets based on [YUI 3](http://developer.yahoo.com/yui/3/) come out, we will consider totally moving to YUI 3 in the future.