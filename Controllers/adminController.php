<?php
class adminController extends defaultController
{
    function index()
    {
    	if(isset($_SESSION['is_logged_in'])){
            require(ROOT . 'Models/User.php');
            $user = new User();
            $dbUser['users'] = $user->getAllUsers();
            $this->set($dbUser);
            $this->render("index");
        }
        else
        {
            require(ROOT . 'Models/Blog.php');
            $blogs = new Blog();
            $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
            $this->set($dbBlogs);
            $this->render("publicArea");
        }
    }

    function delete($id){
        if(isset($_SESSION['is_logged_in'])){
            require(ROOT . 'Models/User.php');
            $user = new User();
            $user->deleteUser($id);
            header("Location: /PHP_project_Modul151_MVC/");
        }
        else
        {
            require(ROOT . 'Models/Blog.php');
            $blogs = new Blog();
            $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
            $this->set($dbBlogs);
            $this->render("publicArea");
        }
    }
}
?>