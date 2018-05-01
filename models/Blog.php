<?php
class Blog extends Model
{
    public function create($title, $blogText)
    {
        $sql = "INSERT INTO blog (title, blogText) VALUES (:title, :blogText)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'title' => $title,
            'blogText' => $blogText,
        ]);
    }

    public function showBlog($id)
    {
        $sql = "SELECT * FROM blog WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
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
        $sql = "SELECT * FROM blog ORDER BY user_id, blogDate DESC";
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