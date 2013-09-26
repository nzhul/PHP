<?php 
session_start();
if (!isset($_SESSION['isLogged'])) {
    header('Location: login.php');
    exit;
}
?>
<?php
require 'inc/header.php';
?>
<div id="navigation">
    <ul id="menu">
        <li><input type="file" name="upload" /></li>
        <li><a href="#">Filter</a>
            <ul class="sub-menu">
                <li><a href="index.php">All</a></li>
                <li><a href="#">asd</a></li>
                <li><a href="#">asd</a></li>
                <li><a href="#">asd</a></li>
            </ul>
        </li>
        <li style="float: right;"><a href="logout.php">LO</a></li>
        <li style="float: right;"><a href="#">Hello, <?= $_SESSION['username'] ?></a></li>
    </ul>
</div>
<table>
    <tr>
        <td>№</td>
        <td>Name</td>
        <td>Type</td>
        <td>Date</td>
        <td>Del</td>
    </tr>
    <?php 
    $dirContent = scandir('userFolders/'.$_SESSION['username']);
    foreach ($dirContent as $key => $value) {
        echo $value.';  ';
    }
    ?>
    <tr>
        <td>1.</td>
        <td><a href="#">This is really long file name and so on asd s s s  s s .pdf</a></td>
        <td>asd</td>
        <td>22.22.2013</td>
        <td><a class="btn del" title="Delete" href="#">del</a></td>
    </tr>
    <tr>
        <td>2.</td>
        <td><a href="#">This is really long file name and so on asd s s s  s s .pdf</a></td>
        <td>asd</td>
        <td>22.22.2013</td>
        <td><a class="btn del" title="Delete" href="#">del</a></td>
    </tr>
    
    <tr>
        <td>№</td>
        <td>asd</td>
        <td>ICO</td>
        <td>Date</td>
        <td>DL</td>
    </tr>
</table>

<?php
include 'inc/footer.php';
?>