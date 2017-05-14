    <div id="featured_products">
        <h3>ПРОМОТИРАНИ ПРОДУКТИ:</h3>
        <div style="clear:both;"></div>

        <?php 
        $product_result = run_q('SELECT * FROM products WHERE is_promo=1 AND is_public=1 ORDER BY product_id DESC');
        $i = 1;
        while ($product_row = mysql_fetch_array($product_result)){
          $class = ($i % 4 == 0) ? ' last' : '';
        if(ae_detect_ie()){ // За интернет експлорър
            echo '<div class="product_box'.$class.'">
                    <div class="product_thumb">
                        <a rel=".overlay_box" class="overlay_trigger_link" href="showproduct.php?p='.$product_row['product_id'].'"><img style="margin: 0px;" alt="'.$product_row['pname'].'" src="img/product_img/'.$product_row['img_name'].'"/></a>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="product_title">Цена: '.$product_row['pfinal_price'].'<br/>'.$product_row['pname'].'</div>
                </div>';
        }else { // За нормалните браузъри
         echo '<div class="product_box'.$class.'">
                    <div class="product_thumb">
                        <img style="margin: 0px;" alt="'.$product_row['pname'].'" src="img/product_img/'.$product_row['img_name'].'"/>
                    </div>
                    <img class="product_frame" alt="Рамка на продукта" src="img/product_frame.png"/>
                        <span class="price"><span id="price_change">'.$product_row['pfinal_price'].'</span><span style="font-size:8px;">&nbsp;</span><span style="font-size: 14px;">лв/m<span style="vertical-align: super;font-size: 8px;">2</span></span></span>
                    <a class="overlay_trigger_link" rel=".overlay_box" href="showproduct.php?p='.$product_row['product_id'].'">Масивен дъб</a>
                    <div style="clear:both;"></div>
                    <div class="product_title">'.$product_row['pname'].'</div>
                </div>';   
        }
          $i++;
        }
        ?>



        <div style="clear: both;"></div>
        <div style="margin: 20px auto;width: 100%;text-align: center;">< <a href="products.php">Виж всички продукти</a> ></div>
<?php 
if(!ae_detect_ie()){?>
<div class="overlay_box"><div class="content_wrap">
                LOADING ...
            </div></div>
        <script> 
            $(document).ready(function() {
                var triggers = $(".overlay_trigger_link").overlay({
                    mask: {
                        color: '#000',
                        loadSpeed: 200,
                        opacity: 0.7
                    },
                    closeOnClick: true, fixed:true,
                    onBeforeLoad: function() {

                        // grab wrapper element inside content
                        var wrap = this.getOverlay().find(".content_wrap");

                        // load the page specified in the trigger
                        wrap.load(this.getTrigger().attr("href"));
                    }
                });
            });
        </script>    
<?php } ?>
    </div>


