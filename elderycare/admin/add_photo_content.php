<?php
if (isset($_POST['new_post']) && $_POST['new_post'] == 1) {
    $error_array = array();
    $photo_title = addslashes($_POST['title']);
    $photo_pselect_group = $_POST['pselect_group'];
    $post_image_filename = $_POST['photo_filename'];
    $post_photo_description = addslashes($_POST['photo_description']);

    if (mb_strlen($photo_title, 'UTF-8') < 4) {
        $error_array['post_title'] = '<span style="color:red;font-weight:bold;">Името на снимката</span> е твърде кратко!';
    }
    if (mb_strlen($photo_title, 'UTF-8') > 200) {
        $error_array['post_title'] = '<span style="color:red;font-weight:bold;">Името на снимкаа</span> е твърде дълго - макс 200!';
    }
    if (mb_strlen($post_photo_description, 'UTF-8') < 5) {
        $error_array['post_description'] = '<span style="color:red;font-weight:bold;">Описанието на снимката</span> е твърде кратко!';
    }
    if (mb_strlen($post_photo_description, 'UTF-8') > 3000) {
        $error_array['post_description'] = '<span style="color:red;font-weight:bold;">Името на снимкаа</span> е твърде дълго - макс 1000!';
    }
    if ($photo_pselect_group < 1) {
        $error_array['post_pselect_group'] = 'Не сте избрали <span style="color:red;font-weight:bold;">група</span>!';
    }

    /*if($post_image_name=='no_picture.jpg'){
        $error_array['post_image_name'] = 'Не сте качили <span style="color:red;font-weight:bold;">снимка</span> на снимкаа!';
    }*/

    if (count($error_array) == 0) {
        run_q('INSERT INTO photos (filename,title,description,category_id,date_added)
                       VALUES ("' . $post_image_filename . '", "' . $photo_title . '","' . $post_photo_description . '", ' . $photo_pselect_group . ', ' . time() . ')');
        if (!mysql_error()) {
            redirect('add_photo.php?succ_add=1');
        } else {
            mysql_error();
        }
    } else {
        mysql_error();
    }
}


if (isset ($_POST['edit_photo']) && isset ($_POST['edit_photo_id']) && $_POST['edit_photo'] > 0) {
    $edit_id_post = (int)$_POST['edit_photo_id'];
    $error_array = array();
    $photo_title = addslashes($_POST['title']);
    $photo_pselect_group = $_POST['pselect_group'];
    $post_image_filename = $_POST['photo_filename'];
    $post_old_image_name = $_POST['old_photo_filename'];
    $post_photo_description = addslashes($_POST['photo_description']);

    if ($edit_id_post > 0) {
        $result_edit_photo = run_q('SELECT photo_id FROM photos WHERE photo_id=' . $edit_id_post);
        $edit_num_rows_post = mysql_num_rows($result_edit_photo);
        if ($edit_num_rows_post > 0) {

            if (mb_strlen($photo_title, 'UTF-8') < 4) {
                $error_array['post_title'] = '<span style="color:red;font-weight:bold;">Името на снимката</span> е твърде кратко!';
            }
            if (mb_strlen($photo_title, 'UTF-8') > 200) {
                $error_array['post_title'] = '<span style="color:red;font-weight:bold;">Името на снимката</span> е твърде дълго - макс 200!';
            }
            if ($photo_pselect_group < 1) {
                $error_array['post_pselect_group'] = 'Не сте избрали <span style="color:red;font-weight:bold;">група</span>!';
            }
            if (mb_strlen($post_photo_description, 'UTF-8') < 5) {
                $error_array['post_description'] = '<span style="color:red;font-weight:bold;">Описанието на снимката</span> е твърде кратко!';
            }
            if (mb_strlen($post_photo_description, 'UTF-8') > 3000) {
                $error_array['post_description'] = '<span style="color:red;font-weight:bold;">Името на снимкаа</span> е твърде дълго - макс 1000!';
            }
            /*if($post_image_name=='no_picture.jpg'){
                $error_array['post_image_name'] = 'Не сте качили <span style="color:red;font-weight:bold;">снимка</span> на снимкаа!';
            }*/
            // run_q
            if (count($error_array) == 0) {
                run_q('UPDATE photos SET title="' . $photo_title . '",category_id=' . $photo_pselect_group . ', filename="' . $post_image_filename . '", description="'.$post_photo_description.'" WHERE photo_id=' . $edit_id_post);
                if ($post_old_image_name != $post_image_filename) {
                    if ($post_old_image_name != 'no_picture.jpg') {
                        echo 'Старата картинка е изтрита';
                        unlink('../img/gallery/' . $post_old_image_name);
                        unlink('../img/gallery/thumbs/' . $post_old_image_name);
                    } else {
                        echo 'Имаме нова картинка но не изтриваме старата понеже тя е no_picture.jpg';
                    }
                } else {
                    echo 'Старата картинка се запазва';
                }
                redirect('add_photo.php?editid=' . $edit_id_post . '&succ_edit=1');
            } else {
                mysql_error();
            }

        } else {
            echo 'Няма такъв коментар';
        }
    } else {
        echo 'Хакерче';
    }
}


if (isset($_GET['editid'])) {
    $editid = $_GET['editid'];
    $hidden_mode = 'edit_photo';
    $error_array = array();
    $edit_photo_id = $editid;

    $edit_result = run_q('SELECT * FROM photos WHERE photo_id=' . $editid);
    $edit_row = mysql_fetch_array($edit_result);
    $title = $edit_row['title'];
    $photo_description = $edit_row['description'];
    $pselect_group = $edit_row['category_id'];
    $post_image_filename = $edit_row['filename'];
} else {
    $hidden_mode = 'new_post';
    $title = '';
    $photo_description = '';
    $pselect_group = '';
    $post_image_filename = 'no_picture.jpg';
}


if (isset($_GET['deleteid'])) {
    $deleteid = (int)$_GET['deleteid'];
    if ($deleteid > 0) {
        $result_delete = run_q('SELECT photo_id, filename FROM `photos` WHERE photo_id=' . $deleteid);
        $delete_num_rows = mysql_num_rows($result_delete);
        $delete_row = mysql_fetch_array($result_delete);
        if ($delete_num_rows > 0) {
            if ($delete_row['filename'] != 'no_picture.jpg') {
                //echo 'Изтриваме картинката ако не е равна на no_picture.jpg';
                unlink('../img/gallery/' . $delete_row['filename']);
                unlink('../img/gallery/thumbs/' . $delete_row['filename']);
            }
            run_q('DELETE FROM `photos` WHERE photo_id=' . $deleteid);
            redirect('add_photo.php?succ_del=1');
        } else {
            echo '<h2 style="color:red;margin: 25px 0 0 35px;">Няма такава група!</h2>';
        }
    } else {
        echo '<h2 style="color:red;margin: 25px 0 0 35px;">Нещо не е наред :)!</h2>';
    }
}


// POST['edit_photo'] - TODO

if (isset($_GET['succ_add']) && $_GET['succ_add'] == 1) {
    echo '<div class="information_box" style="background: #e7f7cf;width: 744px;height: 50px;border: 1px solid #8bc90d;margin: 10px 0 15px 0px; color: #416115; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 20px;" src="img/succ.jpg" /><span style="font-weight: bold;">Снимката беше добавена успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="index.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="img/succ_close.jpg" /></a></div>';
}
if (isset($_GET['succ_edit']) && $_GET['succ_edit'] == 1) {
    echo '<div class="information_box" style="background: #f7f3c6;width: 744px;height: 50px;border: 1px solid #d2af0c;margin: 10px 0 15px 0px; color: #8c791e; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="img/succ_edit.jpg" /><span style="font-weight: bold;">Снимката беше редактирана успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="index.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="img/succ_edit_close.jpg" /></a></div>';
}
if (isset($_GET['succ_del']) && $_GET['succ_del'] == 1) {
    echo '<div class="information_box" style="background: #f6e0e0;width: 680px;height: 50px;border: 1px solid #dd0b0b;margin: 10px 0 15px 0px; color: #901313; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="img/succ_del.jpg" /><span style="font-weight: bold;">Снимката беше изтрита успешно!</span> Това действие неможе да бъде отменено.<a href="index.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="img/succ_del_close.jpg" /></a></div>';
}
?>

<div id="add_product_field">
    <form method="post" action="add_photo.php">
        <div id="add_product_field_left">
            <div id="ap_title">
                <img style="position:relative;top:6px;margin: 0 8px 0 -2px;" src="../img/admin/add_photo_icon2.png"
                     alt="Добави снимка"/>
                Добави нова снимка
            </div>
            <div class="input_field">
                <label for="title">Име на снимката:</label>
                <input type="text" id="title" name="title" value="<?php echo $title; ?>"/>
            </div>
            <div class="input_field photo-description">
                <label for="photo_description">Описание:</label>
                <textarea id="photo_description" name="photo_description"><?php echo $photo_description; ?></textarea>
            </div>
            <select id="select_group" name="pselect_group">
                <option value="no-group">Избери Група</option>
                <?php
                $group_result = run_q('SELECT `category_id`,`name` FROM `categories`'); // DATABASE CONNECT
                while ($category_row = mysql_fetch_array($group_result)) {
                    if ($pselect_group == $category_row['category_id']) {
                        $selected = 'selected="selected"';
                    } else {
                        $selected = '';
                    }
                    echo '<option ' . $selected . ' value="' . $category_row['category_id'] . '">' . $category_row['category_id'] . ' - ' . $category_row['name'] . '</option>';
                }
                ?>
            </select>
            <?php if (isset ($edit_photo_id)) {
                echo '<input type="hidden" name="edit_photo_id" value="' . $edit_photo_id . '"/>';
            } ?>
            <input type="hidden" value="<?php echo $post_image_filename; ?>" name="old_photo_filename"/>
            <input type="hidden" value="1" name="<?php echo $hidden_mode; ?>"/>
            <input id="save_btn" type="submit" name="submit" value="Запази"/>
            <input id="reset_btn" type="reset" value="Изчисти"/>

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
        </div>

        <div id="add_product_field_right">
            <div class="product_box">
                <div class="product_thumb">
                    <img style="margin: 0px 0 0 0px;" alt="Тъмбнейл на снимкаа" class="jcrop-preview"
                         src="../img/gallery/thumbs/<?php echo $post_image_filename; ?>"/>
                    <input type='hidden' name='photo_filename' id="photo-hidden-field"
                           value='<?php echo $post_image_filename; ?>'/>
                </div>
    </form>
</div>
<div style="clear:both;"></div>
<div id="upload_title">Качи снимка от компютъра</div>
<div style="clear:both;"></div>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
    <input type="file" name="photoimg" id="photoimg"/>
</form>
</div>
<div style="clear:both;"></div>
<div id="crop-field"></div>
</div>