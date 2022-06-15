<?php
    require_once "database.php";
    require_once "managers/ResultManager.php";

    if(isset($_GET['resultId'])) {
        ResultManager::DeleteResult($_GET['resultId']);
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Result - Formula One</title>
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
                    <th>Position</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Round</th>
                    <th>Track</th>
                    <th>Points</th>
                    <th></th>
                    <th><a href="addResult.php">Add</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach (ResultManager::GetResult() as $result) {
                        echo '<tr>';
                        echo '<td>'.$result->resultId.'</td>';
                        echo '<td>'.$result->resultPosition.'</td>';
                        echo '<td>'.$result->driverFirstname.'</td>';
                        echo '<td>'.$result->driverLastname.'</td>';
                        echo '<td>'.$result->raceRound.'</td>';
                        echo '<td>'.$result->raceTrack.'</td>';
                        echo '<td>'.$result->resultPoints.'</td>';
                        echo '<td><a href="updateResult.php?resultId='.$result->resultId.'">Update</a></td>';
                        echo '<td><a href="result.php?resultId='.$result->resultId.'">Delete</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>

    </body>
</html>
