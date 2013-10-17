<?php
require './inc/config.php';
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
    $usernameField = '<li><a href="user.php?id=' . $_SESSION['user_id'] . '">Hello, <span style="color: #93c72e;">' . $_SESSION['username'] . '</span> (' . $_SESSION['comments_count'] . ')</a></li>
        <li><a href="logout.php">Logout</a></li>';
} else {
    $usernameField = '<li><a href="login.php">Login</a></li>';
}
?>
<div class="navigation" style="text-align: right;">
    <ul id="menu">
        <li style="float: left;"><a href="index.php" id="addBook">All Books</a></li>
        <?= $usernameField; ?>
    </ul>
</div>
<table>
    <tr>
        <td colspan="2"><span class="sum"><?= $row['book_title'] . ' [' . $row['comments_count'] . ']' ?></span></td>
    </tr>
    <tr>
        <td><img src="img/book.png" style="width: 300px;"/></td>
        <td style="vertical-align: top;"><span class="sum">Description of the book:</span><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Integer sed metus fringilla, viverra justo sed, auctor est. 
            Vestibulum aliquet, leo sit amet rutrum tincidunt, lectus dolor suscipit elit,
            id vulputate purus quam eget dolor. Vivamus mattis nulla sit amet orci imperdiet 
            gravida. Curabitur tincidunt nulla sapien, a gravida purus ultrices commodo. 
            Morbi feugiat nisi sit amet purus accumsan facilisis ac malesuada magna. 
            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia 
            Curae; Morbi pharetra rhoncus odio id suscipit.</td>
    </tr>
    <tr>
        <td colspan="2"><span class="sum">Authors:</span>
            <?php
            $sql = 'SELECT authors.author_id, authors.author_name FROM authors 
                    LEFT JOIN books_authors 
                    ON authors.author_id = books_authors.author_id
                    LEFT JOIN books 
                    ON books_authors.book_id = books.book_id
                    WHERE books.book_id=' . (int) $_GET['id'];
            $result = mysqli_query($link, $sql);
            $rowCount = $result->num_rows;
            $loopCount = 1;
            while ($row = $result->fetch_assoc()) {
                if ($loopCount == $rowCount) {
                    $divider = '';
                } else {
                    $divider = ' | ';
                }
                echo '<a href="author.php?id=' . $row['author_id'] . '">' . $row['author_name'] . '</a>' . $divider;
                $loopCount++;
            }
            ?>
        </td>
    </tr>
</table>
<?php
if (isset($_GET['err']) && $_GET['err'] == 1 && isset($_SESSION['msg_err_array'])) {
    echo '<table><tr><td style="color: #ff491f;">';
    foreach ($_SESSION['msg_err_array'] as $v) {
        echo $v . '<br/>';
    }
    echo '</td></tr></table>';
}
?>
<?php
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
