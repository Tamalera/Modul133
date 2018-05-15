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
	      	<?php echo '<img class="card-img-top imgSmall m-2" id="imageSmall" src="'."images/".basename($image['pictureSmall']).'" alt="pic" onclick="openModal()">'; ?>
	      </td>
	      <td><?php echo '
	      	<form action="picture/save/'.$image['pictureID'].'" method="POST">
	      		<input name="picText" type="text" class="form-control" id="picText" value="'.$image['pictureText'].'"/>
	      		<input type="submit" class="btn btn-info btn-sm mt-1" name="action" value="Save"/>
	      	</form>
	      	'?>
	      </td>
	      <td>
          <?php echo '
	      	<form method="POST" action="picture/delete/'.$image['pictureID'].'">
              <input type="submit" class="btn btn-danger btn-sm mt-1" name="action" value="X"/>
            </form>
          '?>
	      </td>
	    </tr>
	  </tbody>
  </form>
</table>

<!-- The Modal/Lightbox -->
<div id="myModal" class="modalImage">
  <div class="modal-contentImage">
  	<?php echo '<img onclick="closeModal()" class="card-img-top m-2" src="'."images/".basename($image['pictureBig']).'" alt="pic"'; ?>
  </div>
</div>

<script>
// Open the Modal
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById('myModal').style.display = "none";
}
</script>

<style type="text/css">
.modalImage {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-contentImage {
  position: relative;
  margin: 10px;
  padding: 0;
  width: 100%;
  max-width: 1200px;
}
</style>