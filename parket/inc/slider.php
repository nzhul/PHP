<div class="slider">
    <?php 
    // explode за цената
    // Ако дължината strlen на explode['1'] е по голяма от 1 (тоест 2) - правиме широчината на clear див-а - 220px; else - 180px;
    
    $slide_result = run_q('SELECT * FROM slides');
    while ($slide_row = mysql_fetch_array($slide_result)){
            $post_price_array = explode('.', $slide_row['slide_price']);
            $price_before = $post_price_array[0];
            $price_after = $post_price_array[1];
            if(mb_strlen($price_before, 'UTF-8')>1){
                $divsize = 'width: 235px;margin-left:-15px;';//big size
            }
            else {
                $divsize = 'width: 175px;';// small size
            }
        echo '    <div>
        <img src="img/slider/'.$slide_row['img_name'].'"/>
        <div class="caption">
            <div class="caption_text"><strong>'.$slide_row['slide_title'].'</strong><br/><span>'.$slide_row['slide_desc'].'</span></div>
            <div class="caption_price"><span class="big_price">'.$price_before.'</span><span class="small_price">.'.$price_after.'</span> <span class="small_text">лв/m<sup>2</sup></span><div style="clear: both;'.$divsize.'"></div></div>
        </div>
    </div>';
    }
    ?>
</div>