<!doctype html>
<head>
    <meta charset="utf-8">
    <base href="/PHP_project_Modul151_MVC/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/personalStyles.css">
    <script
    src="http://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>

  <title>Modul 151</title>
</head>
<body onload="return ran_col()">
    <nav class="site-header sticky-top py-1 bg-dark">
      <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a href="/PHP_project_Modul151_MVC/" class="navbar-brand text-light">My Blog</a>

        <div class="col-11 d-flex justify-content-end align-items-center">
          <div class="justify-content-between">
            <?php if(!isset($_SESSION['is_logged_in'])){
              ?>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#loginModal">
              Sign In
            </button>
             <?php
            }
            ?>
            <?php 
            $actualURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if(isset($_SESSION['is_logged_in']) && $actualURL == "http://localhost/PHP_project_Modul151_MVC/"){
              ?>
              <div class="nav">
                <a href="blog/create">Write Blog &nbsp</a>
                <p class="text-light"><?php echo("{$_SESSION['username']}");?></p>
                <form method="POST" action="login/logout">
                  <button class="btn btn-sm btn-outline-secondary" name="logoutForm">Logout</button>
                </form>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
    </nav>

<main role="main" class="container">

    <div class="starter-template">

        <?php
        echo $content_for_layout;
        ?>

    </div>

</main>

<footer class="blog-footer">
  <p>
    <a href="#">Back</a>
  </p>
  <p>&copy; Modul 151 INFW2017.2a Florence Meier</p>
</footer>

<script type="text/javascript">
  <?php
    require(ROOT . 'public/randomColor.js');
  ?>
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>

</body>

<!-- LOGIN and REGISTER is MODAL: needs to be outside of BODY-TAG to work -->
<?php 
 require(ROOT . 'views/Login/signIn.php');
?>

</html>