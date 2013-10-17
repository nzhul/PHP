<?php
if (!isset($_GET['id']) || !((int) $_GET['id'] > 0)) {
    header('Location: index.php');
    exit;
}
require 'inc/config.php';
require 'inc/header.php';
?>
<div class="navigation">
    <ul id="menu">
        <li><a href="index.php">Books List</a></li>
        </li>
    </ul>
</div>
<?php
$sql = 'SELECT * FROM authors
        WHERE author_id =' . (int) $_GET['id'];
$result = mysqli_query($link, $sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <table>
        <tr>
            <td><span class="sum">Author:</span> <a href="?id=<?= $row['author_id'] ?>"><?= $row['author_name'] ?></a></td>
        </tr>
    </table>
    <table>
        <tr>
        <td><img src="img/author.png" style="width: 300px;"/></td>
        <td style="vertical-align: top;"><span class="sum">Information about the author:</span><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Integer sed metus fringilla, viverra justo sed, auctor est. 
            Vestibulum aliquet, leo sit amet rutrum tincidunt, lectus dolor suscipit elit,
            id vulputate purus quam eget dolor. Vivamus mattis nulla sit amet orci imperdiet 
            gravida. Curabitur tincidunt nulla sapien, a gravida purus ultrices commodo. 
            Morbi feugiat nisi sit amet purus accumsan facilisis ac malesuada magna. 
            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia 
            Curae; Morbi pharetra rhoncus odio id suscipit.</td>
        </tr>
    </table>
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
            WHERE books.book_title in (SELECT books.book_title
            FROM books
            LEFT JOIN books_authors ON books.book_id = books_authors.book_id
            LEFT JOIN authors ON authors.author_id = books_authors.author_id
            WHERE authors.author_id='.$_GET['id'].')    
            ORDER BY book_title';
        $result = mysqli_query($link, $sql);
        if ($result->num_rows > 0) {
            $reArrange = array();
            while ($row = $result->fetch_assoc()) {
                $reArrange[$row['book_id']]['book_title'] = $row['book_title'];
                $reArrange[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
            }
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
} else {
    echo '<table><tr><td style="color: #ffc000;" colspan="2">';
    echo 'There is no such author!';
    echo '</td></tr></table>';
}
?>
<?php
include 'inc/footer.php';
?>