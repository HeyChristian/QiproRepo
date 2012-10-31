function ApplicationWindow(title) {
	
	
	//Ti.API.debug('On Change --->' + title);
	
	//var alertDialog = Titanium.UI.createAlertDialog({ title: 'Hello', message: 'You got mail -->' + title, buttonNames: ['OK','Doh!'] }); 
	//alertDialog.show();
	/*
	var self = Ti.UI.createWindow({
		title:title,
		backgroundColor:'white'
	});*/
	
	var self;
	if(title==='Home'){
		self=CreateHome();
	}else if(title==='Blog'){
		self=CreateBlog();
	}else{
		self=CreateContactus();
		
	}
	
	
	
	/*
	
	var button = Ti.UI.createButton({
		height:44,
		width:200,
		title:L('openWindow'),
		top:20
	});
	self.add(button);
	
	button.addEventListener('click', function() {
		//containingTab attribute must be set by parent tab group on
		//the window for this work
		self.containingTab.open(Ti.UI.createWindow({
			title: L('newWindow'),
			backgroundColor: 'white'
		}));
	});
	*/
	return self;
};


function CreateHome(){
	
	
	var win = Ti.UI.createWindow({
		
		title:'Home',
		backgroundColor:'white',
		navBarHidden:true,
		
		
	});
	
	

	
	var view = Ti.UI.createView({
		
				
		
	});
	
	var logoBar = Ti.UI.createImageView({
		 image:'images/qprologo.png',
		 top:5
		
	});
	view.add(logoBar);
	
	var menuView = Ti.UI.createView({
		
		top:100,
		height:370,
			backgroundImage : 'images/ios-linen.jpg',
		backgroundRepeat : true,
		
	});
	
	var scrollMenu = Ti.UI.createScrollView({
		contentWidth : 'auto',
		contentHeight : 'auto',
		showVerticalScrollIndicator : true,
		layout : 'vertical'
		
	});
	
	


	
	var title ='Quiénes Somos';
	var subtitle='Misión y Visión, Propósito,Responsabilidades, Organizaciones afiliadas';
	var image='/images/home.png';
	var destination = 'quienessomos';
	
	scrollMenu.add(GetFrontItem(win,title,subtitle,image,destination));
	
	
	title='Recursos';
	subtitle = 'Presentaciones, Modelos de mejoramiento';
	image = '/images/briefcase.png';
	destination='recursos';
	
	scrollMenu.add(GetFrontItem(win,title,subtitle,image,destination));
	
	title='Lo Más Reciente';
	subtitle = 'Redes de Aprendizaje y Acción';
	image = '/images/mostRecent.png';
	destination='lomasreciente';
	scrollMenu.add(GetFrontItem(win,title,subtitle,image,destination));
	
	
	
	menuView.add(scrollMenu);
	view.add(menuView);
	
	
	win.add(view);
	
	
	
	
	return win;
	
}
function GetFrontItem(win,title,subtitle,image,destination){
	
	
	var iView = Ti.UI.createView({
		height : 100,
		width : '100%'

	});

	
	var btn = Ti.UI.createButton({
		
		height : 85,
		width : '120%',
		left : 10,
		right : 0,
		backgroundImage : '/images/light.png',
		top : 20
	});
	var lblMain = Ti.UI.createLabel({
		text : title,
		height : 'auto',
		width : 'auto',
		color : 'white',
		left : 84,
		top : 25,
		font : {

			fontSize : 22,
			fontColor : '#fff'
		}
	});
	//SUB LABEL
	var lblSubTitle = Ti.UI.createLabel({
		text : subtitle,
		height : 'auto',
		width : '200',
		color : 'white',
		left : 84,
		top : 52,
		font : {
			fontSize : 12,
			fontColor : '#fff'
		}
	});

	var imgBtn = Ti.UI.createImageView({
		image : image,
		width : 45,
		height : 45,
		top : 40,
		left : 25
	});


    var imgNavigator = Ti.UI.createImageView({
		image : '/images/rightA2.png',
		width : 50,
		height : 50,
		top : 38,
		right : 0
	});
	
	iView.add(btn);
	iView.add(lblSubTitle);
	iView.add(imgBtn);
	iView.add(lblMain);
	iView.add(imgNavigator);
	
	
	
	btn.addEventListener('click', function() {
	
	
	
		win.containingTab.open(callJsonHomeCategories(title,destination,win));
		
		
		
	});


	
	
	
	return iView;
	
}







