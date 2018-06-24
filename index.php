<?php
$http="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$path = parse_url($http)['path'];
 require_once 'core\orm.php';
 require_once 'routes\routing.php';

