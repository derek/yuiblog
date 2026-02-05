<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
	
        <title>Example: Applying Panel & Dialog Memory Leak Patch (YUI Library)</title>
	
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

		<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.2.0/build/fonts/fonts-min.css">
		<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.2.0/build/reset/reset-min.css">
		<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.2.0/build/container/assets/container.css">

        <style tyep="text/css">

            h1 {
            
                font-weight:bold;
            
            }

            body {
            
               padding:.5em;
            
            }

            p {
            
               margin:.5em 0;
            
            }
            
        </style>


		<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/utilities/utilities.js"></script>
  		<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/container/container-min.js"></script>
        <script type="text/javascript" src="mem_leak_patch.js"></script>

		<script type="text/javascript">


            function handleSubmit() {

                alert("You clicked the \"Submit\" button.");

            }

            function handleCancel() {
    
                this.cancel();

            }


            var aButtons = [ { text:"Submit", handler:handleSubmit, isDefault:true },
                              { text:"Cancel", handler:handleCancel } ];

            var oDialog = null;

            function onCreateDialogClick() {

            	oDialog = new YAHOO.widget.Dialog("sampledialog",
            			{ 
            			  width: "300px",
            			  close: true,
            			  visible: true,
                          modal: true,
                          fixedcenter: true,
                          buttons: aButtons
            			 } );
            
            	oDialog.setHeader("Dialog Header");
            	oDialog.setBody("The body of the dialog.");

                oDialog.hideEvent.subscribe(function() {
                
                    oDialog.destroy();
                    oDialog = null;
                
                });

            	oDialog.render(document.body);

            }
            
            YAHOO.util.Event.onAvailable("createdialog", function() {

                YAHOO.util.Event.addListener(this, "click", onCreateDialogClick);
            
            });
            
		</script>

	</head>
    <body>

        <h1>Example: Applying Panel & Dialog Memory Leak Patch (YUI Library)</h1>

        <p>This example demonstrates how to apply a patch that fixes an IE memory leak in version 2.2.0 of Panel and Dialog.  Use the buttons below to create a YAHOO.widget.Dialog instance.  Each Dialog you create will be destroy when hidden.  You should see no memory leak in IE as you repeatedly create and destroy the Dialog.</p>

        <button type="button" id="createdialog">Create Dialog</button>

    </body>
</html>