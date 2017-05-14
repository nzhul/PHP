<?php
if (isset($_POST['x']) and $_SERVER['REQUEST_METHOD'] == "POST"){
    $x = (int)$_POST['x'];
    $y = (int)$_POST['y'];
    $w = (int)$_POST['w'];
    $h = (int)$_POST['h'];
    $tempimgsrc = $_POST['tempimgsrc'];
    $save_path = '../img/gallery/';
    $new_name = time() . '.jpg';
    $targ_w = 350;
    $targ_h = 250;
    $jpeg_quality = 90;

    $img_r = imagecreatefromjpeg($tempimgsrc );
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
    imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
    if(imagejpeg($dst_r,$save_path.'thumbs/'. $new_name,$jpeg_quality) && copy($tempimgsrc, $save_path.$new_name)){
        unlink($tempimgsrc);
        echo $save_path.'thumbs/'.$new_name;
    } else {
        echo 'error';
    };
}
?>
