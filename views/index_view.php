<?php
require_once "layout/main.php";

if( $_SESSION['error']){
	echo $_SESSION['error'];
}
// form for adding the movie
echo '<form method="POST" action="/movie/add" id="adding_form" hidden="true">
  <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" name="title" required="true" aria-describedby="emailHelp" placeholder="Enter the title of the movie">
  </div>
   <div class="form-group">
    <label for="year">Release Year:</label>
    <input type="number" min="1900" max="2018" class="form-control" id="year" name="year"  required="true" placeholder="Enter the release year of the movie">
  </div>
  <div class="form-group">
    <label for="format">Format:</label>
    <input type="text" class="form-control" id="format" name="format" required="true"  placeholder="Enter the format of the movie">
  </div>
  <div class="form-group">
    <label for="stars">Stars:</label>
    <input type="text" class="form-control" id="stars" name="stars" required="true"  placeholder="Enter the stars of the movie">
  </div>
   <button type="submit" class="btn btn-success">Submit</button>
  </form>';
	echo "<button type='button' onclick='showForm(this)' hidden='false' class='btn btn-primary'>Add movie</button>";
	echo "<p></p>";

// showing all movies
if( !$_SESSION['movies']){
	echo "<div class='alert alert-danger' role='alert'>
   <strong>There are no any movies!</strong>
</div>";
}else{
	

	// table of gettting all the movies
	echo '<table class="table-striped table-bordered table-responsive table">';
echo
'<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Release Year</th>
    <th>Format</th>
    <th>Stars</th>
    <th>Delete</th>
</tr>';

	foreach ($_SESSION['movies'] as $m) {
		$id=$m['id'];
		echo '<tr>';
		echo '<td>'.$m['id'].'</td>';
		echo '<td><a href=/movie/get?id='.$id.'>'.$m['Title'].'</a></td>';
		echo '<td>'.$m['Release Year'].'</td>';
		echo '<td>'.$m['Format'].'</td>';
		echo '<td>'.$m['Stars'].'</td>';
		echo "<td><form action='/movie/delete' method='GET'>
		<input hidden type='text'  name='id' value={$m['id']} />
		<button type='submit' class='btn btn-danger'>Delete</button>
		</form></td>";
echo '</tr>';
	}
	
echo '</table>';
}
?>
<script type="text/javascript">

	//clear all form inputs every time the page is loaded
window.onload=function(){
	adding_form.querySelectorAll('input').forEach((input)=>{
		input.value='';
	})
}

	function showForm(el){
	el.previousSibling.hidden=false;
	el.parentNode.removeChild(el);
	}
</script>