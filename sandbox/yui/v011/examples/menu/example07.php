<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Context Menu Example</title>

        <!-- Standard reset and fonts -->
        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css">

        <!-- CSS for Menu -->
        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css">
 
        <!-- Page-specific styles -->
        <style type="text/css">
            
            #ewes img.disabled {

                opacity:.5;
                filter:alpha(opacity=50);
            
            }
            
        </style>

        <!-- Namespace source file -->
        <script type="text/javascript" src="../../build/yahoo/yahoo.js"></script>

        <!-- Dependency source files -->
        <script type="text/javascript" src="../../build/event/event.js"></script>
        <script type="text/javascript" src="../../build/dom/dom.js"></script>

        <!-- Container source file -->
        <script type="text/javascript" src="../../build/container/container_core.js"></script>

        <!-- Menu source file -->
        <script type="text/javascript" src="../../build/menu/menu.js"></script>

        <!-- Page-specific script -->
        <script type="text/javascript">


            // "click" event handler for each item in the context menu
            
            function onContextMenuItemClick(p_sType, p_aArguments) {

                var oTarget = this.parent.contextEventTarget;

                if(oTarget.tagName == "IMG") {

                    if(YAHOO.util.Dom.hasClass(oTarget, "disabled")) {

                        YAHOO.util.Dom.removeClass(oTarget, "disabled");
                    
                    }
                    else {

                        YAHOO.util.Dom.addClass(oTarget, "disabled");
                    
                    }
                
                }

                this.parent.hide();
            
            }


            // "beforeshow" event handler for the context menu

            function onBeforeShowContextMenu(p_sType, p_aArguments) {

                var oTarget = this.contextEventTarget;

                if(oTarget.tagName == "IMG") {
                    
                    var sText = YAHOO.util.Dom.hasClass(oTarget, "disabled") ? "enable" : "disable";

                    this.getItem(0).cfg.setProperty("text", sText);
                
                }
            
            }


            // "load" event handler for the "window" object       

            function onWindowLoad(p_oEvent) {

                // Create the context menu

                var oContextMenu = new YAHOO.widget.ContextMenu(
                                        "contextmenu", 
                                        { trigger: "ewes" } 
                                    );

                var oItem = oContextMenu.addItem("enable");


                // Add a "click" event handler to the item

                oItem.clickEvent.subscribe(onContextMenuItemClick);


                // Add a "beforeshow" event handler to the context menu

                oContextMenu.beforeShowEvent.subscribe(onBeforeShowContextMenu, oContextMenu, true);


                // Render the context menu

                oContextMenu.render(document.body);


            }


            // Assign a "load" event handler to the window

            YAHOO.util.Event.addListener(window, "load", onWindowLoad);
                    
        </script>

    </head>
    <body>

        <div id="ewes">
            <img class="disabled" src="img/dolly.jpg" width="100" height="100" alt="Dolly, a ewe, the first mammal to have been successfully cloned from an adult cell.">
            <img src="img/dolly.jpg" width="100" height="100" alt="Dolly, a ewe, the first mammal to have been successfully cloned from an adult cell.">
            <img class="disabled" src="img/dolly.jpg" width="100" height="100" alt="Dolly, a ewe, the first mammal to have been successfully cloned from an adult cell.">
            <img src="img/dolly.jpg" width="100" height="100" alt="Dolly, a ewe, the first mammal to have been successfully cloned from an adult cell.">
            <img src="img/dolly.jpg" width="100" height="100" alt="Dolly, a ewe, the first mammal to have been successfully cloned from an adult cell.">
        </div>

    </body>
</html>