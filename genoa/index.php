<?php 
include 'inc/functions.php';
?>
<?php 
headerz();
?>
                <div id="index_left_img_field">
                    <div id="left_hover-menu">
                        <div class="hover_list_box">
                            <h3>Ресторант Генуа:</h3>
                        <div style="clear:both;">&nbsp;</div>
                            <a href="menu.php" class="hover_item">Меню</a>
                            <a href="gallery.php" class="hover_item">Галерия</a>
                            <a href="contact.php" class="hover_item">Контакти</a>
                        </div>
                    </div>
                    <div id="left-pic" ><img src="img/left_pic.jpg" alt="Снимка на ястие"/></div>
                </div>
                <div class="index_info_field">
                    <h2 class="index_big_title">Ресторант Генуа</h2>
                    <p class="index_desc">Ресторант"Генуа" се намира в тиха част на кв."Изток" 
                        на 200м. от бул."Цариградско шосе". Разполага с приятна и свежа градина с 30 места,
                        а самият ресторант с 50 места, е на подземно ниво с прохладна и дискретна обстановка 
                        далеч от градския шум.</p>
                    <p class="index_reserv"><span style="font-weight: bold;font-family: Tahoma;color: #d82427;">Резервация:</span> +359 887 77 25 50</p>
                </div>
                     <script type="text/javascript">
                        $('#left-pic').parent().hover(function() {
                            $('#left_hover-menu').css('display', 'block');
                            $('#left_hover-menu').animate({
                                opacity: 1
                            }, 1);
                        }, function() {
                            $('#left_hover-menu').animate({
                                opacity: 0
                            }, 1, function() {
                                $('#left_hover-menu').css('display', 'none');
                            });
                        });
                    </script>
                <div id="index_right_img_field">
                    <div id="right_hover-menu">
                        <div class="hover_list_box">
                            <h3>Кетъринг Генуа:</h3>
                        <div style="clear:both;">&nbsp;</div>
                            <a href="menu_ketering.php" class="hover_item">Меню</a>
                            <a href="gallery_ketering.php" class="hover_item">Галерия</a>
                            <a href="contact_ketering.php" class="hover_item">Контакти</a>
                        </div>
                    </div>
                    <div id="right-pic" ><img src="img/right_pic.jpg" alt="Снимка на ястие"/></div>
                </div>
                    <div class="index_info_field" style="float:right;position: relative;top:-7px;">
                    <h2 class="index_big_title">Кетъринг Генуа</h2>
                    <p class="index_desc">Ресторант"Генуа" се намира в тиха част на кв."Изток" 
                        на 200м. от бул."Цариградско шосе". Разполага с приятна и свежа градина с 30 места,
                        а самият ресторант с 50 места, е на подземно ниво с прохладна и дискретна обстановка 
                        далеч от градския шум.</p>
                    <p class="index_reserv"><span style="font-weight: bold;font-family: Tahoma;color: #d82427;">Резервация:</span> +359 854 26 34 34</p>
                </div>
                     <script type="text/javascript">
                        $('#right-pic').parent().hover(function() {
                            $('#right_hover-menu').css('display', 'block');
                            $('#right_hover-menu').animate({
                                opacity: 1
                            }, 1);
                        }, function() {
                            $('#right_hover-menu').animate({
                                opacity: 0
                            }, 1, function() {
                                $('#right_hover-menu').css('display', 'none');
                            });
                        });
                    </script>
                    <div id="dotted_vert_blue_divider"></div>
                    
                    <div style="clear: both;">&nbsp;</div>
<?php 
include 'inc/footer.php';
?>