<h1>TODO! - до тук съм стигнал! - 25.10.2013</h1>
<table>
    <tr>
        <td colspan="2"><span class="sum"><?= $row['book_title'] . ' [' . $row['comments_count'] . ']' ?></span></td>
    </tr>
    <tr>
        <td><img src="img/book.png" style="width: 300px;"/></td>
        <td style="vertical-align: top;"><span class="sum">Description of the book:</span><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Integer sed metus fringilla, viverra justo sed, auctor est. 
            Vestibulum aliquet, leo sit amet rutrum tincidunt, lectus dolor suscipit elit,
            id vulputate purus quam eget dolor. Vivamus mattis nulla sit amet orci imperdiet 
            gravida. Curabitur tincidunt nulla sapien, a gravida purus ultrices commodo. 
            Morbi feugiat nisi sit amet purus accumsan facilisis ac malesuada magna. 
            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia 
            Curae; Morbi pharetra rhoncus odio id suscipit.</td>
    </tr>
    <tr>
        <td colspan="2"><span class="sum">Authors:</span>
            <?php
            getAuthorsOfBook($link);
            ?>
        </td>
    </tr>
</table>