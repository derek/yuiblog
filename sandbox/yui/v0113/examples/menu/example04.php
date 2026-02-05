<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>Dynamic ContextMenu Example</title>
        
        <!-- Standard reset and fonts -->
        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css">
        
        <!-- CSS for Menu -->
        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css">

        <!-- Namespace source file -->
        <script type="text/javascript" src="../../build/yahoo/yahoo.js"></script>
        
        <!-- Dependency source files -->
        <script type="text/javascript" src="../../build/event/event.js"></script>
        <script type="text/javascript" src="../../build/dom/dom.js"></script>
        
        <!-- Container source file -->
        <script type="text/javascript" src="../../build/container/container_core.js"></script>

        <!-- Menu source file -->
        <script type="text/javascript" src="../../build/menu/menu.js"></script>

        <script type="text/javascript">


            // "click" event handler for an item in a ContextMenu instance

            function onMenuItemClick(p_sType, p_aArguments) {
        
                alert('clicked!');
        
            }


            function onWindowLoad(p_oEvent) {

                /*
                     Create an instance of the OverlayManager to keep track
                     of the various ContextMenu instances that are created
                */
                
                var oOverlayManager = new YAHOO.widget.OverlayManager();

                
                function onLIMouseOver(p_oEvent, p_nImportantValue) {

                    /*
                        Only create a ContextMenu instance if one doesn't 
                        already exist for this element
                    */
                
                    var sMenuId = "menu_" + this.id;

                    if(!oOverlayManager.find(sMenuId)) {
                    
                        var oContextMenu = new YAHOO.widget.ContextMenu(sMenuId, { trigger: this } );
                        
                        oItem = oContextMenu.addItem("ContextMenu for #"+ p_nImportantValue);

                        oItem.clickEvent.subscribe(onMenuItemClick);

                        oContextMenu.addItem("item 2");
                        oContextMenu.addItem("item 3");

                        oContextMenu.render(document.body);
                        
                        oOverlayManager.register(oContextMenu);
                    
                    }
                
                }


                /*
                     Add a "mouseover" event handler to each of the anchors 
                     that will create a context menu for the element.
                */

                YAHOO.util.Event.addListener("bbb48", "mouseover", onLIMouseOver, 48);
                YAHOO.util.Event.addListener("bbb49", "mouseover", onLIMouseOver, 49);
                
            }

            YAHOO.util.Event.addListener(window, "load", onWindowLoad);

        </script>
    </head>        
    <body>
    
        <a id="bbb48" href="#" TITLE="Test 1">Test 1</a><BR>
        <a id="bbb49" href="#" TITLE="Test 2">Test 2</a>
        
    </body>
</html>