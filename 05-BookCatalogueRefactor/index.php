<?php
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/header.php';
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'asc') {
        $sortSql = 'asc';
        $sortFix = 'desc';
    } else if ($_GET['sort'] == 'desc') {
        $sortSql = 'desc';
        $sortFix = 'asc';
    }
} else {
    $sortSql = 'asc';
    $sortFix = 'desc';
}
if (isset($_POST['postSearch'])) {
    $key = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['searchKey'])));
    $sqlSearch = 'WHERE book_title LIKE "%' . $key . '%"';
} else {
    $sqlSearch = '';
}

if (isset($_SESSION['username'])) {
    $usernameField = '<li><a href="user.php?id=' . $_SESSION['user_id'] . '">Hello, <span style="color: #93c72e;">
    ' . $_SESSION['username'] . '</span> (' . $_SESSION['comments_count'] . ')</a></li>
        <li><a href="logout.php">Logout</a></li>';
} else {
    $usernameField = '<li><a href="login.php">Login</a></li>';
}
include './templates/userRow.php';
include './templates/navigation.php';
include './templates/bookForm.php';
include './templates/authorForm.php';
errorDisplay();
include './templates/booksTable.php';
include 'inc/footer.php';