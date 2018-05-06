<?php
class likeController extends defaultController
{
    function index($id)
    {
        if(isset($_SESSION['is_logged_in'])){

            require(ROOT . 'Models/Like.php');
            $likes = new Like();
            $count = $likes->checkLike($id);
            if ($count == 0) {
                $likes->addLike($id);
            }
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