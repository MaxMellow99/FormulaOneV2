<?php
    require_once "database.php";
    require_once "managers/UserManager.php";

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
        <title>Update User - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <form method="Post">
            Username: <input type="text" name="username" value="<?php echo $user->userInfoUsername ?>"><br>
            Firstname: <input type="text" name="firstname" value="<?php echo $user->userInfoFirstname ?>"><br>
            Lastname: <input type="text" name="lastname" value="<?php echo $user->userInfoLastname ?>"><br>
            Email: <input type="email" name="email" value="<?php echo $user->userInfoEmail ?>"><br>
            Is Admin: <input type="number" name="isadmin" value="<?php echo $user->userInfoAdmin ?>" max="1"><br>
            Activation Code: <input type="text" name="activation" value="<?php echo $user->userActivationCode ?>"><br>
            Is Active: <input type="number" name="isactive" value="<?php echo $user->userIsActive ?>" max="1"><br>
            Profile Picture: <input type="file" name="image"><br>
            <input type="submit" value="Update"><br>
            <a href="admin.php">Cancel</a>
        </form>
    </body>
</html>
