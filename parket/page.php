<?php
require 'cfg.php';
require 'functions.php';
headerz();
?>
<div id="product_front_container">    
<?php
require 'inc/left_navigation.php';
if(isset($_GET['id'])){
    $group = (int)$_GET['id'];
}
else {
    $group = 1;
}
$group_result = run_q('SELECT * FROM `pages` WHERE page_id='.$group);
$group_row = mysql_fetch_array($group_result);
?>
<div class="path_box">Страници > <?php echo $group_row['page_name'] ?></div>
<div class="desc_box"><?php echo $group_row['page_desc'] ?></div>
<div class="path_box" style="margin: 0 5px 20px 0px;">Страници > <?php echo $group_row['page_name'] ?></div>
</div>
<div style="clear: both;"></div>
<?php
require 'inc/footer.php';
?>