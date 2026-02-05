<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Example: Basic Menu From Markup (YUI Library)</title>

                <!-- Standard reset and fonts -->

        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css">

 

        <!-- CSS for Menu -->

        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css">
 

        <!-- Page-specific styles -->

        <style type="text/css">

            body { margin:.5em; }

            h1 { font-weight:bold; }

            div.yuimenu {
            
                position:absolute;
                visibility:hidden;
            
            }

            p#clicknote {

                margin-top:1em;

            }

            p#clicknote em {
            
                font-weight:bold;
            
            }

            #dataset {

                border:solid 1px #000;

            }

            #dataset tr.odd {

                background-color:#ccc;
            
            }

            
            #dataset tr.selected {

                background-color:#039;
            
            }
            

            #dataset td {

                border:solid 1px #000;
                padding:.25em .5em;
            
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

            /**
            * @method enforceConstraints
            * @description The default event handler executed when the moveEvent is fired,  
            * if the "constraintoviewport" configuration property is set to true.
            * @param {String} type The name of the event that was fired.
            * @param {Array} args Collection of arguments sent when the 
            * event was fired.
            * @param {Array} obj Array containing the current Menu instance 
            * and the item that fired the event.
            */
            YAHOO.widget.Menu.prototype.enforceConstraints = function(type, args, obj) {

                var Dom = YAHOO.util.Dom;
                var oConfig = this.cfg;
                var pos = args[0];
            
                var x = pos[0];
                var y = pos[1];
            
                var offsetHeight = this.element.offsetHeight;
                var offsetWidth = this.element.offsetWidth;
            
                var viewPortWidth = YAHOO.util.Dom.getViewportWidth();
                var viewPortHeight = YAHOO.util.Dom.getViewportHeight();
            
                var scrollX = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
                var scrollY = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
            
                var topConstraint = scrollY + 10;
                var leftConstraint = scrollX + 10;
                var bottomConstraint = scrollY + viewPortHeight - offsetHeight - 10;
                var rightConstraint = scrollX + viewPortWidth - offsetWidth - 10;

                var aContext = oConfig.getProperty("context");
                var oContextElement = aContext ? aContext[0] : null;
            
            
                if (x < 10) {
            
                    x = leftConstraint;
            
                } else if ((x + offsetWidth) > viewPortWidth) {
            
                    if(
                        oContextElement &&
                        ((x - oContextElement.offsetWidth) > offsetWidth)
                    ) {
            
                        x = (x - (oContextElement.offsetWidth + offsetWidth));
            
                    }
                    else {
            
                        x = rightConstraint;
            
                    }
            
                }
            
                if (y < 10) {
            
                    y = topConstraint;
            
                } else if (y > bottomConstraint) {
            
                    if(oContextElement && (y > offsetHeight)) {
            
                        y = ((y + oContextElement.offsetHeight) - offsetHeight);
            
                    }
                    else {
            
                        y = bottomConstraint;
            
                    }
            
                }

                oConfig.setProperty("x", x, true);
                oConfig.setProperty("y", y, true);
                oConfig.setProperty("xy", [x,y], true);
            
            };


            /**
            * @method focus
            * @description Causes the menu item to receive the focus and fires the 
            * focus event.
            */
            YAHOO.widget.MenuItem.prototype.focus = function() {
        
                var oParent = this.parent;
                var oAnchor = this._oAnchor;
                var oActiveItem = oParent.activeItem;
        
        
                function setFocus() {
        
                    oAnchor.focus();
                
                }
        
        
                if(
                    !this.cfg.getProperty("disabled") && 
                    oParent && 
                    oParent.cfg.getProperty("visible") && 
                    this.element.style.display != "none"
                ) {
        
                    if(oActiveItem) {
        
                        oActiveItem.blur();
        
                    }
        
                    try {
        
                        window.setTimeout(setFocus, 0);
        
                    }
                    catch(e) {
                    
                    }
                    
                    this.focusEvent.fire();
        
                }
        
            };



            /*
                 Utility function used to return the parent TR element of a 
                 child node
            */

            function GetTableRowFromEventTarget(p_oNode) {

                var oLI;

                if(p_oNode.tagName == "TR") {
                
                    oLI = p_oNode;

                }
                else {

                    /*
                         If the target of the event was a child of a TR, 
                         get the parent TR element
                    */

                    do {
    
                        if(p_oNode.tagName == "TR") {

                            oLI = p_oNode;                            

                            break;
                        
                        }
    
                    }
                    while((p_oNode = p_oNode.parentNode));
                
                }

                return oLI;
            
            }


            // "load" event handler for the window

            function onWindowLoad(p_oEvent) {

                var aItemData = [
                
                    "Menu Item 1",
                    "Menu Item 2",
                    "Menu Item 3",
                    "Menu Item 4",
                    "Menu Item 5",
                    "Menu Item 6",
                    "Menu Item 7",
                    "Menu Item 8",
                    "Menu Item 9",
                    "Menu Item 10"
    
                ];
    

                // Create the context menu

                var oContextMenu = new YAHOO.widget.ContextMenu("contextmenu", 
                                        {
                                            trigger:"dataset",
                                            lazyload: true,
                                            itemdata: aItemData
                                        }
                                    );


                // "show" event handler for the context menu

                function onContextMenuShow(p_sType, p_aArgs, p_oMenu) {

                    var oTR = GetTableRowFromEventTarget(this.contextEventTarget);

                    YAHOO.util.Dom.addClass(oTR, "selected");
                
                }


                // "hide" event handler for the context menu

                function onContextMenuHide(p_sType, p_aArgs, p_oMenu) {

                    var oTR = GetTableRowFromEventTarget(this.contextEventTarget);

                    YAHOO.util.Dom.removeClass(oTR, "selected");
                
                }


                // Subscribe to the "show" and "hide" events

                oContextMenu.showEvent.subscribe(onContextMenuShow, oContextMenu, true);
                oContextMenu.hideEvent.subscribe(onContextMenuHide, oContextMenu, true);

            }

            YAHOO.util.Event.addListener(window, "load", onWindowLoad);

        </script>

    </head>
    <body>

        <table id="dataset">
            <tr class="odd"><td>Row 0, Column 1</td><td>Row 0, Column 2</td><td>Row 0, Column 3</td><td>Row 0, Column 4</td></tr>
            <tr><td>Row 1, Column 1</td><td>Row 1, Column 2</td><td>Row 1, Column 3</td><td>Row 1, Column 4</td></tr>
            <tr class="odd"><td>Row 2, Column 1</td><td>Row 2, Column 2</td><td>Row 2, Column 3</td><td>Row 2, Column 4</td></tr>
            <tr><td>Row 3, Column 1</td><td>Row 3, Column 2</td><td>Row 3, Column 3</td><td>Row 3, Column 4</td></tr>
            <tr class="odd"><td>Row 4, Column 1</td><td>Row 4, Column 2</td><td>Row 4, Column 3</td><td>Row 4, Column 4</td></tr>
            <tr><td>Row 5, Column 1</td><td>Row 5, Column 2</td><td>Row 5, Column 3</td><td>Row 5, Column 4</td></tr>
            <tr class="odd"><td>Row 6, Column 1</td><td>Row 6, Column 2</td><td>Row 6, Column 3</td><td>Row 6, Column 4</td></tr>
            <tr><td>Row 7, Column 1</td><td>Row 7, Column 2</td><td>Row 7, Column 3</td><td>Row 7, Column 4</td></tr>
            <tr class="odd"><td>Row 8, Column 1</td><td>Row 8, Column 2</td><td>Row 8, Column 3</td><td>Row 8, Column 4</td></tr>
            <tr><td>Row 9, Column 1</td><td>Row 9, Column 2</td><td>Row 9, Column 3</td><td>Row 9, Column 4</td></tr>
            <tr class="odd"><td>Row 10, Column 1</td><td>Row 10, Column 2</td><td>Row 10, Column 3</td><td>Row 10, Column 4</td></tr>
            <tr><td>Row 11, Column 1</td><td>Row 11, Column 2</td><td>Row 11, Column 3</td><td>Row 11, Column 4</td></tr>
            <tr class="odd"><td>Row 12, Column 1</td><td>Row 12, Column 2</td><td>Row 12, Column 3</td><td>Row 12, Column 4</td></tr>
            <tr><td>Row 13, Column 1</td><td>Row 13, Column 2</td><td>Row 13, Column 3</td><td>Row 13, Column 4</td></tr>
            <tr class="odd"><td>Row 14, Column 1</td><td>Row 14, Column 2</td><td>Row 14, Column 3</td><td>Row 14, Column 4</td></tr>
            <tr><td>Row 15, Column 1</td><td>Row 15, Column 2</td><td>Row 15, Column 3</td><td>Row 15, Column 4</td></tr>
            <tr class="odd"><td>Row 16, Column 1</td><td>Row 16, Column 2</td><td>Row 16, Column 3</td><td>Row 16, Column 4</td></tr>
            <tr><td>Row 17, Column 1</td><td>Row 17, Column 2</td><td>Row 17, Column 3</td><td>Row 17, Column 4</td></tr>
            <tr class="odd"><td>Row 18, Column 1</td><td>Row 18, Column 2</td><td>Row 18, Column 3</td><td>Row 18, Column 4</td></tr>
            <tr><td>Row 19, Column 1</td><td>Row 19, Column 2</td><td>Row 19, Column 3</td><td>Row 19, Column 4</td></tr>
            <tr class="odd"><td>Row 20, Column 1</td><td>Row 20, Column 2</td><td>Row 20, Column 3</td><td>Row 20, Column 4</td></tr>
            <tr><td>Row 21, Column 1</td><td>Row 21, Column 2</td><td>Row 21, Column 3</td><td>Row 21, Column 4</td></tr>
            <tr class="odd"><td>Row 22, Column 1</td><td>Row 22, Column 2</td><td>Row 22, Column 3</td><td>Row 22, Column 4</td></tr>
            <tr><td>Row 23, Column 1</td><td>Row 23, Column 2</td><td>Row 23, Column 3</td><td>Row 23, Column 4</td></tr>
            <tr class="odd"><td>Row 24, Column 1</td><td>Row 24, Column 2</td><td>Row 24, Column 3</td><td>Row 24, Column 4</td></tr>
            <tr><td>Row 25, Column 1</td><td>Row 25, Column 2</td><td>Row 25, Column 3</td><td>Row 25, Column 4</td></tr>
            <tr class="odd"><td>Row 26, Column 1</td><td>Row 26, Column 2</td><td>Row 26, Column 3</td><td>Row 26, Column 4</td></tr>
            <tr><td>Row 27, Column 1</td><td>Row 27, Column 2</td><td>Row 27, Column 3</td><td>Row 27, Column 4</td></tr>
            <tr class="odd"><td>Row 28, Column 1</td><td>Row 28, Column 2</td><td>Row 28, Column 3</td><td>Row 28, Column 4</td></tr>
            <tr><td>Row 29, Column 1</td><td>Row 29, Column 2</td><td>Row 29, Column 3</td><td>Row 29, Column 4</td></tr>
            <tr class="odd"><td>Row 30, Column 1</td><td>Row 30, Column 2</td><td>Row 30, Column 3</td><td>Row 30, Column 4</td></tr>
            <tr><td>Row 31, Column 1</td><td>Row 31, Column 2</td><td>Row 31, Column 3</td><td>Row 31, Column 4</td></tr>
            <tr class="odd"><td>Row 32, Column 1</td><td>Row 32, Column 2</td><td>Row 32, Column 3</td><td>Row 32, Column 4</td></tr>
            <tr><td>Row 33, Column 1</td><td>Row 33, Column 2</td><td>Row 33, Column 3</td><td>Row 33, Column 4</td></tr>
            <tr class="odd"><td>Row 34, Column 1</td><td>Row 34, Column 2</td><td>Row 34, Column 3</td><td>Row 34, Column 4</td></tr>
            <tr><td>Row 35, Column 1</td><td>Row 35, Column 2</td><td>Row 35, Column 3</td><td>Row 35, Column 4</td></tr>
            <tr class="odd"><td>Row 36, Column 1</td><td>Row 36, Column 2</td><td>Row 36, Column 3</td><td>Row 36, Column 4</td></tr>
            <tr><td>Row 37, Column 1</td><td>Row 37, Column 2</td><td>Row 37, Column 3</td><td>Row 37, Column 4</td></tr>
            <tr class="odd"><td>Row 38, Column 1</td><td>Row 38, Column 2</td><td>Row 38, Column 3</td><td>Row 38, Column 4</td></tr>
            <tr><td>Row 39, Column 1</td><td>Row 39, Column 2</td><td>Row 39, Column 3</td><td>Row 39, Column 4</td></tr>
            <tr class="odd"><td>Row 40, Column 1</td><td>Row 40, Column 2</td><td>Row 40, Column 3</td><td>Row 40, Column 4</td></tr>
            <tr><td>Row 41, Column 1</td><td>Row 41, Column 2</td><td>Row 41, Column 3</td><td>Row 41, Column 4</td></tr>
            <tr class="odd"><td>Row 42, Column 1</td><td>Row 42, Column 2</td><td>Row 42, Column 3</td><td>Row 42, Column 4</td></tr>
            <tr><td>Row 43, Column 1</td><td>Row 43, Column 2</td><td>Row 43, Column 3</td><td>Row 43, Column 4</td></tr>
            <tr class="odd"><td>Row 44, Column 1</td><td>Row 44, Column 2</td><td>Row 44, Column 3</td><td>Row 44, Column 4</td></tr>
            <tr><td>Row 45, Column 1</td><td>Row 45, Column 2</td><td>Row 45, Column 3</td><td>Row 45, Column 4</td></tr>
            <tr class="odd"><td>Row 46, Column 1</td><td>Row 46, Column 2</td><td>Row 46, Column 3</td><td>Row 46, Column 4</td></tr>
            <tr><td>Row 47, Column 1</td><td>Row 47, Column 2</td><td>Row 47, Column 3</td><td>Row 47, Column 4</td></tr>
            <tr class="odd"><td>Row 48, Column 1</td><td>Row 48, Column 2</td><td>Row 48, Column 3</td><td>Row 48, Column 4</td></tr>
            <tr><td>Row 49, Column 1</td><td>Row 49, Column 2</td><td>Row 49, Column 3</td><td>Row 49, Column 4</td></tr>
            <tr class="odd"><td>Row 50, Column 1</td><td>Row 50, Column 2</td><td>Row 50, Column 3</td><td>Row 50, Column 4</td></tr>
            <tr><td>Row 51, Column 1</td><td>Row 51, Column 2</td><td>Row 51, Column 3</td><td>Row 51, Column 4</td></tr>
            <tr class="odd"><td>Row 52, Column 1</td><td>Row 52, Column 2</td><td>Row 52, Column 3</td><td>Row 52, Column 4</td></tr>
            <tr><td>Row 53, Column 1</td><td>Row 53, Column 2</td><td>Row 53, Column 3</td><td>Row 53, Column 4</td></tr>
            <tr class="odd"><td>Row 54, Column 1</td><td>Row 54, Column 2</td><td>Row 54, Column 3</td><td>Row 54, Column 4</td></tr>
            <tr><td>Row 55, Column 1</td><td>Row 55, Column 2</td><td>Row 55, Column 3</td><td>Row 55, Column 4</td></tr>
            <tr class="odd"><td>Row 56, Column 1</td><td>Row 56, Column 2</td><td>Row 56, Column 3</td><td>Row 56, Column 4</td></tr>
            <tr><td>Row 57, Column 1</td><td>Row 57, Column 2</td><td>Row 57, Column 3</td><td>Row 57, Column 4</td></tr>
            <tr class="odd"><td>Row 58, Column 1</td><td>Row 58, Column 2</td><td>Row 58, Column 3</td><td>Row 58, Column 4</td></tr>
            <tr><td>Row 59, Column 1</td><td>Row 59, Column 2</td><td>Row 59, Column 3</td><td>Row 59, Column 4</td></tr>
            <tr class="odd"><td>Row 60, Column 1</td><td>Row 60, Column 2</td><td>Row 60, Column 3</td><td>Row 60, Column 4</td></tr>
            <tr><td>Row 61, Column 1</td><td>Row 61, Column 2</td><td>Row 61, Column 3</td><td>Row 61, Column 4</td></tr>
            <tr class="odd"><td>Row 62, Column 1</td><td>Row 62, Column 2</td><td>Row 62, Column 3</td><td>Row 62, Column 4</td></tr>
            <tr><td>Row 63, Column 1</td><td>Row 63, Column 2</td><td>Row 63, Column 3</td><td>Row 63, Column 4</td></tr>
            <tr class="odd"><td>Row 64, Column 1</td><td>Row 64, Column 2</td><td>Row 64, Column 3</td><td>Row 64, Column 4</td></tr>
            <tr><td>Row 65, Column 1</td><td>Row 65, Column 2</td><td>Row 65, Column 3</td><td>Row 65, Column 4</td></tr>
            <tr class="odd"><td>Row 66, Column 1</td><td>Row 66, Column 2</td><td>Row 66, Column 3</td><td>Row 66, Column 4</td></tr>
            <tr><td>Row 67, Column 1</td><td>Row 67, Column 2</td><td>Row 67, Column 3</td><td>Row 67, Column 4</td></tr>
            <tr class="odd"><td>Row 68, Column 1</td><td>Row 68, Column 2</td><td>Row 68, Column 3</td><td>Row 68, Column 4</td></tr>
            <tr><td>Row 69, Column 1</td><td>Row 69, Column 2</td><td>Row 69, Column 3</td><td>Row 69, Column 4</td></tr>
            <tr class="odd"><td>Row 70, Column 1</td><td>Row 70, Column 2</td><td>Row 70, Column 3</td><td>Row 70, Column 4</td></tr>
            <tr><td>Row 71, Column 1</td><td>Row 71, Column 2</td><td>Row 71, Column 3</td><td>Row 71, Column 4</td></tr>
            <tr class="odd"><td>Row 72, Column 1</td><td>Row 72, Column 2</td><td>Row 72, Column 3</td><td>Row 72, Column 4</td></tr>
            <tr><td>Row 73, Column 1</td><td>Row 73, Column 2</td><td>Row 73, Column 3</td><td>Row 73, Column 4</td></tr>
            <tr class="odd"><td>Row 74, Column 1</td><td>Row 74, Column 2</td><td>Row 74, Column 3</td><td>Row 74, Column 4</td></tr>
            <tr><td>Row 75, Column 1</td><td>Row 75, Column 2</td><td>Row 75, Column 3</td><td>Row 75, Column 4</td></tr>
            <tr class="odd"><td>Row 76, Column 1</td><td>Row 76, Column 2</td><td>Row 76, Column 3</td><td>Row 76, Column 4</td></tr>
            <tr><td>Row 77, Column 1</td><td>Row 77, Column 2</td><td>Row 77, Column 3</td><td>Row 77, Column 4</td></tr>
            <tr class="odd"><td>Row 78, Column 1</td><td>Row 78, Column 2</td><td>Row 78, Column 3</td><td>Row 78, Column 4</td></tr>
            <tr><td>Row 79, Column 1</td><td>Row 79, Column 2</td><td>Row 79, Column 3</td><td>Row 79, Column 4</td></tr>
            <tr class="odd"><td>Row 80, Column 1</td><td>Row 80, Column 2</td><td>Row 80, Column 3</td><td>Row 80, Column 4</td></tr>
            <tr><td>Row 81, Column 1</td><td>Row 81, Column 2</td><td>Row 81, Column 3</td><td>Row 81, Column 4</td></tr>
            <tr class="odd"><td>Row 82, Column 1</td><td>Row 82, Column 2</td><td>Row 82, Column 3</td><td>Row 82, Column 4</td></tr>
            <tr><td>Row 83, Column 1</td><td>Row 83, Column 2</td><td>Row 83, Column 3</td><td>Row 83, Column 4</td></tr>
            <tr class="odd"><td>Row 84, Column 1</td><td>Row 84, Column 2</td><td>Row 84, Column 3</td><td>Row 84, Column 4</td></tr>
            <tr><td>Row 85, Column 1</td><td>Row 85, Column 2</td><td>Row 85, Column 3</td><td>Row 85, Column 4</td></tr>
            <tr class="odd"><td>Row 86, Column 1</td><td>Row 86, Column 2</td><td>Row 86, Column 3</td><td>Row 86, Column 4</td></tr>
            <tr><td>Row 87, Column 1</td><td>Row 87, Column 2</td><td>Row 87, Column 3</td><td>Row 87, Column 4</td></tr>
            <tr class="odd"><td>Row 88, Column 1</td><td>Row 88, Column 2</td><td>Row 88, Column 3</td><td>Row 88, Column 4</td></tr>
            <tr><td>Row 89, Column 1</td><td>Row 89, Column 2</td><td>Row 89, Column 3</td><td>Row 89, Column 4</td></tr>
            <tr class="odd"><td>Row 90, Column 1</td><td>Row 90, Column 2</td><td>Row 90, Column 3</td><td>Row 90, Column 4</td></tr>
            <tr><td>Row 91, Column 1</td><td>Row 91, Column 2</td><td>Row 91, Column 3</td><td>Row 91, Column 4</td></tr>
            <tr class="odd"><td>Row 92, Column 1</td><td>Row 92, Column 2</td><td>Row 92, Column 3</td><td>Row 92, Column 4</td></tr>
            <tr><td>Row 93, Column 1</td><td>Row 93, Column 2</td><td>Row 93, Column 3</td><td>Row 93, Column 4</td></tr>
            <tr class="odd"><td>Row 94, Column 1</td><td>Row 94, Column 2</td><td>Row 94, Column 3</td><td>Row 94, Column 4</td></tr>
            <tr><td>Row 95, Column 1</td><td>Row 95, Column 2</td><td>Row 95, Column 3</td><td>Row 95, Column 4</td></tr>
            <tr class="odd"><td>Row 96, Column 1</td><td>Row 96, Column 2</td><td>Row 96, Column 3</td><td>Row 96, Column 4</td></tr>
            <tr><td>Row 97, Column 1</td><td>Row 97, Column 2</td><td>Row 97, Column 3</td><td>Row 97, Column 4</td></tr>
            <tr class="odd"><td>Row 98, Column 1</td><td>Row 98, Column 2</td><td>Row 98, Column 3</td><td>Row 98, Column 4</td></tr>
            <tr><td>Row 99, Column 1</td><td>Row 99, Column 2</td><td>Row 99, Column 3</td><td>Row 99, Column 4</td></tr>
        </table>

    </body>
</html>