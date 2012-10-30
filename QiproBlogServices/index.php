<?php session_start(); 

//

include "classes/category.php";

?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>


  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Qipro App Portal</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="stylesheets/foundation.min.css">
  <link rel="stylesheet" href="stylesheets/app.css">

  <script src="javascripts/modernizr.foundation.js"></script>


  
  <!-- Included JS Files (Uncompressed) -->
 <!--
  
  <script src="javascripts/jquery.js"></script>
  
  <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  
  <script src="javascripts/jquery.foundation.forms.js"></script>
  
  <script src="javascripts/jquery.foundation.reveal.js"></script>
  
  <script src="javascripts/jquery.foundation.orbit.js"></script>
  
  <script src="javascripts/jquery.foundation.navigation.js"></script>
  
  <script src="javascripts/jquery.foundation.buttons.js"></script>
  
  <script src="javascripts/jquery.foundation.tabs.js"></script>
  
  <script src="javascripts/jquery.foundation.tooltips.js"></script>
  
  <script src="javascripts/jquery.foundation.accordion.js"></script>
  
  <script src="javascripts/jquery.placeholder.js"></script>
  
  <script src="javascripts/jquery.foundation.alerts.js"></script>
  
  <script src="javascripts/jquery.foundation.topbar.js"></script>
  -->

  <!-- Included JS Files (Compressed) -->
  <script src="javascripts/jquery.js"></script>
  <script src="javascripts/foundation.min.js"></script>
  
  <!-- Initialize JS Plugins -->
  <script src="javascripts/app.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <style type="text/css">
  
  html, body {
  height: 100%;
  width: 100%;
  padding: 0;
  margin: 0;
}

#full-screen-background-image {
  z-index: -999;
  min-height: 100%;
  min-width: 1024px;
  width: 100%;
  height: auto;
  position: fixed;
  top: 0;
  left: 0;
}

#wrapper {
  position: relative;
  width:90%;
  margin-top:50px;
  /*min-height: 400px;*/
 /* margin: auto;*/
  color: #333;
}
  .invisible {
  
	display:none;
}
  
  </style>

<script type="text/javascript">
	
	
	if (typeof jQuery != 'undefined') {
 
    	//alert("jQuery library is loaded!");
 
	}else{
 
    	alert("jQuery library is not found!");
 
	}
	
	

  $(document).ready(function() {
	  
	 // alert('document is ready');
	  
	  $(document).foundationTopBar();
	  $(document).foundationButtons();
	  $(document).foundationTabs();
	  
	 // $("#changedSelectInput").foundationCustomForms();
	  
    /*$('#buttonForModal').click(function() {
      $('#loginModal').reveal({
		  
		  animation: 'fadeAndPop', //fade, fadeAndPop, none
     	  animationSpeed: 300, //how fast animations are
          closeOnBackgroundClick: true, //if you click background will modal close?
          dismissModalClass: 'close-reveal-modal' //the class of a button or element that will close an open modal
		  
		  
		  });
    });*/
	
	
	 $(document).ajaxStart(function(){
  		$('#loading').reveal();
		
 	 }).ajaxStop(function(){
   		$('#loading').hide();
		
 	});	
	
	$("#artcategory").change(function(){
		
		/*var id = $(this).find(":selected").val();
		
		var form_data = {
					catid:id ,
					is_ajax_option_change: 1,
					is_ajax:0
		};
		
	//	alert(id);
	
		$.ajax({
			async:false,
			cache:false,
			type:"POST",
			url:"newarticle.php",
			data:form_data,
			success:function(response)
			{
				
				//alert(response);
				//$('#newarticle').show();
				
				$('#childcat').html(response);
			
			}
			
		});
		*/
		
				//$('#childcat').html("update complete!!!! " + id);
				
				
	}).trigger('change');
	
	
	$('#frmnew').submit(function(e){
		return false;
	});
	
	$("#btnsavearticle").click(function(){ 
		
		var action = $("#frmnew").attr('action');
			
	
			var form_data = {
					artname: $("#artname").val(),
					artcontent: $("#artcontent").val(),
					catid: $("#artcategory").find(":selected").val(),
					is_ajax: 1
			};
			
			
			//	alert(action);
			$.ajax({
				type:"POST",
				url:action,
				data: form_data,
				success:function(response)
				{
					
					
					if(response == 'success'){
					 	$('#notificaitontext').html("<h2>Article is Saved!!</h2>");
					 	$('#notificationmodal').reveal().show();
						$('#newarticle').hide();
						
						
						
					}else{
						$('#newarticle').reveal();
						$('#articleNotification').html("<div  class='alert-box alert'>" + response + "</div>");
					}
				}
			});

			return false;
		
	});
	
	$("#btnlogin").click(function(){ 
		
		
			var action = $("#frmauth").attr('action');
			
			var form_data = {
					username: $("#username").val(),
					password: $("#password").val(),
					is_ajax: 1
			};
			
		
			$.ajax({
				type:"POST",
				url:action,
				data: form_data,
				success:function(response)
				{
					// alert(response);
					if(response == 'success'){
						//$('#loginerror').html('');
						//
					 	$('#notificaitontext').html("<p>This form is submited!!!!</p>");
					 	$('#notificationmodal').reveal().show();
						$('#loginmodal').hide();
						location.reload();
						
						
					}else{
						$('#loginmodal').reveal();
						$('#articleNotification').html("<div  class='alert-box alert'>" + response + "</div>");
					}
				}
			});

			return false;
		
	});
	
	
	
	
	
	
  });
