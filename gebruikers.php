<?php

require_once "./usercheck.php";
require_once "managers/personmanager.php";
require_once "managers/GambleManager.php";
require_once "managers/RaceManger.php";


$races = RaceManger::GetRace();


if (isset($_GET['showall'])) {
    $gambles = GambleManager::GetFinalGambleAll($_SESSION['user']);
    header("location: gebruikers.php");
} else if (isset($_POST["racetype"])) {
    $gambles = GambleManager::GetFinalGambleSpecific($_SESSION['user'], $_POST['racetype']);
} else {
    $gambles = GambleManager::GetFinalGambleAll($_SESSION['user']);
}


//is er ingelogd
if (isset($_SESSION['id'])) {
    //haal de ingelogde persoon op.
    $personmanager = new personmanager();
    $person = $personmanager->getAllById($_SESSION['id']);

    //if admin show admin backend button else display none
    if ($person->userInfoAdmin == 1) {
?>
        <script>
            //javascript
            $('.admin-backend').show();
        </script>
<?php
    }
}




if (isset($_POST['usernamesubmit'])) {
    $id = $_SESSION['id'];
    session_destroy();

    //Update username
    $personmanager->changeUsername($_POST['changeusername'], $id);

    header("location: index.php");
} else if (isset($_POST['emailsubmit'])) {
    $id = $_SESSION['id'];

    //Update username
    $personmanager->changeEmail($_POST['changeemail'], $id);

    header("location: index.php");
} else if (isset($_POST['passsubmit'])) {
    $id = $_SESSION['id'];

    //Update username
    $personmanager->changePass($_POST['changepass'], $id);

    session_destroy();
    header("location: index.php");
}


?>
<html>

<head>
    <?php
    require "./head.php";
    ?>
</head>

