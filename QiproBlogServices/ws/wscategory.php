<?php
	// header("Content-type: application/json; charset=utf-8");
		header("Content-type: application/json;charset=utf-8");

		include("../Framework/Static/dbcon.php");
		//include "../classes/category.php";
		
		if(isset($_GET['controlname'])){
		
			$controlname=$_GET['controlname'];
			$q = "select cd.cat_id, cd.cat_name as cat_name,a.art_type,a.art_content from categories cd left
			 join categories ch on cd.cat_id_parent = ch.cat_id 
			 join articles a on cd.cat_id = a.category_id where ch.cat_control_name='$controlname'";
				
				
				$dbcon = new dbcon();
				$dt    =  $dbcon->GetArray($q);
				echo $dt;
				echo json_encode($dt);
	
		}
	 

?>