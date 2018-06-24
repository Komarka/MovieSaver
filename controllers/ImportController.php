<?php
session_start();
class ImportController{
	public function index(){
		return view('import');
}
    public function upload($request){
    	// make one big query to database instead of many small queries.

    	$sql="INSERT INTO movies (`Title`, `Release Year`, `Format`, Stars) VALUES " ;
    	if(!empty($_FILES) && $this->checkFile($_FILES)){
      $fp = fopen($_FILES['file']['tmp_name'], 'r');
     
    while ( ($line = fgets($fp)) !== false) {
    	$line=explode(':', $line);
    	if($line[0]==='Title'){
    		$sql.=" (";
    	}     
     $sql.="'".trim($line[1])."', ";
     if($line[0]==="Stars"){
     	$sql.="'";
     }

     if(empty($line[1])){
     	$sql=substr($sql,0,-7);
	  $sql.="),";
}


    }
    $sql=substr($sql, 0, -1);
    $sql=substr_replace($sql, "')", -2);
   KomarOrm::connect('127.0.0.1','mysql','mysql','MovieSaver')->query($sql);
  
   $message_import= '<div class="alert alert-success" role="alert">
  <strong>Well done!</strong> You have successfully downloaded your movies.
</div>';

    	}else{
    		$message_import= '<div class="alert alert-danger" role="alert">
   Oops!Something went wrong!
</div>';
    	}
    	$_SESSION['message_import']=$message_import;
    	return view('success_import');
    }


    private function checkFile($file){
     if ($_FILES["file"]["error"] > 0 || $_FILES["file"]["type"] !== "text/plain" || $_FILES['file']['size'] > 5*1048576 ){
     	return false;
     }else{
       return true;
     }

   }

 }

?>