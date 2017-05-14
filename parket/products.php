<?php
require 'cfg.php';
require 'functions.php';
headerz(1,2);
?>
<div id="product_front_container">    
<?php
require 'inc/left_navigation.php';
if(isset($_GET['group'])){
    $group = (int)$_GET['group'];
}
else {
    $group = 1;
}
$group_result = run_q('SELECT * FROM `group` WHERE group_id='.$group);
$group_row = mysql_fetch_array($group_result);
?>
<div class="path_box">Прудикти > <strong><?php echo $group_row['gname'] ?></strong></div>
<div class="desc_box expandable"><?php echo $group_row['gdesc'] ?></div>
<div class="path_box" style="margin: 0 5px 10px 0px;">Прудикти > <strong><?php echo $group_row['gname'] ?></strong></div>
<?php
require 'inc/list_products.php';
?>
</div>
<div style="clear: both;"></div>
<?php
require 'inc/footer.php';
?>