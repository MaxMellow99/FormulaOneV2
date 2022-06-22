<?php
session_start();

require_once "managers/personmanager.php";
require_once "managers/standingmanager.php";


//als je bent ingelogd.
if (isset($_SESSION['id'])) {
    $personmanager = new personmanager();
    $person = $personmanager->getAllById($_SESSION['id']);
}


//Haalt het huidige path op.
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['url'] = substr_replace($url, "", -1) . "\n";

//Haalt de huidige tussenstand op.
$standingmanager = new standingmanager();
$standings = $standingmanager->getAllStandings();

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
                    <a href="#" class="nav-link">Voorspellen</a>
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
    <div id="body-container">
        <h1 id="h1-text-home" class="text-light text-center font-weight-bold">Tussenstand</h1>
        <div class="rounded mx-auto d-block" id="top-3-drivers">


            <div class="top-drivers-container" id="second-place-container">
                <h4 class="driver-pf-names"><?php echo $standings[1]->driverFirstname . ' '  . $standings[1]->driverLastname; ?></h4>
                <img class="img-fit" src="./images/driverimages/<?php echo $standings[1]->driverPicture; ?>"></img>
            </div>



            <div class="top-drivers-container" id="third-place-container">
                <h4 class="driver-pf-names"><?php echo $standings[2]->driverFirstname . ' '  .  $standings[2]->driverLastname; ?></h4>
                <img class="img-fit" src="./images/driverimages/<?php echo $standings[2]->driverPicture; ?>"></img>
            </div>

            <div>
                <h4 class="driver-pf-names"><?php echo $standings[0]->driverFirstname . ' '  . $standings[0]->driverLastname; ?></h4>

                <div class="top-drivers-container" id="first-place-container">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[0]->driverPicture; ?>"></img>
                </div>
            </div>
            <img id="winner-podium-home" src="./images/winner-podium.svg">
        </div>


        <div class="row">
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#4</h3>
                <h1 class="rest-driver-names"><?php echo $standings[3]->driverFirstname . ' '  . $standings[3]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[3]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#5</h3>
                <h1 class="rest-driver-names"><?php echo $standings[4]->driverFirstname . ' '  . $standings[4]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[4]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#6</h3>
                <h1 class="rest-driver-names"><?php echo $standings[5]->driverFirstname . ' '  . $standings[5]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[5]->driverPicture; ?>"></img>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#7</h3>
                <h1 class="rest-driver-names"><?php echo $standings[6]->driverFirstname . ' '  . $standings[6]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[6]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#8</h3>
                <h1 class="rest-driver-names"><?php echo $standings[7]->driverFirstname . ' '  . $standings[7]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[7]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#9</h3>
                <h1 class="rest-driver-names"><?php echo $standings[8]->driverFirstname . ' '  . $standings[8]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[8]->driverPicture; ?>"></img>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#10</h3>
                <h1 class="rest-driver-names"><?php echo $standings[9]->driverFirstname . ' '  . $standings[9]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[9]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#11</h3>
                <h1 class="rest-driver-names"><?php echo $standings[10]->driverFirstname . ' '  . $standings[10]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[10]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#12</h3>
                <h1 class="rest-driver-names"><?php echo $standings[11]->driverFirstname . ' '  . $standings[11]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[11]->driverPicture; ?>"></img>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#13</h3>
                <h1 class="rest-driver-names"><?php echo $standings[12]->driverFirstname . ' '  . $standings[12]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[12]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#14</h3>
                <h1 class="rest-driver-names"><?php echo $standings[13]->driverFirstname . ' '  . $standings[13]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[13]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#15</h3>
                <h1 class="rest-driver-names"><?php echo $standings[14]->driverFirstname . ' '  . $standings[14]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[14]->driverPicture; ?>"></img>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#16</h3>
                <h1 class="rest-driver-names"><?php echo $standings[15]->driverFirstname . ' '  . $standings[15]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[15]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#17</h3>
                <h1 class="rest-driver-names"><?php echo $standings[16]->driverFirstname . ' '  . $standings[16]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[16]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#18</h3>
                <h1 class="rest-driver-names"><?php echo $standings[17]->driverFirstname . ' '  . $standings[17]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[17]->driverPicture; ?>"></img>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#19</h3>
                <h1 class="rest-driver-names"><?php echo $standings[18]->driverFirstname . ' '  . $standings[18]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[18]->driverPicture; ?>"></img>
                </div>
            </div>
            <div class="col-4 col-md-4">
                <h3 class="rest-driver-names">#20</h3>
                <h1 class="rest-driver-names"><?php echo $standings[19]->driverFirstname . ' '  . $standings[19]->driverLastname; ?></h1>
                <div class="rest-driver-imgs">
                    <img class="img-fit" src="./images/driverimages/<?php echo $standings[19]->driverPicture; ?>"></img>
                </div>
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
        </div>
    </div>

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