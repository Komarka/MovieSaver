<?php
session_start();
class MovieController{
	public function delete(){
	if(!empty($_GET['id'])) {
	KomarOrm::connect('127.0.0.1','mysql','mysql','MovieSaver')->delete()->from('movies')->where(['id','=',$_GET['id'].''])->get();
	back();
	}else{
		$_SESSION['error']='<div class="alert alert-danger" role="alert">
   Oops!Something went wrong!;
</div>';
	}
}

 public function get(){
if(!empty($_GET['id'])) {
	$_SESSION['movie']=KomarOrm::connect('127.0.0.1','mysql','mysql','MovieSaver')->select()->from('movies')->where(['id','=',$_GET['id'].''])->getAsArray();
	return view('movie');

	}else{
		$_SESSION['error']='<div class="alert alert-danger" role="alert">
   Oops!Something went wrong!;
</div>';
back();
	}
 }

 public function add($request){
 	list($title,$year,$format,$stars)=array_values(validate($request));
 	$year=(string)$year;
 	$sql="INSERT INTO movies (`Title`, `Release Year`, `Format`, `Stars`)
VALUES ('$title', '$year', '$format','$stars')";
KomarOrm::connect('127.0.0.1','mysql','mysql','MovieSaver')->query($sql);
back();

 }

}