<form action="" class="col-md-8 offset-2" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="blog_titel">Titel</label>
      <input name="blogTitle" type="text" class="form-control" id="blog_titel" required>
    </div>
    <div class="form-group">
      <label for="blog_textarea">Blog Content</label>
      <textarea name="blogContent" type="text" class="form-control" id="blog_textarea" required></textarea>
    </div>
    <input class="m-2" type="file" name="picUpload" id="picUpload"> <br>
    <label for="pic_text">Caption</label>
    <input name="pic_text" type="text" class="form-control" id="pic_text">
    <br>
    <button name="createBlog" type="submit" class="btn btn-primary">Submit Blog</button>
</form>