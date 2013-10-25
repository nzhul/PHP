<?php if (isset($_SESSION['isLogged'])) { ?>
    <form action="processpost.php" method="POST">
        <table>
            <tr>
                <td>Write a comment:</td>
            </tr>
            <tr>
                <td><textarea name="comment"></textarea></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="postComment" value="Comment"/>
                    <input type="hidden" name="bookid" value="<?= (int) $_GET['id'] ?>"/>
                </td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <table>
        <tr>
            <td style="color: #ffc000; text-align: center;"><a href="login.php">To write a comment<br/>Please Login!</a></td>
        </tr>
    </table>  
<?php } ?>