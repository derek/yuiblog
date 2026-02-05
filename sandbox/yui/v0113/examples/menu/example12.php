<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Basic Menu From Existing Markup</title>

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

                var oMenu = new YAHOO.widget.Menu("basicmenu", { fixedcenter: true, monitorresize: true });

                oMenu.onDomResize = function () { 

                    alert("You resized the font"); 

                };                

                oMenu.render();

                oMenu.show();
             
            };


            YAHOO.util.Event.addListener(window, "load", YAHOO.example.onWindowLoad);
            
        </script>

    </head>
    <body>

        <div id="basicmenu" class="yuimenu">
            <div class="bd">
                <ul class="first-of-type">
                    <li class="yuimenuitem"><a href="http://mail.yahoo.com">Yahoo! Mail</a></li>
                    <li class="yuimenuitem"><a href="http://addressbook.yahoo.com">Yahoo! Address Book</a></li>
                    <li class="yuimenuitem"><a href="http://calendar.yahoo.com">Yahoo! Calendar</a></li>
                    <li class="yuimenuitem"><a href="http://notepad.yahoo.com">Yahoo! Notepad</a></li>
                </ul>            
            </div>
        </div>

    </body>
</html>