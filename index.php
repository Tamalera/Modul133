<?php   

//Start initial session
session_start();  
require('config.php');
//error_reporting(E_ERROR || E_PARSE);

//Register user: first check if username already exists. If not, save user and encrypted password plus USER
if (isset($_POST['register'])){

  $email = $_POST['emailreg'];
  //Check for double User
  $queryUser = "SELECT `username` FROM `benutzer` WHERE  username='$email'";
  $resultUsers = mysqli_query($connection, $queryUser) or die(mysqli_error($connection));
  $count = mysqli_num_rows($resultUsers);

  if ($count == 0) {  
    $username = $_POST['emailreg'];
    $hashedPass = password_hash($_POST['passwordreg'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO `benutzer`(`username`, `passwordHash`) VALUES ('$username','$hashedPass')";
    $result = mysqli_query($connection, $sql);
    if ($result) {
      echo "ok";
    } else {
      echo "fail";
    }

    $_SESSION["is_logged_in"] = true;
    $_SESSION["username"] = $username;

    }
    else {
      echo '<script language="javascript">';
        echo 'alert("User already exists")';
      echo '</script>';
    }
  
}

//For sign in: check for correct username and passord. If all good, log in.
if (isset($_POST["email"]) && isset($_POST["password"])) {

  // Store input in variables
  $username = $_POST["email"];
  $password = $_POST['password'];

  //SQL-Injection should be prevented:
  $username = stripslashes($username);
  $password = stripslashes($password);

  // Check user (if exists)
  $query = "SELECT `username` FROM `benutzer` WHERE  username='$username'";
  $resultUser = mysqli_query($connection, $query) or die(mysqli_error($connection));
  $count = mysqli_num_rows($resultUser);

  // Check password for validity -> first get if from DB with same user as before
  $passwordFromDB = "SELECT `passwordHash` FROM `benutzer` WHERE  username='$username'";
  $resultPassword = mysqli_query($connection, $passwordFromDB) or die(mysqli_error($connection));
  $hash = mysqli_fetch_assoc($resultPassword);
  if ($count == 1 && password_verify($password, $hash["passwordHash"])) {
    $_SESSION["is_logged_in"] = true;
    $_SESSION["username"] = $username;
    echo "Welcome"." ".$username;
  } else {
    echo "Access denied";
  }
}

//Function which checkes, if user already exists. Gives back boolean value.
function checkDoubleUser($name) {

}

//Create blog: gets title and content from user; uses date and name.
if (isset($_POST['createBlog'])){
  $myFile = "blogData.txt";
  $fh = fopen($myFile, 'a') or die("can't open file");
  if (FALSE === $fh) {
      echo 'Can not open file...';
  }

  $blogAuthor = "\n".$_SESSION["username"] . ":";
  fwrite($fh, $blogAuthor);
  $blogTitle = $_POST['blogTitle'] . ":";
  fwrite($fh, $blogTitle);
  $date = date('d/m/Y', time()) . ":";
  fwrite($fh, $date);
  $blogText = $_POST['blogContent'];
  fwrite($fh, $blogText);
  fclose($fh);  
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

<body>

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

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  </body>
</html>