<?php
$result = run_q('SELECT * FROM `categories`');
?>
<?php
if (isset ($_POST['new_post']) && $_POST['new_post'] > 0) {
    $error_array = array();
    $post_name = $_POST['name'];
    $post_description = $_POST['description'];

    if (mb_strlen($post_name, 'UTF-8') < 4) {
        $error_array['post_name'] = '<span style="color:red;font-weight:bold;">Името на групата</span> е твърде кратко!';
    }
    if (mb_strlen($post_name, 'UTF-8') > 200) {
        $error_array['post_name'] = '<span style="color:red;font-weight:bold;">Името на групата</span> е твърде дълго - макс 200!';
    }
    if (mb_strlen($post_description, 'UTF-8') < 4) {
        $error_array['post_description'] = '<span style="color:red;font-weight:bold;">Описанието на групата</span> е твърде кратко!';
    }
    if (mb_strlen($post_description, 'UTF-8') > 20000) {
        $error_array['post_description'] = '<span style="color:red;font-weight:bold;">Описанието на групата</span> е твърде дълго - макс 20 000!';
    }
    if (count($error_array) == 0) {
        run_q('INSERT INTO `categories` (name, description, date_added) VALUES ("' . $post_name . '","' . $post_description . '",' . time() . ')');
        redirect('categories.php?succ_add=1');
    } else {
        mysql_error();
    }

    // error validation
    // run_q
    // redirect
}
if (isset ($_POST['edit_post']) && isset ($_POST['edit_post_id']) && $_POST['edit_post'] > 0) {
    $edit_id_post = (int)$_POST['edit_post_id'];
    $error_array = array();
    $post_name = $_POST['name'];
    $post_description = $_POST['description'];
    if ($edit_id_post > 0) {
        $result_edit_post = run_q('SELECT category_id FROM `categories` WHERE category_id=' . $edit_id_post);
        $edit_num_rows_post = mysql_num_rows($result_edit_post);
        if ($edit_num_rows_post > 0) {
            if (mb_strlen($post_name, 'UTF-8') < 4) {
                $error_array['post_name'] = '<span style="color:red;font-weight:bold;">Името на групата</span> е твърде кратко!';
            }
            if (mb_strlen($post_name, 'UTF-8') > 200) {
                $error_array['post_name'] = '<span style="color:red;font-weight:bold;">Името на групата</span> е твърде дълго - макс 200!';
            }
            if (mb_strlen($post_description, 'UTF-8') < 4) {
                $error_array['post_description'] = '<span style="color:red;font-weight:bold;">Описанието на групата</span> е твърде кратко!';
            }
            if (mb_strlen($post_description, 'UTF-8') > 20000) {
                $error_array['post_description'] = '<span style="color:red;font-weight:bold;">Описанието на групата</span> е твърде дълго - макс 20 000!';
            }
            if (count($error_array) == 0) {
                run_q('UPDATE `categories` SET name="' . $post_name . '",description="' . $post_description . '" WHERE category_id=' . $edit_id_post);
                redirect('categories.php?editid=' . $edit_id_post . '&succ_edit=1');
            } else {
                mysql_error();
            }

        } else {
            echo 'Тази група не съществува!';
        }
    } else {
        echo 'Хакерче!';
    }
    // error validation
    // run_q
    // redirect
}


if (isset($_GET['editid'])) {
    $editid = (int)$_GET['editid'];
    $hidden_mode = 'edit_post';
    $edit_post_id = $editid;
    $edit_result = run_q('SELECT * FROM `categories` WHERE category_id=' . $editid);
    $edit_row = mysql_fetch_array($edit_result);
    $name = $edit_row['name'];
    $description = $edit_row['description'];
    $btn_value = 'Запази';
} else {
    $hidden_mode = 'new_post';
    $name = '';
    $description = '';
    $btn_value = 'Нова група';
}

if (isset($_GET['deleteid'])) {
    $deleteid = (int)$_GET['deleteid'];
    if ($deleteid > 0) {
        $result_delete = run_q('SELECT category_id FROM `categories` WHERE category_id=' . $deleteid);
        $delete_num_rows = mysql_num_rows($result_delete);
        if ($delete_num_rows > 0) {
            run_q('UPDATE products SET category_id=9 WHERE category_id=' . $deleteid); // Сменям групата на всички продукти на - 9 - "ДРУГИ"
            run_q('DELETE FROM `categories` WHERE category_id=' . $deleteid); // След това изтривам групата
            redirect('categories.php?succ_del=1');
        } else {
            echo '<h2 style="color:red;margin: 25px 0 0 35px;">Няма такава група!</h2>';
        }
    } else {
        echo '<h2 style="color:red;margin: 25px 0 0 35px;">Нещо не е наред :)!</h2>';
    }
}


