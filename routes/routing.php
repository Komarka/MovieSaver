<?php
require_once 'core\Router.class.php';
Router::get('/');
Router::get('/import',"ImportController");
Router::post('/import/upload',"ImportController");
Router::get('/movie/delete',"MovieController");
Router::get('/movie/get',"MovieController");
Router::post('/movie/add',"MovieController");
Router::get('/search','SearchController');

if(!in_array($GLOBALS['path'],Router::getRoutes())){
	die("There is no such url");
}
?>