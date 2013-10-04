<?php
require 'inc/config.php';
if (!isset($_SESSION['isLogged'])) {
    header('Location: login.php');
    exit;
}
require 'inc/header.php';
?>
<div id="navigation">
    <ul id="menu">
        <li><a href="#" id="addMSG">Add Message</a></li>
        <li><a href="#">Filter</a>
            <ul class="sub-menu">
                <li><a href="index.php">All</a></li>
                <?php
                $sql = 'SELECT * FROM cat';
                $result = mysqli_query($link, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li><a href="index.php?c=' . $row['cat_id'] . '">' . $row['cname'] . '</a></li>';
                    }
                }
                ?>
            </ul>
        </li>
        <li style="float: right;"><a href="logout.php">Logout</a></li>
        <li style="float: right;"><a href="#">Hello, <?= $_SESSION['username'] ?></a></li>
    </ul>
</div>
<form action="processmsg.php" method="POST">
    <table id="postField">
        <tr>
            <td><label for="title">Title</label></td>
            <td><input type="text" name="title" id="title" value="" style="width: 400px;" /></td>
        </tr>
        <tr>
            <td><label for="cat">Category</label></td>
            <td>
                <select name="cat">
                    <?php
                    if ($result->num_rows > 0) {
                        $result->data_seek(0);
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['cat_id'] . '">' . $row['cname'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="content">Content</label></td>
            <td><textarea name="content" id="content"></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="postmsg" value="POST"/>
            </td>
        </tr>
    </table>
</form>
<form action="processmsg.php" method="POST">
    <table id="postCat">
        <tr>
            <td colspan="2" style="text-align: center;"><label for="title">Add New Category</label></td>
        </tr>
        <tr>
            <td><label for="title">Title</label></td>
            <td><input type="text" name="title" id="title" value="" style="width: 400px;" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="postcat" value="Add Cat"/>
            </td>
        </tr>
    </table>
</form>
<?php
if (isset($_GET['succreg'])) {
    echo '<table><tr><td style="color: #93c72e;">';
    echo 'Welcome to the MessageBoard ' . $_SESSION['username'] . '!';
    echo '</td></tr></table>';
} else if (isset($_GET['err']) && $_GET['err'] == 1 && isset($_SESSION['msg_err_array'])) {
    echo '<table><tr><td style="color: #ff491f;">';
    foreach ($_SESSION['msg_err_array'] as $v) {
        echo $v . '<br/>';
    }
    echo '</td></tr></table>';
} else if (isset($_GET['succdel'])) {
    echo '<table><tr><td style="color: #ff491f;">';
    echo 'The message was deleted!';
    echo '</td></tr></table>';
}
if ($_SESSION['power'] == 2 && isset($_GET['del'])) {
    $delID = (int) $_GET['del'];
    $sql = 'DELETE FROM msg WHERE msg_id=' . $delID;
    if (mysqli_query($link, $sql)) {
        header('Location: index.php?succdel=1');
        exit;
    }
}

if (isset($_GET['c'])) {
    $cat = (int) $_GET['c'];
    $sqlFilter = ' AND c.cat_id=' . $cat . ' ';
} else {
    $sqlFilter = '';
}
$sql = 'SELECT u.username,m.msg_id,m.title,m.content,m.date_added, c.cname, c.cat_id 
        FROM msg as m, users as u, cat as c
        WHERE m.author_id = u.user_id AND c.cat_id = m.cat_id' .
        $sqlFilter
        . ' ORDER BY m.date_added DESC';
$result = mysqli_query($link, $sql);
if ($result->num_rows > 0) {
    $counter = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
        $real_date = date('d/m/Y', $row['date_added']);
        echo '<table>
    <tr>
        <td class="sum">' . $counter . '. ' . $row['title'] . '</td>
    </tr>
    <tr>
        <td>' . $row['content'] . '</td>
    </tr>
    <tr>
        <td>от ' . $row['username'] . ' | ' . $real_date . ' | <a href="?c=' . $row['cat_id'] . '">' . $row['cname'] . '</a>';
        if ($_SESSION['power'] == 2) {
            echo '<a class="btn del" title="Delete" href="?del=' . $row['msg_id'] . '">del</a>';
        }
        echo '</td>
    </tr>
</table>';
        $counter--;
    }
}
?>

<?php
include 'inc/footer.php';
?>