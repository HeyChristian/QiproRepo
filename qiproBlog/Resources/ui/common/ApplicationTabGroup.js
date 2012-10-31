function ApplicationTabGroup(Window) {
	//create module instance
	var self = Ti.UI.createTabGroup();
	
	//create app tabs
	var win1 = new Window(L('Home')),
		win2 = new Window(L('Blog')),
		win3 = new Window(L('Contact us'));
	
	
	
	
	var tab1 = Ti.UI.createTab({
		title: L(''),
		icon: '/images/home2.png',
		window: win1
	});
	
		tab1.addEventListener("click",function(){
			
			if(!Ti.Platform.osname === 'android'){
				Window.hideNavBar();
			}
			
		});
	
	
	win1.containingTab = tab1;
	
	var tab2 = Ti.UI.createTab({
		title: L(''),
		icon: '/images/blog4.png',
		window: win2
	});
	win2.containingTab = tab2;
	
	
	var tab3 = Ti.UI.createTab({
		title: L(''),
		icon: '/images/about2.png',
		window: win3
	});
	win3.containingTab = tab3;
	
	
	

	
	self.addTab(tab1);
	self.addTab(tab2);
	self.addTab(tab3);
	
	return self;
};





module.exports = ApplicationTabGroup;
