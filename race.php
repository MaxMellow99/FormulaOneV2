<?php
    require_once "database.php";
    require_once "managers/RaceManger.php";

    if(isset($_GET['raceId'])) {
        RaceManger::DeleteRace($_GET['raceId']);
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Race - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <ul>
            <li><a href="user.php">User</a></li>
            <li><a href="driver.php">Driver</a></li>
            <li><a href="race.php">Race</a></li>
            <li><a href="result.php">Result</a></li>
            <li><a href="standing.php">Standing</a></li>
        </ul>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Season</th>
                    <th>Round</th>
                    <th>Track</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th></th>
                    <th><a href="addRace.php">Add</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach (RaceManger::GetRace() as $race) {
                        echo '<tr>';
                        echo '<td>'.$race->raceId.'</td>';
                        echo '<td>'.$race->raceSeason.'</td>';
                        echo '<td>'.$race->raceRound.'</td>';
                        echo '<td>'.$race->raceTrack.'</td>';
                        echo '<td>'.$race->raceDate.'</td>';
                        echo '<td>'.$race->raceTime.'</td>';
                        echo '<td><a href="updateRace.php?raceId='.$race->raceId.'">Update</a></td>';
                        echo '<td><a href="race.php?raceId='.$race->raceId.'">Delete</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>
