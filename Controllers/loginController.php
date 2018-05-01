<?php
class LoginController extends defaultController
{
    function login()
    {
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
		  require(ROOT . 'Models/User.php');
		  $user = new User();
          $dbUser['count'] = $user->userExist($username);

       	  $count = $dbUser['count'];

		  //Check password for validity -> first get if from DB with same user as before
		  $dbPasswordHash['passwordHash'] = $user->getPassword($username);

		  if ($count == 1 && password_verify($password, $dbPasswordHash["passwordHash"])) {
		    $_SESSION["is_logged_in"] = true;
		    $_SESSION["username"] = $username;

		    require(ROOT . 'Models/Blog.php');
	        $blogs = new Blog();
	        $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
	        $this->set($dbBlogs);

		    $this->render("../Blog/index");

		  } else {
		    $this->render("../error");
		  }
		}
    }

    function register()
    {

    }

    function logout()
    {
    	//Button is clicked
    	if (isset($_POST["logoutForm"]))
    	{
    	// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy();

		// go to main page
		 $this->render("logout");
    	}
    }
}
?>