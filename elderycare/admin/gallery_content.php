<?php
if(isset($_GET['category'])){
    $get_category = (int)$_GET['category'];
    $category_url = ' WHERE category_id='.$get_category;
}
else {
    $category_url = '';
}
$result = run_q('SELECT photo_id, filename FROM photos '.$category_url.' ');
?>

<p><strong>Покажи:</strong>
    <a href="index.php">Всички</a> |
    <?php
    $category_url_result = run_q('SELECT category_id, name FROM `categories`');
    while ($category_url_row = mysql_fetch_array($category_url_result)){
        echo '<a href="index.php?category='.$category_url_row['category_id'].'">'.$category_url_row['name'].'</a> | ';
    }
    ?>

<h3>ГАЛЕРИЯ:</h3>
<div style="clear:both;">&nbsp;</div>
<div id="adm_table_field">
    <?php
    while ($row = mysql_fetch_array($result)) {
        echo '<div class="adm_thumb_box">
        <a href="add_photo.php?editid='.$row['photo_id'].'"><img src="../img/gallery/thumbs/'.$row['filename'].'" alt=""/></a><br/>
        <a href="../index.html#gallery" class="icon_btn"><img src="img/icons/preview.png"/></a>
        <a href="add_photo.php?editid='.$row['photo_id'].'" class="icon_btn"><img src="img/icons/edit.png"/></a>
        <a onClick="return question();" href="add_photo.php?deleteid='.$row['photo_id'].'" class="icon_btn"><img src="img/icons/delete.png"/></a>
    </div>';
    }
    ?>
    <script type="text/javascript" language="javascript">
        function question(){
            var quest = confirm("Сигурни ли сте, че искате да изтриете тази снимка ?\nТова действие неможе да бъде отменено !!! ");
            if (quest){return true;} else{return false;}
        }
    </script>
</div>
<div style="clear: both; margin: 0 0 20px 0px;">&nbsp;</div>
<a id="add_product_btn" href="add_photo.php">Добави нова снимка!</a>
<div style="clear: both; margin: 10px 0 50px 0px;">&nbsp;</div>