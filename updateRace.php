<?php
    require_once "database.php";
    require_once "managers/RaceManger.php";

    $race = RaceManger::GetSpecificRace($_GET['raceId']);

    if($_POST) {
        RaceManger::UpdateRace(
                $_GET['raceId'],
                $_POST['season'],
                $_POST['round'],
                $_POST['track'],
                $_POST['date'],
                $_POST['time']
        );
        header('location:race.php');
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Update Race - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <form method="Post">
            Season: <input type="number" name="season" value="<?php echo $race->raceSeason ?>"><br>
            Round: <input type="number" name="round" value="<?php echo $race->raceRound ?>"><br>
            Track: <input type="text" name="track" value="<?php echo $race->raceTrack ?>"><br>
            Date: <input type="date" name="date" value="<?php echo $race->raceDate ?>"><br>
            Time: <input type="time" name="time" value="<?php echo $race->raceTime ?>"><br>
            <input type="submit" value="Update"><br>
            <a href="race.php">Cancel</a>
        </form>
    </body>
</html>
