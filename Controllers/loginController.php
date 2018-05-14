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
		  require_once(ROOT . 'Models/User.php');
		  $user = new User();
          $count = $user->userExist($username);

		  //Check password for validity -> first get if from DB with same user as before
		  $dbPasswordHash['passwordHash'] = $user->getPassword($username);

		  if ($count == 1 && password_verify($password, $dbPasswordHash["passwordHash"])) {
		    $_SESSION["is_logged_in"] = true;
		    $_SESSION["username"] = $username;

		    require_once(ROOT . 'Models/User.php');
		    $user = new User();
		    $userRole = $user->getUserRole($username);
		    if ($userRole == 1) {
		    	$_SESSION["admin"] = true;
		    }

		    require(ROOT . 'Models/Blog.php');
	        $blogs = new Blog();
	        $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
	        $this->set($dbBlogs);

		    header("Location: /PHP_project_Modul151_MVC/");

		  } else {
		    $this->render("../error");
		  }
		}
    }

    function register()
    {
    	//*** REGISTRATION ***//
		//Register user: first check if username already exists. If not, save user and encrypted password plus USER
		if (isset($_POST['register'])){

		  //Assign input variable for registration
		  $email = $_POST['emailreg'];

		  //Check for double user: only if username is NOT (!) found in DB, user can register
		  require_once(ROOT . 'Models/User.php');
		  $user = new User();
          $count = $user->userExist($email);

		  if ($count == 0) { 
		   
		    $username = $email;
		    $hashedPass = password_hash($_POST['passwordreg'], PASSWORD_DEFAULT);

		    $user->addUser($username, $hashedPass);

		    $_SESSION["is_logged_in"] = true;
		    $_SESSION["username"] = $username;

		    }		  
		}
		header("Location: /PHP_project_Modul151_MVC/");

    }

    function logout()
    {
    	//Button is clicked
    	if (isset($_POST["logoutForm"]))
    	{
    	header("Location: /PHP_project_Modul151_MVC/");
    	// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy();

		// go to main page
		header("Location: /PHP_project_Modul151_MVC/");
    	}
    }
}
?>