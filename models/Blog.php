<?php
class Blog extends Model
{
    public function create($title, $blogText)
    {
        $blogDate = date('Y-m-d H:i:s');

        //Get user (have username, need ID)
        require(ROOT . 'Models/User.php');
        $user = new User();
        $user_id = $user->getUserID($_SESSION["username"]);

        $sql = "INSERT INTO blog (title, blogText, blogDate, user_id) VALUES (:title, :blogText, :blogDate, :user_id)";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([
            'title' => $title,
            'blogText' => $blogText,
            'blogDate' => $blogDate,
            'user_id' => $user_id
        ]);
    }

    public function showBlog($id)
    {
        $sql = "SELECT * FROM blog WHERE id = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);
        return $req->fetch();
    }

    public function showAllBlogs()
    {
        $sql = "SELECT * FROM blog";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function showAllBlogsSorted()
    {
        $sql = "SELECT * FROM blog LEFT JOIN benutzer ON benutzer.userID = blog.user_id ORDER BY user_id, blogDate DESC";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function edit($id, $title, $blogText)
    {
        $sql = "UPDATE blog SET title = :title, blogText = :blogText WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'id' => $id,
            'title' => $title,
            'blogText' => $blogText,
        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM blog WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>