<?php 
	
	session_start(); 

	if(isset($_GET['page']))
	{
		$_SESSION['page'] = $_GET['page'];
	}
	else {
		$_SESSION['page'] = 1;
	}

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html> 
<head> 



	<title>[#jaltodeodio]</title> 
	
    <meta name="Description" content="Desahoga tu odio AQUI!!!!" /> 
    <meta name="Keywords" content="#jaltodeodio,jaltodeodio.com,jaltoDodio,jaltoDodio.com,group, fan page,fanpage,jaltodeodio,jalto d odio, jdo,JDO,ODIO,jalto de odio,ODIO,halto de odio,twitter,facebook,Web Design,Christian Vazquez,Pollo Truco,Pollo,PHP,C#,JavaScript,Java,Web Development" /> 
    
	<meta http-equiv="content-type" content="text/html;charset=utf-8" /> 
	<meta http-equiv="Content-Style-Type" content="text/css" /> 
	
	<link rel="stylesheet" type="text/css" href="css/reset.css" /> 
	<link rel="stylesheet" type="text/css" href="css/main.css" /> 
	
	<link rel="apple-touch-icon" href="#"/>
	
	<script type="text/javascript" src="scripts/jquery.js"></script> 
	<script type="text/javascript" src="scripts/jquery.scrollTo.js"></script> 
	<script type="text/javascript" src="scripts/jquery.localscroll.js"></script> 
	<script type="text/javascript" src="scripts/jquery.validate.js"></script> 
 	<script type="text/javascript" src="scripts/jquery.form.js"></script> 
	
	
	

  <!-- stylesheets -->
  	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />
	
  
	<!--[if lte IE 6]>
		<script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>
	<![endif]-->
	 
    <!-- jQuery - the core -->
	<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="js/slide.js" type="text/javascript"></script>

	<!-- mooTools 
	<script type="text/javascript" src="js/mootools-1.2-core-yc.js"></script> 
    <script type="text/javascript" src="js/mootools-1.2-more.js"></script> -->
    <!-- Form Check -->
    <script type="text/javascript" src="js/lang/en.js"> </script>
    <!--  script type="text/javascript" src="js/formcheck.js"> </script-->
    <!-- Theme -->
    <link rel="stylesheet" href="theme/classic/formcheck.css" type="text/css" media="screen" />
	
	<script type="text/javascript">

	 /* window.addEvent('domready', function(){
	        new FormCheck('frmBlogPost');
	    });*/


	
	    
	    

	
    $(document).ready(function(){



        

        $(".watermark").each(function(){
           $(this).val($(this).attr('placeholder'));
        });

        $(".watermark").focus(function(){

            var placeholder = $(this).attr('placeholder');
            var current_value = $(this).val();
            $(this).css('color', '#192750');
            if(current_value == placeholder) {
                $(this).val('');


            }

        });

        $(".watermark").blur(function(){

            var placeholder = $(this).attr('placeholder');
            var current_value = $(this).val();

            if(current_value == '') {
                $(this).val(placeholder);
                $(this).css('color', '#676767');
            }

        });



    })
	
	</script>
	
<?php 
		include_once('Scripts/analyticstracking.php'); 
 		include("Framework/Static/dbcon.php");	
	?>
</head> 
 
<body>


<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h3>Desahoga Tu Odio!!</h3>
		
				<p class="grey">Recuerda que todo comentario es anonimo asi que ten la libertad de escribir lo que realmente deseas.</p>
				<!--  h2></h2>-->
				<br/>
				<p class="grey">Al Poner el Email puedes reclamar tu odio!!  <a href="#" title="Download">Notificalo Aqui!</a></p>
			</div>
			<form id="frmBlogPost" class="clearfix" action="blogPost.php" method="post">
			<div class="left">
				
				
					<h3>Comparte tu Odio</h3>
					<label class="grey" for="username">NickName:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="email">Email:</label>
					<input class="field watermark" placeholder='Opcional'  type="text" name="email" id="email" size="23" />
					
					
	           
				
			</div>
			<div class="left right">			
			
			
					
					<label class="grey" for="postblog"></label>
					<label class="grey" for="postblog"></label>
				    <textarea class="field" name="postblog" id="postblog" cols="18" rows="10"></textarea> 
						<br/>
					<input type="submit" name="submit" value="Post" class="bt_register" />
				
			</div>
			</form>
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<!-- <li>Hello Hater!</li>
			<li class="sep">|</li> -->
			<li id="toggle">
				<a id="open" class="open" href="#">Postea tu Odio</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

   <!--   <div id="container">
		<div id="content" >-->


		<div id="contentBody">



<div id="wrapper"> 
	<a href="?page=1">
	<div id="header"> 
		<h1>Jalto de Odio</h1>
		<h2>...</h2> 
	</div> 
	</a>
	<div id="showcase"> 
		
	
		<center> 
		<?php include('paging.php'); ?>
		</center>
		<br/><br/>
		
		
		<?php 
			
			include('Posts.php'); 
			
		?>
		<center> 
		<?php include('paging.php'); ?>
		</center>
		<div class="hr"><hr /></div> 
		<br/><br/>
		<?php // include('newPost.php'); ?>
		
		
		
	</div> 
	
	<div id="subcontent"> 
		
		<div id="twitter_div"> 
			<h2 class="twitter-title">My twitterings</h2> 
 
			<ul id="twitter_update_list" style="color:graytext"> 
				<li>My Twitterings....</li> 
			</ul> 
			<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script> 
			<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/mojopollo.json?callback=twitterCallback2&amp;count=5"></script> 
 
			<p><a href="http://twitter.com/mojopollo" class="twitter_link" title="Visit my feed on twitter.com.">Follow me on twitter</a></p> 
 
		</div> 
		
		<h3 class="ontheweb">Around the web</h3> 
		
		<div class="pullout lastfm"> 
		
			<h4>I&rsquo;m on FaceBook</h4> 
			<p></p> 
			<p><a href="#" title="PolloFaceBook">Pollo On FaceBook</a></p> 
		</div> 
		
		<div class="pullout flashden"> 
		
			<h4>I&rsquo;m on Twitter</h4> 
			<p></p> 
			<p><a href="http://www.twitter.com/mojopollo" title="Pollo On Twitter">Pollo On Twitter</a></p> 
		</div> 
		
		<div class="pullout lastfm"> 
		
			<h4>I&rsquo;m in Your House</h4> 
			<p></p> 
			<p><a href="#" title="">On Your House</a></p> 
		</div> 
		<div>
			
				<?php include('ads/ads.php'); ?>
				<br/>
		</div>
		
	</div> 
	
	

	<div id="footer-close"><hr /></div> 
</div> 
 <!-- 
 </div>/ content >
        <div class="clearfix"></div>
	</div> container -->
	</div>
<?php include('Scripts/quantcast.php'); ?>
</body> 
</html>