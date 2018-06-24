<?php
 function view($file){
 	$path="./views/".$file.'_view.php';
 	if(is_file($path)){
 		require_once $path;
 	}else{
 		die('There is no such view in views');
 	}

 }


 function back(){
 	header('Location: ' . $_SERVER['HTTP_REFERER']);
 }

 function validate($request){
 	if (!empty($request)){
 		$result_array=[];
 		foreach ($request as $key => $value) {
 		$result_array[$key]=trim(stripslashes(htmlspecialchars($value)));
 		}
 		return $result_array;
 	}
 }