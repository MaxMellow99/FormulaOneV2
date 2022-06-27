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
    <H1 class="text-center text-light">Tussenstand aanpassen</H1>
        <form method="Post" class="d-flex justify-content-center">
            <div>
                <label class="text-light">Position:</label> <input class="form-control" type="number" name="position" value="<?php echo $standing->standingPoints ?>"><br>
                <label class="text-light">Driver:</label> <?php
                    echo '<select class="form-control" name="driver">';
                        foreach (DriverManager::GetDriver() as $driver) {
                            echo "<option value='$driver->driverId'>$driver->driverFirstname $driver->driverLastname</option>";
                        }
                    echo '</select>';
                    echo '<br>';
                ?>
                <label class="text-light">Position:</label> class="form-control" <input type="number" name="position" value="<?php echo $standing->standingPosition ?>"><br>
                <label class="text-light">Points:</label> class="form-control" <input type="number" name="points" value="<?php echo $standing->standingPoints ?>"><br>
                <label class="text-light">Wins:</label> class="form-control" <input type="number" name="wins" value="<?php echo $standing->standingWins ?>"><br>
                <input class="btn btn-primary" type="submit" value="Update"><br><br>
                <a class="btn btn-warning" href="standing.php">Cancel</a>
            </div>
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