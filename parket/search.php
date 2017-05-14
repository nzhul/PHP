<?php
require 'cfg.php';
require 'functions.php';
headerz(1,2);
?>
<div id="product_front_container">    
<?php
require 'inc/left_navigation.php';


?>
<div class="path_box">Прудикти > <strong>Търсачка</strong></div>
<?php
require 'inc/search_products.php';
?>
<div class="path_box" style="margin: 0 5px 10px 0px;">Прудикти > <strong>Търсачка</strong></div>
</div>
<div style="clear: both;"></div>
<?php
require 'inc/footer.php';
?>