<?php
    require_once "database.php";
    require_once "managers/StandingManager.php";
    require_once "managers/DriverManager.php";
    require_once "admincheck.php";

    $standing = StandingManager::GetSpecificStanding($_GET['standingId']);

    if($_POST) {
        StandingManager::UpdateStanding(
                $_GET['standingId'],
                $_POST['driver'],
                $_POST['position'],
                $_POST['points'],
                $_POST['wins'],
        );
        header('location:standing.php');
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
            Position: <input type="number" name="position" value="<?php echo $standing->standingPoints ?>"><br>
            Driver: <?php
                echo '<select name="driver">';
                    foreach (DriverManager::GetDriver() as $driver) {
                        echo "<option value='$driver->driverId'>$driver->driverFirstname $driver->driverLastname</option>";
                    }
                echo '</select>';
                echo '<br>';
            ?>
            Position: <input type="number" name="position" value="<?php echo $standing->standingPosition ?>"><br>
            Points: <input type="number" name="points" value="<?php echo $standing->standingPoints ?>"><br>
            Wins: <input type="number" name="wins" value="<?php echo $standing->standingWins ?>"><br>
            <input type="submit" value="Update"><br>
            <a href="standing.php">Cancel</a>
        </form>
    </body>
</html>
<?php
if (isset($_SESSION["user"])) {
?>
    <script>
        $(document).ready(function() {
            //Login knop 
            $('#login_logout').attr('data-target', '').attr('href', './logout.php');
            $('#login_logout').attr('data-toggle', '').attr('href', './logout.php');
            $("#login_logout").html("Log uit");

            $('#register_button').hide();

            var welcometext;
            welcometext = "";
            welcometext += "<span class='text-light' id='welcome_text'>Welkom, <?php echo $_SESSION['user'];  ?>  </span>";

            $("#place-welkom-text").append(welcometext);
        });
    </script>
<?php
}
?>