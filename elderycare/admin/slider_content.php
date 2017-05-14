<?php 
$result = run_q('SELECT * FROM `slides`');
?>
<?php 
if(isset ($_POST['new_post']) && $_POST['new_post']>0){
            $error_array = array();
            $post_gname = $_POST['slide_title'];
            $post_gdesc = $_POST['slide_desc'];
            $post_img_name = $_POST['img_name'];
            $post_slide_price = $_POST['slide_price'];
            
            if(mb_strlen($post_gname,'UTF-8')<4){
                $error_array['post_gname'] = '<span style="color:red;font-weight:bold;">Името на слайда</span> е твърде кратко!';
            }
            if(mb_strlen($post_gname,'UTF-8')>200){
                $error_array['post_gname'] = '<span style="color:red;font-weight:bold;">Името на слайда</span> е твърде дълго - макс 200!';
            }
            if(mb_strlen($post_gdesc,'UTF-8')<4){
                $error_array['post_gdesc'] = '<span style="color:red;font-weight:bold;">Описанието на слайда</span> е твърде кратко!';
            }
            if(mb_strlen($post_gdesc,'UTF-8')>20000){
                $error_array['post_gdesc'] = '<span style="color:red;font-weight:bold;">Описанието на слайда</span> е твърде дълго - макс 20 000!';
            }
            if (count($error_array) == 0) {
                run_q('INSERT INTO `slides` (slide_title,slide_desc,date_added,img_name,slide_price) VALUES ("'.$post_gname.'","'.$post_gdesc.'",'.time().',"'.$post_img_name.'","'.$post_slide_price.'")');
                redirect('slider.php?succ_add=1');
            }
            else {
                mysql_error();
            }
                    
            // error validation
            // run_q
            // redirect
}
if(isset ($_POST['edit_post']) && isset ($_POST['edit_post_id']) && $_POST['edit_post']>0){
            $edit_id_post = (int)$_POST['edit_post_id'];
            $error_array = array();
            $post_gname = $_POST['slide_title'];
            $post_gdesc = $_POST['slide_desc'];
            $post_img_name = $_POST['img_name'];
            $post_slide_price = $_POST['slide_price'];
            if($edit_id_post>0){
                $result_edit_post = run_q('SELECT slide_id FROM `slides` WHERE slide_id='.$edit_id_post);
                $edit_num_rows_post = mysql_num_rows($result_edit_post);
                if($edit_num_rows_post>0){
                    if(mb_strlen($post_gname,'UTF-8')<4){
                        $error_array['post_slide_title'] = '<span style="color:red;font-weight:bold;">Името на слайда</span> е твърде кратко!';
                    }
                    if(mb_strlen($post_gname,'UTF-8')>200){
                        $error_array['post_slide_title'] = '<span style="color:red;font-weight:bold;">Името на слайда</span> е твърде дълго - макс 200!';
                    }
                    if(mb_strlen($post_gdesc,'UTF-8')<4){
                        $error_array['post_slide_desc'] = '<span style="color:red;font-weight:bold;">Описанието на слайда</span> е твърде кратко!';
                    }
                    if(mb_strlen($post_gdesc,'UTF-8')>20000){
                        $error_array['post_slide_desc'] = '<span style="color:red;font-weight:bold;">Описанието на слайда</span> е твърде дълго - макс 20 000!';
                    }
                    if (count($error_array) == 0) {
                        run_q('UPDATE `slides` SET slide_title="'.$post_gname.'",slide_desc="'.$post_gdesc.'",img_name="'.$post_img_name.'",slide_price="'.$post_slide_price.'" WHERE slide_id='.$edit_id_post);
                        redirect('slider.php?editid='.$edit_id_post.'&succ_edit=1');
                    }
                    else {
                        mysql_error();
                    }
                    
                }else {
                    echo 'Тази страница не съществува!';
                }
            }else {
                echo 'Хакерче!';
            }
            // error validation
            // run_q
            // redirect
}


if(isset($_GET['editid'])){
    $editid = (int)$_GET['editid'];
    $hidden_mode = 'edit_post';
    $edit_post_id = $editid;
    $edit_result = run_q('SELECT * FROM `slides` WHERE slide_id='.$editid);
    $edit_row = mysql_fetch_array($edit_result);
    $gname = $edit_row['slide_title'];
    $gdesc = $edit_row['slide_desc'];
    $img_name = $edit_row['img_name'];
    $slide_price = $edit_row['slide_price'];
    $btn_value = 'Запази';
}
else {
    $hidden_mode = 'new_post';
    $gname = '';
    $gdesc = '';
    $btn_value = 'Нов слайд';
    $img_name = 'no_image.jpg';
    $slide_price = '??.??';
}

if(isset($_GET['deleteid'])){
            $deleteid=(int)$_GET['deleteid'];
            if($deleteid>0){
                $result_delete = run_q('SELECT slide_id FROM `slides` WHERE slide_id='.$deleteid);
                $delete_num_rows = mysql_num_rows($result_delete);
                if($delete_num_rows>0){
                        run_q('DELETE FROM `slides` WHERE slide_id='.$deleteid); // След това изтривам слайда
                        redirect('slider.php?succ_del=1');
                }
                else { echo '<h2 style="color:red;margin: 25px 0 0 35px;">Няма такъв слайд!</h2>';}
            }
            else {echo '<h2 style="color:red;margin: 25px 0 0 35px;">Нещо не е наред :)!</h2>';}
}



