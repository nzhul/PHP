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
        
<script type="text/javascript" src="advancedslider/examples/jquery.advancedSlider.min.js"></script>
<link rel="stylesheet" type="text/css" href="advancedslider/examples/advanced-slider.css" media="screen"/>
<!--[if IE]><script type="text/javascript" src="advancedslider/examples/excanvas.compiled.js"></script><![endif]-->

<script type="text/javascript">

	$(document).ready(function(){
		$('.slider').advancedSlider({width:1024, height:458,navigationButtons:false, hideTimer:false, slideProperties:{
        0:{effectType:'scale', horizontalSlices:'6', verticalSlices:'3', slicePattern:'spiralCenterToMarginCW', sliceDelay:'80',
            captionSize:'35', captionHideEffect:'slide'},
        1:{effectType:'fade', horizontalSlices:'1', verticalSlices:'1', slicePattern:'leftToRight', captionPosition:'custom',
            captionShowEffect:'fade', captionHeight:120, slideshowDelay:12000},
        2:{effectType:'slide', horizontalSlices:'10', verticalSlices:'1', slicePattern:'rightToLeft', sliceDuration:'700'},
        3:{effectType:'height', horizontalSlices:'10', verticalSlices:'1', slicePattern:'leftToRight', slicePoint:'centerBottom',
            sliceDuration:'500', captionSize:'45'},
        4:{effectType:'scale', horizontalSlices:'10', verticalSlices:'5', sliceDuration:'800'},
        5:{effectType:'height', horizontalSlices:'1', verticalSlices:'15', slicePattern:'bottomToTop', slicePoint:'centerTop',
            sliceDuration:'700', captionPosition:'left', captionSize:'150', captionHideEffect:'slide'},
        6:{effectType:'slide', horizontalSlices:'6', verticalSlices:'3', slicePattern:'topLeftToBottomRight', 
            slideStartPosition:'rightBottom', slideStartRatio:'0.5', sliceDuration:'700'},
        7:{effectType:'fade', horizontalSlices:'10', verticalSlices:'5'},
        8:{effectType:'slide', horizontalSlices:'15', verticalSlices:'1', slideMask:'true', slicePattern:'rightToLeft', 
            slideStartPosition:'verticalAlternative', sliceDuration:'800'},
        9:{effectType:'fade', horizontalSlices:'10', verticalSlices:'5'}
}
									});
	});
	
</script>
<script src="js/jquery.tools.min.js" type="text/javascript"></script>
    </head>
    <body style="background: black url(img/bg1_70.jpg) no-repeat top center">
        <div id="super_wrapper">
            <div id="logo_box">
                <h1 style="margin: 0 0 -8px 0px;"><a href="index.php">ПАРКЕТИ</a><span style="color:#fca503;">&</span><a href="index.php">ТАПЕТИ</a></h1>
                <h5 style="font-family: Tahoma;margin: 0 0 0 0px;color: #c6c6c6;">НАЙ-ЯКИТЕ ПАРКЕТИ И ТАПЕТИ НА ПАЗАРА</h5>
            </div>
            <div id="content_wrapper">
                <div id="navigation">
                    <ul class="sf-menu">
                        <li>
                            <a href="index.php">НАЧАЛО</a>
                        </li>
                        <li class="current">
                            <a href="products.php">ПРОДУКТИ</a>
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
                            echo '<li><a href="page.php?id='.$page_row['page_id'].'">'.$page_row['page_name'].'</a></li>';
                        }
                        ?>
                    </ul>
                    <div id="search"><input type="text"/><input type="submit" value="ТЪРСИ"/></div>
                </div>
                <div style="clear:both;"></div>