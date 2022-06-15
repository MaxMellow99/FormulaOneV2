<?php
    require_once "database.php";
    require_once "managers/StandingManager.php";
    require_once "managers/DriverManager.php";

    if($_POST) {
        StandingManager::AddStanding(
                $_POST['driver'],
                $_POST['position'],
                $_POST['points'],
                $_POST['wins']
        );
        header('location:standing.php');
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Standing - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <form method="Post">
            Driver: <?php
                echo '<select name="driver">';
                    foreach (DriverManager::GetDriver() as $driver) {
                        echo '<<option selected disabled hidden>Kies</option>';
                        echo "<option class='form-select w-75' value='$driver->driverId'>$driver->driverFirstname $driver->driverLastname</option>";
                    }
                echo '</select>';
                echo '<br>';
            ?>
            Position: <input type="number" name="position"><br>
            Points: <input type="number" name="points"><br>
            Wins: <input type="number" name="wins"><br>
            <input type="submit" value="Add"><br>
            <a href="standing.php">Cancel</a>
        </form>
    </body>
</html>
