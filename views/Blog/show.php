<?php

echo '<div class="card">
		<div class="d-flex offset-1 row wrap">';

foreach ($blog as $image) {
	if ($image['pictureSmall']) {
	$pic = "images/".basename($image['pictureSmall']);
	echo '<a href="/PHP_project_Modul151_MVC/picture/edit/'.$image['pictureID'].'"><img class="card-img-top imgSmall m-2" src="'.$pic.'" alt="pic"></a>';
	echo '<p>'.$image['pictureText'].'</p>';
	}
}

echo '</div>
	<div class="card-body">
			<h5 class="card-title">'.$image['title'].'</h5>
			<p class="card-text">'.$image['blogText'].'</p>
			<a href="/PHP_project_Modul151_MVC/" class="btn btn-primary">back</a>
		</div>
	</div>';

?>