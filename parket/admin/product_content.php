<?php 
if(isset($_GET['group'])){
    $get_group = (int)$_GET['group'];
    $group_url = ' WHERE group_id='.$get_group;
}
else {
    $group_url = '';
}
$result = run_q('SELECT * FROM products '.$group_url.' ');
?>
            <div id="adm_table_field">
                <p><strong>Покажи:</strong> 
                    <a href="index.php">Всички</a> | 
                    <?php 
                        $group_url_result = run_q('SELECT group_id,gname FROM `group`');
                        while ($group_url_row = mysql_fetch_array($group_url_result)){
                            echo '<a href="index.php?group='.$group_url_row['group_id'].'">'.$group_url_row['gname'].'</a> | ';
                        }
                    ?>
                <table>
                    <tr class="tbl_head">
                        <td>Продукт</td>
                        <td>Код</td>
                        <td>Име на продукта</td>
                        <td>Група</td>
                        <td>Размери</td>
                        <td>Производител</td>
                        <td>Промо</td>
                        <td>Цена</td>
                        <td>Инструменти</td>
                    </tr>
<?php 
                    while ($row = mysql_fetch_array($result)) {
                        switch ($row['is_promo']){
                            case 1:
                                $promo = '<img style="outline:0;" src="../img/admin/is_promo.png" />';
                                break;
                            case 2:
                                $promo = '--';
                                break;
                        }
                        $group_result = run_q('SELECT `gname` FROM `group` WHERE group_id='.$row['group_id']);
                        $group_row = mysql_fetch_array($group_result);
                        $group_name = $group_row['gname'];
                        echo '<tr>
                        <td><a href="add_product.php?editid='.$row['product_id'].'" class="adm_thumb_box"><img src="../img/product_img/'.$row['img_name'].'"/></a></td>
                        <td>'.$row['pcode'].'</td>
                        <td>'.$row['pname'].'</td>
                        <td>'.$group_name.'</td>
                        <td>'.$row['psize'].'</td>
                        <td>'.$row['producer'].'</td>
                        <td>'.$promo.'</td>
                        <td>'.$row['pfinal_price'].'</td>
                        <td><a href="../products.php?group='.$row['group_id'].'" class="icon_btn"><img src="../img/icons/preview.png"/></a><a href="add_product.php?editid='.$row['product_id'].'" class="icon_btn"><img src="../img/icons/edit.png"/></a><a onClick="return question();" href="add_product.php?deleteid='.$row['product_id'].'" class="icon_btn"><img src="../img/icons/delete.png"/></a></td>
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
                        <td>Размери</td>
                        <td>Производител</td>
                        <td>Промо</td>
                        <td>Цена</td>
                        <td>Инструменти</td>
                    </tr>
                </table>
                <a id="add_product_btn" href="add_product.php">Добави нов продукт!</a>
            </div>
