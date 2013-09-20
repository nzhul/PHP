<?php
require 'inc/header.php';
require 'inc/constants.php';
?>
<?php
if (isset($_POST['submit'])) {
    $error_array = array();
    $post_product = str_replace('|', '-', trim(htmlspecialchars($_POST['product'])));
    $post_cost = floatval($_POST['cost']);
    $post_type = (int) $_POST['type'];

    if (mb_strlen($post_product, 'UTF-8') < 2) {
        $error_array['post_content'] = 'Името на продукта е твърде кратко!';
    }
    if (mb_strlen($post_product, 'UTF-8') > 100) {
        $error_array['post_content'] = 'Името на продукта е твърде дълго - max 100!';
    }
    if ($post_cost <= 0) {
        $error_array['post_cost'] = 'Цената трябва да е полужително число!';
    }
    if ($post_cost >= 999) {
        $error_array['post_cost'] = 'Цената трябва да е по-малка от 999!';
    }
    if ($post_type < 0) {
        $error_array['post_type'] = 'Ей хакерче!';
    }

    if (count($error_array) == 0) {
        // We dont have errors so we record the new input
        $data = $post_product . '|' . $post_cost . '|' . $post_type . '|' . time()."\r\n";
        if (file_put_contents('database.txt', $data,FILE_APPEND)) {
            $success = true;
        }
    }
}
?>
<div id="navigation">
    <ul id="menu">
        <li>
            <a href="index.php">Expenses List</a>
        </li>
    </ul>
</div>
<div id="add">
    <form action="form.php" method="POST">
        <table>
            <?php
            if (isset($error_array)) {
                if (count($error_array) > 0) {
                    echo '<tr><td colspan="2" style="color: #dd7200;">';
                    foreach ($error_array as $v) {
                        echo $v . '<br/>';
                    }
                    echo '</td></tr>';
                }
            }
            if (isset($success)) {
                echo '<tr><td colspan="2" style="color: #93c72e;">';
                echo 'Записът беше направен успешно!';
                echo '</td></tr>';
            }
            ?>

            <tr>
                <td><label for="product">Product</label></td>
                <td><input type="text" name="product" id="product" /></td>
            </tr>
            <tr>
                <td><label for="cost">Cost</label></td>
                <td><input type="text" name="cost" id="cost" /></td>
            </tr>
            <tr>
                <td><label for="type">Type</label></td>
                <td><select id="type" name="type">
                        <?php
                        foreach ($types as $key => $value) {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Add"/></td>
            </tr>
        </table>
    </form>
</div>
<?php
include 'inc/footer.php';
?>