if(isset($_GET['succ_add']) && $_GET['succ_add']==1){
 echo '<div class="information_box" style="background: #e7f7cf;width: 780px;height: 50px;border: 1px solid #8bc90d;margin: 10px 0 15px 0px; color: #416115; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 20px;" src="../img/succ.jpg" /><span style="font-weight: bold;">Новия слайд беше добавен успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="slider.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="../img/succ_close.jpg" /></a></div>';
}
if(isset($_GET['succ_edit']) && $_GET['succ_edit']==1){
 echo '<div class="information_box" style="background: #f7f3c6;width: 760px;height: 50px;border: 1px solid #d2af0c;margin: 10px 0 15px 0px; color: #8c791e; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="../img/succ_edit.jpg" /><span style="font-weight: bold;">Слайда беше редактиран успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="slider.php"><img style="position: relative;top:5px;margin: 0 20px 0 40px;" src="../img/succ_edit_close.jpg" /></a></div>';   
}
if(isset($_GET['succ_del']) && $_GET['succ_del']==1){
 echo '<div class="information_box" style="background: #f6e0e0;width: 700px;height: 50px;border: 1px solid #dd0b0b;margin: 10px 0 15px 0px; color: #901313; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="../img/succ_del.jpg" /><span style="font-weight: bold;">Слайда беше изтрит успешно!</span> Това действие неможе да бъде отменено.<a href="slider.php"><img style="position: relative;top:5px;margin: 0 20px 0 40px;" src="../img/succ_del_close.jpg" /></a></div>';   
}
?>
<script type="text/javascript" language="javascript">
    function question(){
        var quest = confirm("Сигурни ли сте, че искате да изтриете този слайд ?\nТова действие неможе да бъде отменено !!! ");
        if (quest){return true;} else{return false;}
    }
</script>
            <h3>СЛАЙДОВЕ:</h3>
            <div id="adm_table_field">
                <table class="categories_table">
                    <tr class="tbl_head">
                        <td>Име на слайда</td>
                        <td>Описание на промоцията</td>
                        <td>Цена</td>
                        <td>Снимка</td>
                        <td>Инструменти</td>
                    </tr>
<?php 
                    while ($row = mysql_fetch_array($result)) {
                        //$short_desc = mb_substr($row['page_desc'], 0, 400, 'UTF-8');
                        echo '<tr>
                        <td style="width:180px;font-weight:bold;">'.$row['slide_title'].'</td>
                        <td>'.$row['slide_desc'].'</td>
                        <td>'.$row['slide_price'].'</td>
                        <td style="text-align:center;"><img style="width:300px;" src="../img/slider/'.$row['img_name'].'"/></td>
                        <td style="vertical-align:middle;"><a href="../showpage.php?id='.$row['slide_id'].'" class="icon_btn"><img src="../img/icons/preview.png"/></a><a href="slider.php?editid='.$row['slide_id'].'#formm" class="icon_btn"><img src="../img/icons/edit.png"/></a><a onClick="return question();" href="slider.php?deleteid='.$row['slide_id'].'" class="icon_btn"><img src="../img/icons/delete.png"/></a></td>
                    </tr>';
                    }
?>                    <tr class="tbl_head">
                        <td>Продукт</td>
                        <td>Описание на промоцията</td>
                        <td>Цена</td>
                        <td>Снимка</td>
                        <td>Инструменти</td>
                    </tr>
                </table>
            </div>
                <a id="formm"></a>
                <form method="post" action="slider.php">
                <div id="submit_group_field">
                    <div class="input_field" style="margin: 0 0 10px 0px;">
                        <label for="pname">Име на картинката:</label>
                        <input type="text" id="pname" name="img_name" value="<?php echo $img_name ?>" />
                    </div>
                    <div class="input_field" style="margin: 0 0 10px 0px;">
                        <label for="pname">Име на слайда:</label>
                        <input type="text" id="pname" name="slide_title" value="<?php echo $gname ?>" />
                    </div>
                    <div class="input_field" style="margin: 0 0 10px 0px;">
                        <label for="slide_price">Цена:</label>
                        <input type="text" id="slide_price" name="slide_price" value="<?php echo $slide_price ?>" />
                    </div>
                    <div class="input_field" style="margin: 0 0 10px 0px;">
                        <label for="slide_desc">Описание:</label>
                        <input type="text" id="slide_desc" name="slide_desc" value="<?php echo $gdesc ?>" />
                    </div>
                    <div style="clear: both;"></div>
                    <input type="hidden" value="1" name="<?php echo $hidden_mode; ?>" />
                    <?php if(isset ($edit_post_id)){echo '<input type="hidden" name="edit_post_id" value="'.$edit_post_id.'"/>';} ?>
                    <input id="save_btn" type="submit" style="margin: 10px 0 180px 0px;" name="submit" value="<?php echo $btn_value ?>" />
                </div>
                </form>