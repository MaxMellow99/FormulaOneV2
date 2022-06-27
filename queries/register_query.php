<?php
session_start();
require_once '../database.php';
require_once '../managers/emailverificationmanager.php';
require_once "../emailverification.php";

$emailmanager = new emailverificationmanager();
$activation_code = $emailmanager->generate_activation_code();

$_SESSION['code'] = $activation_code;



if (isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $stmt = $conn->prepare("INSERT INTO userinfo (userInfoEmail, userInfoFirstname, userInfoLastname, userInfoUsername, userInfoPassword, userActivationCode) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindValue(1, $email);  
    $stmt->bindValue(2, $firstname);  
    $stmt->bindValue(3, $lastname);  
    $stmt->bindValue(4, $username);  
    $stmt->bindValue(5, $password); 
    $stmt->bindValue(6, $activation_code);
    $stmt->execute();   
    
    

    send_activation_email($email, $firstname, $activation_code);
}
