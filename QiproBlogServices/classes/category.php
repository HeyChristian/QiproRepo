<?php

include("Framework/Static/dbcon.php");
class Category{
	
	
	
	function getHeaderItems(){
		
			$dbcon = new dbcon();
			$q = "select cat_id,upper(cat_name) as cat_name from categories where cat_id_parent = 0 and expiration_date is null order by cat_name desc";
				
			$dt    =  $dbcon->GetArray($q);
			return $dt;
		
	}
	function getSingleChildItems($catid){
		
			$dbcon = new dbcon();
			$q = "select cat_id,upper(cat_name) as cat_name from categories where cat_id_parent = $catid and expiration_date is null order by cat_name desc";
				
			$dt    =  $dbcon->GetArray($q);
			return $dt;
		
	}
	
	function getArticle($catid){
	
		
		
		
	}
	
	function getItems($catid){
		
		
		try{
			
			$dbcon = new dbcon();
			$q = "select 
						id,
						art_name,
						art_content,
						cat_name 
				from
						 articles a 
				left join 
						categories c 
					on 
						a.category_id = c.cat_id 
				where c.cat_id_parent = $catid and a.expiration_date is null";
				
				
				$dt    =  $dbcon->GetArray($q);
				$count=0;
				
				$t='';
				
				
				echo "<table>";
				echo "<tr><td>ID</td><td>NAME</td><td>CATEGORY</td></tr>";
				foreach($dt as $row)
				{
					
					//$options = $options."<option value='$row[cat_id]'>$row[cat_name]</option>";
					//$t = $t.$this->getChildItems($row['cat_name'],$row['cat_id']);
					echo "<tr>";
					
					echo "<td>$row[id]</td>";
					echo "<td>$row[art_name]</td>";
					echo "<td>$row[cat_name]</td>";
					
					
					
					echo "</tr>";
					
				}
				
				echo "</table>";
			
			
		}catch(Exception $e){
		
			
			
		}
		
		
		
	}
	
	function getOptionItems(){
		
		
		try{
			
			
				
				
			
				foreach($this->getHeaderItems() as $hrow)
				{
					
			       //$options = $options."<option value='$row[cat_id]'>$row[cat_name]</option>";
					//getChildItems($row['cat_name'],$row['cat_id']);
					//echo "<option value='$row[cat_id]'>$row[cat_name]</option>";
					
					foreach ($this->getSingleChildItems($hrow['cat_id']) as $drow){
						
						echo "<option value='$drow[cat_id]'>$hrow[cat_name]   -  $drow[cat_name]</option>";
						
					}
					
					
					
				}
				
		
			
			
		}catch(Exception $e){
		
			
			
		}
		
		
		
	}
	function getChildItems($catname,$catid){
		try{
			
			$dbcon = new dbcon();
			$q   = "select cat_id,upper(cat_name) as cat_name from categories where cat_id_parent = ".$catid." and expiration_date is null";
			
			
		
			$dt  =  $dbcon->GetArray($q);
				
			$count=0;
				
				
			$options='';//"<label>Sub Category</label><select id='childcat' >";
				
				foreach($dt as $row)
				{
					
					$options = $options."<option value='".$row["cat_id"]."'>".$catname."	- ".$row["cat_name"]."</option>";
					//$count = (int)$row["count"];
					
					$count = $count +1;
				}
				//$options=$options."</select><br/></br>";
				
				
				
				if($count > 0){
					echo $options;
				}else{
					echo "<option value='$catid'>$catname</option>";	
				}
			//echo "<option value=$catid>$q</option>";
			
			
			
		}catch(Exception $e){
		
			//echo $e->getMessage();	
			
		}
		
	}
	
	
	
	
}


?>