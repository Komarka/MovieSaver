<?php
require_once "layout/main.php";
if($_SESSION['search_error']){
	echo "<div class='container'>";
	echo $_SESSION['search_error'];
	echo "</div>";
}elseif (empty($_SESSION['search_error'])) {
 echo '<div class="jumbotron">';
foreach ($_SESSION['movie'] as  $info) {
 echo "<h1>" .$info['Title']."</h1>";
 echo "<p><strong>Year:</strong>".$info['Release Year']."</p>";
 echo "<p><strong>Format:</strong>".$info['Format']."</p>";
 echo "<p><strong>Stars:</strong>".$info['Stars']."</p>";
}
echo '</div>';
}
session_destroy();




 