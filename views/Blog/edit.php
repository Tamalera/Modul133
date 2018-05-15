<div class="col-md-8 offset-2">
  <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="blog_titel">Titel</label>
        <input name="blogTitle" type="text" class="form-control" id="blog_titel" value="<?php echo $blog["title"];?>" required>
      </div>
      <div class="form-group">
        <label for="blog_textarea">Blog Content</label>
        <textarea name="blogContent" type="text" class="form-control" id="blog_textarea" required><?php echo $blog["blogText"];?></textarea>
      </div>
      <input class="m-2" type="file" name="picUpload" id="picUpload"> <br>
      <label for="picText">Caption</label>
      <input name="picText" type="text" class="form-control" id="picText">
      <br>
      <button name="editBlog" type="submit" class="btn btn-primary">Submit Blog</button>
  </form> 
</div>