<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Административен панел</title>
        <link rel="stylesheet" href="admin-styles/admin.css" type="text/css"/>
        <link rel="stylesheet" href="../css/modal.css"/>
        <link rel="stylesheet" href="scripts/jcrop/css/jquery.Jcrop.css"/>
        <script src="../scripts/libs/jquery-2.1.1.min.js"></script>
        <script src="scripts/jquery.form.js"></script>
        <script src="scripts/modal.js"></script>
        <script src="scripts/jcrop/js/jquery.Jcrop.js"></script>
        <script src="scripts/photo-upload.js"></script>
    </head>
    <body>
        <div id="super_wrapper">
            <div id="logo_box">
                <h1 style="margin: 0 0 -8px 0px;"><a href="index.php">св</a><span style="color:#fca503;">.</span><a href="index.php">Мария</a></h1>
                <h5 style="font-family: Tahoma;font-size: 16px;margin: 0 0 0 0px;color: white;">АДМИНИСТРАТИВЕН ПАНЕЛ</h5>
                <?php if (isset($_SESSION['is_loggedd'])){echo '<div id="logout_field">Добре дошъл, Ники - <a href="logout.php">Излез</a></div>';} ?>
            </div>
            <div id="adm_navigation">
                <a href="index.php">ГАЛЕРИЯ</a>
                <a href="categories.php">ГРУПИ СНИМКИ</a>
                <a href="slider.php">СЛАЙДЕР</a>
            </div>