<?php 
if(isset($_GET['group'])){
    $get_group = (int)$_GET['group'];
    $group_url = ' WHERE cat_id='.$get_group;
}
else {
    $group_url = '';
}
$result = run_q('SELECT * FROM items '.$group_url.' ORDER BY item_id DESC  ');
?>
            <div id="adm_table_field">
                <p><strong>Покажи:</strong> 
                    <a href="index.php">Всички</a> | 
                    <?php 
                        $group_url_result = run_q('SELECT cat_id,ctitle FROM `menu`');
                        while ($group_url_row = mysql_fetch_array($group_url_result)){
                            echo '<a href="index.php?group='.$group_url_row['cat_id'].'">'.$group_url_row['ctitle'].'</a> | ';
                        }
                    ?>
                <table>
                    <tr class="tbl_head">
                        <td>Продукт</td>
                        <td>ID</td>
                        <td style="text-align: left;padding: 0 0 0 15px;">Име на продукта</td>
                        <td>Група</td>
                        <td>Тегло</td>
                        <td>Цена</td>
                        <td>Инструменти</td>
                    </tr>
<?php 
                    while ($row = mysql_fetch_array($result)) {
                        $group_result = run_q('SELECT `ctitle` FROM `menu` WHERE cat_id='.$row['cat_id']);
                        $group_row = mysql_fetch_array($group_result);
                        $group_name = $group_row['ctitle'];
                        echo '<tr>
                        <td><a class="adm_ket_pic_link"><img src="../img/upload/minithumb_'.$row['pic_name'].'"/></a></td>
                        <td>'.$row['item_id'].'</td>
                        <td style="text-align: left;padding: 0 0 0 15px;">'.$row['item_name'].'</td>
                        <td style="text-align: left;padding: 0 0 0 15px;">'.$group_name.'</td>
                        <td>'.$row['item_weight'].' гр</td>
                        <td>'.$row['item_price'].' лв</td>
                        <td><a href="../menu.php" class="icon_btn"><img src="../img/icons/preview.png"/></a><a href="add_item.php?editid='.$row['item_id'].'" class="icon_btn"><img src="../img/icons/edit.png"/></a><a onClick="return question();" href="add_item.php?deleteid='.$row['item_id'].'" class="icon_btn"><img src="../img/icons/delete.png"/></a></td>
                    </tr>';
                    }
?>                    
<script type="text/javascript" language="javascript">
    function question(){
        var quest = confirm("Сигурни ли сте, че искате да изтриете този продукт ?\nТова действие неможе да бъде отменено !!! ");
        if (quest){return true;} else{return false;}
    }
</script>
                    <tr class="tbl_head">
                        <td>Продукт</td>
                        <td>Код</td>
                        <td>Име на продукта</td>
                        <td>Група</td>
                        <td>Тегло</td>
                        <td>Цена</td>
                        <td>Инструменти</td>
                    </tr>
                </table>
                <a id="add_product_btn" href="add_item.php">Добави нов продукт!</a>
            </div>
