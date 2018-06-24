<?php
session_start();
class SearchController{
	public function index(){
		if(!empty($_GET) && isset($_GET['q'])){
			list($query)=array_values(validate($_GET));

			$search=$this->search($query);
			if($search){

			$array[]=$search->fetch_assoc();
			$_SESSION['movie']=$array;
		}else{
			$_SESSION['search_error']="<div class='alert alert-danger' role='alert'>
   <strong>No results!</strong>
</div>";
		}
			return view('movie');

		}

	}

	private function search($query){
		$sql="SELECT * FROM `movies` WHERE `Title` LIKE '%$query%' OR `Stars` LIKE '%$query%'  LIMIT 1";
		$result=KomarOrm::connect('127.0.0.1','mysql','mysql','MovieSaver')->query($sql);
		return $result->num_rows>0 ? $result : false;
}


	
}