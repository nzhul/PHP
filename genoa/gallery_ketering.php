<?php 
include './cfg.php';
include 'inc/functions.php';
?>
<?php 
headerz(3);
?>
<div style="width: 1065px;height: auto;">
    <h3 class="vera_cruz" style="margin: 30px 0 0 30px;font-size: 40px;">Кетеринг Генуа -Галерия:</h3>
    <div style="width: 1055px;height: auto;float: left;margin: 10px 0 0 0px;padding: 0 0 0 10px;">
        <?php
        $result = run_q('SELECT cat_id,ctitle from menu_ket');
        while ($row = mysql_fetch_array($result)){
            echo '<h4 style="margin: 20px 0 0 18px;">'.$row['ctitle'].'</h4>';
            echo '<div style="overflow:hidden;height:1px;width:95%;background:red;clear:both;margin: 20px 0px 0 20px;display:block;float:left;"></div>';
            $item_result = run_q('SELECT * FROM items_ket WHERE pic_name!="no_picture.jpg" AND cat_id='.$row['cat_id']);
            while ($items_row = mysql_fetch_array($item_result)){
                $short_title = mb_substr($items_row['item_name'], 0, 20, 'UTF-8');
                echo '<div class="thumb_box">
        <a class="lightbox gallery_lightbox_link" href="img/upload/'.$items_row['pic_name'].'" title="'.$items_row['item_name'].'">
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