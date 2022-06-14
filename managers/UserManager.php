<?php
    require_once 'database.php';

class UserManager
{
    public static function GetUser() {
        global $conn;

        $stmt = $conn->prepare('SELECT * FROM userinfo');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function GetSpecificUser($pId) {
        global $conn;

        $stmt = $conn->prepare('SELECT * FROM userinfo WHERE userInfoId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public static function UpdateUser($pId, $pUsername, $pFirstname, $pLastname, $pEmail, $pAdmin, $pActivation, $pIsActive, $pPicture) {
        global $conn;

        $stmt = $conn->prepare('UPDATE userinfo SET userInfoUsername = ?, userInfoFirstname = ?, userInfoLastname = ?, userInfoEmail = ?, userInfoAdmin = ?, userActivationCode = ?, userIsActive = ?, userProfileImg = ? WHERE userInfoId = ?');
        $stmt->bindValue(1, $pUsername);
        $stmt->bindValue(2, $pFirstname);
        $stmt->bindValue(3, $pLastname);
        $stmt->bindValue(4, $pEmail);
        $stmt->bindValue(5, $pAdmin);
        $stmt->bindValue(6, $pActivation);
        $stmt->bindValue(7, $pIsActive);
        $stmt->bindValue(8, $pPicture);
        $stmt->bindValue(9, $pId);
        $stmt->execute();
    }

    public static function DeleteUser($pId) {
        global $conn;

        $stmt = $conn->prepare('DELETE FROM userinfo WHERE userInfoId = ?');
        $stmt->bindValue(1, $pId);
        $stmt->execute();
    }
}