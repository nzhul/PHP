<?php
require '../inc/cfg.php';


//get the posted values
$username = mysql_real_escape_string(htmlspecialchars(trim($_POST['username']), ENT_QUOTES));
$pass = md5($_POST['password']);

//now validating the username and password
$sql = "SELECT username,password FROM users WHERE username='" . $username . "'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

//if username exists sUp3r@park3ti
if (mysql_num_rows($result) > 0) {
    //compare the password
    if (strcmp($row['password'], $pass) == 0) {
        
        $_SESSION['username'] = $username;
        $_SESSION['is_logged'] = true;
        redirect('index.php?succ_login=1');
    }
    else {
        redirect('index.php?err=1');
        }
}
else {
redirect('index.php?err=1');
}

?>