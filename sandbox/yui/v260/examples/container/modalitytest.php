<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>YUI Modal Dialog Speed Test</title>


        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/fonts/fonts-min.css">
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com2.6.0/build/container/assets/skins/sam/container.css">

        <script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
        <script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/container/container-min.js"></script>

        <script type="text/javascript">

			(function () {
			
				var Dom = YAHOO.util.Dom,
					Event = YAHOO.util.Event,

					aElementTypes = ["a", "input", "select", "textarea", "button"],
					nElementTypes = aElementTypes.length,

					sTextInputHTML = "<input type='text'>",
					sSelectHTML = "<select><option>Foo</option></select>",
					sAnchorHTML = "<a href='http://www.yahoo.com'>Yahoo!</a>",
					sTextAreaHTML = "<textarea></textarea>",
					sButtonHTML = "<button>Click Me!</button>",
					
					BUTTON = "button",
					TEXTAREA = "textarea",
					INPUT = "input",
					SELECT = "select",
					A = "a",
					
					oPanel;
						

				var setUpTest = function () {

					var nFocusableElements = parseInt(Dom.get("focusable-elements").value, 10),
						aElements = [],
						sElement,
						sTag,
						i,
						j;


					if (nFocusableElements > 0) {

						for (i = 0; i < nFocusableElements; i++) {
		
							for (j = 0; j < nElementTypes; j++) {

								sTag = aElementTypes[j];

								switch (sTag) {
								
									case TEXTAREA:
										sElement = sTextAreaHTML;
									break;

									case BUTTON:
										sElement = sButtonHTML;
									break;
								
									case INPUT:
										sElement = sTextInputHTML;
									break;
									
									case SELECT:
										sElement = sSelectHTML;
									break;									

									case A:
										sElement = sAnchorHTML;
									break;								

								}
								
								aElements[aElements.length] = sElement;

							}

						}


						Dom.get("container-1").innerHTML = aElements.join("");
					
					}
				
				};
	

				Event.on("setup-button", "click", function() {

					if (!oPanel) {

						oPanel = new YAHOO.widget.Panel("oPanel", {
							width: "450px",
							modal: true,
							visible: false,
							fixedcenter: true
						});
		
						oPanel.setHeader("Header");
						oPanel.setBody('<a href="#">Foo</a><input type="text" /><select><option>Foo</option><option>Bar</option></select>');
						oPanel.setFooter("Footer");
						oPanel.render("container-2");

					}

					setUpTest();
					
				});


				Event.on("run-button", "click", function () {

					if (oPanel) {

						var oStartTime = new Date().getTime();
	
						oPanel.show();
						
						var oEndTime = new Date().getTime();
						var oTime = oEndTime - oStartTime;
						
						Dom.get("time-to-show").value = oTime;
						
	
						oStartTime = new Date().getTime();					
	
						oPanel.hide();
						
						oEndTime = new Date().getTime();						
						oTime = oEndTime - oStartTime;
						
						Dom.get("time-to-hide").value = oTime;
						
						Dom.get("container-1").innerHTML = "";
					
					}
				
				});

			}());

        </script>
    </head>

    <body class="yui-skin-sam">

		<h1>YUI Modal Dialog Speed Test</h1>
		<p>This page is designed to test how long it takes to show and hide a modal Dialog in YUI 2.6.0 vs. YUI 2.5.2.  By default this page uses YUI 2.6.0.  Change to YUI 2.5.2 by adding "?yuiversion=2.5.2" to the URL.<p>

		<fieldset>
			<legend>Test Configuration</legend>
			<div>
				<label for="focusable-elements">Number of focusable elements to create: </label>
				<input type="text" id="focusable-elements" name="focusable-elements" value="250">
			</div>
			<button id="setup-button">Setup Test</button>
			<button id="run-button">Run Test</button>			
		</fieldset>


		<fieldset>
			<legend>Test Results</legend>
			<div>
				<label for="time-to-show">Time to show: <label><input type="text" id="time-to-show" name="time-to-show">
			</div>
			<div>
				<label for="time-to-hide">Time to hide: <label><input type="text" id="time-to-hide" name="time-to-hide">			
			</div>
		</fieldset>

        <div id="container-1"></div>
        <div id="container-2"></div>

    </body>
</html>