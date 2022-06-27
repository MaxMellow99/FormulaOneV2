<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../tools/PHPMailer/Exception.php';
require '../tools/PHPMailer/PHPMailer.php';
require '../tools/PHPMailer/SMTP.php';


function send_activation_email($email, $firstname, $activation)
{

    $url = $_SESSION['url'];

    //Create a new PHPMailer instance
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.strato.com';
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Username = 'student@computercampus.nl';
    $mail->Password = 'Sp@mmenmagniet!';



    //Set who the message is to be sent from
    $mail->setFrom('no-reply@gmail.com', 'Formule 1');
    //Set who the message is to be sent to
    $mail->addAddress($email, $firstname);
    //Set the subject line
    $mail->Subject = 'Account activatie';
    //Read an HTML message body from an external file, convert referenced images to embedded,

    // The message
    $mail->msgHTML("Klik <a href='$url/activeer.php?activation_code=$activation'>hier</a> om je account te activeren\r\n <a href='activeer.php?activation_code=$activation'></a>");



    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Kijk in uw inbox om uw account te activeren!';
    }
}
