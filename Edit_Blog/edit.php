<?php   
require('../config.php');

//error_reporting(E_ERROR || E_PARSE);
session_start();
  if(!isset($_SESSION['is_logged_in'])){
    header("Location: http://infw2017-2a-151-web15.iet-gibb.net/");
  } 
  else 
  {
    if ($_POST['action'] && $_POST['id']) {
      if ($_POST['action'] == 'Edit') {
        //Get the blog with send id and logged in user: first user id of user
        $getUserByIdSQL = 'SELECT userID FROM benutzer WHERE  username = ?';
        $statementGetUserById = $PDOconnection->prepare($getUserByIdSQL);
        $statementGetUserById->execute([$_SESSION['username']]);
        $ID = $statementGetUserById->fetch();

        $userIDForDB = $ID->userID;

        $getBlogToEditSQL = 'SELECT * FROM blog WHERE blogID = :bid AND user_id = :uid';
        $statementGetBlogToEdit = $PDOconnection->prepare($getBlogToEditSQL);
        $statementGetBlogToEdit->execute(['bid' => $_POST['id'], 'uid' => $userIDForDB]);
        $blogToEdit = $statementGetBlogToEdit->fetch();

        $blogID = $blogToEdit->blogID;
        $blogTitle = $blogToEdit->title;
        $blogBody = $blogToEdit->blogText;
      }
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <nav class="site-header sticky-top py-1 bg-dark">
      <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="navbar-brand text-inverse" href="../index.php">My Blog</a>

        <div class="col-11 d-flex justify-content-end align-items-center">
          <div class="justify-content-between">
            <?php if(isset($_SESSION['is_logged_in'])){
              ?>
              <div class="nav">
                <p class="text-light"><?php echo("{$_SESSION['username']}");?></p>
                <a class="btn btn-sm btn-outline-secondary" href="../Login/logout.php">Logout</a>
              </div>
              <?php
            }
            ?> 
          </div>
        </div>
      </div>
    </nav>

    <br>

    <?php if(isset($_SESSION['is_logged_in'])){
    ?>
    <div class="col-md-8 offset-2">
      <form action="../index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="blogID" value="<?php echo $blogID; ?>""/>
          <div class="form-group">
            <label for="blog_titel">Titel</label>
            <input name="blogTitle" type="text" class="form-control" id="blog_titel" value="<?php echo "{$blogTitle}";?>" required>
          </div>
          <div class="form-group">
            <label for="blog_textarea">Blog Content</label>
            <textarea name="blogContent" type="text" class="form-control" id="blog_textarea" required><?php echo("{$blogBody}");?></textarea>
          </div>
          <input class="m-2" type="file" name="picUpload" id="picUpload"> <br>
          <button name="editBlog" type="submit" class="btn btn-primary">Submit Blog</button>
      </form> <br>
    
        <div>
          HERE ARE PICTURES DISPLAYED
          <button>DELETE PICTURE</button>
        </div>
    </div>
      <?php
      }
      ?> 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<?php
  include "../PageManagement/footer.php";
?>