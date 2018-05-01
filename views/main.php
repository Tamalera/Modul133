<!doctype html>
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

  <title>Modul 151</title>
</head>

<body onload="return ran_col()">
    <nav class="site-header sticky-top py-1 bg-dark">
      <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="navbar-brand text-light">My Blog</a>

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
            <?php if(isset($_SESSION['is_logged_in'])){
              ?>
              <div class="nav">
                <a href="Create_Blog/create.php">Write Blog &nbsp</a>
                <p class="text-light"><?php echo("{$_SESSION['username']}");?></p>
                <a class="btn btn-sm btn-outline-secondary" href="./Login/logout.php">Logout</a>
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
    <a href="#">Back to top</a>
  </p>
  <p>&copy; Modul 133 INFW2017.2a Florence Meier</p>
</footer>

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