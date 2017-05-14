<?php
//include('db.php');
//session_start();
//$session_id='1'; //$session id
$path = "../img/upload/";


function recreate_gall_thumb($source, $thumb_width=250) {
    if($thumb_width == 250){
        $new_name = 'thumb_'.basename($source);
    }else { // $thumb_width = 20px;
        $new_name = 'minithumb_'.basename($source);
    }
    //$new_name = 'thumb_'.basename($source);
    $save_path = '../img/upload/';
    //$img = imagecreatefromjpeg($source);
    $info = getimagesize($source);
    switch ($info[2]) {
        case IMAGETYPE_JPEG:
            $img = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG:
            $img = imagecreatefrompng($source);
            break;
        case IMAGETYPE_GIF:
            $img = imagecreatefromgif($source);
            break;
        default:
            return false;
            break;
    }
    $width = imagesx($img);
    $height = imagesy($img);
    $new_width = $thumb_width;
    $new_height = floor($height * ($thumb_width / $width));
    $tmp_img = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagejpeg($tmp_img, $save_path . $new_name, 100);
    //unlink($source);
}

	$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<2097152)
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
                                                            recreate_gall_thumb($path . $actual_image_name, 250);
                                                            recreate_gall_thumb($path . $actual_image_name, 30);
								//mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
									
									echo "<img src='../img/upload/thumb_".$actual_image_name."' ><input type='hidden' name='pic_name' value='".$actual_image_name."'/>";
								}
							else
								echo "failed";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
		}
?>