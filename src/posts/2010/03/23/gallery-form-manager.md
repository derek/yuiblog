---
layout: layouts/post.njk
title: "In the YUI 3 Gallery: John Lindal's Form Manager"
author: "John Lindal"
date: 2010-03-23
slug: "gallery-form-manager"
permalink: /2010/03/23/gallery-form-manager/
categories:
  - "Development"
---
Forms have been a staple on web sites for a very long time. In the early days, they were quite simple: the user entered values and then waited while the server processed the values or spit back errors. The rise of Web 2.0 has significantly improved the experience, most notably by pre-validating on the client. This provides immediate feedback and avoids pointless connections to the server.

Pre-validation is merely one aspect of forms, however. The entire cycle is:

1.  pre-populate the form with default values;
2.  pre-validate the input in the browser;
3.  submit the form data to the server synchronously or asynchronously;
4.  display the results returned by the server (success or errors).

When combined with [YUI 3 IO](http://developer.yahoo.com/yui/3/io/ "YUI 3: IO"), the YUI 3 Gallery module [Form Manager](http://yuilibrary.com/gallery/show/formmgr) supports this full cycle. You can play with the client-side functionality [here](http://jafl.github.com/yui3-gallery/formmgr/).

### Initialization

The first step, pre-populating the form with default values, is of course best done by setting values directly in the markup, because this works even when JavaScript is turned off. However, you can also pass a map of default values, keyed on the names of the form elements, to the Form Manager constructor. When you call `prepareForm()`, it merges the default values from the DOM with the default values passed to the constructor, with the constructor values taking precedence. The result is saved so you can easily reset to these values by calling `populateForm()`. You can also modify these stored defaults: `setDefaultValues()`, `setDefaultValue()`, or `saveCurrentValuesAsDefault()`. (Note that this is different from the browser's native `reset` function, since that uses only values encoded in the DOM. Form Manager provides `clearForm()` as a wrapper for `reset`.)

Another useful function to call during initialization is `initFocus()`. This sets focus to the first element in the form. If filling out the form is the main reason for visiting the page, this saves the user a click. Obviously, if you have more than one form on the page, you should only call `initFocus()` for one of them.

### Pre-validation

Pre-validating user input is a [tricky business](http://weblog.raganwald.com/2007/09/you-suck.html). In my experience, the simplest approach is best: check everything after the user says I'm done. This avoids the need to filter the input stream (keyup is easy to catch, but paste is notoriously difficult, and it all leads to very unexpected edge case behaviors) and, more importantly, it doesn't interrupt the user's flow. This is why Form Manager provides a single function to validate everything in the form (drum roll, please): `validateForm()`.

Unlike other solutions, Form Manager stores most of the validation configuration in the DOM. To mark a field for validation, apply one or more of the following CSS classes directly to the field:

`yiv-required`

Value must not be empty.

`yiv-length:[x,y]`

String must be at least x characters and at most y characters. At least one of x and y must be specified.

`yiv-integer:[x,y]`

The value must be an integer, and the value must be at least x and at most y. x and y are both optional.

`yiv-decimal:[x,y]`

The value must be a decimal, and the value must be at least x and at most y. Exponents are not allowed. x and y are both optional.

For example, if a field must be filled in, and it only accepts between 6 and 10 characters, the CSS class would be `yiv-required yiv-length:[6,10]`.

One nice benefit of encoding validation in CSS classes is that it can be applied in related situations, e.g., when editing dynamically created fields in a table. (I hope to post an example for [YUI 2 DataTable](http://developer.yahoo.com/yui/datatable/ "YUI 2: DataTable") soon.) FormManager exposes the static function [`validateFromCSSData()`](http://jafl.github.com/yui3-gallery/formmgr/yuidoc/FormManager.html#method_Y.FormManager.validateFromCSSData) so you don't have to reinvent the wheel.

If you need to use a regular expression to validate a field, register it by calling [`setRegex()`](http://jafl.github.com/yui3-gallery/formmgr/yuidoc/FormManager.html#method_setRegex). For anything else, you can attach a function to a field by calling [`setFunction()`](http://jafl.github.com/yui3-gallery/formmgr/yuidoc/FormManager.html#method_setFunction). If you need to perform checks that encompass multiple fields, you can override `postValidateForm()` on your instance of `Y.FormManager`.

One final note: As the name suggests, **pre-validation is not real validation**. JavaScript is relatively easy to subvert (or turn off completely), so the server must never trust anything that it receives from the client. In addition, some checks can only be done on the server, e.g., anything that requires hitting the database.

### Displaying Errors

Obviously, if either pre-validation on the client or validation on the server fails, then you need to notify the user, ideally by highlighting the fields that need attention. Form Manager supports this via the function [`displayMessage()`](http://jafl.github.com/yui3-gallery/formmgr/yuidoc/FormManager.html#method_displayMessage).

This function expects certain CSS marker classes on the DOM surrouning each form element or tightly coupled set of form elements. My favorite layout is:

```
<div class="formmgr-row>
  ...element label...
  <span class="formmgr-message-text"></span>
  ...form element marked with CSS class formmgr-field...
</div>

```

This localizes well, since the label is above the field, and when an error message is displayed, it's very clear to which field the error applies. To see it in action, follow [this link](http://jafl.github.com/yui3-gallery/formmgr/) and click the Validate button in the upper left corner of the page.

But that is just my preference. You can arrange the DOM elements any way you want inside the container marked by `formmgr-row`, as long as somewhere inside is another container marked by `formmgr-message-text`, and the field itself is marked by `formmgr-field`.

#### Message Types

One important point is that `displayMessage()` requires a message type. The supported types are stored in `Y.FormManager.status_order` in order of precedence. The default is `[ 'error', 'warn', 'success', 'info' ]`, but you can modify this to suit your needs. The ordering is important because, if you call `displayMessage()` with a higher precedence type and the field is already displaying a message with a lower precedence, then the new message will replace the original message. Similarly, a lower precedence message will be ignored if a higher precedence message is already displayed. This allows you to toss messages at each field with abandon, secure in the knowledge that errors will override warnings.

When a message is displayed, the container marked with `formmgr-row` and the field marked with `formmgr-field` both get an extra CSS class: `formmgr-has_type_`, where _type_ is the message type. This allows you to style the message, field, label, etc. in a different way for each message type. In addition, the fieldset containing the form field also gets the same class. This can be used to direct the user's attention when the form is large. (If several fields within a fieldset have different types of messages, the highest precedence type is set on the fieldset.)

#### Messages

Form Manager includes a default set of error messages for all the validations that can be encoded in CSS. These strings are stored in `Y.FormManager.Strings`, so you can modify and/or localize them.

You can also specify custom messages for individual fields by calling [`setErrorMessages()`](http://jafl.github.com/yui3-gallery/formmgr/yuidoc/FormManager.html#method_setErrorMessages).

Note that there is no default message for a regular expression validator, because anything generic like The value does not match the required pattern. is utterly meaningless to the user. If you do not set a message for the type `regex` before setting the regular expression itself, Form Manager will log an error to remind you.

### Submitting the Form

Regardless of whether you submit the data synchronously (via `form.submit()`) or asynchronously (via `Y.io`), you will probably want to disable the form while the data is being processed. Form Manager automatically finds all buttons inside the <form> element. If you have additional buttons elsewhere on the page, you can register them by calling `registerButton()`. All known buttons will be disabled when you call `disableForm()`. (If you use XHR, call `enableForm()` after you receive the response from the server!)

If you submit the form synchronously, then you will serve the same page again if there are errors. In order to work without JavaScript, you should write the errors directly into the DOM, the same way that Form Manager does it.

If you submit via XHR, then you know that JavaScript is enabled, so you can use `displayMessage()` to highlight the values which the server rejected. Obviously, this requires that the response from the server include detailed error information!

As a final note, if the form is in an overlay, then you should only close the overlay if the server response with success; i.e., display errors in the overlay, but display a success message somewhere prominent on the main page.