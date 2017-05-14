<?php 
include './cfg.php';
include 'inc/functions.php';
?>
<?php 
headerz(3);
?>
<div style="width: 1065px;height:auto;">
    <h3 class="vera_cruz" style="margin: 30px 0 0 30px;font-size: 40px;">Ресторант Генуа -Галерия:</h3>
    <div style="width: 1055px;height: 690px;float: left;margin: 10px 0 0 0px;padding: 0 0 0 10px;">
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/1restaurant_daylight.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/1restaurant_daylight.jpg" style="position: relative;top:0px;" />
        </a>
            <p>ресторант градина</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/restaurant_7.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/restaurant_7.jpg" style="position: relative;top:0px;" />
        </a>
            <p>ресторант градина</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/2masa_outside.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/2masa_outside.jpg" style="position: relative;top:0px;" />
        </a>
            <p>ресторант - градина, вътре</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/restaurant_1.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/restaurant_1.jpg" style="position: relative;top:0px;" />
        </a>
            <p>ресторант - градина, вътре</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/restaurant_4.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/restaurant_4.jpg" style="position: relative;top:0px;" />
        </a>
            <p>ресторант - градина, вътре</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/restaurant_2.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/restaurant_2.jpg" style="position: relative;top:0px;" />
        </a>
            <p>ресторант - градина, вътре</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/restaurant_3.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/restaurant_3.jpg" style="position: relative;top:0px;" />
        </a>
            <p>ресторант - градина, вътре</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/3separe_vutre.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/3separe_vutre.jpg" style="position: relative;top:0px;" />
        </a>
            <p>ВИП сепаре</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/4separe_vutre.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/4separe_vutre.jpg" style="position: relative;top:0px;" />
        </a>
            <p>основен ресторант</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/restaurant_5.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/restaurant_5.jpg" style="position: relative;top:0px;" />
        </a>
            <p>основен ресторант</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/restaurant_6.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/restaurant_6.jpg" style="position: relative;top:0px;" />
        </a>
            <p>основен ресторант</p>
        </div>
        <div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/rest_gallery_upload/restaurant_9.jpg">
            <img class="gallery_thumb" src="img/rest_gallery_upload/thumb/restaurant_9.jpg" style="position: relative;top:0px;" />
        </a>
            <p>основен ресторант</p>
        </div>
    </div>
    <h3 class="vera_cruz" style="margin: 30px 0 0 30px;font-size: 40px;">Кетеринг Генуа -Галерия:</h3>
    <div style="width: 1055px;height: auto;float: left;margin: 10px 0 0 0px;padding: 0 0 0 10px;">
        <?php
        $result = run_q('SELECT cat_id,ctitle from menu');
        while ($row = mysql_fetch_array($result)){
            echo '<h4 style="margin: 20px 0 0 18px;">'.$row['ctitle'].'</h4>';
            echo '<div style="overflow:hidden;height:1px;width:95%;background:red;clear:both;margin: 20px 0px 0 20px;display:block;float:left;"></div>';
            $item_result = run_q('SELECT * FROM items WHERE pic_name!="no_picture.jpg" AND cat_id='.$row['cat_id']);
            while ($items_row = mysql_fetch_array($item_result)){
                $short_title = mb_substr($items_row['item_name'], 0, 20, 'UTF-8');
                echo '<div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/upload/'.$items_row['pic_name'].'">
            <img class="gallery_thumb" src="img/upload/thumb_'.$items_row['pic_name'].'" style="position: relative;top:0px;" />
        </a>
            <p>'.$short_title.'</p>
        </div>';
            }
            echo '<div style="clear:both;">&nbsp;</div>';
        }
        ?>
    </div>
    <div style="clear:both;">&nbsp;</div>
    <!--<div style="float:right;height: 60px;width: auto;margin: 20px 30px 0 0px;">
        <a href="" style="width: 60px;" class="pag_btn"><<</a> <a href="" class="pag_btn" style="background-color: #d82427;">1</a> <a href="" class="pag_btn">2</a> <a href="" class="pag_btn">3</a> <a href="" class="pag_btn">4</a><a href="" style="width: 60px;" class="pag_btn">>></a>
    </div>-->
</div>


<?php 
include 'inc/footer.php';
?>