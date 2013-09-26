<?php 
session_start();
if (isset($_SESSION['isLogged'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['login'])) {
    $username = addslashes(trim($_POST['username']));
    $password = md5($_POST['password']);
    $usersList = file('database/users.txt');
    for ($i = 0; $i < count($usersList); $i++) {
        if (substr_count($usersList[$i], $username)) {
            // This user exists
            $splitedRow = explode('|', $usersList[$i]);
            if ($splitedRow[1] == $password) {
                // Successful Login
                $_SESSION['isLogged'] = true;
                $_SESSION['username'] = $username;
                header('Location: index.php');
            }
            else
            {
                $error_array['passwordDoesntMatch'] = 'Wrong Password!';
            }
            break;
        }
        else
        {
            $error_array['userDontExists'] = "Username doesn't exists!";
        }
    }
}
?>
<?php
require 'inc/header.php';
?>
<div id="navigation" style="width: 350px;">
    <ul id="menu" >
        <li>
            <a href="register.php">You don't have account ? Register Here!</a>
        </li>
    </ul>
</div>
<div id="add">
    <form action="login.php" method="POST">
        <table style="width: 350px;">
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" name="username" id="username" value="" /></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password" value="" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="login" value="Enter"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
include 'inc/footer.php';
?>