</script>

</head>
<body>

  <img alt="full screen background image" src="images/bg/bg1.jpeg" id="full-screen-background-image" /> 

   




<nav class="top-bar">
  <ul>
    <li class="name" style="background-color:white; font-color:black"><h1><a href="#">
    <img src="images/portal/qprologo.png" style='width:37px; height:37px;'/>
    <span style="color:black">[QIPRO]</span>

    </a></h1></li>
    <li class="toggle-topbar"><a href="#"></a></li>
  </ul>
  <section>
  	<ul	class="right">
    	<li>
    	    <?php
				
				if(isset($_SESSION['uid'])){
			 		echo "<li><a href='#'>
					<img src='images/portal/user.png' style='width:20px; height:20px; margin-top:10px' ></img> 
					<span>WELCOME,  ".$_SESSION['uname']."</span></a></li>";
					echo "<li><a href='#'  data-reveal-id='logout'>
					<img src='images/portal/log-out.png' style='width:20px; height:20px; margin-top:10px' ></img> 
					<span>Log Out</span>
					</a></li>";
				}
				else
				{
					echo " <li><a href='#'  data-reveal-id='loginmodal' class='large'>
								<div style='vertical-align:buttom; font-size:18px'> 
									<img src='images/portal/log-in2.png' style='width:20px; height:20px; margin-top:10px' ></img> 
									<span>Login</span>
								</div>
								</a>
						   </li>";	
        			
      				
					
				}
		 	?>
    	</li>
    </ul>

   
  </section>
</nav>


<div id="loading" class="reveal-modal">
<center>
  <h2>Please Wait . . .
  		<img src="images/portal/ajax-loader.gif" />
  </h2>
  </center>
</div>


  <div id="wrapper">

<div id="logout" class="reveal-modal">
  <h2>Do you want logout, are you sure?</h2>
 
  <a class="close-reveal-modal">&#215;</a>
  <a href="Auth/logout.php" class="large alert button" style="width:40%" >Logout</a>
  <a class="large button" style="width:40%" onClick="$('#logout').hide();">Close</a>
</div>

<div id="notificationmodal" class="reveal-modal">
 <center>
  <div id="notificaitontext"></div>
  
  <br/>
  <a class="close-reveal-modal">&#215;</a>
  <a class="large success button" style="width:100%" onClick="$('#notificationmodal').hide();">Dismiss</a>
  </center>
</div>