if (isset($_GET['succ_add']) && $_GET['succ_add'] == 1) {
    echo '<div class="information_box" style="background: #e7f7cf;width: 744px;height: 50px;border: 1px solid #8bc90d;margin: 10px 0 15px 0px; color: #416115; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 20px;" src="img/succ.jpg" /><span style="font-weight: bold;">Новата група беше добавена успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="categories.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="img/succ_close.jpg" /></a></div>';
}
if (isset($_GET['succ_edit']) && $_GET['succ_edit'] == 1) {
    echo '<div class="information_box" style="background: #f7f3c6;width: 740px;height: 50px;border: 1px solid #d2af0c;margin: 10px 0 15px 0px; color: #8c791e; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="img/succ_edit.jpg" /><span style="font-weight: bold;">Група беше редактирана успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="categories.php"><img style="position: relative;top:5px;margin: 0 20px 0 40px;" src="img/succ_edit_close.jpg" /></a></div>';
}
if (isset($_GET['succ_del']) && $_GET['succ_del'] == 1) {
    echo '<div class="information_box" style="background: #f6e0e0;width: 680px;height: 50px;border: 1px solid #dd0b0b;margin: 10px 0 15px 0px; color: #901313; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="img/succ_del.jpg" /><span style="font-weight: bold;">Група беше изтрита успешно!</span> Това действие неможе да бъде отменено.<a href="categories.php"><img style="position: relative;top:5px;margin: 0 20px 0 40px;" src="img/succ_del_close.jpg" /></a></div>';
}
?>
<script type="text/javascript" language="javascript">
    function question() {
        var quest = confirm("Сигурни ли сте, че искате да изтриете тази група ?\nТова действие неможе да бъде отменено !!! ");
        if (quest) {
            return true;
        } else {
            return false;
        }
    }
</script>
<h3>ГРУПИ:</h3>
<div id="adm_table_field">
    <table class="categories_table">
        <tr class="tbl_head">
            <td>Име на групата</td>
            <td>Описание</td>
            <td>Инструменти</td>
        </tr>
        <?php
        while ($row = mysql_fetch_array($result)) {
            $short_desc = mb_substr($row['description'], 0, 400, 'UTF-8');
            echo '<tr>
                        <td style="width:180px;font-weight:bold;">' . $row['name'] . '</td>
                        <td>' . $short_desc . '</td>
                        <td style="vertical-align:middle;"><a href="../products.php?categories=' . $row['category_id'] . '" class="icon_btn"><img src="../img/icons/preview.png"/></a><a href="categories.php?editid=' . $row['category_id'] . '#formm" class="icon_btn"><img src="../img/icons/edit.png"/></a><a onClick="return question();" href="categories.php?deleteid=' . $row['category_id'] . '" class="icon_btn"><img src="../img/icons/delete.png"/></a></td>
                    </tr>';
        }
        ?>
        <tr class="tbl_head">
            <td>Продукт</td>
            <td>Описание</td>
            <td>Инструменти</td>
        </tr>
    </table>
</div>
<div style="clear:both;">&nbsp;</div>
<?php
if (isset ($error_array)) {
    if (count($error_array) > 0) {
        $i = 1;
        foreach ($error_array as $v) {
            echo '<span style="margin: 0 0 0 10px;">' . $i . '. ' . $v . '</span><br/>';
            $i++;
        }
    }
}
?>
<a id="formm"></a>
<form method="post" action="categories.php">
    <div id="submit_group_field">
        <div class="input_field" style="margin: 0 0 10px 0px;">
            <label for="pname">Име на групата:</label>
            <input type="text" id="pname" name="name" value="<?php echo $name ?>"/>
        </div>
        <textarea name="description" id="group_desc_textarea"><?php echo $description ?></textarea>

        <div style="clear: both;"></div>
        <input type="hidden" value="1" name="<?php echo $hidden_mode; ?>"/>
        <?php if (isset ($edit_post_id)) {
            echo '<input type="hidden" name="edit_post_id" value="' . $edit_post_id . '"/>';
        } ?>
        <input id="save_btn" type="submit" style="margin: 10px 0 180px 0px;" name="submit"
               value="<?php echo $btn_value ?>"/>
    </div>
</form>