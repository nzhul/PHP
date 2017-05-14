<table>
    <tr>
        <td class="sum">Book</td>
        <td class="sum">Authors</td>
    </tr>
    <?php
    $data = getBooksAndAuthors($link, $sqlSearch, $sqlSearch);
    include './templates/books_table.php';
    ?>
    <tr>
        <td class="sum">Book</td>
        <td class="sum">Authors</td>
    </tr>
</table>