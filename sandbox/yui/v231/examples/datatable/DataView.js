/*
 * Copyright (c) 2007, Yahoo! Inc. All rights reserved.
 * Code licensed under the BSD License:
 * http://developer.yahoo.net/yui/license.txt
 * version: 2.3.0
*/
/* Enhanced DataTable with row filtering and hideable columns 
 * Copyright (c) 2007, Victor Morales. All rights reserved.
 * Code licensed under the BSD License.
*/

YAHOO.widget.DataView = function(elContainer , aColumnDefs , oDataSource , oConfigs) {
        if (arguments.length > 0) {
			YAHOO.widget.DataView.superclass.constructor.call(this, elContainer , aColumnDefs , oDataSource , oConfigs);
		}
		//Call ContextMenu initialization method
       this._initHideMenu();
};

// Inherit from YAHOO.widget.DataTable
YAHOO.lang.extend(YAHOO.widget.DataView, YAHOO.widget.DataTable);


YAHOO.widget.DataView.prototype._initHideMenu=function() {
    
	var oColumnSet= this.getColumnSet()
	this.aColState=[];
	var _hideCol=[]
        var keys= oColumnSet.keys;
        for (var i=0; i<keys.length;i++) {
            if(keys[i].hideable) {
				itemText = keys[i].text || keys[i].key;
                _hideCol.push({text:itemText,checked:true, colNum:i})
            }
            this.aColState[i]=0;
        }
        if (_hideCol.length>0)    {
          var oContextMenu = new YAHOO.widget.ContextMenu("hideMenu", { zindex:32767,trigger: this.getTheadEl()     } );

          // Define the items for the menu
          var aMenuItemData =_hideCol 
          var nMenuItems = aMenuItemData.length;
          var oMenuItem;
          for(var i=0; i<nMenuItems; i++) {
             var item= aMenuItemData[i]
             oMenuItem = oContextMenu.addItem(item);
             oMenuItem.clickEvent.subscribe(this.onhideMenuClick, [oMenuItem,item.colNum],this);
          }
          oContextMenu.render(document.body);
        }

};

YAHOO.widget.DataView.prototype.onhideMenuClick=function(p_sType, p_aArgs, p_oMenuItem) {
        var oMenuItem= p_oMenuItem[0];
        var col_no=p_oMenuItem[1];
        var swap=! oMenuItem.cfg.getProperty("checked")
        oMenuItem.cfg.setProperty("checked", swap);
        var colstyle;
        if (!swap) {
            this.hideSwap(col_no,'none',0)
            this.aColState[col_no]=1      
        }
        else {
            this.hideSwap(col_no,'',0)
            this.aColState[col_no]=0
        }
};

YAHOO.widget.DataView.prototype.hideSwap=function(col_no,colstyle,startRow) {

       //Hide or unhide column header
        var headRow= this.getTheadEl().getElementsByTagName('th')
        headRow[col_no].style.display=colstyle;
		
        var rows= this.getTbodyEl().getElementsByTagName('tr')
        
        // Hide or unhide column rows 
        for (var row=startRow; row<rows.length;row++) {
          var cels = rows[row].getElementsByTagName('td')
	      cels[col_no].style.display=colstyle;
        }
};

YAHOO.widget.DataView.prototype.isFiltered=false;

YAHOO.widget.DataView.prototype.doBeforeLoadData= function( sRequest ,oResponse ) {
    if(oResponse) {
        this.defaultView=oResponse.results;
    }    
    return true;
};

YAHOO.widget.DataView.prototype.filterRows=function(filteredRows) {
    if(filteredRows == undefined) {
        this.initializeTable(this.defaultView);
        this.isFiltered=false;
    }
    else {
        var dataView=[];
        for (var i=0; i<filteredRows.length;i++) {
        	var r=filteredRows[i];
			var row= this.getRecordSet().getRecord(r).getData();
            dataView.push(row);
		}
   		 this.initializeTable(dataView)
         this.isFiltered=true;
    }
};

YAHOO.widget.DataView.prototype.Filter=function(sQuery,sColumnKey) {
	sQuery=unescape(sQuery);
	var aResults = [];
	var rs=this.getRecordSet()

	if(sQuery && sQuery.length > 0) {
		var q= sQuery.toLowerCase();
		for (var i=0; i<rs.getLength(); i++) {
			var field=this.getRecord(i).getData()[sColumnKey]
		    if(!field) return []
			//Save the index of the match
			var mIndex=field.toLowerCase().indexOf(q)
			if (mIndex<0) { continue;}
			aResults.push(i) //matched Row index
		}
	}
	//	return aResults;
	this.filterRows(aResults)
}

YAHOO.widget.DataView.prototype.ClearFilters=function(){
	 this.initializeTable(this.defaultView);
     this.isFiltered=false;
}
