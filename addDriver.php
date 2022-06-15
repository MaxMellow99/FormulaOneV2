<?php
    require_once "database.php";
    require_once "managers/DriverManager.php";

    if($_POST) {
        DriverManager::AddDriver(
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['number'],
                $_POST['code'],
                $_POST['birthdate'],
                $_POST['nationality']
        );
        header('location:driver.php');
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Add Driver - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <form method="Post">
            Firstname: <input type="text" name="firstname"><br>
            Lastname: <input type="text" name="lastname"><br>
            Number: <input type="number" name="number"><br>
            Code: <input type="text" name="code"><br>
            Birthdate: <input type="date" name="birthdate"><br>
            Nationality: <input type="text" name="nationality"><br>
            <input type="submit" value="Add"><br>
            <a href="driver.php">Cancel</a>
        </form>
    </body>
</html>
