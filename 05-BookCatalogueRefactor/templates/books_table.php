<?php
    if ($data != 0) {
        foreach ($data as $key => $book) {
            echo '<tr><td><a href="book.php?id=' . $key . '">' . $book['book_title'] . '</a>
                [<span style="color:white;">' . $book['comments_count'] . '</span>]</td><td>';
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