<?php
    require_once "database.php";
    require_once "managers/StandingManager.php";

    if(isset($_GET['standingId'])) {
        StandingManager::DeleteStanding($_GET['standingId']);
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Standing - Formula One</title>
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
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Position</th>
                    <th>Points</th>
                    <th>Wins</th>
                    <th></th>
                    <th><a href="addStanding.php">Add</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach (StandingManager::GetStanding() as $standing) {
                        echo '<tr>';
                            echo '<td>'.$standing->standingId.'</td>';
                            echo '<td>'.$standing->driverFirstname.'</td>';
                            echo '<td>'.$standing->driverLastname.'</td>';
                            echo '<td>'.$standing->standingPosition.'</td>';
                            echo '<td>'.$standing->standingPoints.'</td>';
                            echo '<td>'.$standing->standingWins.'</td>';
                            echo '<td><a href="updateStanding.php?standingId='.$standing->standingId.'">Update</a></td>';
                            echo '<td><a href="standing.php?standingId='.$standing->standingId.'">Delete</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>

    </body>
</html>
