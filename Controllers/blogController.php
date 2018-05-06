<?php
class blogController extends defaultController
{
    function index()
    {
        if(isset($_SESSION['is_logged_in'])){
            require(ROOT . 'Models/Blog.php');
            $blogs = new Blog();
            $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
            $this->set($dbBlogs);
            $this->render("index");
        }
        else
        {
            require(ROOT . 'Models/Blog.php');
            $blogs = new Blog();
            $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
            $this->set($dbBlogs);
            $this->render("../publicArea");
        }
    }
    function create()
    {
        if(isset($_SESSION['is_logged_in'])){
            if (isset($_POST["blogTitle"]) && isset($_POST["blogContent"]))
            {
                require(ROOT . 'Models/Blog.php');
                $blog= new Blog();
                $blog->create($_POST["blogTitle"], $_POST["blogContent"]);

                header("Location: /PHP_project_Modul151_MVC/");
            }
            else
            {
                $this->render("create");
            }
        }
        else
        {
            require(ROOT . 'Models/Blog.php');
            $blogs = new Blog();
            $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
            $this->set($dbBlogs);
            $this->render("../publicArea");
        }

    }
    function edit($id)
    {
        if(isset($_SESSION['is_logged_in'])){
            if (isset($_POST["blogTitle"]) && isset($_POST["blogContent"]))
            {
                require(ROOT . 'Models/Blog.php');
                $blogs = new Blog();
                $blogs->edit($id, $_POST["blogTitle"], $_POST["blogContent"]);
                header("Location: /PHP_project_Modul151_MVC/");
            }
            else
            {
                require(ROOT . 'Models/Blog.php');
                $blogs = new Blog();
                $dbBlogs['blog'] = $blogs->showBlog($id);
                $this->set($dbBlogs);
                $this->render("edit");
            }
        }
        else
        {
            require(ROOT . 'Models/Blog.php');
            $blogs = new Blog();
            $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
            $this->set($dbBlogs);
            $this->render("../publicArea");
        }
    }
    function delete($id)
    {
        if(isset($_SESSION['is_logged_in'])){
            require(ROOT . 'Models/Blog.php');
            $deleteBlog = new Blog();
            $deleteBlog->delete($id);
            header("Location: /PHP_project_Modul151_MVC/");
        }
        else
        {
            require(ROOT . 'Models/Blog.php');
            $blogs = new Blog();
            $dbBlogs['blogs'] = $blogs->showAllBlogsSorted();
            $this->set($dbBlogs);
            $this->render("../publicArea");
        }
    }
}
?>