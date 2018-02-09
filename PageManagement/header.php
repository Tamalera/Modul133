<!DOCTYPE html>
<html>
  <head>
    <title>Modul 133</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
    	<div class="col-1 d-flex justify-content-start align-items-center">
        <a href="mainpage.html"><img src="logo.jpg"></a>
      </div>
    	<div class="col-11 d-flex justify-content-end align-items-center">
        <div class="justify-content-between">
      		<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
            Sign In
          </button>
       		<a class="btn btn-sm btn-outline-secondary" href="#">Sign Up</a>
        </div>
    	</div>
    </div>
    <hr>
  </header>

<?php 
include "Login/signIn.php"; 
?> 

<script type="text/javascript">
$('#exampleModal').modal() 
</script>