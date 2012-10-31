/*
 * A tabbed application, consisting of multiple stacks of windows associated with tabs in a tab group.  
 * A starting point for tab-based application with multiple top-level windows. 
 * Requires Titanium Mobile SDK 1.8.0+.
 * 
 * In app.js, we generally take care of a few things:
 * - Bootstrap the application with any data we need
 * - Check for dependencies like device type, platform version or network connection
 * - Require and open our top-level UI component
 *  
 */

//bootstrap and check dependencies
if (Ti.version < 1.8 ) {
	alert('Sorry - this application template requires Titanium Mobile SDK 1.8 or later');
}

// This is a single context application with mutliple windows in a stack
(function() {
	//determine platform and form factor and render approproate components
	var osname = Ti.Platform.osname,
		version = Ti.Platform.version,
		height = Ti.Platform.displayCaps.platformHeight,
		width = Ti.Platform.displayCaps.platformWidth;
	
	//considering tablet to have one dimension over 900px - this is imperfect, so you should feel free to decide
	//yourself what you consider a tablet form factor for android
	var isTablet = osname === 'ipad' || (osname === 'android' && (width > 899 || height > 899));
	
	var Window;
	if (isTablet) {
		Window = require('ui/tablet/ApplicationWindow');
	}
	else {
		Window = require('ui/handheld/ApplicationWindow');
	}

	if(!osname === 'android'){
		//Titanium.UI.iPhone.hideStatusBar();
	}

	var ApplicationTabGroup = require('ui/common/ApplicationTabGroup');
	new ApplicationTabGroup(Window).open();
	
	//callJson();
	
	//alert('success call Json API');
	
})();







function callJson() {
	// Empty array "rowData" for our tableview
	try{
			// Create our HTTP Client and name it "loader"
			//alert('callJson Event');
			
		  var test = 'nunca entro';
		  
		  var jresult = [];
		  var size_data;
			// Runs the function when the data is ready for us to process
			var loader = Ti.Network.createHTTPClient({
			// Sets the HTTP request method, and the URL to get data from
			//loader.open("GET","http://api.twitter.com/1/statuses/user_timeline.json?screen_name=esmandau");
		

			onload:function(e) {
				
				//test='entro chevere';
				
				var request = loader.responseText;
				request = request.substring(5,request.length);
				
				alert(request);

				try{
				
					var json =    JSON.parse(request);  //eval('(' + request + ')');
					size_data = json.length;
					
					alert("size json: " + size_data);
					//eval('(' + this.responseText + ')');
					for(var i = 0; i < size_data; i++) {
							//data.id = res[i].cat_id;
							//data.name =  res[i].cat_name;
							
							
							jresult.push({
								id  :json[i].cat_id,
								name:json[i].cat_name
							});
							
			
					}
				
				
					alert(jresult);
					
					
				}catch(err)
				{
					alert(err);
					Titanium.API.error(err);
				    Titanium.UI.createAlertDialog({
				        message : err,
				        title : "Remote Server Error"
				    });
				}
				
			},
			onerror:function(e)
		    {
		        Ti.API.info('Network error: ' + JSON.stringify(e));
		        
		        test =  JSON.stringify(e);
		        alert('on error');
		    },
		    onreadystatechange:function() {
		   	
		   		test = loader.readyState + ' ' + loader.statusText + ' ' + this.responseText;

			//	alert('onreadystatechange readyState = ' + test );
		   		
	            if (this.readyState === 4) { // message completed, the first interesting state change
	                if (this.status === 200) { // send successful
	                    handleResponse(JSON.parse(this.responseText));
	                } else { // network/server error
	                    handleError(this.status,this.statusText, this.responseText);
	                }
	            }
	        }
	     });
		    
		    
		loader.open("GET","http://coalicionlazo.qipro.org/apps/webservices/ws/wscategory.php?controlname=quienessomos",false);
		loader.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		//loader.setTimeout(5000);
		 //loader.open("GET","http://api.twitter.com/1/statuses/user_timeline.json?screen_name=esmandau");
		 loader.send();
		  // loader.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		  
		    
		    
		//	var alertDialog = Titanium.UI.createAlertDialog({ title: 'Json', message: 'jsonObject  ' + ' ' + test , buttonNames: ['OK'] }); 
		   // alertDialog.show();
		    
		} catch(err){
			Titanium.API.error(err);
		    Titanium.UI.createAlertDialog({
		        message : err,
		        title : "Remote Server Error"
		    });
			
		}
}