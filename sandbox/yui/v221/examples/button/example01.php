<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Example: Checkbox Buttons (YUI Library)</title>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="../../build/reset/reset-min.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts-min.css">
        <link rel="stylesheet" type="text/css" href="../../build/button/assets/button.css">
 
        <!-- Page-specific styles -->
        <style type="text/css">

            body { margin:.5em; }

            h1 { font-weight:bold; }

            fieldset, 
            fieldset div {

                border:2px groove #ccc;
                margin:.5em;
                padding:.5em;

            }

            /* Checked state for Button instances of type "checkbox" */
            
            .yuibutton.checkbox.checked {
                
                background-color:#ff0;
                
            }
            
            
            /* Checked state for Button instances of type "radio" */
            
            .yuibuttongroup .yuibutton.radio.checked {
            
                background-color:#f66;
            
            }

        </style>

        <!-- Dependencies -->
        <script type="text/javascript" src="../../build/yahoo-dom-event/yahoo-dom-event.js"></script>
        <script type="text/javascript" src="../../build/element/element-beta-min.js"></script>
        
        <!-- Source file -->
        <script type="text/javascript" src="../../build/button/button-beta-min.js"></script>

        <!-- Page-specific JavaScript -->
        <script type="text/javascript">

            YAHOO.example.init = function () {

                // "contentready" event handler for the "checkboxbuttonsfrommarkup" <fieldset>

                function onCheckboxButtonsMarkupReady() {
            
                    // Create Buttons using existing <input> elements as a data source
            
                    var oCheckButton1 = new YAHOO.widget.Button("checkbutton1src", { id:"checkbutton1", label:"One" });
                    var oCheckButton2 = new YAHOO.widget.Button("checkbutton2src", { id:"checkbutton2", label:"Two" });
                    var oCheckButton3 = new YAHOO.widget.Button("checkbutton3src", { id:"checkbutton3", label:"Three" });
                    var oCheckButton4 = new YAHOO.widget.Button("checkbutton4src", { id:"checkbutton4", label:"Four" });
        

                    // Create Buttons using the YUI Button markup

                    var oCheckButton5 = new YAHOO.widget.Button("checkbutton5", { type:"checkbox", value:"1", checked:true });
                    var oCheckButton6 = new YAHOO.widget.Button("checkbutton6", { type:"checkbox", value:"2"});
                    var oCheckButton7 = new YAHOO.widget.Button("checkbutton7", { type:"checkbox", value:"3" });
                    var oCheckButton8 = new YAHOO.widget.Button("checkbutton8", { type:"checkbox", value:"4" });

                }

                YAHOO.util.Event.onContentReady("checkboxbuttonsfrommarkup", onCheckboxButtonsMarkupReady);


                // Create Buttons without using existing markup

                var oCheckButton9 = new YAHOO.widget.Button({ type:"checkbox", label:"One", id:"checkbutton9", name:"checkboxfield3", value:"1", container:"checkboxbuttonsfromjavascript", checked:true });
                var oCheckButton10 = new YAHOO.widget.Button({ type:"checkbox", label:"Two", id:"checkbutton10", name:"checkboxfield3", value:"2", container:"checkboxbuttonsfromjavascript" });
                var oCheckButton11 = new YAHOO.widget.Button({ type:"checkbox", label:"Three", id:"checkbutton11", name:"checkboxfield3", value:"3", container:"checkboxbuttonsfromjavascript" });
                var oCheckButton12 = new YAHOO.widget.Button({ type:"checkbox", label:"Four", id:"checkbutton12", name:"checkboxfield3", value:"4", container:"checkboxbuttonsfromjavascript" });


                // "contentready" event handler for the "radiobuttonsfrommarkup" <fieldset>    
    
                function onRadioButtonMarkupReady() {
    
                    var oButtonGroup1 = new YAHOO.widget.ButtonGroup("buttongroup1");
                    var oButtonGroup2 = new YAHOO.widget.ButtonGroup("buttongroup2");
    
                }
    
                YAHOO.util.Event.onContentReady("radiobuttonsfrommarkup", onRadioButtonMarkupReady);
    
    
                // Create a ButtonGroup without using existing markup

                var oButtonGroup3 = new YAHOO.widget.ButtonGroup({ id: "buttongroup3", name: "radiofield3", container:"radiobuttonsfromjavascript" });
    
                oButtonGroup3.addButtons([
    
                    { label:"Radio 9", value:"Radio 9", checked:true },
                    { label:"Radio 10", value:"Radio 10" }, 
                    { label:"Radio 11", value:"Radio 11" }, 
                    { label:"Radio 12", value:"Radio 12" }
    
                ]);

            } ();

        </script>

    </head>
    <body>

        <h1>Example: Customizing "checked" state for Buttons (YUI Library)</h1>

        <form id="example" name="example" method="post" action="example03.html">

            <fieldset id="checkboxbuttons">
                <legend>Checkbox Buttons</legend>

                <fieldset id="checkboxbuttonsfrommarkup">
                    <legend>From Markup</legend>

                    <div>
                        <input id="checkbutton1src" type="checkbox" name="checkboxfield1" value="1" checked>
                        <input id="checkbutton2src" type="checkbox" name="checkboxfield1" value="2">
                        <input id="checkbutton3src" type="checkbox" name="checkboxfield1" value="3">
                        <input id="checkbutton4src" type="checkbox" name="checkboxfield1" value="4">
                    </div>

                    <div>
                        <span id="checkbutton5" class="yuibutton"><span class="first-child"><button type="button" name="checkboxfield2">One</button></span></span>
                        <span id="checkbutton6" class="yuibutton"><span class="first-child"><button type="button" name="checkboxfield2">Two</button></span></span>
                        <span id="checkbutton7" class="yuibutton"><span class="first-child"><button type="button" name="checkboxfield2">Three</button></span></span>
                        <span id="checkbutton8" class="yuibutton"><span class="first-child"><button type="button" name="checkboxfield2">Four</button></span></span>
                    </div>

                </fieldset>

                <fieldset id="checkboxbuttonsfromjavascript">
                    <legend>From JavaScript</legend>
                </fieldset>

            </fieldset>


            <fieldset id="radiobuttons">
                <legend>Radio Buttons</legend>

                <fieldset id="radiobuttonsfrommarkup">
                    <legend>From Markup</legend>

                    <div class="yuibuttongroup" id="buttongroup1">
                        <input id="radio1" type="radio" name="radiofield1" value="Radio 1" checked>
                        <input id="radio2" type="radio" name="radiofield1" value="Radio 2">
                        <input id="radio3" type="radio" name="radiofield1" value="Radio 3">
                        <input id="radio4" type="radio" name="radiofield1" value="Radio 4">
                    </div>

                    <div class="yuibuttongroup" id="buttongroup2">
                        <span id="radio5" class="yuibutton checked"><span class="first-child"><button type="button" name="radiofield2" value="Radio 5">Radio 5</button></span></span>
                        <span id="radio6" class="yuibutton"><span class="first-child"><button type="button" name="radiofield2" value="Radio 6">Radio 6</button></span></span>
                        <span id="radio7" class="yuibutton"><span class="first-child"><button type="button" name="radiofield2" value="Radio 7">Radio 7</button></span></span>
                        <span id="radio8" class="yuibutton"><span class="first-child"><button type="button" name="radiofield2" value="Radio 8">Radio 8</button></span></span>
                    </div>

                </fieldset>

                <fieldset id="radiobuttonsfromjavascript">
                    <legend>From JavaScript</legend>
                </fieldset>

            </fieldset>

        </form>

    </body>
</html>