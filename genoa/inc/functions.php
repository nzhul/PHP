<?php
function headerz($active=1){
    switch ($active){
        case 1:
            $home = 'active_nav_btn';
            $menu = '';
            $gallery = '';
            $ketering = '';
            $contact = '';
            break;
        case 2:
            $home = '';
            $menu = 'active_nav_btn';
            $gallery = '';
            $ketering = '';
            $contact = '';
            break;
        case 3:
            $home = '';
            $menu = '';
            $gallery = 'active_nav_btn';
            $ketering = '';
            $contact = '';
            break;
        case 4:
            $home = '';
            $menu = '';
            $gallery = '';
            $ketering = 'active_nav_btn';
            $contact = '';
            break;
        case 5:
            $home = '';
            $menu = '';
            $gallery = '';
            $ketering = '';
            $contact = 'active_nav_btn';
            break;
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ресторант Генуа</title>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
           <!--<script type="text/javascript" src="js/jquery.1.5.1.min.js"></script>  JQuery Offline -->
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">google.load("jquery", "1.5.1");</script> 
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="css/ie_sux.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="js/lightbox/themes/default/jquery.lightbox.css" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="js/lightbox/themes/default/jquery.lightbox.ie6.css" /><![endif]-->
<script type="text/javascript" src="js/lightbox/jquery.lightbox.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.lightbox').lightbox();
  });  
  $(function() {
			$('#bgeffect_activate').click(function() {
					$('#bgeffect').fadeIn("slow");
					$('#bgeffect_skull').fadeIn("slow");
				});
		});
</script>
    </head>
    <body style="background: #002e6e url(img/bg1_70.jpg) no-repeat top center">
        <div id="super_wrapper">
            <div id="logo_box">
                <a href="index.php" title="Ресторант Генуа"><img src="img/genoa_logo.png" alt="Ресторант Генуа"/></a>
            </div>
            <div id="navigation">
                <a href="index.php" class="nav_btn <?php echo $home; ?>">НАЧАЛО</a>
                <a href="menu.php" class="nav_btn <?php echo $menu; ?>">МЕНЮ</a>
                <a href="gallery.php" class="nav_btn <?php echo $gallery; ?>">ГАЛЕРИЯ</a>
                <!--<a href="ketering.php" class="nav_btn <?php echo $ketering; ?>">КЕТЪРИНГ</a>-->
                <a href="contact.php" class="nav_btn <?php echo $contact; ?>">КОНТАКТИ</a>
            </div>
            <div id="nav_underline"></div>
            <div id="index_white_field">
<?php 
}
?>
