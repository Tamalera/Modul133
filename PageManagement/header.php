<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    
    <title>Modul 133</title>
  </head>

  <body>
<nav class="site-header sticky-top py-1 bg-dark">
  <div class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="navbar-brand text-inverse" href="#">My Blog</a>

    <div class="col-11 d-flex justify-content-end align-items-center">
      <div class="justify-content-between">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#loginModal">
          Sign In
        </button>
        <a class="btn btn-sm btn-outline-secondary" href="#">Sign Up</a>
      </div>
    </div>
  </div>
</nav>



<?php 
include "Login/signIn.php"; 
?> 

<script type="text/javascript">
  ('#loginModal').modal() 
</script>