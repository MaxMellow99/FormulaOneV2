<?php
    require_once "database.php";
    require_once "managers/UserManager.php";

    if(isset($_GET['userId'])) {
        UserManager::DeleteUser($_GET['userId']);
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Admin - Formula One</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <ul>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="driver.php">Driver</a></li>
            <li><a href="race.php">Race</a></li>
            <li><a href="result.php">Result</a></li>
            <li><a href="standing.php">Standing</a></li>
        </ul>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Is Admin</th>
                    <th>Activation Code</th>
                    <th>Is Active</th>
                    <th>Profile Picture</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach (UserManager::GetUser() as $user) {
                    echo '<tr>';
                        echo '<td>'.$user->userInfoId.'</td>';
                        echo '<td>'.$user->userInfoUsername.'</td>';
                        echo '<td>'.$user->userInfoFirstname.'</td>';
                        echo '<td>'.$user->userInfoLastname.'</td>';
                        echo '<td>'.$user->userInfoEmail.'</td>';
                        echo '<td>'.$user->userInfoAdmin.'</td>';
                        echo '<td>'.$user->userActivationCode.'</td>';
                        echo '<td>'.$user->userIsActive.'</td>';
                        echo '<td>'.$user->userProfileImg.'</td>';
                        echo '<td><a href="updateUser.php?userId='.$user->userInfoId.'">Update</a></td>';
                        echo '<td><a href="admin.php?userId='.$user->userInfoId.'">Delete</a></td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </body>
</html>
