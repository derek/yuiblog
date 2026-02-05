<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Example: Menu Buttons (YUI Library)</title>

        <!-- Reset and Fonts -->
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/reset/reset-min.css">
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/fonts/fonts-min.css">
            
        <!-- Menu CSS -->
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/menu/assets/menu.css">

         
        <!-- CSS for Button -->
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/button/assets/button.css">
 
        <!-- Page-specific styles -->
        <style type="text/css">

            body { margin:.5em; }

            h1 { font-weight:bold; }

            fieldset {

                border:2px groove #ccc;
                margin:.5em;
                padding:.5em;

            }

            #menu1 div.bd {
            
                width:300px;
            
            }
            
            #menu2 div.bd {
            
                width:200px;
            
            }

        </style>

        
        <!-- Dependency source files -->
        <script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/yahoo-dom-event/yahoo-dom-event.js"></script>
        <script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/element/element-beta-min.js"></script>
        <!-- Container Core Library -->
        <script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/container/container_core-min.js"></script>

        <!-- Menu Library -->
        <script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/menu/menu-min.js"></script>
        
        <!-- Button source file -->
        <script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/button/button-beta-min.js"></script>

        <!-- Page-specific JavaScript -->
        <script type="text/javascript">

            YAHOO.util.Event.onDOMReady(function () {

                function onMenuItemClick(p_sType, p_aArgs, p_oItem) {

                    alert(this.value);
                
                }

                var aItemData1 = [

                    { text: "menu 1 - item one", value: 1, onclick: { fn: onMenuItemClick } },
                    { text: "menu 1 - item two", value: 2, onclick: { fn: onMenuItemClick } },
                    { text: "menu 1 - item three", value: 3, onclick: { fn: onMenuItemClick } }
                    
                ];

                var oMenu1 = new YAHOO.widget.Menu("menu1", { itemdata: aItemData1, lazyload: true, container: "menubuttons" });

                var oMenuButton1 = new YAHOO.widget.Button({ type: "menubutton", label: "Menu Button 1", menu: oMenu1, container: "menubuttons" });


                var aItemData2 = [

                    { text: "menu 2 - item one", value: 1, onclick: { fn: onMenuItemClick } },
                    { text: "menu 2 - item two", value: 2, onclick: { fn: onMenuItemClick } },
                    { text: "menu 2 - item three", value: 3, onclick: { fn: onMenuItemClick } }
                    
                ];

                var oMenu2 = new YAHOO.widget.Menu("menu2", { itemdata: aItemData2 });

                oMenu2.render("menubuttons");

                var oMenuButton2 = new YAHOO.widget.Button({ type: "menubutton", label: "Menu Button 2", menu: oMenu2, container: "menubuttons" });

            });

        </script>

    </head>
    <body>

        <h1>Example: Menu Buttons (YUI Library)</h1>

        <form id="example" name="example" method="post" action="#">

            <fieldset id="menubuttons">
                <legend>Menu Buttons</legend>
            </fieldset>

        </form>

    </body>
</html>