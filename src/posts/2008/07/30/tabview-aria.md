---
layout: layouts/post.njk
title: "Enhancing TabView Accessibility with WAI-ARIA Roles and States"
author: "Todd Kloots"
date: 2008-07-30
slug: "tabview-aria"
permalink: /2008/07/30/tabview-aria/
categories:
  - "Accessibility"
  - "Development"
---
The [YUI TabView Control](http://developer.yahoo.com/yui/tabview/) is built on a strong foundation of semantic markup that provides users with some basic accessibility. But while TabView looks like a desktop tab control, screen readers don't present it as an atomic widget, leaving users to figure out how the various HTML elements that compose a TabView relate to each other. However, through the application of the [WAI-ARIA Roles and States](http://www.w3.org/TR/wai-aria/), it is possible to enhance TabView's accessibility such that users of screen readers perceive it as a desktop tab control.

A [complete example](/yuiblog/sandbox/yui/v252/examples/tabview/aria_tabview.html) of TabView using the WAI-ARIA Roles and States is available in the YUI Sandbox. [Watch a screen cast of the example running in Firefox 3 with the NVDA screen reader](/yuiblog/blog-archive/assets/tabviewscreencast.mov), or [download the latest development snapshot of NVDA](http://www.nvda-project.org/wiki/Snapshots) and try it yourself.

   

<object height="322" width="512"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.16"> <param name="allowFullScreen" value="true"> <param name="bgcolor" value="#000000"> <param name="flashVars" value="id=9051193&amp;vid=3199866&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/4371/69134473.jpeg&amp;embed=1"><embed allowfullscreen="true" bgcolor="#000000" flashvars="id=9051193&amp;vid=3199866&amp;lang=en-us&amp;intl=us&amp;thumbUrl=http%3A//us.i1.yimg.com/us.yimg.com/p/i/bcst/videosearch/4371/69134473.jpeg&amp;embed=1" height="322" src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.16" type="application/x-shockwave-flash" width="512"></object>

  
[YUI TabView with ARIA roles and states/Todd Kloots](http://video.yahoo.com/watch/3199866/9051193) @ [Yahoo! Video](http://video.yahoo.com)

### Applying the WAI-ARIA Roles and States to TabView

#### Step 1: Getting Started

To start working with the WAI-ARIA Roles and States you'll need both a browser and screen reader that support ARIA. Both [Firefox 3](http://www.mozilla.com/en-US/firefox/) and [Internet Explorer 8 Beta 1](http://www.microsoft.com/windows/products/winfamily/ie/ie8/getitnow.mspx) have ARIA support. Trial versions of the leading [JAWS](http://www.freedomscientific.com/fs_products/software_jaws.asp) and [Window-Eyes](http://www.gwmicro.com/Window-Eyes/) screen readers are available for free download. However, the open-source [NVDA Screen Reader](http://www.nvda-project.org/) is the best option for developers as it is both free and provides excellent support for ARIA.

#### Step 2: Adding Enhanced Keyboard Support

Out of the box, TabView provides basic keyboard support. Each Tab in a TabView is represented by an `<A>` element whose `href` attribute is set to the id of an `<DIV>` element that contains its content. In IE and Firefox, `<A>` elements are automatically placed in the browser's default tab index, enabling the user to toggle between Tabs by pressing the tab key, and select a Tab by pressing enter. (In Safari and Opera, `<A>` elements are not in the tab index by default. Safari users can change this by going to the Safari Menu, Selecting "Preferences", then choose the "Advanced" tab and check the "Press Tab to highlight each item on a webpage" checkbox.)

Having all of the Tabs in a TabView in the browser's default tab index is a mixed blessing: it provides basic keyboard accessibility, but can also make navigating more tedious in that users navigating via the tab key have to tab through every Tab's `<A>` as well as the content of the active Tab's correpsonding TabPanel in order to skip past the control. This problem can be solved by setting the `tabindex` attribute of the `<A>` element of the active Tab to a value of 0, and the inactive Tabs to -1. Setting an element's `tabindex` attribute to a value of -1 removes it from the browser's default tab order, while maintaining its focusability via JavaScript. Therefore, with this change in place it will be easier for the user to skip over a TabView widget while navigating with the keyboard.

##### Mac vs. Windows

With only one Tab now in the browser's default tab index, it will be necessary to supplement the TabView with support for the arrow keys to enable the user to navigate between Tabs as they would on the desktop. There are two different models for arrow key support for tabbed-content controls in operating systems: Mac OS X and Windows. On Windows, pressing the left or right arrow key moves focus to the next Tab and immediately displays its corresponding TabPanel. On the Mac, with VoiceOver enabled, the arrow keys only move focus between each Tab, and the user must press the space bar to load the content of the Tab's corresponding TabPanel. Of the two, the Mac's model might be considered better for a DHTML TabView. For example, if each Tab's content is loaded via XHR, the Mac's more intentional Tab selection model could help prevent the user from making requests for data he/she is not interested in consuming.

##### Supporting Multiple Orientations

The [`orientation`](http://developer.yahoo.com/yui/docs/YAHOO.widget.TabView.html#config_orientation) attribute of the TabView is used to render the Tabs on any of the widget's four sides. To provide arrow key support that will work regardless of the orientation of the Tabs, the left and up keys will move the focus to the previous Tab, while the right and down arrow keys will move the focus to the next Tab. As an additional convenience to the user, we'll take another cue from the Mac's tab control implementation so that focus is automatically moved to the first or last Tab when the user has reached the beginning or end of a list of Tabs.

To apply these keyboard enhancements to TabView, we'll define a new prototype method named `enhanceAccessibility`. This new method is designed to provide consistent keyboard support for TabView across all of the [A-Grade](http://developer.yahoo.com/yui/articles/gbs/) browsers. It will work regardless of how the TabView is constructed (from existing markup, or from script), its orientation, or if its content is static or loaded via XHR.

```
YAHOO.widget.TabView.prototype.enhanceAccessibility = function () {

	var Dom = YAHOO.util.Dom,
		Event = YAHOO.util.Event,
		UA = YAHOO.env.ua,

		oTabViewEl = this.get("element"),
		oTabList = Dom.getChildren(oTabViewEl)[0],
		aTabListItems = Dom.getChildren(oTabList),
		aTabs = this.get("tabs"),
		oTabIndexMap = {},
		oTab,
		oTabEl,
		oTabAnchor,
		oTabContentEl,
		oFocusedTabAnchor,
		sTabId,
		oActiveTab;


	//	Set the "tabIndex" attribute of each Tab's <A> element: The 
	//	"tabIndex" of the active Tab's <A> element is set to 0, the others to -1.
	//	This improves the keyboard accessibility of the TabView by placing
	//	only one Tab in the browser's tab index by default, allowing the user
	//	to easily skip over the control when navigating the page with the tab key.

	Dom.batch(oTabList.getElementsByTagName("A"), function (element) {
		element.tabIndex = -1;
	});
	

	oActiveTab = this.get("activeTab");

	if (oActiveTab) {
		Dom.getFirstChild(oActiveTab.get("element")).tabIndex = 0;
	}


	//	Returns the <A> element representing each Tab in the TabView.

	var getTabAnchor = function (element) {
	
		var oTabAnchor;
	
		if (Dom.getAncestorByClassName(element, "yui-nav")) {

			if (element.nodeName.toUpperCase() === "A") {
				oTabAnchor = element;
			}
			else {
				oTabAnchor = Dom.getAncestorByTagName(element, "A");
			}

		}
		
		return oTabAnchor;
	
	};


	//	Keydown event listener for the TabView that provides support for 
	//	using the arrow keys to move focus between each Tab.

	this.on("keydown", function (event) {
	
		var oCurrentTabAnchor = getTabAnchor(Event.getTarget(event)),
			oCurrentTabLI,
			oNextTabLI,
			oNextTabAnchor;


		if (oCurrentTabAnchor) {

			oCurrentTabLI = oCurrentTabAnchor.parentNode;

			switch (Event.getCharCode(event)) {

				case 37:	// Left
				case 38:	// Up

					oNextTabLI = Dom.getPreviousSibling(oCurrentTabLI);
					
					if (!oNextTabLI) { 
						oNextTabLI = aTabListItems[aTabListItems.length-1];
					}
				
				break;

				case 39:	// Right
				case 40:	// Down

					oNextTabLI = Dom.getNextSibling(oCurrentTabLI);
					
					if (!oNextTabLI) { 
						oNextTabLI = aTabListItems[0];
					}
				
				break;
			
			}

			oNextTabAnchor = Dom.getChildren(oNextTabLI)[0];

			if (!oFocusedTabAnchor) {
				oFocusedTabAnchor = oCurrentTabAnchor;			
			}

			oFocusedTabAnchor.tabIndex = -1;
			oNextTabAnchor.tabIndex = 0;

			oNextTabAnchor.focus();

			oFocusedTabAnchor = oNextTabAnchor;

		}

	});

};
```

#### Step 3: Adding the WAI-ARIA Roles and States

With the keyboard functionality in place, we'll proceed with the application of the WAI-ARIA Roles and States. Once applied, assistive technologies (AT) such as a screen reader will no longer announce the HTML elements that compose the TabView as HTML elements, but as a tab control. In this way the relationship between the WAI-ARIA Roles and States and HTML is similar to that of CSS: both enable the developer to change the presentation of markup. And since the WAI-ARIA Roles and States enable the TabView to be presented to the user as a desktop tab control, it makes the previous work of applying desktop-like keyboard behavior all the more critical. If users of AT are going to preceive the TabView as a desktop tab control, it needs to fulfill that expectation from a keyboard perspective.

As a best practice, apply the WAI-ARIA Roles and States via JavaScript. Since the WAI-ARIA Roles and States depend on JavaScript-based keyboard functionality, it follows that the attributes representing the WAI-ARIA Roles and States only be applied via JavaScript. This [Progressive Enhancement](http://en.wikipedia.org/wiki/Progressive_enhancement) strategy ensures the best possible user experience by only applying WAI-ARIA Roles and States when the browser technologies required to support them (in this case, CSS and JavaScript) are available.

Roles and states are added to a TabView's DOM elements via the [`setAttribute`](http://www.w3.org/TR/2000/WD-DOM-Level-1-20000929/level-one-core.html#ID-F68F082) method. At present only two browsers have WAI-ARIA support: [Firefox 3](http://www.mozilla.com/en-US/firefox/) and [Internet Explorer 8 Beta 1](http://www.microsoft.com/windows/products/winfamily/ie/ie8/getitnow.mspx). (The [changelog](http://www.opera.com/docs/changelogs/windows/950/) for Opera 9.5 mentions support for screen readers, MSAA, and ARIA, but in my testing in Opera I didn't find ARIA to work.) Therefore, we'll make use of YUI's browser detection ([`YAHOO.env.ua`](http://developer.yahoo.com/yui/docs/YAHOO.env.ua.html)) and only apply the Roles and States to browsers that support them. The role of [`tab`](http://www.w3.org/TR/wai-aria/#tab) will be applied to each Tab's `<A>` element, and the role of [`tablist`](http://www.w3.org/TR/wai-aria/#tablist) to their parent `<UL>`. Finally, each Tab's content element (`<DIV>`) will receive the role of [`tabpanel`](http://www.w3.org/TR/wai-aria/#tabpanel) and an [`aria-labelledby`](http://www.w3.org/TR/wai-aria/#labelledby) attribute with a value of the id of the `<A>` representing its corresponding Tab instance. The `aria-labelledby` attribute enables the screen reader to announce the label of the Tab for each TabPanel when the first element in a TabPanel receives focus, providing the user with some context as to where they are. The following example illustrates how the ARIA roles and properties are applied to each of the HTML elements that compose a TabView:

```
<div class="yui-navset">
	<ul role="tablist">
		<li>
			<a href="..." id="tab-1" role="tab">tab label</a>

		</li>
	</ul>
	<div clas="yui-content">
		<div role="tabpanel" aria-labelledby="tab-1">tab content</div>

	</div>
</div>
```

##### Screen-Reader Specific Tweaks

The implementation of the WAI-ARIA Roles and States is slightly different across screen readers, so it is necessary to make some additional tweaks. A role of [`presentation`](http://www.w3.org/TR/wai-aria/#presentation) will need to be applied to the parent `<LI>` element of each `<A>`, so that the Window-Eyes screen reader recognizes that each Tab belongs to the same TabList. For JAWS it is necessary to remove the `href` attribute of each Tab's `<A>` element to prevent it from announcing the attribute's value when focused. Ideally JAWS would behave like NVDA and Window-Eyes and allow the applied `role` attribute of [`tab`](http://www.w3.org/TR/wai-aria/#tab) to take precedence over the default role of the `<A>` element. The following illustrates the updated markup for a TabView with the screen reader tweaks applied:

```
<div class="yui-navset">
	<ul role="tablist">
		<li role="presentation">

			<a id="tab-1" role="tab">tab label</a>
		</li>
	</ul>
	<div clas="yui-content">
		<div role="tabpanel" aria-labelledby="tab-1">tab content</div>

	</div>
</div>
```

With this strategy for applying the WAI-ARIA Roles and States to TabView, we can update the `enhanceAccessibility` method:

```
YAHOO.widget.TabView.prototype.enhanceAccessibility = function () {

	var Dom = YAHOO.util.Dom,
		Event = YAHOO.util.Event,
		UA = YAHOO.env.ua,

		oTabViewEl = this.get("element"),
		oTabList = Dom.getChildren(oTabViewEl)[0],
		aTabListItems = Dom.getChildren(oTabList),
		aTabs = this.get("tabs"),
		oTabIndexMap = {},
		oTab,
		oTabEl,
		oTabAnchor,
		oTabContentEl,
		oFocusedTabAnchor,
		sTabId,
		oActiveTab;


	//	Set the "tabIndex" attribute of each Tab's <A> element: The 
	//	"tabIndex" of the active Tab's <A> element is set to 0, the others to -1.
	//	This improves the keyboard accessibility of the TabView by placing
	//	only one Tab in the browser's tab index by default, allowing the user
	//	to easily skip over the control when navigating the page with the tab key.

	Dom.batch(oTabList.getElementsByTagName("A"), function (element) {
		element.tabIndex = -1;
	});
	

	oActiveTab = this.get("activeTab");

	if (oActiveTab) {
		Dom.getFirstChild(oActiveTab.get("element")).tabIndex = 0;
	}


	//	Returns the <A> element representing each Tab in the TabView.

	var getTabAnchor = function (element) {
	
		var oTabAnchor;
	
		if (Dom.getAncestorByClassName(element, "yui-nav")) {

			if (element.nodeName.toUpperCase() === "A") {
				oTabAnchor = element;
			}
			else {
				oTabAnchor = Dom.getAncestorByTagName(element, "A");
			}

		}
		
		return oTabAnchor;
	
	};


	//	Keydown event listener for the TabView that provides support for 
	//	using the arrow keys to move focus between each Tab.

	this.on("keydown", function (event) {
	
		var oCurrentTabAnchor = getTabAnchor(Event.getTarget(event)),
			oCurrentTabLI,
			oNextTabLI,
			oNextTabAnchor;


		if (oCurrentTabAnchor) {

			oCurrentTabLI = oCurrentTabAnchor.parentNode;

			switch (Event.getCharCode(event)) {

				case 37:	// Left
				case 38:	// Up

					oNextTabLI = Dom.getPreviousSibling(oCurrentTabLI);
					
					if (!oNextTabLI) { 
						oNextTabLI = aTabListItems[aTabListItems.length-1];
					}
				
				break;

				case 39:	// Right
				case 40:	// Down

					oNextTabLI = Dom.getNextSibling(oCurrentTabLI);
					
					if (!oNextTabLI) { 
						oNextTabLI = aTabListItems[0];
					}
				
				break;
			
			}

			oNextTabAnchor = Dom.getChildren(oNextTabLI)[0];

			if (!oFocusedTabAnchor) {
				oFocusedTabAnchor = oCurrentTabAnchor;			
			}

			oFocusedTabAnchor.tabIndex = -1;
			oNextTabAnchor.tabIndex = 0;

			oNextTabAnchor.focus();

			oFocusedTabAnchor = oNextTabAnchor;

		}

	});


	//	Only apply the WAI-ARIA Roles and States for FF 3 and IE 8 since those
	//	are the only browsers that currently support ARIA.
	
	if ((UA.gecko && UA.gecko >= 1.9) || (UA.ie && UA.ie >= 8)) {

		//	Set the "role" attribute of the <UL> encapsulating the Tabs to "tablist"

		oTabList.setAttribute("role", "tablist");
		
	
		for (var i = 0, nLength = aTabs.length; i < nLength; i++) {
		
			oTab = aTabs[i];
			oTabEl = oTab.get("element");
			oTabAnchor = Dom.getChildren(oTabEl)[0];


			//	Create a map that links the ids of each Tab's <A> element to  
			//	the Tab's "index" attribute to make it possible to retrieve a Tab
			//	instance reference by id.

			sTabId = oTabAnchor.id;
		
			if (!sTabId) {
				sTabId = Dom.generateId();
				oTabAnchor.id = sTabId;
			}
	
			oTabIndexMap[sTabId] = i;


			//	Need to set the "role" attribute of each Tab's <LI> element to 
			//  "presentation" so that Window-Eyes recognizes that each Tab belongs to 
			//	the same TabList. Without this, Window-Eyes will announce each Tab as  
			//	being "1 of 1" as opposed to "1 of 3," or "2 of 3".

			oTabEl.setAttribute("role", "presentation");

			oTabAnchor.setAttribute("role", "tab");



			//	JAWS announces the value of the "href" attribute of each Tab's <A>  
			//	element when it recieves focus.  Ideally JAWS would allow the 
			//	applied "role" attribute of "tab" to take precedence over the default   
			//  role of the <A> element like NVDA and Window-Eyes do.  It is 
			//	possible to fix this problem by removing the "href" attribute from 
			//	the <A>.

			oTabAnchor.removeAttribute("href");
	

			oTabContentEl = oTab.get("contentEl");

			oTabContentEl.setAttribute("role", "tabpanel");
			

			//	Set the "aria-labelledby" attribute for the TabPanel <LI> element to 
			//	the id of its corresponding Tab's <A> element.  Doing so enables the 
			//	screen reader to announce the label of the Tab for each TabPanel when  
			//	the first element in a TabPanel receives focus, providing the user  
			//	with some context as to where they are.
			
			oTabContentEl.setAttribute("aria-labelledby", sTabId);
		
		}


		//	Add a keypress listener that toggles the active Tab instance when the user 
		//	presses the Enter key.  This is necessary because the removal of the "href" 
		//	attribute from each Tab's <A> element (for JAWS support) causes the 
		//	TabView's default Enter key support to stop working.  Support for the Space
		//	Bar is also added as an additional convience for the user.

		this.on("keypress", function (event) {
		
			var oTabAnchor = getTabAnchor(Event.getTarget(event)),
				nCharCode = Event.getCharCode(event);
	
			if (oTabAnchor && 
				(nCharCode === 13 || nCharCode === 32) && 
				(oTabAnchor.parentNode !== this.get("activeTab").get("element"))) {

					this.set("activeIndex", oTabIndexMap[oTabAnchor.id]);
			
			}
		
		});
	
	}

};
```

#### Step 4: Putting It All Together

To test the new `enhanceAccessibility` method, we'll use the [Getting Content from an External Source example](http://developer.yahoo.com/yui/examples/tabview/datasrc.html) from the existing TabView examples gallery as a starting point. Once the TabView instance has been appended to the page, we'll call the new `enhanceAccessibility` method. Next we'll use some additional WAI-ARIA Roles and States to make some example-specific tweaks. First we'll, use the [`describedby`](http://www.w3.org/TR/wai-aria/#describedby) property to provide some helpful instructional text that will be announced to the user when the TabView initially receives focus. Since each Tab's content is loaded asynchronously, we'll also leverage [WAI-ARIA Live Regions](http://www.w3.org/WAI/PF/aria-practices/#LiveRegions) to message users when a Tab's content is both being loaded and has finished loading. (Note: The `describedby` property and Live Regions are currently only supported in the [latest development snapshots of NVDA](http://www.nvda-project.org/wiki/Snapshots).) The following code snippet illustrates how it all comes together:

```
(function() {

	var oTabView = new YAHOO.widget.TabView();

	oTabView.addTab( new YAHOO.widget.Tab({
		label: "Opera",
		content: "<p>Please wait.  Content loading.</p>",
		dataSrc: "news.php?query=opera+browser",
		cacheData: true,
		active: true
	}));

	oTabView.addTab( new YAHOO.widget.Tab({
		label: "Firefox",
		content: "<p>Please wait.  Content loading.</p>",
		dataSrc: "news.php?query=firefox+browser",
		cacheData: true
	}));

	oTabView.addTab( new YAHOO.widget.Tab({
		label: "Explorer",
		content: "<p>Please wait.  Content loading.</p>",
		dataSrc: "news.php?query=microsoft+explorer+browser",
		cacheData: true
	}));

	oTabView.addTab( new YAHOO.widget.Tab({
		label: "Safari",
		content: "<p>Please wait.  Content loading.</p>",
		dataSrc: "news.php?query=apple+safari+browser",
		cacheData: true
	}));


	oTabView.appendTo("container");
	oTabView.enhanceAccessibility();


	var Dom = YAHOO.util.Dom,
		UA = YAHOO.env.ua,
		oActiveTab,
		oTitle,
		oTabViewEl,
		oLog,
		sInstructionalText;


	//	Only apply the WAI-ARIA Roles and States for FF 3 and IE 8 since those
	//	are the only browsers that currently support ARIA.
	
	if ((UA.gecko && UA.gecko >= 1.9) || (UA.ie && UA.ie >= 8)) {

		oActiveTab = oTabView.get("activeTab");


		//	Append some instructional text to the <H2>

		oTitle = Dom.get("tabview-title");

		sInstructionalText = oTitle.innerHTML;

		oTitle.innerHTML = (sInstructionalText + "<em id=\"tabview-description\">Press the space bar or enter key to load the content of each tab.</em>");


		//	Set the "aria-describedby" attribute of the <UL> with the role of "tablist"
		//	to the id of the <EM> inside the <H2>.  This will trigger the screen reader 
		//	to read the text of the <EM> when the TabView is initially focused, 
		//	providing some additional instructional text to the user.  (Currently this 
		//	only works with the NVDA screen reader.)

		Dom.getChildren(oTabView.get("element"))[0].setAttribute("aria-describedby", "tabview-description");
		

		//	Append a live region to the TabView's root element that will be used to 
		//	message users about the status of the TabView.

		oTabViewEl = oTabView.get("element");
		oLog = oTabViewEl.ownerDocument.createElement("div");

		oLog.setAttribute("role", "log");
		oLog.setAttribute("aria-live", "polite");

		oTabViewEl.appendChild(oLog);


		//	"activeTabChange" event handler used to notify the screen reader that 
		//	the content of the Tab is loading.

		oTabView.on("activeTabChange", function (event) {

			var oTabEl = this.get("activeTab").get("element"),
				sTabLabel = oTabEl.textContent || oTabEl.innerText,
				oCurrentMessage = Dom.getFirstChild(oLog),
				oMessage = oLog.ownerDocument.createElement("p");

			oMessage.innerHTML = "Please wait.  Content loading for " + sTabLabel + " property page.";

			if (oCurrentMessage) {
				oLog.replaceChild(oMessage, oCurrentMessage);
			}
			else {
				oLog.appendChild(oMessage);						
			}

		});	
	

		//	"dataLoadedChange" event handler used to notify the screen reader that 
		//	the content of the Tab has finished loading.
		
		var onDataLoadedChange = function (event) {

			var oTabEl = this.get("element"),
				sTabLabel = oTabEl.textContent || oTabEl.innerText,
				oCurrentMessage = Dom.getFirstChild(oLog),
				oMessage = oLog.ownerDocument.createElement("p");

			oMessage.innerHTML = "Content loaded for " + sTabLabel + " property page.";

			if (oCurrentMessage) {
				oLog.replaceChild(oMessage, oCurrentMessage);
			}
			else {
				oLog.appendChild(oMessage);						
			}
		
		};
	
		oTabView.getTab(0).on("dataLoadedChange", onDataLoadedChange);
		oTabView.getTab(1).on("dataLoadedChange", onDataLoadedChange);
		oTabView.getTab(2).on("dataLoadedChange", onDataLoadedChange);
		oTabView.getTab(3).on("dataLoadedChange", onDataLoadedChange);

	}

})();
```

### Further Reading and Resources

-   [Using WAI-ARIA Roles and States with the YUI Menu Control](/yuiblog/2007/12/21/menu-waiaria/)
-   [Accessible Rich Internet Applications (WAI-ARIA) Version 1.0 W3C Specification](http://www.w3.org/TR/wai-aria/)
-   [WAI-ARIA Best Practices](http://www.w3.org/TR/wai-aria-practices/)
-   [ARIA: Accessible Rich Internet Applications/Relationship to HTML FAQ](http://developer.mozilla.org/en/docs/ARIA:_Accessible_Rich_Internet_Applications/Relationship_to_HTML_FAQ)
-   [Accessible DHTML](http://www.mozilla.org/access/dhtml/)
-   [Key-navigable custom DHTML widgets](http://developer.mozilla.org/en/docs/Key-navigable_custom_DHTML_widgets)
-   [Firefox 3](http://www.mozilla.com/en-US/firefox/)
-   [Internet Explorer 8 Beta 1](http://www.microsoft.com/windows/products/winfamily/ie/ie8/getitnow.mspx)
-   [NVDA Screen Reader](http://www.nvda-project.org/)
-   [Freedom Scientific JAWS Screen Reader](http://www.freedomscientific.com/fs_products/software_jaws.asp)
-   [GW Micro Window-Eyes Screen Reader](http://www.gwmicro.com/Window-Eyes/)
-   [An Introduction to Screen Readers](http://video.yahoo.com/video/play?vid=514676)
-   [Making Ajax Work with Screen Readers](http://juicystudio.com/article/making-ajax-work-with-screen-readers.php)