<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'msgboard');
mysqli_query($link, 'SET NAMES utf8');
?>