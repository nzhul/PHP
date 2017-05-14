<?php
require 'cfg.php';
require 'functions.php';
headerz(2,1);
require 'inc/slider.php';
?>
<div style="clear: both;">&nbsp;</div>
<div id="welcome_box">
    <div id="quality_propriety">КОРЕКТНОСТ & КАЧЕСТВО</div><div id="welcome_text">Фирмата ни е специализирана в продажбата и монтажа на ламиниран и естествен паркет ,предлагаме голямо разнообразие от различни декори ламиниран паркет, класическия дъбов и буков паркет.  [ <a href="page.php?id=4">Научете повече за нас</a> ]</div>
</div>
<div id="product_front_container">
<?php 
require 'inc/left_navigation.php';
require 'inc/featured_products.php';
?>
    <div style="clear: both;"></div>
</div>
<?php
require 'inc/footer.php';
?>