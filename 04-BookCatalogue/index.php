<?php
require 'inc/config.php';
require 'inc/header.php';
?>
<div id="navigation">
    <ul id="menu">
        <li><a href="#" id="addMSG">Add Book</a></li>
        <li><a href="index.php">Filter</a>
            <ul class="sub-menu">
                <li><a href="#">asd</a></li>
                <li><a href="#">asd</a></li>
                <li><a href="#">asd</a></li>
            </ul>
        </li>
    </ul>
</div>
<form action="processpost.php" method="POST">
    <table id="postField">
        <tr>
            <td><label for="title">Book Title</label></td>
            <td><input type="text" name="title" id="title" value="" style="width: 400px;" /></td>
        </tr>
        <tr>
            <td><label for="cat">Category</label></td>
            <td>
                <select name="cat" multiple="">
                    <option value="#">dfg1</option>
                    <option value="#">dfg2</option>
                    <option value="#">dfg3</option>
                    <option value="#">dfg4</option>
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
                <input type="submit" name="postBook" value="POST"/>
            </td>
        </tr>
    </table>
</form>
<form action="processpost.php" method="POST">
    <table id="postField">
        <tr>
            <td><label for="title">Author</label></td>
            <td><input type="text" name="title" id="title" value="" style="width: 400px;" /></td>
        </tr>
        <tr>
            <td><label for="cat">Category</label></td>
            <td>
                <select name="cat" multiple="">
                    <option value="#">dfg1</option>
                    <option value="#">dfg2</option>
                    <option value="#">dfg3</option>
                    <option value="#">dfg4</option>
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
                <input type="submit" name="postAuthor" value="POST"/>
            </td>
        </tr>
    </table>
</form>
<table>
    <tr>
        <td class="sum">Book</td>
        <td class="sum">Authors</td>
    </tr>
    <tr>
        <td>The Color of the magic</td>
        <td>Terry Pratchet, Neel Grayman, And So on And So on The list goes on and on and on</td>
    </tr>
    <tr>
        <td>The Color of the magic</td>
        <td>Terry Pratchet, Neel Grayman, And So on And So on The list goes on and on and on</td>
    </tr>
    <tr>
        <td>The Color of the magic</td>
        <td>Terry Pratchet, Neel Grayman, And So on And So on The list goes on and on and on</td>
    </tr>
    <tr>
        <td class="sum">Book</td>
        <td class="sum">Authors</td>
    </tr>
</table>

<?php
include 'inc/footer.php';
?>