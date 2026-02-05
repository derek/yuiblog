<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
	    <title>Example: Using Dialog's getData method (YUI Library)</title>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		
		<link type="text/css" rel="stylesheet" href="../../build/fonts/fonts.css">
		<link type="text/css" rel="stylesheet" href="../../build/reset/reset.css">
		<link type="text/css" rel="stylesheet" href="../../build/logger/assets/logger.css">
		<link type="text/css" rel="stylesheet" href="../../build/container/assets/container.css">

		<style type="text/css">

			body { background:#eee }
			#dialog1 label { display:block;float:left;width:45%;clear:left; }

            #logger {
            
               position:absolute;
               bottom:0;
               right:0;
            
            }

		</style>

		<script type="text/javascript" src="../../build/yahoo/yahoo.js"></script>
		<script type="text/javascript" src="../../build/event/event.js" ></script>
		<script type="text/javascript" src="../../build/dom/dom.js" ></script>
		<script type="text/javascript" src="../../build/logger/logger.js" ></script>
		<script type="text/javascript" src="../../build/dragdrop/dragdrop.js" ></script>
		<script type="text/javascript" src="../../build/container/container.js"></script>

		<script type="text/javascript">

            YAHOO.widget.Dialog.prototype.getData = function() {
            
                var oForm = this.form;
            
                if(oForm) {
            
                    var aElements = oForm.elements,
                        nTotalElements = aElements.length,
                        oData = {},
                        sName,
                        oElement;
            
            
                    for(var i=0; i<nTotalElements; i++) {
            
                        sName = aElements[i].name,
                        oElement = aElements[sName];
            
            
                        if(oElement) {
            
                            if(oElement.tagName) {
            
                                var sType = oElement.type,
                                    sTagName = oElement.tagName.toUpperCase();
            
                                switch(sTagName) {
            
                                    case "INPUT":
            
                                        if(sType == "checkbox") {
                    
                                            oData[sName] = oElement.checked;
                                        
                                        }
                                        else if(sType != "radio") {
                    
                                            oData[sName] = oElement.value;
                    
                                        }
                                    
                                    break;
            
                                    case "TEXTAREA":
            
                                        oData[sName] = oElement.value;
            
                                    break;
            
                                    case "SELECT":
            
                                        var aOptions = oElement.options,
                                            nOptions = aOptions.length,
                                            aValues = [],
                                            oOption,
                                            sValue;
            
            
                                        for(var n=0; n<nOptions; n++) {
            
                                            oOption = aOptions[n];
            
                                            if(oOption.selected) {
            
                                                sValue = oOption.value;
            
                                                if(!sValue || sValue === "") {
            
                                                    sValue = oOption.text;
            
                                                }
            
                                                aValues[aValues.length] = sValue;
                                            
                                            }
            
                                        }
            
                                        oData[sName] = aValues;
            
                                    break;
            
                                }
            
            
                            }
                            else {
            
                                var nElements = oElement.length,
                                    sType = oElement[0].type,
                                    sTagName = oElement[0].tagName.toUpperCase();
            
            
                                switch(sType) {
            
                                    case "radio":
            
                                        var oRadio;
            
                                        for(var n=0; n<nElements; n++) {
            
                                            oRadio = oElement[n];
            
                                            if(oRadio.checked) {
            
                                                oData[sName] = oRadio.value;
                                                break;
            
                                            }
            
                                        }
            
                                    break;
                                    
                                    case "checkbox":
            
                                        var aValues = [],
                                            oCheckbox;
            
                                        for(var n=0; n<nElements; n++) {
            
                                            oCheckbox = oElement[n];
            
                                            if(oCheckbox.checked) {
            
                                                aValues[aValues.length] = oCheckbox.value;
            
                                            }
            
                                        }
                                        
                                        oData[sName] = aValues;
            
                                    break;
            
                                }
            
                            }
                        
                        }
                    
                    }
            
                }
            
            
                return oData;
                
            };

            YAHOO.namespace("example.container");

            function onWindowLoad(p_oEvent) {

                var oLogReader = new YAHOO.widget.LogReader("logger");
                
                // Define various event handlers for Dialog
                var handleSubmit = function() {

                    var oData = oDialog.getData();

                    for(var sKey in oData) {

                        YAHOO.log(sKey + ": " + oData[sKey]);
                    
                    }

                };


                // Instantiate the Dialog
                var oDialog = new YAHOO.widget.Dialog("dialog1", 
                                                        { 
                                                            xy:[0,0],
                                                            width : "300px",
                                                            visible : false, 
                                                            constraintoviewport : true,
                                                            buttons : [ { text:"Submit", handler:handleSubmit, isDefault:true } ]
                                                        });

                
                // Render the Dialog
                oDialog.render();

                oDialog.show();

            }

            YAHOO.util.Event.addListener(window, "load", onWindowLoad);

		</script>

	</head>
	<body>

		<div id="dialog1">
			<div class="hd">Please enter your information</div>
			<div class="bd">
				<form method="POST" id="myform">

                    <div>
                        <label for="firstname">First Name:</label><input type="textbox" id="firstname" name="firstname">
                        <label for="lastname">Last Name:</label><input type="textbox" id="lastname" name="lastname">
                        <label for="email">E-mail:</label><input type="textbox" id="email" name="email"> 
    
                        <label for="state">State:</label>
                        <select multiple id="state" name="state" size="3">
                            <option value="California">California</option>
                            <option value="New Jersey">New Jersey</option>
                            <option value="New York">New York</option>
                        </select> 
					</div>

                    <div>
                        <label for="radiobutton1">Radio buttons:</label>
                        <input type="radio" id="radiobutton1" name="radiobuttons" value="1" checked> 1
                        <input type="radio" id="radiobutton2" name="radiobuttons" value="2"> 2
					</div>

                    <div>
    					<label for="checkbox1">Single checkbox:</label>
    					<input type="checkbox" id="checkbox1" name="singlecheckbox" value="1"> 1
                    </div>
						
                    <div>
    					<label for="textarea">Text area:</label>
    					<textarea id="textarea" name="textarea"></textarea>
                    </div>

                    <div>
                        <label for="checkbox2">Multi checkbox:</label>
                        <input type="checkbox" id="checkbox2" name="multicheckbox" value="1"> 1
                        <input type="checkbox" id="checkbox3" name="multicheckbox" value="2"> 2
                    </div>

				</form>
			</div>
		</div>
		
		<div id="logger"></div>

	</body>
</html>