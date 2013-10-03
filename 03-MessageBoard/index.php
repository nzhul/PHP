<?php
require 'inc/config.php';
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
<form action="processmsg.php">
    <table id="postField">
        <tr>
            <td><label for="title">Title</label></td>
            <td><input type="text" name="title" id="title" value="" style="width: 400px;" /></td>
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
<?php
$sql = 'SELECT u.username,m.msg_id,m.title,m.content,m.date_added, c.cname 
        FROM msg as m, users as u, cat as c
        WHERE m.author_id = u.user_id AND c.cat_id = m.cat_id
        ORDER BY m.date_added DESC';
$result = mysqli_query($link, $sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $real_date = date('d/m/Y', $row['date_added']);
        echo '<table>
    <tr>
        <td>' . $row['msg_id'] . '. ' . $row['title'] . '</td>
    </tr>
    <tr>
        <td>' . $row['content'] . '</td>
    </tr>
    <tr>
        <td>от ' . $row['username'] . '; ' . $real_date . '; ' . $row['cname'] . '</td>
    </tr>
</table>';
    }
}
?>

<?php
include 'inc/footer.php';
?>