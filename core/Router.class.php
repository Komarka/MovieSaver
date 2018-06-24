<?php
 require_once 'helpers.php';
class Router{
	private static  $routes=[];
	public static function get($route="/",$controller='IndexController'){
		array_push(self::$routes, $route);
		if($route===$GLOBALS['path'] && $_SERVER['REQUEST_METHOD']==='GET'){
			require_once "controllers/".$controller.".php";
			$parts=explode('/', $route);
			if(sizeof($parts)>2){
				$method=$parts[2];
         $class=new $controller();
         $class->$method();
			}else{
				$class=new $controller();
				$class->index();
			}
			
			

		}
		
	}
	public static function post($route="/",$controller){
		if(is_null($controller)){
			echo "Controller is null";
		}else{
		array_push(self::$routes, $route);
		if($route===$GLOBALS['path'] && $_SERVER['REQUEST_METHOD']==='POST'){
			require_once  "controllers/".$controller.".php";
			$parts=explode('/', $route);
			if(sizeof($parts)>2){
				$method=$parts[2];
         $class=new $controller();
         $class->$method($_POST);
			}

		}	
		}
		
		
	}

	static function getRoutes(){
		return self::$routes;
	}
}


?>
