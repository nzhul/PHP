<?php
require 'inc/header.php';
require 'inc/constants.php';
?>
<?php
if (isset($_POST['newPost'])) {
    $error_array = array();
    $post_product = str_replace('|', '-', trim(htmlspecialchars($_POST['product'])));
    $post_cost = floatval(str_replace(',', '.', $_POST['cost']));
    $post_type = (int) $_POST['type'];

    if (mb_strlen($post_product, 'UTF-8') < 3) {
        $error_array['post_content'] = 'The name of the product is too short!';
    }
    if (mb_strlen($post_product, 'UTF-8') > 100) {
        $error_array['post_content'] = 'The name of the product is too long - max 100!';
    }
    if ($post_cost <= 0) {
        $error_array['post_cost'] = 'The cost must be positive number!';
    }
    if ($post_cost >= 999) {
        $error_array['post_cost'] = 'The cost must be less than 999!';
    }
    if ($post_type < 0) {
        $error_array['post_type'] = 'Hey you!';
    }

    if (count($error_array) == 0) {
        // We dont have errors so we record the new input
        $data = $post_product . '|' . $post_cost . '|' . $post_type . '|' . time() . "\r\n";
        if (file_put_contents('database.txt', $data, FILE_APPEND)) {
            $success = true;
        }
    }
}
if (isset($_POST['editPost'])) {
    $error_array = array();
    $post_product = str_replace('|', '-', trim(htmlspecialchars($_POST['product'])));
    $post_cost = floatval(str_replace(',', '.', $_POST['cost']));
    $post_type = (int) $_POST['type'];
    $post_hiddentime = $_POST['hiddentime'];

    if (mb_strlen($post_product, 'UTF-8') < 3) {
        $error_array['post_content'] = 'The name of the product is too short!';
    }
    if (mb_strlen($post_product, 'UTF-8') > 100) {
        $error_array['post_content'] = 'The name of the product is too long - max 100!';
    }
    if ($post_cost <= 0) {
        $error_array['post_cost'] = 'The cost must be positive number!';
    }
    if ($post_cost >= 999) {
        $error_array['post_cost'] = 'The cost must be less than 999!';
    }
    if ($post_type < 0) {
        $error_array['post_type'] = 'Hey you!';
    }

    if (count($error_array) == 0) {

        $fileData = file('database.txt');
        $newData = "";
        for ($i = 0; $i < count($fileData); $i++) {
            if (strpos($fileData[$i], $post_hiddentime)) {
                $editedRow = $post_product . '|' . $post_cost . '|' . $post_type . '|' . $post_hiddentime . "\r\n";
                $newData = $newData . $editedRow;
                continue;
            }
            $newData = $newData . $fileData[$i];
        }
        if (file_put_contents('database.txt', $newData)) {
            $successEdit = true;
        }
    }
}
if (isset($_GET['edit']) && (int) $_GET['edit'] > 0) {
    $fileData = file('database.txt');
    for ($i = 0; $i < count($fileData); $i++) {
        if (strpos($fileData[$i], $_GET['edit'])) {
            $match = $fileData[$i];
            break;
        }
    }
    $splitedMatch = explode('|', $match);
    $productVal = $splitedMatch[0];
    $costVal = $splitedMatch[1];
    $typeVal = $splitedMatch[2];
    $hiddenTime = (int) $splitedMatch[3];
    $mode = "editPost";
    $btnValue = "Save";
} else {
    $productVal = "";
    $costVal = "";
    $typeVal = 0;
    $mode = "newPost";
    $btnValue = "Add";
    $hiddenTime = 0;
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
                echo 'Successfull record!';
                echo '</td></tr>';
            }
            if (isset($successEdit)) {
                echo '<tr><td colspan="2" style="color: #93c72e;">';
                echo 'Record successfuly Edited!';
                echo '</td></tr>';
            }
            ?>

            <tr>
                <td><label for="product">Product</label></td>
                <td><input type="text" name="product" id="product" value="<?= $productVal ?>" /></td>
            </tr>
            <tr>
                <td><label for="cost">Cost</label></td>
                <td><input type="text" name="cost" id="cost" value="<?= $costVal ?>" /></td>
            </tr>
            <tr>
                <td><label for="type">Type</label></td>
                <td><select id="type" name="type">
                        <?php
                        foreach ($types as $key => $value) {
                            if ($key == $typeVal) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" name="<?= $mode ?>" value="<?= $btnValue ?>"/>
                    <input type="hidden" name="hiddentime" value="<?= $hiddenTime ?>"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
include 'inc/footer.php';
?>