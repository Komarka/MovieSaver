<?php
session_start();
class IndexController{
	public function index(){
		session_destroy();
		$movies=$this->getMovies();
		$_SESSION['movies']=$movies;
		return view('index');

	}

	private function getMovies(){
		$movies=KomarOrm::connect('127.0.0.1','mysql','mysql','MovieSaver')->select()->from('movies')->orderBy(['Title'=>'asc'])->getAsArray();
return  is_null($movies) ? false : $movies;
	}

	public function delete(){
		echo "delete";
	}
}
?>
