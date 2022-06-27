<?php
    require_once "database.php";
    require_once "managers/UserManager.php";
    require_once "admincheck.php";

    $user = UserManager::GetSpecificUser($_GET['userId']);

    if($_POST) {
        UserManager::UpdateUser(
                $_GET['userId'],
                $_POST['username'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['isadmin'],
                $_POST['activation'],
                $_POST['isactive'],
                $_POST['image']
        );
        header('location:admin.php');
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
                            <a href="./race.php" class="nav-link">Races</a>
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
            <H1 class="text-center text-light">Updating <?php echo $user->userInfoUsername ?></H1>
        <form method="Post" class="d-flex justify-content-center">
            <div>
                <label class="text-light">Username:</label> <input class="form-control" type="text" name="username" value="<?php echo $user->userInfoUsername ?>"><br>
                <label class="text-light">Firstname:</label> <input class="form-control" type="text" name="firstname" value="<?php echo $user->userInfoFirstname ?>"><br>
                <label class="text-light">Lastname:</label> <input class="form-control" type="text" name="lastname" value="<?php echo $user->userInfoLastname ?>"><br>
                <label class="text-light">Email:</label> <input class="form-control" type="email" name="email" value="<?php echo $user->userInfoEmail ?>"><br>
                <label class="text-light">Is Admin:</label> <input class="form-control" type="number" name="isadmin" value="<?php echo $user->userInfoAdmin ?>" max="1"><br>
                <label class="text-light">Activation Code:</label> <input class="form-control" type="text" name="activation" value="<?php echo $user->userActivationCode ?>"><br>
                <label class="text-light">Is Active:</label> <input class="form-control" type="number" name="isactive" value="<?php echo $user->userIsActive ?>" max="1"><br>
                <label class="text-light">Profile Picture:</label> <input class="form-control" type="file" name="image"><br>
                <input class="btn btn-primary" type="submit" value="Update"><br><br>
                <button class="btn btn-warning"><a href="user.php">Cancel</a></button>
            </div>
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
