<?php
if(isset($_GET['p'])){
require 'cfg.php';
$product_id = (int)$_GET['p'];
$presult = run_q('SELECT * FROM products WHERE product_id='.$product_id);
$prow = mysql_fetch_array($presult);
if($prow['img_name'] == 'no_picture.jpg'){
    $img_name_fix = 'no_picture_big.jpg';
}
else {
    $img_name_fix = $prow['img_name'];
}
}
else {
$product_name = 'Името на продукта липсва!';
}


if(ae_detect_ie()){
require 'functions.php';
headerz(1,2);
    ?>
<div id="product_front_container">    
<?php
require 'inc/left_navigation.php';
?>
                                        <div class="overlay_pic_column">
                                            <h3 class="overlay_product_title"><?php echo $prow['pname']; ?></h3>
                                            <img src="img/product_img/<?php echo $img_name_fix; ?>" alt="<?php echo $prow['pname']; ?>"/>
                                        </div>
                                        <div class="overlay_info_column">
                                            <h3 class="overlay_product_title" style="margin: 20px 0 0 20px;">ХАРАКТЕРИСТИКИ</h3>
                                            <table class="info_table">
                                                <tr>
                                                    <td><strong>Код на продукта:</strong></td>
                                                    <td><?php echo $prow['pcode']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Дебелина/Клас:</strong></td>
                                                    <td><?php echo $prow['pwidth_class']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Размери:</strong></td>
                                                    <td><?php echo $prow['psize']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Повърхност/Покритие:</strong></td>
                                                    <td><?php echo $prow['psurface']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Производител:</strong></td>
                                                    <td><?php echo $prow['producer']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Цената включва:</strong></td>
                                                    <td><?php echo $prow['pprice_desc']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Цена:</strong></td>
                                                    <td><?php echo $prow['pfinal_price']; ?> лв/m2</td>
                                                </tr>
                                            </table>
                                        </div>
</div>
<div style="clear: both;"></div>
<?php
require 'inc/footer.php';
?>
        
<?php }else { ?>
                                        <div class="overlay_pic_column">
                                            <h3 class="overlay_product_title"><?php echo $prow['pname']; ?></h3>
                                            <img src="img/product_img/<?php echo $img_name_fix; ?>" alt="<?php echo $prow['pname']; ?>"/>
                                            <img src="img/big_shadow.jpg" alt="Сянка"/>
                                        </div>
                                        <div class="overlay_info_column">
                                            <h3 class="overlay_product_title">ХАРАКТЕРИСТИКИ</h3>
                                            <table class="info_table">
                                                <tr>
                                                    <td>Код на продукта:</td>
                                                    <td><?php echo $prow['pcode']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Дебелина/Клас:</td>
                                                    <td><?php echo $prow['pwidth_class']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Размери:</td>
                                                    <td><?php echo $prow['psize']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Повърхност/Покритие:</td>
                                                    <td><?php echo $prow['psurface']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Производител:</td>
                                                    <td><?php echo $prow['producer']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Цената включва:</td>
                                                    <td><?php echo $prow['pprice_desc']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Цена:</td>
                                                    <td><?php echo $prow['pfinal_price']; ?> лв/m2</td>
                                                </tr>
                                            </table>
                                        </div>
<?php } ?>                                        
