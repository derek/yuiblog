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