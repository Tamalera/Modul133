<?php
class Like extends Model
{
    public function checkLike($blog_id)
    {
        require_once(ROOT . 'Models/User.php');
        $userID = new User();
        $userID = $userID->getUserID($_SESSION["username"]);
        $sql = "SELECT * FROM likes WHERE  blog_ID = :bid AND user_ID = :uid";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([
            'bid' => $blog_id,
            'uid' => $userID
             ]);
        $count = $req->rowCount();
        return $count;
    }

    public function addLike($blog_id)
    {
        //Get user (have username, need ID)
        require_once(ROOT . 'Models/User.php');
        $myUser = new User();
        $user_id = $myUser->getUserID($_SESSION["username"]);

        $sql = "INSERT INTO likes (blog_ID, user_ID) VALUES (:bid, :uid)";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([
            'bid' => $blog_id,
            'uid' => $user_id
        ]);

        //Count likes one up in Blog-Table
        $sql2 = "UPDATE blog SET likes = (likes + 1) WHERE blogID = :id";
        $req2 = Database::getBdd()->prepare($sql2);
        $req2->execute([
            'id' => $blog_id
        ]);
    }

    public function deleteLike($id)
    {
        $sql = 'DELETE FROM likes WHERE blog_ID = ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);
    }
}
?>