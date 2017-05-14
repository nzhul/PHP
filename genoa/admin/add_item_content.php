<?php 
            if (isset($_POST['new_post']) && $_POST['new_post'] == 1) {
            $error_array = array();
            $post_item_name = addslashes($_POST['item_name']);
            $post_item_weight = addslashes($_POST['item_weight']);
            $post_item_price = $_POST['item_price'];
            $post_pselect_group = $_POST['pselect_group'];
            $post_image_name = $_POST['pic_name'];
            
            
            if(mb_strlen($post_item_name,'UTF-8')<4){
                $error_array['post_item_name'] = '<span style="color:red;font-weight:bold;">Името на продукта</span> е твърде кратко!';
            }
            if(mb_strlen($post_item_name,'UTF-8')>200){
                $error_array['post_item_name'] = '<span style="color:red;font-weight:bold;">Името на продукта</span> е твърде дълго - макс 200!';
            }
            if(mb_strlen($post_item_weight,'UTF-8')<1){
                $error_array['post_item_weight'] = 'Моля попълнете полето за <span style="color:red;font-weight:bold;">тегло на артикула</span>!';
            }
            if($post_item_price=='??.??'){
                $error_array['post_item_price'] = 'Моля попълнете <span style="color:red;font-weight:bold;">Цената</span>!';
            }
            if($post_pselect_group<1){
                $error_array['post_pselect_group'] = 'Не сте избрали <span style="color:red;font-weight:bold;">група</span>!';
            }
            /*if($post_image_name=='no_picture.jpg'){
                $error_array['post_image_name'] = 'Не сте качили <span style="color:red;font-weight:bold;">снимка</span> на продукта!';
            }*/
            
            if (count($error_array) == 0) {
                run_q('INSERT INTO items (item_name,item_weight,cat_id,item_price,pic_name) 
                       VALUES ("'.$post_item_name.'", '.$post_item_weight.','.$post_pselect_group.', '.$post_item_price.', "'.$post_image_name.'")');
                if(!mysql_error()){redirect('add_item.php?succ_add=1');}else {
                    mysql_error();
                }
            }
            else {
                mysql_error();
            }
        }
        
        
        if(isset ($_POST['edit_post']) && isset ($_POST['edit_post_id']) && $_POST['edit_post']>0){
            $edit_id_post = (int)$_POST['edit_post_id'];
            $error_array = array();
            $post_item_name = addslashes($_POST['item_name']);
            $post_item_weight = addslashes($_POST['item_weight']);
            $post_item_price = $_POST['item_price'];
            $post_pselect_group = $_POST['pselect_group'];
            $post_image_name = $_POST['pic_name'];
            $post_old_image_name = $_POST['old_pic_name'];
            
            if($edit_id_post>0){
                $result_edit_post = run_q('SELECT item_id FROM items WHERE item_id='.$edit_id_post);
                $edit_num_rows_post = mysql_num_rows($result_edit_post);
                if($edit_num_rows_post>0){
                    
                    if(mb_strlen($post_item_name,'UTF-8')<4){
                        $error_array['post_item_name'] = '<span style="color:red;font-weight:bold;">Името на продукта</span> е твърде кратко!';
                    }
                    if(mb_strlen($post_item_name,'UTF-8')>200){
                        $error_array['post_item_name'] = '<span style="color:red;font-weight:bold;">Името на продукта</span> е твърде дълго - макс 200!';
                    }
                    if(mb_strlen($post_item_weight,'UTF-8')<1){
                        $error_array['post_item_weight'] = 'Моля попълнете полето за <span style="color:red;font-weight:bold;">тегло на артикулая</span>!';
                    }
                    if($post_item_price=='??.??'){
                        $error_array['post_item_price'] = 'Моля попълнете <span style="color:red;font-weight:bold;">Цената</span>!';
                    }
                    if($post_pselect_group<1){
                        $error_array['post_pselect_group'] = 'Не сте избрали <span style="color:red;font-weight:bold;">група</span>!';
                    }
                    /*if($post_image_name=='no_picture.jpg'){
                        $error_array['post_image_name'] = 'Не сте качили <span style="color:red;font-weight:bold;">снимка</span> на продукта!';
                    }*/
                    // run_q
                    if (count($error_array) == 0) {
                        run_q('UPDATE items SET item_name="'.$post_item_name.'",item_weight="'.$post_item_weight.'",cat_id='.$post_pselect_group.',item_price="'.$post_item_price.'",pic_name="'.$post_image_name.'" WHERE item_id='.$edit_id_post);
                        if($post_old_image_name != $post_image_name){
                            if($post_old_image_name != 'no_picture.jpg'){
                             echo 'Старата картинка е изтрита';
                             unlink('../img/upload/'.$post_old_image_name);
                            }
                            else {echo 'Имаме нова картинка но не изтриваме старата понеже тя е no_picture.jpg';}
                        }
                        else {
                            echo 'Старата картинка се запазва';
                        }
                        redirect('add_item.php?editid='.$edit_id_post.'&succ_edit=1');
                    }
                    else {
                        mysql_error();
                    }
            
                }
                else {echo 'Няма такъв коментар';}
            }
            else {echo 'Хакерче';}
        }
        
        
        if(isset($_GET['editid'])){
            $editid = $_GET['editid'];
            $hidden_mode = 'edit_post';
            $error_array = array();
            $edit_post_id = $editid;
            
            $edit_result = run_q('SELECT * FROM items WHERE item_id='.$editid);
            $edit_row = mysql_fetch_array($edit_result);
            $item_name = $edit_row['item_name'];
            $item_weight = $edit_row['item_weight'];
            $item_price = $edit_row['item_price'];
            $pselect_group = $edit_row['cat_id'];
            $post_image_name = $edit_row['pic_name'];
        }
        else {
            $hidden_mode = 'new_post';
            $item_name = '';
            $item_weight = '';
            $item_price = '??.??';
            $pselect_group = '';
            $post_image_name = 'no_picture.jpg';
        }
        
        
if(isset($_GET['deleteid'])){
            $deleteid=(int)$_GET['deleteid'];
            if($deleteid>0){
                $result_delete = run_q('SELECT item_id,pic_name FROM `items` WHERE item_id='.$deleteid);
                $delete_num_rows = mysql_num_rows($result_delete);
                $delete_row = mysql_fetch_array($result_delete);
                if($delete_num_rows>0){
                        if($delete_row['pic_name'] != 'no_picture.jpg'){
                            //echo 'Изтриваме картинката ако не е равна на no_picture.jpg';
                            unlink('../img/upload/'.$delete_row['pic_name']);
                            unlink('../img/upload/thumb_'.$delete_row['pic_name']);
                            unlink('../img/upload/minithumb_'.$delete_row['pic_name']);
                        }
                        run_q('DELETE FROM `items` WHERE item_id='.$deleteid);
                        redirect('add_item.php?succ_del=1');
                }
                else { echo '<h2 style="color:red;margin: 25px 0 0 35px;">Няма такава група!</h2>';}
            }
            else {echo '<h2 style="color:red;margin: 25px 0 0 35px;">Нещо не е наред :)!</h2>';}
}
        
        
// POST['edit_post'] - TODO
        
if(isset($_GET['succ_add']) && $_GET['succ_add']==1){
 echo '<div class="information_box" style="background: #e7f7cf;width: 744px;height: 50px;border: 1px solid #8bc90d;margin: 10px 0 15px 0px; color: #416115; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 20px;" src="../img/succ.jpg" /><span style="font-weight: bold;">Новия продукт беше добавен успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="index.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="../img/succ_close.jpg" /></a></div>';   
}
if(isset($_GET['succ_edit']) && $_GET['succ_edit']==1){
 echo '<div class="information_box" style="background: #f7f3c6;width: 744px;height: 50px;border: 1px solid #d2af0c;margin: 10px 0 15px 0px; color: #8c791e; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="../img/succ_edit.jpg" /><span style="font-weight: bold;">Продукта беше редактиран успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="index.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="../img/succ_edit_close.jpg" /></a></div>';   
}
if(isset($_GET['succ_del']) && $_GET['succ_del']==1){
 echo '<div class="information_box" style="background: #f6e0e0;width: 680px;height: 50px;border: 1px solid #dd0b0b;margin: 10px 0 15px 0px; color: #901313; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="../img/succ_del.jpg" /><span style="font-weight: bold;">Продукта беше изтрит успешно!</span> Това действие неможе да бъде отменено.<a href="index.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="../img/succ_del_close.jpg" /></a></div>';   
}
?>

<div id="add_product_field">
    <form method="post" action="add_item.php">
    <div id="add_product_field_left">
    <div id="ap_title">
        <img style="position:relative;top:6px;margin: 0 8px 0 -2px;" src="../img/admin/add_icon.png" alt="Добави продукт" />
        Добави нов продукт
    </div>
    <div class="input_field">
        <label for="item_name">Име на продукта:</label>
        <input type="text" id="item_name" name="item_name" value="<?php echo $item_name; ?>" />
    </div>

    <div class="input_field">
        <label for="item_weight">Тегло:</label>
        <input type="text" id="item_weight" name="item_weight" value="<?php echo $item_weight; ?>" />
    </div>
    <div class="input_field">
        <label for="item_price">Цена:</label>
        <input type="text" id="item_price" name="item_price" value="<?php echo $item_price; ?>" />
    </div>
    <select id="select_group" name="pselect_group">
        <option value="no-group">Избери Група</option>
<?php 
    $group_result = run_q('SELECT `cat_id`,`ctitle` FROM `menu`'); // DATABASE CONNECT
    while ($group_row = mysql_fetch_array($group_result)) {
        if($pselect_group==$group_row['cat_id']){
            $selected = 'selected="selected"';
        }
        else {$selected = '';}
     echo '<option '.$selected.' value="'.$group_row['cat_id'].'">'.$group_row['cat_id'].' - '.$group_row['ctitle'].'</option>';   
    }
?>
    </select>
    <?php
    if(isset ($error_array)){
        if(count($error_array)>0){
                $i = 1;
                foreach ($error_array as $v) {
            echo '<span style="margin: 0 0 0 10px;">'.$i.'. '.$v.'</span><br/>';
                 $i++;
        }}}
        ?>
<?php if(isset ($edit_post_id)){echo '<input type="hidden" name="edit_post_id" value="'.$edit_post_id.'"/>';} ?>
    <input type="hidden" value="<?php echo $post_image_name; ?>" name="old_pic_name" />
    <input type="hidden" value="1" name="<?php echo $hidden_mode; ?>" />
    <input id="save_btn" type="submit" name="submit" value="Запази" />
    <input id="reset_btn" type="reset" value="Изчисти" />
    </div>

        <div id="add_product_field_right">
                <div class="product_box">
                    <div class="product_thumb">
                        <img style="margin: 0px 0 0 0px;" alt="Тъмбнейл на продукта" src="../img/upload/thumb_<?php echo $post_image_name; ?>"/><input type='hidden' name='pic_name' value='<?php echo $post_image_name; ?>'/>
                    </div>
    </form>
<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').live('change', function(){
			           $(".product_thumb").html('');
			    $(".product_thumb").html('<img style="margin: 120px 0 0 40px" src="../img/loading.gif"/>');
			$("#imageform").ajaxForm({target: '.product_thumb'}).submit();
			});
        }); 
</script>
                </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#price_change').text($('#item_price').val());
                $('#item_price').keyup(function () {
                $('#price_change').text($(this).val());
                });
                $('.product_title').text($('#item_name').val());
                $('#item_name').keyup(function () {
                $('.product_title').text($(this).val());
                });
            });
        </script>
        <div style="clear:both;"></div>
        <div id="upload_title">Качи снимка от компютъра</div>
        <div style="clear:both;"></div>
        <form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
        <input type="file" name="photoimg" id="photoimg"  />
        </form>
        </div>
        <div style="clear:both;"></div>
</div>