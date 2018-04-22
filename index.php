<?php   

//Start initial session
session_start();

//DB connection
require('config.php');
//error_reporting(E_ERROR || E_PARSE);

//*** REGISTRATION ***//
//Register user: first check if username already exists. If not, save user and encrypted password plus USER
if (isset($_POST['register'])){

  //Assign input variable for registration
  $email = $_POST['emailreg'];

  //Check for double user: only if username is NOT (!) found in DB, user can register
  $getUserSQL = 'SELECT username FROM benutzer WHERE username = ?';
  $statementGetUser = $PDOconnection->prepare($getUserSQL);
  $statementGetUser->execute([$email]);
  $user = $statementGetUser->fetch();
  $count = $statementGetUser->rowCount();

  if ($count == 0) {  
    $username = $_POST['emailreg'];
    $hashedPass = password_hash($_POST['passwordreg'], PASSWORD_DEFAULT);

    $getPasswordSQL = 'INSERT INTO benutzer(username, passwordHash) VALUES(:username, :passwordHash)';
    $statementPassword = $PDOconnection->prepare($getPasswordSQL);
    $statementPassword->execute(['username' => $username, 'passwordHash' => $hashedPass]);
    echo "ok";

    $_SESSION["is_logged_in"] = true;
    $_SESSION["username"] = $username;

    }
    else {
      //Feedback, that username already exists -> no login
      echo '<script language="javascript">';
        echo 'alert("User already exists")';
      echo '</script>';
    }
  
}

//*** SIGN IN ***//
//For sign in: check for correct username and passord. If all good, log in.
if (isset($_POST["email"]) && isset($_POST["password"])) {

  //Store input in variables
  $username = $_POST["email"];
  $password = $_POST['password'];

  //SQL-Injection should be prevented:
  $username = stripslashes($username);
  $password = stripslashes($password);

  //Check user (if exists)
  $checkUserSQL = 'SELECT username FROM benutzer WHERE  username = ?';
  $statementcheckUser = $PDOconnection->prepare($checkUserSQL);
  $statementcheckUser->execute([$username]);
  $count = $statementcheckUser->rowCount();

  //Check password for validity -> first get if from DB with same user as before
  $checkPassworHashSQL = 'SELECT passwordHash FROM benutzer WHERE  username = ?';
  $statementcheckPassworHash = $PDOconnection->prepare($checkPassworHashSQL);
  $statementcheckPassworHash->execute([$username]);
  $hash = $user = $statementcheckPassworHash->fetch(PDO::FETCH_ASSOC);

  if ($count == 1 && password_verify($password, $hash["passwordHash"])) {
    $_SESSION["is_logged_in"] = true;
    $_SESSION["username"] = $username;
    echo "Welcome"." ".$username;
  } else {
    echo "Access denied";
  }
}

//*** CREATE BLOG ***//
//Create blog: gets title and content from user; uses date and name.
if (isset($_POST["createBlog"])){

  //Get all data you need from user (date is added automatically)
  $blogTitle = $_POST["blogTitle"];
  $blogContent = $_POST["blogContent"];
  $blogAuthor = $_SESSION["username"];

  //SQL-Injection should be prevented:
  $blogTitle = stripslashes($blogTitle);
  $blogContent = stripslashes($blogContent);
  $blogAuthor = stripslashes($blogAuthor);

  //Get author ID
  $getUserByIdSQL = 'SELECT userID FROM benutzer WHERE  username = ?';
  $statementGetUserById = $PDOconnection->prepare($getUserByIdSQL);
  $statementGetUserById->execute([$blogAuthor]);
  $ID = $statementGetUserById->fetch();

  $userIDForDB = $ID->userID;

  //Add blog to DB
  $insertBlogSQL = 'INSERT INTO blog(title, blogText, user_id) VALUES (:blogTitle, :blogContent, :userIDForDB)';
  $statementInsertBlog = $PDOconnection->prepare($insertBlogSQL);
  $statementInsertBlog->execute(['blogTitle' => $blogTitle, 'blogContent' => $blogContent, 'userIDForDB' => $userIDForDB]);
  echo "Blog added";

}

