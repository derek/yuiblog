<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Context Menu Positioning Test</title>

        <!-- Standard reset and fonts -->

        <link rel="stylesheet" type="text/css" href="../../build/reset/reset.css" />
        <link rel="stylesheet" type="text/css" href="../../build/fonts/fonts.css" />

        <!-- CSS for Menu -->

        <link rel="stylesheet" type="text/css" href="../../build/menu/assets/menu.css" />
 
        <style type="text/css">

            div#menucontextuel {
            
                position:absolute;
                visibility:hidden;
            
            }

            #TabData
            {
                clear: left;
                cursor: pointer;
                margin: 0 0.5em;
            }
            
            #TabData thead td
            {
                font-weight: bold;
                padding: 0;
                text-align: center;
            }
            
            #TabData tbody tr td
            {
                padding: 0.1em 0.4em;
                font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
            }
            
            #TabData td.Icones
            {
                white-space: nowrap;
            }
            
            /* Vues lignes */
            #TabData tbody
            {
                background-color: #C8DDF0;
            }

            #TabData .lignehover td
            {
                /*background-color : #F8ECDF;*/
            }

            #TabData .ligneselected td
            {
                color: white;
                background-color: #0058A4;
            }
            
            /* Boutons actions */
            #title-actions
            {
                margin: 0;
                margin-left: 5em;
            }
            
            #title-actions p
            {
                margin: 0;
            }
            
            #title-actions input
            {
                border: 1px solid black;
                background-color: transparent;
                margin: 0;
                padding: 0.2em;
                width: 12em;
            }
            
            .I_intitule
            {
                /* color: blue;*/
            }
            
            .I_meta
            {
                /*font-family: "Courier New", Courier, monospace;*/
                font-style: italic;
                color: green;
            }

            #blablabla
            {
                margin: 2em;
                padding-left: 50px;
                border: 1px solid red;
                background-color: red;
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

            YAHOO.widget.Menu.prototype.enforceConstraints = function(type, args, obj) {

                var Dom = YAHOO.util.Dom;

                var oConfig = this.cfg;
            
                var pos = args[0];
            
                var x = pos[0];
                var y = pos[1];
            
                var offsetHeight = this.element.offsetHeight;
                var offsetWidth = this.element.offsetWidth;
            
                var viewPortWidth = Dom.getViewportWidth();
                var viewPortHeight = Dom.getViewportHeight();
            
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


            // retiens les no de ligne sélectionnées
            var LignesSelectionnees = ""; // sera rempli en concaténant plusieurs /|<id_ligne>/
            
            
            
            function high(obj) { obj.className = 'menuhover';}
            function highgrey(obj) { obj.className = "lignehover";}
            function highgreythis() { this.className = 'lignehover'; }
            function highblue(obj) { obj.className = 'boutonhover'; }
            function highbluethis() { this.className = 'boutonhover';}
            function selecttr(obj) { obj.className = "ligneselected";}
            function selecttrthis() { this.className = "ligneselected";}
            function normalthis() { this.className = this._classNameBAK;}
            function normal(obj) { obj.className = obj._classNameBAK; }
            
            // Ini tableau
            function IniVue(ColMeta, page2open)
            {
            // Propriétés onmouseover, onmouseout et onclick du tableau de la liste des interviews
            var ListeItws = document.getElementById('TabData');
            for (j=0; j<ListeItws.tBodies[0].rows.length; j++)
                {
                ListeItws.tBodies[0].rows[j].id = "TR" + j;
                // clics
                //ListeItws.tBodies[0].rows[j].onclick = function (){LigneCliquee(this);};
                YAHOO.util.Event.addListener(ListeItws.tBodies[0].rows[j], "click", LigneCliquee);
                //ListeItws.tBodies[0].rows[j].ondblclick = function(e) {UnSelectAllLignes(); LigneCliqueeObj(this); self.location = page2open}
                ListeItws.tBodies[0].rows[j].onselectstart = function() { return false;}
                // esthétique
                ListeItws.tBodies[0].rows[j].cells[0].className = "I_intitule";
                if (ColMeta != -1)
                    {
                    for (k=ColMeta; k < ListeItws.tBodies[0].rows[j].cells.length; k++)
                        {
                        ListeItws.tBodies[0].rows[j].cells[k].className = "I_meta";
                        }
                    }
                }
            //BoutonActions_switch(false);
            }
            
            
            
            function UnSelectAllLignes()
            {
            TabLignes = LignesSelectionnees.split("|");
            for (i=0;i<TabLignes.length;i++)
                {
                var ligne = document.getElementById(TabLignes[i]);
                if (ligne)
                    {
                    ligne._selected = false;
                    normal(ligne);
                    }
                }
            //BoutonActions_switch(false);
            LignesSelectionnees = "";
            }
            
            function LigneCliquee(e)
            {
            // récupération de l'event
            var e = e || window.event;
            
            LigneCliqueeObj(this);
            }
            
            
            function LigneCliqueeObj(obj)
            {
            // modification de la classe
            if (obj._selected)
                {
                highgrey(obj);
                LignesSelectionnees = LignesSelectionnees.replace("|"+obj.id, "");
                if (LignesSelectionnees == "")
                    {
                    //BoutonActions_switch(false);
                    }
                obj._selected = false;
                }
            else
                {
                //BoutonActions_switch(true);
                selecttr(obj);
                LignesSelectionnees += "|" + obj.id
                obj._selected = true;
                }
            }

        </script>

    </head>
    <body onLoad="" id="mybody">

        <p>
            <a href="" onClick="ClickBtn(); return false;" id="blablabla">Menu</a>
        </p>
    
    
       <table id="TabData">
        <tbody id="TabData-TBody">
        <tr>
           <td>1)</td>
    
           <td><img src="img_itw/Section.gif" title="Section" border="0"></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Quelle est votre impression générale de la nouvelle interface web ?</td>
           <td>var1</td>

           <td>02/06/2006 16:30</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
    
        <tr>
           <td>2)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>

           <td>Quel est votre nom ?</td>
           <td>var2</td>
           <td>02/06/2006 16:31</td>
    
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>

           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
    
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>

        <tr>
           <td>3)</td>
           <td></td>
    
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>

           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
    
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>

           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
    
        </tr>
        <tr>
           <td>3)</td>
           <td></td>

           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
    
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>

           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>

        </tr>
        <tr>
           <td>3)</td>
    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>

           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        
        <!-- added rows -->
                <tr>
           <td>3)</td>
           <td></td>

           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
    
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>

           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>

        </tr>
        <tr>
           <td>3)</td>
    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>

           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
                <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>

           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
    
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>

           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>

        <tr>
           <td>3)</td>
    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>

           <td>Pierre Goiffon/Alma</td>
        </tr>
                <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>

           <td>var3</td>
    
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
           <td></td>

           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>

           <td>3)</td>
    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>

        </tr>
                        <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>

    
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>

    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>

    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>

                <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
    
           <td>08/06/2006 09:01</td>

           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>

           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
    
           <td></td>

           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
                <tr>

           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
    
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>

        </tr>
        <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>

           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>

           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
                <tr>
           <td>3)</td>

           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>

        <tr>
           <td>3)</td>
    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>

           <td>Pierre Goiffon/Alma</td>
        </tr>
                        <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>

           <td>var3</td>
    
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
           <td></td>

           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>

           <td>3)</td>
    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>

        </tr>
                <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>

    
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>

    
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>

    
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>

                <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
    
           <td>08/06/2006 09:01</td>

           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
           <td></td>
           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
    
           <td>Dans quelle société travaillez-vous ?</td>

           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <tr>
           <td>3)</td>
    
           <td></td>

           <td class="Icones"><img src="img_itw/icone118.gif" title="Fermée unique (boutons radio - 1 choix parmi n)" border="0"><img src="img_itw/Exclamation.gif" title="Réponse obligatoire" border="0"></td>
           <td>Dans quelle société travaillez-vous ?</td>
           <td>var3</td>
           <td>08/06/2006 09:01</td>
           <td>Pierre Goiffon/Alma</td>
        </tr>
        <!-- end added rows -->

        
        
    
        </tbody>
       </table>

        <!-- Tableau vue - FIN -->


        <div id="menucontextuel" class="yuimenu">
        <div class="bd">
        <ul>
        <li><a href="javascript://">Copier</a></li>
        <li><a href="javascript://">Coller</a></li>
        <li><a href="javascript://">Déplacer</a></li>
        <li><a href="javascript://">Affichage conditionnel</a></li>
        
        <li>Liste des choix
            <div id="menuAffCond">
            <div class="bd">
            <ul>
            <li><a href="javascript://">Affichage aléatoire</a></li>
            <li><a href="javascript://">Affichage non aléatoire</a></li>
            <li><a href="javascript://">Affichage horizontal</a></li>
            <li><a href="javascript://">Affichage vertical</a></li>
        
            </ul>
            </div>
            </div>
        </li>
        <li>Réponses
            <div id="menuReponses">
            <div class="bd">
            <ul>
            <li><a href="javascript://">Obligatoires</a></li>
            <li><a href="javascript://">Facultatives</a></li>
        
            </ul>
            </div>
            </div>
        </li>
        <li>Statistiques
            <div id="menuStats">
            <div class="bd">
            <ul>
            <li><a href="javascript://">Ignorer les non réponses</a></li>
            <li><a href="javascript://">Tenir compte des non réponses</a></li>
        
            <li><a href="javascript://">Associer des valeurs numériques</a></li>
            <li><a href="javascript://">Ne pas associer de valeur numérique</a></li>
            </ul>
            </div>
            </div>
        </li>
        <li><a href="javascript://">Supprimer</a></li>
        <li>Options avancées
            <div id="menuOptAv">
        
            <div class="bd">
            <ul>
            <li><a href="javascript://">Interdire la modification de la réponse</a></li>
            <li><a href="javascript://">Autoriser la modification de la réponse</a></li>
            <li><a href="javascript://">Interdire la modification de la question</a></li>
            <li><a href="javascript://">Autoriser la modification de la question</a></li>
            <li><a href="javascript://">Renuméroter les questions</a></li>
        
            </ul>
            </div>
            </div>
        </li>
        </ul>
        </div>
        </div>


        <Script language="Javascript" type="text/javascript">

            // Menu contextuel
            var oCMenu = new YAHOO.widget.ContextMenu("menucontextuel", { trigger: "TabData-TBody" });

            oCMenu.render();
            
            // gestion clic du menu
            function onBeforeShowMyMenu()
            {
            var tr = oCMenu.contextEventTarget;
            if(!tr)
                return;
            
            while(tr.tagName.toLowerCase() != "tr")
                tr = tr.parentNode;
            if (!tr._selected)
                {
                UnSelectAllLignes();
                LigneCliqueeObj(tr);
                }
            }
            oCMenu.beforeShowEvent.subscribe(onBeforeShowMyMenu);
            
            IniVue(4,"Menu_I4.html");
            
            function ClickBtn()
            {
            //oCMenu.cfg.setProperty('context', ['blablabla', 'br', 'tl']);
            //oMenu.cfg.setProperty("fixedcenter", true);
//             oMenu.align('tl','br');
//             oMenu.show();
            }

// THE FOLLOWING LINES ARE COMMENTED OUT BECAUSE THEY ARE THE PROBLEM!!  
// YOU CANNOT INSTANTIATE TWO MENUS AGAINST THE SAME SET OF MARKUP
// 
//             var oMenu = new YAHOO.widget.Menu("menucontextuel", {
//                 context:['blablabla','bl','tr']
//                 });
//             oMenu.render();
        
        </Script>

    </body>
</html>