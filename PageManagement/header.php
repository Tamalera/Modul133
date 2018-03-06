
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
                <p class="text-light">Welcome! &nbsp</p>
                <a class="btn btn-sm btn-outline-secondary" href="./Login/logout.php">Logout</a>
              </div>
              <?php
            }
            ?> 
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