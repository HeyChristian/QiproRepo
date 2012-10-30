<?php
		session_start();
		try{
		
			include("Framework/Static/dbcon.php");	
		
			$is_ajax = $_REQUEST['is_ajax'];
			if(isset($is_ajax) && $is_ajax)
			{
				$username = $_REQUEST['username'];
				$password = $_REQUEST['password'];
			
			
			
			
				//Authentication statement
				
					$dbcon = new dbcon();
		
				
					$q = "SELECT * FROM auth WHERE USERNAME='".$username."' and PASSWORD='".$password."'";
					
					$dt    =  $dbcon->GetArray($q);
					
					$is_auth=false;
					foreach($dt as $row)
					{
						$_SESSION['uid']   = $row['ID'];
						$_SESSION['uname'] = $row['NAME'].' '.$row['LAST_NAME'];
						
						
						$is_auth=true;
					}
					
				
			
			
			
				if($is_auth)	//if($username == 'demo' && $password == 'demo')
				{
					echo "success";	
					//echo $_SESSION['uname'];
				}else{
					//echo $username.'  '.$password;
					//echo $q;
					echo "Username or password incorrect, Please verified!";	
				}
			}
			
		}catch(Exception $e){
			echo $e->getMessage();	
		}
	
?>