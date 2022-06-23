<?php
    session_start();

    var_dump($_SESSION['id']);
    require_once "managers/GambleManager.php";
    require_once "managers/DriverManager.php";

    if($_POST) {
        GambleManager::ClearSorting();
    }
    for ($i = 1; $i <= 20; $i++) {
        if(isset($_POST["driver$i"])) {

            GambleManager::CalculateGamble(
                     $i,
                    "5",
                    $_POST["driver$i"],
                    $_SESSION['id']
            );
        }
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
            <table class="table table-striped">
                <thead class="table-dark">
                    <th>Gamble <input type="submit"></th>
                </thead>
                <tbody>
                    <?php
                        for ($i = 1; $i <= 20; $i++) {
                            echo "<tr>";
                                echo "<td>$i: "; 
                                    echo "<select name='driver$i'>";
                                        echo "<option hidden none>Chose driver</option>";
                                        foreach(DriverManager::GetDriver() as $driver) {
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
