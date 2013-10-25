<?php
$result = getComments($link, $_GET['id']);
if ($result->num_rows <= 0) {
    ?>
    <table>
        <tr>
            <td style="color: #ffc000; text-align: center;">The book doesn't have any comments yet<br/>Write the first one!</td>
        </tr>
    </table>
    <?php
} else {
    echo '<table>
        <tr>
            <td style="color: #ffc000; text-align: center;">Comments:</td>
        </tr>
    </table>';
    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        $real_date = date('d/m/Y \- h:i:s A', $row['date_added']);
        echo '<table>
    <tr>
        <td>' . $counter . '. <a href="user.php?id=' . $row['author_id'] . '">' . $row['username'] . '</a> | ' . $real_date . '</td>
    </tr>
    <tr>
        <td>' . $row['comment'] . '</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>';
        $counter++;
    }
}
?>