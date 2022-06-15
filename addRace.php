<?php
    require_once "database.php";
    require_once "managers/RaceManger.php";

    if($_POST) {
        RaceManger::AddRace(
                $_POST['season'],
                $_POST['round'],
                $_POST['track'],
                $_POST['date'],
                $_POST['time'],
        );
        header('location:race.php');
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Race - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <form method="Post">
            Season: <input type="text" name="season"><br>
            Round: <input type="number" name="round"><br>
            Track: <input type="text" name="track"><br>
            Date: <input type="date" name="date"><br>
            Time: <input type="time" name="time"><br>
            <input type="submit" value="Add"><br>
            <a href="race.php.php">Cancel</a>
        </form>
    </body>
</html>
