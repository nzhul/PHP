<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Административен панел</title>
        <link rel="stylesheet" href="../css/admin.css" type="text/css"/>
           <script type="text/javascript" src="../js/jquery.1.5.1.min.js"></script> <!-- JQuery Offline -->
        <!--<script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">google.load("jquery", "1.5.1");</script> JQuery ONLINE - В МОМЕНТА Е СПРЯНО ЗАЩОТО НЕТА НИ НЕ СТРУВА -->
        <script type="text/javascript" src="../js/jquery.form.js"></script>
        <script type="text/javascript" src="../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

        <script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "textareas"
});
        </script>


    </head>
    <body>
        <div id="super_wrapper">
            <div id="logo_box">
                <h1 style="margin: 0 0 -8px 0px;"><a href="index.php">ПАРКЕТИ</a><span style="color:#fca503;">&</span><a href="index.php">ТАПЕТИ</a></h1>
                <h5 style="font-family: Tahoma;font-size: 16px;margin: 0 0 0 0px;color: white;">АДМИНИСТРАТИВЕН ПАНЕЛ</h5>
                <?php if (isset($_SESSION['is_loggedd'])){echo '<div id="logout_field">Добре дошъл, Ники - <a href="logout.php">Излез</a></div>';} ?>
            </div>
            <div id="adm_navigation">
                <a href="index.php">ПРОДУКТИ</a>
                <a href="categories.php">ГРУПИ ПРОДУКТИ</a>
                <a href="pages.php">СТРАНИЦИ</a>
                <a href="slider.php">СЛАЙДЕР</a>
            </div>