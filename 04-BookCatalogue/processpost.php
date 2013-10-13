<?php
require 'inc/config.php';
if (isset($_POST['postAuthor'])) {
    $author = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['authorName'])));
    if (mb_strlen($author, 'UTF-8') < 3) {
        $error_array['author_short'] = 'The author name is too short';
    }
    if (mb_strlen($author, 'UTF-8') > 30) {
        $error_array['author_long'] = 'The author name is too long';
    }
    if (!preg_match('/^[a-z\d\s\._]{3,30}$/i', $author)) {
        $error_array['author_invalid'] = 'Invalid Author Name';
    }
    if (!isset($error_array)) {
        $sql = 'SELECT author_id FROM authors WHERE author_name="' . $author . '"';
        $result = mysqli_query($link, $sql);
        if ($result->num_rows > 0) {
            $error_array['authorExists'] = 'Author already Exists!';
        }
    }

    if (!isset($error_array)) {
        $sql = 'INSERT INTO authors (author_id, author_name) VALUES (NULL,"' . $author . '")';
        if (mysqli_query($link, $sql)) {
            header('Location: index.php?succAuthor=1');
            exit;
        } else {
            $error_array = mysqli_error($link);
            $_SESSION['msg_err_array'] = $error_array;
            header('Location: index.php?err=1');
            exit;
        }
    } else {
        // send back the error_array
        $_SESSION['msg_err_array'] = $error_array;
        header('Location: index.php?err=1');
        exit;
    }
}

if (isset($_POST['postBook'])) {
    $bookTitle = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['bookTitle'])));
    if (!isset($_POST['authors'])) {
        $error_array['noAuthorsSelected'] = 'Please select atleast one author!';
        $_SESSION['msg_err_array'] = $error_array;
        header('Location: index.php?err=1');
    } else {
        $authors = $_POST['authors'];
    }
    if (mb_strlen($bookTitle, 'UTF-8') < 3) {
        $error_array['book_short'] = 'The book title is too short';
    }
    if (mb_strlen($bookTitle, 'UTF-8') > 30) {
        $error_array['book_long'] = 'The book title is too long';
    }
    if (!preg_match('/^[a-z\d\s\._]{3,30}$/i', $bookTitle)) {
        $error_array['book_invalid'] = 'Invalid Book Name';
    }
    if (!isset($error_array)) {
        $sql = 'SELECT book_id FROM books WHERE book_title="' . $bookTitle . '"';
        $result = mysqli_query($link, $sql);
        if ($result->num_rows > 0) {
            $error_array['bookExists'] = 'Book already Exists!';
        }
    }

    if (!isset($error_array)) {
        $sql = 'INSERT INTO books (book_id, book_title) VALUES (NULL,"' . $bookTitle . '")';
        if (mysqli_query($link, $sql)) {
            $valuesBuilder = '';
            for ($i = 0; $i < count($authors); $i++) {
                if ($i == count($authors) - 1) {
                    $comma = '';
                } else {
                    $comma = ', ';
                }
                $valuesBuilder .= '(' . mysqli_insert_id($link) . ', ' . $authors[$i] . ')' . $comma;
            }
            $sql2 = 'INSERT INTO books_authors (book_id, author_id) VALUES ' . $valuesBuilder;
            if (mysqli_query($link, $sql2)) {
                header('Location: index.php');
                exit;
            }
        } else {
            $error_array = mysqli_error($link);
            $_SESSION['msg_err_array'] = $error_array;
            header('Location: index.php?err=1');
            exit;
        }
    } else {
        // send back the error_array
        $_SESSION['msg_err_array'] = $error_array;
        header('Location: index.php?err=1');
        exit;
    }
}
?>
