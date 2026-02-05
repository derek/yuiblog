<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Click Event Handler Example</title>

        <!-- Stanard reset and fonts -->
        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css">
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css">

        <!-- CSS for Menu -->
        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css">

        <!-- Namespace source file -->
        <script type="text/javascript" src="../../build/yahoo/yahoo.js"></script>
        
        <!-- Dependency source files -->
        <script type="text/javascript" src="../../build/event/event.js"></script>
        <script type="text/javascript" src="../../build/dom/dom.js"></script>
        <script type="text/javascript" src="../../build/container/container_core.js"></script>
        
        <!-- Menu source file -->
        <script type="text/javascript" src="../../build/menu/menu.js"></script>

        <!-- Page-specific script -->
        <script type="text/javascript">

            function onWindowLoad(p_oEvent) {


                function onMenuItemClick(p_sType, p_aArguments, p_oValue) {
                
                    alert("index: " + this.index + ", text: " + this.cfg.getProperty("text") + ", value:" + p_oValue);
                
                }


                var oMenu = new YAHOO.widget.Menu("mymenu");


                var oItem1 = oMenu.addItem(new YAHOO.widget.MenuItem("Item One"));

                oItem1.clickEvent.subscribe(onMenuItemClick, "foo1");


                var oItem2 = oMenu.addItem(new YAHOO.widget.MenuItem("Item Two"));
                
                oItem2.clickEvent.subscribe(onMenuItemClick, ["foo", "bar"]);



                oMenu.render(document.body);
    
                oMenu.show();

            }


            YAHOO.util.Event.addListener(window, "load", onWindowLoad);
            
        </script>
    </head>
    <body>
    </body>
</html>