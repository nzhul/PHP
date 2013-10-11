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
    <?php
    $sql = 'SELECT * FROM books 
            LEFT JOIN books_authors 
            ON books.book_id = books_authors.book_id
            LEFT JOIN authors 
            ON books_authors.author_id = authors.author_id';
    $result = mysqli_query($link, $sql);
    if ($result->num_rows > 0) {
        $reArrange = array();
        while ($row = $result->fetch_assoc()) {
            $reArrange[$row['book_id']]['book_title'] = $row['book_title'];
            $reArrange[$row['book_id']]['authors'][] = $row['author_name'];
            /*echo '<tr>
        <td><pre>'.print_r($reArrange, true).'</pre></td>
        <td></td>
    </tr>';*/
        }
        foreach ($reArrange as $value) {
            echo '<tr><td>'.$reArrange['book_title'].'</td><td>';
            foreach ($value['authors'] as $value2)
            {
             echo $value2.', ';   
            }
            echo '</td></tr>';
        }
    }
    ?>
    <tr>
        <td class="sum">Book</td>
        <td class="sum">Authors</td>
    </tr>
</table>

<?php
include 'inc/footer.php';
?>