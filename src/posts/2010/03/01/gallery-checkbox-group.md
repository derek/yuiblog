---
layout: layouts/post.njk
title: "In the YUI 3 Gallery:  Checkbox Group Behaviors"
author: "John Lindal"
date: 2010-03-01
slug: "gallery-checkbox-group"
permalink: /blog/2010/03/01/gallery-checkbox-group/
categories:
  - "Development"
---
Checkboxes and radio buttons are well known patterns for choosing from a small set of items. The former lets you choose any subset of items (including none), while the latter requires exactly one selection.

But what if you need a different behavior? The [Checkbox Groups module](http://yuilibrary.com/gallery/show/checkboxgroups) in the [YUI 3 Gallery](http://yuilibrary.com/gallery/) implements three common cases and a foundation for constructing others. The module is based on checkboxes because, by default, they do not enforce any restrictions, which makes them an ideal foundation on which to build.

The first behavior provided by the module is `Y.AtLeastOneCheckboxGroup`. This enforces that at least one item must be selected. More than one selection is permitted, but deselecting all items is prevented. This implemented using the "drop of mercury" algorithm discussed in [Tog on Interface](http://search.yahoo.com/search?p=tog+on+interface): Whenever you try to deselect the last item, the selection slides out from under the cursor. You can play with it [here](http://jafl.github.com/yui3-gallery/checkboxgroups/).

The second example (`Y.AtMostOneCheckboxGroup`) allows no selection, but more than one selection is not permitted. Note that you cannot use radio buttons for this, because then it is not possible to unselect the current item. This is demonstrated in the second example on [this page](http://jafl.github.com/yui3-gallery/checkboxgroups/).

The final example (`Y.SelectAllCheckboxGroup`) implements a "select all" behavior using an extra checkbox. Selecting the "Select All" checkbox selects all the other items. Deselecting it deselects all other items. Selecting or deselecting any item updates the state of the "Select All" checkbox. You can try it out by playing with the third example on [this page](http://jafl.github.com/yui3-gallery/checkboxgroups/).

The possiblities are endless. You can build your own custom behavior quickly by extending the base class used by all the above examples: [`Y.CheckboxGroup`](http://jafl.github.com/yui3-gallery/checkboxgroups/yuidoc/CheckboxGroup.html). This takes care of all the bureaucracy, so all you have to do is implement `enforceConstraints()`. The function is invoked with the list of managed checkboxes and the index of the checkbox that has just been changed. You can then inspect and update the state of all the checkboxes to enforce your custom constraints.

In many cases, all you need are the checkboxes themselves, e.g., `Y.AtLeastOneCheckboxGroup` and `Y.AtMostOneCheckboxGroup`. For this, your constructor can be pass-through, since the base class `Y.CheckboxGroup` will manage the list for you. If you need additional controls, e.g., `Y.SelectAllCheckboxGroup`, your constructor should require references to these controls, and you will need to store them so you can access their state inside `enforceConstraints()`.

To use the Checkbox Groups module, include the following script on your page:

```
<script type="text/javascript" src="http://yui.yahooapis.com/combo?3.0.0/build/yui/yui-min.js&gallery-2009.12.08-22/build/gallery-checkboxgroups/gallery-checkboxgroups-min.js"></script>

```

The provided behaviors are all install-and-forget:

```
YUI().use('gallery-checkboxgroups', function(Y)
{
	// attaches behavior to all checkboxes with CSS class "my-at-least-one-checkbox-group"
	new Y.AtLeastOneCheckboxGroup('.my-at-least-one-checkbox-group');

	// attaches behavior to all checkboxes with CSS class "my-at-most-one-checkbox-group"
	new Y.AtMostOneCheckboxGroup('.my-at-most-one-checkbox-group');

	// attaches behavior to all checkboxes with CSS class "my-select-all-checkbox-group",
	// controlled by the checkbox with id "my-select-all-checkbox"
	new Y.SelectAllCheckboxGroup('#my-select-all-checkbox', '.my-select-all-checkbox-group');
});

```

One final note: Ideally, checkboxes with custom behavior should be styled differently, so the user has some indication that they are not just plain checkboxes. For example, Tog suggests using diamonds for `Y.AtLeastOneCheckboxGroup`. In practice, however, you must also ensure that people can figure out that your controls are to be used for selecting items. So be clever, just not too clever!