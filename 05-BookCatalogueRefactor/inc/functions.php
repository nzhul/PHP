<?php

function getAllAuthors($link) {
    $sql = 'SELECT * FROM authors';
    $result = mysqli_query($link, $sql);
    return $result;
}

function errorDisplay() {
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
    } else if (isset($_GET['succreg'])) {
        echo '<table><tr><td style="color: #93c72e;">';
        echo 'Welcome to the Book Catalogue ' . $_SESSION['username'] . '!';
        echo '</td></tr></table>';
    }
}

function getBooksAndAuthors($link, $sqlSearch, $sortSql) {
    $sql = 'SELECT * FROM books 
            LEFT JOIN books_authors 
            ON books.book_id = books_authors.book_id
            LEFT JOIN authors 
            ON books_authors.author_id = authors.author_id
            ' . $sqlSearch . '
            ORDER BY book_title ' . $sortSql;
    $result = mysqli_query($link, $sql);
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[$row['book_id']]['book_title'] = $row['book_title'];
            $data[$row['book_id']]['comments_count'] = $row['comments_count'];
            $data[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
        }
        return $data;
    } else {
        $data = 0;
        return $data;
    }
}

function getAuthorsOfBook($link) {
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
}

?>
