<?php
session_start();


require_once "managers/GambleManager.php";
require_once "managers/DriverManager.php";
require_once "managers/RaceManger.php";


$races = RaceManger::GetRace();


if ($_POST) {
    //Gooit sortingtable leeg
    GambleManager::ClearSorting();
    GambleManager::ClearGamble($_SESSION['user']);

    for ($i = 1; $i <= 20; $i++) {
        if (isset($_POST["position$i"])) {

            GambleManager::CalculateGamble(
                $i,
                $_POST["racetype"],
                $_POST["position$i"],
                $_SESSION['id']
            );
        }
    }
    header("location: beforegamble.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Gamble - Formula One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <form method="POST">
        <label>Filter op race</label>
        <select class="m-2" name="racetype">
            <?php
            echo "<option hidden none>Chose race</option>";
            foreach ($races as $race) {
                echo "<option value='$race->raceId'>$race->raceTrack</option>";
            }
            ?>
        </select>
        <input type="submit">

        <table class="table table-striped">
            <thead class="table-dark">
                <th>Gamble <input type="submit"></th>
            </thead>
            <tbody>
                <?php
                for ($i = 1; $i <= 20; $i++) {
                    echo "<tr>";
                    echo "<td>position $i: ";
                    echo "<select name='position$i'>";
                    echo "<option hidden none>Chose driver</option>";
                    foreach (DriverManager::GetDriver() as $driver) {
                        echo "<option value='$driver->driverId'>$driver->driverLastname</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
</body>

</html>