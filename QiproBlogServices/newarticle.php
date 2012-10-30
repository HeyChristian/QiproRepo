<?php

		session_start();
		include("Framework/Static/dbcon.php");	
		include("clases/category.php");
		
		try{
		
			
		
			$is_ajax = $_REQUEST['is_ajax'];
			if(isset($is_ajax) && $is_ajax)
			{
				$name = $_REQUEST['artname'];
				$content = $_REQUEST['artcontent'];
				$catid =$_REQUEST['catid'];
			
			
			

				
					$dbcon = new dbcon();
		
				
			
					
					$q="insert into articles (art_name,art_content,category_id) values('$name','$content',$catid)";
					
				  	$result = $dbcon->exec0($q);
			
			
			
				if($result)	
				{
					echo "success";	
					
				}else{
				
					echo "An Error Occur, Please Verified your input and try again later!";
				}
			}
			
		}catch(Exception $e){
			echo $e->getMessage();	
		}






		try{
		
		
			$is_ajax2 = $_REQUEST['is_ajax_option_change'];
			if(isset($is_ajax2) && $is_ajax2)
			{
				  $catid = $_REQUEST['catid'];
				   //echo "funcino   $catid";
				   $cat = new Category();
				   echo $cat->getChildItems($catid); 
				  //echo "funciono ";
			}
		}
		catch(Exception $e){
			
			echo $e->getMessage();	
		}









?>