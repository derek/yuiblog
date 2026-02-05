<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
        <title>Example: Panel Positioning (YUI Library)</title>
        
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		
		<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.2.0/build/fonts/fonts-min.css">
		<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.2.0/build/reset/reset-min.css">
		<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.2.0/build/container/assets/container.css">

        <style type="text/css">
        
            body {
            
                height:5000px;
            
            }
        
        </style>


		<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
		<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/dragdrop/dragdrop-min.js" ></script>
		<script type="text/javascript" src="http://yui.yahooapis.com/2.2.0/build/container/container-min.js"></script>

		<script type="text/javascript">

            function onWindowLoad() {


                function setPanelPosition(p_sType, p_aArgs, p_oPanel) {

                    var oDoc = document,
                        nScrollTop = Math.max(oDoc.documentElement.scrollTop, oDoc.body.scrollTop),
                        nScrollLeft = Math.max(oDoc.documentElement.scrollLeft, oDoc.body.scrollLeft),
                        nY = (YAHOO.util.Dom.getViewportHeight() + nScrollTop) - (this.element.offsetHeight + 3),  // "3" Accounts for the offset of the Panel's shadow
                        nX = (YAHOO.util.Dom.getViewportWidth() + nScrollLeft) - (this.element.offsetWidth + 3);    // "3" Accounts for the offset of the Panel's shadow

                    this.moveTo(nX, nY);
                
                }


                var oPanel = new YAHOO.widget.Panel("overlay2", { width:"200px" });

                oPanel.setBody("Hello, World!");

                oPanel.renderEvent.subscribe(setPanelPosition, oPanel, true);
               
                YAHOO.widget.Overlay.windowResizeEvent.subscribe(setPanelPosition, oPanel, true);
                YAHOO.widget.Overlay.windowScrollEvent.subscribe(setPanelPosition, oPanel, true);

                oPanel.render(document.body);

            }

            YAHOO.util.Event.addListener(window, "load", onWindowLoad);

		</script>

	</head>
	<body>

	</body>
</html>