<?php
session_start();
?>

<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();

// go to main page
header("Location: ../index.php");
?>
