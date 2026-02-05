<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"

        "http://www.w3.org/TR/html4/strict.dtd">

<html>

    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <title>Menu Example 9: Loading menu item urls in an iframe</title>


        <!-- Stanard reset and fonts -->

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

        <script type="text/javascript" src="../../build/container/container_core.js"></script>


        <!-- Menu source file -->

        <script type="text/javascript" src="../../build/menu/menu.js"></script>


        <!-- Page-specific script -->

        <script type="text/javascript">

                function onClick() {
                
                    document.getElementById("myframe").src = this.value;
                
                }

                function onWindowLoad(p_oEvent) {
                
                    var oMenu = new YAHOO.widget.Menu("basicmenu");

                    var oItem1 = oMenu.addItem(new YAHOO.widget.MenuItem("Yahoo! Travel"));
                    
                    oItem1.clickEvent.subscribe(onClick);
                    oItem1.value =
"http://travel.yahoo.com";

                    var oItem2 = oMenu.addItem(new YAHOO.widget.MenuItem("Yahoo! Search"));
                    
                    oItem2.clickEvent.subscribe(onClick);
                    oItem2.value =
"http://search.yahoo.com";
                    
                    var oItem3 = oMenu.addItem(new YAHOO.widget.MenuItem("Yahoo! Shopping"));
                    
                    oItem3.clickEvent.subscribe(onClick);
                    oItem3.value =
"http://shopping.yahoo.com"; 
                    
                    oMenu.render(document.body);
                    oMenu.show();
                
                }
                
                YAHOO.util.Event.addListener(window, "load", onWindowLoad);


        </script>

    </head>

    <body>
         <iframe id="myframe" style="border:solid 1px #000;height:500px;width:500px;"></iframe>

    </body>

</html>