//*** EDIT BLOG ***//
//Edit blog: gets title and content from user; uses date and name.
if (isset($_POST["editBlog"]) && isset($_POST["blogID"])){

  //Get all data you need from user (date is added automatically)
  $blogID = $_POST["blogID"];
  $blogTitle = $_POST["blogTitle"];
  $blogContent = $_POST["blogContent"];
  $blogAuthor = $_SESSION["username"];
  //$date = date('d/m/Y', time());

  //SQL-Injection should be prevented:
  $blogTitle = stripslashes($blogTitle);
  $blogContent = stripslashes($blogContent);
  $blogAuthor = stripslashes($blogAuthor);

  //Get author ID
  $getUserByIdSQL = 'SELECT userID FROM benutzer WHERE  username = ?';
  $statementGetUserById = $PDOconnection->prepare($getUserByIdSQL);
  $statementGetUserById->execute([$blogAuthor]);
  $ID = $statementGetUserById->fetch();

  $userIDForDB = $ID->userID;

  //Add blog to DB
  $updateBlogSQL = 'UPDATE blog SET title = :title, blogText = :content WHERE blogID = :bid AND user_id = :uid';
  $statementUpdateBlog = $PDOconnection->prepare($updateBlogSQL);
  $statementUpdateBlog->execute(['title' => $blogTitle, 'content' => $blogContent, 'bid' => $blogID, 'uid' => $userIDForDB]);
}

//*** DELETE BLOG ***//
if (isset($_POST["action"]) && isset($_POST["bid_del"])) {
  //Get user (the one logged in)
  $loggedUser = $_SESSION["username"];

  $getUserByIdSQL = 'SELECT userID FROM benutzer WHERE  username = ?';
  $statementGetUserById = $PDOconnection->prepare($getUserByIdSQL);
  $statementGetUserById->execute([$loggedUser]);
  $ID = $statementGetUserById->fetch();

  $userIDForDB = $ID->userID;

  //Delete blog
  $deleteBlogSQL = 'DELETE FROM blog WHERE blogID = :bid AND user_id = :uid';
  $statementDeleteBlog = $PDOconnection->prepare($deleteBlogSQL);
  $statementDeleteBlog->execute(['bid' => $_POST["bid_del"], 'uid' => $userIDForDB]);
}

//*** LIKES ***//
if (isset($_POST['like_button'])) {
  //Get user (the one logged in)
  $loggedUser = $_SESSION["username"];

  $getUserByIdSQL = 'SELECT userID FROM benutzer WHERE  username = ?';
  $statementGetUserById = $PDOconnection->prepare($getUserByIdSQL);
  $statementGetUserById->execute([$loggedUser]);
  $ID = $statementGetUserById->fetch();

  $userIDForDB = $ID->userID;

  //Check if blog was liked already by user
  $checkBlogLikeSQL = 'SELECT likesID FROM likes WHERE blog_ID = :bid AND user_id = :uid';
  $statementCheckBlogLike = $PDOconnection->prepare($checkBlogLikeSQL);
  $statementCheckBlogLike->execute(['bid' => $_POST["bid_likes"], 'uid' => $userIDForDB]);
  $count = $statementCheckBlogLike->rowCount();

  if ($count == 0) {

    //Set likes and update blog
    $updateBlogLikesSQL = 'UPDATE blog SET likes = (likes + 1) WHERE blogID = :bid';
    $statementUpdateBlogLikes = $PDOconnection->prepare($updateBlogLikesSQL);
    $statementUpdateBlogLikes->execute(['bid' => $_POST["bid_likes"]]);

    //Set new like-row in likes-table
    $updateLikesSQL = 'INSERT INTO likes(blog_ID, user_id) VALUES (:bid, :uid)';
    $statementUpdateLikes = $PDOconnection->prepare($updateLikesSQL);
    $statementUpdateLikes->execute(['bid' => $_POST["bid_likes"], 'uid' => $userIDForDB]);
  }
  else
  {
    echo "You have already liked this blog";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

  <title>Modul 133</title>

</head>

<body  onload="return ran_col()">

  <?php if(!isset($_SESSION['is_logged_in'])){
    include "PageManagement/header.php";
    include "Blog/publicArea.php";
  }
  ?> 

  <?php if(isset($_SESSION['is_logged_in'])){
    include "PageManagement/header.php";
    include "Blog/mainpage.php"; 
  }
  ?> 

  <?php
  include "PageManagement/footer.php";
  ?>

  <script type="text/javascript">
    function ran_col() { //function name
        var color = '#'; // hexadecimal starting symbol
        //var letters = ['000000','FF0000','00FF00','0000FF','FFFF00','00FFFF','FF00FF','C0C0C0']; //Set your colors here
        var randomColor = Math.floor(Math.random()*16777215).toString(16);
        color += randomColor;
        var allTitles = document.getElementsByClassName('randomBackground')
        var counter;
        for (counter = 0; counter < allTitles.length; counter++) {
            allTitles[counter].style.backgroundColor = color;
        }
    }
</script>

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  </body>
</html>