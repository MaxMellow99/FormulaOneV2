<?php
    require_once "usercheck.php";

    var_dump($_SESSION['id']);
    require_once "managers/GambleManager.php";
    require_once "managers/DriverManager.php";
    require_once "managers/personmanager.php";
    

    if (isset($_SESSION['id'])) {
        $personmanager = new personmanager();
        $person = $personmanager->getAllById($_SESSION['id']);
    }

    var_dump($_POST);

    if($_POST) {
        //Gooit sortingtable leeg
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
        <?php
        require "./head.php";
        ?>
    </head>

    <body>
        <nav id="nav-top-color" class="navbar navbar-expand-lg">
            <img id="header-logo" src="images/F1.svg.png" class="navbar-brand"></img>

            <ul id="nav-top" class="navbar-nav ml-auto flex-nowrap">
                <li id="place-welkom-text" class="nav-item">
                    <a id="register_button" type="button" data-toggle="modal" data-target="#myModal1" href="#" class="nav-link btn-danger loginlogout">register</a>
                </li>
                <li class="nav-item">
                    <a id="login_logout" type="button" data-toggle="modal" data-target="#myModal" class="nav-link btn-danger loginlogout">login</a>
                </li>
            </ul>

        </nav>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div id="nav-align-right" class="d-flex flex-grow-1">
            <span class="w-100 d-lg-none d-block">
                <!-- hidden spacer to center brand on mobile -->
            </span>
            <div class="w-100 text-right">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar7">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar7">
            <ul class="navbar-nav ml-auto flex-nowrap">
                <li class="admin-backend" class="nav-item" <?php if ($person->userInfoAdmin == 1) {
                                                                echo "style='display: block;' ";
                                                            } ?>>
                    <a href="./admin.php" class="nav-link">admin</a>
                </li>
                <li class="nav-item">
                    <a href="./index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="./addGamble.php" class="nav-link">Voorspellen</a>
                </li>
                <li class="nav-item">
                    <a href="./gebruikers.php" class="nav-link">Gebruiker</a>
                </li>
                <li class="nav-item">
                    <img id="acc-profile-img" src="<?php if (isset($_SESSION["id"])) echo "./images/profileimages/$person->userProfileImg";
                                                    if (!isset($_SESSION["id"])) echo "./images/profileimages/TEMPFOTO.jpg"; ?>">
                </li>
            </ul>
        </div>
    </nav>
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