<?php 
			
class comments
{

		
		function TotalComment($pid)
		{
		
		
			$dbcon = new dbcon();
			$q = "SELECT COUNT(active) as count  FROM comments WHERE pid=".$pid." and active= 1 order by id ASC";
				
				$dt    =  $dbcon->GetArray($q);
				$count=0;
				foreach($dt as $row)
				{
					$count = (int)$row["count"];
				}
				
				
				$h = "<p><a class='spch-bub-inside' href='#'>
        	    <span class='point'></span><em>".$count." comments</em></a></p>"; 
				if($count==0)
					$h="";
		
			return $h;
		
		}

		function show($pid,$page=1)
		{
			
		
			
	
		
		   $hr ="<hr style='border:dashed 1px #abbb36' />";
		   //echo $hr;
			 $m = "<table width='600px' border='0'>";

				//include("Framework/Static/dbcon.php");	
			$dbcon = new dbcon();
	
			if(isset($pid))
			{
				$q = "SELECT * FROM comments WHERE pid=".$pid." and active= 1 order by id ASC";
				
				$dt    =  $dbcon->GetArray($q);
				foreach($dt as $row)
				{
					
					$m .= "<tr><td><table width ='100%'><tr>";
					//echo "<td>";	
					//echo "<h4>".$row["username"]."</h4>";
					//echo "<h5>".FormatDate($row['date'])."</h5>"; 
					//echo "</td>";
					$m .= "<tr><td><span style='color:#10a1e2'>Hater Says:</span> | <span style='color:gray'>".$row["comment"]."</span><br/><span style='font-size:10px; color:white'>".$this->ago($row['ago'])."</span></td></table></td></tr>";
					$m .= "<tr><td>$hr</td></tr>";
					
				}
			
		  	}
			

			$m .= "
			<tr>
				<td>
			
					<form id='comment-".$pid."' method='post' action='CommentPost.php?pid=".$pid."&page=$page'> 
					<table width='100%'>
						<tr>
							<td colspan='2'>
								
							    <textarea rows='2'
							    cols='78'
							    placeholder='Post your hater comment here' 
							    name='txtshortpost' id='txtshortpost'.$pid.' 
							    class='field watermark' style='color:white'>Post your hater comment here</textarea>
							</td>
						</tr>
						<tr align='right'>
							<td colspan='2' align='right' style='text-align:right'>
								
										
										<input type='submit' name='submit' value='Hate Post' class='bt_register' />
								
							</td>
						</tr>
					</table>
					</form>
				</td>
			</tr>
			
			</table>";
			return $m;
			}
	function ago($time)
				{
					$ago="";
				
					if(strlen($time) > 0)
					{
					   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
					   $lengths = array("60","60","24","7","4.35","12","10");
					
					   $now = time();
					
					       $difference     = $now - $time;
					       $tense         = "ago";
					
					   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
					       $difference /= $lengths[$j];
					   }
					
					   $difference = round($difference);
					
					   if($difference != 1) {
					       $periods[$j].= "s";
					   }
					   $ago = "  $difference $periods[$j]  ago";
					}
				
				
				   return $ago;
				}
}
?>