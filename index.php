<?php   
session_start();  

$username_guest = 'guest@test.ch';

$username_admin = 'admin@test.ch';
$password = 'Admin_123';



if (isset($_POST["email"]) && isset($_POST["password"])) { 

  if ($_POST["email"] === $username_admin && $_POST["password"] === $password) { 
    $_SESSION["is_logged_in"] = true;
  } 
  else 
  {
    ?>  
    <div align="center">  
     <p id="danger_msg">Access denied; wrong credentials</p>
   </div>  
   <?php
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