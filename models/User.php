<?php
class User extends Model
{

    public function userExist($username)
    {
        $sql = "SELECT username FROM benutzer WHERE  username = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$username]);
        $count = $req->rowCount();
        return $count;
    }

    public function getPassword($username)
    {
        $sql = "SELECT passwordHash FROM benutzer WHERE  username = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$username]);
        $passwordHash = $req->fetch(PDO::FETCH_ASSOC);
        return $passwordHash['passwordHash'];
    }

}
?>