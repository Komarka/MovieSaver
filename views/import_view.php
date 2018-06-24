<?php
require_once "layout/main.php";
?>

<div class="container">
<form method="POST" action="import/upload" enctype="multipart/form-data">
   File: <input type="FILE" name="file"/>
</br>
  <button type="submit" class="btn btn-primary mb-2">Send</button>
</form>
</div>

