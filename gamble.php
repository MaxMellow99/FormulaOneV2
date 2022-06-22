<?php
    require_once "database.php";
    require_once "managers/GambleManager.php";

    if (isset($_SESSION['id'])) {
        $personmanager = new personmanager();
        $person = $personmanager->getAllById($_SESSION['id']);
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Gamble - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <td>Position</td>
                    <td>Username</td>
                    <td>Points</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach (GambleManager::GetGamble() as $gamble) {
                        echo "<tr>";
                            echo "<td>$gamble->gamblePosition</td>";
                            echo "<td>$gamble->userInfoUsername</td>";
                            echo "<td>$gamble->gamblePoints</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>
