<?php
session_start();

require_once "database.php";
require_once "managers/GambleManager.php";
require_once "managers/RaceManger.php";
require_once "managers/personmanager.php";



$races = RaceManger::GetRace();


if(isset($_GET['showall'])){
    $gambles = GambleManager::GetFinalGambleAll($_SESSION['user']);
    header("location: gamble.php");
}
else if (isset($_POST["racetype"])) {
    $gambles = GambleManager::GetFinalGambleSpecific($_SESSION['user'], $_POST['racetype']);
} else {
    $gambles = GambleManager::GetFinalGambleAll($_SESSION['user']);
}



?>
<!doctype html>
<html lang="en">

<head>
    <title>Gamble - Formula One</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    
    <form method="post">
    <label>Filter op race</label>
        <select class="m-2" name="racetype">
            <?php
            echo "<option hidden none>Chose race</option>";
            foreach ($races as $race) {
                echo "<option value='$race->raceTrack'>$race->raceTrack</option>";
            }
            ?>
        </select>
        <input type="submit">
    </form>

        

    <a class="btn btn-primary m-3" href="gamble.php?showall">show all</a>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td>Race</td>
                <td>Username</td>
                <td>Points</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($gambles as $gamble) {
                echo "<tr>";
                echo "<td>$gamble->raceTrack</td>";
                echo "<td>$gamble->userInfoUsername</td>";
                echo "<td>$gamble->Points</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>