<?php 
include 'cfg.php';
include 'inc/functions.php';
?>
<?php 
headerz(2);
?>

<div id="menu_container">
<h3 class="vera_cruz" style="margin: 10px 0 5px 10px;font-size: 40px;">Ресторант Генуа - Меню:</h3>
<?php 
$result = run_q('SELECT * FROM menu ORDER BY corder');
while ($row = mysql_fetch_array($result)) {
    echo '<div class="cat_btn cat'.$row['cat_id'].'">
        <h3 class="menu_title">'.$row['ctitle'].' &nbsp;&nbsp;<span>[<span class="plus-minus-sign">+</span>]</span></h3>
        <p style="margin: 0 0 0 40px;width:550px;">'.$row['cdesc'].'</p>
    </div>';
    echo '<div class="products_list_box">
        <p style="color:#002e6e;"><span style="float:left; margin: 0 0 0 245px;">гр</span> <span style="float:left;margin: 0 0 0 30px;">лв</span><span style="float: right;margin: 0 30px 0 30px;">лв</span> <span style="float: right;margin: 0 0 0 0px;">гр</span></p>
        <div style="clear:both;"></div>';
    $item_result = run_q('SELECT * FROM items WHERE cat_id='.$row['cat_id']);
    while ($item_row = mysql_fetch_array($item_result)) {
            $item_name_clear = htmlspecialchars($item_row['item_name']);
      /*  if($item_row['pic_name']=='no_image.jpg'){
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
    <h3 class="vera_cruz" style="font-size:40px;margin: 30px 0 0 0px;">Тайните на готвача!</h3>
    <img src="img/chef_picture.jpg" alt="Професионален готвач" style="margin: 5px 0 0 2px;" />
    <h4 style="margin: 0 0 0 0px;">Ролята на готвача за доброто име на всеки ресторан:</h4>
    <p>Всички знаят, колко важна е ролята на добрия готвач за доброто име на всеки ресторант!<br/>
    Готвачът има своите хитринки, с които ще отличи ястията си и ще ги направи предпочитани. <br/><br/>Ето някои препоръки на нашия готвач:
    </p>
    <p>За да бъде ястието апетитно, основна роля играят подправките, поставени към подходящите продукти!</p>
    <div style="width: 84px;float:left;margin: 0 0 0 10px;">
    <div class="circle">1.</div>
    <div class="circle">2.</div>
    <div class="circle">3.</div>
    </div>
    <div style="width: 200px;float: right;">
        <h4>Карамфилът:</h4>
        <p>Карамфилът се използва при приготвянето на сладки ястия, супа и компоти. Добра комбинация се получава, като го добавим в тесто и маринати.</p>
        <h4>Джинджифилът:</h4>
        <p>Джинджифилът трябва да се слага в сладките, много добре подобрява вкуса на супи като боб-чорба и картофената. Приляга чудесно на всички оризови и зеленчукови ястия.</p>
        <h4>Канелата:</h4>
        <p>Канелата се използва за приготвянето на плодови ястия – сладкиши, торти и и всякакви други десерти.</p>
    </div>
        <h3 class="vera_cruz" style="font-size:40px;margin: 30px 0 0 0px;">Орк. Кристали!</h3>
    <img src="img/kristali.jpg" alt="Професионален готвач" style="margin: 5px 0 0 2px;" />
    <h4 style="margin: 0 0 0 0px;">Всеки петък и събота от 20:00:</h4>
    <p>За вашето добро настроение всеки петък и събота от 20:00 ще свири оркестър кристал. Не пропускайте!</p>
</div>
<div style="clear:both;">&nbsp;</div>
<?php 
include 'inc/footer.php';
?>