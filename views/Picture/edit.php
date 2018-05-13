<table class="table table-dark mt-4">
	
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Caption</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
	  <tbody>
	    <tr>
	      <td>
	      	<form action="picture/addPic/'.$image['pictureID'].'" method="POST" enctype="multipart/form-data">
	      	<?php echo '<img class="card-img-top imgSmall m-2" src="'."images/".basename($image['pictureSmall']).'" alt="pic">'; ?> <br>
			    <input class="m-2" type="file" name="picUpload" id="picUpload"> <br>
			    <button name="addPicture" type="submit" class="btn btn-primary">Add</button>
			</form>
	      </td>
	      <td><?php echo '
	      	<form action="picture/save/'.$image['pictureID'].'" method="POST">
	      		<input name="picText" type="text" class="form-control" id="picText" value="'.$image['pictureText'].'"/>
	      		<input type="submit" class="btn btn-info btn-sm mt-1" name="action" value="Save"/>
	      	</form>
	      	'?>
	      </td>
	      <td>
	      	<form method="POST" action="picture/deletePicture/'.$image['pictureID'].'">
              <input type="submit" class="btn btn-danger btn-sm mt-1" name="action" value="X"/>
            </form>
	      </td>
	    </tr>
	  </tbody>
  </form>
</table>