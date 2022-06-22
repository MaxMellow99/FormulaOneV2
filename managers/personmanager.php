<?php

require "./database.php";

class personmanager
{
    public function getAllById($id)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM `userinfo` WHERE `userInfoId`=?");
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject();
    }

    public function activate($id)
    {
        global $conn;

        $stmt = $conn->prepare("UPDATE `s_557367_db1`.`userinfo` SET `userIsActive` = '1' WHERE (`userActivationCode` = ?)");
        $stmt->bindValue(1, $id);
        $stmt->execute();

    }


    public function changePfPic($filepath ,$id){
        global $conn;

        $stmt = $conn->prepare("UPDATE userinfo SET userProfileImg = ? WHERE (`userInfoId` = ?);");
        $stmt->bindValue(1, $filepath);
        $stmt->bindValue(2, $id);

        $stmt->execute();
    }

    public function deletePfPic($id){
        $empty = '';
        global $conn;

        $stmt = $conn->prepare("UPDATE userinfo SET userProfileImg = ? WHERE (userInfoId = ?);");
        $stmt->bindValue(1, $empty);
        $stmt->bindValue(2, $id);

        $stmt->execute();
    }

    public function changeUsername($name, $id){
        global $conn;

        $stmt = $conn->prepare("UPDATE userinfo SET userInfoUsername = ? WHERE (userInfoId = ?);");
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $id);

        $stmt->execute();
    }
    public function changeEmail($email, $id){
        global $conn;

        $stmt = $conn->prepare("UPDATE userinfo SET userInfoEmail = ? WHERE (userInfoId = ?)");
        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, $id);

        $stmt->execute();
    }

    public function changePass($pass, $id){
        global $conn;
        $password = password_hash($pass, PASSWORD_DEFAULT);


        $stmt = $conn->prepare("UPDATE userinfo SET userInfoPassword = ? WHERE (userInfoId = ?)");
        $stmt->bindValue(1, $password);
        $stmt->bindValue(2, $id);

        $stmt->execute();
    }
}
