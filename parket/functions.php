<?php
function headerz($home=1,$products=1){
    switch ($home){
        case 1:
            $home_active = '';
            break;
        case 2:
            $home_active = 'class="active_nav_btn"';
            break;
    }
    switch ($products){
        case 1:
            $products_active = '';
            break;
        case 2:
            $products_active = 'class="active_nav_btn"';
            break;
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Паркети и тапети - коректност и качество</title>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
           <script type="text/javascript" src="js/jquery.1.5.1.min.js"></script> <!-- JQuery Offline -->
        <!--<script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">google.load("jquery", "1.5.1");</script> JQuery ONLINE - В МОМЕНТА Е СПРЯНО ЗАЩОТО НЕТА НИ НЕ СТРУВА -->
        <link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen">
        <script type="text/javascript" src="js/superfish.js"></script>
        <script type="text/javascript" src="js/hoverIntent.js"></script>
        <script type="text/javascript">

        // initialise plugins
        jQuery(function(){
            jQuery('ul.sf-menu').superfish();
        });
        </script>
        
<?php 
if($home == 2){
    require 'inc/slider_script.php';
}
?>
        <script> 
            $(document).ready(function() {

// you can override default options globally, so they apply to every .expander() call
$.expander.defaults.slicePoint = 520;

$(document).ready(function() {
  // simple example, using all default options unless overridden globally
  $('div.expandable').expander();

  // *** OR ***

  // override default options (also overrides global overrides)
  $('div.expandable').expander({
    slicePoint:       80,  // default is 100
    expandPrefix:     ' ', // default is '... '
    expandText:       '[...]', // default is 'read more'
    collapseTimer:    5000, // re-collapses after 5 seconds; default is 0, so no re-collapsing
    userCollapseText: '[^]'  // default is 'read less'
  });

});

            });
        </script> 
<script type="text/javascript" src="js/jquery.expander.js"></script>
<script src="js/jquery.tools.min.js" type="text/javascript"></script>
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="css/ie_sux.css" />
<![endif]-->
    </head>
    <body style="background: black url(img/bg1_70.jpg) no-repeat top center">
        <div id="super_wrapper">
            <div id="logo_box">
                <h1 style="margin: 0 0 -8px 0px;"><a href="index.php">ПАРКЕТИ</a><span style="color:#fca503;">&</span><a href="index.php">ТАПЕТИ</a></h1>
                <h5 style="font-family: Tahoma;margin: 0 0 0 0px;color: #c6c6c6;">КОРЕКТНОСТ & КАЧЕСТВО НА ИЗГОДНА ЦЕНА</h5>
            </div>
            <div id="content_wrapper">
                <div id="navigation">
                    <ul class="sf-menu">
                        <li>
                            <a style="border: 0px;" <?php echo $home_active; ?> href="index.php">НАЧАЛО</a>
                        </li>
                        <li class="current">
                            <a <?php echo $products_active; ?> href="products.php">ПРОДУКТИ</a>
                            <ul>
                                <?php 
                                $group_result = run_q('SELECT group_id,gname FROM `group`');
                                while ($group_row = mysql_fetch_array($group_result)){
                                    echo '<li><a href="products.php?group='.$group_row['group_id'].'">'.$group_row['gname'].'</a></li>';
                                }
                                ?>
                            </ul>
                        </li>
                        <?php 
                        $page_result = run_q('SELECT page_id,page_name FROM pages');
                        while ($page_row = mysql_fetch_array($page_result)){
                            if(isset($_GET['id'])){
                                if($page_row['page_id'] == $_GET['id']){
                                    $page_active = 'class="active_nav_btn"';
                                }
                                else {$page_active = '';}
                            }
                            else $page_active = '';
                            echo '<li><a '.$page_active.' href="page.php?id='.$page_row['page_id'].'">'.$page_row['page_name'].'</a></li>';
                        }
                        ?>
                    </ul>
                    <div id="search"><form method="post" action="search.php"><input type="text" id="keyword" name="keyword"/><input type="submit" id="search_submit" name="search" value="ТЪРСИ"/></form></div>
                </div>
                <div style="clear:both;"></div>
<?php
}
?>
