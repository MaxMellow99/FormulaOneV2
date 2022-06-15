<?php
    require_once "database.php";
    require_once "managers/ResultManager.php";
    require_once "managers/DriverManager.php";
    require_once "managers/RaceManger.php";

    if($_POST) {
        ResultManager::AddResult(
                $_POST['position'],
                $_POST['driver'],
                $_POST['race'],
                $_POST['points']
        );
        header('location:result.php');
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Result - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <form method="Post">
            Position: <input type="number" name="position"><br>
            Driver: <?php
                echo '<select name="driver">';
                    foreach (DriverManager::GetDriver() as $driver) {
                        echo '<<option selected disabled hidden>Kies</option>';
                        echo "<option class='form-select w-75' value='$driver->driverId'>$driver->driverFirstname $driver->driverLastname</option>";
                    }
                echo '</select>';
                echo '<br>';
            ?>
            Driver: <?php
                echo '<select name="race">';
                    foreach (RaceManger::GetRace() as $race) {
                        echo '<<option selected disabled hidden>Kies</option>';
                        echo "<option class='form-select w-75' value='$race->raceId'>$race->raceTrack</option>";
                    }
                echo '</select>';
                echo '<br>';
            ?>
            Points: <input type="number" name="points"><br>
            <input type="submit" value="Add"><br>
            <a href="race.php.php">Cancel</a>
        </form>
    </body>
</html>
