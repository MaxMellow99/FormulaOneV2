<?php

session_start();
    require"managers/personmanager.php";
    $personmanager = new personmanager();
    $person = $personmanager->getAllById($_SESSION['id']);
if (isset($_SESSION['id'])) {
    if ($person->userInfoAdmin == 1) {
    }
    else{
        header("location: index.php");
    }

}
else{
    header("location:index.php");
}



?>