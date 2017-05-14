<?php 
$result = run_q('SELECT * FROM `pages`');
?>
<?php 
if(isset ($_POST['new_post']) && $_POST['new_post']>0){
            $error_array = array();
            $post_gname = mysql_real_escape_string($_POST['gname']);
            $post_gdesc = mysql_real_escape_string($_POST['gdesc']);
            
            if(mb_strlen($post_gname,'UTF-8')<4){
                $error_array['post_gname'] = '<span style="color:red;font-weight:bold;">Името на страницата</span> е твърде кратко!';
            }
            if(mb_strlen($post_gname,'UTF-8')>200){
                $error_array['post_gname'] = '<span style="color:red;font-weight:bold;">Името на страницата</span> е твърде дълго - макс 200!';
            }
            if(mb_strlen($post_gdesc,'UTF-8')<4){
                $error_array['post_gdesc'] = '<span style="color:red;font-weight:bold;">Описанието на страницата</span> е твърде кратко!';
            }
            if(mb_strlen($post_gdesc,'UTF-8')>20000){
                $error_array['post_gdesc'] = '<span style="color:red;font-weight:bold;">Описанието на страницата</span> е твърде дълго - макс 20 000!';
            }
            if (count($error_array) == 0) {
                run_q('INSERT INTO `pages` (page_name,page_desc,date_added) VALUES ("'.$post_gname.'","'.$post_gdesc.'",'.time().')');
                redirect('pages.php?succ_add=1');
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
            $post_gname = mysql_real_escape_string($_POST['gname']);
            $post_gdesc = mysql_real_escape_string($_POST['gdesc']);
            if($edit_id_post>0){
                $result_edit_post = run_q('SELECT page_id FROM `pages` WHERE page_id='.$edit_id_post);
                $edit_num_rows_post = mysql_num_rows($result_edit_post);
                if($edit_num_rows_post>0){
                    if(mb_strlen($post_gname,'UTF-8')<4){
                        $error_array['post_gname'] = '<span style="color:red;font-weight:bold;">Името на страницата</span> е твърде кратко!';
                    }
                    if(mb_strlen($post_gname,'UTF-8')>200){
                        $error_array['post_gname'] = '<span style="color:red;font-weight:bold;">Името на страницата</span> е твърде дълго - макс 200!';
                    }
                    if(mb_strlen($post_gdesc,'UTF-8')<4){
                        $error_array['post_gdesc'] = '<span style="color:red;font-weight:bold;">Описанието на страницата</span> е твърде кратко!';
                    }
                    if(mb_strlen($post_gdesc,'UTF-8')>20000){
                        $error_array['post_gdesc'] = '<span style="color:red;font-weight:bold;">Описанието на страницата</span> е твърде дълго - макс 20 000!';
                    }
                    if (count($error_array) == 0) {
                        run_q('UPDATE `pages` SET page_name="'.$post_gname.'",page_desc="'.$post_gdesc.'" WHERE page_id='.$edit_id_post);
                        redirect('pages.php?editid='.$edit_id_post.'&succ_edit=1');
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
    $edit_result = run_q('SELECT * FROM `pages` WHERE page_id='.$editid);
    $edit_row = mysql_fetch_array($edit_result);
    $gname = $edit_row['page_name'];
    $gdesc = $edit_row['page_desc'];
    $btn_value = 'Запази';
}
else {
    $hidden_mode = 'new_post';
    $gname = '';
    $gdesc = '';
    $btn_value = 'Нова страница';
}

if(isset($_GET['deleteid'])){
            $deleteid=(int)$_GET['deleteid'];
            if($deleteid>0){
                $result_delete = run_q('SELECT page_id FROM `pages` WHERE page_id='.$deleteid);
                $delete_num_rows = mysql_num_rows($result_delete);
                if($delete_num_rows>0){
                        run_q('DELETE FROM `pages` WHERE page_id='.$deleteid); // След това изтривам страницата
                        redirect('pages.php?succ_del=1');
                }
                else { echo '<h2 style="color:red;margin: 25px 0 0 35px;">Няма такава страница!</h2>';}
            }
            else {echo '<h2 style="color:red;margin: 25px 0 0 35px;">Нещо не е наред :)!</h2>';}
}



if(isset($_GET['succ_add']) && $_GET['succ_add']==1){
 echo '<div class="information_box" style="background: #e7f7cf;width: 780px;height: 50px;border: 1px solid #8bc90d;margin: 10px 0 15px 0px; color: #416115; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 20px;" src="../img/succ.jpg" /><span style="font-weight: bold;">Новата страница беше добавена успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="pages.php"><img style="position: relative;top:5px;margin: 0 20px 0 30px;" src="../img/succ_close.jpg" /></a></div>';
}
if(isset($_GET['succ_edit']) && $_GET['succ_edit']==1){
 echo '<div class="information_box" style="background: #f7f3c6;width: 760px;height: 50px;border: 1px solid #d2af0c;margin: 10px 0 15px 0px; color: #8c791e; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="../img/succ_edit.jpg" /><span style="font-weight: bold;">Страница беше редактирана успешно!</span> Може да проверите в сайта дали всичко е ок.<a href="pages.php"><img style="position: relative;top:5px;margin: 0 20px 0 40px;" src="../img/succ_edit_close.jpg" /></a></div>';   
}
if(isset($_GET['succ_del']) && $_GET['succ_del']==1){
 echo '<div class="information_box" style="background: #f6e0e0;width: 700px;height: 50px;border: 1px solid #dd0b0b;margin: 10px 0 15px 0px; color: #901313; line-height: 50px;padding: 0 0 0 0;"><img style="position: relative;top:3px;margin: 0 40px 0 30px;" src="../img/succ_del.jpg" /><span style="font-weight: bold;">Страница беше изтрита успешно!</span> Това действие неможе да бъде отменено.<a href="pages.php"><img style="position: relative;top:5px;margin: 0 20px 0 40px;" src="../img/succ_del_close.jpg" /></a></div>';   
}
?>
<script type="text/javascript" language="javascript">
    function question(){
        var quest = confirm("Сигурни ли сте, че искате да изтриете тази страница ?\nТова действие неможе да бъде отменено !!! ");
        if (quest){return true;} else{return false;}
    }
</script>
            <h3>СТРАНИЦИ:</h3>
            <div id="adm_table_field">
                <table class="categories_table">
                    <tr class="tbl_head">
                        <td>Име на страницата</td>
                        <td>Описание</td>
                        <td>Инструменти</td>
                    </tr>
<?php 
                    while ($row = mysql_fetch_array($result)) {
                        $short_desc = mb_substr($row['page_desc'], 0, 400, 'UTF-8');
                        echo '<tr>
                        <td style="width:180px;font-weight:bold;">'.$row['page_name'].'</td>
                        <td>'.$short_desc.'</td>
                        <td style="vertical-align:middle;"><a href="../page.php?id='.$row['page_id'].'" title="Прегледай" class="icon_btn"><img src="../img/icons/preview.png"/></a><a href="pages.php?editid='.$row['page_id'].'#formm" title="Редактирай" class="icon_btn"><img src="../img/icons/edit.png"/></a><a onClick="return question();" href="pages.php?deleteid='.$row['page_id'].'" title="Изтрий" class="icon_btn"><img src="../img/icons/delete.png"/></a></td>
                    </tr>';
                    }
?>                    <tr class="tbl_head">
                        <td>Продукт</td>
                        <td>Описание</td>
                        <td>Инструменти</td>
                    </tr>
                </table>
            </div>
                <a id="formm"></a>
                <form method="post" action="pages.php">
                <div id="submit_group_field">
                    <div class="input_field" style="margin: 0 0 10px 0px;">
                        <label for="pname">Име на страницата:</label>
                        <input type="text" id="pname" name="gname" value="<?php echo $gname ?>" />
                    </div>
                    <textarea name="gdesc" id="group_desc_textarea"><?php echo $gdesc ?></textarea>
                    <div style="clear: both;"></div>
                    <input type="hidden" value="1" name="<?php echo $hidden_mode; ?>" />
                    <?php if(isset ($edit_post_id)){echo '<input type="hidden" name="edit_post_id" value="'.$edit_post_id.'"/>';} ?>
                    <input id="save_btn" type="submit" style="margin: 10px 0 180px 0px;" name="submit" value="<?php echo $btn_value ?>" />
                </div>
                </form>