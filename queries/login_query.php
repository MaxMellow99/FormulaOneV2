<?php
session_start();

require_once '../database.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM `userinfo` WHERE `userInfoUsername`=?");
    $stmt->bindValue(1, $_POST['username']);
    $stmt->execute();

    $dbuser = $stmt->fetchObject();
   
    //Als er een persoon is opgehaald
    if ($dbuser !== false) {

        //password verify, vergelijkt ingevuld wachtwoord met wachtwoord in db
        if ($dbuser->userIsActive >= 1 && password_verify($password, $dbuser->userInfoPassword)) {
            echo"Ingelogd!";  
            $_SESSION['user'] = $dbuser->userInfoUsername;
            $_SESSION['id'] = $dbuser->userInfoId;
            header("location: ../index.php");
        }
        else {
            if($dbuser->userIsActive == 0) {
                echo "Je account is nog niet geactiveerd!";
            }
            else{
                echo "Onjuist Gebruikersnaam/Wachtwoord"; 
            }
            
            //header("location: index.php");
        }
    }
    //Als het niet lukt om een persoon op te halen, Foute credentials
    else{
        echo "Onjuist Gebruikersnaam/Wachtwoord";
        //header("location: index.php");
    }
}
