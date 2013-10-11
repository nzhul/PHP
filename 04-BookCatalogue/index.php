<?php
require 'inc/config.php';
require 'inc/header.php';
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'asc') {
        $sortSql = 'asc';
        $sortFix = 'desc';
    } else if ($_GET['sort'] == 'desc') {
        $sortSql = 'desc';
        $sortFix = 'asc';
    }
} else {
    $sortSql = 'asc';
    $sortFix = 'desc';
}

if (isset($_POST['postSearch'])) {
    $key = htmlspecialchars(mysql_real_escape_string(trim($_POST['searchKey'])));
    $sqlSearch = 'WHERE book_title LIKE "%' . $key . '%"';
} else {
    $sqlSearch = '';
}
?>
<div id="navigation">
    <ul id="menu">
        <li><a href="#" id="addBook">Add Book</a></li>
        <li><a href="#" id="addAuthor">Add Author</a></li>
        <li><a href="index.php?sort=<?= $sortFix ?>">Sort</a>
        </li>
    </ul>
    <form action="index.php" method="POST">
        <input type="submit" name="postSearch" value="Search Book" id="postSearch"/>
        <input type="text" name="searchKey" id="searchKey"/>
    </form>
</div>
<form action="processpost.php" method="POST">
    <table id="postBook">
        <tr>
            <td><label for="title">Book Title</label></td>
            <td><input type="text" name="bookTitle" id="title" value="" style="width: 400px;" /></td>
        </tr>
        <tr>
            <td><label for="aut">Authors</label></td>
            <td>
                <select name="authors[]" multiple="multiple">
                    <?php
                    $sql = 'SELECT * FROM authors';
                    $result = mysqli_query($link, $sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['author_id'] . '">' . $row['author_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="postBook" value="Add Book"/>
            </td>
        </tr>
    </table>
</form>
<form action="processpost.php" method="POST">
    <table id="postAuthor">
        <tr>
            <td><label for="title">Author</label></td>
            <td><input type="text" name="authorName" id="title" value="" style="width: 400px;" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" name="postAuthor" style="width: 80px;" value="Add Author"/>
            </td>
        </tr>
    </table>
</form>
<?php
if (isset($_GET['err']) && $_GET['err'] == 1 && isset($_SESSION['msg_err_array'])) {
    echo '<table><tr><td style="color: #ff491f;">';
    foreach ($_SESSION['msg_err_array'] as $v) {
        echo $v . '<br/>';
    }
    echo '</td></tr></table>';
} else if (isset($_GET['succAuthor'])) {
    echo '<table><tr><td style="color: #93c72e;">';
    echo 'The Author has been added!';
    echo '</td></tr></table>';
}
?>
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
            ON books_authors.author_id = authors.author_id
            ' . $sqlSearch . '
            ORDER BY book_title ' . $sortSql;
    $result = mysqli_query($link, $sql);
    if ($result->num_rows > 0) {
        $reArrange = array();
        while ($row = $result->fetch_assoc()) {
            $reArrange[$row['book_id']]['book_title'] = $row['book_title'];
            $reArrange[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
        }
        /* echo '<tr>
          <td><pre>'.print_r($reArrange, true).'</pre></td>
          <td></td>
          </tr>'; */
        foreach ($reArrange as $book) {
            echo '<tr><td>' . $book['book_title'] . '</td><td>';
            $authorsCount = count($book['authors']);
            $commaCounter = 1;
            foreach ($book['authors'] as $key => $author) {
                if ($commaCounter == $authorsCount) {
                    $comma = '';
                } else {
                    $comma = ', ';
                }
                echo '<a href="author.php?id=' . $key . '">' . $author . '</a>' . $comma;
                $commaCounter++;
            }
            echo '</td></tr>';
        }
    } else {
        echo '<tr><td style="color: #ffc000;" colspan="2">';
        echo 'The Search doesn\'t give any results!';
        echo '</td></tr>';
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