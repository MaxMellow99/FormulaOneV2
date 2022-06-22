<?php
    require_once "admincheck.php";



?>
<!DOCTYPE html>
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
                <li class="admin-backend" class="nav-item" <?php if($person->userInfoAdmin == 1) { echo "style='display: block;' ";} ?> >
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
</html>