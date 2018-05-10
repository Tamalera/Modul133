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
                $blog = new Blog();
                $blog->create($_POST["blogTitle"], $_POST["blogContent"]);

                //Upload picture if one exists
                if (isset($_POST["pic_text"])){
                    //Picture upload:
                    require(ROOT . 'Models/Picture.php');
                    $picture = new Picture();
                    $picture->addPicture($_POST["pic_text"]);
                }

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
                $dbBlogs['blog'] = $blogs->editBlog($id);
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
            
            //Also delete entry of all likes of this blog in Likes-Table
            if($_POST['likesID'] > 0){
                require(ROOT . 'Models/Like.php');
                $deleteLikesOfBlog = new Like();
                $deleteLikesOfBlog->deleteLike($id);
            }

            //Also delete picture all pictures of this blog
            if($_POST['pictureID'] > 0){
                require(ROOT . 'Models/Picture.php');
                $deletePicture = new Picture();
                $deletePicture->deletePictureOfBlog($id);
            }

            //Delete actual blog
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


    function show($id)
    {
        if(isset($_SESSION['is_logged_in'])){
            require(ROOT . 'Models/Blog.php');
            $blogs = new Blog();
            $dbBlogs['blog'] = $blogs->showBlog($id);
            $this->set($dbBlogs);
            $this->render("show");
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