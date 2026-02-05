
(function () {
	var Dom = YAHOO.util.Dom,
		Event = YAHOO.util.Event,
		Connect = YAHOO.util.Connect,
		json = YAHOO.lang.JSON,
		ButtonGroup = YAHOO.widget.ButtonGroup,
		Button = YAHOO.widget.Button,
		ButtonWrapper = YAHOO.widget.ButtonWrapper,
		Paginator = YAHOO.widget.Paginator;
	
	Event.onContentReady('searchPage', function () {
		var textInputs,
			textMenu,
			sortDir,
			inputID,
			pagControls,
			submitContainer,
			subButton,
			callback,
			searchForm,
			changeRequestHandler; 
		// ButtonWrapper.createTextInput('textInput1');
		//textInput2 = ButtonWrapper.createTextInput('textInput2'),
		//textInput3 = ButtonWrapper.createTextInput('textInput3', {isDark: true}),
		//textInput4 = ButtonWrapper.createTextInput('textInput4'),
		//textInput5 = ButtonWrapper.createTextInput('textInput5', {noWatermark: true}),
		//textInput6 = ButtonWrapper.createTextInput('textInput6'),
		//textInput7 = ButtonWrapper.createTextInput('textInput7', {width: 100}),
		//textInput8 = ButtonWrapper.createTextInput('textInput8'),
		//textInput9 = ButtonWrapper.createTextInput('textInput9', {isDark: true, noWatermark: true, width: 230});
		
		textInputs = Dom.getElementsByClassName('textInput', 'INPUT', 'searchPage');
		Dom.batch(textInputs, function (el) {
			inputID = Dom.generateId(el);
			textInputs[inputID] = ButtonWrapper.createTextInput(inputID, {isDark: false});
		});
		
		textMenu = Dom.getElementsByClassName('textMenu', 'INPUT', 'searchPage');

		var oButton;

		Dom.batch(textMenu, function (el) {
			
			//	Note: Button will automatically generate IDs for buttons, so no
			//	need to use  "Dom.generateId".  Also, Button has 
			//	"menuminscrollheight" and "menumaxheight" attributes for setting
			//	its Menu's "minscrollheight" and "maxscrollheight" properties.

			//	inputID = Dom.generateId(el);
			//	textMenu[inputID] = ButtonWrapper.createSelectButton(inputID, {}, {minscrollheight: 900, maxheight: 900});
			
			oButton = ButtonWrapper.createSelectButton(el);
			textMenu[inputID] = oButton.get("id");
			
		});

		sortDir = Dom.getElementsByClassName('sortDir', 'DIV', 'searchPage');
		Dom.batch(sortDir, function (el) {
			inputID = Dom.generateId(el);
			sortDir[inputID] = new ButtonGroup(inputID);
			if (sortDir[inputID].getButton(1).get('value') == 'down') {
				Dom.addClass(Dom.getChildren(el)[1], 'sortDown');
			}
		});
		
		changeRequestHandler = function (state) {
			pagControls.setState({
				rowsPerPage: state.rowsPerPage
			});
			searchForm = Dom.get('searchForm');
			YAHOO.widget.Button.addHiddenFieldsToForm(searchForm);
			Connect.setForm(searchForm);
			Connect.asyncRequest('POST', 'search_adv.php?case=search_sub&recordOffset=' + state.recordOffset +
					'&rowsPerPage=' + state.rowsPerPage, callback);
		};
		
		pagControls = new Paginator({
		    rowsPerPage : 25, // one div per page
		    containers : 'pagControls', // controls will be rendered into this element
		    rowsPerPageOptions: [{value: 25, text: '25'}, {value: 50, text: '50'}, {value: 100, text: '100'}, {value: 200, text: '200'}],
		    template : "{FirstPageLink} {PreviousPageLink} {PageLinks} {NextPageLink} {LastPageLink} Show: {RowsPerPageDropdown}" 
		});
		pagControls.render();
		pagControls.subscribe('changeRequest', changeRequestHandler);
		submitContainer = document.createElement('div');
		submitContainer.id = 'submitContainer'
		Dom.get('pagControls').appendChild(submitContainer);
		subButton = new Button(submitContainer, {
			label: 'Search',
			onclick: {
				fn: function (e) {
					var rowsPerPage;
					Event.preventDefault(e);
					// searchForm
					searchForm = Dom.get('searchForm');
					YAHOO.widget.Button.addHiddenFieldsToForm(searchForm);
					Connect.setForm(searchForm);
					rowsPerPage = pagControls.getState()['rowsPerPage'];
					Connect.asyncRequest('POST', 'search_adv.php?case=search_sub&rowsPerPage=' + rowsPerPage, callback);
				}
			}
		});
		
		callback = {
			success: function (o) {
				Dom.get('ajaxout').innerHTML = o.responseText;
				var output = json.parse(o.responseText);
				pagControls.setState({
					rowsPerPage: parseInt(output.rowsPerPage, 10),
					recordOffset: parseInt(output.recordOffset, 10),
					totalRecords: parseInt(output.totalRecords, 10)
				});
				Dom.get('ajaxout').innerHTML = output.output;
			},
			failure: function (o) {
				Dom.get('ajaxout').innerHTML = o.responseText;
			}
		};
	});
}());