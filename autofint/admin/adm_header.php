<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Autofint - Заявка</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/admin.css" type="text/css"/>
        <link rel="stylesheet" href="../css/styleOrange.css" type="text/css"/>
        <link rel="stylesheet" href="../css/print.css" type="text/css" media="print" />
    </head>
    <body>
        <div id="super_wrapper">
            <div id="logo_box">
                <h1 style="margin: 0 0 -8px 0px;"><a href="index.php">AUTOFINT</a></h1>
                <h5 style="font-family: Tahoma;font-size: 16px;margin: 0 0 0 0px;color: white;">АДМИНИСТРАТИВЕН ПАНЕЛ</h5>
                <?php if (isset($_SESSION['is_logged'])){echo '<div id="logout_field">Добре дошли - <a href="logout.php">Излез</a></div>';} ?>
            </div>
            <div id="adm_navigation">
                <a href="index.php">СПЕДИЦИЯ</a>
                <a href="fleet_page.php">ФЛИЙТ МЕНИДЖМЪНТ</a>
            </div>