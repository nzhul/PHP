<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'books');
mysqli_query($link, 'SET NAMES utf8');
?>