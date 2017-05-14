<?php 
include 'cfg.php';
include 'inc/functions.php';
?>
<?php 
headerz(2);
?>

<div id="menu_container" style="min-height: 1050px;">
<h3 class="vera_cruz" style="margin: 10px 0 5px 10px;font-size: 40px;">Кетеринг Генуа - Меню:</h3>
<?php 
$result = run_q('SELECT * FROM menu_ket ORDER BY corder');
while ($row = mysql_fetch_array($result)) {
    echo '<div class="cat_btn ket_cat'.$row['cat_id'].'">
        <h3 class="menu_title">'.$row['ctitle'].' &nbsp;&nbsp;<span>[<span class="plus-minus-sign">+</span>]</span></h3>
        <p style="margin: 0 0 0 40px;width:550px;">'.$row['cdesc'].'</p>
    </div>';
    echo '<div class="products_list_box">
        <p style="color:#002e6e;"><span style="float:left; margin: 0 0 0 245px;">гр</span> <span style="float:left;margin: 0 0 0 30px;">лв</span><span style="float: right;margin: 0 30px 0 30px;">лв</span> <span style="float: right;margin: 0 0 0 0px;">гр</span></p>
        <div style="clear:both;"></div>';
    $item_result = run_q('SELECT * FROM items_ket WHERE cat_id='.$row['cat_id']);
    while ($item_row = mysql_fetch_array($item_result)) {
            $item_name_clear = htmlspecialchars($item_row['item_name']);
        /*if($item_row['pic_name']=='no_picture.jpg'){
            $thumb_img_name = '';
        }
        else {        }*/
            $thumb_img_name = '<a title="'.$item_name_clear.'" href="img/upload/'.$item_row['pic_name'].'" class="lightbox ket_pic_link"><img src="img/upload/minithumb_'.$item_row['pic_name'].'"/></a>';

        echo '<p class="product_row">'.$thumb_img_name.$item_row['item_name'].'<span class="price">'.$item_row['item_price'].'</span> <span class="weight">'.$item_row['item_weight'].'</span></p>';
    }
    echo '</div><div style="clear:both;"></div>';
}
?>
</div>
<script type="text/javascript">
   $('.cat_btn').hover(function() {
       $(this).children().css('color', 'white');
       $(this).addClass('fuie');
       $(this).find('.plus-minus-sign').css('color', 'white');
   }, function() {
       $(this).children().css('color', '#002e6e');
       $(this).removeClass('fuie');
       $(this).find('.plus-minus-sign').css('color', '#d82427');
   });
</script>
<script type="text/javascript">
jQuery(document).ready(function(){

$(".cat_btn").toggle(function () {
$(this).next(".products_list_box").slideDown();
$(this).find('.plus-minus-sign').text(' - ');
}, function(){
$(this).next(".products_list_box").slideUp();
$(this).find('.plus-minus-sign').text('+');
});

});
</script>
<div id="menu_right_column">
    <h3 class="vera_cruz" style="font-size:40px;margin: 30px 0 0 0px;">Изкуството на кетъринга!</h3>
    <img src="img/ketering_picture.jpg" alt="Кетеринг" style="margin: 5px 0 0 2px;" />
    <h4 style="margin: 0 0 0 0px;">Изкуството на кетъринга и неговите предимсва!</h4>
    <p>За да разберете удобството при ползването на кетъринг, трябва да направите своя първи опит да организирате партито си по този начин!<br/><br/>Ето няколко  от неговите предимства:</p>
    <div style="width: 84px;float:left;margin: 0 0 0 10px;">
    <div class="circle">1.</div>
    <div class="circle">2.</div>
    <div class="circle">3.</div>
    </div>
    <div style="width: 200px;float: right;">
        <h4>Удобсво за домакинята:</h4>
        <p>Домакините ще посрещнат гостите си  отпочинали, без стреса на една кулинарна подготовка, предлагайки голямо разнообразие на хапки, подходящи за всеки вкус.</p>
        <h4>Красив и апетитен аранжимент:</h4>
        <p>Естетиката на красиво аранжираните хапки създава една изискана и празнична атмосфера</p>
        <h4>Възможност за по- добри социални контакти:</h4>
        <p>Спестяваме място  и вашите гости контактуват със всички свободно, без да са с определени места за вечеря на маса.</p>
    </div>
</div>
<div style="clear:both;">&nbsp;</div>
<?php 
include 'inc/footer.php';
?>