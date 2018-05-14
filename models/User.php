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

    public function getUserID($username)
    {
        $sql = "SELECT userID FROM benutzer WHERE  username = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$username]);
        $user = $req->fetch(PDO::FETCH_ASSOC);
        return $user['userID'];
    }

    public function addUser($userName, $pwHash)
    {
        //User ROle is 2 by default: 1 = admin, 2 = user
        $sql = "INSERT INTO benutzer (username, passwordHash, role_id) VALUES (:username, :passwordHash, :role_id)";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([
            'username' => $userName,
            'passwordHash' => $pwHash,
            'role_id' => 2
        ]);
    }

    public function getUserRole($username)
    {
        $sql = "SELECT role_ID FROM benutzer WHERE  username = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$username]);
        $user = $req->fetch(PDO::FETCH_ASSOC);
        return $user['role_ID'];
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM benutzer
        LEFT JOIN role ON role.roleID = benutzer.role_ID";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function deleteUser($id){
        $sql = 'DELETE FROM benutzer WHERE userID = ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);
    }

}
?>