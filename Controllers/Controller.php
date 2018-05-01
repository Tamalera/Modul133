<?php
class Controller extends defaultController
{
    function index()
    {
    	require(ROOT . 'Models/Blog.php');
        $blogs = new Blog();
        $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
        $this->set($dbBlogs);
        $this->render("publicArea");
    }
}
?>