<?php
class KomarOrm{
	 private $_host = "127.0.0.1";
	 private $_username;
	 private  $_instance;
	private $_password;
	  private $_database;
	  private $_sql_command;
	  private $_delete_all=false;
private function __construct($args){
	$this->_host=$args[0];
		$this->_username=$args[1];
$this->_password=$args[2];
$this->_database=$args[3];
$this->_sql_command='';


}
	private function __clone(){}
	static function connect($host,$username,$password,$database){
	return new self(func_get_args());
	
}
private function getInstance(){
		if(!$this->_instance) { 
			$this->_instance = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
			
		}
		return $this->_instance;

		if (mysqli_connect_errno()) { 
   printf("Connection to the server is impossible. The code of the error is following: %s\n", mysqli_connect_error()); 
   exit; 
}
}

public function delete(){
$result='DELETE ';
	if(func_num_args()===0){
		$result.=' ';

	}else if(is_array(func_get_arg(0))){
		$array=func_get_arg(0);
		$len=sizeof($array);
			for ($i=0; $i<$len ; $i++) { 
			$result.=' '.$array[$i].', ';

		}
		
		$result=substr($result,0,-2);
	}
	
       $this->_sql_command=$result;
       return $this;
}


public function select(){
	$result='SELECT ';
	if(func_num_args()===0){
		$result.=' * ';


	}else if(is_array(func_get_arg(0))){
		$array=func_get_arg(0);
		$len=sizeof($array);
			for ($i=0; $i<$len ; $i++) { 
			$result.=' '.$array[$i].', ';

		}
		
		$result=substr($result,0,-2);
	}
	
       $this->_sql_command=$result;
       return $this;
}
public function from($db){
	$this->_sql_command.=' FROM '.$db;
return $this;
	
	
}






public function where($array){
if(is_array($array) && !empty($array) && sizeof($array)===3){
	if(!is_numeric($array[2])){$this->_sql_command.=" WHERE ".$array[0]." ".$array[1]." "."'$array[2]'";}
	else{
		$this->_sql_command.=" WHERE ".$array[0]." ".$array[1]." "." ".$array[2];
	}
}else{
	die("Ooops,watch the documentation.");
}
return $this;

}

public function get(){
	return $this->getInstance()->query($this->_sql_command);
	//echo $this->_sql_command;
}
public function orderBY(){
	$result= " ORDER BY ";
	$allowed=['asc','desc'];
	if(is_array(func_get_arg(0))){
		$array=func_get_arg(0);
		if(sizeof($array)===1){
			foreach ($array as $key => $value) {
			if(!in_array($value, $allowed)){
				die('Not the propriate arg');
			}else{
				$result.=$key.' '.strtoupper($value).' ';
			}
		}
		}else{
			foreach ($array as $key => $value) {
			if(!in_array($value, $allowed)){
				die('Not the propriate arg');
			}else{
				$result.=$key.' '.strtoupper($value).', ';
			}
		}
		$result=substr($result,0,-1);
		}

		
		
		
	}else if (is_string(func_get_arg(0))) {
		$result.=func_get_arg(0).' DESC ';
	}else{
		die("Oops wathch the documentation");
	}
$this->_sql_command.=$result;
return $this;
}

public function groupBy($field){
	$this->_sql_command.=" GROUP BY ".$field;
	return $this;
}


public function update($db,$params){
	$this->_sql_command="UPDATE ".$db;
	if(is_array($params)){
		$this->_sql_command.= " SET ";
		if(sizeof($params)>1){
		foreach ($params as $key => $value) {
			if(is_numeric($value)){
				$this->_sql_command.=" ".$key." = ".$value." ,";
			}else{
$this->_sql_command.=" ".$key." = "."'$value'"." ,";
			}
			
		}
		$this->_sql_command=substr($this->_sql_command,0,-1);
	}else{
foreach ($params as $key => $value) {
		if(is_numeric($value)){
				$this->_sql_command.=" ".$key." = ".$value." ";
			}else{
$this->_sql_command.=" ".$key." = "."'$value'"." ";
			}
		}
	}
	}else{
	die("Ooops,watch the documentation.");
}
return $this;
}




public function getAsArray($option=MYSQLI_ASSOC){
	$res=$this->getInstance()->query($this->_sql_command);
	while ($data = $res->fetch_array($option))
        {

           $array[] = $data;

        }
        return $array;
}





public function getAsObject(){
return $this->getInstance()->query($this->_sql_command)->fetch_object();	     
}


public function query($command){
	return $this->getInstance()->query($command);
}


public function getAsJson(){
	return json_encode($this->getInstance()->query($this->_sql_command)->fetch_object());
}

	}







?>
