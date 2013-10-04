<?php

require 'inc/config.php';
if (!isset($_SESSION['isLogged'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['postmsg'])) {
    $title = mysqli_real_escape_string($link, trim($_POST['title']));
    $content = mysqli_real_escape_string($link, trim($_POST['content']));
    $cat = (int) $_POST['cat'];
    if (mb_strlen($title, 'UTF-8') < 3) {
        $error_array['title_short'] = 'The title is too short';
    }
    if (mb_strlen($title, 'UTF-8') > 50) {
        $error_array['title_long'] = 'The title is too long';
    }
    if (mb_strlen($content, 'UTF-8') < 3) {
        $error_array['content_short'] = 'The content is too short';
    }
    if (mb_strlen($content, 'UTF-8') > 250) {
        $error_array['content_long'] = 'The content is too long';
    }
    if (!isset($error_array)) {
        $sql = 'SELECT cat_id from cat WHERE cat_id=' . $cat;
        $result = mysqli_query($link, $sql);
        if ($result->num_rows <= 0) {
            $err_array['invalid_cat'] = 'Invalid category';
        }
    }

    if (!isset($error_array)) {
        // record the message 
        $sql = 'INSERT INTO msg (msg_id, author_id, cat_id, date_added, title, content) VALUES (NULL, ' . $_SESSION['user_id'] . ', ' . $cat . ', ' . time() . ', "' . $title . '", "' . $content . '");';
        if (mysqli_query($link, $sql)) {
            header('Location: index.php');
            exit;
        } else {
            $err_array['mysql error'] = mysql_error();
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
