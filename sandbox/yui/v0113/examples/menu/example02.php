<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>Generic Menu Test using YUI 0.11.3 </title>
        
        <!-- Standard reset and fonts -->
        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css">
        
        <!-- CSS for Menu -->
        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css">
        
        <!-- Page-specific styles -->
        <style type="text/css">

            body, html {
                padding: 0;
                margin: 0;
                font-size: 100%;
                font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
            }
            
            #hdr {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                border-bottom: 1px solid black;
                display: block;
                text-align: center;
            }
            
            #rop {
                width: 90%;
                margin-left: auto;
                margin-right: auto;
                padding-top: 0.5em;
                display: block;	
            }
            
            
            #rhc {
                display: block;
                float: left;
                width: 84%;
                border-left: 1px solid black;
            }
            
            h1, h2 {
                text-align: center;
                border: 0;
                margin: 0;
            }
            
            .img {
                margin: 0 auto;
                display: block;
                width: 691px;
            }
            
            .clearer {
                clear: both;
                line-height: 0.01em;
            }

        </style>
        <style media="print">

                #lhc {
                    width: 0;
                    display: none;
                }
                
                #rhc {
                    display: block;
                    float: left;
                    width: 100%;
                    border: 1px solid red;
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

                var oMenuBar = new YAHOO.widget.MenuBar("T4Graphs");
                oMenuBar.render();

                // "click" event handler for each item in the menubar

                function onMenuBarItemClick(p_sType, p_aArgs) {
                
                    var oEvent = p_aArgs[0];
                    var oTarget = YAHOO.util.Event.getTarget(oEvent);

                    if(oTarget != this.submenuIndicator) {

                        var oActiveItem = this.parent.activeItem;
                    
                    
                        // Hide any other submenus that might be visible
                    
                        if(oActiveItem && oActiveItem != this) {
                    
                            this.parent.clearActiveItem();
                    
                        }
                    
                    
                        // Select and focus the current MenuItem instance
                    
                        this.cfg.setProperty("selected", true);
                        this.focus();
                    
                    
                        // Show the submenu for this instance
                    
                        var oSubmenu = this.cfg.getProperty("submenu");
        
                        if(oSubmenu) {
                    
                            if(oSubmenu.cfg.getProperty("visible")) {
                            
                                oSubmenu.hide();
                            
                            }
                            else {
                            
                                oSubmenu.show();                    
                            
                            }
                    
                        }
                    
                    }
    
                }


                // Add a "click" handler to each item in the menubar

                var i = oMenuBar.getItemGroups()[0].length - 1,
                    oMenuBarItem;

                do {

                    oMenuBarItem = oMenuBar.getItem(i);
                    
                    if(oMenuBarItem) {

                        oMenuBarItem.clickEvent.subscribe(
                                onMenuBarItemClick,
                                oMenuBarItem,
                                true
                            );

                    }
                
                }
                while(i--);


                // "click" event handler for the document
    
                function onDocumentClick(p_oEvent) {
                
                    var oTarget = YAHOO.util.Event.getTarget(p_oEvent);

                    if(
                        oTarget != oMenuBar.element && 
                        !YAHOO.util.Dom.isAncestor(oMenuBar.element, oTarget)
                    ) {

                        YAHOO.example.OverlayManager.hideAll();
                        
                        if(oMenuBar.activeItem) {
    
                            oMenuBar.clearActiveItem();
                            oMenuBar.activeItem.blur();
                        
                        }

                    }

                }


                // Add a "click" handler for the document

                YAHOO.util.Event.addListener(
                        document, 
                        "click", 
                        onDocumentClick
                    );


                YAHOO.example.OverlayManager = 
                    new YAHOO.widget.OverlayManager();


                // Register the menus with the Overlay mananger

                var oTopLevel1 = oMenuBar.getItem(0).cfg.getProperty("submenu"),
                    oTopLevel2 = oMenuBar.getItem(1).cfg.getProperty("submenu"),
                    oTopLevel3 = oMenuBar.getItem(2).cfg.getProperty("submenu"),
                    oTopLevel4 = oMenuBar.getItem(3).cfg.getProperty("submenu"),
                    oTopLevel5 = oMenuBar.getItem(4).cfg.getProperty("submenu"),
                    oTopLevel6 = oMenuBar.getItem(5).cfg.getProperty("submenu"),
                    oTopLevel7 = oMenuBar.getItem(6).cfg.getProperty("submenu");


                YAHOO.example.OverlayManager.register([oTopLevel1, oTopLevel2, oTopLevel3, oTopLevel4, oTopLevel5, oTopLevel6, oTopLevel6]);
                
            }

            YAHOO.util.Event.addListener(window, "load", onWindowLoad);

        </script>
    </head>        
    <body>
    
        <div id="rop">
        <div id="T4Graphs" class="yuimenubar">
        <div class="bd">
        <ul class="first-of-type">
        <li class="yuimenubaritem">Top Level1
        <div id="top_level1" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">SUBLEVEL1.1
        
        <div id="sublevel1.1" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL1.2
        <div id="sublevel1.2" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL1.3
        <div id="sublevel1.3" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenubaritem">Top Level2
        <div id="top_level2" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">SUBLEVEL2.1
        <div id="sublevel2.1" class="yuimenu">
        <div class="bd">
        
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        
        <li class="yuimenuitem">SUBLEVEL2.2
        <div id="sublevel2.2" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        
        </div>
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL2.3
        <div id="sublevel2.3" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenubaritem">Top Level3
        <div id="top_level3" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">SUBLEVEL3.1
        <div id="sublevel3.1" class="yuimenu">
        <div class="bd">
        
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        
        <li class="yuimenuitem">SUBLEVEL3.2
        <div id="sublevel3.2" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        
        </div>
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL3.3
        <div id="sublevel3.3" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL3.4
        <div id="sublevel3.4" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenubaritem">Top Level4
        <div id="top_level4" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">SUBLEVEL4.1
        
        <div id="sublevel4.1" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL4.2
        <div id="sublevel4.2" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL4.3
        <div id="sublevel4.3" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenubaritem">Top Level5
        <div id="top_level5" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">SUBLEVEL5.1
        <div id="sublevel5.1" class="yuimenu">
        <div class="bd">
        
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        
        <li class="yuimenuitem">SUBLEVEL5.2
        <div id="sublevel5.2" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        
        </div>
        </div>
        </li>
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenubaritem">Top Level6
        <div id="top_level6" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">SUBLEVEL6.1
        <div id="sublevel6.1" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL6.2
        <div id="sublevel6.2" class="yuimenu">
        <div class="bd">
        
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenubaritem">Top Level7
        <div id="top_level7" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">SUBLEVEL7.1
        <div id="sublevel7.1" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        <li class="yuimenuitem">September 3, 2006</li>
        
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        <li class="yuimenuitem">SUBLEVEL7.2
        <div id="sublevel7.2" class="yuimenu">
        <div class="bd">
        <ul>
        <li class="yuimenuitem">September 5, 2006</li>
        <li class="yuimenuitem">September 4, 2006</li>
        
        <li class="yuimenuitem">September 3, 2006</li>
        <li class="yuimenuitem">September 2, 2006</li>
        <li class="yuimenuitem">September 1, 2006</li>
        <li class="yuimenuitem">August 31, 2006</li>
        </ul>
        </div>
        </div>
        </li>
        </ul>
        </div>
        </div>
        </li>
        </ul>
        
        </div>
        </div>
        </div>
        <div class="clearer">&nbsp;</div>
        
    </body>
</html>