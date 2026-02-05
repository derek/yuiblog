<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>Dynamically Creating ContextMenu Instances</title>
        
        <!-- Standard reset and fonts -->
        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css">
        
        <!-- CSS for Menu -->
        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css">

        <style type="text/css">
        
            div#one,
            div#two,
            div#three,
            div#four {
            
                position:absolute;
                background-color:#ccc;
                width:200px;
                height:200px;
            
            }

            div#one h2,
            div#two h2,
            div#three h2,
            div#four h2,
            div#one p,
            div#two p,
            div#three p,
            div#four p {
            
                margin:.5em;
            
            }

            div#one {
            
                top:0;
                left:0;
            
            }

            div#two {
            
                top:0;
                right:0;
            
            }

            div#three {
            
                bottom:0;
                left:0;
            
            }
            
            div#four {
            
                bottom:0;
                right:0;
            
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

        <script type="text/javascript">

            function onWindowLoad(p_oEvent) {

                /*
                     Map of HTML element ids to data for items in 
                     ContextMenu instances
                */

                var oContextMenuData = {
                
                    "one": ["Item One", "Item Two", "Item Three", "Item Four"],
                    "two": ["Cut", "Copy", "Paste"],
                    "three": ["Add", "Edit", "Delete"],
                    "four": ["John", "Paul", "George", "Ringo"]
                
                };


                /*
                     Create an instance of the OverlayManager to keep track
                     of the various ContextMenu instances that are created
                */
                
                var oOverlayManager = new YAHOO.widget.OverlayManager();


                // "mousedown" event listener for each of the four DIVs

                function onDIVMouseOver(p_oEvent) {

                    /*
                        Only create a ContextMenu instance if one doesn't 
                        already exist for this element AND if the element's
                        id is found in the "oContextMenuData" map
                    */
                
                    var sMenuId = "menu_" + this.id;

                    if(!oOverlayManager.find(sMenuId) && oContextMenuData[this.id]) {
                    
                        // Instantiate a ContextMenu

                        var oContextMenu = new YAHOO.widget.ContextMenu(sMenuId, { trigger: this, constraintoviewport:true } );


                        /*
                             Add the items to the menu that match the id of the 
                             element that was clicked.
                        */

                        var aItems = oContextMenuData[this.id];
                        var nItems = aItems.length;
                        
                        for(var i=0; i<nItems; i++) {

                            oContextMenu.addItem(aItems[i]);
                        
                        }


                        oContextMenu.render(document.body);
                        
                        /*
                            Register the menu with the OverlayManager instance
                            so that we can maintain 
                        */

                        oOverlayManager.register(oContextMenu);

                    }
                
                }

                YAHOO.util.Event.addListener(["one","two","three","four"], "mouseover", onDIVMouseOver);
                
            }

            YAHOO.util.Event.addListener(window, "load", onWindowLoad);

        </script>
    </head>        
    <body>
    
        <div id="one">
            <h2>DIV #1</h2>
            <p>I have a unique context menu.</p>
        </div>

        <div id="two">
            <h2>DIV #2</h2>
            <p>I have a unique context menu.</p>
        </div>

        <div id="three">
            <h2>DIV #3</h2>
            <p>I have a unique context menu.</p>
        </div>
        
        <div id="four">
            <h2>DIV #4</h2>
            <p>I have a unique context menu.</p>
        </div>
        
    </body>
</html>