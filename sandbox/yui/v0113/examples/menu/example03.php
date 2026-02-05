<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Website Top Nav Example</title>

        <!-- Standard reset and fonts -->
        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css">

        <!-- Grids -->
        <link rel="stylesheet" type="text/css" href="../../build/grids/grids.css">

        <!-- CSS for Menu -->
        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css">
 
        <!-- Page-specific styles -->
        <style type="text/css">


            div.yui-b p {
            
                margin:0 0 .5em 0;
                color:#999;
            
            }
            
            div.yui-b p strong {
            
                font-weight:bold;
                color:#000;
            
            }
            
            div.yui-b p em {

                color:#000;
            
            }            
            
            h1 {

                padding:.25em .5em;
                background-color:#ccc;

            }

            #productsandservices {
            
                margin:0 0 10px 0;
            
            }
            
            div.yuimenu {
            
                position:absolute;
            
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

            // Apply patches
            
            YAHOO.widget.MenuModule.prototype.initDefaultConfig = function() {
            
                YAHOO.widget.MenuModule.superclass.initDefaultConfig.call(this);
            
                var oConfig = this.cfg;
            
                // Add configuration properties
            
                oConfig.addProperty(
                    "position", 
                    {
                        value: "dynamic", 
                        handler: this.configPosition, 
                        validator: this._checkPosition 
                    } 
                );
            
                oConfig.addProperty("submenualignment", { value: ["tl","tr"] } );
            
            };
      

            YAHOO.widget.MenuModule.prototype._onElementClick = 
            
                function(p_oEvent, p_oMenuModule) {
            
                    var Event = this._oEventUtil;
                    
                    var oTarget = Event.getTarget(p_oEvent);
                    
                    /*
                        Check if the target was a DOM element that is a part of an
                        item and (if so), fire the associated "click" 
                        Custom Event.
                    */
                    
                    var oItem = this._fireItemEvent(oTarget, "clickEvent", p_oEvent);
                
                    if(oItem) {
            
                        var oSubmenu = oItem.cfg.getProperty("submenu");
                
                        /*
                            ACCESSIBILITY FEATURE FOR SCREEN READERS: Expand/collapse the
                            submenu when the user clicks on the submenu indicator image.
                        */        
                
                        if(oTarget == oItem.submenuIndicator && oSubmenu) {
            
                            if(oSubmenu.cfg.getProperty("visible")) {
                    
                                oSubmenu.hide();
                    
                            }
                            else {
            
                                var oActiveItem = this.activeItem;
                           
            
                                // Hide any other submenus that might be visible
                            
                                if(oActiveItem && oActiveItem != this) {
                            
                                    this.clearActiveItem();
                            
                                }
            
                                this.activeItem = oItem;
                    
                                oItem.cfg.setProperty("selected", true);
            
                                oSubmenu.show();
                    
                            }
                    
                        }
                        else {
                        
                            if(oTarget.tagName == "A") {
                
                                Event.preventDefault(p_oEvent);
                            
                            }
            
                            var sURL = oItem.cfg.getProperty("url");
            
                            if(sURL.substr((sURL.length-1),1) != "#") {
                    
                                document.location = sURL;
                            
                            }
            
                        }
                    
                    }
            
            
                    /*
                        Stop the propagation of the event at each MenuModule 
                        instance since Menus can be embedded in eachother.
                    */
            
                    Event.stopPropagation(p_oEvent);
                
                
                    // Fire the associated "click" Custom Event for the MenuModule instance
                
                    this.clickEvent.fire(p_oEvent);
            
                };


            YAHOO.example.OverlayManager = new YAHOO.widget.OverlayManager();

            var g_nTimeoutId;


            // "mouseover" event handler for the menubar

            function onMenuBarMouseOver(p_sType, p_aArguments, p_oMenu) {

                if(g_nTimeoutId) {

                    window.clearTimeout(g_nTimeoutId);

                }
            
            }


            // "mouseover" event handler for each submenu

            function onSubmenuMouseOver(p_sType, p_aArguments, p_oMenu) {

                if(g_nTimeoutId) {

                    window.clearTimeout(g_nTimeoutId);

                }

            }


            // "mouseout" event handler for each submenu
            
            function onSubmenuMouseOut(p_sType, p_aArguments, p_oMenu) {

                function hideMenu() {

                    YAHOO.example.OverlayManager.hideAll();

                }


                if(g_nTimeoutId) {

                    window.clearTimeout(g_nTimeoutId);

                }

                g_nTimeoutId = window.setTimeout(hideMenu, 750);
            
            }


            // "mousedown" handler for the document

            function onDocumentMouseDown(p_oEvent) {
            
                var oTarget = YAHOO.util.Event.getTarget(p_oEvent);

                if(
                    oTarget != oMenuBar.element && 
                    !YAHOO.util.Dom.isAncestor(oMenuBar.element, oTarget)
                ) {

                    YAHOO.example.OverlayManager.hideAll();

                }
    
            }


            // "mouseover" handler for each item in the menu bar

            function onMenuBarItemMouseOver(p_sType, p_aArguments, p_oMenuItem) {
            
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
            
                    oSubmenu.show();
            
                }
            
            }
        

            // "mouseout" handler for each item in the menu bar
        
            function onMenuBarItemMouseOut(p_sType, p_aArguments, p_oMenuItem) {
            
                this.cfg.setProperty("selected", false);
            
            
                var oSubmenu = this.cfg.getProperty("submenu");
            
                if(oSubmenu) {
            
                    var oDOMEvent = p_aArguments[0],
                        oRelatedTarget = YAHOO.util.Event.getRelatedTarget(oDOMEvent);
            
                    if(
                        !(
                            oRelatedTarget == oSubmenu.element || 
                            this._oDom.isAncestor(oSubmenu.element, oRelatedTarget)
                        )
                    ) {
            
                        oSubmenu.hide();
            
                    }
            
                }
            
            }


            // "load" handler for the window

            function onWindowLoad() {

                // Instantiate and render the menubar and corresponding submenus

                var oMenuBar = new YAHOO.widget.MenuBar("productsandservices");
                oMenuBar.render();

                /*
                    Add a "mouseover" and "mouseout" event handler each item 
                    in the menu bar 
                */               

                var aMenuBarItems = oMenuBar.getItemGroups()[0],
                    i = aMenuBarItems.length - 1;

                do {

                    aMenuBarItems[i].mouseOverEvent.subscribe(
                        onMenuBarItemMouseOver
                    );

                    aMenuBarItems[i].mouseOutEvent.subscribe(
                        onMenuBarItemMouseOut 
                    );
                
                }
                while(i--);


                // Add a "mouseover" handler to the menubar

                oMenuBar.mouseOverEvent.subscribe(
                        onMenuBarMouseOver, 
                        oMenuBar, 
                        true
                    );


                // Register each submenu with the OverlayManager instance

                var oCommunication = oMenuBar.getItem(0).cfg.getProperty("submenu"),
                    oPIM = oCommunication.getItem(5).cfg.getProperty("submenu"),
                    oShopping = oMenuBar.getItem(1).cfg.getProperty("submenu"),
                    oEntertainment = oMenuBar.getItem(2).cfg.getProperty("submenu"),
                    oInformation = oMenuBar.getItem(3).cfg.getProperty("submenu");


                YAHOO.example.OverlayManager.register([oCommunication, oPIM, oShopping, oEntertainment, oInformation]);


                // Add a "mouseover" event handler to each submenu
                
                oCommunication.mouseOverEvent.subscribe(onSubmenuMouseOver, oCommunication, true);
                oPIM.mouseOverEvent.subscribe(onSubmenuMouseOver, oPIM, true);
                oShopping.mouseOverEvent.subscribe(onSubmenuMouseOver, oShopping, true);
                oEntertainment.mouseOverEvent.subscribe(onSubmenuMouseOver, oEntertainment, true);
                oInformation.mouseOverEvent.subscribe(onSubmenuMouseOver, oInformation, true);
                

                // Add a "mouseout" event handler to each submenu

                oCommunication.mouseOutEvent.subscribe(onSubmenuMouseOut, oCommunication, true);
                oPIM.mouseOutEvent.subscribe(onSubmenuMouseOut, oPIM, true);
                oShopping.mouseOutEvent.subscribe(onSubmenuMouseOut, oShopping, true);
                oEntertainment.mouseOutEvent.subscribe(onSubmenuMouseOut, oEntertainment, true);
                oInformation.mouseOutEvent.subscribe(onSubmenuMouseOut, oInformation, true);


                // Add a "mousedown" handler to the document

                YAHOO.util.Event.addListener(
                        document, 
                        "mousedown", 
                        onDocumentMouseDown
                    );

            }


            // Add a "load" handler for the window

            YAHOO.util.Event.addListener(window, "load", onWindowLoad);

        </script>
    </head>
    <body id="yahoo-com">
        <div id="doc" class="yui-t1">

            <div id="hd">
                <!-- start: your content here -->
                
                    <h1>Website Top Nav Exmaple</h1>
        
                <!-- end: your content here -->
            </div>
            <div id="bd">

                <!-- start: primary column from outer template -->
                <div id="yui-main">

                    <div class="yui-b">
                        <!-- start: stack grids here -->
                                
                       <div id="productsandservices" class="yuimenubar">
                            <div class="bd">
                                <ul class="first-of-type">
                                    <li class="yuimenubaritem first-of-type">Communication
                
                                        <div id="communication" class="yuimenu">
                                            <div class="bd">
                                                <ul>

                                                    <li class="yuimenuitem"><a href="http://360.yahoo.com">360&#176;</a></li>
                                                    <li class="yuimenuitem"><a href="http://alerts.yahoo.com">Alerts</a></li>
                                                    <li class="yuimenuitem"><a href="http://avatars.yahoo.com">Avatars</a></li>
                                                    <li class="yuimenuitem"><a href="http://groups.yahoo.com">Groups</a></li>
                                                    <li class="yuimenuitem"><a href="http://promo.yahoo.com/broadband/">Internet Access</a></li>
                                                    <li class="yuimenuitem">PIM
                                                    
                                                        <div id="pim" class="yuimenu">

                                                            <div class="bd">
                                                                <ul class="first-of-type">
                                                                    <li class="yuimenuitem"><a href="http://mail.yahoo.com">Yahoo! Mail</a></li>
                                                                    <li class="yuimenuitem"><a href="http://addressbook.yahoo.com">Yahoo! Address Book</a></li>
                                                                    <li class="yuimenuitem"><a href="http://calendar.yahoo.com">Yahoo! Calendar</a></li>
                                                                    <li class="yuimenuitem"><a href="http://notepad.yahoo.com">Yahoo! Notepad</a></li>
                                                                </ul>            
                                                            </div>

                                                        </div>                    
                                                    
                                                    </li>
                                                    <li class="yuimenuitem"><a href="http://members.yahoo.com">Member Directory</a></li>
                                                    <li class="yuimenuitem"><a href="http://messenger.yahoo.com">Messenger</a></li>
                                                    <li class="yuimenuitem"><a href="http://mobile.yahoo.com">Mobile</a></li>
                                                    <li class="yuimenuitem"><a href="http://photos.yahoo.com">Photos</a></li>
                                                </ul>

                                            </div>
                                        </div>      
                                    
                                    </li>
                                    <li class="yuimenubaritem">Shopping
                
                                        <div id="shopping" class="yuimenu">
                                            <div class="bd">                    
                                                <ul>
                                                    <li class="yuimenuitem"><a href="http://auctions.shopping.yahoo.com">Auctions</a></li>
                                                    <li class="yuimenuitem"><a href="http://autos.yahoo.com">Autos</a></li>

                                                    <li class="yuimenuitem"><a href="http://classifieds.yahoo.com">Classifieds</a></li>
                                                    <li class="yuimenuitem"><a href="http://shopping.yahoo.com/b:Flowers%20%26%20Gifts:20146735">Flowers &#38; Gifts</a></li>
                                                    <li class="yuimenuitem"><a href="http://points.yahoo.com">Points</a></li>
                                                    <li class="yuimenuitem"><a href="http://realestate.yahoo.com">Real Estate</a></li>
                                                    <li class="yuimenuitem"><a href="http://travel.yahoo.com">Travel</a></li>

                                                    <li class="yuimenuitem"><a href="http://wallet.yahoo.com">Wallet</a></li>
                                                    <li class="yuimenuitem"><a href="http://yp.yahoo.com">Yellow Pages</a></li>
                                                </ul>
                                            </div>
                                        </div>                    
                                    
                                    </li>
                                    <li class="yuimenubaritem">Entertainment
                
                                        <div id="entertainment" class="yuimenu">
                                            <div class="bd">                    
                                                <ul>

                                                    <li class="yuimenuitem"><a href="http://fantasysports.yahoo.com">Fantasy Sports</a></li>
                                                    <li class="yuimenuitem"><a href="http://games.yahoo.com">Games</a></li>
                                                    <li class="yuimenuitem"><a href="http://www.yahooligans.com">Kids</a></li>
                                                    <li class="yuimenuitem"><a href="http://music.yahoo.com">Music</a></li>
                                                    <li class="yuimenuitem"><a href="http://movies.yahoo.com">Movies</a></li>
                                                    <li class="yuimenuitem"><a href="http://music.yahoo.com/launchcast">Radio</a></li>

                                                    <li class="yuimenuitem"><a href="http://travel.yahoo.com">Travel</a></li>
                                                    <li class="yuimenuitem"><a href="http://tv.yahoo.com">TV</a></li>
                                                </ul>                    
                                            </div>
                                        </div>                                        
                                    
                                    </li>
                                    <li class="yuimenubaritem">Information
                
                                        <div id="information" class="yuimenu">
                                            <div class="bd">                                        
                                                <ul>

                                                    <li class="yuimenuitem"><a href="http://downloads.yahoo.com">Downloads</a></li>
                                                    <li class="yuimenuitem"><a href="http://finance.yahoo.com">Finance</a></li>
                                                    <li class="yuimenuitem"><a href="http://health.yahoo.com">Health</a></li>
                                                    <li class="yuimenuitem"><a href="http://local.yahoo.com">Local</a></li>
                                                    <li class="yuimenuitem"><a href="http://maps.yahoo.com">Maps &#38; Directions</a></li>

                                                    <li class="yuimenuitem"><a href="http://my.yahoo.com">My Yahoo!</a></li>
                                                    <li class="yuimenuitem"><a href="http://news.yahoo.com">News</a></li>
                                                    <li class="yuimenuitem"><a href="http://search.yahoo.com">Search</a></li>
                                                    <li class="yuimenuitem"><a href="http://smallbusiness.yahoo.com">Small Business</a></li>
                                                    <li class="yuimenuitem"><a href="http://weather.yahoo.com">Weather</a></li>
                                                </ul>                    
                                            </div>

                                        </div>                                        
                                    
                                    </li>
                                </ul>            
                            </div>
                        </div>

                        <p><strong>NOTE:</strong> <em>This example demonstrates how to combine a menu built from existing markup with a menu built completely from JavaScript.  The root menu in the top nav is constructed using markup and enables the user to navigate to different landing pages for each product category.  If JavaScript is enabled, submenus are constructed and appended to the root menu.  This allows the user to skip the product landing pages and proceed directly to a given property.</em></p>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat dolor, id aliquam leo tortor eget odio. Pellentesque orci arcu, eleifend at, iaculis sit amet, posuere eu, lorem. Aliquam erat volutpat. Phasellus vulputate. Vivamus id erat. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nunc gravida. Ut euismod, tortor eget convallis ullamcorper, arcu odio egestas pede, ut ornare urna elit vitae mauris. Aenean ullamcorper eros a lacus. Curabitur egestas tempus lectus. Donec et lectus et purus dapibus feugiat. Sed sit amet diam. Etiam ipsum leo, facilisis ac, rutrum nec, dignissim quis, tellus. Sed eleifend.</p>

                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat dolor, id aliquam leo tortor eget odio. Pellentesque orci arcu, eleifend at, iaculis sit amet, posuere eu, lorem. Aliquam erat volutpat. Phasellus vulputate. Vivamus id erat. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nunc gravida. Ut euismod, tortor eget convallis ullamcorper, arcu odio egestas pede, ut ornare urna elit vitae mauris. Aenean ullamcorper eros a lacus. Curabitur egestas tempus lectus. Donec et lectus et purus dapibus feugiat. Sed sit amet diam. Etiam ipsum leo, facilisis ac, rutrum nec, dignissim quis, tellus. Sed eleifend.</p>

                        <!-- end: stack grids here -->
                    </div>
                </div>
                <!-- end: primary column from outer template -->

                <!-- start: secondary column from outer template -->
                <div class="yui-b">

                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat dolor, id aliquam leo tortor eget odio. Pellentesque orci arcu, eleifend at, iaculis sit amet, posuere eu, lorem. Aliquam erat volutpat. Phasellus vulputate. Vivamus id erat. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nunc gravida. Ut euismod, tortor eget convallis ullamcorper, arcu odio egestas pede, ut ornare urna elit vitae mauris. Aenean ullamcorper eros a lacus. Curabitur egestas tempus lectus. Donec et lectus et purus dapibus feugiat. Sed sit amet diam. Etiam ipsum leo, facilisis ac, rutrum nec, dignissim quis, tellus. Sed eleifend.</p>
                    
                </div>
                <!-- end: secondary column from outer template -->
            </div>
            <div id="ft">

                <p>FOOTER: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas sit amet metus. Nunc quam elit, posuere nec, auctor in, rhoncus quis, dui. Aliquam erat volutpat. Ut dignissim, massa sit amet dignissim cursus, quam lacus feugiat.</p>

            </div>
        </div>
    </body>
</html>