function callJsonHomeCategories(title,controlname,rootwin) {
	// Empty array "rowData" for our tableview
	try{
		
		
	
	     var child = Titanium.UI.createWindow({
			navBarHidden:false,
			barColor:'black',
			title:title
		
		 });
	
		 	var jresult = [];
		  	var size_data;
			
			var loader = Ti.Network.createHTTPClient({
		
			onload:function(e) {
				
				
				var request = loader.responseText;

				try{
				
					var json =    JSON.parse(request);  //eval('(' + request + ')');
					size_data = json.length;
					
					//alert("size json: " + size_data);
					//eval('(' + this.responseText + ')');
					for(var i = 0; i < size_data; i++) {
							//data.id = res[i].cat_id;
							//data.name =  res[i].cat_name;
							
							//alert(json[i].art_content);
							
							jresult.push({
								id  :json[i].cat_id,
								title:json[i].cat_name,
								type:json[i].art_type,
								content:json[i].art_content,
								artid:json[i].art_id
							});
							
			
					}
				
				
					
					
					
	
					
					child.add(GetSubChild(jresult,rootwin));
					
					
					
					
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
		   	
		   	
		
	            if (this.readyState === 4) { // message completed, the first interesting state change
	                if (this.status === 200) { // send successful
	                    handleResponse(JSON.parse(this.responseText));
	                } else { 
	                    handleError(this.status,this.statusText, this.responseText);
	                }
	            }
	        }
	     });
		    
		    
		loader.open("GET","http://coalicionlazo.qipro.org/apps/webservices/ws/wscategory.php?controlname=" + controlname,false);
		loader.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		loader.send();

		    
		    return child;
		    
		} catch(err){
			Titanium.API.error(err);
		    Titanium.UI.createAlertDialog({
		        message : err,
		        title : "Remote Server Error"
		    });
			
		}
}


function GetSubChild(jresult,rootwin){
	
					
						var tableview = Titanium.UI.createTableView({
					    	data:jresult
						});
					
						// create table view event listener
						tableview.addEventListener('click', function(e)
						{
						    
						    
						    
						    var winTitle='';
						    
						    if(e.rowData.type == "LST"){
						    	winTitle=e.rowData.title;
						    }
						    
						    
						    
						     var win = Titanium.UI.createWindow({
						            
						            title:L(winTitle),
						            //backgroundColor:'white', 
						            navBarHidden:false, 
						            barColor:'black',
						            backgroundImage : 'images/ios-linen.jpg',
									backgroundRepeat : true,
						            
						    });
					
						    
						    
						    //alert(e.rowData.content);
						    //alert(e.rowData.type);
						    
						    if(e.rowData.type == "TXT"){
						    	
						    	//var actInd = Titanium.UI.createActivityIndicator();

								//actInd.message = 'Please wait...';//message will only shows in android. 
								
								//win.add(actInd);
						    	
						    	//actInd.show();
						    	var scroll = Ti.UI.createScrollView({
						    		top:38,
						    		contentHeight:'auto',
						    		contentWidth:300, 
						    		showVerticalScrollIndicator:true, 
						    		layout:'vertical'
						    		
						    	});
						    	
						    	var header = Ti.UI.createLabel({
						    		
						    		text:L(e.rowData.title),
						    		top:0,
						    		left:3,
						    		color:'white',
						    		font:{
						    			fontSize:26, 
						    		}
						    	});
						    	
							    var label = Ti.UI.createLabel({
							    	top:35,
							    	left:3,
							    	color:'white',
							    	height:'auto',
							    	textAlign:'justify',
							    	text:L(e.rowData.content)
							    });
							    
							    win.add(header);
							    scroll.add(label);
						
							  	
							  	win.add(scroll);
							 	
							   
						   
						   }else if(e.rowData.type == "LST"){
						   	
						   	
						   			
						   	
						   	
						   	 		var jresult2 = [];
		  							var size_data;
			
						   			var loader = Ti.Network.createHTTPClient({
		
										onload:function(e) {
												var request = loader.responseText;
											   // alert(request);
												try{
												
													var json =    JSON.parse(request);  
													
													size_data = json.length;
													for(var i = 0; i < size_data; i++) {
					
															jresult2.push({
																id  :json[i].id,
																title:json[i].art_name,
																type:json[i].art_type,
																content:json[i].art_content,
																docurl:json[i].art_pdf_url
															});
															//alert(json[i].art_name);
											
													}
												
												
													//alert('antes de llamarse ella misma');
													win.add(GetSubChild(jresult2,rootwin));
													
													
													
													
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
									onreadystatechange:function() {
		   	
		   	
		
								            if (this.readyState === 4) { // message completed, the first interesting state change
								                if (this.status === 200) { // send successful
								                    handleResponse(JSON.parse(this.responseText));
								                } else { 
								                    handleError(this.status,this.statusText, this.responseText);
								                }
								            }
								        }
									
									});
				
									loader.open("GET","http://coalicionlazo.qipro.org/apps/webservices/ws/wscategory.php?artid=" + e.rowData.artid,false);
									loader.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
									loader.send();
													   	
						   	
						   	
						   }else if(e.rowData.type == "PDF"){
						   	
						   		var webview = Titanium.UI.createWebView({
								    url:L(e.rowData.docurl),
								    top:0,
								    height:"auto",
								    width:"auto"
								});
														   	
						  		win.add(webview) 	
						   }
						  
						  rootwin.containingTab.open(win);
						    
						    
						});
	
	
	
	return tableview;
	
}

function CreateBlog(){
	
	
	var win = Ti.UI.createWindow({
		
		title:'Blog',
	
		
	})
	return win;
	
}

function CreateContactus(){
	
	
	var win = Ti.UI.createWindow({
		
		title:'Contact us',
		backgroundColor:'blue'
		
	})
	return win;
	
}

module.exports = ApplicationWindow;
