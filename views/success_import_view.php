<?php
require_once "layout/main.php";
echo "<div class='container'>";
if(isset($_SESSION['message_import'])){
	echo $_SESSION['message_import'];
}
echo "</div>";
?>