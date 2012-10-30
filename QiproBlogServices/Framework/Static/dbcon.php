<?php 
class dbcon
{ 	
	
	var $dbConfig;
	var $query=''; //="select * from Entity";
	
	function _construct($id){
		
		//$dbConfig = new DBConfig();
	}
	function exec($q=""){
		
		try{
	    $dbConfig = new DBConfig();
	    $dbConfig ->config();
	    $dbConfig ->conn();
	    
		$result= mysql_query($this->query) or die(mysql_error());
		
		$dbConfig->Close();
	    return $result;
		}catch(Exception $e){
		
			echo $e->getMessage(); 
		}
	}
	function GetArray($q){
	
		//print "query GetArray ".$this->$query;
		//print "<BR>";
		return $this->mysql_fetch_full_result_array_byIndex($this->exec0($q));	
	}

	
	function exec0($q="")
	{
		try{
			$dbConfig = new DBConfig();
	    	$dbConfig ->config();
	    	$dbConfig ->conn();
			$result = mysql_query($q);
			$dbConfig->Close();
			return $result;
		}
		catch(Exception $e)
		{
			return false;
		}
	
	}
	function ShowTable()
	{
			$dbConfig = new DBConfig();
	    	$dbConfig ->config();
	    	$dbConfig ->conn();
		
			$result = mysql_query($this->query);
			$numfields = mysql_num_fields($result);
			
			
			echo $tbl = "<table>\n<tr>";

			for ($i=0; $i < $numfields; $i++) // Header
			{ echo '<th>'.mysql_field_name($result, $i).'</th>'; }

			echo "</tr>\n";

			while ($row = mysql_fetch_row($result)) // Data
			
			{ echo '<tr><td>'.implode($row,'</td><td>')."</td></tr>\n"; }

			echo "</table>\n";

			$dbConfig->Close();
	}
	
	
	function mysql_fetch_full_result_array($result)
	{
	
		//print "query fetch array ".$this->$query;
		//	print "<BR>";
    	$table_result=array();
    	$r=0;
    	while($row = mysql_fetch_assoc($result)){
        	$arr_row=array();
        	$c=0;
        	while ($c < mysql_num_fields($result)) 
        	{        
            	$col = mysql_fetch_field($result, $c);    
            	$arr_row[$col -> name] = $row[$col -> name];            
            	$c++;
        	}    
        	$table_result[$r] = $arr_row;
        	$r++;
    }    
    return $table_result;
}
	function mysql_fetch_full_result_array_byIndex($result)
	{
	
		//print "query fetch array ".$this->$query;
		//	print "<BR>";
    	$table_result=array();
    	$r=0;
    	while($row = mysql_fetch_assoc($result)){
        	$arr_row=array();
        	$c=0;
        	while ($c < mysql_num_fields($result)) 
        	{        
            	$col = mysql_fetch_field($result, $c);    
            	$arr_row[$col-> name] = $row[$col -> name];            
            	$c++;
        	}    
        	$table_result[$r] = $arr_row;
        	$r++;
    }    
    return $table_result;
}

}


class DBConfig {

    var $host = 'qipro12.db.9606288.hostedresource.com';
    var $user = 'qipro12';
    var $pass = 'zxc123ZXC';
    var $db	  = 'qipro12';
    var $db_link;
    var $conn = false;
    var $persistant = false;
    
    public $error = false;

    public function config(){ // class config
        $this->error = true;
        $this->persistant = false;
    }
    
    function conn($host='qipro12.db.9606288.hostedresource.com',$user='qipro12',$pass='zxc123ZXC',$db='qipro12'){ // connection function
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        
        // Establish the connection.
		
		mysql_query("SET NAMES 'utf8'");
		
        if ($this->persistant)
            $this->db_link = mysql_pconnect($this->host, $this->user, $this->pass, true);
        else 
            $this->db_link = mysql_connect($this->host, $this->user, $this->pass, true);



		//mysql_query("SET NAMES 'utf8'");
		mysql_set_charset('utf8');
		
        if (!$this->db_link) {
            if ($this->error) {
                $this->error($type=1);
            }
            return false;
        }
        else {
        if (empty($db)) {
            if ($this->error) {
                $this->error($type=2);
            }
        }
        else {
            $db = mysql_select_db($this->db, $this->db_link); // select db
            if (!$db) {
                if ($this->error) {
                    $this->error($type=2);
                }
            return false;
            }
            $this -> conn = true;
        }
            return $this->db_link;
        }
    }

    function close() { // close connection
   
        if ($this -> conn){ // check connection
            if ($this->persistant) {
                $this -> conn = false;
            }
            else {
                mysql_close($this->db_link);
                $this -> conn = false;
            }
        }
        else {
            if ($this->error) {
                return $this->error($type=4);
            }
        }
    }
    
    public function error($type=''){ //Choose error type
        if (empty($type)) {
            return false;
        }
        else {
            if ($type==1)
                echo "<strong>Database could not connect</strong> ";
            else if ($type==2)
                echo "<strong>mysql error</strong> " . mysql_error();
            else if ($type==3)
                echo "<strong>error </strong>, Proses has been stopped";
            else
                echo "<strong>error </strong>, no connection !!!";
        }
    }
}

?>
