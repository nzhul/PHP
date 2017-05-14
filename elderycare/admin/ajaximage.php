<?php
//include('db.php');
//session_start();
//$session_id='1'; //$session id
$path = "../img/gallery/temp/";

$valid_formats = array("jpg", "png", "gif", "bmp");
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];

    if (strlen($name)) {
        list($txt, $ext) = explode(".", $name);
        if (in_array($ext, $valid_formats)) {
            if ($size < 2097152) {
                $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
                $tmp = $_FILES['photoimg']['tmp_name'];
                if (move_uploaded_file($tmp, $path . $actual_image_name)) {
                    echo '<img src="../img/gallery/temp/' . $actual_image_name . '" id="target"/><div style="clear: both;">&nbsp;</div>
                                    <form method="post" onsubmit="return checkCoords();">
                                        <input type="hidden" id="x" name="x" />
                                        <input type="hidden" id="y" name="y" />
                                        <input type="hidden" id="w" name="w" />
                                        <input type="hidden" id="h" name="h" />
                                        <input type="submit" value="ИЗРЕЖИ КАРТИНКАТА" id="crop-image-btn" />
                                    </form>';
                } else
                    echo "failed";
            } else {
                echo "Image file size max 1 MB";
            }
        } else {
            echo "Invalid file format..";
        }
    } else
        echo "Please select image..!";

    exit;
}
?>