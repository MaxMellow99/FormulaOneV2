<?php
    require_once "database.php";
    require_once "managers/RaceManger.php";
    require_once "admincheck.php";

    if(isset($_GET['raceId'])) {
        RaceManger::DeleteRace($_GET['raceId']);
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
                    <li class="nav-item">
                            <a href="./gamble.php" class="nav-link">Gamble</a>
                        </li>
                    <li class="nav-item">
                            <a href="./driver.php" class="nav-link">Coureurs</a>
                        </li>
                        <li class="nav-item">
                            <a href="./user.php" class="nav-link">Gebruikers</a>
                        </li>
                        <li class="nav-item">
                            <a href="./result.php" class="nav-link">Race resultaten</a>
                        </li>
                        <li class="nav-item">
                            <a href="./standing.php" class="nav-link">Tussenstand</a>
                        </li>
                        <li class="nav-item">
                            <a href="./race.php" class="nav-link text-white">Races</a>
                        </li>
                        <li class="admin-backend" class="nav-item" <?php if($person->userInfoAdmin == 1) { echo "style='display: block;' ";} ?> >
                            <a href="./admin.php" class="nav-link">admin</a>
                        </li>
                        <li class="nav-item">
                            <a href="./index.php" class="nav-link">Home</a>
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

        <table class="table table-striped table-light">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Season</th>
                    <th>Round</th>
                    <th>Track</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th></th>
                    <th><a class="btn btn-primary" href="addRace.php">Add</a></th>
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
                        echo '<td><a class="btn btn-success" href="updateRace.php?raceId='.$race->raceId.'">Update</a></td>';
                        echo '<td><a class="btn btn-danger" href="race.php?raceId='.$race->raceId.'">Delete</a></td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
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