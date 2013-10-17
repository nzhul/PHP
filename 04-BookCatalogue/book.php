<?php
require './inc/config.php';
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
        <td colspan="2"><span class="sum">Book Name</span></td>
    </tr>
    <tr>
        <td><img src="img/bookoftyrael.jpg" style="width: 300px;"/></td>
        <td style="vertical-align: top;"><span class="sum">Description of the book:</span><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Integer sed metus fringilla, viverra justo sed, auctor est. 
            Vestibulum aliquet, leo sit amet rutrum tincidunt, lectus dolor suscipit elit,
            id vulputate purus quam eget dolor. Vivamus mattis nulla sit amet orci imperdiet 
            gravida. Curabitur tincidunt nulla sapien, a gravida purus ultrices commodo. 
            Morbi feugiat nisi sit amet purus accumsan facilisis ac malesuada magna. 
            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia 
            Curae; Morbi pharetra rhoncus odio id suscipit. Sed nec nibh sed sem tincidunt 
            fringilla ut nec enim. Ut placerat placerat accumsan. Proin sollicitudin convallis 
            pharetra. Sed felis eros, dapibus tristique dignissim in, laoreet non ligula. 
            Donec commodo justo et nibh interdum, in aliquet metus viverra.</td>
    </tr>
    <tr>
        <td colspan="2"><span class="sum">Authors:</span> <a href="author.php?id=1">Автор1</a>, <a href="author.php?id=1">Автор2</a> </td>
    </tr>
</table>
<table>
    <tr>
        <td style="color: #ffc000; text-align: center;">The book doesn't have any comments yet<br/><a href="login.php">Write the first one!<br/>Login</a></td>
    </tr>
</table>
<table>
    <tr>
        <td>1. <a href="user.php?id=1">Username</a> | 25.09.2013 - 04:52:27 PM</td>
    </tr>
    <tr>
        <td>Integer sed metus fringilla, viverra justo sed, auctor est. 
            Vestibulum aliquet, leo sit amet rutrum tincidunt, lectus dolor suscipit elit,
            id vulputate purus quam eget dolor.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td>1. <a href="user.php?id=1">Username</a> | 25.09.2013 - 04:52:27 PM</td>
    </tr>
    <tr>
        <td>Integer sed metus fringilla, viverra justo sed, auctor est. 
            Vestibulum aliquet, leo sit amet rutrum tincidunt, lectus dolor suscipit elit,
            id vulputate purus quam eget dolor.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td>1. <a href="user.php?id=1">Username</a> | 25.09.2013 - 04:52:27 PM</td>
    </tr>
    <tr>
        <td>Integer sed metus fringilla, viverra justo sed, auctor est. 
            Vestibulum aliquet, leo sit amet rutrum tincidunt, lectus dolor suscipit elit,
            id vulputate purus quam eget dolor.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td>1. <a href="user.php?id=1">Username</a> | 25.09.2013 - 04:52:27 PM</td>
    </tr>
    <tr>
        <td>Integer sed metus fringilla, viverra justo sed, auctor est. 
            Vestibulum aliquet, leo sit amet rutrum tincidunt, lectus dolor suscipit elit,
            id vulputate purus quam eget dolor.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
<table>
    <tr>
        <td>Write a comment:</td>
    </tr>
    <tr>
        <td><textarea></textarea></td>
    </tr>
    <tr>
        <td><input type="submit" name="postComment" value="Comment"/></td></tr>
</table>
<table>
    <tr>
        <td style="color: #ffc000; text-align: center;"><a href="login.php">To write a comment<br/>Please Login!</a></td>
    </tr>
</table>
<?php
include './inc/footer.php';
?>
