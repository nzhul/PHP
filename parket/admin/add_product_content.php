<?php 
            if (isset($_POST['new_post']) && $_POST['new_post'] == 1) {
            $error_array = array();
            $post_pname = addslashes($_POST['pname']);
            $post_pcode = addslashes($_POST['pcode']);
            $post_pwidth_class = addslashes($_POST['pwidth_class']);
            $post_psize = addslashes($_POST['psize']);
            $post_psurface = addslashes($_POST['psurface']);
            $post_producer = addslashes($_POST['producer']);
            $post_pfinal_price = $_POST['pfinal_price'];
            $post_pprice_desc = addslashes($_POST['pprice_desc']);
            $post_pselect_group = $_POST['pselect_group'];
            if(isset($_POST['is_promotion']) && $_POST['is_promotion']=='on'){$post_is_promotion = 1;}else {$post_is_promotion = 2;}
            if(isset($_POST['is_public']) && $_POST['is_public']=='on'){$post_is_public = 1;}else {$post_is_public = 2;}
            $post_image_name = $_POST['img_name'];
            
            
            if(mb_strlen($post_pname,'UTF-8')<4){
                $error_array['post_pname'] = '<span style="color:red;font-weight:bold;">Името на продукта</span> е твърде кратко!';
            }
            if(mb_strlen($post_pname,'UTF-8')>200){
                $error_array['post_pname'] = '<span style="color:red;font-weight:bold;">Името на продукта</span> е твърде дълго - макс 200!';
            }
            if(mb_strlen($post_pcode,'UTF-8')<2){
                $error_array['post_pcode'] = '<span style="color:red;font-weight:bold;">Кода</span> е твърде къс - мин 2!';
            }
            if(mb_strlen($post_pwidth_class,'UTF-8')<1){
                $error_array['post_pwidth_class'] = 'Моля попълнете <span style="color:red;font-weight:bold;">дебелина/клас</span>!';
            }
            if(mb_strlen($post_psize,'UTF-8')<1){
                $error_array['post_psize'] = 'Моля попълнете <span style="color:red;font-weight:bold;">размерите</span>!';
            }
            if(mb_strlen($post_psurface,'UTF-8')<1){
                $error_array['post_psurface'] = 'Моля попълнете вида на <span style="color:red;font-weight:bold;">повърхността</span>!';
            }
            if(mb_strlen($post_producer,'UTF-8')<1){
                $error_array['post_producer'] = 'Моля попълнете полето за <span style="color:red;font-weight:bold;">производителя</span>!';
            }
            if($post_pfinal_price=='??.??'){
                $error_array['post_pfinal_price'] = 'Моля попълнете <span style="color:red;font-weight:bold;">Цената</span>!';
            }
            if (mb_strlen($post_pprice_desc,'UTF-8') < 4) {
                $error_array['post_pprice_desc'] = 'Описанието на <span style="color:red;font-weight:bold;">цената</span> е твърде кратко - мин 4!';
            }
            if (mb_strlen($post_pprice_desc,'UTF-8') > 1000) {
                $error_array['post_pprice_desc'] = 'Прекалено много текст в <span style="color:red;font-weight:bold;">описанието на цената</span> - макс 1000';
            }
            if($post_pselect_group<1){
                $error_array['post_pselect_group'] = 'Не сте избрали <span style="color:red;font-weight:bold;">група</span>!';
            }
            /*if($post_image_name=='no_picture.jpg'){
                $error_array['post_image_name'] = 'Не сте качили <span style="color:red;font-weight:bold;">снимка</span> на продукта!';
            }*/
            
            if (count($error_array) == 0) {
                run_q('INSERT INTO products (pname,pcode,pwidth_class,psize,psurface,producer,pprice_desc,group_id,is_promo,is_public,pfinal_price,img_name) 
                       VALUES ("'.$post_pname.'","'.$post_pcode.'","'.$post_pwidth_class.'", "'.$post_psize.'", "'.$post_psurface.'", "'.$post_producer.'", "'.$post_pprice_desc.'",'.$post_pselect_group.', '.$post_is_promotion.','.$post_is_public.', "'.$post_pfinal_price.'", "'.$post_image_name.'")');
                if(!mysql_error()){redirect('add_product.php?succ_add=1');}else {
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
            $post_pname = addslashes($_POST['pname']);
            $post_pcode = addslashes($_POST['pcode']);
            $post_pwidth_class = addslashes($_POST['pwidth_class']);
            $post_psize = addslashes($_POST['psize']);
            $post_psurface = addslashes($_POST['psurface']);
            $post_producer = addslashes($_POST['producer']);
            $post_pfinal_price = $_POST['pfinal_price'];
            $post_pprice_desc = addslashes($_POST['pprice_desc']);
            $post_pselect_group = $_POST['pselect_group'];
            if(isset($_POST['is_promotion']) && $_POST['is_promotion']=='on'){$post_is_promotion = 1;}else {$post_is_promotion = 2;}
            if(isset($_POST['is_public']) && $_POST['is_public']=='on'){$post_is_public = 1;}else {$post_is_public = 2;}
            $post_image_name = $_POST['img_name'];
            $post_old_image_name = $_POST['old_img_name'];
            
            if($edit_id_post>0){
                $result_edit_post = run_q('SELECT product_id FROM products WHERE product_id='.$edit_id_post);
                $edit_num_rows_post = mysql_num_rows($result_edit_post);
                if($edit_num_rows_post>0){
                    
                    if(mb_strlen($post_pname,'UTF-8')<4){
                        $error_array['post_pname'] = '<span style="color:red;font-weight:bold;">Името на продукта</span> е твърде кратко!';
                    }
                    if(mb_strlen($post_pname,'UTF-8')>200){
                        $error_array['post_pname'] = '<span style="color:red;font-weight:bold;">Името на продукта</span> е твърде дълго - макс 200!';
                    }
                    if(mb_strlen($post_pcode,'UTF-8')<2){
                        $error_array['post_pcode'] = '<span style="color:red;font-weight:bold;">Кода</span> е твърде къс - мин 2!';
                    }
                    if(mb_strlen($post_pwidth_class,'UTF-8')<1){
                        $error_array['post_pwidth_class'] = 'Моля попълнете <span style="color:red;font-weight:bold;">дебелина/клас</span>!';
                    }
                    if(mb_strlen($post_psize,'UTF-8')<1){
                        $error_array['post_psize'] = 'Моля попълнете <span style="color:red;font-weight:bold;">размерите</span>!';
                    }
                    if(mb_strlen($post_psurface,'UTF-8')<1){
                        $error_array['post_psurface'] = 'Моля попълнете вида на <span style="color:red;font-weight:bold;">повърхността</span>!';
                    }
                    if(mb_strlen($post_producer,'UTF-8')<1){
                        $error_array['post_producer'] = 'Моля попълнете полето за <span style="color:red;font-weight:bold;">производителя</span>!';
                    }
                    if($post_pfinal_price=='??.??'){
                        $error_array['post_pfinal_price'] = 'Моля попълнете <span style="color:red;font-weight:bold;">Цената</span>!';
                    }
                    if (mb_strlen($post_pprice_desc,'UTF-8') < 4) {
                        $error_array['post_pprice_desc'] = 'Описанието на <span style="color:red;font-weight:bold;">цената</span> е твърде кратко - мин 4!';
                    }
                    if (mb_strlen($post_pprice_desc,'UTF-8') > 1000) {
                        $error_array['post_pprice_desc'] = 'Прекалено много текст в <span style="color:red;font-weight:bold;">описанието на цената</span> - макс 1000';
                    }
                    if($post_pselect_group<1){
                        $error_array['post_pselect_group'] = 'Не сте избрали <span style="color:red;font-weight:bold;">група</span>!';
                    }
                    /*if($post_image_name=='no_picture.jpg'){
                        $error_array['post_image_name'] = 'Не сте качили <span style="color:red;font-weight:bold;">снимка</span> на продукта!';
                    }*/
                    // run_q
                    if (count($error_array) == 0) {
                        run_q('UPDATE products SET pname="'.$post_pname.'",pcode="'.$post_pcode.'",pwidth_class="'.$post_pwidth_class.'",psize="'.$post_psize.'",psurface="'.$post_psurface.'",producer="'.$post_producer.'",pprice_desc="'.$post_pprice_desc.'",group_id='.$post_pselect_group.',is_promo='.$post_is_promotion.',is_public='.$post_is_public.',pfinal_price="'.$post_pfinal_price.'",img_name="'.$post_image_name.'" WHERE product_id='.$edit_id_post);
                        if($post_old_image_name != $post_image_name){
                            if($post_old_image_name != 'no_picture.jpg'){
                             echo 'Старата картинка е изтрита';
                             unlink('../img/product_img/'.$post_old_image_name);
                            }
                            else {echo 'Имаме нова картинка но не изтриваме старата понеже тя е no_picture.jpg';}
                        }
                        else {
                            echo 'Старата картинка се запазва';
                        }
                        redirect('add_product.php?editid='.$edit_id_post.'&succ_edit=1');
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
            
            $edit_result = run_q('SELECT * FROM products WHERE product_id='.$editid);
            $edit_row = mysql_fetch_array($edit_result);
            $pname = $edit_row['pname'];
            $pcode = $edit_row['pcode'];
            $pwidth_class = $edit_row['pwidth_class'];
            $psize = $edit_row['psize'];
            $psurface = $edit_row['psurface'];
            $producer = $edit_row['producer'];
            $pfinal_price = $edit_row['pfinal_price'];
            $pprice_desc = $edit_row['pprice_desc'];
            $pselect_group = $edit_row['group_id'];
            switch ($edit_row['is_promo']){case 1: $is_promo = 'checked="checked"';break; case 2: $is_promo = ''; }
            switch ($edit_row['is_public']){case 1: $is_public = 'checked="checked"';break; case 2: $is_public = ''; }
            $post_image_name = $edit_row['img_name'];
        }
        else {
            $hidden_mode = 'new_post';
            $pname = '';
            $pcode = '';
            $pwidth_class = '';
            $psize = '';
            $psurface = '';
            $producer = '';
            $pfinal_price = '??.??';
            $pprice_desc = '• Доставка на паркет<br/>
• Монтаж на паркета<br/>
• ПВЦ первази<br/>
• Подложка за паркета';
            $pselect_group = '';
            $is_promo = '';
            $is_public = 'checked="checked"';
            $post_image_name = 'no_picture.jpg';
        }
        
        
if(isset($_GET['deleteid'])){
            $deleteid=(int)$_GET['deleteid'];
            if($deleteid>0){
                $result_delete = run_q('SELECT product_id,img_name FROM `products` WHERE product_id='.$deleteid);
                $delete_num_rows = mysql_num_rows($result_delete);
                $delete_row = mysql_fetch_array($result_delete);
                if($delete_num_rows>0){
                        if($delete_row['img_name'] != 'no_picture.jpg'){
                            //echo 'Изтриваме картинката ако не е равна на no_picture.jpg';
                            unlink('../img/product_img/'.$delete_row['img_name']);
                        }
                        run_q('DELETE FROM `products` WHERE product_id='.$deleteid);
                        redirect('add_product.php?succ_del=1');
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
    <form method="post" action="add_product.php">
    <div id="add_product_field_left">
    <div id="ap_title">
        <img style="position:relative;top:6px;margin: 0 8px 0 -2px;" src="../img/admin/add_icon.png" alt="Добави продукт" />
        Добави нов продукт
    </div>
    <div class="input_field">
        <label for="pname">Име на продукта:</label>
        <input type="text" id="pname" name="pname" value="<?php echo $pname; ?>" />
    </div>
    <div class="input_field">
        <label for="pcode">Код на продукта:</label>
        <input type="text" id="pcode" name="pcode" value="<?php echo $pcode; ?>" />
    </div>
    <div class="input_field">
        <label for="pwidth_class">Дебелина / Клас:</label>
        <input type="text" id="pwidth_class" name="pwidth_class" value="<?php echo $pwidth_class; ?>" />
    </div>
    <div class="input_field">
        <label for="psize">Размери:</label>
        <input type="text" id="psize" name="psize" value="<?php echo $psize; ?>" />
    </div>
    <div class="input_field">
        <label for="psurface">Повърхност/Покритие:</label>
        <input type="text" id="psurface" name="psurface" value="<?php echo $psurface; ?>" />
    </div>
    <div class="input_field">
        <label for="producer">Производител:</label>
        <input type="text" id="producer" name="producer" value="<?php echo $producer; ?>" />
    </div>
    <div class="input_field">
        <label for="pfinal_price">Крайна цена:</label>
        <input type="text" id="pfinal_price" name="pfinal_price" value="<?php echo $pfinal_price; ?>" />
    </div>
    <label id="pprice_desc_label" for="pprice_desc">Цената включва:</label>
    <textarea id="pprice_desc" name="pprice_desc"><?php echo $pprice_desc; ?></textarea>
    <select id="select_group" name="pselect_group">
        <option value="no-group">Избери Група</option>
<?php 
    $group_result = run_q('SELECT `group_id`,`gname` FROM `group` WHERE active=1 ORDER BY `date_added` ASC'); // DATABASE CONNECT
    while ($group_row = mysql_fetch_array($group_result)) {
        if($pselect_group==$group_row['group_id']){
            $selected = 'selected="selected"';
        }
        else {$selected = '';}
     echo '<option '.$selected.' value="'.$group_row['group_id'].'">'.$group_row['group_id'].' - '.$group_row['gname'].'</option>';   
    }
?>
    </select>
    <label for="is_promotion">Промоция</label><input type="checkbox" <?php echo $is_promo; ?> name="is_promotion" id="is_promotion"/>
    <label for="is_public">Публичен</label><input type="checkbox" <?php echo $is_public; ?> name="is_public" id="is_public"/><br/>
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
    <input type="hidden" value="<?php echo $post_image_name; ?>" name="old_img_name" />
    <input type="hidden" value="1" name="<?php echo $hidden_mode; ?>" />
    <input id="save_btn" type="submit" name="submit" value="Запази" />
    <input id="reset_btn" type="reset" value="Изчисти" />
    </div>

        <div id="add_product_field_right">
                <div class="product_box">
                    <div class="product_thumb">
                        <img style="margin: 0px 0 0 0px;" alt="Тъмбнейл на продукта" src="../img/product_img/<?php echo $post_image_name; ?>"/><input type='hidden' name='img_name' value='<?php echo $post_image_name; ?>'/>
                    </div>
    </form>
                    <img style="margin: -6px 0 0 -6px;position: relative;top:-249px;" alt="Рамка на продукта" src="../img/product_frame.png"/>
                        <span class="price"><span id="price_change">6.99</span><span style="font-size:8px;">&nbsp;</span><span style="font-size: 14px;">лв/m<span style="vertical-align: super;font-size: 8px;">2</span></span></span>
                    <a class="overlay_trigger_link" rel=".overlay_box" href="#">Масивен дъб</a>
                    <div class="product_title">МАСИВЕН ДЪБ</div>
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
                $('#price_change').text($('#pfinal_price').val());
                $('#pfinal_price').keyup(function () {
                $('#price_change').text($(this).val());
                });
                $('.product_title').text($('#pname').val());
                $('#pname').keyup(function () {
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