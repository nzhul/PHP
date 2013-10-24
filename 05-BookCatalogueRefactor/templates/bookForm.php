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
                    $result = getAllAuthors($link);
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