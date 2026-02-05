<html>
    <head>
        <title>Dialog Example - YUI Library</title>
        <link rel="stylesheet" type="text/css" href="../../build/container/assets/container.css">
        <script type="text/javascript" src="../../build/yahoo/yahoo.js"></script>
        <script type="text/javascript" src="../../build/dom/dom.js"></script>
        <script type="text/javascript" src="../../build/event/event.js"></script>

        <script type="text/javascript" src="../../build/dragdrop/dragdrop.js"></script>
        <script type="text/javascript" src="../../build/container/container.js"></script>
        <script type="text/javascript">

            var manager = new YAHOO.widget.OverlayManager();

            function onCloseMouseDown(p_oEvent) {
                
                this.blur();

                YAHOO.util.Event.stopPropagation(p_oEvent);
            
            }

            function popup(imgId,name,id,image) {

                var graphDialog = new YAHOO.widget.Dialog(id, { width:"680px", visible : false, constraintoviewport : false, draggable : true, close : true});

                graphDialog.setHeader("<center>" + name + "</center>");
                graphDialog.setBody(image);
                graphDialog.render(document.body);          
                graphDialog.show();
                graphDialog.hideEvent.subscribe(odestroy,graphDialog,true);
                manager.register(graphDialog);
                
                YAHOO.util.Event.addListener(graphDialog.close, "mousedown", onCloseMouseDown, graphDialog, true);

            }

            function odestroy() {
                  this.destroy();
                  manager.remove(this);
            }

        </script>

    </head>
    <body>
        <input type = "button" name = "Dialog1" value="popup1" onClick="popup('img1','Solaris Process soopa/httpd','graphDialog1','<IMG SRC=\'ART/graph_full_1.jpeg\'>')">
        <input type = "button" name = "Dialog1" value="popup2" onClick="popup('img2','Solaris Process soopa/httpd','graphDialog2','<IMG SRC=\'ART/graph_full_2.jpeg\'>')">

    </body>
</html>