<body>
    <nav id="nav-top-color" class="navbar navbar-expand-lg">
        <img id="header-logo" src="images/F1.svg.png" class="navbar-brand"></img>

        <ul id="nav-top" class="navbar-nav ml-auto flex-nowrap">
            <li id="place-welkom-text" class="nav-item text-light">
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
                    <a href="addGamble.php" class="nav-link">Voorspellen</a>
                </li>
                <li class="nav-item">
                    <a href="./gebruikers.php" class="nav-link">Gebruiker</a>
                </li>
                <li class="nav-item">
                    <img id="acc-profile-img" alt="No Image" src="<?php if (isset($person->userProfileImg)) echo "./images/profileimages/$person->userProfileImg";
                                                    if (!isset($person->userProfileImg)) echo "./images/profileimages/TEMPFOTO.jpg"; ?>">
                </li>
            </ul>
        </div>
    </nav>
    <div id="acc-body-container">
        <div id="acc-sidebar">
            <h2 class="acc-text-sidebar">Mijn Account</h2>
            <h5 class="acc-text-sidebar-smaller">Je bent ingelogd als <?php echo $_SESSION["user"]; ?></h5>
            <img id="acc-profile-img-bigger"    alt="No Image" src="<?php if (isset($person->userProfileImg)) echo "./images/profileimages/$person->userProfileImg";
                                                    if (!isset($person->userProfileImg)) echo "./images/profileimages/TEMPFOTO.jpg"; ?>">
            <h5 class="acc-text-sidebar-smaller"><a type="button" data-toggle="modal" data-target="#myModal2" id="acc-change-profilepic">Verander profielfoto</a> </h5>

            <ul id="vertical-nav" class="nav flex-column">
                <li class="vertical-nav-border" class="nav-item">
                    <a data="profile-page" class="nav-link active" onclick="showPage(this)">Persoonlijke Informatie</a>
                </li>
                <li class="vertical-nav-border" class="nav-item">
                    <a data="voorspellingen-page" class="nav-link" onclick="showPage(this)">Voorspellingen</a>
                </li>
                <li class="vertical-nav-border" class="nav-item">
                    <a data="statistieken-page" class="nav-link" onclick="showPage(this);">Statistieken</a>
                </li>
            </ul>
        </div>
        <div id="acc-body">
            <div class="acc-page-tabs" id="profile-page">
                <form id="gbrk-form">
                    <div class="form-group">
                        <label class="text-light" for="exampleInputFirstName">Voornaam</label>
                        <input name="firstname" type="text" class="form-control" value="<?php echo "$person->userInfoFirstname"; ?>">

                        <br>
                        <div class="line-black"></div>
                        <label class="text-light" for="exampleInputLastName">Achternaam</label>
                        <input name="lastname" type="text" class="form-control" value="<?php echo "$person->userInfoLastname"; ?>">
                    </div>
                    <div class="line-black"></div>
                    <div class="form-group">
                        <label class="text-light" for="exampleInputUsername">Gebruikersnaam</label>
                        <input type="text" class="form-control" value="<?php echo "$person->userInfoUsername"; ?>">
                        <a type="button" data-toggle="modal" data-target="#changeusernameModal" class="text-primary">Username wijzigen</a>
                    </div>
                    <div class="line-black"></div>
                    <div class="form-group">
                        <label class="text-light" for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control" value="<?php echo "$person->userInfoEmail"; ?>">
                        <a type="button" data-toggle="modal" data-target="#changeemailModal" class="text-primary">E-mail wijzigen</a>
                    </div>
                    <div class="line-black"></div>
                    <div class="form-group">
                        <label class="text-light" for="exampleInputPass">Wachtwoord</label>
                        <input type="email" class="form-control" value="*********">
                        <a type="button" data-toggle="modal" data-target="#changePassModal" class="text-primary">Wachtwoord wijzigen</a>
                    </div>
                </form>
            </div>
            <div class="acc-page-tabs" id="voorspellingen-page">
                <h1 class="m-3 text-left text-light">Voorspellingen</h1>

                <form style="width: 60%; float:left;" method="post">
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
                    <a class="btn btn-primary m-3" href="gebruikers.php?showall">show all</a>
                </form>



                
                <table style="width: 60%;" class="table-striped">
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
            </div>
            <div class="acc-page-tabs" id="statistieken-page">
                <h1>check2</h1>
            </div>
        </div>




        <div id="modals">
            <!-- Login Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Login</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="queries/login_query.php" method="POST" class="login-form">
                                <p class="login-text">Gebruikersnaam / E-mail</p>
                                <input name="username" class="login-input" type="text">
                                <p class="login-text">Wachtwoord</p>
                                <input name="password" class="login-input" type="password">
                                <br>
                                <br>
                                <input name="login" class="login-submit btn btn-success " type="submit" value="Login">
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- register Modal -->
            <div class="modal" id="myModal1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Register</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <form action="queries/register_query.php" method="POST" class="login-form login-register">
                                <p class="login-text">Gebruikersnaam</p>
                                <input name="username" class="login-input" type="text">
                                <p class="login-text">Voornaam</p>
                                <input name="firstname" class="login-input" type="text">
                                <p class="login-text">Achternaam</p>
                                <input name="lastname" class="login-input" type="text">
                                <p class="login-text">Wachtwoord</p>
                                <input class="login-input" type="password">
                                <p class="login-text">Wachtwoord</p>
                                <input name="password" class="login-input" type="password">
                                <p name="password1" class="login-text">E-mail</p>
                                <input name="email" class="login-input" type="email">
                                <br>
                                <br>
                                <input name="register" class="login-submit btn btn-success" type="submit" value="Register">
                            </form>

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- change pf modal -->
            <div id="myModal2" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Profile Picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./uploadpf.php" method="post" enctype="multipart/form-data">
                                Select image to upload: <br>
                                <input type="file" name="fileToUpload" id="fileToUpload"> <br> <br>
                                <input class="btn btn-primary" type="submit" value="Upload Image" name="submit">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- change username modal -->
            <div class="modal fade" id="changeusernameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <label>username:</label>
                                <input name="changeusername" type="text" value="<?php echo "$person->userInfoUsername" ?>"></input>
                                <input name="usernamesubmit" type="submit">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- change email modal -->
            <div class="modal fade" id="changeemailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <label>email:</label>
                                <input name="changeemail" type="text" value="<?php echo "$person->userInfoEmail" ?>"></input>
                                <input name="emailsubmit" type="submit">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- change pass modal -->
            <div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <label>pass:</label>
                                <input name="changepass" type="text" value="<?php echo "**********" ?>"></input>
                                <input name="passsubmit" type="submit">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

</html>

<script>
    $(document).ready(function() {

        <?php
        //Ben je ingelogd?
        if (isset($_SESSION["user"])) {
        ?>

            //Login knop 
            $('#login_logout').attr('data-target', '').attr('href', './logout.php');
            $('#login_logout').attr('data-toggle', '').attr('href', './logout.php');
            $("#login_logout").html("Log uit");

            $('#register_button').hide();


            //welkom tekst voor als je bent ingelogd
            var welcometext;
            welcometext = "";
            welcometext += "<span id='welcome_text'>Welkom, <?php echo $_SESSION['user'];  ?>  </span>";

            //toevoegen aan div
            $("#place-welkom-text").append(welcometext);
        <?php
        }
        ?>

        //gebruikers page vertical nav functions
        $(function() {
            showPage = function(page) {
                //alle tabs sluiten zodat er geen dubbele open staan.
                $('#profile-page').hide();
                $('#voorspellingen-page').hide();
                $('#statistieken-page').hide();
                $('#beveiliging-page').hide();

                //Id van de page uit de button data attribute halen.
                $id = $(page).attr('data');
                //De page openen die bij de geklikte button hoort.
                $('#' + $id).show();
            };
        });

    });
</script>