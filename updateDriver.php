<?php
    require_once "database.php";
    require_once "managers/DriverManager.php";

    $driver = DriverManager::GetSpecificDriver($_GET['driverId']);

    if($_POST) {
        DriverManager::UpdateDriver(
                $_GET['driverId'],
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
        <title>Update Driver - Formula One</title>
    </head>
    <body>
        <form method="Post">
            Firstname:<input type="text" name="firstname" value="<?php echo $driver->driverFirstname ?>"><br>
            Lastname:<input type="text" name="lastname" value="<?php echo $driver->driverLastname ?>"><br>
            Number:<input type="number" name="number" value="<?php echo $driver->driverNumber ?>"><br>
            Code:<input type="text" name="code" value="<?php echo $driver->driverCode ?>"><br>
            Birthdate:<input type="text" name="birthdate" value="<?php echo $driver->driverBirthdate ?>"><br>
            Nationality:<input type="text" name="nationality" value="<?php echo $driver->driverNationality ?>"><br>
            <input type="submit" value="Update"><br>
            <a href="driver.php">Cancel</a>
        </form>
    </body>
</html>
