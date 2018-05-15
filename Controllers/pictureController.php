<?php
class pictureController extends defaultController
{
    function edit($id)
    {
        if(isset($_SESSION['is_logged_in'])){

            require(ROOT . 'Models/Picture.php');
            $picture = new Picture();
            $dbPics['image'] = $picture->getOneBlogPicture($id);
            $this->set($dbPics);
            $this->render("edit");

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

    function save($id)
    {
        if(isset($_SESSION['is_logged_in'])){
            
            if (isset($_POST["picText"]))
            {
                require(ROOT . 'Models/Picture.php');
                $picture = new Picture();
                $picture->changeCaption($id, $_POST["picText"]);
                header("Location: /PHP_project_Modul151_MVC/");
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

            require(ROOT . 'Models/Picture.php');
            $picture = new Picture();
            $picture->deletePicture($id);
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