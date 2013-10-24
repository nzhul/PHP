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

$sql = 'SELECT * FROM comments
        LEFT JOIN users
        ON comments.author_id = users.user_id
        WHERE book_id=' . (int) $_GET['id'];
$result = mysqli_query($link, $sql);
if ($result->num_rows <= 0) {
    ?>
    <table>
        <tr>
            <td style="color: #ffc000; text-align: center;">The book doesn't have any comments yet<br/>Write the first one!</td>
        </tr>
    </table>
    <?php
} else {
    echo '<table>
        <tr>
            <td style="color: #ffc000; text-align: center;">Comments:</td>
        </tr>
    </table>';
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        $real_date = date('d/m/Y \- h:i:s A', $row['date_added']);
        echo '<table>
    <tr>
        <td>' . $counter . '. <a href="user.php?id=' . $row['author_id'] . '">' . $row['username'] . '</a> | ' . $real_date . '</td>
    </tr>
    <tr>
        <td>' . $row['comment'] . '</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>';
        $counter++;
    }
}
?>
<?php if (isset($_SESSION['isLogged'])) { ?>
    <form action="processpost.php" method="POST">
        <table>
            <tr>
                <td>Write a comment:</td>
            </tr>
            <tr>
                <td><textarea name="comment"></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="postComment" value="Comment"/>
                    <input type="hidden" name="bookid" value="<?= (int) $_GET['id'] ?>"/>
                </td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <table>
        <tr>
            <td style="color: #ffc000; text-align: center;"><a href="login.php">To write a comment<br/>Please Login!</a></td>
        </tr>
    </table>  
<?php } ?>
<?php
include './inc/footer.php';
?>
