<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Determing what item is clicked in a menu</title>

        <!-- Standard reset and fonts -->
        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css">

        <!-- CSS for Menu -->
        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css">
 
        <!-- Page-specific styles -->
        <style type="text/css">

            body { margin:.5em; }

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

            YAHOO.example.onWindowLoad = function(p_oEvent) {

                var oMenu = new YAHOO.widget.Menu("basicmenu", { fixedcenter: true });

                oMenu.addItem("Item One");
                oMenu.addItem("Item Two");
                oMenu.addItem("Item Three");
                oMenu.addItem("Item Four");

                oMenu.render(document.body);
                oMenu.show();

                function onMenuClick(p_sType, p_aArgs, p_oMenu) {

                    if(this.activeItem) {

                        alert(
                            "You clicked the following item: " +
                            "text: " + this.activeItem.cfg.getProperty("text") + ", " +
                            "index: " + this.activeItem.index + ", " +
                            "group index: " + this.activeItem.groupIndex
                        );

                    }
                
                }

                oMenu.mouseDownEvent.subscribe(onMenuClick, oMenu, true);

            }


            YAHOO.util.Event.addListener(window, "load", YAHOO.example.onWindowLoad);
            
        </script>

    </head>
    <body>

    </body>
</html>