<?php
require 'inc/config.php';
if (!isset($_SESSION['isLogged'])) {
    header('Location: login.php');
    exit;
}

?>
