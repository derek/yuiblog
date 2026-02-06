---
layout: layouts/post.njk
title: "The YUI 3 Form Module — Forms and Validation Made Simple"
author: "Greg Hinch"
date: 2009-12-03
slug: "yui-3-gallery-form-module"
permalink: /blog/2009/12/03/yui-3-gallery-form-module/
categories:
  - "Development"
---
[![Greg's YUI 3 Gallery Form Module](/yuiblog/blog-archive/assets/form-module-20091203-122111.png)](http://yuilibrary.com/gallery/show/form)The [Form](http://yuilibrary.com/gallery/show/form) module in the [YUI 3 Gallery](http://yuilibrary.com/gallery/ "YUI Library :: Gallery") aims to make working with forms simple, including built-in as well as customizable validation and the ability to set errors from the server. There are predefined field classes for all HTML form input types, and you can extend them to create your own specifically tailored fields. Validation is completely customizable on the field level, and includes a number of built-in methods that you can use for validating email addresses, phone numbers, postal codes, dates, times, and IP addresses. That validation can be done at the time of submission or inline as field values change.

A Form object can be completely generated in script or built directly from markup (supporting a [progressive enhancement](http://en.wikipedia.org/wiki/Progressive_enhancement "Progressive enhancement - Wikipedia, the free encyclopedia") approach). Here's an example of how simple it is to build a form from script:

```
var myForm = new Y.Form({
	method : "post",
	action : "/test.php?action=submit",
	inlineValidation : true,
	fields : [
		{name : 'input1', type : 'text', label : 'Email Input: ', validator : 'email'},
		{name : 'input2', type : 'text', label : 'Phone Number Input: ', validator : 'phone'},
		{name : 'choiceinput', type : 'choice', label : 'Radio Choices: ', choices : [
			{label : 'Choice A', value : 'A'},
			{label : 'Choice B', value : 'B'},
			{label : 'Choice C', value : 'C'}
		]},
		{type : 'submit', label : 'Submit'},
		{type : 'reset', label : 'Reset'}
	]
});
myForm.render('#formContainer');

```

This example highlights several of the features of the Form module. The attribute **inlineValidate** is set to true, which causes fields to validate themselves as soon as their _valueChange_ event fires. Preconfigured validators for **email** and **phone numbers** are set on two of the inputs as well, and a special field called a **ChoiceField** is used for a radio button choice input set.

Please see [more examples on Github](http://ghinch.github.com/examples/form/) for building a Form from markup and defining a custom DateField, which attaches a [YUI 2 Calendar Widget](http://developer.yahoo.com/yui/calendar/) to an input.

I hope you find the Form module useful in your application development, and welcome any comments or suggestions for the addition of features or bugs to fix. For more information please see the [documentation](http://ghinch.github.com/yui3-gallery/docs/module_form.html) on Github.

Questions about the Form component? Every [YUI 3 Gallery](http://yuilibrary.com/gallery/) module has a dedicated discussion forum; [here's the one for the Form module](http://yuilibrary.com/forum/viewforum.php?f=111).