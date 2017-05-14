<?php
require './inc/config.php';
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
} else {
    $sql = 'SELECT * FROM users WHERE user_id=' . (int) $_GET['id'];
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
    $usernameField = '<li><a href="user.php?id=' . $_SESSION['user_id'] . '">Hello, <span style="color: #93c72e;">' . $_SESSION['username'] . '</span> (' . $_SESSION['comments_count'] . ')</a></li>
        <li><a href="logout.php">Logout</a></li>';
} else {
    $usernameField = '<li><a href="login.php">Login</a></li>';
}
?>
<div class="navigation" style="text-align: right;">
    <ul id="menu">
        <li style="float: left;"><a href="index.php" id="addBook">All Books</a></li>
        <!--<li style="float: left;"><a href="users.php" id="addBook">All Users</a></li>-->
        <?= $usernameField; ?>
    </ul>
</div>

<table>
    <tr>
        <td colspan="2"><span class="sum">User: <a href="?id=<?= $row['user_id'] ?>"><?= $row['username'] . '</a> [' . $row['comments_count'] . ']' ?></span></td>
    </tr>
    <tr>
        <td><img src="img/user.png" style="width: 300px;"/></td>
        <td style="vertical-align: top;"><span class="sum">Information about the user:</span><br/>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.

        </td>
    </tr>
    <tr>
        <td colspan="2"><span class="sum">Social Media links or other stuff: </span>
        </td>
    </tr>
</table>
<?php
$sql = 'SELECT comments.comment, comments.date_added, books.book_id, books.book_title, users.user_id, users.username 
        FROM comments
        LEFT JOIN users
        ON comments.author_id = users.user_id
        LEFT JOIN books
        ON comments.book_id = books.book_id
        WHERE users.user_id =' . (int) $_GET['id'];
$result = mysqli_query($link, $sql);
if ($result->num_rows <= 0) {
    echo '<table>
        <tr>
            <td style="color: #ffc000; text-align: center;">' . $row['username'] . ' does not have any comments yet</td>
        </tr>
    </table>';
} else {
    $counter = 1;
    echo '<table>
        <tr>
            <td style="color: #ffc000; text-align: center;">' . $row['username'] . ' Comments:</td>
        </tr>
    </table>';
    while ($row = $result->fetch_assoc()) {
        $real_date = date('d/m/Y \- h:i:s A', $row['date_added']);
        echo '<table>
    <tr>
        <td>' . $counter . '. <a href="user.php?id=' . $row['user_id'] . '">' . $row['username'] . '</a> | ' . $real_date . '</td>
    </tr>
    <tr>
        <td>' . $row['comment'] . '</td>
    </tr>
    <tr>
        <td>on Book: <a href="book.php?id=' . $row['book_id'] . '">' . $row['book_title'] . '</a></td>
    </tr>
</table>';
        $counter++;
    }
}
?>