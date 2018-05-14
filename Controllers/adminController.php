<?php
class adminController extends defaultController
{
    function index()
    {
    	if(isset($_SESSION['is_logged_in'])){
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
}
?>