<!-- LOGIN MODAL -->
<div id="loginmodal" class="reveal-modal small">
  <h2>Login User</h2>
	<form id="frmauth" name="frmauth" action="dologin.php" method="post">
  		<label>Username</label>
  		<input name="username" id="username" type="text" placeholder="Enter your username" ></input>
  
  		<label>Password</label>
  		<input name="password" id="password"  type="password"  placeholder="Enter your password" ></input>
  
  
    	<div id="loginerror"></div>
  
  
  		<div class="alert-box secondary">Never shared your password.
  			<a href="#" class="close">&times;</a>
 		</div>
  
  		<a href="#" id="btnlogin" class="large success button" >Login</a>
  
   		<button  type="reset" id="btnCancel" class="large alert button">Reset</button>
	</form>  
	<a class="close-reveal-modal">&#215;</a>
</div>





 <!-- NEW ARTICLE MODAL -->
 <div id="newarticle" class="reveal-modal">
  <h3>New Article</h3>
   <div id="articleNotification"></div>
  <a class="close-reveal-modal">&#215;</a>
  <form id="frmnew" name="frmnew" action="newarticle.php" method="post">
  	  <label>Name:</label>
      <input name="artname" id="artname" type="text" placeholder="Enter a new article name" />
      
      <label>Category:</label>
      <select name="artcategory" id="artcategory">
      	<?php 
		 		$cat = new Category();
			    $cat ->getOptionItems(); 
		?>
      </select>
      <br/> <br/>
      <div id="childcat"></div>
      
	  <label>Content:</label>
      <textarea name="artcontent" id="artcontent"  placeholder="Message" rows="20"></textarea>
       <a href="#" id="btnsavearticle" class="large button" style="width:100%" >Save Article</a>
  </form>
</div>
 
 <!-- NEW ARTICLE MODAL -->
 <div id="allarticle" class="reveal-modal large">
 
	
  </div>
  
<div class="<?php  if($_GET['page'] == 'allarticle') echo 'row'; else echo'invisible'; ?>">
     <div class="twelve columns">
     		<div class="panel">
            <h3>All Article</h3>
   <div id="allarticleNotification"></div>

   
  
  <dl class="tabs contained">
 	<?php
			$cat = new Category();
			$dt  = $cat->getHeaderItems();
			
			$ch=0;
			$cd=0;
			foreach( $dt as $row)
			{
				$cd=0;
				
				if($row['cat_name']=='UNKNOWN')
					echo "<dd class='active'>";
				else
					echo "<dd>";
					
				echo "<a href='#con".$row['cat_id']."'>$row[cat_name]</a></dd>";
				
				
	
				
	
			}
			

	?> 	
    </dl>
    <ul class="tabs-content contained">
    		<?php
			
			
			$cat = new Category();
			$dt  = $cat->getHeaderItems();

			foreach( $dt as $row)
			{
				
				
				if($row['cat_name']=='UNKNOWN')
					echo "<li class='active' id='con".$row['cat_id']."'>";
				else
					echo "<li id='con".$row['cat_id']."'>";
					
				echo "---> $row[cat_name]";
				echo $row['cat_id'];
				//$cat->getArticle($row['cat_id']);
				
				echo "</li>";
	
			}
			
			?>
		</ul>	
           
           
           
            </div>
     
     </div>

</div>







<div class="<?php  if(isset($_SESSION['uid']) && $_GET['page'] == null) echo 'row'; else echo'invisible'; ?>">
  <div class="eight columns">
    <div class="row">
      <div class="six columns">
      		<div class="panel">
            <center>
            <a href="#"  data-reveal-id="newarticle">
  			<h5>New Article</h5>
             <img src="images/portal/newPost.png"/>	
             </a>
  			</center>
			</div>
      </div>
      <div class="six columns">
        	<div class="panel">
  			<center>
            <a href="?page=allarticle" >
  			<h5>Manage Article</h5>
             <img src="images/portal/article.png"/>	
             </a>
  			</center>
			</div>
      </div>
    </div>
    <div class="row">
      <div class="six columns">
      		<div class="panel">
  			<center>
  			<h5>Notifications</h5>
             <img src="images/portal/alerts.png"/>	
  			</center>
			</div>
      </div>
      <div class="six columns">
        	<div class="panel">
            <center>
  			<h5>Maintenance</h5>
            <img src="images/portal/adminTool.png"/>	
  		</center>
			</div>
      </div>
    </div>
    
  </div>
</div>

  </div>




</body>
</html>