<?php
    require_once "database.php";
    require_once "managers/DriverManager.php";

    if(isset($_GET['driverId'])) {
        DriverManager::DeleteDriver($_GET['driverId']);
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Driver - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <ul>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="driver.php">Driver</a></li>
            <li><a href="race.php">Race</a></li>
            <li><a href="result.php">Result</a></li>
            <li><a href="standing.php">Standing</a></li>
        </ul>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Number</th>
                    <th>Code</th>
                    <th>Birthdate</th>
                    <th>Nationality</th>
                    <th></th>
                    <th><a href="addDriver.php">Add</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach (DriverManager::GetDriver() as $driver) {
                        echo '<tr>';
                        echo '<td>'.$driver->driverId.'</td>';
                        echo '<td>'.$driver->driverFirstname.'</td>';
                        echo '<td>'.$driver->driverLastname.'</td>';
                        echo '<td>'.$driver->driverNumber.'</td>';
                        echo '<td>'.$driver->driverCode.'</td>';
                        echo '<td>'.$driver->driverBirthdate.'</td>';
                        echo '<td>'.$driver->driverNationality.'</td>';
                        echo '<td><a href="updateDriver.php?driverId='.$driver->driverId.'">Update</a></td>';
                        echo '<td><a href="driver.php?driverId='.$driver->driverId.'">Delete</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>

    </body>
</html>
