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
    function edit($id)
    {
        // require(ROOT . 'Models/Task.php');
        // $task= new Task();
        // $d["task"] = $task->showTask($id);
        // if (isset($_POST["title"]))
        // {
        //     if ($task->edit($id, $_POST["title"], $_POST["description"]))
        //     {
        //         header("Location: " . WEBROOT . "tasks/index");
        //     }
        // }
        // $this->set($d);
        // $this->render("edit");
    }
    function delete($id)
    {
        // require(ROOT . 'Models/Task.php');
        // $task = new Task();
        // if ($task->delete($id))
        // {
        //     header("Location: " . WEBROOT . "tasks/index");
        // }
    }
}
?>