<?php
require './inc/config.php';
require './inc/functions.php';
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
} else {
    $sql = 'SELECT * FROM books WHERE book_id=' . (int) $_GET['id'];
    $result = mysqli_query($link, $sql);
    if ($result->num_rows <= 0) {
        header('Location: index.php');
        exit;
    } else {
        $row = $result->fetch_assoc();
    }
}
require './inc/header.php';

if (isset($_SESSION['username'])) {
    $usernameField = '<li style="float: left;"><a href="index.php" id="addBook">All Books</a></li><li><a href="user.php?id=' . $_SESSION['user_id'] . 
    '">Hello, <span style="color: #93c72e;">' . $_SESSION['username'] . '</span> (' . $_SESSION['comments_count'] . ')</a></li>
        <li><a href="logout.php">Logout</a></li>';
} else {
    $usernameField = '<li><a href="login.php">Login</a></li>';
}
?>
<?php
include './templates/userRow.php';
include './templates/bookInfoTable.php';
errorDisplay();
include './templates/bookComments.php';
include './templates/commentForm.php';
include './inc/footer.php';
?>
